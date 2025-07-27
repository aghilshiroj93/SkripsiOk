<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilPembagianKelasController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademik = TahunAkademik::all();
        $selectedTahunAkademikId = $request->input('tahun_akademik_id');

        $dataPembagianGrouped = collect();

        if ($selectedTahunAkademikId) {
            $dataPembagian = Detail::with(['kelas', 'jurusan', 'tahunAkademik', 'siswa'])
                ->where('tahun_akademik_id', $selectedTahunAkademikId)
                ->get();

            $dataPembagianGrouped = $dataPembagian->groupBy(function ($item) {
                return $item->kelas_id . '-' . $item->jurusan_id . '-' . $item->tahun_akademik_id;
            });
        }

        return view('hasil_pembagian_kelas.index', compact('tahunAkademik', 'dataPembagianGrouped', 'selectedTahunAkademikId'));
    }

    public function getDetail(Request $request)
    {
        $siswa = Detail::with('siswa')
            ->where('kelas_id', $request->kelas_id)
            ->where('jurusan_id', $request->jurusan_id)
            ->where('tahun_akademik_id', $request->tahun_akademik_id)
            ->whereNotNull('siswa_id')
            ->get();

        return response()->json($siswa);
    }

    public function getSiswaTanpaKelas(Request $request)
    {
        $tahunAkademikId = $request->tahun_akademik_id;

        $siswaTanpaKelas = Siswa::whereDoesntHave('details', function ($q) use ($tahunAkademikId) {
            $q->where('tahun_akademik_id', $tahunAkademikId);
        })
            ->whereDoesntHave('siswaTidakAktif') // ⬅️ Tambahkan ini
            ->get();

        return response()->json($siswaTanpaKelas);
    }




    public function tambahSiswa(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
            'siswa_ids' => 'required|array',
        ]);

        foreach ($request->siswa_ids as $siswaId) {
            Detail::create([
                'kelas_id' => $request->kelas_id,
                'jurusan_id' => $request->jurusan_id,
                'tahun_akademik_id' => $request->tahun_akademik_id,
                'siswa_id' => $siswaId,
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('hasil.pembagian.index', ['tahun_akademik_id' => $request->tahun_akademik_id])
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function hapusSiswaDariKelas($id_detail)
    {
        $detail = Detail::findOrFail($id_detail);
        $detail->delete();

        return response()->json(['success' => true]);
    }


    // Tampilkan halaman detail
    public function detail($kelas_id, $jurusan_id, $tahun_akademik_id)
    {
        $data = Detail::with('siswa', 'kelas', 'jurusan')
            ->where('kelas_id', $kelas_id)
            ->where('jurusan_id', $jurusan_id)
            ->where('tahun_akademik_id', $tahun_akademik_id)
            ->get();

        return view('hasil_pembagian_kelas.detail', compact('data', 'kelas_id', 'jurusan_id', 'tahun_akademik_id'));
    }

    // Tampilkan halaman tambah siswa
    public function formTambah(Request $request, $kelas_id, $jurusan_id, $tahun_akademik_id)
    {
        $siswaTanpaKelas = Siswa::whereDoesntHave('details', function ($q) use ($tahun_akademik_id) {
            $q->where('tahun_akademik_id', $tahun_akademik_id);
        })->whereDoesntHave('siswaTidakAktif')->paginate(10);

        if ($request->ajax()) {
            return view('hasil_pembagian_kelas.tambah', compact(...))->render();
        }

        return view('hasil_pembagian_kelas.tambah', compact('siswaTanpaKelas', 'kelas_id', 'jurusan_id', 'tahun_akademik_id'));
    }
}
