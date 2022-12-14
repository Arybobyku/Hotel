<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotelId = Auth::user()->id_hotel;
        return view('employee.asset.index', [
            'assets' => Asset::where('id_hotel', $hotelId)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.asset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:11',
            'satuan' => 'required|max:255',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->hasfile('image')) {
            $nama = $request->file('image')->store('images/asset-images');
        } else {
            $nama = null;
        }

        Asset::create([
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'id_hotel' => $hotelId,
            'image' => $nama,
        ]);
        Log::create([
            'activity' => "$nameUser Menambah Asset Barang $request->name $request->jumlah $request->satuan",
            'id_hotel' => $hotelId,
        ]);

        return redirect('/hotel/asset')->with('success', 'Asset Barang Baru Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        return view('employee.asset.show', [
            'asset' => $asset,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        return view('employee.asset.edit', [
            'asset' => $asset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:11',
            'satuan' => 'required|max:255',
            'image' => 'image|file|max:1024',
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('asset-images');
        }
        Asset::where('id', $asset->id)->update($validatedData);
        Log::create([
            'activity' => "$nameUser Mengubah Asset Barang $request->name $request->jumlah $request->satuan",
            'id_hotel' => $hotelId,

        ]);
        return redirect('hotel/asset')->with('status', 'Berhasil Mengedit Asset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Asset $asset)
    {
        $nameUser = Auth::user()->name;
        $hotelId = Auth::user()->id_hotel;

        Asset::destroy($asset->id);
        Log::create([
            'activity' => "$nameUser Menghapus Asset Barang $asset->name",
            'id_hotel' => $hotelId,

        ]);
        return redirect('hotel/asset')->with('status', 'Berhasil Menghapus Asset');
    }
}
