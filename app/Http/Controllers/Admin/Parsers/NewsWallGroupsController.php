<?php


namespace App\Http\Controllers\Admin\Parsers;


use App\Http\Controllers\Controller;
use App\Repositories\KeyRepository;
use App\Services\VkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NewsWallGroupsController extends Controller
{
    private $keyRepository;
    private $vkService;


    public function __construct()
    {
        $this->keyRepository = new KeyRepository();
        $this->vkService = new VkService();
    }


    public function showGetNewsWallGroups()
    {
        $date = date("Y-m-d");

        return view('parsers.wallGroups', ['date' => $date]);
    }

    public function storeNewsWallGroups(Request $request)
    {
        $date = strtotime($request->input('date'));
        $srcFile = date("Y-m-d-H-i-s"); //Получили для имени нового файла
        $srcFileNameCsv = $srcFile . ".csv"; //Добавили расширение для нового файла
        $fpl = fopen(__DIR__ . "/../../../../../storage/app/public/folder/" . $srcFileNameCsv, "w"); //Открыли новый файл для записи
        $file = __DIR__ . '/../../../../../storage/app/public/folder/wall_groups_news.txt'; //Адрес исходника

        $fh = fopen($file, "r");//Открыли исходный файл для чтения

        $accessToken = $this->keyRepository->accessToken();
        while (($value = fgetcsv($fh, 0, ';')) !== false) {
            sleep(1);
            $g = $value[0];
            $data = [
                'owner_id' => "-" . $g,
                'count' => 10,
                'offset' => null,
                'filter' => "all",
                'extended' => 1,
                'v' => '5.126',
                'access_token' => $accessToken
            ];
            $postsGroup = $this->vkService->wallGet($data);

            if (!empty($postsGroup->response->items) && !empty($postsGroup->response->count) > 0 || empty($postsGroup->error)) {
                $count = count($postsGroup->response->items);
                for ($i = 0; $i < $count; $i++) {
                    $datePost = $postsGroup->response->items[$i]->date;
                    $postId = $postsGroup->response->items[$i]->id;
                    $groupId = $postsGroup->response->items[$i]->owner_id;
                    $attachments = $postsGroup->response->items[$i]->attachments;
                    $countLikes = $postsGroup->response->items[$i]->likes->count;
                    $nameGroup = $postsGroup->response->groups[0]->name;
                    $image = null;
                    if (!empty(count($attachments))) {
                        foreach ($attachments as $attachment) {
                            if ($attachment->type === "photo") {
                                $image = $attachment->photo->orig_photo->url;
                                break;
                            }
                        }
                    }
                    $text = $postsGroup->response->items[$i]->text;
                    $text = explode("\n", $text);
                    $text = implode(' ', $text);
                    $text = str_replace(';', '', mb_substr($text, 0, 200, 'UTF-8'));

                    if (!empty($text) && $date <= $datePost) {
                        fwrite($fpl, $groupId . ";"
                            . $postId . ";"
                            . $nameGroup . ";"
                            . $text . ";"
                            . $image . ";"
                            . $datePost . ";"
                            . $countLikes . ";"
                            . PHP_EOL);
                    }
                }
            }
        }
        fclose($fpl);

        return redirect()->route("admin.read.file", ['file' => $srcFileNameCsv]);
    }
}