<?php

namespace App\Models\Costing;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorService extends Model
{
    protected $table = 'vendor_service';
    protected $guarded = ['id'];

    protected $casts = [
        'coverage_tags' => 'array',
        'aktif' => 'boolean',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function rateCards(): HasMany
    {
        return $this->hasMany(RateCard::class, 'vendor_service_id');
    }

    /** @return string[] */
    public function providedTags(): array
    {
        return $this->coverage_tags ?? [];
    }

    public function providesTag(string $tag): bool
    {
        return in_array($tag, $this->providedTags(), true);
    }
}
