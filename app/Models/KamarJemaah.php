<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarJemaah extends Model
{
    use HasFactory;

    protected $table = 'kamar_jemaah';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'kamar',
        'jemaah'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }
}
