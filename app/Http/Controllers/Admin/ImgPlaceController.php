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
            $id = $request->id;
            $this->fileService->storeFileInPublic($request->file('file'), (int)$id);
            $images = $this->imgPlaceService->findImagesByPlaceId((int)$id);
            foreach ($images as $value) {
                $array[] = $value->path;
            }

            $data = implode(',', $array);
            $file = (string)$data;

            $res = ['answer' => 'ok', 'images' => $file];
        } else {
            $res = ['answer' => 'error', 'mess' => 'Ошибка'];
        }
        exit(json_encode($res));
    }

    public function destroy(Request $request)
    {
        if ($request->get('file')) {
            $file = $request->get('file');
            $this->fileService->destroyImg($file);
            $this->imgPlaceService->destroy($file['path']);

//
//            $res = ['answer' => 'ok', 'images' => gettype($file)];
//            exit(json_encode($res));
        }
    }
}
