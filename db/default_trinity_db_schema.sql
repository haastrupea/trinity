-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2019 at 01:58 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `churchDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Action_log`
--

CREATE TABLE `Action_log` (
  `id` int(11) NOT NULL,
  `action` varchar(500) NOT NULL,
  `date_logged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`user_id`, `user_name`, `user_email`, `user_password`, `role_id`, `created`, `last_update`) VALUES
(1, 'trinity', 'haastrupea@gmail.com', '$2y$10$3tVCutKB8BeYk4WTIcTG5.DjI7T1YfVbUlpgk2WQbWuMvSZlt9SIO', 1, '2019-05-01 08:57:08', '2019-06-21 20:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `role_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `role`, `role_description`) VALUES
(1, 'Admin', 'have full control over the operations of trinity');

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE `bulletin` (
  `bulletin_id` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `Issue` int(11) NOT NULL,
  `publish_status` enum('now','later','until') NOT NULL DEFAULT 'now',
  `publish_date` date DEFAULT NULL,
  `keyword` varchar(500) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bulletin_file` varchar(100) NOT NULL,
  `bulletin_title_id` int(11) NOT NULL,
  `dl_counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulletin_title`
--

CREATE TABLE `bulletin_title` (
  `title_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `last_modefied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) NOT NULL,
  `publish` set('daily','weekly','monthly','yearly') NOT NULL DEFAULT 'monthly',
  `pub_freq` int(11) NOT NULL DEFAULT '1',
  `publish_status` enum('published','pending') NOT NULL DEFAULT 'pending',
  `date_published` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `church_history`
--

CREATE TABLE `church_history` (
  `church_id` int(11) NOT NULL,
  `founding_date` date NOT NULL,
  `church_History` text,
  `video_doc` varchar(200) DEFAULT NULL,
  `mission` varchar(500) DEFAULT NULL,
  `vision` varchar(500) DEFAULT NULL,
  `vs_ms_youtube_link` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `church_info`
--

CREATE TABLE `church_info` (
  `id` int(11) NOT NULL,
  `ch_name` varchar(100) NOT NULL,
  `ch_address` varchar(250) NOT NULL,
  `ch_email` varchar(50) NOT NULL,
  `ch_phone_1` int(20) NOT NULL,
  `ch_phone_2` int(20) DEFAULT NULL,
  `ch_phone_3` int(20) DEFAULT NULL,
  `ch_phone_4` int(20) DEFAULT NULL,
  `ch_box_number` varchar(20) DEFAULT NULL,
  `ch_post_office` varchar(100) DEFAULT NULL,
  `ch_fax` int(25) DEFAULT NULL,
  `ch_fb_pg` varchar(50) DEFAULT NULL,
  `ch_twitter` varchar(50) DEFAULT NULL,
  `ch_instagram` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `church_pastor`
--

CREATE TABLE `church_pastor` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(20) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `about` text,
  `gender` set('male','female','') DEFAULT NULL,
  `welcome_address` varchar(500) DEFAULT NULL,
  `fb_page` varchar(150) DEFAULT NULL,
  `ig_page` varchar(150) DEFAULT NULL,
  `twitter_page` varchar(150) DEFAULT NULL,
  `is_founder` tinyint(1) NOT NULL DEFAULT '0',
  `post` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ev_events`
--

CREATE TABLE `Ev_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `venue` varchar(150) NOT NULL,
  `event_description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_all_day` tinyint(1) NOT NULL DEFAULT '1',
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_event_id` int(11) DEFAULT NULL,
  `use_event_name` tinyint(1) NOT NULL DEFAULT '1',
  `flyer_file_name` varchar(100) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_exception`
--

CREATE TABLE `Ev_repeat_exception` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rescheduled` tinyint(1) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_all_day` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_pattern`
--

CREATE TABLE `Ev_repeat_pattern` (
  `event_id` int(11) NOT NULL,
  `repeat_type` int(11) NOT NULL,
  `occurencies` int(11) DEFAULT NULL,
  `interval_sep` int(10) NOT NULL DEFAULT '1',
  `day_of_week` set('1','2','3','4','5','6','7') DEFAULT NULL,
  `week_of_month` set('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_type`
--

CREATE TABLE `Ev_repeat_type` (
  `id` int(11) NOT NULL,
  `repeat_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ev_repeat_type`
--

INSERT INTO `Ev_repeat_type` (`id`, `repeat_type`) VALUES
(1, 'daily'),
(2, 'weekly'),
(3, 'monthly'),
(4, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `next_event_occur`
--

CREATE TABLE `next_event_occur` (
  `ev_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `picture_gallery`
--

CREATE TABLE `picture_gallery` (
  `id` int(11) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `outside_view` varchar(100) DEFAULT NULL,
  `inside_view` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preachers`
--

CREATE TABLE `preachers` (
  `preachers_id` int(11) NOT NULL,
  `preacher_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sermons`
--

CREATE TABLE `sermons` (
  `sermon_id` int(11) NOT NULL,
  `sermon_topic` varchar(100) NOT NULL,
  `sermon_preacher_id` int(11) NOT NULL,
  `preached_on` date NOT NULL,
  `sermon_publish_status` enum('now','later','until') NOT NULL DEFAULT 'now',
  `sermon_publish_date` date DEFAULT NULL,
  `sermon_description` varchar(500) DEFAULT NULL,
  `sermon_audio_file` varchar(100) DEFAULT NULL,
  `sermon_cover_image` varchar(100) DEFAULT NULL,
  `sermon_youtube_vld` varchar(300) DEFAULT NULL,
  `sermon_keywords` varchar(500) DEFAULT NULL,
  `folder_hash_key` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sermon_transcription`
--

CREATE TABLE `sermon_transcription` (
  `language` enum('en') DEFAULT 'en',
  `transcription` text NOT NULL,
  `sermon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Action_log`
--
ALTER TABLE `Action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_by` (`action_by`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bulletin_id`),
  ADD UNIQUE KEY `bulletin_file` (`bulletin_file`),
  ADD KEY `bulletin_created_by` (`added_by`),
  ADD KEY `number` (`Issue`),
  ADD KEY `bulletin_title_id` (`bulletin_title_id`),
  ADD KEY `dl_counter` (`dl_counter`);

--
-- Indexes for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  ADD PRIMARY KEY (`title_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `church_history`
--
ALTER TABLE `church_history`
  ADD PRIMARY KEY (`church_id`),
  ADD UNIQUE KEY `church_id` (`church_id`),
  ADD KEY `church_id_2` (`church_id`);

--
-- Indexes for table `church_info`
--
ALTER TABLE `church_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `church_pastor`
--
ALTER TABLE `church_pastor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ev_events`
--
ALTER TABLE `Ev_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_event_id` (`parent_event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `Ev_repeat_exception`
--
ALTER TABLE `Ev_repeat_exception`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `Ev_repeat_pattern`
--
ALTER TABLE `Ev_repeat_pattern`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `repeat_type` (`repeat_type`);

--
-- Indexes for table `Ev_repeat_type`
--
ALTER TABLE `Ev_repeat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `next_event_occur`
--
ALTER TABLE `next_event_occur`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `picture_gallery`
--
ALTER TABLE `picture_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preachers`
--
ALTER TABLE `preachers`
  ADD PRIMARY KEY (`preachers_id`);

--
-- Indexes for table `sermons`
--
ALTER TABLE `sermons`
  ADD PRIMARY KEY (`sermon_id`),
  ADD UNIQUE KEY `sermon_id` (`sermon_id`),
  ADD UNIQUE KEY `sermon_youtube_link` (`sermon_youtube_vld`),
  ADD UNIQUE KEY `sermon_audio_file` (`sermon_audio_file`),
  ADD UNIQUE KEY `folder_hash_key` (`folder_hash_key`),
  ADD UNIQUE KEY `sermon_youtube_vld` (`sermon_youtube_vld`),
  ADD KEY `sermon_preacher_id` (`sermon_preacher_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `sermon_transcription`
--
ALTER TABLE `sermon_transcription`
  ADD PRIMARY KEY (`sermon_id`),
  ADD UNIQUE KEY `sermon_id_2` (`sermon_id`),
  ADD KEY `sermon_id` (`sermon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Action_log`
--
ALTER TABLE `Action_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `bulletin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `church_info`
--
ALTER TABLE `church_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `church_pastor`
--
ALTER TABLE `church_pastor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Ev_events`
--
ALTER TABLE `Ev_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `Ev_repeat_type`
--
ALTER TABLE `Ev_repeat_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `picture_gallery`
--
ALTER TABLE `picture_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `preachers`
--
ALTER TABLE `preachers`
  MODIFY `preachers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sermons`
--
ALTER TABLE `sermons`
  MODIFY `sermon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Action_log`
--
ALTER TABLE `Action_log`
  ADD CONSTRAINT `Action_log_ibfk_1` FOREIGN KEY (`action_by`) REFERENCES `Admin` (`user_id`);

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`);

--
-- Constraints for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD CONSTRAINT `bulletin_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `Admin` (`user_id`),
  ADD CONSTRAINT `bulletin_ibfk_2` FOREIGN KEY (`bulletin_title_id`) REFERENCES `bulletin_title` (`title_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  ADD CONSTRAINT `bulletin_title_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `church_history`
--
ALTER TABLE `church_history`
  ADD CONSTRAINT `church_history_ibfk_1` FOREIGN KEY (`church_id`) REFERENCES `church_info` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_events`
--
ALTER TABLE `Ev_events`
  ADD CONSTRAINT `Ev_events_ibfk_1` FOREIGN KEY (`parent_event_id`) REFERENCES `Ev_events` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `Ev_events_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_repeat_exception`
--
ALTER TABLE `Ev_repeat_exception`
  ADD CONSTRAINT `Ev_repeat_exception_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Ev_events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ev_repeat_exception_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_repeat_pattern`
--
ALTER TABLE `Ev_repeat_pattern`
  ADD CONSTRAINT `Ev_repeat_pattern_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Ev_events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ev_repeat_pattern_ibfk_2` FOREIGN KEY (`repeat_type`) REFERENCES `Ev_repeat_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `next_event_occur`
--
ALTER TABLE `next_event_occur`
  ADD CONSTRAINT `next_event_occur_ibfk_1` FOREIGN KEY (`ev_id`) REFERENCES `Ev_repeat_pattern` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sermons`
--
ALTER TABLE `sermons`
  ADD CONSTRAINT `sermons_ibfk_1` FOREIGN KEY (`sermon_preacher_id`) REFERENCES `preachers` (`preachers_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sermons_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sermon_transcription`
--
ALTER TABLE `sermon_transcription`
  ADD CONSTRAINT `sermon_transcription_ibfk_1` FOREIGN KEY (`sermon_id`) REFERENCES `sermons` (`sermon_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
