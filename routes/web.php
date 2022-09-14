<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login', function(){
    return response(['status' => 'false', 'message' => 'Unauthorize'])->name('login');
});

Auth::routes();

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories']);
    Route::get('/category/create', [\App\Http\Controllers\HomeController::class, 'createCategory']);
    Route::post('/category/store', [App\Http\Controllers\HomeController::class, 'storeCategory'])->name('create.category');
    Route::get('/category/edit/{id}', [App\Http\Controllers\HomeController::class, 'editCategory'])->name('edit.category');
    Route::post('/category/update/{id}', [App\Http\Controllers\HomeController::class, 'updateCategory'])->name('update.category');
    Route::get('/category/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroyCategory'])->name('delete.category');
    Route::get('/articles', [App\Http\Controllers\HomeController::class, 'articles']);
    Route::get('/article/create', [App\Http\Controllers\HomeController::class, 'createArticle']);
    Route::post('/article/store', [App\Http\Controllers\HomeController::class, 'storeArticle'])->name('create.article');
    Route::get('/article/edit/{id}', [App\Http\Controllers\HomeController::class, 'editArticle'])->name('edit.article');
    Route::post('/article/update/{id}', [App\Http\Controllers\HomeController::class, 'updateArticle'])->name('update.article');
    Route::get('/article/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroyArticle'])->name('delete.article');
}); 
