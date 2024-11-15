<?php


namespace App\Services;


use App\Repositories\SlierImgRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;

class SliderImgService extends Serializer
{
    private $sliderImgRepository;

    public function __construct()
    {
        $this->sliderImgRepository = new SlierImgRepository();
    }

    public function findAll(): object
    {
        return $this->sliderImgRepository->findAll();
    }

    public function create(string $path)
    {
        $this->sliderImgRepository->create($path);
    }

    public function delete(string  $path)
    {
        $this->sliderImgRepository->delete($path);
    }

    public function getImagesArray(object $data): array
    {
        $array = [];
        if (!empty(count($data))) {
            foreach ($data as $datum) {
                $array[] = $datum->path;
            }
        }
        return $array;
    }

}