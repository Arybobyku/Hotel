<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();
        $book = Book::where('id_hotel', $idHotel)->where('id_user', $idUser)->get();
        return view('employee.shift', [
            "books" => $book,
        ]);
    }
}
