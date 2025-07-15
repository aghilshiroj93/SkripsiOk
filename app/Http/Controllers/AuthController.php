<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    // <-- ini wajib di atas!

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $nis = $request->input('email');
        $password = $request->input('password');

        $siswa = \App\Models\Siswa::where('nis', $nis)->first();

        if ($siswa && Hash::check($password, $siswa->password)) {
            Auth::guard('siswa')->login($siswa);
            $request->session()->regenerate();

            return redirect()->route('dashboard_siswa.index');
        }

        // Jika tidak ketemu siswa, coba login sebagai user (admin/guru)
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'NIS/email atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
