-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 08:41 PM
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
  `prefix` varchar(20) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `request_type` char(25) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link_type` int(11) DEFAULT NULL,
  `module_id` int(50) DEFAULT NULL,
  `main_menu_id` int(50) DEFAULT NULL,
  `sub_menu_id` int(50) DEFAULT NULL,
  `middlewares` varchar(50) DEFAULT NULL,
  `permission` int(20) NOT NULL,
  `active_status` char(25) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_links`
--

INSERT INTO `module_links` (`id`, `prefix`, `url`, `controller`, `method`, `request_type`, `name`, `link_type`, `module_id`, `main_menu_id`, `sub_menu_id`, `middlewares`, `permission`, `active_status`, `created_at`, `updated_at`) VALUES
(1, NULL, '//', 'SecurityAndAccess\\HomeController', 'index', 'get', 'home', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-05-25 03:34:27', '2024-05-25 03:34:27'),
(2, '/securityandaccess', '/security/access/index', 'SecurityAndAccess\\SecurityAndAccessController', 'index', 'get', 'security-access-index', 1, 1, NULL, NULL, NULL, 0, '1', '2024-06-01 15:56:10', '2024-06-10 17:25:54'),
(3, '/securityandaccess', '/module/search', 'SecurityAndAccess\\ModuleController', 'moduleSearch', 'get', 'module-search', 2, 1, 2, NULL, NULL, 0, '1', '2024-05-30 16:29:28', '2024-06-10 17:05:38'),
(4, '/securityandaccess', '/module/create', 'SecurityAndAccess\\ModuleController', 'moduleCreate', 'get', 'module-create', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:16:40', '2024-06-08 17:27:55'),
(5, '/securityandaccess', '/module/store', 'SecurityAndAccess\\ModuleController', 'moduleStore', 'post', 'module-store', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:28:41', '2024-06-08 16:38:33'),
(6, '/securityandaccess', '/module/edit/{id}', 'SecurityAndAccess\\ModuleController', 'moduleEdit', 'get', 'module-edit', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:34:41', '2024-05-25 02:34:41'),
(7, '/securityandaccess', '/module/update', 'SecurityAndAccess\\ModuleController', 'moduleUpdate', 'patch', 'module-update', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:39:46', '2024-05-25 02:39:46'),
(8, '/securityandaccess', '/module/status', 'SecurityAndAccess\\ModuleController', 'moduleStatus', 'put', 'module-status', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:47:19', '2024-05-25 02:47:19'),
(9, '/securityandaccess', '/module/delete', 'SecurityAndAccess\\ModuleController', 'moduleDelete', 'delete', 'module-delete', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-05-25 02:49:56', '2024-06-22 18:25:07'),
(10, '/securityandaccess', '/menu/index', 'SecurityAndAccess\\ModuleController', 'menuIndex', 'get', 'menu-index', 2, 1, 3, NULL, NULL, 0, '1', '2024-05-25 01:34:17', '2024-05-25 01:34:17'),
(11, '/securityandaccess', '/menu/create', 'SecurityAndAccess\\ModuleController', 'menuCreate', 'get', 'menu-create', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-05-25 03:00:24', '2024-05-25 03:00:24'),
(12, '/securityandaccess', '/menu/store', 'SecurityAndAccess\\ModuleController', 'menuStore', 'post', 'menu-store', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-05-25 03:10:32', '2024-06-08 17:49:45'),
(13, '/securityandaccess', '/module/link/index', 'SecurityAndAccess\\ModuleLinkController', 'linkIndex', 'get', 'module-link-index', 2, 1, 4, NULL, NULL, 0, '1', '2024-05-25 01:45:21', '2024-06-10 15:55:55'),
(14, '/securityandaccess', '/module/link/create', 'SecurityAndAccess\\ModuleLinkController', 'linkCreate', 'get', 'module-link-create', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-05-25 03:14:25', '2024-06-08 16:38:43'),
(15, '/securityandaccess', '/module/link/store', 'SecurityAndAccess\\ModuleLinkController', 'linkStore', 'post', 'module-link-store', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-05-25 03:22:56', '2024-05-25 03:22:56'),
(67, '/securityandaccess', '/middleware/search', 'SecurityAndAccess\\MiddlewareController', 'middlewareSearch', 'get', 'middleware-search', 2, 1, 70, NULL, NULL, 0, '1', '2024-06-01 17:52:39', '2024-06-01 17:52:39'),
(68, '/securityandaccess', '/middleware/create', 'SecurityAndAccess\\MiddlewareController', 'middlewareCreate', 'get', 'middleware-create', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-06-01 17:58:21', '2024-06-01 17:58:21'),
(69, '/securityandaccess', '/middleware/store', 'SecurityAndAccess\\MiddlewareController', 'middlewareStore', 'post', 'middleware-store', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-06-01 17:59:06', '2024-06-01 17:59:06'),
(70, '/securityandaccess', '/assign/middleware', 'SecurityAndAccess\\AssignMiddlewareController', 'assignMiddlewareToRoute', 'get', 'securityandaccess.assign-middleware', 3, 1, 70, 71, NULL, 0, '1', '2024-06-02 13:47:04', '2024-06-02 13:47:04'),
(74, '/securityandaccess', '/add/middleware', 'SecurityAndAccess\\AssignMiddlewareController', 'addMiddleware', 'post', 'securityandaccess.add.middleware', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-06-03 13:37:45', '2024-06-03 13:37:45'),
(75, '/securityandaccess', '/add/route', 'SecurityAndAccess\\AssignMiddlewareController', 'addRoute', 'post', 'securityandaccess.add.route', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-06-03 13:40:01', '2024-06-03 13:40:01'),
(76, '/securityandaccess', '/remove/route', 'SecurityAndAccess\\AssignMiddlewareController', 'removeRoute', 'delete', 'securityandaccess.remove.route', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-06-05 19:16:22', '2024-06-05 19:16:22'),
(77, '/securityandaccess', '/remove/middleware', 'SecurityAndAccess\\AssignMiddlewareController', 'removeMiddleware', 'delete', 'securityandaccess.remove.middleware', NULL, 1, NULL, NULL, NULL, 0, '1', '2024-06-07 12:38:34', '2024-06-07 12:38:34'),
(78, '/securityandaccess', '/assign', 'SecurityAndAccess\\AssignMiddlewareController', 'assign', 'delete', 'securityandaccess.assign', NULL, NULL, NULL, NULL, NULL, 0, '1', '2024-06-07 14:08:37', '2024-06-07 14:08:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
