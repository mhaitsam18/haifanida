<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function agen()
    {
        return $this->hasOne(Agen::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function author()
    {
        return $this->hasOne(Author::class);
    }

    public function kontens()
    {
        return $this->hasMany(Konten::class);
    }

    public function pesans()
    {
        return $this->hasMany(Pesan::class);
    }
    public function referals()
    {
        return $this->hasMany(Referal::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
