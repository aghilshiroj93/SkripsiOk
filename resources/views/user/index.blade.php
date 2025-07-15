@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Manajemen User</h2>
        <button onclick="openModal('tambahUserModal')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah User
        </button>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">Email</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">Role</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <button onclick="openModal('editUserModal{{ $user->id }}')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</button>

                            <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $user->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div id="editUserModal{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-lg p-6 w-full max-w-md">
                            <h3 class="text-lg font-semibold mb-4">Edit User</h3>
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label class="block text-sm">Nama</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="w-full border rounded px-3 py-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}"
                                        class="w-full border rounded px-3 py-2" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm">Role</label>
                                    <select name="role" class="w-full border rounded px-3 py-2">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="bk" {{ $user->role === 'bk' ? 'selected' : '' }}>BK</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm">Password (kosongkan jika tidak diubah)</label>
                                    <input type="password" name="password" class="w-full border rounded px-3 py-2">
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="closeModal('editUserModal{{ $user->id }}')"
                                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah --}}
    <div id="tambahUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Tambah User Baru</h3>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm">Nama</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Role</label>
                    <select name="role" class="w-full border rounded px-3 py-2" required>
                        <option value="admin">Admin</option>
                        <option value="bk">BK</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('tambahUserModal')"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Modal Handler Script --}}
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data user akan hilang permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    @endif
</script>
@endsection
