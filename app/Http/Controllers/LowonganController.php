<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function show(Lowongan $lowongan)
    {
        $saved = Session::get('saved_lowongan', []);
        $isSaved = in_array($lowongan->lowongan_id, $saved);

        return view('user.info-lowongan', compact('lowongan', 'isSaved'));
    }

    // ✅ INI YANG KURANG
    public function simpan()
    {
        return $this->tersimpanSession();
    }

    public function toggleSimpanSession($id)
    {
        $saved = Session::get('saved_lowongan', []);

        if (in_array($id, $saved)) {
            $saved = array_diff($saved, [$id]);
            $status = false;
        } else {
            $saved[] = $id;
            $status = true;
        }

        Session::put('saved_lowongan', $saved);

        return response()->json(['saved' => $status]);
    }

    public function tersimpanSession()
    {
        $ids = Session::get('saved_lowongan', []);

        $lowongan = Lowongan::with('perusahaan')
            ->whereIn('lowongan_id', $ids)
            ->get();

        return view('user.lowongan-tersimpan', compact('lowongan'));
    }
}
