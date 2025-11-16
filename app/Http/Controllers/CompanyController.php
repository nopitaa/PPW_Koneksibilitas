<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function loginPage()
    {
        return "Halaman Login Perusahaan";
    }

    public function index()
    {
        // Dummy data untuk halaman perusahaan
        $companies = [
            (object)[
                'id' => 1,
                'company_id' => 'C002',
                'name' => 'PT Digital Maju',
                'position' => 'Backend Developer',
                'status' => 'Disetujui'
            ]
        ];

        return view('admin.perusahaan', compact('companies'));
    }

    public function dashboard(Request $request)
{
    // Data dummy untuk dashboard admin
    $companies = [
        (object)[
            'id' => 1,
            'company_id' => 'C001',
            'name' => 'PT Teknologi Cerdas',
            'position' => 'Frontend Developer',
            'status' => 'Pengajuan'
        ],
        (object)[
            'id' => 2,
            'company_id' => 'C002',
            'name' => 'PT Digital Maju',
            'position' => 'Backend Developer',
            'status' => 'Disetujui'
        ],
        (object)[
            'id' => 3,
            'company_id' => 'C003',
            'name' => 'PT Inovasi Solusi',
            'position' => 'UI/UX Designer',
            'status' => 'Ditolak'
        ]
    ];

    return view('admin.dashboard', compact('companies'));
}


    // ============================
    //   APPROVE & REJECT DUMMY
    // ============================

    public function approve($id)
    {
        return back()->with('success', "Lowongan ID $id berhasil disetujui (dummy)");
    }

    public function reject($id)
    {
        return back()->with('error', "Lowongan ID $id ditolak (dummy)");
    }
}
