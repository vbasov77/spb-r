<?php


namespace App\Services;


use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{

    public function checkEmail(string $email): bool
    {
        $userRepo = new UserRepository();
        return $userRepo->findByEmail($email) ? true : false;
    }

    public function addUser(string $nameUser, string $email, string $password): void
    {
        $userRepo = new UserRepository();
        $date = [
            'name' => $nameUser,
            'email' => $email,
            'password' => Hash::make($password),
        ];
        $userRepo->addUser($date);
    }
}