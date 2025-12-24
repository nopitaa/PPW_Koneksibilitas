<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\keterampilan;
use App\Models\User;
use Illuminate\Http\Request;

class KeterampilanController extends Controller
{
    /**
     * =====================
     * GET ALL KETERAMPILAN (API)
     * =====================
     */
    public function index()
    {
        $keterampilan = keterampilan::orderBy('nama_keterampilan')->get();

        return response()->json([
            'success' => true,
            'data' => $keterampilan->map(function ($item) {
                return [
                    'id' => $item->keterampilan_id,
                    'nama' => $item->nama_keterampilan
                ];
            })
        ]);
    }

    /**
     * =====================
     * GET USER KETERAMPILAN (API)
     * =====================
     */
    public function getUserSkills(Request $request)
    {
        $user = $request->user();
        
        $skills = $user->keterampilan;

        return response()->json([
            'success' => true,
            'data' => $skills->map(function ($item) {
                return [
                    'id' => $item->keterampilan_id,
                    'nama' => $item->nama_keterampilan
                ];
            })
        ]);
    }

    /**
     * =====================
     * SYNC USER KETERAMPILAN (API)
     * =====================
     */
    public function syncUserSkills(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'keterampilan_ids' => 'required|array',
            'keterampilan_ids.*' => 'exists:keterampilan,keterampilan_id',
        ]);

        $user->keterampilan()->sync($request->keterampilan_ids);

        return response()->json([
            'success' => true,
            'message' => 'Keterampilan berhasil disinkronkan',
            'data' => $user->keterampilan->map(function ($item) {
                return [
                    'id' => $item->keterampilan_id,
                    'nama' => $item->nama_keterampilan
                ];
            })
        ]);
    }
}

