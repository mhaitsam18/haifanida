<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimoni';
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
