<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    public function index(Request $request){
        $hotel = Hotel::where('id',$request->id)->first();
        return view('admin.hotel.hotel', [
            "hotel" => $hotel,
        ]);
    }
}
