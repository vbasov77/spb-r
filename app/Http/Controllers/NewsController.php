<?php

namespace App\Http\Controllers;

use App\Repositories\KeyRepository;
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
    private $keyRepository;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsService = new NewsService();
        $this->vkService = new VkService();
        $this->telegramService = new TelegramService();
        $this->keyRepository = new KeyRepository();
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


    public function store(Request $request)
    {
        $dataVk = '';
        $img = null;

        if ($request->input('telegram') || $request->input('all')) {
            $telegramPostId = $this->telegramService->addTelegramPost($request);
            if (!$telegramPostId) {
                $message = "Проблема с публикацией в телеграм \n Причина: " . $telegramPostId['message'];

                return redirect()->route('error.message', ['message' => $message]);

            }
        }

        if ($request->input('vk_go') || $request->input('all')) {
            $keyGo = $this->keyRepository->idGroupVk();
            $vkGo = $this->vkService->getWallUploadServer($request, $keyGo);

            if ($vkGo) {
                $dataVk = $vkGo[0]['vkPostId'];
                $img = $vkGo[1]['images'];
            } else {
                return redirect()->route('error.message', ['message' => "Не получен ответ с VK"]);
            }

        }

        if ($request->input('animal') || $request->input('all')) {
            $keyAnimal = $this->keyRepository->idGroupVkAnimal();
            $vkAnimal = $this->vkService->getWallUploadServer($request, $keyAnimal);
            !empty($vkGo) ? $dataVk = $vkGo [0]['vkPostId'] . ',' . $vkAnimal[0]['vkPostId']
                : $dataVk = $vkAnimal[0]['vkPostId'];

            if (!empty($vkAnimal[1]['images'])) {
                $img = $vkAnimal[1]['images'];
            }
        }

        if ($request->input('all') || $request->input('this_site')) {
            $ids = [];
            if (!empty($dataVk)) {
                $ids ['vkPostId'] = $dataVk;
            }

            if (!empty($telegramPostId)) {
                $ids ['tgPost'] = $telegramPostId['id'];
            }
            $id = $this->newsService->store($request, $ids, $img);

            return redirect()->route('post', ['id' => $id]);
        }

        return redirect()->route('create.news');

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
