-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2014 at 04:35 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  `entry_status` tinyint(1) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_details`
--

INSERT INTO `groups_details` (`group_id`, `member_id`, `date_added`, `entry_status`) VALUES
(1, 1, '2014-08-29 22:17:50', 0),
(1, 5, '2014-08-29 22:17:50', 0),
(1, 6, '2014-08-29 22:18:04', 0),
(1, 7, '2014-08-29 22:18:04', 0),
(2, 3, '2014-08-29 22:18:30', 0),
(2, 4, '2014-08-29 22:18:30', 0),
(2, 8, '2014-08-29 22:18:42', 0),
(2, 9, '2014-08-29 22:18:42', 0),
(1, 10, '2014-09-12 13:06:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups_master`
--

CREATE TABLE IF NOT EXISTS `groups_master` (
  `group_id` int(8) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(2) NOT NULL,
  `skill_id` int(2) NOT NULL,
  `max_number` int(1) NOT NULL,
  `term_id` int(8) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `term_id` (`term_id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups_master`
--

INSERT INTO `groups_master` (`group_id`, `lesson_id`, `skill_id`, `max_number`, `term_id`, `date_created`) VALUES
(1, 2, 4, 5, 1, '2014-08-30'),
(2, 2, 4, 5, 1, '2014-08-30');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_description`, `sport_id`, `cost`) VALUES
(1, 'Group', 1, '13'),
(2, 'Group', 2, '13'),
(3, 'Private', 1, '40'),
(4, 'Private', 2, '40');

-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions_details`
--

CREATE TABLE IF NOT EXISTS `medical_conditions_details` (
  `member_id` int(8) NOT NULL,
  `medical_condition_id` int(8) NOT NULL,
  `medical_condition_description` varchar(100) NOT NULL,
  PRIMARY KEY (`member_id`,`medical_condition_id`),
  KEY `medical_condition_id` (`medical_condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_conditions_details`
--

INSERT INTO `medical_conditions_details` (`member_id`, `medical_condition_id`, `medical_condition_description`) VALUES
(1, 2, 'none'),
(1, 3, 'none'),
(3, 4, 'none'),
(3, 7, 'none'),
(4, 8, 'None'),
(5, 8, 'None'),
(6, 5, 'none'),
(7, 5, 'None'),
(8, 8, 'None'),
(9, 8, 'None'),
(10, 2, 'none'),
(115, 3, 'none'),
(130, 3, 'none'),
(211, 1, 'none'),
(211, 3, 'none'),
(212, 1, 'none');

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
  `member_id` int(8) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `schedule_date` date NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '0',
  `task_id` int(2) NOT NULL,
  `task_accomplished` tinyint(1) NOT NULL DEFAULT '0',
  `staff_id` int(8) NOT NULL,
  `staff_comments` varchar(100) DEFAULT NULL,
  KEY `member_id` (`member_id`),
  KEY `task_id` (`task_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members_skills`
--

CREATE TABLE IF NOT EXISTS `members_skills` (
  `member_id` int(8) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `skill_id` int(2) NOT NULL,
  PRIMARY KEY (`member_id`,`skill_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members_skills`
--

INSERT INTO `members_skills` (`member_id`, `entry_date`, `skill_id`) VALUES
(1, '2014-09-14 07:56:34', 4),
(3, '2014-09-14 07:56:34', 4),
(4, '2014-09-14 07:56:34', 4),
(5, '2014-09-14 07:56:34', 4),
(6, '2014-09-14 07:56:34', 4),
(7, '2014-09-14 07:56:34', 4),
(8, '2014-09-14 07:56:34', 4),
(9, '2014-09-14 07:56:34', 4),
(10, '2014-09-14 07:56:34', 4),
(111, '2014-09-14 07:59:08', 5),
(112, '2014-09-14 07:59:08', 5),
(113, '2014-09-14 07:59:08', 5),
(114, '2014-09-14 07:59:08', 5),
(115, '2014-09-14 07:59:08', 5),
(116, '2014-09-14 07:59:08', 5),
(117, '2014-09-14 07:59:08', 5),
(118, '2014-09-14 07:59:08', 5),
(119, '2014-09-14 07:59:08', 5),
(120, '2014-09-14 07:59:08', 5),
(121, '2014-09-14 07:59:08', 5),
(122, '2014-09-14 07:59:08', 5),
(123, '2014-09-14 07:59:08', 5),
(124, '2014-09-14 07:59:08', 5),
(125, '2014-09-14 07:59:08', 5),
(126, '2014-09-14 07:59:08', 5),
(127, '2014-09-14 07:59:08', 5),
(128, '2014-09-14 07:59:08', 5),
(129, '2014-09-14 07:59:08', 5),
(130, '2014-09-14 07:59:08', 5),
(131, '2014-09-14 07:59:08', 5),
(132, '2014-09-14 07:59:08', 5),
(133, '2014-09-14 07:59:08', 5),
(134, '2014-09-14 07:59:08', 5),
(135, '2014-09-14 07:59:08', 5),
(136, '2014-09-14 07:59:08', 5),
(137, '2014-09-14 07:59:08', 5),
(138, '2014-09-14 07:59:08', 5),
(139, '2014-09-14 07:59:08', 5),
(140, '2014-09-14 07:59:08', 5),
(141, '2014-09-14 07:59:08', 5),
(142, '2014-09-14 07:59:08', 5),
(143, '2014-09-14 07:59:08', 5),
(144, '2014-09-14 07:59:08', 5),
(145, '2014-09-14 07:59:08', 5),
(146, '2014-09-14 07:59:08', 5),
(147, '2014-09-14 07:59:08', 5),
(148, '2014-09-14 07:59:08', 5),
(149, '2014-09-14 07:59:08', 5),
(150, '2014-09-14 07:59:08', 5),
(151, '2014-09-14 08:00:08', 6),
(152, '2014-09-14 08:00:08', 6),
(153, '2014-09-14 08:00:08', 6),
(154, '2014-09-14 08:00:08', 6),
(155, '2014-09-14 08:00:08', 6),
(156, '2014-09-14 08:00:08', 6),
(157, '2014-09-14 08:00:08', 6),
(158, '2014-09-14 08:00:08', 6),
(159, '2014-09-14 08:00:08', 6),
(160, '2014-09-14 08:00:08', 6),
(161, '2014-09-14 08:00:08', 6),
(162, '2014-09-14 08:00:08', 6),
(163, '2014-09-14 08:00:08', 6),
(164, '2014-09-14 08:00:08', 6),
(165, '2014-09-14 08:00:08', 6),
(166, '2014-09-14 08:00:08', 6),
(167, '2014-09-14 08:00:08', 6),
(168, '2014-09-14 08:00:08', 6),
(169, '2014-09-14 08:00:08', 6),
(170, '2014-09-14 08:00:08', 6),
(171, '2014-09-14 08:00:08', 6),
(172, '2014-09-14 08:00:08', 6),
(173, '2014-09-14 08:00:08', 6),
(174, '2014-09-14 08:00:08', 6),
(175, '2014-09-14 08:00:08', 6),
(176, '2014-09-14 08:00:08', 6),
(177, '2014-09-14 08:00:08', 6),
(178, '2014-09-14 08:00:08', 6),
(179, '2014-09-14 08:00:08', 6),
(180, '2014-09-14 08:00:08', 6),
(181, '2014-09-14 08:02:10', 7),
(182, '2014-09-14 08:02:10', 7),
(183, '2014-09-14 08:02:10', 7),
(184, '2014-09-14 08:02:10', 7),
(185, '2014-09-14 08:02:10', 7),
(186, '2014-09-14 08:02:10', 7),
(187, '2014-09-14 08:02:10', 7),
(188, '2014-09-14 08:02:10', 7),
(189, '2014-09-14 08:02:10', 7),
(190, '2014-09-14 08:02:10', 7),
(191, '2014-09-14 08:02:10', 7),
(192, '2014-09-14 08:02:10', 7),
(193, '2014-09-14 08:02:10', 7),
(194, '2014-09-14 08:02:10', 7),
(195, '2014-09-14 08:02:10', 7),
(196, '2014-09-14 08:02:10', 7),
(197, '2014-09-14 08:02:10', 7),
(198, '2014-09-14 08:02:10', 7),
(199, '2014-09-14 08:02:10', 7),
(200, '2014-09-14 08:02:10', 7),
(201, '2014-09-14 08:02:10', 7),
(202, '2014-09-14 08:02:10', 7),
(203, '2014-09-14 08:02:10', 7),
(204, '2014-09-14 08:02:10', 7),
(205, '2014-09-14 08:02:10', 7),
(206, '2014-09-14 08:02:10', 7),
(207, '2014-09-14 08:02:10', 7),
(208, '2014-09-14 08:02:10', 7),
(209, '2014-09-14 08:02:10', 7),
(210, '2014-09-14 08:02:10', 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `payments_details`
--

INSERT INTO `payments_details` (`transaction_id`, `payment_id`, `payment_date`, `payment_type`, `amount_paid`) VALUES
(1, 78, '2014-09-14', 'credit', '130'),
(2, 79, '2014-09-15', 'CASH', '130'),
(3, 80, '2014-09-15', 'CASH', '130'),
(4, 81, '2014-09-15', 'CASH', '130'),
(5, 82, '2014-09-15', 'CASH', '130'),
(6, 83, '2014-09-15', 'CASH', '130'),
(7, 84, '2014-09-15', 'CASH', '130'),
(8, 85, '2014-09-15', 'CASH', '130'),
(9, 86, '2014-09-15', 'CASH', '130'),
(10, 93, '2014-09-15', 'CASH', '130'),
(11, 94, '2014-09-15', 'CASH', '130'),
(12, 95, '2014-09-15', 'CASH', '130'),
(13, 96, '2014-09-15', 'CASH', '130'),
(14, 97, '2014-09-15', 'CASH', '130'),
(15, 98, '2014-09-15', 'CASH', '130'),
(16, 99, '2014-09-15', 'CASH', '130'),
(17, 100, '2014-09-15', 'CASH', '130'),
(18, 101, '2014-09-15', 'CASH', '130'),
(19, 102, '2014-09-15', 'CASH', '130'),
(20, 103, '2014-09-15', 'CASH', '130'),
(21, 104, '2014-09-15', 'CASH', '130'),
(22, 105, '2014-09-15', 'CASH', '130'),
(23, 106, '2014-09-15', 'CASH', '130'),
(24, 107, '2014-09-15', 'CASH', '130'),
(25, 108, '2014-09-15', 'CASH', '130'),
(26, 109, '2014-09-15', 'CASH', '130'),
(27, 110, '2014-09-15', 'CASH', '130'),
(28, 111, '2014-09-15', 'CASH', '130'),
(29, 112, '2014-09-15', 'CASH', '130'),
(30, 113, '2014-09-15', 'CASH', '130'),
(31, 114, '2014-09-15', 'CASH', '130'),
(32, 115, '2014-09-15', 'CASH', '130'),
(33, 116, '2014-09-15', 'CASH', '130'),
(34, 117, '2014-09-15', 'CASH', '130'),
(35, 118, '2014-09-15', 'CASH', '130'),
(36, 119, '2014-09-15', 'CASH', '130'),
(37, 120, '2014-09-15', 'CASH', '130'),
(38, 121, '2014-09-16', 'cash', '130'),
(39, 122, '2014-09-15', 'CASH', '130'),
(40, 123, '2014-09-15', 'CASH', '130'),
(41, 124, '2014-09-15', 'CASH', '130'),
(42, 125, '2014-09-15', 'CASH', '130'),
(43, 126, '2014-09-15', 'CASH', '130'),
(44, 127, '2014-09-15', 'CASH', '130'),
(45, 128, '2014-09-15', 'CASH', '130'),
(46, 129, '2014-09-15', 'CASH', '130'),
(47, 130, '2014-09-15', 'CASH', '130'),
(48, 131, '2014-09-15', 'CASH', '130'),
(49, 132, '2014-09-15', 'CASH', '130'),
(50, 156, '2014-09-15', 'CASH', '130'),
(51, 157, '2014-09-15', 'CASH', '130'),
(52, 158, '2014-09-15', 'CASH', '130'),
(53, 159, '2014-09-15', 'CASH', '130'),
(54, 160, '2014-09-15', 'CASH', '130'),
(55, 161, '2014-09-15', 'CASH', '130'),
(56, 162, '2014-09-15', 'CASH', '130'),
(57, 163, '2014-09-15', 'CASH', '130'),
(58, 164, '2014-09-15', 'CASH', '130'),
(59, 165, '2014-09-15', 'CASH', '130'),
(60, 166, '2014-09-15', 'CASH', '130'),
(61, 167, '2014-09-15', 'CASH', '130'),
(62, 168, '2014-09-15', 'CASH', '130'),
(63, 169, '2014-09-15', 'CASH', '130'),
(64, 170, '2014-09-15', 'CASH', '130'),
(65, 171, '2014-09-15', 'CASH', '130'),
(66, 172, '2014-09-15', 'CASH', '130'),
(67, 173, '2014-09-15', 'CASH', '130'),
(68, 174, '2014-09-15', 'CASH', '130'),
(69, 175, '2014-09-15', 'CASH', '130'),
(70, 176, '2014-09-15', 'CASH', '130'),
(71, 177, '2014-09-15', 'CASH', '130'),
(72, 178, '2014-09-15', 'CASH', '130'),
(73, 179, '2014-09-15', 'CASH', '130'),
(74, 180, '2014-09-15', 'CASH', '130'),
(75, 181, '2014-09-15', 'CASH', '130'),
(76, 182, '2014-09-15', 'CASH', '130'),
(77, 183, '2014-09-15', 'CASH', '130'),
(78, 184, '2014-09-15', 'CASH', '130'),
(79, 185, '2014-09-15', 'CASH', '130'),
(80, 186, '2014-09-15', 'CASH', '130'),
(81, 187, '2014-09-15', 'CASH', '130'),
(82, 188, '2014-09-15', 'CASH', '130'),
(83, 189, '2014-09-15', 'CASH', '130'),
(84, 190, '2014-09-15', 'CASH', '130'),
(85, 191, '2014-09-15', 'CASH', '130'),
(86, 192, '2014-09-15', 'CASH', '130'),
(87, 193, '2014-09-15', 'CASH', '130'),
(88, 194, '2014-09-15', 'CASH', '130'),
(89, 195, '2014-09-15', 'CASH', '130'),
(90, 196, '2014-09-15', 'CASH', '130'),
(91, 197, '2014-09-15', 'CASH', '130'),
(92, 198, '2014-09-15', 'CASH', '130'),
(93, 199, '2014-09-15', 'CASH', '130'),
(94, 200, '2014-09-15', 'CASH', '130'),
(95, 201, '2014-09-15', 'CASH', '130'),
(96, 202, '2014-09-15', 'CASH', '130'),
(97, 203, '2014-09-15', 'CASH', '130'),
(98, 204, '2014-09-15', 'CASH', '130'),
(99, 205, '2014-09-15', 'CASH', '130'),
(100, 206, '2014-09-15', 'CASH', '130'),
(101, 207, '2014-09-15', 'CASH', '130'),
(102, 208, '2014-09-15', 'CASH', '130'),
(103, 209, '2014-09-15', 'CASH', '130'),
(104, 210, '2014-09-15', 'CASH', '130'),
(105, 211, '2014-09-15', 'CASH', '130'),
(106, 212, '2014-09-15', 'CASH', '130'),
(107, 213, '2014-09-15', 'CASH', '130'),
(108, 214, '2014-09-15', 'CASH', '130'),
(109, 215, '2014-09-15', 'CASH', '130'),
(110, 101, '2013-12-06', 'credit', '51');

-- --------------------------------------------------------

--
-- Table structure for table `payments_master`
--

CREATE TABLE IF NOT EXISTS `payments_master` (
  `payment_id` int(8) NOT NULL AUTO_INCREMENT,
  `registration_id` int(8) NOT NULL,
  `member_id` int(8) NOT NULL,
  `term_id` int(8) NOT NULL,
  `lesson_id` int(2) NOT NULL,
  `number_of_lessons` int(2) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `Unique1` (`registration_id`,`member_id`,`term_id`,`lesson_id`),
  KEY `term_id` (`term_id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=216 ;

--
-- Dumping data for table `payments_master`
--

INSERT INTO `payments_master` (`payment_id`, `registration_id`, `member_id`, `term_id`, `lesson_id`, `number_of_lessons`, `total_amount`) VALUES
(78, 1, 1, 1, 2, 10, '130'),
(79, 2, 3, 1, 2, 10, '130'),
(80, 2, 4, 1, 4, 5, '200'),
(81, 3, 5, 1, 2, 10, '130'),
(82, 3, 6, 1, 2, 10, '130'),
(83, 3, 7, 1, 2, 10, '130'),
(84, 4, 8, 1, 2, 10, '130'),
(85, 4, 9, 1, 2, 10, '130'),
(86, 1, 10, 1, 2, 10, '130'),
(93, 5, 111, 1, 2, 10, '130'),
(94, 6, 112, 1, 2, 10, '130'),
(95, 7, 113, 1, 2, 10, '130'),
(96, 8, 114, 1, 2, 10, '130'),
(97, 9, 115, 1, 2, 10, '130'),
(98, 10, 116, 1, 2, 10, '130'),
(99, 11, 117, 1, 2, 10, '130'),
(100, 12, 118, 1, 2, 10, '130'),
(101, 13, 119, 1, 2, 10, '130'),
(102, 14, 120, 1, 2, 10, '130'),
(103, 15, 121, 1, 2, 10, '130'),
(104, 16, 122, 1, 2, 10, '130'),
(105, 17, 123, 1, 2, 10, '130'),
(106, 18, 124, 1, 2, 10, '130'),
(107, 19, 125, 1, 2, 10, '130'),
(108, 20, 126, 1, 2, 10, '130'),
(109, 21, 127, 1, 2, 10, '130'),
(110, 22, 128, 1, 2, 10, '130'),
(111, 23, 129, 1, 4, 10, '400'),
(112, 24, 130, 1, 2, 10, '130'),
(113, 25, 131, 1, 2, 10, '130'),
(114, 26, 132, 1, 2, 10, '130'),
(115, 27, 133, 1, 2, 10, '130'),
(116, 28, 134, 1, 2, 10, '130'),
(117, 29, 135, 1, 2, 10, '130'),
(118, 30, 136, 1, 2, 10, '130'),
(119, 31, 137, 1, 2, 10, '130'),
(120, 32, 138, 1, 2, 10, '130'),
(121, 33, 139, 1, 2, 10, '130'),
(122, 34, 140, 1, 2, 10, '130'),
(123, 35, 141, 1, 2, 10, '130'),
(124, 36, 142, 1, 2, 10, '130'),
(125, 37, 143, 1, 2, 10, '130'),
(126, 38, 144, 1, 2, 10, '130'),
(127, 39, 145, 1, 2, 10, '130'),
(128, 40, 146, 1, 2, 10, '130'),
(129, 41, 147, 1, 2, 10, '130'),
(130, 42, 148, 1, 2, 10, '130'),
(131, 43, 149, 1, 2, 10, '130'),
(132, 44, 150, 1, 2, 10, '130'),
(156, 45, 151, 1, 2, 10, '130'),
(157, 46, 152, 1, 2, 10, '130'),
(158, 47, 153, 1, 2, 10, '130'),
(159, 48, 154, 1, 2, 10, '130'),
(160, 49, 155, 1, 2, 10, '130'),
(161, 50, 156, 1, 2, 10, '130'),
(162, 51, 157, 1, 2, 10, '130'),
(163, 52, 158, 1, 2, 10, '130'),
(164, 53, 159, 1, 2, 10, '130'),
(165, 54, 160, 1, 2, 10, '130'),
(166, 55, 161, 1, 2, 10, '130'),
(167, 56, 162, 1, 2, 10, '130'),
(168, 57, 163, 1, 2, 10, '130'),
(169, 58, 164, 1, 2, 10, '130'),
(170, 59, 165, 1, 2, 10, '130'),
(171, 60, 166, 1, 2, 10, '130'),
(172, 61, 167, 1, 2, 10, '130'),
(173, 62, 168, 1, 2, 10, '130'),
(174, 63, 169, 1, 2, 10, '130'),
(175, 64, 170, 1, 2, 10, '130'),
(176, 65, 171, 1, 2, 10, '130'),
(177, 66, 172, 1, 2, 10, '130'),
(178, 67, 173, 1, 2, 10, '130'),
(179, 68, 174, 1, 2, 10, '130'),
(180, 69, 175, 1, 2, 10, '130'),
(181, 70, 176, 1, 2, 10, '130'),
(182, 71, 177, 1, 2, 10, '130'),
(183, 72, 178, 1, 2, 10, '130'),
(184, 73, 179, 1, 2, 10, '130'),
(185, 74, 180, 1, 2, 10, '130'),
(186, 75, 181, 1, 2, 10, '130'),
(187, 76, 182, 1, 2, 10, '130'),
(188, 77, 183, 1, 2, 10, '130'),
(189, 78, 184, 1, 2, 10, '130'),
(190, 79, 185, 1, 2, 10, '130'),
(191, 80, 186, 1, 2, 10, '130'),
(192, 81, 187, 1, 2, 10, '130'),
(193, 82, 188, 1, 2, 10, '130'),
(194, 83, 189, 1, 2, 10, '130'),
(195, 84, 190, 1, 2, 10, '130'),
(196, 85, 191, 1, 2, 10, '130'),
(197, 86, 192, 1, 2, 10, '130'),
(198, 87, 193, 1, 4, 8, '320'),
(199, 88, 194, 1, 2, 10, '130'),
(200, 89, 195, 1, 2, 10, '130'),
(201, 90, 196, 1, 2, 10, '130'),
(202, 91, 197, 1, 2, 10, '130'),
(203, 92, 198, 1, 2, 10, '130'),
(204, 93, 199, 1, 2, 10, '130'),
(205, 94, 200, 1, 2, 10, '130'),
(206, 95, 201, 1, 2, 10, '130'),
(207, 96, 202, 1, 2, 10, '130'),
(208, 97, 203, 1, 2, 10, '130'),
(209, 98, 204, 1, 2, 10, '130'),
(210, 99, 205, 1, 2, 10, '130'),
(211, 100, 206, 1, 2, 10, '130'),
(212, 101, 207, 1, 2, 10, '130'),
(213, 102, 208, 1, 2, 10, '130'),
(214, 103, 209, 1, 2, 10, '130'),
(215, 104, 210, 1, 2, 10, '130');

-- --------------------------------------------------------

--
-- Table structure for table `public_holidays`
--

CREATE TABLE IF NOT EXISTS `public_holidays` (
  `public_holiday` date NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`public_holiday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`member_id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `registrations_details`
--

INSERT INTO `registrations_details` (`member_id`, `registration_id`, `member_fname`, `member_mname`, `member_lname`, `member_dob`) VALUES
(1, 1, 'Alanis', '', 'Morisette', '2011-12-15'),
(3, 2, 'child 1 of 2 -> reg2', '', 'child 1 of 2 -> reg2', '2008-10-10'),
(4, 2, 'child 2 of 2 -> reg2', '', 'child 2 of 2 -> reg2', '2010-01-01'),
(5, 3, 'child 1 of 3 -> reg3', '', 'child 1 of 3 -> reg3', '2008-10-10'),
(6, 3, 'child 2 of 3 -> reg3', '', 'child 2 of 3 -> reg3', '2010-01-01'),
(7, 3, 'child 3 of 3 -> reg3', '', 'child 3 of 3 -> reg3', '2008-10-10'),
(8, 4, 'child 1 of 2 -> reg4', '', 'child 1 of 2 -> reg4', '2009-01-01'),
(9, 4, 'child 2 of 2 -> reg4', '', 'child 2 of 2 -> reg4', '2008-10-10'),
(10, 1, 'Star', '', 'Polar', '2011-09-01'),
(111, 5, 'Chelsea', NULL, 'Gonzales', '2010-10-18'),
(112, 6, 'Britanni', NULL, 'Hendrix', '2010-12-30'),
(113, 7, 'Armando', NULL, 'Melton', '2010-10-29'),
(114, 8, 'Ivor', NULL, 'Pitts', '2009-12-14'),
(115, 9, 'Neve', '', 'Smith', '2009-04-26'),
(116, 10, 'Brian', NULL, 'Hall', '2007-07-11'),
(117, 11, 'Britanni', NULL, 'Middleton', '2005-09-15'),
(118, 12, 'Shelly', NULL, 'Glenn', '2005-09-28'),
(119, 13, 'Kenneth', NULL, 'Perkins', '2005-09-28'),
(120, 14, 'Dora', NULL, 'Swanson', '2007-10-29'),
(121, 15, 'Basil', NULL, 'Stephenson', '2006-09-15'),
(122, 16, 'Kaye', NULL, 'Wood', '2009-06-09'),
(123, 17, 'Mari', NULL, 'Marquez', '2008-08-07'),
(124, 18, 'Mark', NULL, 'Harris', '2007-03-24'),
(125, 19, 'Kareem', NULL, 'Steele', '2007-02-06'),
(126, 20, 'Keith', NULL, 'Briggs', '2009-06-01'),
(127, 21, 'Donovan', NULL, 'Acevedo', '2008-03-02'),
(128, 22, 'Kirestin', NULL, 'Mayer', '2009-01-06'),
(129, 23, 'Bo', NULL, 'Riddle', '2006-02-19'),
(130, 24, 'Marcia', '', 'Hart', '2009-08-02'),
(131, 25, 'Colorado', NULL, 'Yang', '2006-08-11'),
(132, 26, 'Len', NULL, 'Perkins', '2010-10-07'),
(133, 27, 'Devin', NULL, 'Arnold', '2005-03-07'),
(134, 28, 'Delilah', NULL, 'George', '2005-11-28'),
(135, 29, 'Odessa', NULL, 'Estes', '2009-09-12'),
(136, 30, 'Nora', NULL, 'Mckenzie', '2006-11-19'),
(137, 31, 'Courtney', NULL, 'Craft', '2006-08-10'),
(138, 32, 'Colin', NULL, 'Stevenson', '2009-06-07'),
(139, 33, 'Sage', NULL, 'Noel', '2005-10-20'),
(140, 34, 'Quynn', NULL, 'Wynn', '2010-02-09'),
(141, 35, 'Nita', NULL, 'Vang', '2007-02-21'),
(142, 36, 'Chiquita', NULL, 'Duran', '2008-01-07'),
(143, 37, 'Rashad', NULL, 'Solis', '2009-04-14'),
(144, 38, 'Reuben', NULL, 'Knight', '2006-05-01'),
(145, 39, 'Indira', NULL, 'Watkins', '2008-05-01'),
(146, 40, 'Imogene', NULL, 'Talley', '2007-02-21'),
(147, 41, 'Ifeoma', NULL, 'Savage', '2005-07-31'),
(148, 42, 'Blaine', NULL, 'Navarro', '2006-03-23'),
(149, 43, 'Calvin', NULL, 'William', '2007-08-17'),
(150, 44, 'Lev', NULL, 'Waters', '2006-12-26'),
(151, 45, 'Amir', NULL, 'Sweet', '2006-01-20'),
(152, 46, 'Yuri', NULL, 'Patton', '2006-05-22'),
(153, 47, 'Alec', NULL, 'Green', '2010-09-23'),
(154, 48, 'Portia', NULL, 'Mcdowell', '2007-02-25'),
(155, 49, 'Elijah', NULL, 'Vang', '2009-05-09'),
(156, 50, 'Hasad', NULL, 'Carlson', '2006-08-28'),
(157, 51, 'May', NULL, 'Rivera', '2010-02-10'),
(158, 52, 'Cheyenne', NULL, 'Kemp', '2006-09-24'),
(159, 53, 'Ora', NULL, 'Barber', '2006-09-20'),
(160, 54, 'Tarik', NULL, 'Hodges', '2006-09-11'),
(161, 55, 'Odessa', NULL, 'Conley', '2007-07-30'),
(162, 56, 'Kennan', NULL, 'Lamb', '2006-04-07'),
(163, 57, 'Todd', NULL, 'Daniel', '2010-03-27'),
(164, 58, 'Xanthus', NULL, 'Walls', '2010-08-03'),
(165, 59, 'Brianna', NULL, 'Nunez', '2007-10-17'),
(166, 60, 'Larissa', NULL, 'Solomon', '2009-08-17'),
(167, 61, 'Tana', NULL, 'Thompson', '2006-08-05'),
(168, 62, 'Dawn', NULL, 'Howard', '2008-08-21'),
(169, 63, 'Emerson', NULL, 'Golden', '2010-07-21'),
(170, 64, 'Kameko', NULL, 'Poole', '2006-02-26'),
(171, 65, 'Raven', NULL, 'Slater', '2005-10-11'),
(172, 66, 'Quail', NULL, 'Foreman', '2006-01-24'),
(173, 67, 'Anika', NULL, 'Alvarez', '2008-08-14'),
(174, 68, 'Dana', NULL, 'Patrick', '2008-04-11'),
(175, 69, 'Nomlanga', NULL, 'Curry', '2008-03-28'),
(176, 70, 'Richard', NULL, 'Ramirez', '2005-08-31'),
(177, 71, 'Dillon', NULL, 'Allison', '2010-10-05'),
(178, 72, 'Ariel', NULL, 'Wheeler', '2008-11-23'),
(179, 73, 'Piper', NULL, 'Koch', '2007-09-29'),
(180, 74, 'Zelda', NULL, 'Bridges', '2005-05-14'),
(181, 75, 'Bianca', NULL, 'Delgado', '2009-01-24'),
(182, 76, 'Joy', NULL, 'York', '2008-07-14'),
(183, 77, 'Dahlia', NULL, 'Boyer', '2009-07-18'),
(184, 78, 'Flynn', NULL, 'Vance', '2010-10-02'),
(185, 79, 'Stacey', NULL, 'Callahan', '2009-08-15'),
(186, 80, 'Wanda', NULL, 'Thompson', '2009-10-14'),
(187, 81, 'Abraham', NULL, 'Christensen', '2007-04-02'),
(188, 82, 'Candace', NULL, 'Adkins', '2005-01-30'),
(189, 83, 'Zelenia', NULL, 'Ward', '2005-10-08'),
(190, 84, 'Sara', NULL, 'Leonard', '2009-03-10'),
(191, 85, 'Thaddeus', NULL, 'Richardson', '2008-12-13'),
(192, 86, 'Gail', NULL, 'Bowen', '2006-09-04'),
(193, 87, 'Ruth', NULL, 'Whitfield', '2009-03-02'),
(194, 88, 'Nyssa', NULL, 'Rocha', '2005-11-19'),
(195, 89, 'Shafira', NULL, 'Hodge', '2005-04-21'),
(196, 90, 'Germaine', NULL, 'Mcclure', '2010-06-06'),
(197, 91, 'Kasimir', NULL, 'Floyd', '2006-01-14'),
(198, 92, 'Lamar', NULL, 'Moore', '2010-03-14'),
(199, 93, 'Aileen', NULL, 'Warner', '2009-10-30'),
(200, 94, 'Veda', NULL, 'Schroeder', '2009-08-15'),
(201, 95, 'Geraldine', NULL, 'England', '2006-08-05'),
(202, 96, 'Ezra', NULL, 'Reynolds', '2006-07-21'),
(203, 97, 'Idona', NULL, 'Richardson', '2007-08-06'),
(204, 98, 'Jordan', NULL, 'Aguilar', '2006-12-31'),
(205, 99, 'Moana', NULL, 'Padilla', '2009-01-02'),
(206, 100, 'Grady', NULL, 'Riley', '2009-12-30'),
(207, 101, 'Jasmine', NULL, 'Garcia', '2007-12-07'),
(208, 102, 'Charissa', NULL, 'Tanner', '2009-12-11'),
(209, 103, 'Shelley', NULL, 'Austin', '2005-08-17'),
(210, 104, 'Troy', NULL, 'Knox', '2008-09-20'),
(211, 1, '123', '', '123', '2014-01-01'),
(212, 105, 'test', '', 'test', '2014-09-12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `registrations_master`
--

INSERT INTO `registrations_master` (`registration_id`, `parent_fname`, `parent_mname`, `parent_lname`, `address1`, `address2`, `suburb`, `post_code`, `email`, `home_number`, `mobile_number`, `office_number`) VALUES
(1, 'Name', '', 'Surnam', 'ADD 1', 'ADD 1', 'SANCTUARY LAKES', 3300, '', 0, 0, 0),
(2, 'Give', 'it normal', 'name', 'ADD 2', 'ADD 2', 'SANCTUARY LAKES', 3390, '', 0, 0, 0),
(3, 'Do', 'you', 'Understand', 'ADD 3', 'ADD 3', 'SANCTUARY LAKES', 3300, '', 0, 0, 0),
(4, 'Bloody', '', 'Racist', 'ADD 4', 'ADD 4', 'SANCTUARY LAKES', 3300, '', 0, 0, 0),
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
  `schedule_id` int(8) NOT NULL,
  `staff_id` int(8) NOT NULL,
  `schedule_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  KEY `schedule_id` (`schedule_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_master`
--

CREATE TABLE IF NOT EXISTS `schedule_master` (
  `schedule_id` int(8) NOT NULL AUTO_INCREMENT,
  `group_id` int(8) NOT NULL,
  `date_created` date NOT NULL,
  `term_id` int(8) NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `term_id` (`term_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(5, 14, 'WATER SAFETY', 'LEARN POOL SAFETY RULES'),
(12, 19, 'test', 'test'),
(12, 20, 'test1', 'test1'),
(13, 15, '0', '');

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
(15, 1, 'Mew', 'Skill'),
(13, 1, 'My', 'Skill'),
(1, 1, 'One', 'Beginner'),
(12, 1, 'test', 'test'),
(14, 1, 'tested', 'test'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_mname`, `staff_lname`, `home_number`, `mobile_number`, `emg_contact_name`, `emg_contact_number`, `staff_email`, `active`) VALUES
(1, 'Daniel', '', 'Tupples', '', '', '', '', '', 1),
(2, 'KEONE', NULL, 'KEONE', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Neil', '', 'Neilsen', '', '', '', '', '', 1),
(4, 'LANI', NULL, 'LANI', NULL, NULL, NULL, NULL, NULL, 1),
(5, 'CAITLYN', '', 'CAITLYN', '', '', '', '', '', 1),
(6, 'EMILY', NULL, 'EMILY', NULL, NULL, NULL, NULL, NULL, 1),
(7, 'LEISA', '', 'LEISA', '', '', '', '', '', 0),
(8, 'Kaissar', '', 'Shalabayev', '', '', '', '', '', 1),
(14, '1q2w3e', '', '1q2w3e', '', '', '', '', '', 1);

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
  UNIQUE KEY `term_description` (`term_description`),
  UNIQUE KEY `start_date` (`start_date`,`end_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `term_description`, `start_date`, `end_date`) VALUES
(1, 'Term 4', '2014-10-06', '2014-12-13'),
(2, 'Term 2', '2013-01-01', '2013-04-30'),
(3, 'test', '2014-08-01', '2014-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `staff_id` int(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`),
  KEY `passwords_ibfk_1` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`staff_id`, `username`, `type`, `password`) VALUES
(1, 'dtupples', 'administrator', 'dtupples'),
(2, 'keone', 'staff', ''),
(3, 'nell', 'staff', 'pgWwXpzkQPSGfqaKlGAsgk4u/'),
(4, 'lani', 'staff', ''),
(5, 'caitlyn', 'staff', ''),
(6, 'emily', 'staff', ''),
(7, 'leisa', 'staff', ''),
(8, 'kshalabaev', 'staff', 'PvAQd7ZAXWGFv0KdnbrMUEaV4');

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
  ADD CONSTRAINT `medical_conditions_details_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `medical_conditions_details_ibfk_2` FOREIGN KEY (`medical_condition_id`) REFERENCES `medical_conditions_master` (`medical_condition_id`);

--
-- Constraints for table `members_progress`
--
ALTER TABLE `members_progress`
  ADD CONSTRAINT `members_progress_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `members_progress_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `skills_details` (`task_id`),
  ADD CONSTRAINT `members_progress_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `members_skills`
--
ALTER TABLE `members_skills`
  ADD CONSTRAINT `members_skills_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `members_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills_master` (`skill_id`);

--
-- Constraints for table `payments_details`
--
ALTER TABLE `payments_details`
  ADD CONSTRAINT `payments_details_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments_master` (`payment_id`);

--
-- Constraints for table `payments_master`
--
ALTER TABLE `payments_master`
  ADD CONSTRAINT `payments_master_ibfk_2` FOREIGN KEY (`term_id`) REFERENCES `terms` (`term_id`),
  ADD CONSTRAINT `payments_master_ibfk_4` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`),
  ADD CONSTRAINT `payments_master_ibfk_5` FOREIGN KEY (`member_id`) REFERENCES `registrations_details` (`member_id`),
  ADD CONSTRAINT `payments_master_ibfk_6` FOREIGN KEY (`registration_id`) REFERENCES `registrations_master` (`registration_id`);

--
-- Constraints for table `registrations_details`
--
ALTER TABLE `registrations_details`
  ADD CONSTRAINT `registrations_details_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations_master` (`registration_id`);

--
-- Constraints for table `schedule_details`
--
ALTER TABLE `schedule_details`
  ADD CONSTRAINT `schedule_details_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `schedule_details_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_master` (`schedule_id`);

--
-- Constraints for table `schedule_master`
--
ALTER TABLE `schedule_master`
  ADD CONSTRAINT `schedule_master_ibfk_2` FOREIGN KEY (`term_id`) REFERENCES `terms` (`term_id`),
  ADD CONSTRAINT `schedule_master_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups_master` (`group_id`);

--
-- Constraints for table `skills_details`
--
ALTER TABLE `skills_details`
  ADD CONSTRAINT `skills_details_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skills_master` (`skill_id`);

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