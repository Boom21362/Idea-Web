<?php

declare(strict_types=1);

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/register',[RegisteredUserController::class,'store']);

Route::get('/login',[SessionsController::class,'create']);
Route::post('/login',[SessionsController::class,'store']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [RegisteredUserController::class, 'delete'])->name('logout');
});
