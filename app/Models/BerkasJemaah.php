<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasJemaah extends Model
{
    use HasFactory;

    protected $table = 'berkas_jemaah';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'jemaah',
        'berkas',
    ];

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }
    public function berkas()
    {
        return $this->belongsTo(Berkas::class, 'berkas_id');
    }
}
