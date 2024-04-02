<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(BookingService $bookingService)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $book = $bookingService->findAllById($id);
            return view('profile', ['data' => $book]);
        } else {
            return redirect()->route('login');
        }

    }
}
