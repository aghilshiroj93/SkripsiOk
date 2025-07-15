<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('kelas_jurusan.index', [
            'kelas' => Kelas::all(),
            'jurusan' => Jurusan::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50'
        ]);

        Kelas::create($request->only('nama_kelas'));

        return redirect()->route('kelas-jurusan.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();

        return redirect()->route('kelas-jurusan.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas-jurusan.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
