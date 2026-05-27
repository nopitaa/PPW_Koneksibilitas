<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Email atau password salah');
        }

        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_email' => $admin->email
        ]);

        return redirect()->route('dashboard');
    }

    public function dashboard(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $keyword = $request->keyword;

        $lowongans = Lowongan::with('perusahaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('posisi', 'ILIKE', "%$keyword%")
                    ->orWhereHas('perusahaan', function ($q) use ($keyword) {
                        $q->where('nama_perusahaan', 'ILIKE', "%$keyword%");
                    });
            })
            ->orderBy('lowongan_id', 'desc')
            ->get();

        // Statistik untuk card summary
        $totalLowonganAktif  = Lowongan::where('status', 'disetujui')->count();
        $totalPerusahaan     = \App\Models\Perusahaan::count();
        $totalPending        = Lowongan::where('status', 'pending')
                                ->orWhereNull('status')->count();
        $totalDitolak        = Lowongan::where('status', 'ditolak')->count();

        return view('admin.dashboard', compact(
            'lowongans',
            'totalLowonganAktif',
            'totalPerusahaan',
            'totalPending',
            'totalDitolak'
        ));
    }

    // ✅ APPROVE (pakai status varchar)
    public function approve(Request $request, $id)
    {
        Lowongan::where('lowongan_id', $id)->update([
            'status' => 'disetujui'
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Lowongan berhasil disetujui',
                'stats' => [
                    'aktif' => Lowongan::where('status', 'disetujui')->count(),
                    'perusahaan' => \App\Models\Perusahaan::count(),
                    'pending' => Lowongan::where('status', 'pending')->orWhereNull('status')->count(),
                    'ditolak' => Lowongan::where('status', 'ditolak')->count(),
                ]
            ]);
        }

        return back()->with('success', 'Lowongan berhasil disetujui');
    }

    // ✅ REJECT (pakai status varchar)
    public function reject(Request $request, $id)
    {
        Lowongan::where('lowongan_id', $id)->update([
            'status' => 'ditolak'
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Lowongan ditolak',
                'stats' => [
                    'aktif' => Lowongan::where('status', 'disetujui')->count(),
                    'perusahaan' => \App\Models\Perusahaan::count(),
                    'pending' => Lowongan::where('status', 'pending')->orWhereNull('status')->count(),
                    'ditolak' => Lowongan::where('status', 'ditolak')->count(),
                ]
            ]);
        }

        return back()->with('success', 'Lowongan ditolak');
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_email']);
        return redirect()->route('admin.login');
    }
    public function perusahaan()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $lowongans = Lowongan::with('perusahaan')
            ->where('status', 'disetujui')
            ->get();

        return view('admin.perusahaan', compact('lowongans'));
    }

    public function pengajuan(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $keyword = $request->keyword;

        $lowongans = Lowongan::with('perusahaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('posisi', 'ILIKE', "%$keyword%")
                    ->orWhereHas('perusahaan', function ($q) use ($keyword) {
                        $q->where('nama_perusahaan', 'ILIKE', "%$keyword%");
                    });
            })
            ->orderBy('lowongan_id', 'desc')
            ->get();

        return view('admin.pengajuan', compact('lowongans'));
    }

}
