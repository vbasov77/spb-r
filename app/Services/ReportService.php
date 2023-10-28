<?php


namespace App\Services;


use App\Repositories\ReportRepository;

class ReportService extends Service
{

    private $reportRepository;


    public function __construct()
    {
        $this->reportRepository = new ReportRepository();
    }


    public function findByMonth(string $month): object
    {
        return $this->reportRepository->findByMonth($month);
    }


    public function getSum(): int
    {
        $result = $this->reportRepository->getTotal();

        if (empty(count($result))) {
            $sum = 0;
        } else {
            $sum = $result[0]->sum;
        }
        return $sum;
    }

    public function getCountNight(): int
    {
        $count = $this->reportRepository->getTotal();
        if (empty(count($count))) {
            $countNight = 0;
        } else {
            $countNight = $count[0]->count_night;
        }
        return $countNight;
    }
}