<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maskapai extends Model
{
    use HasFactory;

    protected $table = 'maskapai';
    protected $guarded = ['id'];

    public function paket() : HasMany
    {
        return $this->hasMany(Paket::class);
    }
}
