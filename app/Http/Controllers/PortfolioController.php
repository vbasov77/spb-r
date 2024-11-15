<?php


namespace App\Http\Controllers;


use App\Models\Work;
use App\Services\ArticleService;
use App\Services\SliderImgService;

class PortfolioController extends Controller
{
    public function show(SliderImgService $sliderImgService, ArticleService $articleService)
    {
        $works = Work::all()->take(10)->reverse();
        $obj = $sliderImgService->findAll();
        $articles = $articleService->findForFront();

        return view('portfolio', ['works' => $works, 'images' => $obj, 'articles' => $articles]);
    }
}