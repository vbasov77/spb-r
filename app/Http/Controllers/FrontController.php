<?php


namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Request;


class FrontController extends Controller
{

    public function front(Request $request)
    {
        $service = new BookingService();
        $data = $service->getBookingDates();
        $settings = new SettingsService();
        $frontSettings = $settings->findSettingsFrontPage();
        $dataSettings = explode("&", $frontSettings->settings);
        return view('front')->with(['data' => $data, 'dataSettings' => $dataSettings]);
    }
}