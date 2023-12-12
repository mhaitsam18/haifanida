<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketEkstra extends Model
{
    use HasFactory;

    protected $table = 'paket_ekstra';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'paket',
        'ekstra'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
