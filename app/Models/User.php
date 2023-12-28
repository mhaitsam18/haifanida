<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

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

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPasswordNotification($token));
    // }


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

    //GATE

    public function isAdmin()
    {
        return $this->role_id === 1;
    }
    public function isSuperAdmin()
    {
        return !$this->admin->kantor_id;
    }
    public function isAdminKantor()
    {
        return $this->admin->is_superadmin !== true;
    }
    public function isAuthor()
    {
        return $this->role_id === 2;
    }
    public function isMember()
    {
        return $this->role_id === 3;
    }
    public function isJemaah()
    {
        return $this->pemesanans()->whereHas('jemaah', function ($query) {
            $query->where('is_active', 1);
        })->exists();
    }
    public function isPusat()
    {
        return $this->admin->kantor->jenis_kantor !== 'pusat';
    }
    public function isPerwakilan()
    {
        return $this->admin->kantor->jenis_kantor !== 'perwakilan';
    }
    public function isCabang()
    {
        return $this->admin->kantor->jenis_kantor !== 'cabang';
    }
    public function isAgen()
    {
        return $this->role_id === 4;
    }
}
