-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 23, 2025 at 10:52 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elpartner_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache`
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
('laravel_cache_a@gmail.com|127.0.0.1', 'i:2;', 1750710786),
('laravel_cache_a@gmail.com|127.0.0.1:timer', 'i:1750710786;', 1750710786),
('laravel_cache_adrian1@gmail.com|127.0.0.1', 'i:2;', 1750514095),
('laravel_cache_adrian1@gmail.com|127.0.0.1:timer', 'i:1750514095;', 1750514095);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `nip`, `email`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TechNova Sp. z o.o.', '1234563218', 'kontakt@technova.pl', '123-456-789', 'ul. Innowacji 15, 00-001 Warszawa', '2025-06-04 06:28:19', '2025-06-04 06:28:19', NULL),
(2, 'GreenSoft Polska', '9876543210', 'biuro@greensoft.pl', '987-654-321', 'ul. Zielona 22, 61-100 Poznań', '2025-06-04 06:29:14', '2025-06-04 06:29:14', NULL),
(3, 'LogiTech Solutions', '8529637415', 'info@logitechsolutions.com', '601-234-567', 'al. Logistyki 99, 40-200 Katowice', '2025-06-04 06:29:42', '2025-06-04 06:29:42', NULL),
(4, 'ProMedia Group', '3692581470', 'kontakt@promedia.pl', '533-123-456', 'ul. Kreatywna 1, 80-200 Gdańsk', '2025-06-04 06:30:05', '2025-06-04 06:30:05', NULL),
(5, 'Adrian Ratajczak', '1111111111', 'adziussuper@gmail.com', '017656610295', 'Srem', '2025-06-21 12:42:51', '2025-06-21 12:43:08', '2025-06-21 12:43:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
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
-- Struktura tabeli dla tabeli `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `invoice_number`, `issue_date`, `due_date`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '1', '2025-06-04', '2025-06-05', 200.00, '2025-06-04 19:38:24', '2025-06-04 19:38:24', NULL),
(2, 5, 'INV/2025/0012', '2025-06-23', '2025-06-23', 1000.00, '2025-06-23 18:38:34', '2025-06-23 18:38:34', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_02_152436_add_role_to_users_table', 1),
(5, '2025_06_02_152616_create_clients_table', 1),
(6, '2025_06_02_152650_create_suppliers_table', 1),
(7, '2025_06_02_152705_create_products_table', 1),
(8, '2025_06_02_152719_create_orders_table', 1),
(9, '2025_06_02_152729_create_invoices_table', 1),
(10, '2025_06_02_152741_create_order_product_table', 1),
(11, '2025_06_02_152831_create_registration_codes_table', 1),
(13, '2025_06_04_210624_alter_order_product_set_default_prices', 2),
(14, '2025_06_04_213716_add_order_number_to_orders_table', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `client_id`, `order_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 2, '2025-06-04', 'Scheduled', '2025-06-04 18:42:29', '2025-06-04 19:10:48', '2025-06-04 19:10:48'),
(2, NULL, 2, '2025-06-04', 'Scheduled', '2025-06-04 19:11:06', '2025-06-04 19:24:57', '2025-06-04 19:24:57'),
(3, NULL, 2, '2025-06-05', 'Scheduled', '2025-06-04 19:38:07', '2025-06-04 19:38:07', NULL),
(4, NULL, 3, '2025-06-21', 'Confirmed', '2025-06-21 12:49:58', '2025-06-21 12:49:58', NULL),
(5, NULL, 2, '2025-06-22', 'Scheduled', '2025-06-23 18:36:15', '2025-06-23 18:36:15', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_buy` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_sell` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `price_buy`, `price_sell`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 2, 0.00, 0.00, '2025-06-04 19:11:06', '2025-06-04 19:11:06'),
(2, 3, 2, 2, 42.00, 75.00, '2025-06-04 19:38:07', '2025-06-04 19:38:07'),
(3, 4, 2, 3, 42.00, 75.00, '2025-06-21 12:49:58', '2025-06-21 12:49:58'),
(4, 4, 1, 1, 120.00, 190.00, '2025-06-21 12:49:58', '2025-06-21 12:49:58'),
(5, 5, 5, 2, 90.00, 140.00, '2025-06-23 18:36:15', '2025-06-23 18:36:15'),
(6, 5, 3, 3, 38.00, 69.00, '2025-06-23 18:36:15', '2025-06-23 18:36:15'),
(7, 5, 4, 1, 75.00, 120.00, '2025-06-23 18:36:15', '2025-06-23 18:36:15'),
(8, 5, 1, 2, 120.00, 190.00, '2025-06-23 18:36:15', '2025-06-23 18:36:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price_buy` decimal(10,2) NOT NULL,
  `price_sell` decimal(10,2) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price_buy`, `price_sell`, `supplier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'X200 Mechanical Keyboard', 'Durable mechanical keyboard with RGB backlighting, metal base, and Kailh Red switches. Ideal for gaming and productivity', 120.00, 190.00, 1, '2025-06-04 06:36:56', '2025-06-04 06:36:56', NULL),
(2, 'L-Click Wireless Mouse 2.4GHz', 'Ergonomic wireless mouse with silent buttons, adjustable DPI, and USB receiver. Powered by AA battery', 42.00, 75.00, 1, '2025-06-04 06:37:41', '2025-06-04 06:39:34', NULL),
(3, 'Eco Paper Bags 35x40cm (100pcs)', 'Bulk pack of 100 biodegradable paper bags made of recycled kraft paper. Eco-friendly alternative for retail stores', 38.00, 69.00, 2, '2025-06-04 06:38:13', '2025-06-04 06:38:13', NULL),
(4, 'Cardboard Boxes 30x20x10 (50pcs)', 'Set of 50 single-wall cardboard shipping boxes. Made from 100% recycled paper. Ideal for e-commerce packaging', 75.00, 120.00, 2, '2025-06-04 06:38:40', '2025-06-04 06:38:40', NULL),
(5, 'A4 Business Flyers – Full Color (500pcs)', 'Premium 135gsm gloss-coated flyers, A4 size, double-sided full-color printing. Delivered in 2–3 business days', 90.00, 140.00, 3, '2025-06-04 06:39:03', '2025-06-04 06:39:03', NULL),
(6, 'PVC Business Cards – Matte Finish (1000pcs)', 'High-quality PVC business cards, matte laminated, 85x55mm. Delivered in branded packaging', 110.00, 180.00, 3, '2025-06-04 06:39:25', '2025-06-04 06:39:25', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `registration_codes`
--

CREATE TABLE `registration_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registration_codes`
--

INSERT INTO `registration_codes` (`id`, `code`, `is_used`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'kB4UCri4Bk', 1, 1, '2025-06-04 06:02:46', '2025-06-04 06:03:12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
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
('g9K8bUokyftGUpdZ7F3LioT3HKyHE3Pzsrjc9Zlp', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVBQamJTOTlMajYxY0x4MG5qcU1qSEZqd05uckpKSUZSNjZjTXMyViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1750517642),
('I5Srt93bbQXDRNgOkiTDBRppVusBYvA4EfWt7MSy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUzJlRnFvcE56YTZFZ1lRU2JQRlRWQVFpbXQ1T0FxVlROTmFya0trciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RyYXRpb24tY29kZXMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1750711402);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `nip`, `email`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NextTech Electronics', '5478210963', 'kontakt@nexttech.pl', '501-101-202', 'ul. Nowoczesna 10, 02-300 Warszawa', '2025-06-04 06:30:55', '2025-06-04 06:30:55', NULL),
(2, 'EcoPack Solutions', '6829453107', 'biuro@ecopack.pl', '609-321-654', 'ul. Zielona Dolina 7, 90-001 Łódź', '2025-06-04 06:31:18', '2025-06-04 06:31:18', NULL),
(3, 'Print4U Sp. z o.o.', '2987456213', 'info@print4u.pl', '512-789-456', 'ul. Drukarska 5, 31-002 Kraków', '2025-06-04 06:31:44', '2025-06-04 06:31:44', NULL),
(4, 'SoftCom Import', '7658492013', 'kontakt@softcom.pl', '798-456-123', 'al. Biznesu 99, 50-050 Wrocław', '2025-06-04 06:32:39', '2025-06-04 06:32:39', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$5jYMKEqPWh5Dx/w0D29GjeO9PWKsvJBMOqMe7pYstx.MaQwni6bh.', 'admin', NULL, '2025-06-02 17:54:53', '2025-06-02 17:54:53'),
(2, 'Adrian', 'adrian@gmail.com', NULL, '$2y$12$i.C3IONDzFr/ODk/9amJU.C/.4kdhI9xgCHLybjg5TBiJenxA/7Ga', 'user', NULL, '2025-06-04 06:03:12', '2025-06-04 06:03:12');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeksy dla tabeli `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_nip_unique` (`nip`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indeksy dla tabeli `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeksy dla tabeli `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Indeksy dla tabeli `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indeksy dla tabeli `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indeksy dla tabeli `registration_codes`
--
ALTER TABLE `registration_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_codes_code_unique` (`code`),
  ADD KEY `registration_codes_created_by_foreign` (`created_by`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeksy dla tabeli `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_nip_unique` (`nip`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration_codes`
--
ALTER TABLE `registration_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registration_codes`
--
ALTER TABLE `registration_codes`
  ADD CONSTRAINT `registration_codes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
