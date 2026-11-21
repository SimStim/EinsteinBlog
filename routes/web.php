<?php

use App\Http\Controllers\BlogPostController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('cat/{category}', [BlogPostController::class, 'category'])
    ->name('blog.category');

Route::resource('blog', BlogPostController::class)
    ->parameters(['blog' => 'blogPost']);
