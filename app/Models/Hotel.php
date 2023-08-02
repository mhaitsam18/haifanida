<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotel';
    protected $guarded = ['id'];

    public function paket() : HasMany
    {
        return $this->hasMany(Hotel::class);
    }
}
