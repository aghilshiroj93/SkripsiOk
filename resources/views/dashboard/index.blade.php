@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 mt-2">Ringkasan statistik dan data kehadiran</p>
        </div>

        <!-- Stats Cards -->
        @auth
            @if (auth()->user()->role == 'guru')
                <!-- Teacher Stats Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ([
                [
                    'title' => 'Jadwal Mengajar',
                    'value' => $totalJadwal ?? '0',
                    'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'color' => 'blue',
                    'tooltip' => 'Total jadwal mengajar Anda',
                ],
                [
                    'title' => 'Kelas Diajar',
                    'value' => $totalKelas ?? '0',
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'color' => 'green',
                    'tooltip' => 'Jumlah kelas yang Anda ajar',
                ],
                [
                    'title' => 'Jurusan Diajar',
                    'value' => $totalJurusan ?? '0',
                    'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
                    'color' => 'purple',
                    'tooltip' => 'Jumlah jurusan yang Anda ajar',
                ],
                [
                    'title' => 'Total Siswa',
                    'value' => $totalSiswa ?? '0',
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'color' => 'yellow',
                    'tooltip' => 'Total siswa di kelas yang Anda ajar',
                ],
            ] as $card)
                        <!-- Stat Card -->
                        <div
                            class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative group">
                            <!-- Card Content - Always Visible -->
                            <div class="flex items-center space-x-4">
                                <!-- Icon -->
                                <div class="p-3 rounded-full bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $card['icon'] }}" />
                                    </svg>
                                </div>

                                <!-- Text - Always Visible -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ $card['title'] }}</p>
                                    <p class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
                                </div>
                            </div>

                            <!-- Tooltip - Only shows on hover -->
                            <div
                                class="hidden group-hover:block absolute z-10 w-48 px-2 py-1 text-sm text-white bg-gray-800 rounded shadow-lg bottom-full mb-2 left-1/2 transform -translate-x-1/2">
                                {{ $card['tooltip'] }}
                                <div
                                    class="absolute w-3 h-3 -bottom-1 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-800">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Tampilan Statistik untuk Admin/BK -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ([
                [
                    'title' => 'Siswa Aktif',
                    'value' => $totalSiswa ?? '0',
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'color' => 'blue',
                    'tooltip' => 'Jumlah siswa aktif saat ini',
                ],
                [
                    'title' => 'Siswa Tidak Aktif',
                    'value' => $totalSiswaTidakAktif ?? '0',
                    'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                    'color' => 'red',
                    'tooltip' => 'Jumlah siswa tidak aktif',
                ],
                [
                    'title' => 'Guru',
                    'value' => $totalGuru ?? '0',
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'color' => 'purple',
                    'tooltip' => 'Total guru terdaftar',
                ],
                [
                    'title' => 'Kelas',
                    'value' => $totalKelas ?? '0',
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'color' => 'green',
                    'tooltip' => 'Jumlah kelas aktif',
                ],
            ] as $card)
                        <div
                            class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative group">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-full bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $card['icon'] }}" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ $card['title'] }}</p>
                                    <p class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
                                </div>
                            </div>
                            @isset($card['tooltip'])
                                <div
                                    class="hidden group-hover:block absolute z-10 w-48 px-2 py-1 text-sm text-white bg-gray-800 rounded shadow-lg bottom-full mb-2 left-1/2 transform -translate-x-1/2">
                                    {{ $card['tooltip'] }}
                                    <div
                                        class="absolute w-3 h-3 -bottom-1 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-800">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endforeach
                </div>

                <!-- Secondary Stats for Admin/BK -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ([
                [
                    'title' => 'Jurusan',
                    'value' => $totalJurusan ?? '0',
                    'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
                    'color' => 'yellow',
                    'tooltip' => 'Total jurusan yang tersedia',
                ],
                [
                    'title' => 'Mata Pelajaran',
                    'value' => $totalMapel ?? '0',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'color' => 'indigo',
                    'tooltip' => 'Total mata pelajaran',
                ],
                [
                    'title' => 'Tahun Akademik',
                    'value' => $tahunAktif ? $tahunAktif->tahun . ' - ' . ucfirst($tahunAktif->semester) : '<span class="text-gray-400 italic">Belum aktif</span>',
                    'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'color' => 'emerald',
                    'tooltip' => 'Tahun akademik aktif saat ini',
                    'html' => true,
                ],
            ] as $card)
                        <div
                            class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative group">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-full bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $card['icon'] }}" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ $card['title'] }}</p>
                                    @if (isset($card['html']) && $card['html'])
                                        <p class="text-xl font-semibold text-{{ $card['color'] }}-600">{!! $card['value'] !!}
                                        </p>
                                    @else
                                        <p class="text-xl font-semibold text-{{ $card['color'] }}-600">{{ $card['value'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @isset($card['tooltip'])
                                <div
                                    class="hidden group-hover:block absolute z-10 w-48 px-2 py-1 text-sm text-white bg-gray-800 rounded shadow-lg bottom-full mb-2 left-1/2 transform -translate-x-1/2">
                                    {{ $card['tooltip'] }}
                                    <div
                                        class="absolute w-3 h-3 -bottom-1 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-800">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endforeach
                </div>
            @endif
        @endauth

        <!-- Secondary Stats -->
        {{-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            @foreach ([['title' => 'Jurusan', 'value' => $totalJurusan ?? '-', 'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z', 'color' => 'yellow'], ['title' => 'Mata Pelajaran', 'value' => $totalMapel ?? '-', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'indigo'], ['title' => 'Tahun Akademik Aktif', 'value' => $tahunAktif ? $tahunAktif->tahun . ' - ' . ucfirst($tahunAktif->semester) : '<span class="text-gray-400 italic">Belum aktif</span>', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'emerald']] as $card)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ $card['title'] }}</p>
                            <p class="text-xl font-semibold text-{{ $card['color'] }}-600">{!! $card['value'] !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

        <!-- Main Content Area -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Filter Section - Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
                    <div class="flex items-center mb-4">
                        <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Filter Data</h3>
                    </div>

                    <form method="GET" class="space-y-4">
                        @foreach ([
            ['name' => 'tahun_akademik_id', 'label' => 'Tahun Akademik', 'options' => $tahunAkademikList, 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['name' => 'jurusan_id', 'label' => 'Jurusan', 'options' => $jurusanList, 'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'],
            ['name' => 'kelas_id', 'label' => 'Kelas', 'options' => $kelasList, 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['name' => 'bulan', 'label' => 'Bulan', 'options' => [['id' => '01', 'nama' => 'Januari'], ['id' => '02', 'nama' => 'Februari'], ['id' => '03', 'nama' => 'Maret'], ['id' => '04', 'nama' => 'April'], ['id' => '05', 'nama' => 'Mei'], ['id' => '06', 'nama' => 'Juni'], ['id' => '07', 'nama' => 'Juli'], ['id' => '08', 'nama' => 'Agustus'], ['id' => '09', 'nama' => 'September'], ['id' => '10', 'nama' => 'Oktober'], ['id' => '11', 'nama' => 'November'], ['id' => '12', 'nama' => 'Desember']], 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ] as $field)
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $field['icon'] }}" />
                                        </svg>
                                    </div>
                                    <select name="{{ $field['name'] }}" onchange="this.form.submit()"
                                        class="block w-full pl-10 pr-3 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md transition-all duration-150 shadow-sm hover:border-blue-300 appearance-none bg-white">
                                        <option value="">Semua {{ $field['label'] }}</option>
                                        @foreach ($field['options'] as $option)
                                            <option value="{{ $option->id ?? $option['id'] }}"
                                                {{ request($field['name']) == ($option->id ?? $option['id']) ? 'selected' : '' }}
                                                @if (
                                                    $field['name'] == 'tahun_akademik_id' &&
                                                        !request($field['name']) &&
                                                        isset($tahunAktif) &&
                                                        ($option->id ?? $option['id']) == $tahunAktif->id) selected @endif>
                                                {{ $option->nama ?? ($option->tahun ?? ($option->nama_kelas ?? $option['nama'])) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex space-x-3 pt-2">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Terapkan
                            </button>
                            @if (count(array_filter(request()->all())))
                                <a href="{{ url()->current() }}"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 flex items-center justify-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <!-- Section Header with Stats -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Rekapitulasi Absensi</h2>
                                <p class="text-gray-600 mt-1">Analisis data kehadiran siswa secara komprehensif</p>
                            </div>
                            @if ($rekap->count())
                                <div class="mt-4 md:mt-0 flex items-center space-x-3">
                                    <div
                                        class="bg-blue-50 px-3 py-1 rounded-full text-sm font-medium text-blue-800 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $rekap->count() }} data ditemukan
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($rekap->count())
                            @php
                                // Process data for chart
                                $rekapPerTanggal = [];
                                $totalHadir = 0;
                                $totalTidakHadir = 0;

                                foreach ($rekap as $item) {
                                    if (!empty($item['tanggal'])) {
                                        $tgl = \Carbon\Carbon::parse($item['tanggal'])->format('d M');
                                        if (!isset($rekapPerTanggal[$tgl])) {
                                            $rekapPerTanggal[$tgl] = [
                                                'hadir' => 0,
                                                'sakit' => 0,
                                                'izin' => 0,
                                                'alpa' => 0,
                                            ];
                                        }

                                        $rekapPerTanggal[$tgl]['hadir'] += $item['hadir'];
                                        $rekapPerTanggal[$tgl]['sakit'] += $item['sakit'];
                                        $rekapPerTanggal[$tgl]['izin'] += $item['izin'];
                                        $rekapPerTanggal[$tgl]['alpa'] += $item['alpa'];

                                        $totalHadir += $item['hadir'];
                                        $totalTidakHadir += $item['sakit'] + $item['izin'] + $item['alpa'];
                                    }
                                }

                                // Sort by date
                                uksort($rekapPerTanggal, function ($a, $b) {
                                    return strtotime($a) - strtotime($b);
                                });
                            @endphp

                            <!-- Summary Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-green-50 border border-green-100 rounded-lg p-4 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Hadir</p>
                                            <p class="text-2xl font-bold text-green-600">{{ $totalHadir }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Sakit</p>
                                            <p class="text-2xl font-bold text-yellow-600">
                                                {{ array_sum(array_column($rekapPerTanggal, 'sakit')) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Izin</p>
                                            <p class="text-2xl font-bold text-blue-600">
                                                {{ array_sum(array_column($rekapPerTanggal, 'izin')) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-red-50 border border-red-100 rounded-lg p-4 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-full bg-red-100 text-red-600 mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Alpa</p>
                                            <p class="text-2xl font-bold text-red-600">
                                                {{ array_sum(array_column($rekapPerTanggal, 'alpa')) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Section -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">Grafik Kehadiran Harian</h3>
                                    <div class="flex space-x-2">
                                        <button onclick="toggleChartType()"
                                            class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-md text-gray-700 transition-colors flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                            Tampilan
                                        </button>
                                        <button onclick="downloadChart()"
                                            class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-md text-gray-700 transition-colors flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Unduh
                                        </button>
                                    </div>
                                </div>
                                <div class="h-96">
                                    <canvas id="absensiChart" data-rekap="{{ json_encode($rekapPerTanggal) }}"></canvas>
                                </div>
                            </div>

                            <!-- Data Table -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">Detail Rekapitulasi</h3>
                                    <div class="relative">
                                        <select id="tableSort"
                                            class="block appearance-none bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <option value="date-asc">Tanggal (Terlama)</option>
                                            <option value="date-desc">Tanggal (Terbaru)</option>
                                            <option value="hadir-desc">Hadir (Terbanyak)</option>
                                            <option value="alpa-desc">Alpa (Terbanyak)</option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tanggal</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Hadir</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Sakit</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Izin</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Alpa</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Total</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($rekapPerTanggal as $date => $data)
                                                @php
                                                    $total =
                                                        $data['hadir'] + $data['sakit'] + $data['izin'] + $data['alpa'];
                                                    $percentage =
                                                        $total > 0 ? round(($data['hadir'] / $total) * 100) : 0;
                                                @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $date }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                                        {{ $data['hadir'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600">
                                                        {{ $data['sakit'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                                        {{ $data['izin'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                                                        {{ $data['alpa'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $total }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="w-16 mr-2">
                                                                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                                    <div class="h-full bg-green-500 rounded-full"
                                                                        style="width: {{ $percentage }}%"></div>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="text-xs font-medium text-gray-500">{{ $percentage }}%</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="bg-gray-50 rounded-xl p-12 text-center border-2 border-dashed border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-700">Tidak ada data absensi</h3>
                                <p class="mt-2 text-gray-500 max-w-md mx-auto">Data absensi tidak ditemukan untuk filter
                                    yang
                                    Anda pilih. Coba gunakan kriteria filter yang berbeda.</p>
                                <div class="mt-6">
                                    <a href="{{ url()->current() }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Initialize chart
        let absensiChart;
        let currentChartType = 'bar';

        document.addEventListener('DOMContentLoaded', function() {
            renderChart();

            // Table sorting functionality
            document.getElementById('tableSort').addEventListener('change', function() {
                const value = this.value;
                const tbody = document.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));

                rows.sort((a, b) => {
                    const aCells = a.querySelectorAll('td');
                    const bCells = b.querySelectorAll('td');

                    if (value === 'date-asc') {
                        return new Date(aCells[0].textContent) - new Date(bCells[0].textContent);
                    } else if (value === 'date-desc') {
                        return new Date(bCells[0].textContent) - new Date(aCells[0].textContent);
                    } else if (value === 'hadir-desc') {
                        return parseInt(bCells[1].textContent) - parseInt(aCells[1].textContent);
                    } else if (value === 'alpa-desc') {
                        return parseInt(bCells[4].textContent) - parseInt(aCells[4].textContent);
                    }
                    return 0;
                });

                // Remove existing rows
                rows.forEach(row => tbody.removeChild(row));

                // Add sorted rows
                rows.forEach(row => tbody.appendChild(row));
            });
        });

        function renderChart() {
            const ctx = document.getElementById('absensiChart');
            const data = JSON.parse(ctx.dataset.rekap);
            const labels = Object.keys(data);
            const colors = {
                hadir: {
                    bg: '#22c55e',
                    border: '#16a34a',
                    hover: '#4ade80'
                },
                sakit: {
                    bg: '#facc15',
                    border: '#eab308',
                    hover: '#fde047'
                },
                izin: {
                    bg: '#38bdf8',
                    border: '#0ea5e9',
                    hover: '#7dd3fc'
                },
                alpa: {
                    bg: '#ef4444',
                    border: '#dc2626',
                    hover: '#f87171'
                }
            };

            const datasets = Object.entries(colors).map(([key, color]) => ({
                label: key.charAt(0).toUpperCase() + key.slice(1) +
                    (key === 'hadir' ? ' (H)' : key === 'sakit' ? ' (S)' : key === 'izin' ? ' (I)' : ' (A)'),
                backgroundColor: color.bg,
                borderColor: color.border,
                borderWidth: 1,
                hoverBackgroundColor: color.hover,
                hoverBorderColor: color.border,
                data: labels.map(date => data[date][key]),
                barPercentage: 0.8,
                categoryPercentage: 0.9
            }));

            if (absensiChart) {
                absensiChart.destroy();
            }

            absensiChart = new Chart(ctx, {
                type: currentChartType,
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    family: 'Inter, sans-serif'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: {
                                size: 14,
                                weight: 'bold',
                                family: 'Inter, sans-serif'
                            },
                            bodyFont: {
                                size: 12,
                                family: 'Inter, sans-serif'
                            },
                            padding: 12,
                            cornerRadius: 6,
                            displayColors: true,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw;
                                }
                            }
                        },
                        datalabels: {
                            display: currentChartType === 'bar' ? false : true,
                            color: '#1f2937',
                            font: {
                                weight: 'bold',
                                size: 10
                            },
                            formatter: function(value) {
                                return value > 0 ? value : '';
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    family: 'Inter, sans-serif'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: '#e5e7eb'
                            },
                            ticks: {
                                color: '#6b7280',
                                stepSize: 1,
                                font: {
                                    family: 'Inter, sans-serif'
                                },
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                },
                plugins: [ChartDataLabels]
            });
        }

        function toggleChartType() {
            currentChartType = currentChartType === 'bar' ? 'line' : 'bar';
            renderChart();
        }

        function downloadChart() {
            const link = document.createElement('a');
            link.download = 'grafik-absensi-' + new Date().toISOString().slice(0, 10) + '.png';
            link.href = document.getElementById('absensiChart').toDataURL('image/png');
            link.click();
        }

        function printChart() {
            const printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Cetak Rekapitulasi Absensi</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .print-header { text-align: center; margin-bottom: 20px; }
                        .print-title { font-size: 18px; font-weight: bold; }
                        .print-subtitle { font-size: 14px; color: #666; }
                        .print-date { font-size: 12px; color: #999; margin-top: 10px; }
                        .print-chart { margin: 30px auto; max-width: 700px; }
                        .print-footer { margin-top: 30px; font-size: 12px; text-align: center; color: #999; }
                    </style>
                </head>
                <body>
                    <div class="print-header">
                        <div class="print-title">Rekapitulasi Absensi</div>
                        <div class="print-subtitle">Sistem Informasi Akademik</div>
                        <div class="print-date">Dicetak pada ${new Date().toLocaleString()}</div>
                    </div>
                    <div class="print-chart">
                        <img src="${document.getElementById('absensiChart').toDataURL('image/png')}" style="width: 100%;" />
                    </div>
                    <div class="print-footer">
                        Laporan ini dicetak secara otomatis dari sistem
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close(); // Add this line
            }, 500);
        }
    </script>
@endsection
