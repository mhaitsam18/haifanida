<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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

    protected function keberangkatan(): Attribute {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->locale('id')->format('d F Y')
        );
    }
}
