-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2019 at 11:03 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TgaNN6RhpP`
--

-- --------------------------------------------------------

--
-- Table structure for table `Campouts`
--

CREATE TABLE `Campouts` (
  `id` int(11) UNSIGNED NOT NULL,
  `dates` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Patrols`
--

CREATE TABLE `Patrols` (
  `id` int(11) UNSIGNED NOT NULL,
  `names` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Patrols`
--

INSERT INTO `Patrols` (`id`, `names`) VALUES
(1, 'Dragon'),
(2, 'Falcon'),
(3, 'Phoenix'),
(10, 'Not Assigned To A Patrol');

-- --------------------------------------------------------

--
-- Table structure for table `Scouts`
--

CREATE TABLE `Scouts` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `patrol` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Tents`
--

CREATE TABLE `Tents` (
  `id` int(11) UNSIGNED NOT NULL,
  `tent_number` varchar(255) NOT NULL,
  `assigned_to_patrol` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `Tents`
--

INSERT INTO `Tents` (`id`, `tent_number`, `assigned_to_patrol`, `date`) VALUES
(16, '15-01-A', 'Dragon', '2019-09-13 15:17:20'),
(17, '04-01', 'Dragon', '2019-09-13 15:17:32'),
(18, '02-06', 'Dragon', '2019-09-13 15:17:51'),
(19, '19-02', 'Dragon', '2019-09-13 15:18:01'),
(20, '19-06', 'Dragon', '2019-09-13 15:18:13'),
(21, '02-08', 'Falcon', '2019-09-13 15:18:32'),
(22, '02-03', 'Falcon', '2019-09-13 15:18:45'),
(23, '02-11', 'Falcon', '2019-09-13 15:18:56'),
(24, '19-03', 'Falcon', '2019-09-13 15:19:07'),
(25, '19-04', 'Falcon', '2019-09-13 15:19:15'),
(26, '04-03', 'Phoenix', '2019-09-13 15:19:26'),
(27, '02-09', 'Phoenix', '2019-09-13 15:19:34'),
(28, '02-01', 'Phoenix', '2019-09-13 15:19:45'),
(29, '19-01', 'Phoenix', '2019-09-13 15:19:56'),
(30, '19-05', 'Phoenix', '2019-09-13 15:20:15'),
(31, '02-10', 'Not Assigned To A Patrol', '2019-09-13 15:20:50'),
(32, '02-04', 'Not Assigned To A Patrol', '2019-09-13 15:21:04'),
(33, '02-13', 'Not Assigned To A Patrol', '2019-09-13 15:21:29'),
(34, '10-02', 'Not Assigned To A Patrol', '2019-09-13 15:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `Tent_Inventory`
--

CREATE TABLE `Tent_Inventory` (
  `id` int(11) UNSIGNED NOT NULL,
  `tent_number` varchar(255) NOT NULL,
  `date_returned` varchar(255) DEFAULT NULL,
  `campout` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patrol` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Tent_Issues`
--

CREATE TABLE `Tent_Issues` (
  `id` int(11) UNSIGNED NOT NULL,
  `tent_number` varchar(255) NOT NULL,
  `issue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_fixed` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `reset_password` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`, `reset_password`) VALUES
(1, ' Admin User', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, '2fvh2f8r1.png', 1, '2019-11-04 16:59:35', '0'),
(12, 'Test', 'Test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 'no_image.jpg', 1, '2019-11-04 17:53:32', '0'),
(13, 'test pl', 'pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 2, 'no_image.jpg', 1, '2019-11-04 17:47:12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`) VALUES
(1, 'Quartermaster', 1),
(2, 'Patrol Leader', 2),
(7, 'Admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Campouts`
--
ALTER TABLE `Campouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`dates`);

--
-- Indexes for table `Patrols`
--
ALTER TABLE `Patrols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Scouts`
--
ALTER TABLE `Scouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patrol` (`patrol`);

--
-- Indexes for table `Tents`
--
ALTER TABLE `Tents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tent_number` (`tent_number`);

--
-- Indexes for table `Tent_Inventory`
--
ALTER TABLE `Tent_Inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Tent_Issues`
--
ALTER TABLE `Tent_Issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Campouts`
--
ALTER TABLE `Campouts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Patrols`
--
ALTER TABLE `Patrols`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Scouts`
--
ALTER TABLE `Scouts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tents`
--
ALTER TABLE `Tents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Tent_Inventory`
--
ALTER TABLE `Tent_Inventory`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tent_Issues`
--
ALTER TABLE `Tent_Issues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
