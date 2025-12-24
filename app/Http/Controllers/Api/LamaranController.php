<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LamaranController extends Controller
{
    /**
     * =====================
     * GET MY LAMARAN (API)
     * =====================
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        $lamaran = Lamaran::where('user_id', $user->user_id)
            ->with(['lowongan.perusahaan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $lamaran->map(function ($item) {
                return [
                    'id' => $item->lamaran_id,
                    'lowongan' => [
                        'id' => $item->lowongan->lowongan_id,
                        'posisi' => $item->lowongan->posisi,
                        'perusahaan' => $item->lowongan->perusahaan->nama_perusahaan ?? null,
                    ],
                    'nama_lengkap' => $item->nama_lengkap,
                    'email' => $item->email,
                    'status' => $item->status ?? 'pending',
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            })
        ]);
    }

    /**
     * =====================
     * GET DETAIL LAMARAN (API)
     * =====================
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        
        $lamaran = Lamaran::where('user_id', $user->user_id)
            ->with(['lowongan.perusahaan'])
            ->find($id);

        if (!$lamaran) {
            return response()->json([
                'success' => false,
                'message' => 'Lamaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $lamaran->lamaran_id,
                'lowongan' => [
                    'id' => $lamaran->lowongan->lowongan_id,
                    'posisi' => $lamaran->lowongan->posisi,
                    'kategori' => $lamaran->lowongan->kategori_pekerjaan,
                    'persyaratan' => $lamaran->lowongan->persyaratan,
                    'perusahaan' => [
                        'id' => $lamaran->lowongan->perusahaan->perusahaan_id ?? null,
                        'nama' => $lamaran->lowongan->perusahaan->nama_perusahaan ?? null,
                    ],
                ],
                'nama_lengkap' => $lamaran->nama_lengkap,
                'jenis_kelamin' => $lamaran->jenis_kelamin,
                'nomor_hp' => $lamaran->nomor_hp,
                'alamat_lengkap' => $lamaran->alamat_lengkap,
                'email' => $lamaran->email,
                'pendidikan' => $lamaran->pendidikan,
                'nama_institusi' => $lamaran->nama_institusi,
                'jurusan' => $lamaran->jurusan,
                'th_start' => $lamaran->th_start,
                'th_end' => $lamaran->th_end,
                'alat_bantu' => $lamaran->alat_bantu,
                'cv_url' => $lamaran->cv ? Storage::url($lamaran->cv) : null,
                'resume_url' => $lamaran->resume ? Storage::url($lamaran->resume) : null,
                'portofolio_url' => $lamaran->portofolio ? Storage::url($lamaran->portofolio) : null,
                'created_at' => $lamaran->created_at->format('Y-m-d H:i:s'),
            ]
        ]);
    }

    /**
     * =====================
     * CREATE LAMARAN (API)
     * =====================
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $profile = Profile::where('user_id', $user->user_id)->first();

        // Validasi lowongan exists
        $lowongan = Lowongan::find($request->lowongan_id);
        if (!$lowongan) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan'
            ], 404);
        }

        // Validasi CV (wajib jika tidak ada di profile)
        $cvRule = 'nullable|file|mimes:pdf,doc,docx|max:2048';
        if (!$profile || !$profile->cv_path) {
            $cvRule = 'required|' . $cvRule;
        }

        $data = $request->validate([
            'lowongan_id' => 'required|exists:lowongan,lowongan_id',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'nomor_hp' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'email' => 'required|email',
            'pendidikan' => 'required|string',
            'nama_institusi' => 'required|string',
            'jurusan' => 'required|string',
            'th_start' => 'required|integer',
            'th_end' => 'required|integer',
            'alat_bantu' => 'nullable|string',
            'cv' => $cvRule,
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portofolio' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        // Handle CV
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('lamaran/cv', 'public');
        } else {
            $cvPath = $profile->cv_path ?? null;
            if (!$cvPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'CV wajib diupload atau tersedia di profile'
                ], 422);
            }
        }

        // Handle Resume
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('lamaran/resume', 'public');
        } elseif ($profile && $profile->resume_path) {
            $resumePath = $profile->resume_path;
        }

        // Handle Portfolio
        $portofolioPath = null;
        if ($request->hasFile('portofolio')) {
            $portofolioPath = $request->file('portofolio')->store('lamaran/portofolio', 'public');
        } elseif ($profile && $profile->portfolio_path) {
            $portofolioPath = $profile->portfolio_path;
        }

        $lamaran = Lamaran::create([
            'user_id' => $user->user_id,
            'lowongan_id' => $data['lowongan_id'],
            'nama_lengkap' => $data['nama_lengkap'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nomor_hp' => $data['nomor_hp'],
            'alamat_lengkap' => $data['alamat_lengkap'],
            'email' => $data['email'],
            'pendidikan' => $data['pendidikan'],
            'nama_institusi' => $data['nama_institusi'],
            'jurusan' => $data['jurusan'],
            'th_start' => $data['th_start'],
            'th_end' => $data['th_end'],
            'alat_bantu' => $data['alat_bantu'] ?? 'Tidak ada',
            'cv' => $cvPath,
            'resume' => $resumePath,
            'portofolio' => $portofolioPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lamaran berhasil dikirim',
            'data' => [
                'id' => $lamaran->lamaran_id,
                'lowongan_id' => $lamaran->lowongan_id,
            ]
        ], 201);
    }
}

