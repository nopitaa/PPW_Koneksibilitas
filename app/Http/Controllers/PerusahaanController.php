<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'nama_perusahaan'   => 'required|string|max:255',
            'alamat'            => 'required|string',
            'email'             => 'required|email|unique:perusahaan,email',
            'nomor_npwp'        => 'required|string',
            'password'          => 'required|min:6|confirmed',
            'dokumen_legalitas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload dokumen legalitas jika ada
        $pathDokumen = null;
        if ($request->hasFile('dokumen_legalitas')) {
            $pathDokumen = $request->file('dokumen_legalitas')
                ->store('dokumen_legalitas', 'public');
        }

        $perusahaan = Perusahaan::create([
            'nama_perusahaan'   => $request->nama_perusahaan,
            'alamat'            => $request->alamat,
            'email'             => $request->email,
            'nomor_npwp'        => $request->nomor_npwp,
            'password'          => Hash::make($request->password),
            'dokumen_legalitas' => $pathDokumen,
        ]);

        Session::put('perusahaan', $perusahaan);

        return redirect()->route('perusahaan-dashboard');
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
        Session::flush();
        return redirect()->route('login-perusahaan');
    }

    public function dashboard()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        $jumlahLowongan = Lowongan::where('perusahaan_id', $perusahaan->perusahaan_id)->count();

        $jumlahPelamar = Lowongan::where('perusahaan_id', $perusahaan->perusahaan_id)
            ->withCount('lamaran')
            ->get()
            ->sum('lamaran_count');

        return view('perusahaan.dashboard', compact(
            'perusahaan',
            'jumlahLowongan',
            'jumlahPelamar'
        ));
    }

    public function GetLowongan()
    {
        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('perusahaan_id', $perusahaan->perusahaan_id)->get();
        return view('perusahaan.views', compact('lowongan'));
    }

    public function formLowongan()
    {
        return view('perusahaan.form');
    }

    public function addLowongan(Request $request)
    {
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

        return redirect()->route('informasi-lowongan');
    }

    public function detailLowongan($id)
    {
        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        return view('perusahaan.detail', compact('lowongan'));
    }

    public function editLowongan($id)
    {
        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        return view('perusahaan.edit', compact('lowongan'));
    }

    public function updateLowongan(Request $request, $id)
    {
        $request->validate([
            'posisi'             => 'required',
            'persyaratan'        => 'required',
            'kategori_pekerjaan' => 'required',
        ]);

        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        $lowongan->update([
            'posisi'             => $request->posisi,
            'persyaratan'        => $request->persyaratan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
        ]);

        return redirect()->route('informasi-lowongan');
    }

    public function deleteLowongan($id)
    {
        $perusahaan = Session::get('perusahaan');

        $lowongan = Lowongan::where('lowongan_id', $id)
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->firstOrFail();

        $lowongan->lamaran()->delete();
        $lowongan->delete();

        return redirect()->route('informasi-lowongan');
    }

    // ─── DATA PELAMAR ────────────────────────────────────────────────

    public function dataPelamar()
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $perusahaan = Session::get('perusahaan');

        // Ambil semua lowongan milik perusahaan beserta pelamar & data user-nya
        $lowongans = Lowongan::where('perusahaan_id', $perusahaan->perusahaan_id)
            ->with(['lamaran' => function ($query) {
                $query->with('user')->orderBy('updated_at', 'desc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('perusahaan.pelamar', compact('lowongans', 'perusahaan'));
    }

    public function updateStatusLamaran(Request $request, $id)
    {
        if (!Session::has('perusahaan')) {
            return redirect()->route('login-perusahaan');
        }

        $request->validate([
            'status' => 'required|in:Terkirim,Diproses,Diterima,Ditolak',
        ]);

        $perusahaan = Session::get('perusahaan');

        // Pastikan lamaran ini milik lowongan yang dimiliki perusahaan yang login
        $lamaran = Lamaran::whereHas('lowongan', function ($query) use ($perusahaan) {
                $query->where('perusahaan_id', $perusahaan->perusahaan_id);
            })
            ->where('lamaran_id', $id)
            ->firstOrFail();

        $lamaran->status     = $request->status;
        $lamaran->updated_at = now();
        $lamaran->save();

        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
