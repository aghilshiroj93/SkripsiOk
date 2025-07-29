@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">Detail Siswa dalam Kelas</h2>

        <!-- Input Pencarian -->
        <input type="text" id="searchDetail" placeholder="Cari NIS, NISN, atau Nama..."
            class="mb-3 w-full px-3 py-2 border rounded">

        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">NIS</th>
                    <th class="border px-4 py-2">NISN</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody id="detailSiswaBody">
                @forelse ($data->whereNotNull('siswa_id') as $item)
                    <tr data-id="{{ $item->id_detail }}">
                        <td class="border px-4 py-2">{{ $item->siswa?->nis ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $item->siswa?->nisn ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $item->siswa?->nama ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center">
                            <button onclick="hapusSiswa({{ $item->id_detail }})"
                                class="bg-red-500 text-white px-2 py-1 rounded">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-2">Tidak ada siswa</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <!-- Kembali -->
        <div class="mt-6">
            <a href="{{ route('hasil.pembagian.index', ['tahun_akademik_id' => $tahun_akademik_id]) }}"
                class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </div>

    <script>
        // Fitur pencarian
        document.getElementById('searchDetail').addEventListener('input', function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('#detailSiswaBody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });

        // Hapus siswa via AJAX
        function hapusSiswa(id_detail) {
            if (confirm('Yakin ingin menghapus siswa ini?')) {
                fetch(`/hasil-pembagian/hapus-detail/${id_detail}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal menghapus');
                        // Hapus baris tabel
                        document.querySelector(`tr[data-id='${id_detail}']`).remove();
                    })
                    .catch(error => {
                        alert(error.message);
                    });
            }
        }
    </script>
@endsection

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
