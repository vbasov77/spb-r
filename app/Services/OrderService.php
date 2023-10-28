<?php


namespace App\Services;


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


    public function updateOrder(Request $data): void
    {
        $this->bookingRepository->updateOrder($data);
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
        $booking = $this->bookingService->findById($id);
        $data = [
            'id_book' => $booking->id,
            'user_name' => $booking->user_name,
            'phone' => $booking->phone,
            'email' => $booking->email,
            'no_in' => $booking->no_in,
            'no_out' => $booking->no_out,
            'payment_term' => $booking->payment_term,
            'user_info' => $booking->user_info,
            'total' => $booking->total,
            'pay' => $booking->pay,
            'otz' => "Удалено пользователем",
            'info_pay' => $booking->info_pay
        ];
        $this->archiveService->save($booking, $data['otz']);
        $this->bookingService->delete($id);

        return $data;
    }


}