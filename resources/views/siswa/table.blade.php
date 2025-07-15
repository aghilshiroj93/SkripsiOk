<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($siswa as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nis }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nisn }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $item->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center space-x-3">
                            @php
                                $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($item->id);
                            @endphp
                            <a href="{{ route('siswa.show', $encryptedId) }}"
                                class="text-blue-500 hover:text-blue-700 transition-colors" title="Detail">
                                <iconify-icon icon="mdi:eye-outline" width="20"></iconify-icon>
                            </a>
                            <a href="{{ route('siswa.edit', $encryptedId) }}"
                                class="text-yellow-500 hover:text-yellow-700 transition-colors" title="Edit">
                                <iconify-icon icon="mdi:pencil-outline" width="20"></iconify-icon>
                            </a>
                            <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="text-red-500 hover:text-red-700 transition-colors delete-button"
                                    title="Hapus">
                                    <iconify-icon icon="mdi:trash-can-outline" width="20"></iconify-icon>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
