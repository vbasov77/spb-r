<?php

namespace App\Http\Controllers;


use App\Mail\ConfirmOrder;
use App\Models\Booking;
use App\Services\ArchiveService;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\MailService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(BookingService $bookingService, OrderService $orderService): View
    {
        $data = $bookingService->getBookingDates();
        $datesInOrder = $orderService->inOrder(); //Формируем даты по порядку
        $bookingDates = !empty($datesInOrder) ? $datesInOrder : null;

        return view('orders.index')->with(['data' => $bookingDates, 'data2' => $data]);
    }


    public function edit(Request $request,
                         BookingService $bookingService, OrderService $orderService)
    {
        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            $order = $bookingService->getBookingOrderId($request->id);

            return view('/orders.order_edit')->with(['order' => $order]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $orderService->updateOrder($request);
            return redirect()->action('OrderController@index');
        }


    }

    public function delete(int $id,
                           BookingService $bookingService,
                           DateService $dateService,
                           OrderService $orderService): RedirectResponse
    {
        $result = $bookingService->findById($id);

        $date[] = $result->no_in;
        $date[] = $result->no_out;
        $condition = 2;

        $dateService->setCountNightObj($date, $result->total, $condition);
        $orderService->deleteOrder($id);
        return redirect()->action('OrderController@index');
    }

    public function deleteProf(int $id,
                               BookingService $bookingService,
                               DateService $dateService,
                               OrderService $orderService, MailService $mailService): RedirectResponse
    {
        $booking = $bookingService->findById($id);
        if (!empty($booking)) {

            $date[] = $booking->no_in;
            $date[] = $booking->no_out;
            $condition = 2;

            $dateService->setCountNightObj($date, $booking->total, $condition);
            $data = $orderService->deleteOrder($id);
            $mailService->DeleteOrderUser($data);
        }

        return redirect()->action('ProfileController@view');
    }

    public function confirm(int $id, BookingService $bookingService): RedirectResponse
    {
        $bookingService->confirmOrder($id);
        $result = $bookingService->getBookingOrderId($id);

        $data = [
            'user_name' => $result->user_name,
            'in' => $result->no_in,
            'out' => $result->no_out,
            'sum' => $result->total

        ];
        $subject = 'Подтверждение бронирования';
        $toEmail = preg_replace("/\s+/", "", $result->email);
        Mail::to($toEmail)->send(new ConfirmOrder($subject, $data));
        return redirect()->action('OrderController@index');
    }

    public function reject(int $id, ArchiveService $archiveService,
                           BookingService $bookingService,
                           DateService $dateService,
                           MailService $mailService, OrderService $orderService): RedirectResponse
    {
        $res = Booking::where('id', $id)->get();
        $date[] = $res[0]->no_in;
        $date[] = $res[0]->no_out;
        $condition = 2;

        $dateService->setCountNightObj($date, $res[0]->total, $condition);

        $result = $bookingService->getBookingOrderId($id);

        $mailService->RejectOrder($result);

        $otz = "Отклонено администратором";
        $archiveService->save($result, $otz);

        $orderService->deleteOrder($id);

        return redirect()->action('OrderController@index');
    }

    public function toPayView(int $id): View
    {
        return view('orders/order_pay', ['id' => $id]);
    }


    public function toPay(Request $request, BookingService $bookingService): RedirectResponse
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 16);
        $infoPay = 1 . ";" . $code . ";" . $request->total;
        $bookingService->updateInfoPay($request->id, $infoPay);
        return redirect()->action([VerificationController::class, 'verificationUserBook'], ['id' => $request->id]);
    }


}
