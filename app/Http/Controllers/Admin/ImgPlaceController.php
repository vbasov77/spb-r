<?php


declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImgPlace;
use App\Services\FileService;
use App\Services\ImgPlaceService;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ImgPlaceController extends Controller
{
    private $imgPlaceService;
    private $fileService;


    public function __construct()
    {
        $this->imgPlaceService = new ImgPlaceService();
        $this->fileService = new FileService();
    }


    public function create(Request $request)
    {
        if ($request->file('file')) {
            $path = $this->fileService->storeFileInServerVk($request->file('file'));
            $this->imgPlaceService->store($path, (int)$request->id);


            $result = ImgPlace::where('place_id', $request->id)->get();
            foreach ($result as $value) {
                $array[] = $value->path;
            }
            $data = implode('^', $array);
            $fil = (string)$data;
            $res = ['answer' => 'ok', 'images' => (string)$fil];

            exit(json_encode($res));
        }
    }

    public function destroy(Request $request)
    {
        if ($request->get('file')) {
            $file = $request->get('file');
            $this->imgPlaceService->destroy($file['path']);
        }
    }
}
