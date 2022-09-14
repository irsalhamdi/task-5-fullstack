<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('category', [CategoryController::class, 'store'])->name('category.create');
    Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.detail');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('posts', [PostController::class, 'index'])->name('posts');
    Route::post('post', [PostController::class, 'store'])->name('post.create');
    Route::get('post/{id}', [PostController::class, 'show'])->name('post.detail');
    Route::put('post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{id}', [PostController::class, 'destroy'])->name('post.delete');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
