<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'perwakilan',
        'kantor',
    ];

    public function perwakilan()
    {
        return $this->belongsTo(Perwakilan::class);
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }
}
