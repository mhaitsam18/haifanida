<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    use HasFactory;

    protected $table = 'hotel_image';
    protected $guarded = ['id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
