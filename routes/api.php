<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return [
        'pong' => true
    ];
});

Route::get('/generate', [ApiController::class, 'store']);
Route::get('/posts/{initial}/{final}/{order?}', [ApiController::class, 'getPosts']);
Route::get('/authors/{order?}', [ApiController::class, 'getAuthors']);
