<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatan';
    protected $guarded = ['id'];

    public function kategori() : BelongsTo
    {
        return $this->belongsTo(KategoriCatatan::class, 'kategori_catatan_id');
    }
}
