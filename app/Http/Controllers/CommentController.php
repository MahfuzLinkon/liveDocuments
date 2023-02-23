<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $limit = $request->limit ?? 20;
        $comments = Comment::query()->paginate($limit);
//        return new JsonResponse([
//            'data' => $comments,
//        ]);
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): CommentResource
    {
        $create = Comment::query()->create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);
//        return new JsonResponse([
//            'data' => $create,
//        ]);
        return new CommentResource($create);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): CommentResource
    {
//        return new JsonResponse([
//            'data' => $comment,
//        ]);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment): JsonResponse | CommentResource
    {
        $update = $comment->update([
//            'user_id' => $request->user_id ?? $comment->user_id,
//            'post_id' => $request->post_id ?? $comment->post_id,
            'body' => $request->body ?? $comment->body,
        ]);
        if (!$update){
            return new JsonResponse([
                'error' => 'Comment Not Updated',
            ], 400);
        }
//        return new JsonResponse([
//            'data' => $comment,
//        ]);
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $delete = $comment->forceDelete();
        if (!$delete){
            return new JsonResponse([
                'error' => 'Resource not deleted',
            ]);
        }
        return new JsonResponse([
            'data' => 'Deleted',
        ]);
    }
}
