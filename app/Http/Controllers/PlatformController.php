<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class PlatformController extends Controller
{


    public function index()
    {
        return view('platform.index', [
            'platforms' => Platform::all(),
        ]);
    }

    public function create()
    {
        return view('platform.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform_name' => ['required', 'string', 'max:255'],
            'platform_fee' => ['required', 'integer'],
        ]);

        Platform::create([
            'platform_name' => $request->platform_name,
            'platform_fee' => $request->platform_fee,
        ]);

        return redirect('/dashboard/platform')->with('success', 'Berhasil Menambahkan Platform Baru');
    }
    public function edit(Platform $platform, Request $request)
    {
        $platform = Platform::where('id', $request->id)->first();
        return view('platform.edit', [
            'platform' => $platform,
        ]);
    }
    public function update(Request $request, Platform $platform)
    {
        $request->validate([
            'platform_name' => ['required', 'string', 'max:255'],
            'platform_fee' => ['required', 'integer'],
        ]);

        Platform::where('id', $request->id)->update([
            'platform_name' => $request->platform_name,
            'platform_fee' => $request->platform_fee,
        ]);

        return redirect('/dashboard/platform')->with('success', 'Berhasil Mengubah User');
    }
    public function destroy(Platform $platform, Request $request)
    {
        Platform::destroy($request->id);

        return redirect('/dashboard/platform')->with('delete', 'Telah Dihapus');
    }
}
