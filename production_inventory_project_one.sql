-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 01:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `production_inventory_project_one`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `buyer_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bestseller A/S', 'Active', 1, NULL, NULL, '2023-07-24 03:39:30', '2023-07-24 03:39:30', NULL),
(2, 'G-Star Raw CV', 'Active', 1, NULL, NULL, '2023-07-27 22:33:16', '2023-07-27 22:33:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grey', 'Active', 1, NULL, NULL, '2023-07-24 03:39:44', '2023-07-24 03:39:44', NULL),
(2, 'Pitch Black', 'Active', 1, NULL, NULL, '2023-07-28 05:16:51', '2023-07-28 05:16:51', NULL),
(3, 'Black', 'Active', 1, NULL, NULL, '2023-07-28 05:17:07', '2023-07-28 05:17:07', NULL),
(4, 'N/A', 'Active', 1, NULL, NULL, '2023-07-28 05:17:41', '2023-07-28 05:17:41', NULL);

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
-- Table structure for table `garment_types`
--

CREATE TABLE `garment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `garment_types`
--

INSERT INTO `garment_types` (`id`, `item_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Long Pant', 'Active', 1, 1, NULL, '2023-07-25 04:38:30', '2023-07-25 04:38:53', NULL),
(2, 'Short Pant', 'Active', 1, NULL, NULL, '2023-07-27 22:33:50', '2023-07-27 22:33:50', NULL),
(3, 'Jacket', 'Active', 1, NULL, NULL, '2023-07-28 05:25:10', '2023-07-28 05:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lines`
--

CREATE TABLE `lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `line_no` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lines`
--

INSERT INTO `lines` (`id`, `line_no`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Line-2', 'Active', 1, 1, NULL, '2023-07-25 04:44:33', '2023-07-25 04:44:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_styles`
--

CREATE TABLE `master_styles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `wash_id` int(11) NOT NULL,
  `garment_type_id` int(11) NOT NULL,
  `status` enum('Inactive','Running','Hold','Close','Cancel') NOT NULL DEFAULT 'Inactive',
  `status_change_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_styles`
--

INSERT INTO `master_styles` (`id`, `unique_id`, `buyer_id`, `style_id`, `season_id`, `color_id`, `wash_id`, `garment_type_id`, `status`, `status_change_date`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 1, 1, 2, 1, 'Inactive', NULL, 1, 1, NULL, '2023-07-27 22:34:08', '2023-07-28 05:44:59', NULL),
(2, 2, 1, 1, 2, 1, 3, 2, 'Inactive', NULL, 1, 1, NULL, '2023-07-27 22:34:20', '2023-07-28 05:44:48', NULL),
(4, 3, 1, 1, 2, 3, 3, 2, 'Inactive', NULL, 1, NULL, NULL, '2023-07-28 05:45:33', '2023-07-28 05:51:41', NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_15_141849_create_washes_table', 1),
(6, '2023_07_15_142031_create_colors_table', 1),
(7, '2023_07_16_092351_create_buyers_table', 1),
(8, '2023_07_16_092448_create_seasons_table', 1),
(18, '2023_07_17_092359_create_styles_table', 2),
(21, '2023_07_25_095557_create_garment_types_table', 2),
(22, '2023_07_25_095914_create_lines_table', 2),
(23, '2023_07_25_092333_create_style_bpo_orders_table', 3),
(24, '2023_07_25_051143_create_master_styles_table', 4);

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
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `season_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1-2-3/23', 'Active', 1, NULL, NULL, '2023-07-24 03:39:38', '2023-07-24 03:39:38', NULL),
(2, '7-8-9/23', 'Active', 1, NULL, NULL, '2023-07-25 05:31:35', '2023-07-25 05:31:35', NULL),
(3, '23Q4', 'Active', 1, NULL, NULL, '2023-07-28 05:16:30', '2023-07-28 05:16:30', NULL),
(4, 'N/A', 'Active', 1, NULL, NULL, '2023-07-28 05:17:48', '2023-07-28 05:17:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `style_name` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `buyer_id`, `style_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'JJIERIK JJORIGINAL GE 511 SN', 'Active', 1, 1, NULL, '2023-07-25 04:50:13', '2023-07-28 05:23:39', NULL),
(2, 1, 'JJIERIK JJORIGINAL GE 510 SN', 'Active', 1, 1, NULL, '2023-07-25 05:29:26', '2023-07-28 05:19:55', NULL),
(4, 2, 'D19079-B964-A810', 'Active', 1, NULL, NULL, '2023-07-28 05:16:03', '2023-07-28 05:16:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `style_bpo_orders`
--

CREATE TABLE `style_bpo_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_style_id` int(11) NOT NULL,
  `bpo_no` longtext NOT NULL,
  `order_quantity` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `style_bpo_orders`
--

INSERT INTO `style_bpo_orders` (`id`, `master_style_id`, `bpo_no`, `order_quantity`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(79, 6, 'AAA', 201.00, 1, NULL, '2023-07-27 04:16:29', '2023-07-27 04:16:29'),
(80, 6, 'AAA', 202.00, 1, NULL, '2023-07-27 04:16:29', '2023-07-27 04:16:29'),
(81, 6, 'AAA', 203.00, 1, NULL, '2023-07-27 04:16:29', '2023-07-27 04:16:29'),
(82, 6, 'AAA', 204.00, 1, NULL, '2023-07-27 04:16:29', '2023-07-27 04:16:29'),
(86, 6, 'AAA', 201.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40'),
(87, 6, 'AAA', 202.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40'),
(88, 6, 'AAA', 203.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40'),
(89, 6, 'AAA', 204.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40'),
(90, 6, 'AAA', 500.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40'),
(91, 6, 'AAA', 300.00, 1, NULL, '2023-07-27 04:20:40', '2023-07-27 04:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Employee','User') NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$yH1/7/bvwqLZpqA4JbAvYO4Dio5a55tSXB3ISOI5RYN/tkQIMqsw6', 'Admin', 'Active', NULL, NULL, NULL),
(2, 'Employee', 'employee@email.com', '$2y$10$Y/WWv.UU8RVCWK0W1pnurOixxMGmuus75Ni9WBD5pJLhoshZdLovi', 'Employee', 'Active', NULL, NULL, NULL),
(3, 'User', 'user@email.com', '$2y$10$ZchHwb.k8eQiEZ84ka6.v.KH7aXRQ2agVOqOnNlqhZnjUAFI3oR2q', 'User', 'Active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `washes`
--

CREATE TABLE `washes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wash_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `washes`
--

INSERT INTO `washes` (`id`, `wash_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'GE 510', 'Active', 1, NULL, NULL, '2023-07-24 03:39:50', '2023-07-24 03:39:50', NULL),
(3, 'GE 511', 'Active', 1, NULL, NULL, '2023-07-26 23:56:12', '2023-07-26 23:56:12', NULL),
(4, 'N/A', 'Active', 1, NULL, NULL, '2023-07-28 05:17:32', '2023-07-28 05:17:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `garment_types`
--
ALTER TABLE `garment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lines`
--
ALTER TABLE `lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_styles`
--
ALTER TABLE `master_styles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_styles_unique_id_unique` (`unique_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `style_bpo_orders`
--
ALTER TABLE `style_bpo_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `washes`
--
ALTER TABLE `washes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garment_types`
--
ALTER TABLE `garment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lines`
--
ALTER TABLE `lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_styles`
--
ALTER TABLE `master_styles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `style_bpo_orders`
--
ALTER TABLE `style_bpo_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `washes`
--
ALTER TABLE `washes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
