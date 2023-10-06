<?php


namespace App\Services;


use App\Models\Schedule;
use App\Repositories\ScheduleRepository;
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

    public function getStrInsertSchedule(array $bookingDatesArray, int $cost)
    {
        $str = "";
        $count = count($bookingDatesArray);
        for ($i = 0; $i < $count; $i++) {
            $i != $count-1 ? $str .= "('$bookingDatesArray[$i]', $cost), "
                : $str .= "('$bookingDatesArray[$i]', $cost)";
        }
        return $str;
    }

    public function createSchedule(string $datesBook)
    {
        $scheduleRepo = new ScheduleRepository();
        $scheduleRepo->createSchedule($datesBook);
    }

    public function findAll()
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findAll();
    }

    public function findAllById(string $str)
    {
        $scheduleRepo = new ScheduleRepository();
        return $scheduleRepo->findAllById($str);
    }

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


    // Задание. Поработать над методом, чтобы удалялось за один запрос....
    public function delSchedule()
    {
        $date = date('d.m.Y');
        $schedules = Schedule::all();
        $count = 0;
        foreach ($schedules as $schedule) {
            if (strtotime($schedule->date_book) < strtotime($date)) {
                Schedule::where('id', $schedule->id)->delete();
                $count += 1;
            }
        }
        return view('messages.del_schedule', ['count' => $count]);
    }


}