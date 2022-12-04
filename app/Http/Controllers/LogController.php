<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Hotel;

class LogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id_hotel == Null) {
            $logs = Log::latest()->paginate(15);
        } else {
            $logs = Log::where('id_hotel', $request->id_hotel)->latest()->paginate(15);
        }
        return view('admin.hotel.log', [
            'logs' => $logs,
            'hotels' => Hotel::all(),
        ]);
    }
}
