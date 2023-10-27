<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\ReportService;

class ReportsController extends Controller
{
    public function view(ReportService $reportService, BookingService $bookingService)
    {
        $dateBook = $bookingService->getBookingDates();
        $countNight = $reportService->getCountNight();
        $sum = $reportService->getSum();
        return view('reports.reports_obj', [
            'sum' => $sum,
            'count_night' => $countNight,
            'date_book' => $dateBook['date_book']
        ]);
    }


}
