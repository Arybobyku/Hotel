<?php

namespace App\Http\Controllers;

use App\Models\Asset;
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
        $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:11',
            'satuan' => 'required|max:255',
            'image' => 'image|file|max:1024',
        ]);

        if($request->hasfile('image'))
        {
            $request->file('image')->move(public_path('images/asset-images/'), $request->file('image')->getClientOriginalName());
        }


        Asset::create([
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'id_hotel' => $hotelId,
            'image' => $request->image = 'images/asset-images/' . $request->file('image')->getClientOriginalName(),
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
            'asset' => $asset
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
