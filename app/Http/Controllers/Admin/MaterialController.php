<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\ImgMaterial;
use App\Repositories\KeyRepository;
use App\Repositories\RequestRepository;
use App\Services\ImgMailService;
use App\Services\ImgMaterialService;
use App\Services\MaterialService;
use App\Services\VkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Illuminate\View\View;

class MaterialController extends Controller
{
    private $materialService;
    private $keyRepository;
    private $vkService;
    private $imgMaterialService;

    /**
     * MaterialController constructor.
     */
    public function __construct()
    {
        $this->materialService = new MaterialService();
        $this->keyRepository = new KeyRepository();
        $this->vkService = new VkService();
        $this->imgMaterialService = new ImgMaterialService();
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = $this->materialService->findByObjId($request->id);

        return \view('material.index', ['data' => $data, 'objId' => $request->id]);
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request): View
    {
        !empty($request->message) ? $message = $request->message : $message = null;

        return view('material.create', ['message' => $message]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $material = $this->materialService->findByTitleAndObjId($request);
        $message = "Материал " . $request->input('title') . " добавлен";
        if (isset($material)) {
            $this->materialService->updatePriceAndQuantity($request, $material);

            return redirect()->route('admin.edit.material', ['message' => $message, 'id' => $material->id]);
        } else {
            $newMaterial = new Material($request->except('_token', 'list'));
            if ($newMaterial->save()) {
                return redirect()->route('admin.edit.material', ['message' => $message, 'id' => $newMaterial->id]);
            }
        }

    }


    public function show(Request $request)
    {
        $material = $this->materialService->findById($request->id);
        $images = $this->imgMaterialService->findAllByMaterialId($request->id);

        return \view('material.show', ['material' => $material, 'images' => $images]);
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        !empty($request->message) ? $message = $request->message : $message = null;
        $material = $this->materialService->findByIdWithImage($request->id);
        $images = $this->imgMaterialService->findPathsByMaterialId($request);

        return view('material.edit', ['material' => $material[0], 'message' => $message, 'images' => $images]);
    }


    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        try {
            $this->materialService->update($request);
            $res = ['answer' => 'ok'];

            exit(json_encode($res));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param Request $request
     */
    public function autocomplete(Request $request)
    {
        $result = $this->materialService->autocomplete($request->title);

        exit(json_encode($result));
    }

    public function storeImg(Request $request, RequestRepository $requestRepository)
    {
        if ($request->file('file')) {
            $path = $this->materialService->storeImg($request, $requestRepository);

            $res = ['answer' => 'ok', 'images' => (string)$path];

            exit(json_encode($res));
        }
    }

    /**
     * @param Request $request
     */
    public function destroyImg(Request $request)
    {
        if ($request->file) {
            ImgMaterial::where('path', $request->file)->delete();
        }

    }

    /**
     * @return Factory|View
     */
    public function findItEverywhere()
    {
        return \view('material.find_it_everywhere');
    }

}
