<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\Orders\EditOrderRequest;
use App\Mail\ConfirmOrder;
use App\Services\ArchiveService;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\MailService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @param BookingService $bookingService
     * @param OrderService $orderService
     * @param Request $request
     * @return View
     */
    public function ordersList(BookingService $bookingService, OrderService $orderService, Request $request): View
    {
        $data = $bookingService->getBookingDates();
        $datesInOrder = $orderService->inOrder(); //Формируем даты по порядку
        $bookingDates = !empty($datesInOrder) ? $datesInOrder : null;
        $error = !empty($request->error) ? $request->error : null;

        return view('orders.orders_list')->with(['data' => $bookingDates, 'data2' => $data, 'error' => $error]);
    }

    /**
     * @param Request $request
     * @param BookingService $bookingService
     * @return View
     */
    public function viewEdit(Request $request, BookingService $bookingService): View
    {
        $order = $bookingService->getBookingByOrderId((int)$request->id)[0];
        return view('/orders.order_edit')->with(['order' => $order]);
    }


    public function edit(OrderService $orderService, EditOrderRequest $editOrderRequest): RedirectResponse
    {
        $orderService->updateOrder($editOrderRequest);
        return redirect()->action([OrderController::class, 'ordersList']);
    }


    public function delete(Request $request,
                           BookingService $bookingService,
                           DateService $dateService,
                           OrderService $orderService): RedirectResponse
    {
        $id = (int)$request->id;
        $result = $bookingService->findById($id);
        $date[] = $result->no_in;
        $date[] = $result->no_out;
        $condition = 2;

        $dateService->setCountNightObj($date, (int)$result->total, $condition);

        $orderService->deleteOrder($id);
        if (Auth::user()->admin == 0) {
            return redirect()->action([ProfileController::class, 'index']);
        }

        return redirect()->action([OrderController::class, "ordersList"]);
    }

    public function deleteProf(Request $request,
                               BookingService $bookingService,
                               DateService $dateService,
                               OrderService $orderService, MailService $mailService)
    {
        $id = $request->id;

        $booking = $bookingService->findById($id);

        if (!empty($booking)) {

            $date[] = $booking->no_in;
            $date[] = $booking->no_out;
            $condition = 2;

            $dateService->setCountNightObj($date, $booking->total, $condition);
            $data = $orderService->deleteOrder($id);
            $mailService->DeleteOrderUser($data);
        }

        return redirect()->action([ProfileController::class, 'index']);
    }

    public function confirm(int $id, BookingService $bookingService): RedirectResponse
    {
        $result = $bookingService->getBookingByOrderId((int)$id);

        $check = $bookingService->checkingForEmploymentAll($result[0]->no_in, $result[0]->no_out, 0);
        if ($check) {
            $bookingService->confirmOrder($id);

            $data = [
                'user_name' => $result[0]->name,
                'in' => $result[0]->no_in,
                'out' => $result[0]->no_out,
                'sum' => $result[0]->total

            ];
            $subject = 'Подтверждение бронирования';
            $toEmail = preg_replace("/\s+/", "", $result[0]->email);
            Mail::to($toEmail)->send(new ConfirmOrder($subject, $data));

            return redirect()->action([OrderController::class, 'ordersList']);
        }

        $message = "Имеются занятые даты";
        return redirect()->action([OrderController::class, 'ordersList'], ['error' => $message]);
    }

    public function reject(int $id, ArchiveService $archiveService,
                           BookingService $bookingService,
                           DateService $dateService,
                           MailService $mailService, OrderService $orderService): RedirectResponse
    {
        $order = $bookingService->getBookingByOrderId($id)[0];

        $date[] = $order->no_in;
        $date[] = $order->no_out;

        $condition = 2;

        $dateService->setCountNightObj($date, $order->total, $condition);

        $mailService->RejectOrder($order);

        $comment = "Отклонено администратором";
        $archive = $archiveService->getArrayForArchive($order, $comment);
        $archiveService->save($archive);
        $bookingService->delete($id);


        return redirect()->action([OrderController::class, "ordersList"]);
    }

    public function toPayView(int $id): View
    {
        return view('orders.order_pay', ['id' => $id]);
    }


    public function toPay(Request $request, BookingService $bookingService): RedirectResponse
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 16);
        $infoPay = 1 . ";" . $code . ";" . $request->total;
        $bookingService->updateInfoPay((int)$request->id, $infoPay);
        return redirect()->action([VerificationController::class, 'verificationUserBook'], ['id' => (int)$request->id]);
    }
}
