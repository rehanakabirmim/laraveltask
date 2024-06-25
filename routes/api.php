<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Login Route
Route::controller(UserController::class)->group(function(){
    Route::post('login', 'loginUser');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('user', 'getUserDetail');
        Route::get('logout', 'userLogout');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/inventory/product/all', 'index');
        Route::get('/inventory/product/show/{id}', 'show');
        Route::post('/inventory/product/store', 'store');
        Route::put('/inventory/product/update/{id}', 'update');
        Route::delete('/inventory/product/delete/{id}', 'destroy');
    });
});
