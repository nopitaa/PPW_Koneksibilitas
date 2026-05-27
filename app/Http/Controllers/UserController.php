<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\Perusahaan;
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
            return redirect()->route('home')
                ->with('login_success', 'Selamat datang, ' . Auth::user()->nama_depan . '!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function beranda()
    {
        // Hanya tampilkan 8 lowongan terbaru yang sudah disetujui
        $data = Lowongan::with('perusahaan')
            ->where('status', 'disetujui')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('user.beranda', compact('data'));
    }

    public function karir(Request $request)
    {
        $query = Lowongan::with('perusahaan')
            ->where('status', 'disetujui')
            ->orderBy('created_at', 'desc');

        // Search: posisi, kategori, atau nama perusahaan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'like', "%{$search}%")
                  ->orWhere('kategori_pekerjaan', 'like', "%{$search}%")
                  ->orWhereHas('perusahaan', function ($qp) use ($search) {
                      $qp->where('nama_perusahaan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan kategori pekerjaan
        if ($request->filled('kategori')) {
            $query->where('kategori_pekerjaan', $request->kategori);
        }

        $lowongan = $query->paginate(12)->withQueryString();

        // Ambil semua kategori yang tersedia untuk dropdown filter
        $kategoris = Lowongan::where('status', 'disetujui')
            ->whereNotNull('kategori_pekerjaan')
            ->distinct()
            ->pluck('kategori_pekerjaan')
            ->sort()
            ->values();

        $totalLowongan = Lowongan::where('status', 'disetujui')->count();

        return view('user.karir', compact('lowongan', 'kategoris', 'totalLowongan'));
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

        return redirect()->route('home')
            ->with('logout_success', 'Anda berhasil logout. Sampai jumpa!');
    }
}
