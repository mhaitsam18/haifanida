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
    protected $with = [
        'children',
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
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // public function hasChildren()
    // {
    //     return $this->children->count() > 0;
    // }
}
