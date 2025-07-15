@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Form Tambah/Edit -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                    {{ request()->has('edit') ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' }}
                </h2>
                <form
                    action="{{ request()->has('edit') ? route('mata_pelajaran.update', request('edit')) : route('mata_pelajaran.store') }}"
                    method="POST">
                    @csrf
                    @if (request()->has('edit'))
                        @method('PUT')
                    @endif

                    @php
                        $editData = request()->has('edit') ? \App\Models\MataPelajaran::find(request('edit')) : null;
                    @endphp

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
                        <input type="text" name="nama" value="{{ old('nama', $editData->nama ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        @error('nama')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition duration-200 shadow-sm">
                            {{ request()->has('edit') ? 'Update' : 'Simpan' }}
                        </button>
                        @if (request()->has('edit'))
                            <a href="{{ route('mata_pelajaran.index') }}"
                                class="text-gray-500 hover:text-gray-700 text-sm font-medium">Batal</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Daftar Mata Pelajaran</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($mataPelajaran as $item)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-4">
                                            <a href="{{ route('mata_pelajaran.index', ['edit' => $item->id]) }}"
                                                class="text-blue-600 hover:text-blue-800 hover:underline transition duration-200">Edit</a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('mata_pelajaran.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-800 hover:underline transition duration-200 swal-confirm"
                                                    data-id="{{ $item->id }}">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.swal-confirm').forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
