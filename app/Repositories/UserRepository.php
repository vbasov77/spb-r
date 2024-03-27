<?php


namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    public function findByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function addUser(array $data): int
    {
        return User::insertGetId($data);
    }

    public function getUserIdByEmail(string $email)
    {
        return User::where('email', $email)->value('id');
    }
}