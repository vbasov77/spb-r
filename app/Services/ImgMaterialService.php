<?php


namespace App\Services;


use App\Repositories\ImgMaterialRepository;
use Illuminate\Http\Request;


class ImgMaterialService extends Service
{
    private $imgMaterialRepository;

    /**
     * ImgMailService constructor.
     */
    public function __construct()
    {
        $this->imgMaterialRepository = new ImgMaterialRepository();
    }

    /**
     * @param int $materialId
     * @return mixed
     */
    public function findAllByMaterialId(int $materialId)
    {
        return $this->imgMaterialRepository->findAllByMaterialId($materialId);
    }

    public function findPathsByMaterialId(Request $request)
    {
        return $this->imgMaterialRepository->findPathsByMaterialId($request->id);
    }

}