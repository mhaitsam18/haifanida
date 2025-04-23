<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hotel';
    protected $guarded = [
        'id'
    ];
    public function paketHotels()
    {
        return $this->hasMany(PaketHotel::class);
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_hotel');
    }
}
