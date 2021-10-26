<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/view/{id}', [BlogController::class, 'view'])->name('blog.view');

Route::resource('/admin/blogs', \App\Http\Controllers\Admin\BlogController::class)->names('admin.blogs');
Route::resource('/comments', CommentController::class)->names('comments');

