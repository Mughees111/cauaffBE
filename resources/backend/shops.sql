-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2021 at 04:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hairapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `address` text COLLATE utf8mb4_bin DEFAULT NULL,
  `lat` decimal(20,7) DEFAULT NULL,
  `lng` decimal(20,7) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` text COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `meta_title` varchar(150) COLLATE utf8mb4_bin DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_bin DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_bin DEFAULT NULL,
  `monday` int(1) NOT NULL DEFAULT 0,
  `monday_opens` time DEFAULT NULL,
  `monday_closes` time DEFAULT NULL,
  `tuesday` int(1) NOT NULL DEFAULT 0,
  `tuesday_opens` time DEFAULT NULL,
  `tuesday_closes` time DEFAULT NULL,
  `wednesday` int(1) NOT NULL DEFAULT 0,
  `wednesday_opens` time DEFAULT NULL,
  `wednesday_closes` time DEFAULT NULL,
  `thursday` int(1) NOT NULL DEFAULT 0,
  `thursday_opens` time DEFAULT NULL,
  `thursday_closes` time DEFAULT NULL,
  `friday` int(1) NOT NULL DEFAULT 0,
  `friday_opens` time DEFAULT NULL,
  `friday_closes` time DEFAULT NULL,
  `saturday` int(1) NOT NULL DEFAULT 0,
  `saturday_opens` time DEFAULT NULL,
  `saturday_closes` time DEFAULT NULL,
  `sunday` int(1) NOT NULL DEFAULT 0,
  `sunday_opens` time DEFAULT NULL,
  `sunday_closes` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `lparent`, `lang_id`, `parent_id`, `title`, `address`, `lat`, `lng`, `slug`, `description`, `image`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`, `meta_title`, `meta_keywords`, `meta_description`, `monday`, `monday_opens`, `monday_closes`, `tuesday`, `tuesday_opens`, `tuesday_closes`, `wednesday`, `wednesday_opens`, `wednesday_closes`, `thursday`, `thursday_opens`, `thursday_closes`, `friday`, `friday_opens`, `friday_closes`, `saturday`, `saturday_opens`, `saturday_closes`, `sunday`, `sunday_opens`, `sunday_closes`) VALUES
(10, 7, 0, 0, 0, 'YouTube', 'IT tower Lahore pakistan, P1-45, P1-45, P1-45, P1-45', '50.0000000', '50.0000000', NULL, NULL, '624bdcdcf2f008cdf911ee57aa56d27f.jpg', 1, '2020-08-25 22:03:59', 1, '2020-10-10 11:23:38', 1, 0, 1, NULL, NULL, NULL, 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00', 0, '08:30:00', '20:30:00'),
(11, 7, 0, 0, 0, 'YouTube2', 'IT tower Lahore pakistan, P1-45, P1-45, P1-45, P1-45', '4343.0000000', '3434.0000000', NULL, NULL, '053de5e459295ce3fb3f6f0c6bc697cc.jpg', 1, '2020-08-25 23:11:05', 1, '2020-10-10 11:52:47', 1, 0, 0, NULL, NULL, NULL, 1, '08:32:00', '20:30:00', 1, '08:30:00', '22:34:00', 1, '08:30:00', '20:30:00', 1, '08:30:00', '22:30:00', 1, '09:30:00', '22:30:00', 1, '09:30:00', '23:30:00', 1, '08:30:00', '13:30:00'),
(12, 14, 0, 0, 0, 'Fubtechx', 'this is some description', '31.4127000', '73.1180000', NULL, NULL, '3108da6b3229475d29942d3023f48ee8.jpg', 1, '2020-08-26 11:53:00', 1, '2020-10-10 12:27:05', 1, 0, 0, NULL, NULL, NULL, 1, '05:30:00', '20:30:00', 1, '05:29:00', '20:30:00', 1, '05:30:00', '22:30:00', 1, '05:30:00', '17:30:00', 1, '05:30:00', '17:30:00', 1, '05:30:00', '20:30:00', 0, '08:30:00', '20:30:00'),
(13, 17, 0, 0, 0, 'Barber001 saloon', 'ABC Town', '31.4126891', '73.1154766', NULL, NULL, NULL, 1, '2020-10-10 12:37:22', 17, '2020-10-10 12:37:22', 17, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(14, 18, 0, 0, 0, 'wole saloon', 'ABC Town', '40.7134956', '-74.2133080', NULL, NULL, NULL, 1, '2020-10-29 05:13:56', 18, '2020-10-29 05:13:56', 18, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(15, 19, 0, 0, 0, 'olu saloon', 'ABC Town', '40.7135032', '-74.2133248', NULL, NULL, NULL, 1, '2020-10-29 05:18:34', 19, '2020-10-29 05:18:34', 19, 0, 1, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(16, 20, 0, 0, 0, 'isyy barber ', '145 Goodwin Avenue Newark NJ 07112', '40.7133410', '-74.2140806', NULL, NULL, NULL, 1, '2020-10-29 05:27:35', 20, '2020-10-29 05:27:35', 20, 0, 1, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(17, 21, 0, 0, 0, 'Usama malik saloon', 'ABC Town', '31.4126688', '73.1153523', NULL, NULL, NULL, 1, '2020-10-29 13:39:57', 21, '2020-10-29 13:39:57', 21, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(18, 22, 0, 0, 0, 'Jug Head saloon', 'ABC Town', '31.5159020', '74.3409681', NULL, NULL, NULL, 1, '2020-11-02 10:41:04', 22, '2020-11-02 10:41:04', 22, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(19, 23, 0, 0, 0, 'Shop saloon', 'ABC Town', '31.4126657', '73.1153855', NULL, NULL, NULL, 1, '2020-11-02 13:04:32', 23, '2020-11-02 13:04:32', 23, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(20, 24, 0, 0, 0, 'Loke like', 'ABC Town', '31.5159114', '74.3409974', NULL, NULL, NULL, 1, '2020-11-02 18:46:08', 24, '2020-11-02 18:46:08', 24, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(21, 25, 0, 0, 0, 'Dexi Crew saloon', 'ABC Town', '31.4126642', '73.1153794', NULL, NULL, '96a90f14-4634-4565-abdb-646ef6f8f568.jpg', 1, '2020-11-04 13:48:26', 25, '2020-11-04 13:48:26', 25, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(22, 26, 0, 0, 0, 'Fubtechx x saloon', 'ABC Town', '31.4181242', '73.0772357', NULL, NULL, '574d6efd-f3de-430a-9ddf-1bef80b02283.jpg', 1, '2020-11-05 00:23:21', 26, '2020-11-05 00:23:21', 26, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(23, 27, 0, 0, 0, 'Tato saloon', '2404929648', '38.9326304', '-76.9064827', NULL, NULL, 'a73adafa-3767-47a1-8d04-ef474d641235.jpg', 1, '2020-11-07 07:27:11', 27, '2020-11-07 07:27:11', 27, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(24, 28, 0, 0, 0, 'Fola saloon', 'ABC Town', '38.9326058', '-76.9064935', NULL, NULL, NULL, 1, '2020-11-07 07:30:45', 28, '2020-11-07 07:30:45', 28, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(25, 29, 0, 0, 0, 'Barbar saloon', 'ABC Town', '31.4173589', '73.0762644', NULL, NULL, NULL, 1, '2020-11-11 00:12:56', 29, '2020-11-11 00:12:56', 29, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(26, 30, 0, 0, 0, 'Johndoe  saloon', 'ABC Town', NULL, NULL, NULL, NULL, NULL, 1, '2020-11-14 19:24:45', 30, '2020-11-14 19:24:45', 30, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(27, 31, 0, 0, 0, 'Muhammad Kashif saloon', 'Kohinoor plaza No1 , Faisalabad', '31.4126995', '73.1154028', NULL, NULL, '672f5c70-c91a-4738-b5be-3b621397771d.jpg', 1, '2020-12-11 12:15:50', 31, '2020-12-11 12:15:50', 31, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00'),
(28, 12, 0, 0, 0, 'Isaac ayeni saloon', 'ABC Town', '4343.0000000', '74.3409681', NULL, NULL, NULL, 1, '2021-01-04 06:38:35', 32, '2021-03-25 03:11:33', 1, 0, 0, NULL, NULL, NULL, 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00', 1, '09:00:00', '21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
