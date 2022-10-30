<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Hotel;

class LogController extends Controller
{
    public function index(Request $request)
    {
        if (count($request->all()) == 0) {
            $logs = Log::latest()->get();
        } else {
            $logs = Log::where('id_hotel', $request->id_hotel)->latest()->get();
        }
        return view('admin.hotel.log', [
            'logs' => $logs,
            'hotels' => Hotel::all(),
        ]);
    }
}
