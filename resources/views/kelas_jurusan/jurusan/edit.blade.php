@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Jurusan</h2>

    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nama Jurusan</label>
        <input type="text" name="nama" value="{{ $jurusan->nama }}" required class="w-full border px-3 py-2 rounded mb-4">

        <div class="flex justify-end gap-2">
            <a href="{{ route('kelas-jurusan.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
