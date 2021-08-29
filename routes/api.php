<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\BookController;
use App\Http\Controllers\api\v1\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v1"], function () {

	##############
    ##############
    ##############
    ### book route
    ##############
    ##############
    Route::apiResource('books', BookController::class)->only(['index', 'show']);

    ##############
    ##############
    ##############
    ### category
    ###	route
    ##############
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
});
