<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    public function view()
    {
        return view('/');
    }

    public function verificationUserBook($id)
    {
        $bookingService = new BookingService();
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
