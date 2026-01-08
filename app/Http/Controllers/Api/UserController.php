<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;


class UserController extends Controller
{
   public function getStatusLamaranApi(Request $request)
    {
        $user = $request->user();
        $query = Lamaran::with(['lowongan.perusahaan'])
            ->where('user_id', $user->user_id) 
            ->orderBy('created_at', 'desc');
            
        $status = $request->query('status');
        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        $data = $query->get();
        $formattedData = $data->map(function($item) {
            $lowongan = $item->lowongan;
            $perusahaan = $lowongan ? $lowongan->perusahaan : null;
            
            return [
                'id' => $item->lamaran_id,
                'status' => $item->status, 
                'tanggal' => $item->created_at->format('d M Y'), 
                'posisi' => $lowongan ? $lowongan->posisi : 'Posisi Tidak Ditemukan',
                'perusahaan' => $perusahaan ? $perusahaan->nama_perusahaan : 'Perusahaan Tidak Ditemukan',
                
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedData,
        ]);
    }
}
?>