<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Company::query();

        // Filter berdasarkan ID Perusahaan
        if ($request->filled('company_id')) {
            $query->where('company_id', 'like', '%' . $request->company_id . '%');
        }

        // Filter berdasarkan Status
        if ($request->filled('status') && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Ambil semua data sesuai filter
        $companies = $query->get();

        return view('dashboard', compact('companies'));
    }


    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'Disetujui']);

        return redirect()->back()->with('success', 'Lowongan berhasil disetujui!');
    }

    public function reject($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'Ditolak']);

        return redirect()->back()->with('error', 'Lowongan telah ditolak.');
    }

    public function index()
    {
        // Halaman perusahaan hanya menampilkan data yang sudah disetujui
        $companies = Company::where('status', 'Disetujui')->get();

        return view('perusahaan', compact('companies'));
    }
}
