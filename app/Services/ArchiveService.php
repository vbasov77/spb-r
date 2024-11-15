<?php


namespace App\Services;

use App\Repositories\ArchiveRepository;
use Illuminate\Http\Request;


class ArchiveService extends Service
{
    private $archiveRepository;

    /**
     * ArchiveService constructor.
     */
    public function __construct()
    {
        $this->archiveRepository = new ArchiveRepository();
    }

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return $this->archiveRepository->findById($id);
    }

    /**
     * @param array $booking
     */
    public function save(array $booking): void
    {
        $this->archiveRepository->save($booking);
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return $this->archiveRepository->findAll();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $this->archiveRepository->delete($id);
    }

    /**
     * @param object $data
     * @param string $comment
     * @return array
     */
    public function getArrayForArchive(object $data, string $comment): array
    {
        return [
            'user_id' => $data->user_id,
            'date_in' => $data->no_in,
            'date_out' => $data->no_out,
            'user_info' => $data->user_info,
            'total' => $data->total,
            'comment' => $comment,
        ];

    }

    /**
     * @param Request $request
     */
    public function update(Request $request): void
    {
        $data = [
            'date_in' => date('d.m.Y', strtotime($request->date_in)),
            'date_out' => date('d.m.Y', strtotime($request->date_out)),
            'user_info' => $request->user_info,
            'total' => $request->total,
            'comment' => $request->comment,
        ];

        $this->archiveRepository->update($data, $request->id);
    }

}