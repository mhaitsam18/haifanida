<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guarded = [
        'id'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_roles');
    }

    public function menuRoles()
    {
        return $this->hasMany(MenuRole::class);
    }

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class);
    }
}
