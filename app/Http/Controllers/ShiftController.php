<?php

namespace App\Http\Controllers;

use App\Exports\ShiftExport;
use App\Models\Book;
use App\Models\ChargePivot;
use App\Models\Hotel;
use App\Models\Platform;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();
        if ($request->from == null && $request->to == null) {
            $from = date('2010-10-01');
            $to = date('2040-10-31');
        } else {
            $from = $request->from;
            $to = $request->to;
        }

        if (!empty($request->id_user) && $request->tipee == null && $request->booktipe == null && $request->id_platform == null) { // user
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->latest()
                ->paginate(15);
            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee != null && $request->booktipe == null && $request->id_platform == null) { // payment type
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee == null && $request->booktipe != null && $request->id_platform == null) { // booking type
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('booking_type', $request->booktipe)

                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee == null && $request->booktipe == null && $request->id_platform != null) { // id_platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee != null && $request->booktipe == null && $request->id_platform == null) { // payment type, user
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)

                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee == null && $request->booktipe != null && $request->id_platform == null) { // booking type, user
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('booking_type', $request->booktipe)

                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee != null && $request->booktipe != null && $request->id_platform == null) { // booking type, payment type
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)

                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee == null && $request->booktipe == null && $request->id_platform != null) { // user, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee != null && $request->booktipe == null && $request->id_platform != null) { // payment type, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee == null && $request->booktipe != null && $request->id_platform != null) { // booktipe, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee != null && $request->booktipe != null && $request->id_platform == null) { // booking type, payment type, user
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (empty($request->id_user) && $request->tipee != null && $request->booktipe != null && $request->id_platform != null) { // booking type, payment type, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_platform', $request->id_platform)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee == null && $request->booktipe != null && $request->id_platform != null) { // booking type, puser, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('id_platform', $request->id_platform)
                ->where('booking_type', $request->booktipe)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee != null && $request->booktipe == null && $request->id_platform != null) { // payment type, puser, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_platform', $request->id_platform)
                ->sum('platform_fee2');
        } elseif (!empty($request->id_user) && $request->tipee != null && $request->booktipe != null && $request->id_platform != null) { // booking type, payment type, user, platform
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->where('id_platform', $request->id_platform)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->where('id_platform', $request->id_platform)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->where('id_platform', $request->id_platform)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('booking_type', $request->booktipe)
                ->where('id_platform', $request->id_platform)
                ->sum('platform_fee2');
        } else {
            $filter = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);

            $totalUangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->sum('total_amount');

            $uangMasuk = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->sum('price');

            $totalAmount = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->sum('total_amount');

            $totalCharge = Book::whereBetween('checkin', [$from, $to])
                ->where('id_hotel', $request->id)
                ->sum('platform_fee2');
            // ddd($filter);
        }

        session()->flashInput($request->input());
        $hotel = Hotel::where('id', $request->id)->first();

        // ddd($filter);

        return view('admin.hotel.shift', [
            'books' => $filter,
            'pegawais' => User::where('id_hotel', $request->id)
                ->where('role', 0)
                ->get(),
            'hotel' => $hotel,
            'grandTotalUangMasuk' => $totalUangMasuk - $totalCharge,
            'grandUangMasuk' => $uangMasuk,
            'grandTotalAmount' => $totalAmount,
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
        foreach ($charges as $charge) {
            $totalCharge += $charge->charge->charge;
        }
        $hotel = Hotel::where('id', $myId)->first();
        $book = Book::where('id', $request->id)->first();

        return view('admin.hotel.shiftdetail', [
            'books' => $book,
            'hotel' => $hotel,
            'charges' => $charges,
            'totalCharge' => $totalCharge,
        ]);
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

        return Excel::download(new ShiftExport($myId, $request->from, $request->to, $request->id_user, $request->tipee, $request->booktipe, $request->id_platform), $hotelName.' '.$paymentType.' '.$bookType.' '.$platformName.''.$formattedDate1.' - '.$formattedDate2.'.xlsx');
    }
}
