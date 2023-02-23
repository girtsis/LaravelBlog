<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'index'])->name('index');
Route::get('/post/{post}', [PublicController::class, 'show'])->name('show');
Route::get('/tag/{tag}', [PublicController::class, 'tag'])->name('tag');

Route::get('/pages/page1', [PublicController::class, 'page1'])->name('page1');
Route::get('/pages/page2', [PublicController::class, 'page2'])->name('page2');



Auth::routes(['verify'=> true]);

//Route::get('/home', [PostController::class, 'index'])->name('home');
//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
//Route::post('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
//Route::post('/posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
Route::middleware(['verified', 'auth'])->group(function(){
    Route::resource('posts', PostController::class);
    Route::get('/post/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::post('/post/{post}/comment', [CommentController::class, 'comment'])->name('post.comment');
    Route::post('/post/{post}/comment/{comment}/edit', [CommentController::class, 'edit'])->name('post.comment.edit');
    Route::get('/post/{post}/comment/{comment}/delete', [CommentController::class, 'delete'])->name('post.comment.delete');
});

