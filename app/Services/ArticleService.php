<?php


namespace App\Services;


use App\Repositories\ArticleRepository;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\DocBlock\Serializer;

class ArticleService extends Serializer
{
    private $articleRepository;


    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

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


    public function getTags(): array
    {
        $tags = $this->articleRepository->findTags();
        if (!empty(count($tags))) {
            $count = count($tags);
            $tagsArray = [];
            for ($i = 0; $i < $count; $i++)
                $arr = explode(",",
                    preg_replace("/\s*([,\[\]])\s*/", "$1", $tags[$i])); // Удалили пробелы
            foreach ($arr as $value) {
                if (!in_array($value, $tagsArray))
                    $tagsArray[] = $value;
            }
        } else
            $tagsArray = [];
        return $tagsArray;
    }

    public function findAll(): object
    {
        return $this->articleRepository->findAll();
    }


    public function findForFront(): object
    {
        return $this->articleRepository->findForFront();
    }

    public function findAllWithPaginate(): object
    {
        return $this->articleRepository->findAllWithPaginate();
    }

    public function searchEveryWhereOnRequest(string $search): object
    {
        return $this->articleRepository->searchEveryWhereOnRequest($search);
    }

    public function searchForASpecificQuery(string $name, string $search): object
    {
        return $this->articleRepository->searchForASpecificQuery($name, $search);
    }


}