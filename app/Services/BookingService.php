<?php


namespace App\Services;


use App\Repositories\BookingRepository;
use Illuminate\Http\Request;


class BookingService extends Service
{

    private $bookingRepository;

    public function __construct()
    {
        $this->bookingRepository = new BookingRepository;
    }

    public function findById(int $id): object
    {
        return $this->bookingRepository->findById($id);
    }

    public function create(array $book): void
    {
        $this->bookingRepository->addBooking($book);
    }

    public function getBookingNoInTable(): object
    {
        return $this->bookingRepository->getBookingNoInTable();
    }

    public function findAll(): object
    {
        return $this->bookingRepository->findAll();
    }

    public function getBookingNoIn(string $noIn): array
    {
        return $this->bookingRepository->getBookingNoIn($noIn);
    }

    public function findByEmail(string $email): object
    {
        return $this->bookingRepository->findByEmail($email);
    }

    public function delete(int $id): void
    {
        $this->bookingRepository->delete($id);
    }

    public function confirmOrder(int $id): void
    {
        $this->bookingRepository->confirmOrder($id);
    }


    public function getBookingOrderId(int $id): object
    {
        return $this->bookingRepository->getBookingOrderId($id);
    }

    public function updateInfoPay(int $id, string $infoPay): void
    {
        $this->bookingRepository->updateInfoPay($id, $infoPay);
    }

    public function checkingForEmployment(string $dateView): bool
    {
        $check = explode(',', $dateView);
        for ($i = 0; $i < count($check) - 1; $i++) {
            $it = explode('/', $check[$i]);
            $arrayDates[] = $it[0];
        }
        $allDates = $this->bookingRepository->getDateBooks();
        if (!empty(count($allDates))) {
            foreach ($allDates as $date) {
                $arrayTable[] = $date->date_book;
            }
            if (!empty(count($arrayDates))) {
                foreach ($arrayDates as $value) {
                    foreach ($arrayTable as $table) {
                        $tab = explode(',', $table);
                        if (in_array($value, $tab)) {
                            return false;
                        }
                    }
                }
            }
        }
        return true;

    }


    public function getBookingDates(): array
    {
        $booking = $this->bookingRepository->findAll();
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
            $dateBook = implode(',', $arrayDatesFormat);

        } else {
            $dateBook = "";
        }

        $data = [
            'date_book' => $dateBook,
        ];

        return $data;
    }


    public function addBooking(Request $request, string $userName): array
    {
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
        $id = $this->bookingRepository->addBooking($data);
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'id' => $id
        ];
        return $params;

    }


}