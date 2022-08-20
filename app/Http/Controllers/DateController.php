<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DateController extends Controller
{

    public static function getDates($startTime, $endTime)
    {
        $day = 86400;
        $format = 'd.m.Y';
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
//        $numDays = round(($endTime - $startTime) / $day) + 1;
        $numDays = round(($endTime - $startTime) / $day); // без +1
        $days = [];
        for ($i = 1; $i < $numDays; $i++) {
            $days[] = date($format, ($startTime + ($i * $day)));
        }
        return $days;
    }

    public static function plusCost($sum_night)
    {
        if ($sum_night <= 1) {
            $c = 830;
        } elseif ($sum_night > 1 && $sum_night <= 14) {
            $c = 320;
        }  else ($c = 0);
        return $c;

    }

    public static function getBookingDates()
    {

        $result = DbController::GetBookingTable();
        if (!empty($result)) {
            // Переформатирование date_book
            $dis_s = [];
            $dis_a = [];
            for ($i = 0; $i < count($result); $i++) {
                $dis = explode(',', $result [$i]['date_book']);
                foreach ($dis as $item) {
                    $dis_s [] = date("Y-m-d", strtotime($item));
                }
                $dis_a[] = implode(',', $dis_s);
            }
            $date_book = implode(',', $dis_s);

            // Переформатирование no_in
            $dis_n = [];
            $dis_i = [];
            for ($ii = 0; $ii < count($result); $ii++) {
                $diss = explode(',', $result[$ii]['no_in']);
                foreach ($diss as $val) {
                    $dis_n [] = date("Y-m-d", strtotime($val));
                }
                $dis_i[] = implode(',', $dis_n);
            }
            $no_in = implode(',', $dis_n);

            // Переформатирование no_out;
            $dis_o = [];
            $dis_t = [];
            for ($li = 0; $li < count($result); $li++) {
                $disss = explode(',', $result [$li]['no_out']);

                foreach ($disss as $v) {
                    $dis_o[] = date("Y-m-d", strtotime($v));
                }
                $dis_t[] = implode(',', $dis_o);
            }
            $no_out = implode(',', $dis_o);
        } else {
            $date_book = "";
            $no_in = "";
            $no_out = "";
        }

        $data = [
            'date_book' => $date_book,
            'no_in' => $no_in,
            'no_out' => $no_out,

        ];

        return $data;
    }

    public static function inOrder(){

        $res = DbController::GetBookingNoInTable();
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $arr[] = strtotime($res [$i]['no_in']);
            }
            sort($arr);
            foreach ($arr as $item) {
                $ar = date('d.m.Y', $item);
                $arri [] = DbController::GetBookingNoIn($ar);
            }
        } else {
            $arri = "";
        }

        return $arri;
    }


}
