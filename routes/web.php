<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArtworkController;

Route::resource('categories', CategoryController::class);
Route::resource('artworks', ArtworkController::class);