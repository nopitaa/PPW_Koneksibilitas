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
        $profile = Profile::firstOrCreate(
            ['user_id' => $user->user_id],
            ['skills' => []] 
        );
        $data = $profile->toArray();
        $data['avatar_url'] = $profile->avatar_path ? asset('storage/' . $profile->avatar_path) : null;
        $data['cv_url'] = $profile->cv_path ? asset('storage/' . $profile->cv_path) : null;
        $data['portfolio_url'] = $profile->portfolio_path ? asset('storage/' . $profile->portfolio_path) : null;
        $data['user_email'] = $user->email;
        $data['full_name'] = trim(($user->nama_depan ?? '') . ' ' . ($user->nama_belakang ?? ''));

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $profile = Profile::firstOrCreate(['user_id' => $user->user_id]);

        $request->validate([
            'name'      => 'nullable|string',
            'subtitle'  => 'nullable|string',
            'about'     => 'nullable|string',
            'skills'    => 'nullable|array',
            'avatar'    => 'nullable|image|mimes:png,img,jpg,jpeg|max:2048',//2mb,img
            'cv'        => 'nullable|file|mimes:pdf,doc,docx|max:2048',//2mb
            'portfolio' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',//5mb
        ]);

        $updateData = [];
        if ($request->has('name')) $updateData['name'] = $request->name;
        if ($request->has('subtitle')) $updateData['subtitle'] = $request->subtitle;
        if ($request->has('about')) $updateData['about'] = $request->about;
        if ($request->has('skills')) $updateData['skills'] = $request->skills;
        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) Storage::disk('public')->delete($profile->avatar_path);
            $updateData['avatar_path'] = $request->file('avatar')->store('profiles', 'public');
        }
        if ($request->hasFile('cv')) {
            if ($profile->cv_path) Storage::disk('public')->delete($profile->cv_path);
            $updateData['cv_path'] = $request->file('cv')->store('profiles', 'public');
        }
        if ($request->hasFile('portfolio')) {
            if ($profile->portfolio_path) Storage::disk('public')->delete($profile->portfolio_path);
            $updateData['portfolio_path'] = $request->file('portfolio')->store('profiles', 'public');
        }
        $profile->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }

    public function getSkills()
    {
        return response()->json([
            'success' => true,
            'data' => keterampilan::orderBy('nama_keterampilan')->pluck('nama_keterampilan')
        ]);
    }
}

?>
