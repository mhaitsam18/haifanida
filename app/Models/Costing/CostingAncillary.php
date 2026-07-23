<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostingAncillary extends Model
{
    protected $table = 'costing_ancillary';
    protected $guarded = ['id'];

    protected $casts = [
        'cost' => 'decimal:2',
        'sell' => 'decimal:2',
        'takeup_pct' => 'decimal:4',
        'participants' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'margin' => 'decimal:2',
        'counts_to_floor' => 'boolean',
    ];

    public function costing(): BelongsTo
    {
        return $this->belongsTo(Costing::class, 'costing_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(AncillaryProduct::class, 'ancillary_product_id');
    }
}
