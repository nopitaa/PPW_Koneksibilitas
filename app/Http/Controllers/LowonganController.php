<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function simpan()
    {
        // Ambil data lowongan + perusahaan
        $lowongan = Lowongan::with('perusahaan')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('user.lowongan-tersimpan', compact('lowongan'));

    }
        public function show($id)
    {
        $lowongan = Lowongan::with('perusahaan')->findOrFail($id);
        return view('user.info-lowongan', compact('lowongan'));
    }
}
