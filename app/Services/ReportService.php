<?php


namespace App\Services;


use App\Repositories\ArchiveRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class ReportService extends Service
{

    private $reportRepository;
    private $archiveRepository;


    public function __construct()
    {
        $this->reportRepository = new ReportRepository();
        $this->archiveRepository = new ArchiveRepository();
    }

    /**
     * @param string $month
     * @return object
     */
    public function findByMonth(string $month): object
    {
        return $this->reportRepository->findByMonth($month);
    }

    /**
     * @return int
     */
    public function getSum(): int
    {
        $result = $this->reportRepository->getTotal();

        return !empty(count($result)) ? $result[0]->sum : 0;
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return $this->reportRepository->findAll();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->reportRepository->findById($id);
    }

    /**
     * @param Request $request
     */
    public function editExpenses(Request $request): void
    {
        $data = [
            'expenses' => $request->input('expenses'),
            'info_expenses' => $request->input('info_expenses')
        ];

        $this->reportRepository->editExpenses($request->input('id'), $data);
    }


    public function getSumStr(object $reports)
    {
        $yar = date('Y');
        $count = count($reports);
        $arrayReports = [];

        for ($i = 0; $i < $count; $i++) {
            $period = explode('.', $reports[$i]->v_period);
            if ($period[1] === $yar) {
                $arrayReports[] = [
                    'month' => (int)$period[0],
                    'year' => (int)$period[1],
                    'sum' => (int)$reports[$i]->sum,
                    'count_night' => (int)$reports[$i]->count_night
                ];
            }
        }

        return $this->sumStr($arrayReports);
    }

    public function getExpensesStr(object $reports)
    {
        $yar = date('Y');
        $count = count($reports);
        $arrayReports = [];

        for ($i = 0; $i < $count; $i++) {
            $period = explode('.', $reports[$i]->v_period);
            if ($period[1] === $yar) {
                $arrayReports[] = [
                    'month' => (int)$period[0],
                    'year' => (int)$period[1],
                    'sum' => (int)$reports[$i]->expenses,
                ];
            }
        }
        return $this->sumStr($arrayReports);
    }

    public function sumStr(array $arrayReports)
    {
        $sum = [];
        $countMonth = 0;
        for ($l = 0; $l < 12; $l++) {
            $countMonth++;
            $sum[$l] = 0;
            foreach ($arrayReports as $value) {
                if ($value['month'] === $countMonth) {
                    $sum[$l] = $value['sum'];
                    break;
                }
            }
        }

        return implode(',', $sum);
    }

    public function getTotalSumStr(string $strFirst, string $strSecond)
    {
        $arrayFirst = explode(',', $strFirst);
        $arraySecond = explode(',', $strSecond);
        $newArray = [];
        $count = count($arrayFirst);

        for ($i = 0; $i < $count; $i++) {
            $newArray[] = $arrayFirst[$i] - $arraySecond[$i];
        }

        return implode(',', $newArray);
    }

    public function getCountWeekday()
    {
        $arrayDates = $this->archiveRepository->getDatesIn();
        $arrayDays = [];
        foreach ($arrayDates as $date) {
            $time = strtotime($date);
            $arrayDays[] = date('w', $time);
        }

        $arr = [];
        $count = 0;
        while ($count < 7) {
            $counter = 0;
            foreach ($arrayDays as $value) {
                if ($value == $count) {
                    $counter++;
                }
            }
            $arr[] = $counter;
            $count++;
        }
        $arr[] = $arr[0];
        array_shift($arr);

        return implode(',', $arr);

    }

    public function getCountNight(object $reports)
    {
        $yar = date('Y');
        $count = count($reports);
        $arrayReports = [];

        for ($i = 0; $i < $count; $i++) {
            $period = explode('.', $reports[$i]->v_period);
            if ($period[1] === $yar) {
                $arrayReports[] = [
                    'month' => (int)$period[0],
                    'year' => (int)$period[1],
                    'count_night' => (int)$reports[$i]->count_night,
                ];
            }
        }

        $countNight = [];
        $countMonth = 0;
        for ($l = 0; $l < 12; $l++) {
            $countMonth++;
            $countNight[$l] = 0;
            foreach ($arrayReports as $value) {
                if ($value['month'] === $countMonth) {
                    $countNight[$l] = $value['count_night'];
                    break;
                }
            }
        }

        return implode(',', $countNight);
    }

}