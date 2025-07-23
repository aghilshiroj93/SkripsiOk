{{-- @extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Kelas</h2>

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nama Kelas</label>
        <input type="text" name="nama" value="{{ $kelas->nama }}" required class="w-full border px-3 py-2 rounded mb-4">

        <div class="flex justify-end gap-2">
            <a href="{{ route('kelas-jurusan.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection --}}
