<?php


namespace App\Repositories;


use App\Models\Booking;
use App\Models\Pay;

class PayRepository extends Repository
{
    public function updateBookInfoPayAndPay(int $id, string $info_pay, int $pay): void
    {
        $data = [
            'info_pay' => $info_pay,
            'pay' => $pay,
        ];
        Booking::where('id', $id)->update($data);
    }

    public function updateBookInfoPay(int $id, string $info_pay): void
    {
        Pay::where("booking_id", $id)->update(["info_pay" => $info_pay]);
    }
}