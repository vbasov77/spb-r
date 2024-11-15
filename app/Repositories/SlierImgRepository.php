<?php


namespace App\Repositories;


use App\Models\SliderImg;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class SlierImgRepository extends Repository
{

    public function findAll()
    {
        return SliderImg::orderBy("id", "desc")->get();
    }

    public function create(string $path)
    {
        SliderImg::insert([
            'path' => $path
        ]);
    }

    public function delete(string  $path)
    {
        SliderImg::where('path', $path)->delete();
    }


}