-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2018 at 06:03 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinecourse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2017-01-24 16:21:18', '12-12-2018 11:28:49 PM');

-- --------------------------------------------------------

--
-- Table structure for table `applyfor`
--

CREATE TABLE `applyfor` (
  `id` int(3) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applyfor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applyfor`
--

INSERT INTO `applyfor` (`id`, `creationDate`, `applyfor`) VALUES
(1, '2018-12-11 18:20:13', 'regular'),
(2, '2018-12-11 18:21:15', 'supplementary'),
(4, '2018-12-11 18:22:39', 'improvement');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `lecture` int(5) DEFAULT NULL,
  `tutorial` int(5) NOT NULL,
  `practical` int(5) NOT NULL,
  `credit` int(5) NOT NULL,
  `noofseats` int(5) NOT NULL,
  `department` varchar(255) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `courseType` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `courseCode`, `courseName`, `lecture`, `tutorial`, `practical`, `credit`, `noofseats`, `department`, `semester`, `courseType`, `creationDate`) VALUES
(34, 'CSS-111', 'Engineering Mathematics-1', 3, 1, 0, 3, 100, 'Computer Science and Engineering', 'First', 'Compulsory', '2018-12-09 21:12:27'),
(35, 'CSS-112', 'Physics for Computer Engineers', 3, 1, 0, 3, 100, 'Computer Science and Engineering', 'First', 'Compulsory', '2018-12-09 21:12:48'),
(38, 'CSD-113', 'Computer Fundamentals and Programming', 3, 1, 0, 3, 100, 'Computer Science and Engineering', 'First', 'Compulsory', '2018-12-09 21:12:58'),
(39, 'CSS-121', 'Engineering Mathematics-2', 3, 1, 0, 3, 100, 'Computer Science and Engineering', 'First', 'Compulsory', '2018-12-09 21:13:12'),
(40, 'CS-700', 'Artificial Intelligence', 3, 1, 0, 3, 100, 'Computer Science and Engineering', 'Seventh', 'Elective', '2018-12-09 21:13:25'),
(41, 'CSD-410', 'Information Security', 3, 1, 0, 3, 60, 'Computer Science and Engineering', 'Seventh', 'Compulsory', '2018-12-12 19:01:58'),
(42, 'CSD-411', 'Advanced Computer Architecture', 3, 1, 0, 3, 60, 'Computer Science and Engineering', 'Seventh', 'Compulsory', '2018-12-12 19:02:52'),
(43, 'CSD-412', 'Advanced Operating System', 3, 1, 0, 3, 60, 'Computer Science and Engineering', 'Seventh', 'Compulsory', '2018-12-12 19:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `courseenroll`
--

CREATE TABLE `courseenroll` (
  `id` int(11) NOT NULL,
  `studentRegNo` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `courseCode` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `applyFor` varchar(255) NOT NULL,
  `enrollDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseenroll`
--

INSERT INTO `courseenroll` (`id`, `studentRegNo`, `session`, `department`, `semester`, `courseCode`, `courseName`, `receipt`, `applyFor`, `enrollDate`) VALUES
(256, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'First', 'CSS-112', 'Physics for Computer Engineers', 'Screenshot (14).png', 'regular', '2018-12-12 17:05:44'),
(257, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'First', 'CSD-113', 'Computer Fundamentals and Programming', 'Screenshot (14).png', 'regular', '2018-12-12 17:05:44'),
(271, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'First', 'CSS-111', 'Engineering Mathematics-1', 'Screenshot (10).png', 'regular', '2018-12-12 18:26:14'),
(272, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'First', 'CSS-121', 'Engineering Mathematics-2', 'Screenshot (10).png', 'regular', '2018-12-12 18:26:14'),
(273, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'First', 'CSS-112', 'Physics for Computer Engineers', 'page_1.jpg', 'supplementary', '2018-12-12 19:00:02'),
(274, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'Seventh', 'CS-700', 'Artificial Intelligence', 'page_2.jpg', 'regular', '2018-12-12 19:04:26'),
(275, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'Seventh', 'CSD-410', 'Information Security', 'page_2.jpg', 'regular', '2018-12-12 19:04:26'),
(276, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'Seventh', 'CSD-411', 'Advanced Computer Architecture', 'page_2.jpg', 'regular', '2018-12-12 19:04:26'),
(277, '15mi542', '2018-Odd', 'Computer Science and Engineering', 'Seventh', 'CSD-412', 'Advanced Operating System', 'page_2.jpg', 'regular', '2018-12-12 19:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `creationDate`) VALUES
(9, 'Computer Science and Engineering', '2018-11-18 19:06:11'),
(13, 'Civil ', '2018-11-18 19:07:26'),
(14, 'Mechanical', '2018-11-18 19:07:37'),
(15, 'Electronics and Communication', '2018-11-18 19:07:59'),
(16, 'Chemical', '2018-11-18 20:30:20'),
(17, 'Architecture', '2018-11-18 20:30:46'),
(18, 'Electrical', '2018-11-18 20:30:53'),
(19, 'Mathematics', '2018-12-12 17:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`, `creationDate`, `updationDate`) VALUES
(7, 'First', '2018-11-18 19:04:27', ''),
(8, 'Second', '2018-11-18 19:04:38', ''),
(9, 'Third', '2018-11-18 19:04:43', ''),
(10, 'Fourth', '2018-11-18 19:04:48', ''),
(11, 'Fifth', '2018-11-18 19:04:54', ''),
(12, 'Sixth', '2018-11-18 19:04:58', ''),
(13, 'Seventh', '2018-11-18 19:05:04', ''),
(14, 'Eighth', '2018-11-18 19:05:10', ''),
(15, 'Ninth', '2018-11-18 20:18:40', ''),
(17, 'Tenth', '2018-11-18 20:28:56', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session`, `creationDate`) VALUES
(31, '2018-Odd', '2018-12-09 19:39:29'),
(33, '2019-Odd', '2018-12-10 09:38:39'),
(34, '2019-Even', '2018-12-12 08:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentRegNo` varchar(255) NOT NULL,
  `studentName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentPhoto` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `cgpa` decimal(10,2) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentRegNo`, `studentName`, `password`, `studentPhoto`, `department`, `cgpa`, `creationDate`) VALUES
('15mi530', 'Raj Rahi', '202cb962ac59075b964b07152d234b70', 'Screenshot (4).png', 'Computer Science and Engineering', '0.00', '2018-12-12 17:59:37'),
('15mi542', 'Prashant Gupta', '827ccb0eea8a706c4c34a16891f84e7b', 'avatar-1.jpg.png', 'Computer Science and Engineering', '0.00', '2018-12-09 17:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `studentRegno` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `studentRegno`, `userip`, `loginTime`, `logout`, `status`) VALUES
(64, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-09 19:44:26', '', 1),
(65, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-09 19:45:31', '', 1),
(66, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-09 19:47:37', '', 1),
(67, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-10 09:35:22', '', 1),
(68, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-10 09:37:34', '', 1),
(69, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-10 09:38:26', '', 1),
(70, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 09:27:33', '11-12-2018 03:06:20 PM', 1),
(71, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 09:36:28', '11-12-2018 03:06:31 PM', 1),
(72, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 09:36:55', '', 1),
(73, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 12:24:06', '11-12-2018 06:00:15 PM', 1),
(74, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 12:31:15', '11-12-2018 06:12:19 PM', 1),
(75, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 12:47:47', '', 1),
(76, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 12:52:29', '11-12-2018 06:22:51 PM', 1),
(77, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 12:53:10', '11-12-2018 06:52:58 PM', 1),
(78, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 13:23:33', '11-12-2018 07:03:38 PM', 1),
(79, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 13:34:54', '11-12-2018 07:21:51 PM', 1),
(80, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 13:52:01', '11-12-2018 07:55:07 PM', 1),
(81, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 16:42:38', '11-12-2018 11:46:09 PM', 1),
(82, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 18:39:40', '', 1),
(83, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-11 19:11:27', '12-12-2018 12:30:27 PM', 1),
(84, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 07:00:50', '12-12-2018 12:31:29 PM', 1),
(85, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 07:03:14', '12-12-2018 12:34:01 PM', 1),
(86, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 07:07:45', '12-12-2018 01:29:12 PM', 1),
(87, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 08:43:09', '', 1),
(88, '15mi530', 0x3a3a3100000000000000000000000000, '2018-12-12 18:00:17', '12-12-2018 11:36:41 PM', 1),
(89, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 18:06:48', '12-12-2018 11:57:30 PM', 1),
(90, '15mi530', 0x3a3a3100000000000000000000000000, '2018-12-12 18:27:37', '12-12-2018 11:57:43 PM', 1),
(91, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-12 18:49:43', '', 1),
(92, '15mi542', 0x3a3a3100000000000000000000000000, '2018-12-13 04:44:44', '13-12-2018 10:17:45 AM', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applyfor`
--
ALTER TABLE `applyfor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseenroll`
--
ALTER TABLE `courseenroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentRegNo`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applyfor`
--
ALTER TABLE `applyfor`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `courseenroll`
--
ALTER TABLE `courseenroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
