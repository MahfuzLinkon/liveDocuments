<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'data' => 'Checking Post',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return new JsonResponse([
            'data' => 'Posted',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return new JsonResponse([
            'data' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        return new JsonResponse([
            'data' => 'Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        return new JsonResponse([
            'data' => 'Deleted',
        ]);
    }
}
