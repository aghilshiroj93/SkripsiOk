<div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    NIS
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    NISN
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Siswa
                </th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($siswaTidakAktif as $data)
                <tr class="transition-colors hover:bg-gray-50/80">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $data->siswa->nis }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $data->siswa->nisn }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 mr-3">
                                <!-- Placeholder for student avatar -->
                                <div class="h-full w-full rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <iconify-icon icon="mdi:account-school" width="20"></iconify-icon>
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $data->siswa->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $data->siswa->kelas->nama ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form method="POST" action="{{ route('siswa-tidak-aktif.destroy', $data->siswa_id) }}" 
                              class="delete-form inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 transition-colors mr-3"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini dari daftar tidak aktif?')">
                                <iconify-icon icon="mdi:trash-can-outline" width="18"></iconify-icon>
                                <span class="sr-only">Hapus</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <iconify-icon icon="mdi:database-remove" width="48" class="opacity-50 mb-2"></iconify-icon>
                            <p class="text-sm font-medium">Tidak ada data siswa tidak aktif</p>
                            <p class="text-xs mt-1">Siswa yang tidak aktif akan muncul di sini</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>