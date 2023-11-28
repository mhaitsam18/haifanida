<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatJemaah extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_jemaah';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'jemaah'
    ];

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }
}
