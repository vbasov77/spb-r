<?php


namespace App\Repositories;


use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleRepository extends Repository
{
    public function findAll()
    {
        return Schedule::all();
    }

    public function findAllById(string $str)
    {
        $result = DB::select("select * from schedule where $str");
        return $result;
    }

    public function findByDatesBook(string $str)
    {
        return DB::select("select id, date_book, cost from schedule where $str");
    }

    public function createSchedule(array $datesBook)
    {
        Schedule::insert($datesBook);
    }

    public function update(array $dates, int $cost)
    {
        Schedule::whereIn('date_book', $dates)->update(['cost' => $cost]);
    }

    public function updateCost(string $str)
    {
        DB::select("UPDATE schedule SET cost = CASE
   $str ELSE cost END");
    }

    public function deleteByIds($str)
    {
        DB::select("DELETE FROM schedule where $str");
    }

}