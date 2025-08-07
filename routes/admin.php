<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('categories', CategoryController::class)->names('admin.categories');

Route::resource('tags', TagController::class)->names('admin.tags');

Route::get('datatables/posts', [DatatableController::class, 'posts'])->name('datatable.posts');

Route::get('datatables/users', [DatatableController::class, 'users'])->name('datatable.users');

Route::resource('posts', PostController::class)->names('admin.posts');

Route::resource('users', UserController::class)->names('admin.users')->only(['index', 'edit', 'update']);
