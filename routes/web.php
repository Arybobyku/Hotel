<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SpendingController;
use Illuminate\Support\Facades\Route;

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
// Route::get('/', function () {
//     return view('welcome');
// });
// // Fallback route
// Route::fallback(function () {
//     return redirect('/');
// });

require __DIR__.'/auth.php';

// admin
Route::middleware('auth', 'admin')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('admin/hotel/{id}/shift/export/', 'App\Http\Controllers\ShiftController@export')->name('export.shift');
    Route::get('admin/hotel/{id}/spending/export/', 'App\Http\Controllers\ShiftSpendingController@export')->name('export.spending');

    // Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::put('/dashboard/charge/{id}/edit', [ChargeController::class, 'update']);
    Route::post('/dashboard/charge/create', [ChargeController::class, 'store']);
    Route::delete('/dashboard/charge/{id}', [ChargeController::class, 'destroy']);
    Route::get('/dashboard/charge/create', [ChargeController::class, 'create'])->name('charge.create');
    Route::get('/dashboard/charge/{id}/edit', [ChargeController::class, 'edit'])->name('charge.edit');
    Route::get('/dashboard/charge', [ChargeController::class, 'index'])->name('charge.index');

    Route::put('/dashboard/platform/{id}/edit', [PlatformController::class, 'update']);
    Route::post('/dashboard/platform/create', [PlatformController::class, 'store']);
    Route::delete('/dashboard/platform/{id}', [PlatformController::class, 'destroy']);
    Route::get('/dashboard/platform/create', [PlatformController::class, 'create'])->name('platform.create');
    Route::get('/dashboard/platform/{id}/edit', [PlatformController::class, 'edit'])->name('platform.edit');
    Route::get('/dashboard/platform', [PlatformController::class, 'index'])->name('platform.index');

    Route::resource('/dashboard/user', AdminController::class)->middleware('auth', 'admin');
    Route::get('/dashboard/user/{id}', [AdminController::class, 'userDetail'])->name('dashboard/user/detail');

    Route::get('/dashboard/log', [LogController::class, 'index'])->name('log');
    // Route::post('dashboard/user/{id}', [AdminController::class,"update"])->name("dashboard.user.edit");
    Route::get('admin/hotel/{id}/shift', [\App\Http\Controllers\ShiftController::class, 'index'])->name('admin.shift');
    Route::get('admin/hotel/shift', [\App\Http\Controllers\ShiftController::class, 'index'])->name('admin.shift');
    Route::delete('admin/hotel/{hotel}/shift/{shift}', [\App\Http\Controllers\ShiftController::class, 'destroy'])->name('book.destroy');
    Route::get('admin/hotel/{id_hotel}/shift/detail/{id}', [\App\Http\Controllers\ShiftController::class, 'show'])->name('admin.shiftdetail');
    Route::get('admin/hotel/{id_hotel}/shift/edit/{id}', [\App\Http\Controllers\ShiftController::class, 'edit'])->name('admin.shiftedit');
    Route::put('admin/hotel/{id_hotel}/shift/edit/{id}', [\App\Http\Controllers\ShiftController::class, 'update'])->name('admin.shiftupdate');

    Route::get('admin/hotel/{id}/shift/data', [\App\Http\Controllers\ShiftController::class, 'getData'])->name('admin.shift.data');

    Route::get('admin/hotel/{id}/spending', [\App\Http\Controllers\ShiftSpendingController::class, 'index'])->name('admin.spending');
    // Route::get('admin/hotel/{hotel_id}/shift/detail/{shift_id}', [ShiftController::class, 'detail'])->name('admin.hotel.shift.detail');

    Route::get('admin/hotel/{id_hotel}/spending/detail/{id}', [\App\Http\Controllers\ShiftSpendingController::class, 'show'])->name('admin.spendingdetail');
    Route::get('admin/hotel/{id}', [\App\Http\Controllers\AdminHotelController::class, 'index'])->name('admin.hotel');
    Route::get('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'create'])->name('admin.createroom');
    Route::post('admin/hotel/{id}/create', [\App\Http\Controllers\AdminHotelController::class, 'createroom'])->name('createroom');
    Route::post('admin/hotel/{id}', [App\Http\Controllers\AdminHotelController::class, 'deleteroom'])->name('deleteroom');
    Route::get('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'edit'])->name('admin.editroom');
    Route::get('admin/hotel/{id_hotel}/detail/{id}', [App\Http\Controllers\AdminHotelController::class, 'detail'])->name('admin.roomdetail');
    Route::put('admin/hotel/{id_hotel}/edit/{id}', [App\Http\Controllers\AdminHotelController::class, 'editroom'])->name('editroom');
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('admin/setting/{id}', [\App\Http\Controllers\SettingController::class, 'adminedit'])->name('admin.setting.edit');
    Route::put('admin/setting/{id}', [\App\Http\Controllers\SettingController::class, 'adminupdate'])->name('admin.setting.update');
});

// pegawai
Route::middleware('auth')->group(function () {
    Route::get('hotel/shift/export/', 'App\Http\Controllers\ShiftController@export')->name('export.shiftfinance');

    Route::resource('hotel/asset', AssetController::class);
    Route::resource('hotel/spending', SpendingController::class);
    Route::post('hotel/asset/create', [\App\Http\Controllers\AssetController::class, 'store'])->name('hotel.asset.store');

    Route::get('hotel/book1/multi', [\App\Http\Controllers\BookController::class, 'indexwalkin'])->name('hotel_book');
    Route::post('hotel/book1/multi/post', [\App\Http\Controllers\BookController::class, 'booking'])->name('insertcheckin2');

    // Route::post('hotel/book1/multi', [\App\Http\Controllers\BookController::class, 'indexwalkin'])->name('hotel.book');

    // Route::get('hotel/book/{date}/{id}', [\App\Http\Controllers\BookController::class, 'indexwalkin'])->name('hotel.book');
    Route::get('hotel/book', [\App\Http\Controllers\BookController::class, 'indexapp'])->name('hotel.book2');
    Route::post('hotel/book', [\App\Http\Controllers\BookController::class, 'booking'])->name('insertcheckin');

    Route::get('hotel/dashboard', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotel.dashboard');
    Route::POST('hotel/dashboard/checkin', [\App\Http\Controllers\BookController::class, 'checkIn'])->name('hotel.dashboard.checkIn');
    Route::POST('hotel/dashboard/checkout', [\App\Http\Controllers\BookController::class, 'checkOut'])->name('hotel.dashboard.checkOut');

    Route::get('hotel/rooms', [\App\Http\Controllers\HotelController::class, 'rooms'])->name('hotel.rooms');
    Route::get('hotel/typebook', [\App\Http\Controllers\HotelController::class, 'typebook'])->name('hotel.typebook');
    Route::get('hotel/shift', [\App\Http\Controllers\HotelController::class, 'shift'])->name('hotel.shift');
    Route::get('hotel/shift/detail/{id}', [\App\Http\Controllers\HotelController::class, 'detailshift']);

    Route::get('hotel/struk/{id}', [\App\Http\Controllers\HotelController::class, 'struk'])->name('hotel.struk');

    Route::get('hotel/appreport', [\App\Http\Controllers\HotelController::class, 'platformreport'])->name('hotel.appreport');

    Route::get('hotel/setting/{id}', [\App\Http\Controllers\SettingController::class, 'edit'])->name('setting.edit');
    Route::put('hotel/setting/{id}', [\App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');



});
