<?php

namespace App\Models\Costing;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One version of the management-set fixed FX costing policy. Versions are never
 * mutated in place; revising creates a new row and closes the previous one
 * (effective_to). A costing pins the version it was built on, so historical
 * margins never shift when the policy changes.
 */
class FxPolicyVersion extends Model
{
    use HasFactory;

    protected $table = 'fx_policy_version';
    protected $guarded = ['id'];

    protected $casts = [
        'usd_idr' => 'decimal:2',
        'sar_idr' => 'decimal:2',
        'peg_sar_per_usd' => 'decimal:4',
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** SAR value implied purely by the USD rate and the peg (no buffer). */
    public function impliedSar(): float
    {
        $peg = (float) $this->peg_sar_per_usd ?: 3.75;

        return (float) $this->usd_idr / $peg;
    }

    /** How far above the peg-implied SAR this policy's SAR sits (the buffer). */
    public function bufferPct(): float
    {
        $implied = $this->impliedSar();

        return $implied > 0 ? ((float) $this->sar_idr - $implied) / $implied : 0.0;
    }
}
