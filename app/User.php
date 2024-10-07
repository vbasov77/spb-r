<?php

namespace App;

use App\Models\Booking;
use App\Models\UserPhone;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isModerator()
    {
        return $this->role == 2;
    }

    public function userPhone()
    {
        return $this->hasOne(UserPhone::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
