<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusJemaah extends Model
{
    use HasFactory;

    protected $table = 'bus_jemaah';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'bus',
        'jemaah',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }
}
