<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PerusahaanController extends Controller
{
    public function showLogin()
    {
        return view('perusahaan.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $perusahaan = Perusahaan::where('email', $request->email)->first();

        if (!$perusahaan) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        if (!Hash::check($request->password, $perusahaan->password)) {
            return back()->with('error', 'Password salah.');
        }

        Session::put('perusahaan', $perusahaan);

        return redirect()->route('perusahaan-dashboard');
    }

    public function dashboard()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        return view('perusahaan.Dashboard', [
            'perusahaan' => Session::get('perusahaan')
        ]);
    }

    public function logout()
    {
        Session::forget('perusahaan');

        Session::flush();

        return redirect()->route('login-perusahaan')->with('success', 'Berhasil logout.');
    }
}
