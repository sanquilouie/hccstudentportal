-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 04:41 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `eventid` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`eventid`, `title`, `caption`, `image`, `tag`) VALUES
(11, 'gjhgjhgjgjg', 'jgjgjhghgjh', 'adasdasdas.JPG', ''),
(12, 'dsfsdfdssdfdsfs', 'hgfhgf', '3.JPG', ''),
(13, 'jhgjhgjh', 'jhgjhgjgjhgjhgjhgkjgjh576576576576', '6.JPG', ''),
(999999999, 'AAAAAAAAAAAAAA', 'AAAAAAAAAAAAAAA', '', ''),
(1000000000, 'ghgfhfhf5545454', 'hghghghgh76876876876868686877777777777777777777777777777777', '4.JPG', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billingid` int(20) NOT NULL,
  `studentid` int(20) NOT NULL,
  `tuitionfee` int(20) NOT NULL,
  `learnandins` int(20) NOT NULL,
  `regfee` int(20) NOT NULL,
  `compprossfee` int(20) NOT NULL,
  `guidandcouns` int(20) NOT NULL,
  `schoolidfee` int(20) NOT NULL,
  `studenthand` int(20) NOT NULL,
  `schoolfab` int(20) NOT NULL,
  `insurance` int(20) NOT NULL,
  `totalass` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `netass` int(20) NOT NULL,
  `cashcheckpay` int(20) NOT NULL,
  `balance` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billingid`, `studentid`, `tuitionfee`, `learnandins`, `regfee`, `compprossfee`, `guidandcouns`, `schoolidfee`, `studenthand`, `schoolfab`, `insurance`, `totalass`, `discount`, `netass`, `cashcheckpay`, `balance`) VALUES
(55, 545222, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(56, 54545454, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(57, 654512, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(58, 545456, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(59, 454565, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(60, 987542, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(61, 321698, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(62, 654654, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(63, 354987, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(64, 545222, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(65, 54545454, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(66, 654512, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(67, 545456, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(68, 454565, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(69, 987542, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(70, 321698, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(71, 654654, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735),
(72, 354987, 6000, 3700, 1000, 350, 235, 150, 100, 100, 100, 11735, 5000, 11735, 5000, 6735);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(25) NOT NULL,
  `facultyid` int(25) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `facultyid`, `firstname`, `lastname`, `department`, `email`, `contact`) VALUES
(5, 679, 'Draco', 'Malfoy', 'BSCS', 'asdasd@yahoo.com', 12321),
(6, 123, 'Harry', 'Potter', 'BSCS', 'harrypotter@gmail.com', 2147483647),
(7, 58555, 'Ichigo', 'Kurozaki', 'BSED', 'ichigo@yahoo.com', 951554515);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `entryid` int(255) NOT NULL,
  `studentid` int(12) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `schoolyear` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `units` varchar(255) NOT NULL,
  `prelim` varchar(255) NOT NULL DEFAULT 'GW',
  `midterm` varchar(255) NOT NULL DEFAULT 'GW',
  `finals` varchar(255) NOT NULL DEFAULT 'GW',
  `finalgrades` varchar(255) NOT NULL,
  `average` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`entryid`, `studentid`, `studentname`, `schoolyear`, `semester`, `subject`, `faculty`, `units`, `prelim`, `midterm`, `finals`, `finalgrades`, `average`, `status`) VALUES
(57, 54545454, 'Dela Cruz, Juana', '2022/2023', 'Second', 'Math', 'Garcia, Julieta, ', '3', '80', 'GW', 'GW', 'NG', 'NG', 'NG');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(25) NOT NULL,
  `studentid` bigint(25) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` int(25) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `email` mediumtext NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentid`, `firstname`, `lastname`, `address`, `contact`, `birthday`, `email`, `course`, `year`, `section`) VALUES
(1, 21312, 'asd', 'asd', 'asd', 132, '2019-12-31', 'asda@yahoo.com', 'BSCS', 'asdas', 'asdsa'),
(2, 12345, 'fname', 'lname', 'addrss', 12345, '2022-12-31', 'email@yahoo.com', 'BSCS', 'year', 'section'),
(3, 32323, 'asdsd', 'asdsad', 'asdasd', 323, '2022-12-31', 'asdsa@yahoo.com', 'BSCS', 'sadasd', 'asdsad'),
(4, 2423432, 'dfsfds', 'sdfsdfd', 'sdfdsf', 234234, '2022-12-31', 'sdfdsfhgh@yahoo.com', 'BSCS', 'fsdf', 'dfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectid` int(20) NOT NULL,
  `facultyid` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectid`, `facultyid`, `faculty`, `course`, `code`, `subject`, `year`, `sem`, `unit`) VALUES
(7, '', 'N/A', 'BSCS', 'CCP 1101', 'Computer Programming 1', 'First Year', 'First Semester', '3'),
(9, '', 'N/A', 'BSCS', 'CSP 1101', 'Social and Professional Issues in Computing', 'First Year', 'First Semester', '3'),
(10, '', 'N/A', 'BSCS', 'MLC 1101	', 'Literacy/Civic Welfare/Military Science 1', 'First Year', 'First Semester', '3'),
(11, '', 'N/A', 'BSCS', 'PPE 1101	', 'Physical Education 1	', 'First Year', 'First Semester', '3'),
(12, '', 'N/A', 'BSCS', 'ZGE 1102	', 'The Contemporary World	', 'First Year', 'First Semester', '3'),
(14, '', 'N/A', 'BSCS', 'CCP 1102	', 'Computer Programming 2', 'First Year', 'Second Semester', '3'),
(15, '', 'N/A', 'BSCS', 'CDS 1101	', 'Data Structures and Algorithms', 'First Year', 'Second Semester', '3'),
(16, '', 'N/A', 'BSCS', 'CFD 1101	', 'Fundamentals of Database Systems	', 'First Year', 'Second Semester', '3'),
(17, '', 'N/A', 'BSCS', 'MLC 1102', 'Literacy/Civic Welfare/Military Science 2	', 'First Year', 'Second Semester', '3'),
(18, '', 'N/A', 'BSCS', 'PPE 1102', 'Physical Education 2', 'First Year', 'Second Semester', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `userid` bigint(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `password`, `role`) VALUES
(1, 999999, '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(94, 2423432, '1a1dc91c907325c69271ddf0c944bc72', 'Student'),
(95, 679, '1a1dc91c907325c69271ddf0c944bc72', 'Faculty'),
(96, 123, '1a1dc91c907325c69271ddf0c944bc72', 'Faculty'),
(104, 58555, '1a1dc91c907325c69271ddf0c944bc72', 'Faculty');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billingid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`entryid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `eventid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000001;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billingid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `entryid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
