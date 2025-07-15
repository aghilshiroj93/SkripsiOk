@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
    <div
        class="max-w-3xl mx-auto bg-white/80 backdrop-blur-lg p-8 rounded-xl shadow-xl border border-gray-200 transition-all duration-300">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-4 border-b border-gray-200">
            <h2 class="text-3xl font-extrabold text-gray-900">Detail Siswa</h2>
            <div
                class="mt-2 md:mt-0 inline-flex items-center px-4 py-1.5 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 text-sm font-medium">
                ID: {{ $siswa->id }}
            </div>
        </div>

        <div class="space-y-6">
            <!-- NIS & NISN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <p class="text-xs uppercase tracking-wider text-gray-500">NIS</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $siswa->nis }}</p>
                </div>
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <p class="text-xs uppercase tracking-wider text-gray-500">NISN</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $siswa->nisn }}</p>
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-lg shadow-inner">
                <p class="text-xs uppercase tracking-wider text-gray-500">Nama Lengkap</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $siswa->nama }}</p>
            </div>

            <!-- Jenis Kelamin & Tanggal Lahir -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <p class="text-xs uppercase tracking-wider text-gray-500">Jenis Kelamin</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow transition-shadow">
                    <p class="text-xs uppercase tracking-wider text-gray-500">Tanggal Lahir</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $siswa->tanggal_lahir }}</p>
                </div>
            </div>

            <!-- Tempat Lahir -->
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <p class="text-xs uppercase tracking-wider text-gray-500">Tempat Lahir</p>
                <p class="text-lg font-semibold text-gray-800">{{ $siswa->tempat_lahir }}</p>
            </div>

            <!-- Alamat -->
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <p class="text-xs uppercase tracking-wider text-gray-500">Alamat</p>
                <p class="text-lg font-semibold text-gray-800">{{ $siswa->alamat }}</p>
            </div>

            <!-- Nomor HP -->
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <p class="text-xs uppercase tracking-wider text-gray-500">Nomor HP</p>
                <p class="text-lg font-semibold text-gray-800">{{ $siswa->no_hp }}</p>
            </div>
        </div>
        <!-- Password Info -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded">
            <p class="font-semibold">Catatan:</p>
            <p>Password siswa <strong>tidak ditampilkan</strong> di sini untuk alasan keamanan. Jika siswa lupa, Anda bisa
                meresetnya lewat tombol edit.</p>
        </div>


        <!-- Tombol Kembali -->
        <div class="mt-10 flex justify-end">
            <a href="{{ route('siswa.index') }}"
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Siswa
            </a>
        </div>
    </div>
@endsection
