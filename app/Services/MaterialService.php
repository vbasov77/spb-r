<?php


namespace App\Services;

use App\Models\ImgMaterial;
use App\Repositories\KeyRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MaterialService extends Service
{
    private $materialRepository;
    private $keyRepository;
    private $imgMaterialService;

    /**
     * ArchiveService constructor.
     */
    public function __construct()
    {
        $this->materialRepository = new MaterialRepository();
        $this->keyRepository = new KeyRepository();
        $this->imgMaterialService = new ImgMaterialService();
    }

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return $this->materialRepository->findById($id);
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $data = [
            'obj_id' => $request->input('obj_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ];

        $this->materialRepository->update($data, $request->id);
    }

    /**
     * @param string $title
     * @return array
     */
    public function autocomplete(string $title)
    {
        $array = $this->materialRepository->autocomplete($title);
        $titles = [];
        foreach ($array as $value) {
            $titles[] = $value->title;
        }

        return $titles;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function findByTitleAndObjId(Request $request)
    {
        return $this->materialRepository->findByTitleAndObjId($request->input('title'),
            $request->input('obj_id'));
    }

    /**
     * @param Request $request
     * @param object $material
     */
    public function updatePriceAndQuantity(Request $request, object $material)
    {
        $price = $material->price + $request->input('price');
        $quantity = $material->quantity + $request->input('quantity');
        $description = null;
        if (!empty($request->input('description'))) {
            if (!empty($material->description)) {
                $description = $material->description . '; ' . $request->input('description');
            } else {
                $description = $request->input('description');
            }
        }

        $data = [
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description
        ];

        $this->materialRepository->update($data, (int)$material->id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findByIdWithImage(int $id)
    {
        return $this->materialRepository->findByIdWithImage($id);
    }

    /**
     * @param Request $request
     * @param RequestRepository $requestRepository
     * @return mixed
     */
    public function storeImg(Request $request, RequestRepository $requestRepository)
    {
        if ($request->file('file')) {
            $accessToken = $this->keyRepository->accessToken();
            $groupId = $this->keyRepository->idGroupVkMaterial();

            // Получение сервера vk для загрузки изображения.
            $urlGetWallUploadServer = 'https://api.vk.com/method/photos.getWallUploadServer';
            $data = [
                'group_id' => $groupId,
                'access_token' => $accessToken,
                'v' => 5.131
            ];

            $server = json_decode($requestRepository->post($urlGetWallUploadServer, $data));

            $image = $request->file('file')->path();
            if (!empty($server->response->upload_url)) {
                // Отправка изображения на сервер.
                if (function_exists('curl_file_create')) {
                    $curlFile = curl_file_create($image, 'image/jpeg', 'image.jpg');
                } else {
                    $curlFile = '@' . $image;
                }
                $json = json_decode($requestRepository->postFile($server->response->upload_url, $curlFile), true);

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
                $save = json_decode($requestRepository->post($urlSaveWallPhoto, $dataSaveWallPhoto));
                $path = $save->response[0]->orig_photo->url;
                $data = [
                    'material_id' => $request->id,
                    'path' => $path,
                ];
                DB::table('images_materials')->insertGetId($data);

                return $path;
            }
        }
    }

    /**
     * @param int $objId
     * @return mixed
     */
    public function findByObjId(int $objId)
    {
        return $this->materialRepository->findByObjId($objId);
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchEveryWhereOnRequest(string $search)
    {
        return $this->materialRepository->searchEveryWhereOnRequest($search);
    }

    /**
     * @param string $search
     * @param int $objId
     * @return array
     */
    public function findItEverywhere(string $search, int $objId)
    {
        return $this->materialRepository->findItEverywhere($search, $objId);
    }
}