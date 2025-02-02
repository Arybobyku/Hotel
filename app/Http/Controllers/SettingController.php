<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TextColor;
use App\Models\BackgroundColor;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{

    public function edit(User $user)
    {
        $textColor = TextColor::all();
        $bgColor = BackgroundColor::all();
        return view('admin.setting.edit', [
            'textColors' => TextColor::get(),
            'user' => $user,
            'bgColors' => BackgroundColor::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hotelId = Auth::user()->id_hotel;
        $nameUser = Auth::user()->name;
        $idUser = Auth::user()->id;
        $validatedData = $request->validate([
            'text_color' => 'required|max:255',
            'header_bg_color' => 'required|max:255',
            'sidebar_bg_color' => 'required|max:255',
        ]);
        // ddd($validatedData );
        User::where('id', $id)->update($validatedData);
        // Log::create([
        //     'activity' => "$nameUser Mengubah Asset Barang $request->name $request->jumlah $request->satuan",
        //     'id_hotel' => $hotelId,

        // ]);
        return redirect('hotel/setting/'. $idUser )->with('status', 'Berhasil Mengedit Profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */

}
