<?php

use App\Http\Controllers\API\AuthController;

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


Route::group(['prefix' => 'v1'], function(){

    // Login Route

    Route::post('login' , [AuthController::class, 'login']);
 
    // Routes for logged users
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function(){


    });
});
