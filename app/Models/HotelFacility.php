<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelFacility extends Model
{
    use HasFactory;

    protected $table = 'hotel_facility';
    protected $guarded = ['id'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_facility_pivot', 'facility_id', 'hotel_id');
    }
}
