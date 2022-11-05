<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Hotel;
use App\Models\User;
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

        if ((empty($request->input('from')) || empty($request->input('to'))) && $request->id_user) {
            $filter = Book::where('id_user', $request->id_user)->get();
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && $request->id_user) {
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->get();
        }
           elseif (!empty($request->input('from')) && !empty($request->input('to')) && empty($request->input('id_user'))) {
            $from = $request->from;
            $to = $request->to;
            $filter = Book::whereBetween('book_date', [$from, $to])
                ->where('id_hotel', $request->id)
                ->get();
            

        } 

     else {
            $filter = Book::where('id_hotel', $request->id)->get();
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
        User::where('id', $myId)->update([
            'id_hotel' => $request->id,
        ]);
        $hotel = Hotel::where('id', $myId)->first();
        $book = Book::where('id', $request->id)->first();
        return view('admin.hotel.shiftdetail', [
            'books' => $book,
            'hotel' => $hotel,
        ]);
    }
    public function export(Request $request) 
    {
        
        $from=$request->from;
        $to = $request->to;
        $id = $request->id;
        $id_user = $request->id_user;
        return Excel::download(new ShiftExport ($request->id, $request->from, $request->to, $request->id_user), 'users.xlsx');
    }
}
