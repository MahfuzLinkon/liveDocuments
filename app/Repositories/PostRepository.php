<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attribute)
    {
        return  DB::transaction(function () use ($attribute){
            $created = Post::query()->create([
                'title' => data_get($attribute, 'title', 'Untitled'),
                'body' => data_get($attribute, 'body', 'Untitled'),
            ]);
//            if (!$created){
//                throw new Exception('failed to create');
//            }
            throw_if(!$created, GeneralJsonException::class, 'failed to create post');
            if ($userIds = data_get($attribute, 'user_ids')){
                $created->users()->sync(data_get($attribute, $userIds));
            }
            return $created;
        });
    }

    /**
     * @throws Exception
     */
    public function update($post, array $attribute)
    {
        return DB::transaction(function () use ($post, $attribute){
            $updated = $post->update([
                'title' => data_get($attribute, 'title', $post->title),
                'body' => data_get($attribute, 'body', $post->body),
            ]);

//            if (!$updated){
//                throw new Exception('failed to update post');
//            }
            throw_if(!$updated, GeneralJsonException::class, 'failed to update post');

            if ($userIds = data_get($attribute, 'user_ids')){
                $post->users()->sync($userIds);
            }
            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use ($post){
            $deleted = $post->forceDelete();
//            if (!$deleted){
//                throw new Exception('cannot be delete');
//            }
            throw_if(!$deleted, GeneralJsonException::class, 'failed to delete post');
            return $deleted;
        });
    }
}
