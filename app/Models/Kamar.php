<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'paket'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function KamarJemaahs()
    {
        return $this->hasMany(KamarJemaah::class);
    }

    public function jemaahs()
    {
        return $this->belongsToMany(Jemaah::class, 'kamar_jemaah');
    }
}
