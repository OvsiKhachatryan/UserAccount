<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function () {
    Route::post('create/moderator', 'createModerator')->middleware('check.role:admin');
    Route::post('block/user', 'blockUser')->middleware('check.role:admin');
});

Route::middleware('auth:sanctum')->controller(PostController::class)->group(function () {
    Route::get('{locale}/get/posts', 'get')->middleware('locale')->middleware('check.role:user');
    Route::post('create/post', 'create')->middleware('check.role:user');
    Route::post('update/post', 'update')->middleware('check.role:user');
    Route::post('delete/post', 'delete')->middleware('check.role:moderator,admin');
});

Route::middleware('auth:sanctum')->controller(CommentController::class)->group(function () {
    Route::post('create/comment', 'create')->middleware('check.role:user');
    Route::post('delete/comment', 'delete')->middleware('check.role:moderator,admin');
});

