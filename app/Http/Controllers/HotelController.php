<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Book;
use App\Models\ChargePivot;
use App\Models\ChargeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class HotelController extends Controller
{
    public function index()
    {

        //         $startDate = date_create(date('Y-m-d'));
        // date_add($startDate, date_interval_create_from_date_string(-1 . " days"));
        // $date = date_format($startDate, "Y-m-d");
        // $bookings = Book::where('id_hotel', $idHotel)
        $idHotel = Auth::user()->id_hotel;

        $hotel = Hotel::where('id', $idHotel)->first();
        $charges = ChargeType::all();
        $startDate = date('Y-m-d');
        $bookings = Book::where('id_hotel', $idHotel)
            ->where('book_date', '>=', $startDate)
            ->get();
        return view('employee.dashboard', [
            'hotel' => $hotel,
            'bookings' => $bookings,
            'charges' => $charges,
        ]);
    }

    public function typebook(Request $request){
        return view('employee.typebook');

    }

    public function rooms(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $startDate = date('Y-m-d');
        $endDate = null;

        $now = date('Y-m-d');
        $rooms = Room::where('id_hotel', $idHotel)->get();
        $availableRooms = [];
        // var_dump($request->dateChange);die();
        if ($request->startDateChange && $request->endDateChange != null) {
            $startDate = $request->startDateChange;
            $endDate = $request->endDateChange;
            $date = 'From ' . $request->startDateChange . ' Until ' . $request->endDateChange;

            $bookings = Book::Where(function ($query) use ($startDate, $endDate) {
                $query->WhereDate('book_date', '>', $startDate)->orWhereDate('book_date_end', '>=', $startDate);
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
            $bookings = Book::whereDate('book_date', $startDate)
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
            $bookings = Book::whereDate('book_date', $startDate)
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
        session()->flashInput($request->input());
        return view('employee.room', [
            'rooms' => $availableRooms,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function shift(Request $request)
    {
        $idBook = Book::all();
        $charges = ChargePivot::with('book')->get();
        $idHotel = Auth::user()->id_hotel;
        $isFinance = Auth::user()->isfinance;
        $idUser = Auth::id();

        if ($request->from == Null && $request->to == Null) {
            $from = date('2010-10-01');
            $to = date('2040-10-31');
        } else {
            $from = $request->from;
            $to = $request->to;
        }
        if ($isFinance == 0) {
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_user', $idUser)->where('id_hotel', $idHotel)
                ->latest()->paginate(15);

        } else {
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->latest()->paginate(15);

        }
        session()->flashInput($request->input());
        return view('employee.shift', [
            'books' => $filter,
            // 'charges' => $totalCharge,
        ]);
    }

    public function detailshift(Request $request)
    {
        $myId = Auth::user()->id;
        $book = Book::where('id', $request->id)->first();
        $charges = ChargePivot::where('id_book', $request->id)
            ->with('charge')
            ->get();
        $totalCharge = 0;
        foreach ($charges as $charge) {
            $totalCharge += $charge->charge->charge;
        }
        return view('employee.shiftdetail', [
            'books' => $book,
            'charges' => $charges,
            'totalCharge' => $totalCharge,
        ]);
    }

    public function struk(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $book = Book::where('id', $request->id)->first();

        $charges = ChargePivot::where('id_book', $request->id)
            ->with('charge')
            ->get();

        $totalCharge = 0;
        foreach ($charges as $charge) {
            $totalCharge += $charge->charge->charge;
        }
        return view('employee.struk', [
            'book' => $book,
            'charges' => $charges,
            'totalCharge' => $totalCharge,
        ]);
    }
}
