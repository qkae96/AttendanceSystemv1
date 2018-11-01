-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2018 at 08:36 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `CheckIn` timestamp NULL DEFAULT NULL,
  `CheckOut` timestamp NULL DEFAULT NULL,
  `TagID` varchar(45) DEFAULT NULL,
  `EventID` int(11) NOT NULL,
  `ProfileID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `EventDate` date NOT NULL,
  `EventStartTime` time NOT NULL,
  `EventEndTime` time NOT NULL,
  `EventVenue` varchar(45) DEFAULT NULL,
  `EventClockOut` tinyint(1) UNSIGNED ZEROFILL DEFAULT NULL,
  `EventDescription` text,
  `RepeatEvent` tinyint(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `EndRepeat` date DEFAULT NULL,
  `ProfileID` int(11) NOT NULL,
  `EventCode` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `EventDate`, `EventStartTime`, `EventEndTime`, `EventVenue`, `EventClockOut`, `EventDescription`, `RepeatEvent`, `EndRepeat`, `ProfileID`, `EventCode`) VALUES
(1, 'Design Patterns', '2018-10-15', '13:00:00', '15:00:00', 'MM6', NULL, NULL, NULL, NULL, 3, 'WIF3008'),
(2, 'Design Pattern Replacement', '2018-10-23', '16:00:00', '17:00:00', 'MM6', NULL, NULL, NULL, NULL, 3, 'WIF3008');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `ProfileID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `MatricNo` varchar(45) DEFAULT NULL,
  `TagID` varchar(45) DEFAULT NULL,
  `ProfileType` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `PhoneNo` varchar(45) DEFAULT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ProfileID`, `Name`, `MatricNo`, `TagID`, `ProfileType`, `Email`, `PhoneNo`, `Username`, `Password`) VALUES
(1, 'TEOW QIN KAE', 'WES150036', '3543696191', 'Student', 'qkae96@siswa.um.edu.my', '0149887023', NULL, NULL),
(2, 'TEOH ZHI YU', 'WES150051', '3543846751', 'Student', 'tzy_1996@hotmail.com', '0164691494', NULL, NULL),
(3, 'DR. SU MOON TING', NULL, NULL, 'Lecturer', 'smting@um.edu.my', '+603-79676369', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`,`EventID`,`ProfileID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`,`ProfileID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ProfileID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `ProfileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
