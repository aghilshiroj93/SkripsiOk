@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Rekapitulasi Absensi</h1>
    </div>

    <!-- Filter Form -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
            <!-- Tahun Akademik -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Akademik</label>
                <select name="tahun_akademik_id" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Tahun</option>
                    @foreach ($tahunAkademikList as $ta)
                        <option value="{{ $ta->id }}" {{ request('tahun_akademik_id') == $ta->id ? 'selected' : '' }}>
                            {{ $ta->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jurusan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <select name="jurusan_id" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Jurusan</option>
                    @foreach ($jurusanList as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kelas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="kelas_id"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <div class="flex items-end">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Filter Data
                </button>
            </div>
        </form>
    </div>

    <!-- Rekap Table -->
    @if ($rekap->count())
        <div class="bg-white rounded-xl shadow-md overflow-hidden" id="tabel_pembagian">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hadir</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sakit</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Izin</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Alpa</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($rekap as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['nis'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['nisn'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['nama'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['jurusan'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['kelas'] }}</td>
                                <td class="px-6 py-4 text-center text-sm font-semibold text-green-600">{{ $item['hadir'] }}</td>
                                <td class="px-6 py-4 text-center text-sm text-yellow-600">{{ $item['sakit'] }}</td>
                                <td class="px-6 py-4 text-center text-sm text-yellow-500">{{ $item['izin'] }}</td>
                                <td class="px-6 py-4 text-center text-sm font-semibold text-red-500">{{ $item['alpa'] }}</td>
                                <td class="px-6 py-4 text-center text-sm font-bold text-gray-900">{{ $item['total'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Silakan gunakan filter di atas untuk menampilkan data rekapitulasi absensi.</p>
        </div>
    @endif
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #tabel_pembagian, #tabel_pembagian * {
            visibility: visible;
        }
        #tabel_pembagian {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
