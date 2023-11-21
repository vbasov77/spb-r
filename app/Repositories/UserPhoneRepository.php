<?php


namespace App\Repositories;


use App\Models\UserPhone;

class UserPhoneRepository extends Repository
{
    public function findPhoneByUserId(int $user_id)
    {
        return UserPhone::where('user_id', $user_id)->value('phone');
    }
}