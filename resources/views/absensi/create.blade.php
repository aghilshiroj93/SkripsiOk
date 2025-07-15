@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">
        Absensi ({{ $jadwal->hari }} {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
    </h1>

    <form action="{{ route('absensi.store', $jadwal->id) }}" method="POST">
        @csrf
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">NIS</th>
                    <th class="border p-2">NISN</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">H</th>
                    <th class="border p-2">I</th>
                    <th class="border p-2">S</th>
                    <th class="border p-2">A</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaList as $siswa)
                    <tr>
                        <td class="border p-2">{{ $siswa->nis }}</td>
                        <td class="border p-2">{{ $siswa->nisn }}</td>
                        <td class="border p-2">{{ $siswa->nama }}</td>

                        <!-- Kirim ID siswa sebagai hidden input -->
                        <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">

                        <!-- Absensi radio -->
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $loop->index }}]" value="H">
                        </td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $loop->index }}]" value="I">
                        </td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $loop->index }}]" value="S">
                        </td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $loop->index }}]" value="A" checked>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection
