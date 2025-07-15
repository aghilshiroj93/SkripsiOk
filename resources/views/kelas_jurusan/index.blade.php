@extends('layouts.app')

@section('title', 'Manajemen Kelas & Jurusan')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- KELAS --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Kelas</h2>
                <button onclick="openKelasModal()"
                    class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-sm">
                    <iconify-icon icon="mdi:plus" width="16"></iconify-icon> Tambah Kelas
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelas</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kelas as $i => $k)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ $k->nama_kelas }}</td>
                                <td class="px-4 py-3 text-sm space-x-2">
                                    <button onclick="editKelas({{ $k->id }}, '{{ $k->nama_kelas }}')"
                                        class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                        <iconify-icon icon="mdi:pencil" width="14"></iconify-icon> Edit
                                    </button>
                                    <form action="{{ route('kelas.destroy', $k->id) }}" method="POST"
                                        class="inline form-hapus-kelas">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 flex items-center gap-1 btn-hapus-kelas">
                                            <iconify-icon icon="mdi:trash-can-outline" width="14"></iconify-icon> Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- JURUSAN --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Jurusan</h2>
                <button onclick="openJurusanModal()"
                    class="flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-sm">
                    <iconify-icon icon="mdi:plus" width="16"></iconify-icon> Tambah Jurusan
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Jurusan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jurusan as $i => $j)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ $j->nama }}</td>
                                <td class="px-4 py-3 text-sm space-x-2">
                                    <button onclick="editJurusan({{ $j->id }}, '{{ $j->nama }}')"
                                        class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                        <iconify-icon icon="mdi:pencil" width="14"></iconify-icon> Edit
                                    </button>
                                    <form action="{{ route('jurusan.destroy', $j->id) }}" method="POST"
                                        class="inline form-hapus-jurusan">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 flex items-center gap-1 btn-hapus-jurusan">
                                            <iconify-icon icon="mdi:trash-can-outline" width="14"></iconify-icon> Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Kelas --}}
    <div id="kelasModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Form Kelas</h3>
            <form id="kelasForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="kelasMethod" value="POST">
                <input type="text" name="nama_kelas" id="kelasNama" placeholder="Contoh: XII IPA 2"
                    class="w-full border px-3 py-2 rounded mb-4" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('kelasModal')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Jurusan --}}
    <div id="jurusanModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Form Jurusan</h3>
            <form id="jurusanForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="jurusanMethod" value="POST">
                <input type="text" name="nama" id="jurusanNama" placeholder="Contoh: IPS"
                    class="w-full border px-3 py-2 rounded mb-4" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('jurusanModal')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS --}}
    <script>
        function openKelasModal() {
            document.getElementById('kelasModal').classList.remove('hidden');
            document.getElementById('kelasForm').action = '{{ route('kelas.store') }}';
            document.getElementById('kelasMethod').value = 'POST';
            document.getElementById('kelasNama').value = '';
        }

        function editKelas(id, nama) {
            document.getElementById('kelasModal').classList.remove('hidden');
            document.getElementById('kelasForm').action = `/kelas/${id}`;
            document.getElementById('kelasMethod').value = 'PUT';
            document.getElementById('kelasNama').value = nama;
        }

        function openJurusanModal() {
            document.getElementById('jurusanModal').classList.remove('hidden');
            document.getElementById('jurusanForm').action = '{{ route('jurusan.store') }}';
            document.getElementById('jurusanMethod').value = 'POST';
            document.getElementById('jurusanNama').value = '';
        }

        function editJurusan(id, nama) {
            document.getElementById('jurusanModal').classList.remove('hidden');
            document.getElementById('jurusanForm').action = `/jurusan/${id}`;
            document.getElementById('jurusanMethod').value = 'PUT';
            document.getElementById('jurusanNama').value = nama;
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Notifikasi dari session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // Handle konfirmasi hapus kelas
        document.querySelectorAll('form[action^="{{ route('kelas.destroy', '') }}"]').forEach(form => {
            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus kelas ini?',
                        text: "Tindakan ini tidak dapat dibatalkan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });

        // Handle konfirmasi hapus jurusan
        document.querySelectorAll('form[action^="{{ route('jurusan.destroy', '') }}"]').forEach(form => {
            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus jurusan ini?',
                        text: "Tindakan ini tidak dapat dibatalkan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>

@endsection
