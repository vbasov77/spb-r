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
            'user_info' => $data->user_info,
            'total' => $data->summ,
            'pay' => $data->pay,
            'info_pay' => $data->info_pay,
            'confirmed' => $data->confirmed,
            'otz' => $otz
        ];
        $archiveRepo->save($archive);
    }


}