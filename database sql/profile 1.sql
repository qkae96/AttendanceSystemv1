-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 10:53 PM
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
-- Database: `getprofile`
--

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
(6, 'Eng Zhi Yuan', 'WES150008', '3543603455', 'user', 'engzhiyuan96@gmail.com', '0125176801', 'engzhiyuan', '123'),
(7, 'WEE CHEE SAN', 'WES150038', '3543846239', 'user', 'leonweecs@gmail.com', '0104315105', 'leonweecs', '123'),
(8, 'Teoh Khau Kheng', 'WES150035', '3543783679', 'user', 'khenggy111@gmail.com', '0174567919', 'Kheng', '123'),
(9, 'Ahmad Rifqi bin Ahmad Rokis', 'WES150004', '3543610879', 'user', 'rifqi.rokis.1996@gmailcom', '0132037015', 'Rifqi', '123'),
(10, 'Qurratu Aini Bt Hasram', 'wes150050', '3543779231', 'user', 'qurratu.aini996@gmail.com', '018-3664403', 'Ratu', '123'),
(11, 'Chempaka Seri binti Abdul Razak', 'WES150043', '1232599167', 'user', 'chempakaseri96@gmail.com', '0183100257', 'chempakaseri', '123'),
(12, 'SITI SHOLIHA BINTI', 'wes150033', '3543562783', 'user', 'sholiha.zakaria@gmail.com', '0182679302', 'sholiha.zakaria@gmail.com', '123'),
(13, 'MUHAMMAD AMEER BIN ZULKARNAIN', 'WES150015', '3543788607', 'user', 'ameerzulkarnain@gmail.com', '0173868337', 'ameerzulkarnain', '123'),
(14, 'MUHAMMAD RASHID BIN SARIFUDDIN', 'WES150019', '0768422695', 'user', 'mrrashid125@gmail.com', '01131232030', 'mrashid', '1234'),
(15, 'NURANIS ILLIANI BINTI MOHAMAD ZAIDI', 'WES150022', '3543687647', 'user', 'anisilliani9@gmail.com', '0135268545', 'anisilliani', '123'),
(16, 'NURUL NADIA BINTI ABDUL HALIM', 'WES150024', '3543683391', 'user', 'nrlnadia1826@gmail.com', '0175301308', 'nurulnadia', '123'),
(17, 'ZAFIQA SHAREEN ZAMERA', 'WIF160066', '2017434943', 'user', 'zafiqashareenzamera@gmail.com', '0145551646', 'zafiqashareen', '123'),
(18, 'SITI NURFARHANIS BT MOHD MUSTAKIN', 'WIF160055', '2017158079', 'user', 'sitinurfarhaniss@gmail.com', '0194075129', 'anismustakin', '123'),
(19, 'IRSYAD BIN SHAMSUDIN', 'WES150009', '3543596127', 'user', 'eisyad.irsyad@gmail.com', '0173199972', 'eisyad.irsyad', '123'),
(20, 'ZAIHUSNA IZZATI BINTI ZAINUDDIN', 'WES150040', '3543788127', 'user', 'zaihusna.izzati@siswa.um.edu.my', '0134666974', 'zaihusnaizzati', '123'),
(21, 'NUR AINI BINTI MOHAMAD ZAINUDIN', 'WES150020', '1793968291', 'user', 'ainizainudinn@gmail.com', '0102447096', 'ainizainudin', '123'),
(22, 'OMAR MOKHTAR BIN KASIM', 'WES150049', '3543837471', 'user', 'omar.veyron@gmail.com', '0175178252', 'omarqe', '123'),
(23, 'MUHAMMAD FIRDAUS BIN', 'WES150018', '3543534527', 'user', 'firifeu@gmail.com', '0189451384', 'firdaus', '123'),
(24, 'AbdlRahman Mohammed Fathy', 'WIF160711', '2017119007', 'user', 'abdlrahmanfathy2020@siswa.um.edu.my', '01116400794', 'AbdlRahman', '123'),
(25, 'Ali Hasan Sumait', 'WIF160712', '2017254367', 'user', 'alisumait@siswa.um.edu.my', '0175561614', 'alisumait', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ProfileID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `ProfileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
