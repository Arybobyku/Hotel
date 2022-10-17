<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;

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


require __DIR__ . '/auth.php';

//admin
Route::middleware('auth', 'admin')->group(function () {

    Route::view('about', 'about')->name('about');

    // Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/dashboard/user', AdminController::class)->middleware('auth', 'admin');

    Route::get('hotel/{id}', [\App\Http\Controllers\AdminHotelController::class, 'index'])->name('admin.hotel');
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
});

//pegawai
Route::middleware('auth')->group(function () {
    Route::get('/hotel/book', [\App\Http\Controllers\BookController::class, 'create'])->name('hotel.book');
    Route::post('/hotel/book', [\App\Http\Controllers\BookController::class, 'checkin'])->name("insertcheckin");

    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('hotel/dashboard', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotel.dashboard');
    Route::get('hotel/rooms', [\App\Http\Controllers\HotelController::class, 'rooms'])->name('hotel.rooms');
    Route::get('hotel/shift', [\App\Http\Controllers\HotelController::class, 'shift'])->name('hotel.shift');
});
