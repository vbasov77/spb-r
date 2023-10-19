<?php


namespace App\Services;


use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Serializer;


class BookingService extends Serializer
{

    public function findById(int $id)
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->findById($id);
    }

    public function create(array $book){
        $bookingRepo = new BookingRepository();
        $bookingRepo->addBooking($book);
    }

    public function getBookingNoInTable()
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->getBookingNoInTable();
    }

    public function findAll()
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->findAll();
    }

    public function getBookingNoIn(string $noIn)
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->getBookingNoIn($noIn);
    }

    public function findByEmail(string $email)
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->findByEmail($email);
    }

    public function delete(int $id)
    {
        $bookingRepo = new BookingRepository();
        $bookingRepo->delete($id);
    }

    public function confirmOrder(int $id)
    {
        $bookingRepo = new BookingRepository();
        $bookingRepo->confirmOrder($id);
    }


    public function getBookingOrderId(int $id)
    {
        $bookingRepo = new BookingRepository();
        return $bookingRepo->getBookingOrderId($id);
    }

    public function updateInfoPay(int $id, string $infoPay)
    {
        $bookingRepo = new BookingRepository();
        $bookingRepo->updateInfoPay($id, $infoPay);
    }

    public function checkingForEmployment($dateView)
    {
        $check = explode(',', $dateView);
        for ($i = 0; $i < count($check) - 1; $i++) {
            $it = explode('/', $check[$i]);
            $array_dates[] = $it[0];
        }
        $all_dates = DB::table('booking')->get('date_book');
        if (!empty(count($all_dates))) {
            foreach ($all_dates as $da) {
                $array_table[] = $da->date_book;
            }
            if (!empty(count($array_dates))) {
                foreach ($array_dates as $ar) {
                    foreach ($array_table as $table) {
                        $tab = explode(',', $table);
                        if (in_array($ar, $tab)) {
                            return false;
                        }
                    }
                }
            }
        }
        return true;

    }


    public function getBookingDates()
    {
        $bookingRepo = new BookingRepository();
        $booking = $bookingRepo->findAll();

        if (!empty($booking)) {
            // Переформатирование date_book
            $arrayDatesFormat = [];
            for ($i = 0; $i < count($booking); $i++) {
                $dateBook = explode(',', $booking[$i]->date_book);
                $countDateBook = count($dateBook);
                for ($j = 0; $j < $countDateBook - 1; $j++) {
                    $arrayDatesFormat[] = date("Y-m-d", strtotime($dateBook[$j]));
                }
            }
            $date_book = implode(',', $arrayDatesFormat);

        } else {
            $date_book = "";
        }

        $data = [
            'date_book' => $date_book,
        ];

        return $data;
    }


    public function addBooking(Request $request, string $userName)
    {
        $bookingRepo = new BookingRepository();
        $dateService = new DateService();

        $email = $request->email;
        $info = implode("&", $request->more_book);
        $dateBook = $request->date_book;
        $total = $request->sum;
        $phone = $request->phone;
        $moreBook = $request->date_view;

        $dateBook = preg_replace("/\s+/", "", $dateBook);// удалили пробелы
        $dateBookArray = explode("-", $dateBook);// преобразовали в массив

        $email = preg_replace("/\s+/", "", $email);// удалили пробелы

        $condition = 1;                                            // 1 - прибавить, 2 - вычесть
        $dateService->setCountNightObj($dateBookArray, $request->sum, $condition);
        $startDate = $dateBookArray[0];
        $endDate = $dateBookArray[1];
        $dateArray = $dateService->getDates($startDate, $endDate, 1);
        $dateBook = implode(',', $dateArray);

        $data = [
            'user_name' => $userName,
            'phone' => $phone,
            'email' => $email,
            'date_book' => $dateBook,
            'no_in' => $startDate,
            'no_out' => $endDate,
            'more_book' => $moreBook,
            'user_info' => $info,
            'total' => $total,
        ];
        $id = $bookingRepo->addBooking($data);
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'id' => $id
        ];
        return $params;

    }


}