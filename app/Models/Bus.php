<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'bus';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'paket'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function jemaahs()
    {
        return $this->belongsToMany(Jemaah::class, 'bus_jemaah');
    }

    public function busJemaahs()
    {
        return $this->hasMany(BusJemaah::class);
    }
}
