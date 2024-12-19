<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    private $settingsService;

    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->settingsService = new SettingsService();
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if (empty($request->message)) {
            $request->message = null;
        }

        return view('settings.index', ['message' => $request->message]);
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $settings = $this->settingsService->findSettingsFrontPage();
        $data = explode("&", $settings->settings);
        !empty($request->message) ? $message = $request->message : $message = null;

        return view('settings.front_settings', ['data' => $data, "message" => $message]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $inDb = implode("&", $request->input("data"));
        $this->settingsService->updateFrontSettings($inDb);
        $message = "Настройки сохранены";

        return redirect()->action([SettingsController::class, "edit"], ['message' => $message]);
    }

}
