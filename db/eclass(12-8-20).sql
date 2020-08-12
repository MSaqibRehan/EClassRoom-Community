-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 07:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `verification` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`, `added_by`, `date`, `verification`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin', '0000-00-00 00:00:00', 335316);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announce_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sem_sub_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `announcement` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announce_id`, `course_p_id`, `session_id`, `semester_id`, `sem_sub_id`, `teacher_id`, `announcement`, `status`, `created_at`) VALUES
(1, 1, 1, 8, 2, 13, 'heloooo ', 'Active', '2020-07-06 15:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_remarks`
--

CREATE TABLE `assignment_remarks` (
  `assign_remark_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `assign_sub_id` int(11) NOT NULL,
  `obt_marks` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_remarks`
--

INSERT INTO `assignment_remarks` (`assign_remark_id`, `assign_id`, `assign_sub_id`, `obt_marks`, `remarks`, `created_at`) VALUES
(4, 3, 2, '12', 'super duper', '2020-07-05 03:08:32'),
(5, 3, 2, '12', ' sdsa sasada aassad as', '2020-07-05 02:49:44'),
(6, 4, 7, '12', 'tstyt y t', '2020-07-05 14:12:16'),
(7, 1, 8, '12', 'dfs dfs df', '2020-07-05 14:26:51'),
(8, 1, 9, '12', 'asdasd', '2020-08-12 01:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submit`
--

CREATE TABLE `assignment_submit` (
  `assign_sub_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `attach_file` varchar(255) NOT NULL,
  `submit_date` datetime NOT NULL,
  `status` enum('Unmarked','Marked') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_submit`
--

INSERT INTO `assignment_submit` (`assign_sub_id`, `assign_id`, `std_id`, `attach_file`, `submit_date`, `status`) VALUES
(2, 3, 3, 'hci.docx', '2020-07-02 02:44:22', ''),
(7, 4, 3, 'assignment_1.docx', '2020-07-05 14:11:49', ''),
(8, 1, 3, 'assignment.pdf', '2020-07-05 14:26:31', ''),
(9, 1, 4, 'jobb.pdf', '2020-08-12 01:25:38', '');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_upload`
--

CREATE TABLE `assignment_upload` (
  `assign_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sem_sub_id` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `c_p_id` int(11) NOT NULL,
  `assign_no` int(11) NOT NULL,
  `assign_title` varchar(200) NOT NULL,
  `assign_file` varchar(255) NOT NULL,
  `assign_note` text DEFAULT NULL,
  `due_date` date NOT NULL,
  `total_marks` varchar(20) NOT NULL,
  `status` enum('Active','Closed') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_upload`
--

INSERT INTO `assignment_upload` (`assign_id`, `session_id`, `semester_id`, `sem_sub_id`, `uploaded_by`, `c_p_id`, `assign_no`, `assign_title`, `assign_file`, `assign_note`, `due_date`, `total_marks`, `status`, `created_at`) VALUES
(1, 1, 8, 2, 13, 1, 1, 'asddd', 'asddd.docx', 'gfh fghf', '2020-06-29', '15', 'Active', '2020-06-27 10:06:03'),
(2, 1, 8, 2, 13, 1, 2, 'Demo test', 'Demo_test.docx', 'ssjkans kjask ', '2020-06-30', '15', 'Active', '2020-06-29 08:06:43'),
(3, 1, 8, 2, 10, 1, 3, 'test assignment', 'test_assignment.docx', ' fgdfgdfg dfgdfg dfgd g', '2020-07-01', '15', 'Active', '2020-06-30 01:18:33'),
(4, 1, 8, 3, 13, 1, 4, 'teeeeeeeee', 'teeeeeeeee.docx', ' jkj k k k', '2020-07-15', '15', 'Active', '2020-07-05 11:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `date`, `name`, `creator`) VALUES
(6, '2018-09-16 20:55:24', 'test', 'admin'),
(7, '2018-09-16 20:55:30', 'dummy', 'admin'),
(8, '2020-06-22 02:36:37', 'test1', 'admin1'),
(9, '2020-08-11 22:52:55', 'php', 'saqib');

-- --------------------------------------------------------

--
-- Table structure for table `class_handouts`
--

CREATE TABLE `class_handouts` (
  `handout_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sem_sub_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `lecture` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_handouts`
--

INSERT INTO `class_handouts` (`handout_id`, `course_p_id`, `session_id`, `semester_id`, `sem_sub_id`, `week`, `lecture`, `topic`, `file`, `description`, `created_by`, `created_at`) VALUES
(1, 1, 1, 8, 2, 1, 1, 'Image Formate', 'Image Formate', 'Image Formate', 6, '2020-07-01 23:04:54'),
(2, 1, 1, 8, 2, 2, 1, 'pata nai', 'pata nai', 'pata nai', 6, '2020-07-02 01:36:48'),
(3, 1, 1, 8, 2, 3, 1, 'a', 'a', 'a', 6, '2020-07-03 22:47:43'),
(4, 1, 1, 8, 2, 4, 1, 'b', 'b', 'b', 6, '2020-07-03 22:50:27'),
(5, 1, 1, 8, 2, 5, 1, 'c', 'c', 'c', 6, '2020-07-03 22:50:27'),
(6, 1, 1, 8, 2, 7, 1, 'e', 'e', 'e', 6, '2020-07-03 22:51:35'),
(7, 1, 1, 8, 2, 6, 1, 'd', 'd', 'd', 6, '2020-07-03 22:52:40'),
(8, 1, 1, 8, 2, 8, 1, 'f', 'f', 'f', 6, '2020-06-25 12:40:31'),
(9, 1, 1, 8, 2, 9, 1, 'g', 'g', 'g', 6, '2020-06-25 19:52:18'),
(10, 1, 1, 8, 2, 10, 1, 'h', 'h', 'h', 6, '2020-06-25 12:40:31'),
(11, 1, 1, 8, 2, 11, 1, 'i', 'i', 'i', 6, '2020-06-25 19:52:18'),
(12, 1, 1, 8, 2, 12, 1, 'j', 'j', 'j', 6, '2020-06-25 12:40:31'),
(13, 1, 1, 8, 2, 13, 1, 'k', 'k', 'k', 6, '2020-06-25 19:52:18'),
(14, 1, 1, 8, 2, 14, 1, 'l', 'l', 'l', 6, '2020-06-25 12:40:31'),
(15, 1, 1, 8, 2, 15, 1, 'm', 'm', 'm', 6, '2020-06-25 19:52:18'),
(16, 1, 1, 8, 2, 16, 1, 'n', 'n', 'n', 6, '2020-06-25 12:40:31'),
(17, 1, 1, 8, 2, 1, 2, 'This is lecture 2', 'This is lecture 2', 'This is lecture 2', 6, '2020-06-25 19:52:18'),
(18, 1, 1, 8, 2, 2, 2, 'dsa', 'Annotation 2020-03-08 190420.jpg', 'hgerget', 6, '2020-07-06 09:53:49'),
(19, 1, 1, 8, 2, 3, 2, 'qwertyuio', 'Annotation 2020-05-22 112531.jpg', 'qwertyuiop', 6, '2020-07-06 10:17:00'),
(20, 1, 1, 8, 2, 4, 2, 'khan', 'Annotation 2020-03-18 174300.jpg', 'qwertyuiop[', 6, '2020-07-06 10:18:22'),
(21, 1, 1, 8, 2, 5, 2, 'Dip', 'image-6.png', 'qwertyuiop[', 6, '2020-07-06 12:13:47'),
(22, 1, 1, 8, 2, 6, 2, 'df dsf xc', 'HCI MCQS.docx', 'd fds fdsf sdf ds', 6, '2020-07-06 13:05:59'),
(23, 1, 1, 4, 3, 1, 1, 'ota ni', 'HCI MCQS.docx', 'ds fsdfsd fds', 6, '2020-07-06 13:06:22'),
(24, 1, 1, 4, 3, 1, 2, 'sad sa', 'HCI MCQS.docx', 'dsf dsf ds', 6, '2020-07-06 13:06:35'),
(25, 1, 1, 4, 3, 2, 1, 'test file', 'test_file_week_2_lecture_1.pdf', 'this is tesst description', 6, '2020-08-12 09:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_program`
--

CREATE TABLE `course_program` (
  `cp_id` int(11) NOT NULL,
  `cp_name` varchar(200) NOT NULL,
  `no_of_semesters` int(2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_program`
--

INSERT INTO `course_program` (`cp_id`, `cp_name`, `no_of_semesters`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'BSCS', 8, 'Active', 1, '2020-06-15 20:05:14', 0, '0000-00-00 00:00:00'),
(2, 'BBA', 8, 'Active', 1, '2020-06-15 20:05:29', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sender_name` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `course_p_id`, `session_id`, `semester_id`, `sender_name`, `message`, `created_at`) VALUES
(1, 2, 1, 8, 5, 'hello this is saqib', '2020-06-19 01:55:19'),
(2, 1, 1, 8, 4, 'hello ', '2020-06-18 01:55:19'),
(3, 2, 1, 8, 5, 'hello this is saqib', '2020-06-19 01:55:19'),
(4, 1, 1, 8, 5, 'hello this is 1', '2020-06-19 01:55:19'),
(5, 1, 1, 8, 4, 'hello this is 2', '2020-06-19 01:55:19'),
(6, 1, 1, 8, 5, 'hello this is 3 ', '2020-06-19 01:55:19'),
(7, 1, 1, 8, 4, 'hello this is 4', '2020-06-19 01:55:19'),
(8, 1, 1, 8, 3, 'hello this is 5 ', '2020-06-19 01:55:19'),
(9, 1, 1, 8, 5, 'hello this is 6', '2020-06-19 01:55:19'),
(11, 1, 1, 8, 5, 'hello this is 1', '2020-06-19 01:55:19'),
(12, 1, 1, 8, 4, 'hello this is 2', '2020-06-19 01:55:19'),
(13, 1, 1, 8, 5, 'hello this is 3 ', '2020-06-19 01:55:19'),
(14, 1, 1, 8, 4, 'hello this is 4', '2020-06-19 01:55:19'),
(15, 1, 1, 8, 3, 'hello this is 5 ', '2020-06-19 01:55:19'),
(16, 1, 1, 8, 5, 'hello this is 6', '2020-06-19 01:55:19'),
(18, 1, 1, 8, 5, 'hello this is 1', '2020-06-19 01:55:19'),
(19, 1, 1, 8, 4, 'hello this is 2', '2020-06-19 01:55:19'),
(20, 1, 1, 8, 5, 'hello this is 3 ', '2020-06-19 01:55:19'),
(21, 1, 1, 8, 4, 'hello this is 4', '2020-06-19 01:55:19'),
(22, 1, 1, 8, 3, 'hello this is 5 ', '2020-06-19 01:55:19'),
(23, 1, 1, 8, 5, 'hello this is 6', '2020-06-19 01:55:19'),
(24, 1, 1, 8, 4, 'hello this is 66', '2020-06-19 01:55:19'),
(25, 1, 1, 8, 2, 'hello this is 7', '2020-06-19 01:55:19'),
(26, 1, 1, 8, 4, 'hello this is 8', '2020-06-19 01:55:19'),
(27, 1, 1, 8, 5, 'hello this is 9', '2020-06-19 01:55:19'),
(28, 1, 1, 8, 4, 'hello this is 0', '2020-06-19 01:55:19'),
(29, 1, 1, 8, 5, 'hello this is 11', '2020-06-19 01:55:19'),
(30, 1, 1, 8, 5, 'hello this is 12', '2020-06-19 01:55:19'),
(31, 1, 1, 8, 5, 'hello this is 13', '2020-06-19 01:55:19'),
(32, 1, 1, 8, 5, 'hello this is 14', '2020-06-19 01:55:19'),
(33, 1, 1, 8, 5, 'hello this is 15', '2020-06-19 01:55:19'),
(34, 1, 1, 8, 5, 'ds sfdsf', '2020-06-27 02:32:38'),
(35, 1, 1, 8, 5, 'dfdsfsdf sdf sdfsadf sdf sadf ', '2020-06-27 02:33:00'),
(36, 1, 1, 8, 5, 'dsfdsfsdf sdfsfsf sfsd sdf', '2020-06-27 02:33:44'),
(37, 1, 1, 8, 5, 'hi this is test message at 2:34', '2020-06-27 02:34:14'),
(38, 1, 1, 8, 5, 'sadfsdf ', '2020-06-27 02:35:03'),
(39, 1, 1, 8, 5, 'dsfdsf', '2020-06-27 02:35:13'),
(40, 1, 1, 8, 5, 'dsfds', '2020-06-27 02:36:10'),
(41, 1, 1, 8, 5, 'dsf sd', '2020-06-27 18:25:07'),
(42, 1, 1, 8, 5, 'bnbn', '2020-06-27 18:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1590136774),
('m130524_201442_init', 1590136788),
('m190124_110200_add_verification_token_column_to_user_table', 1590136790);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `category`, `author`, `content`, `author_email`) VALUES
(19, '2020-07-13 17:40:17', 'sadsad', 'test', 'saqib Rehan', 'hello this ', 'saqibrehan587@gmail.com'),
(20, '2020-08-11 22:52:55', 'what is', 'php', 'saqib', 'what is php', 'saqibrehan587@gmail.com'),
(21, '2020-08-11 22:57:42', 'about php', 'php', 'rehan', 'what is php and how does it work', 'saqibrehan2007@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `quizz_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sem_sub_id` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `quizz_no` int(11) NOT NULL,
  `quizz_title` varchar(255) NOT NULL,
  `quizz_file` varchar(255) NOT NULL,
  `quizz_note` text DEFAULT NULL,
  `total_marks` varchar(20) NOT NULL,
  `status` enum('Active','Closed') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`quizz_id`, `course_p_id`, `session_id`, `semester_id`, `sem_sub_id`, `uploaded_by`, `quizz_no`, `quizz_title`, `quizz_file`, `quizz_note`, `total_marks`, `status`, `created_at`) VALUES
(1, 1, 1, 8, 2, 13, 1, 'testtt', 'testtt.docx', ' dsfds ds fdsfsdf dsfsdf sdf', '15', 'Active', '2020-07-03 10:07:18'),
(2, 1, 1, 8, 2, 10, 2, 'sad asd as', 'sad_asd_as.jpg', 'sa sad', '123', 'Active', '2020-07-06 12:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `quizz_remarks`
--

CREATE TABLE `quizz_remarks` (
  `quizz_remark_id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `obt_marks` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizz_remarks`
--

INSERT INTO `quizz_remarks` (`quizz_remark_id`, `quizz_id`, `std_id`, `remarks`, `obt_marks`, `created_at`) VALUES
(2, 1, 3, 'helloooo', '14', '2020-07-05 13:59:12'),
(3, 1, 4, 'asdas dad', '11', '2020-08-12 01:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_key`
--

CREATE TABLE `quiz_key` (
  `quiz_key_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_key`
--

INSERT INTO `quiz_key` (`quiz_key_id`, `quiz_id`, `quiz_key`) VALUES
(4, 1, 'testtt_key.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `semester_no` varchar(50) NOT NULL,
  `class_time` enum('Morning','Evening') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `course_p_id`, `semester_no`, `class_time`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '1', 'Morning', 1, '2020-06-15 20:50:06', 0, '0000-00-00 00:00:00'),
(2, 1, '2', 'Morning', 1, '2020-06-15 20:50:14', 0, '0000-00-00 00:00:00'),
(3, 1, '3', 'Morning', 1, '2020-06-15 20:50:20', 0, NULL),
(4, 1, '4', 'Morning', 1, '2020-06-15 20:50:38', 0, '0000-00-00 00:00:00'),
(5, 1, '5', 'Morning', 1, '2020-06-15 20:52:58', 0, '0000-00-00 00:00:00'),
(6, 1, '6', 'Morning', 1, '2020-06-15 20:53:05', 0, '0000-00-00 00:00:00'),
(7, 1, '7', 'Morning', 1, '2020-06-15 20:53:11', 0, '0000-00-00 00:00:00'),
(8, 1, '8', 'Morning', 1, '2020-06-15 20:53:16', 0, '0000-00-00 00:00:00'),
(9, 2, '1', 'Morning', 1, '2020-08-12 01:17:17', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `semester_subjects`
--

CREATE TABLE `semester_subjects` (
  `sem_subj_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_no` int(11) NOT NULL,
  `subject_title` varchar(100) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `subject__code` varchar(25) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester_subjects`
--

INSERT INTO `semester_subjects` (`sem_subj_id`, `course_p_id`, `semester_id`, `subject_no`, `subject_title`, `subject_description`, `subject__code`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 2, 1, 'ABC', ' SFDSFSDFSDF', '321432432', NULL, NULL, NULL, NULL),
(2, 1, 8, 1, 'DIP', 'Digital image processing', '12345', 1, '2020-06-25 12:23:14', NULL, NULL),
(3, 1, 8, 1, 'DB', 'Database', '4321', 1, '2020-06-25 12:23:43', NULL, NULL),
(4, 2, 9, 1, 'abc', 'test description', 'cstr222', 1, '2020-08-12 01:17:49', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `session_duration` varchar(20) NOT NULL,
  `session_start_date` date NOT NULL,
  `session_end_date` date NOT NULL,
  `intake` enum('Spring','Fall') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `course_p_id`, `session_duration`, `session_start_date`, `session_end_date`, `intake`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '2016-2020', '2016-10-03', '2020-10-03', 'Spring', 'Active', 1, '2020-06-15 20:39:46', 1, '2020-08-12 01:16:51'),
(2, 2, '2017-2021', '2017-10-03', '2021-10-03', 'Spring', 'Active', 1, '2020-06-15 20:41:42', 1, '2020-08-12 01:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `std_enrollment`
--

CREATE TABLE `std_enrollment` (
  `std_enrol_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `std_enrollment`
--

INSERT INTO `std_enrollment` (`std_enrol_id`, `std_id`, `session_id`, `semester_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 2, 1, 2, 1, '2020-06-24 03:00:02', NULL, NULL),
(3, 3, 1, 8, 1, '2020-06-24 15:48:42', NULL, NULL),
(4, 4, 1, 8, 1, '2020-08-12 01:21:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `std_reg_no` varchar(255) NOT NULL,
  `std_cnic` varchar(15) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_father_name` varchar(255) NOT NULL,
  `std_gender` enum('Male','Female') NOT NULL,
  `std_dob` date NOT NULL,
  `std_address` text NOT NULL,
  `std_mobile_no` varchar(15) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `user_id`, `std_reg_no`, `std_cnic`, `std_name`, `std_father_name`, `std_gender`, `std_dob`, `std_address`, `std_mobile_no`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 4, '123213', '', '3213123213213213', 'wqewqe', 'Male', '2020-05-31', 'wewqewqewqe', '+21-321-3213213', 'Active', 1, '2020-06-24 03:00:02', NULL, NULL),
(3, 5, '16-IRYC-59', '31303-1782040-9', 'saqib rehan', 'afzal rehan', 'Male', '2020-06-01', 'Chak 117/p', '+92-312-6232587', 'Active', 1, '2020-06-24 15:48:41', NULL, NULL),
(4, 7, 'tyk123', '22222-2222222-2', 'abc', 'xyz', 'Male', '2020-07-26', 'chak 117 p', '+23-232-1323232', 'Active', 1, '2020-08-12 01:21:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_father` varchar(255) NOT NULL,
  `teacher_cnic` varchar(15) NOT NULL,
  `teacher_mobile_no` varchar(15) NOT NULL,
  `teacher_gender` enum('Male','Female') NOT NULL,
  `teacher_dob` date NOT NULL,
  `teacher_address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `user_id`, `teacher_name`, `teacher_father`, `teacher_cnic`, `teacher_mobile_no`, `teacher_gender`, `teacher_dob`, `teacher_address`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(10, 3, '2 3ewqrqwe', 'dsf dsfdsfsdf', '21213-2132132-1', '+12-312-3121231', 'Male', '2020-06-10', 'dsa fsd fsdfsdf', 'Active', NULL, NULL, NULL, NULL),
(13, 6, 'saqib', 'rehan', '12344-4444444-4', '+21-421-4214214', 'Male', '2020-06-14', ' sdfdsf dsf sd fd', 'Active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class_enrollment`
--

CREATE TABLE `teacher_class_enrollment` (
  `tce_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sem_sub_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_class_enrollment`
--

INSERT INTO `teacher_class_enrollment` (`tce_id`, `teacher_id`, `session_id`, `semester_id`, `sem_sub_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(9, 13, 1, 4, 3, 1, '2020-06-25 19:15:02', NULL, NULL),
(10, 13, 1, 8, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `user_type`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Superadmin', 'admin', 'jr6PjnlrPuqIiSYKWxLJSyi6lTQwEEFc', '$2y$13$llfYhkOXD1adrmVVojjTRe.qblV2wemZxut1RC0kd2cQPyqODYm1a', NULL, 'saqibrehan587@gmail.com', 10, 1590234288, 1590234288, '7_pCPCsHFyhcf0FLNhN2jG_N9Munz7kV_1590234288'),
(2, '12345', 'student', 'syzXExLyXHDgSmre0523PxYtS95jtFf-', '$2y$13$x30tMWnLiOU5LO8cPRU.WeVeoeRea39skiAOsLehjteNkgruY2Kz.', NULL, 'saqibali4171@gmail.com', 9, 1592948942, 1592948942, 'PQhnc8gqDvCv41kmqo1FcUWJJCUr8Bl1_1592948942'),
(3, '12222', 'student', '9o76vvuX1TZTWFr3eu549PKmKSxcPeTp', '$2y$13$HtuGsPFzKS7BLPaBz1G3ke7dNfedJitiCYGXVu9ZJOn69r6VuaxlW', NULL, 'saqibrehan2007@gmail.com', 10, 1592949463, 1592949463, 'p-6ofh7-usKLsr_BML8PUX2vwp7Yu6bq_1592949463'),
(4, '123213213123213213', 'student', 'HQc2lx7xLCwGoovR2Z600A0oPuevWIiu', '$2y$13$c/UQ7j6D6jXFGS5jpbrHAu07seT3.2G4TMGcKjfZcMi/YG.ODzecm', NULL, 'sadas@gmail.com', 10, 1592949602, 1592949602, 'xdDIhfv9eD85yD85eEcW4SPmlBJNf78G_1592949602'),
(5, 'rehan', 'student', 'd7BhwxH3gQDLhBQvqWX6k__Ni1qgjoGb', '$2y$13$IVRVX0PzzaqRQPHMKnKzeezYp38st2KxwzksQXaQIbMTUIw80vgpy', NULL, 'saqibrehan@gmail.com', 10, 1592995720, 1592995720, '_4JxG0IIYMh3lpjcn4ElJFuYK8u1UEYP_1592995720'),
(6, 'rehan123', 'teacher', 'imggIm-OHTYFFyWnVpS_SkbpRpHBbAjY', '$2y$13$/TH2y4Fs1mFisxa6uKYwKen04VCPycmnz9X7EWw0//4Z1PFYiHjZO', NULL, 'saasass@gmail.com', 10, 1593094500, 1593094500, 'cCqikx-SY8d9bdTouz6ZyhHms8VxgnqK_1593094500'),
(7, 'abcxyz', 'student', 'RXVcQGJKIHsbVoMq69KOuNvLlXZO6hdg', '$2y$13$gQpK1PtnB7lpygg1laycxut0n9N8PYJroHKAFLH7wUVmTC36aI91W', NULL, 'abxyz@gmail.com', 10, 1597177267, 1597177267, 'AUyM1sGD9oHYgQFrqHDwdZNoS4FujGtN_1597177267');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announce_id`),
  ADD KEY `course_p_id` (`course_p_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `sem_sub_id` (`sem_sub_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `assignment_remarks`
--
ALTER TABLE `assignment_remarks`
  ADD PRIMARY KEY (`assign_remark_id`),
  ADD KEY `assign_id` (`assign_id`),
  ADD KEY `assign_sub_id` (`assign_sub_id`);

--
-- Indexes for table `assignment_submit`
--
ALTER TABLE `assignment_submit`
  ADD PRIMARY KEY (`assign_sub_id`),
  ADD KEY `assign_id` (`assign_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `assignment_upload`
--
ALTER TABLE `assignment_upload`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `sem_sub_id` (`sem_sub_id`),
  ADD KEY `uploaded_by` (`uploaded_by`),
  ADD KEY `c_p_id` (`c_p_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_handouts`
--
ALTER TABLE `class_handouts`
  ADD PRIMARY KEY (`handout_id`),
  ADD KEY `course_p_id` (`course_p_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `sem_sub_id` (`sem_sub_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_program`
--
ALTER TABLE `course_program`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`),
  ADD KEY `course_p_id` (`course_p_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `sender_name` (`sender_name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`quizz_id`),
  ADD KEY `course_p_id` (`course_p_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `sem_sub_id` (`sem_sub_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `quizz_remarks`
--
ALTER TABLE `quizz_remarks`
  ADD PRIMARY KEY (`quizz_remark_id`),
  ADD KEY `quizz_id` (`quizz_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `quiz_key`
--
ALTER TABLE `quiz_key`
  ADD PRIMARY KEY (`quiz_key_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD KEY `course_program_id` (`course_p_id`);

--
-- Indexes for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  ADD PRIMARY KEY (`sem_subj_id`),
  ADD KEY `course_p_id` (`course_p_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `course_p_id` (`course_p_id`);

--
-- Indexes for table `std_enrollment`
--
ALTER TABLE `std_enrollment`
  ADD PRIMARY KEY (`std_enrol_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teacher_class_enrollment`
--
ALTER TABLE `teacher_class_enrollment`
  ADD PRIMARY KEY (`tce_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `sem_subj_id` (`sem_sub_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_remarks`
--
ALTER TABLE `assignment_remarks`
  MODIFY `assign_remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignment_submit`
--
ALTER TABLE `assignment_submit`
  MODIFY `assign_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assignment_upload`
--
ALTER TABLE `assignment_upload`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class_handouts`
--
ALTER TABLE `class_handouts`
  MODIFY `handout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_program`
--
ALTER TABLE `course_program`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `quizz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizz_remarks`
--
ALTER TABLE `quizz_remarks`
  MODIFY `quizz_remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_key`
--
ALTER TABLE `quiz_key`
  MODIFY `quiz_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  MODIFY `sem_subj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `std_enrollment`
--
ALTER TABLE `std_enrollment`
  MODIFY `std_enrol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher_class_enrollment`
--
ALTER TABLE `teacher_class_enrollment`
  MODIFY `tce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`),
  ADD CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `announcement_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `announcement_ibfk_4` FOREIGN KEY (`sem_sub_id`) REFERENCES `semester_subjects` (`sem_subj_id`),
  ADD CONSTRAINT `announcement_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `assignment_remarks`
--
ALTER TABLE `assignment_remarks`
  ADD CONSTRAINT `assignment_remarks_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `assignment_upload` (`assign_id`),
  ADD CONSTRAINT `assignment_remarks_ibfk_2` FOREIGN KEY (`assign_sub_id`) REFERENCES `assignment_submit` (`assign_sub_id`);

--
-- Constraints for table `assignment_submit`
--
ALTER TABLE `assignment_submit`
  ADD CONSTRAINT `assignment_submit_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `assignment_upload` (`assign_id`),
  ADD CONSTRAINT `assignment_submit_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`);

--
-- Constraints for table `assignment_upload`
--
ALTER TABLE `assignment_upload`
  ADD CONSTRAINT `assignment_upload_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `assignment_upload_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `assignment_upload_ibfk_3` FOREIGN KEY (`sem_sub_id`) REFERENCES `semester_subjects` (`sem_subj_id`),
  ADD CONSTRAINT `assignment_upload_ibfk_4` FOREIGN KEY (`uploaded_by`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `assignment_upload_ibfk_5` FOREIGN KEY (`c_p_id`) REFERENCES `course_program` (`cp_id`);

--
-- Constraints for table `class_handouts`
--
ALTER TABLE `class_handouts`
  ADD CONSTRAINT `class_handouts_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`),
  ADD CONSTRAINT `class_handouts_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `class_handouts_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `class_handouts_ibfk_4` FOREIGN KEY (`sem_sub_id`) REFERENCES `semester_subjects` (`sem_subj_id`);

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`),
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `inbox_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `inbox_ibfk_4` FOREIGN KEY (`sender_name`) REFERENCES `user` (`id`);

--
-- Constraints for table `quizz`
--
ALTER TABLE `quizz`
  ADD CONSTRAINT `quizz_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`),
  ADD CONSTRAINT `quizz_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `quizz_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `quizz_ibfk_4` FOREIGN KEY (`sem_sub_id`) REFERENCES `semester_subjects` (`sem_subj_id`),
  ADD CONSTRAINT `quizz_ibfk_5` FOREIGN KEY (`uploaded_by`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `quizz_remarks`
--
ALTER TABLE `quizz_remarks`
  ADD CONSTRAINT `quizz_remarks_ibfk_1` FOREIGN KEY (`quizz_id`) REFERENCES `quizz` (`quizz_id`),
  ADD CONSTRAINT `quizz_remarks_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`);

--
-- Constraints for table `quiz_key`
--
ALTER TABLE `quiz_key`
  ADD CONSTRAINT `quiz_key_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizz` (`quizz_id`);

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`);

--
-- Constraints for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  ADD CONSTRAINT `semester_subjects_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`),
  ADD CONSTRAINT `semester_subjects_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `std_enrollment`
--
ALTER TABLE `std_enrollment`
  ADD CONSTRAINT `std_enrollment_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`),
  ADD CONSTRAINT `std_enrollment_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `std_enrollment_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `teacher_class_enrollment`
--
ALTER TABLE `teacher_class_enrollment`
  ADD CONSTRAINT `sem sub` FOREIGN KEY (`sem_sub_id`) REFERENCES `semester_subjects` (`sem_subj_id`),
  ADD CONSTRAINT `semester` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `session` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`),
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
