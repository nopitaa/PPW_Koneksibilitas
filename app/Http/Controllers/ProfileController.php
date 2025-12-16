<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\keterampilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected function getProfile(): Profile
    {
        return Profile::firstOrCreate([], [
            'name' => null,
            'subtitle' => null,
            'about' => null,
            'skills' => null,
        ]);
    }

    public function show()
    {
        $profile = $this->getProfile();

        return view('user.profile-show', compact('profile'));
    }

    public function edit()
    {
        $profile = $this->getProfile();

        // ambil daftar keterampilan yang tersedia
        $allSkills = keterampilan::orderBy('nama_keterampilan')->get();

        return view('user.profile-edit', compact('profile', 'allSkills'));
    }

    public function update(Request $request)
    {
        $profile = $this->getProfile();

        $data = $request->validate([
            'name'      => ['nullable', 'string', 'max:100'],
            'about'     => ['nullable', 'string', 'max:1000'],
            'skills'    => ['nullable', 'array'], // menerima array pilihan
            'skills.*'  => ['string'],
            'avatar'    => ['nullable', 'image', 'max:2048'], // 2MB
            'cv'        => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'resume'    => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'portfolio' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip', 'max:5120'],
        ]);

        // parsing skills: data bisa berupa array (dari checkbox) atau string (fallback)
        $skillsArray = null;
        if (!empty($data['skills'])) {
            if (is_array($data['skills'])) {
                $skillsArray = collect($data['skills'])
                    ->map(fn ($s) => trim($s))
                    ->filter()
                    ->values()
                    ->all();
            } else {
                $skillsArray = collect(explode(',', $data['skills']))
                    ->map(fn ($s) => trim($s))
                    ->filter()
                    ->values()
                    ->all();
            }
        }

        // handle upload files (pakai disk public)
        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $data['avatar_path'] = $request->file('avatar')->store('profiles', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($profile->cv_path) {
                Storage::disk('public')->delete($profile->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('profiles', 'public');
        }

        if ($request->hasFile('resume')) {
            if ($profile->resume_path) {
                Storage::disk('public')->delete($profile->resume_path);
            }
            $data['resume_path'] = $request->file('resume')->store('profiles', 'public');
        }

        if ($request->hasFile('portfolio')) {
            if ($profile->portfolio_path) {
                Storage::disk('public')->delete($profile->portfolio_path);
            }
            $data['portfolio_path'] = $request->file('portfolio')->store('profiles', 'public');
        }

        // simpan
        $profile->update([
            'name'           => $data['name'] ?? $profile->name,
            'subtitle'       => $profile->subtitle,  // kita biarkan kosong
            'about'          => $data['about'] ?? null,
            'skills'         => $skillsArray,
            'avatar_path'    => $data['avatar_path'] ?? $profile->avatar_path,
            'cv_path'        => $data['cv_path'] ?? $profile->cv_path,
            'resume_path'    => $data['resume_path'] ?? $profile->resume_path,
            'portfolio_path' => $data['portfolio_path'] ?? $profile->portfolio_path,
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // 🔍 PREVIEW FILE DI TAB BARU
    public function view(string $type)
    {
        $profile = $this->getProfile();

        // hanya boleh: cv, resume, portfolio
        if (! in_array($type, ['cv', 'resume', 'portfolio'])) {
            abort(404);
        }

        $field = $type . '_path';   // cv_path / resume_path / portfolio_path

        if (! $profile->$field) {
            abort(404);
        }

        $path = $profile->$field;

        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $file = Storage::disk('public')->get($path);
        $mime = Storage::disk('public')->mimeType($path) ?? 'application/octet-stream';

        // inline = buka di tab baru, bukan download
        return response($file, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="'.basename($path).'"');
    }
}
