<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

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
            'email' => [
                'required',
                'string',
                'email:dns',
                'unique:users'
            ],
            'nama_depan'    => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'password' => [
                'required',
                Password::min(8)     // Minimal 8 karakter
                    ->letters()      // Harus ada huruf
                    ->mixedCase()    // Harus ada Huruf Besar & Kecil
                    ->symbols()      // Harus ada Simbol (!, @, #, dll)
                    ->numbers()   // (Opsional) Kalau mau wajib ada angka juga
            ],
        ],
        [
            'password.min'     => 'Password minimal harus 8 karakter.',
            'password.mixed'   => 'Password harus mengandung huruf Besar dan Kecil.',
            'password.symbols' => 'Password harus mengandung minimal satu simbol unik (!, @, #, $, dll).',
            'password.letters' => 'Password harus mengandung huruf.',
            'email.unique'     => 'Email sudah terdaftar.',
            'email.email'      => 'Format email tidak valid.'
        ]);
        // Buat user baru
        User::create([
            'email' => $request->email,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),

        ]);
        return redirect()->route('login')->with('success', 'Silakan login.');
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
            // regenerasi session ID
            $request->session()->regenerate();
            // selalu redirect ke beranda setelah login, jangan ke intended (lamar dsb)
            return redirect()->route('home')->with('success','Selamat Datang di Koneksibilitas!');
        }
        return back()->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    public function Beranda()
    {
         $data = Lowongan::with('perusahaan')->get();

        return view('user.beranda', compact('data'));
    }

    public function show($id)
    {
        $lowongan = lowongan::with('perusahaan')
            ->where('lowongan_id', $id)
            ->firstOrFail();

        return view('user.info-lowongan', compact('lowongan'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
