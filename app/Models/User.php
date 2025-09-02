<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'idemploye',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idemploye', 'idemploye');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'idrole');
    }
}