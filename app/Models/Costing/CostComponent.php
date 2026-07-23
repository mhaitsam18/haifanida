<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A costable component from the "Biaya Produksi" taxonomy. Carries its cost
 * behaviour, coverage requirements/provisions, and the per-component vendor
 * eligibility policy.
 */
class CostComponent extends Model
{
    protected $table = 'cost_component';
    protected $guarded = ['id'];

    protected $casts = [
        'provides_tags' => 'array',
        'requires_tags' => 'array',
        'params' => 'array',
        'requires_incorporated_vendor' => 'boolean',
        'rejects_individual_vendor' => 'boolean',
        'is_mandatory' => 'boolean',
    ];

    public function rateCards(): HasMany
    {
        return $this->hasMany(RateCard::class, 'cost_component_id');
    }

    public function scopeProduction($query)
    {
        return $query->where('kategori', 'production');
    }

    /**
     * Whether a vendor is eligible to supply THIS component, given its legal
     * entity type. The 2022 rule lives here (ticket only), never on the vendor.
     */
    public function allowsVendor(Vendor $vendor): bool
    {
        if ($this->rejects_individual_vendor && $vendor->isIndividual()) {
            return false;
        }

        if ($this->requires_incorporated_vendor && $vendor->is_incorporated !== true) {
            return false;
        }

        return true;
    }
}
