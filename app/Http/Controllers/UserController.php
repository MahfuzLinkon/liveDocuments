<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Throwable;

/**
 *
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return UserResource::collection(User::query()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserRepository $repository): UserResource
    {
        $created = $repository->create($request->only([
            'name',
            'email',
            'password',
        ]));
//        return new JsonResponse([
//            'data' => 'Posted',
//        ]);
        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, UserRepository $repository): UserResource
    {
        $updated = $repository->update($user, $request->only([
            'name',
            'email',
        ]));
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(User $user, UserRepository $repository): JsonResponse
    {
        $repository->forceDelete($user);
        return new JsonResponse([
            'data' => 'Deleted',
        ]);
    }
}
