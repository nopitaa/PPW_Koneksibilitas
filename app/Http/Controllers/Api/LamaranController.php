<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Profile;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /* =======================
       USER MOBILE & APP
    ======================== */

    public function index(Request $request)
    {
        $user = $request->user();

        $lamaran = Lamaran::where('user_id', $user->user_id)
            ->with(['lowongan.perusahaan'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $lamaran
        ]);
    }

    public function show(Request $request, $id)
    {
        $lamaran = Lamaran::with(['lowongan.perusahaan'])
            ->where('lamaran_id', $id)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $lamaran
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $profile = Profile::where('user_id', $user->user_id)->first();

        $data = $request->validate([
            'lowongan_id'    => 'required',
            'nama_lengkap'   => 'required',
            'jenis_kelamin'  => 'required',
            'nomor_hp'       => 'required',
            'alamat_lengkap' => 'required',
            'email'          => 'required',
            'pendidikan'     => 'required',
            'nama_institusi' => 'required',
            'jurusan'        => 'required',
            'th_start'       => 'required',
            'th_end'         => 'required',
            'alat_bantu'     => 'nullable',
            'cv'             => 'nullable|file',
            'resume'         => 'nullable|file',
            'portofolio'     => 'nullable|file',
        ]);

        // handle uploaded files
        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('lamaran/cv', 'public');
        }
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('lamaran/resume', 'public');
        }
        if ($request->hasFile('portofolio')) {
            $data['portofolio'] = $request->file('portofolio')->store('lamaran/portofolio', 'public');
        }

        $lamaran = Lamaran::create(array_merge($data, [
            'user_id' => $user->user_id,
            'status'  => 'submitted'
        ]));

        return response()->json([
            'success' => true,
            'application_id' => $lamaran->lamaran_id
        ]);
    }

    /* =======================
       MOBILE STEP FORM
    ======================== */

    public function mobileStep1(Request $r)
    {
        $user = $r->user(); // boleh null

        $lamaran = Lamaran::create([
            'user_id'        => $user?->user_id,   // 🔑 INI FIX UTAMA
            'lowongan_id'    => $r->lowongan_id,
            'nama_lengkap'   => $r->full_name,
            'jenis_kelamin'  => $r->gender,
            'nomor_hp'       => $r->phone,
            'alamat_lengkap' => $r->address,
            'email'          => $r->email,
            'status'         => 'draft'
        ]);

        return response()->json([
            'application_id' => $lamaran->lamaran_id
        ]);
    }

    public function mobileStep2(Request $r)
    {
        Lamaran::where('lamaran_id', $r->application_id)->update([
            'pendidikan'     => $r->last_education,
            'nama_institusi' => $r->institution,
            'jurusan'        => $r->major,
            'th_start'       => $r->year_start,
            'th_end'         => $r->year_end,
        ]);

        return response()->json(['ok' => true]);
    }

    public function mobileStep3(Request $r)
    {
        $update = [
            'alat_bantu' => $r->assistive_tools,
            'status'     => 'submitted'
        ];

        // handle optional file uploads from mobile
        if ($r->hasFile('cv')) {
            $update['cv'] = $r->file('cv')->store('lamaran/cv', 'public');
        }
        if ($r->hasFile('resume')) {
            $update['resume'] = $r->file('resume')->store('lamaran/resume', 'public');
        }
        if ($r->hasFile('portofolio')) {
            $update['portofolio'] = $r->file('portofolio')->store('lamaran/portofolio', 'public');
        }

        Lamaran::where('lamaran_id', $r->application_id)->update($update);

        return response()->json(['ok' => true]);
    }

    /* =======================
       HR WEB
    ======================== */

    public function hrIndex()
    {
        return Lamaran::where('status', 'submitted')
            ->latest()
            ->get();
    }

    public function approve($id)
    {
        Lamaran::where('lamaran_id', $id)
            ->update(['status' => 'approved']);

        return response()->json(['ok' => true]);
    }

    public function reject($id)
    {
        Lamaran::where('lamaran_id', $id)
            ->update(['status' => 'rejected']);

        return response()->json(['ok' => true]);
    }
}
