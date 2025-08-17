-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2025 at 06:13 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u125955421_learn`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempt_answers`
--

CREATE TABLE `attempt_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) DEFAULT NULL,
  `user_answer` text NOT NULL,
  `auto_mark` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attempt_group_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attempt_answers`
--

INSERT INTO `attempt_answers` (`id`, `user_id`, `module_id`, `lesson_id`, `quiz_id`, `user_answer`, `auto_mark`, `created_at`, `updated_at`, `attempt_group_id`) VALUES
(1, 2, 2, 2, 1, 'A', 1, '2025-02-16 14:24:09', '2025-02-16 14:24:09', NULL),
(2, 2, 2, 2, 2, 'B', 0, '2025-02-16 14:24:09', '2025-02-16 14:24:09', NULL),
(3, 1, 2, 2, 1, 'A', 1, '2025-02-17 18:34:41', '2025-02-17 18:34:41', NULL),
(4, 1, 2, 2, 2, 'B', 0, '2025-02-17 18:34:41', '2025-02-17 18:34:41', NULL),
(5, 11, 2, 2, 1, 'A', 1, '2025-04-03 08:32:45', '2025-04-03 08:32:45', NULL),
(6, 11, 2, 2, 2, 'B', 0, '2025-04-03 08:32:45', '2025-04-03 08:32:45', NULL),
(7, 1, 2, 2, 1, 'A', 1, '2025-06-18 06:45:11', '2025-06-18 06:45:11', NULL),
(8, 1, 2, 2, 2, 'A', 1, '2025-06-18 06:45:11', '2025-06-18 06:45:11', NULL),
(9, 11, 7, 6, 4, 'B', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(10, 11, 7, 6, 5, 'C', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(11, 11, 7, 6, 6, 'A', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(12, 11, 7, 6, 7, 'B', 0, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(13, 11, 7, 6, 8, 'A', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(14, 11, 7, 6, 9, 'C', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(15, 11, 7, 6, 10, 'B', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(16, 11, 7, 6, 11, 'C', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(17, 11, 7, 6, 12, 'B', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(18, 11, 7, 6, 13, 'C', 1, '2025-07-10 12:37:12', '2025-07-10 12:37:12', NULL),
(19, 11, 7, 6, 4, 'B', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(20, 11, 7, 6, 5, 'C', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(21, 11, 7, 6, 6, 'A', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(22, 11, 7, 6, 7, 'C', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(23, 11, 7, 6, 8, 'A', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(24, 11, 7, 6, 9, 'C', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(25, 11, 7, 6, 10, 'B', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(26, 11, 7, 6, 11, 'C', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(27, 11, 7, 6, 12, 'B', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(28, 11, 7, 6, 13, 'C', 1, '2025-07-10 12:38:51', '2025-07-10 12:38:51', NULL),
(29, 296, 7, 6, 4, 'B', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(30, 296, 7, 6, 5, 'C', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(31, 296, 7, 6, 6, 'A', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(32, 296, 7, 6, 7, 'C', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(33, 296, 7, 6, 8, 'A', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(34, 296, 7, 6, 9, 'C', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(35, 296, 7, 6, 10, 'B', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(36, 296, 7, 6, 11, 'C', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(37, 296, 7, 6, 12, 'B', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(38, 296, 7, 6, 13, 'C', 1, '2025-07-17 15:31:35', '2025-07-17 15:31:35', NULL),
(39, 5, 7, 6, 4, 'B', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(40, 5, 7, 6, 5, 'C', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(41, 5, 7, 6, 6, 'A', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(42, 5, 7, 6, 7, 'C', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(43, 5, 7, 6, 8, 'A', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(44, 5, 7, 6, 9, 'C', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(45, 5, 7, 6, 10, 'B', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(46, 5, 7, 6, 11, 'C', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(47, 5, 7, 6, 12, 'B', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(48, 5, 7, 6, 13, 'C', 1, '2025-07-17 15:38:00', '2025-07-17 15:38:00', NULL),
(49, 245, 7, 6, 4, 'B', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(50, 245, 7, 6, 5, 'C', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(51, 245, 7, 6, 6, 'A', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(52, 245, 7, 6, 7, 'C', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(53, 245, 7, 6, 8, 'A', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(54, 245, 7, 6, 9, 'C', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(55, 245, 7, 6, 10, 'B', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(56, 245, 7, 6, 11, 'C', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(57, 245, 7, 6, 12, 'B', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(58, 245, 7, 6, 13, 'C', 1, '2025-07-17 16:03:52', '2025-07-17 16:03:52', NULL),
(59, 307, 7, 6, 4, 'B', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(60, 307, 7, 6, 5, 'C', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(61, 307, 7, 6, 6, 'A', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(62, 307, 7, 6, 7, 'C', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(63, 307, 7, 6, 8, 'A', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(64, 307, 7, 6, 9, 'C', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(65, 307, 7, 6, 10, 'B', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(66, 307, 7, 6, 11, 'C', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(67, 307, 7, 6, 12, 'B', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(68, 307, 7, 6, 13, 'C', 1, '2025-07-17 16:24:32', '2025-07-17 16:24:32', NULL),
(69, 202, 7, 6, 4, 'B', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(70, 202, 7, 6, 5, 'C', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(71, 202, 7, 6, 6, 'A', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(72, 202, 7, 6, 7, 'C', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(73, 202, 7, 6, 8, 'A', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(74, 202, 7, 6, 9, 'C', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(75, 202, 7, 6, 10, 'B', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(76, 202, 7, 6, 11, 'C', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(77, 202, 7, 6, 12, 'A', 0, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL),
(78, 202, 7, 6, 13, 'C', 1, '2025-07-18 15:42:02', '2025-07-18 15:42:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trails`
--

CREATE TABLE `audit_trails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`id`, `user_id`, `module`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 4, 'User', 'Viewed List User Page', '45.215.254.252', '2024-11-01 02:47:41', '2024-11-01 02:47:41'),
(2, 1, 'User', 'Viewed List User Page', '41.174.43.96', '2024-11-12 09:19:32', '2024-11-12 09:19:32'),
(3, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2024-11-12 09:21:13', '2024-11-12 09:21:13'),
(4, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2024-11-12 09:21:19', '2024-11-12 09:21:19'),
(5, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2024-11-12 09:23:36', '2024-11-12 09:23:36'),
(6, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2024-11-12 09:28:50', '2024-11-12 09:28:50'),
(7, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2024-11-12 09:28:53', '2024-11-12 09:28:53'),
(8, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2024-11-12 09:30:44', '2024-11-12 09:30:44'),
(9, 5, 'User', 'Created Business record with ID {\"name\":\"Harriet Nalungwe\",\"email\":\"Harriet.Nalungwe@natsave.co.zm\",\"branch_id\":\"1\",\"role_id\":\"2\",\"user_id\":5,\"updated_at\":\"2024-11-12T09:31:12.000000Z\",\"created_at\":\"2024-11-12T09:31:12.000000Z\",\"id\":8}', '41.77.145.194', '2024-11-12 09:31:12', '2024-11-12 09:31:12'),
(10, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2024-11-12 09:31:12', '2024-11-12 09:31:12'),
(11, 1, 'User', 'Viewed List User Page', '2c0f:2a80:103e:d010:bd92:8d1c:a1d4:dc8f', '2024-12-06 11:49:38', '2024-12-06 11:49:38'),
(12, 1, 'User', 'Viewed List User Page', '102.212.181.92', '2025-02-05 13:56:24', '2025-02-05 13:56:24'),
(13, 5, 'User', 'Viewed List User Page', '41.174.44.115', '2025-02-06 05:42:56', '2025-02-06 05:42:56'),
(14, 5, 'User', 'Viewed List User Page', '41.174.44.115', '2025-02-06 05:42:57', '2025-02-06 05:42:57'),
(15, 5, 'User', 'Viewed Create User Page', '41.174.44.115', '2025-02-06 06:00:13', '2025-02-06 06:00:13'),
(16, 5, 'User', 'Viewed List User Page', '41.60.197.26', '2025-02-06 12:22:19', '2025-02-06 12:22:19'),
(17, 5, 'User', 'Viewed List User Page', '41.60.197.26', '2025-02-06 12:58:17', '2025-02-06 12:58:17'),
(18, 5, 'User', 'Viewed Create User Page', '41.60.197.26', '2025-02-06 12:58:20', '2025-02-06 12:58:20'),
(19, 5, 'User', 'Created Business record with ID {\"name\":\"Ingrid Brock\",\"email\":\"testy@ontech.co.zm\",\"branch_id\":\"1\",\"role_id\":\"1\",\"user_id\":5,\"updated_at\":\"2025-02-06T12:59:01.000000Z\",\"created_at\":\"2025-02-06T12:59:01.000000Z\",\"id\":9}', '41.60.197.26', '2025-02-06 12:59:01', '2025-02-06 12:59:01'),
(20, 5, 'User', 'Viewed List User Page', '41.60.197.26', '2025-02-06 12:59:02', '2025-02-06 12:59:02'),
(21, 5, 'User', 'Viewed Create User Page', '41.60.197.26', '2025-02-06 12:59:29', '2025-02-06 12:59:29'),
(22, 2, 'User', 'Viewed List User Page', '41.216.95.232', '2025-02-16 10:05:32', '2025-02-16 10:05:32'),
(23, 2, 'User', 'Viewed List User Page', '41.216.95.232', '2025-02-16 14:26:07', '2025-02-16 14:26:07'),
(24, 2, 'User', 'Viewed Create User Page', '41.216.95.232', '2025-02-16 14:26:10', '2025-02-16 14:26:10'),
(25, 2, 'User', 'Created Business record with ID {\"name\":\"yvy\",\"email\":\"yvy@gmail.com\",\"branch_id\":\"1\",\"role_id\":\"2\",\"user_id\":2,\"updated_at\":\"2025-02-16T14:26:36.000000Z\",\"created_at\":\"2025-02-16T14:26:36.000000Z\",\"id\":10}', '41.216.95.232', '2025-02-16 14:26:36', '2025-02-16 14:26:36'),
(26, 2, 'User', 'Viewed List User Page', '41.216.95.232', '2025-02-16 14:26:36', '2025-02-16 14:26:36'),
(27, 5, 'User', 'Viewed List User Page', '102.212.181.22', '2025-02-16 22:31:39', '2025-02-16 22:31:39'),
(28, 5, 'User', 'Viewed List User Page', '102.212.181.22', '2025-02-16 22:31:56', '2025-02-16 22:31:56'),
(29, 5, 'User', 'Viewed Create User Page', '102.212.181.22', '2025-02-16 22:32:03', '2025-02-16 22:32:03'),
(30, 5, 'Branch', 'Viewed List Branch Page', '102.212.181.22', '2025-02-16 22:35:12', '2025-02-16 22:35:12'),
(31, 5, 'Branch', 'Viewed Create Branch Page', '102.212.181.22', '2025-02-16 22:35:15', '2025-02-16 22:35:15'),
(32, 5, 'User', 'Viewed List User Page', '102.212.181.22', '2025-02-17 17:57:41', '2025-02-17 17:57:41'),
(33, 1, 'User', 'Viewed List User Page', '102.212.181.22', '2025-02-17 18:27:02', '2025-02-17 18:27:02'),
(34, 1, 'User', 'Viewed List User Page', '41.175.24.179', '2025-03-07 13:14:49', '2025-03-07 13:14:49'),
(35, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-04-02 10:29:49', '2025-04-02 10:29:49'),
(36, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-04-02 11:19:21', '2025-04-02 11:19:21'),
(37, 5, 'User', 'Created Business record with ID {\"name\":\"Vivien Dube\",\"email\":\"Vivien.Dube@natsave.co.zm\",\"branch_id\":\"1\",\"role_id\":\"2\",\"user_id\":5,\"updated_at\":\"2025-04-02T11:20:14.000000Z\",\"created_at\":\"2025-04-02T11:20:14.000000Z\",\"id\":11}', '41.77.145.194', '2025-04-02 11:20:14', '2025-04-02 11:20:14'),
(38, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-04-02 11:20:14', '2025-04-02 11:20:14'),
(39, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-04-03 08:29:05', '2025-04-03 08:29:05'),
(40, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-04-03 08:39:14', '2025-04-03 08:39:14'),
(41, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:6b31:99b8:16bc:a05', '2025-06-18 06:29:13', '2025-06-18 06:29:13'),
(42, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:6b31:99b8:16bc:a05', '2025-06-18 06:29:25', '2025-06-18 06:29:25'),
(43, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:d79:e169:9b51:6841', '2025-06-18 06:51:35', '2025-06-18 06:51:35'),
(44, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:d79:e169:9b51:6841', '2025-06-18 06:52:03', '2025-06-18 06:52:03'),
(45, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:02:51', '2025-06-18 08:02:51'),
(46, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:07:06', '2025-06-18 08:07:06'),
(47, 1, 'User', 'Created Business record with ID {\"name\":\"Harriet Edwards\",\"email\":\"prisca.kamaloni@gmail.com\",\"branch_id\":\"1\",\"role_id\":\"1\",\"user_id\":1,\"updated_at\":\"2025-06-18T08:09:17.000000Z\",\"created_at\":\"2025-06-18T08:09:17.000000Z\",\"id\":12}', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:09:17', '2025-06-18 08:09:17'),
(48, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:09:18', '2025-06-18 08:09:18'),
(49, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:12:11', '2025-06-18 08:12:11'),
(50, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:12:14', '2025-06-18 08:12:14'),
(51, 1, 'Branch', 'Viewed Create Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:12:21', '2025-06-18 08:12:21'),
(52, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:13:24', '2025-06-18 08:13:24'),
(53, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:32:26', '2025-06-18 08:32:26'),
(54, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:32:35', '2025-06-18 08:32:35'),
(55, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 08:32:56', '2025-06-18 08:32:56'),
(56, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:09:47', '2025-06-18 09:09:47'),
(57, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 09:09:47', '2025-06-18 09:09:47'),
(58, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 09:09:56', '2025-06-18 09:09:56'),
(59, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:10:01', '2025-06-18 09:10:01'),
(60, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:10:23', '2025-06-18 09:10:23'),
(61, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:10:30', '2025-06-18 09:10:30'),
(62, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:10:35', '2025-06-18 09:10:35'),
(63, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:18:08', '2025-06-18 09:18:08'),
(64, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:18:28', '2025-06-18 09:18:28'),
(65, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:20:54', '2025-06-18 09:20:54'),
(66, 12, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 09:22:44', '2025-06-18 09:22:44'),
(67, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:26:58', '2025-06-18 09:26:58'),
(68, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:27:00', '2025-06-18 09:27:00'),
(69, 1, 'User', 'Created Business record with ID {\"name\":\"Chela Maivune\",\"email\":\"chela@natsave.co.zm\",\"branch_id\":\"1\",\"role_id\":\"2\",\"user_id\":1,\"updated_at\":\"2025-06-18T09:27:45.000000Z\",\"created_at\":\"2025-06-18T09:27:45.000000Z\",\"id\":13}', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:27:45', '2025-06-18 09:27:45'),
(70, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:27:45', '2025-06-18 09:27:45'),
(71, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:29:11', '2025-06-18 09:29:11'),
(72, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:29:50', '2025-06-18 09:29:50'),
(73, 12, 'User', 'Viewed List User Page', '216.234.213.29', '2025-06-18 09:31:12', '2025-06-18 09:31:12'),
(74, 12, 'Branch', 'Viewed List Branch Page', '216.234.213.29', '2025-06-18 09:32:02', '2025-06-18 09:32:02'),
(75, 12, 'User', 'Viewed List User Page', '216.234.213.29', '2025-06-18 09:32:23', '2025-06-18 09:32:23'),
(76, 1, 'User', 'Viewed List User Page', '216.234.213.29', '2025-06-18 09:33:12', '2025-06-18 09:33:12'),
(77, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:35:40', '2025-06-18 09:35:40'),
(78, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:45:21', '2025-06-18 09:45:21'),
(79, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:44:15', '2025-06-18 09:44:15'),
(80, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:45:59', '2025-06-18 09:45:59'),
(81, 1, 'Branch', 'Viewed Create Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:46:04', '2025-06-18 09:46:04'),
(82, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:47:23', '2025-06-18 09:47:23'),
(83, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:47:31', '2025-06-18 09:47:31'),
(84, 1, 'Branch', 'Viewed Create Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:47:34', '2025-06-18 09:47:34'),
(85, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:47:46', '2025-06-18 09:47:46'),
(86, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:874e:4345:378a:d54e', '2025-06-18 09:53:13', '2025-06-18 09:53:13'),
(87, 12, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 10:26:26', '2025-06-18 10:26:26'),
(88, 12, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 10:30:18', '2025-06-18 10:30:18'),
(89, 12, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 10:30:19', '2025-06-18 10:30:19'),
(90, 12, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:a5fe:2079:8a9c:22ac', '2025-06-18 10:30:49', '2025-06-18 10:30:49'),
(91, 12, 'User', 'Viewed List User Page', '216.234.213.29', '2025-06-18 11:30:23', '2025-06-18 11:30:23'),
(92, 12, 'User', 'Viewed List User Page', '216.234.213.29', '2025-06-18 11:30:51', '2025-06-18 11:30:51'),
(93, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:46:24', '2025-06-18 12:46:24'),
(94, 1, 'User', 'Viewed Create User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:46:29', '2025-06-18 12:46:29'),
(95, 1, 'User', 'Created Business record with ID {\"name\":\"Dennis Zitha\",\"email\":\"dennis@ontech.co.zm\",\"branch_id\":\"1\",\"role_id\":\"2\",\"user_id\":1,\"updated_at\":\"2025-06-18T12:47:12.000000Z\",\"created_at\":\"2025-06-18T12:47:12.000000Z\",\"id\":14}', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:47:12', '2025-06-18 12:47:12'),
(96, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:47:13', '2025-06-18 12:47:13'),
(97, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:47:22', '2025-06-18 12:47:22'),
(98, 1, 'Branch', 'Viewed Create Branch Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:47:25', '2025-06-18 12:47:25'),
(99, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:47:57', '2025-06-18 12:47:57'),
(100, 1, 'Branch', 'Viewed List Branch Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:51:40', '2025-06-18 12:51:40'),
(101, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 12:59:25', '2025-06-18 12:59:25'),
(102, 1, 'User', 'Viewed List User Page', '2605:59c0:5d3f:ec10:1938:f7c3:8774:a6a8', '2025-06-18 13:00:10', '2025-06-18 13:00:10'),
(103, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 10:59:12', '2025-07-10 10:59:12'),
(104, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 10:59:41', '2025-07-10 10:59:41'),
(105, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 10:59:58', '2025-07-10 10:59:58'),
(106, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 11:00:00', '2025-07-10 11:00:00'),
(107, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:01:15', '2025-07-10 11:01:15'),
(108, 5, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 11:01:18', '2025-07-10 11:01:18'),
(109, 5, 'Branch', 'Viewed Create Branch Page', '41.77.145.194', '2025-07-10 11:01:27', '2025-07-10 11:01:27'),
(110, 5, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 11:01:39', '2025-07-10 11:01:39'),
(111, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:01:58', '2025-07-10 11:01:58'),
(112, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 11:02:06', '2025-07-10 11:02:06'),
(113, 5, 'User', 'Created Business record with ID {\"name\":\"Lukundo Siame\",\"email\":\"Lukundo.Siame@natsave.co.zm\",\"branch_id\":\"4\",\"role_id\":\"2\",\"user_id\":5,\"updated_at\":\"2025-07-10T11:03:53.000000Z\",\"created_at\":\"2025-07-10T11:03:53.000000Z\",\"id\":15}', '41.77.145.194', '2025-07-10 11:03:53', '2025-07-10 11:03:53'),
(114, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:03:53', '2025-07-10 11:03:53'),
(115, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:07:34', '2025-07-10 11:07:34'),
(116, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:08:38', '2025-07-10 11:08:38'),
(117, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:10:40', '2025-07-10 11:10:40'),
(118, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:14:11', '2025-07-10 11:14:11'),
(119, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 11:15:12', '2025-07-10 11:15:12'),
(120, 5, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 12:53:33', '2025-07-10 12:53:33'),
(121, 5, 'Branch', 'Viewed Create Branch Page', '41.77.145.194', '2025-07-10 12:53:58', '2025-07-10 12:53:58'),
(122, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:08:54', '2025-07-10 13:08:54'),
(123, 5, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 13:08:59', '2025-07-10 13:08:59'),
(124, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:22:29', '2025-07-10 13:22:29'),
(125, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:24:12', '2025-07-10 13:24:12'),
(126, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 13:24:25', '2025-07-10 13:24:25'),
(127, 5, 'User', 'Created Business record with ID {\"name\":\"Lupondo Maninga\",\"email\":\"Lupondo.Maninga@natsave.co.zm\",\"branch_id\":\"4\",\"role_id\":\"1\",\"user_id\":5,\"updated_at\":\"2025-07-10T13:26:42.000000Z\",\"created_at\":\"2025-07-10T13:26:42.000000Z\",\"id\":16}', '41.77.145.194', '2025-07-10 13:26:42', '2025-07-10 13:26:42'),
(128, 5, 'User', 'Created Business record with ID {\"name\":\"Berlin Chivunga\",\"email\":\"Berlin.Chivunga@natsave.co.zm\",\"branch_id\":\"4\",\"role_id\":\"1\",\"user_id\":5,\"updated_at\":\"2025-07-10T13:28:14.000000Z\",\"created_at\":\"2025-07-10T13:28:14.000000Z\",\"id\":17}', '41.77.145.194', '2025-07-10 13:28:14', '2025-07-10 13:28:14'),
(129, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:28:15', '2025-07-10 13:28:15'),
(130, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:31:30', '2025-07-10 13:31:30'),
(131, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:32:19', '2025-07-10 13:32:19'),
(132, 15, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 13:34:55', '2025-07-10 13:34:55'),
(133, 15, 'User', 'Created Business record with ID {\"name\":\"Adam Chabala\",\"email\":\"Adam.Chabala@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T13:36:43.000000Z\",\"created_at\":\"2025-07-10T13:36:43.000000Z\",\"id\":18}', '41.77.145.194', '2025-07-10 13:36:43', '2025-07-10 13:36:43'),
(134, 15, 'User', 'Created Business record with ID {\"name\":\"Amos Kaluba\",\"email\":\"Amos.Kaluba@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T13:53:00.000000Z\",\"created_at\":\"2025-07-10T13:53:00.000000Z\",\"id\":19}', '41.77.145.194', '2025-07-10 13:53:00', '2025-07-10 13:53:00'),
(135, 17, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:54:46', '2025-07-10 13:54:46'),
(136, 17, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 13:54:50', '2025-07-10 13:54:50'),
(137, 17, 'User', 'Created Business record with ID {\"name\":\"KINGSLEY NYAMBE\",\"email\":\"Kingsley.Nyambe@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T13:56:49.000000Z\",\"created_at\":\"2025-07-10T13:56:49.000000Z\",\"id\":20}', '41.77.145.194', '2025-07-10 13:56:49', '2025-07-10 13:56:49'),
(138, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 13:58:41', '2025-07-10 13:58:41'),
(139, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 13:58:47', '2025-07-10 13:58:47'),
(140, 16, 'User', 'Created Business record with ID {\"name\":\"ELIOUS NYIRENDA\",\"email\":\"Elious.Nyirenda@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-10T14:00:50.000000Z\",\"created_at\":\"2025-07-10T14:00:50.000000Z\",\"id\":21}', '41.77.145.194', '2025-07-10 14:00:50', '2025-07-10 14:00:50'),
(141, 17, 'User', 'Created Business record with ID {\"name\":\"BETTY MUSHAUKWA\",\"email\":\"Betty.Mushaukwa@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T14:03:10.000000Z\",\"created_at\":\"2025-07-10T14:03:10.000000Z\",\"id\":22}', '41.77.145.194', '2025-07-10 14:03:10', '2025-07-10 14:03:10'),
(142, 17, 'User', 'Created Business record with ID {\"name\":\"Hellen Mungulunga\",\"email\":\"hellen.mungulunga@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T14:08:10.000000Z\",\"created_at\":\"2025-07-10T14:08:10.000000Z\",\"id\":23}', '41.77.145.194', '2025-07-10 14:08:10', '2025-07-10 14:08:10'),
(143, 17, 'User', 'Created Business record with ID {\"name\":\"Deberah Mutale\",\"email\":\"deborah.mutale@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T14:09:52.000000Z\",\"created_at\":\"2025-07-10T14:09:52.000000Z\",\"id\":24}', '41.77.145.194', '2025-07-10 14:09:52', '2025-07-10 14:09:52'),
(144, 17, 'User', 'Created Business record with ID {\"name\":\"Mukumwa Mwikisa\",\"email\":\"Mukumwa.Mwikisa@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T14:12:03.000000Z\",\"created_at\":\"2025-07-10T14:12:03.000000Z\",\"id\":25}', '41.77.145.194', '2025-07-10 14:12:03', '2025-07-10 14:12:03'),
(145, 15, 'User', 'Created Business record with ID {\"name\":\"Martha Tembo\",\"email\":\"Martha.Tembo@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:12:49.000000Z\",\"created_at\":\"2025-07-10T14:12:49.000000Z\",\"id\":26}', '41.77.145.194', '2025-07-10 14:12:49', '2025-07-10 14:12:49'),
(146, 15, 'User', 'Created Business record with ID {\"name\":\"CATHERINE SHAANGA\",\"email\":\"Catherine.Shaanga@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:13:34.000000Z\",\"created_at\":\"2025-07-10T14:13:34.000000Z\",\"id\":27}', '41.77.145.194', '2025-07-10 14:13:34', '2025-07-10 14:13:34'),
(147, 17, 'User', 'Created Business record with ID {\"name\":\"Martin Dzekedzeke\",\"email\":\"Martin.Dzekedzeke@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-10T14:13:45.000000Z\",\"created_at\":\"2025-07-10T14:13:45.000000Z\",\"id\":28}', '41.77.145.194', '2025-07-10 14:13:45', '2025-07-10 14:13:45'),
(148, 15, 'User', 'Created Business record with ID {\"name\":\"ERIC KUNDA\",\"email\":\"Eric.Kunda@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:14:19.000000Z\",\"created_at\":\"2025-07-10T14:14:19.000000Z\",\"id\":29}', '41.77.145.194', '2025-07-10 14:14:19', '2025-07-10 14:14:19'),
(149, 15, 'User', 'Created Business record with ID {\"name\":\"CHIMWEMWE NGOMA\",\"email\":\"Chimwemwe.Ngoma@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:15:17.000000Z\",\"created_at\":\"2025-07-10T14:15:17.000000Z\",\"id\":30}', '41.77.145.194', '2025-07-10 14:15:17', '2025-07-10 14:15:17'),
(150, 15, 'User', 'Created Business record with ID {\"name\":\"MALILWE MWEENE\",\"email\":\"Malilwe.Mweene@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:16:39.000000Z\",\"created_at\":\"2025-07-10T14:16:39.000000Z\",\"id\":31}', '41.77.145.194', '2025-07-10 14:16:39', '2025-07-10 14:16:39'),
(151, 15, 'User', 'Created Business record with ID {\"name\":\"BECILIA MUNDAILA\",\"email\":\"Becilia.Mundaila@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:17:29.000000Z\",\"created_at\":\"2025-07-10T14:17:29.000000Z\",\"id\":32}', '41.77.145.194', '2025-07-10 14:17:29', '2025-07-10 14:17:29'),
(152, 15, 'User', 'Created Business record with ID {\"name\":\"VICTOR MWAZI\",\"email\":\"Victor.Mwazi@natsave.co.zm\",\"branch_id\":\"5\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:18:43.000000Z\",\"created_at\":\"2025-07-10T14:18:43.000000Z\",\"id\":33}', '41.77.145.194', '2025-07-10 14:18:43', '2025-07-10 14:18:43'),
(153, 15, 'User', 'Created Business record with ID {\"name\":\"MONICA BANDA\",\"email\":\"Monica.Banda@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:19:47.000000Z\",\"created_at\":\"2025-07-10T14:19:47.000000Z\",\"id\":34}', '41.77.145.194', '2025-07-10 14:19:47', '2025-07-10 14:19:47'),
(154, 15, 'User', 'Created Business record with ID {\"name\":\"GABRIEL MUKUMBI\",\"email\":\"Gabriel.Mukumbi@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:20:21.000000Z\",\"created_at\":\"2025-07-10T14:20:21.000000Z\",\"id\":35}', '41.77.145.194', '2025-07-10 14:20:21', '2025-07-10 14:20:21'),
(155, 15, 'User', 'Created Business record with ID {\"name\":\"LOTTIE ZIMBA\",\"email\":\"Lottie.Zimba@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:20:53.000000Z\",\"created_at\":\"2025-07-10T14:20:53.000000Z\",\"id\":36}', '41.77.145.194', '2025-07-10 14:20:53', '2025-07-10 14:20:53'),
(156, 15, 'User', 'Created Business record with ID {\"name\":\"NGANDWE SENDAPU\",\"email\":\"Ngandwe.Sendapu@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:21:55.000000Z\",\"created_at\":\"2025-07-10T14:21:55.000000Z\",\"id\":37}', '41.77.145.194', '2025-07-10 14:21:55', '2025-07-10 14:21:55'),
(157, 15, 'User', 'Created Business record with ID {\"name\":\"VIOLET MWANZA\",\"email\":\"Violet.Mwanza@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:22:30.000000Z\",\"created_at\":\"2025-07-10T14:22:30.000000Z\",\"id\":38}', '41.77.145.194', '2025-07-10 14:22:30', '2025-07-10 14:22:30'),
(158, 15, 'User', 'Created Business record with ID {\"name\":\"MWANGALA MUMBULA\",\"email\":\"Mwangala.Mumbula@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:23:23.000000Z\",\"created_at\":\"2025-07-10T14:23:23.000000Z\",\"id\":39}', '41.77.145.194', '2025-07-10 14:23:23', '2025-07-10 14:23:23'),
(159, 15, 'User', 'Created Business record with ID {\"name\":\"PATIENCE MUMBA\",\"email\":\"Patience.Mumba@natsave.co.zm\",\"branch_id\":\"33\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:24:15.000000Z\",\"created_at\":\"2025-07-10T14:24:15.000000Z\",\"id\":40}', '41.77.145.194', '2025-07-10 14:24:15', '2025-07-10 14:24:15'),
(160, 15, 'User', 'Created Business record with ID {\"name\":\"SHEBA KABIKA\",\"email\":\"Sheba.Kabika@natsave.co.zm\",\"branch_id\":\"6\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:25:05.000000Z\",\"created_at\":\"2025-07-10T14:25:05.000000Z\",\"id\":41}', '41.77.145.194', '2025-07-10 14:25:05', '2025-07-10 14:25:05'),
(161, 15, 'User', 'Created Business record with ID {\"name\":\"CHILILA KASHIMBAYA\",\"email\":\"Chilila.Kashimbaya@natsave.co.zm\",\"branch_id\":\"26\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:26:19.000000Z\",\"created_at\":\"2025-07-10T14:26:19.000000Z\",\"id\":42}', '41.77.145.194', '2025-07-10 14:26:19', '2025-07-10 14:26:19'),
(162, 15, 'User', 'Created Business record with ID {\"name\":\"KALUKEKI SAYA\",\"email\":\"Kalukaku.Saya@natsave.co.zm\",\"branch_id\":\"26\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:27:36.000000Z\",\"created_at\":\"2025-07-10T14:27:36.000000Z\",\"id\":43}', '41.77.145.194', '2025-07-10 14:27:36', '2025-07-10 14:27:36'),
(163, 15, 'User', 'Created Business record with ID {\"name\":\"QUEEN NACHILIMA\",\"email\":\"Queen.Nachilima@natsave.co.zm\",\"branch_id\":\"26\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:28:22.000000Z\",\"created_at\":\"2025-07-10T14:28:22.000000Z\",\"id\":44}', '41.77.145.194', '2025-07-10 14:28:22', '2025-07-10 14:28:22'),
(164, 15, 'User', 'Created Business record with ID {\"name\":\"ROSE MULENGA\",\"email\":\"Rose.Mulenga@natsave.co.zm\",\"branch_id\":\"26\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:39:56.000000Z\",\"created_at\":\"2025-07-10T14:39:56.000000Z\",\"id\":45}', '41.77.145.194', '2025-07-10 14:39:56', '2025-07-10 14:39:56'),
(165, 15, 'User', 'Created Business record with ID {\"name\":\"MARTHA SIMWANZA\",\"email\":\"Martha.Simwanza@natsave.co.zm\",\"branch_id\":\"26\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:41:56.000000Z\",\"created_at\":\"2025-07-10T14:41:56.000000Z\",\"id\":46}', '41.77.145.194', '2025-07-10 14:41:56', '2025-07-10 14:41:56'),
(166, 15, 'User', 'Created Business record with ID {\"name\":\"LEAH NACHILYANGO\",\"email\":\"Leah.Nachilyango@natsave.co.zm\",\"branch_id\":\"44\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:43:13.000000Z\",\"created_at\":\"2025-07-10T14:43:13.000000Z\",\"id\":47}', '41.77.145.194', '2025-07-10 14:43:13', '2025-07-10 14:43:13'),
(167, 15, 'User', 'Created Business record with ID {\"name\":\"MISHECK LWANDO\",\"email\":\"Misheck.Lwando@natsave.co.zm\",\"branch_id\":\"44\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:44:18.000000Z\",\"created_at\":\"2025-07-10T14:44:18.000000Z\",\"id\":48}', '41.77.145.194', '2025-07-10 14:44:18', '2025-07-10 14:44:18'),
(168, 15, 'User', 'Created Business record with ID {\"name\":\"SUWILANJI NAMUCHIMBA\",\"email\":\"Suwilanji.Namuchimba@natsave.co.zm\",\"branch_id\":\"44\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:45:34.000000Z\",\"created_at\":\"2025-07-10T14:45:34.000000Z\",\"id\":49}', '41.77.145.194', '2025-07-10 14:45:34', '2025-07-10 14:45:34'),
(169, 15, 'User', 'Created Business record with ID {\"name\":\"PENELOPE MUSUKWA\",\"email\":\"Penelope.Musukwa@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:47:25.000000Z\",\"created_at\":\"2025-07-10T14:47:25.000000Z\",\"id\":50}', '41.77.145.194', '2025-07-10 14:47:25', '2025-07-10 14:47:25'),
(170, 15, 'User', 'Created Business record with ID {\"name\":\"HELLEN BULAKA\",\"email\":\"Hellen.Bulaka@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:48:21.000000Z\",\"created_at\":\"2025-07-10T14:48:21.000000Z\",\"id\":51}', '41.77.145.194', '2025-07-10 14:48:21', '2025-07-10 14:48:21'),
(171, 15, 'User', 'Created Business record with ID {\"name\":\"BWALYA SICHULA\",\"email\":\"Bwalya.Sichula@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:49:04.000000Z\",\"created_at\":\"2025-07-10T14:49:04.000000Z\",\"id\":52}', '41.77.145.194', '2025-07-10 14:49:04', '2025-07-10 14:49:04'),
(172, 15, 'User', 'Created Business record with ID {\"name\":\"ZOOLE ZYAMBO\",\"email\":\"Zoole.Zyambo@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:50:49.000000Z\",\"created_at\":\"2025-07-10T14:50:49.000000Z\",\"id\":53}', '41.77.145.194', '2025-07-10 14:50:49', '2025-07-10 14:50:49'),
(173, 15, 'User', 'Created Business record with ID {\"name\":\"JOHN BWALYA\",\"email\":\"John.Bwalya@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:51:41.000000Z\",\"created_at\":\"2025-07-10T14:51:41.000000Z\",\"id\":54}', '41.77.145.194', '2025-07-10 14:51:41', '2025-07-10 14:51:41'),
(174, 15, 'User', 'Created Business record with ID {\"name\":\"APHIA MUNANGONGWE\",\"email\":\"Aphia.Munangongwe@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:53:25.000000Z\",\"created_at\":\"2025-07-10T14:53:25.000000Z\",\"id\":55}', '41.77.145.194', '2025-07-10 14:53:25', '2025-07-10 14:53:25'),
(175, 15, 'User', 'Created Business record with ID {\"name\":\"AGATHA CHINGAIPE\",\"email\":\"Agatha.Chingaipe@natsave.co.zm\",\"branch_id\":\"25\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:54:03.000000Z\",\"created_at\":\"2025-07-10T14:54:03.000000Z\",\"id\":56}', '41.77.145.194', '2025-07-10 14:54:03', '2025-07-10 14:54:03'),
(176, 15, 'User', 'Created Business record with ID {\"name\":\"JAMES KOMBE\",\"email\":\"James.Kombe@natsave.co.zm\",\"branch_id\":\"7\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:54:41.000000Z\",\"created_at\":\"2025-07-10T14:54:41.000000Z\",\"id\":57}', '41.77.145.194', '2025-07-10 14:54:41', '2025-07-10 14:54:41'),
(177, 15, 'User', 'Created Business record with ID {\"name\":\"MILLICENT SIMATAA\",\"email\":\"Millicent.Simataa@natsave.co.zm\",\"branch_id\":\"7\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:55:42.000000Z\",\"created_at\":\"2025-07-10T14:55:42.000000Z\",\"id\":58}', '41.77.145.194', '2025-07-10 14:55:42', '2025-07-10 14:55:42'),
(178, 15, 'User', 'Created Business record with ID {\"name\":\"EVERISTO CHINYIMBA\",\"email\":\"Everisto.Chinyimba@natsave.co.zm\",\"branch_id\":\"7\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:56:50.000000Z\",\"created_at\":\"2025-07-10T14:56:50.000000Z\",\"id\":59}', '41.77.145.194', '2025-07-10 14:56:50', '2025-07-10 14:56:50'),
(179, 15, 'User', 'Created Business record with ID {\"name\":\"CYNTHIA MUBIANA\",\"email\":\"Cynthia.Mubiana@natsave.co.zm\",\"branch_id\":\"7\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:57:28.000000Z\",\"created_at\":\"2025-07-10T14:57:28.000000Z\",\"id\":60}', '41.77.145.194', '2025-07-10 14:57:28', '2025-07-10 14:57:28'),
(180, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-10 14:58:11', '2025-07-10 14:58:11'),
(181, 15, 'User', 'Created Business record with ID {\"name\":\"EMMANUEL NYENDWA\",\"email\":\"Emmanuel.Nyendwa@natsave.co.zm\",\"branch_id\":\"7\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:58:46.000000Z\",\"created_at\":\"2025-07-10T14:58:46.000000Z\",\"id\":61}', '41.77.145.194', '2025-07-10 14:58:46', '2025-07-10 14:58:46'),
(182, 15, 'User', 'Created Business record with ID {\"name\":\"REGINA SIMWAKA\",\"email\":\"Regina.Simwaka@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T14:59:36.000000Z\",\"created_at\":\"2025-07-10T14:59:36.000000Z\",\"id\":62}', '41.77.145.194', '2025-07-10 14:59:36', '2025-07-10 14:59:36'),
(183, 15, 'User', 'Created Business record with ID {\"name\":\"JOY KASANGILI\",\"email\":\"Joy.Kasangili@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T15:00:31.000000Z\",\"created_at\":\"2025-07-10T15:00:31.000000Z\",\"id\":63}', '41.77.145.194', '2025-07-10 15:00:31', '2025-07-10 15:00:31'),
(184, 5, 'User', 'Created Business record with ID {\"name\":\"Zindaba Gondwe\",\"email\":\"Zindaba.Gondwe@natsave.co.zm\",\"branch_id\":\"4\",\"role_id\":\"1\",\"user_id\":5,\"updated_at\":\"2025-07-10T15:01:04.000000Z\",\"created_at\":\"2025-07-10T15:01:04.000000Z\",\"id\":64}', '41.77.145.194', '2025-07-10 15:01:04', '2025-07-10 15:01:04'),
(185, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 15:01:05', '2025-07-10 15:01:05'),
(186, 15, 'User', 'Created Business record with ID {\"name\":\"KOTUTU LIKISI\",\"email\":\"Kotutu.Likisi@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T15:01:15.000000Z\",\"created_at\":\"2025-07-10T15:01:15.000000Z\",\"id\":65}', '41.77.145.194', '2025-07-10 15:01:15', '2025-07-10 15:01:15'),
(187, 15, 'User', 'Created Business record with ID {\"name\":\"CHILANDO CHILANDO\",\"email\":\"Chilando.Chilando@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T15:01:58.000000Z\",\"created_at\":\"2025-07-10T15:01:58.000000Z\",\"id\":66}', '41.77.145.194', '2025-07-10 15:01:58', '2025-07-10 15:01:58'),
(188, 15, 'User', 'Created Business record with ID {\"name\":\"FAITH MUTABWA\",\"email\":\"Faith.Mutabwa@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-10T15:02:43.000000Z\",\"created_at\":\"2025-07-10T15:02:43.000000Z\",\"id\":67}', '41.77.145.194', '2025-07-10 15:02:43', '2025-07-10 15:02:43'),
(189, 15, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 15:04:37', '2025-07-10 15:04:37'),
(190, 15, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 15:04:51', '2025-07-10 15:04:51'),
(191, 5, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-10 15:07:35', '2025-07-10 15:07:35'),
(192, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-10 15:07:38', '2025-07-10 15:07:38'),
(193, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 06:09:18', '2025-07-11 06:09:18'),
(194, 15, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 06:09:21', '2025-07-11 06:09:21'),
(195, 15, 'User', 'Created Business record with ID {\"name\":\"GLENDA NDHLOVU\",\"email\":\"Glenda.Ndhlovu@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:11:23.000000Z\",\"created_at\":\"2025-07-11T06:11:23.000000Z\",\"id\":68}', '41.77.145.194', '2025-07-11 06:11:23', '2025-07-11 06:11:23'),
(196, 15, 'User', 'Created Business record with ID {\"name\":\"LINDIWE MWIINGA\",\"email\":\"Lindiwe.Mwiinga@natsave.co.zm\",\"branch_id\":\"8\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:14:57.000000Z\",\"created_at\":\"2025-07-11T06:14:57.000000Z\",\"id\":69}', '41.77.145.194', '2025-07-11 06:14:57', '2025-07-11 06:14:57'),
(197, 15, 'User', 'Created Business record with ID {\"name\":\"GRACE MBAMBARA\",\"email\":\"Grace.Mbambara@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:15:41.000000Z\",\"created_at\":\"2025-07-11T06:15:41.000000Z\",\"id\":70}', '41.77.145.194', '2025-07-11 06:15:41', '2025-07-11 06:15:41'),
(198, 15, 'User', 'Created Business record with ID {\"name\":\"TIMOTHY GOMA\",\"email\":\"Timothy.Goma@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:16:12.000000Z\",\"created_at\":\"2025-07-11T06:16:12.000000Z\",\"id\":71}', '41.77.145.194', '2025-07-11 06:16:12', '2025-07-11 06:16:12'),
(199, 15, 'User', 'Created Business record with ID {\"name\":\"MADALITSO PHIRI\",\"email\":\"Madalitso.Phiri@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:16:57.000000Z\",\"created_at\":\"2025-07-11T06:16:57.000000Z\",\"id\":72}', '41.77.145.194', '2025-07-11 06:16:57', '2025-07-11 06:16:57'),
(200, 15, 'User', 'Created Business record with ID {\"name\":\"ALLIA SITWALA\",\"email\":\"Allia.Sitwala@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:17:46.000000Z\",\"created_at\":\"2025-07-11T06:17:46.000000Z\",\"id\":73}', '41.77.145.194', '2025-07-11 06:17:46', '2025-07-11 06:17:46'),
(201, 15, 'User', 'Created Business record with ID {\"name\":\"ESTHER NALWAMBA\",\"email\":\"Esther.Nalwamba@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:18:32.000000Z\",\"created_at\":\"2025-07-11T06:18:32.000000Z\",\"id\":74}', '41.77.145.194', '2025-07-11 06:18:32', '2025-07-11 06:18:32'),
(202, 15, 'User', 'Created Business record with ID {\"name\":\"SERGY MISALE\",\"email\":\"Sergy.Misale@natsave.co.zm\",\"branch_id\":\"9\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:19:23.000000Z\",\"created_at\":\"2025-07-11T06:19:23.000000Z\",\"id\":75}', '41.77.145.194', '2025-07-11 06:19:23', '2025-07-11 06:19:23'),
(203, 15, 'User', 'Created Business record with ID {\"name\":\"NAOMI SILOKA\",\"email\":\"Naomi.Siloka@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:20:17.000000Z\",\"created_at\":\"2025-07-11T06:20:17.000000Z\",\"id\":76}', '41.77.145.194', '2025-07-11 06:20:17', '2025-07-11 06:20:17'),
(204, 15, 'User', 'Created Business record with ID {\"name\":\"SOLOMON NYIRENDA\",\"email\":\"Solomon.Nyirenda@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:21:02.000000Z\",\"created_at\":\"2025-07-11T06:21:02.000000Z\",\"id\":77}', '41.77.145.194', '2025-07-11 06:21:02', '2025-07-11 06:21:02'),
(205, 15, 'User', 'Created Business record with ID {\"name\":\"SEKAI CHINYIMBA\",\"email\":\"Sekai.Chinyimba@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:21:56.000000Z\",\"created_at\":\"2025-07-11T06:21:56.000000Z\",\"id\":78}', '41.77.145.194', '2025-07-11 06:21:56', '2025-07-11 06:21:56'),
(206, 15, 'User', 'Created Business record with ID {\"name\":\"MICHAEL MWANZA\",\"email\":\"Michael.Mwanza@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:22:36.000000Z\",\"created_at\":\"2025-07-11T06:22:36.000000Z\",\"id\":79}', '41.77.145.194', '2025-07-11 06:22:36', '2025-07-11 06:22:36'),
(207, 15, 'User', 'Created Business record with ID {\"name\":\"LILIAN MULELE\",\"email\":\"Lilian.Mulele@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:23:43.000000Z\",\"created_at\":\"2025-07-11T06:23:43.000000Z\",\"id\":80}', '41.77.145.194', '2025-07-11 06:23:43', '2025-07-11 06:23:43'),
(208, 15, 'User', 'Created Business record with ID {\"name\":\"MUBANGA MWAMBA\",\"email\":\"Mubanga.Mwamba@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:24:28.000000Z\",\"created_at\":\"2025-07-11T06:24:28.000000Z\",\"id\":81}', '41.77.145.194', '2025-07-11 06:24:28', '2025-07-11 06:24:28'),
(209, 15, 'User', 'Created Business record with ID {\"name\":\"AISSE WADE\",\"email\":\"Aisse.Wade@natsave.co.zm\",\"branch_id\":\"10\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:25:03.000000Z\",\"created_at\":\"2025-07-11T06:25:03.000000Z\",\"id\":82}', '41.77.145.194', '2025-07-11 06:25:03', '2025-07-11 06:25:03'),
(210, 15, 'User', 'Created Business record with ID {\"name\":\"BRUCE BWALYA\",\"email\":\"Bruce.Bwalya@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:25:46.000000Z\",\"created_at\":\"2025-07-11T06:25:46.000000Z\",\"id\":83}', '41.77.145.194', '2025-07-11 06:25:46', '2025-07-11 06:25:46'),
(211, 15, 'User', 'Created Business record with ID {\"name\":\"AZELINA DAKA\",\"email\":\"Azelina.Daka@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:26:14.000000Z\",\"created_at\":\"2025-07-11T06:26:14.000000Z\",\"id\":84}', '41.77.145.194', '2025-07-11 06:26:14', '2025-07-11 06:26:14'),
(212, 15, 'User', 'Created Business record with ID {\"name\":\"BRYAN HAACUMA\",\"email\":\"Bryan.Haacuma@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:27:01.000000Z\",\"created_at\":\"2025-07-11T06:27:01.000000Z\",\"id\":85}', '41.77.145.194', '2025-07-11 06:27:01', '2025-07-11 06:27:01'),
(213, 15, 'User', 'Created Business record with ID {\"name\":\"DEBORAH MWASE\",\"email\":\"Deborah.Mwase@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:27:40.000000Z\",\"created_at\":\"2025-07-11T06:27:40.000000Z\",\"id\":86}', '41.77.145.194', '2025-07-11 06:27:40', '2025-07-11 06:27:40'),
(214, 15, 'User', 'Created Business record with ID {\"name\":\"FRANCIS BWALYA\",\"email\":\"Francis.Bwalya@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:28:21.000000Z\",\"created_at\":\"2025-07-11T06:28:21.000000Z\",\"id\":87}', '41.77.145.194', '2025-07-11 06:28:21', '2025-07-11 06:28:21'),
(215, 15, 'User', 'Created Business record with ID {\"name\":\"BERTHA MBEWE\",\"email\":\"Bertha.Mbewe@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:29:29.000000Z\",\"created_at\":\"2025-07-11T06:29:29.000000Z\",\"id\":88}', '41.77.145.194', '2025-07-11 06:29:29', '2025-07-11 06:29:29'),
(216, 15, 'User', 'Created Business record with ID {\"name\":\"TREVOR NGULUBE\",\"email\":\"Trevor.Ngulube@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:30:22.000000Z\",\"created_at\":\"2025-07-11T06:30:22.000000Z\",\"id\":89}', '41.77.145.194', '2025-07-11 06:30:22', '2025-07-11 06:30:22'),
(217, 15, 'User', 'Created Business record with ID {\"name\":\"AALIYAH MACHONA\",\"email\":\"Aaliyah.Machona@natsave.co.zm\",\"branch_id\":\"11\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:31:18.000000Z\",\"created_at\":\"2025-07-11T06:31:18.000000Z\",\"id\":90}', '41.77.145.194', '2025-07-11 06:31:18', '2025-07-11 06:31:18'),
(218, 15, 'User', 'Created Business record with ID {\"name\":\"PRUDENCE WALOBELE\",\"email\":\"Prudence.Walobele@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:32:29.000000Z\",\"created_at\":\"2025-07-11T06:32:29.000000Z\",\"id\":91}', '41.77.145.194', '2025-07-11 06:32:29', '2025-07-11 06:32:29'),
(219, 15, 'User', 'Created Business record with ID {\"name\":\"AMINA BANDA\",\"email\":\"Amina.Banda@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:33:13.000000Z\",\"created_at\":\"2025-07-11T06:33:13.000000Z\",\"id\":92}', '41.77.145.194', '2025-07-11 06:33:13', '2025-07-11 06:33:13'),
(220, 15, 'User', 'Created Business record with ID {\"name\":\"REUBEN CHINTU\",\"email\":\"Reuben.Chintu@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:33:55.000000Z\",\"created_at\":\"2025-07-11T06:33:55.000000Z\",\"id\":93}', '41.77.145.194', '2025-07-11 06:33:55', '2025-07-11 06:33:55'),
(221, 15, 'User', 'Created Business record with ID {\"name\":\"MAYBISON KAIRA\",\"email\":\"Maybison.Kaira@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:34:34.000000Z\",\"created_at\":\"2025-07-11T06:34:34.000000Z\",\"id\":94}', '41.77.145.194', '2025-07-11 06:34:34', '2025-07-11 06:34:34'),
(222, 15, 'User', 'Created Business record with ID {\"name\":\"KEITH MUNGONI\",\"email\":\"Keith.Mungoni@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:35:23.000000Z\",\"created_at\":\"2025-07-11T06:35:23.000000Z\",\"id\":95}', '41.77.145.194', '2025-07-11 06:35:23', '2025-07-11 06:35:23'),
(223, 15, 'User', 'Created Business record with ID {\"name\":\"FAITH MALAMBO\",\"email\":\"Faith.Malambo@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:36:24.000000Z\",\"created_at\":\"2025-07-11T06:36:24.000000Z\",\"id\":96}', '41.77.145.194', '2025-07-11 06:36:24', '2025-07-11 06:36:24'),
(224, 15, 'User', 'Created Business record with ID {\"name\":\"RUTH NSWANA\",\"email\":\"Ruth.Nswana@natsave.co.zm\",\"branch_id\":\"12\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:37:05.000000Z\",\"created_at\":\"2025-07-11T06:37:05.000000Z\",\"id\":97}', '41.77.145.194', '2025-07-11 06:37:05', '2025-07-11 06:37:05'),
(225, 15, 'User', 'Created Business record with ID {\"name\":\"SHADRECK MWALE\",\"email\":\"Shadreck.Mwale@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:38:49.000000Z\",\"created_at\":\"2025-07-11T06:38:49.000000Z\",\"id\":98}', '41.77.145.194', '2025-07-11 06:38:49', '2025-07-11 06:38:49'),
(226, 15, 'User', 'Created Business record with ID {\"name\":\"WINSTONE LUNGU\",\"email\":\"Winstone.Lungu@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T06:55:22.000000Z\",\"created_at\":\"2025-07-11T06:55:22.000000Z\",\"id\":99}', '41.77.145.194', '2025-07-11 06:55:22', '2025-07-11 06:55:22'),
(227, 17, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 07:01:32', '2025-07-11 07:01:32'),
(228, 17, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 07:06:04', '2025-07-11 07:06:04'),
(229, 15, 'User', 'Created Business record with ID {\"name\":\"CLEMENT GONDWE\",\"email\":\"Clement.Gondwe@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:06:22.000000Z\",\"created_at\":\"2025-07-11T07:06:22.000000Z\",\"id\":100}', '41.77.145.194', '2025-07-11 07:06:22', '2025-07-11 07:06:22'),
(230, 15, 'User', 'Created Business record with ID {\"name\":\"MARIANGELA CIMINO\",\"email\":\"Mariangela.Cimino@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:07:42.000000Z\",\"created_at\":\"2025-07-11T07:07:42.000000Z\",\"id\":101}', '41.77.145.194', '2025-07-11 07:07:42', '2025-07-11 07:07:42'),
(231, 17, 'User', 'Created Business record with ID {\"name\":\"Tambudzai Muchimba\",\"email\":\"Tambuzai.Muchimba@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:08:18.000000Z\",\"created_at\":\"2025-07-11T07:08:18.000000Z\",\"id\":102}', '41.77.145.194', '2025-07-11 07:08:18', '2025-07-11 07:08:18'),
(232, 17, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 07:08:18', '2025-07-11 07:08:18'),
(233, 17, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 07:08:40', '2025-07-11 07:08:40'),
(234, 17, 'User', 'Created Business record with ID {\"name\":\"Martin Nkhoma\",\"email\":\"Martin.Nkhoma@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:10:58.000000Z\",\"created_at\":\"2025-07-11T07:10:58.000000Z\",\"id\":103}', '41.77.145.194', '2025-07-11 07:10:58', '2025-07-11 07:10:58'),
(235, 17, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 07:10:58', '2025-07-11 07:10:58'),
(236, 17, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 07:11:16', '2025-07-11 07:11:16'),
(237, 17, 'User', 'Created Business record with ID {\"name\":\"Rabson Zulu\",\"email\":\"Rabson.Zulu@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:12:48.000000Z\",\"created_at\":\"2025-07-11T07:12:48.000000Z\",\"id\":104}', '41.77.145.194', '2025-07-11 07:12:48', '2025-07-11 07:12:48');

INSERT INTO `audit_trails` (`id`, `user_id`, `module`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(238, 17, 'User', 'Created Business record with ID {\"name\":\"ISAAC CHISHALA\",\"email\":\"Isaac.Chishala@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:19:19.000000Z\",\"created_at\":\"2025-07-11T07:19:19.000000Z\",\"id\":105}', '41.77.145.194', '2025-07-11 07:19:19', '2025-07-11 07:19:19'),
(239, 17, 'User', 'Created Business record with ID {\"name\":\"Simalumba Simalumba\",\"email\":\"Simalumba.Simalumba@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:20:27.000000Z\",\"created_at\":\"2025-07-11T07:20:27.000000Z\",\"id\":106}', '41.77.145.194', '2025-07-11 07:20:27', '2025-07-11 07:20:27'),
(240, 17, 'User', 'Created Business record with ID {\"name\":\"Lubuto Bwali\",\"email\":\"Lubuto.Bwali@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:22:58.000000Z\",\"created_at\":\"2025-07-11T07:22:58.000000Z\",\"id\":107}', '41.77.145.194', '2025-07-11 07:22:58', '2025-07-11 07:22:58'),
(241, 17, 'User', 'Created Business record with ID {\"name\":\"Beatrice Kunda\",\"email\":\"Beatrice.kunda@natsave.co.zm\",\"branch_id\":\"34\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:24:03.000000Z\",\"created_at\":\"2025-07-11T07:24:03.000000Z\",\"id\":108}', '41.77.145.194', '2025-07-11 07:24:03', '2025-07-11 07:24:03'),
(242, 17, 'User', 'Created Business record with ID {\"name\":\"Stephen Mtonga\",\"email\":\"Stephen.Mtonga@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:25:16.000000Z\",\"created_at\":\"2025-07-11T07:25:16.000000Z\",\"id\":109}', '41.77.145.194', '2025-07-11 07:25:16', '2025-07-11 07:25:16'),
(243, 17, 'User', 'Created Business record with ID {\"name\":\"Musonda Kapasa\",\"email\":\"Musonda.Kapasa@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:26:50.000000Z\",\"created_at\":\"2025-07-11T07:26:50.000000Z\",\"id\":110}', '41.77.145.194', '2025-07-11 07:26:50', '2025-07-11 07:26:50'),
(244, 17, 'User', 'Created Business record with ID {\"name\":\"Annie Munakwala\",\"email\":\"Annie.Munakwale@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:28:37.000000Z\",\"created_at\":\"2025-07-11T07:28:37.000000Z\",\"id\":111}', '41.77.145.194', '2025-07-11 07:28:37', '2025-07-11 07:28:37'),
(245, 17, 'User', 'Created Business record with ID {\"name\":\"Peter Zimba\",\"email\":\"Peter.Zimba@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:34:28.000000Z\",\"created_at\":\"2025-07-11T07:34:28.000000Z\",\"id\":112}', '41.77.145.194', '2025-07-11 07:34:28', '2025-07-11 07:34:28'),
(246, 17, 'User', 'Created Business record with ID {\"name\":\"Exildah Kantumoya\",\"email\":\"Exildah.Kantumoya@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:38:12.000000Z\",\"created_at\":\"2025-07-11T07:38:12.000000Z\",\"id\":113}', '41.77.145.194', '2025-07-11 07:38:12', '2025-07-11 07:38:12'),
(247, 17, 'User', 'Created Business record with ID {\"name\":\"Samuel Watuka\",\"email\":\"Samuel.Watuka@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:39:32.000000Z\",\"created_at\":\"2025-07-11T07:39:32.000000Z\",\"id\":114}', '41.77.145.194', '2025-07-11 07:39:32', '2025-07-11 07:39:32'),
(248, 17, 'User', 'Created Business record with ID {\"name\":\"Rachael Chansa\",\"email\":\"Rachael.Chansa@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:41:01.000000Z\",\"created_at\":\"2025-07-11T07:41:01.000000Z\",\"id\":115}', '41.77.145.194', '2025-07-11 07:41:01', '2025-07-11 07:41:01'),
(249, 17, 'User', 'Created Business record with ID {\"name\":\"Mahongo Manongo\",\"email\":\"Mahongo.Manongo@natsave.co.zm\",\"branch_id\":\"36\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:43:48.000000Z\",\"created_at\":\"2025-07-11T07:43:48.000000Z\",\"id\":116}', '41.77.145.194', '2025-07-11 07:43:48', '2025-07-11 07:43:48'),
(250, 17, 'User', 'Created Business record with ID {\"name\":\"Robert Bwalya\",\"email\":\"Robert.Bwalya@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:45:36.000000Z\",\"created_at\":\"2025-07-11T07:45:36.000000Z\",\"id\":117}', '41.77.145.194', '2025-07-11 07:45:36', '2025-07-11 07:45:36'),
(251, 17, 'User', 'Created Business record with ID {\"name\":\"Aaron .Sampa\",\"email\":\"Aaron.Sampa@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:48:46.000000Z\",\"created_at\":\"2025-07-11T07:48:46.000000Z\",\"id\":118}', '41.77.145.194', '2025-07-11 07:48:46', '2025-07-11 07:48:46'),
(252, 17, 'User', 'Created Business record with ID {\"name\":\"Yaneya Phiri\",\"email\":\"Yaneya.Phiri@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:50:24.000000Z\",\"created_at\":\"2025-07-11T07:50:24.000000Z\",\"id\":119}', '41.77.145.194', '2025-07-11 07:50:24', '2025-07-11 07:50:24'),
(253, 17, 'User', 'Created Business record with ID {\"name\":\"Mercy Kaluba\",\"email\":\"Mercy.Kaluba@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:52:10.000000Z\",\"created_at\":\"2025-07-11T07:52:10.000000Z\",\"id\":120}', '41.77.145.194', '2025-07-11 07:52:10', '2025-07-11 07:52:10'),
(254, 15, 'User', 'Created Business record with ID {\"name\":\"MOIRA PHIRI\",\"email\":\"Moira.Phiri@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:52:53.000000Z\",\"created_at\":\"2025-07-11T07:52:53.000000Z\",\"id\":121}', '41.77.145.194', '2025-07-11 07:52:53', '2025-07-11 07:52:53'),
(255, 17, 'User', 'Created Business record with ID {\"name\":\"Nyangu Banda\",\"email\":\"Nyangu.Banda@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:53:06.000000Z\",\"created_at\":\"2025-07-11T07:53:06.000000Z\",\"id\":122}', '41.77.145.194', '2025-07-11 07:53:06', '2025-07-11 07:53:06'),
(256, 15, 'User', 'Created Business record with ID {\"name\":\"YVONNE CHANDA\",\"email\":\"Yvonne.Chanda@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:53:47.000000Z\",\"created_at\":\"2025-07-11T07:53:47.000000Z\",\"id\":123}', '41.77.145.194', '2025-07-11 07:53:47', '2025-07-11 07:53:47'),
(257, 17, 'User', 'Created Business record with ID {\"name\":\"Emmanuel Kalumba\",\"email\":\"Emmanuel.Kalumba@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:54:25.000000Z\",\"created_at\":\"2025-07-11T07:54:25.000000Z\",\"id\":124}', '41.77.145.194', '2025-07-11 07:54:25', '2025-07-11 07:54:25'),
(258, 15, 'User', 'Created Business record with ID {\"name\":\"PRIMEROSE CHUPA\",\"email\":\"Primerose.Chupa@natsave.co.zm\",\"branch_id\":\"27\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:55:06.000000Z\",\"created_at\":\"2025-07-11T07:55:06.000000Z\",\"id\":125}', '41.77.145.194', '2025-07-11 07:55:06', '2025-07-11 07:55:06'),
(259, 17, 'User', 'Created Business record with ID {\"name\":\"Mulenga Kazembe\",\"email\":\"Mulenga.Kazembe@natsave.co.zm\",\"branch_id\":\"35\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:56:16.000000Z\",\"created_at\":\"2025-07-11T07:56:16.000000Z\",\"id\":126}', '41.77.145.194', '2025-07-11 07:56:16', '2025-07-11 07:56:16'),
(260, 15, 'User', 'Created Business record with ID {\"name\":\"KAPULU MUNENGU\",\"email\":\"Kapulu.Munengu@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T07:57:34.000000Z\",\"created_at\":\"2025-07-11T07:57:34.000000Z\",\"id\":127}', '41.77.145.194', '2025-07-11 07:57:34', '2025-07-11 07:57:34'),
(261, 17, 'User', 'Created Business record with ID {\"name\":\"Ian Kunda\",\"email\":\"Ian.Kunda@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:58:17.000000Z\",\"created_at\":\"2025-07-11T07:58:17.000000Z\",\"id\":128}', '41.77.145.194', '2025-07-11 07:58:17', '2025-07-11 07:58:17'),
(262, 17, 'User', 'Created Business record with ID {\"name\":\"John Kunda\",\"email\":\"John.Kunda@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T07:59:05.000000Z\",\"created_at\":\"2025-07-11T07:59:05.000000Z\",\"id\":129}', '41.77.145.194', '2025-07-11 07:59:05', '2025-07-11 07:59:05'),
(263, 17, 'User', 'Created Business record with ID {\"name\":\"Moses Chitapwa\",\"email\":\"Moses.Chitapwa@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:01:30.000000Z\",\"created_at\":\"2025-07-11T08:01:30.000000Z\",\"id\":130}', '41.77.145.194', '2025-07-11 08:01:30', '2025-07-11 08:01:30'),
(264, 17, 'User', 'Created Business record with ID {\"name\":\"Ilukwi Wamundila\",\"email\":\"Ilukwi.Wamundila@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:02:37.000000Z\",\"created_at\":\"2025-07-11T08:02:37.000000Z\",\"id\":131}', '41.77.145.194', '2025-07-11 08:02:37', '2025-07-11 08:02:37'),
(265, 17, 'User', 'Created Business record with ID {\"name\":\"Melissa Machona\",\"email\":\"Melissa.Machona@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:04:23.000000Z\",\"created_at\":\"2025-07-11T08:04:23.000000Z\",\"id\":132}', '41.77.145.194', '2025-07-11 08:04:23', '2025-07-11 08:04:23'),
(266, 17, 'User', 'Created Business record with ID {\"name\":\"Derrick Ngambi\",\"email\":\"Derrick.Ngambi@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:06:15.000000Z\",\"created_at\":\"2025-07-11T08:06:15.000000Z\",\"id\":133}', '41.77.145.194', '2025-07-11 08:06:15', '2025-07-11 08:06:15'),
(267, 17, 'User', 'Created Business record with ID {\"name\":\"Sharon Kusiyo\",\"email\":\"Sharo.Kusiyo@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:09:19.000000Z\",\"created_at\":\"2025-07-11T08:09:19.000000Z\",\"id\":134}', '41.77.145.194', '2025-07-11 08:09:19', '2025-07-11 08:09:19'),
(268, 17, 'User', 'Created Business record with ID {\"name\":\"Tisa Kunda\",\"email\":\"Tisa.Kunda@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:10:26.000000Z\",\"created_at\":\"2025-07-11T08:10:26.000000Z\",\"id\":135}', '41.77.145.194', '2025-07-11 08:10:26', '2025-07-11 08:10:26'),
(269, 17, 'User', 'Created Business record with ID {\"name\":\"Mable Kayombo\",\"email\":\"Mable.Kayombo@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:11:29.000000Z\",\"created_at\":\"2025-07-11T08:11:29.000000Z\",\"id\":136}', '41.77.145.194', '2025-07-11 08:11:29', '2025-07-11 08:11:29'),
(270, 17, 'User', 'Created Business record with ID {\"name\":\"Taonga Francisca Banda\",\"email\":\"Taonga.Banda@natsave.co.zm\",\"branch_id\":\"37\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:13:24.000000Z\",\"created_at\":\"2025-07-11T08:13:24.000000Z\",\"id\":137}', '41.77.145.194', '2025-07-11 08:13:24', '2025-07-11 08:13:24'),
(271, 17, 'User', 'Created Business record with ID {\"name\":\"Lewis Sakala\",\"email\":\"Lewis.Sakala@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:14:34.000000Z\",\"created_at\":\"2025-07-11T08:14:34.000000Z\",\"id\":138}', '41.77.145.194', '2025-07-11 08:14:34', '2025-07-11 08:14:34'),
(272, 17, 'User', 'Created Business record with ID {\"name\":\"Sikuyuba Mutoloki\",\"email\":\"Sikuyuba.Mutoloki@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:16:03.000000Z\",\"created_at\":\"2025-07-11T08:16:03.000000Z\",\"id\":139}', '41.77.145.194', '2025-07-11 08:16:03', '2025-07-11 08:16:03'),
(273, 17, 'User', 'Created Business record with ID {\"name\":\"Bertha Milayi\",\"email\":\"Bertha.Milayi@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:16:46.000000Z\",\"created_at\":\"2025-07-11T08:16:46.000000Z\",\"id\":140}', '41.77.145.194', '2025-07-11 08:16:46', '2025-07-11 08:16:46'),
(274, 17, 'User', 'Created Business record with ID {\"name\":\"Selina Zulu\",\"email\":\"Selina.Zulu@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:19:05.000000Z\",\"created_at\":\"2025-07-11T08:19:05.000000Z\",\"id\":141}', '41.77.145.194', '2025-07-11 08:19:05', '2025-07-11 08:19:05'),
(275, 15, 'User', 'Created Business record with ID {\"name\":\"TEMBEYA SINYANGWE\",\"email\":\"Tembeya.Sinyangwe@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:25:13.000000Z\",\"created_at\":\"2025-07-11T08:25:13.000000Z\",\"id\":142}', '41.77.145.194', '2025-07-11 08:25:13', '2025-07-11 08:25:13'),
(276, 15, 'User', 'Created Business record with ID {\"name\":\"WINNIE ZULU\",\"email\":\"Winnie.Zulu@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:25:55.000000Z\",\"created_at\":\"2025-07-11T08:25:55.000000Z\",\"id\":143}', '41.77.145.194', '2025-07-11 08:25:55', '2025-07-11 08:25:55'),
(277, 15, 'User', 'Created Business record with ID {\"name\":\"HAZEL MALALA\",\"email\":\"Hazel.Malala@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:26:40.000000Z\",\"created_at\":\"2025-07-11T08:26:40.000000Z\",\"id\":144}', '41.77.145.194', '2025-07-11 08:26:40', '2025-07-11 08:26:40'),
(278, 15, 'User', 'Created Business record with ID {\"name\":\"KAPALA SICHELA\",\"email\":\"Kapala.Sichela@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:27:33.000000Z\",\"created_at\":\"2025-07-11T08:27:33.000000Z\",\"id\":145}', '41.77.145.194', '2025-07-11 08:27:33', '2025-07-11 08:27:33'),
(279, 15, 'User', 'Created Business record with ID {\"name\":\"MILAYO CHIMWASU\",\"email\":\"Milayo.Chimwasu@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:28:18.000000Z\",\"created_at\":\"2025-07-11T08:28:18.000000Z\",\"id\":146}', '41.77.145.194', '2025-07-11 08:28:18', '2025-07-11 08:28:18'),
(280, 15, 'User', 'Created Business record with ID {\"name\":\"MWENGWE NSHINGWE\",\"email\":\"Mwengwe.Nshingwe@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:31:40.000000Z\",\"created_at\":\"2025-07-11T08:31:40.000000Z\",\"id\":147}', '41.77.145.194', '2025-07-11 08:31:40', '2025-07-11 08:31:40'),
(281, 15, 'User', 'Created Business record with ID {\"name\":\"NEWTON MULENGA\",\"email\":\"Newton.Mulenga@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:33:18.000000Z\",\"created_at\":\"2025-07-11T08:33:18.000000Z\",\"id\":148}', '41.77.145.194', '2025-07-11 08:33:18', '2025-07-11 08:33:18'),
(282, 15, 'User', 'Created Business record with ID {\"name\":\"KAYOMBO KAMIZA\",\"email\":\"Kayombo.Kamiza@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:34:31.000000Z\",\"created_at\":\"2025-07-11T08:34:31.000000Z\",\"id\":149}', '41.77.145.194', '2025-07-11 08:34:31', '2025-07-11 08:34:31'),
(283, 15, 'User', 'Created Business record with ID {\"name\":\"MBOLOLO MUSANGU\",\"email\":\"Mbololo.Musangu@natsave.co.zm\",\"branch_id\":\"13\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T08:38:59.000000Z\",\"created_at\":\"2025-07-11T08:38:59.000000Z\",\"id\":150}', '41.77.145.194', '2025-07-11 08:38:59', '2025-07-11 08:38:59'),
(284, 17, 'User', 'Created Business record with ID {\"name\":\"Dainess Phiri\",\"email\":\"Dainess.Phiri@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:45:30.000000Z\",\"created_at\":\"2025-07-11T08:45:30.000000Z\",\"id\":151}', '41.77.145.194', '2025-07-11 08:45:30', '2025-07-11 08:45:30'),
(285, 17, 'User', 'Created Business record with ID {\"name\":\"Zuze Banda\",\"email\":\"Zuze.Banda@natsave.co.zm\",\"branch_id\":\"38\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:46:13.000000Z\",\"created_at\":\"2025-07-11T08:46:13.000000Z\",\"id\":152}', '41.77.145.194', '2025-07-11 08:46:13', '2025-07-11 08:46:13'),
(286, 17, 'User', 'Created Business record with ID {\"name\":\"Emmanuel Moyo\",\"email\":\"Emmanuel.Moyo@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:48:25.000000Z\",\"created_at\":\"2025-07-11T08:48:25.000000Z\",\"id\":153}', '41.77.145.194', '2025-07-11 08:48:25', '2025-07-11 08:48:25'),
(287, 17, 'User', 'Created Business record with ID {\"name\":\"Joseph Sichalwe\",\"email\":\"Joseph.Sichalwe@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:49:48.000000Z\",\"created_at\":\"2025-07-11T08:49:48.000000Z\",\"id\":154}', '41.77.145.194', '2025-07-11 08:49:48', '2025-07-11 08:49:48'),
(288, 17, 'User', 'Created Business record with ID {\"name\":\"Ketty Nkonde\",\"email\":\"Ketty.Nkonde@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:50:38.000000Z\",\"created_at\":\"2025-07-11T08:50:38.000000Z\",\"id\":155}', '41.77.145.194', '2025-07-11 08:50:38', '2025-07-11 08:50:38'),
(289, 17, 'User', 'Created Business record with ID {\"name\":\"Mackford Chibale Nkandu\",\"email\":\"mackford.Nkandu@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:52:38.000000Z\",\"created_at\":\"2025-07-11T08:52:38.000000Z\",\"id\":156}', '41.77.145.194', '2025-07-11 08:52:38', '2025-07-11 08:52:38'),
(290, 17, 'User', 'Created Business record with ID {\"name\":\"Francis Musukuma\",\"email\":\"Francis.Musukuma@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:54:36.000000Z\",\"created_at\":\"2025-07-11T08:54:36.000000Z\",\"id\":157}', '41.77.145.194', '2025-07-11 08:54:36', '2025-07-11 08:54:36'),
(291, 17, 'User', 'Created Business record with ID {\"name\":\"Eddie Kalubwa\",\"email\":\"Eddie.Kalubwa@natsave.co.zm\",\"branch_id\":\"39\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T08:56:01.000000Z\",\"created_at\":\"2025-07-11T08:56:01.000000Z\",\"id\":158}', '41.77.145.194', '2025-07-11 08:56:01', '2025-07-11 08:56:01'),
(292, 15, 'User', 'Created Business record with ID {\"name\":\"JONATHAN CHINYEMBA\",\"email\":\"Jonathan.Chinyemba@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:17:54.000000Z\",\"created_at\":\"2025-07-11T09:17:54.000000Z\",\"id\":159}', '41.77.145.194', '2025-07-11 09:17:54', '2025-07-11 09:17:54'),
(293, 15, 'User', 'Created Business record with ID {\"name\":\"BIEMBA LUNETA\",\"email\":\"Biemba.Luneta@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:19:28.000000Z\",\"created_at\":\"2025-07-11T09:19:28.000000Z\",\"id\":160}', '41.77.145.194', '2025-07-11 09:19:28', '2025-07-11 09:19:28'),
(294, 15, 'User', 'Created Business record with ID {\"name\":\"NALISHEBO KANGUMU\",\"email\":\"Nalishebo.Kangumu@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:21:14.000000Z\",\"created_at\":\"2025-07-11T09:21:14.000000Z\",\"id\":161}', '41.77.145.194', '2025-07-11 09:21:14', '2025-07-11 09:21:14'),
(295, 15, 'User', 'Created Business record with ID {\"name\":\"MUSENGE MAYUNGO\",\"email\":\"Musenge.Mayungo@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:22:37.000000Z\",\"created_at\":\"2025-07-11T09:22:37.000000Z\",\"id\":162}', '41.77.145.194', '2025-07-11 09:22:37', '2025-07-11 09:22:37'),
(296, 17, 'User', 'Created Business record with ID {\"name\":\"Venicious Simullwi\",\"email\":\"Venicious.Simulwi@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T09:24:17.000000Z\",\"created_at\":\"2025-07-11T09:24:17.000000Z\",\"id\":163}', '41.77.145.194', '2025-07-11 09:24:17', '2025-07-11 09:24:17'),
(297, 15, 'User', 'Created Business record with ID {\"name\":\"DEBORAH KAMIZHI\",\"email\":\"Deborah.Kamizhi@natsave.co.zm\",\"branch_id\":\"14\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:24:21.000000Z\",\"created_at\":\"2025-07-11T09:24:21.000000Z\",\"id\":164}', '41.77.145.194', '2025-07-11 09:24:21', '2025-07-11 09:24:21'),
(298, 15, 'User', 'Created Business record with ID {\"name\":\"CHANDA MWENYA\",\"email\":\"Chanda.Mwenya@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:25:42.000000Z\",\"created_at\":\"2025-07-11T09:25:42.000000Z\",\"id\":165}', '41.77.145.194', '2025-07-11 09:25:42', '2025-07-11 09:25:42'),
(299, 17, 'User', 'Created Business record with ID {\"name\":\"Annetty Chongo\",\"email\":\"Annetty.Chongo@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T09:26:19.000000Z\",\"created_at\":\"2025-07-11T09:26:19.000000Z\",\"id\":166}', '41.77.145.194', '2025-07-11 09:26:19', '2025-07-11 09:26:19'),
(300, 17, 'User', 'Created Business record with ID {\"name\":\"Bertha Wanga\",\"email\":\"bertha.Wanga@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T09:29:30.000000Z\",\"created_at\":\"2025-07-11T09:29:30.000000Z\",\"id\":167}', '41.77.145.194', '2025-07-11 09:29:30', '2025-07-11 09:29:30'),
(301, 15, 'User', 'Created Business record with ID {\"name\":\"BESA MWEWA\",\"email\":\"Besa.Mwewa@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:29:30.000000Z\",\"created_at\":\"2025-07-11T09:29:30.000000Z\",\"id\":168}', '41.77.145.194', '2025-07-11 09:29:30', '2025-07-11 09:29:30'),
(302, 15, 'User', 'Created Business record with ID {\"name\":\"VERNON MWANZA\",\"email\":\"Vernon.Mwanza@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:30:15.000000Z\",\"created_at\":\"2025-07-11T09:30:15.000000Z\",\"id\":169}', '41.77.145.194', '2025-07-11 09:30:15', '2025-07-11 09:30:15'),
(303, 15, 'User', 'Created Business record with ID {\"name\":\"MUTINTA HANKOMBO\",\"email\":\"Mutinta.Hankombo@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":15,\"updated_at\":\"2025-07-11T09:33:27.000000Z\",\"created_at\":\"2025-07-11T09:33:27.000000Z\",\"id\":170}', '41.77.145.194', '2025-07-11 09:33:27', '2025-07-11 09:33:27'),
(304, 15, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-11 09:36:40', '2025-07-11 09:36:40'),
(305, 17, 'User', 'Created Business record with ID {\"name\":\"Gwen Namwila\",\"email\":\"Gwen.Namwila@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:05:54.000000Z\",\"created_at\":\"2025-07-11T10:05:54.000000Z\",\"id\":171}', '41.77.145.194', '2025-07-11 10:05:54', '2025-07-11 10:05:54'),
(306, 17, 'User', 'Created Business record with ID {\"name\":\"Bwalya Kapinga\",\"email\":\"bwaly.kapinga@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:06:55.000000Z\",\"created_at\":\"2025-07-11T10:06:55.000000Z\",\"id\":172}', '41.77.145.194', '2025-07-11 10:06:55', '2025-07-11 10:06:55'),
(307, 17, 'User', 'Created Business record with ID {\"name\":\"Christina Mutale\",\"email\":\"Christina.Mutale@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:08:11.000000Z\",\"created_at\":\"2025-07-11T10:08:11.000000Z\",\"id\":173}', '41.77.145.194', '2025-07-11 10:08:11', '2025-07-11 10:08:11'),
(308, 17, 'User', 'Created Business record with ID {\"name\":\"Deborah Njaluka\",\"email\":\"deborah.njaluka@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:10:12.000000Z\",\"created_at\":\"2025-07-11T10:10:12.000000Z\",\"id\":174}', '41.77.145.194', '2025-07-11 10:10:12', '2025-07-11 10:10:12'),
(309, 17, 'User', 'Created Business record with ID {\"name\":\"Patson Munyamata\",\"email\":\"Patson.Munyamata@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:11:23.000000Z\",\"created_at\":\"2025-07-11T10:11:23.000000Z\",\"id\":175}', '41.77.145.194', '2025-07-11 10:11:23', '2025-07-11 10:11:23'),
(310, 17, 'User', 'Created Business record with ID {\"name\":\"Chibulu Chongo\",\"email\":\"Chibulu.Chongo@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:13:16.000000Z\",\"created_at\":\"2025-07-11T10:13:16.000000Z\",\"id\":176}', '41.77.145.194', '2025-07-11 10:13:16', '2025-07-11 10:13:16'),
(311, 17, 'User', 'Created Business record with ID {\"name\":\"Memory Kalenje\",\"email\":\"Memory.Kalenje@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:15:30.000000Z\",\"created_at\":\"2025-07-11T10:15:30.000000Z\",\"id\":177}', '41.77.145.194', '2025-07-11 10:15:30', '2025-07-11 10:15:30'),
(312, 17, 'User', 'Created Business record with ID {\"name\":\"Micheal Phiri\",\"email\":\"Michael.Phiri@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:17:47.000000Z\",\"created_at\":\"2025-07-11T10:17:47.000000Z\",\"id\":178}', '41.77.145.194', '2025-07-11 10:17:47', '2025-07-11 10:17:47'),
(313, 17, 'User', 'Created Business record with ID {\"name\":\"Nothando Kateka\",\"email\":\"Nothando.Kateka@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:19:52.000000Z\",\"created_at\":\"2025-07-11T10:19:52.000000Z\",\"id\":179}', '41.77.145.194', '2025-07-11 10:19:52', '2025-07-11 10:19:52'),
(314, 17, 'User', 'Created Business record with ID {\"name\":\"ISABELMUBANGA\",\"email\":\"isabel.Mubanga@natsave.co.zm\",\"branch_id\":\"40\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:21:07.000000Z\",\"created_at\":\"2025-07-11T10:21:07.000000Z\",\"id\":180}', '41.77.145.194', '2025-07-11 10:21:07', '2025-07-11 10:21:07'),
(315, 17, 'User', 'Created Business record with ID {\"name\":\"Hikala Hamabwe\",\"email\":\"Hikala.Hamabwe@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:21:57.000000Z\",\"created_at\":\"2025-07-11T10:21:57.000000Z\",\"id\":181}', '41.77.145.194', '2025-07-11 10:21:57', '2025-07-11 10:21:57'),
(316, 17, 'User', 'Created Business record with ID {\"name\":\"Chimwemwe Soko\",\"email\":\"Chimwemwe.soko@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:23:21.000000Z\",\"created_at\":\"2025-07-11T10:23:21.000000Z\",\"id\":182}', '41.77.145.194', '2025-07-11 10:23:21', '2025-07-11 10:23:21'),
(317, 17, 'User', 'Created Business record with ID {\"name\":\"Mumba Chishimba\",\"email\":\"Mumba.Chishimba@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:24:24.000000Z\",\"created_at\":\"2025-07-11T10:24:24.000000Z\",\"id\":183}', '41.77.145.194', '2025-07-11 10:24:24', '2025-07-11 10:24:24'),
(318, 17, 'User', 'Created Business record with ID {\"name\":\"Nancy Namwala\",\"email\":\"Nancy.Namwala@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:25:18.000000Z\",\"created_at\":\"2025-07-11T10:25:18.000000Z\",\"id\":184}', '41.77.145.194', '2025-07-11 10:25:18', '2025-07-11 10:25:18'),
(319, 17, 'User', 'Created Business record with ID {\"name\":\"Sitwala Kamwi\",\"email\":\"Sitwala.Kamwi@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:26:22.000000Z\",\"created_at\":\"2025-07-11T10:26:22.000000Z\",\"id\":185}', '41.77.145.194', '2025-07-11 10:26:22', '2025-07-11 10:26:22'),
(320, 17, 'User', 'Created Business record with ID {\"name\":\"Choolwe Mukombwe\",\"email\":\"Choolwe.Mukombwe@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:28:02.000000Z\",\"created_at\":\"2025-07-11T10:28:02.000000Z\",\"id\":186}', '41.77.145.194', '2025-07-11 10:28:02', '2025-07-11 10:28:02'),
(321, 17, 'User', 'Created Business record with ID {\"name\":\"Carol Njekwa\",\"email\":\"Carol.Njekwa@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:28:47.000000Z\",\"created_at\":\"2025-07-11T10:28:47.000000Z\",\"id\":187}', '41.77.145.194', '2025-07-11 10:28:47', '2025-07-11 10:28:47'),
(322, 17, 'User', 'Created Business record with ID {\"name\":\"Hellen Chibuye\",\"email\":\"Hellen.Chibuye@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:30:16.000000Z\",\"created_at\":\"2025-07-11T10:30:16.000000Z\",\"id\":188}', '41.77.145.194', '2025-07-11 10:30:16', '2025-07-11 10:30:16'),
(323, 17, 'User', 'Created Business record with ID {\"name\":\"Lackson Miti\",\"email\":\"Lackson.Miti@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:31:36.000000Z\",\"created_at\":\"2025-07-11T10:31:36.000000Z\",\"id\":189}', '41.77.145.194', '2025-07-11 10:31:36', '2025-07-11 10:31:36'),
(324, 17, 'User', 'Created Business record with ID {\"name\":\"Rosemary Katambo\",\"email\":\"Rosemary.Katambo@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:32:40.000000Z\",\"created_at\":\"2025-07-11T10:32:40.000000Z\",\"id\":190}', '41.77.145.194', '2025-07-11 10:32:40', '2025-07-11 10:32:40'),
(325, 17, 'User', 'Created Business record with ID {\"name\":\"Christopher Phiri\",\"email\":\"Christopher.Phiri@natsave.co.zm\",\"branch_id\":\"30\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:33:40.000000Z\",\"created_at\":\"2025-07-11T10:33:40.000000Z\",\"id\":191}', '41.77.145.194', '2025-07-11 10:33:40', '2025-07-11 10:33:40'),
(326, 17, 'User', 'Created Business record with ID {\"name\":\"Bessie Menda\",\"email\":\"bessie.menda@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:34:55.000000Z\",\"created_at\":\"2025-07-11T10:34:55.000000Z\",\"id\":192}', '41.77.145.194', '2025-07-11 10:34:55', '2025-07-11 10:34:55'),
(327, 17, 'User', 'Created Business record with ID {\"name\":\"Becktody Shazemba\",\"email\":\"Becktody.Shazemba@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:40:39.000000Z\",\"created_at\":\"2025-07-11T10:40:39.000000Z\",\"id\":193}', '41.77.145.194', '2025-07-11 10:40:39', '2025-07-11 10:40:39'),
(328, 17, 'User', 'Created Business record with ID {\"name\":\"Martha Mpande\",\"email\":\"Martha.Mpande@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:55:59.000000Z\",\"created_at\":\"2025-07-11T10:55:59.000000Z\",\"id\":194}', '41.77.145.194', '2025-07-11 10:55:59', '2025-07-11 10:55:59'),
(329, 17, 'User', 'Created Business record with ID {\"name\":\"Hope Longwe\",\"email\":\"Hope.Longwe@natsave.co.zmhpoe\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:57:09.000000Z\",\"created_at\":\"2025-07-11T10:57:09.000000Z\",\"id\":195}', '41.77.145.194', '2025-07-11 10:57:09', '2025-07-11 10:57:09'),
(330, 17, 'User', 'Created Business record with ID {\"name\":\"Salvador Ngulube\",\"email\":\"Salvador.Ngulube@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T10:59:51.000000Z\",\"created_at\":\"2025-07-11T10:59:51.000000Z\",\"id\":196}', '41.77.145.194', '2025-07-11 10:59:51', '2025-07-11 10:59:51'),
(331, 17, 'User', 'Created Business record with ID {\"name\":\"Victor Chisela\",\"email\":\"Victor.Chisela@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:01:04.000000Z\",\"created_at\":\"2025-07-11T11:01:04.000000Z\",\"id\":197}', '41.77.145.194', '2025-07-11 11:01:04', '2025-07-11 11:01:04'),
(332, 17, 'User', 'Created Business record with ID {\"name\":\"Reuben Tembo\",\"email\":\"Reuben.Tembo@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:02:02.000000Z\",\"created_at\":\"2025-07-11T11:02:02.000000Z\",\"id\":198}', '41.77.145.194', '2025-07-11 11:02:02', '2025-07-11 11:02:02'),
(333, 17, 'User', 'Created Business record with ID {\"name\":\"Angela Daka\",\"email\":\"Angela.Daka@natsave.co.zm\",\"branch_id\":\"41\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:03:20.000000Z\",\"created_at\":\"2025-07-11T11:03:20.000000Z\",\"id\":199}', '41.77.145.194', '2025-07-11 11:03:20', '2025-07-11 11:03:20'),
(334, 17, 'User', 'Created Business record with ID {\"name\":\"Choolwe Mpondamasaka\",\"email\":\"Choolwe.Mpondamasaka@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:04:47.000000Z\",\"created_at\":\"2025-07-11T11:04:47.000000Z\",\"id\":200}', '41.77.145.194', '2025-07-11 11:04:47', '2025-07-11 11:04:47'),
(335, 17, 'User', 'Created Business record with ID {\"name\":\"Henry Kapinga\",\"email\":\"Henry.Kapinga@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:06:51.000000Z\",\"created_at\":\"2025-07-11T11:06:51.000000Z\",\"id\":201}', '41.77.145.194', '2025-07-11 11:06:51', '2025-07-11 11:06:51'),
(336, 17, 'User', 'Created Business record with ID {\"name\":\"Chewe Bowa\",\"email\":\"Chewe.Bowa@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:07:26.000000Z\",\"created_at\":\"2025-07-11T11:07:26.000000Z\",\"id\":202}', '41.77.145.194', '2025-07-11 11:07:26', '2025-07-11 11:07:26'),
(337, 17, 'User', 'Created Business record with ID {\"name\":\"Clara Masando\",\"email\":\"Clara.Masando@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:08:29.000000Z\",\"created_at\":\"2025-07-11T11:08:29.000000Z\",\"id\":203}', '41.77.145.194', '2025-07-11 11:08:29', '2025-07-11 11:08:29'),
(338, 17, 'User', 'Created Business record with ID {\"name\":\"Samuel Chanda\",\"email\":\"Samuel.Chanda@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:10:00.000000Z\",\"created_at\":\"2025-07-11T11:10:00.000000Z\",\"id\":204}', '41.77.145.194', '2025-07-11 11:10:00', '2025-07-11 11:10:00'),
(339, 17, 'User', 'Created Business record with ID {\"name\":\"Pamela Ngoma\",\"email\":\"Pamela.Ngoma@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:11:03.000000Z\",\"created_at\":\"2025-07-11T11:11:03.000000Z\",\"id\":205}', '41.77.145.194', '2025-07-11 11:11:03', '2025-07-11 11:11:03'),
(340, 17, 'User', 'Created Business record with ID {\"name\":\"Lungowe Kabisa\",\"email\":\"Lungowe.Kabisa@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:12:39.000000Z\",\"created_at\":\"2025-07-11T11:12:39.000000Z\",\"id\":206}', '41.77.145.194', '2025-07-11 11:12:39', '2025-07-11 11:12:39'),
(341, 17, 'User', 'Created Business record with ID {\"name\":\"Gromyko Muselitata\",\"email\":\"Gromyko.Muselitata@natsave.co.zm\",\"branch_id\":\"42\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:13:53.000000Z\",\"created_at\":\"2025-07-11T11:13:53.000000Z\",\"id\":207}', '41.77.145.194', '2025-07-11 11:13:53', '2025-07-11 11:13:53'),
(342, 17, 'User', 'Created Business record with ID {\"name\":\"Sombo Kauchingu\",\"email\":\"Sombo.Kauchingu@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:14:49.000000Z\",\"created_at\":\"2025-07-11T11:14:49.000000Z\",\"id\":208}', '41.77.145.194', '2025-07-11 11:14:49', '2025-07-11 11:14:49'),
(343, 17, 'User', 'Created Business record with ID {\"name\":\"Mirriam Mandefu\",\"email\":\"Mirrian.Mandefu@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:15:51.000000Z\",\"created_at\":\"2025-07-11T11:15:51.000000Z\",\"id\":209}', '41.77.145.194', '2025-07-11 11:15:51', '2025-07-11 11:15:51'),
(344, 17, 'User', 'Created Business record with ID {\"name\":\"Juliet Tapalu\",\"email\":\"Juliet.Tapalu@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:16:56.000000Z\",\"created_at\":\"2025-07-11T11:16:56.000000Z\",\"id\":210}', '41.77.145.194', '2025-07-11 11:16:56', '2025-07-11 11:16:56'),
(345, 17, 'User', 'Created Business record with ID {\"name\":\"Kalata Chanda\",\"email\":\"Kalata.Chanda@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:18:13.000000Z\",\"created_at\":\"2025-07-11T11:18:13.000000Z\",\"id\":211}', '41.77.145.194', '2025-07-11 11:18:13', '2025-07-11 11:18:13'),
(346, 17, 'User', 'Created Business record with ID {\"name\":\"Mapalo Zombe\",\"email\":\"Mapalo.Zombe@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:18:52.000000Z\",\"created_at\":\"2025-07-11T11:18:52.000000Z\",\"id\":212}', '41.77.145.194', '2025-07-11 11:18:52', '2025-07-11 11:18:52'),
(347, 17, 'User', 'Created Business record with ID {\"name\":\"Yamikani Tembo\",\"email\":\"Yamikani.Tembo@natsave.co.zm\",\"branch_id\":\"43\",\"role_id\":\"2\",\"user_id\":17,\"updated_at\":\"2025-07-11T11:19:37.000000Z\",\"created_at\":\"2025-07-11T11:19:37.000000Z\",\"id\":213}', '41.77.145.194', '2025-07-11 11:19:37', '2025-07-11 11:19:37'),
(348, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 11:52:33', '2025-07-11 11:52:33'),
(349, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 11:52:37', '2025-07-11 11:52:37'),
(350, 16, 'User', 'Created Business record with ID {\"name\":\"ROSEMARY LUNGU\",\"email\":\"rosemary.lungu@natsave.co.zm\",\"branch_id\":\"15\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T11:56:36.000000Z\",\"created_at\":\"2025-07-11T11:56:36.000000Z\",\"id\":214}', '41.77.145.194', '2025-07-11 11:56:36', '2025-07-11 11:56:36'),
(351, 16, 'User', 'Created Business record with ID {\"name\":\"JESSY NANYANGWE CHOMBA\",\"email\":\"jessy.nanyangwe@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T11:58:15.000000Z\",\"created_at\":\"2025-07-11T11:58:15.000000Z\",\"id\":215}', '41.77.145.194', '2025-07-11 11:58:15', '2025-07-11 11:58:15'),
(352, 16, 'User', 'Created Business record with ID {\"name\":\"KACHESA MIZINGA\",\"email\":\"mizinga.kachesa@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:00:04.000000Z\",\"created_at\":\"2025-07-11T12:00:04.000000Z\",\"id\":216}', '41.77.145.194', '2025-07-11 12:00:04', '2025-07-11 12:00:04'),
(353, 16, 'User', 'Created Business record with ID {\"name\":\"MABLE KASAMA\",\"email\":\"mable.kasama@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:01:51.000000Z\",\"created_at\":\"2025-07-11T12:01:51.000000Z\",\"id\":217}', '41.77.145.194', '2025-07-11 12:01:51', '2025-07-11 12:01:51'),
(354, 16, 'User', 'Created Business record with ID {\"name\":\"EXILDAH SIMOONGA\",\"email\":\"exildah.simoonga@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:05:52.000000Z\",\"created_at\":\"2025-07-11T12:05:52.000000Z\",\"id\":218}', '41.77.145.194', '2025-07-11 12:05:52', '2025-07-11 12:05:52'),
(355, 16, 'User', 'Created Business record with ID {\"name\":\"LAVENCE CHISHIMBA\",\"email\":\"lavence.chishimba@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:07:24.000000Z\",\"created_at\":\"2025-07-11T12:07:24.000000Z\",\"id\":219}', '41.77.145.194', '2025-07-11 12:07:24', '2025-07-11 12:07:24'),
(356, 16, 'User', 'Created Business record with ID {\"name\":\"DINESS CHABALA\",\"email\":\"diness.chabala@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:09:07.000000Z\",\"created_at\":\"2025-07-11T12:09:07.000000Z\",\"id\":220}', '41.77.145.194', '2025-07-11 12:09:07', '2025-07-11 12:09:07'),
(357, 16, 'User', 'Created Business record with ID {\"name\":\"ALICK SIMPOKOLWE\",\"email\":\"Alick.Simpokolwe@natsave.co.zm\",\"branch_id\":\"16\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:10:41.000000Z\",\"created_at\":\"2025-07-11T12:10:41.000000Z\",\"id\":221}', '41.77.145.194', '2025-07-11 12:10:41', '2025-07-11 12:10:41'),
(358, 16, 'User', 'Created Business record with ID {\"name\":\"FRIDAH KAPUTULA\",\"email\":\"fridah.kaputula@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:12:40.000000Z\",\"created_at\":\"2025-07-11T12:12:40.000000Z\",\"id\":222}', '41.77.145.194', '2025-07-11 12:12:40', '2025-07-11 12:12:40'),
(359, 16, 'User', 'Created Business record with ID {\"name\":\"GIFT MWIYA\",\"email\":\"gift.mwiya@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:13:48.000000Z\",\"created_at\":\"2025-07-11T12:13:48.000000Z\",\"id\":223}', '41.77.145.194', '2025-07-11 12:13:48', '2025-07-11 12:13:48'),
(360, 16, 'User', 'Created Business record with ID {\"name\":\"JOHN MALICHI\",\"email\":\"john.malichi@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:14:55.000000Z\",\"created_at\":\"2025-07-11T12:14:55.000000Z\",\"id\":224}', '41.77.145.194', '2025-07-11 12:14:55', '2025-07-11 12:14:55'),
(361, 16, 'User', 'Created Business record with ID {\"name\":\"IREEN MULUWA SAMUKOLO\",\"email\":\"ireen.samukolo@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:18:18.000000Z\",\"created_at\":\"2025-07-11T12:18:18.000000Z\",\"id\":225}', '41.77.145.194', '2025-07-11 12:18:18', '2025-07-11 12:18:18'),
(362, 16, 'User', 'Created Business record with ID {\"name\":\"SIMON ZIMBA\",\"email\":\"simon.zimba@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:20:34.000000Z\",\"created_at\":\"2025-07-11T12:20:34.000000Z\",\"id\":226}', '41.77.145.194', '2025-07-11 12:20:34', '2025-07-11 12:20:34'),
(363, 16, 'User', 'Created Business record with ID {\"name\":\"HOWARD MUJIMANZOVU\",\"email\":\"howard.mujimanzovu@natsave.co.zm\",\"branch_id\":\"17\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:21:57.000000Z\",\"created_at\":\"2025-07-11T12:21:57.000000Z\",\"id\":227}', '41.77.145.194', '2025-07-11 12:21:57', '2025-07-11 12:21:57'),
(364, 16, 'User', 'Created Business record with ID {\"name\":\"MISOZI SAKALA SHAMAKAMBA\",\"email\":\"misozi.sakala@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:23:18.000000Z\",\"created_at\":\"2025-07-11T12:23:18.000000Z\",\"id\":228}', '41.77.145.194', '2025-07-11 12:23:18', '2025-07-11 12:23:18'),
(365, 16, 'User', 'Created Business record with ID {\"name\":\"GREAT CHOONGO\",\"email\":\"great.chongo@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:31:25.000000Z\",\"created_at\":\"2025-07-11T12:31:25.000000Z\",\"id\":229}', '41.77.145.194', '2025-07-11 12:31:25', '2025-07-11 12:31:25'),
(366, 16, 'User', 'Created Business record with ID {\"name\":\"FRANK LWANGA\",\"email\":\"frank.lwanga@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:32:40.000000Z\",\"created_at\":\"2025-07-11T12:32:40.000000Z\",\"id\":230}', '41.77.145.194', '2025-07-11 12:32:40', '2025-07-11 12:32:40'),
(367, 16, 'User', 'Created Business record with ID {\"name\":\"NGENDA KAMENDA\",\"email\":\"ngenda.kamenda@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:35:35.000000Z\",\"created_at\":\"2025-07-11T12:35:35.000000Z\",\"id\":231}', '41.77.145.194', '2025-07-11 12:35:35', '2025-07-11 12:35:35'),
(368, 16, 'User', 'Created Business record with ID {\"name\":\"NAMUPU KAMUWANGA\",\"email\":\"namupu.kamuwanga@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:39:16.000000Z\",\"created_at\":\"2025-07-11T12:39:16.000000Z\",\"id\":232}', '41.77.145.194', '2025-07-11 12:39:16', '2025-07-11 12:39:16'),
(369, 16, 'User', 'Created Business record with ID {\"name\":\"UPENDO KANAWILA\",\"email\":\"upendo.kanawila@natsave.co.zm\",\"branch_id\":\"18\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:41:32.000000Z\",\"created_at\":\"2025-07-11T12:41:32.000000Z\",\"id\":233}', '41.77.145.194', '2025-07-11 12:41:32', '2025-07-11 12:41:32'),
(370, 16, 'User', 'Created Business record with ID {\"name\":\"SONGELA MWANZA\",\"email\":\"songela.mwanza@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:43:42.000000Z\",\"created_at\":\"2025-07-11T12:43:42.000000Z\",\"id\":234}', '41.77.145.194', '2025-07-11 12:43:42', '2025-07-11 12:43:42'),
(371, 16, 'User', 'Created Business record with ID {\"name\":\"MULENGA CHIWAZU\",\"email\":\"mulenga.chizawu@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:44:51.000000Z\",\"created_at\":\"2025-07-11T12:44:51.000000Z\",\"id\":235}', '41.77.145.194', '2025-07-11 12:44:51', '2025-07-11 12:44:51'),
(372, 16, 'User', 'Created Business record with ID {\"name\":\"MAJORIE NDHLOVU\",\"email\":\"marjorie.ndhlovu@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:48:12.000000Z\",\"created_at\":\"2025-07-11T12:48:12.000000Z\",\"id\":236}', '41.77.145.194', '2025-07-11 12:48:12', '2025-07-11 12:48:12'),
(373, 16, 'User', 'Created Business record with ID {\"name\":\"KATEMA PHIRI\",\"email\":\"katema.phiri@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:49:35.000000Z\",\"created_at\":\"2025-07-11T12:49:35.000000Z\",\"id\":237}', '41.77.145.194', '2025-07-11 12:49:35', '2025-07-11 12:49:35'),
(374, 16, 'User', 'Created Business record with ID {\"name\":\"GRACIOUS SIMBEYE\",\"email\":\"gracious.simbeye@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T12:59:10.000000Z\",\"created_at\":\"2025-07-11T12:59:10.000000Z\",\"id\":238}', '41.77.145.194', '2025-07-11 12:59:10', '2025-07-11 12:59:10'),
(375, 16, 'User', 'Created Business record with ID {\"name\":\"ZENAIDA BANDA\",\"email\":\"zenaida.banda@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:01:54.000000Z\",\"created_at\":\"2025-07-11T13:01:54.000000Z\",\"id\":239}', '41.77.145.194', '2025-07-11 13:01:54', '2025-07-11 13:01:54'),
(376, 16, 'User', 'Created Business record with ID {\"name\":\"TEMBOZI MUSONDA\",\"email\":\"tembozi.musonda@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:03:46.000000Z\",\"created_at\":\"2025-07-11T13:03:46.000000Z\",\"id\":240}', '41.77.145.194', '2025-07-11 13:03:46', '2025-07-11 13:03:46'),
(377, 16, 'User', 'Created Business record with ID {\"name\":\"MARLEEN INGWE\",\"email\":\"marleen.ingwe@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:07:06.000000Z\",\"created_at\":\"2025-07-11T13:07:06.000000Z\",\"id\":241}', '41.77.145.194', '2025-07-11 13:07:06', '2025-07-11 13:07:06'),
(378, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 13:07:06', '2025-07-11 13:07:06'),
(379, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 13:07:19', '2025-07-11 13:07:19'),
(380, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 13:07:24', '2025-07-11 13:07:24'),
(381, 16, 'User', 'Created Business record with ID {\"name\":\"EPHRAIM KYEMBE\",\"email\":\"Ephraim.Kyembe@natsave.co.zm\",\"branch_id\":\"19\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:09:48.000000Z\",\"created_at\":\"2025-07-11T13:09:48.000000Z\",\"id\":242}', '41.77.145.194', '2025-07-11 13:09:48', '2025-07-11 13:09:48'),
(382, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 13:10:54', '2025-07-11 13:10:54'),
(383, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 13:11:00', '2025-07-11 13:11:00'),
(384, 16, 'User', 'Created Business record with ID {\"name\":\"DIANA CHIPASHA\",\"email\":\"diana.chipasha@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:12:24.000000Z\",\"created_at\":\"2025-07-11T13:12:24.000000Z\",\"id\":243}', '41.77.145.194', '2025-07-11 13:12:24', '2025-07-11 13:12:24'),
(385, 16, 'User', 'Created Business record with ID {\"name\":\"JOTHAM NUNDWE\",\"email\":\"jotham.nundwe@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:14:54.000000Z\",\"created_at\":\"2025-07-11T13:14:54.000000Z\",\"id\":244}', '41.77.145.194', '2025-07-11 13:14:54', '2025-07-11 13:14:54'),
(386, 16, 'User', 'Created Business record with ID {\"name\":\"FELIX CHILESHE\",\"email\":\"felix.chileshe@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:16:08.000000Z\",\"created_at\":\"2025-07-11T13:16:08.000000Z\",\"id\":245}', '41.77.145.194', '2025-07-11 13:16:08', '2025-07-11 13:16:08');
INSERT INTO `audit_trails` (`id`, `user_id`, `module`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(387, 16, 'User', 'Created Business record with ID {\"name\":\"MARY TEMBO\",\"email\":\"mary.tembo@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:17:34.000000Z\",\"created_at\":\"2025-07-11T13:17:34.000000Z\",\"id\":246}', '41.77.145.194', '2025-07-11 13:17:34', '2025-07-11 13:17:34'),
(388, 16, 'User', 'Created Business record with ID {\"name\":\"EMMANUEL MUZETA\",\"email\":\"emmanuel.muzeta@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:21:06.000000Z\",\"created_at\":\"2025-07-11T13:21:06.000000Z\",\"id\":247}', '41.77.145.194', '2025-07-11 13:21:06', '2025-07-11 13:21:06'),
(389, 16, 'User', 'Created Business record with ID {\"name\":\"TOWELA MTONGA\",\"email\":\"towela.mtonga@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:22:49.000000Z\",\"created_at\":\"2025-07-11T13:22:49.000000Z\",\"id\":248}', '41.77.145.194', '2025-07-11 13:22:49', '2025-07-11 13:22:49'),
(390, 16, 'User', 'Created Business record with ID {\"name\":\"SHARON NKOLE NGOSA\",\"email\":\"sharon.nkole@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:25:13.000000Z\",\"created_at\":\"2025-07-11T13:25:13.000000Z\",\"id\":249}', '41.77.145.194', '2025-07-11 13:25:13', '2025-07-11 13:25:13'),
(391, 16, 'User', 'Created Business record with ID {\"name\":\"MWENYA KALAMBULA NGOSA\",\"email\":\"mwenya.kalambulwa@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:27:01.000000Z\",\"created_at\":\"2025-07-11T13:27:01.000000Z\",\"id\":250}', '41.77.145.194', '2025-07-11 13:27:01', '2025-07-11 13:27:01'),
(392, 16, 'User', 'Created Business record with ID {\"name\":\"HAPPINESS CHANDA\",\"email\":\"happiness.chanda@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:28:44.000000Z\",\"created_at\":\"2025-07-11T13:28:44.000000Z\",\"id\":251}', '41.77.145.194', '2025-07-11 13:28:44', '2025-07-11 13:28:44'),
(393, 16, 'User', 'Created Business record with ID {\"name\":\"RABECCA CHALI\",\"email\":\"rabecca.chali@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:30:29.000000Z\",\"created_at\":\"2025-07-11T13:30:29.000000Z\",\"id\":252}', '41.77.145.194', '2025-07-11 13:30:29', '2025-07-11 13:30:29'),
(394, 16, 'User', 'Created Business record with ID {\"name\":\"MATILDA  K PHIRI\",\"email\":\"matilda.phiri@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:34:30.000000Z\",\"created_at\":\"2025-07-11T13:34:30.000000Z\",\"id\":253}', '41.77.145.194', '2025-07-11 13:34:30', '2025-07-11 13:34:30'),
(395, 16, 'User', 'Created Business record with ID {\"name\":\"THERESA NAMAKANDO\",\"email\":\"theresa.namakando@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:35:33.000000Z\",\"created_at\":\"2025-07-11T13:35:33.000000Z\",\"id\":254}', '41.77.145.194', '2025-07-11 13:35:33', '2025-07-11 13:35:33'),
(396, 16, 'User', 'Created Business record with ID {\"name\":\"OSBORNE MLENZO\",\"email\":\"osborne.mlenzo@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:39:06.000000Z\",\"created_at\":\"2025-07-11T13:39:06.000000Z\",\"id\":255}', '41.77.145.194', '2025-07-11 13:39:06', '2025-07-11 13:39:06'),
(397, 16, 'User', 'Created Business record with ID {\"name\":\"STAN BANDA\",\"email\":\"stan.banda@natsave.co.zm\",\"branch_id\":\"21\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:41:32.000000Z\",\"created_at\":\"2025-07-11T13:41:32.000000Z\",\"id\":256}', '41.77.145.194', '2025-07-11 13:41:32', '2025-07-11 13:41:32'),
(398, 16, 'User', 'Created Business record with ID {\"name\":\"SYLVESTER MUMBA\",\"email\":\"sylvester.mumba@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:44:38.000000Z\",\"created_at\":\"2025-07-11T13:44:38.000000Z\",\"id\":257}', '41.77.145.194', '2025-07-11 13:44:38', '2025-07-11 13:44:38'),
(399, 16, 'User', 'Created Business record with ID {\"name\":\"CYNTHIA CHABU\",\"email\":\"cynthia.chabu@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:45:56.000000Z\",\"created_at\":\"2025-07-11T13:45:56.000000Z\",\"id\":258}', '41.77.145.194', '2025-07-11 13:45:56', '2025-07-11 13:45:56'),
(400, 16, 'User', 'Created Business record with ID {\"name\":\"LILIAN T KAONGA\",\"email\":\"lillian.kaonga@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:47:20.000000Z\",\"created_at\":\"2025-07-11T13:47:20.000000Z\",\"id\":259}', '41.77.145.194', '2025-07-11 13:47:20', '2025-07-11 13:47:20'),
(401, 16, 'User', 'Created Business record with ID {\"name\":\"MALUNGO HIMWIINGA\",\"email\":\"malungo.himwiinga@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:48:34.000000Z\",\"created_at\":\"2025-07-11T13:48:34.000000Z\",\"id\":260}', '41.77.145.194', '2025-07-11 13:48:34', '2025-07-11 13:48:34'),
(402, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 13:50:00', '2025-07-11 13:50:00'),
(403, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-11 13:50:09', '2025-07-11 13:50:09'),
(404, 16, 'User', 'Created Business record with ID {\"name\":\"MAXWELL NKOMESHA\",\"email\":\"maxwell.nkomesha@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:50:55.000000Z\",\"created_at\":\"2025-07-11T13:50:55.000000Z\",\"id\":261}', '41.77.145.194', '2025-07-11 13:50:55', '2025-07-11 13:50:55'),
(405, 16, 'User', 'Created Business record with ID {\"name\":\"MUTALE BWALYA\",\"email\":\"mutale.bwalya@natsave.co.zm\",\"branch_id\":\"23\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:52:33.000000Z\",\"created_at\":\"2025-07-11T13:52:33.000000Z\",\"id\":262}', '41.77.145.194', '2025-07-11 13:52:33', '2025-07-11 13:52:33'),
(406, 16, 'User', 'Created Business record with ID {\"name\":\"AUGUSTINE SILWAMBA\",\"email\":\"augustine.silwamba@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:55:03.000000Z\",\"created_at\":\"2025-07-11T13:55:03.000000Z\",\"id\":263}', '41.77.145.194', '2025-07-11 13:55:03', '2025-07-11 13:55:03'),
(407, 16, 'User', 'Created Business record with ID {\"name\":\"MIKE MALAMO\",\"email\":\"mike.malamo@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:56:19.000000Z\",\"created_at\":\"2025-07-11T13:56:19.000000Z\",\"id\":264}', '41.77.145.194', '2025-07-11 13:56:19', '2025-07-11 13:56:19'),
(408, 16, 'User', 'Created Business record with ID {\"name\":\"REGINA CHISUNKA\",\"email\":\"regina.chisunka@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:57:45.000000Z\",\"created_at\":\"2025-07-11T13:57:45.000000Z\",\"id\":265}', '41.77.145.194', '2025-07-11 13:57:45', '2025-07-11 13:57:45'),
(409, 16, 'User', 'Created Business record with ID {\"name\":\"PATRICK KABISA\",\"email\":\"patrick.kabisa@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T13:59:14.000000Z\",\"created_at\":\"2025-07-11T13:59:14.000000Z\",\"id\":266}', '41.77.145.194', '2025-07-11 13:59:14', '2025-07-11 13:59:14'),
(410, 16, 'User', 'Created Business record with ID {\"name\":\"SANDRA MBAITA KAPAKU\",\"email\":\"sandra.kapaku@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:01:00.000000Z\",\"created_at\":\"2025-07-11T14:01:00.000000Z\",\"id\":267}', '41.77.145.194', '2025-07-11 14:01:00', '2025-07-11 14:01:00'),
(411, 16, 'User', 'Created Business record with ID {\"name\":\"MWANAGOMBE MANGAMBWA\",\"email\":\"mwanangombe.mangambwa@natsave.co.zm\",\"branch_id\":\"24\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:02:54.000000Z\",\"created_at\":\"2025-07-11T14:02:54.000000Z\",\"id\":268}', '41.77.145.194', '2025-07-11 14:02:54', '2025-07-11 14:02:54'),
(412, 16, 'User', 'Created Business record with ID {\"name\":\"MEYA KAPITA\",\"email\":\"meya.kaumba@natsave.co.zm\",\"branch_id\":\"22\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:03:58.000000Z\",\"created_at\":\"2025-07-11T14:03:58.000000Z\",\"id\":269}', '41.77.145.194', '2025-07-11 14:03:58', '2025-07-11 14:03:58'),
(413, 16, 'User', 'Created Business record with ID {\"name\":\"MALI KAVIMBA\",\"email\":\"kavimba.mali@natsave.co.zm\",\"branch_id\":\"22\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:04:56.000000Z\",\"created_at\":\"2025-07-11T14:04:56.000000Z\",\"id\":270}', '41.77.145.194', '2025-07-11 14:04:56', '2025-07-11 14:04:56'),
(414, 16, 'User', 'Created Business record with ID {\"name\":\"DEBORAH MUCHILI\",\"email\":\"deborah.muchili@natsave.co.zm\",\"branch_id\":\"22\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:07:57.000000Z\",\"created_at\":\"2025-07-11T14:07:57.000000Z\",\"id\":271}', '41.77.145.194', '2025-07-11 14:07:57', '2025-07-11 14:07:57'),
(415, 16, 'User', 'Created Business record with ID {\"name\":\"KARREN MUSONDA\",\"email\":\"karren.musonda@natsave.co.zm\",\"branch_id\":\"22\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:09:25.000000Z\",\"created_at\":\"2025-07-11T14:09:25.000000Z\",\"id\":272}', '41.77.145.194', '2025-07-11 14:09:25', '2025-07-11 14:09:25'),
(416, 16, 'User', 'Created Business record with ID {\"name\":\"DANIEL LUKWESA\",\"email\":\"daniel.lukwesa@natsave.co.zm\",\"branch_id\":\"22\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:10:39.000000Z\",\"created_at\":\"2025-07-11T14:10:39.000000Z\",\"id\":273}', '41.77.145.194', '2025-07-11 14:10:39', '2025-07-11 14:10:39'),
(417, 16, 'User', 'Created Business record with ID {\"name\":\"BLOODY GOMA\",\"email\":\"bloody.chanda@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:11:46.000000Z\",\"created_at\":\"2025-07-11T14:11:46.000000Z\",\"id\":274}', '41.77.145.194', '2025-07-11 14:11:46', '2025-07-11 14:11:46'),
(418, 16, 'User', 'Created Business record with ID {\"name\":\"ENALA CHILESHE BANDA\",\"email\":\"enala.banda@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:12:56.000000Z\",\"created_at\":\"2025-07-11T14:12:56.000000Z\",\"id\":275}', '41.77.145.194', '2025-07-11 14:12:56', '2025-07-11 14:12:56'),
(419, 16, 'User', 'Created Business record with ID {\"name\":\"MUSUKWA KAPAMPA\",\"email\":\"kapampa.musukwa@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:14:18.000000Z\",\"created_at\":\"2025-07-11T14:14:18.000000Z\",\"id\":276}', '41.77.145.194', '2025-07-11 14:14:18', '2025-07-11 14:14:18'),
(420, 16, 'User', 'Created Business record with ID {\"name\":\"YVONNE NGOSA\",\"email\":\"yvonne.ngosa@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:17:22.000000Z\",\"created_at\":\"2025-07-11T14:17:22.000000Z\",\"id\":277}', '41.77.145.194', '2025-07-11 14:17:22', '2025-07-11 14:17:22'),
(421, 16, 'User', 'Created Business record with ID {\"name\":\"FRIDAH CHILOMBO SACHINYAMA\",\"email\":\"fridah.sachinyama@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:18:52.000000Z\",\"created_at\":\"2025-07-11T14:18:52.000000Z\",\"id\":278}', '41.77.145.194', '2025-07-11 14:18:52', '2025-07-11 14:18:52'),
(422, 16, 'User', 'Created Business record with ID {\"name\":\"MALILO SEFULO\",\"email\":\"malilo.kakoma@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:20:26.000000Z\",\"created_at\":\"2025-07-11T14:20:26.000000Z\",\"id\":279}', '41.77.145.194', '2025-07-11 14:20:26', '2025-07-11 14:20:26'),
(423, 16, 'User', 'Created Business record with ID {\"name\":\"FLORENCE K MUSILEKWA\",\"email\":\"florence.musilekwa@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:21:48.000000Z\",\"created_at\":\"2025-07-11T14:21:48.000000Z\",\"id\":280}', '41.77.145.194', '2025-07-11 14:21:48', '2025-07-11 14:21:48'),
(424, 16, 'User', 'Created Business record with ID {\"name\":\"MARY TEMBO\",\"email\":\"mary.tembo2@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:23:04.000000Z\",\"created_at\":\"2025-07-11T14:23:04.000000Z\",\"id\":281}', '41.77.145.194', '2025-07-11 14:23:04', '2025-07-11 14:23:04'),
(425, 16, 'User', 'Created Business record with ID {\"name\":\"PAMELLAH CHITALIMA\",\"email\":\"pamellah.chitalima@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:24:52.000000Z\",\"created_at\":\"2025-07-11T14:24:52.000000Z\",\"id\":282}', '41.77.145.194', '2025-07-11 14:24:52', '2025-07-11 14:24:52'),
(426, 16, 'User', 'Created Business record with ID {\"name\":\"SATAYA MAKUKULA\",\"email\":\"sataya.makukula@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:26:36.000000Z\",\"created_at\":\"2025-07-11T14:26:36.000000Z\",\"id\":283}', '41.77.145.194', '2025-07-11 14:26:36', '2025-07-11 14:26:36'),
(427, 16, 'User', 'Created Business record with ID {\"name\":\"IDAH MADDEN\",\"email\":\"idah.madden@natsave.co.zm\",\"branch_id\":\"28\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:27:55.000000Z\",\"created_at\":\"2025-07-11T14:27:55.000000Z\",\"id\":284}', '41.77.145.194', '2025-07-11 14:27:55', '2025-07-11 14:27:55'),
(428, 16, 'User', 'Created Business record with ID {\"name\":\"EMMANUEL SAKALA\",\"email\":\"emmanuel.sakala@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:29:38.000000Z\",\"created_at\":\"2025-07-11T14:29:38.000000Z\",\"id\":285}', '41.77.145.194', '2025-07-11 14:29:38', '2025-07-11 14:29:38'),
(429, 16, 'User', 'Created Business record with ID {\"name\":\"MALELI KAZIKA\",\"email\":\"kazika.maleli@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"1\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:30:57.000000Z\",\"created_at\":\"2025-07-11T14:30:57.000000Z\",\"id\":286}', '41.77.145.194', '2025-07-11 14:30:57', '2025-07-11 14:30:57'),
(430, 16, 'User', 'Created Business record with ID {\"name\":\"SENIDA SHAWA\",\"email\":\"senida.shawa@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:32:11.000000Z\",\"created_at\":\"2025-07-11T14:32:11.000000Z\",\"id\":287}', '41.77.145.194', '2025-07-11 14:32:11', '2025-07-11 14:32:11'),
(431, 16, 'User', 'Created Business record with ID {\"name\":\"JAMESON MWANSA\",\"email\":\"jameson.mwansa@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:33:30.000000Z\",\"created_at\":\"2025-07-11T14:33:30.000000Z\",\"id\":288}', '41.77.145.194', '2025-07-11 14:33:30', '2025-07-11 14:33:30'),
(432, 16, 'User', 'Created Business record with ID {\"name\":\"LIKANDO SILUMESI\",\"email\":\"likando.silumesii@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:36:45.000000Z\",\"created_at\":\"2025-07-11T14:36:45.000000Z\",\"id\":289}', '41.77.145.194', '2025-07-11 14:36:45', '2025-07-11 14:36:45'),
(433, 16, 'User', 'Created Business record with ID {\"name\":\"TAONA PHIRI\",\"email\":\"taona.phiri@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:38:07.000000Z\",\"created_at\":\"2025-07-11T14:38:07.000000Z\",\"id\":290}', '41.77.145.194', '2025-07-11 14:38:07', '2025-07-11 14:38:07'),
(434, 16, 'User', 'Created Business record with ID {\"name\":\"BRIAN MUSONDA\",\"email\":\"brian.musonda@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:39:11.000000Z\",\"created_at\":\"2025-07-11T14:39:11.000000Z\",\"id\":291}', '41.77.145.194', '2025-07-11 14:39:11', '2025-07-11 14:39:11'),
(435, 16, 'User', 'Created Business record with ID {\"name\":\"VIVIAN CHISHIMBA\",\"email\":\"vivian.chishimba@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:40:28.000000Z\",\"created_at\":\"2025-07-11T14:40:28.000000Z\",\"id\":292}', '41.77.145.194', '2025-07-11 14:40:28', '2025-07-11 14:40:28'),
(436, 16, 'User', 'Created Business record with ID {\"name\":\"ELVIS NGANDWE\",\"email\":\"elvis.ngandwe@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:41:48.000000Z\",\"created_at\":\"2025-07-11T14:41:48.000000Z\",\"id\":293}', '41.77.145.194', '2025-07-11 14:41:48', '2025-07-11 14:41:48'),
(437, 16, 'User', 'Created Business record with ID {\"name\":\"MARGRET SHAMUZUMBA\",\"email\":\"margret.shamuzumba@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:43:06.000000Z\",\"created_at\":\"2025-07-11T14:43:06.000000Z\",\"id\":294}', '41.77.145.194', '2025-07-11 14:43:06', '2025-07-11 14:43:06'),
(438, 16, 'User', 'Created Business record with ID {\"name\":\"JENIPHER CHIBESA\",\"email\":\"jenipher.chibesa@natsave.co.zm\",\"branch_id\":\"31\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:44:35.000000Z\",\"created_at\":\"2025-07-11T14:44:35.000000Z\",\"id\":295}', '41.77.145.194', '2025-07-11 14:44:35', '2025-07-11 14:44:35'),
(439, 16, 'User', 'Created Business record with ID {\"name\":\"KUFEKISA MATE \",\"email\":\"kufekisa.mate@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:45:59.000000Z\",\"created_at\":\"2025-07-11T14:45:59.000000Z\",\"id\":296}', '41.77.145.194', '2025-07-11 14:45:59', '2025-07-11 14:45:59'),
(440, 16, 'User', 'Created Business record with ID {\"name\":\"KAFULA MUSONDA\",\"email\":\"kafula.musonda@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:47:12.000000Z\",\"created_at\":\"2025-07-11T14:47:12.000000Z\",\"id\":297}', '41.77.145.194', '2025-07-11 14:47:12', '2025-07-11 14:47:12'),
(441, 16, 'User', 'Created Business record with ID {\"name\":\"JOSEPH CHANDA\",\"email\":\"joseph.chanda@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:48:16.000000Z\",\"created_at\":\"2025-07-11T14:48:16.000000Z\",\"id\":298}', '41.77.145.194', '2025-07-11 14:48:16', '2025-07-11 14:48:16'),
(442, 16, 'User', 'Created Business record with ID {\"name\":\"PETRONELLA KABULAYA\",\"email\":\"Petronella.Kabulaya@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:49:38.000000Z\",\"created_at\":\"2025-07-11T14:49:38.000000Z\",\"id\":299}', '41.77.145.194', '2025-07-11 14:49:38', '2025-07-11 14:49:38'),
(443, 16, 'User', 'Created Business record with ID {\"name\":\"EMMANUEL MVULA\",\"email\":\"Emmanuel.Mvula@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:50:29.000000Z\",\"created_at\":\"2025-07-11T14:50:29.000000Z\",\"id\":300}', '41.77.145.194', '2025-07-11 14:50:29', '2025-07-11 14:50:29'),
(444, 16, 'User', 'Created Business record with ID {\"name\":\"STANLEY HATUYUNI\",\"email\":\"Stanley.Hatuyuni@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:52:15.000000Z\",\"created_at\":\"2025-07-11T14:52:15.000000Z\",\"id\":301}', '41.77.145.194', '2025-07-11 14:52:15', '2025-07-11 14:52:15'),
(445, 16, 'User', 'Created Business record with ID {\"name\":\"ABIGAIL MBUNDA\",\"email\":\"Abigail.Mbunda@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:53:25.000000Z\",\"created_at\":\"2025-07-11T14:53:25.000000Z\",\"id\":302}', '41.77.145.194', '2025-07-11 14:53:25', '2025-07-11 14:53:25'),
(446, 16, 'User', 'Created Business record with ID {\"name\":\"CHIPETA TUMBIKO\",\"email\":\"thumbiko.chipeta@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:55:37.000000Z\",\"created_at\":\"2025-07-11T14:55:37.000000Z\",\"id\":303}', '41.77.145.194', '2025-07-11 14:55:37', '2025-07-11 14:55:37'),
(447, 16, 'User', 'Created Business record with ID {\"name\":\"ANNETTE TEMBA MUTILA\",\"email\":\"annette.mutila@natsave.co.zm\",\"branch_id\":\"32\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T14:59:59.000000Z\",\"created_at\":\"2025-07-11T14:59:59.000000Z\",\"id\":304}', '41.77.145.194', '2025-07-11 14:59:59', '2025-07-11 14:59:59'),
(448, 16, 'User', 'Created Business record with ID {\"name\":\"ALBERT NGULUBE\",\"email\":\"albert.ngulube@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T15:03:40.000000Z\",\"created_at\":\"2025-07-11T15:03:40.000000Z\",\"id\":305}', '41.77.145.194', '2025-07-11 15:03:40', '2025-07-11 15:03:40'),
(449, 16, 'User', 'Created Business record with ID {\"name\":\"RAY MUKWAVI\",\"email\":\"Ray.Mukwavi@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-11T15:04:24.000000Z\",\"created_at\":\"2025-07-11T15:04:24.000000Z\",\"id\":306}', '41.77.145.194', '2025-07-11 15:04:24', '2025-07-11 15:04:24'),
(450, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-11 15:04:37', '2025-07-11 15:04:37'),
(451, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-14 07:08:41', '2025-07-14 07:08:41'),
(452, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-14 07:08:46', '2025-07-14 07:08:46'),
(453, 16, 'User', 'Created Business record with ID {\"name\":\"KASAPO MWELWA\",\"email\":\"kasapo.mwelwa@natsave.co.zm\",\"branch_id\":\"20\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-14T07:09:36.000000Z\",\"created_at\":\"2025-07-14T07:09:36.000000Z\",\"id\":307}', '41.77.145.194', '2025-07-14 07:09:36', '2025-07-14 07:09:36'),
(454, 16, 'User', 'Created Business record with ID {\"name\":\"REX PHIRI\",\"email\":\"rex.phiri@natsave.co.zm\",\"branch_id\":\"29\",\"role_id\":\"2\",\"user_id\":16,\"updated_at\":\"2025-07-14T07:11:59.000000Z\",\"created_at\":\"2025-07-14T07:11:59.000000Z\",\"id\":308}', '41.77.145.194', '2025-07-14 07:11:59', '2025-07-14 07:11:59'),
(455, 16, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-14 07:12:27', '2025-07-14 07:12:27'),
(456, 16, 'Branch', 'Viewed List Branch Page', '41.77.145.194', '2025-07-14 07:13:18', '2025-07-14 07:13:18'),
(457, 16, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-14 07:13:44', '2025-07-14 07:13:44'),
(458, 16, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-14 07:13:57', '2025-07-14 07:13:57'),
(459, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-16 08:52:21', '2025-07-16 08:52:21'),
(460, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-16 09:59:37', '2025-07-16 09:59:37'),
(461, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:40:47', '2025-07-17 13:40:47'),
(462, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:43:52', '2025-07-17 13:43:52'),
(463, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:43:56', '2025-07-17 13:43:56'),
(464, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:46:30', '2025-07-17 13:46:30'),
(465, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:46:39', '2025-07-17 13:46:39'),
(466, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:46:44', '2025-07-17 13:46:44'),
(467, 15, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:48:32', '2025-07-17 13:48:32'),
(468, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:51:57', '2025-07-17 13:51:57'),
(469, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:52:44', '2025-07-17 13:52:44'),
(470, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:53:13', '2025-07-17 13:53:13'),
(471, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:55:29', '2025-07-17 13:55:29'),
(472, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:55:37', '2025-07-17 13:55:37'),
(473, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:56:05', '2025-07-17 13:56:05'),
(474, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:56:34', '2025-07-17 13:56:34'),
(475, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:56:55', '2025-07-17 13:56:55'),
(476, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:57:13', '2025-07-17 13:57:13'),
(477, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:57:42', '2025-07-17 13:57:42'),
(478, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:58:07', '2025-07-17 13:58:07'),
(479, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:58:47', '2025-07-17 13:58:47'),
(480, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 13:59:27', '2025-07-17 13:59:27'),
(481, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:00:06', '2025-07-17 14:00:06'),
(482, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:00:36', '2025-07-17 14:00:36'),
(483, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:01:21', '2025-07-17 14:01:21'),
(484, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:01:48', '2025-07-17 14:01:48'),
(485, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:02:36', '2025-07-17 14:02:36'),
(486, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:03:13', '2025-07-17 14:03:13'),
(487, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:03:39', '2025-07-17 14:03:39'),
(488, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:04:05', '2025-07-17 14:04:05'),
(489, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:04:38', '2025-07-17 14:04:38'),
(490, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:05:07', '2025-07-17 14:05:07'),
(491, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:05:24', '2025-07-17 14:05:24'),
(492, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:05:46', '2025-07-17 14:05:46'),
(493, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:06:07', '2025-07-17 14:06:07'),
(494, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:06:51', '2025-07-17 14:06:51'),
(495, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:07:14', '2025-07-17 14:07:14'),
(496, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:07:33', '2025-07-17 14:07:33'),
(497, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:07:58', '2025-07-17 14:07:58'),
(498, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:08:23', '2025-07-17 14:08:23'),
(499, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:08:40', '2025-07-17 14:08:40'),
(500, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:08:58', '2025-07-17 14:08:58'),
(501, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:09:17', '2025-07-17 14:09:17'),
(502, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:09:43', '2025-07-17 14:09:43'),
(503, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:10:01', '2025-07-17 14:10:01'),
(504, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:10:44', '2025-07-17 14:10:44'),
(505, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:11:14', '2025-07-17 14:11:14'),
(506, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:11:39', '2025-07-17 14:11:39'),
(507, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:13:05', '2025-07-17 14:13:05'),
(508, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:13:23', '2025-07-17 14:13:23'),
(509, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:13:54', '2025-07-17 14:13:54'),
(510, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:14:17', '2025-07-17 14:14:17'),
(511, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:14:49', '2025-07-17 14:14:49'),
(512, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:15:05', '2025-07-17 14:15:05'),
(513, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:15:26', '2025-07-17 14:15:26'),
(514, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:15:43', '2025-07-17 14:15:43'),
(515, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:16:01', '2025-07-17 14:16:01'),
(516, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:16:15', '2025-07-17 14:16:15'),
(517, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:16:34', '2025-07-17 14:16:34'),
(518, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:16:56', '2025-07-17 14:16:56'),
(519, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:17:10', '2025-07-17 14:17:10'),
(520, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:17:34', '2025-07-17 14:17:34'),
(521, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:17:56', '2025-07-17 14:17:56'),
(522, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:18:10', '2025-07-17 14:18:10'),
(523, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:18:29', '2025-07-17 14:18:29'),
(524, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:18:53', '2025-07-17 14:18:53'),
(525, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:19:12', '2025-07-17 14:19:12'),
(526, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:19:56', '2025-07-17 14:19:56'),
(527, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:20:12', '2025-07-17 14:20:12'),
(528, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:21:07', '2025-07-17 14:21:07'),
(529, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:21:21', '2025-07-17 14:21:21'),
(530, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:21:37', '2025-07-17 14:21:37'),
(531, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:21:54', '2025-07-17 14:21:54'),
(532, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:22:21', '2025-07-17 14:22:21'),
(533, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:22:40', '2025-07-17 14:22:40'),
(534, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:22:57', '2025-07-17 14:22:57'),
(535, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:23:51', '2025-07-17 14:23:51'),
(536, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:24:08', '2025-07-17 14:24:08'),
(537, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:24:32', '2025-07-17 14:24:32'),
(538, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:24:59', '2025-07-17 14:24:59'),
(539, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:25:33', '2025-07-17 14:25:33'),
(540, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:25:59', '2025-07-17 14:25:59'),
(541, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:26:16', '2025-07-17 14:26:16'),
(542, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:26:46', '2025-07-17 14:26:46'),
(543, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:27:09', '2025-07-17 14:27:09'),
(544, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:27:30', '2025-07-17 14:27:30'),
(545, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:27:49', '2025-07-17 14:27:49'),
(546, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:28:08', '2025-07-17 14:28:08'),
(547, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:28:30', '2025-07-17 14:28:30'),
(548, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:28:44', '2025-07-17 14:28:44'),
(549, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:29:01', '2025-07-17 14:29:01'),
(550, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:29:19', '2025-07-17 14:29:19'),
(551, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:29:41', '2025-07-17 14:29:41'),
(552, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:30:16', '2025-07-17 14:30:16'),
(553, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:30:25', '2025-07-17 14:30:25'),
(554, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:30:41', '2025-07-17 14:30:41'),
(555, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:31:04', '2025-07-17 14:31:04'),
(556, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:31:20', '2025-07-17 14:31:20'),
(557, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:31:37', '2025-07-17 14:31:37'),
(558, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:31:54', '2025-07-17 14:31:54'),
(559, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:32:19', '2025-07-17 14:32:19'),
(560, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:32:38', '2025-07-17 14:32:38'),
(561, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:32:54', '2025-07-17 14:32:54'),
(562, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:33:50', '2025-07-17 14:33:50'),
(563, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:34:25', '2025-07-17 14:34:25'),
(564, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:34:42', '2025-07-17 14:34:42'),
(565, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:35:34', '2025-07-17 14:35:34'),
(566, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:36:05', '2025-07-17 14:36:05'),
(567, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:39:52', '2025-07-17 14:39:52'),
(568, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:40:16', '2025-07-17 14:40:16'),
(569, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:40:18', '2025-07-17 14:40:18'),
(570, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:40:27', '2025-07-17 14:40:27'),
(571, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:40:29', '2025-07-17 14:40:29'),
(572, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:43:27', '2025-07-17 14:43:27'),
(573, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:50:57', '2025-07-17 14:50:57'),
(574, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:51:11', '2025-07-17 14:51:11'),
(575, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-17 14:53:01', '2025-07-17 14:53:01'),
(576, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:54:35', '2025-07-17 14:54:35'),
(577, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:55:24', '2025-07-17 14:55:24'),
(578, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:55:28', '2025-07-17 14:55:28'),
(579, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 14:55:45', '2025-07-17 14:55:45'),
(580, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:09:44', '2025-07-17 15:09:44'),
(581, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:10:33', '2025-07-17 15:10:33'),
(582, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:11:14', '2025-07-17 15:11:14'),
(583, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:11:18', '2025-07-17 15:11:18'),
(584, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:11:21', '2025-07-17 15:11:21'),
(585, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:11:47', '2025-07-17 15:11:47'),
(586, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:09', '2025-07-17 15:12:09'),
(587, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:31', '2025-07-17 15:12:31'),
(588, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:32', '2025-07-17 15:12:32'),
(589, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:32', '2025-07-17 15:12:32'),
(590, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:49', '2025-07-17 15:12:49'),
(591, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:56', '2025-07-17 15:12:56'),
(592, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:12:59', '2025-07-17 15:12:59'),
(593, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:13:23', '2025-07-17 15:13:23'),
(594, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:13:36', '2025-07-17 15:13:36'),
(595, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:13:41', '2025-07-17 15:13:41'),
(596, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:13:43', '2025-07-17 15:13:43'),
(597, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:13:49', '2025-07-17 15:13:49'),
(598, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:14:02', '2025-07-17 15:14:02'),
(599, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:14:23', '2025-07-17 15:14:23'),
(600, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:14:35', '2025-07-17 15:14:35'),
(601, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:14:49', '2025-07-17 15:14:49'),
(602, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:14:58', '2025-07-17 15:14:58'),
(603, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:15:24', '2025-07-17 15:15:24'),
(604, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:15:27', '2025-07-17 15:15:27'),
(605, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:15:50', '2025-07-17 15:15:50'),
(606, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:16:08', '2025-07-17 15:16:08'),
(607, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:16:26', '2025-07-17 15:16:26'),
(608, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:16:29', '2025-07-17 15:16:29'),
(609, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:16:38', '2025-07-17 15:16:38'),
(610, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:16:51', '2025-07-17 15:16:51'),
(611, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:17:13', '2025-07-17 15:17:13'),
(612, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:17:31', '2025-07-17 15:17:31'),
(613, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:17:48', '2025-07-17 15:17:48'),
(614, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:06', '2025-07-17 15:18:06'),
(615, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:23', '2025-07-17 15:18:23'),
(616, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:40', '2025-07-17 15:18:40'),
(617, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:42', '2025-07-17 15:18:42'),
(618, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:45', '2025-07-17 15:18:45'),
(619, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:18:48', '2025-07-17 15:18:48'),
(620, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:19:06', '2025-07-17 15:19:06'),
(621, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:19:23', '2025-07-17 15:19:23'),
(622, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:19:39', '2025-07-17 15:19:39'),
(623, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:19:55', '2025-07-17 15:19:55'),
(624, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:19:57', '2025-07-17 15:19:57'),
(625, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:00', '2025-07-17 15:20:00'),
(626, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:02', '2025-07-17 15:20:02'),
(627, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:21', '2025-07-17 15:20:21'),
(628, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:24', '2025-07-17 15:20:24'),
(629, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:40', '2025-07-17 15:20:40'),
(630, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:20:55', '2025-07-17 15:20:55'),
(631, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:21:11', '2025-07-17 15:21:11'),
(632, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:21:31', '2025-07-17 15:21:31'),
(633, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:21:46', '2025-07-17 15:21:46'),
(634, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:22:03', '2025-07-17 15:22:03'),
(635, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:22:05', '2025-07-17 15:22:05'),
(636, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:23:56', '2025-07-17 15:23:56'),
(637, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:27:36', '2025-07-17 15:27:36'),
(638, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:28:15', '2025-07-17 15:28:15'),
(639, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:28:33', '2025-07-17 15:28:33'),
(640, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:28:41', '2025-07-17 15:28:41'),
(641, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:29:01', '2025-07-17 15:29:01'),
(642, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:29:35', '2025-07-17 15:29:35'),
(643, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:29:48', '2025-07-17 15:29:48'),
(644, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:30:02', '2025-07-17 15:30:02'),
(645, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:30:12', '2025-07-17 15:30:12'),
(646, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:30:45', '2025-07-17 15:30:45'),
(647, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:32:16', '2025-07-17 15:32:16'),
(648, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:35:36', '2025-07-17 15:35:36'),
(649, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:38:44', '2025-07-17 15:38:44'),
(650, 5, 'User', 'Viewed Create User Page', '41.77.145.194', '2025-07-17 15:39:20', '2025-07-17 15:39:20'),
(651, 5, 'User', 'Created Business record with ID {\"name\":\"Kalizya Mofya\",\"email\":\"Kalizya.Mofya@natsave.co.zm\",\"branch_id\":\"4\",\"role_id\":\"2\",\"user_id\":5,\"updated_at\":\"2025-07-17T15:40:09.000000Z\",\"created_at\":\"2025-07-17T15:40:09.000000Z\",\"id\":309}', '41.77.145.194', '2025-07-17 15:40:09', '2025-07-17 15:40:09'),
(652, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:40:10', '2025-07-17 15:40:10'),
(653, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:40:29', '2025-07-17 15:40:29'),
(654, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:56:28', '2025-07-17 15:56:28'),
(655, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 15:57:00', '2025-07-17 15:57:00'),
(656, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 16:00:20', '2025-07-17 16:00:20'),
(657, 5, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-17 16:00:39', '2025-07-17 16:00:39'),
(658, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:18:59', '2025-07-18 08:18:59'),
(659, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:19:47', '2025-07-18 08:19:47'),
(660, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:20:22', '2025-07-18 08:20:22'),
(661, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:20:44', '2025-07-18 08:20:44'),
(662, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:22:10', '2025-07-18 08:22:10'),
(663, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:23:04', '2025-07-18 08:23:04'),
(664, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:23:35', '2025-07-18 08:23:35'),
(665, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:24:10', '2025-07-18 08:24:10'),
(666, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:24:41', '2025-07-18 08:24:41'),
(667, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:25:00', '2025-07-18 08:25:00'),
(668, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:25:18', '2025-07-18 08:25:18'),
(669, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:25:37', '2025-07-18 08:25:37'),
(670, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:25:59', '2025-07-18 08:25:59'),
(671, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:26:23', '2025-07-18 08:26:23'),
(672, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:26:42', '2025-07-18 08:26:42'),
(673, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:27:12', '2025-07-18 08:27:12'),
(674, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:27:35', '2025-07-18 08:27:35'),
(675, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:27:59', '2025-07-18 08:27:59'),
(676, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:28:24', '2025-07-18 08:28:24'),
(677, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:28:45', '2025-07-18 08:28:45'),
(678, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:29:05', '2025-07-18 08:29:05'),
(679, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:29:07', '2025-07-18 08:29:07'),
(680, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:29:27', '2025-07-18 08:29:27'),
(681, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:29:58', '2025-07-18 08:29:58'),
(682, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:30:23', '2025-07-18 08:30:23'),
(683, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:30:26', '2025-07-18 08:30:26'),
(684, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:34:20', '2025-07-18 08:34:20'),
(685, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:40:00', '2025-07-18 08:40:00'),
(686, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:40:39', '2025-07-18 08:40:39'),
(687, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:41:08', '2025-07-18 08:41:08'),
(688, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:41:33', '2025-07-18 08:41:33'),
(689, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:42:22', '2025-07-18 08:42:22'),
(690, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:42:44', '2025-07-18 08:42:44'),
(691, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:43:42', '2025-07-18 08:43:42'),
(692, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:49:51', '2025-07-18 08:49:51'),
(693, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:50:15', '2025-07-18 08:50:15'),
(694, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:50:40', '2025-07-18 08:50:40'),
(695, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:51:21', '2025-07-18 08:51:21'),
(696, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:51:51', '2025-07-18 08:51:51'),
(697, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:53:01', '2025-07-18 08:53:01'),
(698, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:54:44', '2025-07-18 08:54:44'),
(699, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:55:33', '2025-07-18 08:55:33'),
(700, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:55:36', '2025-07-18 08:55:36'),
(701, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:55:39', '2025-07-18 08:55:39'),
(702, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:56:12', '2025-07-18 08:56:12'),
(703, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:58:36', '2025-07-18 08:58:36'),
(704, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 08:59:32', '2025-07-18 08:59:32'),
(705, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:02:46', '2025-07-18 09:02:46'),
(706, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:02:47', '2025-07-18 09:02:47'),
(707, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:03:36', '2025-07-18 09:03:36'),
(708, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:04:30', '2025-07-18 09:04:30'),
(709, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:05:30', '2025-07-18 09:05:30'),
(710, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:06:29', '2025-07-18 09:06:29'),
(711, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:07:46', '2025-07-18 09:07:46'),
(712, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:07:49', '2025-07-18 09:07:49'),
(713, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:09:07', '2025-07-18 09:09:07');
INSERT INTO `audit_trails` (`id`, `user_id`, `module`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(714, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:09:52', '2025-07-18 09:09:52'),
(715, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:10:34', '2025-07-18 09:10:34'),
(716, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:11:15', '2025-07-18 09:11:15'),
(717, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:11:55', '2025-07-18 09:11:55'),
(718, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:14:10', '2025-07-18 09:14:10'),
(719, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:14:13', '2025-07-18 09:14:13'),
(720, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:20:06', '2025-07-18 09:20:06'),
(721, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:21:10', '2025-07-18 09:21:10'),
(722, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:21:12', '2025-07-18 09:21:12'),
(723, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:22:29', '2025-07-18 09:22:29'),
(724, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:23:48', '2025-07-18 09:23:48'),
(725, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:24:52', '2025-07-18 09:24:52'),
(726, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:25:16', '2025-07-18 09:25:16'),
(727, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:25:19', '2025-07-18 09:25:19'),
(728, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:25:22', '2025-07-18 09:25:22'),
(729, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:25:54', '2025-07-18 09:25:54'),
(730, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:27:18', '2025-07-18 09:27:18'),
(731, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:27:59', '2025-07-18 09:27:59'),
(732, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:46:34', '2025-07-18 09:46:34'),
(733, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:48:03', '2025-07-18 09:48:03'),
(734, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:48:06', '2025-07-18 09:48:06'),
(735, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 09:48:19', '2025-07-18 09:48:19'),
(736, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:44:14', '2025-07-18 13:44:14'),
(737, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:47:09', '2025-07-18 13:47:09'),
(738, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:48:54', '2025-07-18 13:48:54'),
(739, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:49:36', '2025-07-18 13:49:36'),
(740, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:51:19', '2025-07-18 13:51:19'),
(741, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:53:09', '2025-07-18 13:53:09'),
(742, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:54:25', '2025-07-18 13:54:25'),
(743, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:55:08', '2025-07-18 13:55:08'),
(744, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:55:12', '2025-07-18 13:55:12'),
(745, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:58:39', '2025-07-18 13:58:39'),
(746, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:58:42', '2025-07-18 13:58:42'),
(747, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 13:59:40', '2025-07-18 13:59:40'),
(748, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:00:22', '2025-07-18 14:00:22'),
(749, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:01:11', '2025-07-18 14:01:11'),
(750, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:01:53', '2025-07-18 14:01:53'),
(751, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:03:23', '2025-07-18 14:03:23'),
(752, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:04:22', '2025-07-18 14:04:22'),
(753, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:05:11', '2025-07-18 14:05:11'),
(754, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:05:17', '2025-07-18 14:05:17'),
(755, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:05:59', '2025-07-18 14:05:59'),
(756, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:06:02', '2025-07-18 14:06:02'),
(757, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:06:52', '2025-07-18 14:06:52'),
(758, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:07:16', '2025-07-18 14:07:16'),
(759, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:07:59', '2025-07-18 14:07:59'),
(760, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:08:17', '2025-07-18 14:08:17'),
(761, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:10:32', '2025-07-18 14:10:32'),
(762, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:10:55', '2025-07-18 14:10:55'),
(763, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:11:21', '2025-07-18 14:11:21'),
(764, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:11:49', '2025-07-18 14:11:49'),
(765, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:12:21', '2025-07-18 14:12:21'),
(766, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:13:43', '2025-07-18 14:13:43'),
(767, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:14:23', '2025-07-18 14:14:23'),
(768, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:15:05', '2025-07-18 14:15:05'),
(769, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:15:48', '2025-07-18 14:15:48'),
(770, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:15:50', '2025-07-18 14:15:50'),
(771, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:16:17', '2025-07-18 14:16:17'),
(772, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:16:40', '2025-07-18 14:16:40'),
(773, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:16:43', '2025-07-18 14:16:43'),
(774, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:12', '2025-07-18 14:17:12'),
(775, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:28', '2025-07-18 14:17:28'),
(776, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:47', '2025-07-18 14:17:47'),
(777, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:50', '2025-07-18 14:17:50'),
(778, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:52', '2025-07-18 14:17:52'),
(779, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:17:56', '2025-07-18 14:17:56'),
(780, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:18:11', '2025-07-18 14:18:11'),
(781, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:18:29', '2025-07-18 14:18:29'),
(782, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:18:55', '2025-07-18 14:18:55'),
(783, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:18:59', '2025-07-18 14:18:59'),
(784, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:19:27', '2025-07-18 14:19:27'),
(785, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:19:51', '2025-07-18 14:19:51'),
(786, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:20:16', '2025-07-18 14:20:16'),
(787, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:20:33', '2025-07-18 14:20:33'),
(788, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:20:52', '2025-07-18 14:20:52'),
(789, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:21:11', '2025-07-18 14:21:11'),
(790, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:21:27', '2025-07-18 14:21:27'),
(791, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:22:16', '2025-07-18 14:22:16'),
(792, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:22:48', '2025-07-18 14:22:48'),
(793, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:23:09', '2025-07-18 14:23:09'),
(794, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:23:28', '2025-07-18 14:23:28'),
(795, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:24:26', '2025-07-18 14:24:26'),
(796, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:24:51', '2025-07-18 14:24:51'),
(797, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:25:36', '2025-07-18 14:25:36'),
(798, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:28:19', '2025-07-18 14:28:19'),
(799, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:28:42', '2025-07-18 14:28:42'),
(800, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:28:45', '2025-07-18 14:28:45'),
(801, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:29:39', '2025-07-18 14:29:39'),
(802, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:30:24', '2025-07-18 14:30:24'),
(803, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:30:48', '2025-07-18 14:30:48'),
(804, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:31:14', '2025-07-18 14:31:14'),
(805, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:31:16', '2025-07-18 14:31:16'),
(806, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:31:44', '2025-07-18 14:31:44'),
(807, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:32:06', '2025-07-18 14:32:06'),
(808, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:32:27', '2025-07-18 14:32:27'),
(809, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:32:42', '2025-07-18 14:32:42'),
(810, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:32:59', '2025-07-18 14:32:59'),
(811, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:33:16', '2025-07-18 14:33:16'),
(812, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:33:31', '2025-07-18 14:33:31'),
(813, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:33:34', '2025-07-18 14:33:34'),
(814, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:33:56', '2025-07-18 14:33:56'),
(815, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:34:00', '2025-07-18 14:34:00'),
(816, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:35:34', '2025-07-18 14:35:34'),
(817, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:36:07', '2025-07-18 14:36:07'),
(818, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:36:34', '2025-07-18 14:36:34'),
(819, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:36:57', '2025-07-18 14:36:57'),
(820, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:37:44', '2025-07-18 14:37:44'),
(821, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:38:21', '2025-07-18 14:38:21'),
(822, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:40:01', '2025-07-18 14:40:01'),
(823, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:40:29', '2025-07-18 14:40:29'),
(824, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:42:07', '2025-07-18 14:42:07'),
(825, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:43:05', '2025-07-18 14:43:05'),
(826, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:43:41', '2025-07-18 14:43:41'),
(827, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:44:09', '2025-07-18 14:44:09'),
(828, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:45:16', '2025-07-18 14:45:16'),
(829, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:47:25', '2025-07-18 14:47:25'),
(830, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:48:09', '2025-07-18 14:48:09'),
(831, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:48:51', '2025-07-18 14:48:51'),
(832, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:49:19', '2025-07-18 14:49:19'),
(833, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:49:56', '2025-07-18 14:49:56'),
(834, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:49:59', '2025-07-18 14:49:59'),
(835, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:50:33', '2025-07-18 14:50:33'),
(836, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:52:33', '2025-07-18 14:52:33'),
(837, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:52:59', '2025-07-18 14:52:59'),
(838, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:14', '2025-07-18 14:53:14'),
(839, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:18', '2025-07-18 14:53:18'),
(840, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:21', '2025-07-18 14:53:21'),
(841, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:24', '2025-07-18 14:53:24'),
(842, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:27', '2025-07-18 14:53:27'),
(843, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:30', '2025-07-18 14:53:30'),
(844, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:33', '2025-07-18 14:53:33'),
(845, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:53:33', '2025-07-18 14:53:33'),
(846, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:54:15', '2025-07-18 14:54:15'),
(847, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:54:22', '2025-07-18 14:54:22'),
(848, 11, 'User', 'Viewed List User Page', '41.77.145.194', '2025-07-18 14:55:05', '2025-07-18 14:55:05'),
(849, 1, 'User', 'Viewed List User Page', '41.223.118.76', '2025-07-21 06:00:48', '2025-07-21 06:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Head Office', '2025-07-10 11:01:38', '2025-07-10 11:01:38'),
(5, 'Chama', '2025-07-10 12:54:17', '2025-07-10 12:54:17'),
(6, 'Chavuma', '2025-07-10 12:54:27', '2025-07-10 12:54:27'),
(7, 'Chilubi Island', '2025-07-10 12:54:41', '2025-07-10 12:54:41'),
(8, 'Chimwemwe', '2025-07-10 12:54:55', '2025-07-10 12:54:55'),
(9, 'Chinsali', '2025-07-10 12:55:04', '2025-07-10 12:55:04'),
(10, 'Chipata', '2025-07-10 12:55:15', '2025-07-10 12:55:15'),
(11, 'Choma', '2025-07-10 12:55:25', '2025-07-10 12:55:25'),
(12, 'Chongwe', '2025-07-10 12:55:37', '2025-07-10 12:55:37'),
(13, 'Kabwe', '2025-07-10 12:55:47', '2025-07-10 12:55:47'),
(14, 'Kalabo', '2025-07-10 12:55:55', '2025-07-10 12:55:55'),
(15, 'Kaputa', '2025-07-10 12:56:05', '2025-07-10 12:56:05'),
(16, 'Kasama', '2025-07-10 12:56:12', '2025-07-10 12:56:12'),
(17, 'Kasempa', '2025-07-10 12:56:21', '2025-07-10 12:56:21'),
(18, 'Kazungula', '2025-07-10 12:56:30', '2025-07-10 12:56:30'),
(19, 'Kitwe', '2025-07-10 12:56:39', '2025-07-10 12:56:39'),
(20, 'Livingstone', '2025-07-10 12:56:47', '2025-07-10 12:56:47'),
(21, 'Luanshya', '2025-07-10 12:56:59', '2025-07-10 12:56:59'),
(22, 'Lumwana', '2025-07-10 12:57:06', '2025-07-10 12:57:06'),
(23, 'Lufwanyama', '2025-07-10 12:57:15', '2025-07-10 12:57:15'),
(24, 'Lukulu', '2025-07-10 12:57:25', '2025-07-10 12:57:25'),
(25, 'Chilenje', '2025-07-10 12:57:35', '2025-07-10 12:57:35'),
(26, 'Chawama Money Window', '2025-07-10 12:58:06', '2025-07-10 12:58:06'),
(27, 'Chawama', '2025-07-10 12:58:24', '2025-07-10 12:58:24'),
(28, 'Lusaka Main', '2025-07-10 12:58:41', '2025-07-10 12:58:41'),
(29, 'Matero', '2025-07-10 12:58:51', '2025-07-10 12:58:51'),
(30, 'Northend', '2025-07-10 13:03:29', '2025-07-10 13:03:29'),
(31, 'Luwingu', '2025-07-10 13:03:38', '2025-07-10 13:03:38'),
(32, 'Mansa', '2025-07-10 13:03:50', '2025-07-10 13:03:50'),
(33, 'Mongu', '2025-07-10 13:03:57', '2025-07-10 13:03:57'),
(34, 'Mpika', '2025-07-10 13:04:04', '2025-07-10 13:04:04'),
(35, 'Mporokoso', '2025-07-10 13:04:21', '2025-07-10 13:04:21'),
(36, 'Mpongwe', '2025-07-10 13:04:29', '2025-07-10 13:04:29'),
(37, 'Mumbwa', '2025-07-10 13:04:39', '2025-07-10 13:04:39'),
(38, 'Mwense', '2025-07-10 13:04:46', '2025-07-10 13:04:46'),
(39, 'Nchelenge', '2025-07-10 13:04:58', '2025-07-10 13:04:58'),
(40, 'Ndola', '2025-07-10 13:05:04', '2025-07-10 13:05:04'),
(41, 'Petauke', '2025-07-10 13:05:20', '2025-07-10 13:05:20'),
(42, 'Solwezi', '2025-07-10 13:05:28', '2025-07-10 13:05:28'),
(43, 'Zambezi', '2025-07-10 13:05:40', '2025-07-10 13:05:40'),
(44, 'Chembe Money Window', '2025-07-10 13:06:10', '2025-07-10 13:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_downloads`
--

CREATE TABLE `document_downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `downloaded_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_length` varchar(255) DEFAULT NULL,
  `video_thumbnail` varchar(255) NOT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `module_id`, `title`, `description`, `video_url`, `video_length`, `video_thumbnail`, `documents`, `created_at`, `updated_at`) VALUES
(6, 7, 'Know Your Customer (KYC) & Anti Money Laundering (AML)', 'The importance of KYC in the AML Programme', NULL, NULL, 'thumbnail/01JZSXN459DT3ZBNRSVSSFY2DQ.png', '[\"lessons\\/documents\\/KYC & AML Training 2025.pdf\"]', '2025-07-10 10:21:16', '2025-07-10 11:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_user_activities`
--

CREATE TABLE `lesson_user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_accessed_at` timestamp NULL DEFAULT NULL,
  `last_accessed_at` timestamp NULL DEFAULT NULL,
  `access_count` int(11) NOT NULL DEFAULT 0,
  `video_play_count` int(11) NOT NULL DEFAULT 0,
  `video_progress_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `video_watch_time_seconds` int(11) NOT NULL DEFAULT 0,
  `video_completed` tinyint(1) NOT NULL DEFAULT 0,
  `document_downloads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`document_downloads`)),
  `lesson_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_04_25_134311_create_roles_table', 1),
(3, '2024_04_25_134324_create_permissions_table', 1),
(4, '2024_05_19_105936_create_audit_trails_table', 1),
(5, '2024_05_19_120753_create_branches_table', 1),
(6, '2024_06_06_132639_create_quotes_table', 1),
(7, '2024_06_06_162201_create_modules_table', 1),
(8, '2024_06_06_162757_create_lessons_table', 1),
(9, '2024_06_10_073123_create_quizzs_table', 1),
(10, '2024_06_10_073952_create_attempt_answers_table', 1),
(11, '2024_06_10_083622_create_certificates_table', 1),
(12, '2024_09_24_195917_create_module_user_table', 1),
(13, '2024_09_25_100905_create_documents_table', 1),
(14, '2025_07_20_120915_enhance_user_activity_tracking_system', 2),
(15, '2025_07_20_122130_create_user_module_progress_table', 2),
(16, '2025_07_20_122131_create_lesson_user_activities_table', 2),
(17, '2025_07_20_122132_create_document_downloads_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Know Your Customer (KYC) & Anti Money Laundering (AML) Training 2025', 'thumbnail/01JZSXFVE881W5AKSE5AW2KZZP.png', 'The Importance of Know Your Customer (KYC) in the Anti-Money Laundering Programme', '2025-07-10 10:18:24', '2025-07-10 11:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `module_user`
--

CREATE TABLE `module_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_user`
--

INSERT INTO `module_user` (`id`, `user_id`, `module_id`, `created_at`, `updated_at`) VALUES
(22, 15, 7, NULL, NULL),
(23, 3, 7, NULL, NULL),
(24, 11, 7, NULL, NULL),
(25, 17, 7, NULL, NULL),
(26, 18, 7, NULL, NULL),
(27, 16, 7, NULL, NULL),
(28, 61, 7, NULL, NULL),
(29, 213, 7, NULL, NULL),
(30, 212, 7, NULL, NULL),
(31, 211, 7, NULL, NULL),
(32, 210, 7, NULL, NULL),
(33, 209, 7, NULL, NULL),
(34, 208, 7, NULL, NULL),
(35, 207, 7, NULL, NULL),
(36, 206, 7, NULL, NULL),
(37, 205, 7, NULL, NULL),
(38, 204, 7, NULL, NULL),
(39, 202, 7, NULL, NULL),
(40, 199, 7, NULL, NULL),
(41, 201, 7, NULL, NULL),
(42, 198, 7, NULL, NULL),
(43, 197, 7, NULL, NULL),
(44, 196, 7, NULL, NULL),
(45, 195, 7, NULL, NULL),
(46, 194, 7, NULL, NULL),
(47, 193, 7, NULL, NULL),
(48, 192, 7, NULL, NULL),
(49, 191, 7, NULL, NULL),
(50, 190, 7, NULL, NULL),
(51, 189, 7, NULL, NULL),
(52, 188, 7, NULL, NULL),
(53, 187, 7, NULL, NULL),
(54, 186, 7, NULL, NULL),
(55, 185, 7, NULL, NULL),
(56, 184, 7, NULL, NULL),
(57, 183, 7, NULL, NULL),
(58, 181, 7, NULL, NULL),
(59, 180, 7, NULL, NULL),
(60, 179, 7, NULL, NULL),
(61, 177, 7, NULL, NULL),
(62, 176, 7, NULL, NULL),
(63, 175, 7, NULL, NULL),
(64, 174, 7, NULL, NULL),
(65, 173, 7, NULL, NULL),
(66, 172, 7, NULL, NULL),
(67, 171, 7, NULL, NULL),
(68, 167, 7, NULL, NULL),
(69, 166, 7, NULL, NULL),
(70, 163, 7, NULL, NULL),
(71, 158, 7, NULL, NULL),
(72, 157, 7, NULL, NULL),
(73, 156, 7, NULL, NULL),
(74, 155, 7, NULL, NULL),
(75, 154, 7, NULL, NULL),
(76, 153, 7, NULL, NULL),
(77, 152, 7, NULL, NULL),
(78, 151, 7, NULL, NULL),
(79, 141, 7, NULL, NULL),
(80, 140, 7, NULL, NULL),
(81, 138, 7, NULL, NULL),
(82, 137, 7, NULL, NULL),
(83, 136, 7, NULL, NULL),
(84, 135, 7, NULL, NULL),
(85, 134, 7, NULL, NULL),
(86, 133, 7, NULL, NULL),
(87, 132, 7, NULL, NULL),
(88, 131, 7, NULL, NULL),
(89, 130, 7, NULL, NULL),
(90, 129, 7, NULL, NULL),
(91, 128, 7, NULL, NULL),
(92, 126, 7, NULL, NULL),
(93, 124, 7, NULL, NULL),
(94, 122, 7, NULL, NULL),
(95, 120, 7, NULL, NULL),
(96, 119, 7, NULL, NULL),
(97, 118, 7, NULL, NULL),
(98, 117, 7, NULL, NULL),
(99, 116, 7, NULL, NULL),
(100, 115, 7, NULL, NULL),
(101, 114, 7, NULL, NULL),
(102, 113, 7, NULL, NULL),
(103, 112, 7, NULL, NULL),
(104, 111, 7, NULL, NULL),
(105, 110, 7, NULL, NULL),
(106, 109, 7, NULL, NULL),
(107, 108, 7, NULL, NULL),
(108, 107, 7, NULL, NULL),
(109, 106, 7, NULL, NULL),
(110, 105, 7, NULL, NULL),
(111, 104, 7, NULL, NULL),
(112, 103, 7, NULL, NULL),
(113, 102, 7, NULL, NULL),
(114, 28, 7, NULL, NULL),
(115, 25, 7, NULL, NULL),
(116, 24, 7, NULL, NULL),
(117, 23, 7, NULL, NULL),
(118, 22, 7, NULL, NULL),
(119, 20, 7, NULL, NULL),
(120, 178, 7, NULL, NULL),
(121, 296, 7, NULL, NULL),
(122, 21, 7, NULL, NULL),
(123, 26, 7, NULL, NULL),
(124, 27, 7, NULL, NULL),
(125, 29, 7, NULL, NULL),
(126, 30, 7, NULL, NULL),
(127, 19, 7, NULL, NULL),
(128, 31, 7, NULL, NULL),
(129, 32, 7, NULL, NULL),
(130, 33, 7, NULL, NULL),
(131, 34, 7, NULL, NULL),
(132, 35, 7, NULL, NULL),
(133, 36, 7, NULL, NULL),
(134, 37, 7, NULL, NULL),
(135, 38, 7, NULL, NULL),
(136, 39, 7, NULL, NULL),
(137, 40, 7, NULL, NULL),
(138, 41, 7, NULL, NULL),
(139, 42, 7, NULL, NULL),
(140, 43, 7, NULL, NULL),
(141, 44, 7, NULL, NULL),
(142, 45, 7, NULL, NULL),
(143, 46, 7, NULL, NULL),
(144, 47, 7, NULL, NULL),
(145, 48, 7, NULL, NULL),
(146, 49, 7, NULL, NULL),
(147, 50, 7, NULL, NULL),
(148, 51, 7, NULL, NULL),
(149, 52, 7, NULL, NULL),
(150, 53, 7, NULL, NULL),
(151, 54, 7, NULL, NULL),
(152, 55, 7, NULL, NULL),
(153, 56, 7, NULL, NULL),
(154, 57, 7, NULL, NULL),
(155, 58, 7, NULL, NULL),
(156, 59, 7, NULL, NULL),
(157, 60, 7, NULL, NULL),
(158, 62, 7, NULL, NULL),
(159, 63, 7, NULL, NULL),
(160, 307, 7, NULL, NULL),
(161, 5, 7, NULL, NULL),
(162, 309, 7, NULL, NULL),
(163, 245, 7, NULL, NULL),
(164, 246, 7, NULL, NULL),
(165, 281, 7, NULL, NULL),
(166, 65, 7, NULL, NULL),
(167, 66, 7, NULL, NULL),
(168, 67, 7, NULL, NULL),
(169, 68, 7, NULL, NULL),
(170, 69, 7, NULL, NULL),
(171, 70, 7, NULL, NULL),
(172, 71, 7, NULL, NULL),
(173, 72, 7, NULL, NULL),
(174, 73, 7, NULL, NULL),
(175, 74, 7, NULL, NULL),
(176, 75, 7, NULL, NULL),
(177, 76, 7, NULL, NULL),
(178, 77, 7, NULL, NULL),
(179, 78, 7, NULL, NULL),
(180, 79, 7, NULL, NULL),
(181, 80, 7, NULL, NULL),
(182, 81, 7, NULL, NULL),
(183, 82, 7, NULL, NULL),
(184, 83, 7, NULL, NULL),
(185, 84, 7, NULL, NULL),
(186, 85, 7, NULL, NULL),
(187, 86, 7, NULL, NULL),
(188, 87, 7, NULL, NULL),
(189, 88, 7, NULL, NULL),
(190, 89, 7, NULL, NULL),
(191, 90, 7, NULL, NULL),
(192, 91, 7, NULL, NULL),
(193, 92, 7, NULL, NULL),
(194, 93, 7, NULL, NULL),
(195, 94, 7, NULL, NULL),
(196, 95, 7, NULL, NULL),
(197, 96, 7, NULL, NULL),
(198, 97, 7, NULL, NULL),
(199, 98, 7, NULL, NULL),
(200, 99, 7, NULL, NULL),
(201, 100, 7, NULL, NULL),
(202, 101, 7, NULL, NULL),
(203, 121, 7, NULL, NULL),
(204, 123, 7, NULL, NULL),
(205, 127, 7, NULL, NULL),
(206, 125, 7, NULL, NULL),
(207, 139, 7, NULL, NULL),
(208, 142, 7, NULL, NULL),
(209, 143, 7, NULL, NULL),
(210, 144, 7, NULL, NULL),
(211, 145, 7, NULL, NULL),
(212, 159, 7, NULL, NULL),
(213, 160, 7, NULL, NULL),
(214, 146, 7, NULL, NULL),
(215, 147, 7, NULL, NULL),
(216, 148, 7, NULL, NULL),
(217, 164, 7, NULL, NULL),
(218, 149, 7, NULL, NULL),
(219, 161, 7, NULL, NULL),
(220, 150, 7, NULL, NULL),
(221, 162, 7, NULL, NULL),
(222, 165, 7, NULL, NULL),
(223, 168, 7, NULL, NULL),
(224, 169, 7, NULL, NULL),
(225, 170, 7, NULL, NULL),
(226, 182, 7, NULL, NULL),
(227, 200, 7, NULL, NULL),
(228, 308, 7, NULL, NULL),
(229, 203, 7, NULL, NULL),
(230, 214, 7, NULL, NULL),
(231, 215, 7, NULL, NULL),
(232, 216, 7, NULL, NULL),
(233, 217, 7, NULL, NULL),
(234, 218, 7, NULL, NULL),
(235, 219, 7, NULL, NULL),
(236, 220, 7, NULL, NULL),
(237, 221, 7, NULL, NULL),
(238, 222, 7, NULL, NULL),
(239, 223, 7, NULL, NULL),
(240, 224, 7, NULL, NULL),
(241, 225, 7, NULL, NULL),
(242, 226, 7, NULL, NULL),
(243, 306, 7, NULL, NULL),
(244, 305, 7, NULL, NULL),
(245, 304, 7, NULL, NULL),
(246, 295, 7, NULL, NULL),
(247, 303, 7, NULL, NULL),
(248, 302, 7, NULL, NULL),
(249, 301, 7, NULL, NULL),
(250, 294, 7, NULL, NULL),
(251, 300, 7, NULL, NULL),
(252, 299, 7, NULL, NULL),
(253, 298, 7, NULL, NULL),
(254, 297, 7, NULL, NULL),
(255, 227, 7, NULL, NULL),
(256, 293, 7, NULL, NULL),
(257, 228, 7, NULL, NULL),
(258, 229, 7, NULL, NULL),
(259, 230, 7, NULL, NULL),
(260, 231, 7, NULL, NULL),
(261, 232, 7, NULL, NULL),
(262, 233, 7, NULL, NULL),
(263, 234, 7, NULL, NULL),
(264, 235, 7, NULL, NULL),
(265, 236, 7, NULL, NULL),
(266, 237, 7, NULL, NULL),
(267, 238, 7, NULL, NULL),
(268, 239, 7, NULL, NULL),
(269, 240, 7, NULL, NULL),
(270, 241, 7, NULL, NULL),
(271, 242, 7, NULL, NULL),
(272, 243, 7, NULL, NULL),
(273, 244, 7, NULL, NULL),
(274, 247, 7, NULL, NULL),
(275, 248, 7, NULL, NULL),
(276, 249, 7, NULL, NULL),
(277, 250, 7, NULL, NULL),
(278, 251, 7, NULL, NULL),
(279, 252, 7, NULL, NULL),
(280, 253, 7, NULL, NULL),
(281, 254, 7, NULL, NULL),
(282, 255, 7, NULL, NULL),
(283, 256, 7, NULL, NULL),
(284, 257, 7, NULL, NULL),
(285, 258, 7, NULL, NULL),
(286, 259, 7, NULL, NULL),
(287, 260, 7, NULL, NULL),
(288, 261, 7, NULL, NULL),
(289, 262, 7, NULL, NULL),
(290, 263, 7, NULL, NULL),
(291, 264, 7, NULL, NULL),
(292, 265, 7, NULL, NULL),
(293, 266, 7, NULL, NULL),
(294, 267, 7, NULL, NULL),
(295, 292, 7, NULL, NULL),
(296, 268, 7, NULL, NULL),
(297, 291, 7, NULL, NULL),
(298, 290, 7, NULL, NULL),
(299, 289, 7, NULL, NULL),
(300, 288, 7, NULL, NULL),
(301, 287, 7, NULL, NULL),
(302, 286, 7, NULL, NULL),
(303, 285, 7, NULL, NULL),
(304, 284, 7, NULL, NULL),
(305, 283, 7, NULL, NULL),
(306, 282, 7, NULL, NULL),
(307, 280, 7, NULL, NULL),
(308, 279, 7, NULL, NULL),
(309, 278, 7, NULL, NULL),
(310, 277, 7, NULL, NULL),
(311, 276, 7, NULL, NULL),
(312, 275, 7, NULL, NULL),
(313, 274, 7, NULL, NULL),
(314, 273, 7, NULL, NULL),
(315, 272, 7, NULL, NULL),
(316, 271, 7, NULL, NULL),
(317, 270, 7, NULL, NULL),
(318, 269, 7, NULL, NULL);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) NOT NULL,
  `create` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `module`, `create`, `read`, `update`, `delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Assigned Module', 1, 1, 1, 1, NULL, NULL),
(2, 1, 'QuizScore', 1, 1, 1, 1, NULL, NULL),
(3, 1, 'Module', 1, 1, 1, 1, NULL, NULL),
(4, 1, 'Lesson', 1, 1, 1, 1, NULL, NULL),
(5, 1, 'Quiz', 1, 1, 1, 1, NULL, NULL),
(6, 1, 'User', 1, 1, 1, 1, NULL, NULL),
(7, 1, 'Branch', 1, 1, 1, 1, NULL, NULL),
(8, 2, 'Assigned Module', 1, 1, 1, 1, NULL, NULL),
(9, 2, 'QuizScore', 0, 0, 0, 0, NULL, NULL),
(10, 2, 'Module', 0, 0, 0, 0, NULL, NULL),
(11, 2, 'Lesson', 0, 0, 0, 0, NULL, NULL),
(12, 2, 'Quiz', 0, 0, 0, 0, NULL, NULL),
(13, 2, 'User', 0, 0, 0, 0, NULL, NULL),
(14, 2, 'Branch', 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizzs`
--

CREATE TABLE `quizzs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `question_image` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `answer_option_a` text NOT NULL,
  `answer_option_b` text NOT NULL,
  `answer_option_c` text NOT NULL,
  `answer_option_d` text NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzs`
--

INSERT INTO `quizzs` (`id`, `lesson_id`, `question`, `question_image`, `correct_answer`, `answer_option_a`, `answer_option_b`, `answer_option_c`, `answer_option_d`, `duration`, `created_at`, `updated_at`) VALUES
(1, 2, '1.	Money laundering means the process whereby criminals attempt to hide and disguise the true origin and ownership of the proceeds of their criminal activities', NULL, 'A', 'True', 'False', 'True', 'False', '4', '2024-11-12 09:28:43', '2024-11-12 09:28:43'),
(2, 2, 'The 3 stages of Money Laundering are placement, layering and integration.', NULL, 'A', 'True', 'False', 'True', 'False', '4', '2024-11-12 09:28:43', '2024-11-12 09:28:43'),
(3, 1, 'What do you understand by the term money laundering?', NULL, 'C', ' The process of legally earning money through hard work and investment', 'he act of printing counterfeit currency for circulation', 'The process of concealing the origins of illegally obtained money, typically by passing it through complex financial transactions', 'A government-approved method of reducing taxes on income', '4', '2025-06-18 10:11:06', '2025-06-18 10:11:06'),
(4, 6, '1.What does AML stand for?', NULL, 'B', 'Anti-Money Lending', 'Anti-Money Laundering', 'Account Management Law', 'Authorized Money Law', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(5, 6, '2. Money laundering typically involves how many stages?', NULL, 'C', 'One', 'Two', 'Three', 'Four', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(6, 6, '3. Which of these is considered the first stage of money laundering?', NULL, 'A', 'Placement', 'Layering', 'Integration', 'Structuring', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(7, 6, '4. Who is responsible for reporting suspicious activity?', NULL, 'C', 'Only senior management', 'Only the Compliance Officer', 'Every employee', 'Only the customer service team', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(8, 6, '5. What does KYC stand for?', NULL, 'A', 'Know Your Customer', 'Keep Your Cash', 'Know Your Country', 'Key Yearly Compliance', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(9, 6, '6. Why is KYC important?', NULL, 'C', 'It helps sell more products', 'It reduces customer service workload', 'It helps identify and prevent financial crime', 'It increases profit', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(10, 6, '7. Which of the following is a method of verifying identity under KYC?', NULL, 'B', 'Asking for the customer\'s favorite color', 'Reviewing a valid passport or ID', 'Watching the customer\'s social media', 'Checking their email signature', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(11, 6, '8. Why is documentation important in AML compliance?', NULL, 'C', 'To decorate the office', 'For historical reference only', 'For regulatory and audit purposes', 'To slow down operations', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(12, 6, '9. What does PIP stand for in AML context?', NULL, 'B', 'Politically Influential People', 'Prominent Influential Person', 'Public Procurement Plan', 'Permanent International Profile', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45'),
(13, 6, '10. How should suspicious customer behavior be handled?', NULL, 'C', 'Ignore it', 'Discuss it with a colleague', 'Report it confidentially', 'Inform the customer directly', '4', '2025-07-10 10:58:45', '2025-07-10 10:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `created_at`, `updated_at`) VALUES
(1, 'Effective AML programs are essential for maintaining the integrity of financial systems.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(2, 'Transaction monitoring is a critical component of a bank\'s AML strategy.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(3, 'Compliance with AML regulations helps prevent financial crime.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(4, 'Monitoring transactions helps detect suspicious activities in real-time.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(5, 'AML policies protect banks from being used as conduits for money laundering.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(6, 'Regulatory compliance is crucial for banks to avoid hefty fines.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(7, 'AML systems should be robust and adaptable to emerging threats.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(8, 'Continuous training is vital for effective AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(9, 'Technology plays a significant role in modern AML solutions.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(10, 'Customer due diligence is the first step in AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(11, 'Banks must report any suspicious transactions to relevant authorities.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(12, 'AML compliance helps build trust with customers and regulators.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(13, 'Transaction monitoring systems should be regularly updated.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(14, 'Effective AML practices can deter criminals from using banking channels.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(15, 'Know Your Customer (KYC) is a cornerstone of AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(16, 'Real-time transaction monitoring can prevent fraudulent activities.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(17, 'AML compliance requires cooperation between banks and regulatory bodies.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(18, 'Banks must maintain detailed records of customer transactions.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(19, 'AML policies should be tailored to the bank\'s risk profile.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(20, 'Regular audits are essential for ensuring AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(21, 'Transaction monitoring helps identify patterns indicative of money laundering.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(22, 'Banks should invest in advanced analytics for AML purposes.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(23, 'AML compliance is an ongoing process, not a one-time effort.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(24, 'Risk-based approach is fundamental in AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(25, 'Financial institutions must stay updated on AML regulations.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(26, 'Suspicious Activity Reports (SARs) are crucial in AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(27, 'Banks must implement effective internal controls for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(28, 'Cross-border transactions require heightened AML vigilance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(29, 'Continuous improvement is key in AML compliance programs.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(30, 'AML programs must be comprehensive and well-documented.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(31, 'Transaction monitoring systems should be able to handle large volumes of data.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(32, 'AML compliance is essential for the bank\'s reputation.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(33, 'Effective AML programs require top-down commitment from the bank\'s leadership.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(34, 'Regulatory penalties for non-compliance can be severe.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(35, 'AML systems must adapt to changing regulatory requirements.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(36, 'Collaboration with law enforcement is vital for AML efforts.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(37, 'Banks should leverage AI and machine learning for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(38, 'Transparency in transactions is essential for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(39, 'Effective AML programs require a combination of technology and human oversight.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(40, 'AML compliance helps safeguard the global financial system.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(41, 'Transaction monitoring should cover all types of transactions.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(42, 'Banks must ensure their AML systems are user-friendly and efficient.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(43, 'AML compliance involves both detection and prevention of money laundering.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(44, 'Regulatory bodies provide guidelines for effective AML practices.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(45, 'Banks must conduct regular risk assessments for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(46, 'AML regulations vary across different jurisdictions.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(47, 'Employee awareness and training are crucial for AML success.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(48, 'Banks must establish clear policies and procedures for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(49, 'AML compliance requires accurate and timely data collection.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(50, 'Effective AML programs protect banks from reputational damage.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(51, 'AML technology should be scalable and flexible.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(52, 'Banks must perform enhanced due diligence for high-risk customers.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(53, 'Transaction monitoring helps uncover hidden patterns of illicit activities.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(54, 'AML programs should include regular testing and validation.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(55, 'Banks must report AML compliance to regulatory authorities periodically.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(56, 'AML systems should integrate seamlessly with other banking systems.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(57, 'Customer segmentation can enhance the effectiveness of AML monitoring.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(58, 'Regulatory frameworks provide a baseline for AML programs.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(59, 'AML compliance is critical for the long-term sustainability of banks.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(60, 'Banks must prioritize AML in their strategic planning.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(61, 'Effective AML programs can reduce the risk of financial crime.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(62, 'Transaction monitoring systems should support real-time alerts.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(63, 'Banks must ensure data privacy while implementing AML measures.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(64, 'AML compliance helps prevent the financing of terrorism.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(65, 'Transaction monitoring should be risk-based and adaptive.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(66, 'Banks must collaborate with each other to combat money laundering.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(67, 'Effective AML requires a combination of prevention, detection, and reporting.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(68, 'Regular updates and maintenance of AML systems are necessary.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(69, 'AML programs must align with international standards and regulations.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(70, 'Transaction monitoring helps protect the bank\'s assets.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(71, 'AML compliance is a key aspect of corporate governance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(72, 'Banks must ensure all employees understand their AML responsibilities.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(73, 'Effective AML programs require a proactive approach.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(74, 'Technology advancements are reshaping AML practices.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(75, 'Banks must conduct ongoing due diligence for existing customers.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(76, 'AML systems should be able to identify unusual transaction patterns.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(77, 'Banks must keep abreast of emerging money laundering techniques.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(78, 'Compliance officers play a critical role in AML efforts.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(79, 'AML compliance helps maintain market integrity.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(80, 'Transaction monitoring should be both comprehensive and precise.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(81, 'Banks must ensure their AML measures are cost-effective.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(82, 'AML regulations help create a level playing field in the financial sector.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(83, 'Effective AML programs enhance customer confidence.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(84, 'Banks should use predictive analytics to improve AML efforts.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(85, 'AML compliance requires robust data management practices.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(86, 'Transaction monitoring systems should be customizable.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(87, 'Banks must regularly review and update their AML policies.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(88, 'Effective AML programs can mitigate legal and regulatory risks.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(89, 'Transaction monitoring should be integrated with other compliance systems.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(90, 'AML compliance is essential for financial stability.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(91, 'Banks must foster a culture of compliance to succeed in AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(92, 'Technology can help automate many aspects of AML compliance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(93, 'AML programs should be designed to detect and deter money laundering.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(94, 'Banks must provide regular AML training to their employees.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(95, 'Effective AML requires strong internal controls and governance.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(96, 'Banks must ensure transparency in their AML reporting.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(97, 'AML compliance involves continuous monitoring and reporting.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(98, 'Banks should invest in cutting-edge technology for AML.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(99, 'Effective AML programs can enhance operational efficiency.', '2024-10-31 21:07:57', '2024-10-31 21:07:57'),
(100, 'Transaction monitoring is a vital tool in the fight against financial crime.', '2024-10-31 21:07:57', '2024-10-31 21:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Administration', 0, '2024-10-31 21:07:59', '2024-10-31 21:07:59'),
(2, 'Compliance', 0, '2024-10-31 21:07:59', '2024-10-31 21:07:59');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_id`, `branch_id`, `updated_by`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'Admin', 'admin@natsave.co.zm', NULL, '$2y$12$y4E3oBCGnTrmBhnBukZlguZuGZXE4v1TdpnOIZ1ij91KeoDav9PUm', 'BzATtYAhhqKKnXS03AvRcg7KAyEImkEK3cFfIj7XqXeYpjaKh2rN7UMSZRvs', '2024-10-31 21:07:58', '2025-06-18 09:53:33'),
(2, 1, 2, 1, NULL, 'Blessmore Mulenga', 'blessmore@ontech.co.zm', NULL, '$2y$12$GjONNX1m5FfRZWiI.DcIxOSPODPH3vDiH6oFZ/y289vse2bLuuFUO', NULL, '2024-10-31 21:07:58', '2024-12-06 11:50:18'),
(3, 2, 3, 4, NULL, 'Nickson Mulila', 'Nickson.Mulila@natsave.co.zm', NULL, '$2y$12$s9z37U.u2A4IbVFKnsUJmuAseaTfP1SIlWd9EmWDN8tHAtxxelgci', 'ekEFmI8o26osgIYdjhXHSrVTM8DahHdiqP65glPUU9gWU9GjTzChDSkOpoQH', '2024-10-31 21:07:58', '2025-07-10 11:14:07'),
(4, 1, 4, 1, NULL, 'Chapwe Telebwe', 'Chapwe.Telebwe@natsave.co.zm', NULL, '$2y$12$hcxIl899i.dXh7vhkvDAmO7fmIrJyaR55cZdP0ppChYJgUc2UCvEy', NULL, '2024-10-31 21:07:58', '2024-10-31 21:07:58'),
(5, 1, 5, 4, NULL, 'Munune Mainza', 'Munene.Mainza@natsave.co.zm', NULL, '$2y$12$BV2JnZrxgnNyYFfj5k3bxuPsdLRHx93wQ8sMJSXJuIDJ9Li38aU4m', '3JbDUBjWV2a9JL0nin0SVtJtrizjt4oStv1p5M5mSCmuhzkSwlX9sViMWmIg', '2024-10-31 21:07:58', '2025-07-17 15:35:52'),
(6, 2, 6, 1, NULL, 'Niza Shakspuku', 'Niza.Shakapuku@natsave.co.zm', NULL, '$2y$12$QIOeXTDlMa6VS.Kul0om.OWhj4aNokeWoowwrvSBRmSNZmhKGAdHu', NULL, '2024-10-31 21:07:59', '2024-10-31 21:07:59'),
(7, 2, 6, 1, NULL, 'Sepiso', 'sepiso@natsave.co.zm', NULL, '$2y$12$xoPEkfGyyXYpSeEhMA1aFOxa.WAFpAhvjNd4mZZMtr/MqHcSMDrM.', NULL, '2024-10-31 21:07:59', '2024-10-31 21:07:59'),
(8, 2, 5, 1, NULL, 'Harriet Nalungwe', 'Harriet.Nalungwe@natsave.co.zm', NULL, '$2y$12$RnpK6yoa4VtIgpyEekKfNuwAblyO/ftiB8fcZZAYguuzmoFMqnaVO', NULL, '2024-11-12 09:31:12', '2024-11-12 09:31:12'),
(11, 1, 5, 4, NULL, 'Vivien Dube', 'Vivien.Dube@natsave.co.zm', NULL, '$2y$12$8UfmTZaZRtbkJNb1RoqXAue7QHaOt7aIhpa.7v7Ze9W1qbdtD9GEK', 'HuL88GWIqgu8EJBubUEdLwjyJjwiSwx7lXcwlwkGOjP1e767KaZXm6hW3fEc', '2025-04-02 11:20:14', '2025-07-17 13:50:25'),
(15, 1, 5, 4, NULL, 'Lukundo Siame', 'Lukundo.Siame@natsave.co.zm', NULL, '$2y$12$O6Md1H6qAw4PG8fEYAz2L.HKZWwgQhs6C8Yp9Owv/te/y4zbaq6gK', 'iwZ7UMnFTJwaDbEfjK4jwaBGhFGt3WHudmnkP7Fl3MwIrdemQnFwVSikzpxs', '2025-07-10 11:03:53', '2025-07-10 13:24:03'),
(16, 1, 5, 4, NULL, 'Lupondo Maninga', 'Lupondo.Maninga@natsave.co.zm', NULL, '$2y$12$czdmGLXXJVHMlZ4JNTtpj.ZOEa.1eNml7QbWDn8bOZfgRFT46EAze', NULL, '2025-07-10 13:26:42', '2025-07-10 13:26:42'),
(17, 1, 5, 4, NULL, 'Berlin Chivunga', 'Berlin.Chivunga@natsave.co.zm', NULL, '$2y$12$p/Gq4n3adIxDFfWbkwptA.sQ3EhLgLq3jI8AqP.oi.mi1wvizAp0.', 'W5zjz84gOWzknKNZUGlELSbglMqWQthvoYDXJdfy0ghgVfFOg5Q6F3dGdtOe', '2025-07-10 13:28:14', '2025-07-10 13:28:14'),
(18, 2, 15, 10, NULL, 'Adam Chabala', 'Adam.Chabala@natsave.co.zm', NULL, '$2y$12$QLcKmV89mfTApCLz9cRxlOuNrWzUks67uMX/DVkT6go9sD0nPtHxa', NULL, '2025-07-10 13:36:43', '2025-07-10 13:36:43'),
(19, 2, 15, 5, NULL, 'Amos Kaluba', 'Amos.Kaluba@natsave.co.zm', NULL, '$2y$12$T0nEr3uMPulwRT22PrwDtOU6yof9AsC1uIs91p/PmvO6vbUgHIz0e', NULL, '2025-07-10 13:53:00', '2025-07-10 13:53:00'),
(20, 2, 17, 33, NULL, 'KINGSLEY NYAMBE', 'Kingsley.Nyambe@natsave.co.zm', NULL, '$2y$12$oi8zR/NtiTIBwUTG5DOOueepehQy4hqy2YvRBNAV3NwfFsgCw8MiW', NULL, '2025-07-10 13:56:49', '2025-07-10 13:56:49'),
(21, 2, 16, 15, NULL, 'ELIOUS NYIRENDA', 'Elious.Nyirenda@natsave.co.zm', NULL, '$2y$12$w0uJ1KJc8mjQ5YLlUydUl.5K9dzzdCV3DU5VOBLum7G5DjIA36Zoi', NULL, '2025-07-10 14:00:50', '2025-07-10 14:00:50'),
(22, 2, 17, 33, NULL, 'BETTY MUSHAUKWA', 'Betty.Mushaukwa@natsave.co.zm', NULL, '$2y$12$pzplUsfpIZ.ddhAPymg/0OX/SvHRR5x9Pe/HLYtNqBPklhhTyPOYS', NULL, '2025-07-10 14:03:10', '2025-07-10 14:03:10'),
(23, 2, 17, 33, NULL, 'Hellen Mungulunga', 'hellen.mungulunga@natsave.co.zm', NULL, '$2y$12$O7ZhC6fZY146T5S4I55bNuYNxdyLOoCf1jYrs.Bu/.7A9geCY5D7W', NULL, '2025-07-10 14:08:10', '2025-07-10 14:08:10'),
(24, 2, 17, 33, NULL, 'Deberah Mutale', 'deborah.mutale@natsave.co.zm', NULL, '$2y$12$C6U/6OMe9UnjUBGaHuoj9uLWwhkx9SEV.iWTmdxmHssh8vq.KFpw.', NULL, '2025-07-10 14:09:52', '2025-07-10 14:09:52'),
(25, 2, 17, 33, NULL, 'Mukumwa Mwikisa', 'Mukumwa.Mwikisa@natsave.co.zm', NULL, '$2y$12$f2J3/Z9ryVFzmqIiQCIF3uAYYdZ69WSWKOUZVSQAiXJ5HngmmG/aa', NULL, '2025-07-10 14:12:03', '2025-07-10 14:12:03'),
(26, 2, 15, 5, NULL, 'Martha Tembo', 'Martha.Tembo@natsave.co.zm', NULL, '$2y$12$MLSxcwGVbdeufyGZZqf92uXd.HLTglBi7jBw0cIIl2ODWB7mmbSCC', NULL, '2025-07-10 14:12:49', '2025-07-10 14:12:49'),
(27, 2, 15, 5, NULL, 'CATHERINE SHAANGA', 'Catherine.Shaanga@natsave.co.zm', NULL, '$2y$12$dlc.ccm8J2e2lUHnr4YHjuZ09Y.bQs3mXHmYxYGInn4IB12cT33xO', NULL, '2025-07-10 14:13:34', '2025-07-10 14:13:34'),
(28, 2, 17, 33, NULL, 'Martin Dzekedzeke', 'Martin.Dzekedzeke@natsave.co.zm', NULL, '$2y$12$Qjn.YswhofXAbmIbUxToIupVddqJZNEMZhc1bfpHaazaQTHzXE.uC', NULL, '2025-07-10 14:13:45', '2025-07-10 14:13:45'),
(29, 2, 15, 5, NULL, 'ERIC KUNDA', 'Eric.Kunda@natsave.co.zm', NULL, '$2y$12$vypO/w8vbDX868YobogNJeeYppGLsvaLXQgn0Q21PiYGwSr4xv6ni', NULL, '2025-07-10 14:14:19', '2025-07-10 14:14:19'),
(30, 2, 15, 5, NULL, 'CHIMWEMWE NGOMA', 'Chimwemwe.Ngoma@natsave.co.zm', NULL, '$2y$12$sxJX4BkVDnvgiHW9rkY7LuvgqE76BrV/7D/UOS2BGKHJKJ9g41oLq', NULL, '2025-07-10 14:15:17', '2025-07-10 14:15:17'),
(31, 2, 15, 5, NULL, 'MALILWE MWEENE', 'Malilwe.Mweene@natsave.co.zm', NULL, '$2y$12$Q1hw5VqgfK4ZQm9IOnh7CuKiiQv7EgoHiy2ssbkSkqMUMxLf4McHm', NULL, '2025-07-10 14:16:39', '2025-07-10 14:16:39'),
(32, 2, 15, 5, NULL, 'BECILIA MUNDAILA', 'Becilia.Mundaila@natsave.co.zm', NULL, '$2y$12$LCO7aB.1GRLEaR.0e.V2rOyYWBQglUabtvpVuWlYT9GtHrRSM5JUe', NULL, '2025-07-10 14:17:29', '2025-07-10 14:17:29'),
(33, 2, 15, 5, NULL, 'VICTOR MWAZI', 'Victor.Mwazi@natsave.co.zm', NULL, '$2y$12$1NOeBlmLvAsH9BAFjsERD.REGrqCx5t6g4mHR3uE5GOwWX1ADj2RW', NULL, '2025-07-10 14:18:43', '2025-07-10 14:18:43'),
(34, 2, 15, 6, NULL, 'MONICA BANDA', 'Monica.Banda@natsave.co.zm', NULL, '$2y$12$6SkzqsZhn8pTC8FlA9aLNu3XZHRlQaPlXIgJeT1amBrP45cttfY/q', NULL, '2025-07-10 14:19:47', '2025-07-10 14:19:47'),
(35, 2, 15, 6, NULL, 'GABRIEL MUKUMBI', 'Gabriel.Mukumbi@natsave.co.zm', NULL, '$2y$12$gyv4ZR2vpV1Q50D/heYDWOC1APU8kEdd3KBoaEGEhnXOsrcM1sZfu', NULL, '2025-07-10 14:20:21', '2025-07-10 14:20:21'),
(36, 2, 15, 6, NULL, 'LOTTIE ZIMBA', 'Lottie.Zimba@natsave.co.zm', NULL, '$2y$12$pyt/UW5dgVKTYhw5d9YLJ.cgaqrNuIk3NCLBa/oQJp2Kd3V1xVrm6', NULL, '2025-07-10 14:20:53', '2025-07-10 14:20:53'),
(37, 2, 15, 6, NULL, 'NGANDWE SENDAPU', 'Ngandwe.Sendapu@natsave.co.zm', NULL, '$2y$12$jr8E98v9cE.N6E5nmQyRauZKIw2V/UiFVdGB2NZML5PyI6WPDZEHS', NULL, '2025-07-10 14:21:55', '2025-07-10 14:21:55'),
(38, 2, 15, 6, NULL, 'VIOLET MWANZA', 'Violet.Mwanza@natsave.co.zm', NULL, '$2y$12$iEF05PhhigPI7dXKYywAMOBUaLVo8jr4FYF2DTgL9oUZ0w4ShcQhu', NULL, '2025-07-10 14:22:30', '2025-07-10 14:22:30'),
(39, 2, 15, 6, NULL, 'MWANGALA MUMBULA', 'Mwangala.Mumbula@natsave.co.zm', NULL, '$2y$12$5C2ddtfIo6S8CYPxrTTxreDtPDChikmDtC5.POGInf0JKbfxmYIQy', NULL, '2025-07-10 14:23:23', '2025-07-10 14:23:23'),
(40, 2, 15, 33, NULL, 'PATIENCE MUMBA', 'Patience.Mumba@natsave.co.zm', NULL, '$2y$12$2xnO4FX98WWjy/HRlA.rueVs3kj0LNKMb5fq5JSyad7dQgz29sDqO', NULL, '2025-07-10 14:24:15', '2025-07-10 14:24:15'),
(41, 2, 15, 6, NULL, 'SHEBA KABIKA', 'Sheba.Kabika@natsave.co.zm', NULL, '$2y$12$MA/EwwcsTuq3.wx3Tw47iuQ1L99SKOQUScXPhhcPfDia47gSSM0QK', NULL, '2025-07-10 14:25:05', '2025-07-10 14:25:05'),
(42, 2, 15, 26, NULL, 'CHILILA KASHIMBAYA', 'Chilila.Kashimbaya@natsave.co.zm', NULL, '$2y$12$73RHcPQB8ddrXSR/VEwWeukAk5C.p.mDpyz1COTg0q.zkAR6Uh6Wa', NULL, '2025-07-10 14:26:19', '2025-07-10 14:26:19'),
(43, 2, 15, 26, NULL, 'KALUKEKI SAYA', 'Kalukaku.Saya@natsave.co.zm', NULL, '$2y$12$r6yHUzeOKCqiq/EzUUfDDutdqmYVzkQahs2YIVkxjTuAvZLKmOMWi', NULL, '2025-07-10 14:27:36', '2025-07-10 14:27:36'),
(44, 2, 15, 26, NULL, 'QUEEN NACHILIMA', 'Queen.Nachilima@natsave.co.zm', NULL, '$2y$12$QvvatcasWCyw//ka1xB2Z.WEkJLjwqKEO/0FzQ2KUeQQCrMdGD5Mu', NULL, '2025-07-10 14:28:22', '2025-07-10 14:28:22'),
(45, 2, 15, 26, NULL, 'ROSE MULENGA', 'Rose.Mulenga@natsave.co.zm', NULL, '$2y$12$/2yJCRP5INDhQWdGgYlOIO1jZw4/uUu774H0E03sdQ5E805Z5FtE2', NULL, '2025-07-10 14:39:56', '2025-07-10 14:39:56'),
(46, 2, 15, 26, NULL, 'MARTHA SIMWANZA', 'Martha.Simwanza@natsave.co.zm', NULL, '$2y$12$GUJO5REtLWzIyVO/wHXwCe0sd.ks9U9CPq3VsmSdQuloJh0D72ajq', NULL, '2025-07-10 14:41:56', '2025-07-10 14:41:56'),
(47, 2, 15, 44, NULL, 'LEAH NACHILYANGO', 'Leah.Nachilyango@natsave.co.zm', NULL, '$2y$12$33MWnYzsO.monNldaDF/cu6hPOhZUKrwOocL.1RCJV2Vt3F4Ao1sa', NULL, '2025-07-10 14:43:13', '2025-07-10 14:43:13'),
(48, 2, 15, 44, NULL, 'MISHECK LWANDO', 'Misheck.Lwando@natsave.co.zm', NULL, '$2y$12$.eAWyIW./PNgNivmtGoUP.yh6pKACx8mU0R7HBosogRhLt.4A3QeG', NULL, '2025-07-10 14:44:18', '2025-07-10 14:44:18'),
(49, 2, 15, 44, NULL, 'SUWILANJI NAMUCHIMBA', 'Suwilanji.Namuchimba@natsave.co.zm', NULL, '$2y$12$6KL8AcobqP3DpWl5ZkQ0T.0rJ2eysTbTVJg0GcGO/ZqnTE/c18Qvy', NULL, '2025-07-10 14:45:34', '2025-07-10 14:45:34'),
(50, 2, 15, 25, NULL, 'PENELOPE MUSUKWA', 'Penelope.Musukwa@natsave.co.zm', NULL, '$2y$12$Ot1GEF.ozy2SgMZ60pdp6edfOAGjr6c7p49LVedx2LcsKGcwwv.Oa', NULL, '2025-07-10 14:47:25', '2025-07-10 14:47:25'),
(51, 2, 15, 25, NULL, 'HELLEN BULAKA', 'Hellen.Bulaka@natsave.co.zm', NULL, '$2y$12$yeDoZKdMPa1hzvfxMD3lde8QB8Q2OnUzNi/.BSt5WchKNJfF6IOEO', NULL, '2025-07-10 14:48:21', '2025-07-10 14:48:21'),
(52, 2, 15, 25, NULL, 'BWALYA SICHULA', 'Bwalya.Sichula@natsave.co.zm', NULL, '$2y$12$bThMUbY9luygPZmxtomBV.Wq119cNfUBzhW4Bve4BgB2nOUbYwfzm', NULL, '2025-07-10 14:49:04', '2025-07-10 14:49:04'),
(53, 2, 15, 25, NULL, 'ZOOLE ZYAMBO', 'Zoole.Zyambo@natsave.co.zm', NULL, '$2y$12$uQTcnufkSnRd.pgndEMGtOsItP47otmjKBcECp40ltx8H.1R16U8.', NULL, '2025-07-10 14:50:49', '2025-07-10 14:50:49'),
(54, 2, 15, 25, NULL, 'JOHN BWALYA', 'John.Bwalya@natsave.co.zm', NULL, '$2y$12$sbbtzT1LWGHlbDP9/XyYV.wvogwPdk4pWxuiDtJ9ueb2m6cBVshw6', NULL, '2025-07-10 14:51:41', '2025-07-10 14:51:41'),
(55, 2, 15, 25, NULL, 'APHIA MUNANGONGWE', 'Aphia.Munangongwe@natsave.co.zm', NULL, '$2y$12$xjfjiquF/UngfjDGJbBQdey7Q.Npt0iKC48DxZf5rohmAiB.aTv8u', NULL, '2025-07-10 14:53:25', '2025-07-10 14:53:25'),
(56, 2, 15, 25, NULL, 'AGATHA CHINGAIPE', 'Agatha.Chingaipe@natsave.co.zm', NULL, '$2y$12$nqNCWKYwMfSGq34fF6d4B.Zm6VS2ieVhxa/ZudmCmPnh2rep0anqu', NULL, '2025-07-10 14:54:03', '2025-07-10 14:54:03'),
(57, 2, 15, 7, NULL, 'JAMES KOMBE', 'James.Kombe@natsave.co.zm', NULL, '$2y$12$vdZ2EXO0l6Pze0qbs5R.6uch9NmIsLegfxEod4ibtOtP7/XOQ/Jzu', NULL, '2025-07-10 14:54:41', '2025-07-10 14:54:41'),
(58, 2, 15, 7, NULL, 'MILLICENT SIMATAA', 'Millicent.Simataa@natsave.co.zm', NULL, '$2y$12$qrqpwY5KB9ggKjF4eabhquXrnZUatmBESKYBEU2p9IVHj7JdZd7Fu', NULL, '2025-07-10 14:55:42', '2025-07-10 14:55:42'),
(59, 2, 15, 7, NULL, 'EVERISTO CHINYIMBA', 'Everisto.Chinyimba@natsave.co.zm', NULL, '$2y$12$Rxni0Y2eP64ddmu0vjUYN./dLlUDt.Jyp656fHIy5eDuMJl3xrCK.', NULL, '2025-07-10 14:56:50', '2025-07-10 14:56:50'),
(60, 2, 15, 7, NULL, 'CYNTHIA MUBIANA', 'Cynthia.Mubiana@natsave.co.zm', NULL, '$2y$12$1uZgUM.d.YmF9FTB5nbU6evSvDtUImPzkAiiv0HgGt1H2PHdcvcty', NULL, '2025-07-10 14:57:28', '2025-07-10 14:57:28'),
(61, 2, 15, 7, NULL, 'EMMANUEL NYENDWA', 'Emmanuel.Nyendwa@natsave.co.zm', NULL, '$2y$12$Q5XGUn8eA5ANmIXn3CfhU.bEI2cnWV3Dd4Q5EIUIbYmeKKcOITemy', NULL, '2025-07-10 14:58:46', '2025-07-10 14:58:46'),
(62, 2, 15, 8, NULL, 'REGINA SIMWAKA', 'Regina.Simwaka@natsave.co.zm', NULL, '$2y$12$TCmALJ.2t/bBvvoazOpyzOgIgfqWCRAOXi285tJXAS52fzPKJiDPq', NULL, '2025-07-10 14:59:36', '2025-07-10 14:59:36'),
(63, 2, 15, 8, NULL, 'JOY KASANGILI', 'Joy.Kasangili@natsave.co.zm', NULL, '$2y$12$tO4DlD0Veb/NSBXKNdFc4ONahjnv263KUz/qhuXmfLAQHLqkyWneG', NULL, '2025-07-10 15:00:31', '2025-07-10 15:00:31'),
(64, 1, 5, 4, NULL, 'Zindaba Gondwe', 'Zindaba.Gondwe@natsave.co.zm', NULL, '$2y$12$rJh7VLUyJpNid9ZPQMZPlO7dk/94zorTylnPld9EUX2yxIaFxWt4a', NULL, '2025-07-10 15:01:04', '2025-07-10 15:01:04'),
(65, 2, 15, 8, NULL, 'KOTUTU LIKISI', 'Kotutu.Likisi@natsave.co.zm', NULL, '$2y$12$WerSDadQGRJMho2xQDwk1ewd7CKpiVIvZNYItnYhFONSHLQXMUWX.', NULL, '2025-07-10 15:01:15', '2025-07-10 15:01:15'),
(66, 2, 15, 8, NULL, 'CHILANDO CHILANDO', 'Chilando.Chilando@natsave.co.zm', NULL, '$2y$12$OwFOZft6zT3BFrDCMnwOb.f5UDqzOhCfLCqHmNU3kl.H7cUNGGzU2', NULL, '2025-07-10 15:01:58', '2025-07-10 15:01:58'),
(67, 2, 15, 8, NULL, 'FAITH MUTABWA', 'Faith.Mutabwa@natsave.co.zm', NULL, '$2y$12$wmjWdoNJLNPf9tZjD9zODO7xC52tvlocOeCFTA00R8ygP4h3HQb.K', NULL, '2025-07-10 15:02:43', '2025-07-10 15:02:43'),
(68, 2, 15, 8, NULL, 'GLENDA NDHLOVU', 'Glenda.Ndhlovu@natsave.co.zm', NULL, '$2y$12$bQwywpPu3KpfvLa2N2u6huXw6mghmweq295IIDR2z/2J.NjMDW/j2', NULL, '2025-07-11 06:11:23', '2025-07-11 06:11:23'),
(69, 2, 15, 8, NULL, 'LINDIWE MWIINGA', 'Lindiwe.Mwiinga@natsave.co.zm', NULL, '$2y$12$vVgFhyYIYx5zxZTvOXhzUOy8h8kjxlnWOkocfhgnTGZshRYOIc.Iq', NULL, '2025-07-11 06:14:57', '2025-07-11 06:14:57'),
(70, 2, 15, 9, NULL, 'GRACE MBAMBARA', 'Grace.Mbambara@natsave.co.zm', NULL, '$2y$12$.XJpi/RRE5cXqKXFYU4m7OvI3kGzn1ahdHGsXgZ10uOWb9F0PTcdi', NULL, '2025-07-11 06:15:41', '2025-07-11 06:15:41'),
(71, 2, 15, 9, NULL, 'TIMOTHY GOMA', 'Timothy.Goma@natsave.co.zm', NULL, '$2y$12$pdK7Igr0Sz1F9pQEY/9E2OVxu7NXqwHa9brhY8FDl0iDukFBImXFi', NULL, '2025-07-11 06:16:12', '2025-07-11 06:16:12'),
(72, 2, 15, 9, NULL, 'MADALITSO PHIRI', 'Madalitso.Phiri@natsave.co.zm', NULL, '$2y$12$z15zvxz5q9LABcxMu5QJK.FDQtRjB6KgAiyiUI0H.aSsBDlMJ.bC6', NULL, '2025-07-11 06:16:57', '2025-07-11 06:16:57'),
(73, 2, 15, 9, NULL, 'ALLIA SITWALA', 'Allia.Sitwala@natsave.co.zm', NULL, '$2y$12$w.AAirlTLboGv3u06CcGRezx8CynNAZdQ.4T0Bb9I0qF3uYFQKPFq', NULL, '2025-07-11 06:17:46', '2025-07-11 06:17:46'),
(74, 2, 15, 9, NULL, 'ESTHER NALWAMBA', 'Esther.Nalwamba@natsave.co.zm', NULL, '$2y$12$9JqbZnJwWQjxAwSQjeZOXuCx3YwTwip/hFDwC.c0X0XMslgFv55nS', NULL, '2025-07-11 06:18:32', '2025-07-11 06:18:32'),
(75, 2, 15, 9, NULL, 'SERGY MISALE', 'Sergy.Misale@natsave.co.zm', NULL, '$2y$12$4gBjTIHHJt/h6NUay58r4.qXfv8/IZ5DWrD5/OP5w8JUzBfxNIXsm', NULL, '2025-07-11 06:19:23', '2025-07-11 06:19:23'),
(76, 2, 15, 10, NULL, 'NAOMI SILOKA', 'Naomi.Siloka@natsave.co.zm', NULL, '$2y$12$T4FPmdQgS9aK7yK/2SGJiu4VKYl0io3Vu/VAhhREEYngsC0oHRI1u', NULL, '2025-07-11 06:20:17', '2025-07-11 06:20:17'),
(77, 2, 15, 10, NULL, 'SOLOMON NYIRENDA', 'Solomon.Nyirenda@natsave.co.zm', NULL, '$2y$12$/e7pAuLhM.L0raCNN40OueBP13lTE9FQHEu15zYW3w9yr/rYCWeO6', NULL, '2025-07-11 06:21:02', '2025-07-11 06:21:02'),
(78, 2, 15, 10, NULL, 'SEKAI CHINYIMBA', 'Sekai.Chinyimba@natsave.co.zm', NULL, '$2y$12$SAoAMg5z3SrSNGdpGyJAKe126L0OQvlNgUkq8RlKHlJQWHKjfeZ1S', NULL, '2025-07-11 06:21:56', '2025-07-11 06:21:56'),
(79, 2, 15, 10, NULL, 'MICHAEL MWANZA', 'Michael.Mwanza@natsave.co.zm', NULL, '$2y$12$tuaV5K7i5yFnif0aW35B/eSqnNC6KSLMGljR.c/uDzhAbIgYFt1by', NULL, '2025-07-11 06:22:36', '2025-07-11 06:22:36'),
(80, 2, 15, 10, NULL, 'LILIAN MULELE', 'Lilian.Mulele@natsave.co.zm', NULL, '$2y$12$/00CqbpTm9y9l/xMEktKbObbppFGJuWb5Ig5bQAiQKfgAm5aCE3vy', NULL, '2025-07-11 06:23:43', '2025-07-11 06:23:43'),
(81, 2, 15, 10, NULL, 'MUBANGA MWAMBA', 'Mubanga.Mwamba@natsave.co.zm', NULL, '$2y$12$bVUqXHb2eVA4sPzRF7.kvuZKIhIWnyweBzLOPcJEZUhGRP9k2u6ve', NULL, '2025-07-11 06:24:28', '2025-07-11 06:24:28'),
(82, 2, 15, 10, NULL, 'AISSE WADE', 'Aisse.Wade@natsave.co.zm', NULL, '$2y$12$HVM7xyb/mOA5kXb2gckteO2TQ2.mxaDny.c4yRx9oUy.JIusdNeru', NULL, '2025-07-11 06:25:03', '2025-07-11 06:25:03'),
(83, 2, 15, 11, NULL, 'BRUCE BWALYA', 'Bruce.Bwalya@natsave.co.zm', NULL, '$2y$12$vBplS8t.ePRSxZKqvHCBqe9AIJNmcHc5WK.HVbUH7szTxSyQCeO5C', NULL, '2025-07-11 06:25:46', '2025-07-11 06:25:46'),
(84, 2, 15, 11, NULL, 'AZELINA DAKA', 'Azelina.Daka@natsave.co.zm', NULL, '$2y$12$CppzNPRhKMpaV.POr7teTuIk5OSxdXiosiQA8MW/VfPs6XUPnt02q', NULL, '2025-07-11 06:26:14', '2025-07-11 06:26:14'),
(85, 2, 15, 11, NULL, 'BRYAN HAACUMA', 'Bryan.Haacuma@natsave.co.zm', NULL, '$2y$12$1o0B/y4HZj4NH1AwK43WYuXTGs3PRKBHNhvEUIcKbeOe.wkDcpfu.', NULL, '2025-07-11 06:27:01', '2025-07-11 06:27:01'),
(86, 2, 15, 11, NULL, 'DEBORAH MWASE', 'Deborah.Mwase@natsave.co.zm', NULL, '$2y$12$Qi4GBGf9515qAcvBFQOcDuyrvIgpwX4zAGHUykI/BIkbLbr8IHNry', NULL, '2025-07-11 06:27:40', '2025-07-11 06:27:40'),
(87, 2, 15, 11, NULL, 'FRANCIS BWALYA', 'Francis.Bwalya@natsave.co.zm', NULL, '$2y$12$yGqY.7FqqW/DeJoFSNxEqOzBfbfJNDv1cgTqrCkpDD7wBKgUvzwXu', NULL, '2025-07-11 06:28:21', '2025-07-11 06:28:21'),
(88, 2, 15, 11, NULL, 'BERTHA MBEWE', 'Bertha.Mbewe@natsave.co.zm', NULL, '$2y$12$yDPcHuBLU0snOC1GUxtWAO1XN4zhAwqRuME9AuSvo3zD6qlELDPWa', NULL, '2025-07-11 06:29:29', '2025-07-11 06:29:29'),
(89, 2, 15, 11, NULL, 'TREVOR NGULUBE', 'Trevor.Ngulube@natsave.co.zm', NULL, '$2y$12$Sv7AtHVd1WLb7US1UDGWk.59eguULWuvEplD8mHrUMFpcTgXC7oYu', NULL, '2025-07-11 06:30:22', '2025-07-11 06:30:22'),
(90, 2, 15, 11, NULL, 'AALIYAH MACHONA', 'Aaliyah.Machona@natsave.co.zm', NULL, '$2y$12$R/UFrkVah.ILi/9crq9/feisf4eGUD1DaSXP8mR9LO5zXRr.bDcue', NULL, '2025-07-11 06:31:18', '2025-07-11 06:31:18'),
(91, 2, 15, 12, NULL, 'PRUDENCE WALOBELE', 'Prudence.Walobele@natsave.co.zm', NULL, '$2y$12$cpKdTkZjQyBNgm77REKRe.2Q4fDAMsTGt6NJDW75BwlJ8iNRyVDRm', NULL, '2025-07-11 06:32:29', '2025-07-11 06:32:29'),
(92, 2, 15, 12, NULL, 'AMINA BANDA', 'Amina.Banda@natsave.co.zm', NULL, '$2y$12$NN5F8uvPbLwLyeUjImSLROK/clwBcOc0ky3CHcTMKfUQ.AIMAltEi', NULL, '2025-07-11 06:33:13', '2025-07-11 06:33:13'),
(93, 2, 15, 12, NULL, 'REUBEN CHINTU', 'Reuben.Chintu@natsave.co.zm', NULL, '$2y$12$0.J750ytGG/OwxXK0o58l.JNiu.5uyVTIiinMRhIrylea0/bLFU1q', NULL, '2025-07-11 06:33:55', '2025-07-11 06:33:55'),
(94, 2, 15, 12, NULL, 'MAYBISON KAIRA', 'Maybison.Kaira@natsave.co.zm', NULL, '$2y$12$TBLuXjcERGy5vFPfUYQp0.l6o5bMMTJMSclOSJiC01J9lKXuQJXca', NULL, '2025-07-11 06:34:34', '2025-07-11 06:34:34'),
(95, 2, 15, 12, NULL, 'KEITH MUNGONI', 'Keith.Mungoni@natsave.co.zm', NULL, '$2y$12$wtLiUEXfOf9oKy6KbZ7in.tGzPQFoGEWJ6XDY24fDH91kIfs4MK5y', NULL, '2025-07-11 06:35:23', '2025-07-11 06:35:23'),
(96, 2, 15, 12, NULL, 'FAITH MALAMBO', 'Faith.Malambo@natsave.co.zm', NULL, '$2y$12$DR3TVS1I7c5RqZ.DZo5Wx.u5PN.oJjgKhvW2lFTqDAHU3UHmF03rG', NULL, '2025-07-11 06:36:24', '2025-07-11 06:36:24'),
(97, 2, 15, 12, NULL, 'RUTH NSWANA', 'Ruth.Nswana@natsave.co.zm', NULL, '$2y$12$haFlRnHs0C6kkefQ8ey/KO3kcttB5u88hXyolJbtJKRIlNv0jMeAe', NULL, '2025-07-11 06:37:05', '2025-07-11 06:37:05'),
(98, 2, 15, 27, NULL, 'SHADRECK MWALE', 'Shadreck.Mwale@natsave.co.zm', NULL, '$2y$12$b5uVM70s0A9LeZNXuAiw/uQN.JUwRNSS2hOnSKZwsmDC/bff3MEY6', NULL, '2025-07-11 06:38:49', '2025-07-11 06:38:49'),
(99, 2, 15, 27, NULL, 'WINSTONE LUNGU', 'Winstone.Lungu@natsave.co.zm', NULL, '$2y$12$bVybIEDEqtsDwp/UTgPXouZQmQHppfWOhrMTK28GPQ2G1lHf0T6K2', NULL, '2025-07-11 06:55:22', '2025-07-11 06:55:22'),
(100, 2, 15, 27, NULL, 'CLEMENT GONDWE', 'Clement.Gondwe@natsave.co.zm', NULL, '$2y$12$aqfhfWy10vSZQLgra3Ot8.CcTlfw.MEW8jIx/gn/M6wrsa5ork0.S', NULL, '2025-07-11 07:06:22', '2025-07-11 07:06:22'),
(101, 2, 15, 27, NULL, 'MARIANGELA CIMINO', 'Mariangela.Cimino@natsave.co.zm', NULL, '$2y$12$jFBK525cSlJ0cWzPGsl5gezF4njs5oaANM79U/2ech3tVzJ3C4gnG', NULL, '2025-07-11 07:07:42', '2025-07-11 07:07:42'),
(102, 2, 17, 34, NULL, 'Tambudzai Muchimba', 'Tambuzai.Muchimba@natsave.co.zm', NULL, '$2y$12$5mJk6dsoDWdDppYVS0TfpOqWnQ6PyLCR3GwNtEwLBVzWFGgRiJePO', NULL, '2025-07-11 07:08:18', '2025-07-11 07:08:18'),
(103, 2, 17, 34, NULL, 'Martin Nkhoma', 'Martin.Nkhoma@natsave.co.zm', NULL, '$2y$12$nXeXc1uJy67LJuvBvPEne.ME7.RcbHNxUNeoVSAHy1eM/2pR8TaK6', NULL, '2025-07-11 07:10:58', '2025-07-11 07:10:58'),
(104, 2, 17, 34, NULL, 'Rabson Zulu', 'Rabson.Zulu@natsave.co.zm', NULL, '$2y$12$AlHfFRWAVWvdo1oRcQZnDOdEkyvcrw82xjbmmIqX5/S8MKSYXijP.', NULL, '2025-07-11 07:12:48', '2025-07-11 07:12:48'),
(105, 2, 17, 34, NULL, 'ISAAC CHISHALA', 'Isaac.Chishala@natsave.co.zm', NULL, '$2y$12$E947dU8tyHR4UH0twelSKu6ggCuXJ9Cargaf64DpzfzsF59Tuev8e', NULL, '2025-07-11 07:19:19', '2025-07-11 07:19:19'),
(106, 2, 17, 34, NULL, 'Simalumba Simalumba', 'Simalumba.Simalumba@natsave.co.zm', NULL, '$2y$12$F1Gozcsr7BL9QJTUhaFeMu9CPT/ugWWm.e0tuERWlniLgpa/RXO/6', NULL, '2025-07-11 07:20:27', '2025-07-11 07:20:27'),
(107, 2, 17, 34, NULL, 'Lubuto Bwali', 'Lubuto.Bwali@natsave.co.zm', NULL, '$2y$12$w1WLWtm7LHKZORPklqd6huiQXQ8RrZvuSLTxkzNhRdVBgtXDcKDji', NULL, '2025-07-11 07:22:58', '2025-07-11 07:22:58'),
(108, 2, 17, 34, NULL, 'Beatrice Kunda', 'Beatrice.kunda@natsave.co.zm', NULL, '$2y$12$lX3l8C8umz..GzB5hK1qf.Jv1w8And5qowQkN74lGJaZNLgAVNUtu', NULL, '2025-07-11 07:24:03', '2025-07-11 07:24:03'),
(109, 2, 17, 36, NULL, 'Stephen Mtonga', 'Stephen.Mtonga@natsave.co.zm', NULL, '$2y$12$OWmPRbThRlJZfv6vWaXWOOjO/yPAe02QfQGWS2S0htAZq37RtKC3e', NULL, '2025-07-11 07:25:16', '2025-07-11 07:25:16'),
(110, 2, 17, 36, NULL, 'Musonda Kapasa', 'Musonda.Kapasa@natsave.co.zm', NULL, '$2y$12$5WKoA/yB5Oskmj6cJm0xzeMXYB3G.MzOq2J8sZgyywBVDflqmsXiq', NULL, '2025-07-11 07:26:50', '2025-07-11 07:26:50'),
(111, 2, 17, 36, NULL, 'Annie Munakwala', 'Annie.Munakwale@natsave.co.zm', NULL, '$2y$12$hLUiILX7JRFKKtIzzneLVel2O.ZUA7huZkIOBL0Sbe1M5eRVc7S/O', NULL, '2025-07-11 07:28:37', '2025-07-11 07:28:37'),
(112, 2, 17, 36, NULL, 'Peter Zimba', 'Peter.Zimba@natsave.co.zm', NULL, '$2y$12$KvQP3nspULVqbocCpjQk3e7bg9xQxEqF4kW1fsE9nY/3HMt3JNxq2', NULL, '2025-07-11 07:34:28', '2025-07-11 07:34:28'),
(113, 2, 17, 36, NULL, 'Exildah Kantumoya', 'Exildah.Kantumoya@natsave.co.zm', NULL, '$2y$12$wBjSadyM3dWnY5UjTz0LWu2xp7OL.oQg2EsrNLeY95GpHMPFWuDpS', NULL, '2025-07-11 07:38:12', '2025-07-11 07:38:12'),
(114, 2, 17, 36, NULL, 'Samuel Watuka', 'Samuel.Watuka@natsave.co.zm', NULL, '$2y$12$HRSM5F70dddyW4RuKWfdJuHkwPNN5EM5gAanfNu631B7hWiHftLyi', NULL, '2025-07-11 07:39:32', '2025-07-11 07:39:32'),
(115, 2, 17, 36, NULL, 'Rachael Chansa', 'Rachael.Chansa@natsave.co.zm', NULL, '$2y$12$QrDH63GV7B9KKiRgtgwUGOgZJSe2m.S1NEj/1M7Do8fCoBnF8O99m', NULL, '2025-07-11 07:41:01', '2025-07-11 07:41:01'),
(116, 2, 17, 36, NULL, 'Mahongo Manongo', 'Mahongo.Manongo@natsave.co.zm', NULL, '$2y$12$xW639.VFemCj/hptJ6hWQ.he5JSbGjdAvfAodrsuqBQHwiAQLHHei', NULL, '2025-07-11 07:43:48', '2025-07-11 07:43:48'),
(117, 2, 17, 35, NULL, 'Robert Bwalya', 'Robert.Bwalya@natsave.co.zm', NULL, '$2y$12$mWDTvO2c/d5H/4eWo1AXfOBWUy4mwFW7ynAhD27j5qeaAIpalqqmy', NULL, '2025-07-11 07:45:36', '2025-07-11 07:45:36'),
(118, 2, 17, 35, NULL, 'Aaron .Sampa', 'Aaron.Sampa@natsave.co.zm', NULL, '$2y$12$UzYD5BxoECahFNvHNstIyeIRaJRlVc1IhdYGOUQS73k8S97D9QUpO', NULL, '2025-07-11 07:48:46', '2025-07-11 07:48:46'),
(119, 2, 17, 35, NULL, 'Yaneya Phiri', 'Yaneya.Phiri@natsave.co.zm', NULL, '$2y$12$EFM//MNnMO1z.pPvd4rk3.eE6plrdWHVQAKqoUW2FU3k7qIDo.wwG', NULL, '2025-07-11 07:50:24', '2025-07-11 07:50:24'),
(120, 2, 17, 35, NULL, 'Mercy Kaluba', 'Mercy.Kaluba@natsave.co.zm', NULL, '$2y$12$p0/DTm0n2PapI1LdBwYqMOousBkSyaDJqBEJfRLCnKJbyJosumFS6', NULL, '2025-07-11 07:52:10', '2025-07-11 07:52:10'),
(121, 2, 15, 27, NULL, 'MOIRA PHIRI', 'Moira.Phiri@natsave.co.zm', NULL, '$2y$12$ipGEEFZyxPk/S0Ue18FYHelBH5h6UToIcJb73XaBDKDgiXt6q4uQa', NULL, '2025-07-11 07:52:53', '2025-07-11 07:52:53'),
(122, 2, 17, 35, NULL, 'Nyangu Banda', 'Nyangu.Banda@natsave.co.zm', NULL, '$2y$12$iDRPzKtsyNgCatjO4J3QDesGsvO5TK2nYlDVv7q7N5lhTmr5JQQZ2', NULL, '2025-07-11 07:53:06', '2025-07-11 07:53:06'),
(123, 2, 15, 27, NULL, 'YVONNE CHANDA', 'Yvonne.Chanda@natsave.co.zm', NULL, '$2y$12$IvhbzieXr1UX994h8OKoV.1LlJyAqH2xCDvIXv6mUTPfD341rV9BO', NULL, '2025-07-11 07:53:47', '2025-07-11 07:53:47'),
(124, 2, 17, 35, NULL, 'Emmanuel Kalumba', 'Emmanuel.Kalumba@natsave.co.zm', NULL, '$2y$12$e6D3u5eOWcQTfe/v22Z8ker/nR4FhA8pegn5dEyGZGEBYoTGi3HvG', NULL, '2025-07-11 07:54:25', '2025-07-11 07:54:25'),
(125, 2, 15, 27, NULL, 'PRIMEROSE CHUPA', 'Primerose.Chupa@natsave.co.zm', NULL, '$2y$12$8IxmDO7CNQjG53TzYisLZ.3rq7hF4HKref4Phy6It6MKWFnrB4ErS', NULL, '2025-07-11 07:55:06', '2025-07-11 07:55:06'),
(126, 2, 17, 35, NULL, 'Mulenga Kazembe', 'Mulenga.Kazembe@natsave.co.zm', NULL, '$2y$12$.zGx.gD6PxVQXN09q1wLuuvZsSs7b0NiAMqNqZ6rrX39AmbgSgVNS', NULL, '2025-07-11 07:56:16', '2025-07-11 07:56:16'),
(127, 2, 15, 13, NULL, 'KAPULU MUNENGU', 'Kapulu.Munengu@natsave.co.zm', NULL, '$2y$12$kG3GzuCk9xh9rHzfoj/ec.rAj.fDmcMzNL5GaDfD3o5VQeh6FOB6y', NULL, '2025-07-11 07:57:34', '2025-07-11 07:57:34'),
(128, 2, 17, 37, NULL, 'Ian Kunda', 'Ian.Kunda@natsave.co.zm', NULL, '$2y$12$whfSUysevM23vbUd/LCLSOAaKKeZOgNBTs93SuJ8LVkBbAj4WssfS', NULL, '2025-07-11 07:58:17', '2025-07-11 07:58:17'),
(129, 2, 17, 37, NULL, 'John Kunda', 'John.Kunda@natsave.co.zm', NULL, '$2y$12$pfGGGnOMPifEsMtqu7dCyuvj0bNTJkXkQfxR0623hPJZSY3PpZzem', NULL, '2025-07-11 07:59:05', '2025-07-11 07:59:05'),
(130, 2, 17, 37, NULL, 'Moses Chitapwa', 'Moses.Chitapwa@natsave.co.zm', NULL, '$2y$12$c6ClZqQBJpQakCV1FlaJju7zKfTn4vJXiNWZ1oLmndeCK3bNhj8K2', NULL, '2025-07-11 08:01:30', '2025-07-11 08:01:30'),
(131, 2, 17, 37, NULL, 'Ilukwi Wamundila', 'Ilukwi.Wamundila@natsave.co.zm', NULL, '$2y$12$K4hF9n.KEPlBjfGA6mdeV..6s70sVVEJ0FBjVehNDmGrVfPleWLyK', NULL, '2025-07-11 08:02:37', '2025-07-11 08:02:37'),
(132, 2, 17, 37, NULL, 'Melissa Machona', 'Melissa.Machona@natsave.co.zm', NULL, '$2y$12$cl7eLqmC2D9r9ZNNdkIPjuTe0hSXiu7d31spTJN3W1UcL7VJKGDT2', NULL, '2025-07-11 08:04:23', '2025-07-11 08:04:23'),
(133, 2, 17, 37, NULL, 'Derrick Ngambi', 'Derrick.Ngambi@natsave.co.zm', NULL, '$2y$12$Xc3MkzcyNvSzAclJei3BiOdYFnANScqBQwazVJH1f8PjW3yUuW0Gq', NULL, '2025-07-11 08:06:15', '2025-07-11 08:06:15'),
(134, 2, 17, 37, NULL, 'Sharon Kusiyo', 'Sharo.Kusiyo@natsave.co.zm', NULL, '$2y$12$DSD.VEKPYFd6NibkYSyCteCjKG4wnc2GuyMQ1V90LUZyUj3dtdSv6', NULL, '2025-07-11 08:09:19', '2025-07-11 08:09:19'),
(135, 2, 17, 37, NULL, 'Tisa Kunda', 'Tisa.Kunda@natsave.co.zm', NULL, '$2y$12$4OFcdd2I/YNzy1I4ugQeDu7Rt62kERomg9o0YM1nojNwjZrogRzOG', NULL, '2025-07-11 08:10:26', '2025-07-11 08:10:26'),
(136, 2, 17, 37, NULL, 'Mable Kayombo', 'Mable.Kayombo@natsave.co.zm', NULL, '$2y$12$US.v7n5VXE3HlE4WDmYh8.tlPPZTHasb0fngyqT9cSojO2x0.boXe', NULL, '2025-07-11 08:11:29', '2025-07-11 08:11:29'),
(137, 2, 17, 37, NULL, 'Taonga Francisca Banda', 'Taonga.Banda@natsave.co.zm', NULL, '$2y$12$.E5k/1Pihra5kxHPwQUtL.YUKPBaPPVmKydV1rteQA4nqPRTrcILi', NULL, '2025-07-11 08:13:24', '2025-07-11 08:13:24'),
(138, 2, 17, 38, NULL, 'Lewis Sakala', 'Lewis.Sakala@natsave.co.zm', NULL, '$2y$12$quxOKKBQfYh0eHhe/HtEnuULUjWLt7USvmmaGkBWGg1wofMhsnnj2', NULL, '2025-07-11 08:14:34', '2025-07-11 08:14:34'),
(139, 2, 17, 38, NULL, 'Sikuyuba Mutoloki', 'Sikuyuba.Mutoloki@natsave.co.zm', NULL, '$2y$12$48GjCyR1OqEH4CSVy/aXJeDdPGzie9bdBpXwW/xEgdEqmp6r4RenG', NULL, '2025-07-11 08:16:03', '2025-07-11 08:16:03'),
(140, 2, 17, 38, NULL, 'Bertha Milayi', 'Bertha.Milayi@natsave.co.zm', NULL, '$2y$12$9Ik2aJi1V8j2sgwWFyCwmeaxH6di/E0AXLtWg6/O5IjOFAOciRXpy', NULL, '2025-07-11 08:16:46', '2025-07-11 08:16:46'),
(141, 2, 17, 38, NULL, 'Selina Zulu', 'Selina.Zulu@natsave.co.zm', NULL, '$2y$12$FhOu6xYHbKWeovk0QJR3oOdPzoJyW5tB5zvTTNQEMka9.W3Yqx7/W', NULL, '2025-07-11 08:19:05', '2025-07-11 08:19:05'),
(142, 2, 15, 13, NULL, 'TEMBEYA SINYANGWE', 'Tembeya.Sinyangwe@natsave.co.zm', NULL, '$2y$12$twoeXPvMHM9VNIoDUlLlU.6RgP5SgEAoocui8X.2GWXbJsCIYSaSi', NULL, '2025-07-11 08:25:13', '2025-07-11 08:25:13'),
(143, 2, 15, 13, NULL, 'WINNIE ZULU', 'Winnie.Zulu@natsave.co.zm', NULL, '$2y$12$wU4OsnvSG4Hj.WKGamx3TeBAOqkuKUIvv4ULQWYqu3W7Sjmgb0w.i', NULL, '2025-07-11 08:25:55', '2025-07-11 08:25:55'),
(144, 2, 15, 13, NULL, 'HAZEL MALALA', 'Hazel.Malala@natsave.co.zm', NULL, '$2y$12$ONC83J3FBGFnS115hLUPE.GLmj0zUXMNRYrtVBLchdEhEyfJMD.Ee', NULL, '2025-07-11 08:26:40', '2025-07-11 08:26:40'),
(145, 2, 15, 13, NULL, 'KAPALA SICHELA', 'Kapala.Sichela@natsave.co.zm', NULL, '$2y$12$hrJ8xlSRyw76wX8rEDiDp.oe1ZNcFuWluyv7pMGdcgCSlliW42DyS', NULL, '2025-07-11 08:27:33', '2025-07-11 08:27:33'),
(146, 2, 15, 13, NULL, 'MILAYO CHIMWASU', 'Milayo.Chimwasu@natsave.co.zm', NULL, '$2y$12$7sn0o5rERZmdv/tHzFtU2.FLzk171Chyv9DJRVzOY/HitNXjZiRRO', NULL, '2025-07-11 08:28:18', '2025-07-11 08:28:18'),
(147, 2, 15, 13, NULL, 'MWENGWE NSHINGWE', 'Mwengwe.Nshingwe@natsave.co.zm', NULL, '$2y$12$ym15VUb7Si3bG1mOQMK0JOux200UEaigflK/sXYChGGlID7770ega', NULL, '2025-07-11 08:31:40', '2025-07-11 08:31:40'),
(148, 2, 15, 13, NULL, 'NEWTON MULENGA', 'Newton.Mulenga@natsave.co.zm', NULL, '$2y$12$936TYax7FQpb274zGH7Y9eExg/.UTE7N/8T07Da7sndjva6ioH7ze', NULL, '2025-07-11 08:33:18', '2025-07-11 08:33:18'),
(149, 2, 15, 14, NULL, 'KAYOMBO KAMIZA', 'Kayombo.Kamiza@natsave.co.zm', NULL, '$2y$12$fnqlCd3pj11MsGxb0gCU9OFTPuISqaFJyTVs2pfUOQw6e6VELlpKm', NULL, '2025-07-11 08:34:31', '2025-07-11 08:34:31'),
(150, 2, 15, 13, NULL, 'MBOLOLO MUSANGU', 'Mbololo.Musangu@natsave.co.zm', NULL, '$2y$12$6d1i4zPJ7CwmYybfClK0l.Nok98ew8xJCgfSRrb8F05xe43O4.n9e', NULL, '2025-07-11 08:38:59', '2025-07-11 08:38:59'),
(151, 2, 17, 38, NULL, 'Dainess Phiri', 'Dainess.Phiri@natsave.co.zm', NULL, '$2y$12$D5MHpBaflLFxqxs2HtyR/.nceM15YMcvF.OfcuSC8xWf3xIJ09846', NULL, '2025-07-11 08:45:30', '2025-07-11 08:45:30'),
(152, 2, 17, 38, NULL, 'Zuze Banda', 'Zuze.Banda@natsave.co.zm', NULL, '$2y$12$nNngIf.2331XPSMv70nH4ekoQBkOboTu4VZJ8bWoaAER8G9o1.jYC', NULL, '2025-07-11 08:46:13', '2025-07-11 08:46:13'),
(153, 2, 17, 39, NULL, 'Emmanuel Moyo', 'Emmanuel.Moyo@natsave.co.zm', NULL, '$2y$12$wH8ZR5FFTPG/vzD/XIEhjuCGlmTFDPrf.FVvMcC3uOS/6ysluN4oW', NULL, '2025-07-11 08:48:25', '2025-07-11 08:48:25'),
(154, 2, 17, 39, NULL, 'Joseph Sichalwe', 'Joseph.Sichalwe@natsave.co.zm', NULL, '$2y$12$AQp7b5snF0KF1eXll/JjbuZtDqen3RQ54JwL/qbgYzIjagad7Kaae', NULL, '2025-07-11 08:49:48', '2025-07-11 08:49:48'),
(155, 2, 17, 39, NULL, 'Ketty Nkonde', 'Ketty.Nkonde@natsave.co.zm', NULL, '$2y$12$CEhVrN2UXMBhTC9uQ8gEVewwymz4s8zPDZ.9E5NQdphNyqcV575nK', NULL, '2025-07-11 08:50:38', '2025-07-11 08:50:38'),
(156, 2, 17, 39, NULL, 'Mackford Chibale Nkandu', 'mackford.Nkandu@natsave.co.zm', NULL, '$2y$12$j6m25DkO2b45KzLzUAHlmuITHpsUrvgS1gEHWbhKeboYE2Fe51.Iq', NULL, '2025-07-11 08:52:38', '2025-07-11 08:52:38'),
(157, 2, 17, 39, NULL, 'Francis Musukuma', 'Francis.Musukuma@natsave.co.zm', NULL, '$2y$12$FKfl2V9FVMLbfpoxSDyYeO0fXe6Zg..GUX5n1rTvugIKW.6TMQYyG', NULL, '2025-07-11 08:54:36', '2025-07-11 08:54:36'),
(158, 2, 17, 39, NULL, 'Eddie Kalubwa', 'Eddie.Kalubwa@natsave.co.zm', NULL, '$2y$12$SyVP9cXIEN6S50JWdQXDAeRh5.ImpLVG4yJKatDD99ZKwRUfNliNS', NULL, '2025-07-11 08:56:01', '2025-07-11 08:56:01'),
(159, 2, 15, 14, NULL, 'JONATHAN CHINYEMBA', 'Jonathan.Chinyemba@natsave.co.zm', NULL, '$2y$12$fh.YUVfaKPmpWDptV6oZAegPgaqfQdmB7JUFn8XsMYVBtMTQPw2Yi', NULL, '2025-07-11 09:17:54', '2025-07-11 09:17:54'),
(160, 2, 15, 14, NULL, 'BIEMBA LUNETA', 'Biemba.Luneta@natsave.co.zm', NULL, '$2y$12$dWb/S.ts3CnN0DhPZBky/.kXDqyLMRiou1bpQFJYfSTX6ZTtDue6S', NULL, '2025-07-11 09:19:28', '2025-07-11 09:19:28'),
(161, 2, 15, 14, NULL, 'NALISHEBO KANGUMU', 'Nalishebo.Kangumu@natsave.co.zm', NULL, '$2y$12$b1DpNicLfr3hjBE/JDr1Nu/n0hc/DHQbvXtN8z/FYOQCR7WLydK9i', NULL, '2025-07-11 09:21:14', '2025-07-11 09:21:14'),
(162, 2, 15, 14, NULL, 'MUSENGE MAYUNGO', 'Musenge.Mayungo@natsave.co.zm', NULL, '$2y$12$AMwJR3dHj7aL7DNWmcMAXuwlCDHjWjTwxCUXi1LRhIgnFlHS0XstW', NULL, '2025-07-11 09:22:37', '2025-07-11 09:22:37'),
(163, 2, 17, 40, NULL, 'Venicious Simullwi', 'Venicious.Simulwi@natsave.co.zm', NULL, '$2y$12$1vKKml7mLkfp/MEVqq9ouOIKC3GG0i.nvYm8ii792RKTQR4szJvj2', NULL, '2025-07-11 09:24:17', '2025-07-11 09:24:17'),
(164, 2, 15, 14, NULL, 'DEBORAH KAMIZHI', 'Deborah.Kamizhi@natsave.co.zm', NULL, '$2y$12$aKq3gC1h7wXo0uMe0g3j5OONeOVad5xBkkGH/tsM4ELaw45qirFIC', NULL, '2025-07-11 09:24:21', '2025-07-11 09:24:21'),
(165, 2, 15, 15, NULL, 'CHANDA MWENYA', 'Chanda.Mwenya@natsave.co.zm', NULL, '$2y$12$OdFORTtJGTkUaGzepHpoReLMprbdDaMnc59vEfyMNGZBPED8BfKEO', NULL, '2025-07-11 09:25:42', '2025-07-11 09:25:42'),
(166, 2, 17, 40, NULL, 'Annetty Chongo', 'Annetty.Chongo@natsave.co.zm', NULL, '$2y$12$0xAegDEA1G/uclcQF4Ulp.rrVQyFIxUXlSxXA5s95rE0gW.1IQBiu', NULL, '2025-07-11 09:26:19', '2025-07-11 09:26:19'),
(167, 2, 17, 40, NULL, 'Bertha Wanga', 'bertha.Wanga@natsave.co.zm', NULL, '$2y$12$J.iNkdx38gTZq0tr16HJJeV0fAScM7ZZQM.MgA2NpDpskOq4vzrDW', NULL, '2025-07-11 09:29:30', '2025-07-11 09:29:30'),
(168, 2, 15, 15, NULL, 'BESA MWEWA', 'Besa.Mwewa@natsave.co.zm', NULL, '$2y$12$/Jq593/uggfB1acgwcP5K.q4Ka/y8.dpgXALO5Ng/LUBPbk8Hdbqi', NULL, '2025-07-11 09:29:30', '2025-07-11 09:29:30'),
(169, 2, 15, 15, NULL, 'VERNON MWANZA', 'Vernon.Mwanza@natsave.co.zm', NULL, '$2y$12$IDfFcqWfU8Z0kgqysxJLE.nKM47kWLJXGdtMjB1N8qVNwhoFCPqNq', NULL, '2025-07-11 09:30:15', '2025-07-11 09:30:15'),
(170, 2, 15, 15, NULL, 'MUTINTA HANKOMBO', 'Mutinta.Hankombo@natsave.co.zm', NULL, '$2y$12$sFHmQcB/jJgLOyT0Aim4t.yNcY8Xha7vtwCh3j6y7coQYzrRluZwu', NULL, '2025-07-11 09:33:27', '2025-07-11 09:33:27'),
(171, 2, 17, 40, NULL, 'Gwen Namwila', 'Gwen.Namwila@natsave.co.zm', NULL, '$2y$12$LUpSuD8x82jyi5OQvT426Oo9GuXzDKc7DAMBAHllYH8VBcUAVz74K', NULL, '2025-07-11 10:05:54', '2025-07-11 10:05:54'),
(172, 2, 17, 40, NULL, 'Bwalya Kapinga', 'bwaly.kapinga@natsave.co.zm', NULL, '$2y$12$AiRfiDnPTVcmDkDeHJza3ucyf/kjq3vkOacMRDNanufL7ELwPSsWK', NULL, '2025-07-11 10:06:55', '2025-07-11 10:06:55'),
(173, 2, 17, 40, NULL, 'Christina Mutale', 'Christina.Mutale@natsave.co.zm', NULL, '$2y$12$uN4b5tqL5VilbyPXWvqrmOB74O.JfzQ/Z4yaeIwQLhuReCumuTmOa', NULL, '2025-07-11 10:08:11', '2025-07-11 10:08:11'),
(174, 2, 17, 40, NULL, 'Deborah Njaluka', 'deborah.njaluka@natsave.co.zm', NULL, '$2y$12$TP3hieMbMK2WDKEvhRsD2usIip0b1rz.wX.kqxH5VBJRvJzL6qa8u', NULL, '2025-07-11 10:10:12', '2025-07-11 10:10:12'),
(175, 2, 17, 40, NULL, 'Patson Munyamata', 'Patson.Munyamata@natsave.co.zm', NULL, '$2y$12$3w2VcLuf6gDKF1gkmS/Q1eSlf90.pAP2zY6OYVRBOm9wGDpfH/hNa', NULL, '2025-07-11 10:11:23', '2025-07-11 10:11:23'),
(176, 2, 17, 40, NULL, 'Chibulu Chongo', 'Chibulu.Chongo@natsave.co.zm', NULL, '$2y$12$4PJAye0Jkes2GbGIIfBCVO2Yfg8U80gAEUJWLLXX2E5YtL4OsD3wy', NULL, '2025-07-11 10:13:16', '2025-07-11 10:13:16'),
(177, 2, 17, 40, NULL, 'Memory Kalenje', 'Memory.Kalenje@natsave.co.zm', NULL, '$2y$12$OVRQqtQx1jkTOPn.CG89AuqHRV7t3S6bS4t.5RhKOX9yuf.JqWk6q', NULL, '2025-07-11 10:15:30', '2025-07-11 10:15:30'),
(178, 2, 17, 40, NULL, 'Michael Phiri', 'Michael.Phiri@natsave.co.zm', NULL, '$2y$12$NRdw4eXUpRhw/gf3xuqNOeGVlar/l4VWnLiLpFfk5nqmXiw2Epp16', NULL, '2025-07-11 10:17:47', '2025-07-17 14:55:36'),
(179, 2, 17, 40, NULL, 'Nothando Kateka', 'Nothando.Kateka@natsave.co.zm', NULL, '$2y$12$1fWVeY.wC0PC/T3XI0x8.uUqV9Yw0.wztbNNeR241xp45I4x8Sd7y', NULL, '2025-07-11 10:19:52', '2025-07-11 10:19:52'),
(180, 2, 17, 40, NULL, 'ISABELMUBANGA', 'isabel.Mubanga@natsave.co.zm', NULL, '$2y$12$uHGpRamxr5Kv7GqP5AuDtuFnFydzxSufNRNeyPnacGo8Okvw5Rak2', NULL, '2025-07-11 10:21:07', '2025-07-11 10:21:07'),
(181, 2, 17, 30, NULL, 'Hikala Hamabwe', 'Hikala.Hamabwe@natsave.co.zm', NULL, '$2y$12$6TjKQfyz2i8v8D3p4PT3E.Gx.DDsB83tjEjTc1f3xtRD7X5.6oq4q', NULL, '2025-07-11 10:21:57', '2025-07-11 10:21:57'),
(182, 2, 17, 30, NULL, 'Chimwemwe Soko', 'Chimwemwe.soko@natsave.co.zm', NULL, '$2y$12$JyEhThrUn35ZJbhpjKm.OujQwrmmp4brG58l.ADybp7OAMgnxFWgi', NULL, '2025-07-11 10:23:21', '2025-07-11 10:23:21'),
(183, 2, 17, 30, NULL, 'Mumba Chishimba', 'Mumba.Chishimba@natsave.co.zm', NULL, '$2y$12$qq8AkPMT5j3AM/wvRK//0eocJQriGFv5EU9fCAyqPA85.Hjw2UQRi', NULL, '2025-07-11 10:24:24', '2025-07-11 10:24:24'),
(184, 2, 17, 30, NULL, 'Nancy Namwala', 'Nancy.Namwala@natsave.co.zm', NULL, '$2y$12$VZjgUtJ8B52yQL/lhprJ3Ot54EXErUdLhFvSaid/SvK5mKOASbwCi', NULL, '2025-07-11 10:25:18', '2025-07-11 10:25:18'),
(185, 2, 17, 30, NULL, 'Sitwala Kamwi', 'Sitwala.Kamwi@natsave.co.zm', NULL, '$2y$12$syGdp5oVjXRp/wVsKKk31.hIhy8CMTrs0cwK29ttLOPBljVHyHWH6', NULL, '2025-07-11 10:26:22', '2025-07-11 10:26:22'),
(186, 2, 17, 30, NULL, 'Choolwe Mukombwe', 'Choolwe.Mukombwe@natsave.co.zm', NULL, '$2y$12$T6dUT1RkpIRULqKPKNyH7OLfpmOCm36G1cWPjUG61d/5tPGuOMhAW', NULL, '2025-07-11 10:28:02', '2025-07-11 10:28:02'),
(187, 2, 17, 30, NULL, 'Carol Njekwa', 'Carol.Njekwa@natsave.co.zm', NULL, '$2y$12$z7im.QMjPoVyr68kJwo3gOb659sV7znw3i3XfgRulW4QSBzUD7O1i', NULL, '2025-07-11 10:28:47', '2025-07-11 10:28:47'),
(188, 2, 17, 30, NULL, 'Hellen Chibuye', 'Hellen.Chibuye@natsave.co.zm', NULL, '$2y$12$.jPyd2uZbR.2yEufKcsWu.6zpT//sFqCcVepRGbN.iJ9vFZWdd1T.', NULL, '2025-07-11 10:30:16', '2025-07-11 10:30:16'),
(189, 2, 17, 30, NULL, 'Lackson Miti', 'Lackson.Miti@natsave.co.zm', NULL, '$2y$12$zcxXhoF9TXkONp9u/wBaYesXSdkc81rPiTtEPtUnw7v02GJMMw9uu', NULL, '2025-07-11 10:31:36', '2025-07-11 10:31:36'),
(190, 2, 17, 30, NULL, 'Rosemary Katambo', 'Rosemary.Katambo@natsave.co.zm', NULL, '$2y$12$6U2D0.r92pzlLwlTL9b62OIdqE.wX/l1fbNg/vqTtwQ4qeHVhWEPm', NULL, '2025-07-11 10:32:40', '2025-07-11 10:32:40'),
(191, 2, 17, 30, NULL, 'Christopher Phiri', 'Christopher.Phiri@natsave.co.zm', NULL, '$2y$12$QrB.Y8LC33Pqa0ztlby.gei0Y2NdrjDBbojnT4VZfVrhtvo04HG8C', NULL, '2025-07-11 10:33:40', '2025-07-11 10:33:40'),
(192, 2, 17, 41, NULL, 'Bessie Menda', 'bessie.menda@natsave.co.zm', NULL, '$2y$12$6iE.COrC2XNlFI96NR1t9eZWSgUYsUc/aHAe/OUOhnnLEcWDVN3x2', NULL, '2025-07-11 10:34:55', '2025-07-11 10:34:55'),
(193, 2, 17, 41, NULL, 'Becktody Shazemba', 'Becktody.Shazemba@natsave.co.zm', NULL, '$2y$12$Z.rTZjmBjDKm9c2S.pfqX.IEOteNecJJ6WK7.XY.tmLzMKtv/Vkke', NULL, '2025-07-11 10:40:39', '2025-07-11 10:40:39'),
(194, 2, 17, 41, NULL, 'Martha Mpande', 'Martha.Mpande@natsave.co.zm', NULL, '$2y$12$6HtZOO0AaNMtXk5KGW3xxOVjqLvYk89YoDCykquPbfjdSZvaRNe4e', NULL, '2025-07-11 10:55:59', '2025-07-11 10:55:59'),
(195, 2, 17, 41, NULL, 'Hope Longwe', 'Hope.Longwe@natsave.co.zmhpoe', NULL, '$2y$12$CNUtfxdoykh1d5gMfjQSMe.WVNs8JvNdIiPDGKB2eLNBDF52glv6i', NULL, '2025-07-11 10:57:09', '2025-07-11 10:57:09'),
(196, 2, 17, 41, NULL, 'Salvador Ngulube', 'Salvador.Ngulube@natsave.co.zm', NULL, '$2y$12$ZuBfi165tNRttyBxt3JNMOu2QILlx7rBCH0RgsuTGxCGwxOx6vJgW', NULL, '2025-07-11 10:59:51', '2025-07-11 10:59:51'),
(197, 2, 17, 41, NULL, 'Victor Chisela', 'Victor.Chisela@natsave.co.zm', NULL, '$2y$12$yA7EfJIzdHzJYtWb1gZonekl4kGYsF9VY9H7udTQi/kj4LVArKzOa', NULL, '2025-07-11 11:01:04', '2025-07-11 11:01:04'),
(198, 2, 17, 41, NULL, 'Reuben Tembo', 'Reuben.Tembo@natsave.co.zm', NULL, '$2y$12$Qvs3/.sTbKMvUZ0eg6KXV.jnh7HiUX2n2POMtMQasKYFcc.KaiuJW', NULL, '2025-07-11 11:02:02', '2025-07-11 11:02:02'),
(199, 2, 17, 41, NULL, 'Angela Daka', 'Angela.Daka@natsave.co.zm', NULL, '$2y$12$LN/.deGN30Sxe8omIv8wu.zleNfuptnbk1RhX39p7TmndZ90EkLEu', NULL, '2025-07-11 11:03:20', '2025-07-11 11:03:20'),
(200, 2, 17, 42, NULL, 'Choolwe Mpondamasaka', 'Choolwe.Mpondamasaka@natsave.co.zm', NULL, '$2y$12$t59DrHyTJcXWT.SJ2euhke9fop8M1pQt2IOoAMTRUlTpt1MvpGvFe', NULL, '2025-07-11 11:04:47', '2025-07-11 11:04:47'),
(201, 2, 17, 42, NULL, 'Henry Kapinga', 'Henry.Kapinga@natsave.co.zm', NULL, '$2y$12$cprCVzL0aWtdqmzZ3t7TZ.oXu54E4qGUCKH/N3bvTtYILCUkaTdp.', NULL, '2025-07-11 11:06:51', '2025-07-11 11:06:51'),
(202, 2, 17, 42, NULL, 'Chewe Bowa', 'Chewe.Bowa@natsave.co.zm', NULL, '$2y$12$0PYqYCOF92pKPhHVsJZBlOOzdcBNwE6k8tzEx3UVcIufzJprp6h/O', 'gVzDHsrTcKjiRyYJxcJavhZbSq8vBcSAb8l59GQyd5zwWoQVcGsntbGSyc8L', '2025-07-11 11:07:26', '2025-07-11 11:07:26'),
(203, 2, 17, 42, NULL, 'Clara Masando', 'Clara.Masando@natsave.co.zm', NULL, '$2y$12$xrUTRRKpAboHlT.qDv/ltOIrO4/S0ZdYE2bmtLiNgojOYSelAxFz2', NULL, '2025-07-11 11:08:29', '2025-07-11 11:08:29'),
(204, 2, 17, 42, NULL, 'Samuel Chanda', 'Samuel.Chanda@natsave.co.zm', NULL, '$2y$12$0AVM7aoSRWIY67Hj5laqhOHa1V3G7rpF1l/XxGUbSTaookmIh5SAO', NULL, '2025-07-11 11:10:00', '2025-07-11 11:10:00'),
(205, 2, 17, 42, NULL, 'Pamela Ngoma', 'Pamela.Ngoma@natsave.co.zm', NULL, '$2y$12$3rDmTEpWC0TCM17RUmEadOPZrQjHvuKyIZtRbJfwBqczUWRLK3Ofe', NULL, '2025-07-11 11:11:03', '2025-07-11 11:11:03'),
(206, 2, 17, 42, NULL, 'Lungowe Kabisa', 'Lungowe.Kabisa@natsave.co.zm', NULL, '$2y$12$RjIQCPM/r3RC.lkeoXI3r.ZD5l0n5rsu8YnlcVRA4QuNsUYJoGmDS', NULL, '2025-07-11 11:12:39', '2025-07-11 11:12:39'),
(207, 2, 17, 42, NULL, 'Gromyko Muselitata', 'Gromyko.Muselitata@natsave.co.zm', NULL, '$2y$12$FeeQec/TJmxcl0YAcAj5n.i7E4Q3Incv36exK2QzzasBEIzxhrkCe', NULL, '2025-07-11 11:13:53', '2025-07-11 11:13:53'),
(208, 2, 17, 43, NULL, 'Sombo Kauchingu', 'Sombo.Kauchingu@natsave.co.zm', NULL, '$2y$12$LseYiw9cA/bWFygIWi9NOe0eiyFvWQKSfhjHREWKo2GMNeHM1C6Tq', NULL, '2025-07-11 11:14:49', '2025-07-11 11:14:49'),
(209, 2, 17, 43, NULL, 'Mirriam Mandefu', 'Mirrian.Mandefu@natsave.co.zm', NULL, '$2y$12$mqgUlNGVOASPxMF06OfTru4AssqM7Yjgn8mWch22z7l/j1byRGHcu', NULL, '2025-07-11 11:15:51', '2025-07-11 11:15:51'),
(210, 2, 17, 43, NULL, 'Juliet Tapalu', 'Juliet.Tapalu@natsave.co.zm', NULL, '$2y$12$4cYhVvPHLuMlPjtQ2GEwV.P0DvsW2WT5Lne73MQUPkrmeBXqB8/9C', NULL, '2025-07-11 11:16:56', '2025-07-11 11:16:56'),
(211, 2, 17, 43, NULL, 'Kalata Chanda', 'Kalata.Chanda@natsave.co.zm', NULL, '$2y$12$/wLAxEAorGUd7iAaQ09KhermCL.18pJVUQ9b1nOlRShKIHv1XA47W', NULL, '2025-07-11 11:18:13', '2025-07-11 11:18:13'),
(212, 2, 17, 43, NULL, 'Mapalo Zombe', 'Mapalo.Zombe@natsave.co.zm', NULL, '$2y$12$rD8I58B43Ezubd3WshWaj.S1he4P3kyIIiN2Nn7NAZPdKUNTUgbl6', NULL, '2025-07-11 11:18:52', '2025-07-11 11:18:52'),
(213, 2, 17, 43, NULL, 'Yamikani Tembo', 'Yamikani.Tembo@natsave.co.zm', NULL, '$2y$12$C12rn3U20jC4LaphNCPVpuaxABdEsBetVTjoDA1wrdSmyeevM/9mK', NULL, '2025-07-11 11:19:37', '2025-07-11 11:19:37'),
(214, 2, 16, 15, NULL, 'ROSEMARY LUNGU', 'rosemary.lungu@natsave.co.zm', NULL, '$2y$12$E3e1mO63Qk0N4l8E5lzapOsLoS6XaxqblHyeZ5VNhZE2Qzc9oY2U2', NULL, '2025-07-11 11:56:36', '2025-07-11 11:56:36'),
(215, 2, 16, 16, NULL, 'JESSY NANYANGWE CHOMBA', 'jessy.nanyangwe@natsave.co.zm', NULL, '$2y$12$zfUEJLh6NwkCMkLHS0V3O.5fsOEyUmUAkzvCLBrlnQtcgCnw8Oxc6', NULL, '2025-07-11 11:58:15', '2025-07-11 11:58:15'),
(216, 2, 16, 16, NULL, 'KACHESA MIZINGA', 'mizinga.kachesa@natsave.co.zm', NULL, '$2y$12$EdtsIl.KoW1MN7vfr.Vqmuw6MwB8B9n1oUt3eNzjzbgKQES6hunG.', NULL, '2025-07-11 12:00:04', '2025-07-11 12:00:04'),
(217, 2, 16, 16, NULL, 'MABLE KASAMA', 'mable.kasama@natsave.co.zm', NULL, '$2y$12$gZNzIwLEnu/ZKHpc6kJqheSK9xkxAfwueUuF5DsJGLaHUBG/0pCqO', NULL, '2025-07-11 12:01:51', '2025-07-11 12:01:51'),
(218, 2, 16, 16, NULL, 'EXILDAH SIMOONGA', 'exildah.simoonga@natsave.co.zm', NULL, '$2y$12$OOKazvUWCNHJ7Igpo0crbOV9XzcMWLFEGUgMOl8ijj/1X2.aKhqoy', NULL, '2025-07-11 12:05:52', '2025-07-11 12:05:52'),
(219, 2, 16, 16, NULL, 'LAVENCE CHISHIMBA', 'lavence.chishimba@natsave.co.zm', NULL, '$2y$12$8irsR5Xg.4ZKOPhdMn5/cu3PD9mTVW2UORlZfNTqmF512ft/t5f5.', NULL, '2025-07-11 12:07:24', '2025-07-11 12:07:24'),
(220, 2, 16, 16, NULL, 'DINESS CHABALA', 'diness.chabala@natsave.co.zm', NULL, '$2y$12$vxPQ0G/PPXPNlT/RVTbC3ONiIrKBpMcJVxxM.E42rV6LhVOLYpu0S', NULL, '2025-07-11 12:09:07', '2025-07-11 12:09:07'),
(221, 2, 16, 16, NULL, 'ALICK SIMPOKOLWE', 'Alick.Simpokolwe@natsave.co.zm', NULL, '$2y$12$uhKuuUtaK8Lc7H9s.fpQ0ukcL0ts963QnQW87YsDnB9VwBoCljk66', NULL, '2025-07-11 12:10:41', '2025-07-11 12:10:41'),
(222, 2, 16, 17, NULL, 'FRIDAH KAPUTULA', 'fridah.kaputula@natsave.co.zm', NULL, '$2y$12$vvJNbNiwaRpRC5kWyug1n.PiyhhKmloT/XcxH1.SrimWHy2gAyr7i', NULL, '2025-07-11 12:12:40', '2025-07-11 12:12:40'),
(223, 2, 16, 17, NULL, 'GIFT MWIYA', 'gift.mwiya@natsave.co.zm', NULL, '$2y$12$.75WIrdg91GOQ4N8k3jAy.gwOX4Xl9BQba/iKRZkvHZu0AiZ/BKgm', NULL, '2025-07-11 12:13:48', '2025-07-11 12:13:48'),
(224, 2, 16, 17, NULL, 'JOHN MALICHI', 'john.malichi@natsave.co.zm', NULL, '$2y$12$RyO7pMHDxrJcwJJ5TorUb.HC4gFPIeHOdEMikPxt5HeFQGX/ggGEW', NULL, '2025-07-11 12:14:55', '2025-07-11 12:14:55'),
(225, 2, 16, 17, NULL, 'IREEN MULUWA SAMUKOLO', 'ireen.samukolo@natsave.co.zm', NULL, '$2y$12$IdD6aDyX1J0PEmaPf.kcHOx3NQCNYY5YakE/57CjkC/DSMwah2/72', NULL, '2025-07-11 12:18:18', '2025-07-11 12:18:18'),
(226, 2, 16, 17, NULL, 'SIMON ZIMBA', 'simon.zimba@natsave.co.zm', NULL, '$2y$12$9ri5qsggv2KASC5z6YbDo.0TNdmAfl8Csowyqd20Jt0TSShFtqSGS', NULL, '2025-07-11 12:20:34', '2025-07-11 12:20:34'),
(227, 2, 16, 17, NULL, 'HOWARD MUJIMANZOVU', 'howard.mujimanzovu@natsave.co.zm', NULL, '$2y$12$VF2nafqFOQwmtfzFDMe2luEflU2emXqyLvGBGRo7egQO.Sm5WqOQG', NULL, '2025-07-11 12:21:57', '2025-07-11 12:21:57'),
(228, 2, 16, 18, NULL, 'MISOZI SAKALA SHAMAKAMBA', 'misozi.sakala@natsave.co.zm', NULL, '$2y$12$XVr9CQN87ziJ2r1Hq2Zlae6DVrIhKyNREG6IWrW9f13/opc/9/P66', NULL, '2025-07-11 12:23:18', '2025-07-11 12:23:18'),
(229, 2, 16, 18, NULL, 'GREAT CHOONGO', 'great.chongo@natsave.co.zm', NULL, '$2y$12$C80EmXAP99XJI16/CsaFZuVItpQB6CW.LnhLrJb1i.BiZvFqMphNm', NULL, '2025-07-11 12:31:25', '2025-07-11 12:31:25'),
(230, 2, 16, 18, NULL, 'FRANK LWANGA', 'frank.lwanga@natsave.co.zm', NULL, '$2y$12$js/gbT3vnLebq800MPkU6ej9V.mbkd2dHIkxv2hHxf0w81NozXch6', NULL, '2025-07-11 12:32:40', '2025-07-11 12:32:40'),
(231, 2, 16, 18, NULL, 'NGENDA KAMENDA', 'ngenda.kamenda@natsave.co.zm', NULL, '$2y$12$m2gxBX6rE9WikrM4/yAQSOHYmV5CQ012I4PPTu37XdU.eYLEAU0pW', NULL, '2025-07-11 12:35:35', '2025-07-11 12:35:35'),
(232, 2, 16, 18, NULL, 'NAMUPU KAMUWANGA', 'namupu.kamuwanga@natsave.co.zm', NULL, '$2y$12$yVN3GSgUryr57YFYqzNUGuCbzZ7hpFONcgeHf8H0jwYrX8czVu7x6', NULL, '2025-07-11 12:39:16', '2025-07-11 12:39:16'),
(233, 2, 16, 18, NULL, 'UPENDO KANAWILA', 'upendo.kanawila@natsave.co.zm', NULL, '$2y$12$Azm5liPcTVbq9R9WCb7z8OWLMD606J5LEvVLFoHCpDGM4TkN/8qDm', NULL, '2025-07-11 12:41:32', '2025-07-11 12:41:32'),
(234, 2, 16, 19, NULL, 'SONGELA MWANZA', 'songela.mwanza@natsave.co.zm', NULL, '$2y$12$A2m.1ps1WN9nU3AMXL.skOYNVI7UXA3jWOrN47PD4tbKGv/pWXWwC', NULL, '2025-07-11 12:43:42', '2025-07-11 12:43:42'),
(235, 2, 16, 19, NULL, 'MULENGA CHIWAZU', 'mulenga.chizawu@natsave.co.zm', NULL, '$2y$12$Av89k94P/5spJcxb7In37.hQ84J69.XCpnqzGa0Wgm..6UnWFEooC', NULL, '2025-07-11 12:44:51', '2025-07-11 12:44:51'),
(236, 2, 16, 19, NULL, 'MAJORIE NDHLOVU', 'marjorie.ndhlovu@natsave.co.zm', NULL, '$2y$12$UuzBFuEcYT.cadRv7wupK.ftLX3PVksOpgLqS37Q8zTsOkNeskaHC', NULL, '2025-07-11 12:48:12', '2025-07-11 12:48:12'),
(237, 2, 16, 19, NULL, 'KATEMA PHIRI', 'katema.phiri@natsave.co.zm', NULL, '$2y$12$Iocmdbh1FuB70/PBVpdvxekFOqHKq5yR0LB.webd3YA3JZQaUeUEm', 'tgF51YNElHQWhMk7tJfBLFVI2d4uoxiqmL6odrjwWdTAl5SbHxnAJONoc9Ai', '2025-07-11 12:49:35', '2025-07-11 12:49:35'),
(238, 2, 16, 19, NULL, 'GRACIOUS SIMBEYE', 'gracious.simbeye@natsave.co.zm', NULL, '$2y$12$LTQ0Pr4LkX/q.o3C0cdeWuTGlgzeDl2drwqVOPkzNJksDgNhu0ay2', NULL, '2025-07-11 12:59:10', '2025-07-11 12:59:10'),
(239, 2, 16, 19, NULL, 'ZENAIDA BANDA', 'zenaida.banda@natsave.co.zm', NULL, '$2y$12$oKpJyrFCCUQ73eJAeb6HmurWHTexVONuyf7Gih0XnSPBOw.XYT.Rq', NULL, '2025-07-11 13:01:54', '2025-07-11 13:01:54'),
(240, 2, 16, 19, NULL, 'TEMBOZI MUSONDA', 'tembozi.musonda@natsave.co.zm', NULL, '$2y$12$Ydo6JohQqw3UxH0o3IrUcuHHudIExdp/RyoSVTJXM4SJUfpTdohz.', NULL, '2025-07-11 13:03:46', '2025-07-11 13:03:46'),
(241, 2, 16, 19, NULL, 'MARLEEN INGWE', 'marleen.ingwe@natsave.co.zm', NULL, '$2y$12$6bcIIWn5iynNRzCF9ovPkeqX1YAauQ0b2cp7DzMWDrQZp9t5nqLxi', NULL, '2025-07-11 13:07:06', '2025-07-11 13:07:06'),
(242, 2, 16, 19, NULL, 'EPHRAIM KYEMBE', 'Ephraim.Kyembe@natsave.co.zm', NULL, '$2y$12$H5bM4bVBqlHoC7wlqUSJJeLXy9Yg/6x5MWwIumgNiUw66D8i3E0PC', NULL, '2025-07-11 13:09:48', '2025-07-11 13:09:48'),
(243, 2, 16, 20, NULL, 'DIANA CHIPASHA', 'diana.chipasha@natsave.co.zm', NULL, '$2y$12$Wx5UsAn1dnxYqwu.qZc0muHIpZgmG10nj7s8I3a3I2jEu.2stNLju', NULL, '2025-07-11 13:12:24', '2025-07-11 13:12:24'),
(244, 2, 16, 20, NULL, 'JOTHAM NUNDWE', 'jotham.nundwe@natsave.co.zm', NULL, '$2y$12$GqDs.4ZPwQlzMc/IGBfoA.GuWeZCsQzfemh7N1tEzFPBnYMawq50m', NULL, '2025-07-11 13:14:54', '2025-07-11 13:14:54'),
(245, 2, 16, 20, NULL, 'FELIX CHILESHE', 'felix.chileshe@natsave.co.zm', NULL, '$2y$12$VwLurNLTkI29ziyBRb6vuObwulaj/bpt99dJzlwh13XEFSNVyWawq', NULL, '2025-07-11 13:16:08', '2025-07-11 13:16:08'),
(246, 2, 16, 20, NULL, 'MARY TEMBO', 'mary.tembo@natsave.co.zm', NULL, '$2y$12$2R/QZlODED4tO58DPwjREO8FlbGrkTo6ynNE3robOFBJSnyOHzspq', NULL, '2025-07-11 13:17:34', '2025-07-11 13:17:34'),
(247, 2, 16, 20, NULL, 'EMMANUEL MUZETA', 'emmanuel.muzeta@natsave.co.zm', NULL, '$2y$12$jV071WK0KAJPR.t7XxCKrONf6MzycAUXRq8x8KvrK4dhzXmNNNAui', NULL, '2025-07-11 13:21:06', '2025-07-11 13:21:06'),
(248, 2, 16, 20, NULL, 'TOWELA MTONGA', 'towela.mtonga@natsave.co.zm', NULL, '$2y$12$/8GUgHbmMM09TjnTOr0u6O7LTmI59pv0tkVpT4I7I2J5GEk5nBsBG', NULL, '2025-07-11 13:22:49', '2025-07-11 13:22:49'),
(249, 2, 16, 21, NULL, 'SHARON NKOLE NGOSA', 'sharon.nkole@natsave.co.zm', NULL, '$2y$12$tBnQ9/ANRfmpUNws12RZ0ezQ/3oUSEALtmUMLFZBxMeNqmktb9lBm', NULL, '2025-07-11 13:25:13', '2025-07-11 13:25:13'),
(250, 2, 16, 21, NULL, 'MWENYA KALAMBULA NGOSA', 'mwenya.kalambulwa@natsave.co.zm', NULL, '$2y$12$Ni2yCAZmg5SwBQ3vbv8xouthj7vyUFz1E4g0rzuMB1JFQaF3wxl8.', NULL, '2025-07-11 13:27:01', '2025-07-11 13:27:01'),
(251, 2, 16, 21, NULL, 'HAPPINESS CHANDA', 'happiness.chanda@natsave.co.zm', NULL, '$2y$12$H8HpZPZawzlpJXA58i42uuZ0qN2v4VDPjexmaqG3alluTWLae49Eu', NULL, '2025-07-11 13:28:44', '2025-07-11 13:28:44'),
(252, 2, 16, 21, NULL, 'RABECCA CHALI', 'rabecca.chali@natsave.co.zm', NULL, '$2y$12$HNVsJkIJPrxpn0xqshjf..0CG.Q4ZTmdurOac5u9iTKXZLZeOM8ni', NULL, '2025-07-11 13:30:29', '2025-07-11 13:30:29'),
(253, 2, 16, 21, NULL, 'MATILDA  K PHIRI', 'matilda.phiri@natsave.co.zm', NULL, '$2y$12$GH0GDZFWfU9iVNAsaW3duet8RSsVOZTwVTS/K9lAgom2kxcZkwHA.', NULL, '2025-07-11 13:34:30', '2025-07-11 13:34:30'),
(254, 2, 16, 21, NULL, 'THERESA NAMAKANDO', 'theresa.namakando@natsave.co.zm', NULL, '$2y$12$jS4zFiafnOz6KG1wKhETpO9zPaaOlkAMrgLmmqR4BXN94ysuoNfIa', NULL, '2025-07-11 13:35:33', '2025-07-11 13:35:33'),
(255, 2, 16, 21, NULL, 'OSBORNE MLENZO', 'osborne.mlenzo@natsave.co.zm', NULL, '$2y$12$G4aFaV994731yb8qiJ9csONvttIdRgpQ/O0E1OkXfCPiZNDpt070m', NULL, '2025-07-11 13:39:06', '2025-07-11 13:39:06'),
(256, 2, 16, 21, NULL, 'STAN BANDA', 'stan.banda@natsave.co.zm', NULL, '$2y$12$et2v0AjalRTl3IvQDb9VAeR192zi9RUacATRsl5JEFZZCgBmHtxUa', NULL, '2025-07-11 13:41:32', '2025-07-11 13:41:32'),
(257, 2, 16, 23, NULL, 'SYLVESTER MUMBA', 'sylvester.mumba@natsave.co.zm', NULL, '$2y$12$z69AFQt9jHDO9xdBXrj3Z.9bWejgIohsD54.gb6ug1z52Uq/E/aKm', NULL, '2025-07-11 13:44:38', '2025-07-11 13:44:38'),
(258, 2, 16, 23, NULL, 'CYNTHIA CHABU', 'cynthia.chabu@natsave.co.zm', NULL, '$2y$12$RhIl2SAbCkvKGkhjYbZdbugAd5AgJIfr/blmipTxdzO8vb8B7hMsS', NULL, '2025-07-11 13:45:56', '2025-07-11 13:45:56'),
(259, 2, 16, 23, NULL, 'LILIAN T KAONGA', 'lillian.kaonga@natsave.co.zm', NULL, '$2y$12$Es3PVCvMRp6yFlo5z2Q.7ebRV3Dh55/pG5J.GyXiA7euhc8C1y2eG', NULL, '2025-07-11 13:47:20', '2025-07-11 13:47:20'),
(260, 2, 16, 23, NULL, 'MALUNGO HIMWIINGA', 'malungo.himwiinga@natsave.co.zm', NULL, '$2y$12$2LdBOw1cJ/WmsfdLWhrT/eMiPjibc2vUwioDRalswDPSLZogcKEEq', NULL, '2025-07-11 13:48:34', '2025-07-11 13:48:34');
INSERT INTO `users` (`id`, `role_id`, `user_id`, `branch_id`, `updated_by`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(261, 2, 16, 23, NULL, 'MAXWELL NKOMESHA', 'maxwell.nkomesha@natsave.co.zm', NULL, '$2y$12$MLsMSc2Vn4KbxttzuATG/e7h3xaDKDom81q4z/5CIIbkmoU8QU5aG', NULL, '2025-07-11 13:50:55', '2025-07-11 13:50:55'),
(262, 2, 16, 23, NULL, 'MUTALE BWALYA', 'mutale.bwalya@natsave.co.zm', NULL, '$2y$12$hFgE/Bvpl4f4DzDBOIuzYeQ8b5TOyLxoBjafZcphcROXLc5tcmLeS', NULL, '2025-07-11 13:52:33', '2025-07-11 13:52:33'),
(263, 2, 16, 24, NULL, 'AUGUSTINE SILWAMBA', 'augustine.silwamba@natsave.co.zm', NULL, '$2y$12$t2DLIRTthLoXABgBGyJ01OcIGuOHfaEl52IWqpJdBq2/Mo8lqkyJO', NULL, '2025-07-11 13:55:03', '2025-07-11 13:55:03'),
(264, 2, 16, 24, NULL, 'MIKE MALAMO', 'mike.malamo@natsave.co.zm', NULL, '$2y$12$o0ltSEFEbEFauoqC71DqNufqgVXpS4RO0ezF/wo8b7baod3EIuChS', NULL, '2025-07-11 13:56:19', '2025-07-11 13:56:19'),
(265, 2, 16, 24, NULL, 'REGINA CHISUNKA', 'regina.chisunka@natsave.co.zm', NULL, '$2y$12$qj5abBnoisq6D7PgHrHEyOdP8iQsc6i7fbRfI8QvvlKyv2HRYsBV2', NULL, '2025-07-11 13:57:45', '2025-07-11 13:57:45'),
(266, 2, 16, 24, NULL, 'PATRICK KABISA', 'patrick.kabisa@natsave.co.zm', NULL, '$2y$12$R3832BSh6Mq301C2cyvBAeKejTFuC6YPbG7ehv4NYcFL0IDhPkqii', NULL, '2025-07-11 13:59:14', '2025-07-11 13:59:14'),
(267, 2, 16, 24, NULL, 'SANDRA MBAITA KAPAKU', 'sandra.kapaku@natsave.co.zm', NULL, '$2y$12$bO.blfoU95teYVlsGyQCM.gUReJLhZq1GyD3JJGP6tncAPBFzKAdW', NULL, '2025-07-11 14:01:00', '2025-07-11 14:01:00'),
(268, 2, 16, 24, NULL, 'MWANAGOMBE MANGAMBWA', 'mwanangombe.mangambwa@natsave.co.zm', NULL, '$2y$12$UJW.P7vRVVuuJ9D5oKl5V.dvbOVS.gjpqPLx/78fb4n6kL0BQwBTu', NULL, '2025-07-11 14:02:54', '2025-07-11 14:02:54'),
(269, 2, 16, 22, NULL, 'MEYA KAPITA', 'meya.kaumba@natsave.co.zm', NULL, '$2y$12$gZzP5xX5MmFIuaD2UGQthOC7VozBVSgVVt6Qo.o8Z.pTZOylQQpD.', NULL, '2025-07-11 14:03:58', '2025-07-11 14:03:58'),
(270, 2, 16, 22, NULL, 'MALI KAVIMBA', 'kavimba.mali@natsave.co.zm', NULL, '$2y$12$c3oMMaNk8nTRMybs8ojkBubw5Fy7J1jh0VI7Kf5aklmuefltqCYpS', NULL, '2025-07-11 14:04:56', '2025-07-11 14:04:56'),
(271, 2, 16, 22, NULL, 'DEBORAH MUCHILI', 'deborah.muchili@natsave.co.zm', NULL, '$2y$12$t/IcLXofCMjfnfty9S93AOVV9H5FEH51MayQ4qo.zk5NvnfysAmw2', NULL, '2025-07-11 14:07:57', '2025-07-11 14:07:57'),
(272, 2, 16, 22, NULL, 'KARREN MUSONDA', 'karren.musonda@natsave.co.zm', NULL, '$2y$12$He5H.n33XKUU3cfBQ5jrHe0VqgodIqgOqcgFTXSXbpdD4caFo/5jK', NULL, '2025-07-11 14:09:25', '2025-07-11 14:09:25'),
(273, 2, 16, 22, NULL, 'DANIEL LUKWESA', 'daniel.lukwesa@natsave.co.zm', NULL, '$2y$12$13pgQPZuYXcWJ5CRG62WdejB/y8pMbat9ewQyujASW9YaosEbMG3a', NULL, '2025-07-11 14:10:39', '2025-07-11 14:10:39'),
(274, 2, 16, 28, NULL, 'BLOODY GOMA', 'bloody.chanda@natsave.co.zm', NULL, '$2y$12$b/KmZQX94osPCEMoZCIgveiQrFl5s1Nc1NfzeoyHe8b8oQL65uuJC', NULL, '2025-07-11 14:11:46', '2025-07-11 14:11:46'),
(275, 2, 16, 28, NULL, 'ENALA CHILESHE BANDA', 'enala.banda@natsave.co.zm', NULL, '$2y$12$0sDVh.uwXtXfcXyyXLkYWeSJWGYObbDtJl2sJYYBo40UDs2wVI9E.', NULL, '2025-07-11 14:12:56', '2025-07-11 14:12:56'),
(276, 2, 16, 28, NULL, 'MUSUKWA KAPAMPA', 'kapampa.musukwa@natsave.co.zm', NULL, '$2y$12$9GnkcURqLFSj/a.Nc/QcReknizqc5.xbTHP3qeU3DHyfKL8cL8eDO', NULL, '2025-07-11 14:14:18', '2025-07-11 14:14:18'),
(277, 2, 16, 28, NULL, 'YVONNE NGOSA', 'yvonne.ngosa@natsave.co.zm', NULL, '$2y$12$EwaJJWSIscAnqEupKtopzuCCqZGbVPlvvdAefAq4fVDqKPshT5Br2', NULL, '2025-07-11 14:17:22', '2025-07-11 14:17:22'),
(278, 2, 16, 28, NULL, 'FRIDAH CHILOMBO SACHINYAMA', 'fridah.sachinyama@natsave.co.zm', NULL, '$2y$12$m8NXBj9L/ggxmQkXfYow4OFKl4NdD7F6SiJ2ybFKTbCDTd/U9xPeu', NULL, '2025-07-11 14:18:52', '2025-07-11 14:18:52'),
(279, 2, 16, 28, NULL, 'MALILO SEFULO', 'malilo.kakoma@natsave.co.zm', NULL, '$2y$12$8e6O9CgLeoLe..taHBaqcO1Cgu8dax0RKF2eNcg5kKjA1rafXISYW', NULL, '2025-07-11 14:20:26', '2025-07-11 14:20:26'),
(280, 2, 16, 28, NULL, 'FLORENCE K MUSILEKWA', 'florence.musilekwa@natsave.co.zm', NULL, '$2y$12$fusFZ5S4HUlCTMBK717areMexHtQ6YZRUaGpLrOV/sA.WStVxjFZu', NULL, '2025-07-11 14:21:48', '2025-07-11 14:21:48'),
(281, 2, 16, 28, NULL, 'MARY TEMBO', 'mary.tembo2@natsave.co.zm', NULL, '$2y$12$ws.3uT/TFnnPs.p1YDV0y.huSKGGvzIPztV09Pchq2ta4QiHbx9/K', NULL, '2025-07-11 14:23:04', '2025-07-11 14:23:04'),
(282, 2, 16, 28, NULL, 'PAMELLAH CHITALIMA', 'pamellah.chitalima@natsave.co.zm', NULL, '$2y$12$rkoU.iQa7fac4vJ2ZU2ZAOfzSr7hIyK0zM50KNiHJI1XIJAP6bCIO', NULL, '2025-07-11 14:24:52', '2025-07-11 14:24:52'),
(283, 2, 16, 28, NULL, 'SATAYA MAKUKULA', 'sataya.makukula@natsave.co.zm', NULL, '$2y$12$PY48M.2inaCah0NsuuEq8.rinodaYSwUe2dWqD61FfEBmpY2g.NUC', NULL, '2025-07-11 14:26:36', '2025-07-11 14:26:36'),
(284, 2, 16, 28, NULL, 'IDAH MADDEN', 'idah.madden@natsave.co.zm', NULL, '$2y$12$8gNIWRwPzeJu5PMjxgNLPuxNcEp86XAta7PqcaNLaV/DP1FpI9EC2', NULL, '2025-07-11 14:27:55', '2025-07-11 14:27:55'),
(285, 2, 16, 29, NULL, 'EMMANUEL SAKALA', 'emmanuel.sakala@natsave.co.zm', NULL, '$2y$12$ur2DO7v8XX.Y7e02A5CMw.Br7wlGL8Pjsi00teDf8tNvINz6lYAxK', NULL, '2025-07-11 14:29:38', '2025-07-11 14:29:38'),
(286, 1, 16, 29, NULL, 'MALELI KAZIKA', 'kazika.maleli@natsave.co.zm', NULL, '$2y$12$336ognulWokHBC8Dg9AYE.lXjskpFYqZrJqk5MMVQWoRHxH6YLuOO', NULL, '2025-07-11 14:30:57', '2025-07-11 14:30:57'),
(287, 2, 16, 29, NULL, 'SENIDA SHAWA', 'senida.shawa@natsave.co.zm', NULL, '$2y$12$9GBrew5pGX2Fbw0o8LE2LuJuQij.DLB3CVcgUa397FLMN35asiOKq', NULL, '2025-07-11 14:32:11', '2025-07-11 14:32:11'),
(288, 2, 16, 31, NULL, 'JAMESON MWANSA', 'jameson.mwansa@natsave.co.zm', NULL, '$2y$12$agml1VgA.60bVgH0de/qke7cCkOKbIuuCJH7sewwHOtt80C5Rug0G', NULL, '2025-07-11 14:33:30', '2025-07-11 14:33:30'),
(289, 2, 16, 31, NULL, 'LIKANDO SILUMESI', 'likando.silumesii@natsave.co.zm', NULL, '$2y$12$JDHdybfXk9wrNQbEOP2ZM.b6Dw4D6rsuax35/ivvDLaUwcTrnCyna', NULL, '2025-07-11 14:36:45', '2025-07-11 14:36:45'),
(290, 2, 16, 31, NULL, 'TAONA PHIRI', 'taona.phiri@natsave.co.zm', NULL, '$2y$12$ZfRN/huTwaPp9I376IFgPefWY5Ee7OG0JnxPJKaFwxiFInyOFO4T2', NULL, '2025-07-11 14:38:07', '2025-07-11 14:38:07'),
(291, 2, 16, 31, NULL, 'BRIAN MUSONDA', 'brian.musonda@natsave.co.zm', NULL, '$2y$12$BrbVN5.EqXEiv4XqdhaxJOZIv.AMhjMhMaid.c76PwJdVmBIdlMDC', NULL, '2025-07-11 14:39:11', '2025-07-11 14:39:11'),
(292, 2, 16, 31, NULL, 'VIVIAN CHISHIMBA', 'vivian.chishimba@natsave.co.zm', NULL, '$2y$12$efUCC2UE7kV6e3oTDLD4Tuq5ECs7GyXcgKFRSrQoJTbkIXFyUwiZy', NULL, '2025-07-11 14:40:28', '2025-07-11 14:40:28'),
(293, 2, 16, 31, NULL, 'ELVIS NGANDWE', 'elvis.ngandwe@natsave.co.zm', NULL, '$2y$12$NFMX7G0PgeBbdAOyv/03WOMYiP4M5.9ArhWfB0aGjJwbKyJgiqNTq', NULL, '2025-07-11 14:41:48', '2025-07-11 14:41:48'),
(294, 2, 16, 31, NULL, 'MARGRET SHAMUZUMBA', 'margret.shamuzumba@natsave.co.zm', NULL, '$2y$12$KPVVdSfOfSPDBEXAyZLEVezaa8F5Lt48zG8R.uIJpjiHjxCCcXlZe', NULL, '2025-07-11 14:43:06', '2025-07-11 14:43:06'),
(295, 2, 16, 31, NULL, 'JENIPHER CHIBESA', 'jenipher.chibesa@natsave.co.zm', NULL, '$2y$12$WGSWB1Q61aop4O0cZCp5cuYt487m0aLJBu1AQzERe8l2CJlw59FfK', NULL, '2025-07-11 14:44:35', '2025-07-11 14:44:35'),
(296, 2, 16, 32, NULL, 'KUFEKISA MATE ', 'kufekisa.mate@natsave.co.zm', NULL, '$2y$12$oBoN9ScKiQfXvsKdg6q1/eWCZybD1rswxXTPegzC4W0WvYyEn6ssi', NULL, '2025-07-11 14:45:59', '2025-07-11 14:45:59'),
(297, 2, 16, 32, NULL, 'KAFULA MUSONDA', 'kafula.musonda@natsave.co.zm', NULL, '$2y$12$4JRe5F1m2XECzS1CRapES.AkfLKd.vSRFSZJ98j9/Kaz5YnbvuCzK', NULL, '2025-07-11 14:47:12', '2025-07-11 14:47:12'),
(298, 2, 16, 32, NULL, 'JOSEPH CHANDA', 'joseph.chanda@natsave.co.zm', NULL, '$2y$12$eAjpn8.ZfLTrut.2FW/MkeFjQsBoZSoK9YvIw9ohP3F9Ri1mWegxO', NULL, '2025-07-11 14:48:16', '2025-07-11 14:48:16'),
(299, 2, 16, 32, NULL, 'PETRONELLA KABULAYA', 'Petronella.Kabulaya@natsave.co.zm', NULL, '$2y$12$re/Bk0rOw5IB95CXvymkwuyRvDBb52BQA.F4L90oTzyFsDd.R1mJy', NULL, '2025-07-11 14:49:38', '2025-07-11 14:49:38'),
(300, 2, 16, 32, NULL, 'EMMANUEL MVULA', 'Emmanuel.Mvula@natsave.co.zm', NULL, '$2y$12$IJ2OHwUQmnAivDyt5tE69ugu4x3V30Ev.BjR7E0OWD3C2fS8KKTKa', NULL, '2025-07-11 14:50:29', '2025-07-11 14:50:29'),
(301, 2, 16, 32, NULL, 'STANLEY HATUYUNI', 'Stanley.Hatuyuni@natsave.co.zm', NULL, '$2y$12$T3y94O.ECSnn2jVVf/vbnOGIKRamt6r0w31p72MTIOVjeq2W0VwRa', NULL, '2025-07-11 14:52:15', '2025-07-11 14:52:15'),
(302, 2, 16, 32, NULL, 'ABIGAIL MBUNDA', 'Abigail.Mbunda@natsave.co.zm', NULL, '$2y$12$c5S7lWOE59GC.uvAzhSBjO55idIEt6cobe//PaHyB5lrvulNotnMa', NULL, '2025-07-11 14:53:25', '2025-07-11 14:53:25'),
(303, 2, 16, 32, NULL, 'CHIPETA TUMBIKO', 'thumbiko.chipeta@natsave.co.zm', NULL, '$2y$12$0iDH48r4OHI4HJBoXOh7DOeKIu5ZRQwQoFzxa2m2WB7rsBQTdvo1q', NULL, '2025-07-11 14:55:37', '2025-07-11 14:55:37'),
(304, 2, 16, 32, NULL, 'ANNETTE TEMBA MUTILA', 'annette.mutila@natsave.co.zm', NULL, '$2y$12$KYZ40uLBtL3fgJBz9e1/WO84xHdI6xNgxoG3674DDheWKw3v6bbO2', NULL, '2025-07-11 14:59:59', '2025-07-11 14:59:59'),
(305, 2, 16, 29, NULL, 'ALBERT NGULUBE', 'albert.ngulube@natsave.co.zm', NULL, '$2y$12$lfOCPJtMVCxSi63j8HISuunrAAEh5CAlDaGvSLXTKQLDzPZx2fneq', NULL, '2025-07-11 15:03:40', '2025-07-11 15:03:40'),
(306, 2, 16, 29, NULL, 'RAY MUKWAVI', 'Ray.Mukwavi@natsave.co.zm', NULL, '$2y$12$IvVu1DZcIqRIiA1TOapLzeQwKPZF7X4POaIUGCDb81wK9t.vOEVP.', NULL, '2025-07-11 15:04:24', '2025-07-11 15:04:24'),
(307, 2, 16, 20, NULL, 'KASAPO MWELWA', 'kasapo.mwelwa@natsave.co.zm', NULL, '$2y$12$Fb7f.yYWYBYl0HI7LMBNnu1yPQZE9LE3CwnqjGuJxd5JCujFCvtYW', NULL, '2025-07-14 07:09:36', '2025-07-14 07:09:36'),
(308, 2, 16, 29, NULL, 'REX PHIRI', 'rex.phiri@natsave.co.zm', NULL, '$2y$12$LaQY6RayIkD7jhOM4BROV.ZcVGdOx1xZE223WouSO/iV/98dObJFa', NULL, '2025-07-14 07:11:59', '2025-07-14 07:11:59'),
(309, 2, 5, 4, NULL, 'Kalizya Mofya', 'Kalizya.Mofya@natsave.co.zm', NULL, '$2y$12$4j1Z39hhelzEfpQ8/Zp6oOVqnMtiVy01oyMSQ/Y1DR0O8u.zKMLRe', NULL, '2025-07-17 15:40:09', '2025-07-17 15:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_module_progress`
--

CREATE TABLE `user_module_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `first_accessed_at` timestamp NULL DEFAULT NULL,
  `last_accessed_at` timestamp NULL DEFAULT NULL,
  `total_lessons` int(11) NOT NULL DEFAULT 0,
  `completed_lessons` int(11) NOT NULL DEFAULT 0,
  `total_quizzes` int(11) NOT NULL DEFAULT 0,
  `completed_quizzes` int(11) NOT NULL DEFAULT 0,
  `overall_progress` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('assigned','in_progress','completed') NOT NULL DEFAULT 'assigned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `document_downloads`
--
ALTER TABLE `document_downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_downloads_user_id_lesson_id_index` (`user_id`,`lesson_id`),
  ADD KEY `document_downloads_downloaded_at_index` (`downloaded_at`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_user_activities`
--
ALTER TABLE `lesson_user_activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_user_activities_user_id_lesson_id_unique` (`user_id`,`lesson_id`),
  ADD KEY `lesson_user_activities_user_id_module_id_index` (`user_id`,`module_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_user`
--
ALTER TABLE `module_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_user_user_id_foreign` (`user_id`),
  ADD KEY `module_user_module_id_foreign` (`module_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzs`
--
ALTER TABLE `quizzs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_module_progress`
--
ALTER TABLE `user_module_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_module_progress_user_id_module_id_unique` (`user_id`,`module_id`),
  ADD KEY `user_module_progress_user_id_status_index` (`user_id`,`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `audit_trails`
--
ALTER TABLE `audit_trails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=850;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_downloads`
--
ALTER TABLE `document_downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lesson_user_activities`
--
ALTER TABLE `lesson_user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `module_user`
--
ALTER TABLE `module_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quizzs`
--
ALTER TABLE `quizzs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `user_module_progress`
--
ALTER TABLE `user_module_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `module_user`
--
ALTER TABLE `module_user`
  ADD CONSTRAINT `module_user_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `module_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
