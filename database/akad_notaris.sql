-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3000
-- Generation Time: Jul 18, 2025 at 12:03 PM
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
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_berkas`
--

INSERT INTO `data_berkas` (`id_berkas`, `id_jenis`, `nama_berkas`, `created_at`, `updated_at`) VALUES
(6, 2, 'KTP Pemilik Sertifikat', '2025-07-16 13:59:38', '2025-07-16 13:59:38'),
(7, 2, 'Sertifikat', '2025-07-17 16:12:33', '2025-07-17 16:12:33'),
(8, 2, 'SKMHT', '2025-07-17 16:12:49', '2025-07-17 16:12:49'),
(9, 2, 'PBB', '2025-07-17 16:13:02', '2025-07-17 16:13:02'),
(10, 2, 'Surat Kuasa dari Bank', '2025-07-17 16:13:21', '2025-07-17 16:13:21'),
(11, 2, 'KTP Pimpinan Bank', '2025-07-17 16:14:18', '2025-07-17 16:14:18'),
(12, 2, 'SK Pejabat Bank', '2025-07-17 16:14:28', '2025-07-17 16:14:28');

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
(8, 1, '2025-07-17', '14:30:00', '15:00:00', NULL, '2025-07-17 13:50:35', '2025-07-17 13:50:35'),
(9, 1, '2025-07-18', '13:30:00', '14:00:00', NULL, '2025-07-17 13:51:20', '2025-07-17 13:51:20'),
(10, 1, '2025-07-19', '09:00:00', '16:00:00', 'Libur', '2025-07-17 16:10:00', '2025-07-17 16:10:00'),
(11, 1, '2025-07-21', '13:00:00', '13:30:00', NULL, '2025-07-17 16:16:04', '2025-07-17 16:16:04'),
(12, 1, '2025-07-22', '10:30:00', '11:00:00', NULL, '2025-07-17 16:16:31', '2025-07-17 16:16:31');

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
(2, 1, 'APHT (Akta Pemberian Hak Tanggungan)', NULL, '2025-07-16 13:59:15', '2025-07-16 13:59:15');

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
(1, 'Akta PPAT', NULL, '2025-07-14 14:36:21', '2025-07-15 12:54:52'),
(12, 'Akta Notaris', NULL, '2025-07-15 13:49:40', '2025-07-15 13:49:40');

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
(5, '2025_07_14_004402_create_table_data_jadwal', 1);

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
(1, 3, '127301273', 'John', '2025-07-17 11:37:09', '2025-07-17 11:37:09');

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
(1, 'admin', '2025-07-14 14:33:06', NULL),
(2, 'staf', '2025-07-14 14:33:06', NULL),
(3, 'notaris', '2025-07-14 14:33:06', NULL),
(4, 'klien', '2025-07-14 14:33:06', NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GGOnwi1QgDANTygdinCsE9pdQG5hVLh65fp14Xoj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGxsRWpFWDlPMXgwMlJvY3hZa3QxNWxzNHdmUEVISVp1Zzd2Z05acyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9ha2FkLW5vdGFyaXMudGVzdDo2NjYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1752839359),
('rKMALIKSgMsbKjllVfO3FdhCVfIngeYGkcmiOsTb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGF5bktBRmFlUTdwbnpoREVRWGZHTWNJRGtrR2hTUVdKRFA5ZElLdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9ha2FkLW5vdGFyaXMudGVzdDo2NjYvbm90YXJpcy9sYXlhbmFuL2phZHdhbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752771024);

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
(4, 2, '13296329', 'Cole palmer', '2025-07-16 14:00:00', '2025-07-16 14:00:00');

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
(1, 'admin01', 'admin01@example.org', '$2y$12$3rSGoCd3nMu.5lNhO1CCOuSYKUh.roEqJW8.iMMEeCe3hdYQHHl3K', 1, '2025-07-14 14:33:13', NULL),
(2, 'staf01', 'staf01@example.org', '$2y$12$HvF.YBEBuvl94mwsVqOZ3uvCXiYrGKnOtSj.BvJXrASEI8xlxKFaq', 2, '2025-07-14 14:33:13', NULL),
(3, 'notaris01', 'notaris01@example.org', '$2y$12$BEj2Z7RF40rFpbFEDg49oOPCYmnKy2Mkdc5c0Mp.7fOnk/bhFR6sC', 3, '2025-07-14 14:33:14', NULL),
(4, 'klien01', 'klien01@example.org', '$2y$12$g1AXsX2ALsUry2qWIurmFeZRZQUYDhEtkIsXKeGEiEsIiPk68HTxm', 4, '2025-07-14 14:33:14', NULL),
(5, 'klien02', 'klien02@example.org', '$2y$12$.dikFVo/q2IlBDoT9YFiXeyLEz6BvPzOur1A8RcGfuUgy8VzovVva', 4, '2025-07-14 14:33:15', NULL);

--
-- Indexes for dumped tables
--

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
  ADD KEY `data_berkas_id_jenis_foreign` (`id_jenis`);

--
-- Indexes for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `data_jadwal_notaris_id_foreign` (`notaris_id`);

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
-- AUTO_INCREMENT for table `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id_berkas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  MODIFY `id_jadwal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id_jenis` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notaris_details`
--
ALTER TABLE `notaris_details`
  MODIFY `notaris_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staf_details`
--
ALTER TABLE `staf_details`
  MODIFY `staf_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD CONSTRAINT `data_berkas_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_layanan` (`id_jenis`) ON DELETE SET NULL;

--
-- Constraints for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD CONSTRAINT `data_jadwal_notaris_id_foreign` FOREIGN KEY (`notaris_id`) REFERENCES `notaris_details` (`notaris_id`) ON DELETE SET NULL;

--
-- Constraints for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD CONSTRAINT `jenis_layanan_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_layanan` (`id_kategori`) ON DELETE SET NULL;

--
-- Constraints for table `notaris_details`
--
ALTER TABLE `notaris_details`
  ADD CONSTRAINT `notaris_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

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
