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
           
        ]);

        // Buat user baru
        User::create([
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password)
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
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
}
