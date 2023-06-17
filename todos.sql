-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2023 at 05:46 AM
-- Server version: 5.7.21
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todos`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optView` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optCreate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optShow` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optEdit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optDelete` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `header`, `name`, `optView`, `optCreate`, `optShow`, `optEdit`, `optDelete`) VALUES
(1, 'Permission', 'Role', 'View', 'Create', 'Show', 'Edit', 'Delete'),
(2, 'Permission', 'User', 'View', 'Create', 'Show', 'Edit', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_02_132737_create_labels_table', 1),
(6, '2022_05_02_132920_create_roles_table', 1),
(7, '2022_05_02_133125_create_permissions_table', 1),
(8, '2022_05_03_141819_create_theme_settings_table', 1),
(9, '2022_05_26_015457_create_user_histories_table', 1),
(10, '2023_06_14_040344_create_todos_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `optView` tinyint(1) NOT NULL DEFAULT '0',
  `optCreate` tinyint(1) NOT NULL DEFAULT '0',
  `optShow` tinyint(1) NOT NULL DEFAULT '0',
  `optEdit` tinyint(1) NOT NULL DEFAULT '0',
  `optDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `header`, `name`, `role_id`, `optView`, `optCreate`, `optShow`, `optEdit`, `optDelete`) VALUES
(1, 'Permission', 'Role', 1, 1, 1, 1, 1, 1),
(2, 'Permission', 'User', 1, 1, 1, 1, 1, 1),
(3, 'Permission', '0_Role', 2, 0, 0, 0, 0, 0),
(4, 'Permission', 'User', 2, 1, 1, 1, 1, 1),
(5, 'Permission', 'Role', 3, 1, 1, 1, 1, 1),
(6, 'Permission', '0_User', 3, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `remark`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super_Admin', NULL, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Admin', NULL, 1, 0, 1, 1, NULL, '2023-06-16 21:48:42', '2023-06-16 22:21:04', NULL),
(3, 'Admin 1', NULL, 1, 0, 1, NULL, NULL, '2023-06-16 22:21:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `user_id`, `theme`, `compact`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'default', 'fixed', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:pending, 1:completed',
  `delete_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:active, 1:deleted',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `name`, `due_date`, `description`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Quam debitis voluptatem vel ab.', '2023-06-21', 'Ea nihil recusandae et est reprehenderit aut laborum pariatur nisi ad aperiam.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Fuga adipisci ex.', '2023-07-03', 'Neque saepe nisi voluptatem facere vero ullam quibusdam consectetur labore dicta maiores velit.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(3, 'Voluptatem mollitia laborum numquam.', '2023-07-12', 'Et doloribus ut vero neque possimus quia numquam.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(4, 'Debitis similique omnis officiis.', '2023-06-26', 'Vero fugit ea et error facere id ratione quia et.', 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(5, 'Quis quo error perspiciatis.', '2023-06-15', 'Et expedita ea et quae aperiam et officia non quis quia vero.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(6, 'Doloribus magni voluptas officia.', '2023-06-27', 'Aut veritatis nihil dolore maxime ipsa eveniet rerum voluptatem.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(7, 'Numquam commodi vitae eum assumenda.', '2023-06-27', 'Quidem quia expedita rerum magnam sequi et.', 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(8, 'Aperiam sed eum.', '2023-07-03', 'Blanditiis alias dolorem incidunt vel et in aut nesciunt aut odit.', 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(9, 'Hic totam soluta at.', '2023-07-14', 'Omnis omnis est quis ad exercitationem deserunt impedit corrupti et et.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(10, 'Rerum aut.', '2023-07-01', 'Doloribus quae dolor eligendi saepe quo magnam rerum consequatur.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(11, 'Illo consequuntur nam voluptas.', '2023-07-05', 'Alias ut enim reiciendis omnis dolor odit.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(12, 'Facilis sit eum.', '2023-06-19', 'Error officiis in quod ad voluptas sunt ducimus in ut.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(13, 'Esse consequatur aut accusamus.', '2023-06-18', 'Et placeat omnis dicta ab dolor facere et numquam in ea non voluptatem in.', 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(14, 'Quia maiores est.', '2023-06-23', 'Neque qui iste corporis sed aut accusamus accusamus occaecati possimus in.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(15, 'Sit quia qui est.', '2023-07-09', 'Eveniet odit ipsa odit eaque debitis voluptatum dolores laborum qui exercitationem quis non ipsum.', 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(16, 'Mean Vatanak', '2023-06-17', 'test', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Projector Screen', '2023-06-30', 'test', 0, 0, NULL, NULL, NULL, '2023-06-16 05:31:10', '2023-06-16 05:31:10', NULL),
(18, 'Project Project', '2023-06-29', NULL, 0, 0, NULL, NULL, NULL, '2023-06-16 21:32:26', '2023-06-16 21:32:26', NULL),
(19, 'Mean Vatanak', '2023-06-30', 'test', 0, 0, NULL, NULL, NULL, '2023-06-16 21:43:10', '2023-06-16 21:43:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role_id` int(11) NOT NULL,
  `theme_id` tinyint(1) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `delete_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `gender`, `image`, `email`, `verified_at`, `token`, `name`, `address`, `role_id`, `theme_id`, `status`, `delete_status`, `created_at`, `created_id`, `updated_at`, `updated_id`, `deleted_at`, `deleted_id`) VALUES
(1, 'admin', '$2y$10$Ir9pPSNROOaKTIvU0rNBQ.MwHFAqwHZdjQlWbMM.BRBZDAL7rEZxi', '010300667', '', '', 'ict@camasean.edu.kh', NULL, '', 'Mean Vatanak', '1', 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_role_id_unique` (`name`,`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
