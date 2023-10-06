<?php


namespace App\Repositories;


use App\Models\Archive;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class ArchiveRepository extends Repository
{
    public function findById(int $id)
    {
        return Archive::find($id);
    }

    public function save(array $archive)
    {
        Archive::insert($archive);
    }
}