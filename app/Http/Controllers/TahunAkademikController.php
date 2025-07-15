<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $data = TahunAkademik::orderByDesc('is_active')->orderByDesc('created_at')->get();
        return view('tahun-akademik.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'semester' => 'required|in:ganjil,genap',
        ]);

        TahunAkademik::create($request->only(['tahun', 'semester']));

        return redirect()->back()->with('success', 'Tahun akademik berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|string',
            'semester' => 'required|in:ganjil,genap',
        ]);

        $data = TahunAkademik::findOrFail($id);
        $data->update($request->only(['tahun', 'semester']));

        return redirect()->back()->with('success', 'Tahun akademik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = TahunAkademik::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Tahun akademik berhasil dihapus.');
    }

    // TahunAkademikController.php
    public function toggleStatus($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);

        // Nonaktifkan semua tahun akademik terlebih dahulu
        TahunAkademik::query()->update(['is_active' => false]);

        // Aktifkan tahun akademik yang dipilih
        $tahunAkademik->update(['is_active' => !$tahunAkademik->is_active]);

        return back()->with('success', 'Status tahun akademik berhasil diubah');
    }
}
