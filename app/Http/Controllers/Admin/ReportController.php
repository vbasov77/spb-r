<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\ReportService;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(ReportService $reportService, BookingService $bookingService): View
    {
        $dateBook = $bookingService->getBookingDates();
        $countNight = $reportService->getCountNight();
        $sum = $reportService->getSum();
        return view('reports.index', [
            'sum' => $sum,
            'count_night' => $countNight,
            'date_book' => $dateBook['date_book']
        ]);
    }
}
