<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class ArticleController extends Controller
{

    public function index(Request $request): View
    {
        $result = Article::where('id', $request->id)->get();
        if (Auth::check()) {
            $role = (int)Auth::user()->role;
        } else {
            $role = null;
        }
        return view('articles.index', ['article' => $result[0], 'role' => $role]);
    }

    public function viewAll(ArticleService $articleService): View
    {
        $articles = $articleService->findAllWithPaginate();
        $tags = $articleService->getArticleTags($articleService->findAll());
        return view('articles.all', ['articles' => $articles, 'tags' => $tags]);
    }



    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $result = Article::where('id', $request->id)->get();
            return view('articles.edit', ['article' => $result[0]]);
        }
        if ($request->isMethod('post')) {
            if (!empty($request->id)) {
                if (!empty($request->file())) {
                    Storage::delete('public/images/articles/' . $request->image);
                    $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
                    $code_theme = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
                    $guessExtension_image = $request->file('new_image')->guessExtension();// получили расширение фото
                    //Записываем файлы
                    $request->file('new_image')->storeAs('images/articles', $code_theme . '.' . $guessExtension_image, 'public');

                }

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
            } else {
                $res = ['answer' => 'error'];
            }
            exit(json_encode($res));
        }
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('articles.add');
        }
        if ($request->isMethod('post')) {
            $path_img = '';
            if ($request->file('image')) {
                // Добавим фото в storage public
                $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
                $code_img = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
                $guessExtension_image = $request->file('image')->guessExtension();// получили расширение фото
                $path_img = $code_img . "." . $guessExtension_image;
                $request->file('image')->storeAs('images/articles', $code_img . '.' . $guessExtension_image, 'public');

            }
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
    }

    public function delete(Request $request)
    {
        Article::where('id', $request->id)->delete();
        return redirect()->action('FrontController@view');
    }

    public function address()
    {
        return \view("tests.address");
    }


}
