<?php


namespace App\Http\Controllers;


use App\Services\BookingService;
use App\Services\DateService;
use App\Services\QueueService;
use Illuminate\Http\Request;

class QueueController extends Controller
{

    public function view()
    {
        $queueService = new QueueService();

        $data = $queueService->getDataQueues();
        return view('queue.view', ['data' => $data]);
    }


    public function toQueue(Request $request)
    {
        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET
            $service = new BookingService();
            $data = $service->getBookingDates();
            return view('queue.add', ['data' => $data]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $queueService = new QueueService();
            $dateService = new DateService();

            $booking = explode("-", preg_replace("/\s+/", "", $request->date_book));

            $countNight = $dateService->getCountNight($booking[0], $booking[1]);

            $data = [
                'date_in' => strtotime($booking[0]),
                'date_out' => strtotime($booking[1]),
                'count_night' => $countNight,
                'name' => $request->name,
                'phone' => $request->phone,
                'messenger' => $request->messenger
            ];

            $queueService->create($data);
            return redirect()->action("QueueController@view");
        }
    }

    public function update(Request $request)
    {
        $queueService = new QueueService();
        if ($request->isMethod('get')) {
            // этот код выполнится, если используется метод GET

            $bookingService = new BookingService();
            $datesBook = $bookingService->getBookingDates();
            $data = $queueService->findById($request->id);

            return view('queue.update', ['data' => $data, 'datesBook' => $datesBook['date_book']]);
        }
        if ($request->isMethod('post')) {
            // этот код выполнится, если используется метод POST
            $dateService = new DateService();

            $booking = explode("-", preg_replace("/\s+/", "", $request->date_book));

            $countNight = $dateService->getCountNight($booking[0], $booking[1]);

            $data = [
                'date_in' => strtotime($booking[0]),
                'date_out' => strtotime($booking[1]),
                'count_night' => $countNight,
                'name' => $request->name,
                'phone' => $request->phone,
                'messenger' => $request->messenger
            ];
            $queueService->update($data, $request->id);
            return redirect()->action("QueueController@view");
        }
    }

    public function delete(Request $request)
    {
        $queueService = new QueueService();
        $queueService->deleteById($request->id);

        return redirect()->action("QueueController@view");

    }

}