<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perwakilan extends Model
{
    use HasFactory;

    protected $table = 'perwakilan';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'kantor',
    ];

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }


    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }
}
