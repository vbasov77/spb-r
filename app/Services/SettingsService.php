<?php


namespace App\Services;


use App\Repositories\SettingsRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;


class SettingsService extends Serializer
{
    public function findSettingsFrontPage(){
        $frontSettings = new SettingsRepository();
        return $frontSettings->findSettingsFrontPage();
    }

}