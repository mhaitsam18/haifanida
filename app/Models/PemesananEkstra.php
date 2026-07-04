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

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
