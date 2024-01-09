<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paket';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'kantor'
    ];

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }


    public function galeries()
    {
        return $this->hasMany(Galeri::class);
    }
    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }
    public function grups()
    {
        return $this->hasMany(Grup::class);
    }
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
    // public function kamars()
    // {
    //     return $this->hasMany(Kamar::class);
    // }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'paket_id');
    }


    public function paketEkstras()
    {
        return $this->hasMany(PaketEkstra::class);
    }

    public function ekstras()
    {
        return $this->belongsToMany(Ekstra::class, 'paket_ekstra');
    }

    public function paketHotels()
    {
        return $this->hasMany(PaketHotel::class);
    }

    public function penginapans()
    {
        return $this->hasMany(PaketHotel::class);
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'paket_hotel');
    }

    public function paketMaskapais()
    {
        return $this->hasMany(PaketMaskapai::class);
    }
    public function penerbangans()
    {
        return $this->hasMany(PaketMaskapai::class);
    }

    public function maskapais()
    {
        return $this->belongsToMany(Maskapai::class, 'paket_maskapai');
    }
}
