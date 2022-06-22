-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2022 at 05:47 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_parent_id_foreign` (`parent_id`),
  KEY `departments_created_by_foreign` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `status`, `parent_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'dasd asd', 'ASD asd ASD', 0, NULL, 1, '2022-06-08 02:34:05', '2022-06-08 02:34:05'),
(2, 'DDDD', 'DSF DSF SDF', 0, 1, 2, '2022-06-08 02:35:08', '2022-06-08 02:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_30_112948_create_departments_table', 1),
(6, '2022_06_08_024936_create_teams_table', 1),
(7, '2022_06_08_070427_create_team_user_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `parent_department_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_department_id_foreign` (`department_id`),
  KEY `teams_parent_department_id_foreign` (`parent_department_id`),
  KEY `teams_created_by_foreign` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `status`, `department_id`, `parent_department_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'First Team', 'A FSDF ADSF SD', 0, 2, 1, 2, '2022-06-08 02:36:18', '2022-06-08 02:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `team_user_roles`
--

DROP TABLE IF EXISTS `team_user_roles`;
CREATE TABLE IF NOT EXISTS `team_user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- Team Lead, 2- Team Member, 3- Manger, 4- Project Manger',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_user_roles_team_id_foreign` (`team_id`),
  KEY `team_user_roles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_user_roles`
--

INSERT INTO `team_user_roles` (`id`, `team_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2022-06-08 02:36:18', '2022-06-08 02:36:18'),
(2, 1, 4, 4, '2022-06-08 02:36:19', '2022-06-08 02:36:19'),
(3, 1, 5, 1, '2022-06-08 02:36:19', '2022-06-08 02:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0- for super admin, 1- for department admin, 2- for sub-department user',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_created_by_foreign` (`created_by`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `users_parent_id_foreign` (`parent_id`),
  KEY `users_parent_department_id_foreign` (`parent_department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `status`, `created_by`, `department_id`, `parent_id`, `parent_department_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'First Team', 'iqbalchannar796@gmail.com', NULL, '$2y$10$qM0WXklmDm47WL2eco4fCOwZrgE4sJQPEitdbAn2X1JmbzGRo2HEm', 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-06-08 02:33:31', '2022-06-08 02:33:31'),
(2, 'First Team', 'parentadmin@gmail.com', NULL, '$2y$10$c.NpsvVkzOZxjDZugSuep.CARgoawbuDUkD1WGzYOTQF2EiyPYMg6', 1, 1, 1, 1, NULL, NULL, NULL, '2022-06-08 02:34:26', '2022-06-08 02:34:26'),
(3, 'SFSDFDSFF', 'SFADFS@GMAIL.COM', NULL, '$2y$10$OCOlxguyCx4kOj9w9WksGOVUKJC4sYAsDWeBbqSvMufyM2.aKDRtu', 2, 1, 2, 2, 2, 1, NULL, '2022-06-08 02:36:18', '2022-06-08 02:36:18'),
(4, 'SDF SDF SDF', 'iqbalchannaSDFSDFSDFr796@gmail.com', NULL, '$2y$10$BSkibwg6C4zszw.xbAQlW.7LOO1UIcctDPKm1NGrFFGeRh0Zs4fUO', 2, 1, 2, 2, 2, 1, NULL, '2022-06-08 02:36:19', '2022-06-08 02:36:19'),
(5, 'SDFSF SDF', 'parentadmin1234@gmail.com', NULL, '$2y$10$3PUjaDa7Mat3vpPd8/1hvuW6Lh47pfyDw1IAboW/arFA7DM41P2ua', 2, 1, 2, 2, 2, 1, NULL, '2022-06-08 02:36:19', '2022-06-08 02:36:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
