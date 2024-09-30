<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Services\VkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NewsController extends Controller
{
    private $newsService;
    private $vkService;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsService = new NewsService();
        $this->vkService = new VkService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        $vkPost = $this->vkService->getWallUploadServer($request);
        $id = $this->newsService->store($request, $vkPost);

        return redirect()->route('post', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id): View
    {
        $post = $this->newsService->findById($id);
        $images = [];

        if(isset($post->img)){
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
            $postVkId = $this->newsService->findVkId($id);

            $this->vkService->destroyPost($postVkId);

            $this->newsService->destroy($id);

            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }
}
