<?php

namespace App\Jobs;

use App\Repositories\KeyRepository;
use App\Services\VkService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WallGroupsPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    private $keyRepository;
    private $vkService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->post = $data;
        $this->keyRepository = new KeyRepository();
        $this->vkService = new VkService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $srcFile = date("Y-m-d-H-i-s"); //Получили для имени нового файла
        $srcFileNameCsv = $srcFile . ".csv"; //Добавили расширение для нового файла
        $fpl = fopen(__DIR__ . "/../../storage/app/public/folder/" . $srcFileNameCsv, "w"); //Открыли новый файл для записи
        $file = __DIR__ . '/../../storage/app/public/folder/wall_groups_news.txt'; //Адрес исходника
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
                'access_token' => $accessToken];
            $cc = $this->vkService->wallGet($data);

            if (!empty($cc['response']['items']) && !empty($cc['response']['count']) > 0 || empty($cc['error'])) {
                $count = count($cc['response']['items']);
                for ($i = 0; $i < $count; $i++) {
                    $post = $cc['response']['items'][$i]['id'];
                    $data_p = $cc['response']['items'][$i]['date'];
                    $date_i = date('Y-m-d', $data_p);
                    $link = $cc['response']['items'][$i]['from_id'];
                    $text = mb_strtolower($cc['response']['items'][$i]['text']);

                    $date = '';
                    if (!empty($text) && $date <= $date_i) {
                        fwrite($fpl, "https://vk.com/club" . $g  /* . ";"
                                        . $text_limit . ";"
                                        . $date_i . ";"
                                        . $g . ";"*/
                            . PHP_EOL);

                    }
                }
            }
        }
        fclose($fpl);
    }

}

