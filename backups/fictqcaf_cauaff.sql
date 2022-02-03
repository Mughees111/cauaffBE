-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2022 at 05:34 AM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fictqcaf_cauaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `assigned_on` datetime NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(11) UNSIGNED NOT NULL,
  `app_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `app_date` date NOT NULL,
  `app_services` varchar(1000) NOT NULL,
  `app_price` float(8,2) NOT NULL,
  `app_est_duration` int(4) NOT NULL,
  `app_start_time` varchar(64) DEFAULT NULL,
  `app_end_time` varchar(64) DEFAULT NULL,
  `app_slots` varchar(255) NOT NULL,
  `app_status` varchar(16) NOT NULL,
  `sal_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_gender` varchar(64) NOT NULL,
  `app_rating` varchar(8) DEFAULT NULL,
  `app_review` varchar(500) DEFAULT NULL,
  `app_review_datetime` datetime DEFAULT NULL,
  `app_user_info` varchar(255) DEFAULT NULL,
  `app_last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `is_paid` tinyint(4) NOT NULL DEFAULT 0,
  `payment_method` text NOT NULL DEFAULT 'cash',
  `cancelled_by` varchar(64) DEFAULT NULL,
  `cancelled_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `app_created`, `app_date`, `app_services`, `app_price`, `app_est_duration`, `app_start_time`, `app_end_time`, `app_slots`, `app_status`, `sal_id`, `user_id`, `user_gender`, `app_rating`, `app_review`, `app_review_datetime`, `app_user_info`, `app_last_modified`, `is_paid`, `payment_method`, `cancelled_by`, `cancelled_reason`) VALUES
(4, '2022-01-16 15:03:13', '2022-01-17', 'Facial,Manicure,Hair cut', 370.00, 140, '13:30', '15:50', '', 'cancelled', 54748, 8, 'male', NULL, NULL, NULL, NULL, '2022-01-16 10:03:13', 1, 'stripe', NULL, NULL),
(5, '2022-01-17 13:02:49', '2022-01-19', 'Facial,Hair cut', 220.00, 80, '08:00', '09:20', '17,18,19', 'pending', 54748, 8, 'male', NULL, NULL, NULL, NULL, '2022-01-17 08:02:49', 1, 'stripe', NULL, NULL),
(6, '2022-01-17 13:29:02', '2022-01-17', 'Facial', 120.00, 30, '08:00', '08:30', '17', 'pending', 54749, 8, 'male', NULL, NULL, NULL, NULL, '2022-01-17 08:29:02', 0, 'cash', NULL, NULL),
(7, '2022-01-17 13:49:23', '2022-01-17', 'Predicure,Hair cut', 250.00, 90, '17:00', '18:30', '35,36,37', 'pending', 54748, 8, 'female', NULL, NULL, NULL, NULL, '2022-01-17 08:49:23', 0, 'cash', NULL, NULL),
(8, '2022-01-17 14:13:47', '2022-01-19', 'Facial,Hair cut', 220.00, 80, '09:30', '10:50', '20,21,22', 'pending', 54748, 14, 'male', NULL, NULL, NULL, NULL, '2022-01-17 09:13:47', 1, 'stripe', NULL, NULL),
(9, '2022-01-17 19:56:21', '2022-01-18', 'Hair cut', 50.00, 45, '10:00', '10:45', '21,22', 'pending', 54747, 8, 'female', NULL, NULL, NULL, NULL, '2022-01-17 14:56:21', 0, 'cash', NULL, NULL),
(10, '2022-01-18 15:59:46', '2022-01-18', 'Hair cut', 50.00, 45, '11:00', '11:45', '23,24', 'pending', 54747, 8, 'male', NULL, NULL, NULL, NULL, '2022-01-18 10:59:46', 0, 'cash', NULL, NULL),
(11, '2022-01-19 15:39:37', '2022-01-27', 'Hair cut', 50.00, 45, '09:00', '09:45', '', 'cancelled', 54747, 13, 'male', NULL, NULL, NULL, NULL, '2022-01-19 10:39:37', 1, 'stripe', NULL, NULL),
(12, '2022-01-23 11:43:03', '2022-01-24', 'Men\'s hair cut', 100.00, 25, '10:00', '10:25', '', 'cancelled', 54752, 16, 'male', NULL, NULL, NULL, NULL, '2022-01-23 06:43:03', 0, 'cash', 'user', NULL),
(13, '2022-01-23 11:47:19', '2022-01-24', 'Men\'s hair cut', 100.00, 25, '10:30', '10:55', '22', 'scheduled', 54752, 16, 'male', NULL, NULL, NULL, NULL, '2022-01-23 06:47:19', 0, 'cash', NULL, NULL),
(14, '2022-01-26 08:58:00', '2022-01-26', 'cutt', 60.00, 50, '10:30', '11:20', '', 'cancelled', 54754, 18, 'male', NULL, NULL, NULL, NULL, '2022-01-26 03:58:00', 0, 'cash', 'salon', 'Go duck ur self\nAlternative time 2022-01-27 07:00'),
(15, '2022-01-26 09:03:19', '2022-01-29', 'cutt', 60.00, 50, '10:00', '10:50', '21,22', 'pending', 54754, 19, 'female', NULL, NULL, NULL, NULL, '2022-01-26 04:03:19', 1, 'stripe', NULL, NULL),
(16, '2022-01-27 01:54:02', '2022-01-26', 'Facial', 120.00, 30, '18:00', '18:30', '', 'cancelled', 54749, 13, 'female', NULL, NULL, NULL, NULL, '2022-01-26 20:54:02', 0, 'cash', 'user', NULL),
(17, '2022-01-29 14:04:23', '2022-01-30', 'Manicure', 120.00, 30, '08:00', '08:30', '17', 'scheduled', 54756, 21, 'male', NULL, NULL, NULL, NULL, '2022-01-29 09:04:23', 0, 'cash', NULL, NULL),
(18, '2022-01-29 14:04:45', '2022-01-30', 'Manicure', 120.00, 30, '09:30', '10:00', '20', 'pending', 54756, 20, 'male', NULL, NULL, NULL, NULL, '2022-01-29 09:04:45', 0, 'cash', NULL, NULL),
(19, '2022-01-29 14:09:40', '2022-01-31', 'Manicure', 120.00, 30, '11:30', '12:00', '24', 'scheduled', 54756, 20, 'male', NULL, NULL, NULL, NULL, '2022-01-29 09:09:40', 0, 'cash', NULL, NULL),
(20, '2022-01-29 14:14:48', '2022-01-29', 'Manicure', 120.00, 30, '10:00', '10:30', '', 'cancelled', 54756, 20, 'male', NULL, NULL, NULL, NULL, '2022-01-29 09:14:48', 0, 'cash', 'user', NULL),
(21, '2022-01-29 14:15:48', '2022-01-29', 'Manicure', 120.00, 30, '09:30', '10:00', '20', 'scheduled', 54756, 22, 'male', NULL, NULL, NULL, NULL, '2022-01-29 09:15:48', 0, 'cash', NULL, NULL),
(22, '2022-01-29 17:40:54', '2022-01-29', 'Facial', 150.00, 40, '09:30', '10:10', '20,21', 'scheduled', 54758, 23, 'male', NULL, NULL, NULL, NULL, '2022-01-29 12:40:54', 0, 'cash', NULL, NULL),
(23, '2022-01-31 04:17:50', '2022-02-01', 'Hair test 1', 35.00, 45, '10:30', '11:15', '22,23', 'pending', 54759, 13, 'male', NULL, NULL, NULL, NULL, '2022-01-30 23:17:50', 0, 'cash', NULL, NULL),
(24, '2022-02-01 18:06:32', '2022-02-02', 'Hair cut', 30.00, 60, '08:00', '09:00', '17,18', 'pending', 54760, 24, 'male', NULL, NULL, NULL, NULL, '2022-02-01 13:06:32', 0, 'cash', NULL, NULL),
(25, '2022-02-01 20:04:23', '2022-02-02', 'Hair color', 120.00, 90, '14:00', '15:30', '29,30,31', 'scheduled', 54760, 24, 'male', NULL, NULL, NULL, NULL, '2022-02-01 15:04:23', 0, 'cash', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`, `type`) VALUES
(1, 'terms_of_services', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n                                                 \r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'app'),
(2, 'cancellation_policy', 'This is the simple test cancellation policy', 'app');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `fav_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `sal_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`fav_id`, `user_id`, `sal_id`) VALUES
(7, 2, 54747),
(15, 6, 54747),
(19, 8, 54747);

-- --------------------------------------------------------

--
-- Table structure for table `notificationss`
--

CREATE TABLE `notificationss` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `notification_type_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `create_at` datetime NOT NULL,
  `push_in` tinyint(4) NOT NULL DEFAULT 0,
  `read_it` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(20,7) NOT NULL DEFAULT 0.0000000,
  `method` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `object` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `method`, `created_at`, `object`, `token`, `app_id`) VALUES
(1, 6, 50.0000000, 'PayPal', '2022-01-17 15:14:47', '{\"id\":\"4AG31326B7851463Y\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"50.00\"},\"payee\":{\"email_address\":\"seller@dedevelopers.com\",\"merchant_id\":\"R34FNY5694KBY\"},\"shipping\":{\"name\":{\"full_name\":\"Buyer Test\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"6VX54512UL120332W\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"50.00\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-01-17T10:14:47Z\",\"update_time\":\"2022-01-17T10:14:47Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"Buyer\",\"surname\":\"Test\"},\"email_address\":\"buyer@giftersz.com\",\"payer_id\":\"2FZELBJY6PYMQ\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-01-17T10:12:45Z\",\"update_time\":\"2022-01-17T10:14:47Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4AG31326B7851463Y\",\"rel\":\"self\",\"method\":\"GET\"}]}', 'e503f29a-8e8c-404c-a591-2284cd74b2c4', 41),
(2, 6, 50.0000000, 'PayPal', '2022-01-17 15:18:45', '{\"id\":\"44844139E4969193S\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"50.00\"},\"payee\":{\"email_address\":\"seller@dedevelopers.com\",\"merchant_id\":\"R34FNY5694KBY\"},\"shipping\":{\"name\":{\"full_name\":\"Buyer Test\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"0JL23637LD2028151\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"50.00\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-01-17T10:18:45Z\",\"update_time\":\"2022-01-17T10:18:45Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"Buyer\",\"surname\":\"Test\"},\"email_address\":\"buyer@giftersz.com\",\"payer_id\":\"2FZELBJY6PYMQ\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-01-17T10:17:50Z\",\"update_time\":\"2022-01-17T10:18:45Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/44844139E4969193S\",\"rel\":\"self\",\"method\":\"GET\"}]}', 'bc19d83d-905e-499c-8c03-5a85b2ac1ee9', 41),
(3, 6, 50.0000000, 'Stripe', '2022-01-17 15:42:52', '{\"paymentIntent\":{\"id\":\"pi_3KIsefFg6vy3Cifj0RgFbzyd\",\"object\":\"payment_intent\",\"amount\":\"5000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIsefFg6vy3Cifj0RgFbzyd_secret_XoSaFE03vBW2X5rg9cVfC9hk5\",\"confirmation_method\":\"automatic\",\"created\":\"1642416101\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIsfnFg6vy3Cifj3tvTA4fJ\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', '89b91148-67b2-4467-a0bc-4f04de88ff28', 42),
(4, 6, 50.0000000, 'Stripe', '2022-01-17 15:43:16', '{\"paymentIntent\":{\"id\":\"pi_3KIsftFg6vy3Cifj0tORuquE\",\"object\":\"payment_intent\",\"amount\":\"5000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIsftFg6vy3Cifj0tORuquE_secret_wOWcrbCAAovuXbkIi9rLzvTL3\",\"confirmation_method\":\"automatic\",\"created\":\"1642416177\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIsgBFg6vy3CifjI6oiilcc\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'f682162b-dc16-4194-9020-130909c138df', 42),
(5, 8, 370.0000000, 'Stripe', '2022-01-17 17:20:20', '{\"paymentIntent\":{\"id\":\"pi_3KIuBHFg6vy3Cifj0MAi3Bix\",\"object\":\"payment_intent\",\"amount\":\"37000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIuBHFg6vy3Cifj0MAi3Bix_secret_YfbVjwViHqrfs3tPtiqJeNszW\",\"confirmation_method\":\"automatic\",\"created\":\"1642421967\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIuC6Fg6vy3Cifjpjp2mlA0\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', '3fd41dd7-8931-479d-a61f-c29ac8f17b31', 4),
(6, 8, 370.0000000, 'Stripe', '2022-01-17 17:22:27', '{\"paymentIntent\":{\"id\":\"pi_3KIuDtFg6vy3Cifj1qAqVkCN\",\"object\":\"payment_intent\",\"amount\":\"37000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIuDtFg6vy3Cifj1qAqVkCN_secret_T7nxgNpyjVb9yMZbmov4plMW1\",\"confirmation_method\":\"automatic\",\"created\":\"1642422129\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIuE9Fg6vy3CifjZUlpHNo7\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'ae0d2b66-5c74-4477-9560-5dc33738a899', 4),
(7, 8, 370.0000000, 'Stripe', '2022-01-17 17:23:41', '{\"paymentIntent\":{\"id\":\"pi_3KIuExFg6vy3Cifj0e0uHs8E\",\"object\":\"payment_intent\",\"amount\":\"37000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIuExFg6vy3Cifj0e0uHs8E_secret_87GdP8EcHo8SNuz4HmHNNR8m7\",\"confirmation_method\":\"automatic\",\"created\":\"1642422195\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIuFLFg6vy3CifjYugN0snb\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', '475a7cb4-9a27-4775-af35-ca9501e7879e', 4),
(8, 8, 370.0000000, 'Stripe', '2022-01-17 17:25:17', '{\"paymentIntent\":{\"id\":\"pi_3KIuGQFg6vy3Cifj0JjroBlF\",\"object\":\"payment_intent\",\"amount\":\"37000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIuGQFg6vy3Cifj0JjroBlF_secret_IRKFR06K6J2hjaCLI762LljGt\",\"confirmation_method\":\"automatic\",\"created\":\"1642422286\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIuGtFg6vy3CifjTGgEUQ46\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'bc262358-2478-4ccc-a068-e12ab97325fe', 4),
(9, 8, 370.0000000, 'Stripe', '2022-01-17 17:27:20', '{\"paymentIntent\":{\"id\":\"pi_3KIuIcFg6vy3Cifj0dU7vIK2\",\"object\":\"payment_intent\",\"amount\":\"37000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIuIcFg6vy3Cifj0dU7vIK2_secret_WqGtJVvXC8jsfmO47Z8WpOwRL\",\"confirmation_method\":\"automatic\",\"created\":\"1642422422\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIuIsFg6vy3CifjgbSRQVYl\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'e55d3f42-6aa1-41e8-83bd-b1caa572fd1f', 4),
(10, 8, 220.0000000, 'Stripe', '2022-01-17 18:29:46', '{\"paymentIntent\":{\"id\":\"pi_3KIvH2Fg6vy3Cifj09NRFWzy\",\"object\":\"payment_intent\",\"amount\":\"22000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIvH2Fg6vy3Cifj09NRFWzy_secret_FHbOBHYbdrRmaMNC79oSlCFN2\",\"confirmation_method\":\"automatic\",\"created\":\"1642426168\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIvHIFg6vy3CifjsFsix0Cx\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', '4d80a6be-55b5-4ace-81c0-1b942aa5a470', 5),
(11, 14, 220.0000000, 'Stripe', '2022-01-17 19:15:42', '{\"paymentIntent\":{\"id\":\"pi_3KIvz1Fg6vy3Cifj15dC9Atf\",\"object\":\"payment_intent\",\"amount\":\"22000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KIvz1Fg6vy3Cifj15dC9Atf_secret_VQ6o9oBHLJJ1c6G3vCdPFjavD\",\"confirmation_method\":\"automatic\",\"created\":\"1642428895\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KIvzjFg6vy3Cifj9pzoHl7D\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', '3cc82272-ba95-46a1-967e-5570718fa9e7', 8),
(12, 13, 50.0000000, 'Stripe', '2022-01-19 20:41:05', '{\"paymentIntent\":{\"id\":\"pi_3KJgGZFg6vy3Cifj1XbLcQVR\",\"object\":\"payment_intent\",\"amount\":\"5000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KJgGZFg6vy3Cifj1XbLcQVR_secret_2Hkacw6sh8uk0NaYFPjnVGHn5\",\"confirmation_method\":\"automatic\",\"created\":\"1642606807\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KJgHTFg6vy3CifjJoRlGgsY\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'f84fc0ae-b524-4ffc-b62e-216965862cbd', 11),
(13, 19, 60.0000000, 'Stripe', '2022-01-26 14:03:49', '{\"paymentIntent\":{\"id\":\"pi_3KM7PaFg6vy3Cifj1DbX889q\",\"object\":\"payment_intent\",\"amount\":\"6000\",\"automatic_payment_methods\":\"\",\"canceled_at\":\"\",\"cancellation_reason\":\"\",\"capture_method\":\"automatic\",\"client_secret\":\"pi_3KM7PaFg6vy3Cifj1DbX889q_secret_C8lVRf6wdW7J0b0M4RqrO5iN5\",\"confirmation_method\":\"automatic\",\"created\":\"1643187810\",\"currency\":\"usd\",\"description\":\"\",\"last_payment_error\":\"\",\"livemode\":\"false\",\"next_action\":\"\",\"payment_method\":\"pm_1KM7PrFg6vy3Cifj1nmE0t8P\",\"payment_method_types\":[\"card\"],\"processing\":\"\",\"receipt_email\":\"\",\"setup_future_usage\":\"\",\"shipping\":\"\",\"source\":\"\",\"status\":\"succeeded\"}}', 'db50462f-de82-401f-a57e-3a09ba598e98', 15);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `c_name` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `paypal_email` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  `paypal_api` text COLLATE utf8mb4_bin DEFAULT NULL,
  `paypal_secret` text COLLATE utf8mb4_bin DEFAULT NULL,
  `paypal_api_type` int(11) NOT NULL DEFAULT 1,
  `stripe_api` text COLLATE utf8mb4_bin DEFAULT NULL,
  `stripe_secret` text COLLATE utf8mb4_bin DEFAULT NULL,
  `bank_name` text COLLATE utf8mb4_bin DEFAULT NULL,
  `iban` text COLLATE utf8mb4_bin DEFAULT NULL,
  `description` text COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `payfast_m_key` text COLLATE utf8mb4_bin DEFAULT NULL,
  `payfast_m_sec` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `lparent`, `lang_id`, `title`, `type`, `c_name`, `paypal_email`, `paypal_api`, `paypal_secret`, `paypal_api_type`, `stripe_api`, `stripe_secret`, `bank_name`, `iban`, `description`, `image`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`, `payfast_m_key`, `payfast_m_sec`) VALUES
(1, 0, 0, 'Paypal', 1, 'USD', 'faisal9550284@gmail.com', 'AX3FDAfxXErEMv9XzH7h5HKu4sIq8kHJiAOhhLwkAnror6z84RrUlyHlIR_z3HCi9Sqmm2vK3gNdi53F', 'f', 1, NULL, NULL, NULL, NULL, NULL, 'paypal_logo.png', 1, '2019-02-11 00:00:00', 1, '2020-08-16 11:29:16', 1, 0, 0, NULL, NULL),
(5, 0, 0, 'Stripe', 5, 'USD', NULL, NULL, NULL, 1, 'pk_test_51KIrgBFg6vy3CifjfWKaRu6jGyGKpawyef6ONQ4U8qCJM8cWbwGuEDS4WKhvrB3K3Yk62sweAPX8IRvfhPRUF2Nn00HagPG8xu', 'sk_test_51KIrgBFg6vy3CifjeTu2lEwUBcUl5FDZvHmQANx8Ry5OYtkQ6f1F8rPoCN4Xvv7ObNcau57Inj3Ep7Fj5Y7la9dB00pbEieYdP', NULL, NULL, NULL, 'stripe_logo.png', 1, '2019-02-11 00:00:00', 1, '2020-08-17 22:11:12', 1, 0, 0, '10185875', 'qgxzhhtc7nm9d');

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `sal_id` int(6) UNSIGNED NOT NULL,
  `sal_name` varchar(500) NOT NULL,
  `sal_address` varchar(255) NOT NULL,
  `sal_country` varchar(256) DEFAULT NULL,
  `sal_city` varchar(48) NOT NULL,
  `sal_zip` varchar(100) NOT NULL,
  `sal_contact_person` varchar(32) NOT NULL,
  `sal_email` varchar(128) NOT NULL,
  `sal_phone` varchar(150) NOT NULL,
  `sal_hours` text NOT NULL,
  `sal_pic` varchar(64) DEFAULT NULL,
  `sal_profile_pic` varchar(255) DEFAULT NULL,
  `sal_created_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `sal_status` tinyint(1) NOT NULL DEFAULT 1,
  `sal_password` varchar(264) DEFAULT NULL,
  `push_id` text DEFAULT NULL,
  `sal_lat` varchar(32) DEFAULT NULL,
  `sal_lng` varchar(32) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sal_type` varchar(64) DEFAULT NULL,
  `sal_specialty` varchar(128) DEFAULT NULL,
  `sal_facebook` varchar(255) DEFAULT NULL,
  `sal_instagram` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sal_twitter` varchar(250) DEFAULT NULL,
  `sal_reviews` int(4) DEFAULT NULL,
  `sal_rating` varchar(5) DEFAULT NULL,
  `sal_modify_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `sal_website` varchar(255) DEFAULT NULL,
  `sal_search_words` varchar(1000) DEFAULT NULL,
  `sal_description` text DEFAULT NULL,
  `sal_area` varchar(255) DEFAULT NULL,
  `sal_state` varchar(255) DEFAULT NULL,
  `sal_paypal_email` varchar(222) DEFAULT NULL,
  `api_logged_sess` text NOT NULL,
  `api_logged_time` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `steps` varchar(12) DEFAULT NULL,
  `payment_method` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `salons`
--

INSERT INTO `salons` (`sal_id`, `sal_name`, `sal_address`, `sal_country`, `sal_city`, `sal_zip`, `sal_contact_person`, `sal_email`, `sal_phone`, `sal_hours`, `sal_pic`, `sal_profile_pic`, `sal_created_datetime`, `sal_status`, `sal_password`, `push_id`, `sal_lat`, `sal_lng`, `is_active`, `sal_type`, `sal_specialty`, `sal_facebook`, `sal_instagram`, `sal_twitter`, `sal_reviews`, `sal_rating`, `sal_modify_datetime`, `sal_website`, `sal_search_words`, `sal_description`, `sal_area`, `sal_state`, `sal_paypal_email`, `api_logged_sess`, `api_logged_time`, `is_deleted`, `steps`, `payment_method`) VALUES
(54747, 'Blazon Salon', '61 Martin Luther King Dr #B Hempstead, New York(NY), 11550', 'US', 'New York', '1111', 'John', 'mughees.abbas@gmail.com', '3134081068', 'a:7:{i:0;a:2:{i:0;s:5:\"08:30\";i:1;s:5:\"22:00\";}i:1;a:2:{i:0;s:5:\"08:30\";i:1;s:5:\"22:00\";}i:2;a:2:{i:0;s:5:\"08:30\";i:1;s:5:\"22:00\";}i:3;a:2:{i:0;s:5:\"08:30\";i:1;s:5:\"22:00\";}i:4;a:2:{i:0;s:5:\"09:00\";i:1;s:5:\"19:39\";}i:5;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', 'c97ba305-220d-49f3-93d8-008ed1dd6ee2.jpg', '87c2f333-10a8-4c60-afa8-61b7a5766d63.jpg', '2022-01-01 18:39:55', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.478297', '74.3636398', 1, 'Men', NULL, NULL, NULL, NULL, 5, NULL, '2022-01-01 18:39:55', NULL, 'Blazon Salon F9H7+C5J, Farooq Colony, Lahore, Punjab, Pakistan Pakistan Lahore Punjab', 'This is the test description', NULL, 'New York', NULL, 'a7e53a07c929e16078c2c8f0e2e62643', '2022-01-01 18:39:55', 0, '8', ''),
(54748, 'Cosmo Salon', '75 Martin Luther King Dr #B Hempstead, Chicago, 11550', 'US', 'Chicago', '1111', 'Ahtisham', 'cosmo@gmail.com', '3134081068', 'a:7:{i:0;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:15\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:15\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:15\";}i:3;a:2:{i:0;s:5:\"07:45\";i:1;s:5:\"19:30\";}i:4;a:2:{i:0;s:5:\"08:30\";i:1;s:5:\"21:00\";}i:5;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', '01eb7116-fc54-4adf-93f1-18f314bdf68b.jpg', 'd5c39dbf-1a70-446a-85d0-96feb49e26e8.jpg', '2022-01-01 15:54:28', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.478294', '74.363628', 1, 'women', NULL, NULL, NULL, NULL, 5, NULL, '2022-01-01 10:54:28', NULL, 'Cosmo Salon F9H7+C5J, Farooq Colony, Lahore, Punjab, Pakistan Pakistan Lahore Punjab', 'Cosmo hair salon have worlds best womens hair cuters', NULL, 'California', NULL, '3287c969e59dfcd33e27af42372d59ce', '2022-01-01 20:54:28', 0, '8', ''),
(54749, 'Cappiello Salon', '75 Martin Luther King Dr #B Hempstead, Los Angeles, 21551', 'US', 'Los Angeles', '12345', 'Ricardo', 'ricardo@gmail.com', '1234567890', 'a:7:{i:0;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:4;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:5;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', '402c6066-caec-4987-9512-55587caf6a46.jpg', 'bd565875-87ad-4ac9-8a5a-a51b837f5853.jpg', '2022-01-10 08:14:15', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.4766193', '74.3636958', 1, 'Men', NULL, NULL, NULL, NULL, 5, NULL, '2022-01-10 03:14:15', NULL, 'Cappiello Salon Model colony 2 qadria masjid, Farooq Colony, Lahore, Punjab, Pakistan Pakistan Lahore Punjab', 'This is the test salon', NULL, 'Illinois', NULL, 'b98df8d6f40aacfd72c638dbab0bd76b', '2022-01-10 13:14:15', 0, '8', ''),
(54752, 'Gents Saloon', 'Test Address', 'US', 'TEST city', '12345', 'Zaheer', 'zaheerhussain@gmail.com', '1234567890', 'a:7:{i:0;a:2:{i:0;s:5:\"09:30\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:30\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"21:30\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:30\";}i:4;a:2:{i:0;s:5:\"09:30\";i:1;s:5:\"12:30\";}i:5;a:2:{i:0;s:6:\"closed\";i:1;s:5:\"00:00\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:5:\"00:00\";}}', 'e9e103db-f736-42b9-af9d-a26fd176adf6.jpg', '91a47457-a282-4057-9a04-8600ccaed8a8.jpg', '2022-01-23 11:39:50', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.4782771', '74.3635958', 1, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-23 06:39:50', NULL, 'Gents Salon Test Address US TEST city California', 'Best salon in the test city', NULL, 'California', NULL, 'b0d4238402341e0146f4485632ec3b03', '2022-01-23 16:39:50', 0, '8', ''),
(54753, 'this', 'this', 'ok', 'okoko', '123333', 'bug', 'bugg@gmail.com', '12345678910', 'a:7:{i:0;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"17:30\";}i:1;a:2:{i:0;s:5:\"04:00\";i:1;s:5:\"17:30\";}i:2;a:2:{i:0;s:5:\"05:00\";i:1;s:5:\"21:30\";}i:3;a:2:{i:0;s:5:\"04:00\";i:1;s:5:\"21:30\";}i:4;a:2:{i:0;s:5:\"05:00\";i:1;s:5:\"21:30\";}i:5;a:2:{i:0;s:5:\"05:00\";i:1;s:5:\"21:30\";}i:6;a:2:{i:0;s:5:\"05:00\";i:1;s:5:\"21:30\";}}', '8788fc34-17c3-4224-af7e-da9202a7280f.jpg', '33269d9b-be4e-4d14-b988-e19f1b7eebb4.jpg', '2022-01-23 12:13:30', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.4712082', '74.2512958', 1, 'Women', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-23 07:13:30', NULL, 'this this ok okoko okok', '', NULL, 'okok', NULL, '1b9916e4aaef6aabaefd3f9a89c380ec', '2022-01-23 17:13:30', 0, '7', ''),
(54754, 'Mahev Salon', '178 J1-', 'Pakistan', 'Lahore', '54660', 'Mahev', 'mahevstark@gmail.com', '3009550284', 'a:7:{i:0;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"15:30\";}i:1;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"21:30\";}i:2;a:2:{i:0;s:5:\"10:00\";i:1;s:5:\"17:30\";}i:3;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"18:30\";}i:4;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"18:30\";}i:5;a:2:{i:0;s:5:\"07:00\";i:1;s:5:\"16:30\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', '9eb38af5-8c86-4e5c-957b-755c51f03016.jpg', 'a63ac319-d8e1-4213-8177-b16d2ea21271.jpg', '2022-01-26 08:53:03', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '31.4712597', '74.2513684', 1, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-26 03:53:03', NULL, 'Mahev Salon 178 J1- Pakistan Lahore Punjab', 'uuu', NULL, 'Punjab', NULL, 'eb9fe842b21e1e6a27fa36c32c025f02', '2022-01-26 13:53:03', 0, '8', ''),
(54755, 'test', '2172 myrtle beach lane', 'usa', 'Danville', '94526', 'tree', 'statcommmwilfried@gmail.com', '0987654321', 'a:7:{i:0;a:2:{i:0;s:5:\"07:30\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:2;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', 'a2123bbf-d257-4ce6-a6aa-66a5e036c91f.jpg', 'f1c8a0b2-5226-4ada-8d92-6d5daeb9c873.jpg', '2022-01-28 17:05:45', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '37.6932488', '-121.876086', 1, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-28 12:05:45', NULL, 'test 2172 myrtle beach lane usa Danville ca', '', NULL, 'ca', NULL, '2e1209d891ed4e0f7a8df21d8b027944', '2022-01-28 22:05:45', 0, '7', ''),
(54756, 'Beauty', '10685 Hazelhurst Dr, Houston, TX 77043, USA', 'USA', 'Hazelhurst', '12345', 'Mughees', 'beauty@salon.com', '1234567890', 'a:7:{i:0;a:2:{i:0;s:5:\"09:30\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:4;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:5;a:2:{i:0;s:5:\"06:00\";i:1;s:5:\"18:30\";}i:6;a:2:{i:0;s:5:\"09:00\";i:1;s:5:\"18:00\";}}', '806a2baf-1cdc-43ef-a297-703a52c3cd00.jpg', '87e88960-fe98-4b5c-8f05-6f4dee920779.jpg', '2022-01-29 13:55:43', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '33.6435657', '73.0881205', 1, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-29 08:55:43', NULL, 'Beauty 10685 Hazelhurst Dr, Houston, TX 77043, USA USA Hazelhurst Wisconsin', 'Amarica best salon', NULL, 'Wisconsin', NULL, 'c4e3b8f6639c633d4987273113587df0', '2022-01-29 19:47:23', 0, '8', ''),
(54758, 'Parus Salon', '10685 Hazelhurst Dr', 'USA', 'California', '12345', 'Mughees', 'parus@gmail.com', '1234567890', 'a:7:{i:0;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:4;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:5;a:2:{i:0;s:5:\"09:00\";i:1;s:5:\"15:30\";}i:6;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}}', 'a45c83ac-3e2e-4ece-b117-305fd2057805.jpg', 'a4462cf3-0ebd-4e93-9176-7e1ec97ebd34.jpg', '2022-01-29 17:37:24', 1, '25d55ad283aa400af464c76d713c07ad', NULL, '33.6435655', '73.0881291', 1, 'Women', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-29 12:37:24', NULL, 'Parus Salon 10685 Hazelhurst Dr USA California California', 'test sal', NULL, 'California', NULL, 'fa490dc75302a0de4d95b09a483c4b03', '2022-01-29 22:37:24', 0, '8', ''),
(54759, 'WILLMAK Salon', '2172 myrtle beach lane', 'USA', 'Danville', '94526', 'Will Mak', 'afroexpression@gmail.com', '4153598384', 'a:7:{i:0;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:4;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:5;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:6;a:2:{i:0;s:6:\"closed\";i:1;s:0:\"\";}}', '4fc39668-c4ce-4851-b701-165ce9c8b5ec.jpg', 'f6ea4c2b-9f1f-4849-a77b-a4d1a2d8fad0.jpg', '2022-01-31 04:09:17', 1, '25d55ad283aa400af464c76d713c07ad', '', '37.689284', '-121.874518', 1, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-30 23:09:17', NULL, 'WILLMAK Salon 2172 myrtle beach lane USA Danville California', '', NULL, 'California', NULL, 'c36efdab6db82e64da179eb2599d4ae9', '2022-01-31 09:09:17', 0, '8', ''),
(54760, 'My salon', '1092', 'USA', 'teat city', '12345', 'Mughess', 'test1@test.com', '2563908745', 'a:7:{i:0;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:1;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:2;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:3;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:4;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:5;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}i:6;a:2:{i:0;s:5:\"08:00\";i:1;s:5:\"18:00\";}}', 'da0e082e-e360-4d5d-b0e1-c096106926a4.jpg', '00b101d6-460b-43e6-8833-b9d8c8bbf710.jpg', '2022-02-01 17:53:06', 1, '25d55ad283aa400af464c76d713c07ad', '', '33.6435674', '73.0881236', 0, 'Men', NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-01 12:53:06', NULL, 'My salon 1092 USA teat city california', 'testing', NULL, 'california', NULL, '437046ad302af971878137d5e75bff9d', '2022-02-02 01:09:01', 0, '8', '');

-- --------------------------------------------------------

--
-- Table structure for table `salon_slots`
--

CREATE TABLE `salon_slots` (
  `ss_id` bigint(11) UNSIGNED NOT NULL,
  `ss_number` bigint(3) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `ss_date` date NOT NULL,
  `ss_start_time` varchar(8) NOT NULL,
  `ss_end_time` varchar(8) NOT NULL,
  `ss_duration` int(11) NOT NULL,
  `ss_is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `appoint_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salon_slots`
--

INSERT INTO `salon_slots` (`ss_id`, `ss_number`, `sal_id`, `ss_date`, `ss_start_time`, `ss_end_time`, `ss_duration`, `ss_is_booked`, `appoint_id`) VALUES
(1, 18, 54747, '2022-01-17', '08:30', '09:00', 30, 0, 0),
(2, 19, 54747, '2022-01-17', '09:00', '09:30', 30, 1, 11),
(3, 20, 54747, '2022-01-17', '09:30', '10:00', 30, 1, 11),
(4, 21, 54747, '2022-01-17', '10:00', '10:30', 30, 1, 9),
(5, 22, 54747, '2022-01-17', '10:30', '11:00', 30, 1, 9),
(6, 23, 54747, '2022-01-17', '11:00', '11:30', 30, 1, 10),
(7, 24, 54747, '2022-01-17', '11:30', '12:00', 30, 1, 10),
(8, 25, 54747, '2022-01-17', '12:00', '12:30', 30, 0, 0),
(9, 26, 54747, '2022-01-17', '12:30', '13:00', 30, 0, 0),
(10, 27, 54747, '2022-01-17', '13:00', '13:30', 30, 0, 0),
(11, 28, 54747, '2022-01-17', '13:30', '14:00', 30, 0, 0),
(12, 29, 54747, '2022-01-17', '14:00', '14:30', 30, 0, 0),
(13, 30, 54747, '2022-01-17', '14:30', '15:00', 30, 0, 0),
(14, 31, 54747, '2022-01-17', '15:00', '15:30', 30, 0, 0),
(15, 32, 54747, '2022-01-17', '15:30', '16:00', 30, 0, 0),
(16, 33, 54747, '2022-01-17', '16:00', '16:30', 30, 0, 0),
(17, 34, 54747, '2022-01-17', '16:30', '17:00', 30, 0, 0),
(18, 35, 54747, '2022-01-17', '17:00', '17:30', 30, 0, 0),
(19, 36, 54747, '2022-01-17', '17:30', '18:00', 30, 0, 0),
(20, 37, 54747, '2022-01-17', '18:00', '18:30', 30, 0, 0),
(21, 38, 54747, '2022-01-17', '18:30', '19:00', 30, 0, 0),
(22, 39, 54747, '2022-01-17', '19:00', '19:30', 30, 0, 0),
(23, 40, 54747, '2022-01-17', '19:30', '20:00', 30, 0, 0),
(24, 41, 54747, '2022-01-17', '20:00', '20:30', 30, 0, 0),
(25, 42, 54747, '2022-01-17', '20:30', '21:00', 30, 0, 0),
(26, 43, 54747, '2022-01-17', '21:00', '21:30', 30, 0, 0),
(27, 44, 54747, '2022-01-17', '21:30', '22:00', 30, 0, 0),
(28, 45, 54747, '2022-01-17', '22:00', '22:30', 30, 0, 0),
(32, 18, 54747, '2022-01-18', '08:30', '09:00', 30, 0, 0),
(33, 19, 54747, '2022-01-18', '09:00', '09:30', 30, 1, 11),
(34, 20, 54747, '2022-01-18', '09:30', '10:00', 30, 1, 11),
(35, 21, 54747, '2022-01-18', '10:00', '10:30', 30, 1, 9),
(36, 22, 54747, '2022-01-18', '10:30', '11:00', 30, 1, 9),
(37, 23, 54747, '2022-01-18', '11:00', '11:30', 30, 1, 10),
(38, 24, 54747, '2022-01-18', '11:30', '12:00', 30, 1, 10),
(39, 25, 54747, '2022-01-18', '12:00', '12:30', 30, 0, 0),
(40, 26, 54747, '2022-01-18', '12:30', '13:00', 30, 0, 0),
(41, 27, 54747, '2022-01-18', '13:00', '13:30', 30, 0, 0),
(42, 28, 54747, '2022-01-18', '13:30', '14:00', 30, 0, 0),
(43, 29, 54747, '2022-01-18', '14:00', '14:30', 30, 0, 0),
(44, 30, 54747, '2022-01-18', '14:30', '15:00', 30, 0, 0),
(45, 31, 54747, '2022-01-18', '15:00', '15:30', 30, 0, 0),
(46, 32, 54747, '2022-01-18', '15:30', '16:00', 30, 0, 0),
(47, 33, 54747, '2022-01-18', '16:00', '16:30', 30, 0, 0),
(48, 34, 54747, '2022-01-18', '16:30', '17:00', 30, 0, 0),
(49, 35, 54747, '2022-01-18', '17:00', '17:30', 30, 0, 0),
(50, 36, 54747, '2022-01-18', '17:30', '18:00', 30, 0, 0),
(51, 37, 54747, '2022-01-18', '18:00', '18:30', 30, 0, 0),
(52, 38, 54747, '2022-01-18', '18:30', '19:00', 30, 0, 0),
(53, 39, 54747, '2022-01-18', '19:00', '19:30', 30, 0, 0),
(54, 40, 54747, '2022-01-18', '19:30', '20:00', 30, 0, 0),
(55, 41, 54747, '2022-01-18', '20:00', '20:30', 30, 0, 0),
(56, 42, 54747, '2022-01-18', '20:30', '21:00', 30, 0, 0),
(57, 43, 54747, '2022-01-18', '21:00', '21:30', 30, 0, 0),
(58, 44, 54747, '2022-01-18', '21:30', '22:00', 30, 0, 0),
(59, 45, 54747, '2022-01-18', '22:00', '22:30', 30, 0, 0),
(60, 17, 54749, '2022-01-17', '08:00', '08:30', 30, 1, 6),
(61, 18, 54749, '2022-01-17', '08:30', '09:00', 30, 0, 0),
(62, 19, 54749, '2022-01-17', '09:00', '09:30', 30, 0, 0),
(63, 20, 54749, '2022-01-17', '09:30', '10:00', 30, 0, 0),
(64, 21, 54749, '2022-01-17', '10:00', '10:30', 30, 0, 0),
(65, 22, 54749, '2022-01-17', '10:30', '11:00', 30, 0, 0),
(66, 23, 54749, '2022-01-17', '11:00', '11:30', 30, 0, 0),
(67, 24, 54749, '2022-01-17', '11:30', '12:00', 30, 0, 0),
(68, 25, 54749, '2022-01-17', '12:00', '12:30', 30, 0, 0),
(69, 26, 54749, '2022-01-17', '12:30', '13:00', 30, 0, 0),
(70, 27, 54749, '2022-01-17', '13:00', '13:30', 30, 0, 0),
(71, 28, 54749, '2022-01-17', '13:30', '14:00', 30, 0, 0),
(72, 29, 54749, '2022-01-17', '14:00', '14:30', 30, 0, 0),
(73, 30, 54749, '2022-01-17', '14:30', '15:00', 30, 0, 0),
(74, 31, 54749, '2022-01-17', '15:00', '15:30', 30, 0, 0),
(75, 32, 54749, '2022-01-17', '15:30', '16:00', 30, 0, 0),
(76, 33, 54749, '2022-01-17', '16:00', '16:30', 30, 0, 0),
(77, 34, 54749, '2022-01-17', '16:30', '17:00', 30, 0, 0),
(78, 35, 54749, '2022-01-17', '17:00', '17:30', 30, 0, 0),
(79, 36, 54749, '2022-01-17', '17:30', '18:00', 30, 0, 0),
(80, 37, 54749, '2022-01-17', '18:00', '18:30', 30, 1, 16),
(91, 17, 54748, '2022-01-17', '08:00', '08:30', 30, 1, 5),
(92, 18, 54748, '2022-01-17', '08:30', '09:00', 30, 1, 5),
(93, 19, 54748, '2022-01-17', '09:00', '09:30', 30, 1, 5),
(94, 20, 54748, '2022-01-17', '09:30', '10:00', 30, 1, 8),
(95, 21, 54748, '2022-01-17', '10:00', '10:30', 30, 1, 8),
(96, 22, 54748, '2022-01-17', '10:30', '11:00', 30, 1, 8),
(97, 23, 54748, '2022-01-17', '11:00', '11:30', 30, 1, 3),
(98, 24, 54748, '2022-01-17', '11:30', '12:00', 30, 1, 3),
(99, 25, 54748, '2022-01-17', '12:00', '12:30', 30, 1, 3),
(100, 26, 54748, '2022-01-17', '12:30', '13:00', 30, 0, 0),
(101, 27, 54748, '2022-01-17', '13:00', '13:30', 30, 0, 0),
(102, 28, 54748, '2022-01-17', '13:30', '14:00', 30, 1, 4),
(103, 29, 54748, '2022-01-17', '14:00', '14:30', 30, 1, 4),
(104, 30, 54748, '2022-01-17', '14:30', '15:00', 30, 1, 4),
(105, 31, 54748, '2022-01-17', '15:00', '15:30', 30, 1, 4),
(106, 32, 54748, '2022-01-17', '15:30', '16:00', 30, 1, 4),
(107, 33, 54748, '2022-01-17', '16:00', '16:30', 30, 0, 0),
(108, 34, 54748, '2022-01-17', '16:30', '17:00', 30, 0, 0),
(109, 35, 54748, '2022-01-17', '17:00', '17:30', 30, 1, 7),
(110, 36, 54748, '2022-01-17', '17:30', '18:00', 30, 1, 7),
(111, 37, 54748, '2022-01-17', '18:00', '18:30', 30, 1, 7),
(122, 17, 54748, '2022-01-18', '08:00', '08:30', 30, 1, 5),
(123, 18, 54748, '2022-01-18', '08:30', '09:00', 30, 1, 5),
(124, 19, 54748, '2022-01-18', '09:00', '09:30', 30, 1, 5),
(125, 20, 54748, '2022-01-18', '09:30', '10:00', 30, 1, 8),
(126, 21, 54748, '2022-01-18', '10:00', '10:30', 30, 1, 8),
(127, 22, 54748, '2022-01-18', '10:30', '11:00', 30, 1, 8),
(128, 23, 54748, '2022-01-18', '11:00', '11:30', 30, 1, 3),
(129, 24, 54748, '2022-01-18', '11:30', '12:00', 30, 1, 3),
(130, 25, 54748, '2022-01-18', '12:00', '12:30', 30, 1, 3),
(131, 26, 54748, '2022-01-18', '12:30', '13:00', 30, 0, 0),
(132, 27, 54748, '2022-01-18', '13:00', '13:30', 30, 0, 0),
(133, 28, 54748, '2022-01-18', '13:30', '14:00', 30, 1, 4),
(134, 29, 54748, '2022-01-18', '14:00', '14:30', 30, 1, 4),
(135, 30, 54748, '2022-01-18', '14:30', '15:00', 30, 1, 4),
(136, 31, 54748, '2022-01-18', '15:00', '15:30', 30, 1, 4),
(137, 32, 54748, '2022-01-18', '15:30', '16:00', 30, 1, 4),
(138, 33, 54748, '2022-01-18', '16:00', '16:30', 30, 0, 0),
(139, 34, 54748, '2022-01-18', '16:30', '17:00', 30, 0, 0),
(140, 35, 54748, '2022-01-18', '17:00', '17:30', 30, 1, 7),
(141, 36, 54748, '2022-01-18', '17:30', '18:00', 30, 1, 7),
(142, 37, 54748, '2022-01-18', '18:00', '18:30', 30, 1, 7),
(143, 17, 54748, '2022-01-19', '08:00', '08:30', 30, 1, 5),
(144, 18, 54748, '2022-01-19', '08:30', '09:00', 30, 1, 5),
(145, 19, 54748, '2022-01-19', '09:00', '09:30', 30, 1, 5),
(146, 20, 54748, '2022-01-19', '09:30', '10:00', 30, 1, 8),
(147, 21, 54748, '2022-01-19', '10:00', '10:30', 30, 1, 8),
(148, 22, 54748, '2022-01-19', '10:30', '11:00', 30, 1, 8),
(149, 23, 54748, '2022-01-19', '11:00', '11:30', 30, 0, 0),
(150, 24, 54748, '2022-01-19', '11:30', '12:00', 30, 0, 0),
(151, 25, 54748, '2022-01-19', '12:00', '12:30', 30, 0, 0),
(152, 26, 54748, '2022-01-19', '12:30', '13:00', 30, 0, 0),
(153, 27, 54748, '2022-01-19', '13:00', '13:30', 30, 0, 0),
(154, 28, 54748, '2022-01-19', '13:30', '14:00', 30, 0, 0),
(155, 29, 54748, '2022-01-19', '14:00', '14:30', 30, 0, 0),
(156, 30, 54748, '2022-01-19', '14:30', '15:00', 30, 0, 0),
(157, 31, 54748, '2022-01-19', '15:00', '15:30', 30, 0, 0),
(158, 32, 54748, '2022-01-19', '15:30', '16:00', 30, 0, 0),
(159, 33, 54748, '2022-01-19', '16:00', '16:30', 30, 0, 0),
(160, 34, 54748, '2022-01-19', '16:30', '17:00', 30, 0, 0),
(161, 35, 54748, '2022-01-19', '17:00', '17:30', 30, 1, 7),
(162, 36, 54748, '2022-01-19', '17:30', '18:00', 30, 1, 7),
(163, 37, 54748, '2022-01-19', '18:00', '18:30', 30, 1, 7),
(164, 18, 54747, '2022-01-19', '08:30', '09:00', 30, 0, 0),
(165, 19, 54747, '2022-01-19', '09:00', '09:30', 30, 1, 11),
(166, 20, 54747, '2022-01-19', '09:30', '10:00', 30, 1, 11),
(167, 21, 54747, '2022-01-19', '10:00', '10:30', 30, 0, 0),
(168, 22, 54747, '2022-01-19', '10:30', '11:00', 30, 0, 0),
(169, 23, 54747, '2022-01-19', '11:00', '11:30', 30, 0, 0),
(170, 24, 54747, '2022-01-19', '11:30', '12:00', 30, 0, 0),
(171, 25, 54747, '2022-01-19', '12:00', '12:30', 30, 0, 0),
(172, 26, 54747, '2022-01-19', '12:30', '13:00', 30, 0, 0),
(173, 27, 54747, '2022-01-19', '13:00', '13:30', 30, 0, 0),
(174, 28, 54747, '2022-01-19', '13:30', '14:00', 30, 0, 0),
(175, 29, 54747, '2022-01-19', '14:00', '14:30', 30, 0, 0),
(176, 30, 54747, '2022-01-19', '14:30', '15:00', 30, 0, 0),
(177, 31, 54747, '2022-01-19', '15:00', '15:30', 30, 0, 0),
(178, 32, 54747, '2022-01-19', '15:30', '16:00', 30, 0, 0),
(179, 33, 54747, '2022-01-19', '16:00', '16:30', 30, 0, 0),
(180, 34, 54747, '2022-01-19', '16:30', '17:00', 30, 0, 0),
(181, 35, 54747, '2022-01-19', '17:00', '17:30', 30, 0, 0),
(182, 36, 54747, '2022-01-19', '17:30', '18:00', 30, 0, 0),
(183, 37, 54747, '2022-01-19', '18:00', '18:30', 30, 0, 0),
(184, 38, 54747, '2022-01-19', '18:30', '19:00', 30, 0, 0),
(185, 39, 54747, '2022-01-19', '19:00', '19:30', 30, 0, 0),
(186, 40, 54747, '2022-01-19', '19:30', '20:00', 30, 0, 0),
(187, 41, 54747, '2022-01-19', '20:00', '20:30', 30, 0, 0),
(188, 42, 54747, '2022-01-19', '20:30', '21:00', 30, 0, 0),
(189, 43, 54747, '2022-01-19', '21:00', '21:30', 30, 0, 0),
(190, 44, 54747, '2022-01-19', '21:30', '22:00', 30, 0, 0),
(191, 45, 54747, '2022-01-19', '22:00', '22:30', 30, 0, 0),
(195, 18, 54747, '2022-01-27', '08:30', '09:00', 30, 0, 0),
(196, 19, 54747, '2022-01-27', '09:00', '09:30', 30, 1, 11),
(197, 20, 54747, '2022-01-27', '09:30', '10:00', 30, 1, 11),
(198, 21, 54747, '2022-01-27', '10:00', '10:30', 30, 0, 0),
(199, 22, 54747, '2022-01-27', '10:30', '11:00', 30, 0, 0),
(200, 23, 54747, '2022-01-27', '11:00', '11:30', 30, 0, 0),
(201, 24, 54747, '2022-01-27', '11:30', '12:00', 30, 0, 0),
(202, 25, 54747, '2022-01-27', '12:00', '12:30', 30, 0, 0),
(203, 26, 54747, '2022-01-27', '12:30', '13:00', 30, 0, 0),
(204, 27, 54747, '2022-01-27', '13:00', '13:30', 30, 0, 0),
(205, 28, 54747, '2022-01-27', '13:30', '14:00', 30, 0, 0),
(206, 29, 54747, '2022-01-27', '14:00', '14:30', 30, 0, 0),
(207, 30, 54747, '2022-01-27', '14:30', '15:00', 30, 0, 0),
(208, 31, 54747, '2022-01-27', '15:00', '15:30', 30, 0, 0),
(209, 32, 54747, '2022-01-27', '15:30', '16:00', 30, 0, 0),
(210, 33, 54747, '2022-01-27', '16:00', '16:30', 30, 0, 0),
(211, 34, 54747, '2022-01-27', '16:30', '17:00', 30, 0, 0),
(212, 35, 54747, '2022-01-27', '17:00', '17:30', 30, 0, 0),
(213, 36, 54747, '2022-01-27', '17:30', '18:00', 30, 0, 0),
(214, 37, 54747, '2022-01-27', '18:00', '18:30', 30, 0, 0),
(215, 38, 54747, '2022-01-27', '18:30', '19:00', 30, 0, 0),
(216, 39, 54747, '2022-01-27', '19:00', '19:30', 30, 0, 0),
(217, 40, 54747, '2022-01-27', '19:30', '20:00', 30, 0, 0),
(218, 41, 54747, '2022-01-27', '20:00', '20:30', 30, 0, 0),
(219, 42, 54747, '2022-01-27', '20:30', '21:00', 30, 0, 0),
(220, 43, 54747, '2022-01-27', '21:00', '21:30', 30, 0, 0),
(221, 44, 54747, '2022-01-27', '21:30', '22:00', 30, 0, 0),
(222, 45, 54747, '2022-01-27', '22:00', '22:30', 30, 0, 0),
(223, 20, 54752, '2022-01-24', '09:30', '10:00', 30, 0, 0),
(224, 21, 54752, '2022-01-24', '10:00', '10:30', 30, 1, 12),
(225, 22, 54752, '2022-01-24', '10:30', '11:00', 30, 1, 13),
(226, 23, 54752, '2022-01-24', '11:00', '11:30', 30, 0, 0),
(227, 24, 54752, '2022-01-24', '11:30', '12:00', 30, 0, 0),
(228, 25, 54752, '2022-01-24', '12:00', '12:30', 30, 0, 0),
(229, 26, 54752, '2022-01-24', '12:30', '13:00', 30, 0, 0),
(230, 27, 54752, '2022-01-24', '13:00', '13:30', 30, 0, 0),
(231, 28, 54752, '2022-01-24', '13:30', '14:00', 30, 0, 0),
(232, 29, 54752, '2022-01-24', '14:00', '14:30', 30, 0, 0),
(233, 30, 54752, '2022-01-24', '14:30', '15:00', 30, 0, 0),
(234, 31, 54752, '2022-01-24', '15:00', '15:30', 30, 0, 0),
(235, 32, 54752, '2022-01-24', '15:30', '16:00', 30, 0, 0),
(236, 33, 54752, '2022-01-24', '16:00', '16:30', 30, 0, 0),
(237, 34, 54752, '2022-01-24', '16:30', '17:00', 30, 0, 0),
(238, 35, 54752, '2022-01-24', '17:00', '17:30', 30, 0, 0),
(239, 36, 54752, '2022-01-24', '17:30', '18:00', 30, 0, 0),
(240, 37, 54752, '2022-01-24', '18:00', '18:30', 30, 0, 0),
(241, 21, 54754, '2022-01-26', '10:00', '10:30', 30, 1, 15),
(242, 22, 54754, '2022-01-26', '10:30', '11:00', 30, 1, 15),
(243, 23, 54754, '2022-01-26', '11:00', '11:30', 30, 1, 14),
(244, 24, 54754, '2022-01-26', '11:30', '12:00', 30, 0, 0),
(245, 25, 54754, '2022-01-26', '12:00', '12:30', 30, 0, 0),
(246, 26, 54754, '2022-01-26', '12:30', '13:00', 30, 0, 0),
(247, 27, 54754, '2022-01-26', '13:00', '13:30', 30, 0, 0),
(248, 28, 54754, '2022-01-26', '13:30', '14:00', 30, 0, 0),
(249, 29, 54754, '2022-01-26', '14:00', '14:30', 30, 0, 0),
(250, 30, 54754, '2022-01-26', '14:30', '15:00', 30, 0, 0),
(251, 31, 54754, '2022-01-26', '15:00', '15:30', 30, 0, 0),
(252, 32, 54754, '2022-01-26', '15:30', '16:00', 30, 0, 0),
(253, 33, 54754, '2022-01-26', '16:00', '16:30', 30, 0, 0),
(254, 34, 54754, '2022-01-26', '16:30', '17:00', 30, 0, 0),
(255, 35, 54754, '2022-01-26', '17:00', '17:30', 30, 0, 0),
(256, 36, 54754, '2022-01-26', '17:30', '18:00', 30, 0, 0),
(257, 15, 54754, '2022-01-27', '07:00', '07:30', 30, 0, 0),
(258, 16, 54754, '2022-01-27', '07:30', '08:00', 30, 0, 0),
(259, 17, 54754, '2022-01-27', '08:00', '08:30', 30, 0, 0),
(260, 18, 54754, '2022-01-27', '08:30', '09:00', 30, 0, 0),
(261, 19, 54754, '2022-01-27', '09:00', '09:30', 30, 0, 0),
(262, 20, 54754, '2022-01-27', '09:30', '10:00', 30, 0, 0),
(263, 21, 54754, '2022-01-27', '10:00', '10:30', 30, 1, 15),
(264, 22, 54754, '2022-01-27', '10:30', '11:00', 30, 1, 15),
(265, 23, 54754, '2022-01-27', '11:00', '11:30', 30, 0, 0),
(266, 24, 54754, '2022-01-27', '11:30', '12:00', 30, 0, 0),
(267, 25, 54754, '2022-01-27', '12:00', '12:30', 30, 0, 0),
(268, 26, 54754, '2022-01-27', '12:30', '13:00', 30, 0, 0),
(269, 27, 54754, '2022-01-27', '13:00', '13:30', 30, 0, 0),
(270, 28, 54754, '2022-01-27', '13:30', '14:00', 30, 0, 0),
(271, 29, 54754, '2022-01-27', '14:00', '14:30', 30, 0, 0),
(272, 30, 54754, '2022-01-27', '14:30', '15:00', 30, 0, 0),
(273, 31, 54754, '2022-01-27', '15:00', '15:30', 30, 0, 0),
(274, 32, 54754, '2022-01-27', '15:30', '16:00', 30, 0, 0),
(275, 33, 54754, '2022-01-27', '16:00', '16:30', 30, 0, 0),
(276, 34, 54754, '2022-01-27', '16:30', '17:00', 30, 0, 0),
(277, 35, 54754, '2022-01-27', '17:00', '17:30', 30, 0, 0),
(278, 36, 54754, '2022-01-27', '17:30', '18:00', 30, 0, 0),
(279, 37, 54754, '2022-01-27', '18:00', '18:30', 30, 0, 0),
(280, 38, 54754, '2022-01-27', '18:30', '19:00', 30, 0, 0),
(288, 15, 54754, '2022-01-28', '07:00', '07:30', 30, 0, 0),
(289, 16, 54754, '2022-01-28', '07:30', '08:00', 30, 0, 0),
(290, 17, 54754, '2022-01-28', '08:00', '08:30', 30, 0, 0),
(291, 18, 54754, '2022-01-28', '08:30', '09:00', 30, 0, 0),
(292, 19, 54754, '2022-01-28', '09:00', '09:30', 30, 0, 0),
(293, 20, 54754, '2022-01-28', '09:30', '10:00', 30, 0, 0),
(294, 21, 54754, '2022-01-28', '10:00', '10:30', 30, 1, 15),
(295, 22, 54754, '2022-01-28', '10:30', '11:00', 30, 1, 15),
(296, 23, 54754, '2022-01-28', '11:00', '11:30', 30, 0, 0),
(297, 24, 54754, '2022-01-28', '11:30', '12:00', 30, 0, 0),
(298, 25, 54754, '2022-01-28', '12:00', '12:30', 30, 0, 0),
(299, 26, 54754, '2022-01-28', '12:30', '13:00', 30, 0, 0),
(300, 27, 54754, '2022-01-28', '13:00', '13:30', 30, 0, 0),
(301, 28, 54754, '2022-01-28', '13:30', '14:00', 30, 0, 0),
(302, 29, 54754, '2022-01-28', '14:00', '14:30', 30, 0, 0),
(303, 30, 54754, '2022-01-28', '14:30', '15:00', 30, 0, 0),
(304, 31, 54754, '2022-01-28', '15:00', '15:30', 30, 0, 0),
(305, 32, 54754, '2022-01-28', '15:30', '16:00', 30, 0, 0),
(306, 33, 54754, '2022-01-28', '16:00', '16:30', 30, 0, 0),
(307, 34, 54754, '2022-01-28', '16:30', '17:00', 30, 0, 0),
(308, 35, 54754, '2022-01-28', '17:00', '17:30', 30, 0, 0),
(309, 36, 54754, '2022-01-28', '17:30', '18:00', 30, 0, 0),
(310, 37, 54754, '2022-01-28', '18:00', '18:30', 30, 0, 0),
(311, 38, 54754, '2022-01-28', '18:30', '19:00', 30, 0, 0),
(319, 15, 54754, '2022-01-29', '07:00', '07:30', 30, 0, 0),
(320, 16, 54754, '2022-01-29', '07:30', '08:00', 30, 0, 0),
(321, 17, 54754, '2022-01-29', '08:00', '08:30', 30, 0, 0),
(322, 18, 54754, '2022-01-29', '08:30', '09:00', 30, 0, 0),
(323, 19, 54754, '2022-01-29', '09:00', '09:30', 30, 0, 0),
(324, 20, 54754, '2022-01-29', '09:30', '10:00', 30, 0, 0),
(325, 21, 54754, '2022-01-29', '10:00', '10:30', 30, 1, 15),
(326, 22, 54754, '2022-01-29', '10:30', '11:00', 30, 1, 15),
(327, 23, 54754, '2022-01-29', '11:00', '11:30', 30, 0, 0),
(328, 24, 54754, '2022-01-29', '11:30', '12:00', 30, 0, 0),
(329, 25, 54754, '2022-01-29', '12:00', '12:30', 30, 0, 0),
(330, 26, 54754, '2022-01-29', '12:30', '13:00', 30, 0, 0),
(331, 27, 54754, '2022-01-29', '13:00', '13:30', 30, 0, 0),
(332, 28, 54754, '2022-01-29', '13:30', '14:00', 30, 0, 0),
(333, 29, 54754, '2022-01-29', '14:00', '14:30', 30, 0, 0),
(334, 30, 54754, '2022-01-29', '14:30', '15:00', 30, 0, 0),
(335, 31, 54754, '2022-01-29', '15:00', '15:30', 30, 0, 0),
(336, 32, 54754, '2022-01-29', '15:30', '16:00', 30, 0, 0),
(337, 33, 54754, '2022-01-29', '16:00', '16:30', 30, 0, 0),
(338, 34, 54754, '2022-01-29', '16:30', '17:00', 30, 0, 0),
(339, 17, 54749, '2022-01-26', '08:00', '08:30', 30, 0, 0),
(340, 18, 54749, '2022-01-26', '08:30', '09:00', 30, 0, 0),
(341, 19, 54749, '2022-01-26', '09:00', '09:30', 30, 0, 0),
(342, 20, 54749, '2022-01-26', '09:30', '10:00', 30, 0, 0),
(343, 21, 54749, '2022-01-26', '10:00', '10:30', 30, 0, 0),
(344, 22, 54749, '2022-01-26', '10:30', '11:00', 30, 0, 0),
(345, 23, 54749, '2022-01-26', '11:00', '11:30', 30, 0, 0),
(346, 24, 54749, '2022-01-26', '11:30', '12:00', 30, 0, 0),
(347, 25, 54749, '2022-01-26', '12:00', '12:30', 30, 0, 0),
(348, 26, 54749, '2022-01-26', '12:30', '13:00', 30, 0, 0),
(349, 27, 54749, '2022-01-26', '13:00', '13:30', 30, 0, 0),
(350, 28, 54749, '2022-01-26', '13:30', '14:00', 30, 0, 0),
(351, 29, 54749, '2022-01-26', '14:00', '14:30', 30, 0, 0),
(352, 30, 54749, '2022-01-26', '14:30', '15:00', 30, 0, 0),
(353, 31, 54749, '2022-01-26', '15:00', '15:30', 30, 0, 0),
(354, 32, 54749, '2022-01-26', '15:30', '16:00', 30, 0, 0),
(355, 33, 54749, '2022-01-26', '16:00', '16:30', 30, 0, 0),
(356, 34, 54749, '2022-01-26', '16:30', '17:00', 30, 0, 0),
(357, 35, 54749, '2022-01-26', '17:00', '17:30', 30, 0, 0),
(358, 36, 54749, '2022-01-26', '17:30', '18:00', 30, 0, 0),
(359, 37, 54749, '2022-01-26', '18:00', '18:30', 30, 1, 16),
(360, 17, 54756, '2022-01-30', '08:00', '08:30', 30, 1, 17),
(361, 18, 54756, '2022-01-30', '08:30', '09:00', 30, 0, 0),
(362, 19, 54756, '2022-01-30', '09:00', '09:30', 30, 0, 0),
(363, 20, 54756, '2022-01-30', '09:30', '10:00', 30, 1, 21),
(364, 21, 54756, '2022-01-30', '10:00', '10:30', 30, 1, 20),
(365, 22, 54756, '2022-01-30', '10:30', '11:00', 30, 0, 0),
(366, 23, 54756, '2022-01-30', '11:00', '11:30', 30, 0, 0),
(367, 24, 54756, '2022-01-30', '11:30', '12:00', 30, 1, 19),
(368, 25, 54756, '2022-01-30', '12:00', '12:30', 30, 0, 0),
(369, 26, 54756, '2022-01-30', '12:30', '13:00', 30, 0, 0),
(370, 27, 54756, '2022-01-30', '13:00', '13:30', 30, 0, 0),
(371, 28, 54756, '2022-01-30', '13:30', '14:00', 30, 0, 0),
(372, 29, 54756, '2022-01-30', '14:00', '14:30', 30, 0, 0),
(373, 30, 54756, '2022-01-30', '14:30', '15:00', 30, 0, 0),
(374, 31, 54756, '2022-01-30', '15:00', '15:30', 30, 0, 0),
(375, 32, 54756, '2022-01-30', '15:30', '16:00', 30, 0, 0),
(376, 33, 54756, '2022-01-30', '16:00', '16:30', 30, 0, 0),
(377, 34, 54756, '2022-01-30', '16:30', '17:00', 30, 0, 0),
(378, 35, 54756, '2022-01-30', '17:00', '17:30', 30, 0, 0),
(379, 36, 54756, '2022-01-30', '17:30', '18:00', 30, 0, 0),
(380, 37, 54756, '2022-01-30', '18:00', '18:30', 30, 0, 0),
(381, 17, 54756, '2022-01-29', '08:00', '08:30', 30, 0, 0),
(382, 18, 54756, '2022-01-29', '08:30', '09:00', 30, 0, 0),
(383, 19, 54756, '2022-01-29', '09:00', '09:30', 30, 0, 0),
(384, 20, 54756, '2022-01-29', '09:30', '10:00', 30, 1, 21),
(385, 21, 54756, '2022-01-29', '10:00', '10:30', 30, 1, 20),
(386, 22, 54756, '2022-01-29', '10:30', '11:00', 30, 0, 0),
(387, 23, 54756, '2022-01-29', '11:00', '11:30', 30, 0, 0),
(388, 24, 54756, '2022-01-29', '11:30', '12:00', 30, 1, 19),
(389, 25, 54756, '2022-01-29', '12:00', '12:30', 30, 0, 0),
(390, 26, 54756, '2022-01-29', '12:30', '13:00', 30, 0, 0),
(391, 27, 54756, '2022-01-29', '13:00', '13:30', 30, 0, 0),
(392, 28, 54756, '2022-01-29', '13:30', '14:00', 30, 0, 0),
(393, 29, 54756, '2022-01-29', '14:00', '14:30', 30, 0, 0),
(394, 30, 54756, '2022-01-29', '14:30', '15:00', 30, 0, 0),
(395, 31, 54756, '2022-01-29', '15:00', '15:30', 30, 0, 0),
(396, 32, 54756, '2022-01-29', '15:30', '16:00', 30, 0, 0),
(397, 33, 54756, '2022-01-29', '16:00', '16:30', 30, 0, 0),
(398, 34, 54756, '2022-01-29', '16:30', '17:00', 30, 0, 0),
(399, 35, 54756, '2022-01-29', '17:00', '17:30', 30, 0, 0),
(400, 36, 54756, '2022-01-29', '17:30', '18:00', 30, 0, 0),
(401, 37, 54756, '2022-01-29', '18:00', '18:30', 30, 0, 0),
(402, 38, 54756, '2022-01-29', '18:30', '19:00', 30, 0, 0),
(412, 17, 54756, '2022-01-31', '08:00', '08:30', 30, 0, 0),
(413, 18, 54756, '2022-01-31', '08:30', '09:00', 30, 0, 0),
(414, 19, 54756, '2022-01-31', '09:00', '09:30', 30, 0, 0),
(415, 20, 54756, '2022-01-31', '09:30', '10:00', 30, 1, 21),
(416, 21, 54756, '2022-01-31', '10:00', '10:30', 30, 1, 20),
(417, 22, 54756, '2022-01-31', '10:30', '11:00', 30, 0, 0),
(418, 23, 54756, '2022-01-31', '11:00', '11:30', 30, 0, 0),
(419, 24, 54756, '2022-01-31', '11:30', '12:00', 30, 1, 19),
(420, 25, 54756, '2022-01-31', '12:00', '12:30', 30, 0, 0),
(421, 26, 54756, '2022-01-31', '12:30', '13:00', 30, 0, 0),
(422, 27, 54756, '2022-01-31', '13:00', '13:30', 30, 0, 0),
(423, 28, 54756, '2022-01-31', '13:30', '14:00', 30, 0, 0),
(424, 29, 54756, '2022-01-31', '14:00', '14:30', 30, 0, 0),
(425, 30, 54756, '2022-01-31', '14:30', '15:00', 30, 0, 0),
(426, 31, 54756, '2022-01-31', '15:00', '15:30', 30, 0, 0),
(427, 32, 54756, '2022-01-31', '15:30', '16:00', 30, 0, 0),
(428, 33, 54756, '2022-01-31', '16:00', '16:30', 30, 0, 0),
(429, 34, 54756, '2022-01-31', '16:30', '17:00', 30, 0, 0),
(430, 35, 54756, '2022-01-31', '17:00', '17:30', 30, 0, 0),
(431, 36, 54756, '2022-01-31', '17:30', '18:00', 30, 0, 0),
(432, 37, 54756, '2022-01-31', '18:00', '18:30', 30, 0, 0),
(433, 19, 54758, '2022-01-29', '09:00', '09:30', 30, 0, 0),
(434, 20, 54758, '2022-01-29', '09:30', '10:00', 30, 1, 22),
(435, 21, 54758, '2022-01-29', '10:00', '10:30', 30, 1, 22),
(436, 22, 54758, '2022-01-29', '10:30', '11:00', 30, 0, 0),
(437, 23, 54758, '2022-01-29', '11:00', '11:30', 30, 0, 0),
(438, 24, 54758, '2022-01-29', '11:30', '12:00', 30, 0, 0),
(439, 25, 54758, '2022-01-29', '12:00', '12:30', 30, 0, 0),
(440, 26, 54758, '2022-01-29', '12:30', '13:00', 30, 0, 0),
(441, 27, 54758, '2022-01-29', '13:00', '13:30', 30, 0, 0),
(442, 28, 54758, '2022-01-29', '13:30', '14:00', 30, 0, 0),
(443, 29, 54758, '2022-01-29', '14:00', '14:30', 30, 0, 0),
(444, 30, 54758, '2022-01-29', '14:30', '15:00', 30, 0, 0),
(445, 31, 54758, '2022-01-29', '15:00', '15:30', 30, 0, 0),
(446, 32, 54758, '2022-01-29', '15:30', '16:00', 30, 0, 0),
(447, 17, 54759, '2022-02-01', '08:00', '08:30', 30, 0, 0),
(448, 18, 54759, '2022-02-01', '08:30', '09:00', 30, 0, 0),
(449, 19, 54759, '2022-02-01', '09:00', '09:30', 30, 0, 0),
(450, 20, 54759, '2022-02-01', '09:30', '10:00', 30, 0, 0),
(451, 21, 54759, '2022-02-01', '10:00', '10:30', 30, 0, 0),
(452, 22, 54759, '2022-02-01', '10:30', '11:00', 30, 1, 23),
(453, 23, 54759, '2022-02-01', '11:00', '11:30', 30, 1, 23),
(454, 24, 54759, '2022-02-01', '11:30', '12:00', 30, 0, 0),
(455, 25, 54759, '2022-02-01', '12:00', '12:30', 30, 0, 0),
(456, 26, 54759, '2022-02-01', '12:30', '13:00', 30, 0, 0),
(457, 27, 54759, '2022-02-01', '13:00', '13:30', 30, 0, 0),
(458, 28, 54759, '2022-02-01', '13:30', '14:00', 30, 0, 0),
(459, 29, 54759, '2022-02-01', '14:00', '14:30', 30, 0, 0),
(460, 30, 54759, '2022-02-01', '14:30', '15:00', 30, 0, 0),
(461, 31, 54759, '2022-02-01', '15:00', '15:30', 30, 0, 0),
(462, 32, 54759, '2022-02-01', '15:30', '16:00', 30, 0, 0),
(463, 33, 54759, '2022-02-01', '16:00', '16:30', 30, 0, 0),
(464, 34, 54759, '2022-02-01', '16:30', '17:00', 30, 0, 0),
(465, 35, 54759, '2022-02-01', '17:00', '17:30', 30, 0, 0),
(466, 36, 54759, '2022-02-01', '17:30', '18:00', 30, 0, 0),
(467, 37, 54759, '2022-02-01', '18:00', '18:30', 30, 0, 0),
(468, 15, 54754, '2022-02-01', '07:00', '07:30', 30, 0, 0),
(469, 16, 54754, '2022-02-01', '07:30', '08:00', 30, 0, 0),
(470, 17, 54754, '2022-02-01', '08:00', '08:30', 30, 0, 0),
(471, 18, 54754, '2022-02-01', '08:30', '09:00', 30, 0, 0),
(472, 19, 54754, '2022-02-01', '09:00', '09:30', 30, 0, 0),
(473, 20, 54754, '2022-02-01', '09:30', '10:00', 30, 0, 0),
(474, 21, 54754, '2022-02-01', '10:00', '10:30', 30, 0, 0),
(475, 22, 54754, '2022-02-01', '10:30', '11:00', 30, 0, 0),
(476, 23, 54754, '2022-02-01', '11:00', '11:30', 30, 0, 0),
(477, 24, 54754, '2022-02-01', '11:30', '12:00', 30, 0, 0),
(478, 25, 54754, '2022-02-01', '12:00', '12:30', 30, 0, 0),
(479, 26, 54754, '2022-02-01', '12:30', '13:00', 30, 0, 0),
(480, 27, 54754, '2022-02-01', '13:00', '13:30', 30, 0, 0),
(481, 28, 54754, '2022-02-01', '13:30', '14:00', 30, 0, 0),
(482, 29, 54754, '2022-02-01', '14:00', '14:30', 30, 0, 0),
(483, 30, 54754, '2022-02-01', '14:30', '15:00', 30, 0, 0),
(484, 31, 54754, '2022-02-01', '15:00', '15:30', 30, 0, 0),
(485, 32, 54754, '2022-02-01', '15:30', '16:00', 30, 0, 0),
(486, 33, 54754, '2022-02-01', '16:00', '16:30', 30, 0, 0),
(487, 34, 54754, '2022-02-01', '16:30', '17:00', 30, 0, 0),
(488, 35, 54754, '2022-02-01', '17:00', '17:30', 30, 0, 0),
(489, 36, 54754, '2022-02-01', '17:30', '18:00', 30, 0, 0),
(490, 37, 54754, '2022-02-01', '18:00', '18:30', 30, 0, 0),
(491, 38, 54754, '2022-02-01', '18:30', '19:00', 30, 0, 0),
(492, 39, 54754, '2022-02-01', '19:00', '19:30', 30, 0, 0),
(493, 40, 54754, '2022-02-01', '19:30', '20:00', 30, 0, 0),
(494, 41, 54754, '2022-02-01', '20:00', '20:30', 30, 0, 0),
(495, 42, 54754, '2022-02-01', '20:30', '21:00', 30, 0, 0),
(496, 43, 54754, '2022-02-01', '21:00', '21:30', 30, 0, 0),
(497, 44, 54754, '2022-02-01', '21:30', '22:00', 30, 0, 0),
(499, 21, 54754, '2022-02-23', '10:00', '10:30', 30, 0, 0),
(500, 22, 54754, '2022-02-23', '10:30', '11:00', 30, 0, 0),
(501, 23, 54754, '2022-02-23', '11:00', '11:30', 30, 0, 0),
(502, 24, 54754, '2022-02-23', '11:30', '12:00', 30, 0, 0),
(503, 25, 54754, '2022-02-23', '12:00', '12:30', 30, 0, 0),
(504, 26, 54754, '2022-02-23', '12:30', '13:00', 30, 0, 0),
(505, 27, 54754, '2022-02-23', '13:00', '13:30', 30, 0, 0),
(506, 28, 54754, '2022-02-23', '13:30', '14:00', 30, 0, 0),
(507, 29, 54754, '2022-02-23', '14:00', '14:30', 30, 0, 0),
(508, 30, 54754, '2022-02-23', '14:30', '15:00', 30, 0, 0),
(509, 31, 54754, '2022-02-23', '15:00', '15:30', 30, 0, 0),
(510, 32, 54754, '2022-02-23', '15:30', '16:00', 30, 0, 0),
(511, 33, 54754, '2022-02-23', '16:00', '16:30', 30, 0, 0),
(512, 34, 54754, '2022-02-23', '16:30', '17:00', 30, 0, 0),
(513, 35, 54754, '2022-02-23', '17:00', '17:30', 30, 0, 0),
(514, 36, 54754, '2022-02-23', '17:30', '18:00', 30, 0, 0),
(530, 15, 54754, '2022-02-19', '07:00', '07:30', 30, 0, 0),
(531, 16, 54754, '2022-02-19', '07:30', '08:00', 30, 0, 0),
(532, 17, 54754, '2022-02-19', '08:00', '08:30', 30, 0, 0),
(533, 18, 54754, '2022-02-19', '08:30', '09:00', 30, 0, 0),
(534, 19, 54754, '2022-02-19', '09:00', '09:30', 30, 0, 0),
(535, 20, 54754, '2022-02-19', '09:30', '10:00', 30, 0, 0),
(536, 21, 54754, '2022-02-19', '10:00', '10:30', 30, 0, 0),
(537, 22, 54754, '2022-02-19', '10:30', '11:00', 30, 0, 0),
(538, 23, 54754, '2022-02-19', '11:00', '11:30', 30, 0, 0),
(539, 24, 54754, '2022-02-19', '11:30', '12:00', 30, 0, 0),
(540, 25, 54754, '2022-02-19', '12:00', '12:30', 30, 0, 0),
(541, 26, 54754, '2022-02-19', '12:30', '13:00', 30, 0, 0),
(542, 27, 54754, '2022-02-19', '13:00', '13:30', 30, 0, 0),
(543, 28, 54754, '2022-02-19', '13:30', '14:00', 30, 0, 0),
(544, 29, 54754, '2022-02-19', '14:00', '14:30', 30, 0, 0),
(545, 30, 54754, '2022-02-19', '14:30', '15:00', 30, 0, 0),
(546, 31, 54754, '2022-02-19', '15:00', '15:30', 30, 0, 0),
(547, 32, 54754, '2022-02-19', '15:30', '16:00', 30, 0, 0),
(548, 33, 54754, '2022-02-19', '16:00', '16:30', 30, 0, 0),
(549, 34, 54754, '2022-02-19', '16:30', '17:00', 30, 0, 0),
(550, 17, 54760, '2022-02-01', '08:00', '08:30', 30, 1, 24),
(551, 18, 54760, '2022-02-01', '08:30', '09:00', 30, 1, 24),
(552, 19, 54760, '2022-02-01', '09:00', '09:30', 30, 0, 0),
(553, 20, 54760, '2022-02-01', '09:30', '10:00', 30, 0, 0),
(554, 21, 54760, '2022-02-01', '10:00', '10:30', 30, 0, 0),
(555, 22, 54760, '2022-02-01', '10:30', '11:00', 30, 0, 0),
(556, 23, 54760, '2022-02-01', '11:00', '11:30', 30, 0, 0),
(557, 24, 54760, '2022-02-01', '11:30', '12:00', 30, 0, 0),
(558, 25, 54760, '2022-02-01', '12:00', '12:30', 30, 0, 0),
(559, 26, 54760, '2022-02-01', '12:30', '13:00', 30, 0, 0),
(560, 27, 54760, '2022-02-01', '13:00', '13:30', 30, 0, 0),
(561, 28, 54760, '2022-02-01', '13:30', '14:00', 30, 0, 0),
(562, 29, 54760, '2022-02-01', '14:00', '14:30', 30, 1, 25),
(563, 30, 54760, '2022-02-01', '14:30', '15:00', 30, 1, 25),
(564, 31, 54760, '2022-02-01', '15:00', '15:30', 30, 1, 25),
(565, 32, 54760, '2022-02-01', '15:30', '16:00', 30, 0, 0),
(566, 33, 54760, '2022-02-01', '16:00', '16:30', 30, 0, 0),
(567, 34, 54760, '2022-02-01', '16:30', '17:00', 30, 0, 0),
(568, 35, 54760, '2022-02-01', '17:00', '17:30', 30, 0, 0),
(569, 36, 54760, '2022-02-01', '17:30', '18:00', 30, 0, 0),
(570, 37, 54760, '2022-02-01', '18:00', '18:30', 30, 0, 0),
(571, 17, 54760, '2022-02-02', '08:00', '08:30', 30, 1, 24),
(572, 18, 54760, '2022-02-02', '08:30', '09:00', 30, 1, 24),
(573, 19, 54760, '2022-02-02', '09:00', '09:30', 30, 0, 0),
(574, 20, 54760, '2022-02-02', '09:30', '10:00', 30, 0, 0),
(575, 21, 54760, '2022-02-02', '10:00', '10:30', 30, 0, 0),
(576, 22, 54760, '2022-02-02', '10:30', '11:00', 30, 0, 0),
(577, 23, 54760, '2022-02-02', '11:00', '11:30', 30, 0, 0),
(578, 24, 54760, '2022-02-02', '11:30', '12:00', 30, 0, 0),
(579, 25, 54760, '2022-02-02', '12:00', '12:30', 30, 0, 0),
(580, 26, 54760, '2022-02-02', '12:30', '13:00', 30, 0, 0),
(581, 27, 54760, '2022-02-02', '13:00', '13:30', 30, 0, 0),
(582, 28, 54760, '2022-02-02', '13:30', '14:00', 30, 0, 0),
(583, 29, 54760, '2022-02-02', '14:00', '14:30', 30, 1, 25),
(584, 30, 54760, '2022-02-02', '14:30', '15:00', 30, 1, 25),
(585, 31, 54760, '2022-02-02', '15:00', '15:30', 30, 1, 25),
(586, 32, 54760, '2022-02-02', '15:30', '16:00', 30, 0, 0),
(587, 33, 54760, '2022-02-02', '16:00', '16:30', 30, 0, 0),
(588, 34, 54760, '2022-02-02', '16:30', '17:00', 30, 0, 0),
(589, 35, 54760, '2022-02-02', '17:00', '17:30', 30, 0, 0),
(590, 36, 54760, '2022-02-02', '17:30', '18:00', 30, 0, 0),
(591, 37, 54760, '2022-02-02', '18:00', '18:30', 30, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sal_groups`
--

CREATE TABLE `sal_groups` (
  `g_id` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `g_name` text NOT NULL,
  `user_ids` text NOT NULL,
  `g_pic` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sal_groups`
--

INSERT INTO `sal_groups` (`g_id`, `sal_id`, `g_name`, `user_ids`, `g_pic`) VALUES
(1, 54756, 'my first user', '20', '663ba6b9-9a67-4f24-a52d-1b343823c8a6.jpg'),
(2, 54758, 'My first client', '23', '');

-- --------------------------------------------------------

--
-- Table structure for table `sal_imgs`
--

CREATE TABLE `sal_imgs` (
  `id` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sal_imgs`
--

INSERT INTO `sal_imgs` (`id`, `sal_id`, `img`) VALUES
(1, 54751, 'b1637bfb-f9b3-43f9-a7d7-980a11525e65.png'),
(2, 54752, '2a1c403e-e939-4897-b76b-c7811ce05c79.jpg'),
(3, 54756, '75339a69-c57d-44be-bcf6-de28484868b8.jpg'),
(4, 54756, 'e257b658-5663-4ab4-8de0-991f2b6e9660.jpg'),
(5, 54759, 'c78a48cd-b9d1-4b6b-9ce5-0693f7da09a0.jpg'),
(6, 54759, 'f9fef808-be05-4d7e-8a2a-87b37a3e3b6b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sal_services`
--

CREATE TABLE `sal_services` (
  `id` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `s_name` varchar(128) NOT NULL,
  `s_time_mins` varchar(128) NOT NULL,
  `s_price` int(255) NOT NULL,
  `s_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sal_services`
--

INSERT INTO `sal_services` (`id`, `sal_id`, `s_name`, `s_time_mins`, `s_price`, `s_desc`) VALUES
(21, 54748, 'Facial', '50', 120, ''),
(22, 54748, 'Manicure', '60', 150, ''),
(23, 54748, 'Predicure', '60', 150, ''),
(25, 54748, 'Hair cut', '30', 100, ''),
(26, 54749, 'Facial', '30', 120, ''),
(27, 54747, 'Hair cut', '45', 50, ''),
(28, 54751, 'Cutting men', '30', 50, ''),
(29, 54752, 'Men\'s hair cut', '25', 100, ''),
(30, 54752, 'Facial', '60', 120, ''),
(31, 54754, 'cutt', '50', 60, ''),
(32, 54756, 'Manicure', '30', 120, ''),
(33, 54756, 'Facial', '50', 130, ''),
(34, 54757, 'Facial', '150', 100, ''),
(35, 54758, 'Facial', '40', 150, ''),
(36, 54759, 'Hair test 1', '45', 35, ''),
(37, 54759, 'Clean cut', '60', 25, ''),
(38, 54760, 'Hair cut', '60', 30, ''),
(39, 54760, 'Hair color', '90', 120, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `site_logo_small` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `copy_right` text COLLATE utf8mb4_bin NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `snapchat` text COLLATE utf8mb4_bin DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_bin DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `google_plus` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `skype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `address` text COLLATE utf8mb4_bin NOT NULL,
  `map_address` text COLLATE utf8mb4_bin DEFAULT NULL,
  `color_icon` varchar(100) COLLATE utf8mb4_bin DEFAULT '#000',
  `color_heading` varchar(100) COLLATE utf8mb4_bin DEFAULT '#000',
  `color_body` varchar(100) COLLATE utf8mb4_bin DEFAULT '#fff',
  `slider_time` int(11) DEFAULT 5,
  `style_name` varchar(255) COLLATE utf8mb4_bin DEFAULT 'style.css?version=new',
  `client_title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `client_logo` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `show_email` int(11) NOT NULL DEFAULT 1,
  `show_mobile` int(11) NOT NULL DEFAULT 1,
  `show_fb` int(11) NOT NULL DEFAULT 1,
  `show_tw` int(11) NOT NULL DEFAULT 1,
  `show_li` int(11) NOT NULL DEFAULT 1,
  `show_gp` int(11) NOT NULL DEFAULT 1,
  `show_skype` int(11) NOT NULL DEFAULT 1,
  `show_address` int(11) NOT NULL DEFAULT 0,
  `show_chistmas_popup` int(11) DEFAULT 0,
  `site_favicon` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `meta_title` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_bin DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_bin DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `currency_space` int(11) NOT NULL DEFAULT 0,
  `currency_position` int(11) NOT NULL DEFAULT 0,
  `shipping_fee` decimal(20,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(20,2) NOT NULL DEFAULT 0.00,
  `twillio_pub` text COLLATE utf8mb4_bin DEFAULT NULL,
  `twillio_sec` text COLLATE utf8mb4_bin DEFAULT NULL,
  `support_page` text COLLATE utf8mb4_bin DEFAULT NULL,
  `twillio_api_key` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `twillio_api_sec` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `site_logo_small`, `mobile`, `email`, `copy_right`, `twitter`, `snapchat`, `instagram`, `facebook`, `linkedin`, `google_plus`, `skype`, `address`, `map_address`, `color_icon`, `color_heading`, `color_body`, `slider_time`, `style_name`, `client_title`, `client_logo`, `show_email`, `show_mobile`, `show_fb`, `show_tw`, `show_li`, `show_gp`, `show_skype`, `show_address`, `show_chistmas_popup`, `site_favicon`, `meta_title`, `meta_keywords`, `meta_description`, `currency`, `currency_space`, `currency_position`, `shipping_fee`, `tax`, `twillio_pub`, `twillio_sec`, `support_page`, `twillio_api_key`, `twillio_api_sec`) VALUES
(1, 'Cream App', 'b86d95f6eb6866fde0ae53fc35c1a68c.png', 'a6de26670b4b6561b94a8bc6616a88af.png', '000 000 0000', 'info@dedevelopers.com', 'Â© 2021 Cream App', 'https://tw.com/faisal', NULL, '', 'https://fbbb.com/dedevelopers', 'https://linkend.com/faisal', '', '', 'Office no:45, floor :p1 IT-Tower, Ghulberge Lahore pakistan.', 'IT Tower, Lahore Pakistan', 'rgb(255, 0, 0)', 'rgb(255, 0, 0)', 'rgb(255, 255, 2', 5, 'minfied_css_1535980922.css', 'c_logo', '2794728d21a8434e8eb6834ef5b7352b.png', 1, 1, 0, 0, 0, 0, 0, 1, 1, '9f3d25c7c910945cf4f5dc23bba8c10c.png', NULL, NULL, NULL, NULL, 0, 0, 0.00, 0.00, 'AC35ecb260ceed4e34b5eafa3e26ea0b87', '1b3f2a3978917771d657af7ab6ec1fa0', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `s_id` int(2) NOT NULL,
  `start_time` varchar(8) NOT NULL,
  `end_time` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`s_id`, `start_time`, `end_time`) VALUES
(1, '00:00', '00:30'),
(2, '00:30', '01:00'),
(3, '01:00', '01:30'),
(4, '01:30', '02:00'),
(5, '02:00', '02:30'),
(6, '02:30', '03:00'),
(7, '03:00', '03:30'),
(8, '03:30', '04:00'),
(9, '04:00', '04:30'),
(10, '04:30', '05:00'),
(11, '05:00', '05:30'),
(12, '05:30', '06:00'),
(13, '06:00', '06:30'),
(14, '06:30', '07:00'),
(15, '07:00', '07:30'),
(16, '07:30', '08:00'),
(17, '08:00', '08:30'),
(18, '08:30', '09:00'),
(19, '09:00', '09:30'),
(20, '09:30', '10:00'),
(21, '10:00', '10:30'),
(22, '10:30', '11:00'),
(23, '11:00', '11:30'),
(24, '11:30', '12:00'),
(25, '12:00', '12:30'),
(26, '12:30', '13:00'),
(27, '13:00', '13:30'),
(28, '13:30', '14:00'),
(29, '14:00', '14:30'),
(30, '14:30', '15:00'),
(31, '15:00', '15:30'),
(32, '15:30', '16:00'),
(33, '16:00', '16:30'),
(34, '16:30', '17:00'),
(35, '17:00', '17:30'),
(36, '17:30', '18:00'),
(37, '18:00', '18:30'),
(38, '18:30', '19:00'),
(39, '19:00', '19:30'),
(40, '19:30', '20:00'),
(41, '20:00', '20:30'),
(42, '20:30', '21:00'),
(43, '21:00', '21:30'),
(44, '21:30', '22:00'),
(45, '22:00', '22:30'),
(46, '22:30', '23:00'),
(47, '23:00', '23:30'),
(48, '23:30', '24:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `string` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `code` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `code_text` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `address` text COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `session_id_key` text COLLATE utf8mb4_bin DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_bin DEFAULT 'dummy_image.png',
  `lifetime_random` text COLLATE utf8mb4_bin DEFAULT NULL,
  `api_logged_sess` text COLLATE utf8mb4_bin DEFAULT NULL,
  `api_logged_time` datetime DEFAULT current_timestamp(),
  `push_id` text COLLATE utf8mb4_bin DEFAULT NULL,
  `social_id` text COLLATE utf8mb4_bin DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `street` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  `zip` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `key_code` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `device_model` text COLLATE utf8mb4_bin DEFAULT NULL,
  `device_manufactur` text COLLATE utf8mb4_bin DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `signup_type` varchar(264) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `string`, `code`, `code_text`, `phone`, `address`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`, `session_id`, `session_id_key`, `profile_pic`, `lifetime_random`, `api_logged_sess`, `api_logged_time`, `push_id`, `social_id`, `country`, `city`, `street`, `zip`, `key_code`, `device_model`, `device_manufactur`, `added_by`, `signup_type`) VALUES
(2, 'Faisal', 'faisal', 'faisall@gmail.com', '12345678', NULL, NULL, NULL, NULL, NULL, 1, '2021-10-24 12:33:10', NULL, '2021-10-29 17:38:08', 1, 0, NULL, NULL, NULL, 'dummy_image.png', NULL, '1b85a4e4ecd8c2eb7b9b6bb70c5b9e56', '2021-12-11 19:36:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'faisalff', 'faisalf', 'faisal@gmail.comm', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '03134081068', 'Lahore', 1, '2021-10-27 14:18:27', NULL, '2021-10-29 17:38:02', 1, 0, NULL, NULL, NULL, 'd87debfb-c292-4262-bc4c-875ef19517b2.jpg', NULL, '71358cc17c66a50d46b60d8f1ffa7998', '2021-12-11 18:31:29', 'ExponentPushToken[U_TuasILAVud73KjB918N7]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Faisal Shahzad', 'Faisal Shahzad', 'csgenius786@gmail.com', '798a9c862ca6fbb281adcba7206a54f1', NULL, NULL, NULL, NULL, NULL, 1, '2021-10-29 17:38:28', 1, '2021-10-29 17:38:28', 1, 0, NULL, NULL, NULL, 'dummy_image.png', NULL, NULL, '2021-10-29 17:38:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'thshhs', 'thshhs', 'attt@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2021-11-23 15:10:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, '26317af6-7bcf-4d41-9dad-1089be79d7ed.jpg', NULL, '37d583a10f3ffc241d567dea5a3c86f0', '2021-11-23 15:10:00', 'ExponentPushToken[6uQqkMDLwTM2PNhxF92oOh]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Mughees', 'Mughees', 'mughees@gmail.com', '123456789', NULL, NULL, NULL, NULL, NULL, 1, '2021-11-24 19:12:47', NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, 'ccaba25d129f832cfa16ecc32699bd9f', '2022-01-07 21:07:03', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Mughees22', 'Mughees223', 'mughees.abbas@gmail.com', 'mughees111', NULL, NULL, NULL, NULL, NULL, 1, '2021-11-24 20:00:39', NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, '61e958957f9042d7f49663dbac064adc', '2021-12-11 20:43:41', 'ExponentPushToken[HVYy6UJm-fy4cRIdHU4ya_]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'mughees', 'mughees11', 'mughees.test@gmail.com', '1ce18ecc7ad294d05334fa074ecd0f37', NULL, NULL, NULL, '03134081068', NULL, 1, '2021-12-28 22:26:19', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'a82f22bd-3cf8-433b-84af-6d09a61b02fb.jpg', NULL, '551255b7009ea1f1d3f2b79b23bf416d', '2022-01-29 22:27:09', '', NULL, NULL, NULL, NULL, NULL, NULL, 'V2043', 'vivo', NULL, NULL),
(9, 'mughees', 'mughees', 'mughees.abas@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2021-12-28 22:31:25', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '5a4d069dec159d26bf51f262f4ece2d1', '2021-12-28 22:31:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Mughees', 'Mughees', 'mugheehdjs.abas@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2021-12-28 22:34:51', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '13e0532f691165924f9671b6377e950e', '2021-12-28 22:34:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Mughees', 'Mughees', 'mugheehzkzdjs.abas@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2021-12-28 22:39:06', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'e771cacff3f4861374179abaeb09c770', '2021-12-28 22:39:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'willmak', 'willmak', 'afroexpression@gmail.com', '9fbd234907023fc293761666ed3400c9', NULL, NULL, NULL, NULL, NULL, 1, '2021-12-30 00:52:03', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '267dd370b64c87957680880bd297a4a5', '2022-01-19 00:21:27', '', NULL, NULL, NULL, NULL, NULL, NULL, 'BE2028', 'OnePlus', NULL, NULL),
(13, 'willmak', 'Will', 'wpromak@gmail.com', '2500f9221fc316aab1564a302d781e5a', NULL, NULL, NULL, '+14153598384', NULL, 1, '2022-01-10 11:36:57', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '6f7ca347012b05236569335f53a2d293', '2022-01-31 09:37:47', '', NULL, NULL, NULL, NULL, NULL, NULL, 'BE2028', 'OnePlus', NULL, NULL),
(14, 'test111', 'test111', 'test@test.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2022-01-17 19:12:03', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '853890651b1270c06a4830fe25e35d04', '2022-01-17 19:12:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'par', 'par', 'mehmoodparus@gmail.com', '8dbdd6877a1fd15924d1ea8566742870', NULL, NULL, NULL, NULL, NULL, 1, '2022-01-18 00:41:32', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bcb6cc1957319e4fea6e9c3e41e0016a', '2022-01-18 00:41:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'zaheer', 'zaheer', 'zaheerhussain@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '12345678900', NULL, 1, '2022-01-18 22:34:35', NULL, NULL, NULL, 0, NULL, NULL, NULL, '7e975534-4b75-477b-8bca-6bc0d76b53f4.jpg', NULL, 'bb88b1ed8547c7c9042d86d11cfceaf5', '2022-01-23 06:42:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'V2043', 'vivo', NULL, NULL),
(17, 'zaidh', 'zaidh', 'Zaidharoon8@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2022-01-19 00:33:54', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'b90ba40f72880c5c8ba76fea0e4923c8', '2022-01-19 00:33:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'this', 'this', 'this@gmail.con', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2022-01-26 13:50:49', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '241345ece2c9c4c705b31814b61fd059', '2022-01-26 13:50:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'mahevstark', 'mahevstark', 'mahevstark@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, NULL, NULL, 1, '2022-01-26 14:02:15', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '799869344efddcebe4b8e6d43f47b30a', '2022-01-26 14:02:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Niaz', 'Niaz', 'niazrai3@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '31340810689', NULL, 1, '2022-01-29 19:02:36', NULL, NULL, NULL, 0, NULL, NULL, NULL, '0dd9f6fa-d948-4476-9a84-0e0bd0e12f93.jpg', NULL, '39474fb7a3bcfb62d6682e82ff429f3a', '2022-01-29 19:02:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'My test user', 'My test user', 'testuser1@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '3134081069', NULL, 1, '2022-01-29 19:03:25', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'a56c9c2f5c4ea82c1d2b5fcefb33dac6', '2022-01-29 19:03:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54756, NULL),
(22, 'test2', 'test2', 'test2@test.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, '1234567890', NULL, 1, '2022-01-29 19:15:31', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'd9253f9e0630c42d0f47ca3b571e4213', '2022-01-29 19:15:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54756, NULL),
(23, 'Test', 'Test', 'testuser@test.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '1234567890', NULL, 1, '2022-01-29 22:40:38', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'a0a3aa2ef4a59325dec7cd3cef0295e4', '2022-01-29 22:40:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54758, NULL),
(24, 'test', 'test', 'test1@test.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL, '31358096622', NULL, 1, '2022-02-01 22:49:41', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'c3421f62-0f00-4c2b-9142-e12667bfcdef.jpg', NULL, '1ad0a2b54da7002fb8e827d2a3ebef59', '2022-02-01 22:49:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Mughees Butt', 'Mughees Buttt', 'mughees.abbas@gmail.com', 'c5045d3290f9017fd9a1b81a77300f40', NULL, NULL, NULL, '03134081068', NULL, 1, '2022-02-02 21:07:57', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'd14bf422-a8f2-4545-90ec-16c75915bcf7.jpg', NULL, '30c20af1d1f42ce231857f140dd95345', '2022-02-03 01:10:07', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GOOGLE'),
(26, 'Mughees Butt', 'Mughees Butt', 'raafayhassan123@gmail.com', '9cb4517a2bf1baa7242fd6663ae20f0e', NULL, NULL, NULL, NULL, NULL, 1, '2022-02-03 00:25:37', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'dummy_image.png', NULL, '414a4e5c37136e640fb1e2bd5e77dc05', '2022-02-03 00:31:20', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FACEBOOK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `FK_sal_id` (`sal_id`);

--
-- Indexes for table `notificationss`
--
ALTER TABLE `notificationss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`sal_id`),
  ADD UNIQUE KEY `unique_index` (`sal_name`,`sal_lat`,`sal_lng`) USING BTREE,
  ADD KEY `sal_instagram` (`sal_instagram`),
  ADD KEY `sal_name` (`sal_name`);

--
-- Indexes for table `salon_slots`
--
ALTER TABLE `salon_slots`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `sal_groups`
--
ALTER TABLE `sal_groups`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `sal_imgs`
--
ALTER TABLE `sal_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sal_services`
--
ALTER TABLE `sal_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notificationss`
--
ALTER TABLE `notificationss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salons`
--
ALTER TABLE `salons`
  MODIFY `sal_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54761;

--
-- AUTO_INCREMENT for table `salon_slots`
--
ALTER TABLE `salon_slots`
  MODIFY `ss_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=592;

--
-- AUTO_INCREMENT for table `sal_groups`
--
ALTER TABLE `sal_groups`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sal_imgs`
--
ALTER TABLE `sal_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sal_services`
--
ALTER TABLE `sal_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `s_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
