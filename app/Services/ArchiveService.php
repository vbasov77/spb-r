<?php


namespace App\Services;


use App\Repositories\ArchiveRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;


class ArchiveService extends Serializer
{
    public function findById(int $id)
    {
        $archiveRepo = new ArchiveRepository();
        return $archiveRepo->findById($id);
    }

    public function save(object $data, string $otz)
    {
        $archiveRepo = new ArchiveRepository();
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
        $archiveRepo->save($archive);
    }

    public function findAll()
    {
        $archiveRepo = new ArchiveRepository();
        return $archiveRepo->findAll();
    }

    public function delete(int $id)
    {
        $archiveRepo = new ArchiveRepository();
        $archiveRepo->delete($id);
    }

    public function back(int $id)
    {
        $archiveRepo = new ArchiveRepository();
        $dateService = new DateService();
        $bookingService = new BookingService();

        $archive = $archiveRepo->findById($id);
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
        $archiveRepo->delete($archive->id);
    }


}