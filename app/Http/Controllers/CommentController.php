<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
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
    public function store(Request $request, CommentRepository $repository): CommentResource
    {
//        $created = Comment::query()->create([
//            'user_id' => $request->user_id,
//            'post_id' => $request->post_id,
//            'body' => $request->body,
//        ]);

        $created = $repository->create($request->only([
            'user_id',
            'post_id',
            'body',
        ]));
//        return new JsonResponse([
//            'data' => $create,
//        ]);
        return new CommentResource($created);
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
    public function update(Request $request, Comment $comment, CommentRepository $repository): JsonResponse | CommentResource
    {
//        $update = $comment->update([
////            'user_id' => $request->user_id ?? $comment->user_id,
////            'post_id' => $request->post_id ?? $comment->post_id,
//            'body' => $request->body ?? $comment->body,
//        ]);
//        if (!$update){
//            return new JsonResponse([
//                'error' => 'Comment Not Updated',
//            ], 400);
//        }
        $comment = $repository->update($comment, $request->only([
            'user_id',
            'post_id',
            'body',
        ]));

//        return new JsonResponse([
//            'data' => $comment,
//        ]);
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, CommentRepository $repository): JsonResponse
    {
//        $delete = $comment->forceDelete();
//        if (!$delete){
//            return new JsonResponse([
//                'error' => 'Resource not deleted',
//            ]);
//        }
        $repository->forceDelete($comment);
        return new JsonResponse([
            'data' => 'Deleted',
        ]);
    }
}
