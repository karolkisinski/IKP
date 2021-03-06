<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * default profile pic URL if no profile photo has been uploaded
     */
    protected function defaultProfilePhotoUrl(){
        return asset('/storage/images/default_profile_pic.jpg');
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['profile', 'services'];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function pets(){
        return $this->hasMany(Pet::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function isAdmin(): bool
    {
        return $this->role == self::ROLE_ADMIN;
    }
}
