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

        return view('admin.dashboard', compact('lowongans'));
    }

    public function approve($id)
    {
        Lowongan::where('lowongan_id', $id)->update([
            'approved_at' => now()
        ]);

        return back()->with('success', 'Lowongan berhasil disetujui');
    }

    public function reject($id)
    {
        // Tidak ubah apapun, hanya notif
        return back()->with('success', 'Lowongan ditolak');
    }





   public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_email']);
        return redirect()->route('admin.login');
    }

}
