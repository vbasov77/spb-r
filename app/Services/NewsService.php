<?php


namespace App\Services;


use App\Repositories\NewsRepository;
use Illuminate\Http\Request;


class NewsService extends Service
{

    private $newsRepository;
    private $fileService;

    public function __construct()
    {
        $this->newsRepository = new NewsRepository();
        $this->fileService = new FileService();
    }

    public function findById(int $id): object
    {
        return $this->newsRepository->findById($id);
    }

    public function findAllById(): object
    {
        return $this->newsRepository->findAll();
    }

    public function store(Request $request, array $images): int
    {
        $data = [
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'description' => $request->input('description'),
            'img' => $images[1]['images'],
            'ids' => $images[0]['vkPostId'],
        ];

        return $this->newsRepository->store($data);

    }

    public function destroy(int $id)
    {
        $this->newsRepository->destroy($id);
    }

    public function findVkId(int $id)
    {
        return $this->newsRepository->findVkId($id);
    }

}