<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/posts', [PostController::class, 'index'])->name('post-index');
Route::post('/posts', [PostController::class, 'store'])->name('post-store');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('post-show');
Route::put('/posts/{slug}', [PostController::class, 'update'])->name('post-update');
Route::delete('/posts/{slug}', [PostController::class, 'destroy'])->name('post-destroy');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
