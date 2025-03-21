<?php

use App\domains\Posts\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']); // Get all posts
    Route::post('/', [PostController::class, 'store']); // Create a post
    Route::get('{id}', [PostController::class, 'show']); // Get a single post
    Route::put('{id}', [PostController::class, 'update']); // Update a post
    Route::delete('{id}', [PostController::class, 'destroy']); // Delete a post
});
