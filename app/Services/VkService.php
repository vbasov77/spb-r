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


    public function getWallUploadServer(Request $request)
    {
        $groupId = 227627516;
        $accessToken = $this->keyRepository->accessToken();
        $title = $request->input('title');
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

        if ($request->file('img')) {
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
            $images = [];

            for ($l = 0; $l < $countImages; $l++) {
                $images[] = 'photo' . $save[$l]->response[0]->owner_id . '_' . $save[$l]->response[0]->id;
            }

            $imagesStr = implode(',', $images);
        }

        // Отправляем сообщение.
        $urlWallPost = "https://api.vk.com/method/wall.post";
        $params = [
            'access_token' => $accessToken,
            'owner_id' => '-' . $groupId,
            'from_group' => 1,
            'message' => $title . "\n\n" . $message,
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

            if (!empty(count($getPost->response->items[0]->attachments))) {
                foreach ($getPost->response->items[0]->attachments as $value) {
                    $imagesPost[] = $value->photo->orig_photo->url;
                }
                $post[] = ['vkPostId' => $groupId . '_' . $response->response->post_id];
                $post[] = ['images' => collect($imagesPost)->toJson()];

                return $post;
            }
        }

        return null;
    }

    public function destroyPost(string $data)
    {
        $url = 'https://api.vk.com/method/wall.delete';
        $post = explode('_', $data);
        $params = [
            'access_token' => $this->keyRepository->accessToken(),
            'owner_id' => '-' . $post[0],
            'post_id' => $post[1],
            'v' => 5.199
        ];

        $this->requestRepository->post($url, $params);
    }

}