<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function formRegister()
    {  
        return view('user.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'         => 'required|email|unique:users',
           'nama_depan'    => 'required|string|max:255',
           'nama_belakang' => 'required|string|max:255',
           'jenis_kelamin' => 'required',
            'password'     => 'required|min:8'
        ]);

        // Buat user baru
        User::create([
            'email' => $request->email,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function formLogin()
    {  
        return view('user.login');
    }
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            //regenerasi session ID 
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

     public function Beranda()
    {  
        return view('user.beranda');
    }
}
