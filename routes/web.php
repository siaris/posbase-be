<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info/php', [InfoController::class, 'showPhpInfo']);
Route::get('/info/get', [InfoController::class, 'handleGetRequest']);
Route::post('/info/post', [InfoController::class, 'handlePostRequest']);
