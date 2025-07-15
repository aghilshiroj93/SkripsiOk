@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Manajemen Jadwal</h1>
            <button onclick="openModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Jadwal
            </button>
        </div>

        <!-- Alert Messages -->
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
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mapel
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jurusan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($jadwalList as $jadwal)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $jadwal->guru->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $jadwal->mataPelajaran->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $jadwal->tahunAkademik->tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $jadwal->jurusan->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $jadwal->kelas->nama_kelas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $jadwal->hari }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $jadwal->jam_mulai }}
                                        - {{ $jadwal->jam_selesai }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $jadwal->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($jadwal->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button
                                            onclick="openEditModal({{ $jadwal->id }}, '{{ $jadwal->guru_id }}', '{{ $jadwal->mata_pelajaran_id }}', '{{ $jadwal->tahun_akademik_id }}', '{{ $jadwal->jurusan_id }}', '{{ $jadwal->kelas_id }}', '{{ $jadwal->hari }}', '{{ $jadwal->jam_mulai }}', '{{ $jadwal->jam_selesai }}', '{{ $jadwal->status }}')"
                                            class="text-yellow-600 hover:text-yellow-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $jadwal->id }})"
                                                class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p class="mt-2 text-gray-600">Belum ada jadwal</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Schedule Modal -->
    <!-- Add Schedule Modal -->
    <div id="modalTambahJadwal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 overflow-y-auto">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <!-- Modal Header (Sticky) -->
            <div class="sticky top-0 bg-white z-10 flex justify-between items-center border-b px-6 py-4 shadow-sm">
                <h2 class="text-lg font-bold text-gray-800">Tambah Jadwal</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content (Scrollable) -->
            <form action="{{ route('jadwal.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                        <select name="guru_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Pilih Guru</option>
                            @foreach ($guruList as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Akademik</label>
                        <select id="tahunAkademik" name="tahun_akademik_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach ($tahunAkademikList as $ta)
                                <option value="{{ $ta->id }}">{{ $ta->tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select id="jurusan" name="jurusan_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required disabled></select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select id="kelas" name="kelas_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required disabled></select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                        <select name="hari"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                            <input type="time" name="jam_mulai"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                            <input type="time" name="jam_selesai"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer (Sticky) -->
                <div class="sticky bottom-0 bg-white pt-4 pb-2 flex justify-end space-x-3 border-t mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Schedule Modal -->
    <div id="modalEditJadwal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 overflow-y-auto">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <!-- Modal Header (Sticky) -->
            <div class="sticky top-0 bg-white z-10 flex justify-between items-center border-b px-6 py-4 shadow-sm">
                <h2 class="text-lg font-bold text-gray-800">Edit Jadwal</h2>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content (Scrollable) -->
            <form id="formEditJadwal" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                        <select name="guru_id" id="edit_guru_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($guruList as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" id="edit_mata_pelajaran_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Akademik</label>
                        <select name="tahun_akademik_id" id="edit_tahun_akademik_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($tahunAkademikList as $ta)
                                <option value="{{ $ta->id }}">{{ $ta->tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select name="jurusan_id" id="edit_jurusan_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select name="kelas_id" id="edit_kelas_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                        <select name="hari" id="edit_hari"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="edit_jam_mulai"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="edit_jam_selesai"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="edit_status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer (Sticky) -->
                <div class="sticky bottom-0 bg-white pt-4 pb-2 flex justify-end space-x-3 border-t mt-6">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Custom scrollbar for modal */
        #modalTambahJadwal ::-webkit-scrollbar,
        #modalEditJadwal ::-webkit-scrollbar {
            width: 6px;
        }

        #modalTambahJadwal ::-webkit-scrollbar-track,
        #modalEditJadwal ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 0 0 8px 8px;
        }

        #modalTambahJadwal ::-webkit-scrollbar-thumb,
        #modalEditJadwal ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #modalTambahJadwal ::-webkit-scrollbar-thumb:hover,
        #modalEditJadwal ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Modal Tambah
        function openModal() {
            document.getElementById('modalTambahJadwal').classList.remove('hidden');
            document.getElementById('modalTambahJadwal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalTambahJadwal').classList.add('hidden');
            document.getElementById('modalTambahJadwal').classList.remove('flex');
        }

        // Dinamis Jurusan dan Kelas - Tambah
        document.getElementById('tahunAkademik').addEventListener('change', function() {
            let tahunId = this.value;
            let jurusan = document.getElementById('jurusan');
            let kelas = document.getElementById('kelas');
            jurusan.innerHTML = '';
            kelas.innerHTML = '';
            jurusan.disabled = true;
            kelas.disabled = true;

            if (tahunId) {
                fetch(`/jadwal/get-jurusan/${tahunId}`)
                    .then(res => res.json())
                    .then(data => {
                        jurusan.disabled = false;
                        jurusan.innerHTML = '<option value="">Pilih Jurusan</option>';
                        for (const [id, nama] of Object.entries(data)) {
                            jurusan.innerHTML += `<option value="${id}">${nama}</option>`;
                        }
                    });
            }
        });

        document.getElementById('jurusan').addEventListener('change', function() {
            let tahunId = document.getElementById('tahunAkademik').value;
            let jurusanId = this.value;
            let kelas = document.getElementById('kelas');
            kelas.innerHTML = '';
            kelas.disabled = true;

            if (jurusanId) {
                fetch(`/jadwal/get-kelas/${tahunId}/${jurusanId}`)
                    .then(res => res.json())
                    .then(data => {
                        kelas.disabled = false;
                        kelas.innerHTML = '<option value="">Pilih Kelas</option>';
                        for (const [id, nama] of Object.entries(data)) {
                            kelas.innerHTML += `<option value="${id}">${nama}</option>`;
                        }
                    });
            }
        });

        // Modal Edit
        function openEditModal(id, guru_id, mapel_id, ta_id, jurusan_id, kelas_id, hari, jam_mulai, jam_selesai, status) {
            const modal = document.getElementById('modalEditJadwal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('formEditJadwal').action = `/jadwal/${id}`;
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_guru_id').value = guru_id;
            document.getElementById('edit_mata_pelajaran_id').value = mapel_id;
            document.getElementById('edit_tahun_akademik_id').value = ta_id;
            document.getElementById('edit_hari').value = hari;
            document.getElementById('edit_jam_mulai').value = jam_mulai;
            document.getElementById('edit_jam_selesai').value = jam_selesai;
            document.getElementById('edit_status').value = status;

            // Fetch jurusan & kelas
            fetch(`/jadwal/get-jurusan/${ta_id}`)
                .then(res => res.json())
                .then(data => {
                    let jurusan = document.getElementById('edit_jurusan_id');
                    jurusan.innerHTML = '<option value="">Pilih Jurusan</option>';
                    for (const [id, nama] of Object.entries(data)) {
                        jurusan.innerHTML += `<option value="${id}">${nama}</option>`;
                    }
                    jurusan.value = jurusan_id;
                })
                .then(() => {
                    fetch(`/jadwal/get-kelas/${ta_id}/${jurusan_id}`)
                        .then(res => res.json())
                        .then(data => {
                            let kelas = document.getElementById('edit_kelas_id');
                            kelas.innerHTML = '<option value="">Pilih Kelas</option>';
                            for (const [id, nama] of Object.entries(data)) {
                                kelas.innerHTML += `<option value="${id}">${nama}</option>`;
                            }
                            kelas.value = kelas_id;
                        });
                });
        }

        function closeEditModal() {
            const modal = document.getElementById('modalEditJadwal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data jadwal akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/jadwal/${id}`;
                    form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Flash Message via SweetAlert
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection
