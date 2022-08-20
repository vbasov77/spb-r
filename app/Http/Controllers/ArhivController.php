<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArhivController extends Controller
{
    public function view()
    {


    }

    public function oneView(int $id)
    {
        $dat = DB::table('arhiv')->find($id);
        $data = json_decode(json_encode($dat), true);
        return view('arhiv/one_view', ['data' => $data]);
    }

    public function inArhiv()
    {
        $result = DbController::GetBookingOrderId($_POST['id']);

        $data = [
            'name_user' => $result [0]['name_user'],
            'phone_user' => $result [0]['phone_user'],
            'email_user' => $result [0]['email_user'],
            'no_in' => $result [0]['no_in'],
            'no_out' => $result [0]['no_out'],
            'user_info' => $result [0]['user_info'],
            'summ' => $result [0]['summ'],
            'pay' => $result [0]['pay'],
            'info_pay' => $result [0]['info_pay'],
            'confirmed' => $result [0]['confirmed'],
            'otz' => $_POST['otz']
        ];
        DB::table('arhiv')->insert($data);
        DB::table('booking')->delete($_POST['id']);
        return redirect()->action('OrdersController@view');
    }


}
