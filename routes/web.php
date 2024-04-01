<?php

use Illuminate\Support\Facades\Redis;
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

Route::get('/redis', function () {

    $visits = Redis::incr('visits');

    $visits = Redis::incrBy('visits', 5);

    return $visits;
});

Route::get('/videos/{id}', function () {

    $downloads = Redis::get('videos.{$id}.downloads');

    return view('videos')->withDownloads($downloads);
});


Route::get('/videos/{id}/downloads', function ($id) {

    $downloads = Redis::incr('videos.{$id}.downloads');

    return back();
});
