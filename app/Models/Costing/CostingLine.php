<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostingLine extends Model
{
    protected $table = 'costing_line';
    protected $guarded = ['id'];

    protected $casts = [
        'group_total' => 'decimal:2',
        'per_pilgrim' => 'decimal:2',
        'active' => 'boolean',
        'is_baseline' => 'boolean',
    ];

    public function costing(): BelongsTo
    {
        return $this->belongsTo(Costing::class, 'costing_id');
    }

    public function rateCard(): BelongsTo
    {
        return $this->belongsTo(RateCard::class, 'rate_card_id');
    }
}
