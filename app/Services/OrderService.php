<?php


namespace App\Services;


use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Serializer;

class OrderService extends Serializer
{
    public function updateOrder(Request $data)
    {
        $bookingRepo = new BookingRepository();
        $bookingRepo->updateOrder($data);
    }

    public function inOrder()
    {
        $booking = new BookingService();
        $result = $booking->getBookingNoInTable();
        $bookingNoIn = "";
        if (!empty(count($result))) {
            for ($i = 0; $i < count($result); $i++) {
                $array[] = strtotime($result[$i]);
            }

            sort($array);
            $bookingNoIn = [];
            foreach ($array as $item) {
                $date = date('d.m.Y', $item);
                $bookingNoIn[] = $booking->getBookingNoIn($date);
            }
        }
        return $bookingNoIn;
    }

    public function deleteOrder(int $id)
    {
        $bookingService = new BookingService();
        $archiveService = new ArchiveService();
        $booking = $bookingService->findById($id);
        $data = [
            'id_book' => $booking->id,
            'user_name' => $booking->user_name,
            'phone' => $booking->phone,
            'email' => $booking->email,
            'no_in' => $booking->no_in,
            'no_out' => $booking->no_out,
            'user_info' => $booking->user_info,
            'total' => $booking->total,
            'pay' => $booking->pay,
            'otz' => "Удалено пользователем",
            'info_pay' => $booking->info_pay
        ];
        $archiveService->save($booking, $data['otz']);
        $bookingService->delete($id);

        return $data;
    }


}