<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Lamaran;

class LamarController extends Controller
{
    /**
     * ======================
     * STEP 1 → SIMPAN SESSION
     * ======================
     */
    public function storeStep1(Request $request, $lowongan)
    {
        $data = $request->validate([
            'nama'   => 'required|string',
            'gender' => 'required|string',
            'no_hp'  => 'required|string',
            'alamat' => 'required|string',
            'email'  => 'required|email',
        ]);

        session(['lamaran.step1' => $data]);

        return redirect()->route('lamar.step2', ['lowongan' => $lowongan]);
    }

    /**
     * ======================
     * STEP 2 → SIMPAN SESSION
     * ======================
     */
    public function storeStep2(Request $request, $lowongan)
    {
        $data = $request->validate([
            'pendidikan_terakhir' => 'required|string',
            'institusi'           => 'required|string',
            'jurusan'             => 'required|string',
            'tahun_mulai'         => 'required|integer',
            'tahun_berakhir'      => 'required|integer',
        ]);

        session(['lamaran.step2' => $data]);

        return redirect()->route('lamar.step3', ['lowongan' => $lowongan]);
    }

    /**
     * ======================
     * STEP 3 → SIMPAN DATABASE
     * ======================
     */
    public function submit(Request $request, $lowongan)
    {
        $user    = Auth::user();
        $profile = Profile::where('user_id', $user->user_id)->first();

        $step1 = session('lamaran.step1');
        $step2 = session('lamaran.step2');

        if (!$step1 || !$step2) {
            return redirect()
                ->route('lamar.step1', ['lowongan' => $lowongan])
                ->with('error', 'Data lamaran belum lengkap.');
        }

        /**
         * ======================
         * VALIDASI DINAMIS
         * ======================
         */
        $cvRule = 'nullable|file|mimes:pdf,doc,docx|max:2048';
        if (!$profile || !$profile->cv_path) {
            $cvRule = 'required|' . $cvRule;
        }

        $request->validate([
            'jenis_disabilitas'     => 'required|string',
            'alat_bantu'            => 'nullable|string',
            'cv'                    => $cvRule,
            'portofolio'            => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
            'dokumen_tambahan'      => 'required|array|min:1',
            'dokumen_tambahan.*'    => 'file|mimes:pdf,doc,docx|max:5120',
        ]);

        /**
         * ======================
         * TENTUKAN CV (WAJIB ADA)
         * ======================
         */
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('lamaran/cv', 'public');
        } else {
            $cvPath = $profile->cv_path;
        }

        /**
         * ======================
         * PORTOFOLIO (OPSIONAL)
         * ======================
         */
        $portoPath = $request->hasFile('portofolio')
            ? $request->file('portofolio')->store('lamaran/portofolio', 'public')
            : null;

        /**
         * ======================
         * RESUME ← DOKUMEN TAMBAHAN (FILE PERTAMA)
         * ======================
         */
        $resumePath = $request->file('dokumen_tambahan')[0]
            ->store('lamaran/resume', 'public');

        /**
         * ======================
         * SIMPAN KE DATABASE
         * ======================
         */
        Lamaran::create([
            'user_id'        => $user->user_id,
            'lowongan_id'    => $lowongan,

            // STEP 1
            'nama_lengkap'   => $step1['nama'],
            'jenis_kelamin'  => $step1['gender'],
            'nomor_hp'       => $step1['no_hp'],
            'alamat_lengkap' => $step1['alamat'],
            'email'          => $step1['email'],

            // STEP 2
            'pendidikan'     => $step2['pendidikan_terakhir'],
            'nama_institusi' => $step2['institusi'],
            'jurusan'        => $step2['jurusan'],
            'th_start'       => $step2['tahun_mulai'],
            'th_end'         => $step2['tahun_berakhir'],

            // STEP 3
            'alat_bantu'     => $request->alat_bantu ?? 'Tidak ada',
            'cv'             => $cvPath,
            'portofolio'     => $portoPath,
            'resume'         => $resumePath,
        ]);

        session()->forget('lamaran');

        return redirect()
    ->route('home')
    ->with('lamaran_success', 'Lamaran berhasil dikirim.');
    }
}
