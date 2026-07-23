<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;

class FxMarketRate extends Model
{
    protected $table = 'fx_market_rate';
    protected $guarded = ['id'];

    protected $casts = [
        'usd_idr' => 'decimal:2',
        'observed_on' => 'date',
    ];

    public static function latest(): ?self
    {
        return static::orderByDesc('observed_on')->orderByDesc('id')->first();
    }
}
