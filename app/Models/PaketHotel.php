<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketHotel extends Model
{
    use HasFactory;

    protected $table = 'paket_hotel';
    protected $guarded = [
        'id'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
