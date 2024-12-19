<?php


namespace App\Repositories;


use App\Models\Obj;
use Illuminate\Config\Repository;

class ObjRepository extends Repository
{
    public function store(array $data)
    {
        return Obj::insertGetId($data);
    }

    public function findById(int $id): object
    {
        return Obj::where('id', $id)->get();
    }
}