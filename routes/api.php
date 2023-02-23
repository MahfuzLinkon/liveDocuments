<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')
    ->group(function(){
        \App\Helpers\RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');


//        require __DIR__ . '/api/v1/users.php';
//        require __DIR__ . '/api/v1/posts.php';
//        require __DIR__ . '/api/v1/comments.php';
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


