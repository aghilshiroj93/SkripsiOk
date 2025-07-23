<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Detail;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use DB;

class RekapAbsensiController extends Controller
{

    public function index(Request $request)
    {
        $tahunAkademikList = TahunAkademik::all();
        $jurusanList = collect();
        $kelasList = collect();
        $rekap = collect();

        $user = auth()->user();

        $kelasGuru = collect();
        if ($user->role === 'guru' && $user->guru) {
            $guruId = $user->guru->id;
            $kelasGuru = Jadwal::where('guru_id', $guruId)
                ->pluck('kelas_id')
                ->unique();
        }

        // Ambil tahun akademik aktif sebagai default jika tidak ada filter
        $tahunAktif = TahunAkademik::where('is_active', true)->first();
        $tahunAkademikId = $request->input('tahun_akademik_id', $tahunAktif ? $tahunAktif->id : null);

        // Jika ada tahun akademik (baik dari request atau default aktif)
        if ($tahunAkademikId) {
            // Set nilai tahun_akademik_id di request agar filter bekerja
            $request->merge(['tahun_akademik_id' => $tahunAkademikId]);

            $query = Detail::with(['siswa', 'kelas', 'jurusan'])
                ->where('tahun_akademik_id', $tahunAkademikId);

            // Filter hanya untuk guru jika ada
            if ($kelasGuru->isNotEmpty()) {
                $query->whereIn('kelas_id', $kelasGuru);
            }

            // Tambah filter jurusan jika dipilih
            if ($request->filled('jurusan_id')) {
                $query->where('jurusan_id', $request->jurusan_id);
            }

            // Tambah filter kelas jika dipilih
            if ($request->filled('kelas_id')) {
                $query->where('kelas_id', $request->kelas_id);
            }

            // Ambil daftar jurusan berdasarkan filter tahun akademik (dan kelas guru kalau ada)
            $jurusanQuery = Detail::where('tahun_akademik_id', $tahunAkademikId);
            if ($kelasGuru->isNotEmpty()) {
                $jurusanQuery->whereIn('kelas_id', $kelasGuru);
            }
            $jurusanList = $jurusanQuery->with('jurusan')->get()
                ->pluck('jurusan')->unique('id')->values();

            // Ambil daftar kelas (jika jurusan dipilih)
            if ($request->filled('jurusan_id')) {
                $kelasQuery = Detail::where('tahun_akademik_id', $tahunAkademikId)
                    ->where('jurusan_id', $request->jurusan_id);
                if ($kelasGuru->isNotEmpty()) {
                    $kelasQuery->whereIn('kelas_id', $kelasGuru);
                }
                $kelasList = $kelasQuery->with('kelas')->get()
                    ->pluck('kelas')->unique('id')->values();
            }

            // Ambil data siswa yang sudah difilter
            $siswaList = $query->get();

            foreach ($siswaList as $detail) {
                if (!$detail->siswa) continue;

                $absensiQuery = Absensi::where('siswa_id', $detail->siswa_id);

                if ($request->filled(['tanggal_mulai', 'tanggal_selesai'])) {
                    $absensiQuery->whereBetween('waktu_absen', [
                        $request->tanggal_mulai . ' 00:00:00',
                        $request->tanggal_selesai . ' 23:59:59',
                    ]);
                }

                $absensiData = $absensiQuery->get()->groupBy('status')->map->count();
                if ($absensiData->isEmpty()) {
                    continue;
                }

                $rekap->push([
                    'nis' => $detail->siswa->nis,
                    'nisn' => $detail->siswa->nisn,
                    'nama' => $detail->siswa->nama,
                    'kelas' => $detail->kelas->nama_kelas,
                    'jurusan' => $detail->jurusan->nama,
                    'hadir' => $absensiData['H'] ?? 0,
                    'sakit' => $absensiData['S'] ?? 0,
                    'izin' => $absensiData['I'] ?? 0,
                    'alpa' => $absensiData['A'] ?? 0,
                    'total' => $absensiData->sum()
                ]);
            }
        }

        return view('rekapabsensi.index', compact(
            'tahunAkademikList',
            'jurusanList',
            'kelasList',
            'rekap',
            'request',
            'tahunAktif'
        ));
    }




    public function filter(Request $request)
    {
        $query = Absensi::with('siswa');

        // Filter jurusan & kelas via relasi Detail
        if ($request->jurusan_id || $request->kelas_id) {
            $siswaIds = Detail::query()
                ->when($request->jurusan_id, fn($q) => $q->where('jurusan_id', $request->jurusan_id))
                ->when($request->kelas_id, fn($q) => $q->where('kelas_id', $request->kelas_id))
                ->pluck('siswa_id');
            $query->whereIn('siswa_id', $siswaIds);
        }

        // Filter waktu
        if ($request->filter_tipe && $request->tanggal) {
            $tanggal = Carbon::parse($request->tanggal);

            switch ($request->filter_tipe) {
                case 'harian':
                    $query->whereDate('waktu_absen', $tanggal);
                    break;
                case 'mingguan':
                    $query->whereBetween('waktu_absen', [$tanggal->startOfWeek(), $tanggal->endOfWeek()]);
                    break;
                case 'bulanan':
                    $query->whereMonth('waktu_absen', $tanggal->month)
                        ->whereYear('waktu_absen', $tanggal->year);
                    break;
                case 'semester':
                    $semesterStart = $tanggal->month <= 6 ? Carbon::create($tanggal->year, 1, 1) : Carbon::create($tanggal->year, 7, 1);
                    $semesterEnd = $semesterStart->copy()->addMonths(5)->endOfMonth();
                    $query->whereBetween('waktu_absen', [$semesterStart, $semesterEnd]);
                    break;
            }
        }

        $data = $query->get();

        // Kelompokkan berdasarkan siswa
        $rekap = $data->groupBy('siswa_id')->map(function ($item, $siswaId) {
            $siswa = $item->first()->siswa;
            return [
                'nis' => $siswa->nis,
                'nisn' => $siswa->nisn,
                'nama' => $siswa->nama,
                'hadir' => $item->where('status', 'H')->count(),
                'izin' => $item->where('status', 'I')->count(),
                'sakit' => $item->where('status', 'S')->count(),
                'alfa' => $item->where('status', 'A')->count(),
            ];
        })->values();

        return response()->json([
            'data' => $rekap
        ]);
    }
}
