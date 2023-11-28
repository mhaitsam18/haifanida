<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'user',
        'kantor'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
