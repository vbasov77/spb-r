<?php


namespace App\Repositories;


use App\Models\Booking;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class BookingRepository extends Repository
{

    public function findById(int $id)
    {
        return Booking::find($id);
    }

    public function findByEmail(string $email)
    {
        return Booking::where("email", $email)->first();
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

    public function updateOrder(array $data)
    {
        DB::update("update booking set user_name = :user_name, phone = :phone, 
                   email = :email,  total = :total WHERE id = :id", [
            'user_name' => $data['user_name'], 'phone' => $data['phone'], 'email' => $data['email'],
            'total' => $data['total'], 'id' => $data['id'],
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

}