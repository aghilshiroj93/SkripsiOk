@extends('layouts.app')

@section('title', 'Tahun Akademik')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tahun Akademik</h2>
            <button onclick="openModal()"
                class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Tahun
            </button>
        </div>

        <!-- Notifikasi -->
        {{-- @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif --}}

        <!-- Tabel -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-50">
                        <tr class="text-left">
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $item->tahun }}</td>
                                <td class="px-6 py-4 capitalize">{{ $item->semester }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('tahun-akademik.toggleStatus', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                    @if ($item->is_active) bg-blue-600 @else bg-gray-200 @endif">
                                            <span class="sr-only">Toggle Status</span>
                                            <span
                                                class="inline-block w-4 h-4 transform transition-transform bg-white rounded-full
                                        @if ($item->is_active) translate-x-6 @else translate-x-1 @endif">
                                            </span>
                                            <span class="absolute left-1 text-xs font-medium text-white"
                                                style="left: 12px; display: @if ($item->is_active) none @else block @endif">Off</span>
                                            <span class="absolute right-1 text-xs font-medium text-white"
                                                style="right: 12px; display: @if ($item->is_active) block @else none @endif">On</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button onclick="editModal({{ $item }})"
                                            class="text-blue-600 hover:text-blue-900 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button type="button"
                                            class="text-red-600 hover:text-red-900 flex items-center swal-confirm"
                                            data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Hapus
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('tahun-akademik.destroy', $item->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800" id="modal-title">Tambah Tahun Akademik</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form id="modal-form" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="POST" id="method-input">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Tahun</label>
                            <input type="text" name="tahun" id="tahun"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Semester</label>
                            <select name="semester" id="semester"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">-- Pilih Semester --</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" onclick="closeModal()"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal-form').action = "{{ route('tahun-akademik.store') }}";
            document.getElementById('method-input').value = "POST";
            document.getElementById('modal-title').innerText = "Tambah Tahun Akademik";
            document.getElementById('tahun').value = '';
            document.getElementById('semester').value = '';
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function editModal(data) {
            openModal();
            document.getElementById('modal-form').action = "/tahun-akademik/" + data.id;
            document.getElementById('method-input').value = "PUT";
            document.getElementById('modal-title').innerText = "Edit Tahun Akademik";
            document.getElementById('tahun').value = data.tahun;
            document.getElementById('semester').value = data.semester;
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@section('scripts')
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


@endsection
