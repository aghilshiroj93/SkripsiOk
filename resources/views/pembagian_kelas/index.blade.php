@extends('layouts.app')
@section('title', 'Pembagian Kelas')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Pilih Tahun Akademik</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-xl">
            @foreach ($tahunAkademik as $tahun)
                <button onclick="selectTahun({{ $tahun->id }})"
                    class="w-full bg-white rounded-lg shadow hover:shadow-md transition p-4 text-center border border-gray-200 hover:bg-blue-50">

                    <!-- Icon -->
                    <div class="flex justify-center mb-2">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 3a1 1 0 000 2h12a1 1 0 100-2H4zM3 7a1 1 0 011-1h12a1 1 0 011 1v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm3 2a1 1 0 100 2h8a1 1 0 100-2H6z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Tahun Akademik -->
                    <div class="text-lg font-semibold text-gray-800">
                        {{ $tahun->tahun }}
                    </div>

                    {{-- <!-- Keterangan -->
                    <div class="text-sm text-gray-500">Hasil Ploting</div>
                    <div class="text-sm text-green-600 font-medium">
                        {{ $tahun->jumlah_dosen ?? '0' }} Dosen
                    </div> --}}
                </button>
            @endforeach
        </div>

    </div>

    @if ($dataPembagian->count())
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-2">Data Pembagian Kelas</h2>
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Jurusan</th>
                        <th class="p-2 border">Kelas</th>
                        <th class="p-2 border">Tahun</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPembagian as $detail)
                        <tr>
                            <td class="p-2 border">{{ $detail->nama ?? '-' }}</td>
                            <td class="p-2 border">{{ $detail->nama_kelas ?? '-' }}</td>

                            <td class="p-2 border">{{ $detail->tahun ?? '-' }}</td>
                            <td class="p-2 border">
                                <form action="{{ route('pembagian.kelas.destroy', $detail->id_detail) }}" method="POST"
                                    onsubmit="return confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Modal Jurusan --}}
    <div id="modal-jurusan" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-4 rounded w-full max-w-md">
            <h2 class="text-lg font-semibold mb-3">Pilih Jurusan</h2>
            <div id="jurusan-list" class="space-y-2"></div>
            <button onclick="closeModal('modal-jurusan')" class="text-blue-600 mt-4">Kembali</button>
        </div>
    </div>

    {{-- Modal Kelas --}}
    <div id="modal-kelas" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-4 rounded w-full max-w-md">
            <h2 class="text-lg font-semibold mb-3">Pilih Kelas</h2>
            <div id="kelas-list" class="space-y-2"></div>
            <button onclick="backToJurusan()" class="text-blue-600 mt-4">Kembali</button>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let selectedTahun = null;
        let selectedJurusan = null;

        function selectTahun(tahunId) {
            selectedTahun = tahunId;
            fetchJurusan();
        }

        function fetchJurusan() {
            fetch("{{ route('pembagian.kelas.get.jurusan') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('jurusan-list');
                    container.innerHTML = '';
                    data.forEach(j => {
                        const btn = document.createElement('button');
                        btn.textContent = j.nama;
                        btn.className = 'w-full p-2 bg-white border rounded hover:bg-blue-50';
                        btn.onclick = () => selectJurusan(j.id);
                        container.appendChild(btn);
                    });
                    document.getElementById('modal-jurusan').classList.remove('hidden');
                });
        }

        function selectJurusan(jurusanId) {
            selectedJurusan = jurusanId;
            document.getElementById('modal-jurusan').classList.add('hidden');
            fetchKelas();
        }

        function fetchKelas() {
            fetch("{{ route('pembagian.kelas.get.kelas') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('kelas-list');
                    container.innerHTML = '';
                    data.forEach(k => {
                        const btn = document.createElement('button');
                        btn.textContent = k.nama_kelas;
                        btn.className = 'w-full p-2 bg-white border rounded hover:bg-green-50';
                        btn.onclick = () => {
                            Swal.fire({
                                title: 'Simpan pembagian kelas ini?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, Simpan',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    savePembagianKelas(k.id);
                                }
                            });
                        };
                        container.appendChild(btn);
                    });
                    document.getElementById('modal-kelas').classList.remove('hidden');
                });
        }

        function savePembagianKelas(kelasId) {
            fetch("{{ route('pembagian.kelas.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        tahun_akademik_id: selectedTahun,
                        jurusan_id: selectedJurusan,
                        kelas_id: kelasId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pembagian kelas berhasil disimpan!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function backToJurusan() {
            document.getElementById('modal-kelas').classList.add('hidden');
            document.getElementById('modal-jurusan').classList.remove('hidden');
        }

        // SweetAlert untuk konfirmasi hapus di form
        document.querySelectorAll('form[onsubmit^="return confirm"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    {{-- SweetAlert on page load for session success --}}
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

@endsection
