<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->input('search');


        $siswa = Siswa::when($keyword, function ($query, $keyword) {
            return $query->where('nis', 'like', "%{$keyword}%")
                ->orWhere('nama', 'like', "%{$keyword}%");
        })
            ->orderBy('nama')
            ->paginate(15);


        if ($request->ajax()) {
            return response()->json([
                'table' => view('siswa.table', compact('siswa'))->render(),
                'pagination' => $siswa->links('pagination::tailwind')->render()
            ]);
        }


        return view('siswa.index', compact('siswa'));
    }



    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa',
            'nisn' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);
        $no_hp = preg_replace('/[^0-9]/', '', $request->no_hp); // hanya angka
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '62' . substr($no_hp, 1);
        }

        Siswa::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $no_hp,
        ]);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $siswa = Siswa::findOrFail($decryptedId);
            return view('siswa.edit', compact('siswa'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(403, 'ID tidak valid');
        }
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $siswa->id,
            'nisn' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
            'password' => 'nullable|string|min:6',
        ]);

        $no_hp = preg_replace('/[^0-9]/', '', $request->no_hp);
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '62' . substr($no_hp, 1);
        }

        $data = [
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function show($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $siswa = Siswa::findOrFail($decryptedId);
            return view('siswa.show', compact('siswa'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(403, 'ID tidak valid');
        }
    }

    public function resetPassword($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'password' => Hash::make($siswa->nis)
        ]);
        // dd('Password updated');

        return redirect()->route('siswa.index')->with('success', 'Password berhasil direset ke NIS.');
    }
}
