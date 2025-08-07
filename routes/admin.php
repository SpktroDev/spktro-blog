<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('categories', CategoryController::class)->except(['show'])->names('admin.categories');

Route::resource('tags', TagController::class)->except(['show'])->names('admin.tags');

Route::get('datatables/posts', [DatatableController::class, 'posts'])->name('datatable.posts');

Route::get('datatables/users', [DatatableController::class, 'users'])->name('datatable.users');

Route::resource('posts', PostController::class)->except(['show'])->names('admin.posts');

Route::resource('users', UserController::class)->names('admin.users')->only(['index', 'edit', 'update']);
