-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 08:42 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empattendanceci`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `academic_id` bigint(20) NOT NULL,
  `academic_name` varchar(100) NOT NULL,
  `academic_code` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `body` varchar(225) NOT NULL,
  `file` varchar(200) NOT NULL,
  `date` varchar(225) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `body`, `file`, `date`, `status`) VALUES
(46, 'Mass Hiring 2022', 'We are looking for aspiring candidate for the position for IT Head Department.', 'file_name', '', 0),
(50, '3', '', 'file_name', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `username` char(6) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL,
  `shift_id` int(1) NOT NULL,
  `location_id` int(1) NOT NULL,
  `in_time` int(11) NOT NULL,
  `notes` varchar(120) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lack_of` varchar(11) NOT NULL,
  `in_status` varchar(15) NOT NULL,
  `out_time` int(11) NOT NULL,
  `out_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `employee_id`, `department_id`, `shift_id`, `location_id`, `in_time`, `notes`, `image`, `lack_of`, `in_status`, `out_time`, `out_status`) VALUES
(45, 'ADM011', 011, 'ADM', 1, 1, 0, 'sdf', 'item-200511-8f5d7be1a1.jpg', 'None', 'Late', 0, 'Early'),
(48, 'ADM011', 011, 'ADM', 1, 1, 0, '', 'item-200513-ad6953a07e.jpg', 'Notes', 'Late', 0, 'Over Time'),
(49, 'PCD010', 010, 'PCD', 2, 1, 0, 'asdasd', '', 'None,image', 'Late', 0, 'Over Time'),
(50, 'ADM011', 011, 'ADM', 1, 1, 0, '', '', 'Notes,image', 'On Time', 0, 'Early'),
(51, 'PCD010', 010, 'PCD', 3, 1, 0, 'testing', 'item-210601-3946bb00df.png', 'None', 'Late', 0, 'Over Time'),
(52, 'PCD010', 010, 'PCD', 3, 2, 0, 'none', '', 'None,image', 'Late', 0, 'Over Time'),
(53, 'STD026', 026, 'STD', 1, 1, 0, 'none', '', 'None,image', 'Late', 0, 'Over Time'),
(54, 'ADM011', 011, 'ADM', 1, 2, 0, 'demo', '', 'None,image', 'Late', 0, 'Over Time'),
(55, 'QCD027', 027, 'QCD', 6, 2, 0, 'none..', '', 'None,image', 'Late', 0, 'Early'),
(56, 'QCD027', 027, 'QCD', 6, 2, 0, 'none', '', 'None,image', 'Late', 0, 'Early'),
(58, 'QCD027', 027, 'QCD', 6, 1, 0, 'none', '', 'None,image', 'Late', 0, 'Early'),
(59, 'QCD027', 027, 'QCD', 6, 4, 0, 'none', '', 'None,image', 'Late', 0, 'Early'),
(60, 'QCD027', 027, 'QCD', 6, 1, 0, 'none', '', 'None,image', 'Late', 0, 'Over Time'),
(61, 'STD026', 026, 'STD', 1, 2, 0, 'none', '', 'None,image', 'On Time', 0, 'Over Time'),
(62, 'ADM011', 011, 'ADM', 1, 1, 0, 'none', '', 'None,image', 'Late', 0, 'Over Time'),
(63, 'QCD027', 027, 'QCD', 6, 2, 0, 'this is a demo note!', '', 'None,image', 'Late', 0, 'Early'),
(64, 'ACD002', 002, 'ACD', 2, 3, 0, 'demo demo', '', 'None,image', 'On Time', 0, 'Early'),
(65, 'STD026', 026, 'STD', 1, 2, 0, 'test', '', 'None,image', 'Late', 0, 'Early'),
(66, 'SCD004', 004, 'SCD', 3, 1, 0, 'dito me sa bahay', '', 'None,image', 'Late', 0, 'Over Time'),
(110, 'STD009', 009, 'STD', 2, 1, 0, '', '', 'Notes,image', 'On Time', 0, 'Early'),
(119, 'ACD036', 036, 'ACD', 1, 1, 1646036340, '', '', 'Notes,image', 'Late', 1646036340, 'Over Time'),
(126, 'STD009', 009, 'STD', 2, 1, 1646701068, '', '', 'Notes,image', 'On Time', 1646701165, 'Early'),
(127, 'PLD007', 007, 'PLD', 2, 2, 1650877866, '', '', 'Notes,image', 'Late', 1650877870, 'Over Time'),
(128, 'PLD007', 007, 'PLD', 2, 1, 1665501012, '', '', 'Notes,image', 'Late', 1665501016, 'Early');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `time_in` varchar(25) NOT NULL,
  `time_out` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `timein_status` varchar(25) NOT NULL,
  `timeout_status` varchar(25) NOT NULL,
  `late_duration` varchar(25) NOT NULL,
  `undertime_duration` varchar(25) NOT NULL,
  `overtime_duration` varchar(25) NOT NULL,
  `total_render` varchar(25) NOT NULL,
  `location` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `id` char(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `educational_info`
--

CREATE TABLE `educational_info` (
  `educ_id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `bachelor_degree` varchar(100) NOT NULL,
  `bs_year` varchar(100) NOT NULL,
  `bs_school` varchar(100) NOT NULL,
  `is_master` tinyint(4) NOT NULL,
  `is_doctorate` tinyint(4) NOT NULL,
  `is_other_degree` tinyint(4) NOT NULL,
  `master_degree` varchar(100) NOT NULL,
  `md_with` varchar(100) NOT NULL,
  `md_year` varchar(100) NOT NULL,
  `md_school` varchar(100) NOT NULL,
  `doctorate` varchar(100) NOT NULL,
  `d_with` varchar(100) NOT NULL,
  `d_year` varchar(100) NOT NULL,
  `d_school` varchar(100) NOT NULL,
  `other_degree` varchar(100) NOT NULL,
  `od_year` varchar(100) NOT NULL,
  `od_school` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_info`
--

INSERT INTO `educational_info` (`educ_id`, `employee_id`, `bachelor_degree`, `bs_year`, `bs_school`, `is_master`, `is_doctorate`, `is_other_degree`, `master_degree`, `md_with`, `md_year`, `md_school`, `doctorate`, `d_with`, `d_year`, `d_school`, `other_degree`, `od_year`, `od_school`, `created_at`) VALUES
(0, 1, 'BS CS', '2019', 'CVSU', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-11 17:31:56'),
(0, 30, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-11 17:35:16'),
(0, 31, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-13 10:16:05'),
(0, 32, 'asdasd', '232', '123asdfas', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-13 12:19:42'),
(0, 33, 'asdasd', '232', 'asdasd', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-13 12:20:58'),
(0, 34, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-15 23:17:26'),
(0, 35, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-01-16 16:57:02'),
(0, 36, 'CVSU', '2019', 'cabvitye', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-02-28 11:27:43'),
(0, 37, 'Bachelors Of Science in Information Technology', '2018-2022', 'Cavite State University, Bacoor Campus City', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-05-05 20:52:16'),
(0, 38, 'BSCS', '2020', 'cvsu', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-10-08 11:32:52'),
(0, 39, 'test', '2020', 'test', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2022-10-14 08:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(1) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(50) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `image` varchar(128) NOT NULL,
  `birth_date` date NOT NULL,
  `hire_date` date NOT NULL,
  `shift_id` int(1) NOT NULL,
  `position_id` int(1) NOT NULL,
  `department_id` int(1) NOT NULL,
  `academic_id` int(1) NOT NULL,
  `place_birth` text NOT NULL,
  `type_emp` varchar(100) NOT NULL,
  `status_emp` varchar(100) NOT NULL,
  `plantilla` varchar(50) NOT NULL,
  `eligibility` varchar(50) NOT NULL,
  `tin_no` varchar(100) NOT NULL,
  `gsis_no` varchar(100) NOT NULL,
  `pagibig_no` varchar(100) NOT NULL,
  `bacherlor_degree` varchar(100) NOT NULL,
  `bs_year` varchar(100) NOT NULL,
  `bs_school` varchar(100) NOT NULL,
  `is_master` int(1) NOT NULL,
  `is_doctorate` int(1) NOT NULL,
  `is_other_degree` int(1) NOT NULL,
  `master` varchar(100) NOT NULL,
  `md_with` varchar(100) NOT NULL,
  `md_year` varchar(100) NOT NULL,
  `md_school` varchar(100) NOT NULL,
  `doctorate` varchar(100) NOT NULL,
  `dd_with` varchar(100) NOT NULL,
  `dd_year` varchar(100) NOT NULL,
  `dd_school` varchar(100) NOT NULL,
  `other_degree` int(11) NOT NULL,
  `other_year` int(11) NOT NULL,
  `other_school` int(11) NOT NULL,
  `created_att` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `middle_name`, `last_name`, `email`, `mobile_no`, `address`, `gender`, `image`, `birth_date`, `hire_date`, `shift_id`, `position_id`, `department_id`, `academic_id`, `place_birth`, `type_emp`, `status_emp`, `plantilla`, `eligibility`, `tin_no`, `gsis_no`, `pagibig_no`, `bacherlor_degree`, `bs_year`, `bs_school`, `is_master`, `is_doctorate`, `is_other_degree`, `master`, `md_with`, `md_year`, `md_school`, `doctorate`, `dd_with`, `dd_year`, `dd_school`, `other_degree`, `other_year`, `other_school`, `created_att`, `is_active`) VALUES
(25, 'Admin ', '', '', 'admin@admin.com', '', '', 'Male', 'default.png', '0000-00-00', '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', 0, 0, 0, '2022-10-15 09:21:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(3) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `employee_id`, `department_id`) VALUES
(1, 001, 'HRD'),
(2, 002, 'ACD'),
(3, 003, 'QCD'),
(4, 004, 'SCD'),
(5, 005, 'STD'),
(6, 006, 'ACD'),
(7, 007, 'PLD'),
(8, 008, 'STD'),
(9, 009, 'STD'),
(10, 010, 'PCD'),
(21, 011, 'ADM'),
(25, 024, 'HRD'),
(26, 026, 'STD'),
(27, 027, 'QCD'),
(28, 029, 'QCD'),
(29, 030, 'QCD'),
(30, 031, 'PLD'),
(33, 034, 'PCD'),
(34, 035, 'PCD'),
(35, 036, 'ACD'),
(36, 037, 'ADM'),
(37, 038, 'ACD'),
(38, 039, 'STD');

-- --------------------------------------------------------

--
-- Table structure for table `e_requestfile`
--

CREATE TABLE `e_requestfile` (
  `id` int(11) NOT NULL,
  `employee_id` int(25) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notif` int(1) NOT NULL DEFAULT 0,
  `readnotif` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `sent_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `e_requestfile`
--

INSERT INTO `e_requestfile` (`id`, `employee_id`, `filetype`, `description`, `reason`, `date`, `notif`, `readnotif`, `status`, `sent_status`) VALUES
(56, 50, 'JPEG/PNG', 'test', 'ayaw ko nga kulit', '2022-12-06 10:48:11', 1, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `e_uploadfile`
--

CREATE TABLE `e_uploadfile` (
  `id` int(11) NOT NULL,
  `employee_id` int(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notif` int(1) NOT NULL DEFAULT 0,
  `readnotif` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `notes` text NOT NULL,
  `file` varchar(200) CHARACTER SET latin1 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `employee_id`, `notes`, `file`, `status`, `created_at`) VALUES
(60, 0, 'dasdasasas', '', 1, '2022-05-10 05:05:17'),
(61, 2, 'sdsdsdsd', '', 1, '2022-05-10 05:05:59'),
(62, 1, 'asaasas', 'default.png', 1, '2022-05-10 05:20:43'),
(63, 3, 'sdssd', 'default.png', 1, '2022-05-10 06:19:05'),
(64, 1, 'sasasa', 'DTR5.docx', 1, '2022-05-11 17:13:25'),
(65, 1, 'asasasas', 'default.png', 1, '2022-05-11 17:17:57'),
(66, 2, 'asasas', 'INTERNETAPPLICATION.docx', 1, '2022-05-13 05:29:30'),
(67, 3, '', 'Rosemarie_samson_ojt_resume.docx', 1, '2022-05-13 05:30:45'),
(68, 5, '', 'FLOWCHART.docx', 1, '2022-05-13 05:32:00'),
(69, 5, '', 'Rosemarie_samson_ojt_resume1.docx', 1, '2022-05-13 05:34:57'),
(70, 3, '', 'CV-SAMSON.docx', 1, '2022-05-13 05:38:08'),
(71, 5, '', 'Evaluation-for-OJT-Practicum-2nd-SEM.docx', 1, '2022-05-13 12:17:52'),
(72, 3, '', 'SAMSON_DTR_(1).docx', 1, '2022-05-13 12:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `filesubmit`
--

CREATE TABLE `filesubmit` (
  `id` int(11) NOT NULL,
  `employee_id` int(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notif` int(1) NOT NULL DEFAULT 0,
  `readnotif` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `e_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fileupload`
--

CREATE TABLE `fileupload` (
  `id` int(11) NOT NULL,
  `employee_id` int(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notif` int(1) NOT NULL DEFAULT 0,
  `readnotif` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(20) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `position_code` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `major` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `major`) VALUES
(1, '                                                                     \r\n                              <strong>Copyright &copy; 2022 Powered by: <a href=\'https://cvsu.edu.ph/bacoor/\'>CVSU Bacoor</a>.</strong> All rights reserved. Designed by - <a style=\'color: #3b3b3b\' href=\'https://github.com/elvinpaz\'>EPAZ</a>');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `day` varchar(150) NOT NULL,
  `meridian` varchar(100) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `schedule_start` longtext NOT NULL,
  `schedule_end` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `employee_id`, `day`, `meridian`, `start_time`, `end_time`, `schedule_start`, `schedule_end`, `status`, `created_at`) VALUES
(26, 1, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"04:15\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"02:36\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-11 14:28:05'),
(27, 3, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"12:21\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-05-12 15:39:34'),
(45, 9, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"22:05\",\"Tuesday\":\"19:05\",\"Wednesday\":\"09:05\",\"Thursday\":\"12:05\",\"Friday\":\"11:05\",\"Saturday\":\"09:50\"}]', '[{\"Monday\":\"22:05\",\"Tuesday\":\"23:05\",\"Wednesday\":\"14:05\",\"Thursday\":\"18:05\",\"Friday\":\"14:06\",\"Saturday\":\"17:06\"}]', 0, '2022-05-12 15:39:42'),
(46, 6, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"10:14\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"07:09\",\"Saturday\":\"12:14\"}]', '[{\"Monday\":\"13:14\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"07:09\",\"Saturday\":\"15:14\"}]', 0, '2022-05-12 15:39:38'),
(48, 36, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"08:55\",\"Tuesday\":\"09:55\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"13:55\",\"Tuesday\":\"13:55\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-11 14:26:42'),
(49, 7, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"12:00\",\"Tuesday\":\"08:10\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"17:00\",\"Tuesday\":\"23:15\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-11 15:08:57'),
(50, 38, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"06:00\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"05:00\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-12 16:37:24'),
(51, 2, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"08:08\",\"Tuesday\":\"08:08\",\"Wednesday\":\"08:08\",\"Thursday\":\"08:08\",\"Friday\":\"08:08\",\"Saturday\":\"08:08\"}]', '[{\"Monday\":\"20:08\",\"Tuesday\":\"20:08\",\"Wednesday\":\"20:08\",\"Thursday\":\"20:08\",\"Friday\":\"20:08\",\"Saturday\":\"20:08\"}]', 0, '2022-10-11 15:49:29'),
(52, 0, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-12 16:57:05'),
(53, 39, '', '', '00:00:00', '00:00:00', '[{\"Monday\":\"01:00\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', '[{\"Monday\":\"12:00\",\"Tuesday\":\"\",\"Wednesday\":\"\",\"Thursday\":\"\",\"Friday\":\"\",\"Saturday\":\"\"}]', 0, '2022-10-14 00:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sched_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` varchar(25) NOT NULL,
  `day` varchar(25) NOT NULL,
  `start` varchar(25) NOT NULL,
  `end` varchar(25) NOT NULL,
  `week` varchar(25) DEFAULT NULL,
  `bill` int(5) NOT NULL,
  `status` varchar(25) NOT NULL,
  `options` varchar(25) NOT NULL,
  `opt_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(1) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `start`, `end`, `status`) VALUES
(1, '08:00:00', '16:00:00', 1),
(2, '13:00:00', '21:00:00', 1),
(3, '18:00:00', '02:00:00', 1),
(4, '03:15:02', '02:05:05', 1),
(5, '07:00:00', '18:25:00', 1),
(6, '01:00:00', '12:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL,
  `has_account` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `employee_id`, `role`, `created_at`, `status`, `has_account`) VALUES
(1, 'admin@admin.com', 'Password@123', 25, 'Admin', '2022-10-25 12:01:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `employee_id`, `role_id`, `created_at`, `status`) VALUES
('ACD002', '$2y$10$5nv5ehyMVdljfKJ6izsOqOimsbv.cbzU.XLB9ji9zbA.eICdSrNvO', 2, 2, '2021-09-11 09:47:23', 1),
('ACD006', '$2y$10$ZtCSdxUEx2iUSL1TAly7luba6d/XHEyX752FvzXuCBn4hNMbMaKZi', 6, 2, '2022-05-05 12:47:26', 1),
('ACD036', '$2y$10$cGi/yj5QRL72Br67JQBtQOuPYcGwt/31PMekjOLMUEjVN.LkstG2W', 36, 2, '2022-02-28 03:56:38', 1),
('ADM011', '$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC', 11, 2, '2021-01-11 09:47:23', 1),
('ADM037', '$2y$10$ZTIB1t.5t4ERIH1ECOmeb.p7ks1n08vydFUURlQObtDD1b942FoZq', 37, 1, '2022-05-05 12:52:58', 1),
('ADM038', '$2y$10$qzqd9/H/cAK/7alZQV5nGelXYwzaYpqaSN0rtI60TbORzedQtVxiS', 38, 1, '2022-10-08 05:27:36', 1),
('admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', 25, 1, '2021-10-11 09:47:23', 1),
('HRD001', '$2y$10$s9d3si8KzkXwKGpDoqwE5.S6sn563Zirrns6oe7U0KborVKtMFuEW', 1, 2, '2021-04-11 09:47:23', 0),
('HRD024', '$2y$10$eB5hs1eJ0vhV//mIFTV.TuhUt/i82PSwKZqCPEBJ6JjwoqqzenjsK', 24, 2, '2022-05-03 15:14:55', 1),
('PCD010', '$2y$10$IEOvsQXHKIA8qePv64e7L./m5qh18ND/uZVik8Nt.m7nwW1s.uCAG', 10, 2, '2021-08-11 09:47:23', 1),
('PLD007', '$2y$10$Ln.oC3A/cQSYSanOSvt15epZJ82t9ojIiG6N2PSJUKsHDl3jIxh7S', 7, 2, '2022-04-25 09:09:51', 1),
('QCD00A', '$2y$10$zbdQvXLFHoujaUsl0P3sUOScu23p.bwho2KTZbEacIdpKhPhqErl.', 3, 2, '2022-02-17 10:06:25', 1),
('QCD027', '$2y$10$peALJo.JKZyD6uMBd41UfuHGQSJe7ExOfDhPITvDbSRRXeWUGY9xy', 27, 2, '2022-01-11 09:47:23', 1),
('QCD029', '$2y$10$rMuNYiFgLnhB7gX/m1A63ekGA8MI51nqYc.3xeL4zLEKMXgUdKiKK', 29, 2, '2022-05-05 12:55:34', 1),
('rosesa', 'zxcvbn', 0, 0, '2022-05-05 13:05:34', 1),
('SCD004', '$2y$10$es7Ni7mlMM5Zdr3yF6JWd.dRck8He67VO.TSWXyw25GHkbYf/s7WG', 4, 2, '2022-01-11 09:47:23', 1),
('STD005', '$2y$10$hr35h1fIySFYCSRVL2jRD.RuYa9WtJCEJkkqvQfPboYK7VwURpLim', 5, 2, '2022-01-11 09:47:23', 1),
('STD008', '$2y$10$8PGnFaiZPYtcIGrwzMmVZuNKbUb/A88f0NZOA9QVgHaUIJ6ddg.Si', 8, 2, '2022-01-11 09:47:23', 1),
('STD009', '$2y$10$Ba3xjuhrprakPHwwW7FZK./OK6/KcPiR2BNXGKQ5/PAqnl.WAJStS', 9, 2, '2022-02-17 15:55:08', 1),
('STD026', '$2y$10$8WNMvEEgNPWyRuSeeLDE1uXwnBkYNJE/heLT1zWbsUfYb/wKFyYIy', 26, 2, '2022-01-11 09:47:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(2) NOT NULL,
  `role_id` int(1) NOT NULL,
  `menu_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 5),
(6, 2, 6),
(7, 1, 7),
(10, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(2) NOT NULL,
  `menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Master'),
(3, 'Attendance'),
(4, 'Files'),
(5, 'Report'),
(6, 'Profile'),
(7, 'Announcement'),
(9, 'Emp_Announcement');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

CREATE TABLE `user_submenu` (
  `id` int(2) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Department', 'master', 'fas fa-fw fa-building', 1),
(3, 2, 'Schedule', 'master/shift', 'fas fa-fw fa-exchange-alt', 1),
(4, 2, 'Employee', 'master/employee', 'fas fa-fw fa-id-badge', 1),
(5, 2, 'Location', 'master/location', 'fas fa-fw fa-map-marker-alt', 1),
(6, 3, 'Attendance Form', 'attendance', 'fas fa-fw fa-clipboard-list', 1),
(7, 3, 'Statistics', 'attendance/stats', 'fas fa-fw fa-chart-pie', 0),
(8, 4, 'My Files', 'files', 'fa fa-files-o', 1),
(9, 2, 'Designation', 'master/designation', 'fa fa-suitcase', 1),
(11, 5, 'Files', 'report/file', 'fa fa-file', 1),
(12, 2, 'Users', 'master/users', 'fas fa-fw fa-users', 1),
(13, 5, 'Print Report', 'report', 'fas fa-fw fa-paste', 1),
(14, 2, 'Academic Rank', 'master/academic', 'fa fa-industry', 1),
(15, 5, 'Database Backup', 'report/database', 'fa fa-database', 1),
(16, 6, 'My Profile', 'profile', 'fas fa-fw fa-id-card', 1),
(18, 7, 'Announcement', 'announcement', 'fa fa-bullhorn', 1),
(21, 9, 'Emp_Announcement', 'emp_announcement', 'fa fa-bullhorn', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`academic_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_department_ibfk_1` (`employee_id`),
  ADD KEY `employee_department_ibfk_2` (`department_id`);

--
-- Indexes for table `e_requestfile`
--
ALTER TABLE `e_requestfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_uploadfile`
--
ALTER TABLE `e_uploadfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `filesubmit`
--
ALTER TABLE `filesubmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileupload`
--
ALTER TABLE `fileupload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `academic_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `e_requestfile`
--
ALTER TABLE `e_requestfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `e_uploadfile`
--
ALTER TABLE `e_uploadfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `filesubmit`
--
ALTER TABLE `filesubmit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `fileupload`
--
ALTER TABLE `fileupload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_submenu`
--
ALTER TABLE `user_submenu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
