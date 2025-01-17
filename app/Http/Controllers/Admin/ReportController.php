<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checks\CheckReportsIndexRequest;
use App\Services\BookingService;
use App\Services\ReportService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    private $reportService;
    private $bookingService;

    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->bookingService = new BookingService();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        if (session('checkReportsIndex')) {
            $months = $this->reportService->getMonthNames();
            $reports = $this->reportService->findAll();
            $sumStr = $this->reportService->getSumStr($reports);
            $expensesStr = $this->reportService->getExpensesStr($reports);
            $total = $this->reportService->getTotalSumStr($sumStr, $expensesStr);
            $weekDay = $this->reportService->getCountWeekday();
            $countNight = $this->reportService->getCountNight($reports);

            return view('reports.index', [
                'reports' => $reports,
                'sumStr' => $sumStr,
                'expensesStr' => $expensesStr,
                'total' => $total,
                'countNight' => $countNight,
                'weekday' => $weekDay,
                'months' => $months
            ]);
        }

        return \view('checks.check_reports');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->reportService->editExpenses($request);

        return redirect()->route('reports');

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $report = $this->reportService->findById((int)$request->input('id'));

        return view('reports.edit', ['report' => $report]);
    }


    public function checkReportsIndex(CheckReportsIndexRequest $request)
    {
        $password = $this->reportService->getPasswordReportsIndex();

        if (password_verify($request->input('password'), $password)) {
            $request->session()->put('checkReportsIndex', 'true');
            $request->session()->save();

            return redirect()->route('reports');
        }
        $message = "Пароль не верен";

        return \view('checks.check_reports', ['error' => $message]);
    }
}
