-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3000
-- Generation Time: Jul 18, 2025 at 06:26 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akad_notaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas_pihak`
--

CREATE TABLE `berkas_pihak` (
  `id_berkas_pihak` bigint UNSIGNED NOT NULL,
  `id_permintaan` bigint UNSIGNED DEFAULT NULL,
  `id_berkas` bigint UNSIGNED NOT NULL,
  `id_pihak` bigint UNSIGNED NOT NULL,
  `berkas_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_berkas`
--

CREATE TABLE `data_berkas` (
  `id_berkas` bigint UNSIGNED NOT NULL,
  `id_jenis` bigint UNSIGNED DEFAULT NULL,
  `id_kategori_pihak` bigint UNSIGNED DEFAULT NULL,
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_berkas`
--

INSERT INTO `data_berkas` (`id_berkas`, `id_jenis`, `id_kategori_pihak`, `nama_berkas`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'KTP Pemilik Sertifikat', '2025-07-18 17:26:11', '2025-07-18 17:26:11'),
(3, 1, 1, 'Sertifikat', '2025-07-18 17:28:43', '2025-07-18 17:28:43'),
(5, 1, 1, 'SKMHT', '2025-07-18 17:33:25', '2025-07-18 17:33:25'),
(6, 1, 1, 'PBB', '2025-07-18 17:33:36', '2025-07-18 17:33:36'),
(7, 1, 2, 'Surat Kuasa dari Bank', '2025-07-18 17:34:02', '2025-07-18 17:34:14'),
(8, 1, 2, 'KTP Pimpinan Bank', '2025-07-18 17:34:23', '2025-07-18 17:34:23'),
(9, 1, 2, 'SK Pejabat Bank', '2025-07-18 17:34:37', '2025-07-18 17:34:37'),
(10, 2, 3, 'KTP Pemilik Sertifikat', '2025-07-18 18:52:14', '2025-07-18 18:52:14'),
(11, 2, 3, 'Sertifikat', '2025-07-18 18:52:26', '2025-07-18 18:52:26'),
(12, 2, 3, 'PBB', '2025-07-18 18:52:37', '2025-07-18 18:52:37'),
(13, 2, 4, 'Surat Kuasa dari Bank', '2025-07-18 18:52:53', '2025-07-18 18:52:53'),
(14, 2, 4, 'KTP Pimpinan Bank', '2025-07-18 18:53:10', '2025-07-18 18:53:10'),
(15, 2, 4, 'SK Pejabat Bank', '2025-07-18 18:53:26', '2025-07-18 18:53:26'),
(16, 3, 5, 'Nama Yayasan (3 kata)', '2025-07-18 18:54:34', '2025-07-18 18:54:34'),
(17, 3, 5, 'KTP & Data pribadi minimal 5 pendiri (keluarga, bukan kenalan biasa)', '2025-07-18 18:54:57', '2025-07-18 18:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `data_jadwal`
--

CREATE TABLE `data_jadwal` (
  `id_jadwal` bigint UNSIGNED NOT NULL,
  `notaris_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_jadwal`
--

INSERT INTO `data_jadwal` (`id_jadwal`, `notaris_id`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-07-21', '09:30:00', '10:00:00', NULL, '2025-07-18 17:40:20', '2025-07-18 17:40:20'),
(2, 1, '2025-07-22', '13:00:00', '14:00:00', NULL, '2025-07-18 17:40:45', '2025-07-18 17:40:45'),
(3, 1, '2025-07-23', '14:00:00', '14:30:00', NULL, '2025-07-18 17:40:59', '2025-07-18 17:40:59'),
(4, 1, '2025-07-24', '09:00:00', '16:00:00', 'Cuti', '2025-07-18 17:41:22', '2025-07-18 19:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `data_pihak`
--

CREATE TABLE `data_pihak` (
  `id_pihak` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `id_pihak_terkait` bigint UNSIGNED DEFAULT NULL,
  `id_kategori_pihak` bigint UNSIGNED NOT NULL,
  `nama_pihak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_pihak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_pihak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pihak` text COLLATE utf8mb4_unicode_ci,
  `tipe_pihak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_layanan`
--

CREATE TABLE `jenis_layanan` (
  `id_jenis` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED DEFAULT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_jenis` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_layanan`
--

INSERT INTO `jenis_layanan` (`id_jenis`, `id_kategori`, `nama_jenis`, `deskripsi_jenis`, `created_at`, `updated_at`) VALUES
(1, 1, 'APHT (Akta Pemberian Hak Tanggungan)', NULL, '2025-07-18 17:02:48', '2025-07-18 17:02:48'),
(2, 1, 'SKMHT (Surat Kuasa Membebankan Hak Tanggungan)', NULL, '2025-07-18 18:51:19', '2025-07-18 18:51:19'),
(3, 2, 'Pendirian Yayasan', NULL, '2025-07-18 18:54:00', '2025-07-18 18:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_layanan`
--

CREATE TABLE `kategori_layanan` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kategori` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_layanan`
--

INSERT INTO `kategori_layanan` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Akta PPAT', NULL, '2025-07-18 17:02:31', '2025-07-18 17:02:41'),
(2, 'Akta Notaris', NULL, '2025-07-18 18:53:44', '2025-07-18 18:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pihak`
--

CREATE TABLE `kategori_pihak` (
  `id_kategori_pihak` bigint UNSIGNED NOT NULL,
  `id_jenis` bigint UNSIGNED DEFAULT NULL,
  `nama_kategori_pihak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_pihak`
--

INSERT INTO `kategori_pihak` (`id_kategori_pihak`, `id_jenis`, `nama_kategori_pihak`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pemilik Sertifikat', '2025-07-18 17:03:01', '2025-07-18 17:03:01'),
(2, 1, 'Bank', '2025-07-18 17:03:09', '2025-07-18 17:03:09'),
(3, 2, 'Pemilik Sertifikat', '2025-07-18 18:51:34', '2025-07-18 18:51:34'),
(4, 2, 'Bank', '2025-07-18 18:51:42', '2025-07-18 18:51:42'),
(5, 3, 'Pendiri Yayasan', '2025-07-18 18:54:13', '2025-07-18 18:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2025_07_11_172257_create_detail_tables_for_each_roles', 1),
(4, '2025_07_13_230148_create_table_kategori_jenis_and_data_berkas', 1),
(5, '2025_07_14_004402_create_table_data_jadwal', 1),
(6, '2025_07_18_001843_create_data_pihak_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notaris_details`
--

CREATE TABLE `notaris_details` (
  `notaris_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nomor_jabatan_notaris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_notaris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notaris_details`
--

INSERT INTO `notaris_details` (`notaris_id`, `user_id`, `nomor_jabatan_notaris`, `nama_notaris`, `created_at`, `updated_at`) VALUES
(1, 3, '1270172', 'John', '2025-07-18 17:38:37', '2025-07-18 17:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_layanan`
--

CREATE TABLE `permintaan_layanan` (
  `id_permintaan` bigint UNSIGNED NOT NULL,
  `id_pihak` bigint UNSIGNED NOT NULL,
  `id_staf` bigint UNSIGNED DEFAULT NULL,
  `id_jadwal` bigint UNSIGNED DEFAULT NULL,
  `tgl_permintaan` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-07-18 17:01:56', NULL),
(2, 'staf', '2025-07-18 17:01:56', NULL),
(3, 'notaris', '2025-07-18 17:01:56', NULL),
(4, 'klien', '2025-07-18 17:01:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staf_details`
--

CREATE TABLE `staf_details` (
  `staf_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nik_staf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_staf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staf_details`
--

INSERT INTO `staf_details` (`staf_id`, `user_id`, `nik_staf`, `nama_staf`, `created_at`, `updated_at`) VALUES
(1, 2, '1274107', 'Jennifer', '2025-07-18 17:39:52', '2025-07-18 17:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin01', 'admin01@example.org', '$2y$12$MNERLvMTK5lUcLSrzz0AhuHnCYyFLLjwhBa8j/82N6AKgwnLkiytS', 1, '2025-07-18 17:02:01', NULL),
(2, 'staf01', 'staf01@example.org', '$2y$12$PUd5r4vSL8lhdzBQqGSjEO7mv0i6mzbGUQrbuiYcqduJFYWFP/RfC', 2, '2025-07-18 17:02:02', NULL),
(3, 'notaris01', 'notaris01@example.org', '$2y$12$AKIEMvk2nErHO.zaqqg7U.15S9Magi0E1WmjtwQ2StByOMKadxrNS', 3, '2025-07-18 17:02:02', NULL),
(4, 'klien01', 'klien01@example.org', '$2y$12$fRxImIS8hUYTGke6oJvboOj1p1VoaQYe.pFh0l3sMsgOXGI30BZKu', 4, '2025-07-18 17:02:03', NULL),
(5, 'klien02', 'klien02@example.org', '$2y$12$05nCggTcFpZv4yYqlhCMaus6qiTYVstyknKsSMxduAj3TV9.B6bmu', 4, '2025-07-18 17:02:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas_pihak`
--
ALTER TABLE `berkas_pihak`
  ADD PRIMARY KEY (`id_berkas_pihak`),
  ADD KEY `berkas_pihak_id_permintaan_foreign` (`id_permintaan`),
  ADD KEY `berkas_pihak_id_berkas_foreign` (`id_berkas`),
  ADD KEY `berkas_pihak_id_pihak_foreign` (`id_pihak`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id_berkas`),
  ADD KEY `data_berkas_id_jenis_foreign` (`id_jenis`),
  ADD KEY `data_berkas_id_kategori_pihak_foreign` (`id_kategori_pihak`);

--
-- Indexes for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `data_jadwal_notaris_id_foreign` (`notaris_id`);

--
-- Indexes for table `data_pihak`
--
ALTER TABLE `data_pihak`
  ADD PRIMARY KEY (`id_pihak`),
  ADD KEY `data_pihak_user_id_foreign` (`user_id`),
  ADD KEY `data_pihak_id_pihak_terkait_foreign` (`id_pihak_terkait`),
  ADD KEY `data_pihak_id_kategori_pihak_foreign` (`id_kategori_pihak`);

--
-- Indexes for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD PRIMARY KEY (`id_jenis`),
  ADD UNIQUE KEY `jenis_layanan_nama_jenis_unique` (`nama_jenis`),
  ADD KEY `jenis_layanan_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori_layanan_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `kategori_pihak`
--
ALTER TABLE `kategori_pihak`
  ADD PRIMARY KEY (`id_kategori_pihak`),
  ADD KEY `kategori_pihak_id_jenis_foreign` (`id_jenis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notaris_details`
--
ALTER TABLE `notaris_details`
  ADD PRIMARY KEY (`notaris_id`),
  ADD KEY `notaris_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `permintaan_layanan`
--
ALTER TABLE `permintaan_layanan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `permintaan_layanan_id_pihak_foreign` (`id_pihak`),
  ADD KEY `permintaan_layanan_id_staf_foreign` (`id_staf`),
  ADD KEY `permintaan_layanan_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staf_details`
--
ALTER TABLE `staf_details`
  ADD PRIMARY KEY (`staf_id`),
  ADD KEY `staf_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas_pihak`
--
ALTER TABLE `berkas_pihak`
  MODIFY `id_berkas_pihak` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id_berkas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  MODIFY `id_jadwal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_pihak`
--
ALTER TABLE `data_pihak`
  MODIFY `id_pihak` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id_jenis` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_pihak`
--
ALTER TABLE `kategori_pihak`
  MODIFY `id_kategori_pihak` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notaris_details`
--
ALTER TABLE `notaris_details`
  MODIFY `notaris_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permintaan_layanan`
--
ALTER TABLE `permintaan_layanan`
  MODIFY `id_permintaan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staf_details`
--
ALTER TABLE `staf_details`
  MODIFY `staf_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas_pihak`
--
ALTER TABLE `berkas_pihak`
  ADD CONSTRAINT `berkas_pihak_id_berkas_foreign` FOREIGN KEY (`id_berkas`) REFERENCES `data_berkas` (`id_berkas`) ON DELETE CASCADE,
  ADD CONSTRAINT `berkas_pihak_id_permintaan_foreign` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan_layanan` (`id_permintaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `berkas_pihak_id_pihak_foreign` FOREIGN KEY (`id_pihak`) REFERENCES `data_pihak` (`id_pihak`) ON DELETE CASCADE;

--
-- Constraints for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD CONSTRAINT `data_berkas_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_layanan` (`id_jenis`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_berkas_id_kategori_pihak_foreign` FOREIGN KEY (`id_kategori_pihak`) REFERENCES `kategori_pihak` (`id_kategori_pihak`) ON DELETE SET NULL;

--
-- Constraints for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD CONSTRAINT `data_jadwal_notaris_id_foreign` FOREIGN KEY (`notaris_id`) REFERENCES `notaris_details` (`notaris_id`) ON DELETE SET NULL;

--
-- Constraints for table `data_pihak`
--
ALTER TABLE `data_pihak`
  ADD CONSTRAINT `data_pihak_id_kategori_pihak_foreign` FOREIGN KEY (`id_kategori_pihak`) REFERENCES `kategori_pihak` (`id_kategori_pihak`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_pihak_id_pihak_terkait_foreign` FOREIGN KEY (`id_pihak_terkait`) REFERENCES `data_pihak` (`id_pihak`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_pihak_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD CONSTRAINT `jenis_layanan_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_layanan` (`id_kategori`) ON DELETE SET NULL;

--
-- Constraints for table `kategori_pihak`
--
ALTER TABLE `kategori_pihak`
  ADD CONSTRAINT `kategori_pihak_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_layanan` (`id_jenis`) ON DELETE SET NULL;

--
-- Constraints for table `notaris_details`
--
ALTER TABLE `notaris_details`
  ADD CONSTRAINT `notaris_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `permintaan_layanan`
--
ALTER TABLE `permintaan_layanan`
  ADD CONSTRAINT `permintaan_layanan_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `data_jadwal` (`id_jadwal`) ON DELETE SET NULL,
  ADD CONSTRAINT `permintaan_layanan_id_pihak_foreign` FOREIGN KEY (`id_pihak`) REFERENCES `data_pihak` (`id_pihak`) ON DELETE CASCADE,
  ADD CONSTRAINT `permintaan_layanan_id_staf_foreign` FOREIGN KEY (`id_staf`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `staf_details`
--
ALTER TABLE `staf_details`
  ADD CONSTRAINT `staf_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
