<?php


namespace App\Repositories;


use App\Http\Requests\Orders\EditOrderRequest;
use App\Models\Booking;
use App\Models\Pay;
use Illuminate\Support\Facades\DB;


class BookingRepository extends Repository
{

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return Booking::find($id);
    }

    /**
     * @param int $id
     * @return object
     */
    public function findAllById(int $id): object
    {
        $bookings = Booking::where("booking.user_id", $id)
            ->leftJoin("pay", "booking.id", "=", "pay.booking_id")
            ->leftJoin("user_phone", "booking.user_id", "=", "user_phone.user_id")
            ->leftJoin("users", "booking.user_id", "=", "users.id")
            ->get(["booking.*", "users.email", "users.name", "user_phone.phone", "pay.total", "pay.pay"]);
        return $bookings;
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return Booking::where('confirmed', 1)->get();
    }

    /**
     * @return object
     */
    public function getBookingNoInTable(): object
    {
        return Booking::pluck('no_in');
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        Booking::where("id", $id)->delete();
    }

    /**
     * @param int $id
     * @return object
     */
    public function getBookingByOrderId(int $id): object
    {
        return Booking::leftJoin("users", "booking.user_id", "=", "users.id")
            ->leftJoin("pay", "booking.id", "=", "pay.booking_id")
            ->leftJoin("user_phone", "users.id", "=", "user_phone.user_id")
            ->where("booking.id", $id)
            ->get(['booking.*', 'pay.total', 'pay.info_pay', 'pay.pay', 'users.name',
                'users.email', 'user_phone.phone']);
    }

    /**
     * @param array $data
     * @return int
     */
    public function addBooking(array $data): int
    {
        return Booking::insertGetId($data);
    }

    /**
     * @param string $noIn
     * @return array
     */
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

    /**
     * @param EditOrderRequest $editOrderRequest
     */
    public function updateOrder(EditOrderRequest $editOrderRequest): void
    {
        $pay = Pay::where('booking_id', $editOrderRequest->input('id'))->first();

        if ($pay) {
            Pay::where('booking_id', $editOrderRequest->input('id'))->update([
                'total' => $editOrderRequest->input('total')
            ]);
        } else {
            Pay::insertGetId([
                'booking_id' => $editOrderRequest->input('id'),
                'total' => $editOrderRequest->input('total')
            ]);
        }
    }

    /**
     * @param int $id
     */
    public function confirmOrder(int $id): void
    {
        $data = [
            'confirmed' => 1,
        ];
        Booking::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @param string $infoPay
     */
    public function updateInfoPay(int $id, string $infoPay): void
    {
        Pay::where('booking_id', $id)->update(['pay' => 1, 'info_pay' => $infoPay]);
    }

    /**
     * @return object
     */
    public function getDateBooks(): object
    {
        return Booking::get('date_book');
    }

    /**
     * @param string $phone
     * @param string $email
     * @return object
     */
    public function getDateBooksByPhone(string $phone, string $email): object
    {
        return DB::table('booking')
            ->leftJoin('user_phone', 'booking.user_id', '=', 'user_phone.user_id')
            ->leftJoin('users', 'booking.user_id', '=', 'users.id')
            ->where('user_phone.phone', $phone)
            ->orWhere('users.email', $email)
            ->get('booking.date_book');
    }

    /**
     * @param int $id
     * @return object
     */
    public function findDatesById(int $id): object
    {
        return Booking::where('id', $id)->get(['id', 'no_in', 'no_out']);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function updateDates(array $data, int $id)
    {
        Booking::where('id', $id)->update($data);
    }

}