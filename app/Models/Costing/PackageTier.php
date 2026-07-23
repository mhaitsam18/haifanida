<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;

class PackageTier extends Model
{
    protected $table = 'package_tier';
    protected $guarded = ['id'];

    protected $casts = [
        'is_private' => 'boolean',
        'estimated_publish' => 'decimal:2',
        'margin_floor_amount' => 'decimal:2',
        'margin_floor_pct' => 'decimal:2',
    ];
}
