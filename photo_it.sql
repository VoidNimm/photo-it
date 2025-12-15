-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 05:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_number` varchar(50) NOT NULL COMMENT 'Nomor booking: BK-2024-001',
  `client_name` varchar(255) NOT NULL COMMENT 'Nama klien',
  `client_email` varchar(255) NOT NULL COMMENT 'Email klien',
  `client_phone` varchar(50) NOT NULL COMMENT 'Telepon klien',
  `service_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID layanan',
  `event_date` date DEFAULT NULL COMMENT 'Tanggal acara',
  `location` varchar(255) DEFAULT NULL COMMENT 'Lokasi acara',
  `notes` text DEFAULT NULL COMMENT 'Catatan',
  `booking_status` varchar(50) DEFAULT 'pending' COMMENT 'pending, confirmed, completed, cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_number`, `client_name`, `client_email`, `client_phone`, `service_id`, `event_date`, `location`, `notes`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, 'BK-2025-0001', 'Akmal Ghanim', 'akmalghanim77@gmail.com', '087890404908', 2, '2025-11-27', 'Jl. Radal 2 asdasd', 'asddddddwqesadxzczxc', 'pending', '2025-11-17 20:58:34', '2025-11-17 20:58:34'),
(2, 'BK-2025-0002', 'Abilul', 'sabilul@gmail.com', '09812393763', 3, '2025-11-26', 'Jl. Kemang', 'aslkdjaspdaslmd aslkdnoakjed', 'pending', '2025-11-17 21:03:41', '2025-11-17 21:03:41'),
(3, 'BK-2025-0003', 'Boni', 'bonskuy@gmail.com', '0862138764', 4, '2025-11-30', 'Gedung Mpruyy', 'Harus pake camera sony dan filter mantap', 'pending', '2025-11-19 01:41:01', '2025-11-19 01:41:01'),
(4, 'BK-2025-0004', 'Pablo', 'pablo77@gmail.com', '089213789782', 1, '2025-11-29', 'Jl. Kemang 22', 'bang yang bener', 'pending', '2025-11-25 02:48:33', '2025-11-25 02:48:33'),
(5, 'BK-2025-0005', 'Akmal Ghanimasd', 'akmal77@gmail.com', '087812312', 2, '2025-12-18', 'Gedung Mpruyy', 'aasdasdasdasdasdasd zxczxc', 'pending', '2025-12-09 02:05:34', '2025-12-09 02:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('photo-it-cache-translation:en:5c93310dd0291e121181e830cdda892e', 's:7:\"Gallery\";', 2080798152),
('photo-it-cache-translation:en:6b0a3b784ca611535e83bb92f7583358', 's:41:\"© Copyright Photo It All Rights Reserved\";', 2080798152),
('photo-it-cache-translation:en:8cf04a9734132302f96da8e113e80ce5', 's:4:\"Home\";', 2080798152),
('photo-it-cache-translation:en:8f7f4c1ce7a4f933663d10543562b096', 's:5:\"About\";', 2080798152),
('photo-it-cache-translation:en:992a0f0542384f1ee5ef51b7cf4ae6c4', 's:8:\"Services\";', 2080798152),
('photo-it-cache-translation:en:a3401c75f7ea3d4c751b96d8d63dac4c', 's:24:\"Designed by Akmal Ghanim\";', 2080798152),
('photo-it-cache-translation:en:bbaff12800505b22a853e8b7f4eb6a22', 's:7:\"Contact\";', 2080798152),
('photo-it-cache-translation:en:ec48fa966df1ef8f1803c90fe878f81a', 's:8:\"Photo It\";', 2080798152);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Nama pengirim',
  `email` varchar(255) NOT NULL COMMENT 'Email pengirim',
  `subject` varchar(255) NOT NULL COMMENT 'Subjek pesan',
  `message` text NOT NULL COMMENT 'Isi pesan',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Nomor telepon',
  `is_read` tinyint(1) DEFAULT 0 COMMENT '1 = sudah dibaca',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `phone`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Akmal Ghanim', 'akmalghanim77@gmail.com', 'ceo', 'halo tes 123', '087890404908', 1, '2025-11-17 23:43:05', '2025-11-20 18:28:45'),
(2, 'Boni', 'boniskuy@gmail.com', 'Bang fotografer', 'anda adalah oke oke okuy', '08631297214', 1, '2025-11-19 01:39:44', '2025-11-20 18:28:25'),
(3, 'Akmut Ghanuy', 'akmuyghanuy@gmail.com', 'Bang fotografer', 'aslkdjalskdaslkdjas', '0878902161', 0, '2025-11-23 20:07:42', '2025-11-23 20:07:42'),
(4, 'Akmal Ghanim', 'akmalghanim77@gmail.com', 'asdasda', 'asdasdasdoaspodas', '087890404908', 0, '2025-11-23 20:12:32', '2025-11-23 20:12:32'),
(5, 'asslamualaikum', 'assalamualaikum@gmail.com', 'bang assalamualaikum', 'assalmualaikum!!!!', '0786191334', 0, '2025-11-23 20:14:57', '2025-11-23 20:14:57'),
(6, 'waalaikumsalam', 'waalaijkumsalam@gmail.com', 'Bang bang', 'waalaikumsalam bro', '089712354', 0, '2025-11-23 20:17:04', '2025-11-23 20:17:04'),
(7, 'bissmillah', 'bissmillah@gmail.com', 'tes', 'tesssssss cptcha', '0908127398', 0, '2025-11-23 20:18:02', '2025-11-23 20:18:02'),
(8, 'bang', 'bang12@gmail.com', 'tes', 'tes cpcthaaa', '1092380193', 0, '2025-11-23 20:22:47', '2025-11-23 20:22:47'),
(9, 'Akmal Ghanim Ganteng', 'akmalghanim77@gmail.com', 'asdasd', 'asdaspod-900asd', '087890404123', 0, '2025-11-23 20:26:52', '2025-11-23 20:26:52'),
(10, 'Akmal Ghanim Ganteng', 'akmalghanim77@gmail.com', 'asdasd', 'asdaspod-900asd', '087890404123', 0, '2025-11-23 20:26:52', '2025-11-23 20:26:52'),
(11, 'asdasd', 'asdasdas@dgdsg', 'qwes', 'asdaserdsfvcv', '4230230948', 0, '2025-11-23 20:30:55', '2025-11-23 20:30:55'),
(12, 'Agsnayahahs', 'afagansyah2@gmail.com', 'Pak Jannah SPG', 'asdasd asdkjaslkdj', '088797961', 1, '2025-11-26 23:32:47', '2025-11-26 23:33:27'),
(13, 'Ananta Jawatan', 'jawatan@gmail.com', 'Pak Akmal CEO', 'asoidjas;odijaslikdjaoslikdjqlw;dnkasdas', '07976123908', 0, '2025-12-03 02:14:18', '2025-12-03 02:14:18'),
(14, 'Amuzha Amuzhuy', 'amuzhuy@gmail.com', 'Bang Ketoprak', 'asdojasioudhasjhdioashjdikasuhdnasijkuhndasijudhn', '086809123', 0, '2025-12-03 02:18:08', '2025-12-03 02:18:08'),
(15, 'Pablo Askara', 'askarapablo@gmail.com', 'Pak Jawa', 'aksjdhaskjdoqweiasdjn askdhasldaskj,d', '0789123987', 0, '2025-12-04 22:58:15', '2025-12-04 22:58:15'),
(16, 'salmlekom', 'samlekom@gmail.com', 'askdjasdk', 'asdkljaslkjdla aslkdjasdpowq kdp[okgfps', '083649131', 0, '2025-12-04 23:02:58', '2025-12-04 23:02:58'),
(17, 'Akmal Ghanim', 'akmalghanim77@gmail.com', 'bang assalamualaikum', 'asdasdqwd  dasdqwd asd asdasdas', '087890404908', 0, '2025-12-05 01:54:28', '2025-12-05 01:54:28'),
(18, 'Akmal Ghanim', 'akmalnim77@gmail.com', 'ceo afgansyah', 'asdasdasdasdasd', '087890404908', 0, '2025-12-09 03:52:42', '2025-12-09 03:52:42'),
(19, 'Akmal Ghanim', 'akmalghanim77@gmail.com', 'asdasdasdasd', 'asdasdaaacxxzczxffdf', '', 1, '2025-12-09 03:53:37', '2025-12-09 03:56:44'),
(20, 'Akmal Ghanim Afgnsyah', 'akmalgha347@gmail.com', 'bang assalamualaikum', 'a[sodiapso [apas[dasjdoj oajdoajsdoj oajsdoasdo', '0878-9040-4908', 1, '2025-12-09 03:57:29', '2025-12-09 03:57:42'),
(21, ']][]\';\'.(*&(*5312', '432234@dasdas', 'sdfsdfdsfs', 'sfddsfsdfsddsf  dsfdsfsdf', '', 0, '2025-12-10 02:40:07', '2025-12-10 02:40:07'),
(22, 'asdagd sadasd ass', 'asdasdasd@dsad', 'asdasdasdas', 'asdasdas asdas dasd asdasd', '0748923221', 0, '2025-12-10 02:50:16', '2025-12-10 02:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL COMMENT 'Nama kategori: City, Wedding, Portrait, dll',
  `slug` varchar(100) NOT NULL COMMENT 'URL slug: city, wedding, portrait',
  `display_order` int(11) DEFAULT 0 COMMENT 'Urutan di navbar',
  `is_active` tinyint(1) DEFAULT 1 COMMENT '1 = aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `category_name`, `slug`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'City', 'city', 1, 1, NULL, NULL),
(2, 'Wedding', 'wedding', 2, 1, NULL, NULL),
(3, 'Portrait', 'portrait', 3, 1, NULL, NULL),
(4, 'Event', 'event', 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID kategori (opsional)',
  `title` varchar(255) NOT NULL COMMENT 'Judul foto',
  `image_path` varchar(255) NOT NULL COMMENT 'Path gambar: gallery/photo1.jpg',
  `display_order` int(11) DEFAULT 0 COMMENT 'Urutan tampil',
  `is_featured` tinyint(1) DEFAULT 0 COMMENT '1 = tampil di homepage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `category_id`, `title`, `image_path`, `display_order`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'City Photo 1', 'gallery/01KAAGZT7HTC7VT9NQ20J08RZE.jpg', 1, 1, NULL, '2025-11-17 20:43:59'),
(2, 1, 'City Photo 2', 'gallery/01KA7WYG4DY49976YBAY6SAFKD.jpg', 2, 1, NULL, '2025-11-16 20:15:15'),
(3, 2, 'Wedding Photo 1', 'gallery/01KA7Q5S1Z4N7G5YZ8C1JWNCEB.jpg', 3, 1, NULL, '2025-11-16 18:34:22'),
(4, 2, 'Wedding Photo 2', 'gallery/01KAAGVC5DXEF6864D7T8H0Q13.jpg', 4, 0, NULL, '2025-11-17 20:41:33'),
(5, 4, 'Event Photo 2', 'gallery/01KAAH2HWV0869RYZ7DM03NNXD.jpg', 5, 0, NULL, '2025-11-17 20:45:28'),
(6, 4, 'Event Photo 1', 'gallery/01KA7Q9WBWERDT6YJ8MBDMBRNC.jpg', 6, 1, NULL, '2025-11-16 18:36:37'),
(7, 2, 'Wedding Afgansyah', 'gallery/01KA7PXF41EAEENAF6D9QSS2F2.jpg', 0, 0, '2025-11-16 08:23:36', '2025-11-16 18:29:50'),
(8, 1, 'Venice', 'gallery/01KB4X151CTEG7HYZYMRZQJ18Q.jpg', 0, 1, '2025-11-28 02:34:41', '2025-11-28 02:34:41'),
(9, 1, 'Madrid', 'gallery/01KB4X4A3HNSJV8BMGSVKBESGZ.jpg', 0, 1, '2025-11-28 02:36:24', '2025-11-28 02:36:24'),
(10, 4, 'Apple Introduce', 'gallery/01KB4X6WMHHCPYBVTWRE03G835.jpg', 0, 1, '2025-11-28 02:37:49', '2025-11-28 02:37:49'),
(11, 2, 'Wedding Alex', 'gallery/01KB4X9XVTRVV1NNXJATKVW7E5.jpg', 0, 1, '2025-11-28 02:39:28', '2025-11-28 02:39:28');

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
(1, '2025_11_21_081306_settings', 1),
(2, '2025_12_02_032014_add_is_admin_to_users_table', 2),
(3, '2025_12_03_054956_change_is_admin_to_role_in_users_table', 3),
(4, '2025_12_11_064249_create_password_reset_tokens_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('akmalghanim77@gmail.com', '8671e0569d9870b5bda3d29070296458560e9c123c00cff2a43504fbb560399e', '2025-12-11 00:15:08'),
('jacobamazing76@gmail.com', 'cbd9713c11bed3b8e05000929d174d92ed5cfc8979246a10b9e8499e71354242', '2025-12-11 00:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL COMMENT 'Nama layanan: Wedding, Portrait, Event',
  `description` text DEFAULT NULL COMMENT 'Deskripsi singkat',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Harga',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Wedding Photography', 'Foto pernikahan lengkap', 5000000.00, NULL, NULL),
(2, 'Portrait Photography', 'Foto portrait profesional', 1500000.00, NULL, NULL),
(3, 'Event Photography', 'Dokumentasi acara', 3000000.00, NULL, NULL),
(4, 'Product Photography', 'Foto produk', 2000000.00, NULL, NULL),
(5, 'City View', 'Dengan panorama seperti NYC', 6000000.00, '2025-11-16 08:20:31', '2025-11-17 19:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('MndhF8DMo7C9BkjV6Ut8UwGMgX6auD7veqFOBIvi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNDg4dGxYQXlRQURtVnM3MGNUaWFCaXhLRGxwMEVSZlhGYnVaU3pHcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvbnRhY3QtbWVzc2FnZXMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvbnRhY3QtbWVzc2FnZXMiO3M6NToicm91dGUiO3M6NDc6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5jb250YWN0LW1lc3NhZ2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765435301),
('tan2BHRQ3oIyVj1iEy4YGnG9jGrKhgLfdpxSnIT2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWJ4QnoyY3pCZ1dKYms5R0pvazVGcE5kaWoxaG5td25rVzRNeE1pSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO319', 1765438706),
('x0XSsCEhHn1oE2q1ecne4Ujb8usf55xGj69pBlcZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmd2TFhkcldJMGFHT3JNUHpXcUFWdncyMENIT0dTSWxPTTFxN3A5eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJpbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765435300),
('yXJbRNZ496PqtQFkF77QtotLjOAf2pYdx3jBzyYj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGtxeks2bU5Oc1JEOVZmUTJFWFBwMmtUUnNEbGlwTUdscUlPb3ZSZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO319', 1765436289);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'navbar_logo_text', '\"Photo It\"', '2025-11-21 01:26:54', '2025-11-21 01:26:54'),
(2, 'navbar_logo_image', '\"settings\\/01KAX84P1RZQBFR7YQ8YYP7ZZ3.jpg\"', '2025-11-21 01:26:55', '2025-11-25 03:14:55'),
(3, 'navbar_menu_items', '[{\"label\":\"Home\",\"url\":\"\\/\",\"order\":1,\"target\":\"_self\"},{\"label\":\"About\",\"url\":\"\\/about\",\"order\":2,\"target\":\"_self\"},{\"label\":\"Gallery\",\"url\":\"\\/gallery\",\"order\":3,\"target\":\"_self\"},{\"label\":\"Services\",\"url\":\"\\/services\",\"order\":4,\"target\":\"_self\"},{\"label\":\"Contact\",\"url\":\"\\/contact\",\"order\":5,\"target\":\"_self\"}]', '2025-11-21 01:26:55', '2025-11-21 01:26:55'),
(4, 'footer_copyright', '\"\\u00a9 Copyright Photo It All Rights Reserved\"', '2025-11-21 01:26:55', '2025-11-21 01:26:55'),
(5, 'footer_credits', '\"Designed by Akmal Ghanim\"', '2025-11-21 01:26:55', '2025-11-21 02:39:37'),
(6, 'footer_credits_url', '\"https:\\/\\/nimghanim.my.id\"', '2025-11-21 01:26:55', '2025-11-21 01:26:55'),
(7, 'navbar_instagram', '\"https:\\/\\/www.instagram.com\\/hitamlegam._\\/\"', '2025-11-21 02:38:52', '2025-11-21 02:38:52'),
(8, 'footer_instagram', '\"https:\\/\\/www.instagram.com\\/hitamlegam._\\/\"', '2025-11-21 02:39:37', '2025-11-21 02:39:37'),
(9, 'about_page_title', '\"About\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(10, 'about_page_subtitle', '\"Photo It adalah tim fotografer profesional yang berdedikasi menangkap cerita di balik setiap momen. Kami percaya bahwa setiap detail memiliki makna, dan setiap gambar dapat menjadi kenangan yang tak lekang oleh waktu.\"', '2025-11-24 20:18:18', '2025-11-25 03:10:34'),
(11, 'about_page_cta_text', '\"Available for Booking\"', '2025-11-24 20:18:18', '2025-11-25 03:35:39'),
(12, 'about_page_cta_url', '\"\\/contact\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(13, 'about_company_image', '\"about\\/01KAWG9V01AN3S689W965MWX4H.jpg\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(14, 'about_company_title', '\"Professional Photography Company\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(15, 'about_company_subtitle', '\"Menyediakan layanan fotografi kreatif dan profesional untuk setiap kebutuhan visual Anda.\"', '2025-11-24 20:18:18', '2025-11-25 03:10:34'),
(16, 'about_company_info', '[{\"label\":\"Established\",\"value\":\"2015\"},{\"label\":\"Location\",\"value\":\"Jakarta, Indonesia\"},{\"label\":\"Team Size\",\"value\":\"50+ Members\"},{\"label\":\"Projects Completed\",\"value\":\"500+\"}]', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(17, 'about_company_description_1', '\"Photo It berkomitmen memberikan pengalaman fotografi terbaik melalui pendekatan yang detail, kreatif, dan penuh dedikasi. Dengan layanan mulai dari wedding, event, portrait, produk, hingga city view, kami memastikan setiap hasil foto mampu menyampaikan cerita dan karakter yang autentik. Dukungan tim yang berpengalaman membuat setiap proses berjalan profesional dan penuh perhatian terhadap kualitas.\"', '2025-11-24 20:18:18', '2025-11-25 03:10:34'),
(18, 'about_company_description_2', '\"Kami terus berkembang dengan mengutamakan kualitas visual dan kepuasan klien dalam setiap proyek. Setiap pengambilan gambar dilakukan dengan perencanaan matang, teknik yang tepat, dan kreativitas yang relevan dengan kebutuhan Anda. Photo It hadir sebagai mitra visual yang dapat diandalkan untuk menghadirkan karya yang bermakna dan memberikan kesan mendalam.\"', '2025-11-24 20:18:18', '2025-11-25 03:10:34'),
(19, 'about_testimonials_title', '\"Testimonials\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(20, 'about_testimonials_subtitle', '\"What they are saying\"', '2025-11-24 20:18:18', '2025-11-24 20:18:18'),
(21, 'navbar_facebook', '\"https:\\/\\/www.facebook.com\\/marketplace\\/item\\/1204514734945481\\/?ref=browse_tab&referral_code=marketplace_top_picks&referral_story_type=top_picks&locale=id_ID\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27'),
(22, 'navbar_twitter', '\"https:\\/\\/x.com\\/?lang=id\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27'),
(23, 'navbar_linkedin', '\"https:\\/\\/id.linkedin.com\\/jobs\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27'),
(24, 'footer_facebook', '\"https:\\/\\/www.facebook.com\\/marketplace\\/item\\/1204514734945481\\/?ref=browse_tab&referral_code=marketplace_top_picks&referral_story_type=top_picks&locale=id_ID\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27'),
(25, 'footer_twitter', '\"https:\\/\\/x.com\\/?lang=id\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27'),
(26, 'footer_linkedin', '\"https:\\/\\/id.linkedin.com\\/jobs\"', '2025-11-25 02:54:27', '2025-11-25 02:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL COMMENT 'Nama pelanggan',
  `client_title` varchar(255) DEFAULT NULL COMMENT 'Jabatan: CEO, Designer, dll',
  `client_image` varchar(255) DEFAULT NULL COMMENT 'Path foto pelanggan',
  `rating` int(11) DEFAULT 5 COMMENT 'Rating 1-5',
  `review_text` text NOT NULL COMMENT 'Isi testimoni',
  `is_featured` tinyint(1) DEFAULT 0 COMMENT '1 = tampil di homepage',
  `is_approved` tinyint(1) DEFAULT 0 COMMENT '1 = sudah disetujui',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `client_title`, `client_image`, `rating`, `review_text`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'Saul Goodman', 'CEO & Founder', 'testimonials/01KAFSG6HTWKSFX4V4QE9WXHS7.png', 5, 'Hasil foto sangat memuaskan, profesional dan tepat waktu. Sangat direkomendasikan!', 1, 1, NULL, '2025-11-19 21:48:56'),
(2, 'Walter White', 'Bussiness', 'testimonials/01KAFVTJZBJMBHH0AYYJSW873R.jpg', 5, 'Pelayanan sangat baik, hasil foto sesuai ekspektasi. Terima kasih!', 1, 1, NULL, '2025-11-19 22:29:34'),
(3, 'Jessie Pinkman', 'Store Owner', NULL, 5, 'Foto produk untuk toko saya sangat bagus, penjualan meningkat!', 1, 1, NULL, '2025-11-19 21:42:55'),
(4, 'Kim Waxler', 'Lawyer', NULL, 4, 'good enough', 0, 1, '2025-11-19 22:28:02', '2025-11-19 22:28:02'),
(5, 'Lalo Salamanca', 'Manager Bank', NULL, 5, 'Very Good', 0, 1, '2025-11-19 22:28:36', '2025-11-19 22:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Akmal Ghanim', 'ghanim77@gmail.com', 'user', NULL, '$2y$12$sJX3D3DrxtK8Qbw3vQ2CWu9Y7J/kREeR3ye1zxTR6JlPTl0JCEv1i', '49YSsbTaTSiJhdFT4n2RWXCNOBRj8qDG4xUE0PiqzSkngsAhbmDuU78g1Y3b', '2025-12-01 20:52:32', '2025-12-01 20:52:32'),
(4, 'Admin Photo It', 'admin@photoit.com', 'admin', '2025-12-01 21:02:44', '$2y$12$8KEGBhpE/VDYN48HsuuJm.C/.6p071LGbF8SCkYZUeLBqesvzH5/y', NULL, '2025-12-01 21:02:44', '2025-12-01 21:02:44'),
(5, 'Super Admin Photo It', 'superadmin@photoit.com', 'super_admin', '2025-12-02 23:21:30', '$2y$12$aXdE6CtTCRuwT3DTS1Pt8u1aOqj7mHjvzRCJv6BsJJeMceMeLEZ0S', 'jDW7j3DI0nt916VMSAj5WzuwnGL8HrKoD2NnVS3OTmfJYQuy1wXmVFWwFFDR', '2025-12-02 23:21:30', '2025-12-02 23:22:56'),
(6, 'orang aring', 'akmalghanim77@gmail.com', 'user', NULL, '$2y$12$q5NtuxeFBZk67cQyvj12H.VwCuMEhqxDzObaA7xbZCqVp3HK2QzX.', NULL, '2025-12-10 23:55:26', '2025-12-10 23:55:26'),
(7, 'fill nim', 'fillnim77@gmail.com', 'user', NULL, '$2y$12$DYS52seL8sJ2IanHy/Rv9eaeYmbA/x5fkBng44UQJGM1Ktz.vIXhe', 'ivkVfZUoTH7bHJMYTPayCD5Az8Denm3fa73vfoLC58vY9D4NqWY3qCma6CZ1', '2025-12-11 00:06:13', '2025-12-11 00:30:03'),
(8, 'jacob amazing', 'jacobamazing76@gmail.com', 'user', NULL, '$2y$12$uJ0rbEiuZEoNQLX3Py7f9uflhnklEglYRqj4AueS05hpQuv3gqsN2', NULL, '2025-12-11 00:32:29', '2025-12-11 00:32:29'),
(9, 'ahmad afgansyah', 'saturnv478@gmail.com', 'user', NULL, '$2y$12$u2D.IeqXBTOkCzro.ugEI.a303SGxkXZKmm4qh3bsBkhaAhd5HDPS', NULL, '2025-12-11 00:37:37', '2025-12-11 00:37:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD CONSTRAINT `gallery_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `gallery_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
