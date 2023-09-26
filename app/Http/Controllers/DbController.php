<?php

namespace App\Http\Controllers;

use App\Mail\DeleteOrder;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DbController extends Controller
{
    public static function createTableBooking($data)
    {
        DB::insert("INSERT INTO booking(name_user, phone_user, email_user, nationality, date_book, no_in, no_out, more_book, summ )
VALUES (:name_user, :phone_user, :email_user, :nationality, :date_book, :no_in, :no_out,  :more_book, :summ)",
            ['name_user' => $data ['name_user'], 'phone_user' => $data ['phone_user'], 'email_user' => $data['email_user'], 'nationality' => $data['nationality'], 'date_book' => $data['date_book'], 'no_in' => $data['no_in'], 'no_out' => $data['no_out'], 'more_book' => $data['more_book'], 'summ' => $data['sum']]);
    }

    public static function GetBookingTable()
    {
        $result = DB::select("SELECT * FROM booking");
        $c = json_decode(json_encode($result), true);
        return $c;
    }
    public static function GetScheduleTable()
    {
        $result = DB::select("SELECT * FROM schedule");
        $c = json_decode(json_encode($result), true);

        return $c;
    }

    public static function updateBookInfoPayAndPay($id, $info_pay, $pay)
    {
        $data = [
            'info_pay' => $info_pay,
            'pay' => $pay,
            'payment_term' => null,
        ];
        DB::table('booking')->where('id', $id)->update($data);
    }

    public static function updateBookInfoPay($id, $info_pay)
    {

        DB::update("update booking set info_pay = :info_pay WHERE id = :id", [
            'info_pay' => $info_pay, 'id' => $id
        ]);
    }

    public static function GetBookingNoInTable()
    {
        $result = DB::select("SELECT no_in FROM booking");
        $c = json_decode(json_encode($result), true);
        return $c;
    }


    public static function GetBookingNoIn($no_in)
    {
        $result = DB::select("SELECT * FROM booking WHERE no_in = :no_in", ['no_in' => $no_in]);
        $c = json_decode(json_encode($result), true);

        return $c;
    }

    public static function GetShedDateBook($date_book)
    {
        $result = DB::select("SELECT * FROM schedule WHERE date_book = :date_book", ['date_book' => $date_book]);
        $c = json_decode(json_encode($result), true);

        return $c;
    }

    public static function GetBookingOrderId($id)
    {
        $result = DB::select("SELECT * FROM booking WHERE id = :id", ['id' => $id]);
        $c = json_decode(json_encode($result), true);

        return $c;
    }


    public static function createTableSchedule($date_book, $cost, $stat)
    {


        DB::insert("INSERT INTO schedule(date_book, cost, stat )
VALUES (:date_book, :cost, :stat)",
            ['date_book' => $date_book, 'cost' => $cost, 'stat' => $stat]);
    }





    public static function updateOrder($data)
    {

        DB::update("update booking set name_user = :name_user, phone_user = :phone_user, email_user = :email_user, nationality = :nationality, summ = :summ WHERE id = :id", [
            'name_user' => $data['name_user'], 'phone_user' => $data['phone_user'], 'email_user' => $data['email_user'], 'nationality' => $data['nationality'], 'summ' => $data['summ'], 'id' => $data['id'],
        ]);
    }

    public static function deleteOrder($id)
    {
        $book = DB::table('booking')->where('id', $id)->get();
        $booking = $book[0];
        $data = [
            'id_book' => $booking->id,
            'name_user' => $booking->name_user,
            'phone_user' => $booking->phone_user,
            'email_user' => $booking->email_user,
            'no_in' => $booking->no_in,
            'no_out' => $booking->no_out,
            'otz' => "Удалено пользователем",
            'user_info' => $booking->user_info,
            'summ' => $booking->summ,
            'pay' => $booking->pay,
            'info_pay' => $booking->info_pay
        ];
        DB::table('arhiv')->insert($data);
        DB::table('booking')->where('id', $id)->delete();
        return $data;
    }

    public static function confirmOrder($id)
    {
        $data = [
            'confirmed' => 1,
            'payment_term' => date('d.m.Y', strtotime("+2 days")),
        ];
        DB::table('booking')->where('id', $id)->update($data);
    }

    public static function getBookingForEmail($email_user)
    {

        $result = DB::select("SELECT * FROM booking WHERE email_user = :email_user", ['email_user' => $email_user]);
        $c = json_decode(json_encode($result), true);

        return $c;
    }
}
