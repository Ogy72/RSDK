-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2020 at 02:45 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rsdkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_pakai_rekam_medis`
--

CREATE TABLE `bahan_pakai_rekam_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `bahan_pakai_id` int(10) UNSIGNED NOT NULL,
  `rekam_medis_id` int(10) UNSIGNED NOT NULL,
  `penggunaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_pakai_rekam_medis`
--

INSERT INTO `bahan_pakai_rekam_medis` (`id`, `bahan_pakai_id`, `rekam_medis_id`, `penggunaan`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 1, '2020-10-15 00:04:55', '2020-10-15 00:04:55'),
(2, 2, 2, 3, '2020-10-15 00:05:08', '2020-10-15 00:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pakai`
--

CREATE TABLE `biaya_pakai` (
  `id` int(10) UNSIGNED NOT NULL,
  `bahan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_pakai`
--

INSERT INTO `biaya_pakai` (`id`, `bahan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Perban Coklat', 12500, '2020-09-22 05:42:22', '2020-09-22 05:55:04'),
(2, 'Kapas', 2500, '2020-09-22 05:42:34', '2020-09-22 05:54:46'),
(3, 'Suntikan', 12000, '2020-09-22 05:43:00', '2020-09-22 05:43:00'),
(5, 'Kapas Steril', 5000, '2020-09-22 05:57:53', '2020-09-22 05:57:53'),
(6, 'Jarum Jahit', 15000, '2020-09-22 05:58:09', '2020-09-22 05:58:09'),
(7, 'Benang Jahit Alami', 35000, '2020-09-22 05:58:28', '2020-09-22 05:58:28'),
(8, 'Benang Jahit Sintetis', 20000, '2020-09-22 05:58:40', '2020-09-22 05:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_tindakan`
--

CREATE TABLE `biaya_tindakan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tindakan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int(10) UNSIGNED NOT NULL,
  `dokter_nid` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perawat_nip` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_tindakan`
--

INSERT INTO `biaya_tindakan` (`id`, `tindakan`, `biaya`, `dokter_nid`, `perawat_nip`, `created_at`, `updated_at`) VALUES
(1, 'Pemasangan Perban Putih', 105000, NULL, '112233445588', '2020-09-14 21:59:40', '2020-09-18 04:49:19'),
(5, 'Pemeriksaan Pasien', 200000, '112233445511', NULL, '2020-09-14 23:07:26', '2020-10-12 23:07:31'),
(7, 'Pemeriksaan Pasien', 150000, '112233445572', NULL, '2020-09-15 06:10:32', '2020-10-12 23:07:18'),
(8, 'Pemasangan Infus', 120000, NULL, '112233445577', '2020-09-15 06:17:38', '2020-09-15 06:38:32'),
(9, 'Pemeriksaan Pasien', 150000, '112233445588', NULL, '2020-09-16 23:01:40', '2020-10-12 23:08:12'),
(10, 'Pemeriksaan Lab', 150000, '112233445588', NULL, '2020-10-11 21:24:45', '2020-10-13 23:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_tindakan_rekam_medis`
--

CREATE TABLE `biaya_tindakan_rekam_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `biaya_tindakan_id` int(10) UNSIGNED NOT NULL,
  `rekam_medis_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_tindakan_rekam_medis`
--

INSERT INTO `biaya_tindakan_rekam_medis` (`id`, `biaya_tindakan_id`, `rekam_medis_id`, `created_at`, `updated_at`) VALUES
(1, 7, 2, '2020-10-14 22:59:38', '2020-10-14 22:59:38'),
(2, 10, 2, '2020-10-14 22:59:53', '2020-10-14 22:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `nid` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`nid`, `nama`, `spesialis`, `alamat`, `no_telp`, `jk`, `created_at`, `updated_at`) VALUES
('112233445511', 'Dr. Budi', 'Penyakit Dalam', 'Jalan Raya', '08112233445566', 'Laki-laki', '2020-09-14 05:37:52', '2020-09-14 05:37:52'),
('112233445572', 'Dr. Perdana', 'Umum', 'Jalan Raya', '08112233445500', 'Laki-laki', '2020-09-14 05:37:29', '2020-09-14 05:51:34'),
('112233445588', 'Dr. Putri Rahayu', 'Gizi', 'Jalan Raya', '08112233445500', 'Perempuan', '2020-09-15 06:20:13', '2020-10-01 00:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2020_09_11_055212_create_dokters_table', 1),
(5, '2020_09_12_134546_create_perawats_table', 1),
(6, '2020_09_13_125933_create_biaya_tindakans_table', 1),
(7, '2020_09_16_134525_create_penyakits_table', 2),
(8, '2020_09_17_053954_create_satuans_table', 3),
(9, '2020_09_17_143023_create_obats_table', 4),
(10, '2020_09_21_134054_create_bahan_pakais_table', 5),
(17, '2014_10_12_000000_create_users_table', 6),
(18, '2014_10_12_100000_create_password_resets_table', 6),
(21, '2020_10_03_144018_create_pasiens_table', 7),
(22, '2020_10_08_133744_create_rekam_medis_table', 8),
(24, '2020_10_12_063055_create_rekam_penyakits_table', 9),
(28, '2020_10_14_130756_create_rekam_obats_table', 11),
(30, '2020_10_13_130416_create_rekam_tindakans_table', 13),
(32, '2020_10_15_060040_create_rekam_bahans_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kd_obat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_obat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_id` int(10) UNSIGNED DEFAULT NULL,
  `expired` date NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kd_obat`, `nm_obat`, `satuan_id`, `expired`, `stok`, `harga`, `created_at`, `updated_at`) VALUES
('GBL9718905104A2', 'Paracetamol', 3, '2021-09-30', 90, 8000, '2020-09-19 06:19:18', '2020-10-14 23:00:05'),
('KTPOCB96595', 'Procold Flu', 8, '2021-11-19', 81, 12000, '2020-09-19 07:44:33', '2020-10-14 21:54:06'),
('SD11542281', 'Vitacimin 500 mg', 10, '2027-09-19', 391, 2000, '2020-09-19 06:37:30', '2020-10-14 06:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `obat_rekam_medis`
--

CREATE TABLE `obat_rekam_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `obat_kd_obat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekam_medis_id` int(10) UNSIGNED NOT NULL,
  `penggunaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat_rekam_medis`
--

INSERT INTO `obat_rekam_medis` (`id`, `obat_kd_obat`, `rekam_medis_id`, `penggunaan`, `created_at`, `updated_at`) VALUES
(4, 'GBL9718905104A2', 2, 10, '2020-10-14 23:00:05', '2020-10-14 23:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nik`, `nama`, `tgl_lahir`, `jk`, `agama`, `status`, `pekerjaan`, `penanggung_jawab`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
('2020-10-0001', '1290013344009997', 'Mentari Senja', '1994-02-08', 'Perempuan', 'Protestan', 'Cerai Mati', 'Pegawai Salon', 'Diri Sendiri', 'Jln. Sempaja Selatan Gang Damai No.77', '08112233445533', '2020-10-08 00:25:38', '2020-10-08 00:25:38'),
('2020-10-0002', '12900133440099988', 'Rudiansyah Pratama', '1987-10-13', 'Laki-laki', 'Islam', 'Kawin', 'Pegawai Swasta', 'Diri Sendiri', 'Jln. Ahmad Dalan Gang Keong No.99 RT 10', '08112233445500', '2020-10-08 00:36:46', '2020-10-08 00:43:11'),
('2020-10-0003', '12900133440012345', 'Amanda Nikita', '1993-07-15', 'Perempuan', 'Katolik', 'Belum Kawin', 'Pegawai Bank', 'Diri Sendiri', 'Jalan Bangeris No 99', '081122334455', '2020-10-08 00:45:21', '2020-10-08 00:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_penyakit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gejala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nm_penyakit`, `gejala`, `created_at`, `updated_at`) VALUES
(1, 'Demam Berdarah', 'Suhu badan diatas 45 deraja, Hidung tersumbat, Bersin-bersin dan Muntah', '2020-09-16 06:50:24', '2020-09-21 05:27:53'),
(2, 'Diabetes Melitus', 'Pusing, Gula darah diatas normal, Sesak nafas', '2020-09-16 06:52:40', '2020-09-16 07:09:10'),
(5, 'Asma', 'Demam, Sesak Nafas dan Susah Tidur', '2020-10-12 07:07:21', '2020-10-13 20:39:14'),
(6, 'Vertigo', 'Pusing, Mual, dan Demam', '2020-10-12 07:18:11', '2020-10-12 07:18:11'),
(10, 'Darah Tinggi', 'Mual, Pusing dan Lemas', '2020-10-13 07:07:56', '2020-10-13 07:07:56'),
(11, 'Kencing Manis', 'Pusing dan Lemas', '2020-10-13 07:22:02', '2020-10-13 07:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit_rekam_medis`
--

CREATE TABLE `penyakit_rekam_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `penyakit_id` int(10) UNSIGNED NOT NULL,
  `rekam_medis_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit_rekam_medis`
--

INSERT INTO `penyakit_rekam_medis` (`id`, `penyakit_id`, `rekam_medis_id`, `created_at`, `updated_at`) VALUES
(13, 6, 2, '2020-10-14 22:59:38', '2020-10-14 22:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `perawat`
--

CREATE TABLE `perawat` (
  `nip` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perawat`
--

INSERT INTO `perawat` (`nip`, `nama`, `alamat`, `no_telp`, `jk`, `poli`, `created_at`, `updated_at`) VALUES
('112233445577', 'Bunda Pinky', 'Jalan Raya', '08112233445500', 'Perempuan', 'Umum', '2020-09-14 05:38:12', '2020-09-14 05:38:12'),
('112233445588', 'Mentari', 'Jalan Raya', '08112233445566', 'Perempuan', 'IGD', '2020-09-14 05:38:31', '2020-09-14 05:38:31'),
('112233445599', 'Messa', 'Jalan Raya', '08112233445500', 'Perempuan', 'Gizi', '2020-09-15 06:21:21', '2020-09-15 06:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `pasien_no_rm` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_periksa` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `pasien_no_rm`, `tgl_periksa`, `created_at`, `updated_at`) VALUES
(2, '2020-10-0001', '2020-10-15', '2020-10-14 22:59:38', '2020-10-14 22:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_satuan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `isi_satuan`, `created_at`, `updated_at`) VALUES
(2, 'Box', 100, '2020-09-16 22:52:25', '2020-09-16 22:52:25'),
(3, 'Tablet', 10, '2020-09-16 22:54:17', '2020-09-19 06:33:10'),
(4, 'Tablet', 12, '2020-09-16 22:54:29', '2020-09-19 06:33:03'),
(5, 'Btl/ml', 100, '2020-09-16 22:54:44', '2020-09-16 22:54:44'),
(7, 'Dus', 100, '2020-09-16 22:56:53', '2020-09-16 22:56:53'),
(8, 'Tablet', 4, '2020-09-16 23:47:24', '2020-09-19 06:33:17'),
(9, 'Btl/L', 1, '2020-09-17 05:11:50', '2020-09-17 05:33:17'),
(10, 'Tablet', 2, '2020-09-19 06:33:25', '2020-09-19 06:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `no_telp`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Desi', 'P001WT', '$2y$10$qq8w/kojZ6ugPz2k9snBVuslnbSHS7cZ5oRsX/6t2E1O6zCY30lli', 'Perawat', '08112233445500', NULL, '2020-09-29 20:20:19', '2020-10-03 03:20:50'),
(3, 'Admin RM', 'ADM001RM', '$2y$10$QQX.9aPyzxn4Z4rrN1Ojo.A/pgMHbiQwIXh5NEgMUr/tUltOASOfu', 'Admin RM', '08112233445500', NULL, '2020-09-30 00:18:03', '2020-10-03 03:20:12'),
(4, 'Admin Keuangan', 'ADM001KE', '$2y$10$46SugmPlbOlwJHoPbXZ4Ku2FEu6.nQ7fz1fPuXe9aFUXsM4Nc2uZO', 'Admin Keuangan', '08112233445500', NULL, '2020-09-30 00:50:21', '2020-10-03 03:19:48'),
(7, 'Super Admin', 'SuperAdmin', '$2y$10$ZyM0K2WJHN0gujkAYYCGIOXyK6ZHrcIVzFf/cmi1X0IH1qamybyPm', 'Admin', 'None', NULL, '2020-10-15 03:21:19', '2020-10-15 03:21:19'),
(8, 'Admin', 'admin', '$2y$10$ueUIBQJ9saW1XofHNal6GuA4/CS2L/PHJYEt/WTkjAzXJACRlX6t.', 'Admin', 'None', NULL, '2020-10-15 03:22:02', '2020-10-15 03:22:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_pakai_rekam_medis`
--
ALTER TABLE `bahan_pakai_rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_pakai_id` (`bahan_pakai_id`),
  ADD KEY `rekam_medis_id` (`rekam_medis_id`);

--
-- Indexes for table `biaya_pakai`
--
ALTER TABLE `biaya_pakai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biaya_tindakan`
--
ALTER TABLE `biaya_tindakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokter_nid` (`dokter_nid`),
  ADD KEY `perawat_nip` (`perawat_nip`);

--
-- Indexes for table `biaya_tindakan_rekam_medis`
--
ALTER TABLE `biaya_tindakan_rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_tindakan_id` (`biaya_tindakan_id`),
  ADD KEY `rekam_medis_id` (`rekam_medis_id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indexes for table `obat_rekam_medis`
--
ALTER TABLE `obat_rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_kd_obat` (`obat_kd_obat`),
  ADD KEY `rekam_medis_id` (`rekam_medis_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakit_rekam_medis`
--
ALTER TABLE `penyakit_rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekam_medis_id` (`rekam_medis_id`),
  ADD KEY `penyakit_rekam_medis_ibfk_1` (`penyakit_id`);

--
-- Indexes for table `perawat`
--
ALTER TABLE `perawat`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekam_medis_pasien_no_rm_index` (`pasien_no_rm`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_pakai_rekam_medis`
--
ALTER TABLE `bahan_pakai_rekam_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biaya_pakai`
--
ALTER TABLE `biaya_pakai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `biaya_tindakan`
--
ALTER TABLE `biaya_tindakan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `biaya_tindakan_rekam_medis`
--
ALTER TABLE `biaya_tindakan_rekam_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `obat_rekam_medis`
--
ALTER TABLE `obat_rekam_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyakit_rekam_medis`
--
ALTER TABLE `penyakit_rekam_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_pakai_rekam_medis`
--
ALTER TABLE `bahan_pakai_rekam_medis`
  ADD CONSTRAINT `bahan_pakai_rekam_medis_ibfk_1` FOREIGN KEY (`bahan_pakai_id`) REFERENCES `biaya_pakai` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bahan_pakai_rekam_medis_ibfk_2` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `biaya_tindakan`
--
ALTER TABLE `biaya_tindakan`
  ADD CONSTRAINT `biaya_tindakan_ibfk_1` FOREIGN KEY (`dokter_nid`) REFERENCES `dokter` (`nid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `biaya_tindakan_ibfk_2` FOREIGN KEY (`perawat_nip`) REFERENCES `perawat` (`nip`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `biaya_tindakan_rekam_medis`
--
ALTER TABLE `biaya_tindakan_rekam_medis`
  ADD CONSTRAINT `biaya_tindakan_rekam_medis_ibfk_1` FOREIGN KEY (`biaya_tindakan_id`) REFERENCES `biaya_tindakan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `biaya_tindakan_rekam_medis_ibfk_2` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `obat_rekam_medis`
--
ALTER TABLE `obat_rekam_medis`
  ADD CONSTRAINT `obat_rekam_medis_ibfk_1` FOREIGN KEY (`obat_kd_obat`) REFERENCES `obat` (`kd_obat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `obat_rekam_medis_ibfk_2` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyakit_rekam_medis`
--
ALTER TABLE `penyakit_rekam_medis`
  ADD CONSTRAINT `penyakit_rekam_medis_ibfk_1` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penyakit_rekam_medis_ibfk_2` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`pasien_no_rm`) REFERENCES `pasien` (`no_rm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
