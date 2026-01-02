<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\keterampilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        
        $profile = Profile::where('user_id', $user->user_id)->first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile belum dibuat'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $profile->name,
                'subtitle' => $profile->subtitle,
                'about' => $profile->about,
                'skills' => $profile->skills ?? [],
                'avatar_url' => $profile->avatar_path ? Storage::url($profile->avatar_path) : null,
                'cv_url' => $profile->cv_path ? Storage::url($profile->cv_path) : null,
                'resume_url' => $profile->resume_path ? Storage::url($profile->resume_path) : null,
                'portfolio_url' => $profile->portfolio_path ? Storage::url($profile->portfolio_path) : null,
            ]
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        
        $profile = Profile::firstOrCreate(
            ['user_id' => $user->user_id],
            [
                'name'     => null,
                'subtitle' => null,
                'about'    => null,
                'skills'   => null,
            ]
        );

        $data = $request->validate([
            'name'      => ['nullable', 'string', 'max:100'],
            'subtitle'  => ['nullable', 'string', 'max:255'],
            'about'     => ['nullable', 'string', 'max:1000'],
            'skills'    => ['nullable', 'array'],
            'skills.*'  => ['string'],
        ]);

        // Parsing skills
        $skillsArray = isset($data['skills'])
            ? collect($data['skills'])->map(fn ($s) => trim($s))->filter()->values()->all()
            : $profile->skills;

        $profile->update([
            'name'    => $data['name'] ?? $profile->name,
            'subtitle' => $data['subtitle'] ?? $profile->subtitle,
            'about'   => $data['about'] ?? $profile->about,
            'skills'  => $skillsArray,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diperbarui',
            'data' => [
                'name' => $profile->name,
                'subtitle' => $profile->subtitle,
                'about' => $profile->about,
                'skills' => $profile->skills ?? [],
            ]
        ]);
    }

    /**
     * =====================
     * UPLOAD AVATAR (API)
     * =====================
     */
    public function uploadAvatar(Request $request)
    {
        $user = $request->user();
        
        $profile = Profile::firstOrCreate(
            ['user_id' => $user->user_id]
        );

        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        // Delete old avatar if exists
        if ($profile->avatar_path && Storage::disk('public')->exists($profile->avatar_path)) {
            Storage::disk('public')->delete($profile->avatar_path);
        }

        $avatarPath = $request->file('avatar')->store('profiles', 'public');
        $profile->update(['avatar_path' => $avatarPath]);

        return response()->json([
            'success' => true,
            'message' => 'Avatar berhasil diupload',
            'avatar_url' => Storage::url($avatarPath)
        ]);
    }

    /**
     * =====================
     * UPLOAD CV (API)
     * =====================
     */
    public function uploadCv(Request $request)
    {
        $user = $request->user();
        
        $profile = Profile::firstOrCreate(
            ['user_id' => $user->user_id]
        );

        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        // Delete old CV if exists
        if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
            Storage::disk('public')->delete($profile->cv_path);
        }

        $cvPath = $request->file('cv')->store('profiles', 'public');
        $profile->update(['cv_path' => $cvPath]);

        return response()->json([
            'success' => true,
            'message' => 'CV berhasil diupload',
            'cv_url' => Storage::url($cvPath)
        ]);
    }

    /**
     * =====================
     * GET ALL SKILLS (API)
     * =====================
     */
    public function getSkills()
    {
        $skills = keterampilan::orderBy('nama_keterampilan')->get();

        return response()->json([
            'success' => true,
            'data' => $skills->map(function ($skill) {
                return [
                    'id' => $skill->keterampilan_id,
                    'nama' => $skill->nama_keterampilan
                ];
            })
        ]);
    }
}

