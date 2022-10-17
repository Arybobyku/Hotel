<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
 
    public function dashboard(){
        return view('dashboard',['hotels'=>Hotel::all()]);
    }

    public function index(){
        return view('users.index', [
            'users' => User::whereNotNull('id_hotel')->get()
        ]);
    }

    public function create(){
        return view('users.create',[
            'hotels' => Hotel::all()
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);


       User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 0,
            'id_hotel'=>$request->id_hotel,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/dashboard/user')->with('success', 'Berhasil Menambahkan User Baru');
        

    }
}
