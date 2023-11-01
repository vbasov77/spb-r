<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DankeController extends Controller
{
    public  function view(): View
    {
        return view('danke', ['mess' => $_GET ['mess']]);
    }


}
