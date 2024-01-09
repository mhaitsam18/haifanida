<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanan';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        ''
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function agen()
    // {
    //     return $this->belongsTo(Agen::class);
    // }
    // public function member()
    // {
    //     return $this->belongsTo(Member::class);
    // }
    // public function admin()
    // {
    //     return $this->belongsTo(Admin::class);
    // }

    public function jemaahs()
    {
        return $this->hasMany(Jemaah::class);
    }
    public function pemesananEkstras()
    {
        return $this->hasMany(PemesananEkstra::class);
    }
    public function pemesananKamars()
    {
        return $this->hasMany(PemesananKamar::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
