<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    // ============================
    // LOGIN PERUSAHAAN
    // ============================

    public function loginPage()
    {
        return view('company.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $company = Perusahaan::where('email', $request->email)->first();

        if (!$company || !Hash::check($request->password, $company->password)) {
            return back()->with('error', 'Email atau password salah');
        }

        session(['company_id' => $company->perusahaan_id]);

        return redirect()->route('company.dashboard');
    }

    public function logout()
    {
        session()->forget('company_id');
        return redirect()->route('company.login');
    }

    // ============================
    // ADMIN - DASHBOARD (PENGAJUAN)
    // ============================

    public function dashboard(Request $request)
    {
        $query = Lowongan::with('perusahaan')
            ->where('status', 'menunggu'); // ✅ FIX

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('posisi', 'ILIKE', "%$keyword%")
                  ->orWhereHas('perusahaan', function ($sub) use ($keyword) {
                      $sub->where('nama_perusahaan', 'ILIKE', "%$keyword%");
                  });
            });
        }

        $companies = $query->get()->map(function ($lowongan) {
            return (object)[
                'id'         => $lowongan->lowongan_id,
                'company_id' => $lowongan->perusahaan->perusahaan_id,
                'name'       => $lowongan->perusahaan->nama_perusahaan,
                'position'   => $lowongan->posisi
            ];
        });

        return view('admin.dashboard', compact('companies'));
    }

    // ============================
    // ADMIN - PERUSAHAAN
    // (LOWONGAN DISETUJUI)
    // ============================

    public function index()
    {
        $companies = Lowongan::with('perusahaan')
            ->where('status', 'disetujui') // ✅ FIX
            ->get()
            ->map(function ($lowongan) {
                return (object)[
                    'company_id' => $lowongan->perusahaan->perusahaan_id,
                    'name'       => $lowongan->perusahaan->nama_perusahaan,
                    'position'   => $lowongan->posisi,
                ];
            });

        return view('admin.perusahaan', compact('companies'));
    }

    // ============================
    // DASHBOARD PERUSAHAAN
    // ============================

    public function companyDashboard()
    {
        $companyId = session('company_id');

        if (!$companyId) {
            return redirect()->route('company.login');
        }

        $companies = Lowongan::where('perusahaan_id', $companyId)
            ->where('status', 'disetujui') // ✅ FIX
            ->get();

        return view('company.dashboard', compact('companies'));
    }
}
