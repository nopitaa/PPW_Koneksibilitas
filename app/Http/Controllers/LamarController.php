<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LamarController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'jenis_disabilitas' => 'required|in:tuna_wicara,tuna_rungu,lainnya',
            'alat_bantu'        => 'nullable|string|max:200',
            'cv'                => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portofolio'        => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
            'dokumen_tambahan.*'=> 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
        ]);

        // Simpan file (contoh penyimpanan ke storage/app/lamaran)
        foreach (['cv','portofolio'] as $f) {
            if ($request->hasFile($f)) {
                $validated[$f] = $request->file($f)->store('lamaran');
            }
        }

        if ($request->hasFile('dokumen_tambahan')) {
            $paths = [];
            foreach ($request->file('dokumen_tambahan') as $file) {
                $paths[] = $file->store('lamaran');
            }
            $validated['dokumen_tambahan'] = $paths;
        }

        return redirect()
            ->route('home')
            ->with('success', 'Lamaran berhasil dikirim. Terima kasih telah melamar!');
    }
}
