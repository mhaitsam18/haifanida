<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';
    protected $guarded = [
        'id'
    ];

    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }
}
