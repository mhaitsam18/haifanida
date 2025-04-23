<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsuPerjalanan extends Model
{
    use HasFactory;

    protected $table = 'isu_perjalanan';
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
