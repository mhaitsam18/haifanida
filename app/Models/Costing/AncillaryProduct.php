<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;

class AncillaryProduct extends Model
{
    protected $table = 'ancillary_product';
    protected $guarded = ['id'];

    protected $casts = [
        'default_cost' => 'decimal:2',
        'default_sell' => 'decimal:2',
        'default_takeup_pct' => 'decimal:4',
    ];
}
