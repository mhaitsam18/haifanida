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

    public function indukKantor()
    {
        return $this->belongsTo(Kantor::class, 'induk_kantor_id');
    }

    public function subKantor()
    {
        return $this->hasMany(Kantor::class, 'induk_kantor_id');
    }
}
