<li class="relative">
    <!-- Data Master Dropdown -->
    <details class="group" @if ($isDataMasterActive) open @endif>
        <summary
            class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 cursor-pointer transition-all duration-200 @if ($isDataMasterActive && !Request::is('mata_pelajaran*') && !Request::is('guru*')) bg-purple-50 text-purple-600 active-menu @endif">
            <div class="flex items-center gap-3">
                <div
                    class="bg-purple-100 text-purple-600 p-2 rounded-lg group-hover:bg-purple-200 transition-colors duration-200 @if ($isDataMasterActive && !Request::is('mata_pelajaran*') && !Request::is('guru*')) bg-purple-200 @endif">
                    <iconify-icon icon="mdi:database" width="20"></iconify-icon>
                </div>
                <span>Data Master</span>
            </div>
            <iconify-icon icon="mdi:chevron-down" class="group-open:rotate-180 transition-transform duration-200"
                width="18"></iconify-icon>
        </summary>
        <ul class="ml-12 mt-1 space-y-1 animate-fadeIn">
            <li>
                <a href="{{ url('/siswa') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('siswa*')) bg-blue-50 text-blue-600 @endif">
                    <iconify-icon icon="mdi:account-school" width="18" class="text-blue-500"></iconify-icon>
                    <span>Data Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/kelas-jurusan') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-green-50 hover:text-green-600 text-gray-700 transition-all duration-200 @if (Request::is('kelas-jurusan*')) bg-green-50 text-green-600 @endif">
                    <iconify-icon icon="mdi:google-classroom" width="18" class="text-green-500"></iconify-icon>
                    <span>Data Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/user') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 transition-all duration-200 @if (Request::is('user*')) bg-purple-50 text-purple-600 @endif">
                    <iconify-icon icon="mdi:account-group" width="18" class="text-purple-500"></iconify-icon>
                    <span>Data User</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('siswa-tidak-aktif*')) bg-red-50 text-red-600 @endif">
                    <iconify-icon icon="mdi:account-remove" width="18" class="text-red-500"></iconify-icon>
                    <span>Siswa Tidak Aktif</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pembagian.kelas.index') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('pembagian-kelas*')) bg-red-50 text-red-600 @endif">
                    <iconify-icon icon="mdi:account-group" width="18" class="text-red-500"></iconify-icon>
                    <span>Pembagian Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('hasil.pembagian.index') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('hasil-pembagian*')) bg-red-50 text-red-600 @endif">
                    <iconify-icon icon="mdi:clipboard-check-outline" width="18" class="text-red-500"></iconify-icon>
                    <span>Hasil Pembagian Kls</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tahun-akademik.index') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('tahun-akademik*')) bg-red-50 text-red-600 @endif">
                    <iconify-icon icon="material-symbols:school-outline" width="18"
                        class="text-red-500"></iconify-icon>
                    <span>Tahun Akademik</span>
                </a>
            </li>
        </ul>
    </details>

    <!-- Setting Dropdown -->
    <details class="group" @if (Request::is('mata_pelajaran*') || Request::is('guru*')) open @endif>
        <summary
            class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 cursor-pointer transition-all duration-200 @if (Request::is('mata_pelajaran*') || Request::is('guru*')) bg-purple-50 text-purple-600 active-menu @endif">
            <div class="flex items-center gap-3">
                <div
                    class="bg-purple-100 text-purple-600 p-2 rounded-lg group-hover:bg-purple-200 transition-colors duration-200 @if (Request::is('mata_pelajaran*') || Request::is('guru*')) bg-purple-200 @endif">
                    <iconify-icon icon="fluent:settings-20-regular" width="20"></iconify-icon>
                </div>
                <span>Setting</span>
            </div>
            <iconify-icon icon="mdi:chevron-down" class="group-open:rotate-180 transition-transform duration-200"
                width="18"></iconify-icon>
        </summary>
        <ul class="ml-12 mt-1 space-y-1 animate-fadeIn">
            <li>
                <a href="{{ route('mata_pelajaran.index') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('mata_pelajaran*')) bg-blue-50 text-blue-600 @endif">
                    <iconify-icon icon="fluent:book-20-filled" width="18" class="text-blue-500"></iconify-icon>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/guru') }}"
                    class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('guru*')) bg-blue-50 text-blue-600 @endif">
                    <iconify-icon icon="mdi:account-tie" width="18" class="text-blue-500"></iconify-icon>
                    <span>Data Guru</span>
                </a>
            </li>
        </ul>
    </details>
</li>
