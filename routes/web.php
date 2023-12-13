<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'getPosts']);

Route::get('/posts/write', [PostController::class, 'writePost']) -> middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'getPost']);

Route::post('/posts', [PostController::class, 'createPost']) -> middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'deletePost']) -> middleware('auth');
Route::get('/posts/{id}/edit', [PostController::class, 'editPost']) -> middleware('auth');
Route::patch('/posts/{id}', [PostController::class, 'updatePost']) -> middleware('auth');

// 댓글
Route::post('/posts/{post_id}/comments', [CommentController::class, 'postComment']) -> middleware('auth');
Route::get('/posts/{post_id}/comments', [CommentController::class, 'getComments']);
Route::delete('/comments/{comment_id}', [CommentController::class, 'deleteComment']) -> middleware('auth');
Route::patch('/comments/{comment_id}', [CommentController::class, 'editComment']) -> middleware('auth');