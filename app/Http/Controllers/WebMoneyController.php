<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebMoneyController extends Controller
{
    public function view()
    {

        $wm_purce = "Z039996680907";


        if (!empty($_POST)) {

            echo 'YES';

        } else {
            exit();
        }
    }

    public function success()
    {

        var_dump($_GET);
    }

    public function fail()
    {

        var_dump($_GET);
    }

}
