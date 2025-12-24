<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * =====================
     * LIST LOWONGAN (MOBILE)
     * =====================
     */
    public function index(Request $request)
    {
        $query = Lowongan::with('perusahaan')
            ->whereNotNull('approved_at') // Hanya lowongan yang sudah disetujui
            ->orderBy('created_at', 'desc');

        // Filter by kategori
        if ($request->has('kategori')) {
            $query->where('kategori_pekerjaan', $request->kategori);
        }

        // Filter by perusahaan
        if ($request->has('perusahaan_id')) {
            $query->where('perusahaan_id', $request->perusahaan_id);
        }

        // Search by posisi
        if ($request->has('search')) {
            $query->where('posisi', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $lowongan = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $lowongan->items(),
            'pagination' => [
                'current_page' => $lowongan->currentPage(),
                'last_page' => $lowongan->lastPage(),
                'per_page' => $lowongan->perPage(),
                'total' => $lowongan->total(),
            ]
        ]);
    }

    /**
     * =====================
     * DETAIL LOWONGAN
     * =====================
     */
    public function show($id)
    {
        $lowongan = Lowongan::with('perusahaan')
            ->whereNotNull('approved_at')
            ->find($id);

        if (!$lowongan) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $lowongan->lowongan_id,
                'posisi' => $lowongan->posisi,
                'kategori_pekerjaan' => $lowongan->kategori_pekerjaan,
                'persyaratan' => $lowongan->persyaratan,
                'perusahaan' => [
                    'id' => $lowongan->perusahaan->perusahaan_id ?? null,
                    'nama' => $lowongan->perusahaan->nama_perusahaan ?? null,
                    'alamat' => $lowongan->perusahaan->alamat ?? null,
                    'email' => $lowongan->perusahaan->email ?? null,
                ],
                'created_at' => $lowongan->created_at->format('Y-m-d H:i:s'),
                'approved_at' => $lowongan->approved_at ? $lowongan->approved_at->format('Y-m-d H:i:s') : null,
            ]
        ]);
    }
}
