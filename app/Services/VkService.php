<?php


namespace App\Services;


use App\Repositories\KeyRepository;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;


class VkService extends Service
{
    private $requestRepository;
    private $keyRepository;

    public function __construct()
    {
        $this->requestRepository = new RequestRepository();
        $this->keyRepository = new KeyRepository();
    }

    public function wallGet(array $data)
    {

        $url = "https://api.vk.com/method/wall.get";
        $params = [
            'owner_id' => $data ['owner_id'],
            'count' => $data ['count'],
            'offset' => $data ['offset'],
            'filter' => $data ['filter'],
            'extended' => $data ['extended'],
            'access_token' => $data ['access_token'],
            'v' => $data ['v'],
        ];

        return json_decode($this->requestRepository->post($url, $params));
    }


    public function getWallUploadServer(Request $request)
    {
        $groupId = $this->keyRepository->idGroupVk();
        $accessToken = $this->keyRepository->accessToken();
        $message = $request->input('text');
        $imagesStr = '';

        // Получение сервера vk для загрузки изображения.
        $urlGetWallUploadServer = 'https://api.vk.com/method/photos.getWallUploadServer';
        $data = [
            'group_id' => $groupId,
            'access_token' => $accessToken,
            'v' => 5.131
        ];
        $server = json_decode($this->requestRepository->post($urlGetWallUploadServer, $data));
        $files = [];

        if (!empty($request->file('video'))) {
            $video = $this->saveVideoInServer($request->file('video'));
            $files[] = 'video' . $video->owner_id . "_" . $video->video_id;
        }

        if (!empty($request->file('img'))) {
            $count = count($request->file('img'));

            for ($i = 0; $i < $count; $i++) {
                $image = $request->file('img')[$i]->path();
                if (!empty($server->response->upload_url)) {

                    // Отправка изображения на сервер.
                    if (function_exists('curl_file_create')) {
                        $curlFile = curl_file_create($image, 'image/jpeg', 'image.jpg');
                    } else {
                        $curlFile = '@' . $image;
                    }
                    $json = json_decode($this->requestRepository->postFile($server->response->upload_url, $curlFile), true);

                    // Сохранение фото в группе.
                    $urlSaveWallPhoto = 'https://api.vk.com/method/photos.saveWallPhoto';
                    $dataSaveWallPhoto = [
                        'group_id' => $groupId,
                        'server' => $json['server'],
                        'photo' => stripslashes($json['photo']),
                        'hash' => $json['hash'],
                        'access_token' => $accessToken,
                        'v' => 5.131
                    ];
                    $save[] = json_decode($this->requestRepository->post($urlSaveWallPhoto, $dataSaveWallPhoto));
                }
            }
            $countImages = count($save);

            for ($l = 0; $l < $countImages; $l++) {
                $files[] = 'photo' . $save[$l]->response[0]->owner_id . '_' . $save[$l]->response[0]->id;
            }
        }
        $imagesStr = implode(',', $files);
        // Отправляем сообщение.
        $urlWallPost = "https://api.vk.com/method/wall.post";
        $params = [
            'access_token' => $accessToken,
            'owner_id' => '-' . $groupId,
            'from_group' => 1,
            'message' => $message,
            'attachments' => $imagesStr,
            'v' => '5.131',
        ];
        $response = json_decode($this->requestRepository->post($urlWallPost, $params));

        if (!empty($response->response->post_id)) {
            // Получаем ссылки на фото поста VK

            $urlPhotosGet = 'https://api.vk.com/method/wall.getById';
            $dataPhotosGet = [
                'access_token' => $accessToken,
                'v' => 5.199,
                'posts' => '-' . $groupId . '_' . $response->response->post_id,
            ];
            $getPost = json_decode($this->requestRepository->post($urlPhotosGet, $dataPhotosGet));

            // Записываем урлы для отображения фото на сайте в базу
            if (!empty(count($getPost->response->items[0]->attachments))) {
                foreach ($getPost->response->items[0]->attachments as $value) {
                    if (!empty($value->photo->orig_photo->url)) {
                        $imagesPost[] = $value->photo->orig_photo->url;
                    }
                }
                $post[] = ['vkPostId' => $groupId . '_' . $response->response->post_id];
                if (!empty($imagesPost)) {
                    $post[] = ['images' => collect($imagesPost)->toJson()];
                }

                return $post;
            }
        }

        return null;
    }

    /**
     * @param object $file
     * @return mixed
     */
    public function saveVideoInServer(object $file)
    {
        $url = "https://api.vk.com/method/video.save";
        $params = [
            'access_token' => $this->keyRepository->accessToken(),
            'v' => 5.199,
            'name' => 'Name of the video',
            'description' => 'A comprehensive description of our first video.',
            'group_id' => $this->keyRepository->idGroupVk(),
            'no_comments' => 0
        ];
        $curlResult = json_decode($this->requestRepository->post($url, $params));
        $parameters = ['video_file' => curl_file_create($file, 'video/mp4', 'video.mp4')];
        $curlResult = json_decode($this->requestRepository->sendTelegram($curlResult->response->upload_url, $parameters));

        return $curlResult;

    }

    public function destroyPostVk(string $data)
    {
        $url = 'https://api.vk.com/method/wall.delete';
        $array = json_decode($data, true);
        $post = explode('_', $array['vkPostId']);
        $params = [
            'access_token' => $this->keyRepository->accessToken(),
            'owner_id' => '-' . $post[0],
            'post_id' => $post[1],
            'v' => 5.199
        ];

        $this->requestRepository->post($url, $params);
    }

}