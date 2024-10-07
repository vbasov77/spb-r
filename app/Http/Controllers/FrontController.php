<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\NewsService;
use App\Services\SettingsService;
use Illuminate\View\View;


class FrontController extends Controller
{
    private $newsService;

    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->newsService = new NewsService();
    }

    public function front(BookingService $bookingService): View
    {
        $data = $bookingService->getBookingDates();
        $settings = new SettingsService();
        $frontSettings = $settings->findSettingsFrontPage();
        $dataSettings = explode("&", $frontSettings->settings);
        $news = $this->newsService->findForFrontPage();

        return view('front')->with(['data' => $data, 'dataSettings' => $dataSettings, 'news' => $news]);
    }


}