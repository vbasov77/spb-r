<?php


namespace App\Services;


use App\Repositories\KeyRepository;
use App\Repositories\RequestRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService extends Service
{
    private $imgPlService;
    private $keyRepository;
    private $requestRepository;


    public function __construct()
    {
        $this->imgPlService = new ImgPlaceService();
        $this->keyRepository = new KeyRepository();
        $this->requestRepository = new RequestRepository();
    }

    public function addFile(object $file): string
    {
        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
        $codeTheme = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
        $guessExtensionImage = $file->guessExtension();// получили расширение фото
        $fileName = $codeTheme . '.' . $guessExtensionImage;

        //Записываем файлы
        $file->storeAs('images/news', $fileName, 'public');

        return $fileName;
    }

    public function storeFileInServerVk(object $image)
    {
        if (!empty($image)) {
            $accessToken = $this->keyRepository->accessToken();
            $groupId = $this->keyRepository->idGroupVkMaterial();

            // Получение сервера vk для загрузки изображения.
            $urlGetWallUploadServer = 'https://api.vk.com/method/photos.getWallUploadServer';
            $data = [
                'group_id' => $groupId,
                'access_token' => $accessToken,
                'v' => 5.131
            ];

            $server = json_decode($this->requestRepository->post($urlGetWallUploadServer, $data));

            $image = $image->path();
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
                $save = json_decode($this->requestRepository->post($urlSaveWallPhoto, $dataSaveWallPhoto));

                return $save->response[0]->orig_photo->url;
            }

        }
    }

    public function storeFileInPublic(object $image, int $placeId)
    {
        if (!empty($image)) {
            // Допустимые символы для уникального имени файла
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Создаём уникальное имя для файла
            $fileName = substr(str_shuffle($permitted_chars), 0, 16) . '.' . $image->extension();

            // Добавление файла в папку public
            $image->move(public_path('images/places'), $fileName);

            $this->imgPlService->store((string)$fileName, (int)$placeId);

            return $fileName;
        }

    }

    public function destroyImg(array $file)
    {
        File::delete(public_path('images/places/' . $file['path']));
    }

    public function destroyImgStr(string $path)
    {
        File::delete(public_path('images/places/' . $path));
    }

    public function destroyFile(string $fileName)
    {
        Storage::delete('public/folder/' . $fileName);
    }


}