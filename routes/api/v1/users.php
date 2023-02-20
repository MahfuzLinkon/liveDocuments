<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//Route::apiResource('users', UserController::class);


Route::middleware([
    'auth'
])
    ->as('users.')
//    ->prefix('heYBro')
    ->group(function(){
        Route::get('/users', [UserController::class, 'index'])->name('index');
        Route::post('/users', [UserController::class, 'store'])->name('store');
        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('show')
//            ->where('user', '[0-9]+')
            ->whereNumber('user')
            ->withoutMiddleware('auth');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('destroy');
    });




