-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 09:26 PM
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
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `course_p_id` int(11) NOT NULL,
  `semester_no` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `course_p_id`, `semester_no`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '1', 1, '2020-06-15 20:50:06', 0, '0000-00-00 00:00:00'),
(2, 1, '2', 1, '2020-06-15 20:50:14', 0, '0000-00-00 00:00:00'),
(3, 1, '3', 1, '2020-06-15 20:50:20', 0, NULL),
(4, 1, '4', 1, '2020-06-15 20:50:38', 0, '0000-00-00 00:00:00'),
(5, 1, '5', 1, '2020-06-15 20:52:58', 0, '0000-00-00 00:00:00'),
(6, 1, '6', 1, '2020-06-15 20:53:05', 0, '0000-00-00 00:00:00'),
(7, 1, '7', 1, '2020-06-15 20:53:11', 0, '0000-00-00 00:00:00'),
(8, 1, '8', 1, '2020-06-15 20:53:16', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `semester_subjects`
--

CREATE TABLE `semester_subjects` (
  `sem_subj_id` int(11) NOT NULL,
  `subj_1_title` varchar(100) NOT NULL,
  `subj_1_description` varchar(255) NOT NULL,
  `subj_2_title` varchar(100) NOT NULL,
  `subj_2_description` varchar(255) NOT NULL,
  `subj_3_title` varchar(100) NOT NULL,
  `subj_3_description` varchar(255) NOT NULL,
  `subj_4_title` varchar(100) DEFAULT NULL,
  `subj_4_description` varchar(255) DEFAULT NULL,
  `subj_5_title` varchar(100) DEFAULT NULL,
  `subj_5_description` varchar(255) DEFAULT NULL,
  `subj_6_title` varchar(100) DEFAULT NULL,
  `subj_6_description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `session_duration` varchar(20) NOT NULL,
  `session_start_date` date NOT NULL,
  `session_end_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_duration`, `session_start_date`, `session_end_date`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '2016-2020', '2016-10-03', '2020-10-03', 'Active', 1, '2020-06-15 20:39:46', 0, '0000-00-00 00:00:00'),
(2, '2017-2021', '2017-10-03', '2021-10-03', 'Active', 1, '2020-06-15 20:41:42', 0, '0000-00-00 00:00:00');

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
(1, 1, 1, 8, 1, '2020-06-15 21:02:03', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `std_reg_no` varchar(255) NOT NULL,
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

INSERT INTO `student` (`std_id`, `user_id`, `std_reg_no`, `std_name`, `std_father_name`, `std_gender`, `std_dob`, `std_address`, `std_mobile_no`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '1122', 'Arslan Nasir', 'Nasir', 'Male', '1998-09-21', 'Chak No. 146p', '+92-304-3374027', 'Active', 1, '2020-06-15 20:56:51', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_father` varchar(255) NOT NULL,
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

INSERT INTO `teacher` (`teacher_id`, `user_id`, `teacher_name`, `teacher_father`, `teacher_mobile_no`, `teacher_gender`, `teacher_dob`, `teacher_address`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Sir Tariq', 'Saeed', '+00-000-0000000', 'Male', '1970-06-24', 'Somewhere in Karachi', 'Active', 1, '2020-06-15 21:04:03', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class_enrollment`
--

CREATE TABLE `teacher_class_enrollment` (
  `tce_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_class_enrollment`
--

INSERT INTO `teacher_class_enrollment` (`tce_id`, `teacher_id`, `session_id`, `semester_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2020-06-15 21:07:21', 0, '0000-00-00 00:00:00');

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
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Superadmin', 'jr6PjnlrPuqIiSYKWxLJSyi6lTQwEEFc', '$2y$13$llfYhkOXD1adrmVVojjTRe.qblV2wemZxut1RC0kd2cQPyqODYm1a', NULL, 'saqibrehan587@gmail.com', 10, 1590234288, 1590234288, '7_pCPCsHFyhcf0FLNhN2jG_N9Munz7kV_1590234288');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_program`
--
ALTER TABLE `course_program`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

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
  ADD PRIMARY KEY (`sem_subj_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`);

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
  ADD KEY `session_id` (`session_id`);

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
-- AUTO_INCREMENT for table `course_program`
--
ALTER TABLE `course_program`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  MODIFY `sem_subj_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `std_enrollment`
--
ALTER TABLE `std_enrollment`
  MODIFY `std_enrol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_class_enrollment`
--
ALTER TABLE `teacher_class_enrollment`
  MODIFY `tce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`course_p_id`) REFERENCES `course_program` (`cp_id`);

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
  ADD CONSTRAINT `teacher_class_enrollment_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `teacher_class_enrollment_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `teacher_class_enrollment_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
