<?php


namespace App\Repositories;


use App\Models\Article;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends Repository
{
    public function findAll(): object
    {
        return Article::all();
    }

    public function findAllWithPaginate(): object
    {
        return Article::OrderBy('id', 'desc')->paginate(10);
    }

    public function findTags(): object
    {
        return Article::distinct()->pluck('tags');
    }

    public function searchEveryWhereOnRequest(string $search)
    {
        return DB::table('articles')->where("title", 'LIKE', "%$search%")->orWhere("description", 'LIKE', "%$search%")
            ->orWhere("text", 'LIKE', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
    }

    public function searchForASpecificQuery(string $title, string $search): object
    {
        return Article::where($title, 'LIKE', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
    }

    public function findForFront(): object
    {
        return Article::orderBy('id', 'desc')->take(5)->get();
    }
}