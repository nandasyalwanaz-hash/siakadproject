<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Ambil role langsung dari kolom users.role
            $role = $user->role ?? 'Mahasiswa';
            session(['role' => $role]);

            // Redirect ke dashboard sesuai role
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget('role');
        auth()->logout();
        return redirect('/login');
    }
}
