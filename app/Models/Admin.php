<?php

namespace App\Models;

// Perhatikan baris di bawah ini, pastikan tidak ada typo
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'username'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}