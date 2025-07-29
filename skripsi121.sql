-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2025 pada 07.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi121`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('H','I','S','A') NOT NULL DEFAULT 'A',
  `waktu_absen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `notifikasi_terkirim` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `jadwal_id`, `siswa_id`, `guru_id`, `status`, `waktu_absen`, `created_at`, `updated_at`, `deleted_at`, `notifikasi_terkirim`) VALUES
(20, 5, 10, 1, 'H', '2025-07-27 09:26:13', '2025-07-27 08:56:19', '2025-07-27 09:26:13', NULL, 1),
(21, 5, 11, 1, 'I', '2025-07-27 09:26:13', '2025-07-27 08:56:19', '2025-07-27 09:26:13', NULL, 1),
(22, 5, 12, 1, 'S', '2025-07-27 09:26:13', '2025-07-27 08:56:19', '2025-07-27 09:26:13', NULL, 1),
(23, 5, 13, 1, 'A', '2025-07-27 09:26:13', '2025-07-27 08:56:19', '2025-07-27 09:26:13', NULL, 1),
(32, 6, 10, 1, 'A', '2025-07-28 05:02:06', '2025-07-28 05:02:06', '2025-07-28 05:02:06', NULL, 0),
(33, 6, 11, 1, 'A', '2025-07-28 05:02:06', '2025-07-28 05:02:06', '2025-07-28 05:02:06', NULL, 0),
(34, 6, 12, 1, 'A', '2025-07-28 05:02:06', '2025-07-28 05:02:06', '2025-07-28 05:02:06', NULL, 0),
(35, 6, 13, 1, 'A', '2025-07-28 05:02:06', '2025-07-28 05:02:06', '2025-07-28 05:02:06', NULL, 0),
(36, 7, 10, 1, 'A', '2025-07-29 05:02:35', '2025-07-29 05:02:35', '2025-07-29 05:02:35', NULL, 0),
(37, 7, 11, 1, 'A', '2025-07-29 05:02:35', '2025-07-29 05:02:35', '2025-07-29 05:02:35', NULL, 0),
(38, 7, 12, 1, 'A', '2025-07-29 05:02:35', '2025-07-29 05:02:35', '2025-07-29 05:02:35', NULL, 0),
(39, 7, 13, 1, 'A', '2025-07-29 05:02:35', '2025-07-29 05:02:35', '2025-07-29 05:02:35', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun_akademik_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jurusan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id_detail`, `kelas_id`, `tahun_akademik_id`, `jurusan_id`, `siswa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 1, 1, 3, '2025-07-25 11:52:14', '2025-07-25 11:52:14', NULL),
(5, 1, 1, 1, 4, '2025-07-25 11:52:14', '2025-07-25 11:52:14', NULL),
(6, 1, 1, 1, 5, '2025-07-26 18:04:37', '2025-07-26 18:04:37', NULL),
(7, 1, 1, 1, 6, '2025-07-26 18:30:03', '2025-07-26 18:30:03', NULL),
(9, 1, 1, 1, 1, '2025-07-27 05:56:34', '2025-07-27 05:56:34', NULL),
(10, 1, 1, 1, 2, '2025-07-27 05:56:34', '2025-07-27 05:56:34', NULL),
(11, 1, 1, 1, 8, '2025-07-27 06:21:40', '2025-07-27 06:21:40', NULL),
(12, 1, 1, 1, 9, '2025-07-27 06:21:48', '2025-07-27 06:21:48', NULL),
(13, 1, 1, 1, 7, '2025-07-27 06:33:03', '2025-07-27 06:33:03', NULL),
(17, 1, 1, 1, 27, '2025-07-27 06:45:42', '2025-07-27 06:45:42', NULL),
(18, 1, 1, 1, 28, '2025-07-27 06:45:55', '2025-07-27 06:45:55', NULL),
(19, 2, 1, 1, NULL, '2025-07-27 08:45:45', '2025-07-27 08:45:45', NULL),
(20, 2, 1, 1, 10, '2025-07-27 08:45:59', '2025-07-27 08:45:59', NULL),
(21, 2, 1, 1, 11, '2025-07-27 08:45:59', '2025-07-27 08:45:59', NULL),
(22, 2, 1, 1, 12, '2025-07-27 08:45:59', '2025-07-27 08:45:59', NULL),
(23, 2, 1, 1, 13, '2025-07-27 08:45:59', '2025-07-27 08:45:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nip`, `nama`, `jenis_kelamin`, `alamat`, `no_hp`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '21122', 'dadad', 'L', 'DUSUN NANGGER RT/RW : 005/003 DESAN TEGALWATU KECANATAN TIRIS', '08828822222', '2025-07-25 11:54:05', '2025-07-25 11:54:05', NULL),
(2, 3, '213131', '3331112', 'L', 'afdfd', '082232811129', '2025-07-27 08:44:49', '2025-07-27 08:44:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_akademik_id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `guru_id`, `mata_pelajaran_id`, `tahun_akademik_id`, `jurusan_id`, `kelas_id`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Jumat', '18:00:00', '19:00:00', 'aktif', '2025-07-25 11:55:28', '2025-07-25 11:56:46', NULL),
(2, 1, 1, 1, 1, 1, 'Minggu', '15:00:00', '15:45:00', 'aktif', '2025-07-27 08:39:18', '2025-07-27 08:42:02', NULL),
(4, 2, 1, 1, 1, 2, 'Minggu', '15:00:00', '16:00:00', 'aktif', '2025-07-27 08:46:43', '2025-07-27 08:46:43', NULL),
(5, 1, 1, 1, 1, 2, 'Minggu', '16:00:00', '17:00:00', 'aktif', '2025-07-27 09:12:22', '2025-07-27 09:12:22', NULL),
(6, 1, 1, 1, 1, 2, 'Senin', '12:00:00', '13:00:00', 'aktif', '2025-07-27 14:07:59', '2025-07-27 14:07:59', NULL),
(7, 1, 1, 1, 1, 2, 'Selasa', '12:00:00', '13:00:00', 'aktif', '2025-07-27 14:08:35', '2025-07-27 14:08:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IPAS', '2025-07-25 11:50:45', '2025-07-25 11:50:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'xii', '2025-07-25 11:50:32', '2025-07-25 11:50:32', NULL),
(2, 'XII MA', '2025-07-27 08:45:33', '2025-07-27 08:45:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'oakdoadka', '2025-07-25 11:54:36', '2025-07-25 11:54:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_14_172704_create_siswa_table', 1),
(6, '2025_05_14_181127_create_kelas_table', 1),
(7, '2025_05_14_181149_create_jurusan_table', 1),
(8, '2025_05_15_120727_add_role_to_users_table', 1),
(9, '2025_05_18_030431_create_tahun_akademik_table', 1),
(10, '2025_05_20_080606_create_detail_table', 1),
(11, '2025_06_12_124306_create_mata_pelajaran_table', 1),
(12, '2025_06_12_180340_create_guru_table', 1),
(13, '2025_06_13_163401_create_jadwal_table', 1),
(14, '2025_06_15_074642_create_absensi_table', 1),
(15, '2025_06_25_205702_add_password_to_siswa_table', 1),
(16, '2025_06_29_114141_create_siswa_tidak_aktif_table', 1),
(17, '2025_07_06_011023_add_notifikasi_terkirim_to_absensi_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `created_at`, `updated_at`, `deleted_at`, `password`) VALUES
(1, 309961, '9856489248', 'Dalimin Simanjuntak M.TI.', 'L', 'Payakumbuh', '2007-11-11', 'Jln. Reksoninten No. 670, Gunungsitoli 17812, Jabar', '6281937665539', '2025-07-25 06:32:02', '2025-07-25 11:58:13', NULL, '$2y$12$ftTREZ3ayMv2pnKa3mKgRe/xQcvOOK/HdWL7tsx94qoHt9ohpA92C'),
(2, 303137, '9234993736', 'Raina Farida M.Farm', 'L', 'Bukittinggi', '1980-08-06', 'Ki. Balikpapan No. 268, Bogor 88855, Riau', '082232811129', '2025-07-25 06:32:02', '2025-07-25 06:32:02', NULL, '$2y$12$qJNeIz892Va.T.zKl1Hm7.sgbp7vTozVv/rrBR31dsmoi9vylMD9O'),
(3, 346169, '3609529434', 'Cahyadi Prayoga', 'L', 'Padangpanjang', '1997-07-17', 'Dk. Bambu No. 73, Pekalongan 41691, Sumbar', '082232811129', '2025-07-25 06:32:02', '2025-07-25 06:32:02', NULL, '$2y$12$ufLuSyBnGYCokAFNvFDAZ.40bfuEF0qkO8YazXFQ6TgvFhrQWv3ay'),
(4, 200451, '2663937015', 'Nadia Laksita', 'P', 'Banjar', '1981-03-06', 'Jln. Baiduri No. 145, Tanjungbalai 95214, Banten', '082232811129', '2025-07-25 06:32:03', '2025-07-25 06:32:03', NULL, '$2y$12$.Ypmi5ubrtfhCenx4xzTWuXKr9hMsplG7LmsDTZGqPyjX3gPuvDj.'),
(5, 630783, '8479497453', 'Hamima Mulyani', 'P', 'Solok', '1978-07-18', 'Kpg. Basuki Rahmat  No. 503, Semarang 29009, NTB', '082232811129', '2025-07-25 06:32:03', '2025-07-25 06:32:03', NULL, '$2y$12$LmewXZwpPcLiL4bgmRggD.px/M6nbwtNUlPHUS4ob7ZdNOtk7TCWS'),
(6, 576496, '0218027205', 'Mursita Kenari Setiawan', 'L', 'Batam', '1998-05-30', 'Kpg. Qrisdoren No. 367, Prabumulih 99066, Bengkulu', '082232811129', '2025-07-25 06:32:04', '2025-07-25 06:32:04', NULL, '$2y$12$VKg6LYMNDl.hHkRvMmS.ROLOevgM5M9q5AwGooigvvvPTha7nnkrC'),
(7, 334819, '0973526705', 'Ibrani Sihombing', 'L', 'Parepare', '1987-04-21', 'Gg. Dahlia No. 447, Padang 97234, Riau', '082232811129', '2025-07-25 06:32:04', '2025-07-25 06:32:04', NULL, '$2y$12$73qsWE.k/NgargwW8wqql.E1hIDoi55OXHyF9jH6gbUk5Ve1QwT6u'),
(8, 141144, '4392005900', 'Mahfud Mandala', 'L', 'Mojokerto', '1982-02-09', 'Jln. Nakula No. 930, Bau-Bau 33318, Kalteng', '082232811129', '2025-07-25 06:32:05', '2025-07-25 06:32:05', NULL, '$2y$12$7H8iCUSZojT1s9LRq34i0.zg32VLw6UpYoWQlgqW2.ixuTvL9W4WG'),
(9, 242711, '3803377829', 'Ulya Zizi Halimah', 'L', 'Banda Aceh', '1981-06-17', 'Psr. Soekarno Hatta No. 421, Malang 44291, Lampung', '082232811129', '2025-07-25 06:32:05', '2025-07-25 06:32:05', NULL, '$2y$12$Z3hE/xMjhT0S7yQenzFORupad8PO0xg6YjamZFgQ314TuChEaR5PS'),
(10, 437748, '0890603761', 'Estiawan Sitorus', 'L', 'Makassar', '1996-07-18', 'Jln. Dahlia No. 210, Jambi 68256, Babel', '082232811129', '2025-07-25 06:32:05', '2025-07-25 06:32:05', NULL, '$2y$12$8Rwd0QZGzDo3s3MRt4HHUudFRNFn4XsYkvjkqv0r.XZuxqC3IcAhG'),
(11, 372486, '5893241872', 'Karma Damanik', 'L', 'Serang', '1982-03-18', 'Kpg. Halim No. 239, Mojokerto 75994, Sulut', '082232811129', '2025-07-25 06:32:06', '2025-07-25 06:32:06', NULL, '$2y$12$PAeJ9aq.w9Z6.dnE4ws7eehmWLMstEkmHsIv/uCqOcXLlpsc9lRyi'),
(12, 159169, '4101788969', 'Omar Catur Januar S.Sos', 'L', 'Solok', '1973-04-14', 'Ki. Ters. Jakarta No. 517, Pematangsiantar 36523, Aceh', '082232811129', '2025-07-25 06:32:06', '2025-07-25 06:32:06', NULL, '$2y$12$fy6ST16RT62tFUljkuKHl.93TOGA0ZPGD1loXz6kgUN5F1IyL272e'),
(13, 243750, '6123781937', 'Siska Salimah Kusmawati M.Farm', 'L', 'Gorontalo', '1985-10-03', 'Kpg. Bazuka Raya No. 435, Sawahlunto 97186, Bengkulu', '082232811129', '2025-07-25 06:32:07', '2025-07-25 06:32:07', NULL, '$2y$12$OOopvGesmRr8maTwK97bB.oQQ6g3Sk.aN4ahx6mJK4n1YQx2d4aaC'),
(14, 619890, '3875591974', 'Usman Balamantri Maulana S.Pt', 'P', 'Sungai Penuh', '1987-07-31', 'Gg. Daan No. 436, Yogyakarta 20864, Jambi', '082232811129', '2025-07-25 06:32:07', '2025-07-25 06:32:07', NULL, '$2y$12$Rc44/q0SPvdhny6e5wMcTexuLSJpE3iQTwW5Iua44Lw5en1sxBA42'),
(15, 972397, '9711598742', 'Carla Rahmi Hassanah S.I.Kom', 'P', 'Bukittinggi', '1983-07-03', 'Psr. Camar No. 441, Singkawang 33431, NTT', '082232811129', '2025-07-25 06:32:08', '2025-07-25 06:32:08', NULL, '$2y$12$kGOOCKbU15UWFuJYE89HD.1eVvpHqjJheElPDLqYZqro80sZfxOvm'),
(16, 266874, '4892648290', 'Olivia Violet Usamah', 'L', 'Surakarta', '1986-03-14', 'Kpg. Banda No. 845, Balikpapan 40814, Sulteng', '082232811129', '2025-07-25 06:32:08', '2025-07-25 06:32:08', NULL, '$2y$12$mC6rKfRMKWHAhgkJ40E3lO8rRixBef0C2aifPXIjKTQehdtFcpdhG'),
(17, 491886, '3011246156', 'Salman Adiarja Maheswara M.TI.', 'P', 'Blitar', '1996-05-29', 'Kpg. Dewi Sartika No. 657, Depok 83080, Sumsel', '082232811129', '2025-07-25 06:32:09', '2025-07-25 06:32:09', NULL, '$2y$12$AP3AwGjJITrvTaLeMMFGyOoRZS7zHgFicY49hpl2CA5/ukmW5lBZG'),
(18, 367281, '5303054864', 'Ghaliyati Rahimah M.M.', 'P', 'Pangkal Pinang', '1995-01-11', 'Ds. Suharso No. 596, Mojokerto 87437, Kepri', '082232811129', '2025-07-25 06:32:09', '2025-07-25 06:32:09', NULL, '$2y$12$RNWsXHcq8dsZSUfRlqgYuOkHwJlzP8yc320nB1Sw5INqEg23q/pDW'),
(19, 777358, '3754319322', 'Nadia Raina Yuniar S.Kom', 'P', 'Palopo', '1998-07-17', 'Dk. Yos Sudarso No. 249, Tangerang Selatan 85907, Lampung', '082232811129', '2025-07-25 06:32:09', '2025-07-25 06:32:09', NULL, '$2y$12$KdNVp1oh3UeymadIOFFyou9driK5Df1bC39tZaeeK1Zl0gYs1SooG'),
(20, 446580, '2653654849', 'Faizah Puspita', 'P', 'Samarinda', '1983-05-06', 'Gg. Padang No. 1, Semarang 30368, Aceh', '082232811129', '2025-07-25 06:32:10', '2025-07-25 06:32:10', NULL, '$2y$12$ybXEdDlOLjK3IMSILkzV9.XKfaKbsvrfc1YLBX4.NsCYw0kq5xdCy'),
(22, 1234567890, '9988776655', 'Budi Santoso', 'L', 'Jakarta', '2005-01-15', 'Jl. Mawar No. 1', '081234567890', '2025-07-26 17:16:02', '2025-07-26 17:16:02', NULL, '$2y$12$U.vLkzVzImcJjEIh8U8lnezytFnXeZ6C8vi9wO8uIC/LHfc9Q6DAW'),
(23, 9876543210, '1122334455', 'Sari Wulandari', 'P', 'Bandung', '2005-05-22', 'Jl. Melati No. 5', '089876543210', '2025-07-26 17:16:02', '2025-07-26 17:16:02', NULL, '$2y$12$jSTHhadCYnJ7Xy1ZSZj/mur3DqDe6OeO11uZKWq0iQdsZsR1P6PAa'),
(27, 1234567800, '1261721', 'dadasda', 'P', 'PROBOLINGGO', '2025-06-30', 'dasdasdasd', '6288288222121', '2025-07-26 17:37:36', '2025-07-26 17:37:36', NULL, '$2y$12$mMyLmEbGpHbaX8A0z.B3XOF34Q.2aP9aSfpCudl.7JJqL/ohbsDMi'),
(28, 1234567899, '12134121', 'sasasa', 'L', 'asasa', '2025-07-26', 'sasasa', '62822579348382', '2025-07-26 17:57:32', '2025-07-26 17:57:32', NULL, '$2y$12$0.Z/4UPIsOabRQbFPHs6Veu75BwbiG.5U1SpeRP6zlEfNnzj1xRKi'),
(29, 1331789694, '9476917480', 'Cut Icha Padmasari', 'P', 'Batam', '2007-02-28', 'Jalan Gardujati No. 14, Sibolga, MA 70395', '08462797531', '2025-07-27 07:07:01', '2025-07-27 07:07:01', NULL, '$2y$12$iWW8OMq6349IaPgA27NuMOsgJge4mpQfFpHOJPJt.hVtNKnClxzuS'),
(30, 2308432892, '8306577498', 'Slamet Nugroho', 'P', 'Kediri', '2008-02-29', 'Jl. S. Parman No. 4, Ternate, AC 23336', '08202507032', '2025-07-27 07:07:01', '2025-07-27 07:07:01', NULL, '$2y$12$HEBTUr.BigobFaovGXws1e62FA9XHcDVCSl0zqxG7wRCk3fEldbvy'),
(31, 7547543875, '2575763715', 'Slamet Nashiruddin', 'L', 'Purwokerto', '2010-02-23', 'Gg. Tubagus Ismail No. 5, Singkawang, Papua Barat 97223', '08756419666', '2025-07-27 07:07:02', '2025-07-27 07:07:02', NULL, '$2y$12$0eJf3ftYL3fkUg0ebCsY4.pGobgmNWa1AyFsh64CLshFPhIna/uFu'),
(32, 7817406219, '7687388938', 'Kezia Narpati', 'L', 'Pagaralam', '2007-08-26', 'Gang Jend. Sudirman No. 913, Sorong, Sulawesi Selatan 83491', '08819065114', '2025-07-27 07:07:02', '2025-07-27 07:07:02', NULL, '$2y$12$t/ygPTuuHH3RAerLy2A1cOUWaFmkUH9hOcXHSZfz4EnmONCT3chFS'),
(33, 4085595382, '8510447476', 'Jarwadi Suryono, S.IP', 'L', 'Ambon', '2009-05-25', 'Gang Ciumbuleuit No. 5, Magelang, SU 50240', '08590168006', '2025-07-27 07:07:03', '2025-07-27 07:07:03', NULL, '$2y$12$lt9m.Sf5t1rFcc72dIolM.ztNMKZz9CXK/kqnQyJknDo/uGB/.GV2'),
(34, 9712929461, '3202653763', 'Zamira Lazuardi', 'P', 'Pasuruan', '2009-06-16', 'Jl. Rawamangun No. 773, Bitung, Kalimantan Barat 36383', '08494740870', '2025-07-27 07:07:03', '2025-07-27 07:07:03', NULL, '$2y$12$Ypm2un4giv36RfLuRStliu1.fCn3g3wqVS32DV6AkctEbxnFn5iRq'),
(35, 6641956916, '5027014461', 'Adika Firgantoro', 'P', 'Tomohon', '2010-03-21', 'Jalan Stasiun Wonokromo No. 344, Depok, Maluku 06071', '08615660789', '2025-07-27 07:07:04', '2025-07-27 07:07:04', NULL, '$2y$12$SQt1u3XB1q397sy1UjT5KuzFYhCQXlOJexUX9chXffnZIbTXOkAsW'),
(36, 6073841336, '3836926593', 'Luwar Utami', 'L', 'Tebingtinggi', '2007-08-29', 'Jl. Kebonjati No. 97, Bukittinggi, Kalimantan Barat 36655', '08111913830', '2025-07-27 07:07:04', '2025-07-27 07:07:04', NULL, '$2y$12$mFCsEdRZvCapO/s19O2dvemt3H4JWIvH61Z3md4EFKgtoJXnB4hqG'),
(37, 5777981951, '7334686380', 'Mitra Mansur, S.Ked', 'P', 'Dumai', '2007-12-08', 'Jl. Medokan Ayu No. 1, Bitung, Nusa Tenggara Timur 10585', '08642651624', '2025-07-27 07:07:05', '2025-07-27 07:07:05', NULL, '$2y$12$jYC3JveA1a9OoI5Vx3nlLeKdEjS77YQESqJ4N0qZT5pgXt5ncwaqi'),
(38, 3495644713, '2990086235', 'Karna Nasyidah', 'P', 'Pematangsiantar', '2007-07-19', 'Jalan Jamika No. 572, Pematangsiantar, Bengkulu 00701', '08391565674', '2025-07-27 07:07:05', '2025-07-27 07:07:05', NULL, '$2y$12$gOPbkabo37.Rd5eST3Efh.21PzWAtE.68c5wBXbq2OniJF/lzZDDG'),
(39, 1567303062, '9917148080', 'Carla Utami, S.Pd', 'L', 'Madiun', '2007-04-10', 'Jalan Dipatiukur No. 20, Padang Sidempuan, Jawa Barat 43592', '08318632505', '2025-07-27 07:07:06', '2025-07-27 07:07:06', NULL, '$2y$12$pL5c7hhv247rU8ResefYVOYDkWNzwaqXfkfqUrZXIfgECnmI9Mr2q'),
(40, 6418905184, '3006921977', 'Karen Siregar', 'P', 'Kediri', '2007-05-14', 'Jalan Raya Ujungberung No. 39, Tanjungpinang, KU 22418', '08798620633', '2025-07-27 07:07:06', '2025-07-27 07:07:06', NULL, '$2y$12$OOZi/0ssV0RDQHOe1IMVoOoM8IVl8TaG/y7Tg1oJJeyca0fFl3jzK'),
(41, 9504628937, '5344527516', 'Julia Ramadan', 'P', 'Bogor', '2007-02-19', 'Gg. Moch. Toha No. 211, Payakumbuh, MA 87361', '08261751774', '2025-07-27 07:07:07', '2025-07-27 07:07:07', NULL, '$2y$12$bqvlp9kneUEso6h6JcunAenTZogn2fYn.EgCX85OoKqhqp/Ngp196'),
(42, 4076648022, '9713691964', 'Maria Hutapea, S.IP', 'L', 'Parepare', '2008-01-31', 'Jl. Suniaraja No. 7, Kota Administrasi Jakarta Utara, KS 41724', '08204946650', '2025-07-27 07:07:07', '2025-07-27 07:07:07', NULL, '$2y$12$jzZCU6CJiPAqNo9UgsauuuHaqpKPExbP6PgH7iBbpKP0mXvhPjwR6'),
(43, 1626776772, '4515776000', 'Puji Novitasari', 'L', 'Jayapura', '2009-10-06', 'Gg. Pacuan Kuda No. 021, Dumai, PA 04179', '08734865955', '2025-07-27 07:07:08', '2025-07-27 07:07:08', NULL, '$2y$12$61soDohJvFMuNCXAIn6RYeQIb78TxX0Sy9vuuI5M3aLTEdfI0Dd0O'),
(44, 2257336491, '1706541843', 'Ratih Sihombing, S.E.I', 'L', 'Sungai Penuh', '2009-06-27', 'Gg. Setiabudhi No. 74, Jayapura, DI Yogyakarta 54757', '08202568148', '2025-07-27 07:07:09', '2025-07-27 07:07:09', NULL, '$2y$12$ZcD78XXD1rKWd3LSkO6tl.3Jb5iDevlw9Ribk2TFJ4BZqZfFMJR2S'),
(45, 2017730177, '3103514500', 'R. Kartika Mulyani', 'P', 'Padangpanjang', '2009-09-16', 'Gang Kutai No. 30, Pekalongan, Sulawesi Tenggara 23965', '08665797181', '2025-07-27 07:07:09', '2025-07-27 07:07:09', NULL, '$2y$12$64n00sgFEU1U3G1GcPZiX.aOM4Eqeo/D8EjXBtckTeke.QXS2YOzG'),
(46, 2630858530, '6201580395', 'Intan Widodo', 'L', 'Kediri', '2010-06-12', 'Jalan Rajiman No. 510, Pagaralam, LA 40249', '08361953640', '2025-07-27 07:07:09', '2025-07-27 07:07:09', NULL, '$2y$12$5T7KhbYiymtOvqVmPYqZyubd0cGkDyANOiv.yK6W2EV2Ovc2N06NC'),
(47, 4420429089, '5867117813', 'Mila Saputra', 'L', 'Tasikmalaya', '2009-06-26', 'Gang Kiaracondong No. 9, Probolinggo, Kalimantan Barat 77307', '08638123867', '2025-07-27 07:07:10', '2025-07-27 07:07:10', NULL, '$2y$12$RRCT2mztPzSuNmExABKvpu08iqFn90UYyA2E72s9Ph2N0tLZnVjoW'),
(48, 8750021621, '5079578447', 'Cemani Hartati', 'P', 'Sukabumi', '2010-03-29', 'Gang Soekarno Hatta No. 5, Magelang, Kalimantan Barat 75903', '08998472274', '2025-07-27 07:07:11', '2025-07-27 07:07:11', NULL, '$2y$12$jbdUzPHIZzuA/SXXQ8zVwOGFCb20AR7.m/jLlluZ8J3g4g7q3NRTi'),
(49, 6195039035, '8234255583', 'Darmana Dongoran, S.Farm', 'L', 'Banjar', '2007-06-16', 'Gang Cihampelas No. 2, Banjar, JT 07398', '08688638473', '2025-07-27 07:07:11', '2025-07-27 07:07:11', NULL, '$2y$12$hmY9jyutEmwjuqS8d6V4.ucdd.hmunrm2XfRwKJCJgqO6N70cOu9a'),
(50, 8683609466, '9846906628', 'Dagel Zulaika', 'P', 'Magelang', '2008-10-08', 'Gg. Sukajadi No. 52, Sawahlunto, Maluku 21819', '08249088664', '2025-07-27 07:07:12', '2025-07-27 07:07:12', NULL, '$2y$12$VKs9Jcpv7nUfpU/q4c45KuRstJcv8XkJ63jMvRhCDjKzzj/.TRzOS'),
(51, 7323253057, '3368323642', 'Tiara Anggraini', 'L', 'Lubuklinggau', '2007-09-08', 'Gang M.H Thamrin No. 20, Langsa, JI 12933', '08501166976', '2025-07-27 07:07:12', '2025-07-27 07:07:12', NULL, '$2y$12$7j.jt3AXIAAojP5hWZrJzOoPVeLCQYXzAp1k8HyjiMmvnK5Oow0CO'),
(52, 9900902711, '8616431044', 'Nabila Maheswara', 'L', 'Surabaya', '2007-09-15', 'Jl. Peta No. 290, Kota Administrasi Jakarta Selatan, PA 32956', '08755063244', '2025-07-27 07:07:13', '2025-07-27 07:07:13', NULL, '$2y$12$IqVB02gvk8..nIJMwACEFOIytOhW7oVsdBBCDz3ugcgSZ8Yur.kEi'),
(53, 8992443592, '5642131468', 'drg. Lala Mardhiyah', 'P', 'Prabumulih', '2010-05-25', 'Gang Kutisari Selatan No. 30, Tidore Kepulauan, MU 56913', '08428480267', '2025-07-27 07:07:14', '2025-07-27 07:07:14', NULL, '$2y$12$GnCoJp4A3R5gxFuwfJXYDu5B/QVKGRXLLJBiutjgvUYfejH5rvJ.2'),
(54, 1930614292, '3241713361', 'Jessica Januar', 'L', 'Palopo', '2009-08-01', 'Gg. Medokan Ayu No. 7, Cimahi, KI 59319', '08161437573', '2025-07-27 07:07:14', '2025-07-27 07:07:14', NULL, '$2y$12$kitnJndEUPHJGp2A8d4yi.NYzP/.qreRcrbhFWFTRYOyzDdoQ0ylK'),
(55, 5836831810, '8802205976', 'Sari Widodo', 'P', 'Jambi', '2008-11-25', 'Jl. BKR No. 17, Bukittinggi, RI 34472', '08834832786', '2025-07-27 07:07:15', '2025-07-27 07:07:15', NULL, '$2y$12$wXCU1dZu4uzZQK2ValtnG.cG2JNEPmhwr0.zsZVOgx07SfWWha9g.'),
(56, 1801485002, '5271834203', 'Dr. Kardi Nainggolan', 'P', 'Tasikmalaya', '2006-08-10', 'Gang Laswi No. 5, Samarinda, PB 54770', '08174218580', '2025-07-27 07:07:15', '2025-07-27 07:07:15', NULL, '$2y$12$Nny2jqmauUeu7b8OJi846O9E8TeJZ1h5.crGJ3NdRDdIYtwzrM2ee'),
(57, 3293172046, '7772098925', 'H. Jagaraga Hartati, S.E.I', 'L', 'Tarakan', '2010-03-08', 'Jl. Sadang Serang No. 688, Tebingtinggi, Nusa Tenggara Barat 07137', '08644768234', '2025-07-27 07:07:16', '2025-07-27 07:07:16', NULL, '$2y$12$kPINJexRwoW8ISLnvniTouM1lRTTdLyYdLV/.6IVhVbTJv6gEZ7ce'),
(58, 5343937081, '2448537507', 'Vera Rajata, S.H.', 'L', 'Padang Sidempuan', '2010-05-25', 'Jl. Rajawali Barat No. 05, Kota Administrasi Jakarta Barat, AC 81217', '08616323675', '2025-07-27 07:07:16', '2025-07-27 07:07:16', NULL, '$2y$12$TKEqV6ZRF.6mjZt9JQjQM.Pn96yVX0CtxwWzrelNHlKX6SAQeKTDi'),
(59, 9487050958, '1664751476', 'Violet Melani', 'P', 'Metro', '2007-06-10', 'Jl. Peta No. 91, Mataram, Kalimantan Tengah 21793', '08740085931', '2025-07-27 07:07:17', '2025-07-27 07:07:17', NULL, '$2y$12$D5a.riWffbWyBM6ScH.SK.UspvalPVcwGbIo/gbHHG/ZFdbnB/ZBO'),
(60, 6495423953, '8031004750', 'Balangga Lestari', 'P', 'Pagaralam', '2009-12-29', 'Gg. Rajawali Barat No. 913, Jayapura, GO 74685', '08254052654', '2025-07-27 07:07:17', '2025-07-27 07:07:17', NULL, '$2y$12$Psjxc1.jVzsTKjsxmlmUVOzM2lAjBEQ638rdenufV.YphmTjp3nzS'),
(61, 9447859851, '1077332845', 'Tgk. Dartono Aryani, S.Kom', 'L', 'Tomohon', '2008-03-17', 'Gang BKR No. 98, Binjai, JI 52198', '08887294147', '2025-07-27 07:07:18', '2025-07-27 07:07:18', NULL, '$2y$12$u8AjuTHdtg8Ls.A5HhqfzuPe8g6mDG4bJOLUYpI9m64KTUSF1FTDS'),
(62, 9755700524, '3071040524', 'Elisa Siregar', 'L', 'Padangpanjang', '2009-08-13', 'Jl. Raya Ujungberung No. 17, Sorong, Kepulauan Riau 61026', '08579361428', '2025-07-27 07:07:18', '2025-07-27 07:07:18', NULL, '$2y$12$iTvbUDV9ReiBRZs9sinkQOj2nAd122sqUNGGoDBY43Kb6gxvBrp6u'),
(63, 1610945482, '8880905973', 'Tari Mandasari, S.T.', 'L', 'Kota Administrasi Jakarta Selatan', '2009-04-11', 'Gg. PHH. Mustofa No. 56, Batu, Kepulauan Bangka Belitung 79709', '08209136483', '2025-07-27 07:07:19', '2025-07-27 07:07:19', NULL, '$2y$12$xgcPThf464Z4UgcO23ROB.t7JTcM.HhJluwCNadCf3O4CHOIIp.Ti'),
(64, 1657593662, '9648871815', 'Mulya Sudiati', 'P', 'Purwokerto', '2007-03-28', 'Gang Jamika No. 0, Jambi, SS 33610', '08145498055', '2025-07-27 07:07:19', '2025-07-27 07:07:19', NULL, '$2y$12$1b233NXpbGNB4cXlTCdxXuOt1u2yF25KekQ6YrrpG5EGg.Vv6ZZkS'),
(65, 3918855380, '6821685637', 'Edward Laksmiwati', 'L', 'Tomohon', '2007-03-29', 'Gg. Ahmad Yani No. 24, Madiun, KB 55860', '08816346895', '2025-07-27 07:07:20', '2025-07-27 07:07:20', NULL, '$2y$12$kOua4/57w0OlPEM9b11ZxubUyT9lV8UX3KZvCSOJo8M36/6gKkUo.'),
(66, 2527218240, '8464072240', 'Tgk. Balijan Maryati, S.Gz', 'L', 'Prabumulih', '2006-08-17', 'Jalan Rungkut Industri No. 57, Prabumulih, Sulawesi Tenggara 65355', '08800048204', '2025-07-27 07:07:20', '2025-07-27 07:07:20', NULL, '$2y$12$G/8b8J7/kZrRyndn60iAyO6m7FbPtPz4tW2BncwRLjz1/mHvXts2a'),
(67, 7576544263, '8159404288', 'Tirtayasa Rahmawati', 'L', 'Serang', '2007-09-19', 'Jl. Ahmad Dahlan No. 6, Magelang, Papua 54546', '08201199748', '2025-07-27 07:07:20', '2025-07-27 07:07:20', NULL, '$2y$12$EpuNIRaSFPL90nzKwJwcSOvWPs8L4EGGBm4jAsXAwo7n1quEMfIrq'),
(68, 7105465256, '3152250562', 'Gasti Mahendra', 'L', 'Manado', '2010-06-18', 'Jl. Soekarno Hatta No. 360, Madiun, Sulawesi Tenggara 68605', '08779251078', '2025-07-27 07:07:21', '2025-07-27 07:07:21', NULL, '$2y$12$mpAUR9Wcu7UiNR3suxfooOkT7sn88EYqy8.XGEZ0iUHUzTwrGEK82'),
(69, 4589035675, '2642383453', 'Luthfi Sihombing', 'P', 'Makassar', '2007-08-11', 'Gang Jayawijaya No. 240, Tangerang Selatan, JK 65865', '08704058147', '2025-07-27 07:07:22', '2025-07-27 07:07:22', NULL, '$2y$12$W8YodJKYHu.lYGAVh3u2ceUkbKhcrZRBax6pTPpEqxdx8fkLlBzpG'),
(70, 6462188098, '7635125398', 'Talia Firmansyah, M.Farm', 'P', 'Madiun', '2007-06-21', 'Gang Ahmad Dahlan No. 6, Kota Administrasi Jakarta Utara, Sumatera Selatan 44808', '08304133575', '2025-07-27 07:07:22', '2025-07-27 07:07:22', NULL, '$2y$12$hYceUr6KOgVXDhvbL9ZD9.PJvxBvrCTDRkrl1tY9XYdblZRyOPLT6'),
(71, 3228292477, '1195773784', 'Karma Januar', 'L', 'Surakarta', '2007-06-18', 'Jalan Antapani Lama No. 1, Parepare, SU 04330', '08223716146', '2025-07-27 07:07:23', '2025-07-27 07:07:23', NULL, '$2y$12$DBuMeOyws8cmBLjlej4oaer8ahNvj7A/QhpW2MmhpFv0mhhZ/qJPu'),
(72, 7899592348, '6887891241', 'Kamal Sitompul, S.Ked', 'P', 'Ambon', '2009-06-12', 'Jalan Jakarta No. 09, Kota Administrasi Jakarta Barat, Riau 06239', '08783664018', '2025-07-27 07:07:23', '2025-07-27 07:07:23', NULL, '$2y$12$J6Dm/nakvsCV3HsGKrRmvuL.Q1jvtFk8Vff3/nJ/57OCXrT3D5CkK'),
(73, 3931709128, '2470126236', 'Puji Laksita', 'L', 'Balikpapan', '2009-10-02', 'Jl. Pelajar Pejuang No. 5, Solok, Aceh 05007', '08788296234', '2025-07-27 07:07:24', '2025-07-27 07:07:24', NULL, '$2y$12$kbTi4jnOylTaincdDuJXLOeWQ9n0bmzUBXkTzf8qAk6gKt92f1yf2'),
(74, 9583886282, '8411305123', 'Jelita Halimah', 'L', 'Palu', '2007-06-07', 'Jl. Sukabumi No. 21, Lubuklinggau, DI Yogyakarta 71557', '08832841231', '2025-07-27 07:07:24', '2025-07-27 07:07:24', NULL, '$2y$12$ejK7XqeUDbRkVkcr2tiObOO80zSPBq2F1cA3brO2W6JGH31Edvevu'),
(75, 4141524061, '8563395463', 'Drs. Siti Anggriawan', 'L', 'Tebingtinggi', '2006-08-24', 'Jl. Merdeka No. 09, Padangpanjang, MA 19314', '08109904543', '2025-07-27 07:07:25', '2025-07-27 07:07:25', NULL, '$2y$12$WKkp9ag.xOEZBY.AkKVBIOQqwv1Ms2DfWSmFoUO6.3ySC/Athnlsu'),
(76, 6531196263, '6877464841', 'Kayla Namaga', 'L', 'Pasuruan', '2008-11-01', 'Jl. R.E Martadinata No. 748, Kediri, BA 62629', '08376302976', '2025-07-27 07:07:25', '2025-07-27 07:07:25', NULL, '$2y$12$Ox3T9sGUmCOupq.ZvZtwa.4b1SCw57MlbkTRy.iwhmI7SL9KglloO'),
(77, 1656803046, '2276095410', 'Bancar Saefullah', 'P', 'Banjarbaru', '2009-11-03', 'Jalan Pacuan Kuda No. 6, Yogyakarta, Papua Barat 73516', '08547029238', '2025-07-27 07:07:26', '2025-07-27 07:07:26', NULL, '$2y$12$arN5kn.FYu187zNQuO0TzOeflSmTIFRKdTkJg8I.M8CxnmOVK1dza'),
(78, 1413441543, '3969157242', 'Leo Wijaya, S.Kom', 'P', 'Pasuruan', '2009-09-18', 'Jl. Jayawijaya No. 06, Lubuklinggau, RI 57326', '08446857410', '2025-07-27 07:07:26', '2025-07-27 07:07:26', NULL, '$2y$12$i4/xQD4GSN4CCdBRNkcY4erGXrP41KhLIo0NDwByZQ1m7Jm52vQdS'),
(79, 2438422052, '6301531511', 'drg. Vanesa Hutapea, M.Farm', 'L', 'Sukabumi', '2009-02-13', 'Gg. Gardujati No. 33, Surakarta, Kalimantan Utara 29276', '08623384436', '2025-07-27 07:07:27', '2025-07-27 07:07:27', NULL, '$2y$12$Cc4PUJQmYMSNH7bWUxWCD.RhKRSwMlg1fZvSZxmX6tYbmr6PSqZo6'),
(80, 3300572162, '9863438658', 'Cut Gabriella Kusmawati, S.H.', 'L', 'Kendari', '2009-12-30', 'Gg. Laswi No. 58, Pontianak, KT 16997', '08628615772', '2025-07-27 07:07:27', '2025-07-27 07:07:27', NULL, '$2y$12$7aKc.D.0EDlhDm8HQMtm9.zhTeaww6Rbr0HqrnqQdNLU.p72QBLWS'),
(81, 5615312171, '8657512807', 'Panca Haryanto', 'P', 'Bandung', '2006-11-15', 'Gg. Tebet Barat Dalam No. 094, Jambi, SR 54288', '08291046930', '2025-07-27 07:07:28', '2025-07-27 07:07:28', NULL, '$2y$12$jaHmbVV6n4hNtRElc0a7Xe0Rpqwdebro10PMYB0DK6aBttkEoZROm'),
(82, 3392797005, '7314310585', 'Zizi Saragih', 'L', 'Ternate', '2007-09-15', 'Jl. Waringin No. 302, Binjai, JI 40117', '08138325172', '2025-07-27 07:07:28', '2025-07-27 07:07:28', NULL, '$2y$12$8xgSGW8ZUl/5xNRC/R7hsuZbbA8R8wEUtqFmJwJOvQQbBszT2dAFy'),
(83, 2201599706, '5112772897', 'Drs. Lanjar Suryono, S.T.', 'P', 'Bukittinggi', '2009-05-04', 'Jl. Gegerkalong Hilir No. 266, Serang, Bengkulu 51134', '08865089005', '2025-07-27 07:07:29', '2025-07-27 07:07:29', NULL, '$2y$12$raNzI3LitxoYbXz8GvxEgOhLAtz4SgtLAMU3mnEsRdAxb5hXw/LWi'),
(84, 9073549838, '5564715600', 'Ani Winarsih', 'P', 'Tarakan', '2007-03-27', 'Jalan M.T Haryono No. 85, Ambon, LA 40479', '08881141050', '2025-07-27 07:07:29', '2025-07-27 07:07:29', NULL, '$2y$12$EvIZ.1zmQuV4Pzr7BA9UqO7FYks0GKm2CDZz1nQzzdUeGpuPEvs.e'),
(85, 6922814466, '7835898849', 'R.A. Dewi Aryani', 'P', 'Banda Aceh', '2009-05-09', 'Gang Pasir Koja No. 92, Kediri, Jawa Tengah 08904', '08684195376', '2025-07-27 07:07:30', '2025-07-27 07:07:30', NULL, '$2y$12$UU/3stBmjJI.KN.MN.tAHONqn2ToFwsZe9JRNwJPJt0shR0K3FEc2'),
(86, 7528605789, '5704596589', 'Panca Pratama', 'L', 'Blitar', '2008-03-23', 'Gang Sukabumi No. 724, Banjarmasin, Jambi 37930', '08843122279', '2025-07-27 07:07:30', '2025-07-27 07:07:30', NULL, '$2y$12$ka9bupGeH3zR2I9qZErGWOipJzfF0Uli6Sg848m.EG3IxdPVJ42MW'),
(87, 4614367212, '6670477749', 'Wulan Palastri', 'L', 'Bima', '2010-01-02', 'Jalan Medokan Ayu No. 159, Gorontalo, JT 61827', '08844863819', '2025-07-27 07:07:31', '2025-07-27 07:07:31', NULL, '$2y$12$muMJKQCLWK3MYHsDD5ogV.vDashxltndA7YJ0thG5CUVcjmtXYWK6'),
(88, 7632475317, '8286126964', 'H. Pangeran Nuraini, S.Kom', 'P', 'Tidore Kepulauan', '2008-10-31', 'Gg. Pasirkoja No. 70, Pontianak, AC 54007', '08775896757', '2025-07-27 07:07:32', '2025-07-27 07:07:32', NULL, '$2y$12$HrcAvtcX4EI34WMOrXMDO.jt01fD.e/jB2qlV38EbnZlt8v1jbf8S'),
(89, 9978394610, '7019203249', 'Zalindra Saptono', 'P', 'Padang Sidempuan', '2007-05-06', 'Gg. Raya Ujungberung No. 97, Tanjungbalai, Kalimantan Timur 87205', '08772726720', '2025-07-27 07:07:32', '2025-07-27 07:07:32', NULL, '$2y$12$2kJrCE5lYHjP3lzxM.2aSOLbQfvALCRVIjzg//spS0lDmfRhEy3sW'),
(90, 3178382998, '8708943471', 'R.M. Emong Sitorus, M.Ak', 'L', 'Bandung', '2007-11-07', 'Gang Surapati No. 339, Tasikmalaya, NB 78467', '08355387572', '2025-07-27 07:07:33', '2025-07-27 07:07:33', NULL, '$2y$12$K5xryFvB7rY8Uy4O0TQ2hOJcB2NENsr1u0WMNRhboYGFjhFnmNHxO'),
(91, 3494489288, '8748493884', 'Kala Widiastuti', 'P', 'Sabang', '2008-06-25', 'Jalan KH Amin Jasuta No. 4, Pekalongan, Sulawesi Tenggara 23854', '08576519773', '2025-07-27 07:07:33', '2025-07-27 07:07:33', NULL, '$2y$12$iOpikBXBOoOX6PT9IlpDGOnI4GWnv71m7O53VOVwUNHrYNg0T0sC.'),
(92, 7757904856, '3676328390', 'Tgk. Gamani Maheswara', 'P', 'Kota Administrasi Jakarta Pusat', '2007-05-12', 'Gg. Cikutra Timur No. 572, Tual, Nusa Tenggara Barat 08990', '08217688771', '2025-07-27 07:07:34', '2025-07-27 07:07:34', NULL, '$2y$12$iahkJtunYF/UQdnnaH4Cpe5ajmifhTA4iPHGqR8Q7k.Ltgrii2bHm'),
(93, 6359446029, '6547241829', 'Padma Kuswoyo, M.Kom.', 'L', 'Dumai', '2008-10-07', 'Gang Raya Setiabudhi No. 93, Pekalongan, KU 15044', '08343640742', '2025-07-27 07:07:34', '2025-07-27 07:07:34', NULL, '$2y$12$b/LQ88yMg56kJNoPUgSEHeY6NSQIP61Ohj2MfuNvjzNLdKHGxQ0l.'),
(94, 4679814740, '4652775028', 'Waluyo Wastuti', 'P', 'Subulussalam', '2008-01-29', 'Gg. Asia Afrika No. 83, Solok, Kalimantan Timur 03303', '08234750650', '2025-07-27 07:07:35', '2025-07-27 07:07:35', NULL, '$2y$12$vidoLvhKZ.BUYlR.D8V2H.lepzmSxvZbWvjLaBu5mr/ShfFEbjsVm'),
(95, 6368329919, '1781811541', 'R. Kasiyah Utama', 'P', 'Lubuklinggau', '2007-05-28', 'Jl. W.R. Supratman No. 643, Mataram, PA 99903', '08558290550', '2025-07-27 07:07:35', '2025-07-27 07:07:35', NULL, '$2y$12$A0rSzjx1egAERYtTVMoHQeM1FWjwRVoajRy0PDDBQNqFu79Pwmt0K'),
(96, 5939854197, '6187683646', 'Febi Rajasa', 'L', 'Dumai', '2009-04-07', 'Jl. Cikapayang No. 6, Langsa, LA 32429', '08368646440', '2025-07-27 07:07:36', '2025-07-27 07:07:36', NULL, '$2y$12$c5qjbp7nYb6C./pLj/psGegQMtrHpGGF2m6W5NKhS9..mHl8LyIdC'),
(97, 1133425417, '9543466338', 'Martani Hutapea', 'L', 'Pariaman', '2006-10-12', 'Jl. Kiaracondong No. 928, Pematangsiantar, Riau 42363', '08703826647', '2025-07-27 07:07:37', '2025-07-27 07:07:37', NULL, '$2y$12$.g5cUzIEhcV1sMNX125mNulze4ndMa1aft8yG1Wm0SKe4J0ctXkYm'),
(98, 1761218615, '4515038775', 'Nabila Suwarno', 'P', 'Kotamobagu', '2009-02-01', 'Gg. Moch. Ramdan No. 302, Banjar, JT 56573', '08799505694', '2025-07-27 07:07:37', '2025-07-27 07:07:37', NULL, '$2y$12$/QJRQqFMpdCSuMaidW8.sejUhLHw6a1p4QbcP3aSETVFqpOoWKdW2'),
(99, 1845705884, '3393653072', 'R.A. Dian Januar', 'L', 'Tegal', '2008-05-13', 'Jl. Kutisari Selatan No. 28, Palangkaraya, PA 76879', '08695317487', '2025-07-27 07:07:37', '2025-07-27 07:07:37', NULL, '$2y$12$qDj81ZLSMOCtyVwJ3QksBOJQ8Z9YfVrORRjV17d.aqV5AqVSydwt.'),
(100, 1809318108, '5938487822', 'Puti Jasmin Anggriawan', 'L', 'Pangkalpinang', '2008-07-26', 'Gang Pasirkoja No. 38, Tasikmalaya, KI 25566', '08242927249', '2025-07-27 07:07:38', '2025-07-27 07:07:38', NULL, '$2y$12$AOI2QSeXvHTb6oYqrVIZGuKEtjhUXegcAzIBMXHdkxzsu5k.MMBoa'),
(101, 3196328823, '7627440861', 'R. Yosef Saputra, M.Farm', 'L', 'Tanjungpinang', '2008-12-02', 'Gg. PHH. Mustofa No. 6, Kota Administrasi Jakarta Timur, LA 83990', '08774071786', '2025-07-27 07:07:38', '2025-07-27 07:07:38', NULL, '$2y$12$w0DcxLS85GA/zO7GFQplzu5Q3tnaNfVMO9HzBnxNftHm/nFslULMG'),
(102, 7081265598, '3364124924', 'Drs. Anggabaya Astuti, S.E.', 'P', 'Blitar', '2008-07-08', 'Gang Tubagus Ismail No. 09, Banda Aceh, NB 91241', '08645865815', '2025-07-27 07:07:39', '2025-07-27 07:07:39', NULL, '$2y$12$vjjbTB40zv9RlaFMxTu/pumj33uioUSH1kebMmOQmFZCK4WF8.NzC'),
(103, 5794124561, '8636352823', 'dr. Jarwadi Novitasari', 'L', 'Balikpapan', '2007-10-19', 'Gg. Cempaka No. 87, Bekasi, Sulawesi Utara 74106', '08720122291', '2025-07-27 07:07:39', '2025-07-27 07:07:39', NULL, '$2y$12$nrv28vOhWv5LPIMBD2zbgOZ0fojtenGHbsMQbSSrdA6c9ElShAU5S'),
(104, 9361358931, '1555778008', 'Garda Najmudin', 'L', 'Tebingtinggi', '2008-10-03', 'Jl. Kebonjati No. 118, Salatiga, DKI Jakarta 43218', '08181532057', '2025-07-27 07:07:40', '2025-07-27 07:07:40', NULL, '$2y$12$pXv0MBxmTrjhj47D8xZ0t.tbvCDZyy3zAMtArLy5glwaGyHZOFjfe'),
(105, 7122064355, '2541975761', 'Drs. Qori Pangestu', 'L', 'Payakumbuh', '2009-12-14', 'Jl. Rawamangun No. 7, Padangpanjang, Jawa Tengah 56508', '08907409139', '2025-07-27 07:07:40', '2025-07-27 07:07:40', NULL, '$2y$12$L7bN5yG.esNfY9rHQYVu/uuLUl33sKdQl1mSoner7zFgC4lfqWcnK'),
(106, 7367588522, '5036279089', 'Irma Uwais, M.Farm', 'L', 'Binjai', '2008-08-28', 'Gang Rajawali Timur No. 597, Malang, SB 47910', '08706871776', '2025-07-27 07:07:41', '2025-07-27 07:07:41', NULL, '$2y$12$nRWbkr6G9dqpu6Ek7ImzhuR7fjA/Ge8p3V1a10ht2uxUJpiDEUk6y'),
(107, 7035733205, '8696177948', 'Hana Wijayanti', 'P', 'Pontianak', '2009-09-04', 'Jl. Kapten Muslihat No. 92, Padang, Maluku Utara 04164', '08734171396', '2025-07-27 07:07:42', '2025-07-27 07:07:42', NULL, '$2y$12$Nf4T.fW5BFs1WkBzliq2uu2RA7r.BexJt0MAK/1XYwffV9TXdXnyi'),
(108, 5668633354, '7879709978', 'Jaiman Santoso', 'L', 'Blitar', '2010-03-16', 'Jalan Asia Afrika No. 63, Pagaralam, BE 47472', '08197983892', '2025-07-27 07:07:42', '2025-07-27 07:07:42', NULL, '$2y$12$IY9/LahCoNewxzytcu5Jke4P.dVKDPWGPipW4qJiD5ZkI4GusywOi'),
(109, 5628547409, '8360360572', 'R.A. Endah Kusumo', 'P', 'Tebingtinggi', '2007-08-04', 'Jl. Gardujati No. 586, Sungai Penuh, Kalimantan Barat 07236', '08400610081', '2025-07-27 07:07:43', '2025-07-27 07:07:43', NULL, '$2y$12$Qpv2uCc1OPVyd1C5mPi5oOwaP6am5kffXCD4KjlMxCKPnWkLZEUbK'),
(110, 2961458401, '8143479443', 'Puspa Nasyiah, S.IP', 'L', 'Ternate', '2009-11-24', 'Jl. Suniaraja No. 26, Bogor, Kalimantan Selatan 34610', '08983471726', '2025-07-27 07:07:43', '2025-07-27 07:07:43', NULL, '$2y$12$zEfyxL5Ik1nkLcq.XTFHCuJtWakf78SNC1cYDCHcyVSfcZo03cHem'),
(111, 5543205134, '1020146234', 'Puspa Handayani', 'P', 'Cimahi', '2009-08-27', 'Gang Peta No. 23, Magelang, PA 83869', '08731191860', '2025-07-27 07:07:43', '2025-07-27 07:07:43', NULL, '$2y$12$c8oPokZUUDReSH32GwPMyevJveZC5X4RXkaQocOg0YKHITNYjI1.a'),
(112, 5455680105, '6329097447', 'Mulya Rahmawati', 'P', 'Pariaman', '2009-06-12', 'Jl. Sadang Serang No. 21, Depok, JB 99693', '08460493189', '2025-07-27 07:07:44', '2025-07-27 07:07:44', NULL, '$2y$12$OuktNov5rA8S9xF4lW4xguwqX0kCD63d1zZdFdTz6eCeXdU5B6i0u'),
(113, 6722553669, '3047878831', 'drg. Irma Riyanti, S.Gz', 'P', 'Banjarmasin', '2008-12-31', 'Jalan Sentot Alibasa No. 4, Bogor, KU 31761', '08116225930', '2025-07-27 07:07:45', '2025-07-27 07:07:45', NULL, '$2y$12$noRYbH0MWQbE2qakVRuMJelDcVlA7GXact3nF6GC.2WKXVpEzozFi'),
(114, 4851813666, '5847285107', 'drg. Mitra Habibi', 'L', 'Medan', '2010-04-18', 'Jalan Laswi No. 4, Bandar Lampung, PB 05235', '08681775069', '2025-07-27 07:07:45', '2025-07-27 07:07:45', NULL, '$2y$12$LrlU/Qx3VUOkV6h3pHWLduYeG5MIpUZq1uUT/ZGfH/zuvHpHjpBEO'),
(115, 3780001857, '9907503648', 'Aurora Firgantoro, S.Sos', 'P', 'Bengkulu', '2008-09-12', 'Gang Ronggowarsito No. 801, Bima, Sumatera Selatan 22996', '08618906404', '2025-07-27 07:07:45', '2025-07-27 07:07:45', NULL, '$2y$12$NlcH10otOfMARdBd8RECF.teYLRKaIl2carzIOnQusn9i3Aqtr3le'),
(116, 3716139725, '2817185772', 'drg. Atmaja Tamba, M.Farm', 'L', 'Serang', '2007-02-17', 'Jalan Sentot Alibasa No. 6, Pontianak, Bali 62517', '08470533377', '2025-07-27 07:07:46', '2025-07-27 07:07:46', NULL, '$2y$12$5.4DifjpDwyUsy77Xb6du.QZU6zZ8hQNJMdwlswWaIExH5wUYOnJi'),
(117, 4317122217, '1479561930', 'Winda Susanti', 'P', 'Metro', '2009-02-23', 'Gg. Ahmad Dahlan No. 16, Subulussalam, Nusa Tenggara Barat 81304', '08522189293', '2025-07-27 07:07:46', '2025-07-27 07:07:46', NULL, '$2y$12$NKMV53ZSn8risKW89ckFDuu9hL8ASpOegnAF8TtKMBgWK.kkk5BHG'),
(118, 6813926128, '4468084889', 'Puti Padmi Budiman', 'P', 'Meulaboh', '2008-06-06', 'Gang Cikutra Timur No. 807, Tasikmalaya, Maluku Utara 26725', '08359515218', '2025-07-27 07:07:47', '2025-07-27 07:07:47', NULL, '$2y$12$JnwszcJAd5CUEUlYnSh3NefOp8K7Z/eQH2WjF9iX2gx53ruwrpwCu'),
(119, 4286567819, '6613787178', 'Elma Zulkarnain, S.IP', 'P', 'Cimahi', '2008-02-10', 'Jalan Laswi No. 9, Jambi, JT 27920', '08267848437', '2025-07-27 07:07:47', '2025-07-27 07:07:47', NULL, '$2y$12$fW63IQI8g.R8NycWOFm/TuGMFq8I3bFsYLzaQBoGPj.jHoHyZ/QgG'),
(120, 9935109276, '6819227520', 'Damar Mandasari', 'P', 'Pekalongan', '2007-07-29', 'Jalan Setiabudhi No. 3, Tasikmalaya, SU 54420', '08645921710', '2025-07-27 07:07:48', '2025-07-27 07:07:48', NULL, '$2y$12$UT6Bsw.i7mN18ztAm1qDg.sfOTcyd8YnYYxczbCkhjssN.SJzGtiK'),
(121, 8307128562, '8426446757', 'Zulaikha Wahyudin', 'P', 'Pekalongan', '2007-01-06', 'Jalan Erlangga No. 961, Serang, BA 56543', '08419893855', '2025-07-27 07:07:48', '2025-07-27 07:07:48', NULL, '$2y$12$GwtcDs0kDTjvSny3KOfW.Ol4SUvY0SjWhXjoWhxTPJxnaqndWBY6q'),
(122, 8602971578, '9581920578', 'Genta Prakasa', 'P', 'Binjai', '2009-10-13', 'Jl. Siliwangi No. 55, Surakarta, RI 94379', '08245511637', '2025-07-27 07:07:49', '2025-07-27 07:07:49', NULL, '$2y$12$75sxTy1Gb4CarpS.kExqZ.8aRVRNPuUezvmu.FZHdE1J5iHuXYlwG'),
(123, 2912107215, '9410290240', 'Ratna Usamah, M.TI.', 'L', 'Kotamobagu', '2010-01-27', 'Gang Ronggowarsito No. 552, Tangerang, LA 42783', '08111303223', '2025-07-27 07:07:49', '2025-07-27 07:07:49', NULL, '$2y$12$DvUei07EmVVcuq33TvTlLuwo85NHBPTQdDR/daR2UBBUQn6vC9jvG'),
(124, 2358489007, '1313079849', 'R.M. Opung Safitri, M.Kom.', 'P', 'Jayapura', '2008-06-12', 'Gg. Cikutra Timur No. 13, Bukittinggi, JA 74942', '08905006170', '2025-07-27 07:07:49', '2025-07-27 07:07:49', NULL, '$2y$12$Hlno4lgJlsaPYOUB8wT0h.X6VFz/mW7T1s1mm968UKEQvV1FezvZe'),
(125, 7326379206, '5095668913', 'Puspa Wibisono', 'P', 'Cimahi', '2009-07-12', 'Jalan Bangka Raya No. 6, Sungai Penuh, Riau 17430', '08889835331', '2025-07-27 07:07:50', '2025-07-27 07:07:50', NULL, '$2y$12$1D5f6TYOY7Gs6rX/tbdgQOf167WXDUeCS8pe5hHqui7RTPl19lDYS'),
(126, 6580864518, '2662617586', 'Balijan Oktaviani, S.Psi', 'L', 'Meulaboh', '2009-12-14', 'Gg. Rajawali Barat No. 8, Bitung, JI 66059', '08757594849', '2025-07-27 07:07:50', '2025-07-27 07:07:50', NULL, '$2y$12$cDYkr4kmk5Qoc0BjYQ6GGOHDUQhszW4rkNWSOP1JVALwBtIhBrswS'),
(127, 1929702603, '5559084802', 'Luthfi Dongoran, S.H.', 'L', 'Gorontalo', '2007-03-14', 'Gg. Jend. A. Yani No. 87, Surabaya, Papua Barat 05994', '08407893750', '2025-07-27 07:07:51', '2025-07-27 07:07:51', NULL, '$2y$12$evxBfQcrwpGytZhUkNeTKutqxALvBez7O.QM8m7U4flFY03UZPbeS'),
(128, 8949304088, '9889403988', 'Dr. Melinda Pertiwi, M.Kom.', 'L', 'Magelang', '2009-09-27', 'Gang Otto Iskandardinata No. 52, Semarang, KB 48219', '08759302585', '2025-07-27 07:07:51', '2025-07-27 07:07:51', NULL, '$2y$12$Viymps.5.eVbci5ci0pHkOxcYnd9UetQjbpQCvFDh5jwVhedVjJDa'),
(129, 9842261439, '5362772408', 'R.M. Bahuraksa Prabowo', 'L', 'Metro', '2008-08-12', 'Gang Suniaraja No. 241, Balikpapan, Maluku Utara 50505', '08276950613', '2025-07-27 07:07:52', '2025-07-27 07:07:52', NULL, '$2y$12$3voiBKAN4VHwGntINl1kuuN8Dkk6FSCqOc.FdTQ4Yspx2hmcliOpq'),
(130, 9620953852, '7409669283', 'Dipa Adriansyah', 'L', 'Batam', '2010-01-11', 'Jl. Moch. Toha No. 1, Bontang, SR 53400', '08525546054', '2025-07-27 07:07:52', '2025-07-27 07:07:52', NULL, '$2y$12$uFYe5KDiw1iwp7XhEHFUS.RixBcGFdlkH3QmAW/UH.v4kj9J/WxYi'),
(131, 3373493184, '3332974850', 'Drs. Tami Rahmawati, S.H.', 'L', 'Pasuruan', '2008-03-03', 'Gg. Abdul Muis No. 61, Sorong, Sumatera Selatan 19557', '08345414053', '2025-07-27 07:07:53', '2025-07-27 07:07:53', NULL, '$2y$12$X92SDzQ78u4cD.hFKU97feo4maV70XjTJ.JIuVa3haPDsuQd1IqFW'),
(132, 8643950563, '8361766750', 'Umi Suryatmi, M.Kom.', 'P', 'Tasikmalaya', '2010-03-01', 'Gang Kapten Muslihat No. 07, Serang, PB 08555', '08857501815', '2025-07-27 07:07:53', '2025-07-27 07:07:53', NULL, '$2y$12$dOXwvO4LWQ0pDEA/OovugO.kVYa3MWQQIzUWni7zlNqKGchjVU4bO'),
(133, 7125909866, '1482448391', 'Praba Nababan', 'L', 'Sibolga', '2010-05-22', 'Jl. Indragiri No. 76, Binjai, Kalimantan Utara 52194', '08333876875', '2025-07-27 07:07:53', '2025-07-27 07:07:53', NULL, '$2y$12$FqJkTEp6VJRyOlJ8SSd5hOa4jEmjACxBgiKVWBODk6C2GSGU6ARBi'),
(134, 6083196311, '3869426087', 'Lulut Ramadan', 'P', 'Sibolga', '2009-11-24', 'Gang Ir. H. Djuanda No. 66, Dumai, Kepulauan Bangka Belitung 72855', '08111098270', '2025-07-27 07:07:54', '2025-07-27 07:07:54', NULL, '$2y$12$rgw1a8A93TAKP4OKEpLGCe5vJu9g0qsIWGGKSypB3f8AUcM4ClMdC'),
(135, 7257026333, '4956620264', 'drg. Juli Megantara', 'L', 'Blitar', '2006-12-24', 'Jl. Ronggowarsito No. 45, Batu, YO 70059', '08767348361', '2025-07-27 07:07:54', '2025-07-27 07:07:54', NULL, '$2y$12$.ymvsph9pZnmlydcnjiCQOJfdqV1/d9XlusR1yZJXqcIBlKFLZHe2'),
(136, 3572984375, '3733937386', 'Yosef Wasita', 'P', 'Medan', '2009-12-07', 'Jl. Suryakencana No. 900, Tasikmalaya, GO 30719', '08180371400', '2025-07-27 07:07:55', '2025-07-27 07:07:55', NULL, '$2y$12$S7sWoKZ.ozJwBb3j3u4kReCcK3mxf4hcjGLv8OOOKeSMxTHw89p0m'),
(137, 8328244889, '7373589939', 'drg. Caraka Namaga', 'L', 'Sawahlunto', '2009-01-02', 'Gang Rajawali Timur No. 0, Depok, Sulawesi Tenggara 59485', '08932451539', '2025-07-27 07:07:55', '2025-07-27 07:07:55', NULL, '$2y$12$QfkW2ziKye/f.hqpfS/0EOIqvpJNgBHDqE0iUPRt3OtoxxL.ak1YS'),
(138, 7487568203, '5223548977', 'Tgk. Titi Budiman', 'L', 'Dumai', '2010-07-06', 'Gg. Raya Ujungberung No. 39, Ambon, NT 48825', '08260198196', '2025-07-27 07:07:56', '2025-07-27 07:07:56', NULL, '$2y$12$jkOhTSwLnB3S8iJwpVtTXe1mrfYj6JcS3FHhJGlFHbrP3GyEG.vfC'),
(139, 8028877104, '9576055743', 'Bahuwirya Palastri, M.M.', 'P', 'Bandar Lampung', '2010-02-18', 'Jalan Kebonjati No. 844, Magelang, Kalimantan Timur 44793', '08123645590', '2025-07-27 07:07:56', '2025-07-27 07:07:56', NULL, '$2y$12$c5ZyKhocMGa9MfMttRducelJhtmH17bofF/iwojMb54Rs5Y46Rk06'),
(140, 1682932381, '6010786078', 'Belinda Usada', 'L', 'Tomohon', '2008-08-02', 'Gang Yos Sudarso No. 789, Tasikmalaya, JT 70201', '08178845229', '2025-07-27 07:07:56', '2025-07-27 07:07:56', NULL, '$2y$12$N36/q9qSnWxqMGTeCZAjAebsmYkFg5CFwZWyFtQtvVPRu0Bw2Ia4S'),
(141, 1242049329, '1799843124', 'Emong Nasyiah', 'L', 'Prabumulih', '2007-06-03', 'Jalan Rajawali Barat No. 92, Tarakan, Kepulauan Bangka Belitung 33546', '08908092706', '2025-07-27 07:07:57', '2025-07-27 07:07:57', NULL, '$2y$12$fGPx2JWKSUJUp6o6LwKUgeUm7zvKV.kW2EU7/mdsKDhhk0jDSdQR.'),
(142, 2910598553, '5968272649', 'Jamal Budiman', 'L', 'Pekalongan', '2006-12-10', 'Jalan Pelajar Pejuang No. 44, Sukabumi, Kalimantan Barat 60459', '08840417590', '2025-07-27 07:07:57', '2025-07-27 07:07:57', NULL, '$2y$12$eztHSYZiC6awKRPjzMs4c.zaLyzFsoFvIZi5GXRO2tRD63KNcvN/C'),
(143, 8946308684, '8438680376', 'Panji Utama', 'P', 'Batam', '2010-03-23', 'Gang Medokan Ayu No. 3, Lubuklinggau, Maluku 03174', '08739940733', '2025-07-27 07:08:23', '2025-07-27 07:08:23', NULL, '$2y$12$TL4EbvL4BD4VlXh3LvUKUOf/nn7UZfrAiIc16tpe7bXqFPBjv10qC'),
(144, 2497767772, '2611907167', 'Mumpuni Narpati', 'P', 'Palu', '2007-11-19', 'Gang Kebonjati No. 2, Ambon, SN 77673', '08797872214', '2025-07-27 07:08:23', '2025-07-27 07:08:23', NULL, '$2y$12$MRXHoxChf0jy5/wx00l/lupaojAX0sSer8T6ZuzPmLS4Ihwn3QK6S'),
(145, 5504711046, '7971445254', 'Restu Pangestu', 'L', 'Salatiga', '2006-10-30', 'Jl. Cihampelas No. 927, Singkawang, Nusa Tenggara Barat 29248', '08856749622', '2025-07-27 07:08:24', '2025-07-27 07:08:24', NULL, '$2y$12$5MQYJJ2mLwEbs71L5MNhUOmR77A0KGGpXPAWet2mOlxKDXJU5Af3.'),
(146, 7315670164, '2113340062', 'Gaiman Hardiansyah', 'P', 'Magelang', '2009-01-16', 'Jl. K.H. Wahid Hasyim No. 33, Lhokseumawe, Papua 94275', '08759987820', '2025-07-27 07:08:24', '2025-07-27 07:08:24', NULL, '$2y$12$PZSnIFVfp3brnEfbFU9AbeNkDe.iOXKjkI/d.6NVjNvcYrNm2gcHq'),
(147, 7557900123, '6683654219', 'Almira Riyanti', 'L', 'Padang', '2010-07-11', 'Gg. Pelajar Pejuang No. 9, Kendari, BE 11312', '08807191303', '2025-07-27 07:08:25', '2025-07-27 07:08:25', NULL, '$2y$12$GGAl2zV.QzK.YqqRKbg7qeSY0R73zT71Pr3fm6cvLkTbyHjvdRe/S'),
(148, 3297021737, '3193165475', 'Keisha Novitasari, S.H.', 'L', 'Solok', '2007-12-05', 'Gang Pacuan Kuda No. 951, Pasuruan, KI 87842', '08489982161', '2025-07-27 07:08:25', '2025-07-27 07:08:25', NULL, '$2y$12$Fj7iXFYyojm/4l5VQAHh9eJ7DPthL9B1rITNuLDm3bPNdrTYwGa9u'),
(149, 7419781914, '9438042572', 'Heryanto Permadi', 'P', 'Pontianak', '2007-02-27', 'Jl. Cempaka No. 954, Tidore Kepulauan, Bali 63246', '08998309102', '2025-07-27 07:08:25', '2025-07-27 07:08:25', NULL, '$2y$12$LaGzn2dqahiknfomsZSJO.uaO7InoXVVEckYEwmMfFquyLJq/91Pi'),
(150, 1587711130, '6832354696', 'Drs. Amalia Laksita, M.Farm', 'L', 'Magelang', '2007-06-19', 'Jalan Rajiman No. 2, Bogor, Jawa Timur 48769', '08663110442', '2025-07-27 07:08:26', '2025-07-27 07:08:26', NULL, '$2y$12$esUlCNZBOJog6jndLSSLGOZkUBXx/yF2hwROaoxF18X2OaUbnOzxO'),
(151, 2554942871, '4990349684', 'dr. Gangsa Firgantoro, S.I.Kom', 'P', 'Yogyakarta', '2009-02-27', 'Jalan Suniaraja No. 8, Madiun, Sulawesi Barat 47632', '08200209388', '2025-07-27 07:08:27', '2025-07-27 07:08:27', NULL, '$2y$12$449TJFrfM/WyMfx23aFcvubbPPaQ22pqq9pU0Bp3c8i2UDLxvm5CG'),
(152, 7043597957, '6485033274', 'Jamil Sinaga', 'P', 'Purwokerto', '2009-06-04', 'Jalan Indragiri No. 9, Tual, Gorontalo 29352', '08378863757', '2025-07-27 07:08:27', '2025-07-27 07:08:27', NULL, '$2y$12$67MuC/EQ.o2GafT7d3u8mOHBjGE0atUsa9tNr5vtU9o/R1cKqSr5C'),
(153, 6050365094, '2151484646', 'Kezia Usamah', 'P', 'Banjar', '2010-07-12', 'Jl. Cihampelas No. 98, Surakarta, JI 19964', '08170611121', '2025-07-27 07:08:28', '2025-07-27 07:08:28', NULL, '$2y$12$X8ixeSIJvRuj1wf8Skt29.goaIj.eHGKXDDgyjfXx5MVbipsZHpES'),
(154, 6909420587, '7875268492', 'Ir. Tiara Novitasari', 'L', 'Bukittinggi', '2008-06-28', 'Gang Otto Iskandardinata No. 702, Palembang, Sumatera Utara 88028', '08386714610', '2025-07-27 07:08:28', '2025-07-27 07:08:28', NULL, '$2y$12$mJvF4be7xl1ObGAG9/ieZuRG38xKg82dfDloOY.2oQ3GTNG/MWgYe'),
(155, 6117987872, '4014747015', 'Kayun Mahendra', 'P', 'Banjar', '2010-06-20', 'Jalan Stasiun Wonokromo No. 693, Pasuruan, Sumatera Utara 48036', '08908840933', '2025-07-27 07:08:29', '2025-07-27 07:08:29', NULL, '$2y$12$yiHRPR7gYWLGfAuuxU06ZOM.bJzVOtKhBy5k9d3ry4wpJiOPaPRwi'),
(156, 7895770535, '5303680892', 'Belinda Suwarno', 'P', 'Kota Administrasi Jakarta Timur', '2006-11-06', 'Gg. Gegerkalong Hilir No. 000, Samarinda, KB 36819', '08866105801', '2025-07-27 07:08:29', '2025-07-27 07:08:29', NULL, '$2y$12$jaRsVbJzjh0n9EsUBwzkC.r9T307/eYVtkAnxKj4etHmUZBEIzSyW'),
(157, 1209166104, '7691391842', 'Eja Januar', 'L', 'Probolinggo', '2007-01-03', 'Jalan Joyoboyo No. 6, Sukabumi, Riau 37880', '08751478909', '2025-07-27 07:08:30', '2025-07-27 07:08:30', NULL, '$2y$12$kI3DzRnQSUXvcqWj89KyQeyxeQRVAmwp4UcIXc06kB5FpakPy8j5.'),
(158, 8185851575, '5030994772', 'Sutan Cager Firmansyah', 'L', 'Binjai', '2008-04-26', 'Gg. Cihampelas No. 5, Bogor, Papua 06862', '08615227228', '2025-07-27 07:08:30', '2025-07-27 07:08:30', NULL, '$2y$12$tF4MULk1Fxo5SwcDBsnmWupRJ26ux7LG43lNEusOOQiHzpT55W/C6'),
(159, 5392102915, '8559909138', 'Balamantri Wasita', 'L', 'Bekasi', '2009-12-27', 'Jl. Tebet Barat Dalam No. 7, Cimahi, YO 79975', '08735573916', '2025-07-27 07:08:31', '2025-07-27 07:08:31', NULL, '$2y$12$ZtdIVt3jzTpxZ2g1TM3XVeME8J.8tLYuIbJ0S6mjhf0uIn7Qy3HyK'),
(160, 5789311551, '1258794571', 'Emin Mayasari', 'P', 'Kupang', '2007-01-22', 'Gang Tebet Barat Dalam No. 35, Manado, KI 67509', '08713716106', '2025-07-27 07:08:31', '2025-07-27 07:08:31', NULL, '$2y$12$004wv5Ijl6CyTmn0.KXSMOe9bdVYlRUbT4u33uMxbaLeVuuIM3jmW'),
(161, 4291108399, '4176743487', 'Maida Nugroho', 'L', 'Pariaman', '2007-05-22', 'Gang Kapten Muslihat No. 673, Tanjungpinang, KR 48598', '08839176612', '2025-07-27 07:08:32', '2025-07-27 07:08:32', NULL, '$2y$12$W.7YFYfGHyDOM11XlVCGrOVQ5.Fhh1wV4T8dvD.TFrLOkp7SlKgoy'),
(162, 1085289478, '7896984677', 'Paris Napitupulu', 'P', 'Pagaralam', '2006-08-05', 'Jl. Jamika No. 80, Bekasi, RI 43792', '08489237606', '2025-07-27 07:08:32', '2025-07-27 07:08:32', NULL, '$2y$12$mzeuxAmMWJXERTTMSbABGu.bJ/Qw7DH3gh8RBxezMlOd6Efv02R4a'),
(163, 6526800855, '7116712262', 'Kenzie Dongoran, M.Kom.', 'L', 'Denpasar', '2008-12-19', 'Gg. Kutisari Selatan No. 3, Tebingtinggi, SR 54503', '08641400500', '2025-07-27 07:08:33', '2025-07-27 07:08:33', NULL, '$2y$12$jh5fKdc6xIm752fx5knma.zpDWNEVoGWnoRsPX9OCZdpMmaKLSVmO'),
(164, 8143659473, '8567800843', 'Luwar Padmasari', 'P', 'Bandar Lampung', '2006-10-08', 'Jl. Pasteur No. 707, Tebingtinggi, Sulawesi Barat 42367', '08310856237', '2025-07-27 07:08:33', '2025-07-27 07:08:33', NULL, '$2y$12$KqMXIckXHcxfMyO8/SlOBeo0u5icuV5jaSOHxiwtu4MYGSj/O2Xxe'),
(165, 4575551830, '3850634923', 'KH. Hartaka Nasyidah, S.Pt', 'P', 'Yogyakarta', '2007-03-29', 'Gang Cempaka No. 8, Bekasi, NT 74859', '08133777272', '2025-07-27 07:08:34', '2025-07-27 07:08:34', NULL, '$2y$12$/6CiZF.IOvNQLeTbFUj5AuqwH9T7fXTHBJdi4g46bBYE.r6tcufle'),
(166, 9175298108, '7968641960', 'Zalindra Permata, S.Ked', 'L', 'Blitar', '2006-07-28', 'Jl. Ciumbuleuit No. 13, Probolinggo, JA 64864', '08616670105', '2025-07-27 07:08:34', '2025-07-27 07:08:34', NULL, '$2y$12$OfDWq9gnRmFOIpfNNStxt.idsP6qGXXD2al6/aTnX5XMq70Navlo.'),
(167, 9056640582, '9311071407', 'drg. Anom Palastri, M.Kom.', 'P', 'Tanjungpinang', '2010-02-28', 'Gg. Joyoboyo No. 68, Gorontalo, SR 18619', '08763977661', '2025-07-27 07:08:35', '2025-07-27 07:08:35', NULL, '$2y$12$g.dKNpt4Ksh.UsUHw.xM4OprxoCZawWeq4ITLRi8L/xtccGrkQrpy'),
(168, 5893363158, '6994015708', 'Teddy Prasasta', 'L', 'Lubuklinggau', '2010-04-07', 'Gang Raya Setiabudhi No. 999, Kediri, Nusa Tenggara Timur 65757', '08522162602', '2025-07-27 07:08:35', '2025-07-27 07:08:35', NULL, '$2y$12$EyCy2tWrb9QJLbW.tyGfP.sKmKLU9245QVS2IyXAG96ICmKewOI.m'),
(169, 9305987451, '6516733042', 'Bambang Nuraini', 'P', 'Magelang', '2007-12-25', 'Gang Peta No. 515, Cilegon, Kalimantan Barat 82726', '08347553691', '2025-07-27 07:08:36', '2025-07-27 07:08:36', NULL, '$2y$12$LqAUpH7QuTfudi/rGm0ZGO9tsMUH65DjvE/PMiOGPBfuGoPHpA/8m'),
(170, 4069153747, '3253432254', 'Kasiyah Mardhiyah', 'L', 'Tangerang', '2007-09-04', 'Gg. HOS. Cokroaminoto No. 292, Kendari, Papua Barat 40288', '08337311006', '2025-07-27 07:08:36', '2025-07-27 07:08:36', NULL, '$2y$12$pYIo4bLHWqgrL01CCJTu6.768aeNevgClhilH41PR2ce24KqoHpE6'),
(171, 3826526040, '9692887689', 'Rusman Winarno', 'P', 'Sungai Penuh', '2007-02-04', 'Gang Kebonjati No. 21, Batu, SU 06332', '08389596836', '2025-07-27 07:08:36', '2025-07-27 07:08:36', NULL, '$2y$12$lNCffh94YMSF5iqjHEwlz.E7Scs9Mb8uXK6el.Mz28wjdINuPGqZS'),
(172, 4200891971, '8232343421', 'Natalia Sitompul', 'P', 'Blitar', '2010-04-13', 'Jalan W.R. Supratman No. 734, Bau-Bau, SU 41015', '08429914482', '2025-07-27 07:08:37', '2025-07-27 07:08:37', NULL, '$2y$12$JQUcNtmFlzLWCoi.2KmY8utAHU08rMjG0z2R1g.iLcXBNxK8pXN52'),
(173, 9141314082, '7599034381', 'Dr. Gaduh Suwarno, S.Pt', 'P', 'Gorontalo', '2010-04-22', 'Gang Bangka Raya No. 19, Yogyakarta, BE 12224', '08743073428', '2025-07-27 07:08:37', '2025-07-27 07:08:37', NULL, '$2y$12$syWsqmFWvezoQrB/wQPx1OJnSsKwLPPm7WCpm85/aHpg4ing.C/iC'),
(174, 5330849016, '1234129766', 'T. Banawa Pangestu', 'P', 'Kediri', '2009-07-28', 'Gang Kutai No. 21, Kota Administrasi Jakarta Pusat, Kalimantan Barat 81634', '08676656799', '2025-07-27 07:08:38', '2025-07-27 07:08:38', NULL, '$2y$12$lek.8LPfgOaIr0cpKJ/2FuE1BwUfVb8xwCXVPNCoqvn00kfTVK1y6'),
(175, 8533519769, '9361237741', 'Pia Waskita, S.I.Kom', 'L', 'Banjarbaru', '2008-05-29', 'Gang Kapten Muslihat No. 4, Langsa, Sulawesi Tengah 24995', '08878913825', '2025-07-27 07:08:38', '2025-07-27 07:08:38', NULL, '$2y$12$NaDKARfilKrs2fukjkWlxOzCa1THvdswajYaVe8mGFh2GLuiRpi6W'),
(176, 8215443688, '1716622503', 'Soleh Agustina', 'L', 'Prabumulih', '2008-01-11', 'Jl. Jend. A. Yani No. 5, Medan, BA 15466', '08888314426', '2025-07-27 07:08:39', '2025-07-27 07:08:39', NULL, '$2y$12$DG1vLlRBdn.j6ikbyBuI3OaCAB0twCUIot0aw578VdSOns5ltrSEO'),
(177, 4981237887, '7729906077', 'Salwa Hutasoit', 'P', 'Ambon', '2006-09-23', 'Jl. Gegerkalong Hilir No. 769, Sabang, KB 97878', '08822982816', '2025-07-27 07:08:39', '2025-07-27 07:08:39', NULL, '$2y$12$7JgW7Tk.tuM8gw04Vp5R0OtV5F9E4Wps5WOEBkuCvEipW5tZb9quS'),
(178, 9897964883, '3221376598', 'Cakrawala Kurniawan', 'P', 'Palu', '2009-08-06', 'Jalan Joyoboyo No. 406, Madiun, Maluku Utara 02271', '08262247563', '2025-07-27 07:08:40', '2025-07-27 07:08:40', NULL, '$2y$12$/U2d8VNcBmJrxAj4TO1mpOg5eAHK2cdDDL.ykheMkNF4UhcqBKHTK'),
(179, 2867071484, '5936509442', 'Rahayu Widodo', 'L', 'Padang Sidempuan', '2008-08-16', 'Gg. Sukabumi No. 7, Metro, Sumatera Selatan 67436', '08623757941', '2025-07-27 07:08:40', '2025-07-27 07:08:40', NULL, '$2y$12$zM7JQKTzKDhzZU2RDeog4.05JvmOuWQTDldq0xE0mO/aXIRQW8zgq'),
(180, 9295738321, '6713579517', 'Azalea Nugroho', 'L', 'Pangkalpinang', '2010-02-05', 'Gang Pasir Koja No. 3, Padang Sidempuan, SU 39998', '08772683275', '2025-07-27 07:08:41', '2025-07-27 07:08:41', NULL, '$2y$12$BHM4hRqjtP661CndP4/KteFpm2xxNGX6j6CFj6x2FAQ0cZe2JJpe6'),
(181, 6827731573, '1277299523', 'T. Ozy Wijaya', 'P', 'Gorontalo', '2008-12-18', 'Jl. Joyoboyo No. 61, Jambi, MU 87180', '08841721181', '2025-07-27 07:08:41', '2025-07-27 07:08:41', NULL, '$2y$12$gswErqKxOXNRhBxCUb/h0e/dPNQkXYksDcR.Hpjg5gzonAqTrlESa'),
(182, 3832039813, '5285846721', 'Dr. Tari Zulaika, S.Ked', 'L', 'Jayapura', '2007-11-22', 'Gg. Indragiri No. 3, Balikpapan, Maluku 06191', '08274381692', '2025-07-27 07:08:41', '2025-07-27 07:08:41', NULL, '$2y$12$VNC/CTDAMV5Y5ykKt0YkCeCM8K0FDEEL7Ox/zpjkN1mzoK.85EcYe'),
(183, 1383827364, '5180331700', 'Jarwadi Prasasta', 'L', 'Kota Administrasi Jakarta Pusat', '2007-08-05', 'Jl. Siliwangi No. 536, Bontang, BE 23894', '08236960623', '2025-07-27 07:08:42', '2025-07-27 07:08:42', NULL, '$2y$12$HRU6c6cFxFLHGTZ8A/I5cOyKCQ88C3jbsmeZTtYBZFhk3OlLWTtM6'),
(184, 3734765338, '2950738447', 'Cayadi Hartati', 'L', 'Ambon', '2010-07-24', 'Jalan Indragiri No. 6, Makassar, NB 54070', '08629027879', '2025-07-27 07:08:42', '2025-07-27 07:08:42', NULL, '$2y$12$ExZIR58G.QYcVbuI1Gd.iugbcWsGS5qZMKDUP1VAILycX66s6OvdS'),
(185, 5258089464, '5345432218', 'Tgk. Nadine Zulaika, M.TI.', 'P', 'Parepare', '2008-07-23', 'Jalan Setiabudhi No. 6, Banjarmasin, KR 19996', '08101025708', '2025-07-27 07:08:43', '2025-07-27 07:08:43', NULL, '$2y$12$SbygGGCOXw0r5bteYFKTWemAfzagrz0BcFOrwLNaAaAFFl07/pGfa'),
(186, 2558289485, '6779265200', 'Restu Samosir, S.H.', 'P', 'Surabaya', '2006-08-28', 'Gg. Kutisari Selatan No. 722, Palopo, Jawa Tengah 34515', '08796195257', '2025-07-27 07:08:43', '2025-07-27 07:08:43', NULL, '$2y$12$YiTf1QOx2xe0EyYjqsLfde7aaqz24OuG3jba/gSz6pnqqxRC4gJmO'),
(187, 2664755201, '8213209587', 'Mulyanto Ardianto', 'L', 'Metro', '2007-02-08', 'Jalan Cempaka No. 7, Surabaya, PA 33646', '08481724316', '2025-07-27 07:08:44', '2025-07-27 07:08:44', NULL, '$2y$12$3vHkrWl2E1j8FS.yb0ZA2.XSsRlb4PZPOhtIRu2XRsZBJ45uB5j.2'),
(188, 1812033826, '4229949066', 'Gawati Hutagalung', 'P', 'Langsa', '2007-12-11', 'Jl. Jakarta No. 8, Sungai Penuh, JK 02863', '08907570839', '2025-07-27 07:08:44', '2025-07-27 07:08:44', NULL, '$2y$12$XaKeQdFuTgvlZgB4O0GhYeKKTyWdNVI4frEi8InvT.RUU3uNGuWc2'),
(189, 2979629521, '1794074022', 'Martana Waskita', 'L', 'Kota Administrasi Jakarta Selatan', '2010-04-10', 'Gang Cikapayang No. 730, Bukittinggi, GO 63091', '08922461435', '2025-07-27 07:08:45', '2025-07-27 07:08:45', NULL, '$2y$12$l3KFSb1J0W3iPzrJ7L3g3OrU2YIIHQD8Hw1c7m.KCXtn5B1M3WPD2'),
(190, 5856489831, '7719590055', 'Embuh Pranowo, S.H.', 'P', 'Tebingtinggi', '2008-07-08', 'Jalan Erlangga No. 52, Prabumulih, Jambi 38286', '08156592916', '2025-07-27 07:08:45', '2025-07-27 07:08:45', NULL, '$2y$12$RdlTMYesnSfEMgjKWjjKpeL3bmfzbEcflciwcbEaSbQwQO1qIQZMu');
INSERT INTO `siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `created_at`, `updated_at`, `deleted_at`, `password`) VALUES
(191, 2793998480, '1233709229', 'Tugiman Halimah', 'P', 'Banjar', '2008-03-22', 'Gang Jend. A. Yani No. 6, Kupang, KR 00785', '08255807193', '2025-07-27 07:08:45', '2025-07-27 07:08:45', NULL, '$2y$12$Cf1pQCoxopEO2a0R9E9LluwmtjeQ5DbljLktqoQCnet5XZuHwzyqi'),
(192, 8286798554, '7931302732', 'drg. Mahesa Hutasoit, S.Kom', 'P', 'Bengkulu', '2006-07-29', 'Gg. H.J Maemunah No. 795, Madiun, JI 49023', '08453809705', '2025-07-27 07:08:46', '2025-07-27 07:08:46', NULL, '$2y$12$yhKO0DzyBKoTraCmBa1h4u5iwbDaD3hp.JBrFSLdz/5IHkrLw.sMW'),
(193, 8900250456, '2460496293', 'Winda Prabowo', 'L', 'Meulaboh', '2009-12-31', 'Jl. R.E Martadinata No. 19, Gorontalo, KS 27081', '08482196368', '2025-07-27 07:08:46', '2025-07-27 07:08:46', NULL, '$2y$12$jw8RjxysbvAE7LbCwpSCE.ropY4Z5KZ1DnO5QI2BIf0XDVVOoMdQu'),
(194, 2510544765, '8476315771', 'dr. Aisyah Anggriawan', 'P', 'Medan', '2008-08-12', 'Gang Abdul Muis No. 0, Blitar, SN 63079', '08111197975', '2025-07-27 07:08:47', '2025-07-27 07:08:47', NULL, '$2y$12$3r60LB.PMNx063lkzWU18OOuQM04J.fsk6YqiCjqeL0tZUS/n6xJu'),
(195, 6056923700, '3134471538', 'Latika Pranowo', 'L', 'Blitar', '2007-06-11', 'Gang Rawamangun No. 13, Makassar, Sumatera Selatan 58412', '08508748596', '2025-07-27 07:08:47', '2025-07-27 07:08:47', NULL, '$2y$12$KxKLQgZPTJ4i1pgZRNyEzOfPddCooRAW2PUj6xYfKQjKq6n7C6vly'),
(196, 3818109716, '9921470623', 'Yunita Sihotang', 'P', 'Banda Aceh', '2009-07-05', 'Jalan Moch. Toha No. 578, Gorontalo, Kalimantan Barat 80751', '08527477796', '2025-07-27 07:08:48', '2025-07-27 07:08:48', NULL, '$2y$12$AZ/nGq2JZLxUglkivtL6JubZqhU2rjObDRNJSklOEttYSBt3jVlr2'),
(197, 1502569492, '2240236797', 'Gaman Saputra', 'P', 'Ternate', '2009-09-10', 'Jalan Tubagus Ismail No. 20, Pekalongan, Sumatera Selatan 28235', '08850036938', '2025-07-27 07:08:49', '2025-07-27 07:08:49', NULL, '$2y$12$TSwGVgEEmj8YIVYmwF5kDeOLEq9kblNaF1ULuGw/2yarlhIrMnIci'),
(198, 7172746154, '2259227930', 'Ulva Sihombing', 'P', 'Banda Aceh', '2007-07-20', 'Gang Pasir Koja No. 1, Samarinda, MA 80261', '08771952238', '2025-07-27 07:08:49', '2025-07-27 07:08:49', NULL, '$2y$12$ObebSiTngQ0jb6CoxT7GOekB53rDVHawPAo0FymGMTg/19VM9Xbs6'),
(199, 5787676933, '5383674733', 'Dr. Paris Utami, S.Kom', 'L', 'Kota Administrasi Jakarta Pusat', '2007-03-11', 'Gang Cihampelas No. 71, Kota Administrasi Jakarta Barat, SN 94432', '08987804459', '2025-07-27 07:08:49', '2025-07-27 07:08:49', NULL, '$2y$12$1aVlaNJujW0ytIIzcKfeS.VfL3qbTxii3wGVBjwKHZyKult3oSk4y'),
(200, 7027229386, '2195337700', 'drg. Hasna Andriani', 'L', 'Yogyakarta', '2007-09-18', 'Gang Dipenogoro No. 51, Kota Administrasi Jakarta Selatan, Sulawesi Barat 36205', '08950573402', '2025-07-27 07:08:50', '2025-07-27 07:08:50', NULL, '$2y$12$e5EsIPNrCyEOMURYfpI4g.Afd1wwPlMUJC7CqiqWQafXLOfqzQ.Ua'),
(201, 3597432051, '6613193321', 'Gasti Simbolon', 'P', 'Cimahi', '2007-05-08', 'Jalan Veteran No. 406, Purwokerto, KR 83727', '08797301743', '2025-07-27 07:08:50', '2025-07-27 07:08:50', NULL, '$2y$12$XanHxVvmzS/ulrZmHXn46ucYCHe2xbuwOW83HyxzQaRMzLZ1ymWJu'),
(202, 7282929346, '2752255899', 'Gawati Hidayat', 'P', 'Tual', '2009-06-15', 'Jalan Jend. Sudirman No. 600, Tidore Kepulauan, Bali 42204', '08530856679', '2025-07-27 07:08:51', '2025-07-27 07:08:51', NULL, '$2y$12$6bdaIUkrQ5PkzDAaPmLhv.XhDsoBr2jUvnKO7.lvFvlnsAPqwy25i'),
(203, 5277202556, '5569186206', 'Jinawi Rajasa', 'L', 'Solok', '2008-08-29', 'Jl. Kutisari Selatan No. 05, Padang Sidempuan, Kalimantan Utara 57787', '08926984479', '2025-07-27 07:08:51', '2025-07-27 07:08:51', NULL, '$2y$12$otApLWREnI79Y6RtLrsDAeg5//7/7T3taVSnUFc4hDKm0lQFGNh62'),
(204, 3248386513, '8752972893', 'Unggul Januar', 'P', 'Pangkalpinang', '2008-10-25', 'Gang Rawamangun No. 6, Tomohon, JT 54396', '08622893732', '2025-07-27 07:08:52', '2025-07-27 07:08:52', NULL, '$2y$12$ELwUeU0pmDQXQ6CJ4nYTBeuzVV6PSujx4yHLVbC/1XJi93wJWlLZS'),
(205, 8094190661, '1353961084', 'Uda Prastuti', 'P', 'Palu', '2008-04-04', 'Jalan HOS. Cokroaminoto No. 1, Pasuruan, Papua 35900', '08617897296', '2025-07-27 07:08:52', '2025-07-27 07:08:52', NULL, '$2y$12$fKExlneb.laldILfse9mx.IWcfs.lyYweR.Pmx.cxFVGuB33oDXJW'),
(206, 6294965091, '3664002789', 'Amalia Dongoran, S.Farm', 'L', 'Dumai', '2007-02-10', 'Jl. Gedebage Selatan No. 026, Parepare, BT 89661', '08342986540', '2025-07-27 07:08:53', '2025-07-27 07:08:53', NULL, '$2y$12$/Olp8WeYeuaKoqjrXpvRnOqCmFpeKBtPnpLjxViwrc5jDCKsQPzXq'),
(207, 8610658868, '8919622499', 'Devi Hariyah', 'L', 'Banjarbaru', '2009-02-26', 'Jl. R.E Martadinata No. 189, Bima, GO 53657', '08548681672', '2025-07-27 07:08:53', '2025-07-27 07:08:53', NULL, '$2y$12$P4qHf892Gw0YjPSSB45VH.bv.ZgQMNDsCS9R53uOhFLRR.EqZyJ.6'),
(208, 8082985801, '3229845610', 'Umi Novitasari', 'P', 'Pematangsiantar', '2007-05-11', 'Jalan Sadang Serang No. 35, Palopo, JT 08800', '08426244892', '2025-07-27 07:08:54', '2025-07-27 07:08:54', NULL, '$2y$12$uBugEBP3ONpa1CDyrk7BheYufcYPuKSjYwHOUCEEVr/9KkRR0yuxa'),
(209, 3774862545, '9646558843', 'Asmadi Pradana', 'L', 'Bau-Bau', '2007-11-05', 'Jalan Merdeka No. 06, Bandar Lampung, JI 91951', '08775859790', '2025-07-27 07:08:54', '2025-07-27 07:08:54', NULL, '$2y$12$UdHo8EUvU3oP0uXTyQ1YBOM2SM3hRpCOEUySL3ik2uT27Achenbfe'),
(210, 7434183797, '2432859546', 'Ida Putra, M.Farm', 'P', 'Bima', '2007-06-03', 'Jl. Jamika No. 79, Singkawang, JT 12550', '08388982925', '2025-07-27 07:08:55', '2025-07-27 07:08:55', NULL, '$2y$12$vg0UsrRcuZ9vuvtovVo0K.neSppkJLoBdzLz4cxAHRv1/Z/a.lNG2'),
(211, 6500234041, '5266404785', 'Wakiman Thamrin', 'P', 'Bima', '2007-11-28', 'Jl. Cikapayang No. 0, Purwokerto, Jawa Barat 35531', '08945845873', '2025-07-27 07:08:55', '2025-07-27 07:08:55', NULL, '$2y$12$feNWOxaFV/ts/tsmSFg3BubxMQ8jFseKVj6gX9CWZTiyQ1dml4VPm'),
(212, 5482214471, '3150189356', 'Pia Jailani', 'L', 'Kupang', '2009-04-28', 'Gg. W.R. Supratman No. 846, Palu, BT 17591', '08411666986', '2025-07-27 07:08:56', '2025-07-27 07:08:56', NULL, '$2y$12$Jr9ou3JoqSUfCvoh9JoFguBJLYYsskJiqxk/zey5sFt7OtdRuiuLm'),
(213, 3457608425, '8907079272', 'Dr. Praba Lazuardi', 'P', 'Kota Administrasi Jakarta Selatan', '2007-09-24', 'Jalan Pacuan Kuda No. 311, Batu, Kalimantan Barat 05527', '08989092788', '2025-07-27 07:08:56', '2025-07-27 07:08:56', NULL, '$2y$12$7yR8dbTVeGQM9vKNKwmtNusjnP80cJDxJFi0gxsQ.M2gk7AXjVl3m'),
(214, 7821334331, '1243227831', 'Dt. Akarsana Prayoga, S.Ked', 'P', 'Palangkaraya', '2010-05-12', 'Jl. Lembong No. 62, Ternate, LA 08517', '08812164400', '2025-07-27 07:08:57', '2025-07-27 07:08:57', NULL, '$2y$12$0pO3oanzI72fQEtqWsL3dO5vmgecNLtx4HGNUYazaJPHA0xP43/ze'),
(215, 1583362382, '9957778545', 'Zizi Rahayu, S.Ked', 'L', 'Meulaboh', '2006-10-08', 'Gang Rajawali Timur No. 349, Lhokseumawe, MU 26676', '08487684503', '2025-07-27 07:08:57', '2025-07-27 07:08:57', NULL, '$2y$12$D6RRinUypnM/IgP.vX7gv.BVwQtZAM9wG1dc4S38UhQFTemGfCzJu'),
(216, 7041581810, '2899630557', 'Drs. Wahyu Rajasa', 'P', 'Magelang', '2010-02-27', 'Jl. Soekarno Hatta No. 667, Malang, SU 78475', '08837865427', '2025-07-27 07:08:58', '2025-07-27 07:08:58', NULL, '$2y$12$hFIrDkLEQ7dJiKquTPZ7huTYv/Pp3T0evXvV91juJmFN75EuhnwUO'),
(217, 4037224553, '7390683799', 'Heru Nuraini', 'P', 'Salatiga', '2007-01-14', 'Gg. Erlangga No. 92, Parepare, SS 65611', '08546432413', '2025-07-27 07:08:58', '2025-07-27 07:08:58', NULL, '$2y$12$9PLvq7g/S43R0Ccjx0pqqutLsTa.MIF/etTf8eoyzM9fgLKHHsozi'),
(218, 1800813149, '8519099676', 'Mitra Siregar', 'L', 'Subulussalam', '2010-01-12', 'Jl. M.H Thamrin No. 5, Blitar, BT 38918', '08996975119', '2025-07-27 07:08:59', '2025-07-27 07:08:59', NULL, '$2y$12$CdLDY/6.3a4OpDtGNGQNgOCHOHgeFt7v3uFGQi8StCE9FXlqlITTy'),
(219, 7224181779, '4103414713', 'Hasan Wastuti', 'L', 'Tanjungbalai', '2009-02-13', 'Jl. Otto Iskandardinata No. 512, Kotamobagu, KU 96816', '08234508346', '2025-07-27 07:08:59', '2025-07-27 07:08:59', NULL, '$2y$12$8zGM9U0VPUrmSGTaDMP4u.5CbFrakPKnOL7U.Uf93gP2VRcc82mC6'),
(220, 8658449081, '5168592531', 'Mumpuni Salahudin, S.Kom', 'L', 'Cirebon', '2006-12-31', 'Gang Rumah Sakit No. 994, Batam, JA 04177', '08718961418', '2025-07-27 07:09:00', '2025-07-27 07:09:00', NULL, '$2y$12$ZYDpA6Mc7CJQkEjHq4lzLOCriSpe6NcRDQKuKJjLxaPSXStCZ9P4y'),
(221, 2351530199, '1843109752', 'Mujur Agustina', 'P', 'Banda Aceh', '2007-08-02', 'Gang Raya Setiabudhi No. 19, Meulaboh, Kalimantan Barat 50888', '08294098918', '2025-07-27 07:09:00', '2025-07-27 07:09:00', NULL, '$2y$12$lAt8fwA566LvTQcoEEoUvuKWDNgEkabRwkCTPCRiqFhxJtBWzjHC6'),
(222, 7123499448, '7566162936', 'Yunita Hidayanto', 'P', 'Kota Administrasi Jakarta Barat', '2009-08-18', 'Jalan Moch. Toha No. 60, Batu, Sumatera Utara 43312', '08160066796', '2025-07-27 07:09:01', '2025-07-27 07:09:01', NULL, '$2y$12$YQBLERczZFwVYsBvi3xCWe25iYU9GP61ssao06UwX587ebaQc9xbm'),
(223, 5374393570, '8175301403', 'Drs. Prima Hutasoit, S.IP', 'P', 'Bogor', '2009-11-01', 'Jl. Dr. Djunjunan No. 2, Padangpanjang, BB 14253', '08581427781', '2025-07-27 07:09:01', '2025-07-27 07:09:01', NULL, '$2y$12$5LCitQOornpWa7vF6eQ8d.q5Mft.hf31/LL/rKByeZ6noXdjObakm'),
(224, 2199583965, '1207747928', 'Adinata Andriani', 'P', 'Denpasar', '2010-03-20', 'Jalan BKR No. 7, Bengkulu, PA 12973', '08952193857', '2025-07-27 07:09:02', '2025-07-27 07:09:02', NULL, '$2y$12$LEq7eMsINDd5r8EqGOjOpulGqFJcxV.TcXnZEdUfsjF5WBIWzZ1t2'),
(225, 9376572713, '2646570338', 'Unggul Wahyuni', 'L', 'Bandung', '2009-10-23', 'Gg. Wonoayu No. 58, Manado, Jambi 46383', '08315270830', '2025-07-27 07:09:03', '2025-07-27 07:09:03', NULL, '$2y$12$RGhuOpGdtluA7.Bej7IymuOGHqTChJzL.gP8Sw11X6ETr4H5UEAhO'),
(226, 9659936667, '3334521090', 'Tiara Narpati', 'P', 'Kediri', '2009-10-23', 'Jl. Rajawali Timur No. 276, Payakumbuh, YO 42578', '08511590630', '2025-07-27 07:09:03', '2025-07-27 07:09:03', NULL, '$2y$12$k6EtmZiJgaAwGbBDC5Q0Z.7ZUNoVbDtn8RkSBOxy0GzkvYiDz9YJO'),
(227, 7242632400, '2256762590', 'Uda Salahudin, S.Kom', 'P', 'Gorontalo', '2009-06-10', 'Gg. Moch. Ramdan No. 885, Depok, Kepulauan Riau 55513', '08158166242', '2025-07-27 07:09:03', '2025-07-27 07:09:03', NULL, '$2y$12$IuCz9/mQUlFCjUDBjAyGn.q/n6s0rGiFesRjzpu6eFfwvYu33.ree'),
(228, 9658295893, '3144980918', 'Drs. Cici Hassanah', 'P', 'Padang', '2007-08-13', 'Gg. Rungkut Industri No. 262, Banda Aceh, Riau 49381', '08606219946', '2025-07-27 07:09:04', '2025-07-27 07:09:04', NULL, '$2y$12$dxz708E87MiRQscQGdr2SurINMlGyQ7fjzzuaQoFokKjfW4RwcQry'),
(229, 4136611164, '2263580654', 'Heryanto Puspasari, S.E.', 'L', 'Bandar Lampung', '2010-03-16', 'Gang Ronggowarsito No. 2, Banda Aceh, BA 01583', '08669541568', '2025-07-27 07:09:04', '2025-07-27 07:09:04', NULL, '$2y$12$itsEvoC/wDFvgvzUGcb5EONqJ5Ejchh20Ybrb.KIfBVptxl7zBoCS'),
(230, 6785687920, '2015623146', 'Lala Yuniar, S.Gz', 'L', 'Blitar', '2009-10-22', 'Jalan HOS. Cokroaminoto No. 7, Bandung, Maluku Utara 68420', '08304729710', '2025-07-27 07:09:05', '2025-07-27 07:09:05', NULL, '$2y$12$7Kygngq52QiH7PNWW8TpcOSLHpvKe5PoJZtcgqZ2Oxv6MMbLCaZ.G'),
(231, 8162833411, '6039284428', 'Parman Najmudin', 'P', 'Mojokerto', '2007-11-22', 'Gang BKR No. 2, Tangerang, DKI Jakarta 06430', '08715719411', '2025-07-27 07:09:05', '2025-07-27 07:09:05', NULL, '$2y$12$Soge3d/TF9aW/WzN5lbW2uJ1wRicMdP1pLWYdza7WQrtgJvWSwe/C'),
(232, 3038323589, '5471317298', 'Gadang Uwais', 'P', 'Tual', '2007-08-23', 'Jl. Cikutra Barat No. 98, Madiun, Sulawesi Tengah 39810', '08387768300', '2025-07-27 07:09:06', '2025-07-27 07:09:06', NULL, '$2y$12$pa4f0TFx0JFFbYKoGtNRteqh7t0.SkIuehRsiKMoNzllPBbbUxLKK'),
(233, 9640587711, '2543521778', 'Drs. Gilda Budiman', 'L', 'Pekanbaru', '2007-05-07', 'Gg. Wonoayu No. 71, Samarinda, NT 02384', '08964233613', '2025-07-27 07:09:06', '2025-07-27 07:09:06', NULL, '$2y$12$muC3Esqz2b2XmpXqNybGbOmJi3UK/caRVFjX4DzWx3gSEHthe3/ru'),
(234, 5421642314, '1888564984', 'drg. Kajen Hutapea, S.Psi', 'P', 'Magelang', '2007-02-13', 'Jl. PHH. Mustofa No. 6, Tegal, Aceh 22063', '08573830583', '2025-07-27 07:09:07', '2025-07-27 07:09:07', NULL, '$2y$12$4veQW/863ktxaSiIavq4pu7WYZcYtbFTOV/Mw8w5o.ku9B7vo.uSa'),
(235, 3726780186, '4802375093', 'Maya Nugroho', 'L', 'Denpasar', '2010-02-10', 'Gang Medokan Ayu No. 463, Semarang, SG 32217', '08667145019', '2025-07-27 07:09:07', '2025-07-27 07:09:07', NULL, '$2y$12$lmpwzs9l8eTq.hE/KqTGdenPDcJASjRmr1B6O8k15PmSH6pN6Zcai'),
(236, 7264259680, '1984686520', 'Jaiman Pradana', 'L', 'Medan', '2008-07-02', 'Gang Rajawali Barat No. 5, Sibolga, LA 97581', '08138450011', '2025-07-27 07:09:08', '2025-07-27 07:09:08', NULL, '$2y$12$Nx6ytW3UgTR7bPtsqGAPJ.Vg0bWdpfY7flq9alXsyYupuKLYZ0/kq'),
(237, 9728607567, '9381813734', 'Eman Nainggolan', 'P', 'Samarinda', '2009-06-11', 'Jalan Ahmad Dahlan No. 172, Tarakan, Kalimantan Barat 83669', '08322475520', '2025-07-27 07:09:08', '2025-07-27 07:09:08', NULL, '$2y$12$q52oQIrlyHF.CgAqVJJbiuQ.9G39c48BJDGLFTFvkVzsjSv1Tt7Wy'),
(238, 6619548098, '3983984098', 'Usyi Ardianto', 'P', 'Prabumulih', '2010-04-16', 'Gg. Waringin No. 867, Metro, Sulawesi Tengah 57325', '08977160768', '2025-07-27 07:09:09', '2025-07-27 07:09:09', NULL, '$2y$12$YMlf/oMbNcwZY.JoDq9H5euU7359PWKPXUjbEUjB5YOAl1Px3XVF.'),
(239, 4248077583, '7239685821', 'Irsad Laksmiwati, S.IP', 'P', 'Batam', '2007-07-13', 'Gang Jend. Sudirman No. 1, Makassar, KB 89683', '08100409327', '2025-07-27 07:09:09', '2025-07-27 07:09:09', NULL, '$2y$12$x4xGFdOBZWpLRWOkhhMfEevF4rRXNgd9I7ygaUbGk5bGilS8g95uO'),
(240, 9630087315, '5587004889', 'Sakti Kuswoyo', 'L', 'Ambon', '2008-07-10', 'Gg. Monginsidi No. 764, Tidore Kepulauan, Jawa Tengah 83565', '08654447187', '2025-07-27 07:09:10', '2025-07-27 07:09:10', NULL, '$2y$12$j9ynj7GczHH6wuLT3cI97.s28FQiJYydCoHEvd0QbkfJGceUTpGKO'),
(241, 8593680348, '9902676439', 'Warji Mansur', 'P', 'Batam', '2009-07-01', 'Gang Kapten Muslihat No. 86, Sorong, SN 59096', '08181277910', '2025-07-27 07:09:10', '2025-07-27 07:09:10', NULL, '$2y$12$nEcF5o6sFqcdlRYVwt2jkuA60xWQp.YkmjrhtYguvlEWAHqnbAoSG'),
(242, 4357478115, '2511884775', 'Xanana Salahudin', 'L', 'Sabang', '2008-07-12', 'Gang Astana Anyar No. 3, Tarakan, LA 74022', '08880579466', '2025-07-27 07:09:11', '2025-07-27 07:09:11', NULL, '$2y$12$V99VfP.Lwyv6NYLnh9OIS.sR4lvBVAJhcLlGDrBHuJU19t.ilqHoG'),
(243, 7239936061, '8084949815', 'Dr. Lantar Mandala, M.M.', 'P', 'Kota Administrasi Jakarta Barat', '2009-04-05', 'Gg. Ahmad Dahlan No. 4, Sibolga, PB 56000', '08131208538', '2025-07-27 07:09:11', '2025-07-27 07:09:11', NULL, '$2y$12$pziscqmlL16Nplh80Zt7/eCvpsBvlxLoMV3jxr0vKutu1Q2Aqbusy'),
(244, 5254625290, '8134155054', 'Tirta Pranowo', 'L', 'Sungai Penuh', '2007-06-13', 'Jl. Pacuan Kuda No. 38, Manado, Nusa Tenggara Barat 33024', '08145794054', '2025-07-27 07:09:12', '2025-07-27 07:09:12', NULL, '$2y$12$UwFEnnNyMWuL99dlXqWRqOD.TDSWYhyBWWMpuxAVjGjxYxSiVchVa'),
(245, 1420564214, '2142874162', 'Gabriella Prabowo', 'P', 'Palu', '2008-08-20', 'Gang Siliwangi No. 9, Bekasi, Jawa Tengah 11804', '08851915548', '2025-07-27 07:09:12', '2025-07-27 07:09:12', NULL, '$2y$12$blIOUzTzPWVF49XTJ81.h..eMmgWG3pmXaxJl49jboynZHarsAb4.'),
(246, 5645021127, '7786577598', 'Yunita Wijaya', 'P', 'Sibolga', '2006-09-02', 'Jalan KH Amin Jasuta No. 452, Magelang, JA 55817', '08796368865', '2025-07-27 07:09:13', '2025-07-27 07:09:13', NULL, '$2y$12$WPhETZL9v/OoYOKoqxPfme8EYOzbzaLLFXWl890ZyYh5TMIBwFfIW'),
(247, 9349943250, '6315206559', 'Maya Waluyo', 'P', 'Pangkalpinang', '2007-09-04', 'Gg. Pasir Koja No. 685, Kupang, Kepulauan Riau 69472', '08178549283', '2025-07-27 07:09:14', '2025-07-27 07:09:14', NULL, '$2y$12$SDkCitLctGQm9AHs.a3NkO1nHTGSOiYdIZBP1CBerxI7KCxmUvaAW'),
(248, 8332175560, '1913465917', 'Genta Januar', 'L', 'Lhokseumawe', '2007-09-01', 'Jalan Raya Setiabudhi No. 17, Tanjungpinang, ST 11229', '08601560648', '2025-07-27 07:09:14', '2025-07-27 07:09:14', NULL, '$2y$12$WvaOlDeoBtkwJCF9GmuC5OIO88qlf7IqR8V6HV78S7wgHSNeHr7q2'),
(249, 5495281529, '8046922030', 'Kemba Prasetya', 'P', 'Cimahi', '2008-09-19', 'Jalan Ronggowarsito No. 5, Jayapura, Nusa Tenggara Barat 10671', '08176604409', '2025-07-27 07:09:15', '2025-07-27 07:09:15', NULL, '$2y$12$61HAgYWXexmXJzQf4NBq2uhSIcAl78hEwywKqhN8PfF9HLugw4Ylq'),
(250, 6189934839, '2741617336', 'Gading Nuraini', 'L', 'Pariaman', '2006-08-11', 'Jl. Siliwangi No. 168, Kediri, Gorontalo 64374', '08937288844', '2025-07-27 07:09:15', '2025-07-27 07:09:15', NULL, '$2y$12$9Pn.VjjAq9VyNdG7syfUreUYyKzX8n2Hdv6QO4DXHzqlnRIvXJHh2'),
(251, 7374154243, '1579726248', 'Elon Rajata', 'P', 'Pekalongan', '2007-03-06', 'Jalan Suryakencana No. 482, Tasikmalaya, KT 27044', '08973043562', '2025-07-27 07:09:15', '2025-07-27 07:09:15', NULL, '$2y$12$9Nd9asw23SObdKPD62KBTe2OdWsjwDCNgKrze/FPcg.QeHB2ylwbW'),
(252, 8833367531, '2967657911', 'Ir. Clara Winarno', 'L', 'Semarang', '2009-03-08', 'Gg. Setiabudhi No. 1, Pangkalpinang, Nusa Tenggara Timur 21496', '08912510357', '2025-07-27 07:09:16', '2025-07-27 07:09:16', NULL, '$2y$12$18eb6w96FQOT2SdaF.u2h.uHMBkdyajbAApMQrTMgQlRkjEMND/me'),
(253, 7731934213, '1636829327', 'Dr. Widya Hutagalung', 'L', 'Kota Administrasi Jakarta Utara', '2008-11-26', 'Gang Yos Sudarso No. 00, Cilegon, KB 87970', '08647599638', '2025-07-27 07:09:16', '2025-07-27 07:09:16', NULL, '$2y$12$8Mqm1KF3A39NPyO64qHsTeUJodHIf3kK0DkwCOvFNjsPwVU3mdXKC'),
(254, 9369944532, '9050523200', 'Halim Puspasari', 'P', 'Palembang', '2010-02-24', 'Jl. M.H Thamrin No. 87, Semarang, KI 59084', '08794750531', '2025-07-27 07:09:17', '2025-07-27 07:09:17', NULL, '$2y$12$BezDV6doLWKqkS57XKyiFuFQXYjp6ZY90x1QFdPjCq8B0gehJD1Hi'),
(255, 5837170730, '6851938296', 'Niyaga Prasetya', 'L', 'Pangkalpinang', '2010-06-22', 'Gg. Veteran No. 16, Bima, SG 55804', '08315671132', '2025-07-27 07:09:17', '2025-07-27 07:09:17', NULL, '$2y$12$hBRrOcy2tLvVr1lHXvn5gOpWeHcvrEpmxFiHBA3rv24ld/QtCuudq'),
(256, 3463685135, '8164041510', 'Endah Zulaika', 'P', 'Mojokerto', '2009-09-22', 'Gang Setiabudhi No. 6, Tarakan, Sumatera Barat 98450', '08535425047', '2025-07-27 07:09:18', '2025-07-27 07:09:18', NULL, '$2y$12$scDNFB5vIru7qvAtN.PEFeG4ZzAKSKRhU5XjtwZ7GJdRNt3ldSK2C'),
(257, 4568072470, '9673888145', 'Zahra Hutasoit', 'L', 'Sukabumi', '2009-09-16', 'Gg. W.R. Supratman No. 8, Bontang, Sumatera Utara 52517', '08941456096', '2025-07-27 07:09:18', '2025-07-27 07:09:18', NULL, '$2y$12$zEJ7SYJIOrnaiJWmWWllROIZZAp.2VQJKZasRN6UhsDcPkiPPhnaK'),
(258, 9584390982, '5033509302', 'Dr. Harja Prasetyo', 'P', 'Kotamobagu', '2008-08-28', 'Jl. Kiaracondong No. 2, Probolinggo, NT 76527', '08394746374', '2025-07-27 07:09:19', '2025-07-27 07:09:19', NULL, '$2y$12$1z8b5IGKB9mbjYNIvEVb2OSaJg0ksxrXdZhPBAhJmKc2jPMft4FMm'),
(259, 8481176325, '3739633529', 'Parman Sirait', 'P', 'Dumai', '2008-09-28', 'Jl. Waringin No. 943, Sibolga, BB 47133', '08955477301', '2025-07-27 07:09:19', '2025-07-27 07:09:19', NULL, '$2y$12$rigGD6TmR/mUbH81PUC0M.NYwSqx6C5MxtDAzehktroE5wDb78lMe'),
(260, 9920095593, '6828580970', 'Laila Sihombing, M.TI.', 'L', 'Pasuruan', '2009-04-27', 'Jl. Sentot Alibasa No. 6, Sungai Penuh, SU 37785', '08129580458', '2025-07-27 07:09:20', '2025-07-27 07:09:20', NULL, '$2y$12$04OY.VE/0mN9ZxgcKXfyEOThaPa4D5EiwBAtCfvwsbQz2xSWPIk7C'),
(261, 8774017086, '7387021735', 'Lanjar Maryadi', 'L', 'Pasuruan', '2008-07-02', 'Gg. Cempaka No. 173, Tual, KS 22925', '08587377600', '2025-07-27 07:09:20', '2025-07-27 07:09:20', NULL, '$2y$12$0hxcRT7LMV03A/NrAsOV0uBN6C/0mI/eNlvX6Sdu4aHfC94V3DNzm'),
(262, 1341033193, '7543505358', 'Hartana Samosir', 'L', 'Bandung', '2009-04-27', 'Jl. Pelajar Pejuang No. 79, Bengkulu, Kepulauan Bangka Belitung 49525', '08633138975', '2025-07-27 07:09:21', '2025-07-27 07:09:21', NULL, '$2y$12$lv06gvbNr.lwVD8b8GTdVuSa/E2J.4ZnDfZkb10oR1buhh2iZ31T.'),
(263, 7720319160, '9149839712', 'Vinsen Pratiwi', 'P', 'Tebingtinggi', '2006-12-06', 'Gang Jamika No. 207, Bitung, Banten 19995', '08748639856', '2025-07-27 07:09:21', '2025-07-27 07:09:21', NULL, '$2y$12$yD3ZzwFQNh9Auikvh891B.p26iHJ6YZM0FFyx91UONZ1Tmd59akSm'),
(264, 8279716072, '4565410345', 'Maya Prakasa, S.Farm', 'L', 'Bengkulu', '2009-04-08', 'Gg. M.T Haryono No. 28, Pariaman, Kepulauan Bangka Belitung 32201', '08912068074', '2025-07-27 07:09:21', '2025-07-27 07:09:21', NULL, '$2y$12$aVkkYuWWDnvSDroJVaNQ0umtrcIYSc.bKQXFGorO0VzLgnnA0AqQi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_tidak_aktif`
--

CREATE TABLE `siswa_tidak_aktif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa_tidak_aktif`
--

INSERT INTO `siswa_tidak_aktif` (`id`, `siswa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2025-07-27 11:07:46', '2025-07-27 11:07:46', NULL),
(2, 2, '2025-07-27 11:07:46', '2025-07-27 11:07:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `semester` enum('ganjil','genap') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id`, `tahun`, `semester`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024/2025', 'ganjil', 1, '2025-07-25 11:51:07', '2025-07-25 11:51:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'guru',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `deleted_at`) VALUES
(1, 'sayaa', 'admin@gmail.com', NULL, '$2y$12$6j0dmUt0KIFuxiM/1Yp80.4/wWs9hOM8gRGZMwv9CGvvRgcwNZjre', NULL, '2025-07-25 06:33:03', '2025-07-25 06:33:03', 'admin', NULL),
(2, 'dadad', 'aghilshiroj129@gmail.com', NULL, '$2y$12$6yOiEvuhj2IPYOaqPrG2X.K1sZvpsbbCx90BkUzjChgVkU1bHvspi', NULL, '2025-07-25 11:54:05', '2025-07-25 11:54:05', 'guru', NULL),
(3, '3331112', 'agil@gmail.com', NULL, '$2y$12$4a164Xp/sn1PA/VlaZYlqeIjvyJ2RqQQaI0wrm8lBK7Mc0FLvXjm6', NULL, '2025-07-27 08:44:49', '2025-07-27 08:44:49', 'guru', NULL),
(4, 'Aghil', 'lutfi@gmail.com', NULL, '$2y$12$F9.oyCdJRDYZNlA8DMLeYOUlaZkxCk6JeHmU5atT8/Th/JAayfcDa', NULL, '2025-07-27 13:18:34', '2025-07-27 13:18:34', 'bk', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_jadwal_id_foreign` (`jadwal_id`),
  ADD KEY `absensi_siswa_id_foreign` (`siswa_id`),
  ADD KEY `absensi_guru_id_foreign` (`guru_id`);

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_kelas_id_foreign` (`kelas_id`),
  ADD KEY `detail_tahun_akademik_id_foreign` (`tahun_akademik_id`),
  ADD KEY `detail_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `detail_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `guru_user_id_unique` (`user_id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_guru_id_foreign` (`guru_id`),
  ADD KEY `jadwal_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `jadwal_tahun_akademik_id_foreign` (`tahun_akademik_id`),
  ADD KEY `jadwal_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `jadwal_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`);

--
-- Indeks untuk tabel `siswa_tidak_aktif`
--
ALTER TABLE `siswa_tidak_aktif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_tidak_aktif_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT untuk tabel `siswa_tidak_aktif`
--
ALTER TABLE `siswa_tidak_aktif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_tahun_akademik_id_foreign` FOREIGN KEY (`tahun_akademik_id`) REFERENCES `tahun_akademik` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_tahun_akademik_id_foreign` FOREIGN KEY (`tahun_akademik_id`) REFERENCES `tahun_akademik` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_tidak_aktif`
--
ALTER TABLE `siswa_tidak_aktif`
  ADD CONSTRAINT `siswa_tidak_aktif_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
