<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKamar extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_kamar';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'pemesanan',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function permintaans()
    {
        return $this->hasMany(PermintaanKamar::class);
    }
}
