<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananEkstra extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_ekstra';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'pemesanan'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
