<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jemaah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jemaah';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'pemesanan',
        'grup',
    ];


    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
    public function grup()
    {
        return $this->belongsTo(Grup::class);
    }


    public function mahram() //setiap Wanita harus memiliki Mahram yang terhubung ke jema'ah laki-laki
    {
        return $this->belongsTo(Jemaah::class, 'mahram_id');
    }
    public function mahrams() //setiap laki-laki bisa dimahramkan dengan beberapa perempuan seperti ibunya, anaknya, istrinya, dan lain-lain.
    {
        return $this->hasMany(Jemaah::class, 'mahram_id');
    }
    // public function jemaah()
    // {
    //     return $this->hasOne(Jemaah::class, 'mahram_id');
    // }
    public function testimoni()
    {
        return $this->hasOne(Testimoni::class);
    }
    public function sertifikatJemaah()
    {
        return $this->hasOne(SertifikatJemaah::class);
    }


    public function berkasJemaahs()
    {
        return $this->hasMany(BerkasJemaah::class);
    }
    public function busJemaahs()
    {
        return $this->hasMany(BusJemaah::class);
    }
    public function KamarJemaahs()
    {
        return $this->hasMany(KamarJemaah::class);
    }

    public function berkass()
    {
        return $this->belongsToMany(Berkas::class, 'berkas_jemaah');
    }
    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'bus_jemaah');
    }
    public function kamars()
    {
        return $this->belongsToMany(Kamar::class, 'kamar_jemaah');
    }
}
