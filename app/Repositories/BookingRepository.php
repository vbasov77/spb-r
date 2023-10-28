<?php


namespace App\Repositories;


use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingRepository extends Repository
{

    public function findById(int $id): object
    {
        return Booking::find($id);
    }

    public function findByEmail(string $email): object
    {
        return Booking::where("email", $email)->get();
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

    public function getBookingOrderId(int $id): object
    {
        return Booking::where("id", $id)->first();
    }


    public function addBooking(array $data): int
    {
        return Booking::insertGetId($data);
    }


    public function getBookingNoIn(string $noIn): array
    {
        $booking = DB::select("select b.*, 
       (select a.otz from archive a where a.phone = b.phone limit 1)archive
from booking b where b.no_in = " . '"' . $noIn . '"');

        return $booking;
    }

    public function updateOrder(Request $data): void
    {
        Booking::where("id", $data->id)->update([
            'user_name' => $data->user_name,
            'phone' => $data->phone,
            'email' => $data->email,
            'total' => $data->total
        ]);
    }

    public function confirmOrder(int $id): void
    {
        $data = [
            'confirmed' => 1,
            'payment_term' => date('d.m.Y', strtotime("+2 days")),
        ];
        Booking::where('id', $id)->update($data);
    }

    public function updateInfoPay(int $id, string $infoPay): void
    {
        Booking::where('id', $id)->update(['pay' => 1, 'info_pay' => $infoPay]);
    }

    public function getDateBooks(): object
    {
        return Booking::get('date_book');
    }

}