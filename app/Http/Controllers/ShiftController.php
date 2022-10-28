<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();

       if(count($request->all()) == 0) {
        $from = date('2022-10-01');
        $to = date('2022-10-31');
        }
        else 
        {
        $from = $request->from;
        $to = $request->to;
        }
        $filter= Book::whereBetween('book_date', [$from, $to])->where('id_user', $idUser)->get();
        session()->flashInput($request->input());
        $book = Book::where('id_hotel', $idHotel)
            ->where('id_user', $idUser)
            ->get();
        return view('employee.shift', [
            'books' => $filter,
        ]);
    }
}