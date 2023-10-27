<?php


namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Request;


class FrontController extends Controller
{
    private $bookingService;


    public function __construct()
    {
        $this->bookingService = new BookingService();
    }


    public function front(Request $request)
    {
        $data = $this->bookingService->getBookingDates();
        $settings = new SettingsService();
        $frontSettings = $settings->findSettingsFrontPage();
        $dataSettings = explode("&", $frontSettings->settings);
        return view('front')->with(['data' => $data, 'dataSettings' => $dataSettings]);
    }
}