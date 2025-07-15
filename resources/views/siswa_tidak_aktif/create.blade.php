<div id="modal-create" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg p-6 relative">
        <h3 class="text-xl font-semibold mb-4">Tambah Siswa Tidak Aktif</h3>

        <form action="{{ route('siswa-tidak-aktif.store') }}" method="POST">
            @csrf

            @php
                $siswaTidakAktifIds = \App\Models\SiswaTidakAktif::pluck('siswa_id')->toArray();
                $siswaAktif = \App\Models\Siswa::whereNotIn('id', $siswaTidakAktifIds)->get();
            @endphp

            <div class="overflow-y-auto max-h-96 border rounded mb-4">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="p-2 text-center"><input type="checkbox" id="check-all"></th>
                            <th class="p-2">NIS</th>
                            <th class="p-2">NISN</th>
                            <th class="p-2">Nama</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($siswaAktif as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="p-2 text-center">
                                    <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" class="siswa-checkbox">
                                </td>
                                <td class="p-2">{{ $siswa->nis }}</td>
                                <td class="p-2">{{ $siswa->nisn }}</td>
                                <td class="p-2">{{ $siswa->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">Semua siswa sudah tidak aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded text-sm">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                    Simpan
                </button>
            </div>
        </form>

        <!-- Close button pojok kanan -->
        <button onclick="document.getElementById('modal-create').classList.add('hidden')" 
                class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-2xl">&times;</button>
    </div>
</div>

<script>
    // Ceklis semua siswa
    document.getElementById('check-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.siswa-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
