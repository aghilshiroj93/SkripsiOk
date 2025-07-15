@extends('dashboard_siswa.layout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Rekap Kehadiran Siswa</h2>
            <p class="text-gray-600 mt-2">Detail lengkap kehadiran Anda</p>
        </div>

        <!-- Informasi Siswa -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Siswa</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span><span class="font-medium">Nama:</span> {{ $siswa->nama }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span><span class="font-medium">NIS:</span> {{ $siswa->nis }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span><span class="font-medium">Kelas:</span> {{ $siswa->detail->kelas->nama_kelas ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Data</h3>
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Akademik</label>
                        <select name="tahun_akademik_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Semua</option>
                            @foreach ($tahunAkademikList as $tahun)
                                <option value="{{ $tahun->id }}" {{ request('tahun_akademik_id') == $tahun->id ? 'selected' : '' }}>
                                    {{ $tahun->tahun }} ({{ ucfirst($tahun->semester) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                        <select name="bulan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Minggu ke</label>
                        <select name="minggu" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('minggu') == $i ? 'selected' : '' }}>Minggu {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-sm text-sm font-medium transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Rekap Kehadiran -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Rekapitulasi Kehadiran</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-green-50 border border-green-100 rounded-lg p-4 text-center">
                        <div class="text-green-800 font-bold text-2xl mb-1">{{ $rekap['hadir'] }}</div>
                        <div class="text-green-600 text-sm font-medium">Hadir</div>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4 text-center">
                        <div class="text-yellow-800 font-bold text-2xl mb-1">{{ $rekap['izin'] }}</div>
                        <div class="text-yellow-600 text-sm font-medium">Izin</div>
                    </div>
                    <div class="bg-orange-50 border border-orange-100 rounded-lg p-4 text-center">
                        <div class="text-orange-800 font-bold text-2xl mb-1">{{ $rekap['sakit'] }}</div>
                        <div class="text-orange-600 text-sm font-medium">Sakit</div>
                    </div>
                    <div class="bg-red-50 border border-red-100 rounded-lg p-4 text-center">
                        <div class="text-red-800 font-bold text-2xl mb-1">{{ $rekap['alpa'] }}</div>
                        <div class="text-red-600 text-sm font-medium">Alpa</div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <div class="text-gray-700 font-semibold">Total Kehadiran: <span class="text-blue-600">{{ $rekap['total'] }}</span></div>
                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Kehadiran</h3>
                <div class="h-64">
                    <canvas id="kehadiranChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('kehadiranChart').getContext('2d');
        const kehadiranChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $rekap['hadir'] }}, {{ $rekap['izin'] }}, {{ $rekap['sakit'] }}, {{ $rekap['alpa'] }}],
                    backgroundColor: [
                        '#34D399', // green
                        '#FBBF24', // yellow
                        '#FB923C', // orange
                        '#F87171' // red
                    ],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        grid: {
                            drawBorder: false,
                            color: '#E5E7EB'
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    }
                }
            }
        });
    </script>
@endsection