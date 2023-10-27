<?php

namespace App\Http\Controllers;

use App\Services\DateService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function view(ScheduleService $scheduleService, DateService $dateService)
    {

        $schedules = $scheduleService->findAll();

        // Получим строку дат для передачи в JS файл календаря
        $dateBookStr = $dateService->getDateBookStr($schedules);

        return view('schedule.schedule')->with(['dateBook' => $dateBookStr]);
    }

    public function updateDiaDates(Request $request,
                                   DateService $dateService,
                                   ScheduleService $scheduleService)
    {

        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            return view('schedule.edit_mass', ['message' => $request->message]);
        }

        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST


            $date = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
            $date = explode("-", $date);

            $arrDate = $dateService->getDates($date[0], $date[1], 0);

            $scheduleService->update($arrDate, $request->cost);

            $message = "Цена (" . $request->cost . " руб) изменена с " . $date[0] . " по " . $date[1] . ", включительно.";

            return redirect()->action('ScheduleController@updateDiaDates', ['message' => $message]);
        }

    }

    public function delSchedule(ScheduleService $scheduleService)
    {
        $count = $scheduleService->delSchedule();
        return view('messages.del_schedule', ['count' => $count]);
    }


    public function add(Request $request, DateService $dateService, ScheduleService $scheduleService)
    {
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

            //Получим массив для массового добавления  расписания в БД за один раз
            $array = $scheduleService->getArrayInsertSchedule($bookingDatesArray, $cost);
            // Запись расписания
            $scheduleService->createSchedule($array);
            return redirect()->action('ScheduleController@view');
        }
    }


    public function edit(Request $request, ScheduleService $scheduleService)
    {
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


    public function editScheduleCost(Request $request, ScheduleService $scheduleService)
    {
        $str = $scheduleService->getStrUpdateSchedules($request);
        $scheduleService->updateScheduleCost($str);

        $message = "Изменения сохранены";
        return redirect()->action('SettingsController@view', ['message' => $message]);
    }

}
