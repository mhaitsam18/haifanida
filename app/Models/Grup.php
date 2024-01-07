<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'grup';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'paket',
        'agen',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function agen()
    {
        return $this->belongsTo(Agen::class);
    }

    public function jemaahs()
    {
        return $this->hasMany(Jemaah::class);
    }
    public function IsuPerjalanans()
    {
        return $this->hasMany(IsuPerjalanan::class);
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
