@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Siswa Tidak Aktif</h1>
                <p class="text-gray-600 mt-1">Manajemen data siswa tidak aktif</p>
            </div>
            <button onclick="showCreateModal()"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg transition-all duration-300 shadow hover:shadow-md">
                <iconify-icon icon="mdi:account-plus" width="18"></iconify-icon>
                <span class="font-medium">Tambah Siswa</span>
            </button>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <form id="searchForm" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <iconify-icon icon="mdi:magnify" class="text-gray-400"></iconify-icon>
                        </div>
                        <input type="text" name="search" id="searchInput" placeholder="Nama/NIS/kelas..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="h-[42px] bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-300 flex items-center gap-2">
                        <iconify-icon icon="mdi:magnify" width="18"></iconify-icon>
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="hidden p-8 flex justify-center">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
            </div>
            
            <!-- Table Content -->
            <div id="siswaTable" class="overflow-x-auto">
                @include('siswa_tidak_aktif.partials.table', ['siswaTidakAktif' => $siswaTidakAktif])
            </div>
        </div>

        <!-- Pagination -->
        <div id="paginationContainer" class="flex justify-center">
            {!! $siswaTidakAktif->links('pagination::tailwind') !!}
        </div>
    </div>

    <!-- Create Modal -->
    @include('siswa_tidak_aktif.create')

    <!-- Success Notification -->
    <div id="successNotification" class="fixed bottom-4 right-4 hidden">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3">
            <iconify-icon icon="mdi:check-circle" width="24"></iconify-icon>
            <span id="successMessage">Operasi berhasil dilakukan!</span>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function showCreateModal() {
        document.getElementById('modal-create').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function hideCreateModal() {
        document.getElementById('modal-create').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function showSuccessMessage(message) {
        const notification = document.getElementById('successNotification');
        document.getElementById('successMessage').textContent = message || 'Operasi berhasil dilakukan!';
        notification.classList.remove('hidden');
        
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 3000);
    }

    $(document).ready(function() {
        // Handle search form submission
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            fetchData(1);
        });

        // Handle pagination clicks
        $(document).on('click', '#paginationContainer a', function(e) {
            e.preventDefault();
            const page = $(this).attr('href').split('page=')[1];
            fetchData(page);
        });

        // Fetch data with AJAX
        function fetchData(page) {
            const search = $('#searchInput').val();

            $.ajax({
                url: "{{ route('siswa-tidak-aktif.index') }}",
                data: { 
                    search: search, 
                    page: page 
                },
                beforeSend: function() {
                    $('#loadingIndicator').removeClass('hidden');
                    $('#siswaTable').addClass('opacity-50');
                },
                success: function(response) {
                    $('#siswaTable').html(response.table);
                    $('#paginationContainer').html(response.pagination);
                    
                    if(response.message) {
                        showSuccessMessage(response.message);
                    }
                },
                complete: function() {
                    $('#loadingIndicator').addClass('hidden');
                    $('#siswaTable').removeClass('opacity-50');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('modal-create');
            if (event.target == modal) {
                hideCreateModal();
            }
        }
    });
</script>
@endsection