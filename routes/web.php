<?php

use Illuminate\Support\Facades\Route;
use Gallery\Gallery\Http\Controllers\AlbumController;
use Gallery\Gallery\Http\Controllers\PhotoController;

Route::resource('albums', AlbumController::class)->only([
    'index', 'show', 'create', 'store', 'destroy'
]);

Route::resource('photos', PhotoController::class);

Route::get('/photos/create/{id}', [PhotoController::class, 'create'])->name('photos.create.id');
