<?php

namespace App\Http\Controllers;

use App\Console\Commands\PaymentVerification;
use App\Mail\ConfirmOrder;
use App\Mail\DeleteOrderUser;
use App\Mail\RejectOrder;
use App\Mail\SendBooking;
use App\Mail\DeleteOrder;
use App\Mail\SendUserDeleteOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function view()
    {
        if (Auth::check()) {
            $data2 = DateController::getBookingDates();
            $arri = DateController::inOrder(); //Формируем даты по порядку
            return view('orders/orders')->with(['data' => $arri, 'data2' => $data2]);
        } else {
            return redirect()->route('login');
        }
    }

    public function viewForEdit($id)
    {

        $order = DbController::GetBookingOrderId($id);
        return view('/orders/order_edit')->with(['order' => $order]);


    }

    public function edit()
    {
        DbController::updateOrder($_POST);
        return redirect()->action('OrdersController@view');

    }

    public function delete($id)
    {
        DbController::deleteOrder($id);
        return redirect()->action('OrdersController@view');
    }

    public function deleteProf($id)
    {
        $data = DbController::deleteOrder($id);
        $subject = 'Удаление бронирования';
        $toEmail = '0120912@mail.ru';
        $user_email = $data['email_user'];
        Mail::to($toEmail)->send(new DeleteOrderUser($subject, $data));
        Mail::to($user_email)->send(new SendUserDeleteOrder($subject, $data));
        return redirect()->action('ProfileController@view');
    }

    public function confirm($id)
    {

        DbController::confirmOrder($id);

        $result = DbController::GetBookingOrderId($id);

        $data = [
            'name_user' => $result [0]['name_user'],
            'in' => $result [0]['no_in'],
            'out' => $result [0]['no_out'],
            'sum' => $result [0]['summ']

        ];
        $subject = 'Подтверждение бронирования';
        $toEmail = preg_replace("/\s+/", "", $result [0]['email_user']);
        Mail::to($toEmail)->send(new ConfirmOrder($subject, $data));
        return redirect()->action('OrdersController@view');
    }

    public function reject(int $id)
    {
        $result = DbController::GetBookingOrderId($id);
        $data = [
            'name_user' => $result [0]['name_user'],
            'in' => $result [0]['no_in'],
            'out' => $result [0]['no_out'],
            'sum' => $result [0]['summ']
        ];
        $subject = 'Бронирование не подтверждено';
        $toEmail = preg_replace("/\s+/", "", $result [0]['email_user']);
        Mail::to($toEmail)->send(new RejectOrder($subject, $data));
        $data = [
            'name_user' => $result [0]['name_user'],
            'phone_user' => $result [0]['phone_user'],
            'email_user' => $result [0]['email_user'],
            'no_in' => $result [0]['no_in'],
            'no_out' => $result [0]['no_out'],
            'user_info' => $result [0]['user_info'],
            'summ' => $result [0]['summ'],
            'pay' => $result [0]['pay'],
            'info_pay' => $result [0]['info_pay'],
            'confirmed' => $result [0]['confirmed'],
            'otz' => "Отклонено администратором"
        ];
        DB::table('arhiv')->insert($data);
        DbController::deleteOrder($id);
        return redirect()->action('OrdersController@view');
    }

    public function toPayView(int $id)
    {
        return view('orders/order_pay', ['id' => $id]);
    }

    public function toPay()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 16);
        $info_pay = 1 . ";" . $code . ";" . $_POST['summ'];
        DB::table('booking')->where('id', $_POST['id'])->update(['pay' => 1, 'info_pay' => $info_pay]);
        return redirect()->action('VerificationController@verificationUserBook', ['id' => $_POST['id']]);
    }


}
