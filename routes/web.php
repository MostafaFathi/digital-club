<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Website\AuthenticationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return view('website.page');
});
Route::get('/search', function () {
    return view('website.page');
});
Route::get('/login', function () {
    if (auth('member')->check()) return redirect('/');
    return view('website.auth.login');
})->name('login');
Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login.show');
Route::post('/admin/login/store', [AuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::post('/member/login', [AuthenticationController::class, 'login'])->name('member.login');
Route::get('/member/logout', [AuthenticationController::class, 'logout']);
Route::get('/create-account', function () {
    return view('website.page');
});
Route::get('/verify-account', function () {
    return view('website.page');
});
Route::get('/join', function () {
    return view('website.page');
});
Route::get('/members', function () {
    return view('website.page');
});
Route::get('/partners', function () {
    return view('website.page');
});
Route::get('/who-we-are', function () {
    return view('website.page');
});
Route::get('/events', function () {
    return view('website.page');
});
Route::get('/events/live-webinars', function () {
    return view('website.page');
});
Route::get('/events/cad', function () {
    return view('website.page');
});
Route::get('/events/workshop', function () {
    return view('website.page');
});
Route::get('/events/live-webinars/details/{id}', function () {
    return view('website.page');
});
Route::get('/events/cad/details/{id}', function () {
    return view('website.page');
});
Route::get('/events/workshop/details/{id}', function () {
    return view('website.page');
});

Route::get('/logout', [HomeController::class, 'logout'])->name('log_out');


require __DIR__ . '/auth.php';
Route::group([ 'middleware' => ['auth']], function () {
    Route::get('/{prefix?}/{site?}', function () {
        return view('admin.page');
    })->where('site', '[\/\w\.-]*')->where('prefix', 'admin');
});
