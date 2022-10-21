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
    return view('/auth/login');
});


require __DIR__ . '/auth.php';

//admin
Route::middleware('auth', 'admin')->group(function () {

    Route::view('about', 'about')->name('about');

    // Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/dashboard/user', AdminController::class)->middleware('auth', 'admin');

    Route::get('admin/hotel/{id}', [\App\Http\Controllers\AdminHotelController::class, 'index'])->name('admin.hotel');
    Route::get('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'create'])->name('admin.createroom');
    Route::post('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'createroom'])->name('createroom');
    Route::post('admin/hotel/{id}', [App\Http\Controllers\AdminHotelController::class, 'deleteroom'])->name('deleteroom');
    Route::get('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'edit'])->name('admin.editroom');
    Route::put('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'editroom'])->name('editroom');
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
});

//pegawai
Route::middleware('auth')->group(function () {

    Route::get('hotel/book/{date}/{id}', [\App\Http\Controllers\BookController::class, 'index'])->name('hotel.book');
    Route::post('hotel/book', [\App\Http\Controllers\BookController::class, 'booking'])->name("insertcheckin");

    Route::get('hotel/dashboard', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotel.dashboard');
    Route::POST('hotel/dashboard/checkin', [\App\Http\Controllers\BookController::class, 'checkIn'])->name('hotel.dashboard.checkIn');
    Route::POST('hotel/dashboard/checkout', [\App\Http\Controllers\BookController::class, 'checkOut'])->name('hotel.dashboard.checkOut');

    Route::get('hotel/rooms', [\App\Http\Controllers\HotelController::class, 'rooms'])->name('hotel.rooms');
    Route::get('hotel/shift', [\App\Http\Controllers\ShiftController::class, 'index'])->name('hotel.shift');
});
