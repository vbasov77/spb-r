<?php


namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    public function findByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function addUser(array $data): void
    {
        User::insert([$data]);
    }
}