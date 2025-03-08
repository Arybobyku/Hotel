<?php

namespace App\Http\Controllers;

use App\Exports\ShiftExport;
use App\Models\Book;
use App\Models\Spending;
use App\Models\ChargePivot;
use App\Models\Hotel;
use App\Models\Platform;
use App\Models\User;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function getData(Request $request)
{
    $idHotel = Auth::user()->id_hotel;
    $idUser = Auth::id();

    // Set date range
    if ($request->from == null && $request->to == null) {
        $from = date('Y-m-01'); // First day of the current month
        $to = date('Y-m-t'); // Last day of the current month
    } else {
        $from = $request->from;
        $to = $request->to;
    }

    // Fetch data without concatenation
    $filter = Book::select([
            'books.*', 
            'rooms.name as room_name', // Fetch room names individually
            'users.name as pegawai', 
            'platforms.platform_name'
        ])
        ->leftJoin('book_room_pivots', 'book_room_pivots.id_book', '=', 'books.id')
        ->leftJoin('rooms', 'book_room_pivots.id_room', '=', 'rooms.id')
        ->leftJoin('users', 'books.id_user', '=', 'users.id')
        ->leftJoin('platforms', 'books.id_platform', '=', 'platforms.id')
        ->whereBetween('books.checkin', [$from, $to])
        ->filterByHotel($idHotel)
        ->when($request->id_user, function ($query) use ($request) {
            $query->filterByUser($request->id_user);
        })
        ->when($request->tipee, function ($query) use ($request) {
            $query->filterByPaymentType($request->tipee);
        })
        ->when($request->booktipe, function ($query) use ($request) {
            $query->filterByBookingType($request->booktipe);
        })
        ->when($request->id_platform, function ($query) use ($request) {
            $query->filterByPlatform($request->id_platform);
        })
        ->get();

    // Group the results by book ID and concatenate room names
    $groupedResults = $filter->groupBy('id');

    // Process each group to concatenate room names
    $processedResults = $groupedResults->map(function ($books) {
        // Get the first book in the group (all books in the group share the same details except room_name)
        $firstBook = $books->first();

        // Concatenate room names
        $roomNames = $books->pluck('room_name')->filter()->unique()->implode(', ');

        // Add the concatenated room names to the first book
        $firstBook->room_name = $roomNames;

        return $firstBook;
    });

    // Convert the processed results back to a collection
    $processedResults = $processedResults->values();

    // Return DataTables response
    return DataTables::of($processedResults)
        ->addColumn('action', function ($book) {
            return '<div class="flex space-x-1">
                <a href="/admin/hotel/' . $book->id_hotel . '/shift/detail/' . $book->id . '"
                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-0 m-1 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </a>
                <a href="/admin/hotel/' . $book->id_hotel . '/shift/edit/' . $book->id . '"
                    class="text-white bg-yellow-400 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-0 m-1 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </a>
                <form action="' . route('book.destroy', ['hotel' => $book->id_hotel, 'shift' => $book->id]) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit"  
                        class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-2 py-0 m-1 inline-flex items-center" onclick="return confirm(\'Are you sure?\')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            </div>';
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function index(Request $request)
{
    $idHotel = Auth::user()->id_hotel;
    $idUser = Auth::id();

    // Set date range
    if ($request->from == null && $request->to == null) {
        $from = date('Y-m-01'); // First day of the current month
        $to = date('Y-m-t'); // Last day of the current month
    } else {
        $from = $request->from;
        $to = $request->to;
    }

    // Calculate total amount and paidout
    $totalAmount = Book::whereBetween('checkin', [$from, $to])
        ->filterByHotel($idHotel)
        ->when($request->id_user, function ($query) use ($request) {
            $query->filterByUser($request->id_user);
        })
        ->when($request->tipee, function ($query) use ($request) {
            $query->filterByPaymentType($request->tipee);
        })
        ->when($request->booktipe, function ($query) use ($request) {
            $query->filterByBookingType($request->booktipe);
        })
        ->sum('total_amount');

    $totalPaidout = Spending::whereBetween('tanggal', [$from, $to])
        ->where('id_hotel', $idHotel)
        ->sum('jumlah');

    // Fetch hotel details
    $hotel = Hotel::where('id', $idHotel)->first();

    return view('admin.hotel.shift', [
        'pegawais' => User::where('id_hotel', $idHotel)
            ->where('role', 0)
            ->get(),
        'hotel' => $hotel,
        'grandTotalAmount' => $totalAmount,
        'totalPaidout' => $totalPaidout,
        'netAmount' => $totalAmount - $totalPaidout,
        'platforms' => Platform::where('platform_name', '!=', 'Walkin')->get(),
    ]);
}
    public function show(Request $request)
    {
        $myId = Auth::user()->id;
        $hotels = Hotel::where('id', $request->id)->first();

        $charges = ChargePivot::where('id_book', $request->id)
            ->with('charge')
            ->get();
        $totalCharge = 0;
        // foreach ($charges as $charge) {
        //     $totalCharge += $charge->charge->charge;
        // }
        $hotel = Hotel::where('id', $myId)->first();
        $book = Book::where('id', $request->id)->first();

        return view('admin.hotel.shiftdetail', [
            'books' => $book,
            'hotel' => $hotel,
            'charges' => $charges,
            'totalCharge' => $totalCharge,
        ]);
    }

    public function edit(Request $request)
    {
        $myId = Auth::user()->id;
        $hotels = Hotel::where('id', $request->id)->first();

        $charges = ChargePivot::where('id_book', $request->id)
            ->with('charge')
            ->get();
        $totalCharge = 0;
        // foreach ($charges as $charge) {
        //     $totalCharge += $charge->charge->charge;
        // }
        $hotel = Hotel::where('id', $myId)->first();
        $book = Book::where('id', $request->id)->first();

        return view('admin.hotel.shiftedit', [
            'books' => $book,
            'platforms' => Platform::where('id', '!=', 1)->get(),   
            'hotel' => $hotel,
            'charges' => $charges,
            'totalCharge' => $totalCharge,
        ]);
    }

    public function update(Request $request, Book $book)
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
        $idUser = Auth::user()->id;
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
        $platform_fee3 = Book::where('id', $request->id_booking)->sum('platform_fee3');
        $assured_stay = Book::where('id', $request->id_booking)->sum('assured_stay');
        $tipforstaf = Book::where('id', $request->id_booking)->sum('tipforstaf');
        $upgrade_room = Book::where('id', $request->id_booking)->sum('upgrade_room');
        $travel_protection = Book::where('id', $request->id_booking)->sum('travel_protection');
        $member_redclub = Book::where('id', $request->id_booking)->sum('member_redclub');
        $breakfast = Book::where('id', $request->id_booking)->sum('breakfast');
        $early_checkin = Book::where('id', $request->id_booking)->sum('early_checkin');
        $late_checkout = Book::where('id', $request->id_booking)->sum('late_checkout');
        // $totalAmount = $price + $totalCharge + $platform_fee3 + $assured_stay + $tipforstaf + $upgrade_room + $travel_protection
        $totalAmount = $price + $platform_fee3 + $assured_stay + $tipforstaf + $upgrade_room + $travel_protection
            + $member_redclub + $breakfast + $early_checkin + $late_checkout;
        $platformFee = Platform::where('id', $request->id_platform)->sum('platform_fee');
        if ($platformFee){
        $potonganFee = ($platformFee * $request->price) / 100;
        } else{
           $potonganFee = 0; 
        }
        if ($request->jenisPembayaran == null){
            $jenisPembayaran = 'Walkin';
        } else {
           $jenisPembayaran = $request->jenisPembayaran ; 
        }
        Book::where('id', $request->id)->update([
            'guestname' => $request->guestname,
            'id_user' => $idUser,
            'nik' => $request->nik,
            'nota' => $request->nota,
            'price' => $request->price,
            // 'price_app' => $request->price_app,
            'book_date' => $request->book_date,
            'days' => $request->days,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'payment_type' => $jenisPembayaran,
            'id_platform' => $request->id_platform,
            'platform_fee2' => $potonganFee,
            'assured_stay' => $request->assured_stay,
            'tipforstaf' => $request->tipforstaf,
            'upgrade_room' => $request->upgrade_room,
            'travel_protection' => $request->travel_protection,
            'member_redclub' => $request->member_redclub,
            'breakfast' => $request->breakfast,
            'early_checkin' => $request->early_checkin,
            'late_checkout' => $request->late_checkout,
            'platform_fee3' => $request->platform_fee3,
        ]);

        Log::create([
            'activity' => "$nameUser Melakukan Update Nomor Transaksi $request->nota",
            'id_hotel' => $hotelId,
        ]);

        return redirect('/admin/hotel/' . $hotelId . '/shift')->with('success', 'Room Telah Dihapus');

    }


    public function destroy($hotel ,$shift)
    {
        $book = Book::findOrFail($shift);
        $book->delete();

        return redirect('/admin/hotel/' . $book->id_hotel . '/shift')->with('success', 'Room Telah Dihapus');
    }

    public function export(Request $request)
    {
        $myId = Auth::user()->id_hotel;
        $hotelName = Hotel::where('id', $myId)->value('name');
        if ($request->id_platform != null) {
            $platformName = Platform::where('id', $myId)->value('platform_name');
        } else {
            $platformName = '';
        }

        if ($request->from != null) {
            $dateFrom = Carbon::parse($request->from);
            $formattedDate1 = $dateFrom->format('d M Y');
        } else {
            $formattedDate1 = '';
        }
        if ($request->to != null) {
            $dateTo = Carbon::parse($request->to);
            $formattedDate2 = $dateTo->format('d M Y');
        } else {
            $formattedDate2 = '';
        }
        if ($request->tipee === '0') {
            $paymentType = 'Walkin';
        } elseif ($request->tipee == null) {
            $paymentType = '';
        } else {
            $paymentType = $request->tipee;
        }
        if ($request->booktipe === '0') {
            $bookType = 'Walkin';
        } else {
            $bookType = $request->booktipe;
        }

        return Excel::download(new ShiftExport($myId, $request->from, $request->to, $request->id_user, $request->tipee, $request->booktipe, $request->id_platform), $hotelName . ' ' . $paymentType . ' ' . $bookType . ' ' . $platformName . '' . $formattedDate1 . ' - ' . $formattedDate2 . '.xlsx');
    }
}
