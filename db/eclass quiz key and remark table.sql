-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2020 at 04:26 PM
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
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quizz_remarks`
--
ALTER TABLE `quizz_remarks`
  MODIFY `quizz_remark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_key`
--
ALTER TABLE `quiz_key`
  MODIFY `quiz_key_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
