<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $guarded = ['id'];

    public function pesanan() : HasMany
    {
        return $this->hasMany(Pesanan::class);
    }

    public function hotelMadinah() : BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_madinah_id');
    }

    public function hotelMekah() : BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_mekah_id');
    }

    public function maskapai() : BelongsTo
    {
        return $this->belongsTo(Maskapai::class);
    }
}
