<?php


namespace App\Services;


use App\Repositories\ReportRepository;

class ReportService extends Service
{
    public function findByMonth(string $month)
    {
        $reportRepo = new  ReportRepository();
        return $reportRepo->findByMonth($month);
    }

    public static function getTotal()
    {
        $reportRepo = new  ReportRepository();
        return $reportRepo->getTotal();
    }

    public function getSum()
    {
        $reportRepo = new  ReportRepository();
        $result = $reportRepo->getTotal();

        if (empty(count($result))) {
            $sum = 0;
        } else {
            $sum = $result[0]->sum;
        }
        return $sum;
    }

    public function getCountNight()
    {
        $reportRepo = new  ReportRepository();
        $count = $reportRepo->getTotal();
        if (empty(count($count))) {
            $countNight = 0;
        } else {
            $countNight = $count[0]->count_night;
        }
        return $countNight;
    }
}