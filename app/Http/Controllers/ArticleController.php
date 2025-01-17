<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;


class ArticleController extends Controller
{
    private $articleService;

    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->articleService = new ArticleService();
    }


    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $result = Article::where('id', $request->id)->get();
        if (Auth::check()) {
            $role = (int)Auth::user()->role;
        } else {
            $role = null;
        }

        return view('articles.show', ['article' => $result[0], 'role' => $role]);
    }

    /**
     * @param ArticleService $articleService
     * @return View
     */
    public function index(ArticleService $articleService): View
    {
        $articles = $articleService->findAllWithPaginate();
        $tags = $articleService->getArticleTags($articleService->findAll());

        return view('articles.index', ['articles' => $articles, 'tags' => $tags]);
    }

    public function searchArticles(Request $request)
    {
        if (!empty(session('search_articles'))) {
            $request->session()->forget('search_articles');
            $request->session()->save();
        }
        $request->session()->put('search_articles', $request->search);
        $request->session()->save();
        $search = $request->input("search");

        $articles = $this->articleService->searchEveryWhereOnRequest($search);
        $tags = $this->articleService->getArticleTags($articles);

        return view('articles.index', ['articles' => $articles, 'tags' => $tags]);
    }

    public function update(Request $request)
    {
        $data = [
            'title' => $request->name,
            'description' => $request->description,
            'text' => $request->text,
            'block_up' => $request->block_up,
            'block' => $request->block,
            'block_down' => $request->block_down,
            'tags' => $request->tags,
        ];

        Article::where('id', $request->id)->update($data);
        $res = ['answer' => 'ok'];

        exit(json_encode($res));
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $result = Article::where('id', $request->id)->get();
        return view('articles.edit', ['article' => $result[0]]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = [
            'author_id' => Auth::id(),
            'title' => $request->name,
            'description' => $request->description,
            'text' => $request->text,
            'block_up' => $request->block_up,
            'block' => $request->block,
            'block_down' => $request->block_down,
            'tags' => $request->tags,
        ];
        $id = Article::insertGetId($data);

        return redirect()->action([ArticleController::class, 'edit'], ['id' => (int)$id]);
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        try {
            $this->articleService->destroy($request->id);
            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function searchByTag(Request $request)
    {
        $articles = $this->articleService->findByTag($request);
        $tags = $this->articleService->getArticleTags($this->articleService->findAll());

        return view('articles.index', ['articles' => $articles, 'tags' => $tags]);
    }
}
