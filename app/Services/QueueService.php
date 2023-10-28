<?php


namespace App\Services;


use App\Repositories\QueueRepository;

class QueueService extends Service
{
    private $queueRepository;


    public function __construct()
    {
        $this->queueRepository = new QueueRepository();
    }


    public function create(array $data): void
    {
        $this->queueRepository->create($data);
    }

    public function findAll(): object
    {
        return $this->queueRepository->findAll();
    }

    public function getDataQueues(): array
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

    public function deleteById(int $id): void
    {
        $this->queueRepository->deleteById($id);
    }

    public function findById(int $id): object
    {
        return $this->queueRepository->findById($id);
    }

    public function update(array $data, int $id): void
    {
        $this->queueRepository->update($data, $id);
    }
}