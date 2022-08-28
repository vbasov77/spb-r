<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Mail\NewBooking;
use App\Mail\SendBooking;

use App\Mail\SendRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class CalendarController extends Controller
{
    public function view()
    {
        $url = url()->current();
        $data = DateController::getBookingDates();
        return view('front')->with(['data' => $data]);
    }


    public function addBooking()
    {
        //Проверка на занятость дат
        $check = explode(',', $_POST['date_view']);
        for ($i = 0; $i < count($check) - 1; $i++) {
            $it = explode('/', $check[$i]);
            $array_dates[] = $it[0];
        }
        $all_dates = DB::table('booking')->get('date_book');
        if (!empty(count($all_dates))) {
            foreach ($all_dates as $da) {
                $array_table[] = $da->date_book;
            }
            if (!empty(count($array_dates))) {
                foreach ($array_dates as $ar) {
                    foreach ($array_table as $table) {
                        $tab = explode(',', $table);
                        if (in_array($ar, $tab)) {
                            return redirect()->action('CalendarController@comeErrorBlade');
                        }
                    }
                }
            }
        }
        // Конец проверки
        $user = explode(",", preg_replace('/\s+?\'\s+?/', '\'', $_POST ['more_book'] [0]));
        $name_user = $user[0];
        $user_info = implode(';', $_POST['more_book']);
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
                'name' => $name_user,
                'email' => $_POST ['email_user'],
                'password' => Hash::make($password),
            ]);
            $params = [
                'name_user' => $name_user,
                'email_user' => $_POST ['email_user'],
                'password' => $password,
            ];
            $subject2 = 'Регистрация на сайте';
            $toEmail2 = $_POST['email_user'];
            Mail::to($toEmail2)->send(new SendRegister($subject2, $params));
        }

        $d = $_POST ['date_book'];
        $d = preg_replace("/\s+/", "", $d);// удалили пробелы
        $email = preg_replace("/\s+/", "", $_POST['email_user']);// удалили пробелы
        $dd = explode("-", $d);// преобразовали в массив
        $condition = 1;                                            // 1 - прибавить, 2 - вычесть
        DateController::setCountNightObj($dd, $_POST['sum'], $condition);
        $startTime = $dd[0];
        $endTime = $dd[1];
        $date_b = DateController::getDates($startTime, $endTime);
        $date_book = implode(',', $date_b);
        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code_book = substr(str_shuffle($code), 0, 16);
        DB::table('booking')->insert([
                'code_book' => $code_book,
                'name_user' => $name_user,
                'phone_user' => $_POST['phone_user'],
                'email_user' => $email,
                'nationality' => "",
                'date_book' => $date_book,
                'no_in' => $startTime,
                'no_out' => $endTime,
                'more_book' => $_POST['date_view'],
                'user_info' => $user_info,
                'summ' => $_POST ['sum'],
            ]
        );
        $new_book = DB::table('booking')->where('code_book', $code_book)->value('id');
        $data = [
            'in' => $startTime,
            'out' => $endTime,
            'name_user' => $name_user,
            'id' => $new_book,
            'url' => request()->root(),
        ];
        $subject = 'Бронирование дат';
        $toEmail = $email;
        Mail::to($toEmail)->send(new SendBooking($subject, $data));
        $sub3 = 'Новое бронирование';
        $email_admin = '0120912@mail.ru';
        Mail::to($email_admin)->send(new NewBooking($sub3, $data));
        $mess = "Предварительное бронирование прошло успешно. <br> Ожидайте подтверждения администратором. На вашу почту, которую вы указали - <b>$email</b>, было отправлено письмо. Проверьте, пожалуйста, почту...<br> Если письма нет в папке 
'Входящие', проверьте папку 'Спам'. <div style='color: red'>Важно!!!</div> Если письмо поступило в папку 'Спам' и для того, чтобы письма в дальнейшем приходили в папку 'Входящие', и Вы получали оповещения, отметьте в ящике, что данное письмо не является спамом.<br>
Статус данного бронирования, вы сможете проверить в своём <a href='/profile'> Личном кабинете.</a>";
        return redirect()->action('DankeController@view', ['mess' => $mess]);
    }

    public function comeErrorBlade()
    {
        return view('errors.error_book');
    }

    public function verification()
    {
        $more_b = [];
        for ($li = 0; $li < count($_POST['name_user']); $li++) {
            $more_b[] = $_POST ['name_user'] [$li] . ", " . $_POST ['age'] [$li] . ", " . $_POST ['nationality'] [$li];
        }
        $date_view = explode(',', $_POST['date_view']);
        return view('/verification_booking')->with(['date_view' => $date_view, 'more_book' => $more_b, 'sum' => $_POST['sum']]);
    }

    public function addInfo()
    {
        if (!empty($_POST ['date_book']) == "") {
            try {
                throw new InvalidArgumentException("Вы не выбрали даты!");
            } catch (InvalidArgumentException $e) {
                $data = DateController::getBookingDates();
                return view('front')->with(['data' => $data, 'error' => $e->getMessage()]);
            }
        } else {
            $d = DbController::GetScheduleTable();
            $date_u = preg_replace("/\s+/", "", $_POST['date_book']);// удалили пробелы
            $date_u = explode("-", $date_u);
            $arr_date = DateController::getDates($date_u[0], $date_u[1]);
            $sum_night = count($arr_date) + 1;
            $cost_arr = DateController::plusCost($sum_night);
            $dat = [];
            $dat[] = $date_u[0];
            $cost = [];
            foreach ($arr_date as $value) {
                $dat [] = $value;
            }
            $dat[] = $date_u[1];
            $date_view = [];
            foreach ($d as $item) {
                $str_arr = $item['date_book'];
                if (!empty(array_search($str_arr, $dat)) && $item ['stat'] != 1) { // проверка есть ли в массиве
                    $cumm_cost = $item['cost'] + $cost_arr;
                    $date_view[] = $item ['date_book'] . "/" . $cumm_cost . " руб.";
                    $cost[] = $item['cost'] + $cost_arr;
                }
            }
            $sum = array_sum($cost);
            $data = $_POST;
            $date_view[] = "<b>Итого: " . $sum_night . "ноч/ " . $sum . " руб.</b>";
            return view('orders/order_info', ['data' => $data, 'date_view' => $date_view, 'sum' => $sum, 'sum_night' => $sum_night]);

        }

    }

}
