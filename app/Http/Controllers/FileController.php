<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private $fileService;

    /**
     * BookingController constructor.
     */
    public function __construct()
    {
        $this->fileService = new FileService();
    }

    public function readFile(Request $request)
    {
        $file = __DIR__ . "/../../../storage/app/public/folder/" . $request->file;
        $fh = fopen($file, "r");
        $postArray = [];

        while (($row = fgetcsv($fh, 0, ';')) !== false) {
            list($groupId, $postId, $nameGroup, $text, $urlImg, $datePost, $countLikes) = $row;

            $postArray[] = [
                'group_id' => $groupId,
                'post_id' => $postId,
                'name_group' => $nameGroup,
                'text' => $text,
                'url' => $urlImg,
                'date_post' => date("d.m.Y H:m:s", (int)$datePost),
                'count_likes' => $countLikes,
            ];
        }

        return view('parsers.index_wall_gr', ['posts' => $postArray, 'fileName' => $request->file]);

    }


    public function index()
    {
        $files = Storage::files('/public/folder');

        $fileNames = array_map(function ($file) {
            return basename($file); // remove the folder name
        }, $files);

        return view('news.index-files', ['files' => $fileNames]);
    }

    public function destroyFile(Request $request)
    {
        try {
            $this->fileService->destroyFile($request->id);

            exit(json_encode(true));
        } catch (\Exception $e) {
            exit(json_encode($e));
        }
    }


}
