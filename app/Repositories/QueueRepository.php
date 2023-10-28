<?php


namespace App\Repositories;


use App\Models\Queue;

class QueueRepository extends Repository
{

    public function create(array $data): void
    {
        Queue::insert($data);
    }

    public function findAll(): object
    {
        return Queue::orderByRaw("date_in")->orderByRaw("count_night DESC")->get();
    }

    public function deleteById(int $id): void
    {
        Queue::where("id", $id)->delete();
    }

    public function findById(int $id): object
    {
        return Queue::where('id', $id)->first();
    }

    public function update(array $data, int $id): void
    {
        Queue::where("id",  $id)->update($data);
    }
}