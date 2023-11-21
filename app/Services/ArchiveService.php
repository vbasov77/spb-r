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

    public function getArrayForArchive(object $data, string $comment): array
    {
        return [
            'user_id' => $data->user_id,
            'date_book' => $data->date_book,
            'info_book' => $data->info_book,
            'user_info' => $data->user_info,
            'confirmed' => $data->confirmed,
            'total' => $data->total,
            'info_pay' => $data->info_pay,
            'comment' => $comment,
            'created_at' => $data->created_at,
        ];

    }


}