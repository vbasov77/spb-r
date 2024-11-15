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
    private $bookingService;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->bookingService = new BookingService();
    }

    /**
     * @param OrderService $orderService
     * @param Request $request
     * @return View
     */
    public function ordersList(OrderService $orderService, Request $request): View
    {
        $data = $this->bookingService->getBookingDates();

        $datesInOrder = $orderService->inOrder(); //Формируем даты по порядку
        $bookingDates = !empty($datesInOrder) ? $datesInOrder : null;
        $error = !empty($request->error) ? $request->error : null;

        return view('orders.orders_list')->with(['data' => $bookingDates, 'data2' => $data, 'error' => $error]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function viewEdit(Request $request): View
    {
        $order = $this->bookingService->getBookingByOrderId((int)$request->id)[0];
        return view('/orders.order_edit')->with(['order' => $order]);
    }

    /**
     * @param OrderService $orderService
     * @param EditOrderRequest $editOrderRequest
     * @return RedirectResponse
     */
    public function edit(OrderService $orderService, EditOrderRequest $editOrderRequest): RedirectResponse
    {
        $orderService->updateOrder($editOrderRequest);
        return redirect()->action([OrderController::class, 'ordersList']);
    }


    /**
     * @param Request $request
     * @param OrderService $orderService
     * @return RedirectResponse
     */
    public function delete(Request $request,
                           OrderService $orderService): RedirectResponse
    {
        $id = (int)$request->id;
        $result = $this->bookingService->findById($id);
        $orderService->deleteOrder($result);

        if (!empty(Auth::user()->isAdmin())) {
            return redirect()->action([ProfileController::class, 'index']);
        }

        return redirect()->action([OrderController::class, "ordersList"]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function confirm(int $id): RedirectResponse
    {
        $result = $this->bookingService->getBookingByOrderId((int)$id);

        $check = $this->bookingService->checkingForEmploymentAll($result[0]->no_in, $result[0]->no_out, 0);
        if ($check) {
            $this->bookingService->confirmOrder($id);

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

    /**
     * @param int $id
     * @param ArchiveService $archiveService
     * @param MailService $mailService
     * @return RedirectResponse
     */
    public function reject(int $id, ArchiveService $archiveService,
                           MailService $mailService): RedirectResponse
    {
        $order = $this->bookingService->getBookingByOrderId($id)[0];
        $order->total = 0;
        $date[] = $order->no_in;
        $date[] = $order->no_out;
        $mailService->RejectOrder($order);
        $comment = "Отклонено администратором";
        $archive = $archiveService->getArrayForArchive($order, $comment);
        $archiveService->save($archive);
        $this->bookingService->delete($id);


        return redirect()->action([OrderController::class, "ordersList"]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function toPayView(int $id): View
    {
        return view('orders.order_pay', ['id' => $id]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function toPay(Request $request): RedirectResponse
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 16);
        $infoPay = 1 . ";" . $code . ";" . $request->total;
        $this->bookingService->updateInfoPay((int)$request->id, $infoPay);

        return redirect()->action([VerificationController::class, 'verificationUserBook'], ['id' => (int)$request->id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function editDates(Request $request)
    {
        $data = $this->bookingService->findDatesById((int)$request->id);

        return view('orders.edit_dates', ['data' => $data[0]]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateDates(Request $request): RedirectResponse
    {
        $this->bookingService->updateDates($request);

        return redirect()->route('admin.order.edit.view', ['id' => $request->id]);
    }
}
