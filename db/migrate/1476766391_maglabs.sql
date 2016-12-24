-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: userhello.db
-- Generation Time: Oct 18, 2016 at 04:52 AM
-- Server version: 10.1.14-MariaDB-1~xenial
-- PHP Version: 5.6.22-nfsn1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maglabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `haldor`
--

CREATE TABLE `haldor` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor` enum('Front_Door','Main_Door','Office_Motion','Shop_Motion','Open_Switch','Boot','Space_Invader','Temperature','Halley') DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `progress_at` timestamp NULL DEFAULT NULL,
  `progress_count` int(11) NOT NULL DEFAULT '0',
  `end_at` timestamp NULL DEFAULT NULL,
  `mark_at` timestamp NULL DEFAULT NULL COMMENT 'this is for when the system had to manually mark an end (eg, when another session started after too long has passed)',
  `last_value` varchar(2560) NOT NULL DEFAULT '',
  `session` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COMMENT='Haldor - Norse name meaning Thor''s Stone';

-- --------------------------------------------------------

--
-- Table structure for table `haldor_payloads`
--

CREATE TABLE `haldor_payloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `payload` text,
  `session` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keyholders`
--

CREATE TABLE `keyholders` (
  `id` int(10) UNSIGNED NOT NULL,
  `keycode` varchar(200) CHARACTER SET ascii NOT NULL,
  `person` varchar(500) NOT NULL DEFAULT 'n00b',
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `membership_payments`
--

CREATE TABLE `membership_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `guest_name` varchar(254) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `paid_on` date NOT NULL,
  `month_start` date DEFAULT NULL,
  `month_end` date DEFAULT NULL,
  `transaction_id` varchar(254) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `membership_periods`
--

CREATE TABLE `membership_periods` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `registered_on` datetime DEFAULT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `cycle_day` tinyint(4) NOT NULL DEFAULT '0',
  `status` set('new','good','delinquent','closed','suspended') NOT NULL DEFAULT 'new',
  `level` set('general','keyed') NOT NULL DEFAULT 'general',
  `closed_on` date DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_emails`
--

CREATE TABLE `paypal_emails` (
  `user_id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement`
--

CREATE TABLE `procurement` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(1500) NOT NULL,
  `description` text NOT NULL,
  `need_amount` int(11) NOT NULL,
  `have_amount` int(11) NOT NULL DEFAULT '0',
  `cost` varchar(500) NOT NULL DEFAULT '',
  `history` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RFID_keys`
--

CREATE TABLE `RFID_keys` (
  `keycode` varchar(200) CHARACTER SET ascii NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `space_invaders`
--

CREATE TABLE `space_invaders` (
  `id` int(10) UNSIGNED NOT NULL,
  `keyholder_id` int(10) UNSIGNED DEFAULT NULL,
  `keycode` varchar(200) NOT NULL,
  `open_at` timestamp NULL DEFAULT NULL,
  `denied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` set('Admin','General','Keyholder','Backer','Guest','Invite','Verify','Reset','Disabled') CHARACTER SET ascii NOT NULL DEFAULT 'Guest,Invite',
  `email` varchar(255) NOT NULL,
  `pwhash` varchar(255) NOT NULL,
  `current_session` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `main_phone` varchar(30) NOT NULL DEFAULT '',
  `emergency_phone` varchar(30) NOT NULL DEFAULT '',
  `interests` text NOT NULL,
  `wikiusername` varchar(500) DEFAULT NULL,
  `wiki_uid` int(11) DEFAULT NULL,
  `joined_at` timestamp NULL DEFAULT NULL,
  `left_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `haldor`
--
ALTER TABLE `haldor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haldor_payloads`
--
ALTER TABLE `haldor_payloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyholders`
--
ALTER TABLE `keyholders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keycode` (`keycode`,`end_at`);

--
-- Indexes for table `membership_payments`
--
ALTER TABLE `membership_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`);

--
-- Indexes for table `membership_periods`
--
ALTER TABLE `membership_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_emails`
--
ALTER TABLE `paypal_emails`
  ADD PRIMARY KEY (`user_id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `procurement`
--
ALTER TABLE `procurement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `space_invaders`
--
ALTER TABLE `space_invaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `haldor`
--
ALTER TABLE `haldor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123275;
--
-- AUTO_INCREMENT for table `haldor_payloads`
--
ALTER TABLE `haldor_payloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=822255;
--
-- AUTO_INCREMENT for table `keyholders`
--
ALTER TABLE `keyholders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `membership_payments`
--
ALTER TABLE `membership_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `membership_periods`
--
ALTER TABLE `membership_periods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `procurement`
--
ALTER TABLE `procurement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `space_invaders`
--
ALTER TABLE `space_invaders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=808;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
