<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Models\ImgPlace;

class ImgPlaceRepository extends Repository
{
    public function store(array $data)
    {
        ImgPlace::insertGetId($data);
    }

    public function findImagesByPlaceId(int $placeId)
    {
        return ImgPlace::where('place_id', $placeId)->get('path');
    }

    public function destroy(string $path)
    {
        ImgPlace::where('path', $path)->delete();
    }
}