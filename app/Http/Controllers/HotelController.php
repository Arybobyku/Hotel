<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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
}
