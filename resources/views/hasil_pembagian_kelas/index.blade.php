@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Hasil Pembagian Kelas</h1>

        <!-- Pilih Tahun Akademik -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Pilih Tahun Akademik</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($tahunAkademik as $ta)
                    <a href="{{ route('hasil.pembagian.index', ['tahun_akademik_id' => $ta->id]) }}"
                        class="block p-4 rounded-lg shadow-md border transition 
                    {{ $selectedTahunAkademikId == $ta->id ? 'bg-blue-100 border-blue-500' : 'bg-white hover:bg-gray-50' }}">

                        <!-- Ikon lingkaran -->
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 3a1 1 0 000 2h12a1 1 0 100-2H4zM3 7a1 1 0 011-1h12a1 1 0 011 1v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm3 2a1 1 0 100 2h8a1 1 0 100-2H6z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Tahun dan Semester -->
                        <div class="text-center text-lg font-semibold text-gray-800 mb-1">
                            {{ $ta->tahun }}
                        </div>
                        <div class="text-center text-sm text-gray-500 mb-1">
                            Semester {{ ucfirst($ta->semester) }}
                        </div>

                        <!-- Keterangan jumlah siswa/dosen jika ada -->
                        {{-- @if (!empty($ta->jumlah_dosen))
                            <div class="text-center text-sm text-green-600 font-medium">
                                {{ $ta->jumlah_dosen }} Dosen
                            </div>
                        @endif --}}
                    </a>
                @endforeach
            </div>
        </div>


        @if ($selectedTahunAkademikId)
            <!-- Tabel Hasil Pembagian Kelas -->
            <div id="tabel_pembagian" class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Jurusan</th>
                            <th class="border px-4 py-2">Kelas</th>
                            <th class="border px-4 py-2">Jumlah Siswa</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTabelPembagian">
                        @foreach ($dataPembagianGrouped as $groupKey => $details)
                            @php
                                $firstDetail = $details->first();
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">{{ $firstDetail->jurusan->nama ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $firstDetail->kelas->nama_kelas ?? '-' }}</td>
                                <td class="border px-4 py-2 text-center">
                                    {{ $details->whereNotNull('siswa_id')->count() }}
                                </td>
                                <td class="border px-4 py-2 text-center space-x-2 whitespace-nowrap">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition-colors"
                                        onclick="openModalDetail({{ $firstDetail->kelas_id }}, {{ $firstDetail->jurusan_id }}, {{ $firstDetail->tahun_akademik_id }})">
                                        Detail
                                    </button>

                                    <button
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded transition-colors"
                                        onclick="openModalTambah({{ $firstDetail->kelas_id }}, {{ $firstDetail->jurusan_id }}, {{ $firstDetail->tahun_akademik_id }})">
                                        Tambah Data
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-600 mt-8">
                <p>Silakan pilih tahun akademik untuk melihat data pembagian kelas.</p>
            </div>
        @endif
    </div>

    @include('hasil_pembagian_kelas.modal')
@endsection

@section('scripts')
    <script>
        function openModalDetail(kelasId, jurusanId, tahunAkademikId) {
            // Tampilkan modal
            document.getElementById('modalDetail').classList.remove('hidden');

            // Load data detail siswa via AJAX
            fetch(
                    `/hasil-pembagian/get-detail?kelas_id=${kelasId}&jurusan_id=${jurusanId}&tahun_akademik_id=${tahunAkademikId}`
                )
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('detailSiswaBody');
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="4" class="text-center py-2">Tidak ada siswa</td></tr>`;
                        return;
                    }
                    data.forEach(item => {
                        tbody.innerHTML += `
                        <tr>
                            <td class="border px-4 py-2">${item.siswa.nis}</td>
                            <td class="border px-4 py-2">${item.siswa.nisn}</td>
                            <td class="border px-4 py-2">${item.siswa.nama}</td>
                            <td class="border px-4 py-2 text-center">
                                <button onclick="hapusSiswa(${item.id_detail})" class="bg-red-500 text-white px-2 rounded">Hapus</button>
                            </td>
                        </tr>`;
                    });
                })
                .catch(err => {
                    console.error('Error loading detail:', err);
                });
        }

        function openModalTambah(kelasId, jurusanId, tahunAkademikId) {
            document.getElementById('kelas_id_tambah').value = kelasId;
            document.getElementById('jurusan_id_tambah').value = jurusanId;
            document.getElementById('tahun_akademik_id_tambah').value = tahunAkademikId;

            fetch(`/hasil-pembagian/get-siswa-tanpa-kelas?tahun_akademik_id=${tahunAkademikId}`)
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('tambahSiswaBody');
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML =
                            '<tr><td colspan="4" class="text-center py-2">Tidak ada siswa yang tersedia</td></tr>';
                        return;
                    }
                    data.forEach(siswa => {
                        tbody.innerHTML += `
                        <tr>
                            <td class="border px-2 text-center">
                                <input type="checkbox" name="siswa_ids[]" value="${siswa.id}">
                            </td>
                            <td class="border px-2">${siswa.nis}</td>
                            <td class="border px-2">${siswa.nisn}</td>
                            <td class="border px-2">${siswa.nama}</td>
                        </tr>`;
                    });
                })
                .catch(err => {
                    console.error('Error loading siswa tanpa kelas:', err);
                });

            document.getElementById('modalTambah').classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function hapusSiswa(id_detail) {
            if (confirm('Apakah Anda yakin ingin menghapus siswa ini dari kelas?')) {
                fetch(`/hasil-pembagian/hapus-detail/${id_detail}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal menghapus data');
                        return res.json();
                    })
                    .then(response => {
                        if (response.success) {
                            alert('Siswa berhasil dihapus');
                            location.reload();
                        } else {
                            alert('Gagal menghapus siswa');
                        }
                    })
                    .catch(error => {
                        alert(error.message);
                    });
            }
        }
    </script>
@endsection
