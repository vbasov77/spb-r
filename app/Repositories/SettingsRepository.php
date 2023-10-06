<?php


namespace App\Repositories;


use App\Models\FrontSetting;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class SettingsRepository extends Repository
{
    public function findSettingsFrontPage()
    {
        return FrontSetting::where("id", 1)->first();
    }


}