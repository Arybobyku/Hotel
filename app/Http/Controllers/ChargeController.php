<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\ChargeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChargeController extends Controller
{


    public function index()
    {
        return view('charge.index', [
            'charges' => ChargeType::all(),
        ]);
    }

    public function create()
    {
        return view('charge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namecharge' => ['required', 'string', 'max:255'],
            'charge' => ['required', 'integer'],
        ]);

        ChargeType::create([
            'name' => $request->namecharge,
            'charge' => $request->charge,
        ]);

        return redirect('/dashboard/charge')->with('success', 'Berhasil Menambahkan User Baru');
    }
    public function edit(ChargeType $charge, Request $request)
    {
        $charge = ChargeType::where('id', $request->id)->first();
        return view('charge.edit', [
            'charge' => $charge,
        ]);
    }
    public function update(Request $request, ChargeType $charge)
    {
        $request->validate([
            'namecharge' => ['required', 'string', 'max:255'],
            'charge' => ['required', 'integer'],
        ]);

        ChargeType::where('id', $request->id)->update([
            'name' => $request->namecharge,
            'charge' => $request->charge,
        ]);

        return redirect('/dashboard/charge')->with('success', 'Berhasil Mengubah User');
    }
    public function destroy(ChargeType $charge, Request $request)
    {
        ChargeType::destroy($request->id);

        return redirect('/dashboard/charge')->with('delete', 'Telah Dihapus');
    }
}
