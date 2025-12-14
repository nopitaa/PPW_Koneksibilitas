<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Lowongan;
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

    public function GetLowongan()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('perusahaan_id', $perusahaan->perusahaan_id)->get();

        return view('perusahaan.views', [
            'lowongan' => $lowongan
        ]);
    }

    public function editLowongan($id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->first();

        if (!$lowongan) {
            return redirect()->back()->with('error', 'Lowongan tidak ditemukan.');
        }

        return view('perusahaan.edit', compact('lowongan'));
    }

    public function updateLowongan(Request $request, $id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $request->validate([
            'posisi' => 'required',
            'persyaratan' => 'required',
            'kategori_pekerjaan' => 'required'
        ]);

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->first();

        if (!$lowongan) {
            return redirect()->back()->with('error', 'Data lowongan tidak ditemukan.');
        }

        $lowongan->update([
            'posisi' => $request->posisi,
            'persyaratan' => $request->persyaratan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
        ]);

        return redirect()->route('informasi-lowongan')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

}
