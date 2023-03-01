<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



if (\Illuminate\Support\Facades\App::environment('local')){
//    Route::get('/playground', function (){
//        $user = \App\Models\User::factory()->make();
//        \Illuminate\Support\Facades\Mail::to($user)
//            ->send(new \App\Mail\WelcomeMail($user));
//        return null;
////        return (new \App\Mail\WelcomeMail(\App\Models\User::factory()->make()))->render();
//    });
}
