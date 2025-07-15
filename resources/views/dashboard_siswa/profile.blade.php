@extends('dashboard_siswa.layout')

@section('title', 'Profil Siswa')

@section('content')
<div class="w-full min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-6 text-white">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Profil Siswa</h1>
                    <p class="mt-1 opacity-90">Informasi lengkap profil siswa</p>
                </div>
                <button onclick="openModal()" 
                    class="mt-4 sm:mt-0 bg-white text-blue-600 hover:bg-blue-50 font-medium py-2 px-6 rounded-lg transition duration-200 shadow-sm">
                    Ubah Password
                </button>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-6">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any()))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->nama }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">NIS</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->nis }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">Alamat</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->alamat }}</p>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-4">
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->jenis_kelamin }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">Kelas</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->detail->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                        <p class="text-sm font-medium text-gray-500 mb-1">Jurusan</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $siswa->detail->jurusan->nama ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0"
             id="modalContent">
            <div class="p-6">
                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800">Ubah Password</h3>
                    <button onclick="closeModal()" 
                            class="text-gray-400 hover:text-gray-600 rounded-full p-1 transition-colors duration-200">
                        <iconify-icon icon="mdi:close" width="24"></iconify-icon>
                    </button>
                </div>
                
                <form action="{{ route('dashboard_siswa.ganti_password') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <div>
                        <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password_baru" id="password_baru" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition
                                          pr-10">
                            <button type="button" onclick="togglePassword('password_baru')"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <iconify-icon icon="mdi:eye-off" id="eyeIcon_password_baru" width="20"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label for="password_baru_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition
                                          pr-10">
                            <button type="button" onclick="togglePassword('password_baru_confirmation')"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <iconify-icon icon="mdi:eye-off" id="eyeIcon_password_baru_confirmation" width="20"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal()" 
                                class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('passwordModal');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        setTimeout(() => {
            modal.style.opacity = '1';
            content.style.transform = 'scale(1)';
            content.style.opacity = '1';
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('passwordModal');
        const content = document.getElementById('modalContent');
        
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        modal.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(`eyeIcon_${fieldId}`);
        
        if (field.type === 'password') {
            field.type = 'text';
            eyeIcon.setAttribute('icon', 'mdi:eye');
        } else {
            field.type = 'password';
            eyeIcon.setAttribute('icon', 'mdi:eye-off');
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('passwordModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

<style>
    /* Smooth transitions for all interactive elements */
    button, input, a {
        transition: all 0.2s ease;
    }
    
    /* Better focus states */
    input:focus, button:focus {
        outline: none;
        ring-width: 2px;
    }
    
    /* Card hover effects */
    .bg-gray-50:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    /* Modal backdrop blur */
    .bg-black.bg-opacity-50 {
        backdrop-filter: blur(4px);
    }
</style>
@endsection