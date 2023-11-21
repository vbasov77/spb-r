<?php


namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    protected $table = 'user_phone';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}