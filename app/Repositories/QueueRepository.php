<?php


namespace App\Repositories;


use App\Models\Queue;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class QueueRepository extends Repository
{

    public function create(array $data)
    {
        Queue::insert($data);
    }

    public function findAll()
    {
        return Queue::orderByRaw("date_in")->orderByRaw("count_night DESC")->get();
    }

    public function deleteById(int $id)
    {
        Queue::where("id", $id)->delete();
    }

    public function findById(int $id)
    {
        return Queue::where('id', $id)->first();
    }

    public function update(array $data, int $id)
    {
        Queue::where("id",  $id)->update($data);
    }
}