<?php

namespace App\Services\Costing\Fx;

use App\Events\Costing\FxPolicyRevised;
use App\Models\Costing\FxPolicyVersion;
use App\Services\Costing\Exceptions\FxPolicyException;
use App\Services\Costing\Support\AuditLogger;
use App\Services\Costing\Support\FxPolicy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Resolves and revises the management-set fixed FX costing policy.
 *
 * Resolution is by effective date: forDate() returns the version in force on a
 * given day (newest effective_from on or before it), so reopening an old
 * costing always sees the rate that applied then. Revision creates a new
 * version, closes the previous one, enforces the SAR peg guard, writes an audit
 * row, and fires FxPolicyRevised.
 */
class FxPolicyService
{
    public function __construct(private AuditLogger $audit) {}

    /** The most recently dated version overall (what a revision supersedes). */
    public function latestVersion(): ?FxPolicyVersion
    {
        return FxPolicyVersion::orderByDesc('effective_from')->orderByDesc('id')->first();
    }

    /** The version in force on $date. Throws if none exists yet. */
    public function forDate(Carbon|string $date): FxPolicyVersion
    {
        $day = ($date instanceof Carbon ? $date : Carbon::parse($date))->toDateString();

        $version = FxPolicyVersion::whereDate('effective_from', '<=', $day)
            ->orderByDesc('effective_from')
            ->orderByDesc('id')
            ->first();

        if (! $version) {
            throw FxPolicyException::noPolicy($day);
        }

        return $version;
    }

    /** The version in force today. */
    public function current(): FxPolicyVersion
    {
        return $this->forDate(Carbon::now());
    }

    /** The immutable value object a costing pins for $date. */
    public function policyFor(Carbon|string $date): FxPolicy
    {
        $v = $this->forDate($date);

        return new FxPolicy(
            versionId: (int) $v->id,
            usdIdr: (float) $v->usd_idr,
            sarIdr: (float) $v->sar_idr,
            effectiveFrom: $v->effective_from->toDateString(),
        );
    }

    public function peg(): float
    {
        return (float) config('costing.fx.peg_sar_per_usd', 3.75);
    }

    /** SAR implied purely by the USD rate and the peg (the buffer floor). */
    public function impliedSar(float $usdIdr, ?float $peg = null): float
    {
        return $usdIdr / ($peg ?? $this->peg());
    }

    /**
     * Peg guard. Returns [implied, blocked, warning, ok].
     * - blocked: SAR below the peg-implied floor (removes the safety buffer).
     * - warning: SAR sits more than sar_buffer_warn_pct above implied (fat-finger).
     */
    public function validatePeg(float $usdIdr, float $sarIdr, ?float $peg = null): array
    {
        $peg ??= $this->peg();
        $implied = $this->impliedSar($usdIdr, $peg);
        $warnPct = (float) config('costing.fx.sar_buffer_warn_pct', 0.10);

        $blocked = ($sarIdr + 0.001) < $implied;

        $warning = (! $blocked && $implied > 0 && $sarIdr > $implied * (1 + $warnPct))
            ? sprintf(
                'Kurs SAR Rp%s berada %.1f%% di atas nilai patokan Rp%s. Pastikan ini disengaja.',
                number_format($sarIdr, 0, ',', '.'),
                ($sarIdr / $implied - 1) * 100,
                number_format($implied, 0, ',', '.'),
            )
            : null;

        return [
            'implied' => $implied,
            'blocked' => $blocked,
            'warning' => $warning,
            'ok' => ! $blocked,
        ];
    }

    /**
     * Create a new policy version. Enforces the peg guard, closes the previous
     * open version, writes an audit row, and fires FxPolicyRevised — all in one
     * transaction.
     *
     * @param  array{usd_idr: mixed, sar_idr: mixed, effective_from: mixed, reason?: string|null}  $data
     */
    public function revise(array $data, ?int $actorId = null): FxPolicyVersion
    {
        $usd = (float) $data['usd_idr'];
        $sar = (float) $data['sar_idr'];
        $peg = $this->peg();

        $check = $this->validatePeg($usd, $sar, $peg);
        if ($check['blocked']) {
            throw FxPolicyException::belowPeg($sar, $check['implied']);
        }

        return DB::transaction(function () use ($data, $usd, $sar, $peg, $actorId) {
            $effectiveFrom = Carbon::parse($data['effective_from'])->toDateString();
            $previous = $this->latestVersion();

            $version = FxPolicyVersion::create([
                'base_currency' => 'USD',
                'usd_idr' => $usd,
                'sar_idr' => $sar,
                'peg_sar_per_usd' => $peg,
                'effective_from' => $effectiveFrom,
                'effective_to' => null,
                'created_by' => $actorId ?? auth()->id(),
                'reason' => $data['reason'] ?? null,
            ]);

            // Close the prior version at the new version's start date.
            if ($previous && $previous->id !== $version->id) {
                $previous->update(['effective_to' => $effectiveFrom]);
            }

            $this->audit->record(
                action: 'fx_policy.revised',
                subject: $version,
                old: $previous?->only(['usd_idr', 'sar_idr', 'effective_from']),
                new: $version->only(['usd_idr', 'sar_idr', 'effective_from']),
                reason: $data['reason'] ?? null,
                userId: $actorId,
            );

            event(new FxPolicyRevised($version, $previous));

            return $version;
        });
    }
}
