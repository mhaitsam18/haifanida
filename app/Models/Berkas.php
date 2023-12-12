<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $guarded = [
        'id'
    ];

    public function berkasJemaah()
    {
        return $this->belongsTo(BerkasJemaah::class, 'berkas_id');
    }

    public function jemaahs()
    {
        return $this->belongsToMany(Jemaah::class, 'berkas_jemaah');
    }
}
