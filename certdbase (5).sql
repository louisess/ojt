-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 11:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certdbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certid` int(11) NOT NULL,
  `eventname` varchar(255) NOT NULL,
  `eventdate` varchar(255) NOT NULL,
  `orgid` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `organizer1` varchar(255) DEFAULT NULL,
  `organizer2` varchar(255) DEFAULT NULL,
  `organizer3` varchar(255) DEFAULT NULL,
  `signatory1` varchar(255) NOT NULL,
  `signatory2` varchar(255) NOT NULL,
  `signatory3` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certid`, `eventname`, `eventdate`, `orgid`, `venue`, `organizer1`, `organizer2`, `organizer3`, `signatory1`, `signatory2`, `signatory3`, `department`, `title`, `description`) VALUES
(78, '2', 'New one', 1, 'a place', 'taylor swift - ogranizer', ' - ', ' - ', '', '', '', '', '', ''),
(79, 'New one', '1 to 18th of January, 2021', 2, 'a place', 'taylor swift - ogranizer', ' - ', ' - ', '', '', '', '', '', ''),
(80, 'New one', '1 to 18th of January, 2021', 2, 'a place', 'taylor swift - ogranizer', ' - ', ' - ', '', '', '', '', '', ''),
(81, 'Folklore', '1 to 3rd of March, 2022', 2, 'nashville', 'taylor swift - ogranizer', ' - ', ' - ', '452e373b967dfadcdb06cf36e80e8106.jpg', '', '', '', '', ''),
(82, 'Graduation', '1st of January, 2021', 2, 'Facebook Live', 'taylor swift - ogranizer', 'selena gomez - speaker', ' - ', '', '', '', 'Certificate of Attendance', 'School of Information Technology', 'pls work?'),
(84, 'An Event ', '1 to 2nd of January, 2021', 2, 'Facebook Live', 'taylor swift - ogranizer', ' - ', ' - ', '', '', '', 'School of Criminal Justice and Public Safety', 'Certificate of Attendance', 'A certificate awarded to viewers of Facebook Live');

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'jon', 'snow', 'js@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'taylor', 'swift', 'ts@g.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'sansa', 'jonas', 'sj@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'Carlos', 'Sainz', 'cs@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(5, 'Sir Lewis', 'Hamilton', 'l44@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 'Seb', 'Vettel', 'sv@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(8, 'kimi', 'raikkonen', 'kr@g.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(17, 'mick ', 'schumacher', 'msc@g.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(18, 'micahel', 'schumacher', 's@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `pid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`pid`, `eventid`, `name`, `email`) VALUES
(20, 49, 'mary knoll', 'mk@gmail.com'),
(21, 49, 'Samantha Lousie', 'sl@gmail.com'),
(22, 49, 'Samantha Lousie', 'sl@gmail.com'),
(23, 49, 'hi', 'hello@gmail.com'),
(24, 49, 'mary knoll', ''),
(25, 49, 'jon snow', 'js@gmail.com'),
(26, 49, 'Hannah Montana', 'hm@gmail.com'),
(28, 68, 'Issa Me', 'isme@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certid`),
  ADD UNIQUE KEY `certid` (`certid`),
  ADD KEY `orgid` (`orgid`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`orgid`) REFERENCES `organizers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
