<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table      = 'kontak';
    protected $primaryKey = 'key';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;
}
