<?php


namespace App\Repositories;


use App\Models\Comment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Mixed_;

class CommentRepository extends Repository
{

    public function addComment(array $comment)
    {
        return Comment::insertGetId($comment);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function findAllById(int $id): Collection
    {
        return DB::table('comments')->where('recipe_id', $id)
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->orderBy('comments.created_at', 'desc')
            ->get(['name' => 'users.name', 'comments.*']);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        Comment::where('id', $id)->delete();
    }
}