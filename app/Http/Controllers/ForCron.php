<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DeleteOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForCron extends Controller
{
    public static function paymentVerification()
    {

        $result = DB::table('booking')->get();
        $arr = json_decode(json_encode($result), true);
        $today = date("d.m.Y");
        foreach ($arr as $item) {

            if (strtotime($item['payment_term']) == strtotime($today) && $item['pay'] == 0) {
                $data = [
                    'name_user' => $item['name_user'],
                    'phone_user' => $item['phone_user'],
                    'email_user' => $item['email_user'],
                    'no_in' => $item['no_in'],
                    'no_out' => $item['no_out'],
                    'otz' => "отменено за неуплату",
                    'user_info' => $item['user_info'],
                    'summ' => $item['summ'],
                    'pay' => $item['pay'],
                    'info_pay' => $item['info_pay'],
                ];
                DB::table('arhiv')->insert($data);
                DB::table('booking')->delete($item['id']);
                $params = [
                    'name_user' => $item['name_user'],
                ];
                $subject = 'Бронирование аннулировано';
                $toEmail = $item['email_user'];
                Mail::to($toEmail)->send(new DeleteOrder($subject, $params));
            }
        }
    }


}
