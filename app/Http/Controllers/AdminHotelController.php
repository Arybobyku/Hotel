<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHotelController extends Controller
{
    public function index(Request $request)
    {
        $myId = Auth::user()->id;
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);
        $hotel = Hotel::where('id', $request->id)->first();
        return view('admin.hotel.hotel', [
            'hotel' => $hotel,
        ]);
    }

    public function create(Request $request)
    {
        $myId = Auth::user()->id;
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);
        $hotel = Hotel::where('id', $request->id)->first();
        return view('admin.hotel.createroom', [
            'hotel' => $hotel,
        ]);
    }

    public function createroom(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;
        $validatedData = $request->validate([
            'id_hotel' => 'required|max:11',
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('room-images');
        }

        Room::create($validatedData);

        return redirect('admin/hotel/' . $hotelId);
    }

    public function deleteroom(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;

        Room::where('id', $request['id'])->delete();
        return redirect('admin/hotel/'. $hotelId)->with('status', 'Berhasil menghapus room');
    }
}
