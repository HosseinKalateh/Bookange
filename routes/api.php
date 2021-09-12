<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\BookController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\PublisherController;
use App\Http\Controllers\api\v1\AuthorController;
use App\Http\Controllers\api\v1\TranslatorController;
use App\Http\Controllers\api\v1\auth\AuthController;
use App\Http\Controllers\api\v1\UserController;

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

##############
##############
##############
### auth route
##############
##############
Route::group([
    "prefix" => "v1/auth",
    "middleware" => [
        "throttle:10,1"
    ]
], function () {
    
    ## User Login
    Route::post('login', [AuthController::class, 'login']);

    ## User Register
    Route::post('register', [AuthController::class, 'register']);
});

Route::group([
    "prefix" => "v1/auth",
    "middleware" => [
        "auth:api"
    ]
], function () {

    ## User Logout
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::group(["prefix" => "v1", "middleware" => 'auth:api'], function () {

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
    ##############
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    ##############
    ##############
    ##############
    ### publisher
    ### route
    ##############
    ##############
    Route::apiResource('publishers', PublisherController::class)->only(['index', 'show']);

    ##############
    ##############
    ##############
    ### author
    ### route
    ##############
    ##############
    Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);

    ##############
    ##############
    ##############
    ### translator
    ### route
    ##############
    ##############
    Route::apiResource('translators', TranslatorController::class)->only(['index', 'show']);

    ##############
    ##############
    ##############
    ### user route
    ##############
    ##############
    Route::apiResource('users', UserController::class)->only(['show', 'update']); 

    ##############
    ##############
    ### wishlist
    ### route
    ##############
    ##############
    // Show User Wishlist
    Route::get('users/{user}/wishlist', [UserController::class, 'showWishlist'])->name(user.showWishlist);
});
