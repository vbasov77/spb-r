<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\TopPlaces;
use Illuminate\Support\Facades\DB;

class TopPlaceRepository extends Repository
{
    public function store(array $data): int
    {
        return TopPlaces::insertGetId($data);
    }


    public function findById(int $id)
    {
        return TopPlaces::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param array $place
     */
    public function update(int $id, array $place): void
    {
        TopPlaces::where('id', $id)->update($place);
    }

    public function destroy(int $id): void
    {
        TopPlaces::where('id', $id)->delete();
    }

    public function findAllWithFirstPhoto()
    {
        $places = DB::select("select t.id, t.title, t.description,(select i.path from img_places i where place_id = t.id order by i.id limit 1) path
from top_places t");

        return $places;
    }

}