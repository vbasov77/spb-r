<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\View\View;

class VerificationController extends Controller
{

    /**
     * @param int $id
     * @param BookingService $bookingService
     * @return View
     */
    public function verificationUserBook(int $id, BookingService $bookingService): View
    {
        $res = $bookingService->getBookingOrderId($id);
        if (!empty($res)) {
            $userInfo = explode('&', $res->user_info);
            $info = explode(',', $res->more_book);
            $sumNight = count($info) - 1;
            return view('/verifications.book_user')->with([
                'res' => $res,
                'nights' => $sumNight,
                'userInfo' => $userInfo,
                'info' => $info
            ]);
        }
    }
}
