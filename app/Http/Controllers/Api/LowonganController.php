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
            ->whereNotNull('status')  // Hanya lowongan yang sudah disetujui
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q
                    ->where('posisi', 'ILIKE', "%{$search}%")
                    ->orWhere('kategori_pekerjaan', 'ILIKE', "%{$search}%")
                    ->orWhereHas('perusahaan', function ($qp) use ($search) {
                        $qp->where('nama_perusahaan', 'ILIKE', "%{$search}%");
                    });
            });
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
    public function show($lowongan_id)
    {
        $lowongan = Lowongan::with('perusahaan')
            ->whereNotNull('status')
            ->find($lowongan_id);

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
                'created_at' => $lowongan->created_at ? $lowongan->created_at->format('Y-m-d H:i:s') : null,
                'status' => $lowongan->status ? $lowongan->status->format('Y-m-d H:i:s') : null,
            ]
        ]);
    }
}
