<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/search', [App\Http\Controllers\Api\TodoAPIController::class, 'search'])->name('api.search.task');
Route::post('/create-task', [App\Http\Controllers\Api\TodoAPIController::class, 'store'])->name('api.store.task');
Route::post('/task/update/{id}', [App\Http\Controllers\Api\TodoAPIController::class, 'update'])->name('api.update.task');
Route::delete('/delete/{id}', [App\Http\Controllers\Api\TodoAPIController::class, 'destroy'])->name('api.delete.task');
