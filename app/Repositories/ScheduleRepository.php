<?php


namespace App\Repositories;


use App\Models\Schedule;
use Illuminate\Config\Repository;
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
        return DB::select("select cost from schedule where $str");
    }

    public function createSchedule(string $datesBook)
    {
        DB::select("insert into schedule(date_book, cost)
values $datesBook");

    }

}