<?php


namespace App\Services;


use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NewsService extends Service
{

    private $newsRepository;
    private $fileService;

    /**
     * NewsService constructor.
     */
    public function __construct()
    {
        $this->newsRepository = new NewsRepository();
        $this->fileService = new FileService();
    }

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return $this->newsRepository->findById($id);
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return $this->newsRepository->findAll();
    }

    /**
     * @param Request $request
     * @param array $ids
     * @param string $img
     * @return int
     */
    public function store(Request $request, array $ids, string $img): int
    {
        $data = [
            'user_id' => Auth::id(),
            'text' => $request->input('text'),
            'img' => $img,
            'ids' => collect($ids)->toJson(),
        ];

        return $this->newsRepository->store($data);

    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->newsRepository->destroy($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findIds(int $id)
    {
        return $this->newsRepository->findIds($id);
    }

    /**
     * @param int $userId
     * @return object
     */
    public function findByUserId(int $userId): object
    {
        return $this->newsRepository->findByUserId($userId);
    }

    /**
     * @return object
     */
    public function findForFrontPage(): object
    {
        return $this->newsRepository->findForFrontPage();
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): void
    {
        $data = [
            'text' => $request->input('text')
        ];

        $this->newsRepository->update($data, $id);
    }


}