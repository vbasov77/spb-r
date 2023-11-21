<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        if (empty($request->message)) {
            $request->message = null;
        }
        return view('settings.index', ['message' => $request->message]);
    }


    public function front(Request $request, SettingsService $settingsService)
    {
        if ($request->isMethod('post')) {
            $inDb = implode("&", $request->input("data"));
            $settingsService->updateFrontSettings($inDb);
            $message = "Настройки сохранены";
            return redirect()->action([SettingsController::class, "front"], ['message' => $message]);
        }

        if ($request->isMethod('get')) {
            $settings = $settingsService->findSettingsFrontPage();
            $data = explode("&", $settings->settings);
            !empty($request->message) ? $message = $request->message : $message = null;
            return view('settings.front_settings', ['data' => $data, "message" => $message]);
        }

    }
}
