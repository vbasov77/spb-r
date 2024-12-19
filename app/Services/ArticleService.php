<?php


namespace App\Services;


use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;


class ArticleService extends Service
{
    private $articleRepository;


    /**
     * ArticleService constructor.
     */
    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function findByTag(Request $request)
    {
        return $this->articleRepository->findByTag($request->input('tag'));
    }


    /**
     * @param $articles
     * @return array
     */
    public function getArticleTags($articles): array
    {
        $tags = [];
        for ($i = 0; $i < count($articles); $i++) {
            $tags[] = explode(',', preg_replace("/\s*([,\[\]])\s*/", "$1", $articles[$i]->tags));
            //удалили пробелы после запятой
        }
        $tags = array_unique(Arr::collapse($tags));

        return $tags;
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @return object
     */
    public function findForFront(): object
    {
        return $this->articleRepository->findForFront();
    }

    /**
     * @return object
     */
    public function findAllWithPaginate(): object
    {
        return $this->articleRepository->findAllWithPaginate();
    }

    /**
     * @param string $search
     * @return LengthAwarePaginator
     */
    public function searchEveryWhereOnRequest(string $search): LengthAwarePaginator
    {
        return $this->articleRepository->searchEveryWhereOnRequest($search);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->articleRepository->destroy($id);
    }


}