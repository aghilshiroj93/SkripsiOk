<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaTidakAktif;
use Illuminate\Http\Request;

class SiswaTidakAktifController extends Controller
{
    // ✅ Tampilkan daftar siswa tidak aktif
    public function index(Request $request)
    {
        $query = SiswaTidakAktif::with('siswa');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nis', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%");
            });
        }

        $siswaTidakAktif = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('siswa_tidak_aktif.partials.table', compact('siswaTidakAktif'))->render(),
                'pagination' => $siswaTidakAktif->links('pagination::tailwind')->toHtml(),
            ]);
        }

        return view('siswa_tidak_aktif.index', compact('siswaTidakAktif'));
    }
    public function create()
    {
        // Ambil semua ID siswa yang sudah ditandai tidak aktif
        $siswaTidakAktifIds = SiswaTidakAktif::pluck('siswa_id');

        // Ambil siswa yang belum masuk daftar tidak aktif
        $siswaAktif = Siswa::whereNotIn('id', $siswaTidakAktifIds)->get();

        return view('siswa_tidak_aktif.modal.create', compact('siswaAktif'));
    }

    // ✅ Tambah siswa ke daftar tidak aktif (via AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'siswa_ids.*' => 'exists:siswa,id',
        ]);

        foreach ($request->siswa_ids as $siswaId) {
            SiswaTidakAktif::firstOrCreate([
                'siswa_id' => $siswaId,
            ]);
        }

        return redirect()->route('siswa-tidak-aktif.index')->with('success', 'Siswa berhasil ditandai tidak aktif.');
    }


    // ✅ Hapus siswa dari daftar tidak aktif (via AJAX)
    public function destroy($siswa_id)
    {
        $data = SiswaTidakAktif::where('siswa_id', $siswa_id)->first();

        if ($data) {
            $data->delete();
            return redirect()->route('siswa-tidak-aktif.index')
                ->with('success', 'Siswa dihapus dari daftar tidak aktif.');
        }

        return redirect()->route('siswa-tidak-aktif.index')
            ->with('error', 'Data tidak ditemukan.');
    }
}
