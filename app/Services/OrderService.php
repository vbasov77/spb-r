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

    public function deleteOrder(int $id): array
    {
        $booking = $this->bookingService->getBookingByOrderId($id)[0];
        $data = [
            'user_id' => $booking->user_id,
            'date_book' => $booking->date_book,
            'info_book' => $booking->info_book,
            'user_info' => $booking->user_info,
            'confirmed' => $booking->confirmed,
            'total' => $booking->total,
            'info_pay' => $booking->info_pay,
            'comment' => "Удалено пользователем",
            'created_at' => $booking->created_at,
        ];

        $this->archiveService->save($data);
        $this->bookingService->delete($id);

        return $data;
    }


}