<?php


namespace App\Services;


use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Serializer;

class UserService extends Serializer
{

    public function checkEmail(string $email)
    {
        $userRepo = new UserRepository();
        return $userRepo->findByEmail($email) ? true : false;
    }

    public function addUser(string $nameUser, string $email, string $password){
        $userRepo = new UserRepository();
        $date = [
            'name' => $nameUser,
            'email' => $email,
            'password' => Hash::make($password),
        ];
        $userRepo->addUser($date);
    }
}