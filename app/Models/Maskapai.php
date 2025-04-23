<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maskapai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'maskapai';
    protected $guarded = [
        'id'
    ];

    public function paketMaskapais()
    {
        return $this->hasMany(PaketMaskapai::class);
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_maskapai');
    }
}
