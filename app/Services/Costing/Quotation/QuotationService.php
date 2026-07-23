<?php

namespace App\Services\Costing\Quotation;

use App\Models\Costing\Costing;
use App\Models\Costing\Quotation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Persists private quotations. A quote is saved against a costing snapshot (which
 * already pins FX/rate-card/visa/overhead versions), so the exact figure is
 * reproducible. Re-quoting the same reference creates a new version and
 * supersedes the prior one, keeping the round-by-round history that private
 * customisation produces.
 */
class QuotationService
{
    public function save(
        Costing $costing,
        array $config,
        ?string $customerName = null,
        ?int $validDays = null,
        ?string $reference = null,
        ?int $actorId = null,
    ): Quotation {
        $validDays ??= (int) config('costing.quotation_valid_days', 14);

        return DB::transaction(function () use ($costing, $config, $customerName, $validDays, $reference, $actorId) {
            if ($reference === null) {
                $reference = $this->nextReference();
                $version = 1;
            } else {
                $version = (int) Quotation::where('reference', $reference)->max('version') + 1;
                Quotation::where('reference', $reference)->update(['status' => 'superseded']);
            }

            return Quotation::create([
                'reference' => $reference,
                'version' => $version,
                'keberangkatan_id' => $costing->keberangkatan_id,
                'costing_id' => $costing->id,
                'paket_id' => $costing->paket_id,
                'customer_name' => $customerName,
                'config_json' => $config,
                'quoted_price' => $costing->publish_price ?? ($costing->burden_per_pilgrim + $costing->package_margin),
                'quoted_margin' => $costing->package_margin,
                'valid_until' => Carbon::today()->addDays($validDays),
                'status' => 'draft',
                'created_by' => $actorId,
            ]);
        });
    }

    /** Q-YYYY-NNNN, sequence per year. */
    public function nextReference(): string
    {
        $year = now()->year;
        $prefix = "Q-{$year}-";
        $last = Quotation::where('reference', 'like', $prefix.'%')
            ->orderByDesc('reference')->value('reference');
        $seq = $last ? ((int) substr($last, strlen($prefix)) + 1) : 1;

        return $prefix.str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
    }
}
