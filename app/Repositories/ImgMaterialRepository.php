<?php


namespace App\Repositories;


use App\Models\ImgMaterial;

class ImgMaterialRepository extends Repository
{
    /**
     * @param int $materialId
     * @return mixed
     */
    public function findAllByMaterialId(int $materialId)
    {
        return ImgMaterial::where('material_id', $materialId)->get();
    }

    public function findPathsByMaterialId(int $materialId)
    {
        return ImgMaterial::where('material_id', $materialId)->pluck('path');
    }


}