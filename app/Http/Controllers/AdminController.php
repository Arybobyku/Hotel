<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', ['hotels' => Hotel::all()]);
    }

    public function index()
    {
        return view('users.index', [
            'users' => User::whereNotNull('id_hotel')->get(),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'hotels' => Hotel::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 0,
            'id_hotel' => $request->id_hotel,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/dashboard/user')->with('success', 'Berhasil Menambahkan User Baru');
    }
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'hotels' => Hotel::all(),
        ]);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'id_hotel' => ['required'],
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 0,
            'id_hotel' => $request->id_hotel,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/dashboard/user')->with('success', 'Berhasil Mengubah User');
    }
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/dashboard/user')->with('delete', 'Isi Materi Baru Telah Dihapus');
    }
}
