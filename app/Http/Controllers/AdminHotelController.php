<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHotelController extends Controller
{
    public function index(Request $request){
        $myId = Auth::user()->id;
        User::where('id',$myId)->update([
            'id_hotel'=>$request->id,
        ]);
        $hotel = Hotel::where('id',$request->id)->first();
        return view('admin.hotel.hotel', [
            "hotel" => $hotel,
        ]);
    }
}
