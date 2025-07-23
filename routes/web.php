<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HasilPembagianKelasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\PembagianKelasController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaTidakAktifController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\UsersController; // Unused, so commented out

// === Public Routes ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:siswa')->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard_siswa.index');
    Route::get('/mapel', [SiswaDashboardController::class, 'mataPelajaran'])->name('dashboard_siswa.mapel');
    // Route::get('/profile', [SiswaDashboardController::class, 'profile'])->name('dashboard_siswa.profile');
    Route::post('/update-password', [SiswaDashboardController::class, 'updatePassword'])->name('dashboard_siswa.updatePassword');
    Route::post('/siswa/ganti-password', [SiswaDashboardController::class, 'changePassword'])->name('dashboard_siswa.ganti_password');
    Route::get('/siswa/profile', [SiswaDashboardController::class, 'profile'])->name('dashboard_siswa.profile');

    Route::post('/logout', function () {
        Auth::guard('siswa')->logout();
        return redirect('/login-siswa');
    })->name('siswa.logout');
});


// === Protected Routes (Requires Auth) ===
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/absensi-chart', [DashboardController::class, 'getAbsensiChartData']);
    Route::get('/dashboard/grafik-absensi', [DashboardController::class, 'grafikAbsensi'])->name('dashboard.grafikAbsensi');


    // Siswa CRUD
    Route::resource('siswa', SiswaController::class);
    Route::get('/siswa/ajax-search', [SiswaController::class, 'ajaxSearch'])->name('siswa.ajax.search');
    Route::post('/siswa/{id}/reset-password', [SiswaController::class, 'resetPassword'])->name('siswa.resetPassword');



    // Kelas & Jurusan (digabung dalam 1 tampilan index untuk efisiensi UI)
    Route::get('/kelas-jurusan', [KelasController::class, 'index'])->name('kelas-jurusan.index');
    Route::resource('kelas', KelasController::class)->except(['index']);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('tahun-akademik', TahunAkademikController::class);
    Route::put('/tahun-akademik/{id}/toggle-status', [TahunAkademikController::class, 'toggleStatus'])
        ->name('tahun-akademik.toggleStatus');
});

// === Admin Only Routes ===
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('user', UserController::class)->except(['create', 'edit', 'show']);
    Route::resource('guru', GuruController::class)->except(['create', 'edit', 'show']);

    Route::resource('jadwal', JadwalController::class);
    Route::get('/jadwal/get-jurusan/{tahun_akademik_id}', [JadwalController::class, 'getJurusan'])->name('jadwal.getJurusan');
    Route::get('/jadwal/get-kelas/{tahun_akademik_id}/{jurusan_id}', [JadwalController::class, 'getKelas'])->name('jadwal.getKelas');
});

use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



Route::get('/pembagian-kelas', [PembagianKelasController::class, 'index'])->name('pembagian.kelas.index');
Route::post('/pembagian-kelas/get-jurusan', [PembagianKelasController::class, 'getJurusan'])->name('pembagian.kelas.get.jurusan');
Route::post('/pembagian-kelas/get-kelas', [PembagianKelasController::class, 'getKelas'])->name('pembagian.kelas.get.kelas');
Route::post('/pembagian-kelas/simpan', [PembagianKelasController::class, 'store'])->name('pembagian.kelas.store');
Route::delete('/pembagian-kelas/{id}', [PembagianKelasController::class, 'destroy'])->name('pembagian.kelas.destroy');


// Route di web.php
Route::get('/siswa-aktif-list', [SiswaTidakAktifController::class, 'listSiswaAktif'])->name('siswa-aktif-list');

Route::get('/siswa-aktif-list', [\App\Http\Controllers\SiswaTidakAktifController::class, 'getSiswaAktif'])->name('siswa-aktif-list');
Route::get('/siswa-tidak-aktif', [SiswaTidakAktifController::class, 'index'])->name('siswa-tidak-aktif.index');
Route::post('/siswa-tidak-aktif', [SiswaTidakAktifController::class, 'store'])->name('siswa-tidak-aktif.store');
Route::delete('/siswa-tidak-aktif/{siswa_id}', [SiswaTidakAktifController::class, 'destroy'])->name('siswa-tidak-aktif.destroy');


Route::prefix('hasil-pembagian')->name('hasil.pembagian.')->group(function () {
    // Halaman utama index
    Route::get('/', [HasilPembagianKelasController::class, 'index'])->name('index');

    // Ambil detail siswa berdasarkan kelas, jurusan, tahun akademik (AJAX)
    Route::get('/get-detail', [HasilPembagianKelasController::class, 'getDetail'])->name('getDetail');

    // Ambil siswa yang belum dibagi kelas (AJAX)
    Route::get('/get-siswa-tanpa-kelas', [HasilPembagianKelasController::class, 'getSiswaTanpaKelas'])->name('getSiswaTanpaKelas');

    // Proses tambah siswa ke kelas (POST)
    Route::post('/tambah', [HasilPembagianKelasController::class, 'tambahSiswa'])->name('tambah');

    // Hapus siswa dari kelas berdasarkan ID detail (DELETE)
    Route::delete('/hapus-detail/{id}', [HasilPembagianKelasController::class, 'hapusSiswaDariKelas'])->name('hapusDetail');

    Route::get('/modal/siswa', [HasilPembagianKelasController::class, 'loadSiswaModal'])->name('modal.siswa');
});



Route::resource('mata_pelajaran', MataPelajaranController::class);

Route::middleware(['auth'])->prefix('absensi')->group(function () {
    Route::get('/', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/{jadwal}/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/{jadwal}', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/{jadwal}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::post('/{jadwal}/update', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::post('/absensi/kirim-notifikasi', [AbsensiController::class, 'sendNotificationForToday'])->name('absensi.kirimNotifikasi');
});

Route::get('/rekapabsensi', [RekapAbsensiController::class, 'index'])->name('rekapabsensi.index');
Route::get('/rekap-absensi', [RekapAbsensiController::class, 'index'])->name('rekap.index');
Route::post('/rekap-absensi/filter', [RekapAbsensiController::class, 'filter'])->name('rekap.filter');





Route::middleware(['auth'])->group(function () {});
