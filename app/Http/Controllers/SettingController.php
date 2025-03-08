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
        return view('employee.setting.edit', [
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
    $myId = Auth::user()->id;

    // Validasi input termasuk gambar
    $validatedData = $request->validate([
        'text_color' => 'required|max:255',
        'header_bg_color' => 'required|max:255',
        'sidebar_bg_color' => 'required|max:255',
        'background_image' => 'image|file', // Validasi gambar
    ]);

    // Jika ada file gambar diupload
    if ($request->file('background_image')) {
        $validatedData['background_image'] = $request->file('background_image')->store('images/backgrounds');
    }

    // Update data user
    User::where('id', $id)->update($validatedData);

    return redirect('admin/setting/' . $myId)->with('status', 'Berhasil Mengedit Profile');
}

public function adminedit(User $user)
    {
        $textColor = TextColor::all();
        $bgColor = BackgroundColor::all();
        return view('employee.setting.edit', [
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
public function adminupdate(Request $request, $id)
{
    $myId = Auth::user()->id;

    // Validasi input termasuk gambar
    $validatedData = $request->validate([
        'text_color' => 'required|max:255',
        'header_bg_color' => 'required|max:255',
        'sidebar_bg_color' => 'required|max:255',
        'background_image' => 'image|file', // Validasi gambar
    ]);

    // Jika ada file gambar diupload
    if ($request->file('background_image')) {
        $validatedData['background_image'] = $request->file('background_image')->store('images/backgrounds');
    }

    // Update data user
    User::where('id', $id)->update($validatedData);

    return redirect('admin/setting/' . $myId)->with('status', 'Berhasil Mengedit Profile');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */

}
