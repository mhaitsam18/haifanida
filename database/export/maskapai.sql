-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 02:13 AM
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
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_maskapai` varchar(255) NOT NULL,
  `nama_maskapai` varchar(255) NOT NULL,
  `negara_asal` varchar(255) NOT NULL,
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
(1, 'AA', 'American Airlines', 'United States', 'aa.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(2, 'DL', 'Delta Air Lines', 'United States', 'dl.png', 'Maskapai penerbangan scheduled,division dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(3, 'UA', 'United Airlines', 'United States', 'ua.png', 'Maskapai penerbangan scheduled,division dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(4, 'WN', 'Southwest Airlines Co.', 'United States Minor Outlying Islands', 'wn.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(5, 'CZ', 'China Southern Airlines', 'China', 'cz.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(6, 'MU', 'China Eastern', 'China', 'mu.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(7, 'OO', 'SkyWest Airlines', 'United States Minor Outlying Islands', 'oo.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(8, 'CA', 'Air China Limited', 'China', 'ca.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(9, 'FX', 'Federal Express', 'United States', 'fx.png', 'Maskapai penerbangan scheduled,cargo dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(10, 'FR', 'Ryanair Ltd.', 'Ireland', 'fr.png', 'Maskapai penerbangan scheduled dari Ireland', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(11, 'XE', 'Expressjet', 'United States Minor Outlying Islands', 'xe.png', 'Maskapai penerbangan  dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(12, 'TK', 'THY - Turkish Airlines', 'Turkey', 'tk.png', 'Maskapai penerbangan scheduled dari Turkey', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(13, 'LH', 'Lufthansa Cargo', 'Germany', 'lh.png', 'Maskapai penerbangan scheduled,cargo dari Germany', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(14, 'BA', 'British Airways', 'United Kingdom', 'ba.png', 'Maskapai penerbangan scheduled dari United Kingdom', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(15, 'EK', 'Emirates', 'United Arab Emirates', 'ek.png', 'Maskapai penerbangan scheduled dari United Arab Emirates', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(16, '5X', 'UPS Airlines', 'United States', '5x.png', 'Maskapai penerbangan cargo dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(17, 'U2', 'Easyjet Airline Company Limited', 'United Kingdom', 'u2.png', 'Maskapai penerbangan scheduled dari United Kingdom', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(18, 'AF', 'Air France', 'France', 'af.png', 'Maskapai penerbangan scheduled dari France', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(19, 'B6', 'JetBlue', 'United States', 'b6.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(20, 'NH', 'All Nippon Airways', 'Japan', 'nh.png', 'Maskapai penerbangan scheduled dari Japan', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(21, 'QR', 'Qatar Airways', 'Qatar', 'qr.png', 'Maskapai penerbangan scheduled dari Qatar', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(22, 'MQ', 'Envoy Air Inc.', 'United States Minor Outlying Islands', 'mq.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(23, 'SU', 'Aeroflot', 'Russia', 'su.png', 'Maskapai penerbangan scheduled dari Russia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(24, 'ZH', 'Shenzhen Airlines', 'China', 'zh.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(25, 'AC', 'Air Canada', 'Canada', 'ac.png', 'Maskapai penerbangan scheduled dari Canada', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(26, 'JJ', 'TAM Linhas Aereas', 'Brazil', 'jj.png', 'Maskapai penerbangan scheduled dari Brazil', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(27, 'JL', 'Japan Airlines', 'Japan', 'jl.png', 'Maskapai penerbangan scheduled dari Japan', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(28, 'KE', 'Korean Air', 'South Korea', 'ke.png', 'Maskapai penerbangan scheduled dari South Korea', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(29, 'AS', 'Alaska Airlines', 'United States', 'as.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(30, 'HU', 'Hainan Airlines', 'China', 'hu.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(31, 'SK', 'SAS', 'Sweden', 'sk.png', 'Maskapai penerbangan scheduled dari Sweden', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(32, 'GA', 'Garuda', 'Indonesia', 'ga.png', 'Maskapai penerbangan scheduled dari Indonesia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(33, 'CX', 'Cathay Pacific', 'Hong Kong', 'cx.png', 'Maskapai penerbangan scheduled dari Hong Kong', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(34, 'RW', 'Republic Airlines', 'United States', 'rw.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(35, 'SV', 'Saudi Arabian Airlines', 'Saudi Arabia', 'sv.png', 'Maskapai penerbangan scheduled dari Saudi Arabia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(36, 'AD', 'Azul Brazilian Airlines', 'Brazil', 'ad.png', 'Maskapai penerbangan scheduled dari Brazil', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(37, 'MF', 'Xiamen Airlines', 'China', 'mf.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(38, 'G3', 'Gol Linhas Aéreas Inteligentes\nGol Linhas Aéreas Inteligentes\n', 'Brazil', 'g3.png', 'Maskapai penerbangan scheduled dari Brazil', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(39, 'QK', 'Jazz Aviation LP', 'Canada', 'qk.png', 'Maskapai penerbangan scheduled dari Canada', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(40, 'EY', 'Etihad Airways', 'United Arab Emirates', 'ey.png', 'Maskapai penerbangan scheduled dari United Arab Emirates', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(41, 'LA', 'Lan Airlines', 'Chile', 'la.png', 'Maskapai penerbangan scheduled dari Chile', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(42, '9E', 'Endeavor Air', 'United States Minor Outlying Islands', '9e.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(43, 'YV', 'Mesa Airlines, Inc.', 'United States Minor Outlying Islands', 'yv.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(44, 'QF', 'Qantas', 'Australia', 'qf.png', 'Maskapai penerbangan scheduled dari Australia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(45, 'JT', 'Lion Airlines', 'Indonesia', 'jt.png', 'Maskapai penerbangan scheduled dari Indonesia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(46, 'WS', 'WestJet', 'Canada', 'ws.png', 'Maskapai penerbangan scheduled dari Canada', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(47, 'KL', 'KLM', 'Netherlands', 'kl.png', 'Maskapai penerbangan scheduled dari Netherlands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(48, 'SQ', 'SIA Cargo', 'Singapore', 'sq.png', 'Maskapai penerbangan scheduled dari Singapore', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(49, 'OH', 'PSA Airlines', 'United States', 'oh.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(50, 'AI', 'Air India', 'India', 'ai.png', 'Maskapai penerbangan scheduled dari India', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(51, '3U', 'Sichuan Airlines', 'China', '3u.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(52, '6E', 'Interglobe Aviation Ltd. dba Indigo', 'India', '6e.png', 'Maskapai penerbangan scheduled dari India', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(53, 'VY', 'Vueling', 'Spain', 'vy.png', 'Maskapai penerbangan scheduled dari Spain', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(54, 'AZ', 'Alitalia', 'Italy', 'az.png', 'Maskapai penerbangan scheduled dari Italy', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(55, 'AV', 'AVIANCA', 'Colombia', 'av.png', 'Maskapai penerbangan scheduled dari Colombia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(56, 'VA', 'Virgin Australia', 'Australia', 'va.png', 'Maskapai penerbangan scheduled dari Australia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(57, 'S5', 'Shuttle America', 'United States Minor Outlying Islands', 's5.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(58, 'SC', 'Shandong Airlines', 'China', 'sc.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(59, '9W', 'Jet Airways', 'India', '9w.png', 'Maskapai penerbangan scheduled dari India', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(60, 'GS', 'Tianjin Airlines', 'China', 'gs.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(61, 'VN', 'Vietnam Airlines', 'Vietnam', 'vn.png', 'Maskapai penerbangan scheduled dari Vietnam', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(62, 'CM', 'COPA Airlines', 'Panama', 'cm.png', 'Maskapai penerbangan scheduled dari Panama', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(63, 'FM', 'Shanghai Airlines', 'China', 'fm.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(64, 'AB', 'Air Berlin', 'Germany', 'ab.png', 'Maskapai penerbangan scheduled dari Germany', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(65, 'OS', 'Austrian', 'Austria', 'os.png', 'Maskapai penerbangan scheduled dari Austria', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(66, 'NK', 'Spirit Airlines', 'United States Minor Outlying Islands', 'nk.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(67, 'OZ', 'Asiana', 'South Korea', 'oz.png', 'Maskapai penerbangan scheduled dari South Korea', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(68, 'CI', 'China Airlines', 'Chinese Taipei', 'ci.png', 'Maskapai penerbangan scheduled dari Chinese Taipei', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(69, 'G4', 'Allegiant Air LLC', 'United States Minor Outlying Islands', 'g4.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(70, 'MH', 'Malaysia Airlines', 'Malaysia', 'mh.png', 'Maskapai penerbangan scheduled dari Malaysia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(71, 'AK', 'AirAsia Berhad dba AirAsia', 'Malaysia', 'ak.png', 'Maskapai penerbangan scheduled dari Malaysia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(72, 'TG', 'Thai Airways International', 'Thailand', 'tg.png', 'Maskapai penerbangan scheduled dari Thailand', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(73, 'IB', 'IBERIA', 'Spain', 'ib.png', 'Maskapai penerbangan scheduled dari Spain', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(74, 'BE', 'flybe', 'United Kingdom', 'be.png', 'Maskapai penerbangan scheduled dari United Kingdom', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(75, 'ET', 'Ethiopian Airlines', 'Ethiopia', 'et.png', 'Maskapai penerbangan scheduled dari Ethiopia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(76, 'JQ', 'Jetstar Airways Pty Limited', 'Australia', 'jq.png', 'Maskapai penerbangan scheduled dari Australia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(77, 'W6', 'Wizz Air Hungary Ltd.', 'Hungary', 'w6.png', 'Maskapai penerbangan scheduled dari Hungary', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(78, 'ZW', 'Air Wisconsin Airlines Corporation (AWAC)', 'United States Minor Outlying Islands', 'zw.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(79, 'LX', 'SWISS', 'Switzerland', 'lx.png', 'Maskapai penerbangan scheduled dari Switzerland', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(80, 'AX', 'Trans States Airlines, LLC', 'United States', 'ax.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(81, 'BR', 'EVA Air', 'Chinese Taipei', 'br.png', 'Maskapai penerbangan scheduled dari Chinese Taipei', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(82, 'S7', 'S7 Airlines', 'Russia', 's7.png', 'Maskapai penerbangan scheduled dari Russia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(83, 'AM', 'Aeromexico', 'Mexico', 'am.png', 'Maskapai penerbangan scheduled dari Mexico', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(84, '4O', 'Interjet', 'Mexico', '4o.png', 'Maskapai penerbangan scheduled dari Mexico', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(85, '5D', 'Aerolitoral S.A. de C.V.', 'Mexico', '5d.png', 'Maskapai penerbangan scheduled dari Mexico', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(86, 'JD', 'Capital Airlines', 'China', 'jd.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(87, 'PC', 'Pegasus Airlines', 'Turkey', 'pc.png', 'Maskapai penerbangan scheduled dari Turkey', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(88, 'UT', 'UTair', 'Russia', 'ut.png', 'Maskapai penerbangan scheduled dari Russia', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(89, 'BY', 'TUI Airways Limited', 'United Kingdom', 'by.png', 'Maskapai penerbangan scheduled,charter dari United Kingdom', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(90, 'CP', 'Compass Airlines LLC', 'United States Minor Outlying Islands', 'cp.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(91, 'TP', 'TAP Portugal', 'Portugal', 'tp.png', 'Maskapai penerbangan scheduled dari Portugal', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(92, 'VX', 'Virgin America', 'United States', 'vx.png', 'Maskapai penerbangan scheduled dari United States', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(93, 'Y4', 'Volaris', 'Mexico', 'y4.png', 'Maskapai penerbangan scheduled dari Mexico', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(94, '4U', 'Germanwings GmbH', 'Germany', '4u.png', 'Maskapai penerbangan scheduled dari Germany', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(95, 'LS', 'Jet2.com Limited', 'United Kingdom', 'ls.png', 'Maskapai penerbangan scheduled,cargo dari United Kingdom', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(96, 'PR', 'Philippine Airlines', 'Philippines', 'pr.png', 'Maskapai penerbangan scheduled dari Philippines', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(97, '9C', 'Spring Airlines Limited Corporation', 'China', '9c.png', 'Maskapai penerbangan scheduled dari China', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(98, 'F9', 'Frontier Airlines, Inc.', 'United States Minor Outlying Islands', 'f9.png', 'Maskapai penerbangan scheduled dari United States Minor Outlying Islands', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(99, '5J', 'Cebu Pacific Air', 'Philippines', '5j.png', 'Maskapai penerbangan scheduled dari Philippines', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17'),
(100, 'DY', 'Norwegian Air Shuttle A.S.', 'Norway', 'dy.png', 'Maskapai penerbangan scheduled dari Norway', NULL, '2023-12-05 01:07:17', '2023-12-05 01:07:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maskapai_kode_maskapai_unique` (`kode_maskapai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
