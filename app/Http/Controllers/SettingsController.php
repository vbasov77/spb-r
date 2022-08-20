<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function view()
    {

//        $dat = DB::table('settings')->get();
//        $res = json_decode(json_encode($dat), true);
//        $front = explode(',', $res[0]['front']);
//        if (empty($_GET['message'])) {
//            $message = null;
//        } else {
//            $message = $_GET['message'];
//        }
        if(empty($_GET['message'])){
            $_GET['message'] = null;
        }

        return view('settings/settings_view', ['message' => $_GET ['message']]);
    }



    public function front(Request $request)
    {
        if (!empty($_POST)) {
            if (!empty($request->file('file'))) {
                $image = $request->file('file');
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $file = $request->file('file');
                $filename = substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
                $image->move(public_path('img/bg_image'), $filename);
                $data = [];
                for ($i = 0; $i < 4; $i++) {
                    $data[] = $_POST ['data'] [$i];
                }
                $data[] = $filename;
                $front_str = implode(',', $data);
                DB::table('settings')->where('id', 1)->update(['front' => $front_str]);
                $message = 'Настройки сохранены';
                return redirect()->action('SettingsController@view', ['message' => $message]);

            } else {

                $data = implode('&', $_POST ['data']);
                DB::table('settings')->where('id', 1)->update(['front' => $data]);
                $message = 'Настройки сохранены';
                return redirect()->action('SettingsController@view', ['message' => $message]);
            }

        } else {
            $dat = DB::table('settings')->get('front');
            $res = json_decode(json_encode($dat), true);
            $result = $res[0]['front'];
            $data = explode(',', $result);

            return view('settings/front_settings', ['data' => $data]);
        }

    }

}
