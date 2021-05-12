-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 08:43 AM
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
  `organizer3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certid`, `eventname`, `eventdate`, `orgid`, `venue`, `organizer1`, `organizer2`, `organizer3`) VALUES
(1, 'a semianr', '1st of March, 2033', 1, 'cxastle clavk', 'jon snow', '', ''),
(28, 'sfaf', '1rd of January, 2021', 5, 'asfwaf', 'Lewis Hamilton', '', ''),
(29, 'asfaf', '28st of June, 2034', 5, 'awfaf', 'Lewis Hamilton', '', ''),
(30, 'asfaf', '28th of June, 2034', 5, 'awfaf', 'Lewis Hamilton', '', ''),
(31, 'safaf', '1st of March, 2021', 5, 'asfaf', 'Lewis Hamilton', '', ''),
(32, 'awfwaf', '2nd of January, 2021', 5, 'awfaf', 'Lewis Hamilton', '', ''),
(33, 'hahahha is this real now', '3rd of March, 2021', 5, 'tototo na ba talaga', 'Lewis Hamilton', '', ''),
(34, 'the north remembers', '12th of May, 2022', 3, 'winterfell', 'sansa jonas', '', ''),
(36, 'the north remembers part 2', '2nd of April, 2023', 3, 'dito lang', 'sansa jonas', 'arya stark', 'bran stark'),
(41, 'hello', '15th of August, 2024', 3, 'dyan abnda', 'sansa jonas', 'hello', ''),
(42, 'try lang', '18th of May, 2024', 3, 'sag', 'sansa jonas', '', ''),
(43, '100 poles bby', '1st of January, 2021', 5, 'spani', 'Lewis Hamilton', '', ''),
(45, 'legends only', '8th of July, 2027', 5, 'spain', 'Lewis Hamilton', 'Sebastian Vettel', ''),
(46, 'f1 4 dummiez', '22nd of January, 2021', 5, 'silverstone', 'Lewis Hamilton', '', '');

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
(17, 'mick ', 'schumacher', 'msc@g.com', '5f4dcc3b5aa765d61d8327deb882cf99');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
