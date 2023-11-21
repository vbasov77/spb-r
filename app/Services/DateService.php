<?php


namespace App\Services;


use App\Http\Controllers\GetController;
use App\Models\Reports;

class DateService extends Service
{

    private $scheduleService;
    private $reportService;

    public function __construct()
    {
        $this->scheduleService = new  ScheduleService();
        $this->reportService = new ReportService();
    }


    public function getDates(string $startTime, string $endTime, int $firstDay): array
    {
        $day = 86400;
        $format = 'd.m.Y';
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
        $numDays = round(($endTime - $startTime) / $day) + 1;
//        $numDays = round(($endTime - $startTime) / $day); // без +1
        $days = [];
        for ($i = $firstDay; $i < $numDays; $i++) {
            $days[] = date($format, ($startTime + ($i * $day)));
        }
        return $days;
    }

    public function getStrDates(array $arrDate): string
    {
        $count = count($arrDate);
        $str = "";
        for ($i = 0; $i < $count; $i++) {
            if ($i + 1 != $count) {
                $str = $str . '"' . $arrDate[$i] . '",';
            } else {
                $str = $str . '"' . $arrDate[$i] . '"';
            }
        }
        return $str;
    }

    public function getCountNight(string $startTimeStamp, string $endTimeStamp): int
    {
        return date_diff(date_create($endTimeStamp), date_create($startTimeStamp))->format('%a%');

    }

    public function getDatesBook(string $booking): array
    {
        $booking = preg_replace("/\s+/", "", $booking);// удалили пробелы
        $dateBook = explode("-", $booking);// реобразовали в массив
        return $datesArray = [
            "startDate" => $dateBook[0],
            "endDate" => $dateBook[1]
        ];
    }

    public function getDateBookStr(object $schedules): string
    {
        if (!empty(count($schedules))) {
            foreach ($schedules as $schedule) {
                $date = date("Y-m-d", strtotime($schedule->date_book));
                $datesBook [] = $date;
            }
            return implode(",", $datesBook);
        } else
            return "";

    }

    public function getInfo(string $to, string $end, int $countNight)
    {
        $dateService = new DateService();
        $arrayDates = $dateService->getDates($to, $end, 1); // Получили даты из диапазона. Формат: 29.09.2023
        $scheduleService = new ScheduleService();

        $str = $scheduleService->getStrInDb($arrayDates); // Сформировали строку запроса в БД типа
        // where date_book = 29.09.2023 or date_book = 30.09.2023...

        $schedules = $scheduleService->findAllById($str); //Получили все существующие даты из БД по
        // сформированной строке.

        if (count($arrayDates) > count($schedules)) {
            return null;
        } else {
            $dateView = [];
            $total = 0;
            foreach ($schedules as $date) {
                $costDate = $date->cost;
                $dateView[] = $date->date_book . "/" . $costDate . " руб.";
                $total += $date->cost;

            }
            $dateView[] = "<b>Итого: " . $countNight . "ноч/ " . $total . " руб.</b>";
            $data = [
                "total" => $total,
                "dateView" => $dateView
            ];
            return $data;
        }
    }

    public function setCountNightObj(array $date, int $sum, $condition): void
    {
        $in = date("m.Y", strtotime($date[0]));
        $out = date("m.Y", strtotime($date[1]));

        if ($in === $out) {
            $month = $in;
            $countNight = self::getCountNight($date[0], $date[1]);
            $result = Reports::where('m&y', $month)->get();
            $data = [];
            if (!empty(count($result))) {
                $data[] = $result[0]->count_night;
                $data[] = $result[0]->sum;
            }
            self::setReportInTable($data, $countNight, $sum, $month, $condition);
        } else {
            $dateService = new DateService();
            // Если даты захватывают два месяца, то разбиваем диапазон дат на два массива по каждому месяцу,
            $endDatesFirstArray = date('t', strtotime($date[0])) . "." . date('m.Y', strtotime($date[0]));// Получаем последнюю дату месяца 31.02.2022
            $firstDatesArray = $dateService->getDates($date[0], $endDatesFirstArray, 0);// Получаем массив дат первого массива

            unset($firstDatesArray[0]);

            if (count($firstDatesArray)) {
                $firstStr = $this->scheduleService->getStrInDb(array_values($firstDatesArray)); // Получили стороку для БД
                $firstArray = $this->scheduleService->findByDatesBook($firstStr); // Получили

                //Получаем сумму по датам первого массива
                $totalFirstArray = [];
                foreach ($firstArray as $firstCost) {
                    $totalFirstArray[] = $firstCost->cost;
                }

                $totalFirst = array_sum($totalFirstArray);// Вся сумма первого массива
                $monthFirst = date('m.Y', strtotime($date[0]));

                $result = $this->reportService->findByMonth($monthFirst);
                $data = [];
                if (!empty(count($result))) {
                    $data[] = $result[0]->count_night;
                    $data[] = $result[0]->sum;
                }
                $dateService = new DateService();
                $countNightFirst = $dateService->getCountNight($date[0], $endDatesFirstArray);
                self::setReportInTable($data, $countNightFirst, $totalFirst, $monthFirst, $condition);

            }

            // Получаем сумму второго массива
            $firstDatesSecondArray = "01." . date('m.Y', strtotime($date[1]));// Получаем первую  дату месяца 01.02.2022
            $secondArray = $dateService->getDates($firstDatesSecondArray, $date[1], 0);// Получаем массив дат


            if (count($secondArray)) {

                $str = $this->scheduleService->getStrInDb($secondArray);

                $secondArray = $this->scheduleService->findByDatesBook($str);
                $totalSecondArray = [];
                foreach ($secondArray as $cost) {
                    $totalSecondArray[] = $cost->cost;
                }
                $totalSecond = array_sum($totalSecondArray);// Вся сумма второго массива
                $monthSecond = date('m.Y', strtotime($date[1]));
                $dateService = new DateService();

                $countNightSecond = $dateService->getCountNight($firstDatesSecondArray, $date[1]) + 1;
                $res = $this->reportService->findByMonth($monthSecond);

                $dataSecond = [];
                if (!empty(count($res))) {
                    $dataSecond[] = $res[0]->count_night;
                    $dataSecond[] = $res[0]->sum;
                }
                self::setReportInTable($dataSecond, $countNightSecond, $totalSecond, $monthSecond, $condition);
            }
        }
    }

    public static function setReportInTable(array $data,
                                            int $countNight, int $sum, string $month, $condition): void
    {
        //Массив $data должен состоять из двух элементов - количество ночей и суммы, если таковые имеются в BD.
        if (!empty(count($data))) {
            if ($condition == 1) {
                $night = $data[0] + $countNight;
                $new_sum = $data[1] + $sum;
            } elseif ($condition == 2) {
                $night = $data[0] - $countNight;
                $new_sum = $data[1] - $sum;
            }
            Reports::where('m&y', $month)->update(
                [
                    'count_night' => $night,
                    'sum' => $new_sum
                ]);
        } else {
            Reports::insert([
                'count_night' => $countNight,
                'sum' => $sum,
                'm&y' => $month
            ]);
        }

    }


}