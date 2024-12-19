<?php

namespace App\Http\Controllers;

use App\Services\ImgPlaceService;
use App\Services\TopPlaceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TopPlacesController extends Controller
{
    private $topPlaceService;
    private $imgPlaceService;

    public function __construct()
    {
        $this->topPlaceService = new TopPlaceService();
        $this->imgPlaceService = new ImgPlaceService();
    }

    /**
     * View
     */
    public function index(): View
    {
        $places = $this->topPlaceService->findAllWithFirstPhoto();

        return \view('top_places.index', ['places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('top_places.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $postId = $this->topPlaceService->store($request);

        return redirect()->route('show.place', ['id' => $postId]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request
     * @return View
     */
    public function show(Request $request): View
    {
        $id = $request->id;
        $place = $this->topPlaceService->findById($id);
        if ($place) {
            $images = $this->imgPlaceService->findImagesByPlaceId($id);
            return view('top_places.show', ['place' => $place, 'images' => $images]);
        }
        $message = "Страницы не существует";
        return \view('errors.error_message', ['message' => $message]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = $this->topPlaceService->findById($id);
        if (!$data) {
            $message = "Материала не существует";
            return \view('errors.error_message', ['message' => $message]);
        }
        $images = $this->imgPlaceService->findImagesByPlaceId($id);

        return \view('top_places.edit', ['data' => $data, 'images' => $images]);
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        try {
            $this->topPlaceService->update($request);
            $res = ['answer' => 'ok'];

            exit(json_encode($res));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        try {
            $this->topPlaceService->destroy($request->id);

            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }

    }
}
