<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\TodoController::class, 'index'])->name('dashboard');
    Route::get('/create-task', [App\Http\Controllers\TodoController::class, 'create'])->name('create.task');
    Route::post('/create-task', [App\Http\Controllers\TodoController::class, 'store'])->name('store.task');
    Route::get('/task/{id}/edit', [App\Http\Controllers\TodoController::class, 'edit'])->name('edit.task');
    Route::put('/task/update/{id}', [App\Http\Controllers\TodoController::class, 'update'])->name('update.task');
    Route::delete('/delete/{id}', [App\Http\Controllers\TodoController::class, 'destroy'])->name('delete.task');
    Route::post('/search', [App\Http\Controllers\TodoController::class, 'search'])->name('search.task');
});

