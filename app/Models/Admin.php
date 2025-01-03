<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'admins';

    protected $fillable = ['id', 'name', 'email', 'password', 'is_active', 'is_admin', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
