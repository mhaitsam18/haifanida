<?php

namespace App\Models\Costing;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * A priced, versioned rate row. Never mutated — superseding sets superseded_by
 * and (usually) valid_to on the old row and inserts a new one.
 */
class RateCard extends Model
{
    protected $table = 'rate_card';
    protected $guarded = ['id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_to' => 'date',
    ];

    public function vendorService(): BelongsTo
    {
        return $this->belongsTo(VendorService::class, 'vendor_service_id');
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(CostComponent::class, 'cost_component_id');
    }

    public function replacement(): BelongsTo
    {
        return $this->belongsTo(RateCard::class, 'superseded_by');
    }

    public function supersedes(): HasMany
    {
        return $this->hasMany(RateCard::class, 'superseded_by');
    }

    public function isBaseline(): bool
    {
        return $this->source === 'baseline';
    }

    /** Live (not superseded) and valid on $date. */
    public function scopeActiveOn($query, Carbon|string $date)
    {
        $day = ($date instanceof Carbon ? $date : Carbon::parse($date))->toDateString();

        return $query->whereNull('superseded_by')
            ->whereDate('valid_from', '<=', $day)
            ->where(function ($q) use ($day) {
                $q->whereNull('valid_to')->orWhereDate('valid_to', '>=', $day);
            });
    }

    public function scopeBaseline($query)
    {
        return $query->where('source', 'baseline');
    }

    public function scopeContracted($query)
    {
        return $query->where('source', 'contracted');
    }
}
