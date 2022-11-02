<?php

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

Route::group(['prefix' => 'website'], function () {
    Route::group(['prefix' => 'member'], function () {
        Route::post('/register', [AuthenticationController::class, 'register']);
    });
});
