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
    public function queueList(QueueService $queueService): View
    {
        $data = $queueService->getDataQueues();
        return view('queue.view', ['data' => $data]);
    }


    public function toQueue()
    {
        $bookingService = new BookingService();
        // этот код выполнится, если используется метод GET
        $data = $bookingService->getBookingDates();
        return view('queue.add', ['data' => $data]);

    }

    public function addQueue(AddQueueRequest $addQueueRequest)
    {
        $dateService = new DateService();
        $queueService = new QueueService();
        // этот код выполнится, если используется метод POST
        $booking = explode("-", preg_replace("/\s+/", "", $addQueueRequest->date_book));

        $countNight = $dateService->getCountNight($booking[0], $booking[1]);

        $data = [
            'date_in' => strtotime($booking[0]),
            'date_out' => strtotime($booking[1]),
            'count_night' => $countNight,
            'name' => $addQueueRequest->name,
            'phone' => $addQueueRequest->phone,
            'messenger' => $addQueueRequest->messenger
        ];

        $queueService->create($data);
        return redirect()->action([QueueController::class, 'queueList']);
    }

    public function editView(Request $request, BookingService $bookingService)
    {
        $queueService = new QueueService();

        $datesBook = $bookingService->getBookingDates();
        $data = $queueService->findById((int)$request->id);

        return view('queue.edit', ['data' => $data, 'datesBook' => $datesBook['date_book']]);

    }

    public function edit(DateService $dateService, EditQueueRequest $editQueueRequest)
    {
        $queueService = new QueueService();

        $booking = explode("-", preg_replace("/\s+/", "", $editQueueRequest->date_book));
        $countNight = $dateService->getCountNight($booking[0], $booking[1]);

        $data = [
            'date_in' => strtotime($booking[0]),
            'date_out' => strtotime($booking[1]),
            'count_night' => $countNight,
            'name' => $editQueueRequest->name,
            'phone' => $editQueueRequest->phone,
            'messenger' => $editQueueRequest->messenger
        ];
        $queueService->update($data, (int)$editQueueRequest->id);
        return redirect()->action([QueueController::class, 'queueList']);
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
