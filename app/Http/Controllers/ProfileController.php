<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        if (Auth::check()) {
            $userEmail = Auth::user()->email;
            $bookingService = new BookingService();
            $book = $bookingService->findByEmail($userEmail);
            $data = [
                'book' => $book,
            ];
            return view('profile', ['data'=>$data]);
        } else {
            return redirect()->route('login');
        }

    }
}
