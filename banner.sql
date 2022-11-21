-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2022 at 06:41 PM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banner`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner_users`
--

DROP TABLE IF EXISTS `banner_users`;
CREATE TABLE IF NOT EXISTS `banner_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_date` datetime NOT NULL,
  `page_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views_count` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_users`
--

INSERT INTO `banner_users` (`id`, `ip_address`, `user_agent`, `view_date`, `page_url`, `views_count`) VALUES
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Sa', '2022-11-21 18:40:30', '', 1),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Sa', '2022-11-21 18:40:34', 'index1.html', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
