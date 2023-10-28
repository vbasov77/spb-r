<?php


namespace App\Repositories;

use App\Models\FrontSetting;
use Illuminate\Support\Facades\DB;

class SettingsRepository extends Repository
{
    public function findSettingsFrontPage(): object
    {
        return FrontSetting::where("id", 1)->first();
    }

    public function updateFrontSettings(string $inDb): void
    {
        DB::table('front_settings')->where("id", 1)->update(["settings" => $inDb]);
    }



}