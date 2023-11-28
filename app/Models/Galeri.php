<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';
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
}
