<?php

namespace App\Models;

// Perhatikan baris di bawah ini, pastikan tidak ada typo
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword, HasApiTokens, Notifiable;

    protected $table = 'admins';

    protected $primaryKey = 'username';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['username', 'email', 'password', 'avatar_url'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
