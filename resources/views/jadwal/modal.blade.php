<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Tambah Jadwal</h2>
        <form method="POST" action="{{ route('pembagian-jadwal.store') }}">
            @csrf
            <input type="hidden" name="tahun_akademik_id" value="{{ $selectedTahunAkademikId }}">

            <div class="mb-2">
                <label>Guru</label>
                <select name="guru_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Guru</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-2">
                <label>Jurusan</label>
                <select name="jurusan_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Kelas</label>
                <select name="kelas_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Mata Pelajaran</label>
                <select name="mapel_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Mapel</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Hari</label>
                <input type="text" name="hari" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Status</label>
                <select name="status" required class="w-full border rounded px-2 py-1">
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="bg-gray-500 text-white px-3 py-1 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Edit Jadwal</h2>
        <form method="POST" id="formEdit" action="">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">

            <div class="mb-2">
                <label>Guru</label>
                <select id="edit_guru_id" name="guru_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Guru</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Jurusan</label>
                <select id="edit_jurusan_id" name="jurusan_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Kelas</label>
                <select id="edit_kelas_id" name="kelas_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Mata Pelajaran</label>
                <select id="edit_mapel_id" name="mapel_id" required class="w-full border rounded px-2 py-1">
                    <option value="">Pilih Mapel</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Hari</label>
                <input type="text" id="edit_hari" name="hari" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Jam Mulai</label>
                <input type="time" id="edit_jam_mulai" name="jam_mulai" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Jam Selesai</label>
                <input type="time" id="edit_jam_selesai" name="jam_selesai" required class="w-full border rounded px-2 py-1">
            </div>

            <div class="mb-2">
                <label>Status</label>
                <select id="edit_status" name="status" required class="w-full border rounded px-2 py-1">
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="bg-gray-500 text-white px-3 py-1 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
