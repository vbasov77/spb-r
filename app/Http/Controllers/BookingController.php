<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Booking\AddDatesRequest;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\MailService;
use App\Services\UserPhoneService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{


    public function addBooking(Request $request,
                               BookingService $bookingService,
                               UserService $userService, MailService $mailService): RedirectResponse
    {

        //Проверка на занятость дат
        $checkBooking = $bookingService->checkingForEmployment($request->info_book, $request->input('phone'),
            $request->input('email'));
        if ($checkBooking == true) {
            $user = explode(",", preg_replace('/\s+?\'\s+?/', '\'', $request->more_book [0]));
            $userName = $user[0];
            $email = $request->email;

            $userId = $userService->getUserIdByEmail($email);

            // Если email нет в БД, то создаём учётную запись и уведомляем пользователя
            if ($userId == null) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $password = substr(str_shuffle($permitted_chars), 0, 16);
                $userId = $userService->addUser($userName, $email, $password, $request->phone); //Добавили юзера
                $mailService->SendRegister($userName, $email, $password);// Отправили юзеру письмо о регистрации
            }

            $userPhoneService = new UserPhoneService();
            $checkUserPhoneInTable = $userPhoneService->checkPhone($userId);
            if ($checkUserPhoneInTable == null) {
                $userPhoneService->savePhone($userId, $request->phone);
            }

            $request->user_id = $userId;

            //Добавляем бронирование в БД, возвращаем данные для mail
            $params = $bookingService->addBooking($request, $userName);

            // Отправляем сообщение
            $message = $mailService->NewBooking($params, $userName, $email);
            return redirect()->action('DankeController@view', ['mess' => $message]);
        } else {
            return redirect()->route('error.book');
        }
    }

    public function comeErrorBlade(): View
    {
        return view('errors.error_book');
    }

    public function orderInfo(Request $request): View    {
        $moreBook = [];
        $count = count($request->input("user_name"));

        for ($i = 0; $i < $count; $i++) {
            $moreBook[] = $request->input("user_name")[$i] . ", " . $request->input("age")[$i] . ", "
                . $request->input("district") [$i];
        }
        $infoBook = explode(',', $request->input('info_book'));

        return view('orders.verification_booking')->with(['infoBook' => $infoBook, 'more_book' => $moreBook,
            'sum' => $request->sum]);
    }


    public function addDates(AddDatesRequest $request, DateService $dateService): View
    {
        /**
         *  Метод формирует информацию для бронирования - количество ночей,
         *  цену по каждому дню.
         *
         */
        $dates = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
        $dates = explode("-", $dates);// разбили строку на массив
        $countNight = (int)$dateService->getCountNight($dates[0], $dates[1]);//Количество ночей
        $infoBook = (array)$dateService->getInfo($dates[0], $dates[1], $countNight);

        if ($infoBook != null) {
            return view('orders.order_info', ['data' => $_POST, 'infoBook' => $infoBook['dateView'],
                'sum' => $infoBook['total'], 'sum_night' => $countNight]);
        } else {
            return view("sorry.sorry");
        }


    }

}
