@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Siswa</h1>
            <a href="{{ route('siswa.create') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                <iconify-icon icon="mdi:account-plus" width="18"></iconify-icon>
                <span>Tambah Siswa</span>
            </a>
        </div>

        {{-- Form Pencarian --}}
        <div class="flex justify-end mb-4">
            <form id="searchForm" method="GET" class="flex gap-2">
                <input type="text" id="searchInput" name="search" placeholder="Cari siswa..."
                    class="border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                {{-- <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                    Cari
                </button> --}}
            </form>
        </div>

        {{-- Tabel Data --}}
        <div id="siswaTable">
            @include('siswa.table', ['siswa' => $siswa])
        </div>

        {{-- Pagination --}}
        <div id="paginationContainer">
            {!! $siswa->links('pagination::tailwind') !!}
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loadingIndicator" style="display: none;">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 border-solid"></div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- AJAX Pencarian dan Pagination --}}
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                fetchSiswaData(1);
            });

            $(document).on('click', '#paginationContainer a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = url.split('page=')[1];
                fetchSiswaData(page);
            });

            function fetchSiswaData(page) {
                const search = $('#searchInput').val();

                $.ajax({
                    url: '{{ route('siswa.index') }}',
                    type: 'GET',
                    data: {
                        search: search,
                        page: page
                    },
                    beforeSend: function() {
                        $('#loadingIndicator').show();
                    },
                    success: function(response) {
                        $('#siswaTable').html(response.table);
                        $('#paginationContainer').html(response.pagination);

                        // Update URL tanpa reload
                        const newUrl = new URL(window.location.href);
                        newUrl.searchParams.set('search', search);
                        newUrl.searchParams.set('page', page);
                        window.history.pushState({}, '', newUrl);
                    },
                    complete: function() {
                        $('#loadingIndicator').hide();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memuat data.',
                        });
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                fetchSiswaData(1);
            });

            $(document).on('click', '#paginationContainer a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = url.split('page=')[1];
                fetchSiswaData(page);
            });

            // Tambahkan ini untuk pencarian otomatis saat mengetik
            let typingTimer;
            const delay = 200;
            $('#searchInput').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    fetchSiswaData(1);
                }, delay);
            });

            function fetchSiswaData(page) {
                const search = $('#searchInput').val();

                $.ajax({
                    url: '{{ route('siswa.index') }}',
                    type: 'GET',
                    data: {
                        search: search,
                        page: page
                    },
                    beforeSend: function() {
                        $('#loadingIndicator').show();
                    },
                    success: function(response) {
                        $('#siswaTable').html(response.table);
                        $('#paginationContainer').html(response.pagination);

                        const newUrl = new URL(window.location.href);
                        newUrl.searchParams.set('search', search);
                        newUrl.searchParams.set('page', page);
                        window.history.pushState({}, '', newUrl);
                    },
                    complete: function() {
                        $('#loadingIndicator').hide();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memuat data.',
                        });
                    }
                });
            }
        });
    </script>


    {{-- SweetAlert untuk Notifikasi Sukses --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    {{-- SweetAlert untuk Notifikasi Gagal (opsional) --}}
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            });
        </script>
    @endif
    {{-- SweetAlert2 untuk Konfirmasi Hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
