<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\TahunAkademik;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Detail;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwalList = Jadwal::with(['guru', 'mataPelajaran', 'tahunAkademik', 'jurusan', 'kelas'])->get();
        $guruList = Guru::all();
        $mapelList = MataPelajaran::all();
        $tahunAkademikList = TahunAkademik::all();

        return view('jadwal.index', compact('jadwalList', 'guruList', 'mapelList', 'tahunAkademikList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required',
            'tahun_akademik_id' => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status' => 'required'
        ]);

        // Cek jika guru sudah punya jadwal di hari dan jam yang bentrok
        $jadwalConflict = Jadwal::where('guru_id', $request->guru_id)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($jadwalConflict) {
            return redirect()->back()->with('error', 'Maaf, guru yang Anda pilih sudah memiliki jadwal di hari dan jam tersebut.');
        }

        // Jika tidak bentrok, simpan jadwal
        Jadwal::create([
            'guru_id' => $request->guru_id,
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required',
            'tahun_akademik_id' => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status' => 'required'
        ]);

        $jadwal = Jadwal::findOrFail($id);

        // Cek bentrok tapi abaikan jadwal dengan ID yang sedang di-update
        $jadwalConflict = Jadwal::where('guru_id', $request->guru_id)
            ->where('hari', $request->hari)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($jadwalConflict) {
            return redirect()->back()->with('error', 'Maaf, guru yang Anda pilih sudah memiliki jadwal bentrok di hari dan jam tersebut.');
        }

        // Update data jika tidak bentrok
        $jadwal->update([
            'guru_id' => $request->guru_id,
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // AJAX: Ambil jurusan berdasarkan tahun akademik dari detail
    public function getJurusan($tahun_akademik_id)
    {
        $jurusan = Detail::where('tahun_akademik_id', $tahun_akademik_id)
            ->with('jurusan')
            ->get()
            ->pluck('jurusan.nama', 'jurusan_id')
            ->unique();

        return response()->json($jurusan);
    }


    // AJAX: Ambil kelas berdasarkan tahun akademik + jurusan dari detail
    public function getKelas($tahun_akademik_id, $jurusan_id)
    {
        $kelas = Detail::where('tahun_akademik_id', $tahun_akademik_id)
            ->where('jurusan_id', $jurusan_id)
            ->with('kelas') // ambil relasi kelas
            ->get()
            ->pluck('kelas.nama_kelas', 'kelas_id') // ambil id & nama kelas
            ->unique();

        return response()->json($kelas);
    }
}
