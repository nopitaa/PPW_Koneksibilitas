<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // admin default (bisa diganti sesuai database)
        $adminEmail = "admin@gmail.com";
        $adminPassword = "admin123";

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai admin');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}
