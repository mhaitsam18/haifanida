<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanKamar extends Model
{
    use HasFactory;

    protected $table = 'permintaan_kamar';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'pemesananKamar'
    ];

    public function pemesananKamar()
    {
        return $this->belongsTo(PemesananKamar::class);
    }
}
