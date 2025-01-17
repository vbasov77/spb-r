<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objects\CreateObjRequest;
use App\Models\Obj;
use App\Services\ObjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ObjController extends Controller
{
    private $objService;

    /**
     * ObjController constructor.
     */
    public function __construct()
    {
        $this->objService = new ObjectService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('objects.create');
    }


    public function store(CreateObjRequest $request)
    {
        $id = $this->objService->store($request);

        return redirect()->route('admin.edit.obj', ['id' => $id]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $obj = $this->objService->findById($request->id);

        return view('objects.show', ['obj' => $obj]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $obj = $this->objService->findById($request->id);

        return view('objects.edit', ['obj' => $obj[0]]);
    }


    public function update(Request $request)
    {
        dd($_POST);
    }


    public function destroy($id)
    {
        //
    }

    /**
     * @return Factory|View
     */
    public function getObj()
    {
        $obj = Obj::all();
        return \view('objects.get_obj', ['obj' => $obj]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        return redirect()->route('admin.index.material', ['id' => $request->input('id')]);
    }
}
