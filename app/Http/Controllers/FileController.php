<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

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
                'date_post' => date("d.m.Y H:m:s", (int) $datePost),
                'count_likes' => $countLikes,
            ];
        }

        return view('parsers.index_wall_gr', ['posts' => $postArray]);

    }


}
