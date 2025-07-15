@extends('layouts.app')

@section('title', 'Pilih Siswa')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pilih Siswa</h1>

        <form action="{{ route('pembagian.kelas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_akademik_id" value="{{ $tahunAkademikId }}">
            <input type="hidden" name="jurusan_id" value="{{ $jurusanId }}">
            <input type="hidden" name="kelas_id" value="{{ $kelasId }}">

            <div class="overflow-x-auto border border-gray-200 rounded-lg mb-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($siswa as $sw)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $sw->id }}" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $sw->nis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $sw->nisn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $sw->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('pembagian.kelas.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <iconify-icon icon="mdi:arrow-left" class="mr-2"></iconify-icon>
                    Kembali
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <iconify-icon icon="mdi:content-save" class="mr-2"></iconify-icon>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection