-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 12:19 PM
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
  `eventdate` date NOT NULL,
  `orgid` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `organizer1` varchar(255) DEFAULT NULL,
  `organizer2` varchar(255) DEFAULT NULL,
  `organizer3` varchar(255) DEFAULT NULL,
  `logo1` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `signatory1` varchar(255) NOT NULL,
  `signatory2` varchar(255) NOT NULL,
  `signatory3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 'Lewis', 'Hamilton', 'lh@g.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 'Seb', 'Vettel', 'sv@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(8, 'kimi', 'raikkonen', 'kr@g.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(17, 'mick ', 'schumacher', 'msc@g.com', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certid`),
  ADD KEY `orgid` (`orgid`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
