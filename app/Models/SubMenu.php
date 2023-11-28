<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $table = 'sub_menus';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'menu'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
