<?php


namespace App\Repositories;


use App\Models\Recipe;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RecipeRepository extends Repository
{
    /**
     * @param array $elem
     * @return int
     */
    public function store(array $elem): int
    {
        return Recipe::insertGetId($elem);
    }

    /**
     * @param $recipe
     */
    public function update($recipe): void
    {
        Recipe::where('id', $recipe['id'])->update($recipe);
    }

    /**
     * @return Recipe[]
     */
    public function findAll(): object
    {
        return Recipe::OrderBy('id', 'desc')->paginate(10);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Recipe::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param string $elem
     */
    public function updateElements(int $id, string $elem): void
    {
        Recipe::where('id', $id)->update(['elements' => $elem]);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        Recipe::where('id', $id)->delete();
    }

    /**
     * @param string $search
     * @return LengthAwarePaginator
     */
    public function searchEveryWhereOnRequest(string $search)
    {
        return DB::table('recipe')->where("title", 'LIKE', "%$search%")->orWhere("description", 'LIKE', "%$search%")
            ->orWhere("elements", 'LIKE', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
    }
}