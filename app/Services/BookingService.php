<?php


namespace App\Services;


use App\Models\Booking;
use App\Models\Pay;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Psr7\str;


class BookingService extends Service
{

    private $bookingRepository;
    private $dateService;

    public function __construct()
    {
        $this->bookingRepository = new BookingRepository;
        $this->dateService = new DateService();
    }

    public function findById(int $id): object
    {
        return $this->bookingRepository->findById($id);
    }

    public function findAllById(int $id): object
    {
        return $this->bookingRepository->findAllById($id);
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

    public function delete(int $id): void
    {
        $this->bookingRepository->delete($id);
    }

    public function confirmOrder(int $id): void
    {
        $this->bookingRepository->confirmOrder($id);
    }


    public function getBookingByOrderId(int $id): object
    {
        return $this->bookingRepository->getBookingByOrderId($id);
    }

    public function updateInfoPay(int $id, string $infoPay): void
    {
        $this->bookingRepository->updateInfoPay($id, $infoPay);
    }

    /**
     * @param string $dateView
     * @param string $phone
     * @param string $email
     * @return bool
     */

    public function checkingForEmployment(string $dateView, string $phone, string $email): bool
    {
        $check = explode(',', $dateView);
        for ($i = 0; $i < count($check) - 1; $i++) {
            $it = explode('/', $check[$i]);
            $arrayDates[] = $it[0];
        }

        $allDates = $this->bookingRepository->getDateBooksByPhone($phone, $email);
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

    public function checkingForEmploymentAll(string $start, string $end): bool
    {
        $allDates = $this->bookingRepository->findAll();
        $datesUser = $this->dateService->getDates($start, $end, 0);
        $array = [];
        foreach ($allDates as $allDate) {
            $arrayOne = explode(',', $allDate->date_book);
            $array[] = $arrayOne;
        }
        $array = Arr::collapse($array);
        $newArray = [];
        foreach ($array as $item) {
            $newArray[] = strtotime($item);
        }
        array_pop($newArray);
        foreach ($datesUser as $value) {
            if (in_array(strtotime($value), $newArray)) {
                return false;
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
        $dateBook = $request->date_book;
        $dateBook = preg_replace("/\s+/", "", $dateBook);// удалили пробелы
        $dateBookArray = explode("-", $dateBook);// преобразовали в массив
        $email = preg_replace("/\s+/", "", $email);// удалили пробелы

        $condition = 1;                                            // 1 - прибавить, 2 - вычесть
        $dateService->setCountNightObj($dateBookArray, $request->sum, $condition);
        $startDate = $dateBookArray[0];
        $endDate = $dateBookArray[1];
        $dateArray = $dateService->getDates($startDate, $endDate, 1);
        $dateBook = implode(',', $dateArray);
        $infoBook = $request->info_book;
        $info = implode("&", $request->more_book);

        $book = new Booking();
        $book->user_id = $request->user_id;
        $book->date_book = $dateBook;
        $book->no_in = $startDate;
        $book->no_out = $endDate;
        $book->info_book = $infoBook;
        $book->user_info = $info;

        $pay = new Pay();
        $pay->booking_id = $book->id;
        $pay->total = $request->sum;

        $book->save();
        $book->pay()->save($pay);
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'id' => $book->id
        ];
        return $params;

    }

    public function addBookingAdm(Request $request) :void
    {
        $dateService = new DateService();

        $dateBook = $request->date_book;
        $dateBook = preg_replace("/\s+/", "", $dateBook);// удалили пробелы
        $dateBookArray = explode("-", $dateBook);// преобразовали в массив
        $startDate = $dateBookArray[0];
        $endDate = $dateBookArray[1];
        $dateArray = $dateService->getDates($startDate, $endDate, 1);
        $dateBook = implode(',', $dateArray);
        $userInfo = (string) $request->input('phone')
            . ', ' . $request->input('user_name')
            . ', ' . $request->input('age')
            . ', ' . $request->input('district');

        $book = new Booking();

        $book->user_id = Auth::id();
        $book->date_book = $dateBook;
        $book->no_in = $startDate;
        $book->no_out = $endDate;
        $book->info_book = 1;
        $book->user_info = $userInfo;
        $book->confirmed = 1;

        $pay = new Pay();
        $pay->booking_id = $book->id;
        $pay->total = $request->total;

        $book->save();
        $book->pay()->save($pay);
    }


}