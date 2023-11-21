<?php

use Illuminate\Database\Seeder;
use App\Models\FrontSetting;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Services\DateService;
use App\Services\ScheduleService;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        FrontSetting::insert([
            'settings' => "Ноябрь,1700&Декабрь,2000"
        ]);

        User::insert([
            'name' => 'Vitaliy',
            'email' => '0120912@mail.ru',
            'password' => Hash::make(100),
            'admin' => 1
        ]);

        $dateService = new DateService();
        $scheduleService = new ScheduleService();
        $startDate = date("d.m.Y");
        $ten = strtotime("+10 day");
        $endDate = date("d.m.Y", $ten);
        $cost = 2000;
        $bookingDatesArray = $dateService->getDates($startDate, $endDate, 0);
        $array = $scheduleService->getArrayInsertSchedule($bookingDatesArray, (int) $cost);
        $scheduleService->createSchedule($array);

    }
}
