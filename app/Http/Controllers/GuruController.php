<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->get();
        return view('guru.index', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:guru,nip',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::beginTransaction();
        try {
            // Simpan ke tabel users
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'role' => 'guru', // uncomment jika ada kolom role
            ]);

            // Simpan ke tabel guru
            Guru::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->user_id);

        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $id,
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        DB::beginTransaction();
        try {
            $user->name = $request->nama;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $guru->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->user_id);

        DB::beginTransaction();
        try {
            $guru->delete();
            $user->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
