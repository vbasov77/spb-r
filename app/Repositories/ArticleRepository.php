<?php


namespace App\Repositories;


use App\Models\Article;
use Illuminate\Config\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends Repository
{
    /**
     * @return object
     */
    public function findAll(): object
    {
        return Article::all();
    }

    /**
     * @return object
     */
    public function findAllWithPaginate(): object
    {
        return Article::OrderBy('id', 'desc')->paginate(10);
    }

    /**
     * @param string $search
     * @return LengthAwarePaginator
     */
    public function searchEveryWhereOnRequest(string $search): LengthAwarePaginator
    {
        return DB::table('articles')->where("title", 'LIKE', "%$search%")->orWhere("description", 'LIKE', "%$search%")
            ->orWhere("text", 'LIKE', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * @return object
     */
    public function findForFront(): object
    {
        return Article::orderBy('id', 'desc')->take(5)->get();
    }

    /**
     * @param string $tag
     * @return mixed
     */
    public function findByTag(string $tag)
    {
        return Article::where('tags', 'LIKE', "%$tag%")->paginate(10);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        Article::where('id', $id)->delete();
    }
}