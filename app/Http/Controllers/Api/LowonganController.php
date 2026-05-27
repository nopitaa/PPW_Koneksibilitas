<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{

    public function index(Request $request)
    {
        $query = Lowongan::with('perusahaan')
            ->where('status', 'disetujui')
            ->orderBy('created_at', 'desc');

        // SEARCH
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
     * LOWONGAN TERBARU (untuk dashboard)
     * Mengembalikan 8 lowongan terbaru tanpa pagination
     * =====================
     */
    public function terbaru()
    {
        $lowongan = Lowongan::with('perusahaan')
            ->where('status', 'disetujui')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                return [
                    'lowongan_id'        => $item->lowongan_id,
                    'posisi'             => $item->posisi,
                    'kategori_pekerjaan' => $item->kategori_pekerjaan,
                    'created_at'         => optional($item->created_at)->format('Y-m-d H:i:s'),
                    'perusahaan' => [
                        'nama'   => $item->perusahaan->nama_perusahaan ?? null,
                        'alamat' => $item->perusahaan->alamat ?? null,
                    ],
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $lowongan,
            'total'   => $lowongan->count(),
        ]);
    }

    /**
     * =====================
     * DETAIL LOWONGAN
     * =====================
     */
    public function show($lowongan_id)
    {
        $lowongan = Lowongan::with('perusahaan')
            ->where('lowongan_id', $lowongan_id)
            ->where('status', 'disetujui')
            ->first();

        if (!$lowongan) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'lowongan_id' => $lowongan->lowongan_id,
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
                'created_at' => optional($lowongan->created_at)->format('Y-m-d H:i:s'),
                'status' => $lowongan->status,
            ]
        ]);
    }
}
