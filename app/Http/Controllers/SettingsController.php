<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function view()
    {
        if (empty($_GET['message'])) {
            $_GET['message'] = null;
        }
        return view('settings/settings_view', ['message' => $_GET ['message']]);
    }


    public function front(Request $request)
    {
        if ($request->isMethod('post')) {
            $inDb = implode("&", $request->data);

            DB::table('front_settings')->where("id", 1)->update(["settings" => $inDb]);

            $message = "Настройки сохранены";
            return redirect()->action("SettingsController@front", ['message' => $message]);
        }
        if ($request->isMethod('get')) {
            $result = DB::table('front_settings')->first();
            $data = explode("&", $result->settings);
            !empty($request->message) ? $message = $request->message : $message = null;
            return view('settings/front_settings', ['data' => $data, "message" => $message]);
        }

    }

}
