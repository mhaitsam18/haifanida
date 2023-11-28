<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'author'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
