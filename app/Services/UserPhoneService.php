<?php


namespace App\Services;


use App\Models\UserPhone;
use App\Repositories\UserPhoneRepository;
use App\User;

class UserPhoneService extends Service
{
    private $userPhoneRepository;


    public function __construct()
    {
        $this->userPhoneRepository = new UserPhoneRepository();
    }


    public function checkPhone(int $userId)
    {
        return $this->userPhoneRepository->findPhoneByUserId($userId);
    }

    public function savePhone(int $userId, string $phone): void
    {
        $userPhone = new UserPhone();
        $userPhone->user_id = $userId;
        $userPhone->phone = $phone;
        $userPhone->save();

    }
}