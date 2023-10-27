<?php

namespace App\Http\Controllers;

class DankeController extends Controller
{
    public  function view()
    {
        return view('danke', ['mess' => $_GET ['mess']]);
    }


}
