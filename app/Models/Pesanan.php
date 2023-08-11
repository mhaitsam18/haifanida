<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $guarded = ['id'];

    public function pelanggan() : BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function paket() : BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }

    public function jemaah() : HasMany {
        return $this->hasMany(Jemaah::class);
    }
}
