<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajaran = MataPelajaran::all();
        return view('mata_pelajaran.index', compact('mataPelajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        MataPelajaran::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('mata_pelajaran.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('mata_pelajaran.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->delete();

        return redirect()->route('mata_pelajaran.index')->with('success', 'Data berhasil dihapus');
    }
}
