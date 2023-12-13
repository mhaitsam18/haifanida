-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 08:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haifanida`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi_artikel` text DEFAULT NULL,
  `gambar_sampul` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_publikasi` timestamp NULL DEFAULT NULL,
  `jumlah_pembaca` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(255) DEFAULT NULL,
  `sumber_referensi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_berkas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_jemaah`
--

CREATE TABLE `berkas_jemaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jemaah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `berkas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` enum('tertunda','diverifikasi','ditolak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_rombongan` varchar(255) DEFAULT NULL,
  `nomor_polisi` varchar(255) DEFAULT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `kapasitas` varchar(255) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus_jemaah`
--

CREATE TABLE `bus_jemaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jemaah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_kursi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perwakilan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `surat_izin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekstra`
--

CREATE TABLE `ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ekstra` varchar(255) DEFAULT NULL,
  `harga_default` double(16,2) DEFAULT NULL,
  `jenis_ekstra` enum('perlengkapan','jasa','permintaan kamar','tipe kamar','pesawat') DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstra`
--

INSERT INTO `ekstra` (`id`, `nama_ekstra`, `harga_default`, `jenis_ekstra`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Perlengkapan', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22'),
(2, 'Koper', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22'),
(3, 'Batik Kain', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22'),
(4, 'Blazer Batik', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(5, 'Kemeja Batik Pria', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(6, 'Kemeja Batik Wanita', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(7, 'Gamis Batik', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(8, 'Rok Merah Maroon', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(9, 'Kerudung Merah Maroon', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(10, 'Celana Merah Maroon', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(11, 'Perlengkapan Ihrom', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(12, 'Kain Ihrom', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(13, 'Sabuk Ihrom', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(14, 'Tas Selempang', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(15, 'Tas Ransel', 1000000.00, 'perlengkapan', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(16, 'Pembuatan Paspor', 1000000.00, 'jasa', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(17, 'Pesawat Class Business', 1000000.00, 'pesawat', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(18, 'Pesawat Class Eksekutif', 1000000.00, 'pesawat', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(19, 'Kamar View Kakbah', 1000000.00, 'permintaan kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(20, 'Kamar View Masjid Nabawi', 1000000.00, 'permintaan kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(21, 'tipe kamar quad gabung', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(22, 'tipe kamar quad keluarga', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(23, 'tipe kamar quad keluarga isi 3 dan 1 bed kosong', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(24, 'tipe kamar double gabung', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(25, 'tipe kamar double keluarga', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23'),
(26, 'tipe kamar single', 1000000.00, 'tipe kamar', NULL, '2023-12-13 07:20:23', '2023-12-13 07:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `jenis` enum('gambar','video') NOT NULL DEFAULT 'gambar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_grup` varchar(255) DEFAULT NULL,
  `keterangan_grup` text DEFAULT NULL,
  `status_grup` varchar(255) DEFAULT NULL,
  `kuota_grup` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_hotel` varchar(255) DEFAULT NULL,
  `nama_hotel` varchar(255) DEFAULT NULL,
  `bintang` enum('0','1','2','3','4','5','6','7') DEFAULT NULL,
  `bintang_setaraf` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `link_gmaps` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `isu_perjalanan`
--

CREATE TABLE `isu_perjalanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `masalah` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `tanggal_pelaporan` timestamp NULL DEFAULT NULL,
  `tanggal_penyelesaian` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jemaah`
--

CREATE TABLE `jemaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `grup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mahram_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_ktp` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nama_sesuai_paspor` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `kewarganegaraan` enum('WNI','WNA') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `tingkat_pendidikan` enum('SD','SLTP','SLTA','D1/D2/D3','D4/S1','S2','S3') DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `nomor_paspor` varchar(255) DEFAULT NULL,
  `tempat_dikeluarkan` varchar(255) DEFAULT NULL,
  `tanggal_dikeluarkan` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `pernah_umroh` tinyint(1) DEFAULT NULL,
  `pernah_haji` tinyint(1) DEFAULT NULL,
  `hubungan_mahram` enum('Orang Tua','Anak','Suami','Saudara Kandung','Kakek','Cucu','Paman','Keponakan') DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `kontak_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `kabupaten`, `provinsi_id`, `created_at`, `updated_at`) VALUES
(1, 'Kabupaten Aceh Barat', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(2, 'Kabupaten Aceh Barat Daya', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(3, 'Kabupaten Aceh Besar', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(4, 'Kabupaten Aceh Jaya', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(5, 'Kabupaten Aceh Selatan', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(6, 'Kabupaten Aceh Singkil', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(7, 'Kabupaten Aceh Tamiang', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(8, 'Kabupaten Aceh Tengah', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(9, 'Kabupaten Aceh Tenggara', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(10, 'Kabupaten Aceh Timur', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(11, 'Kabupaten Aceh Utara', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(12, 'Kabupaten Bener Meriah', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(13, 'Kabupaten Bireuer', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(14, 'Kabupaten Gayo Lues', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(15, 'Kabupaten Nagan Raya', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(16, 'Kabupaten Pidie', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(17, 'Kabupaten Pidie Jaya', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(18, 'Kabupaten Simeulue', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(19, 'Kota Banda Aceh', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(20, 'Kota Langsa', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(21, 'Kota Lhokseumawe', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(22, 'Kota Sabang', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(23, 'Kota Subulussalam', 1, '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(24, 'Kabupaten Asahan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(25, 'Kabupaten Batu Bara', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(26, 'Kabupaten Dairi', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(27, 'Kabupaten Deli Serdang', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(28, 'Kabupaten Humbang Hasundutan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(29, 'Kabupaten Karo', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(30, 'Kabupaten Labuhanbatu', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(31, 'Kabupaten Labuhanbatu Selatan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(32, 'Kabupaten Labuhanbatu Utara', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(33, 'Kabupaten Langkat', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(34, 'Kabupaten Mandailing Natal', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(35, 'Kabupaten Nias', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(36, 'Kabupaten Nias Barat', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(37, 'Kabupaten Nias Selatan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(38, 'Kabupaten Nias Utara', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(39, 'Kabupaten Padang Lawas', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(40, 'Kabupaten Padang Lawas Utara', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(41, 'Kabupaten Pakpak Bharat', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(42, 'Kabupaten Samosir', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(43, 'Kabupaten Serdang Bedagai', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(44, 'Kabupaten Simalungun', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(45, 'Kabupaten Tapanuli Selatan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(46, 'Kabupaten Tapanuli Tengah', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(47, 'Kabupaten Tapanuli Utara', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(48, 'Kabupaten Toba', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(49, 'Kota Binjai', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(50, 'Kota Gunungsitoli', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(51, 'Kota Medan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(52, 'Kota Padangsidimpuan', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(53, 'Kota Pematangsiantar', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(54, 'Kota Sibolga', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(55, 'Kota Tanjungbalai', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(56, 'Kota Tebing Tinggi', 2, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(57, 'Kabupaten Agam', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(58, 'Kabupaten Dharmasraya', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(59, 'Kabupaten Kepulauan Mentawai', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(60, 'Kabupaten Lima Puluh Kota', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(61, 'Kabupaten Padang Pariaman', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(62, 'Kabupaten Pasaman', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(63, 'Kabupaten Pasaman Barat', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(64, 'Kabupaten Pesisir Selatan', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(65, 'Kabupaten Sijunjung', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(66, 'Kabupaten Solok', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(67, 'Kabupaten Solok Selatan', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(68, 'Kabupaten Tanah Datar', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(69, 'Kota Bukittinggi', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(70, 'Kota Padang', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(71, 'Kota Padang Panjang', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(72, 'Kota Pariaman', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(73, 'Kota Payakumbuh', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(74, 'Kota Sawahlunto', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(75, 'Kota Solok', 3, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(76, 'Kabupaten Bengkalis', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(77, 'Kabupaten Indragiri Hilir', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(78, 'Kabupaten Indragiri Hulu', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(79, 'Kabupaten Kampar', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(80, 'Kabupaten Kepulauan Meranti', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(81, 'Kabupaten Kuantan Singingi', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(82, 'Kabupaten Pelalawan', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(83, 'Kabupaten Rokan Hilir', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(84, 'Kabupaten Rokan Hulu', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(85, 'Kabupaten Siak', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(86, 'Kota Dumai', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(87, 'Kota Pekanbaru', 4, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(88, 'Kabupaten Batanghari', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(89, 'Kabupaten Bungo', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(90, 'Kabupaten Kerinci', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(91, 'Kabupaten Merangin', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(92, 'Kabupaten Muaro Jambi', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(93, 'Kabupaten Sarolangun', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(94, 'Kabupaten Tanjung Jabung Barat', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(95, 'Kabupaten Tanjung Jabung Timur', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(96, 'Kabupaten Tebo', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(97, 'Kota Jambi', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(98, 'Kota Sungai Penuh', 5, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(99, 'Kabupaten Banyuasin', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(100, 'Kabupaten Empat Lawang', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(101, 'Kabupaten Lahat', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(102, 'Kabupaten Muara Enim', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(103, 'Kabupaten Musi Banyuasin', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(104, 'Kabupaten Musi Rawas', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(105, 'Kabupaten Musi Rawas Utara', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(106, 'Kabupaten Ogan Ilir', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(107, 'Kabupaten Ogan Komering Ilir', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(108, 'Kabupaten Ogan Komering Ulu', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(109, 'Kabupaten Ogan Komering Ulu Selatan', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(110, 'Kabupaten Ogan Komering Ulu Timur', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(111, 'Kabupaten Penukal Abab Lematang Ilir', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(112, 'Kota Lubuk Linggau', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(113, 'Kota Pagaralam', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(114, 'Kota Palembang', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(115, 'Kota Prabumulih', 6, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(116, 'Kabupaten Bengkulu Selatan', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(117, 'Kabupaten Bengkulu Tengah', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(118, 'Kabupaten Bengkulu Utara', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(119, 'Kabupaten Kaur', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(120, 'Kabupaten Kepahiang', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(121, 'Kabupaten Lebong', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(122, 'Kabupaten Mukomuko', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(123, 'Kabupaten Rejang Lebong', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(124, 'Kabupaten Seluma', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(125, 'Kota Bengkulu', 7, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(126, 'Kabupaten Lampung Barat', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(127, 'Kabupaten Lampung Selatan', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(128, 'Kabupaten Lampung Tengah', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(129, 'Kabupaten Lampung Timur', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(130, 'Kabupaten Lampung Utara', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(131, 'Kabupaten Mesuji', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(132, 'Kabupaten Pesawaran', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(133, 'Kabupaten Pesisir Barat', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(134, 'Kabupaten Pringsewu', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(135, 'Kabupaten Tanggamus', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(136, 'Kabupaten Tulang Bawang', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(137, 'Kabupaten Tulang Bawang Barat', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(138, 'Kabupaten Way Kanan', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(139, 'Kota Bandar Lampung', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(140, 'Kota Metro', 8, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(141, 'Kabupaten Bangka', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(142, 'Kabupaten Bangka Barat', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(143, 'Kabupaten Bangka Selatan', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(144, 'Kabupaten Bangka Tengah', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(145, 'Kabupaten Belitung', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(146, 'Kabupaten Belitung Timur', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(147, 'Kota Pangkalpinang', 10, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(148, 'Kabupaten Bintan', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(149, 'Kabupaten Karimun', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(150, 'Kabupaten Kepulauan Anambas', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(151, 'Kabupaten Lingga', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(152, 'Kabupaten Natuna', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(153, 'Kota Batam', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(154, 'Kota Tanjungpinang', 9, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(155, 'Kabupaten Administrasi Kepulauan Seribu', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(156, 'Kota Administrasi Jakarta Barat', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(157, 'Kota Administrasi Jakarta Pusat', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(158, 'Kota Administrasi Jakarta Selatan', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(159, 'Kota Administrasi Jakarta Timur', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(160, 'Kota Administrasi Jakarta Utara', 11, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(161, 'Kabupaten Bandung', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(162, 'Kabupaten Bandung Barat', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(163, 'Kabupaten Bekasi', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(164, 'Kabupaten Bogor', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(165, 'Kabupaten Ciamis', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(166, 'Kabupaten Cianjur', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(167, 'Kabupaten Cirebon', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(168, 'Kabupaten Garut', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(169, 'Kabupaten Indramayu', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(170, 'Kabupaten Karawang', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(171, 'Kabupaten Kuningan', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(172, 'Kabupaten Majalengka', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(173, 'Kabupaten Pangandaran', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(174, 'Kabupaten Purwakarta', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(175, 'Kabupaten Subang', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(176, 'Kabupaten Sukabumi', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(177, 'Kabupaten Sumedang', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(178, 'Kabupaten Tasikmalaya', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(179, 'Kota Bandung', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(180, 'Kota Banjar', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(181, 'Kota Bekasi', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(182, 'Kota Bogor', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(183, 'Kota Cimahi', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(184, 'Kota Cirebon', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(185, 'Kota Depok', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(186, 'Kota Sukabumi', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(187, 'Kota Tasikmalaya', 12, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(188, 'Kabupaten Banjamegara', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(189, 'Kabupaten Banyumas', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(190, 'Kabupaten Batang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(191, 'Kabupaten Blora', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(192, 'Kabupaten Boyolali', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(193, 'Kabupaten Brebes', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(194, 'Kabupaten Cilacap', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(195, 'Kabupaten Demak', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(196, 'Kabupaten Grobogan', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(197, 'Kabupaten Jepara', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(198, 'Kabupaten Karanganyar', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(199, 'Kabupaten Kebumen', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(200, 'Kabupaten Kendal', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(201, 'Kabupaten Klaten', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(202, 'Kabupaten Kudus', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(203, 'Kabupaten Magelang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(204, 'Kabupaten Pati', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(205, 'Kabupaten Pekalongan', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(206, 'Kabupaten Pemalang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(207, 'Kabupaten Purbalingga', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(208, 'Kabupaten Purworejo', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(209, 'Kabupaten Rembang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(210, 'Kabupaten Semarang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(211, 'Kabupaten Sragen', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(212, 'Kabupaten Sukoharjo', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(213, 'Kabupaten Tegal', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(214, 'Kabupaten Temanggung', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(215, 'Kabupaten Wonogiri', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(216, 'Kabupaten Wonosobo', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(217, 'Kota Magelang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(218, 'Kota Pekalongan', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(219, 'Kota Salatiga', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(220, 'Kota Semarang', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(221, 'Kota Surakarta', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(222, 'Kota Tegal', 13, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(223, 'Kabupaten Bantul', 14, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(224, 'Kabupaten Gunungkidul', 14, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(225, 'Kabupaten Kulon Progo', 14, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(226, 'Kabupaten Sleman', 14, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(227, 'Kota Yogyakarta', 14, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(228, 'Kabupaten Bangkalan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(229, 'Kabupaten Banyuwangi', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(230, 'Kabupaten Blitar', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(231, 'Kabupaten Bojonegoro', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(232, 'Kabupaten Bondowoso', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(233, 'Kabupaten Gresik', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(234, 'Kabupaten Jember', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(235, 'Kabupaten Jombang', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(236, 'Kabupaten Kediri', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(237, 'Kabupaten Lamongan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(238, 'Kabupaten Lumajang', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(239, 'Kabupaten Madiun', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(240, 'Kabupaten Magetan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(241, 'Kabupaten Malang', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(242, 'Kabupaten Mojokerto', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(243, 'Kabupaten Nganjuk', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(244, 'Kabupaten Ngawi', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(245, 'Kabupaten Pacitan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(246, 'Kabupaten Pamekasan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(247, 'Kabupaten Pasuruan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(248, 'Kabupaten Ponorogo', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(249, 'Kabupaten Probolinggo', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(250, 'Kabupaten Sampang', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(251, 'Kabupaten Sidoarjo', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(252, 'Kabupaten Situbondo', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(253, 'Kabupaten Sumenep', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(254, 'Kabupaten Trenggalek', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(255, 'Kabupaten Tuban', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(256, 'Kabupaten Tulungagung', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(257, 'Kota Batu', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(258, 'Kota Blitar', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(259, 'Kota Kediri', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(260, 'Kota Madiun', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(261, 'Kota Malang', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(262, 'Kota Mojokerto', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(263, 'Kota Pasuruan', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(264, 'Kota Probolinggo', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(265, 'Kota Surabaya', 15, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(266, 'Kabupaten Lebak', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(267, 'Kabupaten Pandeglang', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(268, 'Kabupaten Serang', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(269, 'Kabupaten Tangerang', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(270, 'Kota Cilegon', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(271, 'Kota Serang', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(272, 'Kota Tangerang', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(273, 'Kota Tangerang Selatan', 16, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(274, 'Kabupaten Badung', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(275, 'Kabupaten Bangli', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(276, 'Kabupaten Buleleng', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(277, 'Kabupaten Gianyar', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(278, 'Kabupaten Jembrana', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(279, 'Kabupaten Karangasem', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(280, 'Kabupaten Klungkung', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(281, 'Kabupaten Tabanan', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(282, 'Kota Denpasar', 17, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(283, 'Kabupaten Bima', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(284, 'Kabupaten Dompu', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(285, 'Kabupaten Lombok Barat', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(286, 'Kabupaten Lombok Tengah', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(287, 'Kabupaten Lombok Timur', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(288, 'Kabupaten Lombok Utara', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(289, 'Kabupaten Sumbawa', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(290, 'Kabupaten Sumbawa Barat', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(291, 'Kota Bima', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(292, 'Kota Mataram', 18, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(293, 'Kabupaten Alor', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(294, 'Kabupaten Belu', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(295, 'Kabupaten Ende', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(296, 'Kabupaten Flores Timur', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(297, 'Kabupaten Kupang', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(298, 'Kabupaten Lembata', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(299, 'Kabupaten Malaka', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(300, 'Kabupaten Manggarai', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(301, 'Kabupaten Manggarai Barat', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(302, 'Kabupaten Manggarai Timur', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(303, 'Kabupaten Nagekeo', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(304, 'Kabupaten Ngada', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(305, 'Kabupaten Rote Ndao', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(306, 'Kabupaten Sabu Raijua', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(307, 'Kabupaten Sikka', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(308, 'Kabupaten Sumba Barat', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(309, 'Kabupaten Sumba Barat Daya', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(310, 'Kabupaten Sumba Tengah', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(311, 'Kabupaten Sumba Timur', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(312, 'Kabupaten Timor Tengah Selatan', 19, '2023-12-13 07:19:11', '2023-12-13 07:19:11'),
(313, 'Kabupaten Timor Tengah Utara', 19, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(314, 'Kota Kupang', 19, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(315, 'Kabupaten Bengkayang', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(316, 'Kabupaten Kapuas Hulu', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(317, 'Kabupaten Kayong Utara', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(318, 'Kabupaten Ketapang', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(319, 'Kabupaten Kubu Raya', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(320, 'Kabupaten Landak', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(321, 'Kabupaten Melawi', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(322, 'Kabupaten Mempawah', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(323, 'Kabupaten Sambas', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(324, 'Kabupaten Sanggau', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(325, 'Kabupaten Sekadau', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(326, 'Kabupaten Sintang', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(327, 'Kota Pontianak', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(328, 'Kota Singkawang', 20, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(329, 'Kabupaten Barito Selatan', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(330, 'Kabupaten Barito Timur', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(331, 'Kabupaten Barito Utara', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(332, 'Kabupaten Gunung Mas', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(333, 'Kabupaten Kapuas', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(334, 'Kabupaten Katingan', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(335, 'Kabupaten Kotawaringin Barat', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(336, 'Kabupaten Kotawaringin Timur', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(337, 'Kabupaten Lamandau', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(338, 'Kabupaten Murung Raya', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(339, 'Kabupaten Pulang Pisau', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(340, 'Kabupaten Seruyan', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(341, 'Kabupaten Sukamara', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(342, 'Kota Palangka Raya', 21, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(343, 'Kabupaten Balangan', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(344, 'Kabupaten Banjar', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(345, 'Kabupaten Barito Kuala', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(346, 'Kabupaten Hulu Sungai Selatan', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(347, 'Kabupaten Hulu Sungai Tengah', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(348, 'Kabupaten Hulu Sungai Utara', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(349, 'Kabupaten Kotabaru', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(350, 'Kabupaten Tabalong', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(351, 'Kabupaten Tanah Bumbu', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(352, 'Kabupaten Tanah Laut', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(353, 'Kabupaten Tapin', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(354, 'Kota Banjarbaru', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(355, 'Kota Banjarmasin', 22, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(356, 'Kabupaten Berau', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(357, 'Kabupaten Kutai Barat', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(358, 'Kabupaten Kutai Kartanegara', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(359, 'Kabupaten Kutai Timur', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(360, 'Kabupaten Mahakam Ulu', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(361, 'Kabupaten Paser', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(362, 'Kabupaten Penajam Paser Utara', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(363, 'Kota Balikpapan', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(364, 'Kota Bontang', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(365, 'Kota Samarinda', 23, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(366, 'Kabupaten Bulungan', 24, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(367, 'Kabupaten Malinau', 24, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(368, 'Kabupaten Nunukan', 24, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(369, 'Kabupaten Tana Tidung', 24, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(370, 'Kota Tarakan', 24, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(371, 'Kabupaten Bolaang Mongondow', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(372, 'Kabupaten Bolaang Mongondow Selatan', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(373, 'Kabupaten Bolaang Mongondow Timur', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(374, 'Kabupaten Bolaang Mongondow Utara', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(375, 'Kabupaten Kepulauan Sangihe', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(376, 'Kabupaten Kepulauan Siau Tagulandang Biaro', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(377, 'Kabupaten Kepulauan Talaud', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(378, 'Kabupaten Minahasa', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(379, 'Kabupaten Minahasa Selatan', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(380, 'Kabupaten Minahasa Tenggara', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(381, 'Kabupaten Minahasa Utara', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(382, 'Kota Bitung', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(383, 'Kota Kotamobagu', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(384, 'Kota Manado', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(385, 'Kota Tomohon', 25, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(386, 'Kabupaten Banggai', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(387, 'Kabupaten Banggai Kepulauan', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(388, 'Kabupaten Banggai Laut', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(389, 'Kabupaten Buol', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(390, 'Kabupaten Donggala', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(391, 'Kabupaten Morowali', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(392, 'Kabupaten Morowali Utara', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(393, 'Kabupaten Parigi Moutong', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(394, 'Kabupaten Poso', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(395, 'Kabupaten Sigi', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(396, 'Kabupaten Tojo Una-Una', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(397, 'Kabupaten Tolitoli', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(398, 'Kota Palu', 26, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(399, 'Kabupaten Bantaeng', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(400, 'Kabupaten Barru', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(401, 'Kabupaten Bone', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(402, 'Kabupaten Bulukumba', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(403, 'Kabupaten Enrekang', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(404, 'Kabupaten Gowa', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(405, 'Kabupaten Jeneponto', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(406, 'Kabupaten Kepulauan Selayar', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(407, 'Kabupaten Luwu', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(408, 'Kabupaten Luwu Timur', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(409, 'Kabupaten Luwu Utara', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(410, 'Kabupaten Maros', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(411, 'Kabupaten Pangkajene dan Kepulauan', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(412, 'Kabupaten Pinrang', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(413, 'Kabupaten Sidenreng Rappang', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(414, 'Kabupaten Sinjai', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(415, 'Kabupaten Soppeng', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(416, 'Kabupaten Takalar', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(417, 'Kabupaten Tana Toraja', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(418, 'Kabupaten Toraja Utara', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(419, 'Kabupaten Wajo', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(420, 'Kota Makassar', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(421, 'Kota Palopo', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(422, 'Kota Parepare', 27, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(423, 'Kabupaten Bombana', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(424, 'Kabupaten Buton', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(425, 'Kabupaten Buton Selatan', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(426, 'Kabupaten Buton Tengah', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(427, 'Kabupaten Buton Utara', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(428, 'Kabupaten Kolaka', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(429, 'Kabupaten Kolaka Timur', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(430, 'Kabupaten Kolaka Utara', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(431, 'Kabupaten Konawe', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(432, 'Kabupaten Konawe Kepulauan', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(433, 'Kabupaten Konawe Selatan', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(434, 'Kabupaten Konawe Utara', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(435, 'Kabupaten Muna', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(436, 'Kabupaten Muna Barat', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(437, 'Kabupaten Wakatobi', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(438, 'Kota Baubau', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(439, 'Kota Kendari', 28, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(440, 'Kabupaten Boalemo', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(441, 'Kabupaten Bone Bolango', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(442, 'Kabupaten Gorontalo', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(443, 'Kabupaten Gorontalo Utara', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(444, 'Kabupaten Pohuwato', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(445, 'Kota Gorontalo', 29, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(446, 'Kabupaten Majene', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(447, 'Kabupaten Mamasa', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(448, 'Kabupaten Mamuju', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(449, 'Kabupaten Mamuju Tengah', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(450, 'Kabupaten Pasangkayu', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(451, 'Kabupaten Polewali Mandar', 30, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(452, 'Kabupaten Buru', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(453, 'Kabupaten Buru Selatan', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(454, 'Kabupaten Kepulauan Aru', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(455, 'Kabupaten Kepulauan Tanimbar', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(456, 'Kabupaten Maluku Barat Daya', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(457, 'Kabupaten Maluku Tengah', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(458, 'Kabupaten Maluku Tenggara', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(459, 'Kabupaten Seram Bagian Barat', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(460, 'Kabupaten Seram Bagian Timur', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(461, 'Kota Ambon', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(462, 'Kota Tual', 31, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(463, 'Kabupaten Halmahera Barat', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(464, 'Kabupaten Halmahera Selatan', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(465, 'Kabupaten Halmahera Tengah', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(466, 'Kabupaten Halmahera Timur', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(467, 'Kabupaten Halmahera Utara', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(468, 'Kabupaten Kepulauan Sula', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(469, 'Kabupaten Pulau Morotai', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(470, 'Kabupaten Pulau Taliabu', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(471, 'Kota Ternate', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(472, 'Kota Tidore Kepulauan', 32, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(473, 'Kabupaten Biak Numfor', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(474, 'Kabupaten Jayapura', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(475, 'Kabupaten Keerom', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(476, 'Kabupaten Kepulauan Yapen', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(477, 'Kabupaten Mamberamo Raya', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(478, 'Kabupaten Sarmi', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(479, 'Kabupaten Supiori', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(480, 'Kabupaten Waropen', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(481, 'Kota Jayapura', 33, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(482, 'Kabupaten Fakfak', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(483, 'Kabupaten Kaimana', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(484, 'Kabupaten Manokwari', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(485, 'Kabupaten Manokwari Selatan', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(486, 'Kabupaten Pegunungan Arfak', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(487, 'Kabupaten Teluk Bintuni', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(488, 'Kabupaten Teluk Wondama', 34, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(489, 'Kabupaten Asmat', 35, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(490, 'Kabupaten Boven Digoel', 35, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(491, 'Kabupaten Mappi', 35, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(492, 'Kabupaten Merauke', 35, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(493, 'Kabupaten Deiyai', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(494, 'Kabupaten Dogiyai', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(495, 'Kabupaten Intan Jaya', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(496, 'Kabupaten Mimika', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(497, 'Kabupaten Nabire', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(498, 'Kabupaten Paniai', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(499, 'Kabupaten Puncak', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(500, 'Kabupaten Puncak Jaya', 36, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(501, 'Kabupaten Jayawijaya', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(502, 'Kabupaten Lanny Jaya', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(503, 'Kabupaten Mamberamo Tengah', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(504, 'Kabupaten Nduga', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(505, 'Kabupaten Pegunungan Bintang', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(506, 'Kabupaten Tolikara', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(507, 'Kabupaten Yalimo', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(508, 'Kabupaten Yahukimo', 37, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(509, 'Kabupaten Maybrat', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(510, 'Kabupaten Raja Ampat', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(511, 'Kabupaten Sorong', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(512, 'Kabupaten Sorong Selatan', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(513, 'Kabupaten Tambrauw', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12'),
(514, 'Kota Sorong', 38, '2023-12-13 07:19:12', '2023-12-13 07:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `kajian`
--

CREATE TABLE `kajian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `isi_kajian` text DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_publikasi` timestamp NULL DEFAULT NULL,
  `jumlah_pembaca` int(11) NOT NULL DEFAULT 0,
  `sumber_referensi` text DEFAULT NULL,
  `gambar_sampul` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_hotel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_kamar` varchar(255) DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `tersedia` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar_jemaah`
--

CREATE TABLE `kamar_jemaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kamar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jemaah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kantor` varchar(255) DEFAULT NULL,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `kontak_kantor` varchar(255) DEFAULT NULL,
  `alamat_kantor` varchar(255) DEFAULT NULL,
  `kabupaten_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `jenis_kantor` enum('pusat','perwakilan','cabang','agen') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id`, `nama_kantor`, `nama_ketua`, `kontak_kantor`, `alamat_kantor`, `kabupaten_id`, `kecamatan`, `kode_pos`, `jenis_kantor`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Pusat', NULL, NULL, 'Jl. RA. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315', 170, 'Karawang Barat', '41315', 'pusat', '2023-12-13 07:19:12', '2023-12-13 07:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi_konten` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_maskapai` varchar(255) NOT NULL,
  `nama_maskapai` varchar(255) DEFAULT NULL,
  `negara_asal` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`id`, `kode_maskapai`, `nama_maskapai`, `negara_asal`, `logo`, `deskripsi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'AA', 'American Airlines', 'Amerika Serikat', 'aa.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:14', '2023-12-13 07:19:14'),
(2, 'DL', 'Delta Air Lines', 'Amerika Serikat', 'dl.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Amerika Serikat', NULL, '2023-12-13 07:19:14', '2023-12-13 07:19:14'),
(3, 'UA', 'United Airlines', 'Amerika Serikat', 'ua.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Amerika Serikat', NULL, '2023-12-13 07:19:14', '2023-12-13 07:19:14'),
(4, 'WN', 'Southwest Airlines Co.', 'Kepulauan Terluar Kecil Amerika Serikat', 'wn.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:14', '2023-12-13 07:19:14'),
(5, 'CZ', 'China Southern Airlines', 'Cina', 'cz.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:14', '2023-12-13 07:19:14'),
(6, 'MU', 'China Eastern', 'Cina', 'mu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:15', '2023-12-13 07:19:15'),
(7, 'OO', 'SkyWest Airlines', 'Kepulauan Terluar Kecil Amerika Serikat', 'oo.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:15', '2023-12-13 07:19:15'),
(8, 'CA', 'Air China Limited', 'Cina', 'ca.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:15', '2023-12-13 07:19:15'),
(9, 'FX', 'Federal Express', 'Amerika Serikat', 'fx.png', 'Maskapai penerbangan dijadwalkan, kargo dari Amerika Serikat', NULL, '2023-12-13 07:19:15', '2023-12-13 07:19:15'),
(10, 'FR', 'Ryanair Ltd.', 'Irlandia', 'fr.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2023-12-13 07:19:16', '2023-12-13 07:19:16'),
(11, 'XE', 'Expressjet', 'Kepulauan Terluar Kecil Amerika Serikat', 'xe.png', 'Maskapai penerbangan  dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:16', '2023-12-13 07:19:16'),
(12, 'TK', 'THY - Turkish Airlines', 'Turki', 'tk.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2023-12-13 07:19:16', '2023-12-13 07:19:16'),
(13, 'LH', 'Lufthansa Cargo', 'Jerman', 'lh.png', 'Maskapai penerbangan dijadwalkan, kargo dari Jerman', NULL, '2023-12-13 07:19:16', '2023-12-13 07:19:16'),
(14, 'BA', 'British Airways', 'Britania Raya', 'ba.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:16', '2023-12-13 07:19:16'),
(15, 'EK', 'Emirates', 'Uni Emirat Arab', 'ek.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2023-12-13 07:19:17', '2023-12-13 07:19:17'),
(16, '5X', 'UPS Airlines', 'Amerika Serikat', '5x.png', 'Maskapai penerbangan muatan dari Amerika Serikat', NULL, '2023-12-13 07:19:17', '2023-12-13 07:19:17'),
(17, 'U2', 'Easyjet Airline Company Limited', 'Britania Raya', 'u2.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:17', '2023-12-13 07:19:17'),
(18, 'AF', 'Air France', 'Perancis', 'af.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2023-12-13 07:19:17', '2023-12-13 07:19:17'),
(19, 'B6', 'JetBlue', 'Amerika Serikat', 'b6.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:18', '2023-12-13 07:19:18'),
(20, 'NH', 'All Nippon Airways', 'Jepang', 'nh.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:19:18', '2023-12-13 07:19:18'),
(21, 'QR', 'Qatar Airways', 'Qatar', 'qr.png', 'Maskapai penerbangan dijadwalkan dari Qatar', NULL, '2023-12-13 07:19:18', '2023-12-13 07:19:18'),
(22, 'MQ', 'Envoy Air Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'mq.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:18', '2023-12-13 07:19:18'),
(23, 'SU', 'Aeroflot', 'Rusia', 'su.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:19', '2023-12-13 07:19:19'),
(24, 'ZH', 'Shenzhen Airlines', 'Cina', 'zh.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:19', '2023-12-13 07:19:19'),
(25, 'AC', 'Air Canada', 'Kanada', 'ac.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:19', '2023-12-13 07:19:19'),
(26, 'JJ', 'TAM Linhas Aereas', 'Brazil', 'jj.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2023-12-13 07:19:19', '2023-12-13 07:19:19'),
(27, 'JL', 'Japan Airlines', 'Jepang', 'jl.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:19:19', '2023-12-13 07:19:19'),
(28, 'KE', 'Korean Air', 'Korea Selatan', 'ke.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:19:20', '2023-12-13 07:19:20'),
(29, 'AS', 'Alaska Airlines', 'Amerika Serikat', 'as.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:20', '2023-12-13 07:19:20'),
(30, 'HU', 'Hainan Airlines', 'Cina', 'hu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:20', '2023-12-13 07:19:20'),
(31, 'SK', 'SAS', 'Swedia', 'sk.png', 'Maskapai penerbangan dijadwalkan dari Swedia', NULL, '2023-12-13 07:19:20', '2023-12-13 07:19:20'),
(32, 'GA', 'Garuda', 'Indonesia', 'ga.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:20', '2023-12-13 07:19:20'),
(33, 'CX', 'Cathay Pacific', 'Hongkong', 'cx.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2023-12-13 07:19:21', '2023-12-13 07:19:21'),
(34, 'RW', 'Republic Airlines', 'Amerika Serikat', 'rw.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:21', '2023-12-13 07:19:21'),
(35, 'SV', 'Saudi Arabian Airlines', 'Arab Saudi', 'sv.png', 'Maskapai penerbangan dijadwalkan dari Arab Saudi', NULL, '2023-12-13 07:19:21', '2023-12-13 07:19:21'),
(36, 'AD', 'Azul Brazilian Airlines', 'Brazil', 'ad.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2023-12-13 07:19:21', '2023-12-13 07:19:21'),
(37, 'MF', 'Xiamen Airlines', 'Cina', 'mf.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:22', '2023-12-13 07:19:22'),
(38, 'G3', 'Gol Linhas Aéreas Inteligentes\nGol Linhas Aéreas Inteligentes\n', 'Brazil', 'g3.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2023-12-13 07:19:22', '2023-12-13 07:19:22'),
(39, 'QK', 'Jazz Aviation LP', 'Kanada', 'qk.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:22', '2023-12-13 07:19:22'),
(40, 'EY', 'Etihad Airways', 'Uni Emirat Arab', 'ey.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2023-12-13 07:19:22', '2023-12-13 07:19:22'),
(41, 'LA', 'Lan Airlines', 'Chili', 'la.png', 'Maskapai penerbangan dijadwalkan dari Chili', NULL, '2023-12-13 07:19:23', '2023-12-13 07:19:23'),
(42, '9E', 'Endeavor Air', 'Kepulauan Terluar Kecil Amerika Serikat', '9e.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:23', '2023-12-13 07:19:23'),
(43, 'YV', 'Mesa Airlines, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'yv.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:23', '2023-12-13 07:19:23'),
(44, 'QF', 'Qantas', 'Australia', 'qf.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:23', '2023-12-13 07:19:23'),
(45, 'JT', 'Lion Airlines', 'Indonesia', 'jt.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:23', '2023-12-13 07:19:23'),
(46, 'WS', 'WestJet', 'Kanada', 'ws.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:24', '2023-12-13 07:19:24'),
(47, 'KL', 'KLM', 'Belanda', 'kl.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2023-12-13 07:19:24', '2023-12-13 07:19:24'),
(48, 'SQ', 'SIA Cargo', 'Singapura', 'sq.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2023-12-13 07:19:24', '2023-12-13 07:19:24'),
(49, 'OH', 'PSA Airlines', 'Amerika Serikat', 'oh.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:24', '2023-12-13 07:19:24'),
(50, 'AI', 'Air India', 'India', 'ai.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:19:25', '2023-12-13 07:19:25'),
(51, '3U', 'Sichuan Airlines', 'Cina', '3u.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:25', '2023-12-13 07:19:25'),
(52, '6E', 'Interglobe Aviation Ltd. dba Indigo', 'India', '6e.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:19:25', '2023-12-13 07:19:25'),
(53, 'VY', 'Vueling', 'Spanyol', 'vy.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:19:25', '2023-12-13 07:19:25'),
(54, 'AZ', 'Alitalia', 'Italia', 'az.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2023-12-13 07:19:25', '2023-12-13 07:19:25'),
(55, 'AV', 'AVIANCA', 'Kolumbia', 'av.png', 'Maskapai penerbangan dijadwalkan dari Kolumbia', NULL, '2023-12-13 07:19:26', '2023-12-13 07:19:26'),
(56, 'VA', 'Virgin Australia', 'Australia', 'va.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:26', '2023-12-13 07:19:26'),
(57, 'S5', 'Shuttle America', 'Kepulauan Terluar Kecil Amerika Serikat', 's5.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:26', '2023-12-13 07:19:26'),
(58, 'SC', 'Shandong Airlines', 'Cina', 'sc.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:26', '2023-12-13 07:19:26'),
(59, '9W', 'Jet Airways', 'India', '9w.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:19:26', '2023-12-13 07:19:26'),
(60, 'GS', 'Tianjin Airlines', 'Cina', 'gs.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:27', '2023-12-13 07:19:27'),
(61, 'VN', 'Vietnam Airlines', 'Vietnam', 'vn.png', 'Maskapai penerbangan dijadwalkan dari Vietnam', NULL, '2023-12-13 07:19:27', '2023-12-13 07:19:27'),
(62, 'CM', 'COPA Airlines', 'Panama', 'cm.png', 'Maskapai penerbangan dijadwalkan dari Panama', NULL, '2023-12-13 07:19:27', '2023-12-13 07:19:27'),
(63, 'FM', 'Shanghai Airlines', 'Cina', 'fm.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:27', '2023-12-13 07:19:27'),
(64, 'AB', 'Air Berlin', 'Jerman', 'ab.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:19:28', '2023-12-13 07:19:28'),
(65, 'OS', 'Austrian', 'Austria', 'os.png', 'Maskapai penerbangan dijadwalkan dari Austria', NULL, '2023-12-13 07:19:28', '2023-12-13 07:19:28'),
(66, 'NK', 'Spirit Airlines', 'Kepulauan Terluar Kecil Amerika Serikat', 'nk.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:28', '2023-12-13 07:19:28'),
(67, 'OZ', 'Asiana', 'Korea Selatan', 'oz.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:19:28', '2023-12-13 07:19:28'),
(68, 'CI', 'China Airlines', 'Cina Taipei', 'ci.png', 'Maskapai penerbangan dijadwalkan dari Cina Taipei', NULL, '2023-12-13 07:19:28', '2023-12-13 07:19:28'),
(69, 'G4', 'Allegiant Air LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'g4.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:29', '2023-12-13 07:19:29'),
(70, 'MH', 'Malaysia Airlines', 'Malaysia', 'mh.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2023-12-13 07:19:29', '2023-12-13 07:19:29'),
(71, 'AK', 'AirAsia Berhad dba AirAsia', 'Malaysia', 'ak.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2023-12-13 07:19:29', '2023-12-13 07:19:29'),
(72, 'TG', 'Thai Airways International', 'Thailand', 'tg.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:19:29', '2023-12-13 07:19:29'),
(73, 'IB', 'IBERIA', 'Spanyol', 'ib.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:19:30', '2023-12-13 07:19:30'),
(74, 'BE', 'flybe', 'Britania Raya', 'be.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:30', '2023-12-13 07:19:30'),
(75, 'ET', 'Ethiopian Airlines', 'Etiopia', 'et.png', 'Maskapai penerbangan dijadwalkan dari Etiopia', NULL, '2023-12-13 07:19:30', '2023-12-13 07:19:30'),
(76, 'JQ', 'Jetstar Airways Pty Limited', 'Australia', 'jq.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:30', '2023-12-13 07:19:30'),
(77, 'W6', 'Wizz Air Hungary Ltd.', 'Hungaria', 'w6.png', 'Maskapai penerbangan dijadwalkan dari Hungaria', NULL, '2023-12-13 07:19:30', '2023-12-13 07:19:30'),
(78, 'ZW', 'Air Wisconsin Airlines Corporation (AWAC)', 'Kepulauan Terluar Kecil Amerika Serikat', 'zw.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:31', '2023-12-13 07:19:31'),
(79, 'LX', 'SWISS', 'Swiss', 'lx.png', 'Maskapai penerbangan dijadwalkan dari Swiss', NULL, '2023-12-13 07:19:31', '2023-12-13 07:19:31'),
(80, 'AX', 'Trans States Airlines, LLC', 'Amerika Serikat', 'ax.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:31', '2023-12-13 07:19:31'),
(81, 'BR', 'EVA Air', 'Cina Taipei', 'br.png', 'Maskapai penerbangan dijadwalkan dari Cina Taipei', NULL, '2023-12-13 07:19:31', '2023-12-13 07:19:31'),
(82, 'S7', 'S7 Airlines', 'Rusia', 's7.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:32', '2023-12-13 07:19:32'),
(83, 'AM', 'Aeromexico', 'Meksiko', 'am.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:19:32', '2023-12-13 07:19:32'),
(84, '4O', 'Interjet', 'Meksiko', '4o.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:19:32', '2023-12-13 07:19:32'),
(85, '5D', 'Aerolitoral S.A. de C.V.', 'Meksiko', '5d.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:19:32', '2023-12-13 07:19:32'),
(86, 'JD', 'Capital Airlines', 'Cina', 'jd.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:32', '2023-12-13 07:19:32'),
(87, 'PC', 'Pegasus Airlines', 'Turki', 'pc.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2023-12-13 07:19:33', '2023-12-13 07:19:33'),
(88, 'UT', 'UTair', 'Rusia', 'ut.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:33', '2023-12-13 07:19:33'),
(89, 'BY', 'TUI Airways Limited', 'Britania Raya', 'by.png', 'Maskapai penerbangan dijadwalkan, piagam dari Britania Raya', NULL, '2023-12-13 07:19:33', '2023-12-13 07:19:33'),
(90, 'CP', 'Compass Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'cp.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:33', '2023-12-13 07:19:33'),
(91, 'TP', 'TAP Portugal', 'Portugal', 'tp.png', 'Maskapai penerbangan dijadwalkan dari Portugal', NULL, '2023-12-13 07:19:33', '2023-12-13 07:19:33'),
(92, 'VX', 'Virgin America', 'Amerika Serikat', 'vx.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:34', '2023-12-13 07:19:34'),
(93, 'Y4', 'Volaris', 'Meksiko', 'y4.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:19:34', '2023-12-13 07:19:34'),
(94, '4U', 'Germanwings GmbH', 'Jerman', '4u.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:19:34', '2023-12-13 07:19:34'),
(95, 'LS', 'Jet2.com Limited', 'Britania Raya', 'ls.png', 'Maskapai penerbangan dijadwalkan, kargo dari Britania Raya', NULL, '2023-12-13 07:19:34', '2023-12-13 07:19:34'),
(96, 'PR', 'Philippine Airlines', 'Filipina', 'pr.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2023-12-13 07:19:35', '2023-12-13 07:19:35'),
(97, '9C', 'Spring Airlines Limited Corporation', 'Cina', '9c.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:35', '2023-12-13 07:19:35'),
(98, 'F9', 'Frontier Airlines, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'f9.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:35', '2023-12-13 07:19:35'),
(99, '5J', 'Cebu Pacific Air', 'Filipina', '5j.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2023-12-13 07:19:35', '2023-12-13 07:19:35'),
(100, 'DY', 'Norwegian Air Shuttle A.S.', 'Norway', 'dy.png', 'Maskapai penerbangan dijadwalkan dari Norway', NULL, '2023-12-13 07:19:36', '2023-12-13 07:19:36'),
(101, 'MS', 'Egyptair', 'Mesir', 'ms.png', 'Maskapai penerbangan dijadwalkan dari Mesir', NULL, '2023-12-13 07:19:36', '2023-12-13 07:19:36'),
(102, 'NZ', 'Air New Zealand', 'Selandia Baru', 'nz.png', 'Maskapai penerbangan dijadwalkan dari Selandia Baru', NULL, '2023-12-13 07:19:36', '2023-12-13 07:19:36'),
(103, 'AR', 'Aerolineas Argentinas', 'Argentina', 'ar.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2023-12-13 07:19:36', '2023-12-13 07:19:36'),
(104, 'G7', 'GoJet Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'g7.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:37', '2023-12-13 07:19:37'),
(105, 'UX', 'Air Europa', 'Spanyol', 'ux.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:19:37', '2023-12-13 07:19:37'),
(106, 'QX', 'Horizon Air Industries, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'qx.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:37', '2023-12-13 07:19:37'),
(107, 'SA', 'SAA', 'Afrika Selatan', 'sa.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2023-12-13 07:19:37', '2023-12-13 07:19:37'),
(108, 'ZL', 'REX Regional Express', 'Australia', 'zl.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:38', '2023-12-13 07:19:38'),
(109, 'AH', 'Air Algerie', 'Aljazair', 'ah.png', 'Maskapai penerbangan dijadwalkan dari Aljazair', NULL, '2023-12-13 07:19:38', '2023-12-13 07:19:38'),
(110, 'AY', 'Finnair', 'Pulau Aland', 'ay.png', 'Maskapai penerbangan dijadwalkan dari Pulau Aland', NULL, '2023-12-13 07:19:38', '2023-12-13 07:19:38'),
(111, 'CL', 'Lufthansa CityLine', 'Jerman', 'cl.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:19:38', '2023-12-13 07:19:38'),
(112, 'FV', 'Rossiya Airlines', 'Rusia', 'fv.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:39', '2023-12-13 07:19:39'),
(113, 'FZ', 'flydubai', 'Uni Emirat Arab', 'fz.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2023-12-13 07:19:39', '2023-12-13 07:19:39'),
(114, 'HO', 'Juneyao Airlines', 'Cina', 'ho.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:39', '2023-12-13 07:19:39'),
(115, 'IW', 'PT. Wings Abadi Airlines', 'Indonesia', 'iw.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:40', '2023-12-13 07:19:40'),
(116, 'SN', 'Brussels Airlines', 'Belgium', 'sn.png', 'Maskapai penerbangan dijadwalkan dari Belgium', NULL, '2023-12-13 07:19:40', '2023-12-13 07:19:40'),
(117, 'W5', 'Mahan Air', 'Iran', 'w5.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2023-12-13 07:19:40', '2023-12-13 07:19:40'),
(118, 'AT', 'Royal Air Maroc', 'Maroko', 'at.png', 'Maskapai penerbangan dijadwalkan dari Maroko', NULL, '2023-12-13 07:19:40', '2023-12-13 07:19:40'),
(119, 'EI', 'Aer Lingus', 'Irlandia', 'ei.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2023-12-13 07:19:41', '2023-12-13 07:19:41'),
(120, 'FD', 'Thai AirAsia', 'Thailand', 'fd.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:19:41', '2023-12-13 07:19:41'),
(121, 'HA', 'Hawaiian Airlines', 'Amerika Serikat', 'ha.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2023-12-13 07:19:41', '2023-12-13 07:19:41'),
(122, 'A3', 'Aegean Airlines', 'Yunani', 'a3.png', 'Maskapai penerbangan dijadwalkan dari Yunani', NULL, '2023-12-13 07:19:41', '2023-12-13 07:19:41'),
(123, 'IR', 'Iran Air', 'Iran', 'ir.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2023-12-13 07:19:42', '2023-12-13 07:19:42'),
(124, 'WA', 'KLM Cityhopper', 'Belanda', 'wa.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2023-12-13 07:19:42', '2023-12-13 07:19:42'),
(125, 'DE', 'Condor', 'Jerman', 'de.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:19:42', '2023-12-13 07:19:42'),
(126, 'O6', 'Avianca Brasil', 'Brazil', 'o6.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2023-12-13 07:19:42', '2023-12-13 07:19:42'),
(127, 'RV', 'Air Canada rouge', 'Kanada', 'rv.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:42', '2023-12-13 07:19:42'),
(128, 'YS', 'Regional Compagnie Aerienne Europee t/a HOP!-REGIONAL', 'Perancis', 'ys.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2023-12-13 07:19:43', '2023-12-13 07:19:43'),
(129, 'KA', 'Dragonair', 'Hongkong', 'ka.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2023-12-13 07:19:43', '2023-12-13 07:19:43'),
(130, 'LO', 'LOT Polish Airlines', 'Polandia', 'lo.png', 'Maskapai penerbangan dijadwalkan dari Polandia', NULL, '2023-12-13 07:19:43', '2023-12-13 07:19:43'),
(131, 'QG', 'PT. Citilink Indonesia', 'Indonesia', 'qg.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:43', '2023-12-13 07:19:43'),
(132, 'SG', 'SpiceJet Ltd.', 'India', 'sg.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:19:43', '2023-12-13 07:19:43'),
(133, 'WY', 'Oman Air', 'Oman', 'wy.png', 'Maskapai penerbangan dijadwalkan dari Oman', NULL, '2023-12-13 07:19:44', '2023-12-13 07:19:44'),
(134, 'EH', 'ANA Wings Co., Ltd.', 'Jepang', 'eh.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:19:44', '2023-12-13 07:19:44'),
(135, 'HV', 'Transavia Airlines', 'Belanda', 'hv.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2023-12-13 07:19:44', '2023-12-13 07:19:44'),
(136, 'WF', 'Wideroe', 'Norway', 'wf.png', 'Maskapai penerbangan dijadwalkan dari Norway', NULL, '2023-12-13 07:19:44', '2023-12-13 07:19:44'),
(137, 'X3', 'TUIfly', 'Jerman', 'x3.png', 'Maskapai penerbangan dijadwalkan, piagam dari Jerman', NULL, '2023-12-13 07:19:44', '2023-12-13 07:19:44'),
(138, 'D8', 'Norwegian Air International LTD.', 'Irlandia', 'd8.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2023-12-13 07:19:45', '2023-12-13 07:19:45'),
(139, 'LY', 'EL AL', 'Israel', 'ly.png', 'Maskapai penerbangan dijadwalkan dari Israel', NULL, '2023-12-13 07:19:45', '2023-12-13 07:19:45'),
(140, 'VS', 'Virgin Atlantic', 'Britania Raya', 'vs.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:45', '2023-12-13 07:19:45'),
(141, 'MT', 'Thomas Cook Airlines Limited of Manchester', 'Britania Raya', 'mt.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:45', '2023-12-13 07:19:45'),
(142, 'PK', 'PIA', 'Pakistan', 'pk.png', 'Maskapai penerbangan dijadwalkan dari Pakistan', NULL, '2023-12-13 07:19:46', '2023-12-13 07:19:46'),
(143, 'WG', 'Sunwing Airlines Inc.', 'Kanada', 'wg.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:46', '2023-12-13 07:19:46'),
(144, 'ID', 'PT. Batik Air Indonesia', 'Indonesia', 'id.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:46', '2023-12-13 07:19:46'),
(145, 'SJ', 'PT. Sriwijaya Air', 'Indonesia', 'sj.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:19:46', '2023-12-13 07:19:46'),
(146, 'U6', 'Ural Airlines', 'Rusia', 'u6.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:46', '2023-12-13 07:19:46'),
(147, 'WT', 'Swiftair, S.A.', 'Spanyol', 'wt.png', 'Maskapai penerbangan dijadwalkan, piagam dari Spanyol', NULL, '2023-12-13 07:19:47', '2023-12-13 07:19:47'),
(148, '5Y', 'Atlas Air', 'Amerika Serikat', '5y.png', 'Maskapai penerbangan dijadwalkan, piagam dari Amerika Serikat', NULL, '2023-12-13 07:19:47', '2023-12-13 07:19:47'),
(149, 'G9', 'Air Arabia', 'Uni Emirat Arab', 'g9.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2023-12-13 07:19:47', '2023-12-13 07:19:47'),
(150, 'TA', 'TACA', 'Penyelamat', 'ta.png', 'Maskapai penerbangan dijadwalkan dari Penyelamat', NULL, '2023-12-13 07:19:47', '2023-12-13 07:19:47'),
(151, 'FY', 'FlyFirefly Sdn. Bhd', 'Malaysia', 'fy.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2023-12-13 07:19:47', '2023-12-13 07:19:47'),
(152, 'PS', 'Ukraine International Airlines', 'Ukraina', 'ps.png', 'Maskapai penerbangan dijadwalkan dari Ukraina', NULL, '2023-12-13 07:19:48', '2023-12-13 07:19:48'),
(153, 'YW', 'Air Nostrum', 'Spanyol', 'yw.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:19:48', '2023-12-13 07:19:48'),
(154, 'ZB', 'Monarch Airlines', 'Britania Raya', 'zb.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:19:48', '2023-12-13 07:19:48'),
(155, '4Z', 'Airlink', 'Afrika Selatan', '4z.png', 'Maskapai penerbangan terjadwal, virtual dari Afrika Selatan', NULL, '2023-12-13 07:19:48', '2023-12-13 07:19:48'),
(156, 'KQ', 'Kenya Airways', 'Kenya', 'kq.png', 'Maskapai penerbangan dijadwalkan dari Kenya', NULL, '2023-12-13 07:19:48', '2023-12-13 07:19:48'),
(157, 'KN', 'China United Airlines', 'Cina', 'kn.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:49', '2023-12-13 07:19:49'),
(158, 'B2', 'Belavia - Belarusian Airlines', 'Belarusia', 'b2.png', 'Maskapai penerbangan dijadwalkan dari Belarusia', NULL, '2023-12-13 07:19:49', '2023-12-13 07:19:49'),
(159, 'PG', 'Bangkok Air', 'Thailand', 'pg.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:19:49', '2023-12-13 07:19:49'),
(160, 'QY', 'European Air Transport', 'Jerman', 'qy.png', 'Maskapai penerbangan dijadwalkan, kargo dari Jerman', NULL, '2023-12-13 07:19:49', '2023-12-13 07:19:49'),
(161, 'TS', 'Air Transat', 'Kanada', 'ts.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:50', '2023-12-13 07:19:50'),
(162, 'VJ', 'Vietjet Aviation Joint Stock Company', 'Vietnam', 'vj.png', 'Maskapai penerbangan dijadwalkan dari Vietnam', NULL, '2023-12-13 07:19:50', '2023-12-13 07:19:50'),
(163, 'DB', 'HOP!-BRIT AIR', 'Perancis', 'db.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2023-12-13 07:19:50', '2023-12-13 07:19:50'),
(164, 'EW', 'Eurowings', 'Jerman', 'ew.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:19:50', '2023-12-13 07:19:50'),
(165, 'HX', 'Hong Kong Airlines', 'Hongkong', 'hx.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2023-12-13 07:19:51', '2023-12-13 07:19:51'),
(166, 'IA', 'Iraqi Airways', 'Irak', 'ia.png', 'Maskapai penerbangan dijadwalkan dari Irak', NULL, '2023-12-13 07:19:51', '2023-12-13 07:19:51'),
(167, 'DC', 'Braathens Regional', 'Swedia', 'dc.png', 'Maskapai penerbangan terjadwal, virtual dari Swedia', NULL, '2023-12-13 07:19:51', '2023-12-13 07:19:51'),
(168, 'EP', 'Iran Aseman Airlines', 'Iran', 'ep.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2023-12-13 07:19:51', '2023-12-13 07:19:51'),
(169, 'FI', 'Icelandair', 'Islandia', 'fi.png', 'Maskapai penerbangan dijadwalkan dari Islandia', NULL, '2023-12-13 07:19:51', '2023-12-13 07:19:51'),
(170, 'KC', 'Air Astana', 'Kazakstan', 'kc.png', 'Maskapai penerbangan dijadwalkan dari Kazakstan', NULL, '2023-12-13 07:19:52', '2023-12-13 07:19:52'),
(171, 'MI', 'Silkair', 'Singapura', 'mi.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2023-12-13 07:19:52', '2023-12-13 07:19:52'),
(172, 'TU', 'Tunisair', 'Tunisia', 'tu.png', 'Maskapai penerbangan dijadwalkan dari Tunisia', NULL, '2023-12-13 07:19:52', '2023-12-13 07:19:52'),
(173, 'XR', 'Virgin Australia Regional', 'Australia', 'xr.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:52', '2023-12-13 07:19:52'),
(174, 'ZK', 'Great Lakes Aviation Ltd.', 'Kepulauan Terluar Kecil Amerika Serikat', 'zk.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:53', '2023-12-13 07:19:53'),
(175, 'D0', 'DHL Air', 'Britania Raya', 'd0.png', 'Maskapai penerbangan dijadwalkan, kargo dari Britania Raya', NULL, '2023-12-13 07:19:53', '2023-12-13 07:19:53'),
(176, 'DD', 'Nok Airlines Public Company Limited dba Nok Air', 'Thailand', 'dd.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:19:53', '2023-12-13 07:19:53'),
(177, 'GF', 'Gulf Air', 'Bahrain', 'gf.png', 'Maskapai penerbangan dijadwalkan dari Bahrain', NULL, '2023-12-13 07:19:53', '2023-12-13 07:19:53'),
(178, 'HY', 'Uzbekistan Airways', 'Uzbekistan', 'hy.png', 'Maskapai penerbangan dijadwalkan dari Uzbekistan', NULL, '2023-12-13 07:19:53', '2023-12-13 07:19:53'),
(179, 'J2', 'Azerbaijan Airlines', 'Azerbaijan', 'j2.png', 'Maskapai penerbangan dijadwalkan dari Azerbaijan', NULL, '2023-12-13 07:19:54', '2023-12-13 07:19:54'),
(180, 'O3', 'SF Airlines Company Limited', 'Cina', 'o3.png', 'Maskapai penerbangan muatan dari Cina', NULL, '2023-12-13 07:19:54', '2023-12-13 07:19:54'),
(181, 'SL', 'Solenta Aviation', 'Afrika Selatan', 'sl.png', 'Maskapai penerbangan piagam dari Afrika Selatan', NULL, '2023-12-13 07:19:54', '2023-12-13 07:19:54'),
(182, 'WR', 'WestJet Encore', 'Kanada', 'wr.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:54', '2023-12-13 07:19:54'),
(183, 'XY', 'NATIONAL AIR SERVICES dba FLYNAS', 'Arab Saudi', 'xy.png', 'Maskapai penerbangan terjadwal, pribadi dari Arab Saudi', NULL, '2023-12-13 07:19:54', '2023-12-13 07:19:54'),
(184, '8L', 'Lucky Air', 'Cina', '8l.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:55', '2023-12-13 07:19:55'),
(185, 'GB', 'ABX Air, Inc.', 'Amerika Serikat', 'gb.png', 'Maskapai penerbangan muatan dari Amerika Serikat', NULL, '2023-12-13 07:19:55', '2023-12-13 07:19:55'),
(186, 'OD', 'Malindo Airways Sdn Bhd ( Malindo A', 'Malaysia', 'od.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2023-12-13 07:19:55', '2023-12-13 07:19:55'),
(187, 'QQ', 'Alliance Airlines', 'Australia', 'qq.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:19:55', '2023-12-13 07:19:55'),
(188, 'TB', 'TUI Airlines Belgium t/a Jetairfly', 'Belgium', 'tb.png', 'Maskapai penerbangan dijadwalkan dari Belgium', NULL, '2023-12-13 07:19:56', '2023-12-13 07:19:56'),
(189, 'PD', 'Porter Airlines Inc.', 'Kanada', 'pd.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:56', '2023-12-13 07:19:56'),
(190, 'Y8', 'Yangtze River Express Airlines Co. LTD', 'Cina', 'y8.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:56', '2023-12-13 07:19:56'),
(191, 'YC', 'Joint-Stock Company \"Yamal Airlines\"', 'Rusia', 'yc.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:19:56', '2023-12-13 07:19:56'),
(192, '3V', 'TNT Airways S.A.', 'Belgium', '3v.png', 'Maskapai penerbangan muatan dari Belgium', NULL, '2023-12-13 07:19:56', '2023-12-13 07:19:56'),
(193, '8Q', 'Onur Air', 'Turki', '8q.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2023-12-13 07:19:57', '2023-12-13 07:19:57'),
(194, 'G5', 'China Express Airlines', 'Cina', 'g5.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:19:57', '2023-12-13 07:19:57'),
(195, 'RJ', 'Royal Jordanian', 'Yordania', 'rj.png', 'Maskapai penerbangan dijadwalkan dari Yordania', NULL, '2023-12-13 07:19:57', '2023-12-13 07:19:57'),
(196, 'RS', 'Sky Regional', 'Kanada', 'rs.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:57', '2023-12-13 07:19:57'),
(197, 'TO', 'Transavia France', 'Perancis', 'to.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2023-12-13 07:19:58', '2023-12-13 07:19:58'),
(198, 'V0', 'CONVIASA', 'Venezuela', 'v0.png', 'Maskapai penerbangan dijadwalkan dari Venezuela', NULL, '2023-12-13 07:19:58', '2023-12-13 07:19:58'),
(199, 'XQ', 'SunExpress', 'Turki', 'xq.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2023-12-13 07:19:58', '2023-12-13 07:19:58'),
(200, 'ZX', 'Air Georgian Ltd. dba Air Alliance', 'Kanada', 'zx.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:19:58', '2023-12-13 07:19:58'),
(201, '7C', 'Jeju Air Co. Ltd.', 'Korea Selatan', '7c.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:19:58', '2023-12-13 07:19:58'),
(202, 'AU', 'Austral', 'Argentina', 'au.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2023-12-13 07:19:59', '2023-12-13 07:19:59'),
(203, 'BC', 'Skymark Airlines Inc.', 'Jepang', 'bc.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:19:59', '2023-12-13 07:19:59'),
(204, 'BT', 'Air Baltic', 'Latvia', 'bt.png', 'Maskapai penerbangan dijadwalkan dari Latvia', NULL, '2023-12-13 07:19:59', '2023-12-13 07:19:59'),
(205, 'C5', 'Champlain Enterprises Inc. dba Commutair', 'Kepulauan Terluar Kecil Amerika Serikat', 'c5.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:19:59', '2023-12-13 07:19:59'),
(206, 'NM', 'Mount Cook Airlines', 'Selandia Baru', 'nm.png', 'Maskapai penerbangan dijadwalkan dari Selandia Baru', NULL, '2023-12-13 07:20:00', '2023-12-13 07:20:00'),
(207, 'TR', 'Tiger Airways', 'Singapura', 'tr.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2023-12-13 07:20:00', '2023-12-13 07:20:00'),
(208, '7R', 'Joint Stock Aviation Company \"RusLine\"', 'Rusia', '7r.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:20:00', '2023-12-13 07:20:00'),
(209, 'A5', 'HOP!', 'Perancis', 'a5.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2023-12-13 07:20:00', '2023-12-13 07:20:00'),
(210, 'D7', 'Airasia X Berhad dba Airasia X', 'Malaysia', 'd7.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2023-12-13 07:20:01', '2023-12-13 07:20:01'),
(211, 'DS', 'Easyjet Switzerland S.A', 'Swiss', 'ds.png', 'Maskapai penerbangan dijadwalkan dari Swiss', NULL, '2023-12-13 07:20:01', '2023-12-13 07:20:01'),
(212, 'J4*', 'Jet Time', 'Denmark', 'j4*.png', 'Maskapai penerbangan dijadwalkan dari Denmark', NULL, '2023-12-13 07:20:01', '2023-12-13 07:20:01'),
(213, 'KU', 'Kuwait Airways', 'Kuwait', 'ku.png', 'Maskapai penerbangan dijadwalkan dari Kuwait', NULL, '2023-12-13 07:20:01', '2023-12-13 07:20:01'),
(214, 'PN', 'China West Air Co. Ltd.', 'Cina', 'pn.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:01', '2023-12-13 07:20:01'),
(215, 'RO', 'TAROM', 'Rumania', 'ro.png', 'Maskapai penerbangan dijadwalkan dari Rumania', NULL, '2023-12-13 07:20:02', '2023-12-13 07:20:02'),
(216, 'V7', 'Volotea, S.L.', 'Spanyol', 'v7.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:20:02', '2023-12-13 07:20:02'),
(217, 'W3', 'Arik Air', 'Nigeria', 'w3.png', 'Maskapai penerbangan dijadwalkan dari Nigeria', NULL, '2023-12-13 07:20:02', '2023-12-13 07:20:02'),
(218, '3M', 'Silver Airways Corp', 'Kepulauan Terluar Kecil Amerika Serikat', '3m.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:20:02', '2023-12-13 07:20:02'),
(219, 'CF', 'China Postal Airlines', 'Cina', 'cf.png', 'Maskapai penerbangan muatan dari Cina', NULL, '2023-12-13 07:20:02', '2023-12-13 07:20:02'),
(220, 'EU', 'Chengdu Airlines', 'Cina', 'eu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:03', '2023-12-13 07:20:03'),
(221, 'GE', 'TransAsia Airways', 'Taiwan', 'ge.png', 'Maskapai penerbangan dijadwalkan dari Taiwan', NULL, '2023-12-13 07:20:03', '2023-12-13 07:20:03'),
(222, 'PX', 'Air Niugini', 'Papua Nugini', 'px.png', 'Maskapai penerbangan dijadwalkan dari Papua Nugini', NULL, '2023-12-13 07:20:03', '2023-12-13 07:20:03'),
(223, 'QZ', 'PT. Indonesia AirAsia', 'Indonesia', 'qz.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:20:03', '2023-12-13 07:20:03'),
(224, 'ST', 'Germania', 'Jerman', 'st.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:20:04', '2023-12-13 07:20:04'),
(225, 'T5', 'Turkmenistan Airlines', 'Turkmenistan', 't5.png', 'Maskapai penerbangan dijadwalkan dari Turkmenistan', NULL, '2023-12-13 07:20:04', '2023-12-13 07:20:04'),
(226, 'XZ', 'South African Express Airways', 'Afrika Selatan', 'xz.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2023-12-13 07:20:04', '2023-12-13 07:20:04'),
(227, 'I2', 'Compania Operadora de Corto y Medio Radio Iberia Express, S.A.U', 'Spanyol', 'i2.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2023-12-13 07:20:04', '2023-12-13 07:20:04'),
(228, 'UL', 'SriLankan', 'Srilanka', 'ul.png', 'Maskapai penerbangan dijadwalkan dari Srilanka', NULL, '2023-12-13 07:20:05', '2023-12-13 07:20:05'),
(229, '5Z', 'Cemair (Pty) Ltd. t/a Cemair', 'Afrika Selatan', '5z.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2023-12-13 07:20:05', '2023-12-13 07:20:05'),
(230, 'CT', 'Alitalia CityLiner S.p.A.', 'Italia', 'ct.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2023-12-13 07:20:05', '2023-12-13 07:20:05'),
(231, 'CV', 'Cargolux S.A.', 'Luksemburg', 'cv.png', 'Maskapai penerbangan dijadwalkan, kargo dari Luksemburg', NULL, '2023-12-13 07:20:05', '2023-12-13 07:20:05'),
(232, 'GK', 'Jetstar Japan Co., Ltd.', 'Jepang', 'gk.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:20:06', '2023-12-13 07:20:06'),
(233, 'HZ', 'Joint- Stock Company \"Aurora Airlines\"', 'Rusia', 'hz.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:20:06', '2023-12-13 07:20:06'),
(234, 'IG', 'Meridiana fly', 'Italia', 'ig.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2023-12-13 07:20:06', '2023-12-13 07:20:06'),
(235, 'IX', 'Air India Charters Limited', 'India', 'ix.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:20:06', '2023-12-13 07:20:06'),
(236, 'KK', 'Atlasjet Airlines', 'Turki', 'kk.png', 'Maskapai penerbangan dijadwalkan, piagam dari Turki', NULL, '2023-12-13 07:20:06', '2023-12-13 07:20:06'),
(237, 'KS', 'Penair', 'Kepulauan Terluar Kecil Amerika Serikat', 'ks.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:20:07', '2023-12-13 07:20:07'),
(238, 'LM', 'Loganair Limited', 'Britania Raya', 'lm.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:20:07', '2023-12-13 07:20:07'),
(239, 'ME', 'MEA', 'Libanon', 'me.png', 'Maskapai penerbangan dijadwalkan dari Libanon', NULL, '2023-12-13 07:20:07', '2023-12-13 07:20:07'),
(240, 'QB', 'Qeshm Air', 'Iran', 'qb.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2023-12-13 07:20:07', '2023-12-13 07:20:07'),
(241, 'SL2', 'Thai Lion Air', 'Thailand', 'sl2.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:20:08', '2023-12-13 07:20:08'),
(242, 'SY', 'MN Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'sy.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:20:08', '2023-12-13 07:20:08'),
(243, '3X', 'Japan Air Commuter', 'Jepang', '3x.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:20:08', '2023-12-13 07:20:08'),
(244, '7F', 'Bradley Air Services Limited t/a First Air', 'Kanada', '7f.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:20:08', '2023-12-13 07:20:08'),
(245, 'BK', 'Okay Airways', 'Cina', 'bk.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:09', '2023-12-13 07:20:09'),
(246, 'CJ', 'BA Cityflyer Limited', 'Britania Raya', 'cj.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:20:09', '2023-12-13 07:20:09'),
(247, 'G8', 'Go Airlines (India) Ltd.', 'India', 'g8.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:20:09', '2023-12-13 07:20:09'),
(248, 'LJ', 'Jin Air Co. Ltd', 'Korea Selatan', 'lj.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:20:09', '2023-12-13 07:20:09'),
(249, 'NL', 'Shaheen Air International', 'Pakistan', 'nl.png', 'Maskapai penerbangan dijadwalkan dari Pakistan', NULL, '2023-12-13 07:20:09', '2023-12-13 07:20:09'),
(250, 'QS', 'Travel Service, A.S.', 'Republik Ceko', 'qs.png', 'Maskapai penerbangan dijadwalkan, piagam, divisi dari Republik Ceko', NULL, '2023-12-13 07:20:10', '2023-12-13 07:20:10'),
(251, 'VB', 'Aeroenlaces Nacionales S.A. De C.V.', 'Meksiko', 'vb.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:20:10', '2023-12-13 07:20:10'),
(252, '3K', 'Jetstar Asia Airways Pte Ltd', 'Singapura', '3k.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2023-12-13 07:20:10', '2023-12-13 07:20:10'),
(253, '3K2', 'Jetstar Asia Airways - Singapore', 'Singapura', '3k2.png', 'Maskapai penerbangan  dari Singapura', NULL, '2023-12-13 07:20:10', '2023-12-13 07:20:10'),
(254, '5T', 'Canadian North Inc.', 'Kanada', '5t.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:20:10', '2023-12-13 07:20:10'),
(255, 'HG', 'NIKI', 'Austria', 'hg.png', 'Maskapai penerbangan dijadwalkan dari Austria', NULL, '2023-12-13 07:20:11', '2023-12-13 07:20:11'),
(256, 'NS', 'Hebei Airlines Co., Ltd.', 'Cina', 'ns.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:11', '2023-12-13 07:20:11'),
(257, 'OB', 'Boliviana de Aviacion - BoA', 'Bolivia', 'ob.png', 'Maskapai penerbangan dijadwalkan dari Bolivia', NULL, '2023-12-13 07:20:11', '2023-12-13 07:20:11'),
(258, 'OX', 'Orient Thai Airlines Company Ltd.', 'Thailand', 'ox.png', 'Maskapai penerbangan dijadwalkan, piagam dari Thailand', NULL, '2023-12-13 07:20:11', '2023-12-13 07:20:11'),
(259, 'RU', 'AirBridgeCargo Airlines', 'Rusia', 'ru.png', 'Maskapai penerbangan muatan dari Rusia', NULL, '2023-12-13 07:20:12', '2023-12-13 07:20:12'),
(260, 'WX', 'CityJet', 'Irlandia', 'wx.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2023-12-13 07:20:12', '2023-12-13 07:20:12'),
(261, '9I', 'Airline Allied Services Limited dba Alliance Air', 'India', '9i.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2023-12-13 07:20:12', '2023-12-13 07:20:12'),
(262, 'B7', 'UNI Airways Corporation', 'Taiwan', 'b7.png', 'Maskapai penerbangan dijadwalkan dari Taiwan', NULL, '2023-12-13 07:20:12', '2023-12-13 07:20:12'),
(263, 'BM', 'bmi Regional', 'Britania Raya', 'bm.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:20:12', '2023-12-13 07:20:12'),
(264, 'HE', 'LGW-Luftfahrtgesellschaft Walter GmbH', 'Jerman', 'he.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2023-12-13 07:20:13', '2023-12-13 07:20:13'),
(265, 'JU', 'Air SERBIA a.d. Beograd', 'Serbia', 'ju.png', 'Maskapai penerbangan dijadwalkan dari Serbia', NULL, '2023-12-13 07:20:13', '2023-12-13 07:20:13'),
(266, 'LG', 'Luxair', 'Luksemburg', 'lg.png', 'Maskapai penerbangan dijadwalkan dari Luksemburg', NULL, '2023-12-13 07:20:13', '2023-12-13 07:20:13'),
(267, 'MM', 'Peach Aviation Limited', 'Jepang', 'mm.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2023-12-13 07:20:13', '2023-12-13 07:20:13'),
(268, 'NI', 'PGA-Portugalia Airlines', 'Portugal', 'ni.png', 'Maskapai penerbangan dijadwalkan dari Portugal', NULL, '2023-12-13 07:20:13', '2023-12-13 07:20:13'),
(269, 'NX', 'Air Macau', 'Makau', 'nx.png', 'Maskapai penerbangan dijadwalkan dari Makau', NULL, '2023-12-13 07:20:14', '2023-12-13 07:20:14'),
(270, 'RE', 'Stobart Air', 'Irlandia', 're.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2023-12-13 07:20:14', '2023-12-13 07:20:14'),
(271, 'TT', 'Tigerair Australia', 'Australia', 'tt.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2023-12-13 07:20:14', '2023-12-13 07:20:14'),
(272, 'YN', 'Air Creebec (1994) Inc.', 'Kanada', 'yn.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:20:14', '2023-12-13 07:20:14'),
(273, '2P', 'Air Philippines Corporation dba PAL Express and Airphil Express', 'Filipina', '2p.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2023-12-13 07:20:15', '2023-12-13 07:20:15'),
(274, 'DZ', 'Donghai Airlines Co., Ltd', 'Cina', 'dz.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:15', '2023-12-13 07:20:15'),
(275, 'EQ', 'TAME - Linea Aerea del Ecuador', 'Ekuador', 'eq.png', 'Maskapai penerbangan dijadwalkan dari Ekuador', NULL, '2023-12-13 07:20:15', '2023-12-13 07:20:15'),
(276, 'GJ', 'Zhejiang Loong Airlines Co., Ltd', 'Cina', 'gj.png', 'Maskapai penerbangan dijadwalkan, kargo dari Cina', NULL, '2023-12-13 07:20:15', '2023-12-13 07:20:15'),
(277, 'IL', 'PT.Trigana Air Service', 'Indonesia', 'il.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2023-12-13 07:20:16', '2023-12-13 07:20:16'),
(278, 'MN', 'Comair', 'Afrika Selatan', 'mn.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Afrika Selatan', NULL, '2023-12-13 07:20:16', '2023-12-13 07:20:16'),
(279, 'VW', 'Transportes Aeromar, S.A. de C.V.', 'Meksiko', 'vw.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2023-12-13 07:20:16', '2023-12-13 07:20:16'),
(280, 'WE', 'Thai Smile', 'Thailand', 'we.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2023-12-13 07:20:17', '2023-12-13 07:20:17'),
(281, '0B', 'Blue Air', 'Rumania', '0b.png', 'Maskapai penerbangan dijadwalkan dari Rumania', NULL, '2023-12-13 07:20:18', '2023-12-13 07:20:18'),
(282, '9V', 'Avior Airlines, C.A.', 'Venezuela', '9v.png', 'Maskapai penerbangan dijadwalkan dari Venezuela', NULL, '2023-12-13 07:20:18', '2023-12-13 07:20:18'),
(283, 'DT', 'TAAG - Angola Airlines', 'Angola', 'dt.png', 'Maskapai penerbangan dijadwalkan dari Angola', NULL, '2023-12-13 07:20:18', '2023-12-13 07:20:18'),
(284, 'DX', 'Danish Air Transport', 'Denmark', 'dx.png', 'Maskapai penerbangan dijadwalkan dari Denmark', NULL, '2023-12-13 07:20:18', '2023-12-13 07:20:18'),
(285, 'H2', 'SKY Airline', 'Chili', 'h2.png', 'Maskapai penerbangan dijadwalkan dari Chili', NULL, '2023-12-13 07:20:19', '2023-12-13 07:20:19'),
(286, 'JV', 'Bearskin Lake air services LP', 'Kanada', 'jv.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2023-12-13 07:20:19', '2023-12-13 07:20:19'),
(287, 'NG', 'Aero Contractors', 'Nigeria', 'ng.png', 'Maskapai penerbangan dijadwalkan dari Nigeria', NULL, '2023-12-13 07:20:19', '2023-12-13 07:20:19'),
(288, 'OK', 'Czech Airlines j.s.c', 'Republik Ceko', 'ok.png', 'Maskapai penerbangan dijadwalkan dari Republik Ceko', NULL, '2023-12-13 07:20:19', '2023-12-13 07:20:19'),
(289, 'PO', 'Polar Air Cargo Worldwide, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'po.png', 'Maskapai penerbangan muatan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2023-12-13 07:20:20', '2023-12-13 07:20:20'),
(290, 'SF', 'Tassili Airlines', 'Aljazair', 'sf.png', 'Maskapai penerbangan dijadwalkan dari Aljazair', NULL, '2023-12-13 07:20:20', '2023-12-13 07:20:20'),
(291, 'T3', 'Air Kilroe Limited t/a Eastern Airways', 'Britania Raya', 't3.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2023-12-13 07:20:20', '2023-12-13 07:20:20'),
(292, 'TV', 'Tibet Airlines Corporation Limited', 'Cina', 'tv.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2023-12-13 07:20:20', '2023-12-13 07:20:20'),
(293, 'TW', 'T\'way Air', 'Korea Selatan', 'tw.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:20:20', '2023-12-13 07:20:20'),
(294, 'UB', 'Myanmar National Airlines', 'Myanmar', 'ub.png', 'Maskapai penerbangan dijadwalkan dari Myanmar', NULL, '2023-12-13 07:20:21', '2023-12-13 07:20:21'),
(295, 'W8', 'Cargojet Airways', 'Kanada', 'w8.png', 'Maskapai penerbangan dijadwalkan, kargo dari Kanada', NULL, '2023-12-13 07:20:21', '2023-12-13 07:20:21'),
(296, 'Y7', 'Joint Stock Company Airline Taimyr', 'Rusia', 'y7.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2023-12-13 07:20:21', '2023-12-13 07:20:21'),
(297, 'ZE', 'EASTAR JET Co. Ltd.', 'Korea Selatan', 'ze.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2023-12-13 07:20:21', '2023-12-13 07:20:21'),
(298, 'ZO', 'Zagros Airlines', 'Iran', 'zo.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22'),
(299, '2Z', 'Passaredo Transportes Aereos S.A.', 'Brazil', '2z.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22'),
(300, '4M', 'Lan Argentina', 'Argentina', '4m.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2023-12-13 07:20:22', '2023-12-13 07:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `has_dropdown` tinyint(1) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_roles`
--

CREATE TABLE `menu_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT 0,
  `can_edit` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_11_27_193448_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_21_201756_create_provinsi_table', 1),
(7, '2023_11_21_201936_create_kabupaten_table', 1),
(8, '2023_11_22_202738_create_kantor_table', 1),
(9, '2023_11_22_203120_create_hotel_table', 1),
(10, '2023_11_22_203153_create_maskapai_table', 1),
(11, '2023_11_22_203325_create_paket_table', 1),
(12, '2023_11_27_105553_create_berkas_table', 1),
(13, '2023_11_27_195447_create_agen_table', 1),
(14, '2023_11_27_195737_create_member_table', 1),
(15, '2023_11_27_195805_create_author_table', 1),
(16, '2023_11_27_195817_create_admin_table', 1),
(17, '2023_11_27_215623_create_menus_table', 1),
(18, '2023_11_27_215635_create_sub_menus_table', 1),
(19, '2023_11_27_215709_create_menu_roles_table', 1),
(20, '2023_11_27_215845_create_pesan_table', 1),
(21, '2023_11_27_215917_create_paket_hotel_table', 1),
(22, '2023_11_27_220404_create_paket_maskapai_table', 1),
(23, '2023_11_27_220435_create_grup_table', 1),
(24, '2023_11_27_220537_create_kajian_table', 1),
(25, '2023_11_27_220542_create_artikel_table', 1),
(26, '2023_11_27_220622_create_konten_table', 1),
(27, '2023_11_27_222334_create_pemesanan_table', 1),
(28, '2023_11_27_222355_create_pemesanan_ekstra_table', 1),
(29, '2023_11_27_222703_create_perwakilan_table', 1),
(30, '2023_11_27_222746_create_cabang_table', 1),
(31, '2023_11_27_222910_create_pembayaran_table', 1),
(32, '2023_11_27_223108_create_jemaah_table', 1),
(33, '2023_11_27_223223_create_isu_perjalanan_table', 1),
(34, '2023_11_27_223247_create_galeri_table', 1),
(35, '2023_11_27_223307_create_berkas_jemaah_table', 1),
(36, '2023_11_27_223349_create_testimoni_table', 1),
(37, '2023_11_27_223422_create_sertifikat_jemaah_table', 1),
(38, '2023_11_27_223500_create_poin_table', 1),
(39, '2023_11_28_163433_create_referal_table', 1),
(40, '2023_11_28_163455_create_referal_poin_table', 1),
(41, '2023_11_28_185203_create_kamar_table', 1),
(42, '2023_11_28_185209_create_bus_table', 1),
(43, '2023_11_28_223446_create_kamar_jemaah_table', 1),
(44, '2023_11_28_223452_create_bus_jemaah_table', 1),
(45, '2023_12_06_202310_create_ekstra_table', 1),
(46, '2023_12_06_202319_create_paket_ekstra_table', 1),
(47, '2023_12_12_205109_create_pemesanan_kamar_table', 1),
(48, '2023_12_12_205215_create_permintaan_kamar_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_paket` varchar(255) DEFAULT NULL,
  `destinasi` varchar(255) DEFAULT NULL,
  `jenis_paket` enum('umroh','haji','wisata halal') DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `harga` double(16,2) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tempat_keberangkatan` text DEFAULT NULL,
  `tempat_kepulangan` text DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_ekstra`
--

CREATE TABLE `paket_ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ekstra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `harga` double(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_hotel`
--

CREATE TABLE `paket_hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hotel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_reservasi` varchar(255) DEFAULT NULL,
  `tanggal_check_in` date DEFAULT NULL,
  `tanggal_check_out` date DEFAULT NULL,
  `jumlah_kamar` int(11) DEFAULT NULL,
  `keterangan_hotel` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_maskapai`
--

CREATE TABLE `paket_maskapai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `maskapai_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_penerbangan` varchar(255) DEFAULT NULL,
  `nomor_pnr` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `keterangan_penerbangan` text DEFAULT NULL,
  `harga_tiket` double(16,2) DEFAULT NULL,
  `bandara_asal` varchar(255) DEFAULT NULL,
  `bandara_tujuan` varchar(255) DEFAULT NULL,
  `waktu_keberangkatan` time DEFAULT NULL,
  `waktu_kedatangan` time DEFAULT NULL,
  `status_penerbangan` varchar(255) DEFAULT NULL,
  `tipe_penerbangan` enum('Langsung','Transit') DEFAULT NULL,
  `gate_penerbangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_pembayaran` double(16,2) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` timestamp NULL DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('tertunda','diterima','ditolak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_umroh` tinyint(1) NOT NULL DEFAULT 0,
  `is_haji` tinyint(1) NOT NULL DEFAULT 0,
  `is_wisata_halal` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `tanggal_pesan` date DEFAULT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `total_harga` double(16,2) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `is_pembayaran_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_pelunasan` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_ekstra`
--

CREATE TABLE `pemesanan_ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ekstra` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_kamar`
--

CREATE TABLE `pemesanan_kamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `jumlah_pengisi` varchar(255) DEFAULT NULL,
  `harga` double(16,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_kamar`
--

CREATE TABLE `permintaan_kamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_kamar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permintaan` varchar(255) DEFAULT NULL,
  `harga` double(16,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `perwakilan`
--

CREATE TABLE `perwakilan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `surat_izin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `email_pengirim` varchar(255) NOT NULL,
  `nomor_wa_pengirim` varchar(255) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poin`
--

CREATE TABLE `poin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_poin` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Aceh', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(2, 'Sumatera Utara', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(3, 'Sumatera Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(4, 'Riau', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(5, 'Jambi', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(6, 'Sumatera Selatan', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(7, 'Bengkulu', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(8, 'Lampung', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(9, 'Kepulauan Riau', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(10, 'Kepulauan Bangka Belitung', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(11, 'DKI Jakarta', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(12, 'Jawa Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(13, 'Jawa Tengah', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(14, 'DI Yogyakarta', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(15, 'Jawa Timur', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(16, 'Banten', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(17, 'Bali', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(18, 'Nusa Tenggara Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(19, 'Nusa Tenggara Timur', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(20, 'Kalimantan Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(21, 'Kalimantan Tengah', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(22, 'Kalimantan Selatan', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(23, 'Kalimantan Timur', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(24, 'Kalimantan Utara', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(25, 'Sulawesi Utara', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(26, 'Sulawesi Tengah', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(27, 'Sulawesi Selatan', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(28, 'Sulawesi Tenggara', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(29, 'Gorontalo', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(30, 'Sulawesi Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(31, 'Maluku', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(32, 'Maluku Utara', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(33, 'Papua', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(34, 'Papua Barat', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(35, 'Papua Selatan', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(36, 'Papua Tengah', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(37, 'Papua Pegunungan', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(38, 'Papua Barat Daya', '2023-12-13 07:19:10', '2023-12-13 07:19:10'),
(39, 'Nusantara', '2023-12-13 07:19:10', '2023-12-13 07:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_referal` varchar(255) DEFAULT NULL,
  `jumlah_pengguna_referal` int(11) NOT NULL DEFAULT 0,
  `bonus_referal` double(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referal_poin`
--

CREATE TABLE `referal_poin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_poin` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat_jemaah`
--

CREATE TABLE `sertifikat_jemaah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jemaah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_sertifikat` varchar(255) DEFAULT NULL,
  `tanggal_penerbitan` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `jenis_sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_menu` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jemaah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `isi_testimoni` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `disetujui` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_user_id_foreign` (`user_id`),
  ADD KEY `admin_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agen_user_id_foreign` (`user_id`),
  ADD KEY `agen_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikel_slug_unique` (`slug`),
  ADD KEY `artikel_author_id_foreign` (`author_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_user_id_foreign` (`user_id`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas_jemaah`
--
ALTER TABLE `berkas_jemaah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_jemaah_jemaah_id_foreign` (`jemaah_id`),
  ADD KEY `berkas_jemaah_berkas_id_foreign` (`berkas_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `bus_jemaah`
--
ALTER TABLE `bus_jemaah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_jemaah_bus_id_foreign` (`bus_id`),
  ADD KEY `bus_jemaah_jemaah_id_foreign` (`jemaah_id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cabang_perwakilan_id_foreign` (`perwakilan_id`),
  ADD KEY `cabang_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `ekstra`
--
ALTER TABLE `ekstra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_paket_id_foreign` (`paket_id`),
  ADD KEY `grup_agen_id_foreign` (`agen_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isu_perjalanan`
--
ALTER TABLE `isu_perjalanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isu_perjalanan_grup_id_foreign` (`grup_id`);

--
-- Indexes for table `jemaah`
--
ALTER TABLE `jemaah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jemaah_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `jemaah_grup_id_foreign` (`grup_id`),
  ADD KEY `jemaah_mahram_id_foreign` (`mahram_id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kabupaten_provinsi_id_foreign` (`provinsi_id`);

--
-- Indexes for table `kajian`
--
ALTER TABLE `kajian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kajian_slug_unique` (`slug`),
  ADD KEY `kajian_author_id_foreign` (`author_id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamar_paket_hotel_id_foreign` (`paket_hotel_id`);

--
-- Indexes for table `kamar_jemaah`
--
ALTER TABLE `kamar_jemaah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamar_jemaah_kamar_id_foreign` (`kamar_id`),
  ADD KEY `kamar_jemaah_jemaah_id_foreign` (`jemaah_id`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kantor_kabupaten_id_foreign` (`kabupaten_id`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konten_user_id_foreign` (`user_id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maskapai_kode_maskapai_unique` (`kode_maskapai`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_roles_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `paket_ekstra`
--
ALTER TABLE `paket_ekstra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_ekstra_paket_id_foreign` (`paket_id`),
  ADD KEY `paket_ekstra_ekstra_id_foreign` (`ekstra_id`);

--
-- Indexes for table `paket_hotel`
--
ALTER TABLE `paket_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_hotel_paket_id_foreign` (`paket_id`),
  ADD KEY `paket_hotel_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `paket_maskapai`
--
ALTER TABLE `paket_maskapai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_maskapai_paket_id_foreign` (`paket_id`),
  ADD KEY `paket_maskapai_maskapai_id_foreign` (`maskapai_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_paket_id_foreign` (`paket_id`),
  ADD KEY `pemesanan_user_id_foreign` (`user_id`);

--
-- Indexes for table `pemesanan_ekstra`
--
ALTER TABLE `pemesanan_ekstra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_ekstra_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `pemesanan_kamar`
--
ALTER TABLE `pemesanan_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_kamar_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `permintaan_kamar`
--
ALTER TABLE `permintaan_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_kamar_pemesanan_kamar_id_foreign` (`pemesanan_kamar_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `perwakilan`
--
ALTER TABLE `perwakilan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perwakilan_kantor_id_foreign` (`kantor_id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesan_user_id_foreign` (`user_id`);

--
-- Indexes for table `poin`
--
ALTER TABLE `poin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poin_agen_id_foreign` (`agen_id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referal_user_id_foreign` (`user_id`);

--
-- Indexes for table `referal_poin`
--
ALTER TABLE `referal_poin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referal_poin_referal_id_foreign` (`referal_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat_jemaah`
--
ALTER TABLE `sertifikat_jemaah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sertifikat_jemaah_jemaah_id_foreign` (`jemaah_id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_menus_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimoni_jemaah_id_foreign` (`jemaah_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas_jemaah`
--
ALTER TABLE `berkas_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus_jemaah`
--
ALTER TABLE `bus_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ekstra`
--
ALTER TABLE `ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `isu_perjalanan`
--
ALTER TABLE `isu_perjalanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jemaah`
--
ALTER TABLE `jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `kajian`
--
ALTER TABLE `kajian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar_jemaah`
--
ALTER TABLE `kamar_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket_ekstra`
--
ALTER TABLE `paket_ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket_hotel`
--
ALTER TABLE `paket_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket_maskapai`
--
ALTER TABLE `paket_maskapai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan_ekstra`
--
ALTER TABLE `pemesanan_ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan_kamar`
--
ALTER TABLE `pemesanan_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_kamar`
--
ALTER TABLE `permintaan_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perwakilan`
--
ALTER TABLE `perwakilan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poin`
--
ALTER TABLE `poin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `referal`
--
ALTER TABLE `referal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referal_poin`
--
ALTER TABLE `referal_poin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertifikat_jemaah`
--
ALTER TABLE `sertifikat_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agen`
--
ALTER TABLE `agen`
  ADD CONSTRAINT `agen_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `berkas_jemaah`
--
ALTER TABLE `berkas_jemaah`
  ADD CONSTRAINT `berkas_jemaah_berkas_id_foreign` FOREIGN KEY (`berkas_id`) REFERENCES `berkas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `berkas_jemaah_jemaah_id_foreign` FOREIGN KEY (`jemaah_id`) REFERENCES `jemaah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bus_jemaah`
--
ALTER TABLE `bus_jemaah`
  ADD CONSTRAINT `bus_jemaah_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bus_jemaah_jemaah_id_foreign` FOREIGN KEY (`jemaah_id`) REFERENCES `jemaah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cabang`
--
ALTER TABLE `cabang`
  ADD CONSTRAINT `cabang_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cabang_perwakilan_id_foreign` FOREIGN KEY (`perwakilan_id`) REFERENCES `perwakilan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_agen_id_foreign` FOREIGN KEY (`agen_id`) REFERENCES `agen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `isu_perjalanan`
--
ALTER TABLE `isu_perjalanan`
  ADD CONSTRAINT `isu_perjalanan_grup_id_foreign` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jemaah`
--
ALTER TABLE `jemaah`
  ADD CONSTRAINT `jemaah_grup_id_foreign` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jemaah_mahram_id_foreign` FOREIGN KEY (`mahram_id`) REFERENCES `jemaah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jemaah_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_provinsi_id_foreign` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kajian`
--
ALTER TABLE `kajian`
  ADD CONSTRAINT `kajian_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_paket_hotel_id_foreign` FOREIGN KEY (`paket_hotel_id`) REFERENCES `paket_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar_jemaah`
--
ALTER TABLE `kamar_jemaah`
  ADD CONSTRAINT `kamar_jemaah_jemaah_id_foreign` FOREIGN KEY (`jemaah_id`) REFERENCES `jemaah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kamar_jemaah_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kantor`
--
ALTER TABLE `kantor`
  ADD CONSTRAINT `kantor_kabupaten_id_foreign` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `konten`
--
ALTER TABLE `konten`
  ADD CONSTRAINT `konten_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD CONSTRAINT `menu_roles_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `paket_ekstra`
--
ALTER TABLE `paket_ekstra`
  ADD CONSTRAINT `paket_ekstra_ekstra_id_foreign` FOREIGN KEY (`ekstra_id`) REFERENCES `ekstra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_ekstra_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket_hotel`
--
ALTER TABLE `paket_hotel`
  ADD CONSTRAINT `paket_hotel_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_hotel_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket_maskapai`
--
ALTER TABLE `paket_maskapai`
  ADD CONSTRAINT `paket_maskapai_maskapai_id_foreign` FOREIGN KEY (`maskapai_id`) REFERENCES `maskapai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_maskapai_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_ekstra`
--
ALTER TABLE `pemesanan_ekstra`
  ADD CONSTRAINT `pemesanan_ekstra_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_kamar`
--
ALTER TABLE `pemesanan_kamar`
  ADD CONSTRAINT `pemesanan_kamar_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_kamar`
--
ALTER TABLE `permintaan_kamar`
  ADD CONSTRAINT `permintaan_kamar_pemesanan_kamar_id_foreign` FOREIGN KEY (`pemesanan_kamar_id`) REFERENCES `pemesanan_kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perwakilan`
--
ALTER TABLE `perwakilan`
  ADD CONSTRAINT `perwakilan_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `poin`
--
ALTER TABLE `poin`
  ADD CONSTRAINT `poin_agen_id_foreign` FOREIGN KEY (`agen_id`) REFERENCES `agen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `referal`
--
ALTER TABLE `referal`
  ADD CONSTRAINT `referal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `referal_poin`
--
ALTER TABLE `referal_poin`
  ADD CONSTRAINT `referal_poin_referal_id_foreign` FOREIGN KEY (`referal_id`) REFERENCES `referal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sertifikat_jemaah`
--
ALTER TABLE `sertifikat_jemaah`
  ADD CONSTRAINT `sertifikat_jemaah_jemaah_id_foreign` FOREIGN KEY (`jemaah_id`) REFERENCES `jemaah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_jemaah_id_foreign` FOREIGN KEY (`jemaah_id`) REFERENCES `jemaah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
