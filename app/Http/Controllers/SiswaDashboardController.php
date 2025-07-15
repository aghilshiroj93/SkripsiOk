<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Detail;
use App\Models\Jadwal;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;

class SiswaDashboardController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();
        if (!$siswa) abort(403, 'Siswa belum login.');

        // Ambil semua tahun akademik (untuk dropdown filter)
        $tahunAkademikList = TahunAkademik::orderByDesc('tahun')->get();

        // Filter input
        $tahunAkademikId = $request->input('tahun_akademik_id');
        $bulan = $request->input('bulan');
        $minggu = $request->input('minggu'); // 1 = minggu pertama, dst

        // Ambil absensi siswa
        $absensiQuery = Absensi::where('siswa_id', $siswa->id);

        if ($tahunAkademikId) {
            // Filter berdasarkan jadwal yang ada di tahun akademik tertentu
            $jadwalIds = Jadwal::where('tahun_akademik_id', $tahunAkademikId)->pluck('id');
            $absensiQuery->whereIn('jadwal_id', $jadwalIds);
        }

        if ($bulan) {
            $absensiQuery->whereMonth('waktu_absen', $bulan);
        }

        if ($minggu) {
            $startOfMonth = Carbon::now()->month($bulan ?? now()->month)->startOfMonth();
            $startOfWeek = $startOfMonth->copy()->addWeeks($minggu - 1)->startOfWeek();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();
            $absensiQuery->whereBetween('waktu_absen', [$startOfWeek, $endOfWeek]);
        }

        $absensi = $absensiQuery->get();

        $rekap = [
            'hadir' => $absensi->where('status', 'H')->count(),
            'izin'  => $absensi->where('status', 'I')->count(),
            'sakit' => $absensi->where('status', 'S')->count(),
            'alpa'  => $absensi->where('status', 'A')->count(),
            'total' => $absensi->count()
        ];

        return view('dashboard_siswa.index', compact('siswa', 'rekap', 'tahunAkademikList', 'tahunAkademikId', 'bulan', 'minggu'));
    }

    public function mataPelajaran()
    {
        $siswa = Auth::guard('siswa')->user();


        // Ambil data dari tabel detail
        $detail = \App\Models\Detail::where('siswa_id', $siswa->id)
            ->whereHas('tahunAkademik', fn($q) => $q->where('is_active', 1))
            ->first();

        if (!$detail) {
            return view('dashboard_siswa.mata_pelajaran', [
                'jadwals' => [],
                'message' => 'Anda belum dimasukkan ke kelas.'
            ]);
        }

        // Ambil jadwal sesuai dengan kelas, jurusan dan tahun akademik dari detail
        $jadwals = \App\Models\Jadwal::with(['guru', 'mataPelajaran'])
            ->where('kelas_id', $detail->kelas_id)
            ->where('jurusan_id', $detail->jurusan_id)
            ->where('tahun_akademik_id', $detail->tahun_akademik_id)
            ->get();

        return view('dashboard_siswa.mata_pelajaran', compact('jadwals', 'siswa', 'detail'));
    }



    public function profile()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('dashboard_siswa.profile', compact('siswa'));
    }

    public function changePassword(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();

        $validator = Validator::make($request->all(), [
            'password_baru' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $siswa->password = Hash::make($request->password_baru);
        $siswa->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function rekapSiswa()
    {
        $siswa = auth()->guard('siswa')->user();

        $detail = Detail::with(['kelas', 'jurusan'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        if (!$detail) {
            return view('siswa.rekap', ['rekap' => null, 'detail' => null]);
        }

        $absensi = Absensi::where('siswa_id', $siswa->id)->get()->groupBy('status')->map->count();

        $rekap = [
            'hadir' => $absensi['H'] ?? 0,
            'izin' => $absensi['I'] ?? 0,
            'sakit' => $absensi['S'] ?? 0,
            'alpa' => $absensi['A'] ?? 0,
            'total' => $absensi ? array_sum($absensi->toArray()) : 0,
        ];

        return view('siswa.rekap', compact('rekap', 'detail'));
    }
}
