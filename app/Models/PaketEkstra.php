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

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class);
    }
}
