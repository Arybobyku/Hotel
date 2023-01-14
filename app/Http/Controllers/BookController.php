<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Book;
use App\Models\Room;
use App\Models\Platform;
use App\Models\ChargePivot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function indexwalkin(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $room = Room::where('id', $request->id)->first();
        return view('employee.book', ['room' => $room, 'date' => $request->date]);
    }

    public function indexapp(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $startDate = date('Y-m-d');
        $endDate = null;

        $now = date('Y-m-d');
        $idHotel = Auth::user()->id_hotel;
        $rooms = Room::where('id_hotel', $idHotel)->get();
        $availableRooms = [];
        // var_dump($request->dateChange);die();
        if ($request->startDateChange && $request->endDateChange != null) {
            $startDate = $request->startDateChange;
            $endDate = $request->endDateChange;
            $date = 'From ' . $request->startDateChange . ' Until ' . $request->endDateChange;

            $bookings = Book::Where(function ($query) use ($startDate, $endDate) {
                $query->WhereDate('checkin', '>', $startDate)->orWhereDate('book_date_end', '>=', $endDate);
            })
                ->where('id_hotel', $idHotel)
                ->get();

            foreach ($rooms as $room) {
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    if ($booking->id_room == $room->id) {
                        $isAvailable = false;
                        break;
                    }
                }
                if ($isAvailable) {
                    array_push($availableRooms, $room);
                }
            }
        } elseif ($request->startDateChange) {
            $startDate = $request->dateChange;
            $bookings = Book::whereDate('checkin', $startDate)
                ->where('id_hotel', $idHotel)
                ->get();
            foreach ($rooms as $room) {
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    if ($booking->id_room == $room->id) {
                        $isAvailable = false;
                        break;
                    }
                }
                if ($isAvailable) {
                    array_push($availableRooms, $room);
                }
            }
        } else {
            $bookings = Book::whereDate('checkin', $startDate)
                ->where('id_hotel', $idHotel)
                ->get();
            foreach ($rooms as $room) {
                $isAvailable = true;
                foreach ($bookings as $booking) {
                    if ($booking->id_room == $room->id) {
                        $isAvailable = false;
                        break;
                    }
                }
                if ($isAvailable) {
                    array_push($availableRooms, $room);
                }
            }
        }
        return view('employee.book2', [
            'platforms' => Platform::where('id', '!=', 1)->get(),
            'rooms' => $availableRooms,
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
                    'id_charge' => $idCharge,
                    'id_book' => $request->id_booking,
                ]);
            }
        }

        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $date = date('Y-m-d');
        $charges = ChargePivot::where('id_book', $request->id_booking)
            ->with('charge')
            ->get();
        $totalCharge = 0;
        foreach ($charges as $charge) {
            $totalCharge += $charge->charge->charge;
        }
        $price = Book::where('id', $request->id_booking)->sum('price');
        $platform_fee2 = Book::where('id', $request->id_booking)->sum('platform_fee2');
        $assured_stay = Book::where('id', $request->id_booking)->sum('assured_stay');
        $tipforstaf = Book::where('id', $request->id_booking)->sum('tipforstaf');
        $upgrade_room = Book::where('id', $request->id_booking)->sum('upgrade_room');
        $travel_protection = Book::where('id', $request->id_booking)->sum('travel_protection');
        $member_redclub = Book::where('id', $request->id_booking)->sum('member_redclub');
        $breakfast = Book::where('id', $request->id_booking)->sum('breakfast');
        $early_checkin = Book::where('id', $request->id_booking)->sum('early_checkin');
        $totalAmount = $price + $totalCharge + $platform_fee2 + $assured_stay + $tipforstaf + $upgrade_room + $travel_protection
            + $member_redclub + $breakfast + $early_checkin;
        Book::where('id', $request->id_booking)->update([
            'checkOut' => $date,
            'total_charge' => $totalCharge,
            'total_amount' => $totalAmount
        ]);

        Log::create([
            'activity' => "$nameUser Melakukan Checkout Nomor Transaksi $request->nota",
            'id_hotel' => $hotelId,
        ]);
        return redirect('hotel/dashboard');
    }

    public function booking(Request $request)
    {
        $startDate = date('Y-m-d');
        $availableRooms = [];

        $userId = Auth::id();
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $roomName = Room::select(['name'])
            ->where('id', '=', $request->id_room)
            ->get();
        $rooms = Room::where('id_hotel', $hotelId)->get();

        $bookings = Book::whereDate('checkin', $startDate)
            ->where('id_hotel', $hotelId)
            ->get();
        foreach ($rooms as $room) {
            $isAvailable = true;
            foreach ($bookings as $booking) {
                if ($booking->id_room == $room->id) {
                    $isAvailable = false;
                    break;
                }
            }
            if ($isAvailable) {
                array_push($availableRooms, $room);
            }
        }
        $request->validate([
            'id_room' => [
                'required', 'integer', Rule::unique('books')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('id_room', $request->id_room)
                            ->whereDate('checkin', '=', date('Y-m-d'))
                            ->where('id_hotel', auth()->user()->id_hotel);
                    })
            ],
            'guestname' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'nota' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
        ]);

        $platformFee = Platform::where('id', $request->id_platform)->sum('platform_fee');
        $potonganFee = ($platformFee * $request->price) / 100;

        $date = date_create($request->checkin);
        date_add($date, date_interval_create_from_date_string($request->jumlah_hari . ' days'));
        $dateBookingEnd = date_format($date, 'Y-m-d');

        Book::create([
            'guestname' => $request->guestname,
            'id_room' => $request->id_room,
            'id_hotel' => $hotelId,
            'id_user' => $userId,
            'room' => $roomName,
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
            'platform_fee2' => $potonganFee,
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
        return redirect('hotel/dashboard');
    }
}
