<?php

namespace App\Http\Controllers;

use App\Mail\PayQiwi;
use App\Mail\SendAmount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

class QiwiController extends Controller
{
    public function result()
    {
        $dat = file_get_contents("php://input");
        $data = json_decode($dat, 1);
        $id = $data ['bill']['comment'];
        $res = DbController::GetBookingOrderId($id);
        $bill = $res [0] ['info_pay'];
        $bill_array = explode(';', $bill);
        $billId = $bill_array[1];
        if ($billId == $data ['bill']['billId']) {
            $pay = 1;
            $info = [];
            $info[] = 1;
            $info[] = $billId;
            $info[] = $data ['bill']['amount']['value'];
            $info_pay = implode(';', $info);
            DbController::updateBookInfoPayAndPay($id, $info_pay, $pay);
        }
        $subject = 'Произведена оплата';
        $toEmail = "0120912@mail.ru";
        Mail::to($toEmail)->send(new PayQiwi($subject, $data));
        $subject2 = 'Произведена оплата';
        $toEmail2 = $res [0] ['email_user'];
        Mail::to($toEmail2)->send(new SendAmount($subject2, $data));
        Route::get('/clear', function () {
            Artisan::call('cache:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
        });
    }

    public function verification($id)
    {
        $res = DbController::GetBookingOrderId($id);
        if (!empty($res)) {
            if (!empty($res [0]['info_pay']) == 0) {
                $billId = sha1(random_bytes(20));
                $pay = [];
                $pay[] = 0;
                $pay[] = $billId;
                $info_pay = implode(';', $pay); //Создали строку из массива
                DbController::updateBookInfoPay($id, $info_pay);
                $data = DbController::GetBookingOrderId($id);
                $c_pay = $data [0]['summ'] * (20 / 100);
                return view('/qiwi/q_pay')->with(['data' => $data, 'c_pay' => $c_pay, 'billId' => $billId]);
            } else {
                $bill = $res [0] ['info_pay'];
                $bill_array = explode(';', $bill);
                $billId = $bill_array [1];
                $c_pay = $res [0]['summ'] * (20 / 100);
                return view('/qiwi/q_pay')->with(['data' => $res, 'c_pay' => $c_pay, 'billId' => $billId]);
            }
        }


    }


    public function pay()
    {
        $publicKey = KeyController::keyPublicQiwi();
        $billId = $_POST ['billId'];
        $amount = $_POST ['amount'];
        $id = $_POST ['id'];;
        $url = "https://oplata.qiwi.com/create?publicKey=" . $publicKey . "&amount=" . $amount . "&billId=" . $billId . "&comment=" . $id . "&customFields[themeCode]=Vytalyi-BRODDK2q2-&successUrl=https://mieten.ru/q_success";
        echo '<meta http-equiv="refresh" content="0; URL=' . $url . '">';

    }

    public function success()
    {
        $mess = "Оплата прошла успешно!";
        return redirect()->action('DankeController@view', ['mess' => $mess]);
    }

}
