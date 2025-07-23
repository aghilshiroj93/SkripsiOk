<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\SiswaTidakAktif;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use App\Models\TahunAkademik;
use App\Models\Detail;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $jadwalModel;

    public function __construct(Jadwal $jadwalModel)
    {
        $this->jadwalModel = $jadwalModel;
    }

    public function index(Request $request)
    {
        $totalSiswa = Siswa::count();
        $totalSiswaTidakAktif = SiswaTidakAktif::count();
        $totalGuru = Guru::count();
        $totalKelas = Kelas::count();
        $totalJurusan = Jurusan::count();
        $totalMapel = MataPelajaran::count();
        $tahunAktif = TahunAkademik::where('is_active', true)->first();
        $tahunAkademikList = TahunAkademik::all();
        $jurusanList = collect();
        $kelasList = collect();
        $rekap = collect();

        // Gunakan tahun aktif sebagai default jika tidak ada filter
        $tahunAkademikId = $request->input('tahun_akademik_id', $tahunAktif ? $tahunAktif->id : null);

        // Jika ada tahun akademik (baik dari request atau default aktif)
        if ($tahunAkademikId) {
            // Set nilai tahun_akademik_id di request agar filter bekerja
            $request->merge(['tahun_akademik_id' => $tahunAkademikId]);

            if (in_array(Auth::user()->role, ['admin', 'bk'])) {
                // Proses yang sama seperti sebelumnya
                $query = Detail::with(['siswa', 'kelas', 'jurusan'])
                    ->where('tahun_akademik_id', $tahunAkademikId);

                if ($request->filled('jurusan_id')) {
                    $query->where('jurusan_id', $request->jurusan_id);
                    $kelasList = $query->clone()->get()->pluck('kelas')->unique('id')->values();
                }

                if ($request->filled('kelas_id')) {
                    $query->where('kelas_id', $request->kelas_id);
                }

                $jurusanList = Detail::where('tahun_akademik_id', $tahunAkademikId)
                    ->with('jurusan')
                    ->get()
                    ->pluck('jurusan')
                    ->unique('id')
                    ->values();

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

                    // Tambahkan filter bulan jika ada
                    if ($request->filled('bulan')) {
                        $absensiQuery->whereMonth('waktu_absen', $request->bulan);
                    }

                    $absensiPerTanggal = $absensiQuery->get()->groupBy(function ($item) {
                        return \Carbon\Carbon::parse($item->waktu_absen)->format('Y-m-d');
                    });

                    foreach ($absensiPerTanggal as $tanggal => $absensiData) {
                        $statusCount = $absensiData->groupBy('status')->map->count();
                        $rekap->push([
                            'tanggal' => $tanggal,
                            'hadir' => $statusCount['H'] ?? 0,
                            'sakit' => $statusCount['S'] ?? 0,
                            'izin'  => $statusCount['I'] ?? 0,
                            'alpa'  => $statusCount['A'] ?? 0,
                        ]);
                    }
                }
            } else {
                // Proses untuk role selain admin/bk
                $query = Detail::with(['siswa', 'kelas', 'jurusan'])
                    ->where('tahun_akademik_id', $tahunAkademikId);

                if ($request->filled('jurusan_id')) {
                    $query->where('jurusan_id', $request->jurusan_id);
                    $kelasList = $this->jadwalModel->getKelasByTahunAkemikAndJurusanAndIdGuru(
                        $tahunAkademikId,
                        $request->jurusan_id,
                        Auth::user()->guru->id
                    );
                }

                if ($request->filled('kelas_id')) {
                    $query->where('kelas_id', $request->kelas_id);
                }

                $jurusanList = $this->jadwalModel->getJurusanByTahunAkademikAndIdGuru(
                    $tahunAkademikId,
                    Auth::user()->guru->id
                );

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

                    // Tambahkan filter bulan jika ada
                    if ($request->filled('bulan')) {
                        $absensiQuery->whereMonth('waktu_absen', $request->bulan);
                    }

                    $absensiPerTanggal = $absensiQuery->get()->groupBy(function ($item) {
                        return \Carbon\Carbon::parse($item->waktu_absen)->format('Y-m-d');
                    });

                    foreach ($absensiPerTanggal as $tanggal => $absensiData) {
                        $statusCount = $absensiData->groupBy('status')->map->count();
                        $rekap->push([
                            'tanggal' => $tanggal,
                            'hadir' => $statusCount['H'] ?? 0,
                            'sakit' => $statusCount['S'] ?? 0,
                            'izin'  => $statusCount['I'] ?? 0,
                            'alpa'  => $statusCount['A'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return view('dashboard.index', compact(
            'tahunAktif',
            'totalSiswa',
            'totalSiswaTidakAktif',
            'totalGuru',
            'totalKelas',
            'totalJurusan',
            'totalMapel',
            'tahunAkademikList',
            'rekap',
            'kelasList',
            'jurusanList'
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
