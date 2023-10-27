<?php

namespace App\Repositories;

use App\Models\Archive;


class ArchiveRepository extends Repository
{
    public function findById(int $id)
    {
        return Archive::find($id);
    }

    public function findAll()
    {
        return Archive::all();
    }

    public function save(array $archive)
    {
        Archive::insert($archive);
    }

    function delete($id)
    {
        Archive::where("id", $id)->delete();
    }
}