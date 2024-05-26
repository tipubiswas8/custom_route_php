-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 07:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel11`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` char(255) NOT NULL,
  `serial` int(11) NOT NULL,
  `parent_module_id` int(30) DEFAULT NULL,
  `parent_menu_id` char(255) NOT NULL,
  `icon` varchar(400) DEFAULT NULL,
  `active_status` text NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `type`, `serial`, `parent_module_id`, `parent_menu_id`, `icon`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'SA', '1', 1, NULL, '', NULL, '1', '2024-05-13 01:13:58', '2024-05-13 01:13:58'),
(2, 'Payroll', '1', 2, NULL, '', NULL, '1', '2024-05-13 01:14:21', '2024-05-21 11:31:55'),
(3, 'HRM', '1', 3, NULL, '', NULL, '1', '2024-05-13 01:14:56', '2024-05-24 20:48:40'),
(4, 'Account', '1', 4, NULL, '', NULL, '1', '2024-05-13 01:15:03', '2024-05-21 11:31:40'),
(5, 'Module', '2', 1, 1, '', NULL, '1', '2024-05-13 01:17:54', '2024-05-13 01:17:54'),
(6, 'Menu', '2', 2, 1, '', NULL, '1', '2024-05-13 01:19:53', '2024-05-13 01:19:53'),
(7, 'Module Link', '2', 3, 1, '', NULL, '1', '2024-05-13 01:20:26', '2024-05-13 01:20:26'),
(8, 'MM1 for HRM', '2', 1, 3, '', NULL, '1', '2024-05-13 01:21:05', '2024-05-13 01:21:05'),
(9, 'sm1 for mm1 sa', '3', 1, 1, '5', NULL, '1', '2024-05-13 01:22:30', '2024-05-13 01:22:30'),
(10, 'sm2 for mm1 sa', '3', 2, 1, '5', NULL, '1', '2024-05-13 01:22:50', '2024-05-13 01:22:50'),
(11, 'sm1 for mm2 sa', '3', 1, 1, '6', NULL, '1', '2024-05-13 01:24:33', '2024-05-13 01:24:33'),
(12, 'MM2 for Payroll', '2', 2, 2, '', NULL, '1', '2024-05-13 02:57:27', '2024-05-13 02:57:27'),
(13, 'sm1 for mm2 payroll', '3', 1, 2, '12', NULL, '1', '2024-05-13 02:58:12', '2024-05-13 02:58:12'),
(14, 'MM1 for Account', '2', 1, 4, '', NULL, '1', '2024-05-13 03:06:12', '2024-05-13 03:06:12'),
(15, 'sm1 for mm1 acc', '3', 1, 4, '14', NULL, '1', '2024-05-13 03:10:46', '2024-05-13 03:10:46'),
(26, 'MM2 for Account', '2', 4, 4, '', NULL, '1', '2024-05-21 12:06:42', '2024-05-21 12:06:42'),
(27, 'sm1 for mm2 ac', '3', 2, 4, '26', NULL, '1', '2024-05-21 12:07:29', '2024-05-21 12:07:29'),
(28, 'sm2 for mm2 ac', '3', 9, 4, '26', NULL, '1', '2024-05-21 12:08:06', '2024-05-21 12:08:06'),
(46, 'MM2 for HRM', '2', 3, 3, '', NULL, '1', '2024-05-21 20:21:13', '2024-05-21 20:21:13'),
(48, 'sm2 for mm2 h', '3', 20, 3, '46', NULL, '1', '2024-05-21 20:22:38', '2024-05-21 20:22:38'),
(49, 'sm1 for mm2 h', '3', 21, 3, '46', NULL, '1', '2024-05-21 20:23:01', '2024-05-21 20:23:01'),
(50, 'sm1 for mm1 hr', '3', 3, 3, '47', NULL, '1', '2024-05-21 20:23:37', '2024-05-21 20:23:37'),
(54, 'Project', '1', 5, NULL, '', NULL, '1', '2024-05-24 19:12:42', '2024-05-24 19:12:42'),
(55, 'Module', '2', 1, 54, '', NULL, '1', '2024-05-24 19:13:30', '2024-05-24 19:13:30'),
(56, 'Menu', '2', 2, 54, '', NULL, '1', '2024-05-24 19:13:42', '2024-05-24 19:13:42'),
(57, 'Module Link', '2', 3, 54, '', NULL, '1', '2024-05-24 19:14:01', '2024-05-24 19:14:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
