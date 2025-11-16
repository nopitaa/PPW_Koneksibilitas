<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        // Tidak pakai password/email, langsung login
        session(['admin_logged_in' => true]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');

        return redirect()->route('admin.login');
    }
}
