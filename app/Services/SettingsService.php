<?php


namespace App\Services;


use App\Repositories\SettingsRepository;


class SettingsService extends Service
{

    private $settingsRepository;


    public function __construct()
    {
        $this->settingsRepository = new SettingsRepository();
    }

    public function findSettingsFrontPage()
    {
        return $this->settingsRepository->findSettingsFrontPage();
    }

    public function updateFrontSettings(string $inDb): void
    {
        $this->settingsRepository->updateFrontSettings($inDb);
    }



}