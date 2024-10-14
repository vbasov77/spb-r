<?php


namespace App\Services;

use App\Repositories\ImgPlaceRepository;

class ImgPlaceService extends Service
{
    private $imgPlaceRepository;

    public function __construct()
    {
        $this->imgPlaceRepository = new ImgPlaceRepository();
    }

    public function store(string $path, int $placeId)
    {
        $data = [
            'path' => $path,
            'place_id' => $placeId
        ];

        $this->imgPlaceRepository->store($data);
    }

    public function findImagesByPlaceId(int $placeId)
    {
        return $this->imgPlaceRepository->findImagesByPlaceId((int) $placeId);
    }

    public function destroy(string $path)
    {
        $this->imgPlaceRepository->destroy($path);
    }

    public function getFileName($file)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $filename = substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
        $file->move(public_path('images/places'), $filename);
        return $filename;
    }
}