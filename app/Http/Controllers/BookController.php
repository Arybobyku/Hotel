<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Log;
use App\Models\kuesioner;
use App\Models\Room;
use App\Models\UserAnswere;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $room = Room::where('id', $request->id)->first();
        return view('employee.book', ['room' => $room, 'date' => $request->date]);
    }

    public function checkIn(Request $request)
    {
        $date = date('Y-m-d');
        Book::where('id', $request->id_booking)->update([
            'checkIn' => $date,
        ]);
        return redirect('hotel/dashboard');
    }

    public function checkOut(Request $request, Book $book)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $date = date('Y-m-d');
        Book::where('id', $request->id_booking)->update([
            'checkOut' => $date,
        ]);
        Log::create([
            'activity' => "$nameUser Melakukan   Checkout Nomor Transaksi $book->nota",
            'id_hotel' => $hotelId,
        ]);
        return redirect('hotel/dashboard');
    }

    public function booking(Request $request)
    {
        $userId = Auth::id();
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $request->validate([
            'id_room' => ['required', 'integer'],
            'guestname' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'nota' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
        ]);

        $date=date_create($request->booking);
        date_add($date,date_interval_create_from_date_string(($request->jumlah_hari-1)." days"));
        $dateBookingEnd = date_format($date,"Y-m-d");

        Book::create([
            'guestname' => $request->guestname,
            'id_room' => $request->id_room,
            'id_hotel' => $hotelId,
            'id_user' => $userId,
            'nik' => $request->nik,
            'nota' => $request->nota,
            'price' => $request->price,
            'book_date' => $request->booking,
            'book_date_end' => $dateBookingEnd,
            'days' => $request->jumlah_hari,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ]);
        
        Log::create([
            'activity' => "$nameUser Membuat Reservation Nomor Transaksi $request->nota",
            'id_hotel' => $hotelId,
        ]);
        return redirect('hotel/rooms');
    }
}
