<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Hotel;
use App\Models\User;
use App\Models\ChargePivot;
use Illuminate\Support\Facades\Auth;
use App\Exports\ShiftExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();

        if ((empty($request->input('from')) || empty($request->input('to'))) && $request->id_user && $request->tipee != NULL) { //USER DAN TIPE 
            $filter = Book::where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } elseif ((empty($request->input('from')) || empty($request->input('to'))) && empty($request->input('id_user')) && $request->tipee != NULL) { // TIPE
            $filter = Book::where('payment_type', $request->tipee)
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } elseif ((empty($request->input('from')) || empty($request->input('to'))) && $request->tipee == NULL && $request->id_user) { //USER 
            $filter = Book::where('id_user', $request->id_user)
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && $request->id_user && $request->tipee != NULL) { //TANGGAL 
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->where('payment_type', $request->tipee)
                ->latest()
                ->paginate(15);
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && empty($request->input('id_user')) && $request->tipee == NULL) { //TANGGAL 
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && empty($request->input('id_user')) && $request->tipee != NULL) {
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('payment_type', $request->tipee)
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && $request->tipee == NULL && $request->id_user) {
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_user', $request->id_user)
                ->where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        } else {
            $filter = Book::where('id_hotel', $request->id)
                ->latest()
                ->paginate(15);
        }
        session()->flashInput($request->input());
        $hotel = Hotel::where('id', $request->id)->first();

        return view('admin.hotel.shift', [
            'books' => $filter,
            'pegawais' => User::where('id_hotel', $request->id)
                ->where('role', 0)
                ->get(),
            'hotel' => $hotel,
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
        return Excel::download(new ShiftExport($myId, $request->from, $request->to, $request->id_user, $request->tipee), 'users.xlsx');
    }
}
