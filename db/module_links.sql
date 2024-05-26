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
-- Table structure for table `module_links`
--

CREATE TABLE `module_links` (
  `id` int(11) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `request_type` char(25) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link_type` int(11) DEFAULT NULL,
  `module_id` int(50) DEFAULT NULL,
  `main_menu_id` int(50) DEFAULT NULL,
  `sub_menu_id` int(50) DEFAULT NULL,
  `active_status` char(25) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_links`
--

INSERT INTO `module_links` (`id`, `url`, `controller`, `method`, `request_type`, `name`, `link_type`, `module_id`, `main_menu_id`, `sub_menu_id`, `active_status`, `created_at`, `updated_at`) VALUES
(6, '/module/index', 'Module\\ModuleController', 'moduleIndex', 'get', 'module-index', 2, 54, 55, NULL, '1', '2024-05-25 01:20:22', '2024-05-25 01:20:22'),
(7, '/menu/index', 'Module\\MenuController', 'menuIndex', 'get', 'menu-index', 2, 54, 56, NULL, '1', '2024-05-25 01:34:17', '2024-05-25 01:34:17'),
(8, '/module/link/index', 'Module\\ModuleLinkController', 'linkIndex', 'get', 'module-link-index', 2, 54, 57, NULL, '1', '2024-05-25 01:45:21', '2024-05-25 01:45:21'),
(13, '/module/create', 'Module\\ModuleController', 'moduleCreate', 'get', 'module-create', NULL, 54, NULL, NULL, '1', '2024-05-25 02:16:40', '2024-05-25 02:16:40'),
(14, '/module/store', 'Module\\ModuleController', 'moduleStore', 'post', 'module-store', NULL, 54, NULL, NULL, '1', '2024-05-25 02:28:41', '2024-05-25 02:28:41'),
(15, '/module/edit/{id}', 'Module\\ModuleController', 'moduleEdit', 'get', 'module-edit', NULL, 54, NULL, NULL, '1', '2024-05-25 02:34:41', '2024-05-25 02:34:41'),
(16, '/module/update', 'Module\\ModuleController', 'moduleUpdate', 'patch', 'module-update', NULL, 54, NULL, NULL, '1', '2024-05-25 02:39:46', '2024-05-25 02:39:46'),
(18, '/module/status', 'Module\\ModuleController', 'moduleStatus', 'put', 'module-status', NULL, 54, NULL, NULL, '1', '2024-05-25 02:47:19', '2024-05-25 02:47:19'),
(19, '/module/delete', 'Module\\ModuleController', 'moduleDelete', 'delete', 'module-delete', NULL, 54, NULL, NULL, '1', '2024-05-25 02:49:56', '2024-05-25 02:49:56'),
(20, '/module/path/{id}', 'Module\\ModuleController', 'path', 'get', 'module-path', NULL, 54, NULL, NULL, '1', '2024-05-25 02:54:21', '2024-05-25 02:54:21'),
(21, '/menu/create', 'Module\\ModuleController', 'menuCreate', 'get', 'menu-create', NULL, NULL, NULL, NULL, '1', '2024-05-25 03:00:24', '2024-05-25 03:00:24'),
(22, '/menu/store', 'Module\\ModuleController', 'menuStore', 'post', 'menu-store', NULL, NULL, NULL, NULL, '1', '2024-05-25 03:10:32', '2024-05-25 03:10:32'),
(23, '/module/link/create', 'Module\\ModuleLinkController', 'linkCreate', 'get', 'module-link-create', NULL, NULL, NULL, NULL, '1', '2024-05-25 03:14:25', '2024-05-25 03:14:25'),
(24, '/module/link/store', 'Module\\ModuleLinkController', 'linkStore', 'post', 'module-link-store', NULL, NULL, NULL, NULL, '1', '2024-05-25 03:22:56', '2024-05-25 03:22:56'),
(25, '//', 'Module\\HomeController', 'index', 'get', '', NULL, NULL, NULL, NULL, '1', '2024-05-25 03:34:27', '2024-05-25 03:34:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module_links`
--
ALTER TABLE `module_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module_links`
--
ALTER TABLE `module_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
