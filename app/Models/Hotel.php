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

    protected $casts = [
        'aktif' => 'boolean',
        'shuttle_tersedia' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'checkin' => 'datetime:H:i',
        'checkout' => 'datetime:H:i',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // --- Existing booking-system relationships (unchanged) ----------------
    public function paketHotels()
    {
        return $this->hasMany(PaketHotel::class);
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_hotel');
    }

    // --- Curated master-data relationships (Phase 1) ----------------------
    public function chain()
    {
        return $this->belongsTo(HotelChain::class, 'hotel_chain_id');
    }

    public function images()
    {
        return $this->hasMany(HotelImage::class)->orderBy('urutan');
    }

    public function facilities()
    {
        return $this->belongsToMany(HotelFacility::class, 'hotel_facility_pivot', 'hotel_id', 'facility_id');
    }

    public function nearbyPlaces()
    {
        return $this->hasMany(HotelNearbyPlace::class);
    }

    public function externalIds()
    {
        return $this->hasMany(HotelExternalId::class);
    }
}
