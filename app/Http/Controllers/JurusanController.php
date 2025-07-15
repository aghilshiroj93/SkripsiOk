<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100']);
        Jurusan::create($request->only('nama'));
        return redirect()->route('kelas-jurusan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function getJurusan(Request $request)
    {
        $jurusan = Jurusan::all(); // kamu bisa tambah where kalau ingin tergantung tahun akademik
        return response()->json($jurusan);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->nama = $request->nama;
        $jurusan->save();

        return redirect()->route('kelas-jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }


    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('kelas-jurusan.index')->with('success', 'Data berhasil disimpan.');
    }
}
