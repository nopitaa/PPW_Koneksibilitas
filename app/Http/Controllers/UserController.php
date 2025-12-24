<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
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
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
            ],
        ]);

        User::create([
            'email'         => $request->email,
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil.');
    }

    public function formLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function beranda()
    {
        $data = Lowongan::with('perusahaan')->get();
        return view('user.beranda', compact('data'));
    }

    public function show($id)
    {
        $lowongan = Lowongan::with('perusahaan')
            ->where('lowongan_id', $id)
            ->firstOrFail();

        return view('user.info-lowongan', compact('lowongan'));
    }

    public function statuslamaran(Request $request)
    {
        $userId = Auth::id();
        $status = $request->query('status');

        $query = Lamaran::with(['lowongan.perusahaan'])
            ->where('user_id', $userId);

        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        $data = $query->get();

        return view('user.status-lamaran', compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda berhasil logout.');
    }
}
