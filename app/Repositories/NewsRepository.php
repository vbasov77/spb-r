<?php


namespace App\Repositories;


use App\Models\Booking;
use App\Models\News;
use Illuminate\Support\Facades\DB;


class NewsRepository extends Repository
{

    public function findById(int $id): object
    {
        return News::find($id);
    }

    public function findAll(): object
    {
        return News::where('published', 1)->get();
    }

    public function delete(int $id): void
    {
        News::where("id", $id)->delete();
    }


    public function store(array $data): int
    {
        return News::insertGetId($data);
    }

    public function destroy(int $id): void
    {
        News::where('id', $id)->delete();
    }

    public function publishedNews(int $id): void
    {
        $data = [
            'published' => 1,
        ];
        News::where('id', $id)->update($data);
    }

    public function findVkId(int $id)
    {
        return News::where('id', $id)->value('ids');
    }

}