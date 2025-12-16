<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class LamarController extends Controller
{
    public function submit(Request $request)
    {
        // ambil profil terlebih dahulu untuk menentukan aturan validasi
        $profile = Profile::first();

        $cvRule = 'nullable|file|mimes:pdf,doc,docx|max:2048';
        // jika profil tidak punya CV tersimpan, jadikan CV wajib di-upload pada step ini
        if (! $profile || empty($profile->cv_path)) {
            $cvRule = 'required|' . $cvRule;
        }

        $rules = [
            // view uses combined value 'tuna_rungu_wicara'
            'jenis_disabilitas' => 'required|in:tuna_rungu_wicara,lainnya',
            'alat_bantu'        => 'nullable|string|max:200',
            // validate file type/size but we'll enforce presence (upload or profile) below
            'cv'                => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portofolio'        => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
            'dokumen_tambahan.*'=> 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
        ];

        $validated = $request->validate($rules);

        // Pastikan ada CV — baik di-upload sekarang atau sudah ada di Profile
        $hasCvUpload = $request->hasFile('cv');
        if (! $hasCvUpload && (! $profile || empty($profile->cv_path))) {
            return redirect()->back()
                ->withErrors(['cv' => 'CV harus disediakan: unggah CV di sini atau tambahkan CV pada profil Anda.'])
                ->withInput();
        }

        // Simpan file (contoh penyimpanan ke storage/app/lamaran)
        // Jika pengguna tidak mengupload CV/portofolio di form, gunakan file dari Profile jika tersedia
        foreach (['cv','portofolio'] as $f) {
            if ($request->hasFile($f)) {
                // files uploaded in this form are stored on the default disk (storage/app)
                // prefix with `local:` so downstream code knows where to read them
                $path = $request->file($f)->store('lamaran');
                $validated[$f] = 'local:' . $path;
            }
        }

        // fallback: ambil dari profile jika ada (salin ke folder lamaran agar aplikasi punya salinan)
        if ($profile) {
            // mapping form name -> profile field
            $map = ['cv' => 'cv_path', 'portofolio' => 'portfolio_path'];
            foreach ($map as $formName => $profileField) {
                if (empty($validated[$formName]) && !empty($profile->$profileField)) {
                    $srcPath = $profile->$profileField; // path on 'public' disk
                    if (Storage::disk('public')->exists($srcPath)) {
                        // Instead of copying the file, store a reference to the profile file path
                        // and prefix with `public:` so downstream code can read from the public disk.
                        $validated[$formName] = 'public:' . $srcPath;
                    }
                }
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
