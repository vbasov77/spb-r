<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Services\TelegramService;
use App\Services\VkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NewsController extends Controller
{
    private $newsService;
    private $vkService;
    private $telegramService;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsService = new NewsService();
        $this->vkService = new VkService();
        $this->telegramService = new TelegramService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $news = $this->newsService->findAll();

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('news.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $telegramPostId = $this->telegramService->addTelegramPost($request);

        if ($telegramPostId['ok'] == true) {
            $vkPost = $this->vkService->getWallUploadServer($request);
            $id = $this->newsService->store($request, $vkPost, $telegramPostId['id']);

            return redirect()->route('post', ['id' => $id]);
        } else {
            $message = "Проблема с публикацией в телеграм \n Причина: " . $telegramPostId['message'];

            return redirect()->route('error.message', ['message' => $message]);
        }

    }


    public function show(Request $request): View
    {
        $post = $this->newsService->findById($request->id);
        $images = [];

        if (isset($post->img)) {
            $images = json_decode($post->img);
        }

        return view('news.show', ['post' => $post, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;

            $findIds = $this->newsService->findIds($id);

            $this->vkService->destroyPostVk($findIds);

            $this->telegramService->destroyTgPost($findIds);

            $this->newsService->destroy($id);

            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }

    /**
     * @return View
     */
    public function newsByUserId(): View
    {
        $news = $this->newsService->findByUserId(Auth::id());

        return view('news.index', ['news' => $news]);
    }
}
