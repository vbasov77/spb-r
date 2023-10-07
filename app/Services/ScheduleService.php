<?php


namespace App\Services;


use App\Repositories\ScheduleRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Serializer;

class ScheduleService extends Serializer

{
    public static function GetScheduleTable()
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findAll();
    }

    public function findByDatesBook(string $str)
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findByDatesBook($str);
    }

    public function updateScheduleCost(string $str)
    {
        $scheduleRepo = new ScheduleRepository();
        $scheduleRepo->updateCost($str);
    }


    public function update(array $dates, int $cost)
    {
        $scheduleRepo = new ScheduleRepository();
        $scheduleRepo->update($dates, $cost);

    }

    public function getScheduleStr()
    {
        $scheduleRepo = new ScheduleRepository();
        $schedules = $scheduleRepo->findAll();

        if (!empty(count($schedules))) {
            $dateBook = [];
            foreach ($schedules as $schedule) {
                $dateBook[] = date("Y-m-d", strtotime($schedule->date_book));
            }

            $dateBook = implode(',', $dateBook);
        } else {
            $dateBook = "";
        }
        return $dateBook;
    }
    
    public function getArrayInsertSchedule(array $bookingDatesArray, int $cost)
    {
        $array = [];
        $count = count($bookingDatesArray);
        for ($i = 0; $i < $count; $i++) {
            $array[] = ["date_book" => $bookingDatesArray[$i], "cost"=>$cost];
        }
        return $array;
    }
    public function getStrUpdateSchedules(Request $request)
    {
        $str = "";
        $count = count($request->cost);
        for ($i = 0; $i < $count; $i++) {
            $str .= "WHEN id = " . $request->id[$i] . " THEN " . $request->cost[$i] . " ";
        }
        return $str;

    }

    public function createSchedule(array $datesBook)
    {
        $scheduleRepo = new ScheduleRepository();
        $scheduleRepo->createSchedule($datesBook);
    }

    public function findAll()
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findAll();
    }

    public function updateSchedule(Request $request)
    {
        $datesService = new DateService();
        $scheduleService = new ScheduleService();
        $scheduleRepo = new ScheduleRepository();

        $q = preg_replace("/\s+/", "", $request->date_book);// Удалили пробелы
        $dates = explode('-', $q); // Создали массив дат

        $arrayDates = $datesService->getDates($dates[0], $dates[1], 0);
        $datesStr = $scheduleService->getStrInDb($arrayDates);

        return $scheduleRepo->findByDatesBook($datesStr);


    }

    public function findAllById(string $str)
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findAllById($str);
    }


    /**
     *
     * Получение строки для запроса в БД
     * Вид :
     */
    public function getStrInDb(array $dates)
    {
        $str = "date_book = '$dates[0]'";
        $counter = 1;
        for ($i = 1; $i < count($dates); $i++) {
            if ($counter == count($dates)) {
                $str .= " or date_book = '$dates[$i]'";
            } else {
                $str .= " or date_book = '$dates[$i]'";
                $counter += 1;
            }
        }

        return $str;
    }


    public function delSchedule()
    {
        $scheduleRepo = new ScheduleRepository();

        $date = date('d.m.Y');
        $schedules = $scheduleRepo->findAll();
        $count = 0;
        $str = "";

        foreach ($schedules as $schedule) {
            if (strtotime($schedule->date_book) < strtotime($date)) {
                if ($count == 0) {
                    $str .= "id = $schedule->id ";
                    $count += 1;
                } else {
                    $str .= " or id = $schedule->id ";
                    $count += 1;
                }
            }
        }

        $count > 0 ? $scheduleRepo->deleteByIds($str) : false;

        return $count;

    }


}