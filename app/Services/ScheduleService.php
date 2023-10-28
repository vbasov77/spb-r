<?php


namespace App\Services;


use App\Repositories\ScheduleRepository;
use Illuminate\Http\Request;

class ScheduleService extends Service

{
    private $scheduleRepository;

    public function __construct()
    {
        $this->scheduleRepository = new ScheduleRepository();
    }


    public function findByDatesBook(string $str): array
    {
        return $this->scheduleRepository->findByDatesBook($str);
    }

    public function updateScheduleCost(string $str): void
    {
        $this->scheduleRepository->updateCost($str);
    }


    public function update(array $dates, int $cost): void
    {
        $this->scheduleRepository->update($dates, $cost);
    }

    public function getScheduleStr(): string
    {
        $schedules = $this->scheduleRepository->findAll();

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

    public function getArrayInsertSchedule(array $bookingDatesArray, int $cost): array
    {
        $array = [];
        $count = count($bookingDatesArray);
        for ($i = 0; $i < $count; $i++) {
            $array[] = ["date_book" => $bookingDatesArray[$i], "cost" => $cost];
        }
        return $array;
    }

    public function getStrUpdateSchedules(Request $request): string
    {
        $str = "";
        $count = count($request->cost);
        for ($i = 0; $i < $count; $i++) {
            $str .= "WHEN id = " . $request->id[$i] . " THEN " . $request->cost[$i] . " ";
        }
        return $str;

    }

    public function createSchedule(array $datesBook): void
    {
        $this->scheduleRepository->createSchedule($datesBook);
    }

    public function findAll(): object
    {
        return $this->scheduleRepository->findAll();
    }

    public function updateSchedule(Request $request): array
    {
        $datesService = new DateService();
        $scheduleService = new ScheduleService();

        $q = preg_replace("/\s+/", "", $request->date_book);// Удалили пробелы
        $dates = explode('-', $q); // Создали массив дат

        $arrayDates = $datesService->getDates($dates[0], $dates[1], 0);
        $datesStr = $scheduleService->getStrInDb($arrayDates);

        return $this->scheduleRepository->findByDatesBook($datesStr);
    }

    public function findAllById(string $str)
    {
        return $this->scheduleRepository->findAllById($str);
    }


    public function getStrInDb(array $dates): string
    {
        /**
         *
         * Получение строки для запроса в БД
         * Вид :
         */

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


    public function delSchedule(): int
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