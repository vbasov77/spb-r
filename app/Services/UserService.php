<?php


namespace App\Services;


use App\Models\UserPhone;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{

    public function checkEmail(string $email): bool
    {
        $userRepo = new UserRepository();
        return $userRepo->findByEmail($email) ? true : false;
    }

    public function addUser(string $nameUser, string $email, string $password, string $phone): int
    {
        $userRepo = new UserRepository();
        $user = new User();
        $user->name = $nameUser;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $userPhone = new UserPhone();
        $userPhone->user_id = $user->id;
        $userPhone->phone = $phone;
        $user->userPhone()->save($userPhone);

        return $user->id;
    }

    public function getUserIdByEmail(string $email)
    {
        $userRepository = new UserRepository();
        return $userRepository->getUserIdByEmail($email);
    }


}