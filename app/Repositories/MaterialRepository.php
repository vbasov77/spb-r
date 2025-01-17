<?php


namespace App\Repositories;


use App\Models\Material;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class MaterialRepository extends Repository
{

    /**
     * @param string $title
     * @return array
     */
    public function autocomplete(string $title)
    {
        return DB::select("SELECT title  FROM materials WHERE title like lower('%{$title}%');");
    }

    /**
     * @param string $title
     * @param int $objId
     * @return mixed
     */
    public function findByTitleAndObjId(string $title, int $objId)
    {
        return Material::where('title', $title)->where('obj_id', $objId)->first();
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id): void
    {
        Material::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findByIdWithImage(int $id)
    {
        return Material::leftJoin('images_materials', 'materials.id', '=', 'images_materials.material_id')
            ->where('materials.id', $id)
            ->get(['materials.id', 'materials.title', 'materials.obj_id', 'materials.description', 'materials.price',
                'materials.quantity', 'images_materials.path', 'materials.link_to']);
    }

    /**
     * @param int $objId
     * @return mixed
     */
    public function findByObjId(int $objId)
    {
        return Material::where('obj_id', $objId)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return Material::where('id', $id)->first();
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchEveryWhereOnRequest(string $search): array
    {
        return DB::select("select m.*, 
(select i.path from images_materials i where i.material_id = m.id order by i.id limit 1) 
path from materials m
WHERE title like lower('%{$search}%')
OR description like lower('%{$search}%')
");
    }

    /**
     * @param string $search
     * @param int $objId
     * @return array
     */
    public function findItEverywhere(string $search, int $objId)
    {
        return DB::select("select m.*, 
(select i.path from images_materials i where i.material_id = m.id order by i.id limit 1) 
path from materials m
WHERE title like lower('%{$search}%')
OR description like lower('%{$search}%')
OR obj_id = {$objId}
");
    }
}