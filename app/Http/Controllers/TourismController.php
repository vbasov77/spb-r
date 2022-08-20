<?php

namespace App\Http\Controllers;


use App\Mail\SendRegister;
use App\Mail\SendTour;
use App\Mail\SendTourAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TourismController extends Controller
{
    public function PushAndPav()
    {
        $datedis = [];
        return view('tourism/push&pav', ['datedis' => $datedis]);
    }

    public function PushAndPavBook()
    {

        if (Auth::check()) {
            $data = [
                'email_user' => Auth::user()->email,
                'name_user' => Auth::user()->name,
                'date_tour' => $_POST['el'],
                'phone_user' => Auth::user()->phone_user,
                'summ' => 2500,
            ];
        } else {
            $data = [
                'date_tour' => $_POST['el'],
                'summ' => 2500,
            ];
        }
        return view('tourism/add_info', ['data' => $data]);
    }

    public function addPushAndPav()
    {
        DB::table('tour')->insert([
            'name_user' => $_POST['name_user'],
            'phone_user' => $_POST['phone_user'],
            'email_user' => $_POST['email_user'],
            'name_tour' => $_POST['name_tour'],
            'date_tour' => $_POST['date_tour'],
            'time_tour' => $_POST['time_tour'],
            'guests' => $_POST['guests'],
            'summ' => $_POST['summ'],

        ]);
        $users = DB::table('users')->get();
        $u = json_decode(json_encode($users), true);
        $users_email = [];
        foreach ($u as $value) {
            $users_email [] = $value ['email'];
        }
        $email = $_POST['email_user'];
        if (empty(in_array($email, $users_email))) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = substr(str_shuffle($permitted_chars), 0, 16);
            DB::table('users')->insert([
                'name' => $_POST['name_user'],
                'email' => $_POST ['email_user'],
                'phone_user' => $_POST ['phone_user'],
                'password' => Hash::make($password),
            ]);
            $params = [
                'name_user' => $_POST['name_user'],
                'email_user' => $_POST ['email_user'],
                'password' => $password,
            ];
            $subject2 = 'Регистрация на сайте';
            $toEmail2 = $_POST['email_user'];
            Mail::to($toEmail2)->send(new SendRegister($subject2, $params));
        }

        $data = [
            'name_tour' => $_POST ['name_tour'],
            'date_tour' => $_POST['date_tour'],
            'time_tour' => $_POST['time_tour'],
            'name_user' => $_POST['name_user'],
            'summ' => $_POST['summ'],
        ];

        $subject = 'Бронирование тура';
        $toEmail = $_POST['email_user'];
        Mail::to($toEmail)->send(new SendTour($subject, $data));

        $subject2 = 'Бронирование нового тура';
        $toEmail2 = "0120912@mail.ru";
        Mail::to($toEmail2)->send(new SendTourAdmin($subject2, $data));

        $mess = "Ожидайте проверки администратором...";
        return redirect()->action('DankeController@view', ['mess' => $mess]);
    }
}
