<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exports\SpendingExport;
use App\Models\Spending;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ShiftSpendingController extends Controller
{
    public function index(Request $request)
    {
        $idHotel = Auth::user()->id_hotel;
        $idUser = Auth::id();

        if ((empty($request->input('from')) || empty($request->input('to'))) && $request->id_user) {
            $filter = Spending::where('id_user', $request->id_user)
                ->latest()->paginate(15);
                
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && $request->id_user) {
            $from = $request->from;
            $to = $request->to;
            $filter = Spending::whereBetween('tanggal', [$from, $to])
                ->where('id_hotel', $request->id)
                ->where('id_user', $request->id_user)
                ->latest()->paginate(15);
        } elseif (!empty($request->input('from')) && !empty($request->input('to')) && empty($request->input('id_user'))) {
            $from = $request->from;
            $to = $request->to;
            $filter = Spending::whereBetween('tanggal', [$from, $to])
                ->where('id_hotel', $request->id)
                ->latest()->paginate(15);
        } else {
            $filter = Spending::where('id_hotel', $request->id)
                ->latest()->paginate(15);
        }
        session()->flashInput($request->input());
        $hotel = Hotel::where('id', $request->id)->first();

        return view('admin.hotel.spending', [
            'spendings' => $filter,
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
        $spending = Spending::where('id', $request->id)->first();
        return view('admin.hotel.spendingdetail', [
            'spending' => $spending,
            'hotel' => $hotel,
        ]);
    }
    public function export(Request $request)
    {
        $myId = Auth::user()->id_hotel;
        return Excel::download(new SpendingExport($myId, $request->from, $request->to, $request->id_user), 'pengeluaran.xlsx');
    }
}
