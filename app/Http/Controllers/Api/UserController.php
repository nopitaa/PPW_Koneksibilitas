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

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $status = $request->query('status');

        $query = Lamaran::with(['lowongan.perusahaan'])
            ->where('user_id', $user->id) 
            ->orderBy('created_at', 'desc');
            
        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        $data = $query->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
?>