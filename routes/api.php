<?php

use App\Http\Controllers\Website\AuthenticationController;
use App\Http\Controllers\Website\EventController;
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

Route::group(['prefix' => 'website'], function () {
    Route::group(['prefix' => 'member'], function () {
        Route::post('/register', [AuthenticationController::class, 'register']);
    });
    Route::group(['prefix' => 'event'], function () {
        Route::get('/{type}', [EventController::class, 'index']);
        Route::get('/{id}/show', [EventController::class, 'show']);
        Route::get('/search/query', [EventController::class, 'search']);
        Route::post('/{id}/register', [EventController::class, 'register'])->middleware('auth:member');
    });
});
