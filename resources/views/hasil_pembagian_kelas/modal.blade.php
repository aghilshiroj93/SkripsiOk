<!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded p-6 w-11/12 max-w-3xl">
        <h2 class="text-xl font-semibold mb-4">Detail Siswa dalam Kelas</h2>
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
                <!-- Data siswa akan di-inject lewat JS -->
            </tbody>
        </table>
        <div class="mt-4 text-right">
            <button onclick="closeModal('modalDetail')" class="bg-gray-600 text-white px-4 py-2 rounded">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded p-6 w-11/12 max-w-3xl">
        <h2 class="text-xl font-semibold mb-4">Tambah Siswa ke Kelas</h2>
        <form id="formTambahSiswa" method="POST" action="{{ route('hasil.pembagian.tambah') }}">
            @csrf
            <input type="hidden" name="kelas_id" id="kelas_id_tambah">
            <input type="hidden" name="jurusan_id" id="jurusan_id_tambah">
            <input type="hidden" name="tahun_akademik_id" id="tahun_akademik_id_tambah">

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
                    <!-- Data siswa yang belum punya kelas akan di-inject lewat JS -->
                </tbody>
            </table>

            <div class="text-right">
                <button type="button" onclick="closeModal('modalTambah')" class="bg-gray-600 text-white px-4 py-2 rounded mr-2">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
            </div>
        </form>
    </div>
</div>
