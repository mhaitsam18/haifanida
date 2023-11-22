<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    protected $table = 'kantor';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'kabupaten'
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
