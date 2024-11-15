<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\ReportService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $reports = $this->reportService->findAll();
        $sumStr = $this->reportService->getSumStr($reports);
        $expensesStr = $this->reportService->getExpensesStr($reports);
        $total = $this->reportService->getTotalSumStr($sumStr, $expensesStr);
        $weekDay = $this->reportService->getCountWeekday();

        return view('reports.reports_obj', [
            'reports' => $reports,
            'sumStr' => $sumStr,
            'expensesStr' => $expensesStr,
            'total' => $total,
            'weekday' => $weekDay
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function update(Request $request)
    {
        $report = $this->reportService->findById((int)$request->input('id'));

        return view('reports.edit', ['report' => $report]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function edit(Request $request)
    {
        $this->reportService->editExpenses($request);

        return redirect()->route('admin.reports');
    }
}
