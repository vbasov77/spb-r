<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        if (Auth::check()) {
            $userEmail = Auth::user()->email;
            $bookingService = new BookingService();
            $book = $bookingService->findByEmail($userEmail);

            return view('profile', ['data' => $book]);
        } else {
            return redirect()->route('login');
        }

    }
}
