-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 02:05 AM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `kantor_id`, `is_superadmin`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id`, `user_id`, `kantor_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `nama_berkas`, `created_at`, `updated_at`) VALUES
(1, 'KTP', '2024-01-09 11:42:26', '2024-01-09 11:42:26'),
(2, 'KK', '2024-01-09 11:42:26', '2024-01-09 11:42:26'),
(3, 'Surat Nikah', '2024-01-09 11:42:26', '2024-01-09 11:42:26'),
(4, 'Paspor', '2024-01-09 11:42:26', '2024-01-09 11:42:26'),
(5, 'Ijazah', '2024-01-09 11:42:26', '2024-01-09 11:42:26'),
(6, 'Surat Keterangan', '2024-01-09 11:42:26', '2024-01-09 11:42:26');

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

--
-- Dumping data for table `berkas_jemaah`
--

INSERT INTO `berkas_jemaah` (`id`, `jemaah_id`, `berkas_id`, `file_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'jemaah-berkas/berkas-1.jpg', 'tertunda', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 2, 1, 'jemaah-berkas/berkas-2.pdf', 'tertunda', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `paket_id`, `nomor_rombongan`, `nomor_polisi`, `merek`, `kapasitas`, `fasilitas`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '5984 VJV', 'SAPTCO', '45', '<ul>\r\n<li>AC</li>\r\n<li>Toilet</li>\r\n<li>Catering</li>\r\n</ul>', '2024-01-09 11:43:55', '2024-01-09 17:07:40'),
(2, 1, '2', '5985 VJV', 'SAPTCO', '45', '<ul>\n                    <li>Ac</li>\n                    <li>Toilet</li>\n                    <li>Catering</li>\n                </ul>', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `bus_jemaah`
--

INSERT INTO `bus_jemaah` (`id`, `bus_id`, `jemaah_id`, `nomor_kursi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, 2, 2, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perwakilan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_cabang` varchar(255) DEFAULT NULL,
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
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekstra`
--

INSERT INTO `ekstra` (`id`, `nama_ekstra`, `harga_default`, `jenis_ekstra`, `deskripsi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Perlengkapan', 1500000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, 'Koper', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, 'Batik Kain', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(4, 'Blazer Batik', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(5, 'Kemeja Batik Pria', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(6, 'Kemeja Batik Wanita', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(7, 'Gamis Batik', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(8, 'Rok Merah Maroon', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(9, 'Kerudung Merah Maroon', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(10, 'Celana Merah Maroon', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(11, 'Perlengkapan Ihrom', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(12, 'Kain Ihrom', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(13, 'Sabuk Ihrom', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(14, 'Tas Selempang', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(15, 'Tas Ransel', 1000000.00, 'perlengkapan', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(16, 'Pembuatan Paspor', 1000000.00, 'jasa', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(17, 'Pesawat Class Business', 1000000.00, 'pesawat', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(18, 'Pesawat Class Eksekutif', 1000000.00, 'pesawat', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(19, 'Kamar View Kakbah', 1000000.00, 'permintaan kamar', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(20, 'Kamar View Masjid Nabawi', 1000000.00, 'permintaan kamar', NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(21, 'tipe kamar quad gabung', 0.00, 'tipe kamar', '1,2,3,4', 'dapat diisi 1 s/d 4 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(22, 'tipe kamar quad keluarga', 0.00, 'tipe kamar', '4', 'harus diisi 4 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(23, 'tipe kamar quad keluarga isi 3 dan 1 bed kosong', 2500000.00, 'tipe kamar', '3', 'harus diisi 3 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(24, 'tipe kamar double gabung', 2500000.00, 'tipe kamar', '1', 'dapat diisi 1 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(25, 'tipe kamar double keluarga', 5000000.00, 'tipe kamar', '2', 'harus diisi 2 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(26, 'tipe kamar single', 8000000.00, 'tipe kamar', '1', 'hanya dapat diisi 1 orang', '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `paket_id`, `nama`, `deskripsi`, `file_path`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-1.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-2.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(3, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-3.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(4, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-4.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(5, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-5.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(6, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-6.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(7, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-7.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(8, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-8.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(9, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-9.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(10, 1, 'Dokumentasi', 'Umroh 2018', 'paket-galeri/galeri-10.jpg', 'gambar', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_grup` varchar(255) DEFAULT NULL,
  `ketua_grup` varchar(255) DEFAULT NULL,
  `keterangan_grup` text DEFAULT NULL,
  `status_grup` varchar(255) DEFAULT NULL,
  `kuota_grup` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id`, `paket_id`, `agen_id`, `nama_grup`, `ketua_grup`, `keterangan_grup`, `status_grup`, `kuota_grup`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ATET GROUP', NULL, 'Jemaahnya Asep Maulana', '', 50, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, NULL, 'HANEWA GROUP', NULL, 'Jemaahnya Pak Wahyu', '', 50, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `kode_hotel`, `nama_hotel`, `bintang`, `bintang_setaraf`, `kota`, `negara`, `alamat`, `link_gmaps`, `gambar`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'Hotel Anjum', '5', '5 Setaraf', 'Mekkah', 'Arab Saudi', 'Umm Al Qura Street, Haratal Bab And Ash Shamiyyah, Makkah 21955, Arab Saudi', 'https://maps.app.goo.gl/xku74pm4Vgocmdf57', 'hotel-gambar/anjum.jpg', '\nHotel mewah yang menghadap Masjidil Ḥaram atau Masjid Agung Mekkah ini berjarak 2 km dari Al Safa Royal Palace dan 11 km dari gunung Jabal An-Nur.\nKamar-kamar elegan memiliki Wi-Fi gratis, TV layar datar, dan kulkas mini, serta brankas, juga fasilitas untuk membuat kopi dan teh. Kamar di kelas yang lebih tinggi menawarkan pemandangan masjid. Suite mewah dilengkapi dengan ruang keluarga terpisah, sedangkan suite di kelas yang lebih tinggi memiliki tambahan kamar tidur. Kamar-kamar level klub menyertakan akses ke lounge pribadi. Room service ditawarkan.\nSarapan tersedia secara gratis. Ada 4 pilihan tempat makan, termasuk restoran prasmanan yang sejuk dan kafe 24 jam. Ada juga musala. Tersedia tempat parkir.', '2024-01-09 11:42:26', '2024-01-09 11:42:26', NULL),
(2, '', 'Millennium Aqeeq', '5', '5 Setaraf', 'Madinah', 'Arab Saudi', 'Musab bin Omeir Street, Bada\'ah, Madinah 42313, Arab Saudi', 'https://maps.app.goo.gl/FqoSrTo7zdxXzStc8', 'hotel-gambar/millennium-aqeeq.jpg', 'Hotel mewah yang terletak di jalan ramai berjarak 17 menit berjalan kaki dari Al-Masjid an-Nabawi dan 20 menit berjalan kaki dari Al-Baqi\', sebuah pemakaman Islam kuno. Prince Mohammad Bin Abdulaziz International Airport berjarak 21 km.\nKamar dengan dekorasi bernuansa hangat dilengkapi Wi-Fi dan TV serta minibar dan ketel; beberapa memiliki area duduk. Suite dengan 1 dan 2 kamar tidur dilengkapi ruang keluarga, dan kamar level klub menawarkan akses ke lounge pribadi. Room service tersedia 24/7.\nFasilitas meliputi 2 restoran, kedai kopi, dan pasar, plus business center dan ruang pertemuan. Tersedia sarapan dan tempat parkir.', '2024-01-09 11:42:26', '2024-01-09 11:42:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `isu_perjalanan`
--

CREATE TABLE `isu_perjalanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `masalah` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `waktu_pelaporan` timestamp NULL DEFAULT NULL,
  `waktu_penyelesaian` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `isu_perjalanan`
--

INSERT INTO `isu_perjalanan` (`id`, `grup_id`, `masalah`, `solusi`, `waktu_pelaporan`, `waktu_penyelesaian`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Uji Test Fitur :)', 'Stay Safe Semuaa ^_^', '2024-01-09 11:43:55', '2024-01-09 11:43:55', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 2, 'Tidak Ada Masalah :)', 'Stay Safe Semuaa ^_^', '2024-01-09 11:43:55', '2024-01-09 11:43:55', 0, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_agenda` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `grup_id`, `nama_agenda`, `lokasi`, `waktu_mulai`, `waktu_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manasik Umroh', 'Kantor Pusat PT. Haifa Nida Wisata Karawang', '2024-02-14 09:00:00', '2024-02-14 15:00:00', 'Tidak Ada Keterangan', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 2, 'Manasik Umroh', 'Kantor Pusat PT. Haifa Nida Wisata Karawang', '2024-02-14 09:00:00', '2024-02-14 15:00:00', 'Tidak Ada Keterangan', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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
  `email` varchar(255) DEFAULT NULL,
  `tingkat_pendidikan` enum('SD','SLTP','SLTA','D1/D2/D3','D4/S1','S2','S3') DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `nomor_paspor` varchar(255) DEFAULT NULL,
  `tempat_dikeluarkan` varchar(255) DEFAULT NULL,
  `tanggal_dikeluarkan` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `pernah_umroh` tinyint(1) DEFAULT NULL,
  `pernah_haji` tinyint(1) DEFAULT NULL,
  `hubungan_mahram` enum('Ayah','Anak','Suami','Saudara Kandung','Kakek','Cucu','Paman','Keponakan') DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `kontak_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jemaah`
--

INSERT INTO `jemaah` (`id`, `pemesanan_id`, `grup_id`, `mahram_id`, `nomor_ktp`, `nama_lengkap`, `nama_sesuai_paspor`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kewarganegaraan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `nomor_telepon`, `email`, `tingkat_pendidikan`, `pekerjaan`, `nomor_paspor`, `tempat_dikeluarkan`, `tanggal_dikeluarkan`, `tanggal_kadaluarsa`, `pernah_umroh`, `pernah_haji`, `hubungan_mahram`, `golongan_darah`, `foto`, `nama_keluarga_terdekat`, `kontak_keluarga_terdekat`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '3215151802990002', 'Haitsam', 'Haitsam Bin Fahruroji', 'Madinah', '1999-02-18', 'Laki-laki', 'WNI', 'Jl. Raya Cilamaya, Dusun KedungAsem, Rt.08/Rw.04', 'Mekarmaya', 'Cilamaya Wetan', 'Kabupaten Karawang', 'Jawa Barat', '41384', '+6282117503125', 'haitsam03@gmail.com', 'D4/S1', 'Wiraswasta', 'E5055707', 'KARAWANG', '2023-09-06', '2033-09-06', 1, 1, NULL, 'A', 'jemaah-foto/haitsam.jpg', 'Fahruroji', '081220747000', 1, NULL, '2024-01-09 11:43:55', '2024-01-21 12:34:49'),
(2, 1, 1, 1, '3215156503770006', 'Nenden Halimatu Saidah', 'Nenden Halimatu Saidah', 'Purwakarta', '1977-03-25', 'Perempuan', 'WNI', 'Jl. Raya Sempur', 'Sempur', 'Plered', 'Kabupaten Purwakarta', 'Jawa Barat', '41162', '+6281384129373', 'nhalimatu@gmail.com', 'SLTA', 'Ibu Rumah Tangga', NULL, NULL, NULL, NULL, 1, 1, 'Anak', 'B', 'jemaah-foto/nenden.jpg', 'Haitsam', '082117503125', 1, NULL, '2024-01-09 11:43:55', '2024-01-22 03:06:03');

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
(1, 'Kabupaten Aceh Barat', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(2, 'Kabupaten Aceh Barat Daya', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(3, 'Kabupaten Aceh Besar', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(4, 'Kabupaten Aceh Jaya', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(5, 'Kabupaten Aceh Selatan', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(6, 'Kabupaten Aceh Singkil', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(7, 'Kabupaten Aceh Tamiang', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(8, 'Kabupaten Aceh Tengah', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(9, 'Kabupaten Aceh Tenggara', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(10, 'Kabupaten Aceh Timur', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(11, 'Kabupaten Aceh Utara', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(12, 'Kabupaten Bener Meriah', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(13, 'Kabupaten Bireuer', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(14, 'Kabupaten Gayo Lues', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(15, 'Kabupaten Nagan Raya', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(16, 'Kabupaten Pidie', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(17, 'Kabupaten Pidie Jaya', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(18, 'Kabupaten Simeulue', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(19, 'Kota Banda Aceh', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(20, 'Kota Langsa', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(21, 'Kota Lhokseumawe', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(22, 'Kota Sabang', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(23, 'Kota Subulussalam', 1, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(24, 'Kabupaten Asahan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(25, 'Kabupaten Batu Bara', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(26, 'Kabupaten Dairi', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(27, 'Kabupaten Deli Serdang', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(28, 'Kabupaten Humbang Hasundutan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(29, 'Kabupaten Karo', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(30, 'Kabupaten Labuhanbatu', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(31, 'Kabupaten Labuhanbatu Selatan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(32, 'Kabupaten Labuhanbatu Utara', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(33, 'Kabupaten Langkat', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(34, 'Kabupaten Mandailing Natal', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(35, 'Kabupaten Nias', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(36, 'Kabupaten Nias Barat', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(37, 'Kabupaten Nias Selatan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(38, 'Kabupaten Nias Utara', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(39, 'Kabupaten Padang Lawas', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(40, 'Kabupaten Padang Lawas Utara', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(41, 'Kabupaten Pakpak Bharat', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(42, 'Kabupaten Samosir', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(43, 'Kabupaten Serdang Bedagai', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(44, 'Kabupaten Simalungun', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(45, 'Kabupaten Tapanuli Selatan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(46, 'Kabupaten Tapanuli Tengah', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(47, 'Kabupaten Tapanuli Utara', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(48, 'Kabupaten Toba', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(49, 'Kota Binjai', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(50, 'Kota Gunungsitoli', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(51, 'Kota Medan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(52, 'Kota Padangsidimpuan', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(53, 'Kota Pematangsiantar', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(54, 'Kota Sibolga', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(55, 'Kota Tanjungbalai', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(56, 'Kota Tebing Tinggi', 2, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(57, 'Kabupaten Agam', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(58, 'Kabupaten Dharmasraya', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(59, 'Kabupaten Kepulauan Mentawai', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(60, 'Kabupaten Lima Puluh Kota', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(61, 'Kabupaten Padang Pariaman', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(62, 'Kabupaten Pasaman', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(63, 'Kabupaten Pasaman Barat', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(64, 'Kabupaten Pesisir Selatan', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(65, 'Kabupaten Sijunjung', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(66, 'Kabupaten Solok', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(67, 'Kabupaten Solok Selatan', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(68, 'Kabupaten Tanah Datar', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(69, 'Kota Bukittinggi', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(70, 'Kota Padang', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(71, 'Kota Padang Panjang', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(72, 'Kota Pariaman', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(73, 'Kota Payakumbuh', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(74, 'Kota Sawahlunto', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(75, 'Kota Solok', 3, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(76, 'Kabupaten Bengkalis', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(77, 'Kabupaten Indragiri Hilir', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(78, 'Kabupaten Indragiri Hulu', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(79, 'Kabupaten Kampar', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(80, 'Kabupaten Kepulauan Meranti', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(81, 'Kabupaten Kuantan Singingi', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(82, 'Kabupaten Pelalawan', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(83, 'Kabupaten Rokan Hilir', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(84, 'Kabupaten Rokan Hulu', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(85, 'Kabupaten Siak', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(86, 'Kota Dumai', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(87, 'Kota Pekanbaru', 4, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(88, 'Kabupaten Batanghari', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(89, 'Kabupaten Bungo', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(90, 'Kabupaten Kerinci', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(91, 'Kabupaten Merangin', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(92, 'Kabupaten Muaro Jambi', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(93, 'Kabupaten Sarolangun', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(94, 'Kabupaten Tanjung Jabung Barat', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(95, 'Kabupaten Tanjung Jabung Timur', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(96, 'Kabupaten Tebo', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(97, 'Kota Jambi', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(98, 'Kota Sungai Penuh', 5, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(99, 'Kabupaten Banyuasin', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(100, 'Kabupaten Empat Lawang', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(101, 'Kabupaten Lahat', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(102, 'Kabupaten Muara Enim', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(103, 'Kabupaten Musi Banyuasin', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(104, 'Kabupaten Musi Rawas', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(105, 'Kabupaten Musi Rawas Utara', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(106, 'Kabupaten Ogan Ilir', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(107, 'Kabupaten Ogan Komering Ilir', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(108, 'Kabupaten Ogan Komering Ulu', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(109, 'Kabupaten Ogan Komering Ulu Selatan', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(110, 'Kabupaten Ogan Komering Ulu Timur', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(111, 'Kabupaten Penukal Abab Lematang Ilir', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(112, 'Kota Lubuk Linggau', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(113, 'Kota Pagaralam', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(114, 'Kota Palembang', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(115, 'Kota Prabumulih', 6, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(116, 'Kabupaten Bengkulu Selatan', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(117, 'Kabupaten Bengkulu Tengah', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(118, 'Kabupaten Bengkulu Utara', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(119, 'Kabupaten Kaur', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(120, 'Kabupaten Kepahiang', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(121, 'Kabupaten Lebong', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(122, 'Kabupaten Mukomuko', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(123, 'Kabupaten Rejang Lebong', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(124, 'Kabupaten Seluma', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(125, 'Kota Bengkulu', 7, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(126, 'Kabupaten Lampung Barat', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(127, 'Kabupaten Lampung Selatan', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(128, 'Kabupaten Lampung Tengah', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(129, 'Kabupaten Lampung Timur', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(130, 'Kabupaten Lampung Utara', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(131, 'Kabupaten Mesuji', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(132, 'Kabupaten Pesawaran', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(133, 'Kabupaten Pesisir Barat', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(134, 'Kabupaten Pringsewu', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(135, 'Kabupaten Tanggamus', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(136, 'Kabupaten Tulang Bawang', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(137, 'Kabupaten Tulang Bawang Barat', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(138, 'Kabupaten Way Kanan', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(139, 'Kota Bandar Lampung', 8, '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(140, 'Kota Metro', 8, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(141, 'Kabupaten Bangka', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(142, 'Kabupaten Bangka Barat', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(143, 'Kabupaten Bangka Selatan', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(144, 'Kabupaten Bangka Tengah', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(145, 'Kabupaten Belitung', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(146, 'Kabupaten Belitung Timur', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(147, 'Kota Pangkalpinang', 10, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(148, 'Kabupaten Bintan', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(149, 'Kabupaten Karimun', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(150, 'Kabupaten Kepulauan Anambas', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(151, 'Kabupaten Lingga', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(152, 'Kabupaten Natuna', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(153, 'Kota Batam', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(154, 'Kota Tanjungpinang', 9, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(155, 'Kabupaten Administrasi Kepulauan Seribu', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(156, 'Kota Administrasi Jakarta Barat', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(157, 'Kota Administrasi Jakarta Pusat', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(158, 'Kota Administrasi Jakarta Selatan', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(159, 'Kota Administrasi Jakarta Timur', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(160, 'Kota Administrasi Jakarta Utara', 11, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(161, 'Kabupaten Bandung', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(162, 'Kabupaten Bandung Barat', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(163, 'Kabupaten Bekasi', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(164, 'Kabupaten Bogor', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(165, 'Kabupaten Ciamis', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(166, 'Kabupaten Cianjur', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(167, 'Kabupaten Cirebon', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(168, 'Kabupaten Garut', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(169, 'Kabupaten Indramayu', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(170, 'Kabupaten Karawang', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(171, 'Kabupaten Kuningan', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(172, 'Kabupaten Majalengka', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(173, 'Kabupaten Pangandaran', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(174, 'Kabupaten Purwakarta', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(175, 'Kabupaten Subang', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(176, 'Kabupaten Sukabumi', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(177, 'Kabupaten Sumedang', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(178, 'Kabupaten Tasikmalaya', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(179, 'Kota Bandung', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(180, 'Kota Banjar', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(181, 'Kota Bekasi', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(182, 'Kota Bogor', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(183, 'Kota Cimahi', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(184, 'Kota Cirebon', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(185, 'Kota Depok', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(186, 'Kota Sukabumi', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(187, 'Kota Tasikmalaya', 12, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(188, 'Kabupaten Banjamegara', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(189, 'Kabupaten Banyumas', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(190, 'Kabupaten Batang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(191, 'Kabupaten Blora', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(192, 'Kabupaten Boyolali', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(193, 'Kabupaten Brebes', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(194, 'Kabupaten Cilacap', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(195, 'Kabupaten Demak', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(196, 'Kabupaten Grobogan', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(197, 'Kabupaten Jepara', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(198, 'Kabupaten Karanganyar', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(199, 'Kabupaten Kebumen', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(200, 'Kabupaten Kendal', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(201, 'Kabupaten Klaten', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(202, 'Kabupaten Kudus', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(203, 'Kabupaten Magelang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(204, 'Kabupaten Pati', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(205, 'Kabupaten Pekalongan', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(206, 'Kabupaten Pemalang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(207, 'Kabupaten Purbalingga', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(208, 'Kabupaten Purworejo', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(209, 'Kabupaten Rembang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(210, 'Kabupaten Semarang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(211, 'Kabupaten Sragen', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(212, 'Kabupaten Sukoharjo', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(213, 'Kabupaten Tegal', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(214, 'Kabupaten Temanggung', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(215, 'Kabupaten Wonogiri', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(216, 'Kabupaten Wonosobo', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(217, 'Kota Magelang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(218, 'Kota Pekalongan', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(219, 'Kota Salatiga', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(220, 'Kota Semarang', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(221, 'Kota Surakarta', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(222, 'Kota Tegal', 13, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(223, 'Kabupaten Bantul', 14, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(224, 'Kabupaten Gunungkidul', 14, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(225, 'Kabupaten Kulon Progo', 14, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(226, 'Kabupaten Sleman', 14, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(227, 'Kota Yogyakarta', 14, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(228, 'Kabupaten Bangkalan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(229, 'Kabupaten Banyuwangi', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(230, 'Kabupaten Blitar', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(231, 'Kabupaten Bojonegoro', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(232, 'Kabupaten Bondowoso', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(233, 'Kabupaten Gresik', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(234, 'Kabupaten Jember', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(235, 'Kabupaten Jombang', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(236, 'Kabupaten Kediri', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(237, 'Kabupaten Lamongan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(238, 'Kabupaten Lumajang', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(239, 'Kabupaten Madiun', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(240, 'Kabupaten Magetan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(241, 'Kabupaten Malang', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(242, 'Kabupaten Mojokerto', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(243, 'Kabupaten Nganjuk', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(244, 'Kabupaten Ngawi', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(245, 'Kabupaten Pacitan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(246, 'Kabupaten Pamekasan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(247, 'Kabupaten Pasuruan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(248, 'Kabupaten Ponorogo', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(249, 'Kabupaten Probolinggo', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(250, 'Kabupaten Sampang', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(251, 'Kabupaten Sidoarjo', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(252, 'Kabupaten Situbondo', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(253, 'Kabupaten Sumenep', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(254, 'Kabupaten Trenggalek', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(255, 'Kabupaten Tuban', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(256, 'Kabupaten Tulungagung', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(257, 'Kota Batu', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(258, 'Kota Blitar', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(259, 'Kota Kediri', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(260, 'Kota Madiun', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(261, 'Kota Malang', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(262, 'Kota Mojokerto', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(263, 'Kota Pasuruan', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(264, 'Kota Probolinggo', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(265, 'Kota Surabaya', 15, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(266, 'Kabupaten Lebak', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(267, 'Kabupaten Pandeglang', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(268, 'Kabupaten Serang', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(269, 'Kabupaten Tangerang', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(270, 'Kota Cilegon', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(271, 'Kota Serang', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(272, 'Kota Tangerang', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(273, 'Kota Tangerang Selatan', 16, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(274, 'Kabupaten Badung', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(275, 'Kabupaten Bangli', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(276, 'Kabupaten Buleleng', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(277, 'Kabupaten Gianyar', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(278, 'Kabupaten Jembrana', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(279, 'Kabupaten Karangasem', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(280, 'Kabupaten Klungkung', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(281, 'Kabupaten Tabanan', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(282, 'Kota Denpasar', 17, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(283, 'Kabupaten Bima', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(284, 'Kabupaten Dompu', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(285, 'Kabupaten Lombok Barat', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(286, 'Kabupaten Lombok Tengah', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(287, 'Kabupaten Lombok Timur', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(288, 'Kabupaten Lombok Utara', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(289, 'Kabupaten Sumbawa', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(290, 'Kabupaten Sumbawa Barat', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(291, 'Kota Bima', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(292, 'Kota Mataram', 18, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(293, 'Kabupaten Alor', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(294, 'Kabupaten Belu', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(295, 'Kabupaten Ende', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(296, 'Kabupaten Flores Timur', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(297, 'Kabupaten Kupang', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(298, 'Kabupaten Lembata', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(299, 'Kabupaten Malaka', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(300, 'Kabupaten Manggarai', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(301, 'Kabupaten Manggarai Barat', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(302, 'Kabupaten Manggarai Timur', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(303, 'Kabupaten Nagekeo', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(304, 'Kabupaten Ngada', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(305, 'Kabupaten Rote Ndao', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(306, 'Kabupaten Sabu Raijua', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(307, 'Kabupaten Sikka', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(308, 'Kabupaten Sumba Barat', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(309, 'Kabupaten Sumba Barat Daya', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(310, 'Kabupaten Sumba Tengah', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(311, 'Kabupaten Sumba Timur', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(312, 'Kabupaten Timor Tengah Selatan', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(313, 'Kabupaten Timor Tengah Utara', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(314, 'Kota Kupang', 19, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(315, 'Kabupaten Bengkayang', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(316, 'Kabupaten Kapuas Hulu', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(317, 'Kabupaten Kayong Utara', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(318, 'Kabupaten Ketapang', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(319, 'Kabupaten Kubu Raya', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(320, 'Kabupaten Landak', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(321, 'Kabupaten Melawi', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(322, 'Kabupaten Mempawah', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(323, 'Kabupaten Sambas', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(324, 'Kabupaten Sanggau', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(325, 'Kabupaten Sekadau', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(326, 'Kabupaten Sintang', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(327, 'Kota Pontianak', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(328, 'Kota Singkawang', 20, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(329, 'Kabupaten Barito Selatan', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(330, 'Kabupaten Barito Timur', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(331, 'Kabupaten Barito Utara', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(332, 'Kabupaten Gunung Mas', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(333, 'Kabupaten Kapuas', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(334, 'Kabupaten Katingan', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(335, 'Kabupaten Kotawaringin Barat', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(336, 'Kabupaten Kotawaringin Timur', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(337, 'Kabupaten Lamandau', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(338, 'Kabupaten Murung Raya', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(339, 'Kabupaten Pulang Pisau', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(340, 'Kabupaten Seruyan', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(341, 'Kabupaten Sukamara', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(342, 'Kota Palangka Raya', 21, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(343, 'Kabupaten Balangan', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(344, 'Kabupaten Banjar', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(345, 'Kabupaten Barito Kuala', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(346, 'Kabupaten Hulu Sungai Selatan', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(347, 'Kabupaten Hulu Sungai Tengah', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(348, 'Kabupaten Hulu Sungai Utara', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(349, 'Kabupaten Kotabaru', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(350, 'Kabupaten Tabalong', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(351, 'Kabupaten Tanah Bumbu', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(352, 'Kabupaten Tanah Laut', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(353, 'Kabupaten Tapin', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(354, 'Kota Banjarbaru', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(355, 'Kota Banjarmasin', 22, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(356, 'Kabupaten Berau', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(357, 'Kabupaten Kutai Barat', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(358, 'Kabupaten Kutai Kartanegara', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(359, 'Kabupaten Kutai Timur', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(360, 'Kabupaten Mahakam Ulu', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(361, 'Kabupaten Paser', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(362, 'Kabupaten Penajam Paser Utara', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(363, 'Kota Balikpapan', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(364, 'Kota Bontang', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(365, 'Kota Samarinda', 23, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(366, 'Kabupaten Bulungan', 24, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(367, 'Kabupaten Malinau', 24, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(368, 'Kabupaten Nunukan', 24, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(369, 'Kabupaten Tana Tidung', 24, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(370, 'Kota Tarakan', 24, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(371, 'Kabupaten Bolaang Mongondow', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(372, 'Kabupaten Bolaang Mongondow Selatan', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(373, 'Kabupaten Bolaang Mongondow Timur', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(374, 'Kabupaten Bolaang Mongondow Utara', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(375, 'Kabupaten Kepulauan Sangihe', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(376, 'Kabupaten Kepulauan Siau Tagulandang Biaro', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(377, 'Kabupaten Kepulauan Talaud', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(378, 'Kabupaten Minahasa', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(379, 'Kabupaten Minahasa Selatan', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(380, 'Kabupaten Minahasa Tenggara', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(381, 'Kabupaten Minahasa Utara', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(382, 'Kota Bitung', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(383, 'Kota Kotamobagu', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(384, 'Kota Manado', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(385, 'Kota Tomohon', 25, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(386, 'Kabupaten Banggai', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(387, 'Kabupaten Banggai Kepulauan', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(388, 'Kabupaten Banggai Laut', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(389, 'Kabupaten Buol', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(390, 'Kabupaten Donggala', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(391, 'Kabupaten Morowali', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(392, 'Kabupaten Morowali Utara', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(393, 'Kabupaten Parigi Moutong', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(394, 'Kabupaten Poso', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(395, 'Kabupaten Sigi', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(396, 'Kabupaten Tojo Una-Una', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(397, 'Kabupaten Tolitoli', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(398, 'Kota Palu', 26, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(399, 'Kabupaten Bantaeng', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(400, 'Kabupaten Barru', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(401, 'Kabupaten Bone', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(402, 'Kabupaten Bulukumba', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(403, 'Kabupaten Enrekang', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(404, 'Kabupaten Gowa', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(405, 'Kabupaten Jeneponto', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(406, 'Kabupaten Kepulauan Selayar', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(407, 'Kabupaten Luwu', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(408, 'Kabupaten Luwu Timur', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(409, 'Kabupaten Luwu Utara', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(410, 'Kabupaten Maros', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(411, 'Kabupaten Pangkajene dan Kepulauan', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(412, 'Kabupaten Pinrang', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(413, 'Kabupaten Sidenreng Rappang', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(414, 'Kabupaten Sinjai', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(415, 'Kabupaten Soppeng', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(416, 'Kabupaten Takalar', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(417, 'Kabupaten Tana Toraja', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(418, 'Kabupaten Toraja Utara', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(419, 'Kabupaten Wajo', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(420, 'Kota Makassar', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(421, 'Kota Palopo', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(422, 'Kota Parepare', 27, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(423, 'Kabupaten Bombana', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(424, 'Kabupaten Buton', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(425, 'Kabupaten Buton Selatan', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(426, 'Kabupaten Buton Tengah', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(427, 'Kabupaten Buton Utara', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(428, 'Kabupaten Kolaka', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(429, 'Kabupaten Kolaka Timur', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(430, 'Kabupaten Kolaka Utara', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(431, 'Kabupaten Konawe', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(432, 'Kabupaten Konawe Kepulauan', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(433, 'Kabupaten Konawe Selatan', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(434, 'Kabupaten Konawe Utara', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(435, 'Kabupaten Muna', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(436, 'Kabupaten Muna Barat', 28, '2024-01-09 11:42:24', '2024-01-09 11:42:24'),
(437, 'Kabupaten Wakatobi', 28, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(438, 'Kota Baubau', 28, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(439, 'Kota Kendari', 28, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(440, 'Kabupaten Boalemo', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(441, 'Kabupaten Bone Bolango', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(442, 'Kabupaten Gorontalo', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(443, 'Kabupaten Gorontalo Utara', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(444, 'Kabupaten Pohuwato', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(445, 'Kota Gorontalo', 29, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(446, 'Kabupaten Majene', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(447, 'Kabupaten Mamasa', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(448, 'Kabupaten Mamuju', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(449, 'Kabupaten Mamuju Tengah', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(450, 'Kabupaten Pasangkayu', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(451, 'Kabupaten Polewali Mandar', 30, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(452, 'Kabupaten Buru', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(453, 'Kabupaten Buru Selatan', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(454, 'Kabupaten Kepulauan Aru', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(455, 'Kabupaten Kepulauan Tanimbar', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(456, 'Kabupaten Maluku Barat Daya', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(457, 'Kabupaten Maluku Tengah', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(458, 'Kabupaten Maluku Tenggara', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(459, 'Kabupaten Seram Bagian Barat', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(460, 'Kabupaten Seram Bagian Timur', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(461, 'Kota Ambon', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(462, 'Kota Tual', 31, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(463, 'Kabupaten Halmahera Barat', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(464, 'Kabupaten Halmahera Selatan', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(465, 'Kabupaten Halmahera Tengah', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(466, 'Kabupaten Halmahera Timur', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(467, 'Kabupaten Halmahera Utara', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(468, 'Kabupaten Kepulauan Sula', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(469, 'Kabupaten Pulau Morotai', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(470, 'Kabupaten Pulau Taliabu', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(471, 'Kota Ternate', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(472, 'Kota Tidore Kepulauan', 32, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(473, 'Kabupaten Biak Numfor', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(474, 'Kabupaten Jayapura', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(475, 'Kabupaten Keerom', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(476, 'Kabupaten Kepulauan Yapen', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(477, 'Kabupaten Mamberamo Raya', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(478, 'Kabupaten Sarmi', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(479, 'Kabupaten Supiori', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(480, 'Kabupaten Waropen', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(481, 'Kota Jayapura', 33, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(482, 'Kabupaten Fakfak', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(483, 'Kabupaten Kaimana', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(484, 'Kabupaten Manokwari', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(485, 'Kabupaten Manokwari Selatan', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(486, 'Kabupaten Pegunungan Arfak', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(487, 'Kabupaten Teluk Bintuni', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(488, 'Kabupaten Teluk Wondama', 34, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(489, 'Kabupaten Asmat', 35, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(490, 'Kabupaten Boven Digoel', 35, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(491, 'Kabupaten Mappi', 35, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(492, 'Kabupaten Merauke', 35, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(493, 'Kabupaten Deiyai', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(494, 'Kabupaten Dogiyai', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(495, 'Kabupaten Intan Jaya', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(496, 'Kabupaten Mimika', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(497, 'Kabupaten Nabire', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(498, 'Kabupaten Paniai', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(499, 'Kabupaten Puncak', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(500, 'Kabupaten Puncak Jaya', 36, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(501, 'Kabupaten Jayawijaya', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(502, 'Kabupaten Lanny Jaya', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(503, 'Kabupaten Mamberamo Tengah', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(504, 'Kabupaten Nduga', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(505, 'Kabupaten Pegunungan Bintang', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(506, 'Kabupaten Tolikara', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(507, 'Kabupaten Yalimo', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(508, 'Kabupaten Yahukimo', 37, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(509, 'Kabupaten Maybrat', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(510, 'Kabupaten Raja Ampat', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(511, 'Kabupaten Sorong', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(512, 'Kabupaten Sorong Selatan', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(513, 'Kabupaten Tambrauw', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(514, 'Kota Sorong', 38, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `paket_hotel_id`, `nomor_kamar`, `tipe_kamar`, `kapasitas`, `fasilitas`, `tersedia`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, '2', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(3, 1, '3', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(4, 1, '4', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(5, 1, '5', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(6, 1, '6', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(7, 1, '7', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(8, 1, '8', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(9, 1, '9', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(10, 1, '10', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(11, 1, '11', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(12, 1, '12', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(13, 1, '13', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(14, 1, '14', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(15, 1, '15', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(16, 1, '16', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(17, 1, '17', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(18, 1, '18', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(19, 1, '19', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(20, 1, '20', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(21, 1, '21', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(22, 1, '22', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(23, 1, '23', 'Double', 2, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(24, 2, '1', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(25, 2, '2', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(26, 2, '3', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(27, 2, '4', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(28, 2, '5', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(29, 2, '6', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(30, 2, '7', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(31, 2, '8', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(32, 2, '9', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(33, 2, '10', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(34, 2, '11', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(35, 2, '12', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(36, 2, '13', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(37, 2, '14', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(38, 2, '15', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(39, 2, '16', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(40, 2, '17', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(41, 2, '18', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(42, 2, '19', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(43, 2, '20', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(44, 2, '21', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(45, 2, '22', 'Quad', 4, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(46, 2, '23', 'Double', 2, 'Bintang 5', 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `kamar_jemaah`
--

INSERT INTO `kamar_jemaah` (`id`, `kamar_id`, `jemaah_id`, `created_at`, `updated_at`) VALUES
(1, 23, 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 46, 1, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(3, 23, 2, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(4, 46, 2, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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
  `foto_kantor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id`, `nama_kantor`, `nama_ketua`, `kontak_kantor`, `alamat_kantor`, `kabupaten_id`, `kecamatan`, `kode_pos`, `jenis_kantor`, `foto_kantor`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Pusat', 'Ria Maelasari', NULL, 'Jl. RA. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315', 170, 'Karawang Barat', '41315', 'pusat', 'kantor-foto/kantor-haifa-pusat.jpeg', '2024-01-09 11:42:25', '2024-01-15 08:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi_konten` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `indelible` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `user_id`, `nama`, `judul`, `isi_konten`, `gambar`, `indelible`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Beranda 1', 'Haia Nida Wisata', '<p>\n                                    Tour & Travel\n                                    <br>\n                                    No. SK : 91202027102820002\n                                    <br>\n                                    2 Agustus 2022\n                                </p>', 'konten-gambar/beranda-slide1.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, 1, 'Beranda 2', 'Berdiri sejak tahun 2007', '<p>\n                                    didirikan oleh Dr. Fakhrurrozi, Lc., MA, seorang alumni Universitas Islam Madinah yang\n                                    memiliki pengalaman mendalam dan wawasan yang tak ternilai tentang Mekkah dan Madinah.\n                                    Kombinasi pengetahuannya yang mendalam tentang destinasi suci bersama keahliannya dalam\n                                    ilmu agama, menjadikan kami pilihan utama untuk perjalanan Haji, Umroh, dan wisata halal\n                                    Anda.\n                                </p>', 'konten-gambar/beranda-slide2.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, 1, 'Beranda 3', 'Aman, Nyaman dan Amanah', '<p>\n                                    \"Aman, Nyaman, dan Amanah\" adalah sebuah moto yang sangat kuat dan menggambarkan prinsip\n                                    utama PT. Haifa Nida Wisata dalam memberikan pelayanan kepada para jamaah. Kombinasi\n                                    dari keamanan, kenyamanan, dan keamanahan mencerminkan komitmen kami untuk memberikan\n                                    pengalaman perjalanan ibadah yang tak terlupakan. Dalam setiap perjalanan bersama kami,\n                                    kami berusaha untuk menjaga ketiga nilai ini sebagai fondasi utama dalam layanan kami\n                                    kepada Anda.\n                                </p>', 'konten-gambar/beranda-slide3.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(4, 1, 'Beranda 4', 'Sejarah PT. Haifa Nida Wisata Karawang', '<p>\n                                PT. Haifa Nida Wisata Karawang, didirikan pada tahun 2007 oleh Dr. Fakhrurrozi, Lc., MA,\n                                seorang alumni Universitas Islam Madinah yang memiliki pengalaman mendalam dan wawasan yang\n                                tak ternilai tentang Mekkah dan Madinah. Kombinasi pengetahuannya yang mendalam tentang\n                                destinasi suci bersama keahliannya dalam ilmu agama, menjadikan kami pilihan utama untuk\n                                perjalanan Haji, Umroh, dan wisata halal Anda\n                            </p>\n                            <p>\n                                Pendiri bukan hanya seorang alumni Universitas Islam Madinah yang berpengalaman dalam bidang\n                                perjalanan ibadah, tetapi juga merupakan otak di balik Catering Al-Haidari di Madinah.\n                                Pengalamannya yang luas dalam bisnis perhotelan dan sarana transportasi di Kota Mekkah dan\n                                Madinah membuatnya menjadi sumber pengetahuan yang tak ternilai dalam menyediakan pelayanan\n                                berkualitas tinggi kepada para jamaah Haji dan Umroh.\n                            </p>\n                            <p>\n                                Tak hanya itu, Dr. Fakhrurrozi juga merupakan pemilik Bakso Si Adoel yang terkenal di\n                                Madinah dan selalu buka selama musim Haji. Kombinasi pengalaman dan dedikasi dalam\n                                memberikan pengalaman terbaik kepada para tamu Allah menjadikannya alasan yang sangat kuat\n                                untuk memilih PT. Haifa Nida Wisata sebagai mitra perjalanan Haji dan Umroh Anda.\n                                Keberadaannya yang berpengalaman adalah jaminan kualitas dalam setiap perjalanan ibadah\n                                Anda.\n                            </p>', 'konten-gambar/beranda-sejarah.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(5, 1, 'Profil Perusahaan', 'Profil Perusahaan', '<p>\n\n                            </p>', 'konten-gambar/profil-perusahaan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(6, 1, 'Visi Misi', 'Visi Misi', '<p>\n\n                            </p>', 'konten-gambar/visi-misi.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(7, 1, 'FAQ', 'Frequently Asked Questions', '<p>\n\n                            </p>', 'konten-gambar/faq.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(8, 1, 'Panduan', 'Panduan', '<p>\n\n                            </p>', 'konten-gambar/panduan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(9, 1, 'Syarat dan Ketentuan', 'Syarat & Ketentuan', '<p>\n\n                            </p>', 'konten-gambar/syarat-ketentuan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(10, 1, 'Kebijakan Privasi', 'Kebijakan Privasi', '<p>\n\n                            </p>', 'konten-gambar/kebijakan-privasi.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(11, 1, 'Akte Perusahaan', 'Akte Perusahaan', '<p>\n                Nomor Akte:\n                            </p>', 'konten-gambar/akte-perusahaan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(12, 1, 'NIB', 'NIB', '<p>\n                Nomor NIB:\n                            </p>', 'konten-gambar/nib.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(13, 1, 'PPIU', 'PPIU', '<p>\n                Nomor PPIU:\n                            </p>', 'konten-gambar/ppiu.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(14, 1, 'PIHK', 'PIHK', '<p>\n                Nomor PIHK:\n                            </p>', 'konten-gambar/pihk.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(15, 1, 'ASITA', 'ASITA', '<p>\n                Nomor ASITA:\n                            </p>', 'konten-gambar/asita.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(16, 1, 'IATA', 'IATA', '<p>\n                Nomor IATA:\n                            </p>', 'konten-gambar/iata.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(17, 1, 'Motto', 'Motto', '<p>\n\n                            </p>', 'konten-gambar/motto.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(18, 1, 'Slogan', 'Slogan', '<p>\n\n                            </p>', 'konten-gambar/slogan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(19, 1, 'Struktur Organisasi', 'Struktur Organisasi', '<p>\n\n                            </p>', 'konten-gambar/struktur-organsiasi.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(20, 1, 'Alamat Kantor Pusat', 'Alamat', '<p>\n                Jl. Ra. Kartini No.1, Karangpawitan, Kec. Karawang Barat, Karawang, Jawa Barat 41315\n                            </p>', 'konten-gambar/alamat.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(21, 1, 'Rekening Perusahaan', 'Rekening Rekening Perusahaan', '<p>\n                            </p>', 'konten-gambar/rekening-perusahaan.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(22, 1, 'sejarah', 'sejarah', '<p>\n                            </p>', 'konten-gambar/sejarah.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(23, 1, 'Arti Motto', 'Arti Motto', '<p>\n                            </p>', 'konten-gambar/arti-motto.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(24, 1, 'Logo Mitra', 'Logo Mitra', '<p>\n                            </p>', 'konten-gambar/logo-mitra.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(25, 1, 'Sosial Media', 'Sosial Media', '<p>\n                            </p>', 'konten-gambar/social-media.jpg', 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(26, 1, 'Konten', 'Konten', '<p>\n                            </p>', 'konten-gambar/konten.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(27, 1, 'Kontak Utama', 'Kontak Utama', '<p>\n                            </p>', 'konten-gambar/kontak-utama.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(28, 1, 'Email Utama', 'Email Utama', '<p>\n                            </p>', 'konten-gambar/email-utama.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(29, 1, 'Email CS', 'Email CS', '<p>\n                            </p>', 'konten-gambar/email-cs.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(30, 1, 'Email Admin', 'Email Admin', '<p>\n                            </p>', 'konten-gambar/email-admin.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(31, 1, 'Nomor Direksi', 'Nomor Direksi', '<p>\n                            </p>', 'konten-gambar/nomor-direksi.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(32, 1, 'Nomor Marketing', 'Nomor Marketing', '<p>\n                            </p>', 'konten-gambar/nomor-marketing.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(33, 1, 'Nomor Keuangan', 'Nomor Keuangan', '<p>\n                            </p>', 'konten-gambar/nomor-keuangan.jpg', 0, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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
(1, 'AA', 'American Airlines', 'Amerika Serikat', 'maskapai-logo/aa.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:27', '2024-01-09 11:42:27'),
(2, 'DL', 'Delta Air Lines', 'Amerika Serikat', 'maskapai-logo/dl.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Amerika Serikat', NULL, '2024-01-09 11:42:27', '2024-01-09 11:42:27'),
(3, 'UA', 'United Airlines', 'Amerika Serikat', 'maskapai-logo/ua.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Amerika Serikat', NULL, '2024-01-09 11:42:28', '2024-01-09 11:42:28'),
(4, 'WN', 'Southwest Airlines Co.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/wn.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:28', '2024-01-09 11:42:28'),
(5, 'CZ', 'China Southern Airlines', 'Cina', 'maskapai-logo/cz.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:28', '2024-01-09 11:42:28'),
(6, 'MU', 'China Eastern', 'Cina', 'maskapai-logo/mu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:28', '2024-01-09 11:42:28'),
(7, 'OO', 'SkyWest Airlines', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/oo.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:29', '2024-01-09 11:42:29'),
(8, 'CA', 'Air China Limited', 'Cina', 'maskapai-logo/ca.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:29', '2024-01-09 11:42:29'),
(9, 'FX', 'Federal Express', 'Amerika Serikat', 'maskapai-logo/fx.png', 'Maskapai penerbangan dijadwalkan, kargo dari Amerika Serikat', NULL, '2024-01-09 11:42:29', '2024-01-09 11:42:29'),
(10, 'FR', 'Ryanair Ltd.', 'Irlandia', 'maskapai-logo/fr.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2024-01-09 11:42:30', '2024-01-09 11:42:30'),
(11, 'XE', 'Expressjet', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/xe.png', 'Maskapai penerbangan  dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:30', '2024-01-09 11:42:30'),
(12, 'TK', 'THY - Turkish Airlines', 'Turki', 'maskapai-logo/tk.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2024-01-09 11:42:30', '2024-01-09 11:42:30'),
(13, 'LH', 'Lufthansa Cargo', 'Jerman', 'maskapai-logo/lh.png', 'Maskapai penerbangan dijadwalkan, kargo dari Jerman', NULL, '2024-01-09 11:42:30', '2024-01-09 11:42:30'),
(14, 'BA', 'British Airways', 'Britania Raya', 'maskapai-logo/ba.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:42:31', '2024-01-09 11:42:31'),
(15, 'EK', 'Emirates', 'Uni Emirat Arab', 'maskapai-logo/ek.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2024-01-09 11:42:31', '2024-01-09 11:42:31'),
(16, '5X', 'UPS Airlines', 'Amerika Serikat', 'maskapai-logo/5x.png', 'Maskapai penerbangan muatan dari Amerika Serikat', NULL, '2024-01-09 11:42:31', '2024-01-09 11:42:31'),
(17, 'U2', 'Easyjet Airline Company Limited', 'Britania Raya', 'maskapai-logo/u2.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:42:32', '2024-01-09 11:42:32'),
(18, 'AF', 'Air France', 'Perancis', 'maskapai-logo/af.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2024-01-09 11:42:32', '2024-01-09 11:42:32'),
(19, 'B6', 'JetBlue', 'Amerika Serikat', 'maskapai-logo/b6.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:32', '2024-01-09 11:42:32'),
(20, 'NH', 'All Nippon Airways', 'Jepang', 'maskapai-logo/nh.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:42:32', '2024-01-09 11:42:32'),
(21, 'QR', 'Qatar Airways', 'Qatar', 'maskapai-logo/qr.png', 'Maskapai penerbangan dijadwalkan dari Qatar', NULL, '2024-01-09 11:42:33', '2024-01-09 11:42:33'),
(22, 'MQ', 'Envoy Air Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/mq.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:33', '2024-01-09 11:42:33'),
(23, 'SU', 'Aeroflot', 'Rusia', 'maskapai-logo/su.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:42:33', '2024-01-09 11:42:33'),
(24, 'ZH', 'Shenzhen Airlines', 'Cina', 'maskapai-logo/zh.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:34', '2024-01-09 11:42:34'),
(25, 'AC', 'Air Canada', 'Kanada', 'maskapai-logo/ac.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:42:34', '2024-01-09 11:42:34'),
(26, 'JJ', 'TAM Linhas Aereas', 'Brazil', 'maskapai-logo/jj.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2024-01-09 11:42:34', '2024-01-09 11:42:34'),
(27, 'JL', 'Japan Airlines', 'Jepang', 'maskapai-logo/jl.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:42:35', '2024-01-09 11:42:35'),
(28, 'KE', 'Korean Air', 'Korea Selatan', 'maskapai-logo/ke.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:42:35', '2024-01-09 11:42:35'),
(29, 'AS', 'Alaska Airlines', 'Amerika Serikat', 'maskapai-logo/as.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:35', '2024-01-09 11:42:35'),
(30, 'HU', 'Hainan Airlines', 'Cina', 'maskapai-logo/hu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:35', '2024-01-09 11:42:35'),
(31, 'SK', 'SAS', 'Swedia', 'maskapai-logo/sk.png', 'Maskapai penerbangan dijadwalkan dari Swedia', NULL, '2024-01-09 11:42:36', '2024-01-09 11:42:36'),
(32, 'GA', 'Garuda', 'Indonesia', 'maskapai-logo/ga.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:42:36', '2024-01-09 11:42:36'),
(33, 'CX', 'Cathay Pacific', 'Hongkong', 'maskapai-logo/cx.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2024-01-09 11:42:36', '2024-01-09 11:42:36'),
(34, 'RW', 'Republic Airlines', 'Amerika Serikat', 'maskapai-logo/rw.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:37', '2024-01-09 11:42:37'),
(35, 'SV', 'Saudi Arabian Airlines', 'Arab Saudi', 'maskapai-logo/sv.png', 'Maskapai penerbangan dijadwalkan dari Arab Saudi', NULL, '2024-01-09 11:42:37', '2024-01-09 11:42:37'),
(36, 'AD', 'Azul Brazilian Airlines', 'Brazil', 'maskapai-logo/ad.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2024-01-09 11:42:37', '2024-01-09 11:42:37'),
(37, 'MF', 'Xiamen Airlines', 'Cina', 'maskapai-logo/mf.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:37', '2024-01-09 11:42:37'),
(38, 'G3', 'Gol Linhas Aéreas Inteligentes\nGol Linhas Aéreas Inteligentes\n', 'Brazil', 'maskapai-logo/g3.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2024-01-09 11:42:38', '2024-01-09 11:42:38'),
(39, 'QK', 'Jazz Aviation LP', 'Kanada', 'maskapai-logo/qk.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:42:38', '2024-01-09 11:42:38'),
(40, 'EY', 'Etihad Airways', 'Uni Emirat Arab', 'maskapai-logo/ey.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2024-01-09 11:42:38', '2024-01-09 11:42:38'),
(41, 'LA', 'Lan Airlines', 'Chili', 'maskapai-logo/la.png', 'Maskapai penerbangan dijadwalkan dari Chili', NULL, '2024-01-09 11:42:39', '2024-01-09 11:42:39'),
(42, '9E', 'Endeavor Air', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/9e.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:39', '2024-01-09 11:42:39'),
(43, 'YV', 'Mesa Airlines, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/yv.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:39', '2024-01-09 11:42:39'),
(44, 'QF', 'Qantas', 'Australia', 'maskapai-logo/qf.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:42:40', '2024-01-09 11:42:40'),
(45, 'JT', 'Lion Airlines', 'Indonesia', 'maskapai-logo/jt.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:42:40', '2024-01-09 11:42:40'),
(46, 'WS', 'WestJet', 'Kanada', 'maskapai-logo/ws.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:42:40', '2024-01-09 11:42:40'),
(47, 'KL', 'KLM', 'Belanda', 'maskapai-logo/kl.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2024-01-09 11:42:40', '2024-01-09 11:42:40'),
(48, 'SQ', 'SIA Cargo', 'Singapura', 'maskapai-logo/sq.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2024-01-09 11:42:41', '2024-01-09 11:42:41'),
(49, 'OH', 'PSA Airlines', 'Amerika Serikat', 'maskapai-logo/oh.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:41', '2024-01-09 11:42:41'),
(50, 'AI', 'Air India', 'India', 'maskapai-logo/ai.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:42:41', '2024-01-09 11:42:41'),
(51, '3U', 'Sichuan Airlines', 'Cina', 'maskapai-logo/3u.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:42', '2024-01-09 11:42:42'),
(52, '6E', 'Interglobe Aviation Ltd. dba Indigo', 'India', 'maskapai-logo/6e.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:42:42', '2024-01-09 11:42:42'),
(53, 'VY', 'Vueling', 'Spanyol', 'maskapai-logo/vy.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:42:42', '2024-01-09 11:42:42'),
(54, 'AZ', 'Alitalia', 'Italia', 'maskapai-logo/az.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2024-01-09 11:42:42', '2024-01-09 11:42:42'),
(55, 'AV', 'AVIANCA', 'Kolumbia', 'maskapai-logo/av.png', 'Maskapai penerbangan dijadwalkan dari Kolumbia', NULL, '2024-01-09 11:42:43', '2024-01-09 11:42:43'),
(56, 'VA', 'Virgin Australia', 'Australia', 'maskapai-logo/va.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:42:43', '2024-01-09 11:42:43'),
(57, 'S5', 'Shuttle America', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/s5.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:43', '2024-01-09 11:42:43'),
(58, 'SC', 'Shandong Airlines', 'Cina', 'maskapai-logo/sc.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:44', '2024-01-09 11:42:44'),
(59, '9W', 'Jet Airways', 'India', 'maskapai-logo/9w.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:42:44', '2024-01-09 11:42:44'),
(60, 'GS', 'Tianjin Airlines', 'Cina', 'maskapai-logo/gs.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:44', '2024-01-09 11:42:44'),
(61, 'VN', 'Vietnam Airlines', 'Vietnam', 'maskapai-logo/vn.png', 'Maskapai penerbangan dijadwalkan dari Vietnam', NULL, '2024-01-09 11:42:44', '2024-01-09 11:42:44'),
(62, 'CM', 'COPA Airlines', 'Panama', 'maskapai-logo/cm.png', 'Maskapai penerbangan dijadwalkan dari Panama', NULL, '2024-01-09 11:42:45', '2024-01-09 11:42:45'),
(63, 'FM', 'Shanghai Airlines', 'Cina', 'maskapai-logo/fm.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:45', '2024-01-09 11:42:45'),
(64, 'AB', 'Air Berlin', 'Jerman', 'maskapai-logo/ab.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:42:45', '2024-01-09 11:42:45'),
(65, 'OS', 'Austrian', 'Austria', 'maskapai-logo/os.png', 'Maskapai penerbangan dijadwalkan dari Austria', NULL, '2024-01-09 11:42:46', '2024-01-09 11:42:46'),
(66, 'NK', 'Spirit Airlines', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/nk.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:46', '2024-01-09 11:42:46'),
(67, 'OZ', 'Asiana', 'Korea Selatan', 'maskapai-logo/oz.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:42:46', '2024-01-09 11:42:46'),
(68, 'CI', 'China Airlines', 'Cina Taipei', 'maskapai-logo/ci.png', 'Maskapai penerbangan dijadwalkan dari Cina Taipei', NULL, '2024-01-09 11:42:46', '2024-01-09 11:42:46'),
(69, 'G4', 'Allegiant Air LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/g4.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:47', '2024-01-09 11:42:47'),
(70, 'MH', 'Malaysia Airlines', 'Malaysia', 'maskapai-logo/mh.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2024-01-09 11:42:47', '2024-01-09 11:42:47'),
(71, 'AK', 'AirAsia Berhad dba AirAsia', 'Malaysia', 'maskapai-logo/ak.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2024-01-09 11:42:47', '2024-01-09 11:42:47'),
(72, 'TG', 'Thai Airways International', 'Thailand', 'maskapai-logo/tg.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:42:48', '2024-01-09 11:42:48'),
(73, 'IB', 'IBERIA', 'Spanyol', 'maskapai-logo/ib.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:42:48', '2024-01-09 11:42:48'),
(74, 'BE', 'flybe', 'Britania Raya', 'maskapai-logo/be.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:42:48', '2024-01-09 11:42:48'),
(75, 'ET', 'Ethiopian Airlines', 'Etiopia', 'maskapai-logo/et.png', 'Maskapai penerbangan dijadwalkan dari Etiopia', NULL, '2024-01-09 11:42:48', '2024-01-09 11:42:48'),
(76, 'JQ', 'Jetstar Airways Pty Limited', 'Australia', 'maskapai-logo/jq.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:42:49', '2024-01-09 11:42:49'),
(77, 'W6', 'Wizz Air Hungary Ltd.', 'Hungaria', 'maskapai-logo/w6.png', 'Maskapai penerbangan dijadwalkan dari Hungaria', NULL, '2024-01-09 11:42:49', '2024-01-09 11:42:49'),
(78, 'ZW', 'Air Wisconsin Airlines Corporation (AWAC)', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/zw.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:49', '2024-01-09 11:42:49'),
(79, 'LX', 'SWISS', 'Swiss', 'maskapai-logo/lx.png', 'Maskapai penerbangan dijadwalkan dari Swiss', NULL, '2024-01-09 11:42:50', '2024-01-09 11:42:50'),
(80, 'AX', 'Trans States Airlines, LLC', 'Amerika Serikat', 'maskapai-logo/ax.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:50', '2024-01-09 11:42:50'),
(81, 'BR', 'EVA Air', 'Cina Taipei', 'maskapai-logo/br.png', 'Maskapai penerbangan dijadwalkan dari Cina Taipei', NULL, '2024-01-09 11:42:50', '2024-01-09 11:42:50'),
(82, 'S7', 'S7 Airlines', 'Rusia', 'maskapai-logo/s7.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:42:50', '2024-01-09 11:42:50'),
(83, 'AM', 'Aeromexico', 'Meksiko', 'maskapai-logo/am.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:42:51', '2024-01-09 11:42:51'),
(84, '4O', 'Interjet', 'Meksiko', 'maskapai-logo/4o.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:42:51', '2024-01-09 11:42:51'),
(85, '5D', 'Aerolitoral S.A. de C.V.', 'Meksiko', 'maskapai-logo/5d.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:42:51', '2024-01-09 11:42:51'),
(86, 'JD', 'Capital Airlines', 'Cina', 'maskapai-logo/jd.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:51', '2024-01-09 11:42:51'),
(87, 'PC', 'Pegasus Airlines', 'Turki', 'maskapai-logo/pc.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2024-01-09 11:42:52', '2024-01-09 11:42:52'),
(88, 'UT', 'UTair', 'Rusia', 'maskapai-logo/ut.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:42:52', '2024-01-09 11:42:52'),
(89, 'BY', 'TUI Airways Limited', 'Britania Raya', 'maskapai-logo/by.png', 'Maskapai penerbangan dijadwalkan, piagam dari Britania Raya', NULL, '2024-01-09 11:42:52', '2024-01-09 11:42:52'),
(90, 'CP', 'Compass Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/cp.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:53', '2024-01-09 11:42:53'),
(91, 'TP', 'TAP Portugal', 'Portugal', 'maskapai-logo/tp.png', 'Maskapai penerbangan dijadwalkan dari Portugal', NULL, '2024-01-09 11:42:53', '2024-01-09 11:42:53'),
(92, 'VX', 'Virgin America', 'Amerika Serikat', 'maskapai-logo/vx.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:42:53', '2024-01-09 11:42:53'),
(93, 'Y4', 'Volaris', 'Meksiko', 'maskapai-logo/y4.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:42:54', '2024-01-09 11:42:54'),
(94, '4U', 'Germanwings GmbH', 'Jerman', 'maskapai-logo/4u.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:42:54', '2024-01-09 11:42:54'),
(95, 'LS', 'Jet2.com Limited', 'Britania Raya', 'maskapai-logo/ls.png', 'Maskapai penerbangan dijadwalkan, kargo dari Britania Raya', NULL, '2024-01-09 11:42:54', '2024-01-09 11:42:54'),
(96, 'PR', 'Philippine Airlines', 'Filipina', 'maskapai-logo/pr.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2024-01-09 11:42:54', '2024-01-09 11:42:54'),
(97, '9C', 'Spring Airlines Limited Corporation', 'Cina', 'maskapai-logo/9c.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:42:55', '2024-01-09 11:42:55'),
(98, 'F9', 'Frontier Airlines, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/f9.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:55', '2024-01-09 11:42:55'),
(99, '5J', 'Cebu Pacific Air', 'Filipina', 'maskapai-logo/5j.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2024-01-09 11:42:55', '2024-01-09 11:42:55'),
(100, 'DY', 'Norwegian Air Shuttle A.S.', 'Norway', 'maskapai-logo/dy.png', 'Maskapai penerbangan dijadwalkan dari Norway', NULL, '2024-01-09 11:42:56', '2024-01-09 11:42:56'),
(101, 'MS', 'Egyptair', 'Mesir', 'maskapai-logo/ms.png', 'Maskapai penerbangan dijadwalkan dari Mesir', NULL, '2024-01-09 11:42:56', '2024-01-09 11:42:56'),
(102, 'NZ', 'Air New Zealand', 'Selandia Baru', 'maskapai-logo/nz.png', 'Maskapai penerbangan dijadwalkan dari Selandia Baru', NULL, '2024-01-09 11:42:57', '2024-01-09 11:42:57'),
(103, 'AR', 'Aerolineas Argentinas', 'Argentina', 'maskapai-logo/ar.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2024-01-09 11:42:57', '2024-01-09 11:42:57'),
(104, 'G7', 'GoJet Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/g7.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:57', '2024-01-09 11:42:57'),
(105, 'UX', 'Air Europa', 'Spanyol', 'maskapai-logo/ux.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:42:58', '2024-01-09 11:42:58'),
(106, 'QX', 'Horizon Air Industries, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/qx.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:42:58', '2024-01-09 11:42:58'),
(107, 'SA', 'SAA', 'Afrika Selatan', 'maskapai-logo/sa.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2024-01-09 11:42:58', '2024-01-09 11:42:58'),
(108, 'ZL', 'REX Regional Express', 'Australia', 'maskapai-logo/zl.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:42:58', '2024-01-09 11:42:58'),
(109, 'AH', 'Air Algerie', 'Aljazair', 'maskapai-logo/ah.png', 'Maskapai penerbangan dijadwalkan dari Aljazair', NULL, '2024-01-09 11:42:59', '2024-01-09 11:42:59'),
(110, 'AY', 'Finnair', 'Pulau Aland', 'maskapai-logo/ay.png', 'Maskapai penerbangan dijadwalkan dari Pulau Aland', NULL, '2024-01-09 11:42:59', '2024-01-09 11:42:59'),
(111, 'CL', 'Lufthansa CityLine', 'Jerman', 'maskapai-logo/cl.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:42:59', '2024-01-09 11:42:59'),
(112, 'FV', 'Rossiya Airlines', 'Rusia', 'maskapai-logo/fv.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:00', '2024-01-09 11:43:00'),
(113, 'FZ', 'flydubai', 'Uni Emirat Arab', 'maskapai-logo/fz.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2024-01-09 11:43:00', '2024-01-09 11:43:00'),
(114, 'HO', 'Juneyao Airlines', 'Cina', 'maskapai-logo/ho.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:00', '2024-01-09 11:43:00'),
(115, 'IW', 'PT. Wings Abadi Airlines', 'Indonesia', 'maskapai-logo/iw.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:01', '2024-01-09 11:43:01'),
(116, 'SN', 'Brussels Airlines', 'Belgium', 'maskapai-logo/sn.png', 'Maskapai penerbangan dijadwalkan dari Belgium', NULL, '2024-01-09 11:43:01', '2024-01-09 11:43:01'),
(117, 'W5', 'Mahan Air', 'Iran', 'maskapai-logo/w5.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2024-01-09 11:43:01', '2024-01-09 11:43:01'),
(118, 'AT', 'Royal Air Maroc', 'Maroko', 'maskapai-logo/at.png', 'Maskapai penerbangan dijadwalkan dari Maroko', NULL, '2024-01-09 11:43:01', '2024-01-09 11:43:01'),
(119, 'EI', 'Aer Lingus', 'Irlandia', 'maskapai-logo/ei.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2024-01-09 11:43:02', '2024-01-09 11:43:02'),
(120, 'FD', 'Thai AirAsia', 'Thailand', 'maskapai-logo/fd.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:43:02', '2024-01-09 11:43:02'),
(121, 'HA', 'Hawaiian Airlines', 'Amerika Serikat', 'maskapai-logo/ha.png', 'Maskapai penerbangan dijadwalkan dari Amerika Serikat', NULL, '2024-01-09 11:43:02', '2024-01-09 11:43:02'),
(122, 'A3', 'Aegean Airlines', 'Yunani', 'maskapai-logo/a3.png', 'Maskapai penerbangan dijadwalkan dari Yunani', NULL, '2024-01-09 11:43:02', '2024-01-09 11:43:02'),
(123, 'IR', 'Iran Air', 'Iran', 'maskapai-logo/ir.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2024-01-09 11:43:03', '2024-01-09 11:43:03'),
(124, 'WA', 'KLM Cityhopper', 'Belanda', 'maskapai-logo/wa.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2024-01-09 11:43:03', '2024-01-09 11:43:03'),
(125, 'DE', 'Condor', 'Jerman', 'maskapai-logo/de.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:43:03', '2024-01-09 11:43:03'),
(126, 'O6', 'Avianca Brasil', 'Brazil', 'maskapai-logo/o6.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2024-01-09 11:43:04', '2024-01-09 11:43:04'),
(127, 'RV', 'Air Canada rouge', 'Kanada', 'maskapai-logo/rv.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:04', '2024-01-09 11:43:04'),
(128, 'YS', 'Regional Compagnie Aerienne Europee t/a HOP!-REGIONAL', 'Perancis', 'maskapai-logo/ys.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2024-01-09 11:43:04', '2024-01-09 11:43:04'),
(129, 'KA', 'Dragonair', 'Hongkong', 'maskapai-logo/ka.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2024-01-09 11:43:04', '2024-01-09 11:43:04'),
(130, 'LO', 'LOT Polish Airlines', 'Polandia', 'maskapai-logo/lo.png', 'Maskapai penerbangan dijadwalkan dari Polandia', NULL, '2024-01-09 11:43:05', '2024-01-09 11:43:05'),
(131, 'QG', 'PT. Citilink Indonesia', 'Indonesia', 'maskapai-logo/qg.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:05', '2024-01-09 11:43:05'),
(132, 'SG', 'SpiceJet Ltd.', 'India', 'maskapai-logo/sg.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:43:05', '2024-01-09 11:43:05'),
(133, 'WY', 'Oman Air', 'Oman', 'maskapai-logo/wy.png', 'Maskapai penerbangan dijadwalkan dari Oman', NULL, '2024-01-09 11:43:06', '2024-01-09 11:43:06'),
(134, 'EH', 'ANA Wings Co., Ltd.', 'Jepang', 'maskapai-logo/eh.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:43:06', '2024-01-09 11:43:06'),
(135, 'HV', 'Transavia Airlines', 'Belanda', 'maskapai-logo/hv.png', 'Maskapai penerbangan dijadwalkan dari Belanda', NULL, '2024-01-09 11:43:06', '2024-01-09 11:43:06'),
(136, 'WF', 'Wideroe', 'Norway', 'maskapai-logo/wf.png', 'Maskapai penerbangan dijadwalkan dari Norway', NULL, '2024-01-09 11:43:06', '2024-01-09 11:43:06'),
(137, 'X3', 'TUIfly', 'Jerman', 'maskapai-logo/x3.png', 'Maskapai penerbangan dijadwalkan, piagam dari Jerman', NULL, '2024-01-09 11:43:07', '2024-01-09 11:43:07'),
(138, 'D8', 'Norwegian Air International LTD.', 'Irlandia', 'maskapai-logo/d8.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2024-01-09 11:43:07', '2024-01-09 11:43:07'),
(139, 'LY', 'EL AL', 'Israel', 'maskapai-logo/ly.png', 'Maskapai penerbangan dijadwalkan dari Israel', NULL, '2024-01-09 11:43:07', '2024-01-09 11:43:07'),
(140, 'VS', 'Virgin Atlantic', 'Britania Raya', 'maskapai-logo/vs.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:08', '2024-01-09 11:43:08'),
(141, 'MT', 'Thomas Cook Airlines Limited of Manchester', 'Britania Raya', 'maskapai-logo/mt.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:08', '2024-01-09 11:43:08'),
(142, 'PK', 'PIA', 'Pakistan', 'maskapai-logo/pk.png', 'Maskapai penerbangan dijadwalkan dari Pakistan', NULL, '2024-01-09 11:43:08', '2024-01-09 11:43:08'),
(143, 'WG', 'Sunwing Airlines Inc.', 'Kanada', 'maskapai-logo/wg.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:08', '2024-01-09 11:43:08'),
(144, 'ID', 'PT. Batik Air Indonesia', 'Indonesia', 'maskapai-logo/id.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:09', '2024-01-09 11:43:09'),
(145, 'SJ', 'PT. Sriwijaya Air', 'Indonesia', 'maskapai-logo/sj.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:09', '2024-01-09 11:43:09'),
(146, 'U6', 'Ural Airlines', 'Rusia', 'maskapai-logo/u6.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:09', '2024-01-09 11:43:09'),
(147, 'WT', 'Swiftair, S.A.', 'Spanyol', 'maskapai-logo/wt.png', 'Maskapai penerbangan dijadwalkan, piagam dari Spanyol', NULL, '2024-01-09 11:43:10', '2024-01-09 11:43:10'),
(148, '5Y', 'Atlas Air', 'Amerika Serikat', 'maskapai-logo/5y.png', 'Maskapai penerbangan dijadwalkan, piagam dari Amerika Serikat', NULL, '2024-01-09 11:43:10', '2024-01-09 11:43:10'),
(149, 'G9', 'Air Arabia', 'Uni Emirat Arab', 'maskapai-logo/g9.png', 'Maskapai penerbangan dijadwalkan dari Uni Emirat Arab', NULL, '2024-01-09 11:43:10', '2024-01-09 11:43:10'),
(150, 'TA', 'TACA', 'Penyelamat', 'maskapai-logo/ta.png', 'Maskapai penerbangan dijadwalkan dari Penyelamat', NULL, '2024-01-09 11:43:11', '2024-01-09 11:43:11'),
(151, 'FY', 'FlyFirefly Sdn. Bhd', 'Malaysia', 'maskapai-logo/fy.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2024-01-09 11:43:11', '2024-01-09 11:43:11'),
(152, 'PS', 'Ukraine International Airlines', 'Ukraina', 'maskapai-logo/ps.png', 'Maskapai penerbangan dijadwalkan dari Ukraina', NULL, '2024-01-09 11:43:11', '2024-01-09 11:43:11'),
(153, 'YW', 'Air Nostrum', 'Spanyol', 'maskapai-logo/yw.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:43:12', '2024-01-09 11:43:12'),
(154, 'ZB', 'Monarch Airlines', 'Britania Raya', 'maskapai-logo/zb.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:12', '2024-01-09 11:43:12'),
(155, '4Z', 'Airlink', 'Afrika Selatan', 'maskapai-logo/4z.png', 'Maskapai penerbangan terjadwal, virtual dari Afrika Selatan', NULL, '2024-01-09 11:43:12', '2024-01-09 11:43:12'),
(156, 'KQ', 'Kenya Airways', 'Kenya', 'maskapai-logo/kq.png', 'Maskapai penerbangan dijadwalkan dari Kenya', NULL, '2024-01-09 11:43:13', '2024-01-09 11:43:13'),
(157, 'KN', 'China United Airlines', 'Cina', 'maskapai-logo/kn.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:13', '2024-01-09 11:43:13'),
(158, 'B2', 'Belavia - Belarusian Airlines', 'Belarusia', 'maskapai-logo/b2.png', 'Maskapai penerbangan dijadwalkan dari Belarusia', NULL, '2024-01-09 11:43:13', '2024-01-09 11:43:13'),
(159, 'PG', 'Bangkok Air', 'Thailand', 'maskapai-logo/pg.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:43:13', '2024-01-09 11:43:13'),
(160, 'QY', 'European Air Transport', 'Jerman', 'maskapai-logo/qy.png', 'Maskapai penerbangan dijadwalkan, kargo dari Jerman', NULL, '2024-01-09 11:43:14', '2024-01-09 11:43:14'),
(161, 'TS', 'Air Transat', 'Kanada', 'maskapai-logo/ts.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:14', '2024-01-09 11:43:14'),
(162, 'VJ', 'Vietjet Aviation Joint Stock Company', 'Vietnam', 'maskapai-logo/vj.png', 'Maskapai penerbangan dijadwalkan dari Vietnam', NULL, '2024-01-09 11:43:14', '2024-01-09 11:43:14'),
(163, 'DB', 'HOP!-BRIT AIR', 'Perancis', 'maskapai-logo/db.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2024-01-09 11:43:15', '2024-01-09 11:43:15'),
(164, 'EW', 'Eurowings', 'Jerman', 'maskapai-logo/ew.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:43:15', '2024-01-09 11:43:15'),
(165, 'HX', 'Hong Kong Airlines', 'Hongkong', 'maskapai-logo/hx.png', 'Maskapai penerbangan dijadwalkan dari Hongkong', NULL, '2024-01-09 11:43:15', '2024-01-09 11:43:15'),
(166, 'IA', 'Iraqi Airways', 'Irak', 'maskapai-logo/ia.png', 'Maskapai penerbangan dijadwalkan dari Irak', NULL, '2024-01-09 11:43:15', '2024-01-09 11:43:15'),
(167, 'DC', 'Braathens Regional', 'Swedia', 'maskapai-logo/dc.png', 'Maskapai penerbangan terjadwal, virtual dari Swedia', NULL, '2024-01-09 11:43:16', '2024-01-09 11:43:16'),
(168, 'EP', 'Iran Aseman Airlines', 'Iran', 'maskapai-logo/ep.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2024-01-09 11:43:16', '2024-01-09 11:43:16'),
(169, 'FI', 'Icelandair', 'Islandia', 'maskapai-logo/fi.png', 'Maskapai penerbangan dijadwalkan dari Islandia', NULL, '2024-01-09 11:43:16', '2024-01-09 11:43:16'),
(170, 'KC', 'Air Astana', 'Kazakstan', 'maskapai-logo/kc.png', 'Maskapai penerbangan dijadwalkan dari Kazakstan', NULL, '2024-01-09 11:43:17', '2024-01-09 11:43:17'),
(171, 'MI', 'Silkair', 'Singapura', 'maskapai-logo/mi.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2024-01-09 11:43:17', '2024-01-09 11:43:17'),
(172, 'TU', 'Tunisair', 'Tunisia', 'maskapai-logo/tu.png', 'Maskapai penerbangan dijadwalkan dari Tunisia', NULL, '2024-01-09 11:43:17', '2024-01-09 11:43:17'),
(173, 'XR', 'Virgin Australia Regional', 'Australia', 'maskapai-logo/xr.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:43:17', '2024-01-09 11:43:17'),
(174, 'ZK', 'Great Lakes Aviation Ltd.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/zk.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:18', '2024-01-09 11:43:18'),
(175, 'D0', 'DHL Air', 'Britania Raya', 'maskapai-logo/d0.png', 'Maskapai penerbangan dijadwalkan, kargo dari Britania Raya', NULL, '2024-01-09 11:43:18', '2024-01-09 11:43:18'),
(176, 'DD', 'Nok Airlines Public Company Limited dba Nok Air', 'Thailand', 'maskapai-logo/dd.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:43:18', '2024-01-09 11:43:18'),
(177, 'GF', 'Gulf Air', 'Bahrain', 'maskapai-logo/gf.png', 'Maskapai penerbangan dijadwalkan dari Bahrain', NULL, '2024-01-09 11:43:19', '2024-01-09 11:43:19'),
(178, 'HY', 'Uzbekistan Airways', 'Uzbekistan', 'maskapai-logo/hy.png', 'Maskapai penerbangan dijadwalkan dari Uzbekistan', NULL, '2024-01-09 11:43:19', '2024-01-09 11:43:19'),
(179, 'J2', 'Azerbaijan Airlines', 'Azerbaijan', 'maskapai-logo/j2.png', 'Maskapai penerbangan dijadwalkan dari Azerbaijan', NULL, '2024-01-09 11:43:19', '2024-01-09 11:43:19'),
(180, 'O3', 'SF Airlines Company Limited', 'Cina', 'maskapai-logo/o3.png', 'Maskapai penerbangan muatan dari Cina', NULL, '2024-01-09 11:43:19', '2024-01-09 11:43:19'),
(181, 'SL', 'Solenta Aviation', 'Afrika Selatan', 'maskapai-logo/sl.png', 'Maskapai penerbangan piagam dari Afrika Selatan', NULL, '2024-01-09 11:43:20', '2024-01-09 11:43:20'),
(182, 'WR', 'WestJet Encore', 'Kanada', 'maskapai-logo/wr.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:20', '2024-01-09 11:43:20'),
(183, 'XY', 'NATIONAL AIR SERVICES dba FLYNAS', 'Arab Saudi', 'maskapai-logo/xy.png', 'Maskapai penerbangan terjadwal, pribadi dari Arab Saudi', NULL, '2024-01-09 11:43:20', '2024-01-09 11:43:20'),
(184, '8L', 'Lucky Air', 'Cina', 'maskapai-logo/8l.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:21', '2024-01-09 11:43:21'),
(185, 'GB', 'ABX Air, Inc.', 'Amerika Serikat', 'maskapai-logo/gb.png', 'Maskapai penerbangan muatan dari Amerika Serikat', NULL, '2024-01-09 11:43:21', '2024-01-09 11:43:21'),
(186, 'OD', 'Malindo Airways Sdn Bhd ( Malindo A', 'Malaysia', 'maskapai-logo/od.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2024-01-09 11:43:21', '2024-01-09 11:43:21'),
(187, 'QQ', 'Alliance Airlines', 'Australia', 'maskapai-logo/qq.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:43:21', '2024-01-09 11:43:21'),
(188, 'TB', 'TUI Airlines Belgium t/a Jetairfly', 'Belgium', 'maskapai-logo/tb.png', 'Maskapai penerbangan dijadwalkan dari Belgium', NULL, '2024-01-09 11:43:22', '2024-01-09 11:43:22'),
(189, 'PD', 'Porter Airlines Inc.', 'Kanada', 'maskapai-logo/pd.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:22', '2024-01-09 11:43:22'),
(190, 'Y8', 'Yangtze River Express Airlines Co. LTD', 'Cina', 'maskapai-logo/y8.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:22', '2024-01-09 11:43:22'),
(191, 'YC', 'Joint-Stock Company \"Yamal Airlines\"', 'Rusia', 'maskapai-logo/yc.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:23', '2024-01-09 11:43:23'),
(192, '3V', 'TNT Airways S.A.', 'Belgium', 'maskapai-logo/3v.png', 'Maskapai penerbangan muatan dari Belgium', NULL, '2024-01-09 11:43:23', '2024-01-09 11:43:23'),
(193, '8Q', 'Onur Air', 'Turki', 'maskapai-logo/8q.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2024-01-09 11:43:23', '2024-01-09 11:43:23'),
(194, 'G5', 'China Express Airlines', 'Cina', 'maskapai-logo/g5.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:23', '2024-01-09 11:43:23'),
(195, 'RJ', 'Royal Jordanian', 'Yordania', 'maskapai-logo/rj.png', 'Maskapai penerbangan dijadwalkan dari Yordania', NULL, '2024-01-09 11:43:24', '2024-01-09 11:43:24'),
(196, 'RS', 'Sky Regional', 'Kanada', 'maskapai-logo/rs.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:24', '2024-01-09 11:43:24'),
(197, 'TO', 'Transavia France', 'Perancis', 'maskapai-logo/to.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2024-01-09 11:43:24', '2024-01-09 11:43:24'),
(198, 'V0', 'CONVIASA', 'Venezuela', 'maskapai-logo/v0.png', 'Maskapai penerbangan dijadwalkan dari Venezuela', NULL, '2024-01-09 11:43:25', '2024-01-09 11:43:25'),
(199, 'XQ', 'SunExpress', 'Turki', 'maskapai-logo/xq.png', 'Maskapai penerbangan dijadwalkan dari Turki', NULL, '2024-01-09 11:43:25', '2024-01-09 11:43:25'),
(200, 'ZX', 'Air Georgian Ltd. dba Air Alliance', 'Kanada', 'maskapai-logo/zx.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:25', '2024-01-09 11:43:25'),
(201, '7C', 'Jeju Air Co. Ltd.', 'Korea Selatan', 'maskapai-logo/7c.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:43:26', '2024-01-09 11:43:26'),
(202, 'AU', 'Austral', 'Argentina', 'maskapai-logo/au.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2024-01-09 11:43:26', '2024-01-09 11:43:26'),
(203, 'BC', 'Skymark Airlines Inc.', 'Jepang', 'maskapai-logo/bc.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:43:26', '2024-01-09 11:43:26'),
(204, 'BT', 'Air Baltic', 'Latvia', 'maskapai-logo/bt.png', 'Maskapai penerbangan dijadwalkan dari Latvia', NULL, '2024-01-09 11:43:26', '2024-01-09 11:43:26'),
(205, 'C5', 'Champlain Enterprises Inc. dba Commutair', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/c5.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:27', '2024-01-09 11:43:27'),
(206, 'NM', 'Mount Cook Airlines', 'Selandia Baru', 'maskapai-logo/nm.png', 'Maskapai penerbangan dijadwalkan dari Selandia Baru', NULL, '2024-01-09 11:43:27', '2024-01-09 11:43:27'),
(207, 'TR', 'Tiger Airways', 'Singapura', 'maskapai-logo/tr.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2024-01-09 11:43:27', '2024-01-09 11:43:27'),
(208, '7R', 'Joint Stock Aviation Company \"RusLine\"', 'Rusia', 'maskapai-logo/7r.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:28', '2024-01-09 11:43:28'),
(209, 'A5', 'HOP!', 'Perancis', 'maskapai-logo/a5.png', 'Maskapai penerbangan dijadwalkan dari Perancis', NULL, '2024-01-09 11:43:28', '2024-01-09 11:43:28'),
(210, 'D7', 'Airasia X Berhad dba Airasia X', 'Malaysia', 'maskapai-logo/d7.png', 'Maskapai penerbangan dijadwalkan dari Malaysia', NULL, '2024-01-09 11:43:28', '2024-01-09 11:43:28'),
(211, 'DS', 'Easyjet Switzerland S.A', 'Swiss', 'maskapai-logo/ds.png', 'Maskapai penerbangan dijadwalkan dari Swiss', NULL, '2024-01-09 11:43:28', '2024-01-09 11:43:28'),
(212, 'J4*', 'Jet Time', 'Denmark', 'maskapai-logo/j4*.png', 'Maskapai penerbangan dijadwalkan dari Denmark', NULL, '2024-01-09 11:43:29', '2024-01-09 11:43:29'),
(213, 'KU', 'Kuwait Airways', 'Kuwait', 'maskapai-logo/ku.png', 'Maskapai penerbangan dijadwalkan dari Kuwait', NULL, '2024-01-09 11:43:29', '2024-01-09 11:43:29'),
(214, 'PN', 'China West Air Co. Ltd.', 'Cina', 'maskapai-logo/pn.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:29', '2024-01-09 11:43:29'),
(215, 'RO', 'TAROM', 'Rumania', 'maskapai-logo/ro.png', 'Maskapai penerbangan dijadwalkan dari Rumania', NULL, '2024-01-09 11:43:30', '2024-01-09 11:43:30'),
(216, 'V7', 'Volotea, S.L.', 'Spanyol', 'maskapai-logo/v7.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:43:30', '2024-01-09 11:43:30'),
(217, 'W3', 'Arik Air', 'Nigeria', 'maskapai-logo/w3.png', 'Maskapai penerbangan dijadwalkan dari Nigeria', NULL, '2024-01-09 11:43:30', '2024-01-09 11:43:30'),
(218, '3M', 'Silver Airways Corp', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/3m.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:30', '2024-01-09 11:43:30'),
(219, 'CF', 'China Postal Airlines', 'Cina', 'maskapai-logo/cf.png', 'Maskapai penerbangan muatan dari Cina', NULL, '2024-01-09 11:43:31', '2024-01-09 11:43:31'),
(220, 'EU', 'Chengdu Airlines', 'Cina', 'maskapai-logo/eu.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:31', '2024-01-09 11:43:31'),
(221, 'GE', 'TransAsia Airways', 'Taiwan', 'maskapai-logo/ge.png', 'Maskapai penerbangan dijadwalkan dari Taiwan', NULL, '2024-01-09 11:43:31', '2024-01-09 11:43:31'),
(222, 'PX', 'Air Niugini', 'Papua Nugini', 'maskapai-logo/px.png', 'Maskapai penerbangan dijadwalkan dari Papua Nugini', NULL, '2024-01-09 11:43:32', '2024-01-09 11:43:32'),
(223, 'QZ', 'PT. Indonesia AirAsia', 'Indonesia', 'maskapai-logo/qz.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:32', '2024-01-09 11:43:32'),
(224, 'ST', 'Germania', 'Jerman', 'maskapai-logo/st.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:43:32', '2024-01-09 11:43:32'),
(225, 'T5', 'Turkmenistan Airlines', 'Turkmenistan', 'maskapai-logo/t5.png', 'Maskapai penerbangan dijadwalkan dari Turkmenistan', NULL, '2024-01-09 11:43:32', '2024-01-09 11:43:32'),
(226, 'XZ', 'South African Express Airways', 'Afrika Selatan', 'maskapai-logo/xz.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2024-01-09 11:43:33', '2024-01-09 11:43:33'),
(227, 'I2', 'Compania Operadora de Corto y Medio Radio Iberia Express, S.A.U', 'Spanyol', 'maskapai-logo/i2.png', 'Maskapai penerbangan dijadwalkan dari Spanyol', NULL, '2024-01-09 11:43:33', '2024-01-09 11:43:33'),
(228, 'UL', 'SriLankan', 'Srilanka', 'maskapai-logo/ul.png', 'Maskapai penerbangan dijadwalkan dari Srilanka', NULL, '2024-01-09 11:43:33', '2024-01-09 11:43:33'),
(229, '5Z', 'Cemair (Pty) Ltd. t/a Cemair', 'Afrika Selatan', 'maskapai-logo/5z.png', 'Maskapai penerbangan dijadwalkan dari Afrika Selatan', NULL, '2024-01-09 11:43:34', '2024-01-09 11:43:34'),
(230, 'CT', 'Alitalia CityLiner S.p.A.', 'Italia', 'maskapai-logo/ct.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2024-01-09 11:43:34', '2024-01-09 11:43:34'),
(231, 'CV', 'Cargolux S.A.', 'Luksemburg', 'maskapai-logo/cv.png', 'Maskapai penerbangan dijadwalkan, kargo dari Luksemburg', NULL, '2024-01-09 11:43:34', '2024-01-09 11:43:34'),
(232, 'GK', 'Jetstar Japan Co., Ltd.', 'Jepang', 'maskapai-logo/gk.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:43:34', '2024-01-09 11:43:34'),
(233, 'HZ', 'Joint- Stock Company \"Aurora Airlines\"', 'Rusia', 'maskapai-logo/hz.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:35', '2024-01-09 11:43:35'),
(234, 'IG', 'Meridiana fly', 'Italia', 'maskapai-logo/ig.png', 'Maskapai penerbangan dijadwalkan dari Italia', NULL, '2024-01-09 11:43:35', '2024-01-09 11:43:35'),
(235, 'IX', 'Air India Charters Limited', 'India', 'maskapai-logo/ix.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:43:35', '2024-01-09 11:43:35'),
(236, 'KK', 'Atlasjet Airlines', 'Turki', 'maskapai-logo/kk.png', 'Maskapai penerbangan dijadwalkan, piagam dari Turki', NULL, '2024-01-09 11:43:35', '2024-01-09 11:43:35'),
(237, 'KS', 'Penair', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/ks.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:36', '2024-01-09 11:43:36'),
(238, 'LM', 'Loganair Limited', 'Britania Raya', 'maskapai-logo/lm.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:36', '2024-01-09 11:43:36'),
(239, 'ME', 'MEA', 'Libanon', 'maskapai-logo/me.png', 'Maskapai penerbangan dijadwalkan dari Libanon', NULL, '2024-01-09 11:43:36', '2024-01-09 11:43:36'),
(240, 'QB', 'Qeshm Air', 'Iran', 'maskapai-logo/qb.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2024-01-09 11:43:37', '2024-01-09 11:43:37'),
(241, 'SL2', 'Thai Lion Air', 'Thailand', 'maskapai-logo/sl2.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:43:37', '2024-01-09 11:43:37'),
(242, 'SY', 'MN Airlines LLC', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/sy.png', 'Maskapai penerbangan dijadwalkan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:37', '2024-01-09 11:43:37'),
(243, '3X', 'Japan Air Commuter', 'Jepang', 'maskapai-logo/3x.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:43:37', '2024-01-09 11:43:37'),
(244, '7F', 'Bradley Air Services Limited t/a First Air', 'Kanada', 'maskapai-logo/7f.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:38', '2024-01-09 11:43:38'),
(245, 'BK', 'Okay Airways', 'Cina', 'maskapai-logo/bk.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:38', '2024-01-09 11:43:38'),
(246, 'CJ', 'BA Cityflyer Limited', 'Britania Raya', 'maskapai-logo/cj.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:38', '2024-01-09 11:43:38'),
(247, 'G8', 'Go Airlines (India) Ltd.', 'India', 'maskapai-logo/g8.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:43:39', '2024-01-09 11:43:39'),
(248, 'LJ', 'Jin Air Co. Ltd', 'Korea Selatan', 'maskapai-logo/lj.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:43:39', '2024-01-09 11:43:39'),
(249, 'NL', 'Shaheen Air International', 'Pakistan', 'maskapai-logo/nl.png', 'Maskapai penerbangan dijadwalkan dari Pakistan', NULL, '2024-01-09 11:43:39', '2024-01-09 11:43:39'),
(250, 'QS', 'Travel Service, A.S.', 'Republik Ceko', 'maskapai-logo/qs.png', 'Maskapai penerbangan dijadwalkan, piagam, divisi dari Republik Ceko', NULL, '2024-01-09 11:43:39', '2024-01-09 11:43:39'),
(251, 'VB', 'Aeroenlaces Nacionales S.A. De C.V.', 'Meksiko', 'maskapai-logo/vb.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:43:40', '2024-01-09 11:43:40'),
(252, '3K', 'Jetstar Asia Airways Pte Ltd', 'Singapura', 'maskapai-logo/3k.png', 'Maskapai penerbangan dijadwalkan dari Singapura', NULL, '2024-01-09 11:43:40', '2024-01-09 11:43:40'),
(253, '3K2', 'Jetstar Asia Airways - Singapore', 'Singapura', 'maskapai-logo/3k2.png', 'Maskapai penerbangan  dari Singapura', NULL, '2024-01-09 11:43:40', '2024-01-09 11:43:40'),
(254, '5T', 'Canadian North Inc.', 'Kanada', 'maskapai-logo/5t.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:40', '2024-01-09 11:43:40'),
(255, 'HG', 'NIKI', 'Austria', 'maskapai-logo/hg.png', 'Maskapai penerbangan dijadwalkan dari Austria', NULL, '2024-01-09 11:43:41', '2024-01-09 11:43:41'),
(256, 'NS', 'Hebei Airlines Co., Ltd.', 'Cina', 'maskapai-logo/ns.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:41', '2024-01-09 11:43:41'),
(257, 'OB', 'Boliviana de Aviacion - BoA', 'Bolivia', 'maskapai-logo/ob.png', 'Maskapai penerbangan dijadwalkan dari Bolivia', NULL, '2024-01-09 11:43:41', '2024-01-09 11:43:41'),
(258, 'OX', 'Orient Thai Airlines Company Ltd.', 'Thailand', 'maskapai-logo/ox.png', 'Maskapai penerbangan dijadwalkan, piagam dari Thailand', NULL, '2024-01-09 11:43:41', '2024-01-09 11:43:41'),
(259, 'RU', 'AirBridgeCargo Airlines', 'Rusia', 'maskapai-logo/ru.png', 'Maskapai penerbangan muatan dari Rusia', NULL, '2024-01-09 11:43:42', '2024-01-09 11:43:42'),
(260, 'WX', 'CityJet', 'Irlandia', 'maskapai-logo/wx.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2024-01-09 11:43:42', '2024-01-09 11:43:42'),
(261, '9I', 'Airline Allied Services Limited dba Alliance Air', 'India', 'maskapai-logo/9i.png', 'Maskapai penerbangan dijadwalkan dari India', NULL, '2024-01-09 11:43:42', '2024-01-09 11:43:42'),
(262, 'B7', 'UNI Airways Corporation', 'Taiwan', 'maskapai-logo/b7.png', 'Maskapai penerbangan dijadwalkan dari Taiwan', NULL, '2024-01-09 11:43:43', '2024-01-09 11:43:43'),
(263, 'BM', 'bmi Regional', 'Britania Raya', 'maskapai-logo/bm.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:43', '2024-01-09 11:43:43'),
(264, 'HE', 'LGW-Luftfahrtgesellschaft Walter GmbH', 'Jerman', 'maskapai-logo/he.png', 'Maskapai penerbangan dijadwalkan dari Jerman', NULL, '2024-01-09 11:43:43', '2024-01-09 11:43:43'),
(265, 'JU', 'Air SERBIA a.d. Beograd', 'Serbia', 'maskapai-logo/ju.png', 'Maskapai penerbangan dijadwalkan dari Serbia', NULL, '2024-01-09 11:43:43', '2024-01-09 11:43:43'),
(266, 'LG', 'Luxair', 'Luksemburg', 'maskapai-logo/lg.png', 'Maskapai penerbangan dijadwalkan dari Luksemburg', NULL, '2024-01-09 11:43:44', '2024-01-09 11:43:44'),
(267, 'MM', 'Peach Aviation Limited', 'Jepang', 'maskapai-logo/mm.png', 'Maskapai penerbangan dijadwalkan dari Jepang', NULL, '2024-01-09 11:43:44', '2024-01-09 11:43:44'),
(268, 'NI', 'PGA-Portugalia Airlines', 'Portugal', 'maskapai-logo/ni.png', 'Maskapai penerbangan dijadwalkan dari Portugal', NULL, '2024-01-09 11:43:44', '2024-01-09 11:43:44'),
(269, 'NX', 'Air Macau', 'Makau', 'maskapai-logo/nx.png', 'Maskapai penerbangan dijadwalkan dari Makau', NULL, '2024-01-09 11:43:45', '2024-01-09 11:43:45'),
(270, 'RE', 'Stobart Air', 'Irlandia', 'maskapai-logo/re.png', 'Maskapai penerbangan dijadwalkan dari Irlandia', NULL, '2024-01-09 11:43:45', '2024-01-09 11:43:45'),
(271, 'TT', 'Tigerair Australia', 'Australia', 'maskapai-logo/tt.png', 'Maskapai penerbangan dijadwalkan dari Australia', NULL, '2024-01-09 11:43:45', '2024-01-09 11:43:45'),
(272, 'YN', 'Air Creebec (1994) Inc.', 'Kanada', 'maskapai-logo/yn.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:45', '2024-01-09 11:43:45'),
(273, '2P', 'Air Philippines Corporation dba PAL Express and Airphil Express', 'Filipina', 'maskapai-logo/2p.png', 'Maskapai penerbangan dijadwalkan dari Filipina', NULL, '2024-01-09 11:43:46', '2024-01-09 11:43:46'),
(274, 'DZ', 'Donghai Airlines Co., Ltd', 'Cina', 'maskapai-logo/dz.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:46', '2024-01-09 11:43:46'),
(275, 'EQ', 'TAME - Linea Aerea del Ecuador', 'Ekuador', 'maskapai-logo/eq.png', 'Maskapai penerbangan dijadwalkan dari Ekuador', NULL, '2024-01-09 11:43:46', '2024-01-09 11:43:46'),
(276, 'GJ', 'Zhejiang Loong Airlines Co., Ltd', 'Cina', 'maskapai-logo/gj.png', 'Maskapai penerbangan dijadwalkan, kargo dari Cina', NULL, '2024-01-09 11:43:46', '2024-01-09 11:43:46'),
(277, 'IL', 'PT.Trigana Air Service', 'Indonesia', 'maskapai-logo/il.png', 'Maskapai penerbangan dijadwalkan dari Indonesia', NULL, '2024-01-09 11:43:47', '2024-01-09 11:43:47'),
(278, 'MN', 'Comair', 'Afrika Selatan', 'maskapai-logo/mn.png', 'Maskapai penerbangan dijadwalkan, pembagian dari Afrika Selatan', NULL, '2024-01-09 11:43:47', '2024-01-09 11:43:47'),
(279, 'VW', 'Transportes Aeromar, S.A. de C.V.', 'Meksiko', 'maskapai-logo/vw.png', 'Maskapai penerbangan dijadwalkan dari Meksiko', NULL, '2024-01-09 11:43:47', '2024-01-09 11:43:47'),
(280, 'WE', 'Thai Smile', 'Thailand', 'maskapai-logo/we.png', 'Maskapai penerbangan dijadwalkan dari Thailand', NULL, '2024-01-09 11:43:48', '2024-01-09 11:43:48'),
(281, '0B', 'Blue Air', 'Rumania', 'maskapai-logo/0b.png', 'Maskapai penerbangan dijadwalkan dari Rumania', NULL, '2024-01-09 11:43:48', '2024-01-09 11:43:48'),
(282, '9V', 'Avior Airlines, C.A.', 'Venezuela', 'maskapai-logo/9v.png', 'Maskapai penerbangan dijadwalkan dari Venezuela', NULL, '2024-01-09 11:43:48', '2024-01-09 11:43:48'),
(283, 'DT', 'TAAG - Angola Airlines', 'Angola', 'maskapai-logo/dt.png', 'Maskapai penerbangan dijadwalkan dari Angola', NULL, '2024-01-09 11:43:49', '2024-01-09 11:43:49'),
(284, 'DX', 'Danish Air Transport', 'Denmark', 'maskapai-logo/dx.png', 'Maskapai penerbangan dijadwalkan dari Denmark', NULL, '2024-01-09 11:43:49', '2024-01-09 11:43:49'),
(285, 'H2', 'SKY Airline', 'Chili', 'maskapai-logo/h2.png', 'Maskapai penerbangan dijadwalkan dari Chili', NULL, '2024-01-09 11:43:49', '2024-01-09 11:43:49');
INSERT INTO `maskapai` (`id`, `kode_maskapai`, `nama_maskapai`, `negara_asal`, `logo`, `deskripsi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(286, 'JV', 'Bearskin Lake air services LP', 'Kanada', 'maskapai-logo/jv.png', 'Maskapai penerbangan dijadwalkan dari Kanada', NULL, '2024-01-09 11:43:50', '2024-01-09 11:43:50'),
(287, 'NG', 'Aero Contractors', 'Nigeria', 'maskapai-logo/ng.png', 'Maskapai penerbangan dijadwalkan dari Nigeria', NULL, '2024-01-09 11:43:50', '2024-01-09 11:43:50'),
(288, 'OK', 'Czech Airlines j.s.c', 'Republik Ceko', 'maskapai-logo/ok.png', 'Maskapai penerbangan dijadwalkan dari Republik Ceko', NULL, '2024-01-09 11:43:50', '2024-01-09 11:43:50'),
(289, 'PO', 'Polar Air Cargo Worldwide, Inc.', 'Kepulauan Terluar Kecil Amerika Serikat', 'maskapai-logo/po.png', 'Maskapai penerbangan muatan dari Kepulauan Terluar Kecil Amerika Serikat', NULL, '2024-01-09 11:43:50', '2024-01-09 11:43:50'),
(290, 'SF', 'Tassili Airlines', 'Aljazair', 'maskapai-logo/sf.png', 'Maskapai penerbangan dijadwalkan dari Aljazair', NULL, '2024-01-09 11:43:51', '2024-01-09 11:43:51'),
(291, 'T3', 'Air Kilroe Limited t/a Eastern Airways', 'Britania Raya', 'maskapai-logo/t3.png', 'Maskapai penerbangan dijadwalkan dari Britania Raya', NULL, '2024-01-09 11:43:51', '2024-01-09 11:43:51'),
(292, 'TV', 'Tibet Airlines Corporation Limited', 'Cina', 'maskapai-logo/tv.png', 'Maskapai penerbangan dijadwalkan dari Cina', NULL, '2024-01-09 11:43:51', '2024-01-09 11:43:51'),
(293, 'TW', 'T\'way Air', 'Korea Selatan', 'maskapai-logo/tw.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:43:51', '2024-01-09 11:43:51'),
(294, 'UB', 'Myanmar National Airlines', 'Myanmar', 'maskapai-logo/ub.png', 'Maskapai penerbangan dijadwalkan dari Myanmar', NULL, '2024-01-09 11:43:52', '2024-01-09 11:43:52'),
(295, 'W8', 'Cargojet Airways', 'Kanada', 'maskapai-logo/w8.png', 'Maskapai penerbangan dijadwalkan, kargo dari Kanada', NULL, '2024-01-09 11:43:52', '2024-01-09 11:43:52'),
(296, 'Y7', 'Joint Stock Company Airline Taimyr', 'Rusia', 'maskapai-logo/y7.png', 'Maskapai penerbangan dijadwalkan dari Rusia', NULL, '2024-01-09 11:43:52', '2024-01-09 11:43:52'),
(297, 'ZE', 'EASTAR JET Co. Ltd.', 'Korea Selatan', 'maskapai-logo/ze.png', 'Maskapai penerbangan dijadwalkan dari Korea Selatan', NULL, '2024-01-09 11:43:53', '2024-01-09 11:43:53'),
(298, 'ZO', 'Zagros Airlines', 'Iran', 'maskapai-logo/zo.png', 'Maskapai penerbangan dijadwalkan dari Iran', NULL, '2024-01-09 11:43:54', '2024-01-09 11:43:54'),
(299, '2Z', 'Passaredo Transportes Aereos S.A.', 'Brazil', 'maskapai-logo/2z.png', 'Maskapai penerbangan dijadwalkan dari Brazil', NULL, '2024-01-09 11:43:54', '2024-01-09 11:43:54'),
(300, '4M', 'Lan Argentina', 'Argentina', 'maskapai-logo/4m.png', 'Maskapai penerbangan dijadwalkan dari Argentina', NULL, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `email` varchar(255) DEFAULT NULL,
  `tingkat_pendidikan` enum('SD','SLTP','SLTA','D1/D2/D3','D4/S1','S2','S3') DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `nomor_paspor` varchar(255) DEFAULT NULL,
  `tempat_dikeluarkan` varchar(255) DEFAULT NULL,
  `tanggal_dikeluarkan` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `pernah_umroh` tinyint(1) DEFAULT NULL,
  `pernah_haji` tinyint(1) DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `kontak_keluarga_terdekat` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_id`, `nomor_ktp`, `nama_lengkap`, `nama_sesuai_paspor`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kewarganegaraan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `nomor_telepon`, `email`, `tingkat_pendidikan`, `pekerjaan`, `nomor_paspor`, `tempat_dikeluarkan`, `tanggal_dikeluarkan`, `tanggal_kadaluarsa`, `pernah_umroh`, `pernah_haji`, `golongan_darah`, `foto`, `nama_keluarga_terdekat`, `kontak_keluarga_terdekat`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `has_dropdown` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `indelible` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu`, `has_dropdown`, `is_active`, `url`, `icon`, `order`, `indelible`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Main', 1, 1, NULL, NULL, 1000, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, NULL, 'Superadmin', 1, 1, NULL, NULL, 2000, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, NULL, 'Adminkantor', 1, 1, NULL, NULL, 3000, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(4, 1, 'Dashboard', 0, 1, '/admin/index', 'fa-solid fa-tachograph-digital', 1100, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(5, 1, 'Akun Saya', 1, 1, '#', 'fa-solid fa-user', 1200, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(6, 1, 'Halaman Web', 0, 1, '/home', 'fa-solid fa-globe', 1300, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(7, 2, 'Autentikasi & Otorisasi', 1, 1, '#', 'fa-solid fa-face-smile', 2100, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(8, 2, 'Manajemen Pengguna', 1, 1, '#', 'fa-solid fa-user', 2200, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(9, 2, 'Manajemen Aplikasi', 1, 1, '#', 'fa-regular fa-window-restore', 2300, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(10, 2, 'Manajemen Kantor', 1, 1, '#', 'fa-solid fa-building', 2400, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(11, 2, 'Master Data', 1, 1, '#', 'fa-solid fa-database', 2500, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(12, 3, 'Kantor Saya', 0, 1, '/admin/kantor-saya', 'fa-solid fa-house-user', 3100, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(13, 3, 'Manajemen Paket Wisata', 1, 1, '#', 'fa-solid fa-box-open', 3200, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(14, 3, 'Manajemen Jema\'ah', 1, 0, '#', 'fa-solid fa-person-praying', 3300, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(15, 3, 'Manajemen Grup', 1, 0, '#', 'fa-solid fa-people-group', 3400, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(16, 3, 'Pelayanan', 1, 0, '#', 'fa-solid fa-handshake-angle', 3500, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(17, 5, 'Profil Saya', 0, 1, '/admin/profile', '', 1101, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(18, 5, 'Saran dan Keluhan', 0, 1, '/admin/pesan', '', 1102, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(19, 7, 'Manajemen Role', 0, 1, '/admin/role', '', 2101, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(20, 7, 'Manajemen Akses', 0, 0, '/admin/role-menu', '', 2102, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(21, 8, 'Data Admin', 0, 1, '/admin/user-admin', '', 2201, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(22, 8, 'Data Author', 0, 1, '/admin/author', '', 2202, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(23, 8, 'Data Member', 0, 1, '/admin/member', '', 2203, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(24, 8, 'Data Agen', 0, 1, '/admin/agen', '', 2204, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(25, 9, 'Manajemen Menu', 0, 1, '/admin/menu', '', 2301, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(26, 9, 'Manajemen Sub Menu', 0, 0, '/admin/sub-menu', '', 2302, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(27, 9, 'Manajemen Konten', 0, 1, '/admin/konten', '', 2303, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(28, 10, 'Manajemen Kantor', 0, 1, '/admin/kantor', '', 2401, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(29, 10, 'Manajemen Perwakilan', 0, 1, '/admin/perwakilan', '', 2402, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(30, 10, 'Manajemen Cabang', 0, 1, '/admin/cabang', '', 2403, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(31, 11, 'Data Hotel', 0, 1, '/admin/hotel', '', 2501, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(32, 11, 'Data Maskapai', 0, 1, '/admin/maskapai', '', 2502, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(33, 11, 'Data Berkas', 0, 1, '/admin/berkas', '', 2503, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(34, 11, 'Data Ekstra', 0, 1, '/admin/ekstra', '', 2504, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(35, 13, 'Data Paket', 0, 1, '/admin/paket', '', 3101, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(36, 13, 'Galeri', 0, 0, '/admin/galeri', '', 3102, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(37, 13, 'Isu Perjalanan', 0, 0, '/admin/isu-perjalanan', '', 3103, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(38, 13, 'Jadwal', 0, 0, '/admin/jadwal', '', 3104, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(39, 14, 'Data Jema\'ah', 0, 0, '/admin/jemaah', '', 3201, 0, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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

--
-- Dumping data for table `menu_roles`
--

INSERT INTO `menu_roles` (`id`, `menu_id`, `role_id`, `can_view`, `can_edit`, `can_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, 2, 5, 1, 1, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, 3, 6, 1, 1, 1, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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
(48, '2023_12_12_205215_create_permintaan_kamar_table', 1),
(49, '2024_01_07_182624_create_jadwal_table', 1);

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
  `gambar` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `kantor_id`, `nama_paket`, `destinasi`, `jenis_paket`, `durasi`, `harga`, `fasilitas`, `deskripsi`, `tempat_keberangkatan`, `tempat_kepulangan`, `tanggal_mulai`, `tanggal_selesai`, `gambar`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Umroh 24.24', 'Jakarta - Jeddah - Mekkah - Madinah - Jakarta', 'umroh', 9, 24000000.00, '<p>\n                    <h6>Harga Termasuk</h6>\n                    <ul>\n                        <li>Tiket Pesawat</li>\n                        <li>Visa</li>\n                        <li>Makan 3x Sehari</li>\n                        <li>Muthowif Berbahasa Indonesia</li>\n                        <li>Tour & Ziarah</li>\n                        <li>Hotel Berbintang 3</li>\n                    </ul>\n                    <h6>Harga Tidak Termasuk</h6>\n                    <ul>\n                        <li>Pembuatan Paspor</li>\n                        <li>Vaksin Meningitis</li>\n                        <li>Tour diluar Paket</li>\n                        <li>Biaya Lounge, Handling dan Perlengkapan 1,5 juta</li>\n                        <li>Laundry</li>\n                    </ul>\n                </p>', 'Promo Umroh 24 Februari 2024', 'Jakarta', 'Jakarta', '2024-02-24', '2024-03-04', 'paket-gambar/umroh-24.jpg', NULL, '2024-01-09 11:43:55', '2024-01-09 11:43:55', NULL);

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

--
-- Dumping data for table `paket_ekstra`
--

INSERT INTO `paket_ekstra` (`id`, `paket_id`, `ekstra_id`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 21, 12000000.00, '2024-01-10 20:00:47', '2024-01-10 20:00:47');

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
  `total_harga` double(16,2) DEFAULT NULL,
  `keterangan_hotel` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_hotel`
--

INSERT INTO `paket_hotel` (`id`, `paket_id`, `hotel_id`, `nomor_reservasi`, `tanggal_check_in`, `tanggal_check_out`, `jumlah_kamar`, `total_harga`, `keterangan_hotel`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2024-02-25', '2024-02-29', 23, 97000000.00, 'Dekat dengan Masjid', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, 2, '2', '2024-02-29', '2024-03-04', 23, 97000000.00, 'Dekat dengan Masjid', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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
  `total_harga` double(16,2) DEFAULT NULL,
  `bandara_asal` varchar(255) DEFAULT NULL,
  `bandara_tujuan` varchar(255) DEFAULT NULL,
  `waktu_keberangkatan` datetime DEFAULT NULL,
  `waktu_kedatangan` datetime DEFAULT NULL,
  `status_penerbangan` enum('On Schedule','Delay','Canceled','Emergency Landing','Failed','Landed Safely','Accident','Crash') DEFAULT NULL,
  `tipe_penerbangan` enum('Langsung','Transit') DEFAULT NULL,
  `gate_penerbangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_maskapai`
--

INSERT INTO `paket_maskapai` (`id`, `paket_id`, `maskapai_id`, `nomor_penerbangan`, `nomor_pnr`, `kelas`, `kuota`, `keterangan_penerbangan`, `total_harga`, `bandara_asal`, `bandara_tujuan`, `waktu_keberangkatan`, `waktu_kedatangan`, `status_penerbangan`, `tipe_penerbangan`, `gate_penerbangan`, `created_at`, `updated_at`) VALUES
(1, 1, 186, '1', '1', 'Ekonomi', 90, '-', 1260000000.00, 'CGK - Bandar Udara Internasional Soekarno-Hatta', 'JED - King Abdul Aziz Internasional Airport', '2024-02-24 00:00:00', '2024-02-25 00:00:00', 'On Schedule', 'Transit', '4', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 1, 52, '2', '2', 'Ekonomi', 90, '-', 1260000000.00, 'MED - Prince Mohammad bin Abdul Aziz Internasional Airport', 'CGK - Bandar Udara Internasional Soekarno-Hatta', '2024-03-04 00:00:00', '2024-03-05 00:00:00', 'On Schedule', 'Transit', '4', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pemesanan_id`, `jumlah_pembayaran`, `metode_pembayaran`, `tanggal_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 56000000.00, 'Transfer Mandiri', '2024-01-09 11:43:55', 'pembayaran-bukti/bukti-transaksi.jpg', 'diterima', NULL, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `tanggal_pesan` date DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `total_harga` double(16,2) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `is_pembayaran_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_pelunasan` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `paket_id`, `user_id`, `status`, `tanggal_pesan`, `jumlah_orang`, `total_harga`, `metode_pembayaran`, `is_pembayaran_lunas`, `tanggal_pelunasan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Tertunda', '2024-01-09', 2, 48000000.00, 'Cash', 1, '2024-01-09', NULL, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_ekstra`
--

CREATE TABLE `pemesanan_ekstra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ekstra` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `total_harga` double(16,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan_ekstra`
--

INSERT INTO `pemesanan_ekstra` (`id`, `pemesanan_id`, `ekstra`, `jumlah`, `total_harga`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Perlengkapan', '2', 3000000.00, '2', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `pemesanan_kamar`
--

INSERT INTO `pemesanan_kamar` (`id`, `pemesanan_id`, `tipe_kamar`, `jumlah_pengisi`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'tipe kamar double keluarga', '2', 5000000.00, NULL, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `permintaan_kamar`
--

INSERT INTO `permintaan_kamar` (`id`, `pemesanan_kamar_id`, `permintaan`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kamar View Kakbah', 5000000.00, NULL, '2024-01-10 16:18:33', '2024-01-10 16:18:33');

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
  `nama_perwakilan` varchar(255) DEFAULT NULL,
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
(1, 'Aceh', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(2, 'Sumatera Utara', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(3, 'Sumatera Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(4, 'Riau', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(5, 'Jambi', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(6, 'Sumatera Selatan', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(7, 'Bengkulu', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(8, 'Lampung', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(9, 'Kepulauan Riau', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(10, 'Kepulauan Bangka Belitung', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(11, 'DKI Jakarta', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(12, 'Jawa Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(13, 'Jawa Tengah', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(14, 'DI Yogyakarta', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(15, 'Jawa Timur', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(16, 'Banten', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(17, 'Bali', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(18, 'Nusa Tenggara Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(19, 'Nusa Tenggara Timur', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(20, 'Kalimantan Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(21, 'Kalimantan Tengah', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(22, 'Kalimantan Selatan', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(23, 'Kalimantan Timur', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(24, 'Kalimantan Utara', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(25, 'Sulawesi Utara', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(26, 'Sulawesi Tengah', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(27, 'Sulawesi Selatan', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(28, 'Sulawesi Tenggara', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(29, 'Gorontalo', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(30, 'Sulawesi Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(31, 'Maluku', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(32, 'Maluku Utara', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(33, 'Papua', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(34, 'Papua Barat', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(35, 'Papua Selatan', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(36, 'Papua Tengah', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(37, 'Papua Pegunungan', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(38, 'Papua Barat Daya', '2024-01-09 11:42:23', '2024-01-09 11:42:23'),
(39, 'Nusantara', '2024-01-09 11:42:23', '2024-01-09 11:42:23');

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

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, 'author', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, 'member', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(4, 'agen', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(5, 'superadmin', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(6, 'adminkantor', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(7, 'jemaah', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(8, 'pusat', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(9, 'cabang', '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(10, 'perwakilan', '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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
  `sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sertifikat_jemaah`
--

INSERT INTO `sertifikat_jemaah` (`id`, `jemaah_id`, `nomor_sertifikat`, `tanggal_penerbitan`, `tanggal_kadaluarsa`, `jenis_sertifikat`, `sertifikat`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '2024-03-05', NULL, 'Sertifikat Umroh', 'jemaah-sertifikat/sertifikat-1.jpg', '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 2, '2', '2024-03-05', NULL, 'Sertifikat Umroh', 'jemaah-sertifikat/sertifikat-2.jpg', '2024-01-09 11:43:55', '2024-01-09 11:43:55');

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

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `jemaah_id`, `isi_testimoni`, `rating`, `disetujui`, `created_at`, `updated_at`) VALUES
(1, 1, 'PT. Haifa Nida Wisata adalah biro perjalanan Umroh Terbaik', 5, 0, '2024-01-09 11:43:55', '2024-01-09 11:43:55'),
(2, 2, 'PT. Haifa Nida Wisata adalah biro perjalanan Umroh Terbaik', 5, 0, '2024-01-09 11:43:55', '2024-01-09 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `google_token` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `phone_number`, `password`, `google_id`, `google_token`, `avatar`, `photo`, `role_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@haifanida.com', 'admin', '2024-01-09 11:42:25', NULL, '$2y$10$g9DYEIAaBJ8PQ/3fnyWwsO10RrI1IyXAdrx.cMsjQiPP/r9xWCJbu', NULL, NULL, NULL, 'user-photo/administrator.png', 1, NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(2, 'Haitsam', 'haitsam03@gmail.com', 'haitsam', '2024-01-09 11:42:25', NULL, '$2y$10$s0qEFm70Mh6jNOyBvCYCeecOSSD9vLPHE.dhm2tUCoKSS92YFOyCm', '113982475180921431021', 'ya29.a0AfB_byDUt-piBnkg82ZwvgmfTzUMSTioC6rBX-Dd4F4vokCprL06tXZkFEARAN_JRrSSVe7EB8j_3GVyRCzJrjq7VfuIe3SHhcp7ENIQ48x3ASsDPyJeURmbj8aqsyMcfs4RT2ipFwVJncanBSyPKJser8kHPZcJgZijaCgYKATYSARASFQHGX2Mi9_AfUUxXAHgAGWYPH2glYg0171', 'https://lh3.googleusercontent.com/a/ACg8ocLiEOS4CVAtLdSqyBys53Or930-Efoh48Y2-Oxn-zplBRQ=s96-c', 'user-photo/haitsam.jpg', 3, NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(3, 'Abu Haitsam / Fakhry El-Razy / Fahruroji / Dr. Fakhrur Rozi Lc.MA', 'fakhryelrazy@gmail.com', 'fakhry', '2024-01-09 11:42:25', NULL, '$2y$10$5nZpDQElSa4KzgxivLxeA.XafySEAjCl381yDh4VPh9vxzkkCKeni', NULL, NULL, NULL, 'user-photo/fakhry.jpg', 2, NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25'),
(4, 'Asep Maulana', 'sepmaulana@gmail.com', 'atet', '2024-01-09 11:42:25', NULL, '$2y$10$uZRJSDPVIBrikaxt5FAmjumtIg6rFRTCEISY1NnVk7jaoCCyhUvRG', NULL, NULL, NULL, 'user-photo/atet.jpg', 4, NULL, NULL, '2024-01-09 11:42:25', '2024-01-09 11:42:25');

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
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_grup_id_foreign` (`grup_id`);

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
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `berkas_jemaah`
--
ALTER TABLE `berkas_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bus_jemaah`
--
ALTER TABLE `bus_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `isu_perjalanan`
--
ALTER TABLE `isu_perjalanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jemaah`
--
ALTER TABLE `jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kamar_jemaah`
--
ALTER TABLE `kamar_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket_ekstra`
--
ALTER TABLE `paket_ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket_hotel`
--
ALTER TABLE `paket_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_maskapai`
--
ALTER TABLE `paket_maskapai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanan_ekstra`
--
ALTER TABLE `pemesanan_ekstra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanan_kamar`
--
ALTER TABLE `pemesanan_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permintaan_kamar`
--
ALTER TABLE `permintaan_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sertifikat_jemaah`
--
ALTER TABLE `sertifikat_jemaah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_grup_id_foreign` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
