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
        return News::OrderBy('id', 'desc')->paginate(10);;
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

    public function findIds(int $id)
    {
        return News::where('id', $id)->value('ids');
    }

    public function findByUserId(int $userId): object
    {
        return News::where('user_id', $userId)->get();
    }

    public function findForFrontPage(): object
    {
        return News::OrderBy('id', 'desc')->get()->take(4);
    }

}