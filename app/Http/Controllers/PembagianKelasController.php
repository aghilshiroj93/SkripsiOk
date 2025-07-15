<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class PembagianKelasController extends Controller
{
    protected $detailModel;
    public function __construct(Detail $detailModel)
    {
        $this->detailModel = $detailModel;
    }
    public function index()
    {
        $tahunAkademik = TahunAkademik:: where('is_active', 1)->get();
        $dataPembagian = $this->detailModel->getPembagianKelas();

        // return $dataPembagian;
        return view('pembagian_kelas.index', compact('tahunAkademik', 'dataPembagian'));
    }

    public function getJurusan(Request $request)
    {
        return response()->json(Jurusan::all());
    }

    public function getKelas(Request $request)
    {
        return response()->json(Kelas::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Detail::create([
            'tahun_akademik_id' => $validated['tahun_akademik_id'],
            'jurusan_id' => $validated['jurusan_id'],
            'kelas_id' => $validated['kelas_id'],
            'siswa_id' => null, // pastikan field ini nullable
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $detail = Detail::findOrFail($id);
        $detail->delete();

        return redirect()->route('pembagian.kelas.index')->with('success', 'Data berhasil dihapus.');
    }
}
