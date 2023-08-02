<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimoni';
    protected $guarded = ['id'];

    public function pelanggan() : BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function pesanan() : BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }
}
