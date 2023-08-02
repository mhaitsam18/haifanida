<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriCatatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_catatan';
    protected $guarded = ['id'];

    public function catatan() : HasMany
    {
        return $this->hasMany(Catatan::class);
    }
}
