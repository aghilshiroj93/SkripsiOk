<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;
use App\Models\Detail;
use App\Models\Absensi;
use Illuminate\Support\Facades\Http;

class KirimNotifikasiAlpha extends Command
{
    protected $signature = 'notifikasi:alpha3';
    protected $description = 'Kirim notifikasi ke ortu jika siswa alpha >= 3 kali';

    public function handle()
    {
        $siswaIds = Absensi::select('siswa_id')
            ->where('status', 'A')
            ->groupBy('siswa_id')
            ->havingRaw('COUNT(*) >= 3')
            ->pluck('siswa_id');

        if ($siswaIds->isEmpty()) {
            $this->info('Tidak ada siswa yang Alpha >= 3 kali.');
            return;
        }

        foreach ($siswaIds as $siswa_id) {
            $siswa = Siswa::find($siswa_id);
            if (!$siswa || !$siswa->no_hp) continue;

            $detail = Detail::where('siswa_id', $siswa->id)
                ->with(['kelas', 'jurusan'])
                ->latest()
                ->first();

            $kelas = $detail->kelas->nama_kelas ?? '-';
            $jurusan = $detail->jurusan->nama ?? '-';

            $jumlahAlpha = Absensi::where('siswa_id', $siswa_id)
                ->where('status', 'A')
                ->count();

            $message = "Halo Orang Tua/Wali,\n"
                . "Nama: {$siswa->nama}\n"
                . "Kelas: {$kelas}\n"
                . "Jurusan: {$jurusan}\n"
                . "Alpha: {$jumlahAlpha} kali.\n"
                . "Mohon kesediaannya untuk hadir ke sekolah terkait kehadiran putra/putri Bapak/Ibu yang telah tercatat tidak hadir sebanyak 3 kali. Kehadiran Bapak/Ibu sangat kami harapkan untuk membicarakan hal ini lebih lanjut bersama pihak sekolah.
Terima kasih.";

            Http::withHeaders([
                'Authorization' => config('services.fonnte.api_key'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $siswa->no_hp,
                'message' => $message,
                'countryCode' => '62',
            ]);

            $this->info("Notifikasi dikirim ke: {$siswa->nama}");
        }
    }
}
