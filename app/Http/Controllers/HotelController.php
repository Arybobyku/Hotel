<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index()
    {
        $idHotel = Auth::user()->id_hotel;
        $hotel = Hotel::where('id',$idHotel)->first();
        return view('employee.dashboard', [
            "hotel" => $hotel,
        ]);
    }

    public function rooms()
    {
        $idHotel = Auth::user()->id_hotel;
        $rooms = Room::where('id_hotel',$idHotel)->get();
        return view('employee.room', [
            "rooms" => $rooms,
        ]);
    }
    public function shift()
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();
        $book = Book::where('id_hotel',$idHotel)->where('id_user', $idUser)->get();
        return view('employee.shift', [
            "books" => $book,
        ]);
    }

}
