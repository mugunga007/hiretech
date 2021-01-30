-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2019 at 07:09 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiretech`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_seeker`
--

CREATE TABLE `bookmark_seeker` (
  `bookmark_seeker_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookmark_seeker`
--

INSERT INTO `bookmark_seeker` (`bookmark_seeker_id`, `provider_id`, `seeker_id`, `job_type_id`) VALUES
(62, 10, 14, 2),
(75, 10, 15, 3),
(77, 13, 15, 3),
(78, 13, 18, 1),
(79, 13, 17, 3),
(80, 14, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `job_type_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`job_type_id`, `title`, `description`) VALUES
(1, 'Tailor', 'Industry Work'),
(2, 'Waiter', 'Hotel, Restaurant'),
(3, 'Receptionist', 'Hotel, Guest House'),
(4, 'Carpenter', '...'),
(5, 'Plumber', '...'),
(6, 'Electricity Technician', '...'),
(7, 'Construction Helper', '...'),
(8, 'Architecture Designer', '...'),
(9, 'Bikes Mechanician', '...'),
(10, 'Car Mechanician', '...'),
(11, 'Home Daycare', '...');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1545360919),
('m130524_201442_init', 1545360928);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` double NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`provider_id`, `names`, `email`, `password`, `type`, `address`, `phone`, `time`) VALUES
(9, 'soma eric', 'eric@gmail.com', 'ericyii', 'individual', 'remera', 788675645, '2019-01-09 04:41:31'),
(10, 'shema landry', 'lando@gmail.com', '123456', 'individual', 'kobe', 788685746, '2019-01-09 05:13:23'),
(11, 'HillView Hotel', 'hillview@gmail.com', '123456', 'company', 'kigali', 788786069, '2019-04-23 06:31:30'),
(12, 'IcePark Restaurant', 'icepark@icegroup.com', 'ice2019', 'company', 'kimihurura', 788453212, '2019-05-21 06:21:43'),
(13, 'Rugamba Charles', 'rugambac@gmail.com', '123456', 'individual', 'kigali', 788302567, '2019-05-21 06:25:12'),
(14, 'Mattis Enterprise', 'mattisent@gmail.com', '123456', 'company', 'kigali', 788606989, '2019-05-25 10:33:09'),
(15, 'Florence Umutoni', 'florence_toni@gmail.com', 'florence2019', 'individual', 'kigali', 788654020, '2019-05-26 00:34:53'),
(16, 'Jacob Muhima', 'muhima@gmail.com', '123456', 'individual', 'kigali', 887869593, '2019-07-19 12:33:25'),
(17, 'Rugaba Yvan', 'rugaba@gmail.com', '123456', 'individual', 'kigali', 818080325723, '2019-08-14 07:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `provider_job`
--

CREATE TABLE `provider_job` (
  `provider_job_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `job_type_id` int(11) NOT NULL,
  `location` varchar(80) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `work_hours` int(11) DEFAULT NULL,
  `contract_type` varchar(40) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `round` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_job`
--

INSERT INTO `provider_job` (`provider_job_id`, `provider_id`, `job_title`, `job_type_id`, `location`, `description`, `salary`, `work_hours`, `contract_type`, `status`, `date`, `last_edit`, `round`) VALUES
(1, 10, 'waiter', 2, 'remera', 'waiter', 150000, 6, 'permanent', 1, '2019-03-01 00:09:13', '2019-06-26 21:28:14', 0),
(2, 10, 'Hotel Receptionist', 3, 'kacyiru', 'Receptionist night-shift', 200000, 8, 'parttime', 1, '2019-01-01 00:09:13', '2019-06-26 20:51:30', 0),
(6, 10, 'Waiter at B Hotel', 2, 'kigali', '', 180000, 7, 'temporary', 1, '2018-12-19 00:09:13', '2019-06-26 21:28:07', 0),
(7, 10, 'front dest head', 3, 'kigali', '', 300000, 8, 'permanent', 1, '2019-04-07 02:06:08', '2019-04-06 17:40:57', 1),
(15, 10, 'Hotel Receptionist round 1', 3, 'kacyiru', 'Receptionist night-shift', 200000, 8, 'parttime', 3, '2019-04-07 16:56:57', '2019-04-25 04:50:25', 1),
(16, 10, 'waiter round 1', 2, 'remera', 'waiter', 150000, 6, 'permanent', 3, '2019-04-07 17:53:29', '2019-04-25 04:48:32', 1),
(18, 11, 'waiter (bar)', 2, 'remera', 'No desc....', 300000, 34, 'permanent', 1, '2019-04-24 15:21:28', '2019-04-24 15:21:28', 1),
(21, 14, 'waiters at mattis', 2, 'kigali', 'Easy job', 150000, 28, 'permanent', 3, '2019-05-25 21:15:23', '2019-05-25 13:09:02', 1),
(22, 9, 'Hotel Blue\'s Waiter', 2, 'Remera', 'Welcome customers, guide them to seat and take their orders.', 200000, 35, 'temporary', 1, '2019-07-08 08:10:33', '2019-07-08 00:32:38', 1),
(23, 16, 'tailor', 1, 'remera', 'desco', 100000, 12, 'permanent', 3, '2019-07-19 21:38:31', '2019-08-08 12:33:14', 1),
(25, 17, 'geust h', 3, 'kabuga', '', 200000, 28, 'permanent', 1, '2019-08-15 14:30:33', '2019-08-15 09:47:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `provider_notification`
--

CREATE TABLE `provider_notification` (
  `provider_notification_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unread',
  `type` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_notification`
--

INSERT INTO `provider_notification` (`provider_notification_id`, `provider_id`, `message`, `status`, `type`, `from_email`, `time`) VALUES
(1, 10, 'You have new response', 'unread', 'response', 'chris@gmail.com', '2019-06-04 00:00:00'),
(3, 10, 'Your Offer was Accepted', 'unread', 'Accepted', 'aime@gmail.com', '2019-06-02 12:26:53'),
(4, 16, 'Your Offer was Accepted', 'unread', 'Accepted', 'mugunga6@gmail.com', '2019-08-19 17:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `search_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `address` varchar(80) NOT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `search_result_seeker`
--

CREATE TABLE `search_result_seeker` (
  `search_result_seeker_id` int(11) NOT NULL,
  `search_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` (
  `seeker_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `picture` varchar(100) DEFAULT 'default.jpg',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(8) NOT NULL,
  `phone` double NOT NULL,
  `address` varchar(30) NOT NULL,
  `job_type_id` int(11) NOT NULL DEFAULT '0',
  `experience` varchar(250) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`seeker_id`, `firstname`, `lastname`, `picture`, `email`, `password`, `dob`, `gender`, `phone`, `address`, `job_type_id`, `experience`, `views`, `time`) VALUES
(14, 'mutabazi', 'aime', 'aime@gmail.compic.jpg', 'aime@gmail.com', 'aimeyii', '1995-11-29', 'male', 788675645, 'kic', 0, 'worked 4 years', 0, '2019-01-06 08:43:18'),
(15, 'Mugabo', 'Sabin', 'chris@gmail.compic.jpg', 'chris@gmail.com', '123456', '1990-01-05', 'male', 788695847, 'kasu', 0, 'worked in Hotel', 0, '2019-01-06 09:20:45'),
(17, 'Tanaka', 'hito', 'hito@gmail.compic.jpg', 'hito@gmail.com', '123456', '1994-02-09', 'male', 818080325723, 'kicukiro', 0, '2 Years hotel', 0, '2019-03-01 02:57:54'),
(18, 'Kalisa', 'Tom', 'tom@gmail.compic.jpg', 'tom@gmail.com', '123456', '1994-07-21', 'male', 788695849, 'gikondo', 0, 'I have worked in Texirwa 5 years', 0, '2019-03-29 12:08:25'),
(19, 'Ndahiro', 'Emmy', 'mugunga6@gmail.compic.jpg', 'mugunga6@gmail.com', '123456', '1985-09-23', 'male', 818080325723, 'remera', 0, 'dkek', 0, '2019-08-15 14:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_job_type`
--

CREATE TABLE `seeker_job_type` (
  `id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seeker_job_type`
--

INSERT INTO `seeker_job_type` (`id`, `seeker_id`, `job_type_id`) VALUES
(4, 14, 2),
(5, 15, 3),
(6, 15, 2),
(9, 17, 2),
(10, 17, 3),
(11, 18, 1),
(12, 19, 2),
(13, 19, 3),
(14, 18, 4),
(15, 18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `seeker_notification`
--

CREATE TABLE `seeker_notification` (
  `seeker_notification_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unread',
  `type` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seeker_notification`
--

INSERT INTO `seeker_notification` (`seeker_notification_id`, `seeker_id`, `message`, `status`, `type`, `from_email`, `time`) VALUES
(1, 15, 'here i am', 'read', 'About offer', 'lando@gmail.com', '2019-05-09 22:57:24'),
(7, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'lando@gmail.com', '2019-05-13 13:17:06'),
(8, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'lando@gmail.com', '2019-05-13 13:18:53'),
(9, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'lando@gmail.com', '2019-05-13 13:26:11'),
(10, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'lando@gmail.com', '2019-05-13 14:56:26'),
(11, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'eric@gmail.com', '2019-05-19 13:10:25'),
(12, 15, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'rugambac@gmail.com', '2019-05-21 15:27:25'),
(13, 18, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'rugambac@gmail.com', '2019-05-21 15:27:52'),
(14, 17, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'rugambac@gmail.com', '2019-05-21 15:28:05'),
(15, 14, 'Your Profile Got Saved By an Employer, Good Luck!', 'read', 'Bookmarked', 'mattisent@gmail.com', '2019-05-25 21:13:59'),
(26, 17, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-16 18:04:34'),
(27, 17, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-16 18:29:44'),
(28, 17, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-16 18:32:14'),
(29, 17, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-16 18:36:49'),
(30, 19, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-16 18:36:53'),
(31, 17, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-19 17:31:46'),
(32, 19, 'You have a new offer', 'unread', 'Offer', 'muhima@gmail.com', '2019-08-19 17:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `selected_seeker`
--

CREATE TABLE `selected_seeker` (
  `selected_seeker_id` int(11) NOT NULL,
  `search_id` int(11) DEFAULT NULL,
  `seeker_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `job_type_searched` int(11) NOT NULL,
  `provider_job_id` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `selection_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `availability_time` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `job_description` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `confirmation_time` datetime DEFAULT NULL,
  `seeker_response_time` datetime DEFAULT NULL,
  `provider_notification` int(11) NOT NULL DEFAULT '0',
  `seeker_notification` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `selected_seeker`
--

INSERT INTO `selected_seeker` (`selected_seeker_id`, `search_id`, `seeker_id`, `provider_id`, `job_type_searched`, `provider_job_id`, `status`, `selection_time`, `availability_time`, `deadline`, `address`, `job_description`, `message`, `confirmation_time`, `seeker_response_time`, `provider_notification`, `seeker_notification`) VALUES
(62, NULL, 14, 10, 2, 16, 'Accepted', '2019-04-25 13:43:42', NULL, NULL, NULL, NULL, '', '2019-04-25 04:48:32', '2019-06-02 03:26:53', 0, 0),
(63, NULL, 15, 10, 3, 15, 'Accepted', '2019-04-25 13:43:53', NULL, NULL, NULL, NULL, '', '2019-04-25 04:50:25', '2019-05-02 12:12:28', 0, 0),
(68, NULL, 14, 14, 2, 21, 'Confirmed', '2019-05-25 22:04:49', NULL, NULL, NULL, NULL, '', '2019-05-25 13:09:02', NULL, 0, 0),
(69, NULL, 15, 14, 2, 21, 'Confirmed', '2019-05-25 22:04:52', NULL, NULL, NULL, NULL, '', '2019-05-25 13:09:02', NULL, 0, 0),
(70, NULL, 17, 14, 2, 21, 'Confirmed', '2019-05-25 22:04:58', NULL, NULL, NULL, NULL, '', '2019-05-25 13:09:02', NULL, 0, 0),
(75, NULL, 15, 10, 2, 6, 'Selected', '2019-06-26 13:52:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(80, NULL, 14, 10, 2, 1, 'Selected', '2019-06-26 14:28:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(81, NULL, 14, 9, 2, 22, 'Selected', '2019-07-08 09:18:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(82, NULL, 15, 9, 2, 22, 'Selected', '2019-07-08 09:32:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(84, NULL, 18, 16, 1, 23, 'Confirmed', '2019-07-19 21:39:37', NULL, NULL, NULL, NULL, '', '2019-08-08 12:33:14', NULL, 0, 0),
(110, NULL, 15, 17, 3, 25, 'Selected', '2019-08-15 18:46:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(111, NULL, 17, 17, 3, 25, 'Selected', '2019-08-15 18:46:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'ixCozKMKtfLuIrpd0lyas0bOwqkxswWV', '$2y$13$46yb7dETm2LZxF4HGi7LU.XBGYMlihhNVOzXI9MBHT7dT/HJp6Af.', NULL, 'shemagreat@gmail.com', 10, 1546750512, 1546750512, 'user'),
(5, 'aime@gmail.com', 'jVW8V7Ibk6ipImpu0PVraV5kOKocGtEw', '$2y$13$tF7iMc6UmGlywcW7C33wBOGUyvKp54sRdullzqF5fPlZPNgLFF8TS', NULL, 'aime@gmail.com', 10, 1546764200, 1546764200, 'seeker'),
(6, 'chris@gmail.com', 'necWBZ0cOZysQWEmLxVB7dHq2qamP-tG', '$2y$13$N2B4oE7xrszcjVSGyjShc.lOZ4hmdUpRH6VqCJ9jy/1XwGSftJ00G', NULL, 'chris@gmail.com', 10, 1546766448, 1546766448, 'seeker'),
(7, 'eric@gmail.com', 'oI8krU8Tanj5VbOkZDSGgKtme97-ui8m', '$2y$13$N2bnFAV4eW1jpjtbxeNbKuFI2ZPaSBp/At1eYHE8/zTKJ71Rcf80G', NULL, 'eric@gmail.com', 10, 1547008893, 1547008893, 'provider'),
(9, 'lando@gmail.com', 'N6fbiV3BXb_pHuVDee4X1BpWlbuEuFWI', '$2y$13$vZFjXPA1jroPIZZwmvC02eoxfmJeqClvv5dPRhiFSiECyyXabUMu.', NULL, 'lando@gmail.com', 10, 1547010805, 1547010805, 'provider'),
(10, 'hito@gmail.com', '6ZaNdtKmBQSlWFZHyZy8DBbx8GM0OrG8', '$2y$13$yXZJbx3oKiO0sSX29yCunOf2mhoXJUE6QCBIqSCZ9Znl05HB9nH2W', NULL, 'hito@gmail.com', 10, 1551409076, 1551409076, 'seeker'),
(11, 'tom@gmail.com', 'GYWU1ph0q62ygdmoadV38JpgGiRQ7IO2', '$2y$13$slQepFxPE96M9z.QjQKKZu4ZLDdBdTkcEUj.I3Ts9DriMkm4kgOJ2', NULL, 'tom@gmail.com', 10, 1553861307, 1553861307, 'seeker'),
(12, 'hillview@gmail.com', 'YgiN99gckX4BsNr68tvvg2004rPvNhY6', '$2y$13$ho1/aZT9aBxfkuAwXs3XR.2CnlcZVrzBJGgiL2xnDaH7cotSPjZa.', NULL, 'hillview@gmail.com', 10, 1556001092, 1556001092, 'provider'),
(13, 'icepark@icegroup.com', 'emeIYRuElJmW_kFWo7q0_9Dnab8KJ6qW', '$2y$13$2I97UXNEfzkzko.Z8AvsMeLFG.9VRwj2WYUdW6K37F1veJ5OnqHQm', NULL, 'icepark@icegroup.com', 10, 1558419706, 1558419706, 'provider'),
(14, 'rugambac@gmail.com', '7ZNkX3JSooLFsHaMDtWGt8IfAlDYCA2N', '$2y$13$Esw4W26bViQPSZlfjpr5X.NzVW/cpjd43eeIHV6gENmyaflZRoHum', NULL, 'rugambac@gmail.com', 10, 1558419914, 1558419914, 'provider'),
(15, 'mattisent@gmail.com', 'W-Wt0bA6SjsMH_5im8XgTugQbY_Pf9Kq', '$2y$13$BhDXla3MQGu841snFpdreejWScmrFK5tP1IARRHDcM1q6SP7/Laym', NULL, 'mattisent@gmail.com', 10, 1558780392, 1558780392, 'provider'),
(16, 'florence_toni@gmail.com', 'Dz_Xb6u2d9xYTZvFdaBtbFh2t4Vg7-_E', '$2y$13$Lfl2DxoKCztHFx/v9uP1p.OijeHciOvs.U/PQWHy4Q7qlzN9g.Kqa', NULL, 'florence_toni@gmail.com', 10, 1558830896, 1558830896, 'provider'),
(17, 'muhima@gmail.com', '-LH4auhKlrHnbIy6zQGZN4XJdmKw65E2', '$2y$13$YWOGkmMzs0kg528MY2Jd8.FwzHUl8qFdmS3HO1XARHLq87f0z/ez2', NULL, 'muhima@gmail.com', 10, 1563539607, 1563539607, 'provider'),
(18, 'rugaba@gmail.com', '9CGsq3lwhWx2ajD7g9um6qipy7uI9UIJ', '$2y$13$g2.0vnDs2m4Y8zOE7OJEYO8TXGwJ2YWSBAwp7B82wtlNP8hceaII.', NULL, 'rugaba@gmail.com', 10, 1565769363, 1565769363, 'provider'),
(19, 'mugunga6@gmail.com', 'nbifYriuQiVibJvZHpIpYX1yad7EIKQ1', '$2y$13$R.SDoOuUZ6yFbKEEbDEq1OnrpEQ4R0aKhZyO4ZIIKifX8k2mrSW62', NULL, 'mugunga6@gmail.com', 10, 1565877752, 1565877752, 'seeker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark_seeker`
--
ALTER TABLE `bookmark_seeker`
  ADD PRIMARY KEY (`bookmark_seeker_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `provider_job`
--
ALTER TABLE `provider_job`
  ADD PRIMARY KEY (`provider_job_id`),
  ADD UNIQUE KEY `job_title` (`job_title`),
  ADD KEY `job_type_id` (`job_type_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `provider_notification`
--
ALTER TABLE `provider_notification`
  ADD PRIMARY KEY (`provider_notification_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `search_ibfk_1` (`provider_id`),
  ADD KEY `search_ibfk_2` (`job_type_id`);

--
-- Indexes for table `search_result_seeker`
--
ALTER TABLE `search_result_seeker`
  ADD PRIMARY KEY (`search_result_seeker_id`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`seeker_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `seeker_job_type`
--
ALTER TABLE `seeker_job_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seeker_job_type_ibfk_1` (`seeker_id`),
  ADD KEY `seeker_job_type_ibfk_2` (`job_type_id`);

--
-- Indexes for table `seeker_notification`
--
ALTER TABLE `seeker_notification`
  ADD PRIMARY KEY (`seeker_notification_id`),
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `selected_seeker`
--
ALTER TABLE `selected_seeker`
  ADD PRIMARY KEY (`selected_seeker_id`),
  ADD KEY `selected_seeker_ibfk_1` (`seeker_id`),
  ADD KEY `selected_seeker_ibfk_3` (`provider_id`),
  ADD KEY `selected_seeker_ibfk_4` (`provider_job_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark_seeker`
--
ALTER TABLE `bookmark_seeker`
  MODIFY `bookmark_seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provider_job`
--
ALTER TABLE `provider_job`
  MODIFY `provider_job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `provider_notification`
--
ALTER TABLE `provider_notification`
  MODIFY `provider_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `search_result_seeker`
--
ALTER TABLE `search_result_seeker`
  MODIFY `search_result_seeker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `seeker_job_type`
--
ALTER TABLE `seeker_job_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seeker_notification`
--
ALTER TABLE `seeker_notification`
  MODIFY `seeker_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `selected_seeker`
--
ALTER TABLE `selected_seeker`
  MODIFY `selected_seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark_seeker`
--
ALTER TABLE `bookmark_seeker`
  ADD CONSTRAINT `bookmark_seeker_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_seeker_ibfk_2` FOREIGN KEY (`seeker_id`) REFERENCES `seeker` (`seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provider_job`
--
ALTER TABLE `provider_job`
  ADD CONSTRAINT `provider_job_ibfk_1` FOREIGN KEY (`job_type_id`) REFERENCES `job_type` (`job_type_id`),
  ADD CONSTRAINT `provider_job_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`);

--
-- Constraints for table `provider_notification`
--
ALTER TABLE `provider_notification`
  ADD CONSTRAINT `provider_notification_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`);

--
-- Constraints for table `search`
--
ALTER TABLE `search`
  ADD CONSTRAINT `search_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `search_ibfk_2` FOREIGN KEY (`job_type_id`) REFERENCES `job_type` (`job_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seeker_job_type`
--
ALTER TABLE `seeker_job_type`
  ADD CONSTRAINT `seeker_job_type_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `seeker` (`seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seeker_job_type_ibfk_2` FOREIGN KEY (`job_type_id`) REFERENCES `job_type` (`job_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seeker_notification`
--
ALTER TABLE `seeker_notification`
  ADD CONSTRAINT `seeker_notification_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `seeker` (`seeker_id`);

--
-- Constraints for table `selected_seeker`
--
ALTER TABLE `selected_seeker`
  ADD CONSTRAINT `selected_seeker_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `seeker` (`seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_seeker_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_seeker_ibfk_4` FOREIGN KEY (`provider_job_id`) REFERENCES `provider_job` (`provider_job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
