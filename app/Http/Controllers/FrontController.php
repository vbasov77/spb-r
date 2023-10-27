<?php


namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\SettingsService;


class FrontController extends Controller
{

    public function front(BookingService $bookingService)
    {
        $data = $bookingService->getBookingDates();
        $settings = new SettingsService();
        $frontSettings = $settings->findSettingsFrontPage();
        $dataSettings = explode("&", $frontSettings->settings);
        return view('front')->with(['data' => $data, 'dataSettings' => $dataSettings]);
    }
}