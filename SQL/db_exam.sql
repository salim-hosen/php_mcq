-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 11:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admId`, `email`, `password`, `fullName`) VALUES
(1, 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mohammad Salim Hosen'),
(2, 'salim@gmail.com', 'c3ac70501ad99a467f14f62dd4642391', 'Salim Hosen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE `tbl_options` (
  `opId` int(11) NOT NULL,
  `qId` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `ans` int(11) NOT NULL DEFAULT 0,
  `qsetId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_options`
--

INSERT INTO `tbl_options` (`opId`, `qId`, `options`, `ans`, `qsetId`) VALUES
(1, 1, 'kazi Nazrul', 1, 1),
(2, 1, 'Rabindranath', 0, 1),
(3, 1, 'Jashim Uddin', 0, 1),
(4, 1, 'Madhusudon', 0, 1),
(5, 2, 'a', 1, 2),
(6, 2, 'j', 0, 2),
(7, 2, 'k', 0, 2),
(8, 2, 'l', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quesset`
--

CREATE TABLE `tbl_quesset` (
  `qsId` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `qsName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quesset`
--

INSERT INTO `tbl_quesset` (`qsId`, `subId`, `qsName`) VALUES
(1, 1, 'Bangla First Quiz'),
(2, 2, 'English first paper');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `qId` int(11) NOT NULL,
  `qsId` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`qId`, `qsId`, `question`) VALUES
(1, 1, 'Who is the national poetry of bangladesh?'),
(2, 2, 'In the below list which one is vowel?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result`
--

CREATE TABLE `tbl_result` (
  `resId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `qset` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `score` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_result`
--

INSERT INTO `tbl_result` (`resId`, `uId`, `subject`, `qset`, `date`, `score`) VALUES
(14, 12, 'Bangla', 'Bangla First Quiz', '11 May 2020', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subId` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subId`, `subject`) VALUES
(1, 'Bangla'),
(2, 'English'),
(3, 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `uId` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`uId`, `fullName`, `email`, `password`, `status`) VALUES
(12, 'Salim Hosen', 'salimhosen19@gmail.com', '60761a77524cbadf993a9ba56748fbef', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admId`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`opId`);

--
-- Indexes for table `tbl_quesset`
--
ALTER TABLE `tbl_quesset`
  ADD PRIMARY KEY (`qsId`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`qId`);

--
-- Indexes for table `tbl_result`
--
ALTER TABLE `tbl_result`
  ADD PRIMARY KEY (`resId`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `opId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_quesset`
--
ALTER TABLE `tbl_quesset`
  MODIFY `qsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `qId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_result`
--
ALTER TABLE `tbl_result`
  MODIFY `resId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
