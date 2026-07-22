<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelExternalId extends Model
{
    use HasFactory;

    protected $table = 'hotel_external_id';
    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
