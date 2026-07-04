<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketMaskapai extends Model
{
    use HasFactory;

    protected $table = 'paket_maskapai';
    protected $guarded = [
        'id'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class);
    }
}
