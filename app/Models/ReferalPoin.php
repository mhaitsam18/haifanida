<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferalPoin extends Model
{
    use HasFactory;

    protected $table = 'referal_poin';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'referal',
    ];

    public function referal()
    {
        return $this->belongsTo(Referal::class);
    }
}
