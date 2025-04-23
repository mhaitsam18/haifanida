<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstra extends Model
{
    use HasFactory;

    protected $table = 'ekstra';
    protected $guarded = [
        'id'
    ];
    public function paketEkstras()
    {
        return $this->hasMany(PaketEkstra::class);
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_ekstra');
    }
}
