<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterInventoryController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return 'helo user';
});

// Route::get('/info/php', [InfoController::class, 'showPhpInfo']);
// Route::get('/info/get', [InfoController::class, 'handleGetRequest']);
// Route::post('/info/post', [InfoController::class, 'handlePostRequest']);

// Handle OPTIONS method for CORS preflight requests from localhost
Route::options('{any}', function () {
    return response('', 204)
        ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');

Route::prefix('{company}')
     ->middleware(\App\Http\Middleware\DetectCompany::class)
     ->group(function() {
         Route::post('/register', [AuthController::class, 'register']);
         Route::post('/login', [AuthController::class, 'login']);
         Route::middleware(\App\Http\Middleware\CheckBearerToken::class)
         ->group(function(){
            Route::match(['get', 'post'], '/master/formularium/{action?}/{id?}', [MasterInventoryController::class, 'formularium']);
            Route::match(['get', 'post'], '/master/satuan/{action?}/{id?}', [MasterInventoryController::class, 'satuan']);
         });
     });