<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    protected $table = 'kantor';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'kabupaten'
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }


    public function pakets()
    {
        return $this->hasMany(Paket::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function agens()
    {
        return $this->hasMany(Agen::class);
    }


    public function perwakilans()
    {
        return $this->hasMany(Perwakilan::class);
    }

    public function cabangs()
    {
        return $this->hasMany(Cabang::class);
    }
}
