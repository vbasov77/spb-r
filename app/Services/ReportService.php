<?php


namespace App\Services;


use App\Repositories\ArchiveRepository;
use App\Repositories\KeyRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class ReportService extends Service
{

    private $reportRepository;
    private $archiveRepository;
    private $keyRepository;


    public function __construct()
    {
        $this->reportRepository = new ReportRepository();
        $this->archiveRepository = new ArchiveRepository();
        $this->keyRepository = new KeyRepository();
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

    /**
     * @param object $reports
     * @return string
     */
    public function getSumStr(object $reports)
    {
        $dates = $this->getMonthNumbers();
        $count = count($reports);
        $arraySum = [];
        for ($l = 0; $l < 12; $l++) {
            $arraySum[$l] = 0;
            for ($i = 0; $i < $count; $i++) {
                if ($dates[$l] === $reports[$i]->v_period) {
                    $arraySum[$l] = (int)$reports[$i]->sum;
                    break;
                }
            }
        }

        return implode(',', $arraySum);
    }

    /**
     * @param object $reports
     * @return string
     */
    public function getExpensesStr(object $reports)
    {
        $dates = $this->getMonthNumbers();
        $count = count($reports);
        $arraySum = [];
        for ($l = 0; $l < 12; $l++) {
            $arraySum[$l] = 0;
            for ($i = 0; $i < $count; $i++) {
                if ($dates[$l] === $reports[$i]->v_period) {
                    $arraySum[$l] = (int)$reports[$i]->expenses;
                    break;
                }
            }
        }

        return implode(',', $arraySum);
    }

    /**
     * @param string $strFirst
     * @param string $strSecond
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @param object $reports
     * @return string
     */
    public function getCountNight(object $reports)
    {
        $dates = $this->getMonthNumbers();
        $count = count($reports);
        $countNight = [];
        for ($l = 0; $l < 12; $l++) {
            $countNight[$l] = 0;
            for ($i = 0; $i < $count; $i++) {
                if ($dates[$l] === $reports[$i]->v_period) {
                    $countNight[$l] = (int)$reports[$i]->count_night;
                    break;
                }
            }
        }

        return implode(',', $countNight);
    }

    /**
     * @return array
     */
    public function getMonthNames()
    {
        $monthToDay = date('Y-m-d');

        $months = [1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $count = 12;
        $arrayMonth = [];
        for ($i = 0; $i < $count; $i++) {
            $nextMonthTs = strtotime("$monthToDay - $i month");
            $arrayMonth[] = $months[date('n', $nextMonthTs)];
        }
        return array_reverse($arrayMonth);
    }

    /**
     * @return array
     */
    public function getMonthNumbers()
    {
        $monthToDay = date('Y-m-d');
        $count = 12;
        $arrayMonth = [];
        for ($i = 0; $i < $count; $i++) {
            $nextMonthTs = strtotime("$monthToDay - $i month");
            $arrayMonth[] = date('m.Y', $nextMonthTs);
        }
        return array_reverse($arrayMonth);
    }

    /**
     * @return string
     */
    public function getPasswordReportsIndex(): string
    {
        return $this->keyRepository->checkReportsIndex();
    }

}