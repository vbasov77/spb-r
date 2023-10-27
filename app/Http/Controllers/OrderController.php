<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
use App\Models\Booking;
use App\Services\ArchiveService;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\MailService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\VerificationController;

class OrderController extends Controller
{
    private $bookingService;

    private $orderService;

    private $dateService;

    private $mailService;


    public function __construct()
    {
        $this->bookingService = new BookingService();
        $this->orderService = new OrderService();
        $this->dateService = new DateService();
        $this->mailService = new MailService();
    }


    public function view()
    {
        $data = $this->bookingService->getBookingDates();
        $datesInOrder = $this->orderService->inOrder(); //Формируем даты по порядку
        $bookingDates = !empty($datesInOrder) ? $datesInOrder : null;

        return view('orders.orders')->with(['data' => $bookingDates, 'data2' => $data]);
    }


    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            $order = $this->bookingService->getBookingOrderId($request->id);

            return view('/orders.order_edit')->with(['order' => $order]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $this->orderService->updateOrder($request);
            return redirect()->action('OrderController@view');
        }


    }

    public function delete(int $id)
    {
        $result = $this->bookingService->findById($id);

        $date[] = $result->no_in;
        $date[] = $result->no_out;
        $condition = 2;

        $this->dateService->setCountNightObj($date, $result->total, $condition);
        $this->orderService->deleteOrder($id);
        return redirect()->action('OrderController@view');
    }

    public function deleteProf(int $id)
    {
        $booking = $this->bookingService->findById($id);
        if (!empty($booking)) {

            $date[] = $booking->no_in;
            $date[] = $booking->no_out;
            $condition = 2;

            $this->dateService->setCountNightObj($date, $booking->total, $condition);
            $data = $this->orderService->deleteOrder($id);
            $this->mailService->DeleteOrderUser($data);
        }

        return redirect()->action('ProfileController@view');
    }

    public function confirm(int $id)
    {
        $this->bookingService->confirmOrder($id);
        $result = $this->bookingService->getBookingOrderId($id);

        $data = [
            'user_name' => $result->user_name,
            'in' => $result->no_in,
            'out' => $result->no_out,
            'sum' => $result->total

        ];
        $subject = 'Подтверждение бронирования';
        $toEmail = preg_replace("/\s+/", "", $result->email);
        Mail::to($toEmail)->send(new ConfirmOrder($subject, $data));
        return redirect()->action('OrderController@view');
    }

    public function reject(int $id)
    {
        $archiveService = new ArchiveService();
        $res = Booking::where('id', $id)->get();
        $date[] = $res[0]->no_in;
        $date[] = $res[0]->no_out;
        $condition = 2;

        $this->dateService->setCountNightObj($date, $res[0]->total, $condition);

        $result = $this->bookingService->getBookingOrderId($id);

        $this->mailService->RejectOrder($result);

        $otz = "Отклонено администратором";
        $archiveService->save($result, $otz);

        $this->orderService->deleteOrder($id);

        return redirect()->action('OrderController@view');
    }

    public function toPayView(int $id)
    {
        return view('orders/order_pay', ['id' => $id]);
    }


    public function toPay(Request $request)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 16);
        $infoPay = 1 . ";" . $code . ";" . $request->total;
        $this->bookingService->updateInfoPay($request->id, $infoPay);
        return redirect()->action([VerificationController::class, 'verificationUserBook'], ['id' => $request->id]);
    }


}
