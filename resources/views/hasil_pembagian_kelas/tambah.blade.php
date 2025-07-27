@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">Tambah Siswa ke Kelas</h2>

        <form id="tambahForm" action="{{ route('hasil.pembagian.simpan') }}" method="POST">

            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
            <input type="hidden" name="jurusan_id" value="{{ $jurusan_id }}">
            <input type="hidden" name="tahun_akademik_id" value="{{ $tahun_akademik_id }}">

            <!-- Input Pencarian -->
            <input type="text" id="searchTambah" placeholder="Cari NIS, NISN, atau Nama..."
                class="mb-3 w-full px-3 py-2 border rounded">

            <table class="min-w-full border border-gray-300 mb-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1 text-center">Pilih</th>
                        <th class="border px-2 py-1">NIS</th>
                        <th class="border px-2 py-1">NISN</th>
                        <th class="border px-2 py-1">Nama</th>
                    </tr>
                </thead>
                <tbody id="tambahSiswaBody">
                    @forelse ($siswaTanpaKelas as $siswa)
                        <tr>
                            <td class="border px-2 py-1 text-center">
                                <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}">
                            </td>
                            <td class="border px-2 py-1">{{ $siswa->nis }}</td>
                            <td class="border px-2 py-1">{{ $siswa->nisn }}</td>
                            <td class="border px-2 py-1">{{ $siswa->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-2">Tidak ada siswa tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $siswaTanpaKelas->withQueryString()->links() }}
            </div>

            <div class="flex justify-between">
                <a href="{{ route('hasil.pembagian.index', ['tahun_akademik_id' => $tahun_akademik_id]) }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('searchTambah').addEventListener('input', function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('#tambahSiswaBody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
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

@section('scripts')
    <script>
        document.addEventListener('click', function(e) {
            const link = e.target.closest('#paginationLinks a');
            if (link) {
                e.preventDefault();

                fetch(link.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        // Ambil bagian siswaContainer dari HTML baru
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContainer = doc.querySelector('#siswaContainer');

                        // Replace siswaContainer lama
                        document.querySelector('#siswaContainer').innerHTML = newContainer.innerHTML;
                    });
            }
        });
    </script>
@endsection
