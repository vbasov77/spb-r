<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function view(Request $request): View
    {
        if (empty($request->message)) {
            $request->message = null;
        }
        return view('settings.settings_view', ['message' => $request->message]);
    }


    public function front(Request $request)
    {
        $settingService = new SettingsService();

        if ($request->isMethod('post')) {
            $inDb = implode("&", $request->data);
            $settingService->updateFrontSettings($inDb);
            $message = "Настройки сохранены";
            return redirect()->action("SettingsController@front", ['message' => $message]);
        }
        if ($request->isMethod('get')) {
            $settings = $settingService->findFrontSettings();
            $data = explode("&", $settings->settings);
            !empty($request->message) ? $message = $request->message : $message = null;
            return view('settings.front_settings', ['data' => $data, "message" => $message]);
        }

    }

}
