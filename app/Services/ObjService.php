<?php


namespace App\Http\Services;


use App\Repositories\ObjRepository;
use App\Services\Service;
use Illuminate\Http\Request;

class ObjService extends Service
{
    private $objRepository;

    /**
     * ObjService constructor.
     */
    public function __construct()
    {
        $this->objRepository = new ObjRepository();
    }


    public function store(Request $request)
    {
        $data = [
            'address' => $request->input('address'),
            'coordinates' => $request->input('coordinates'),
            'count_rooms' => $request->input('count_rooms'),
            'floor' => $request->input('floor'),
            'area' => $request->input('area'),
        ];
        return $this->objRepository->store($data);
    }

    public function findById(int $id): object
    {
        return $this->objRepository->findById($id);
    }
}