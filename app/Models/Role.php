<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $guarded = [
        'id'
    ];

    /**
     * Resolve a role's id by its name, cached, so callers never need to
     * hardcode role ids (which only reflect seeding order, not identity).
     */
    public static function idFor(string $role): ?int
    {
        return Cache::rememberForever("role-id:{$role}", function () use ($role) {
            return static::where('role', $role)->value('id');
        });
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_roles');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function menuRoles()
    {
        return $this->hasMany(MenuRole::class);
    }
}
