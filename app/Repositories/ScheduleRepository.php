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

    public function findAllById(string $str): array
    {
        return DB::select("select * from schedule where $str");
    }

    public function findByDatesBook(string $str): array
    {
        return DB::select("select id, date_book, cost from schedule where $str");
    }

    public function createSchedule(array $datesBook): void
    {
        Schedule::insert($datesBook);
    }

    public function update(array $dates, int $cost): void
    {
        Schedule::whereIn('date_book', $dates)->update(['cost' => $cost]);
    }

    public function updateCost(string $str): void
    {
        DB::select("UPDATE schedule SET cost = CASE
   $str ELSE cost END");
    }

    public function deleteByIds($str): void
    {
        DB::select("delete from schedule where " . $str);
    }

}