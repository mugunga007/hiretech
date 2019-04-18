-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2019 at 10:19 AM
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
(60, 10, 15, 2);

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
(3, 'Receptionist', 'Hotel, Guest House');

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
  `phone` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`provider_id`, `names`, `email`, `password`, `type`, `address`, `phone`, `time`) VALUES
(9, 'soma eric', 'eric@gmail.com', 'ericyii', 'individual', 'remera', 788675645, '2019-01-09 04:41:31'),
(10, 'shema landry', 'lando@gmail.com', '123456', 'individual', 'kobe', 788685746, '2019-01-09 05:13:23');

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
(1, 10, 'waiter', 2, 'remera', 'waiter', 150000, 6, 'permanent', 4, '2019-03-01 00:09:13', '2019-04-06 15:36:29', 0),
(2, 10, 'Hotel Receptionist', 3, 'kacyiru', 'Receptionist night-shift', 200000, 8, 'parttime', 4, '2019-01-01 00:09:13', '2019-04-06 18:30:22', 0),
(5, 9, 'Waiter at Choco', 2, 'Kigali city', '', 150000, 8, 'permanent', 1, '2018-12-20 00:09:13', '2019-04-01 03:19:44', 0),
(6, 10, 'Waiter at B Hotel', 2, 'kigali', '', 180000, 7, 'temporary', 1, '2018-12-19 00:09:13', '2019-04-01 04:22:24', 0),
(7, 10, 'front dest head', 3, 'kigali', '', 300000, 8, 'permanent', 1, '2019-04-07 02:06:08', '2019-04-06 17:40:57', 1),
(15, 10, 'Hotel Receptionist round 1', 3, 'kacyiru', 'Receptionist night-shift', 200000, 8, 'parttime', 1, '2019-04-07 16:56:57', '2019-04-07 16:56:57', 1),
(16, 10, 'waiter round 1', 2, 'remera', 'waiter', 150000, 6, 'permanent', 1, '2019-04-07 17:53:29', '2019-04-07 17:53:29', 1);

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
  `phone` int(11) NOT NULL,
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
(15, 'mahoro', 'chris', 'chris@gmail.compic.jpg', 'chris@gmail.com', '123456', '1990-01-05', 'male', 788695847, 'kasu', 0, 'worked in Hotel', 0, '2019-01-06 09:20:45'),
(17, 'Tanaka', 'hito', 'hito@gmail.compic.jpg', 'hito@gmail.com', '123456', '1994-02-09', 'male', 788695940, 'kicukiro', 0, '2 Years hotel', 0, '2019-03-01 02:57:54'),
(18, 'Kalisa', 'Tom', 'tom@gmail.compic.jpg', 'tom@gmail.com', '123456', '1994-07-21', 'male', 788695849, 'gikondo', 0, 'I have worked in Texirwa 5 years', 0, '2019-03-29 12:08:25');

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
(11, 18, 1);

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
(25, NULL, 17, 10, 3, 2, 'Accepted', '2019-03-01 14:59:27', NULL, NULL, NULL, NULL, 'Cool you', '2019-03-10 17:50:57', '2019-03-17 11:37:31', 0, 0),
(42, NULL, 15, 10, 2, 1, 'Confirmed', '2019-03-15 11:18:40', NULL, NULL, NULL, NULL, '', '2019-03-15 02:19:51', '2019-03-16 17:55:25', 0, 0),
(45, NULL, 17, 10, 2, 1, 'Denied', '2019-03-15 11:19:41', NULL, NULL, NULL, NULL, '', '2019-03-15 02:19:51', '2019-03-17 08:56:09', 0, 0),
(58, NULL, 15, 10, 2, 1, 'Selected', '2019-04-01 13:25:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

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
(11, 'tom@gmail.com', 'GYWU1ph0q62ygdmoadV38JpgGiRQ7IO2', '$2y$13$slQepFxPE96M9z.QjQKKZu4ZLDdBdTkcEUj.I3Ts9DriMkm4kgOJ2', NULL, 'tom@gmail.com', 10, 1553861307, 1553861307, 'seeker');

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
  MODIFY `bookmark_seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `provider_job`
--
ALTER TABLE `provider_job`
  MODIFY `provider_job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `seeker_job_type`
--
ALTER TABLE `seeker_job_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `selected_seeker`
--
ALTER TABLE `selected_seeker`
  MODIFY `selected_seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `selected_seeker`
--
ALTER TABLE `selected_seeker`
  ADD CONSTRAINT `selected_seeker_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `seeker` (`seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_seeker_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_seeker_ibfk_4` FOREIGN KEY (`provider_job_id`) REFERENCES `provider_job` (`provider_job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
