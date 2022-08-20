<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        if (Auth::check()) {

            $email_user = Auth::user()->email;
            $book = DbController::getBookingForEmail($email_user);
           
            $data = [
                'book' => $book,
            ];

//           var_dump($book);
            return view('profile', ['data'=>$data]);
        } else {
            return redirect()->route('login');
        }

    }
}
