-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 06:22 PM
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
(1, 'Security and Access', '1', 1, NULL, '', '<i class=\"fa-solid fa-bangladeshi-taka-sign\"></i>', '1', '2024-05-24 19:12:42', '2024-05-29 12:20:56'),
(2, 'Module', '2', 1, 1, '', NULL, '1', '2024-05-24 19:13:30', '2024-05-24 19:13:30'),
(3, 'Menu', '2', 2, 1, '', NULL, '1', '2024-05-24 19:13:42', '2024-05-24 19:13:42'),
(4, 'Module Link', '2', 3, 1, '', NULL, '1', '2024-05-24 19:14:01', '2024-05-24 19:14:01');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
