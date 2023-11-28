<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function pemesanans()
    // {
    //     return $this->hasMany(Pemesanan::class);
    // }
}
