<?php

namespace App;

use App\Models\Booking;
use App\Models\UserPhone;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == 1;
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        return $this->role == 2;
    }

    /**
     * @param int $userIdOfThisRecipe
     * @return bool
     */
    public function isAuthor(int $userIdOfThisRecipe)
    {
        return $this->id == $userIdOfThisRecipe;
    }


    /**
     * @return HasOne
     */
    public function userPhone()
    {
        return $this->hasOne(UserPhone::class);
    }

    /**
     * @return HasOne
     */
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
