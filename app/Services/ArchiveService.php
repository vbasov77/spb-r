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

    public function save(array $booking): void
    {
        $this->archiveRepository->save($booking);
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
        $bookingService = new BookingService();

        $archive = $this->archiveRepository->findById($id);
        $datesBook = $dateService->getDates($archive->no_in, $archive->no_out, 1);
        $booking = [
            'user_name' => $archive->user_name,
            'phone' => $archive->phone,
            'email' => $archive->email,
            'date_book' => implode(",", $datesBook),
            'no_in' => $archive->no_in,
            'no_out' => $archive->no_out,
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