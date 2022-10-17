<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\kuesioner;
use App\Models\Room;
use App\Models\UserAnswere;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function create()
    {
        $idHotel = Auth::user()->id_hotel;
        $from = Book::where('id_hotel', $idHotel);
        $rooms = Room::where('id_hotel', $idHotel)->where('is_available', TRUE)->pluck('name', 'id')->prepend(trans('Pilih Kamar'), '');
        return view('hotel.book',
            compact('rooms'));
    }

    public function checkin(Request $request)
    {
        $userId = Auth::id();
        $hotelId = Auth::user()->id_hotel;

        $request->validate([
            'id_room' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'checkin' => ['required'],
            'checkout' => ['required'],
        ]);

       Book::create([
            'name' => $request->name,
            'id_room' => $request->id_room,
            'id_hotel' => $hotelId,
            'id_user' => $userId,
            'nik' => $request->nik,             
            'checkin' => $request->checkin,             
            'checkout' => $request->checkout,             
        ]);

        return redirect ('hotel/rooms');
    }
}
