<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::resource('todos', TodoController::class);
Route::get('/', [TodoController::class, 'index']);

// Route::get('/', function () {
//    return view('welcome');
// });
