@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <iconify-icon icon="mdi:account-plus" width="24"></iconify-icon>
                <span>Tambah Data Siswa</span>
            </h2>
            <a href="{{ route('siswa.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                <iconify-icon icon="mdi:arrow-left" class="mr-1"></iconify-icon>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIS <span class="text-red-500">*</span></label>
                    <input type="text" name="nis" value="{{ old('nis') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NISN <span class="text-red-500">*</span></label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('siswa.index') }}"
                   class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                    <iconify-icon icon="mdi:close" class="mr-2"></iconify-icon>
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                    <iconify-icon icon="mdi:content-save" class="mr-2"></iconify-icon>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection