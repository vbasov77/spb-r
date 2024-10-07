<?php


namespace App\Services;

use App\Repositories\KeyRepository;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;

class TelegramService extends Service
{
    private $requestRepository;
    private $keyRepository;
    private $token;

    public function __construct()
    {
        $this->requestRepository = new RequestRepository();
        $this->keyRepository = new KeyRepository();
        $this->token = $this->keyRepository->telegramBotMietenToken();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addTelegramPost(Request $request)
    {

        $token = $this->token;
        $chatId = $this->keyRepository->idTgChannel();
        $message = $request->input('text');

        $url = 'https://api.telegram.org/bot' . $token . '/sendMediaGroup';
        $media = [];
        $counterMedia = 1;
        $counterValue = 1;

        $params = [
            'chat_id' => $chatId,
        ];

        if (!empty($request->file('video'))) {
            $media[] = ['type' => 'video', 'media' => "attach://$counterMedia.mp4",
                'caption' => $message];
            $counterMedia++;
            $file = $request->file('video')->path();
            $params["$counterValue.mp4"] = curl_file_create(realpath($file));
            $counterValue++;
        }

        if (!empty($request->file('img'))) {
            $count = count($request->file('img'));

            for ($i = 0; $i < $count; $i++) {
                if ($counterMedia == 1) {
                    $media[] = ['type' => 'photo', 'media' => "attach://$counterMedia.jpg",
                        'caption' => $message];
                } else {
                    $media[] = ['type' => 'photo', 'media' => "attach://$counterMedia.jpg"];
                }
                $counterMedia++;
            }

            for ($l = 0; $l < $count; $l++) {
                $image = $request->file('img')[$l]->path();
                $params["$counterValue.jpg"] = curl_file_create(realpath($image));
                $counterValue++;
            }
        }
        $params['media'] = json_encode($media);

        $messageId = json_decode($this->requestRepository->sendTelegram($url, $params));

        if ($messageId->ok === true) {
            $response = [];

            if (!empty(count($messageId->result))) {
                foreach ($messageId->result as $item) {
                    $response[] = $item->message_id;
                }
            }
            $responseStr = implode('&', $response);

            return ["ok" => true, "id" => $chatId . "_" . $responseStr];
        } else {
            return ["ok" => false, "message" => $messageId->description];
        }

    }

    public function destroyTgPost(string $data)
    {
        $array = json_decode($data, true);
        $post = explode('_', $array['tgPost']);
        $url = 'https://api.telegram.org/bot' . $this->token . '/deleteMessages';
        $ids = explode('&', $post[1]);
        $params = [
            'chat_id' => $post[0],
            'message_ids' => json_encode($ids),
        ];

        $this->requestRepository->post($url, $params);
    }

}