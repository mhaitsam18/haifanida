<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'grup'
    ];

    public function grup()
    {
        return $this->belongsTo(Grup::class);
    }
}
