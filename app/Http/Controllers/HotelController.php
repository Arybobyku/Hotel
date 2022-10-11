<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index()
    {
        $idHotel = Auth::user()->id_hotel;
        $hotel = Hotel::where('id',$idHotel)->first();
        return view('hotel.dashboard', [
            "hotel" => $hotel,
        ]);
    }

    public function rooms()
    {
        $idHotel = Auth::user()->id_hotel;
        $rooms = Room::where('id_hotel',$idHotel)->get();
        return view('hotel.room', [
            "rooms" => $rooms,
        ]);
    }
}
