<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRoomPivot;
use App\Models\ChargePivot;
use App\Models\ChargeType;
use App\Models\Hotel;
use App\Models\Platform;
use App\Models\Room;
use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $bookings = Book::where('id_hotel', $idHotel)->latest()->paginate(10);

        return view('employee.dashboard', [
            'hotel' => $hotel,
            'bookings' => $bookings,
            'charges' => $charges,
        ]);
    }

    public function typebook(Request $request)
    {
        return view('employee.typebook');
    }

    public function rooms(Request $request)
{
    $idHotel = Auth::user()->id_hotel;
    $startDate = date('Y-m-d');
    $endDate = null;
    
    $isWeekend = $request->input('is_weekend', 0); // Default 0 kalau tidak dikirim
    
    if ($request->startDateChange && $request->endDateChange) {
        $startDate = $request->startDateChange;
        $endDate = $request->endDateChange;
    }

    // Ambil room_id yang sudah dibooking dalam rentang tanggal tertentu
    $bookedRoomIds = DB::table('book_room_pivots')
        ->join('books', 'book_room_pivots.id_book', '=', 'books.id')
        ->where('books.id_hotel', $idHotel)
        ->where(function ($query) use ($startDate, $endDate) {
            if ($endDate) {
                $query->whereDate('books.book_date', '<=', $endDate)
                      ->whereDate('books.book_date_end', '>=', $startDate);
            } else {
                $query->whereDate('books.checkin', '=', $startDate);
            }
        })
        ->pluck('book_room_pivots.id_room')
        ->toArray();

    // Ambil kamar yang tersedia + filter berdasarkan is_weekend
    $availableRooms = Room::where('id_hotel', $idHotel)
        ->whereNotIn('id', $bookedRoomIds)
        ->when($isWeekend, function ($query) use ($isWeekend) {
            return $query->where('is_weekend', $isWeekend);
        })
        ->get();

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

        if ($request->from == null && $request->to == null) {
            $from = date('2010-10-01');
            $to = date('2040-10-31');
        } else {
            $from = $request->from;
            $to = $request->to;
        }
        if ($isFinance == 0) {
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_user', $idUser)
                ->where('id_hotel', $idHotel)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->where('id_user', $idUser)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->where('id_user', $idUser)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->where('id_user', $idUser)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->where('id_user', $idUser)
                ->sum('platform_fee2');

            $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('jumlah');
        } else {
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('platform_fee2');
            $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('jumlah');
        }

        session()->flashInput($request->input());

        return view('employee.shift', [
            'books' => $filter,
            // 'charges' => $totalCharge,
            'grandTotalUangMasuk' => $totalUangMasuk - $totalCharge,
            'grandUangMasuk' => $uangMasuk,
            'grandTotalAmount' => $totalAmount,
            'totalPaidout' => $totalPaidout,
            'netAmount' => $totalAmount - $totalPaidout,

        ]);
    }

    public function platformreport(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;
        $isFinance = Auth::user()->isfinance;
        $charges = ChargePivot::with('book')->get();
        $idHotel = Auth::user()->id_hotel;
        $isFinance = Auth::user()->isfinance;
        $idUser = Auth::id();

        if ($request->from == null && $request->to == null) {
            $from = date('2010-10-01');
            $to = date('2040-10-31');
        } else {
            $from = $request->from;
            $to = $request->to;
        }
        if ($isFinance == 0) {
            if ($request->pay_type == null && $request->id_platform == null) {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_user', $idUser)
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('booking_type', 'app')
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('booking_type', 'app')
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->sum('jumlah');
            } elseif ($request->id_platform == null) {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_user', $idUser)
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->where('payment_type', $request->pay_type)
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->sum('jumlah');
            } else {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_user', $idUser)
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->where('booking_type', 'app')
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('id_user', $idUser)
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->where('booking_type', 'app')
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->sum('jumlah');
            }
        } else {
            if ($request->pay_type == null && $request->id_platform == null) {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->sum('jumlah');
            } elseif ($request->id_platform == null) {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->where('payment_type', $request->pay_type)
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->sum('jumlah');
            } else {
                $filter = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('booking_type', 'app')
                    ->where('payment_type', $request->pay_type)
                    ->where('id_platform', $request->id_platform)
                    ->latest()
                    ->paginate(15);

                $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->where('id_platform', $request->id_platform)
                    ->sum('total_amount');

                $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->where('id_platform', $request->id_platform)
                    ->sum('price');

                $totalAmount = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->where('id_platform', $request->id_platform)
                    ->sum('total_amount');

                $totalCharge = Book::whereBetween('checkin', [$from, $to])
                    ->where('id_hotel', $idHotel)
                    ->where('payment_type', $request->pay_type)
                    ->where('booking_type', 'app')
                    ->where('id_platform', $request->id_platform)
                    ->sum('platform_fee2');
                $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
                ->where('id_hotel', $idHotel)
                ->sum('jumlah');
            }
        }

        session()->flashInput($request->input());

        return view('employee.appreport', [
            'books' => $filter,
            'hotel' => $idHotel,
            'grandTotalUangMasuk' => $totalUangMasuk,
            'grandUangMasuk' => $uangMasuk,
            'grandTotalAmount' => $totalAmount - $totalCharge,
            'totalPaidout' => $totalPaidout,
            'netAmount' => $totalAmount - $totalPaidout,

            'platforms' => Platform::where('platform_name', '!=', 'Walkin')->get(),
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

    // public function struk(Request $request)
    // {
    //     $idHotel = Auth::user()->id_hotel;
    //     $book = Book::where('id', $request->id)->first();

    //     $charges = ChargePivot::where('id_book', $request->id)
    //         ->with('charge')
    //         ->get();

    //     $totalCharge = 0;
    //     foreach ($charges as $charge) {
    //         $totalCharge += $charge->charge->charge * $charge->qty;
    //     }

    //     return view('employee.struk', [
    //         'book' => $book,
    //         'charges' => $charges,
    //         'totalCharge' => $totalCharge,
    //     ]);
    // }

   public function struk(Request $request)
{
    $idHotel = Auth::user()->id_hotel;
    $book = Book::where('id', $request->id)->first();

    $charges = ChargePivot::where('id_book', $request->id)
        ->with('charge')
        ->get();

    $bookRoomPivots = BookRoomPivot::where('id_book', $request->id)
        ->with('room')
        ->get();

    $totalCharge = 0;
    foreach ($charges as $charge) {
        $totalCharge += $charge->charge->charge * $charge->qty;
    }

    // Ambil harga kamar dari book_room_pivots
    $roomPrice = DB::table('book_room_pivots')
        ->where('id_book', $request->id)
        ->sum('price'); // Jika ada beberapa kamar, ambil total harga

    return view('employee.struk', [
        'book' => $book,
        'charges' => $charges,
        'totalCharge' => $totalCharge,
        'roomPrice' => $roomPrice, // Kirim ke view
        'bookRoomPivots' => $bookRoomPivots, // Kirim ke view
    ]);
}


}
