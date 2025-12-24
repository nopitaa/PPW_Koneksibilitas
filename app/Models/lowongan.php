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

    public function showRegister()
    {
        return view('perusahaan.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat'          => 'required|string',
            'email'           => 'required|email|unique:perusahaan,email',
            'nomor_npwp'      => 'required|string',
            'password'        => 'required|min:6|confirmed',
        ]);

        $perusahaan = Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat'          => $request->alamat,
            'email'           => $request->email,
            'nomor_npwp'      => $request->nomor_npwp,
            'password'        => Hash::make($request->password),
        ]);

        Session::put('perusahaan', $perusahaan);

        return redirect()
            ->route('perusahaan-dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $perusahaan = Perusahaan::where('email', $request->email)->first();

        if (!$perusahaan || !Hash::check($request->password, $perusahaan->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        Session::put('perusahaan', $perusahaan);

        return redirect()->route('perusahaan-dashboard');
    }

    public function logout()
    {
        Session::forget('perusahaan');
        Session::flush();

        return redirect()
            ->route('login-perusahaan')
            ->with('success', 'Berhasil logout.');
    }


    public function dashboard()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $jumlahLowongan = Lowongan::where(
            'perusahaan_id',
            $perusahaan->perusahaan_id
        )->count();

        $jumlahPelamar = 0;

        return view('perusahaan.dashboard', compact(
            'perusahaan',
            'jumlahLowongan',
            'jumlahPelamar'
        ));
    }

    public function GetLowongan()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where(
            'perusahaan_id',
            $perusahaan->perusahaan_id
        )->get();

        return view('perusahaan.views', compact('lowongan'));
    }

    public function formLowongan()
    {
        return view('perusahaan.form');
    }

    public function addLowongan(Request $request)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $request->validate([
            'posisi'             => 'required',
            'persyaratan'        => 'required',
            'kategori_pekerjaan' => 'required'
        ]);

        $perusahaan = Session::get('perusahaan');

        Lowongan::create([
            'perusahaan_id'      => $perusahaan->perusahaan_id,
            'posisi'             => $request->posisi,
            'persyaratan'        => $request->persyaratan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan
        ]);

        return redirect()
            ->route('informasi-lowongan')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function editLowongan($id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        return view('perusahaan.edit', compact('lowongan'));
    }

    public function updateLowongan(Request $request, $id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $request->validate([
            'posisi'             => 'required',
            'persyaratan'        => 'required',
            'kategori_pekerjaan' => 'required'
        ]);

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        $lowongan->update($request->only([
            'posisi',
            'persyaratan',
            'kategori_pekerjaan'
        ]));

        return redirect()
            ->route('informasi-lowongan')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function deleteLowongan($id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->delete();

        return redirect()
            ->route('informasi-lowongan')
            ->with('success', 'Lowongan berhasil dihapus.');
    }

    public function detailLowongan($id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        return view('perusahaan.detail', compact('lowongan'));
    }
}
