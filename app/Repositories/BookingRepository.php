<?php


namespace App\Repositories;


use App\Models\Booking;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingRepository extends Repository
{

    public function findById(int $id)
    {
        return Booking::find($id);
    }

    public function findByEmail(string $email)
    {
        return Booking::where("email", $email)->get();
    }

    public function findAll()
    {
        return Booking::all();
    }


    public function getBookingNoInTable()
    {
        return Booking::pluck('no_in');
    }

    public function delete(int $id)
    {
        Booking::where("id", $id)->delete();
    }

    public function getBookingOrderId(int $id)
    {
        return Booking::where("id", $id)->first();
    }


    public function addBooking(array $data)
    {
        return Booking::insertGetId($data);
    }


    public function getBookingNoIn(string $noIn)
    {
        $booking = DB::select("select b.*, 
       (select a.otz from archive a where a.phone = b.phone limit 1)archive
from booking b where b.no_in = " . '"' . $noIn . '"');

        return $booking;
    }

    public function updateOrder(Request $data)
    {
        Booking::where("id", $data->id)->update([
            'user_name' => $data->user_name,
            'phone' => $data->phone,
            'email' => $data->email,
            'total' => $data->total
        ]);
    }

    public function confirmOrder(int $id)
    {
        $data = [
            'confirmed' => 1,
            'payment_term' => date('d.m.Y', strtotime("+2 days")),
        ];
        Booking::where('id', $id)->update($data);
    }

    public function updateInfoPay(int $id, string $infoPay)
    {
        DB::table('booking')->where('id', $id)->update(['pay' => 1, 'info_pay' => $infoPay]);
    }

}