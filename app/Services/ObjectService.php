<?php


namespace App\Services;


use App\Http\Requests\Objects\CreateObjRequest;
use App\Repositories\ObjRepository;
use Illuminate\Http\Request;

class ObjectService extends Service
{
    private $objRepository;

    /**
     * ObjService constructor.
     */
    public function __construct()
    {
        $this->objRepository = new ObjRepository();
    }


    public function store(CreateObjRequest $request)
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