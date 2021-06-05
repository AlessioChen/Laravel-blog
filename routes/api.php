<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\TagController;
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


Route::group(['prefix' => 'v1'], function () {

    // Login Route
    Route::post('login', [AuthController::class, 'login']);

    // Register Route
    Route::post('register', [AuthController::class, 'register']);

    // Routes for logged users
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function () {

        // Logout Route
        Route::get('logout', [AuthController::class, 'logout']);

        // Tag user route 
        Route::post('tag', [TagController::class, 'tagUser']);

        // List
        Route::get('tag', [TagController::class, 'getTags']);

        //Resources Routes
        Route::apiResources([
            'posts' => PostController::class,
        ]);
    });
});
