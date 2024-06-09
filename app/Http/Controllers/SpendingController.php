<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->from == null && $request->to == null) {
            $from = date('2010-10-01');
            $to = date('2040-10-31');
        } else {
            $from = $request->from;
            $to = $request->to;
        }
        $hotelId = Auth::user()->id_hotel;

        $uangMKeluar = Spending::whereBetween('tanggal', [$from, $to])
                    ->where('id_hotel', $hotelId)
                    ->sum('jumlah');
        session()->flashInput($request->input());

        return view('employee.spending.index', [
            'spendings' => Spending::whereBetween('tanggal', [$from, $to])->where('id_hotel', $hotelId)->latest()->paginate(15),
            'grandUangKeluar' => $uangMKeluar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.spending.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:11',
            'tanggal' => 'required',
            'keterangan' => '',
            'image' => 'image|file',
        ]);
        if ($request->hasfile('image')) {
            $nama = $request->file('image')->store('images/asset-images');
        } else {
            $nama = null;
        }

        Spending::create([
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'id_hotel' => $hotelId,
            'image' => $nama,
        ]);
        Log::create([
            'activity' => "$nameUser Menambah Pengeluaran $request->name $request->jumlah $request->satuan",
            'id_hotel' => $hotelId,
        ]);

        return redirect('/hotel/spending')->with('success', 'Pengeluaran Baru Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Spending $spending)
    {
        return view('employee.spending.show', [
            'spending' => $spending,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending $spending)
    {
        return view('employee.spending.edit', [
            'spending' => $spending,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spending $spending)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:11',
            'tanggal' => 'required',
            'keterangan' => '',
            'image' => 'image|file',
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('asset-images');
        }
        Spending::where('id', $spending->id)->update($validatedData);
        Log::create([
            'activity' => "$nameUser Mengubah Pengeluaran $request->name $request->jumlah $request->satuan",
            'id_hotel' => $hotelId,
        ]);

        return redirect('hotel/spending')->with('status', 'Berhasil Mengedit Pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spending $spending)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        Spending::destroy($spending->id);
        Log::create([
            'activity' => "$nameUser Menghapus Pengeluaran $spending->name",
            'id_hotel' => $hotelId,
        ]);

        return redirect('hotel/spending')->with('status', 'Berhasil Menghapus');
    }
}
