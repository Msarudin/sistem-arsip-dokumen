-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2026 pada 06.52
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
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `archives`
--

CREATE TABLE `archives` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_dokumen` varchar(255) NOT NULL,
  `tipe_file` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `archives`
--

INSERT INTO `archives` (`id`, `category_id`, `user_id`, `judul`, `deskripsi`, `file_dokumen`, `tipe_file`, `created_at`, `updated_at`) VALUES
(10, 8, 1, 'Test1', 'Test1', 'arsip/1795236862_526754b58a264be36129.pdf', 'pdf', '2026-11-21 04:54:23', '2026-11-21 05:00:10'),
(15, 10, 1, 'Test2', 'Test2', 'arsip/1795238062_326ad7b4e0cf5f2511a0.png', 'png', '2026-11-21 05:14:22', '2026-11-21 05:14:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(8, 'Laporan', '2026-11-21 02:49:29', '2026-11-21 02:49:29'),
(10, 'Sk', '2026-11-21 03:00:52', '2026-11-21 03:01:17'),
(14, 'Surat Masuk', '2026-11-21 05:23:43', '2026-11-21 05:23:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-11-20-144753', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1795186417, 1),
(2, '2026-11-20-145418', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1795186603, 2),
(3, '2026-11-20-145517', 'App\\Database\\Migrations\\CreateArchivesTable', 'default', 'App', 1795186603, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin Arsip', 'efendimse@gmail.com', '$2y$10$4Qa3KmFiRgu1Xq9fl46qdux1O/Qa3DE2P3pRdiHKtImAQTL62and.', '2026-11-20 14:59:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_category_id_foreign` (`category_id`),
  ADD KEY `archives_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `archives`
--
ALTER TABLE `archives`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `archives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
