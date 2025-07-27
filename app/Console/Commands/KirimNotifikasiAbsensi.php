<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class KirimNotifikasiAbsensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absensi:kirim-notifikasi';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim notifikasi absensi otomatis jam 14:00 jika belum dikirim';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $absensis = \App\Models\Absensi::with(['siswa', 'jadwal'])
            ->whereDate('waktu_absen', now()->toDateString())
            ->where('notifikasi_terkirim', false)
            ->get()
            ->groupBy(fn($absen) => $absen->siswa_id . '-' . $absen->jadwal->kelas_id)
            ->map(fn($group) => $group->sortByDesc('waktu_absen')->first());

        foreach ($absensis as $absen) {
            $statusMap = ['H' => 'Hadir', 'S' => 'Sakit', 'I' => 'Izin', 'A' => 'Tidak Hadir'];
            $status = $statusMap[$absen->status] ?? $absen->status;
            $siswa = $absen->siswa;

            if ($siswa && $siswa->no_hp) {
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

                $response = \Illuminate\Support\Facades\Http::withHeaders([
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

        $this->info('Notifikasi absensi otomatis dikirim.');
    }
}
