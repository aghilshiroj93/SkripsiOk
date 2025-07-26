<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;


use Illuminate\Support\Facades\Log;

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




    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            $imported = 0;
            $skipped = 0;

            (new FastExcel)->import($request->file('file'), function ($row) use (&$imported, &$skipped) {
                $nis = $row['nis'];
                $nisn = $row['nisn'];

                // Cek duplikat berdasarkan NIS atau NISN
                $exists = \App\Models\Siswa::where('nis', $nis)->orWhere('nisn', $nisn)->exists();
                if ($exists) {
                    $skipped++;
                    return;
                }

                \App\Models\Siswa::create([
                    'nis' => $nis,
                    'nisn' => $nisn,
                    'nama' => $row['nama'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'alamat' => $row['alamat'],
                    'no_hp' => preg_replace('/[^0-9]/', '', $row['no_hp']),
                    'password' => Hash::make($nis),
                ]);

                $imported++;
            });

            $message = "✅ <b>Import selesai.</b><br>✔️ Berhasil: <b>$imported</b><br>⚠️ Duplikat dilewati: <b>$skipped</b>";
            return redirect()->route('siswa.index')->with([
                'import_success' => true,
                'import_message' => $message
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'import_error' => true,
                'import_message' => 'Gagal import: ' . $e->getMessage()
            ]);
        }
    }



    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nisn' => 'required|unique:siswa,nisn',
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
            'password' => Hash::make($request->nis), // gunakan NIS sebagai password default
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
