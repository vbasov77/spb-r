<?php


namespace App\Repositories;

use App\User;
use Illuminate\Config\Repository;

class UserRepository extends Repository
{
    public function findByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function addUser(array $data)
    {
        User::insert([$data]);
    }
}