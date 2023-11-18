<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Archive;


class ArchiveRepository extends Repository
{
    public function findById(int $id): object
    {
        return Archive::find($id);
    }

    public function findAll(): object
    {
        return Archive::all();
    }

    public function save(array $archive): void
    {
        Archive::insert($archive);
    }

    function delete($id): void
    {
        Archive::where("id", $id)->delete();
    }
}