<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use App\Models\Book;

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

    public function edit(Request $request)
    {
        $myId = Auth::user()->id;
        $hotels = Hotel::where('id', $request->id)->first();
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);
        $hotel = Hotel::where('id', $myId)->first();
        $room = Room::where('id', $request->id)->first();
        return view('admin.hotel.editroom', [
            'room' => $room,
            'hotel' => $hotel,
        ]);
    }

    public function editroom(Request $request)
    {
        $myId = Auth::user()->id;
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
        ]);
            if ($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('room-images');
    }
        Room::where('id', $request->id)->update($validatedData);
        return redirect('admin/hotel/' .  $request->id_hotel)->with('status', 'Berhasil Mengedit room');

    }

    public function deleteroom(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;

        Room::where('id', $request['id'])->delete();
        return redirect('admin/hotel/' . $hotelId)->with('status', 'Berhasil menghapus room');
    }
    
        public function detail(Request $request)
    {
        $myId = Auth::user()->id;
        $hotels = Hotel::where('id', $request->id)->first();
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);
        $hotel = Hotel::where('id', $myId)->first();
        $room = Room::where('id', $request->id)->first();
        $book = Book::where('id_room', $request->id)->latest()->get();
        return view('admin.hotel.roomdetail', [
            'room' => $room,
            'hotel' => $hotel,
            'books' => $book,
        ]);
    }
}
