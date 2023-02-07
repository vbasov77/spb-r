<?php

namespace App\Http\Controllers;


use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function test(){

        $subject = 'Test';
        $toEmail = "0120912@mail.ru";
        $params = [];
        Mail::to($toEmail)->send(new TestMail($subject, $params));
    }
}
