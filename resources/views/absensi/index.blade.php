@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Daftar Jadwal Absensi</h1>
        <div class="mb-4 p-4 bg-gray-50 rounded-lg shadow-sm">
            <p class="text-gray-700 font-medium">
                <span class="font-semibold">Tahun Akademik Aktif:</span>
                {{ $tahunAktif->tahun }}
                <span class="italic">({{ ucfirst($tahunAktif->semester) }})</span>
            </p>
        </div>

        @php
            use Carbon\Carbon;
        @endphp
        @if (auth()->user()->role === 'admin')
            <form method="POST" action="{{ route('absensi.kirimNotifikasi') }}">
                @csrf
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 mb-4">
                    Kirim Notifikasi Hari Ini
                </button>
            </form>
        @endif
        @if (session('message'))
            <script>
                Swal.fire({
                    icon: '{{ session('alert-type', 'info') }}',
                    title: '{{ session('message') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="border p-2">Hari</th>
                    <th class="border p-2">Jam</th>
                    <th class="border p-2">Kelas</th>
                    <th class="border p-2">Jurusan</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalList as $jadwal)
                    @php
                        $now = \Carbon\Carbon::now();
                        $jamSekarang = $now->format('H:i');
                        $hariSekarang = strtolower($now->locale('id')->isoFormat('dddd'));

                        $bolehAbsen =
                            strtolower($jadwal->hari) === $hariSekarang &&
                            $jamSekarang >= $jadwal->jam_mulai &&
                            $jamSekarang <= $jadwal->jam_selesai;

                        $waktuHabis = $jamSekarang > $jadwal->jam_selesai;
                        $sudahAbsensi = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                            ->whereDate('waktu_absen', \Carbon\Carbon::today())
                            ->exists();

                    @endphp

                    <tr>
                        <td class="border p-2">{{ $jadwal->hari }}</td>
                        <td class="border p-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td class="border p-2">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                        <td class="border p-2">{{ $jadwal->jurusan->nama ?? '-' }}</td>
                        <td class="border p-2 flex gap-2">

                            {{-- Tombol Play --}}
                            @if (!$sudahAbsensi && $bolehAbsen)
                                <a href="{{ route('absensi.create', $jadwal->id) }}"
                                    class="bg-green-500 text-white p-2 rounded" title="Mulai Absensi">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-6.518-3.759A1 1 0 007 8.24v7.52a1 1 0 001.234.97l6.518-3.759a1 1 0 000-1.742z" />
                                    </svg>
                                </a>
                            @else
                                <button disabled class="bg-gray-400 text-white p-2 rounded" title="Play Nonaktif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-6.518-3.759A1 1 0 007 8.24v7.52a1 1 0 001.234.97l6.518-3.759a1 1 0 000-1.742z" />
                                    </svg>
                                </button>
                            @endif

                            {{-- Tombol Setting --}}
                            @if ($sudahAbsensi && !$waktuHabis)
                                <a href="{{ route('absensi.edit', $jadwal->id) }}"
                                    class="bg-blue-500 text-white p-2 rounded" title="Edit Absensi">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-5-9l5 5m0 0L13 16H9v-4l8-8z" />
                                    </svg>
                                </a>
                            @else
                                <button disabled class="bg-gray-400 text-white p-2 rounded" title="Setting Nonaktif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-5-9l5 5m0 0L13 16H9v-4l8-8z" />
                                    </svg>
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


    </div>
@endsection
