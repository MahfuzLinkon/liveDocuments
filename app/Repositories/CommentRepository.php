<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Exception;

class CommentRepository extends BaseRepository
{

    public function create(array $attribute)
    {
        return DB::transaction(function () use ($attribute){
            $created = Comment::query()->create([
                'user_id' => data_get($attribute, 'user_id'),
                'post_id' => data_get($attribute, 'post_id'),
                'body' => data_get($attribute, 'body'),
            ]);
//            if (!$created){
//                throw new Exception('comment not created');
//            }
            throw_if(!$created, GeneralJsonException::class, 'failed to create comment');

            return $created;
        });

    }

    public function update($comment, array $attribute)
    {
        return DB::transaction(function () use ($comment, $attribute){
            $updated = $comment->update([
                'user_id' => data_get($attribute, 'user_id', $comment->user_id),
                'post_id' => data_get($attribute, 'post_id' , $comment->post_id),
                'body' => data_get($attribute, 'body' , $comment->body),
            ]);
//            if (!$updated){
//                throw new Exception('comment not updated');
//            }
            throw_if(!$updated, GeneralJsonException::class, 'failed to update comment');
            return $comment;
        });
    }

    public function forceDelete($comment)
    {
        return DB::transaction(function () use($comment){
            $deleted = $comment->forceDelete();
//            if (!$deleted){
//                throw new Exception('comment not deleted');
//            }
            throw_if(!$deleted, GeneralJsonException::class, 'failed to delete comment');
            return $deleted;
        });
    }
}
