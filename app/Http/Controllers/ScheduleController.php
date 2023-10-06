<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\DateService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function view()
    {
        $scheduleService = new ScheduleService();

        $dateService = new DateService();        //Получим всё расписание
        $schedules = $scheduleService->findAll();

        // Получим строку дат для передачи в JS файл календаря
        $dateBookStr = $dateService->getDateBookStr($schedules);

        return view('schedule.schedule')->with(['dateBook' => $dateBookStr]);
    }

    public function updateDiaDates(Request $request)
    {

        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            return view('schedule.edit_mass', ['message' => $request->message]);
        }

        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $dateService = new DateService();
            $scheduleService = new ScheduleService();

            $date = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
            $date = explode("-", $date);

            $arrDate = $dateService->getDates($date[0], $date[1], 0);

            $scheduleService->update($arrDate, $request->cost);

            $message = "Цена (" . $request->cost . " руб) изменена с " . $date[0] . " по " . $date[1] . ", включительно.";

            return redirect()->action('ScheduleController@updateDiaDates', ['message' => $message]);
        }

    }

    public function delSchedule()
    {
        $scheduleService = new ScheduleService();
        $count = $scheduleService->delSchedule();

        return view('messages.del_schedule', ['count' => $count]);
    }


    public function add(Request $request)
    {
        $dateService = new DateService();
        $scheduleService = new ScheduleService();

        if ($request->isMethod('get')) {
            $dateBook = $scheduleService->getScheduleStr();
            return view('schedule.schedule')->with(['dateBook' => $dateBook]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $booking = $dateService->getDatesBook($request->date_book);
            // Получим промежуточные даты
            $bookingDatesArray = $dateService->getDates($booking['startDate'], $booking['endDate'], 0);
            $cost = $request->cost;

            //Получим строку для массового добавления  расписания в БД за один раз
            $str = $scheduleService->getStrInsertschedule($bookingDatesArray, $cost);

            // Запись расписания
            $scheduleService->createSchedule($str);
            return redirect()->action('ScheduleController@view');
        }
    }


    public function edit(Request $request)
    {
        $scheduleService = new ScheduleService();

        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            $dateBook = $scheduleService->getScheduleStr();
            return view('schedule.edit')->with(['date_book' => $dateBook]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $params = $scheduleService->updateSchedule($request);
            return view('schedule.edit_table', ['data' => $params]);
        }
    }


    public function editScheduleCost(Request $request)
    {
        $scheduleService = new ScheduleService();
        $str = $scheduleService->getStrUpdateSchedules($request);
        $scheduleService->updateScheduleCost($str);

        $message = "Изменения сохранены";
        return redirect()->action('SettingsController@view', ['message' => $message]);
    }

}
