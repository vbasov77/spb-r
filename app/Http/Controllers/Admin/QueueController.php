<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Queue\AddQueueRequest;
use App\Http\Requests\Queue\EditQueueRequest;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\QueueService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QueueController extends Controller
{
    private $queueService;
    private $dateService;

    /**
     * QueueController constructor.
     */
    public function __construct()
    {
        $this->queueService = new QueueService();
        $this->dateService = new DateService();
    }


    /**
     * @param QueueService $queueService
     * @return View
     */
    public function queueList(QueueService $queueService): View
    {
        $data = $queueService->getDataQueues();
        return view('queue.view', ['data' => $data]);
    }


    /**
     * @return View
     */
    public function toQueue()
    {
        $bookingService = new BookingService();
        // этот код выполнится, если используется метод GET
        $data = $bookingService->getBookingDates();
        return view('queue.add', ['data' => $data]);

    }

    /**
     * @param AddQueueRequest $request
     * @return RedirectResponse
     */
    public function addQueue(AddQueueRequest $request)
    {
        $data = $this->getBooking($request);
        $this->queueService->create($data);

        return redirect()->action([QueueController::class, 'queueList']);
    }

    /**
     * @param Request $request
     * @param BookingService $bookingService
     * @return View
     */
    public function editView(Request $request, BookingService $bookingService)
    {
        $queueService = new QueueService();

        $datesBook = $bookingService->getBookingDates();
        $data = $queueService->findById((int)$request->id);

        return view('queue.edit', ['data' => $data, 'datesBook' => $datesBook['date_book']]);

    }

    /**
     * @param EditQueueRequest $request
     * @return RedirectResponse
     */
    public function edit(EditQueueRequest $request)
    {
        $data = $this->getBooking($request);
        $this->queueService->update($data, (int)$request->id);

        return redirect()->action([QueueController::class, 'queueList']);
    }

    /**
     * @param object $request
     * @return array
     */
    public function getBooking(object $request)
    {
        $booking = explode("-", preg_replace("/\s+/", "", $request->date_book));
        $countNight = $this->dateService->getCountNight($booking[0], $booking[1]);

        return $data = [
            'date_in' => strtotime($booking[0]),
            'date_out' => strtotime($booking[1]),
            'count_night' => $countNight,
            'name' => $request->name,
            'phone' => $request->phone,
            'messenger' => $request->messenger
        ];
    }


    /**
     * @param Request $request
     * @param QueueService $queueService
     * @return RedirectResponse
     */
    public function delete(Request $request, QueueService $queueService): RedirectResponse
    {
        $queueService->deleteById((int)$request->id);
        return redirect()->action([QueueController::class, 'queueList']);
    }
}
