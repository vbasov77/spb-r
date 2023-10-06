<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\DateService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
            $date = preg_replace("/\s+/", "", $request->date_book);// удалили пробелы
            $date = explode("-", $date);
            $arrDate = GetController::getDatesArray($date[0], $date[1]);
            $str = self::getStrDates($arrDate);
//            DB::select("update schedule set cost = " . $request->cost . " where date_book in (" . $str . ");");
            Schedule::whereIn('date_book', $arrDate)->update(['cost' => $request->cost]);
            return redirect()->action('ScheduleController@updateDiaDates', ['message' =>
                "Цена (" . $request->cost . " руб) изменена с " . $date[0] . " по " . $date[1] . ", включительно."
            ]);
        }

    }

    public static function getStrDates(array $arrDate)
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

    public function schedule(Request $request)
    {
        $dateService = new DateService();
        $scheduleService = new ScheduleService();


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

    public function add()
    {
        $sh = DB::table('schedule')->get();
        if (!empty($sh)) {
            $result = json_decode(json_encode($sh), true);

            $date_b = [];
            foreach ($result as $res) {
                $date_b[] = $res['date_book'];
            }
            $dis = [];
            foreach ($date_b as $item) {
                $dis[] = date("Y-m-d", strtotime($item));
            }
            $date_book = implode(',', $dis);
//            var_dump($date_book);
//            return;
        } else {
            $date_book = "";
        }
        return view('schedule/schedule')->with(['date_book' => $date_book]);
    }

    public function viewEdit()
    {
        $sh = DB::table('schedule')->get();

        if (!empty($sh)) {
            $result = json_decode(json_encode($sh), true);
            $date_b = [];
            foreach ($result as $res) {
                $date_b[] = $res['date_book'];
            }
            $dis = [];
            foreach ($date_b as $item) {
                $dis[] = date("Y-m-d", strtotime($item));
            }
            $date_book = implode(',', $dis);
        } else {
            $date_book = "";
        }
        return view('schedule/edit')->with(['date_book' => $date_book]);
    }

    public function edit()
    {

        $q = preg_replace("/\s+/", "", $_POST['date_book']);
        $dates = explode('-', $q);
        $arr_date = DateController::getDates($dates[0], $dates[1], 1);
        $arr = [];
        $arr[] = $dates[0];
        foreach ($arr_date as $value) {
            $arr[] = $value;
        }
        $arr[] = $dates[1];
        $res = DB::table('schedule')->get();
        $result = json_decode(json_encode($res), true);
        foreach ($result as $item) {
            if (in_array($item['date_book'], $arr)) {
                $data[] = $item;
            }
        }
        $arr_resDat = [];
        foreach ($result as $r) {
            $arr_resDat[] = $r['date_book'];
        }
        foreach ($arr as $a) {
            if (empty(in_array($a, $arr_resDat))) {
                $noDates [] = $a;
            } else {
                $noDates = false;
            }
        }

        return view('schedule/edit_table', ['datas' => $data, 'noDates' => $noDates]);
    }

    public function editTable()
    {
        $data = [];
        for ($i = 0; $i < count($_POST['cost']); $i++) {
            $data[] = [$_POST['id'][$i], $_POST['cost'][$i]];
        }
        foreach ($data as $datum) {
            DB::table('schedule')->where('id', $datum[0])->update(['cost' => $datum[1]]);
        }
        $message = "Изменения сохранены";
        return redirect()->action('SettingsController@view', ['message' => $message]);
    }


    public function viewCsv()
    {
        if (empty($_GET)) {
            $_GET ['message'] = false;
        }
        return view('/schedule/view_csv', ['message' => $_GET['message']]);
    }


    public function getCsv()
    {
        $res = DB::table('schedule')->get();
        $result = json_decode(json_encode($res), true);
        $d = $_POST ['date_book'];
        $d = preg_replace("/\s+/", "", $d);// удалили пробелы
        $dd = explode("-", $d);// Преобразовали в массив
        $startTime = $dd[0];
        $endTime = $dd[1];
        $date_b = DateController::getDates($startTime, $endTime, 1);// Получили промежуточные даты
        $arr_book = [];
        $arr_book [] = $startTime;
        foreach ($date_b as $b) {
            $arr_book [] = $b;
        }
        $arr_book [] = $endTime;
        $data = [];
        foreach ($result as $item) {
            if (!empty(in_array($item['date_book'], $arr_book))) {
                $data[] = $item;
            }
        }
        $srcFile = date("Y-m-d-H-i-s"); //Получили для имени нового файла
        $srcFileNameCsv = $srcFile . ".csv"; //Добавили расширение для нового файла
        $fpl = fopen(__DIR__ . "/../../../public/files/" . $srcFileNameCsv, "w"); //Открыли новый файл для записи
        if (!empty($data)) {
            foreach ($data as $value) {
                fwrite($fpl, $value['id'] . ";" . $value['date_book'] . ";" . $value['cost'] . PHP_EOL);
            }
        }
        fclose($fpl);
        return response()->download(public_path('files/' . $srcFileNameCsv));
    }

    public function updateCSV(Request $request)
    {
        if ($request->isMethod('post') && $request->file('file')) {
            $file = $request->file('file');
            $filename = date("Y-m-d-H-i-s") . ".csv";
            $file->move(public_path('files'), $filename);
            $res = fopen(__DIR__ . '/../../../public/files/' . $filename, 'r');
            while (($value = fgetcsv($res, 0, ';')) !== false) {
                DB::table('schedule')->where('id', (int)$value[0])->update(['cost' => $value[2]]);
            }
            fclose($res);
            File::delete(public_path('files/' . $filename));
            $message = "Изменения сохранены";
//            return back()->with(['message'=>$message]);
            return redirect()->action('ScheduleController@viewCsv', ['message' => $message]);

        }
    }
}
