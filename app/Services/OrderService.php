<?php


namespace App\Services;


use App\Http\Requests\Orders\EditOrderRequest;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;

class OrderService extends Service
{
    private $bookingRepository;
    private $bookingService;
    private $archiveService;

    public function __construct()
    {
        $this->bookingRepository = new BookingRepository();
        $this->bookingService = new BookingService();
        $this->archiveService = new ArchiveService();
    }


    public function updateOrder(EditOrderRequest $editOrderRequest): void
    {
        $this->bookingRepository->updateOrder($editOrderRequest);
    }

    public function inOrder(): array
    {
        $result = $this->bookingService->getBookingNoInTable();

        $bookingNoIn = [];
        if (!empty(count($result))) {
            for ($i = 0; $i < count($result); $i++) {
                $array[] = strtotime($result[$i]);
            }
            sort($array);
            $bookingNoIn = [];
            foreach ($array as $item) {
                $date = date('d.m.Y', $item);
                $bookingNoIn[] = $this->bookingService->getBookingNoIn($date);
            }
        }
        return $bookingNoIn;
    }

    public function deleteOrder(object $booking): void
    {
        $data = [
            'user_id' => $booking->user_id,
            'date_in' => $booking->no_in,
            'date_out' => $booking->no_out,
            'user_info' => $booking->user_info,
            'total' => 0,
            'comment' => "Удалено пользователем",
        ];

        $this->archiveService->save($data);
        $this->bookingService->delete($booking->id);
    }


}