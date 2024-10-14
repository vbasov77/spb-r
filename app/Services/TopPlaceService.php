<?php


namespace App\Services;

use App\Repositories\TopPlaceRepository;
use Illuminate\Http\Request;

class TopPlaceService extends Service
{
    private $topPlaceRepository;
    private $fileService;
    private $imgPlaceService;

    public function __construct()
    {
        $this->topPlaceRepository = new TopPlaceRepository();
        $this->fileService = new FileService();
        $this->imgPlaceService = new ImgPlaceService();
    }

    public function store(Request $request): int
    {
        $place = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'text' => $request->input('text'),
        ];
        $id = $this->topPlaceRepository->store($place);

        $img = [];
        if (!empty(count($request->file('img')))) {
            $count = count($request->file('img'));
            for ($i = 0; $i < $count; $i++) {
                $img[] = $this->fileService->storeFileInPublic($request->file('img')[$i], $id);
            }
        }

        return $id;
    }


    public function findAllWithFirstPhoto()
    {
        return $this->topPlaceRepository->findAllWithFirstPhoto();
    }
    public function findById(int $id)
    {
        return $this->topPlaceRepository->findById($id);
    }

    public function update(Request $request): void
    {
        $place = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'text' => $request->input('text'),
        ];
        $this->topPlaceRepository->update($request->id, $place);
    }

    public function destroy(int $id)
    {
        $images = $this->imgPlaceService->findImagesByPlaceId($id);
        $count = count($images);
        for ($i = 0; $i < $count; $i++) {
            $this->fileService->destroyImgStr($images[$i]->path);
        }
        $this->topPlaceRepository->destroy($id);
    }


}