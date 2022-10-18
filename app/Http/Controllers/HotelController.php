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
        $hotel = Hotel::where('id', $idHotel)->first();
        $bookings = Book::where("id_hotel",$idHotel)->get();
        return view('employee.dashboard', [
            "hotel" => $hotel,
            "bookings"=>$bookings
        ]);
    }

    public function rooms(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $date = date('Y-m-d');
        $rooms = Room::where("id_hotel", $idHotel)->get();
        $availableRooms = [];
        // var_dump($request->dateChange);die();
        if ($request->dateChange) {
            $date = $request->dateChange;
            $bookings = Book::whereDate("book_date", $date)->where("id_hotel",$idHotel)->get();
            foreach ($rooms as $room) {
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    if ($booking->id_room == $room->id) {
                        $isAvailable = false;
                        break;
                    }
                }
                if($isAvailable){
                    array_push($availableRooms, $room);
                }
            }
        } else {
            $bookings = Book::whereDate("book_date", $date)->where("id_hotel",$idHotel)->get();
            foreach ($rooms as $room) {
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    if ($booking->id_room == $room->id) {
                        $isAvailable = false;
                        break;
                    }
                }
                if($isAvailable){
                    array_push($availableRooms, $room);
                }
            }
        }
        return view('employee.room', [
            "rooms" => $availableRooms,
            "date" =>$date
        ]);
    }
}
