<?php

namespace App\Http\Controllers;



class ReportsController extends Controller
{
    public function view()
    {
        $date_b = DateController::getBookingDates();
        $count_night = GetController::getCountNight();
        $sum = GetController::getSum();
        return view('reports.reports_obj', ['sum'=> $sum, 'count_night'=> $count_night, 'date_book' => $date_b ['date_book']]);
    }



}
