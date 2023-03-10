<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws GeneralJsonException
     */
    public function index(Request $request): ResourceCollection
    {
        $limit = $request->limit ?? 20;
        $posts = Post::query()->paginate($limit);
//        return new JsonResponse([
//            'data' => $posts,
//        ]);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostRepository $repository): PostResource
    {
            $created = $repository->create($request->only([
                'title',
                'body',
                'user_ids',
            ]));
//        $created = DB::transaction(function () use ($request){
//            $created = Post::query()->create([
//                'title' => $request->title,
//                'body' => $request->body,
//            ]);
//
//            $created->users()->sync($request->user_ids);
//            return $created;
//        });


//        return new JsonResponse([
//            'data' => $created,
//        ]);
        return new PostResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
//        return new JsonResponse([
//            'data' => $post,
//        ]);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, PostRepository $repository): PostResource | JsonResponse
    {
//        $update = $post->update([
//            'title' => $request->title ?? $post->title,
//            'body' => $request->body ?? $post->body,
//        ]);
//        if (!$update){
//            return new JsonResponse([
//                'error' => 'Data Not Updated',
//            ], 400);
//        }

        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids',
        ]));

//        return new JsonResponse([
//            'data' => $post,
//        ]);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostRepository $repository): JsonResponse
    {
        $repository->forceDelete($post);
        return new JsonResponse([
            'data' => 'Deleted Successfully',
        ]);
    }
}
