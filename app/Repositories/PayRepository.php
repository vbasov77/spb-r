<?php


namespace App\Repositories;


use App\Models\Booking;

class PayRepository extends Repository
{
    public function updateBookInfoPayAndPay(int $id, string $info_pay, int $pay)
    {
        $data = [
            'info_pay' => $info_pay,
            'pay' => $pay,
            'payment_term' => null,
        ];
        Booking::where('id', $id)->update($data);
    }

    public function updateBookInfoPay(int $id, string $info_pay)
    {
        Booking::where("id", $id)->update(["info_pay" => $info_pay]);
    }
}