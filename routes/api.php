<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'admin'
], function ($router) {
    Route::post('/login', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin.verify']], function() {
        Route::get('/check', [AdminController::class, 'check']);
        Route::get('/logout', [AdminController::class, 'logout']);
        Route::get('/getRegisteredPag/{id}', [AdminController::class, 'getUsers']);
        Route::get('/getRegistered', [AdminController::class, 'getUser']);
//        Route::post('/getAverageByOption/{id}', [AdminController::class, 'getAverage']);
        Route::get('/getNumberByOption/{id}', [AdminController::class, 'getNumber']);
    });
});

Route::group([
    'prefix' => '/user'
], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::group(['middleware' => ['user.verify']], function() {


    });
});
