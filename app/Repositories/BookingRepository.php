<?php


namespace App\Repositories;


use App\Models\Booking;
use App\Models\Pay;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingRepository extends Repository
{

    public function findById(int $id): object
    {
        return Booking::find($id);
    }

    public function findAllById(int $id): object
    {
        $bookings = Booking::where("booking.user_id", $id)
            ->leftJoin("pay", "booking.id", "=", "pay.booking_id")
            ->leftJoin("user_phone", "booking.user_id", "=", "user_phone.user_id")
            ->leftJoin("users", "booking.user_id", "=", "users.id")
            ->get(["booking.*", "users.email", "users.name", "user_phone.phone", "pay.total", "pay.pay"]);
        return $bookings;
    }

    public function findAll(): object
    {
        return Booking::all();
    }

    public function getBookingNoInTable(): object
    {
        return Booking::pluck('no_in');
    }

    public function delete(int $id): void
    {
        Booking::where("id", $id)->delete();
    }

    public function getBookingByOrderId(int $id): object
    {
        return Booking::leftJoin("users", "booking.user_id", "=", "users.id")
            ->leftJoin("pay", "booking.id", "=", "pay.booking_id")
            ->leftJoin("user_phone", "users.id", "=", "user_phone.user_id")
            ->where("booking.id", $id)
            ->get(['booking.*', 'pay.total', 'pay.info_pay', 'pay.pay', 'users.name',
                'users.email', 'user_phone.phone']);
    }


    public function addBooking(array $data): int
    {
        return Booking::insertGetId($data);
    }


    public function getBookingNoIn(string $noIn): array
    {
        $booking = DB::select("select b.*, p.pay, p.total, p.info_pay, up.phone, us.name,
       (select a.comment from archive a where a.user_id = b.user_id limit 1)archive
from booking b 
left join pay p on b.id = p.booking_id
left join user_phone up on b.user_id = up.user_id
left join users us on b.user_id = us.id
where b.no_in = " . '"' . $noIn . '"');

        return $booking;
    }

    public function updateOrder(Request $data): void
    {
        Pay::where("booking_id", $data->id)->update([
            'total' => $data->total
        ]);
    }

    public function confirmOrder(int $id): void
    {
        $data = [
            'confirmed' => 1,
        ];
        Booking::where('id', $id)->update($data);
    }

    public function updateInfoPay(int $id, string $infoPay): void
    {
        Pay::where('booking_id', $id)->update(['pay' => 1, 'info_pay' => $infoPay]);
    }

    public function getDateBooks(): object
    {
        return Booking::get('date_book');
    }

}