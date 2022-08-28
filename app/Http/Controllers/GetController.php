<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetController extends Controller
{
    public static function getCountNight()
    {
        $count = DB::table('reports')->where('m&y', date('m.Y'))->get();
        if (empty(count($count))) {
            $count_night = 0;
        } else {
            $count_night = $count[0]->count_night;
        }
        return $count_night;
    }

    public static function getSum()
    {
        $result = DB::table('reports')->where('m&y', date('m.Y'))->get();
        if (empty(count($result))) {
            $sum = 0;
        } else {
            $sum = $result[0]->sum;
        }
        return $sum;
    }

    public static function countNight(string $start, string $end)
    {
        //Получение количества ночей диапазона 29.01.2022 - 03.02.2022
        $startTimeStamp = strtotime($start);
        $endTimeStamp = strtotime($end);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
        $count_night = intval($numberDays);
        return $count_night;
    }

    public static function getDatesArray(string $first, string $second)
    {
        //Получение дат диапазона 29.01.2022 - 03.02.2022
        $day = 86400;
        $start = strtotime($first . ' -1 days');
        $end = strtotime($second . ' +1 days');
        $nums = round(($end - $start) / $day);
        $days = [];
        for ($i = 1; $i < $nums; $i++) {
            $days[] = date('d.m.Y', ($start + ($i * $day)));
        }
        return $days;
    }
}
