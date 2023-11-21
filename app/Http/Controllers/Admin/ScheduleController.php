<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DateService;
use App\Services\ScheduleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function view(ScheduleService $scheduleService, DateService $dateService): View
    {
        $schedules = $scheduleService->findAll();

        // Получим строку дат для передачи в JS файл календаря
        $dateBookStr = $dateService->getDateBookStr($schedules);

        return view('schedule.schedule')->with(['dateBook' => $dateBookStr]);
    }

    public function edit(Request $request,
                                   DateService $dateService,
                                   ScheduleService $scheduleService)
    {
        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            return view('schedule.edit', ['message' => $request->message]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST


            $date = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
            $date = explode("-", $date);

            $arrDate = $dateService->getDates($date[0], $date[1], 0);

            $scheduleService->update($arrDate, $request->cost);

            $message = "Цена (" . $request->cost . " руб) изменена с " . $date[0] . " по " . $date[1] . ", включительно.";

            return redirect()->action([ScheduleController::class, "edit"], ['message' => $message]);
        }

    }

    public function delSchedule(ScheduleService $scheduleService): View
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
            $array = $scheduleService->getArrayInsertSchedule($bookingDatesArray, (int)$cost);

            // Запись расписания
            $scheduleService->createSchedule($array);
            return redirect()->action([ScheduleController::class, 'view']);
        }
    }


    public function editScheduleCost(Request $request, ScheduleService $scheduleService)
    {
        $str = $scheduleService->getStrUpdateSchedules($request);
        $scheduleService->updateScheduleCost((string)$str);

        $message = "Изменения сохранены";
        return redirect()->action([SettingsController::class, 'index'], ['message' => $message]);
    }
}
