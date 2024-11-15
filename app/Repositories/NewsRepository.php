<?php


namespace App\Repositories;


use App\Models\Booking;
use App\Models\News;
use Illuminate\Support\Facades\DB;


class NewsRepository extends Repository
{

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return News::find($id);
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return News::OrderBy('id', 'desc')->paginate(10);
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        News::where("id", $id)->delete();
    }

    /**
     * @param array $data
     * @return int
     */
    public function store(array $data): int
    {
        return News::insertGetId($data);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        News::where('id', $id)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findIds(int $id)
    {
        return News::where('id', $id)->value('ids');
    }

    /**
     * @param int $userId
     * @return object
     */
    public function findByUserId(int $userId): object
    {
        return News::where('user_id', $userId)->OrderBy('id', 'desc')->paginate(10);
    }

    /**
     * @return object
     */
    public function findForFrontPage(): object
    {
        return News::OrderBy('id', 'desc')->get()->take(4);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id): void
    {
        News::where('id', $id)->update($data);
    }

}