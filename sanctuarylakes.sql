-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2014 at 10:01 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

create database if not exists sanctuarylakes;
use sanctuarylakes;

--
-- Database: `sanctuarylakes`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups_details`
--

CREATE TABLE IF NOT EXISTS `groups_details` (
  `group_id` int(8) NOT NULL,
  `member_id` int(8) NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`,`member_id`),
  KEY `group_id` (`group_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups_master`
--

CREATE TABLE IF NOT EXISTS `groups_master` (
  `group_id` int(8) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) NOT NULL,
  `lesson_id` int(2) NOT NULL,
  `skill_id` int(2) NOT NULL,
  `max_number` int(1) NOT NULL,
  `term_id` int(8) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `term_id` (`term_id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Table structure for table `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `lesson_id` int(2) NOT NULL AUTO_INCREMENT,
  `lesson_description` varchar(15) NOT NULL,
  `sport_id` int(2) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  PRIMARY KEY (`lesson_id`),
  UNIQUE KEY `lesson_description` (`lesson_description`,`sport_id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_description`, `sport_id`, `cost`) VALUES
(1, 'Group', 1, '13'),
(2, 'Group', 2, '13'),
(3, 'Private', 1, '40'),
(4, 'Private', 2, '40'),


-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions_details`
--

CREATE TABLE IF NOT EXISTS `medical_conditions_details` (
  `member_id` int(8) NOT NULL,
  `medical_condition_id` int(8) NOT NULL,
  PRIMARY KEY (`member_id`,`medical_condition_id`),
  KEY `medical_condition_id` (`medical_condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions_master`
--

CREATE TABLE IF NOT EXISTS `medical_conditions_master` (
  `medical_condition_id` int(8) NOT NULL AUTO_INCREMENT,
  `medical_condition_type` varchar(50) NOT NULL,
  PRIMARY KEY (`medical_condition_id`),
  UNIQUE KEY `medical_condition_type` (`medical_condition_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `medical_conditions_master`
--

INSERT INTO `medical_conditions_master` (`medical_condition_id`, `medical_condition_type`) VALUES
(1, 'ASTHMA'),
(2, 'DIABETES'),
(4, 'EPILEPSY'),
(6, 'HEART CONDITION'),
(5, 'HIGH/LOW BLOOD PRESSURE'),
(8, 'NONE'),
(3, 'RESPIRATORY DISORDERS'),
(7, 'SPECIAL NEEDS');

-- --------------------------------------------------------

--
-- Table structure for table `members_progress`
--

CREATE TABLE IF NOT EXISTS `members_progress` (
  `progress_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint(11) NOT NULL,
  `member_id` int(8) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `attendance` tinyint(1) NOT NULL DEFAULT '0',
  `staff_id` int(8) DEFAULT NULL,
  `staff_comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`progress_id`),
  UNIQUE KEY `schedule_id_3` (`schedule_id`,`member_id`),
  KEY `member_id` (`member_id`),
  KEY `staff_id` (`staff_id`),
  KEY `schedule_id` (`schedule_id`),
  KEY `schedule_id_2` (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1



--
-- Table structure for table `members_progress_details`
--

CREATE TABLE IF NOT EXISTS `members_progress_details` (
  `progress_id` bigint(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`progress_id`,`task_id`),
  KEY `member_progress_id` (`progress_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `members_skills`
--

CREATE TABLE IF NOT EXISTS `members_skills` (
  `member_id` int(8) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `skill_id` int(2) NOT NULL,
  `number_lessons` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`,`sport_id`),
  KEY `member_id` (`member_id`),
  KEY `sport_id` (`sport_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `payments_details`
--

CREATE TABLE IF NOT EXISTS `payments_details` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(8) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `payment_id` (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1


-- --------------------------------------------------------

--
-- Table structure for table `payments_master`
--

CREATE TABLE IF NOT EXISTS `payments_master` (
  `payment_id` int(8) NOT NULL AUTO_INCREMENT,
  `member_id` int(8) NOT NULL,
  `group_id` int(11) NOT NULL,
  `number_lessons` int(11) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `Unique1` (`member_id`,`group_id`),
  UNIQUE KEY `member_id_2` (`member_id`,`group_id`),
  KEY `lesson_id` (`group_id`),
  KEY `member_id` (`member_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1


--
-- Table structure for table `registrations_details`
--

CREATE TABLE IF NOT EXISTS `registrations_details` (
  `member_id` int(8) NOT NULL AUTO_INCREMENT,
  `registration_id` int(8) NOT NULL,
  `member_fname` varchar(25) NOT NULL,
  `member_mname` varchar(15) DEFAULT NULL,
  `member_lname` varchar(25) NOT NULL,
  `member_dob` date NOT NULL,
  `medical_notes` text NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1


-- --------------------------------------------------------

--
-- Table structure for table `registrations_master`
--

CREATE TABLE IF NOT EXISTS `registrations_master` (
  `registration_id` int(8) NOT NULL AUTO_INCREMENT,
  `parent_fname` varchar(25) NOT NULL,
  `parent_mname` varchar(15) DEFAULT NULL,
  `parent_lname` varchar(25) NOT NULL,
  `address1` varchar(10) NOT NULL,
  `address2` varchar(20) NOT NULL,
  `suburb` varchar(20) NOT NULL DEFAULT 'Sanctuary Lakes',
  `post_code` int(4) NOT NULL DEFAULT '3030',
  `email` varchar(50) DEFAULT NULL,
  `home_number` varchar(10) DEFAULT NULL,
  `mobile_number` varchar(10) DEFAULT NULL,
  `office_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1


-- --------------------------------------------------------

--
-- Table structure for table `schedule_details`
--

CREATE TABLE IF NOT EXISTS `schedule_details` (
  `schedule_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(8) NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `schedule_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1


-- --------------------------------------------------------

--
-- Table structure for table `schedule_master`
--

CREATE TABLE IF NOT EXISTS `schedule_master` (
  `group_id` int(8) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `weekday` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_id` (`group_id`),
  KEY `group_id_2` (`group_id`),
  KEY `staff_id` (`staff_id`),
  KEY `staff_id_2` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `skills_details`
--

CREATE TABLE IF NOT EXISTS `skills_details` (
  `skill_id` int(2) NOT NULL,
  `task_id` int(2) NOT NULL AUTO_INCREMENT,
  `task` varchar(50) NOT NULL,
  `task_description` varchar(100) NOT NULL,
  PRIMARY KEY (`task_id`),
  UNIQUE KEY `skill_id` (`skill_id`,`task`,`task_description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `skills_details`
--

INSERT INTO `skills_details` (`skill_id`, `task_id`, `task`, `task_description`) VALUES
(4, 5, 'MOVEMENT AND SWIMMING STROKES', 'KICK ON TUMMY AND BACK ASSISTED'),
(4, 6, 'MOVEMENT AND SWIMMING STROKES', 'SWIM WITH TEACHER FOR 5 MINUTES'),
(4, 2, 'UNDER WATER SKILL', 'BLOW BUBBLES'),
(4, 1, 'UNDER WATER SKILL', 'COMPLETELY SUBMERGE BODY UNDER WATER'),
(4, 3, 'WATER AWARENESS', 'COMFORTABLE WITH WATER ON HEAD AND AROUND EARS AND EYES'),
(4, 4, 'WATER AWARENESS', 'JUMP OFF WALL FROM SEATED AND STANDING POSITIONS'),
(5, 9, 'BODY ORIENTATION', 'FLOAT ON BACK FOR 10 SECONDS WITH MINIMAL OR NO ASSISTANCE'),
(5, 10, 'BODY ORIENTATION', 'TORPEDO AND TAKE AN UNASSISTED BREATH FOR AT LEAST 5 METERS'),
(5, 7, 'ENTRY AND EXIT', 'ENTER AND EXIT THE WATER SAFELY'),
(5, 13, 'MOVEMENT AND SWIMMING STROKES', 'FREE STYLE AND BACK STROKE WITH BOARD FOR 10 METERS'),
(5, 12, 'MOVEMENT AND SWIMMING STROKES', 'KICK ON BACK UNASSISTED FOR 10 METERS'),
(5, 11, 'MOVEMENT AND SWIMMING STROKES', 'KICK WITH BOARD ON FRONT AND BACK WITH CORRECT BODY POSITIONING FOR 10 METERS'),
(5, 8, 'UNDER WATER SKILLS', 'SUBMERGE FACE AND BLOW BUBBLES'),
(5, 14, 'WATER SAFETY', 'LEARN POOL SAFETY RULES');

-- --------------------------------------------------------

--
-- Table structure for table `skills_master`
--

CREATE TABLE IF NOT EXISTS `skills_master` (
  `skill_id` int(2) NOT NULL AUTO_INCREMENT,
  `sport_id` int(2) NOT NULL,
  `skill_band` varchar(15) NOT NULL,
  `skill_band_description` varchar(50) NOT NULL,
  PRIMARY KEY (`skill_id`),
  UNIQUE KEY `sport_id` (`sport_id`,`skill_band`,`skill_band_description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `skills_master`
--

INSERT INTO `skills_master` (`skill_id`, `sport_id`, `skill_band`, `skill_band_description`) VALUES
(1, 1, 'ONE', 'BEGINNER'),
(3, 1, 'THREE', 'ADVANCED'),
(2, 1, 'TWO', 'INTERMEDIATE'),
(10, 2, 'BLUE', 'SQUAD-SWIM, SURVIVE & COMPETE'),
(9, 2, 'GREEN', 'WATER WISE'),
(4, 2, 'LAVENDER', 'TODDLERS'),
(7, 2, 'ORANGE', 'WATER DEVELOPMENT'),
(5, 2, 'PINK', 'WATER DISCOVERY'),
(6, 2, 'RED', 'WATER AWARENESS'),
(8, 2, 'YELLOW', 'WATER SENSE');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `sport_id` int(2) NOT NULL AUTO_INCREMENT,
  `sport_description` varchar(15) NOT NULL,
  PRIMARY KEY (`sport_id`),
  UNIQUE KEY `sport_description` (`sport_description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sport_id`, `sport_description`) VALUES
(2, 'SWIMMING'),
(1, 'TENNIS');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(8) NOT NULL AUTO_INCREMENT,
  `staff_fname` varchar(25) NOT NULL,
  `staff_mname` varchar(15) DEFAULT NULL,
  `staff_lname` varchar(25) NOT NULL,
  `home_number` varchar(15) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `emg_contact_name` varchar(20) DEFAULT NULL,
  `emg_contact_number` varchar(15) DEFAULT NULL,
  `staff_email` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_mname`, `staff_lname`, `home_number`, `mobile_number`, `emg_contact_name`, `emg_contact_number`, `staff_email`, `active`) VALUES
(1, 'Default user', '', 'Default user', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` int(8) NOT NULL AUTO_INCREMENT,
  `term_description` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `start_date` (`start_date`,`end_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `staff_id` int(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL,
  `question` varchar(100) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`),
  KEY `passwords_ibfk_1` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`staff_id`, `username`, `type`, `password`, `question`, `answer`) VALUES
(1, 'administrator', 'administrator', '3qZAJ/Al0rf3J+p/BZ21Q4OKPEooFiXlyEuSfw4OWF7FNn7Kj0ejxn/uarSvw77zocG2l897QLwtdYUQpu+InQ==', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups_details`
--
ALTER TABLE `groups_details`
  ADD CONSTRAINT `groups_details_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups_master` (`group_id`),
  ADD CONSTRAINT `groups_details_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`);

--
-- Constraints for table `groups_master`
--
ALTER TABLE `groups_master`
  ADD CONSTRAINT `groups_master_ibfk_2` FOREIGN KEY (`term_id`) REFERENCES `terms` (`term_id`),
  ADD CONSTRAINT `groups_master_ibfk_3` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`),
  ADD CONSTRAINT `groups_master_ibfk_4` FOREIGN KEY (`skill_id`) REFERENCES `skills_master` (`skill_id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `medical_conditions_details`
--
ALTER TABLE `medical_conditions_details`
  ADD CONSTRAINT `medical_conditions_details_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_conditions_details_ibfk_2` FOREIGN KEY (`medical_condition_id`) REFERENCES `medical_conditions_master` (`medical_condition_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members_progress`
--
ALTER TABLE `members_progress`
  ADD CONSTRAINT `members_progress_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `members_progress_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `members_progress_ibfk_4` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_details` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members_progress_details`
--
ALTER TABLE `members_progress_details`
  ADD CONSTRAINT `members_progress_details_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `skills_details` (`task_id`),
  ADD CONSTRAINT `members_progress_details_ibfk_3` FOREIGN KEY (`progress_id`) REFERENCES `members_progress` (`progress_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members_skills`
--
ALTER TABLE `members_skills`
  ADD CONSTRAINT `members_skills_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills_master` (`skill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments_details`
--
ALTER TABLE `payments_details`
  ADD CONSTRAINT `payments_details_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments_master` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments_master`
--
ALTER TABLE `payments_master`
  ADD CONSTRAINT `payments_master_ibfk_5` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `payments_master_ibfk_7` FOREIGN KEY (`group_id`) REFERENCES `groups_master` (`group_id`);

--
-- Constraints for table `registrations_details`
--
ALTER TABLE `registrations_details`
  ADD CONSTRAINT `registrations_details_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations_master` (`registration_id`);

--
-- Constraints for table `schedule_details`
--
ALTER TABLE `schedule_details`
  ADD CONSTRAINT `schedule_details_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `schedule_master` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_master`
--
ALTER TABLE `schedule_master`
  ADD CONSTRAINT `schedule_master_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups_master` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_master_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skills_details`
--
ALTER TABLE `skills_details`
  ADD CONSTRAINT `skills_details_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skills_master` (`skill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skills_master`
--
ALTER TABLE `skills_master`
  ADD CONSTRAINT `skills_master_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE USER 'slakes'@'localhost' IDENTIFIED BY 'FdncY5zyTBEryDnH';GRANT USAGE ON *.* TO 'slakes'@'localhost' IDENTIFIED BY 'FdncY5zyTBEryDnH' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `sanctuarylakes`.* TO 'slakes'@'localhost'WITH GRANT OPTION;