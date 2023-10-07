<?php


namespace App\Services;


use App\Repositories\PayRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;

class PayService extends Serializer
{
    public function updateBookInfoPayAndPay(int $id, string $info_pay, int $pay)
    {
        $payRepo = new PayRepository();
        $payRepo->updateBookInfoPayAndPay($id, $info_pay, $pay);
    }

    public function updateBookInfoPay(int $id, string $info_pay)
    {
        $payRepo = new PayRepository();
        $payRepo->updateBookInfoPay($id, $info_pay);
    }
}