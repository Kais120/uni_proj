-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2014 at 02:37 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

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

--
-- Dumping data for table `groups_details`
--

INSERT INTO `groups_details` (`group_id`, `member_id`, `date_added`) VALUES
(1, 1, '2014-10-04 02:32:53'),
(1, 3, '2014-10-04 02:32:34'),
(1, 6, '2014-08-29 12:18:04'),
(1, 7, '2014-08-29 12:18:04'),
(2, 4, '2014-08-29 12:18:30'),
(2, 8, '2014-08-29 12:18:42'),
(2, 9, '2014-08-29 12:18:42'),
(2, 10, '2014-10-04 02:36:03'),
(3, 215, '2014-10-03 23:53:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups_master`
--

INSERT INTO `groups_master` (`group_id`, `group_name`, `lesson_id`, `skill_id`, `max_number`, `term_id`, `date_created`) VALUES
(1, 'Group 1', 2, 4, 5, 1, '2014-08-30'),
(2, 'Group 2', 2, 4, 5, 1, '2014-08-30'),
(3, 'Tennis group', 1, 1, 3, 1, '2014-10-04');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_description`, `sport_id`, `cost`) VALUES
(1, 'Group', 1, '13'),
(2, 'Group', 2, '13'),
(3, 'Private', 1, '40'),
(4, 'Private', 2, '40'),
(5, 'Test', 2, '13'),
(6, 'Semi-private', 1, '30');

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

--
-- Dumping data for table `medical_conditions_details`
--

INSERT INTO `medical_conditions_details` (`member_id`, `medical_condition_id`) VALUES
(217, 1),
(218, 1),
(221, 1),
(10, 2),
(222, 2),
(115, 3),
(130, 3),
(3, 4),
(218, 4),
(221, 4),
(6, 5),
(7, 5),
(217, 6),
(1, 7),
(3, 7),
(4, 8),
(5, 8),
(8, 8),
(9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions_master`
--

CREATE TABLE IF NOT EXISTS `medical_conditions_master` (
  `medical_condition_id` int(8) NOT NULL AUTO_INCREMENT,
  `medical_condition_type` varchar(50) NOT NULL,
  PRIMARY KEY (`medical_condition_id`),
  UNIQUE KEY `medical_condition_type` (`medical_condition_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `members_progress`
--

INSERT INTO `members_progress` (`progress_id`, `schedule_id`, `member_id`, `entry_date`, `attendance`, `staff_id`, `staff_comments`) VALUES
(10, 54, 215, '2014-10-03 23:54:19', 1, 1, 'well done'),
(11, 32, 1, '2014-10-04 00:23:45', 1, 1, ''),
(12, 34, 1, '2014-10-04 02:41:19', 1, 1, '');

-- --------------------------------------------------------

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

--
-- Dumping data for table `members_progress_details`
--

INSERT INTO `members_progress_details` (`progress_id`, `task_id`) VALUES
(12, 3),
(11, 4);

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

--
-- Dumping data for table `members_skills`
--

INSERT INTO `members_skills` (`member_id`, `sport_id`, `entry_date`, `skill_id`, `number_lessons`) VALUES
(1, 2, '2014-10-29 01:25:40', 4, 5),
(3, 2, '2014-10-04 02:27:53', 4, 6),
(4, 2, '2014-09-14 07:56:34', 4, 5),
(5, 2, '2014-09-14 07:56:34', 4, 5),
(6, 2, '2014-09-14 07:56:34', 4, 5),
(7, 2, '2014-09-14 07:56:34', 4, 5),
(8, 2, '2014-09-14 07:56:34', 4, 5),
(9, 2, '2014-09-14 07:56:34', 4, 5),
(10, 2, '2014-10-03 11:54:42', 4, 6),
(111, 2, '2014-09-14 07:59:08', 5, 5),
(112, 2, '2014-09-14 07:59:08', 5, 5),
(113, 2, '2014-09-14 07:59:08', 5, 5),
(114, 2, '2014-09-14 07:59:08', 5, 5),
(115, 2, '2014-09-14 07:59:08', 5, 5),
(116, 2, '2014-09-14 07:59:08', 5, 5),
(117, 2, '2014-09-14 07:59:08', 5, 5),
(118, 2, '2014-09-14 07:59:08', 5, 5),
(119, 2, '2014-09-14 07:59:08', 5, 5),
(120, 2, '2014-09-14 07:59:08', 5, 5),
(121, 2, '2014-09-14 07:59:08', 5, 5),
(122, 2, '2014-09-14 07:59:08', 5, 5),
(123, 2, '2014-09-14 07:59:08', 5, 5),
(124, 2, '2014-09-14 07:59:08', 5, 5),
(125, 2, '2014-09-14 07:59:08', 5, 5),
(126, 2, '2014-09-14 07:59:08', 5, 5),
(127, 2, '2014-09-14 07:59:08', 5, 5),
(128, 2, '2014-09-14 07:59:08', 5, 5),
(129, 2, '2014-09-14 07:59:08', 5, 5),
(130, 2, '2014-09-14 07:59:08', 5, 5),
(131, 2, '2014-09-14 07:59:08', 5, 5),
(132, 2, '2014-09-14 07:59:08', 5, 5),
(133, 2, '2014-09-14 07:59:08', 5, 5),
(134, 2, '2014-09-14 07:59:08', 5, 5),
(135, 2, '2014-09-14 07:59:08', 5, 5),
(136, 2, '2014-09-14 07:59:08', 5, 5),
(137, 2, '2014-09-14 07:59:08', 5, 5),
(138, 2, '2014-09-14 07:59:08', 5, 5),
(139, 2, '2014-09-14 07:59:08', 5, 5),
(140, 2, '2014-09-14 07:59:08', 5, 5),
(141, 2, '2014-09-14 07:59:08', 5, 5),
(142, 2, '2014-09-14 07:59:08', 5, 5),
(143, 2, '2014-09-14 07:59:08', 5, 5),
(144, 2, '2014-09-14 07:59:08', 5, 5),
(145, 2, '2014-09-14 07:59:08', 5, 5),
(146, 2, '2014-09-14 07:59:08', 5, 5),
(147, 2, '2014-09-14 07:59:08', 5, 5),
(148, 2, '2014-09-14 07:59:08', 5, 5),
(149, 2, '2014-09-14 07:59:08', 5, 5),
(150, 2, '2014-09-14 07:59:08', 5, 5),
(151, 2, '2014-09-14 08:00:08', 6, 5),
(152, 2, '2014-09-14 08:00:08', 6, 5),
(153, 2, '2014-09-14 08:00:08', 6, 5),
(154, 2, '2014-09-14 08:00:08', 6, 5),
(155, 2, '2014-09-14 08:00:08', 6, 5),
(156, 2, '2014-09-14 08:00:08', 6, 5),
(157, 2, '2014-09-14 08:00:08', 6, 5),
(158, 2, '2014-09-14 08:00:08', 6, 5),
(159, 2, '2014-09-14 08:00:08', 6, 5),
(160, 2, '2014-09-14 08:00:08', 6, 5),
(161, 2, '2014-09-14 08:00:08', 6, 5),
(162, 2, '2014-09-14 08:00:08', 6, 5),
(163, 2, '2014-09-14 08:00:08', 6, 5),
(164, 2, '2014-09-14 08:00:08', 6, 5),
(165, 2, '2014-09-14 08:00:08', 6, 5),
(166, 2, '2014-09-14 08:00:08', 6, 5),
(167, 2, '2014-09-14 08:00:08', 6, 5),
(168, 2, '2014-09-14 08:00:08', 6, 5),
(169, 2, '2014-09-14 08:00:08', 6, 5),
(170, 2, '2014-09-14 08:00:08', 6, 5),
(171, 2, '2014-09-14 08:00:08', 6, 5),
(172, 2, '2014-09-14 08:00:08', 6, 5),
(173, 2, '2014-09-14 08:00:08', 6, 5),
(174, 2, '2014-09-14 08:00:08', 6, 5),
(175, 2, '2014-09-14 08:00:08', 6, 5),
(176, 2, '2014-09-14 08:00:08', 6, 5),
(177, 2, '2014-09-14 08:00:08', 6, 5),
(178, 2, '2014-09-14 08:00:08', 6, 5),
(179, 2, '2014-09-14 08:00:08', 6, 5),
(180, 2, '2014-09-14 08:00:08', 6, 5),
(181, 2, '2014-09-14 08:02:10', 7, 5),
(182, 2, '2014-09-14 08:02:10', 7, 5),
(183, 2, '2014-09-14 08:02:10', 7, 5),
(184, 2, '2014-09-14 08:02:10', 7, 5),
(185, 2, '2014-09-14 08:02:10', 7, 5),
(186, 2, '2014-09-14 08:02:10', 7, 5),
(187, 2, '2014-09-14 08:02:10', 7, 5),
(188, 2, '2014-09-14 08:02:10', 7, 5),
(189, 2, '2014-09-14 08:02:10', 7, 5),
(190, 2, '2014-09-14 08:02:10', 7, 5),
(191, 2, '2014-09-14 08:02:10', 7, 5),
(192, 2, '2014-09-14 08:02:10', 7, 5),
(193, 2, '2014-09-14 08:02:10', 7, 5),
(194, 2, '2014-09-14 08:02:10', 7, 5),
(195, 2, '2014-09-14 08:02:10', 7, 5),
(196, 2, '2014-09-14 08:02:10', 7, 5),
(197, 2, '2014-09-14 08:02:10', 7, 5),
(198, 2, '2014-09-14 08:02:10', 7, 5),
(199, 2, '2014-09-14 08:02:10', 7, 5),
(200, 2, '2014-09-14 08:02:10', 7, 5),
(201, 2, '2014-09-14 08:02:10', 7, 5),
(202, 2, '2014-09-14 08:02:10', 7, 5),
(203, 2, '2014-09-14 08:02:10', 7, 5),
(204, 2, '2014-09-14 08:02:10', 7, 5),
(205, 2, '2014-09-14 08:02:10', 7, 5),
(206, 2, '2014-09-14 08:02:10', 7, 5),
(207, 2, '2014-09-14 08:02:10', 7, 5),
(208, 2, '2014-09-14 08:02:10', 7, 5),
(209, 2, '2014-09-14 08:02:10', 7, 5),
(210, 2, '2014-09-14 08:02:10', 7, 5),
(215, 1, '2014-10-03 23:53:27', 1, 6),
(219, 2, '2014-10-03 12:34:17', 9, 0),
(222, 2, '2014-10-11 08:18:38', 8, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `payments_details`
--

INSERT INTO `payments_details` (`transaction_id`, `payment_id`, `payment_date`, `payment_type`, `amount_paid`) VALUES
(1, 1, '2014-10-02', 'credit', '120'),
(6, 10, '2014-10-02', 'eftpos', '10'),
(7, 10, '2014-10-02', 'cash', '50'),
(8, 10, '2014-10-03', 'cash', '11'),
(9, 1, '2014-10-03', 'cash', '0'),
(10, 1, '2014-10-04', 'cash', '-55'),
(15, 10, '2014-10-12', 'cash', '6'),
(16, 11, '2014-10-12', 'cash', '5'),
(17, 12, '2014-10-12', 'cash', '6');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `payments_master`
--

INSERT INTO `payments_master` (`payment_id`, `member_id`, `group_id`, `number_lessons`, `total_amount`) VALUES
(1, 1, 1, 5, '65'),
(10, 10, 1, 5, '78'),
(11, 3, 1, 6, '78'),
(12, 10, 2, 6, '78');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `registrations_details`
--

INSERT INTO `registrations_details` (`member_id`, `registration_id`, `member_fname`, `member_mname`, `member_lname`, `member_dob`, `medical_notes`) VALUES
(1, 1, 'Mary', '', 'Morris', '2011-12-15', 'none'),
(3, 2, 'child 1 of 2 -> reg2', '', 'child 1 of 2 -> reg2', '2008-10-10', 'none'),
(4, 2, 'child 2 of 2 -> reg2', '', 'child 2 of 2 -> reg2', '2010-01-01', 'none'),
(5, 3, 'child 1 of 3 -> reg3', '', 'child 1 of 3 -> reg3', '2008-10-10', 'none'),
(6, 3, 'child 2 of 3 -> reg3', '', 'child 2 of 3 -> reg3', '2010-01-01', 'none'),
(7, 3, 'child 3 of 3 -> reg3', '', 'child 3 of 3 -> reg3', '2008-10-10', 'none'),
(8, 4, 'child 1 of 2 -> reg4', '', 'child 1 of 2 -> reg4', '2009-01-01', 'none'),
(9, 4, 'child 2 of 2 -> reg4', '', 'child 2 of 2 -> reg4', '2008-10-10', 'none'),
(10, 1, 'Star', '', 'Polar', '2011-09-01', 'none'),
(111, 5, 'Chelsea', NULL, 'Gonzales', '2010-10-18', 'none'),
(112, 6, 'Britanni', NULL, 'Hendrix', '2010-12-30', 'none'),
(113, 7, 'Armando', NULL, 'Melton', '2010-10-29', 'none'),
(114, 8, 'Ivor', NULL, 'Pitts', '2009-12-14', 'none'),
(115, 9, 'Neve', '', 'Smith', '2009-04-26', 'none'),
(116, 10, 'Brian', NULL, 'Hall', '2007-07-11', 'none'),
(117, 11, 'Britanni', NULL, 'Middleton', '2005-09-15', 'none'),
(118, 12, 'Shelly', NULL, 'Glenn', '2005-09-28', 'none'),
(119, 13, 'Kenneth', NULL, 'Perkins', '2005-09-28', 'none'),
(120, 14, 'Dora', NULL, 'Swanson', '2007-10-29', 'none'),
(121, 15, 'Basil', NULL, 'Stephenson', '2006-09-15', 'none'),
(122, 16, 'Kaye', NULL, 'Wood', '2009-06-09', 'none'),
(123, 17, 'Mari', NULL, 'Marquez', '2008-08-07', 'none'),
(124, 18, 'Mark', NULL, 'Harris', '2007-03-24', 'none'),
(125, 19, 'Kareem', NULL, 'Steele', '2007-02-06', 'none'),
(126, 20, 'Keith', NULL, 'Briggs', '2009-06-01', 'none'),
(127, 21, 'Donovan', NULL, 'Acevedo', '2008-03-02', 'none'),
(128, 22, 'Kirestin', NULL, 'Mayer', '2009-01-06', 'none'),
(129, 23, 'Bo', NULL, 'Riddle', '2006-02-19', 'none'),
(130, 24, 'Marcia', '', 'Hart', '2009-08-02', 'none'),
(131, 25, 'Colorado', NULL, 'Yang', '2006-08-11', 'none'),
(132, 26, 'Len', NULL, 'Perkins', '2010-10-07', 'none'),
(133, 27, 'Devin', NULL, 'Arnold', '2005-03-07', 'none'),
(134, 28, 'Delilah', NULL, 'George', '2005-11-28', 'none'),
(135, 29, 'Odessa', NULL, 'Estes', '2009-09-12', 'none'),
(136, 30, 'Nora', NULL, 'Mckenzie', '2006-11-19', 'none'),
(137, 31, 'Courtney', NULL, 'Craft', '2006-08-10', 'none'),
(138, 32, 'Colin', NULL, 'Stevenson', '2009-06-07', 'none'),
(139, 33, 'Sage', NULL, 'Noel', '2005-10-20', 'none'),
(140, 34, 'Quynn', NULL, 'Wynn', '2010-02-09', 'none'),
(141, 35, 'Nita', NULL, 'Vang', '2007-02-21', 'none'),
(142, 36, 'Chiquita', NULL, 'Duran', '2008-01-07', 'none'),
(143, 37, 'Rashad', NULL, 'Solis', '2009-04-14', 'none'),
(144, 38, 'Reuben', NULL, 'Knight', '2006-05-01', 'none'),
(145, 39, 'Indira', NULL, 'Watkins', '2008-05-01', 'none'),
(146, 40, 'Imogene', NULL, 'Talley', '2007-02-21', 'none'),
(147, 41, 'Ifeoma', NULL, 'Savage', '2005-07-31', 'none'),
(148, 42, 'Blaine', NULL, 'Navarro', '2006-03-23', 'none'),
(149, 43, 'Calvin', NULL, 'William', '2007-08-17', 'none'),
(150, 44, 'Lev', NULL, 'Waters', '2006-12-26', 'none'),
(151, 45, 'Amir', NULL, 'Sweet', '2006-01-20', 'none'),
(152, 46, 'Yuri', NULL, 'Patton', '2006-05-22', 'none'),
(153, 47, 'Alec', NULL, 'Green', '2010-09-23', 'none'),
(154, 48, 'Portia', NULL, 'Mcdowell', '2007-02-25', 'none'),
(155, 49, 'Elijah', NULL, 'Vang', '2009-05-09', 'none'),
(156, 50, 'Hasad', NULL, 'Carlson', '2006-08-28', 'none'),
(157, 51, 'May', NULL, 'Rivera', '2010-02-10', 'none'),
(158, 52, 'Cheyenne', NULL, 'Kemp', '2006-09-24', 'none'),
(159, 53, 'Ora', NULL, 'Barber', '2006-09-20', 'none'),
(160, 54, 'Tarik', NULL, 'Hodges', '2006-09-11', 'none'),
(161, 55, 'Odessa', NULL, 'Conley', '2007-07-30', 'none'),
(162, 56, 'Kennan', NULL, 'Lamb', '2006-04-07', 'none'),
(163, 57, 'Todd', NULL, 'Daniel', '2010-03-27', 'none'),
(164, 58, 'Xanthus', NULL, 'Walls', '2010-08-03', 'none'),
(165, 59, 'Brianna', NULL, 'Nunez', '2007-10-17', 'none'),
(166, 60, 'Larissa', NULL, 'Solomon', '2009-08-17', 'none'),
(167, 61, 'Tana', NULL, 'Thompson', '2006-08-05', 'none'),
(168, 62, 'Dawn', NULL, 'Howard', '2008-08-21', 'none'),
(169, 63, 'Emerson', NULL, 'Golden', '2010-07-21', 'none'),
(170, 64, 'Kameko', NULL, 'Poole', '2006-02-26', 'none'),
(171, 65, 'Raven', NULL, 'Slater', '2005-10-11', 'none'),
(172, 66, 'Quail', NULL, 'Foreman', '2006-01-24', 'none'),
(173, 67, 'Anika', NULL, 'Alvarez', '2008-08-14', 'none'),
(174, 68, 'Dana', NULL, 'Patrick', '2008-04-11', 'none'),
(175, 69, 'Nomlanga', NULL, 'Curry', '2008-03-28', 'none'),
(176, 70, 'Richard', NULL, 'Ramirez', '2005-08-31', 'none'),
(177, 71, 'Dillon', NULL, 'Allison', '2010-10-05', 'none'),
(178, 72, 'Ariel', NULL, 'Wheeler', '2008-11-23', 'none'),
(179, 73, 'Piper', NULL, 'Koch', '2007-09-29', 'none'),
(180, 74, 'Zelda', NULL, 'Bridges', '2005-05-14', 'none'),
(181, 75, 'Bianca', NULL, 'Delgado', '2009-01-24', 'none'),
(182, 76, 'Joy', NULL, 'York', '2008-07-14', 'none'),
(183, 77, 'Dahlia', NULL, 'Boyer', '2009-07-18', 'none'),
(184, 78, 'Flynn', NULL, 'Vance', '2010-10-02', 'none'),
(185, 79, 'Stacey', NULL, 'Callahan', '2009-08-15', 'none'),
(186, 80, 'Wanda', NULL, 'Thompson', '2009-10-14', 'none'),
(187, 81, 'Abraham', NULL, 'Christensen', '2007-04-02', 'none'),
(188, 82, 'Candace', NULL, 'Adkins', '2005-01-30', 'none'),
(189, 83, 'Zelenia', NULL, 'Ward', '2005-10-08', 'none'),
(190, 84, 'Sara', NULL, 'Leonard', '2009-03-10', 'none'),
(191, 85, 'Thaddeus', NULL, 'Richardson', '2008-12-13', 'none'),
(192, 86, 'Gail', NULL, 'Bowen', '2006-09-04', 'none'),
(193, 87, 'Ruth', NULL, 'Whitfield', '2009-03-02', 'none'),
(194, 88, 'Nyssa', NULL, 'Rocha', '2005-11-19', 'none'),
(195, 89, 'Shafira', NULL, 'Hodge', '2005-04-21', 'none'),
(196, 90, 'Germaine', NULL, 'Mcclure', '2010-06-06', 'none'),
(197, 91, 'Kasimir', NULL, 'Floyd', '2006-01-14', 'none'),
(198, 92, 'Lamar', NULL, 'Moore', '2010-03-14', 'none'),
(199, 93, 'Aileen', NULL, 'Warner', '2009-10-30', 'none'),
(200, 94, 'Veda', NULL, 'Schroeder', '2009-08-15', 'none'),
(201, 95, 'Geraldine', NULL, 'England', '2006-08-05', 'none'),
(202, 96, 'Ezra', NULL, 'Reynolds', '2006-07-21', 'none'),
(203, 97, 'Idona', NULL, 'Richardson', '2007-08-06', 'none'),
(204, 98, 'Jordan', NULL, 'Aguilar', '2006-12-31', 'none'),
(205, 99, 'Moana', NULL, 'Padilla', '2009-01-02', 'none'),
(206, 100, 'Grady', NULL, 'Riley', '2009-12-30', 'none'),
(207, 101, 'Jasmine', NULL, 'Garcia', '2007-12-07', 'none'),
(208, 102, 'Charissa', NULL, 'Tanner', '2009-12-11', 'none'),
(209, 103, 'Shelley', NULL, 'Austin', '2005-08-17', 'none'),
(210, 104, 'Troy', NULL, 'Knox', '2008-09-20', 'none'),
(215, 1, 'Normal', '', 'Name', '2010-02-23', 'HEalthy'),
(216, 5, 'Arsenal', '', 'London', '2001-05-25', ''),
(217, 6, '12321', '', '23123', '2014-10-09', 'weqe'),
(218, 7, 'Rodolfo', '', '324234', '2014-10-01', ''),
(219, 10, '123', '', '123', '2014-10-02', ''),
(220, 10, '1q2w3e', '', '1q2w3e', '2014-10-01', ''),
(221, 9, '1q2w2we', '', '1q1q2w1', '2014-10-17', ''),
(222, 2, 'Vyk', '', 'Mac', '2014-10-01', '');

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
  `home_number` int(10) DEFAULT NULL,
  `mobile_number` int(10) DEFAULT NULL,
  `office_number` int(10) DEFAULT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `registrations_master`
--

INSERT INTO `registrations_master` (`registration_id`, `parent_fname`, `parent_mname`, `parent_lname`, `address1`, `address2`, `suburb`, `post_code`, `email`, `home_number`, `mobile_number`, `office_number`) VALUES
(1, 'Name', '', 'Surname', 'ADD 1', 'ADD 1', 'SANCTUARY LAKES', 3301, '', 0, 123456789, 0),
(2, 'Give', 'it normal', 'name', 'ADD 2', 'ADD 2', 'SANCTUARY LAKES', 3390, '', 0, 0, 0),
(3, 'Do', 'you', 'Understand', 'ADD 3', 'ADD 3', 'SANCTUARY LAKES', 3300, '', 0, 0, 0),
(4, 'Bamby', '', 'Rorson', 'ADD 4', 'ADD 4', 'SANCTUARY LAKES', 3300, '', 0, 0, 0),
(5, 'Xenos', NULL, 'Gonzales', 'P.O. Box 5', 'Oldenburg', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(6, 'Hannah', '', 'Hendrix', 'Ap #334-78', 'Bras', 'Sanctuary Lakes', 3030, '', 0, 0, 0),
(7, 'Neve', NULL, 'Melton', '725-6065 C', 'Forio', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(8, 'Beatrice', NULL, 'Pitts', 'Ap #167-58', 'Tielen', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(9, 'Jolene', NULL, 'Smith', 'Ap #593-39', 'Port Hope', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(10, 'Audrey', NULL, 'Hall', '147-2737 L', 'Essex', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(11, 'Freya', NULL, 'Middleton', 'Ap #280-40', 'Montacuto', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(12, 'Melyssa', NULL, 'Glenn', 'P.O. Box 6', 'Wanferc�e-Baulet', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(13, 'Maxine', NULL, 'Perkins', 'P.O. Box 1', 'Dessel', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(14, 'Holly', NULL, 'Swanson', 'P.O. Box 4', 'Celle', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(15, 'Karen', NULL, 'Stephenson', '8695 Liber', 'Beez', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(16, 'Steven', NULL, 'Wood', '372-7818 N', 'Schwedt', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(17, 'Marvin', NULL, 'Marquez', '7517 Risus', 'Casacalenda', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(18, 'Stella', NULL, 'Harris', '4975 Et Av', 'Calgary', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(19, 'Marshall', NULL, 'Steele', 'Ap #737-40', 'Herstappe', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(20, 'Tobias', NULL, 'Briggs', 'P.O. Box 2', 'Pforzheim', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(21, 'Xantha', NULL, 'Acevedo', 'P.O. Box 6', 'Arrone', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(22, 'Quinlan', NULL, 'Mayer', 'P.O. Box 1', 'Massello', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(23, 'Timothy', NULL, 'Riddle', 'Ap #414-48', 'Bairnsdale', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(24, 'Avye', NULL, 'Hart', 'Ap #107-30', 'Carbonear', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(25, 'Slade', NULL, 'Yang', 'P.O. Box 4', 'Limón (Puerto Limón)', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(26, 'Chadwick', NULL, 'Perkins', 'P.O. Box 8', 'Bierk Bierghes', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(27, 'Jesse', NULL, 'Arnold', '243-4810 M', 'Merzig', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(28, 'Rowan', NULL, 'George', '8667 Ac, A', 'Eisenstadt', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(29, 'Ivory', NULL, 'Estes', '801-6991 U', 'Vishakhapatnam', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(30, 'Gloria', NULL, 'Mckenzie', 'P.O. Box 9', 'Armadale', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(31, 'Tana', NULL, 'Craft', '568-4225 F', 'Peine', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(32, 'Kirestin', NULL, 'Stevenson', '8782 A, Ro', 'Badalona', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(33, 'Alea', NULL, 'Noel', '913-1506 S', 'Levin', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(34, 'Nora', NULL, 'Wynn', 'Ap #287-47', 'Hofheim am Taunus', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(35, 'Jin', NULL, 'Vang', 'P.O. Box 3', 'Newton Abbot', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(36, 'Alan', NULL, 'Duran', 'P.O. Box 5', 'Cannes', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(37, 'Tyrone', NULL, 'Solis', 'Ap #191-29', 'Nuremberg', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(38, 'Erica', NULL, 'Knight', 'Ap #720-83', 'Goes', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(39, 'Shad', NULL, 'Watkins', '279-1840 A', 'Damoh', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(40, 'Leonard', NULL, 'Talley', '2344 Praes', 'Habra', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(41, 'Linda', NULL, 'Savage', '189-9018 D', 'Boninne', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(42, 'Odysseus', NULL, 'Navarro', 'P.O. Box 3', 'Leominster', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(43, 'Cullen', NULL, 'William', 'Ap #476-71', 'Lagos', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(44, 'Echo', NULL, 'Waters', 'Ap #673-84', 'Orciano Pisano', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(45, 'Roary', NULL, 'Sweet', 'P.O. Box 4', 'Warburg', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(46, 'Wyoming', NULL, 'Patton', 'P.O. Box 6', 'Wichita', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(47, 'Hall', NULL, 'Green', '2085 In Rd', 'Leut', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(48, 'William', NULL, 'Mcdowell', 'Ap #674-50', 'Lugo', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(49, 'Rose', NULL, 'Vang', '920-5306 N', 'Stargard Szczeciński', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(50, 'Charlotte', NULL, 'Carlson', '1707 Amet ', 'Bayswater', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(51, 'Eve', NULL, 'Rivera', '136-5885 T', 'San Costantino Calab', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(52, 'Amber', NULL, 'Kemp', 'Ap #734-62', 'Lloydminster', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(53, 'Allen', NULL, 'Barber', 'P.O. Box 9', 'Hawera', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(54, 'Ariana', NULL, 'Hodges', '1182 Magna', 'Palmerston', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(55, 'Castor', NULL, 'Conley', 'Ap #536-39', 'Lewiston', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(56, 'Zelda', NULL, 'Lamb', '571-7681 U', 'Linton', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(57, 'Judah', NULL, 'Daniel', '169-9599 V', 'Stony Plain', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(58, 'Xandra', NULL, 'Walls', 'Ap #649-80', 'Couthuin', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(59, 'Keelie', NULL, 'Nunez', '7634 Nec S', 'D�sseldorf', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(60, 'Chester', NULL, 'Solomon', 'P.O. Box 5', 'Mechelen-aan-de-Maas', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(61, 'Jenna', NULL, 'Thompson', '243-3747 L', 'Saint-Denis-Bovesse', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(62, 'Madonna', NULL, 'Howard', 'P.O. Box 4', 'Frankfurt', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(63, 'Libby', NULL, 'Golden', 'P.O. Box 5', 'A Coruña', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(64, 'Beatrice', NULL, 'Poole', 'P.O. Box 5', 'Cáceres', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(65, 'Gretchen', NULL, 'Slater', 'P.O. Box 5', 'Sant''Egidio alla Vib', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(66, 'Minerva', NULL, 'Foreman', '809 Malesu', 'Maasmechelen', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(67, 'Paloma', NULL, 'Alvarez', '105 Conval', 'Connah''s Quay', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(68, 'Keefe', NULL, 'Patrick', '143-7969 A', 'Portland', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(69, 'Urielle', NULL, 'Curry', 'P.O. Box 7', 'St. Pölten', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(70, 'Vaughan', NULL, 'Ramirez', '351-7590 V', 'Heide', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(71, 'Buckminster', NULL, 'Allison', '530 Tempus', 'Carson City', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(72, 'Rashad', NULL, 'Wheeler', 'Ap #797-29', 'Latinne', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(73, 'Scarlet', NULL, 'Koch', '6625 Tempo', 'Glendale', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(74, 'Malcolm', NULL, 'Bridges', 'Ap #221-55', 'Sete Lagoas', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(75, 'Myles', NULL, 'Delgado', '479-8788 P', 'Liverpool', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(76, 'Lydia', NULL, 'York', 'P.O. Box 7', 'Aalst', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(77, 'Kim', NULL, 'Boyer', 'Ap #314-41', 'Linlithgow', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(78, 'Davis', NULL, 'Vance', '6547 Senec', 'Hengelo', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(79, 'Marsden', NULL, 'Callahan', '586-1833 T', 'Kilmarnock', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(80, 'Latifah', NULL, 'Thompson', 'P.O. Box 1', 'Navsari', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(81, 'Karly', NULL, 'Christensen', '904-7313 E', 'Villenave-d''Ornon', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(82, 'Lavinia', NULL, 'Adkins', 'Ap #911-18', 'Balfour', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(83, 'Thane', NULL, 'Ward', 'Ap #192-75', 'Habay', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(84, 'Jarrod', NULL, 'Leonard', 'P.O. Box 1', 'Petit-Thier', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(85, 'Barbara', NULL, 'Richardson', '7773 Nisl ', 'Bhavnagar', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(86, 'Fleur', NULL, 'Bowen', '6405 Arcu.', 'San Juan de Dios', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(87, 'Ian', NULL, 'Whitfield', 'P.O. Box 1', 'Valley East', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(88, 'Winifred', NULL, 'Rocha', 'Ap #578-99', 'Sonipat', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(89, 'Casey', NULL, 'Hodge', '285 Et, Rd', 'Baltimore', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(90, 'Clark', NULL, 'Mcclure', '818-5846 E', 'Raj Nandgaon', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(91, 'Reed', NULL, 'Floyd', '818-1687 L', 'Carunchio', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(92, 'Doris', NULL, 'Moore', 'P.O. Box 3', 'Madison', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(93, 'Mercedes', NULL, 'Warner', '677-2008 P', 'Laives/Leifers', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(94, 'Kareem', NULL, 'Schroeder', 'Ap #108-97', 'Porirua', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(95, 'Bree', NULL, 'England', 'P.O. Box 6', 'Grand Falls', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(96, 'Graham', NULL, 'Reynolds', '929-2562 N', 'Markham', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(97, 'Nehru', NULL, 'Richardson', 'P.O. Box 8', 'Rockville', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(98, 'Ulysses', NULL, 'Aguilar', '884-412 Cl', 'Castelnovo del Friul', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(99, 'Audra', NULL, 'Padilla', 'Ap #947-35', 'Tribogna', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(100, 'Phyllis', NULL, 'Riley', 'P.O. Box 6', 'Goslar', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(101, 'Brendan', NULL, 'Garcia', 'Ap #881-96', 'Deurne', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(102, 'Kai', NULL, 'Tanner', '7388 Cras ', 'Kermt', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(103, 'Adrienne', NULL, 'Austin', 'P.O. Box 5', 'Varsenare', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(104, 'Nero', NULL, 'Knox', 'P.O. Box 9', 'Biarritz', 'Sanctuary Lakes', 3030, NULL, NULL, NULL, NULL),
(105, 'test', '', 'test', '', '', '', 0, '', 0, 0, 0),
(106, 'Killian', '', 'Murphy', '', 'London', '', 0, '', 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `schedule_details`
--

INSERT INTO `schedule_details` (`schedule_id`, `group_id`, `schedule_date`, `start_time`, `end_time`) VALUES
(22, 2, '2014-10-09', '10:30:00', '12:30:00'),
(23, 2, '2014-10-16', '10:30:00', '12:30:00'),
(24, 2, '2014-10-23', '10:30:00', '12:30:00'),
(25, 2, '2014-10-30', '10:30:00', '12:30:00'),
(26, 2, '2014-11-06', '10:30:00', '12:30:00'),
(27, 2, '2014-11-13', '10:30:00', '12:30:00'),
(28, 2, '2014-11-20', '10:30:00', '12:30:00'),
(29, 2, '2014-11-27', '10:30:00', '12:30:00'),
(30, 2, '2014-12-04', '10:30:00', '12:30:00'),
(31, 2, '2014-12-11', '10:30:00', '12:30:00'),
(32, 1, '2014-10-06', '10:30:00', '12:00:00'),
(33, 1, '2014-10-13', '10:30:00', '12:00:00'),
(34, 1, '2014-10-20', '10:30:00', '12:00:00'),
(35, 1, '2014-10-27', '10:30:00', '12:00:00'),
(36, 1, '2014-11-03', '10:30:00', '12:00:00'),
(37, 1, '2014-11-10', '10:30:00', '12:00:00'),
(38, 1, '2014-11-17', '10:30:00', '12:00:00'),
(39, 1, '2014-11-24', '10:30:00', '12:00:00'),
(40, 1, '2014-12-01', '10:30:00', '12:00:00'),
(41, 1, '2014-12-08', '10:30:00', '12:00:00'),
(52, 3, '2014-10-09', '09:00:00', '10:00:00'),
(53, 3, '2014-10-16', '09:00:00', '10:00:00'),
(54, 3, '2014-10-23', '09:00:00', '10:00:00'),
(55, 3, '2014-10-30', '09:00:00', '10:00:00'),
(56, 3, '2014-11-06', '09:00:00', '10:00:00'),
(57, 3, '2014-11-13', '09:00:00', '10:00:00'),
(58, 3, '2014-11-20', '09:00:00', '10:00:00'),
(59, 3, '2014-11-27', '09:00:00', '10:00:00'),
(60, 3, '2014-12-04', '09:00:00', '10:00:00'),
(61, 3, '2014-12-11', '09:00:00', '10:00:00');

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

--
-- Dumping data for table `schedule_master`
--

INSERT INTO `schedule_master` (`group_id`, `staff_id`, `date_created`, `weekday`, `start_time`, `end_time`) VALUES
(1, 5, '2014-09-29', 1, '10:30:00', '12:00:00'),
(2, 5, '2014-09-29', 4, '10:30:00', '12:30:00'),
(3, 1, '2014-10-04', 4, '09:00:00', '10:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `skills_master`
--

INSERT INTO `skills_master` (`skill_id`, `sport_id`, `skill_band`, `skill_band_description`) VALUES
(1, 1, 'ONE', 'Beginner'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_mname`, `staff_lname`, `home_number`, `mobile_number`, `emg_contact_name`, `emg_contact_number`, `staff_email`, `active`) VALUES
(1, 'Daniel', '', 'Tipples', '', '', '', '', '', 1),
(2, 'KEONE', NULL, 'KEONE', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Neil', '', 'Neilsen', '', '', '', '', '', 1),
(4, 'LANI', NULL, 'LANI', NULL, NULL, NULL, NULL, NULL, 1),
(5, 'CAITLYN', '', 'CAITLYN', '', '', '', '', '', 1),
(6, 'EMILY', NULL, 'EMILY', NULL, NULL, NULL, NULL, NULL, 1),
(7, 'LEISA', '', 'LEISA', '', '', '', '', '', 0),
(15, 'Test', '', 'Test', '', '', '', '', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `term_description`, `start_date`, `end_date`) VALUES
(1, 'Term 4', '2014-10-06', '2014-12-13');

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
(1, 'dtipples', 'administrator', 'TLiLIO3A+2XL60jPlEc/RVP3hSphRWXzLVufKAc9pzDVLzrEhpdHRRoZCJ4z5AR8DD8Mb/ZsPPsbvCcghP46Eg==', NULL, NULL),
(2, 'keone', 'staff', '', NULL, NULL),
(3, 'nell', 'staff', 'pgWwXpzkQPSGfqaKlGAsgk4u/', NULL, NULL),
(4, 'lani', 'staff', '', NULL, NULL),
(5, 'caitlyn', 'staff', '', NULL, NULL),
(6, 'emily', 'staff', '', NULL, NULL),
(7, 'leisa', 'staff', '', NULL, NULL),
(15, 'tester', 'staff', '9gAUGtyX93gCrs2qvHQBtLAs3R3ZQUh3SPqia+l+AYGxXiPYxq6VOCbgqi/ZvN+O8umRCWJ30MZdjkmFJAveJA==', NULL, NULL);

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