<?php


namespace App\Services;


use App\Repositories\QueueRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;

class QueueService extends Serializer
{
    public function create(array $data)
    {
        $queueRepo = new QueueRepository();
        $queueRepo->create($data);
    }

    public function findAll()
    {
        $queueRepo = new QueueRepository();
        return $queueRepo->findAll();
    }

    public function getDataQueues()
    {
        $queueService = new QueueService();
        $queues = $queueService->findAll();

        $dateBooks = [];
        $count = count($queues);

        for ($i = 0; $i < $count; $i++) {
            $dateBooks [] = date("Y-m-d", $queues[$i]->date_in);
        }

        return $data = [
            'dateBook' => implode(',', $dateBooks),
            'queue' => $queues
        ];

    }

    public function deleteById(int $id)
    {
        $queueRepo = new QueueRepository();
        $queueRepo->deleteById($id);
    }

    public function findById(int $id)
    {
        $queueRepo = new QueueRepository();
        return $queueRepo->findById($id);
    }

    public function update(array $data, int $id)
    {
        $queueRepo = new QueueRepository();
        $queueRepo->update($data, $id);
    }
}