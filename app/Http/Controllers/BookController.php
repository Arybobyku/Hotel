<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ChargePivot;
use App\Models\ChargeType;
use App\Models\Log;
use App\Models\kuesioner;
use App\Models\Platform;
use App\Models\Room;
use App\Models\UserAnswere;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function indexwalkin(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $room = Room::where('id', $request->id)->first();
        return view('employee.book', ['room' => $room, 'date' => $request->date, 
    ]);
    }
    
    public function indexapp(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        return view('employee.book2', [
            'platforms' => Platform::all()

        ]);
    }

    public function checkIn(Request $request)
    {
        $date = date('Y-m-d');
        Book::where('id', $request->id_booking)->update([
            'checkIn' => $date,
        ]);
        return redirect('hotel/dashboard');
    }

    public function checkOut(Request $request, Book $book)
    {
        $chargers = $request->charge;
        if ($chargers != null) {
            foreach ($chargers as $idCharge) {
                ChargePivot::create([
                    "id_charge" => $idCharge,
                    "id_book" => $request->id_booking
                ]);
            }
        }
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $date = date('Y-m-d');
        Book::where('id', $request->id_booking)->update([
            'checkOut' => $date,
        ]);

        Log::create([
            'activity' => "$nameUser Melakukan Checkout Nomor Transaksi $request->nota",
            'id_hotel' => $hotelId,
        ]);
        return redirect('hotel/dashboard');
    }

    public function booking(Request $request)
    {
        $userId = Auth::id();
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $request->validate([
            'id_room' => ['required', 'integer'],
            'guestname' => ['required', 'string', 'max:255'],
            'room' => ['required','string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'nota' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
        ]);

        $date = date_create($request->booking);
        date_add($date, date_interval_create_from_date_string($request->jumlah_hari . " days"));
        $dateBookingEnd = date_format($date, "Y-m-d");

        Book::create([
            'guestname' => $request->guestname,
            'id_room' => $request->id_room,
            'id_hotel' => $hotelId,
            'id_user' => $userId,
            'room' => $request->room,
            'nik' => $request->nik,
            'nota' => $request->nota,
            'price' => $request->price,
            // 'price_app' => $request->price_app,
            'book_date' => $request->booking,
            'book_date_end' => $dateBookingEnd,
            'days' => $request->jumlah_hari,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'booking_type' => $request->jenisPesan,
            'payment_type' => $request->jenisPembayaran,
            'id_platform' => $request->id_platform,
            'platform_fee2' => $request->platform_fee2,
            'assured_stay' => $request->assured_stay,
            'tipforstaf' => $request->tipforstaf,
            'upgrade_room' => $request->upgrade_room,
            'travel_protection' => $request->travel_protection,
            'member_redclub' => $request->member_redclub,
            'breakfast' => $request->breakfast,
            'early_checkin' => $request->early_checkin,
        ]);

        Log::create([
            'activity' => "$nameUser Membuat Reservation Nomor Transaksi $request->nota",
            'id_hotel' => $hotelId,
        ]);
        return redirect('hotel/rooms');
    }
}
