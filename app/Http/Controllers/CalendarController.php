<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\MailService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{


    public function addBooking(Request $request)
    {
        $bookingService = new BookingService();
        $userService = new UserService();
        $mailService = new MailService();

        //Проверка на занятость дат
        $checkBooking = $bookingService->checkingForEmployment($request->date_view);

        if ($checkBooking == true) {
            $user = explode(",", preg_replace('/\s+?\'\s+?/', '\'', $request->more_book [0]));

            $userName = $user[0];
            $email = $request->email;

            // Проверка есть ли email в БД
            $checkEmail = $userService->checkEmail($email);

            // Если email нет в БД, то создаём учётную запись и уведомляем пользователя
            if ($checkEmail == false) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $password = substr(str_shuffle($permitted_chars), 0, 16);

                $userService->addUser($userName, $email, $password); //Добавили юзера

                $mailService->SendRegister($userName, $email, $password);// Отправили юзеру письмо о регистрации

            }
            //Добавляем бронирование в БД, возвращаем данные для mail
            $params = $bookingService->addBooking($request, $userName);

            // Отправляем сообщение
            $message = $mailService->NewBooking($params, $userName, $email);

            return redirect()->action('DankeController@view', ['mess' => $message]);
        } else {
            return redirect()->action('CalendarController@comeErrorBlade');
        }
    }

    public function comeErrorBlade()
    {
        return view('errors.error_book');
    }

    public function verification(Request $request)
    {
        $moreBook = [];
        for ($i = 0; $i < count($request->user_name); $i++) {
            $moreBook[] = $request->user_name[$i] . ", " . $request->age[$i] . ", " . $request->nationality [$i];
        }
        $date_view = explode(',', $request->date_view);
        return view('orders.verification_booking')->with(['date_view' => $date_view, 'more_book' => $moreBook,
            'sum' => $request->sum]);
    }


    /**
     *  Метод формирует информацию для бронирования - количество ночей,
     *  цену по каждому дню.
     *
     */

    public function addInfo(Request $request)
    {
        if (empty($request->date_book)) {
            try {
                throw new InvalidArgumentException("Вы не выбрали даты!");
            } catch (InvalidArgumentException $e) {
                return redirect()->action('FrontController@front', ['error' => $e->getMessage()]);
            }
        }

        $dates = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
        $dates = explode("-", $dates);// разбили строку на массив

        $dateService = new DateService();
        $countNight = (integer)$dateService->getCountNight($dates[0], $dates[1]);//Количество ночей

        $infoBook = (array)$dateService->getInfo($dates[0], $dates[1], $countNight);
        if ($infoBook != null) {
            return view('orders.order_info', ['data' => $_POST, 'date_view' => $infoBook['dateView'],
                'sum' => $infoBook['total'], 'sum_night' => $countNight]);
        } else {
            return view("sorry.sorry");
        }


    }

}
