<?php


namespace App\Services;

use App\Repositories\ArchiveRepository;

class ArchiveService extends Service
{
    private $archiveRepository;

    public function __construct()
    {
        $this->archiveRepository = new ArchiveRepository();
    }


    public function findById(int $id): object
    {
        return $this->archiveRepository->findById($id);
    }

    public function save(object $data, string $otz): void
    {
        $archive = [
            'user_name' => $data->user_name,
            'phone' => $data->phone,
            'email' => $data->email,
            'no_in' => $data->no_in,
            'no_out' => $data->no_out,
            'payment_term' => $data->payment_term,
            'more_book' => $data->more_book,
            'user_info' => $data->user_info,
            'total' => $data->total,
            'pay' => $data->pay,
            'info_pay' => $data->info_pay,
            'confirmed' => $data->confirmed,
            'otz' => $otz,
            'created_at' => $data->created_at
        ];
        $this->archiveRepository->save($archive);
    }

    public function findAll(): object
    {
        return $this->archiveRepository->findAll();
    }

    public function delete(int $id): void
    {
        $this->archiveRepository->delete($id);
    }

    public function back(int $id): void
    {
        $dateService = new DateService();
        $bookingService  = new BookingService();

        $archive = $this->archiveRepository->findById($id);
        $datesBook = $dateService->getDates($archive->no_in, $archive->no_out, 1);
        $booking = [
            'user_name' => $archive->user_name,
            'phone' => $archive->phone,
            'email' => $archive->email,
            'date_book' => implode(",", $datesBook),
            'no_in' => $archive->no_in,
            'no_out' => $archive->no_out,
            'payment_term' => $archive->payment_term,
            'more_book' => $archive->more_book,
            'user_info' => $archive->user_info,
            'total' => $archive->total,
            'pay' => $archive->pay,
            'info_pay' => $archive->info_pay,
            'confirmed' => $archive->confirmed,
            'created_at' => $archive->created_at
        ];
        $bookingService->create($booking);
        $this->archiveRepository->delete($archive->id);
    }


}