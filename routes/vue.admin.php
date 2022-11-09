<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Member\AuthenticationController;
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

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'edit']);
        Route::post('/store', [EventController::class, 'store']);
        Route::post('/{id}/update', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
    });
    Route::group(['prefix' => 'member'], function () {
        Route::get('/', [MemberController::class, 'index']);
        Route::get('/{id}', [MemberController::class, 'edit']);
        Route::post('/store', [MemberController::class, 'store']);
        Route::post('/{id}/update', [MemberController::class, 'update']);
        Route::delete('/{id}', [MemberController::class, 'destroy']);
    });
});
