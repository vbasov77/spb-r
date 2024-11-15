<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MissedDatesController extends Controller
{
    private $bookingService;

    /**
     * BookingController constructor.
     */
    public function __construct()
    {
        $this->bookingService = new BookingService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('orders.missed_dates');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $dateIn = date('d.m.Y', strtotime($request->input('date_in')));
        $dateOut = date('d.m.Y', strtotime($request->input('date_out')));

        $check = $this->bookingService->checkingForEmploymentAll($dateIn, $dateOut, 1);
        if ($check) {
            $this->bookingService->missedDates($request);

            return redirect()->route("admin.orders");
        } else {
            return redirect()->route('error.book');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id): View
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
