<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [UserController::class, 'index']);

Route::post('/create', [UserController::class, 'store']);

Route::get('/show/{id}', [UserController::class, 'show']);

Route::put('/update/{id}', [UserController::class, 'update']);
