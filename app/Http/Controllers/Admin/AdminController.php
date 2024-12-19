<?php


declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\NewsService;
use App\Services\SettingsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    private $newsService;

    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->newsService = new NewsService();
    }

    public function general()
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.panel');
        }
    }

    /**
     * @param BookingService $bookingService
     * @return Factory|RedirectResponse|View
     */
    public function front(BookingService $bookingService)
    {

        $data = $bookingService->getBookingDates();
        $settings = new SettingsService();
        $frontSettings = $settings->findSettingsFrontPage();
        $dataSettings = explode("&", $frontSettings->settings);
        $news = $this->newsService->findForFrontPage();

        return view('front')->with(['data' => $data, 'dataSettings' => $dataSettings, 'news' => $news]);
    }
}
