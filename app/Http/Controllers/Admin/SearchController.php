<?php


declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MaterialService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $materialService;

    public function __construct()
    {
        $this->materialService = new MaterialService();
    }

    public function search(Request $request)
    {
        if (!empty(session('search'))) {
            $request->session()->forget('search');
            $request->session()->save();
        }
        $request->session()->put('search', $request->title);
        $request->session()->save();
        $search = $request->input("title");
        $objId = (int) $request->objId;

        if (mb_strlen($search) > 3) {
            $search = mb_substr($search, 0, -2);
        }
        $objId != 0 ?
            $materials = $this->materialService->searchEveryWhereOnRequest($search) :
            $materials = $this->materialService->findItEverywhere($search, $objId);

        return view('search.materials', ['materials' => $materials]);
    }

    public function deleteSession(Request $request)
    {
        $request->session()->forget('search');
        $request->session()->save();
        $session = session('search');
        $res = ['session' => $session];

        exit(json_encode($res));
    }

}
