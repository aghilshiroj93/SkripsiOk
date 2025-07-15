@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Absensi ({{ $jadwal->hari }} {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})</h1>

    <form action="{{ route('absensi.update', $jadwal->id) }}" method="POST">
        @csrf
        <table class="w-full border text-sm mb-4">
            <thead class="bg-gray-100">
                <tr>
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
                @foreach ($absensiList as $absen)
                    <tr>
                        <td class="border p-2">{{ $absen->siswa->nis }}</td>
                        <td class="border p-2">{{ $absen->siswa->nisn }}</td>
                        <td class="border p-2">{{ $absen->siswa->nama }}</td>
                        <td class="border p-2">
                            <input type="hidden" name="absensi_id[]" value="{{ $absen->id }}">
                            <input type="radio" name="status[{{ $absen->id }}]" value="H" 
                                {{ $absen->status == 'H' ? 'checked' : '' }}>
                        </td>
                        <td class="border p-2">
                            <input type="radio" name="status[{{ $absen->id }}]" value="I" 
                                {{ $absen->status == 'I' ? 'checked' : '' }}>
                        </td>
                        <td class="border p-2">
                            <input type="radio" name="status[{{ $absen->id }}]" value="S" 
                                {{ $absen->status == 'S' ? 'checked' : '' }}>
                        </td>
                        <td class="border p-2">
                            <input type="radio" name="status[{{ $absen->id }}]" value="A" 
                                {{ $absen->status == 'A' ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update Absensi</button>
        </div>
    </form>
</div>
@endsection
