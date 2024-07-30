<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::get('/index', [MovieController::class, 'index']);
Route::get('/', [MovieController::class, 'index'])->name('movies.index');