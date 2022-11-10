<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LogController;
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
    Route::get('admin/hotel/{id}/shift/export/', 'App\Http\Controllers\ShiftController@export')->name('export.shift');

    // Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/dashboard/user', AdminController::class)->middleware('auth', 'admin');
    Route::get('/dashboard/user/{id}', [AdminController::class,'userDetail'])->name('dashboard/user/detail');
    Route::get('/dashboard/log', [LogController::class,'index'])->name('log');
    // Route::post('dashboard/user/{id}', [AdminController::class,"update"])->name("dashboard.user.edit");
    Route::get('admin/hotel/{id}/shift', [\App\Http\Controllers\ShiftController::class, 'index'])->name('admin.shift');
    Route::get('admin/hotel/{id_hotel}/shift/detail/{id}', [\App\Http\Controllers\ShiftController::class, 'show'])->name('admin.shiftdetail');
    Route::get('admin/hotel/{id}', [\App\Http\Controllers\AdminHotelController::class, 'index'])->name('admin.hotel');
    Route::get('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'create'])->name('admin.createroom');
    Route::post('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'createroom'])->name('createroom');
    Route::post('admin/hotel/{id}', [App\Http\Controllers\AdminHotelController::class, 'deleteroom'])->name('deleteroom');
    Route::get('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'edit'])->name('admin.editroom');
    Route::get('admin/hotel/{id_hotel}/detail/{id}', [App\Http\Controllers\AdminHotelController::class, 'detail'])->name('admin.roomdetail');
    Route::put('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'editroom'])->name('editroom');
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
});

//pegawai
Route::middleware('auth')->group(function () {
    Route::get('admin/hotel/{id}/shift/export/', 'App\Http\Controllers\ShiftController@export')->name('export.shiftfinance');

    Route::resource('hotel/asset', AssetController::class);
    Route::post('hotel/asset/create', [\App\Http\Controllers\AssetController::class, 'store'])->name("hotel.asset.store");

    Route::get('hotel/book/{date}/{id}', [\App\Http\Controllers\BookController::class, 'index'])->name('hotel.book');
    Route::post('hotel/book', [\App\Http\Controllers\BookController::class, 'booking'])->name("insertcheckin");

    Route::get('hotel/dashboard', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotel.dashboard');
    Route::POST('hotel/dashboard/checkin', [\App\Http\Controllers\BookController::class, 'checkIn'])->name('hotel.dashboard.checkIn');
    Route::POST('hotel/dashboard/checkout', [\App\Http\Controllers\BookController::class, 'checkOut'])->name('hotel.dashboard.checkOut');

    Route::get('hotel/rooms', [\App\Http\Controllers\HotelController::class, 'rooms'])->name('hotel.rooms');
    Route::get('hotel/shift', [\App\Http\Controllers\HotelController::class, 'shift'])->name('hotel.shift');
  
    Route::get('hotel/struk/{id}', [\App\Http\Controllers\HotelController::class, 'struk'])->name('hotel.struk');
});
