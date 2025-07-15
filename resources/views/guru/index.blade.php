@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    html: '<strong>{{ session('success') }}</strong>',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke Sip!'
                });
            </script>
        @elseif(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: '<strong>{{ session('error') }}</strong>',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOut'
                    },
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
        @endif



        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Data Guru</h1>
            <button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
                class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Guru</button>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full table-auto border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">NIP</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Jenis Kelamin</th>
                        <th class="px-4 py-2 border">Alamat</th>
                        <th class="px-4 py-2 border">No HP</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guru as $index => $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $item->nip }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama }}</td>
                            <td class="px-4 py-2 border">{{ $item->jenis_kelamin }}</td>
                            <td class="px-4 py-2 border">{{ $item->alamat }}</td>
                            <td class="px-4 py-2 border">{{ $item->no_hp }}</td>
                            <td class="px-4 py-2 border">{{ $item->user->email }}</td>
                            <td class="px-4 py-2 border flex gap-1">
                                <!-- Edit -->
                                <button onclick="editData({{ $item }}, '{{ $item->user->email }}')"
                                    class="bg-yellow-400 text-white px-2 py-1 rounded text-sm">Edit</button>

                                <!-- Delete -->
                                <form id="deleteForm-{{ $item->id }}" action="{{ route('guru.destroy', $item->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="tambahModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4">Tambah Guru</h2>
            <form action="{{ route('guru.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="nip" placeholder="NIP" class="border p-2 rounded" required>
                    <input type="text" name="nama" placeholder="Nama" class="border p-2 rounded" required>
                    <select name="jenis_kelamin" class="border p-2 rounded" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <input type="text" name="no_hp" placeholder="No HP" class="border p-2 rounded" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="border p-2 rounded" required>
                    <input type="email" name="email" placeholder="Email Login" class="border p-2 rounded" required>
                    <input type="password" name="password" placeholder="Password Login" class="border p-2 rounded" required>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')"
                        class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4">Edit Guru</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" id="edit_nip" name="nip" class="border p-2 rounded" required>
                    <input type="text" id="edit_nama" name="nama" class="border p-2 rounded" required>
                    <select id="edit_jenis_kelamin" name="jenis_kelamin" class="border p-2 rounded" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <input type="text" id="edit_no_hp" name="no_hp" class="border p-2 rounded" required>
                    <input type="text" id="edit_alamat" name="alamat" class="border p-2 rounded" required>
                    <input type="email" id="edit_email" name="email" class="border p-2 rounded" required>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ubah"
                        class="border p-2 rounded">
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editData(data, email) {
            document.getElementById('edit_nip').value = data.nip;
            document.getElementById('edit_nama').value = data.nama;
            document.getElementById('edit_jenis_kelamin').value = data.jenis_kelamin;
            document.getElementById('edit_alamat').value = data.alamat;
            document.getElementById('edit_no_hp').value = data.no_hp;
            document.getElementById('edit_email').value = email;
            document.getElementById('editForm').action = `/guru/${data.id}`;
            document.getElementById('editModal').classList.remove('hidden');
        }


        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }
    </script>
@endsection
