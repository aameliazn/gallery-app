<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerAction')->name('register.action');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logoutAction')->middleware('auth')->name('logout.action');
});

Route::middleware('auth')->group(function () {
    Route::controller(PhotoController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('create', 'create')->name('photo.create');
        Route::post('create', 'store')->name('photo.store');
        Route::get('destroy/{photoId}', 'destroy')->name('photo.destroy');
    });

    Route::controller(AlbumController::class)->group(function () {
        Route::post('album/create', 'store')->name('album.store');
    });

    Route::resource('favorites', FavoriteController::class)->only(['store', 'destroy']);

    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
});
