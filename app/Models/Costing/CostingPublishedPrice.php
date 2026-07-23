<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostingPublishedPrice extends Model
{
    protected $table = 'costing_published_price';
    protected $guarded = ['id'];

    protected $casts = [
        'occupancy' => 'integer',
        'price' => 'decimal:2',
    ];

    public function costing(): BelongsTo
    {
        return $this->belongsTo(Costing::class, 'costing_id');
    }
}
