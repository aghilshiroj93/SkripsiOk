<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Detail;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AbsensiController extends Controller
{
   public function index()
{
    $user = Auth::user();

    // Ambil tahun akademik aktif
    $tahunAktif = TahunAkademik::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tahun akademik aktif belum diatur.');
    }

    // Query awal: hanya jadwal dari tahun akademik aktif
    $jadwalQuery = Jadwal::with(['jurusan', 'kelas', 'guru'])
        ->where('tahun_akademik_id', $tahunAktif->id);

    // Jika bukan admin atau bk, filter berdasarkan guru yang login
    if ($user->role === 'guru') {
        $jadwalQuery->where('guru_id', $user->guru->id);
    }

    $jadwalList = $jadwalQuery->get();

    return view('absensi.index', compact('jadwalList', 'tahunAktif'));
}


    public function create(Jadwal $jadwal)
    {
        $now = Carbon::now();

        // Cek hari
        if (strtolower($jadwal->hari) != strtolower($now->locale('id')->isoFormat('dddd'))) {
            return back()->with('error', 'Hari ini bukan jadwal absensi.');
        }

        // Cek jam
        $jamSekarang = $now->format('H:i');

        if ($jamSekarang < $jadwal->jam_mulai) {
            return back()->with('error', 'Absensi belum dibuka. Tunggu jam mulai.');
        }

        if ($jamSekarang > $jadwal->jam_selesai) {
            return back()->with('error', 'Waktu absensi sudah berakhir.');
        }

        // Ambil data siswa sesuai jadwal
        $siswaList = Detail::where('kelas_id', $jadwal->kelas_id)
            ->where('jurusan_id', $jadwal->jurusan_id)
            ->with('siswa')
            ->get()
            ->pluck('siswa')
            ->filter();

        return view('absensi.create', compact('jadwal', 'siswaList'));
    }



    public function store(Request $request, Jadwal $jadwal)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru', 'bk'])) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan absensi.');
        }

        if (!$request->siswa_id || !$request->status) {
            return back()->with('error', 'Data absensi tidak lengkap. Mohon isi semua absensi.');
        }

        foreach ($request->siswa_id as $index => $siswa_id) {
            Absensi::updateOrCreate(
                [
                    'jadwal_id' => $jadwal->id,
                    'siswa_id' => $siswa_id
                ],
                [
                    'guru_id' => auth()->user()->guru->id,
                    'status' => $request->status[$index],
                    'waktu_absen' => now()
                ]
            );
        }
        // // Hanya kirim 
        // $now = now();
        // if ($now->format('H:i') >= '14:00') {
        //     // $token = 'vdu6Te1psvaHjw5K8Jz3'; // <- Ganti ini dengan token asli kamu

        //     foreach ($request->siswa_id as $index => $siswa_id) {
        //         $siswa = \App\Models\Siswa::find($siswa_id);

        //         if ($siswa && $siswa->no_hp) {
        //             $kelas = \App\Models\Detail::where('siswa_id', $siswa->id)
        //                 ->with(['kelas', 'jurusan'])
        //                 ->latest()
        //                 ->first();

        //             $statusCode = $request->status[$index];
        //             $statusMap = [
        //                 'H' => 'Hadir',
        //                 'S' => 'Sakit',
        //                 'I' => 'Izin',
        //                 'A' => 'Tidak Hadir',
        //             ];
        //             $status = $statusMap[$statusCode] ?? $statusCode;

        //             $message = "Halo Orang Tua/Wali,\n"
        //                 . "Absensi hari ini:\n"
        //                 . "Nama: $siswa->nama\n"
        //                 . "Kelas: " . ($kelas->kelas->nama_kelas ?? '-') . "\n"
        //                 . "Jurusan: " . ($kelas->jurusan->nama ?? '-') . "\n"
        //                 . "Status: $status";

        //             // Kirim ke Fonnte
        //             Http::withHeaders([
        //                 'Authorization' => config('services.fonnte.api_key'),
        //             ])->post('https://api.fonnte.com/send', [
        //                 'target' => $siswa->no_hp,
        //                 'message' => $message,
        //                 'countryCode' => '62',
        //             ]);
        //         }
        //     }
        // }


        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }




    public function edit(Jadwal $jadwal)
    {
        $user = auth()->user();

        // Batasi akses berdasarkan role
        if ($user->role === 'guru') {
            // Pastikan jadwal milik guru yang sedang login
            if ($jadwal->guru_id !== $user->guru->id) {
                abort(403, 'Anda tidak memiliki izin untuk mengedit absensi ini.');
            }
        } elseif (!in_array($user->role, ['admin', 'bk'])) {
            // Hanya admin, guru, dan bk yang diizinkan
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Ambil data absensi untuk jadwal yang dipilih
        $absensiList = Absensi::with('siswa')
            ->where('jadwal_id', $jadwal->id)
            ->get();

        return view('absensi.edit', compact('jadwal', 'absensiList'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        foreach ($request->status as $id => $status) {
            $absensi = Absensi::find($id);

            if ($absensi) {
                $absensi->update([
                    'status' => $status,
                    'waktu_absen' => now()
                ]);
            }
        }


        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }



    public function sendNotificationForToday()
    {
        $absensis = Absensi::with(['siswa'])
            ->whereDate('waktu_absen', now()->toDateString())
            ->where('notifikasi_terkirim', false)
            ->get();

        if ($absensis->isEmpty()) {
            return back()->with([
                'alert-type' => 'info',
                'message' => 'Semua notifikasi hari ini sudah pernah dikirim.',
            ]);
        }

        foreach ($absensis as $absen) {
            $statusMap = [
                'H' => 'Hadir',
                'S' => 'Sakit',
                'I' => 'Izin',
                'A' => 'Tidak Hadir',
            ];

            $status = $statusMap[$absen->status] ?? $absen->status;
            $siswa = $absen->siswa;

            if ($siswa && $siswa->no_hp) {
                // GUNAKAN DETAIL TERBARU DARI SISWA (bukan relasi dari absensi)
                $detail = \App\Models\Detail::where('siswa_id', $siswa->id)
                    ->with(['kelas', 'jurusan'])
                    ->latest()
                    ->first();

                $kelas = $detail->kelas->nama_kelas ?? '-';
                $jurusan = $detail->jurusan->nama ?? '-';

                $message = "Halo Orang Tua/Wali,\nAbsensi hari ini:\n"
                    . "Nama: {$siswa->nama}\n"
                    . "Kelas: {$kelas}\n"
                    . "Jurusan: {$jurusan}\n"
                    . "Status: {$status}";

                $response = Http::withHeaders([
                    'Authorization' => config('services.fonnte.api_key'),
                ])->post('https://api.fonnte.com/send', [
                    'target' => $siswa->no_hp,
                    'message' => $message,
                    'countryCode' => '62',
                ]);

                if ($response->successful()) {
                    $absen->update(['notifikasi_terkirim' => true]);
                }
            }
        }

        return back()->with([
            'alert-type' => 'success',
            'message' => 'Notifikasi berhasil dikirim.',
        ]);
    }
}
