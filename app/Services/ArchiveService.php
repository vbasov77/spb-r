<?php


namespace App\Services;


use App\Repositories\ArchiveRepository;



class ArchiveService extends Service
{
    public function findById(int $id, ArchiveRepository $archiveRepository)
    {
        return $archiveRepository->findById($id);
    }

    public function save(object $data, string $otz, ArchiveRepository $archiveRepository)
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
        $archiveRepository->save($archive);
    }

    public function findAll(ArchiveRepository $archiveRepository)
    {
        return $archiveRepository->findAll();
    }

    public function delete(int $id, ArchiveRepository $archiveRepository)
    {
        $archiveRepository->delete($id);
    }

    public function back(int $id, ArchiveRepository $archiveRepository,
                         DateService $dateService, BookingService $bookingService)
    {
        $archive = $archiveRepository->findById($id);
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
        $archiveRepository->delete($archive->id);
    }


}