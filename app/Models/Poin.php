<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    protected $table = 'poin';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'agen',
    ];

    public function agen()
    {
        return $this->belongsTo(Agen::class);
    }
}
