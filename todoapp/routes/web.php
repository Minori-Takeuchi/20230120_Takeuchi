<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/home', [TodoController::class,'index'])->name('index');
Route::post('/create', [TodoController::class,'create']);
Route::post('/update', [TodoController::class,'update']);
Route::post('/delete', [TodoController::class,'delete']);
Route::get('/find', [TodoController::class,'find'])->name('find');
Route::get('/search',[TodoController::class,'getSearch']);
Route::post('/search',[TodoController::class,'search'])->name('search');

Route::post('/findUpdate',[TodoController::class,'findUpdate']);
Route::post('/findDelete',[TodoController::class,'findDelete']);



Route::get('/', function () {
    return view('auth/register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
