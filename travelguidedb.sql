-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 06:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelguidedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mob` decimal(10,0) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `dob`, `gender`, `email`, `mob`, `pass`) VALUES
(18, 'Abhishek Sapariya', '2000-10-25', 'male', 'abhisheksapariya678@gmail.com', '0', 'abhi123'),
(19, 'abhi_678', '2020-10-02', 'male', '17ce099@charusat.edu.in', '0', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `schedule1`
--

CREATE TABLE `schedule1` (
  `userId` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `stime` varchar(10) NOT NULL,
  `etime` varchar(10) NOT NULL,
  `date1` varchar(11) NOT NULL,
  `likes` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `lstime` varchar(20) DEFAULT NULL,
  `letime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule1`
--

INSERT INTO `schedule1` (`userId`, `day`, `stime`, `etime`, `date1`, `likes`, `city`, `lstime`, `letime`) VALUES
(18, 4, '9 am', '9 pm', '2020-10-22', 'restaurant,shopping,historic sites,temple,', 'Mumbai', '9:00', '23:00'),
(18, 5, '11 am', '5 pm', '2020-10-23', 'restaurant,shopping,temple,', 'Delhi', '9:00', '23:00'),
(18, 6, '3 pm', '8 pm', '2020-10-24', 'shopping,historic sites,temple,', 'Chennai', '9:00', '23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule1`
--
ALTER TABLE `schedule1`
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule1`
--
ALTER TABLE `schedule1`
  ADD CONSTRAINT `schedule1_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
