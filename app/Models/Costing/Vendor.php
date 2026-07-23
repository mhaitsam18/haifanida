<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Vendor master. Legal-entity fields are descriptive only; eligibility is
 * enforced per component (see CostComponent::allowsVendor). Payment/bridging
 * fields describe the supplier-credit terms Module 2 will price against cost of
 * capital.
 */
class Vendor extends Model
{
    protected $table = 'vendor';
    protected $guarded = ['id'];

    protected $casts = [
        'is_incorporated' => 'boolean',
        'is_related_party' => 'boolean',
        'deposit_is_layered' => 'boolean',
        'contingent_liability_on_cancel' => 'boolean',
        'will_bridge_payment' => 'boolean',
        'relationship_since' => 'date',
        'deposit_pct' => 'decimal:2',
        'deposit_flat' => 'decimal:2',
        'bridging_ceiling' => 'decimal:2',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(VendorService::class, 'vendor_id');
    }

    public function isIndividual(): bool
    {
        return $this->legal_entity_type === 'perorangan';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
