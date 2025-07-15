@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Edit Profil</h2>
            </div>

            <div class="p-6">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informasi Dasar</h3>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required>
                        </div>
                    </div>

                    <!-- Password Change Section (Hidden by default) -->
                    <div x-data="{ showPasswordFields: false }" class="space-y-4">
                        <button type="button" @click="showPasswordFields = !showPasswordFields"
                            class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <span>Ganti Password</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" x-show="!showPasswordFields">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" x-show="showPasswordFields" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>

                        <div x-show="showPasswordFields" class="space-y-4 bg-gray-50 p-4 rounded-md" style="display: none;">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat
                                    Ini</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <input type="password" id="password" name="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Guru Information Section -->
                    @if ($user->role === 'guru' && isset($guru))
                        <div class="space-y-4 border-t pt-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informasi Guru</h3>

                            <div>
                                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                <input type="text" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis
                                    Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                                    <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" id="alamat" name="alamat"
                                    value="{{ old('alamat', $guru->alamat) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include AlpineJS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
