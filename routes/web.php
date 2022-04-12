<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::get('/', function () {
//     return view("backend.auth.login");
// });

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::Post('login', [AuthController::class, 'login'])->name('login_submit');
Route::get('register', [RegisterController::class, "showReg"])->name('user_register');
Route::post('register', [RegisterController::class, "register"])->name('register_data');
Route::get('logout', [AuthController::class, "logout"])->name('logout');

// Banner
Route::get('banner-list', [BannerController::class, "index"])->name('banner-list');
Route::get('banner-create', [BannerController::class, "create"])->name('banner-create');
Route::post('banner-create', [BannerController::class, "store"])->name('banner-store');
Route::get('banners/{id}', [BannerController::class, "show"])->name('banner_show');
Route::get('banners/edit/{id}', [BannerController::class, "edit"])->name('banner_edit');
Route::put('banners/update/{id}', [BannerController::class, "update"])->name('banner_update');
// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

