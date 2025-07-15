<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $guru = null;

        if ($user->role === 'guru') {
            $guru = $user->guru;
        }

        return view('profile.profile', compact('user', 'guru'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi umum
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Jika guru, update data guru juga
        if ($user->role === 'guru') {
            $request->validate([
                'nip'           => 'required',
                'no_hp'         => 'required',
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
            ]);

            $user->guru->update([
                'nip'           => $request->nip,
                'no_hp'         => $request->no_hp,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        }

        // BK dan Admin tidak perlu update tabel lain

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
