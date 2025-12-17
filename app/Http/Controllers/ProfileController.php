<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\keterampilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Ambil profile milik user login.
     * Jika belum ada, buat 1 profile baru untuk user tersebut.
     */
    protected function getProfile(): Profile
    {
        $user = auth()->user();

        return Profile::firstOrCreate(
            ['user_id' => $user->user_id],
            [
                'name'     => null,
                'subtitle' => null,
                'about'    => null,
                'skills'   => null,
            ]
        );
    }

    public function show()
    {
        $profile = $this->getProfile();
        return view('user.profile-show', compact('profile'));
    }

    public function edit()
    {
        $profile = $this->getProfile();

        $allSkills = keterampilan::orderBy('nama_keterampilan')->get();

        if ($allSkills->isEmpty()) {
            $defaults = [
                'Design Grafis',
                'Mobile Developer',
                'Web Development',
                'UI/UX Designer',
                'Data Analyst',
                'SEO',
                'Copywriting',
                'Social Media Management',
                'Project Management',
                'DevOps',
            ];

            $allSkills = collect($defaults)->map(function ($name, $i) {
                return (object) [
                    'keterampilan_id'   => 'dflt-' . ($i + 1),
                    'nama_keterampilan' => $name,
                ];
            });
        }

        return view('user.profile-edit', compact('profile', 'allSkills'));
    }

    public function update(Request $request)
    {
        $profile = $this->getProfile();

        $data = $request->validate([
            'name'      => ['nullable', 'string', 'max:100'],
            'about'     => ['nullable', 'string', 'max:1000'],
            'skills'    => ['nullable', 'array'],
            'skills.*'  => ['string'],
            'avatar'    => ['nullable', 'image', 'max:2048'],
            'cv'        => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'resume'    => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'portfolio' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip', 'max:5120'],
        ]);

        // Parsing skills
        $skillsArray = isset($data['skills'])
            ? collect($data['skills'])->map(fn ($s) => trim($s))->filter()->values()->all()
            : null;

        /**
         * ===== FILE UPLOAD (AMAN, TIDAK ADA delete(null)) =====
         */

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path && Storage::disk('public')->exists($profile->avatar_path)) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $data['avatar_path'] = $request->file('avatar')->store('profiles', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
                Storage::disk('public')->delete($profile->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('profiles', 'public');
        }

        if ($request->hasFile('resume')) {
            if ($profile->resume_path && Storage::disk('public')->exists($profile->resume_path)) {
                Storage::disk('public')->delete($profile->resume_path);
            }
            $data['resume_path'] = $request->file('resume')->store('profiles', 'public');
        }

        if ($request->hasFile('portfolio')) {
            if ($profile->portfolio_path && Storage::disk('public')->exists($profile->portfolio_path)) {
                Storage::disk('public')->delete($profile->portfolio_path);
            }
            $data['portfolio_path'] = $request->file('portfolio')->store('profiles', 'public');
        }

        /**
         * Simpan ke database
         */
        $profile->update([
            'name'           => $data['name'] ?? $profile->name,
            'about'          => $data['about'] ?? $profile->about,
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

    public function view(string $type)
    {
        $profile = $this->getProfile();

        if (!in_array($type, ['cv', 'resume', 'portfolio'])) {
            abort(404);
        }

        $field = $type . '_path';

        if (!$profile->$field || !Storage::disk('public')->exists($profile->$field)) {
            abort(404);
        }

        return response(
            Storage::disk('public')->get($profile->$field),
            200,
            [
                'Content-Type' => Storage::disk('public')->mimeType($profile->$field),
                'Content-Disposition' => 'inline; filename="' . basename($profile->$field) . '"',
            ]
        );
    }
}
