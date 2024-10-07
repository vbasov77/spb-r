<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ErrorController extends Controller
{
    public  function view(Request $request): View
    {
        return view('errors.error_message', ['message' => $request->message]);
    }


}
