<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * =====================
     * LOGIN MOBILE (API)
     * =====================
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $user = Auth::user();
        
        // Generate token untuk mobile
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id'            => $user->user_id,
                'email'         => $user->email,
                'nama_depan'    => $user->nama_depan,
                'nama_belakang' => $user->nama_belakang,
                'nama_lengkap'  => $user->nama_depan . ' ' . $user->nama_belakang,
                'jenis_kelamin' => $user->jenis_kelamin,
            ]
        ]);
    }

    /**
     * =====================
     * REGISTER MOBILE (API)
     * =====================
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'nama_depan'    => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $user = User::create([
            'email'         => $request->email,
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password),
        ]);

        // Generate token setelah registrasi
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => [
                'id'            => $user->user_id,
                'email'         => $user->email,
                'nama_depan'    => $user->nama_depan,
                'nama_belakang' => $user->nama_belakang,
                'nama_lengkap'  => $user->nama_depan . ' ' . $user->nama_belakang,
                'jenis_kelamin' => $user->jenis_kelamin,
            ]
        ], 201);
    }

    /**
     * =====================
     * LOGOUT MOBILE (API)
     * =====================
     */
    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    /**
     * =====================
     * GET CURRENT USER (API)
     * =====================
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'user' => [
                'id'            => $user->user_id,
                'email'         => $user->email,
                'nama_depan'    => $user->nama_depan,
                'nama_belakang' => $user->nama_belakang,
                'nama_lengkap'  => $user->nama_depan . ' ' . $user->nama_belakang,
                'jenis_kelamin' => $user->jenis_kelamin,
            ]
        ]);
    }
}
