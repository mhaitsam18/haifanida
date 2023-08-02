<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $guarded = ['id'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function testimoni() : HasMany
    {
        return $this->hasMany(Testimoni::class);
    }
}
