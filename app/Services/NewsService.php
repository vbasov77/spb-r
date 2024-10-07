<?php


namespace App\Services;


use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function findAll(): object
    {
        return $this->newsRepository->findAll();
    }

    public function store(Request $request, array $vkPost, string $telegramPost): int
    {
        $ids = [
            'vkPostId' => $vkPost[0]['vkPostId'],
            'tgPost' => $telegramPost
        ];

        $img = null;
        if (!empty($vkPost[1]['images'])) {
            $img = $vkPost[1]['images'];
        }

        $data = [
            'user_id' => Auth::id(),
            'text' => $request->input('text'),
            'img' => $img,
            'ids' => collect($ids)->toJson(),
        ];

        return $this->newsRepository->store($data);

    }

    public function destroy(int $id)
    {
        $this->newsRepository->destroy($id);
    }

    public function findIds(int $id)
    {
        return $this->newsRepository->findIds($id);
    }

    public function findByUserId(int $userId): object
    {
        return $this->newsRepository->findByUserId($userId);
    }

    public function findForFrontPage(): object
    {
        return $this->newsRepository->findForFrontPage();
    }

}