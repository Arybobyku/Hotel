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
        $startDate = date('Y-m-d');
        $bookings = Book::where("id_hotel",$idHotel)->where('book_date','>=',$startDate)->get();
        return view('employee.dashboard', [
            "hotel" => $hotel,
            "bookings"=>$bookings
        ]);
    }

    public function rooms(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $startDate = date('Y-m-d');
        $endDate = null;
        $rooms = Room::where("id_hotel", $idHotel)->get();
        $availableRooms = [];
        // var_dump($request->dateChange);die();
         if($request->startDateChange && $request->endDateChange!=null){
            $startDate = $request->startDateChange;
            $endDate = $request->endDateChange;
            $date = "From ".$request->startDateChange ." Until ".$request->endDateChange;
            $bookings = Book::whereBetween("book_date", [$startDate,$endDate])->where("id_hotel",$idHotel)->get();
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
       else if ($request->startDateChange) {
            $startDate = $request->dateChange;
            $bookings = Book::whereDate("book_date", $startDate)->where("id_hotel",$idHotel)->get();
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
            $bookings = Book::whereDate("book_date", $startDate)->where("id_hotel",$idHotel)->get();
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
            "startDate"=>$startDate,
            "endDate"=>$endDate
        ]);
    }
}
