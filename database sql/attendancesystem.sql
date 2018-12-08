-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 06:10 PM
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
  `Status` text,
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
(1, 'TEOW QIN KAE', 'WES150036', '3543696191', 'user', 'qkae96@siswa.um.edu.my', '0149887023', 'qkae96', '1234'),
(2, 'TEOH ZHI YU', 'WES150051', '3543846751', 'user', 'tzy_1996@hotmail.com', '0164691494', NULL, NULL),
(3, 'DR. SU MOON TING', NULL, NULL, 'admin', 'smting@um.edu.my', '+603-79676369', 'admin', 'admin'),
(6, 'ENG ZHI YUAN', 'WES150008', '3543603455', 'user', 'engzhiyuan96@gmail.com', '0125176801', 'engzhiyuan', '123'),
(7, 'WEE CHEE SAN', 'WES150038', '3543846239', 'user', 'leonweecs@gmail.com', '0104315105', 'leonweecs', '123'),
(8, 'TEOH KHAU KHENG', 'WES150035', '3543783679', 'user', 'khenggy111@gmail.com', '0174567919', 'Kheng', '123'),
(9, 'AHMAD RIFQI BIN AHMAD ROKIS', 'WES150004', '3543610879', 'user', 'rifqi.rokis.1996@gmailcom', '0132037015', 'Rifqi', '123'),
(10, 'QURRATU AINI BT HASRAM', 'WES150050', '3543779231', 'user', 'qurratu.aini996@gmail.com', '018-3664403', 'Ratu', '123'),
(11, 'CHEMPAKA SERI BINTI ABDUL RAZAK', 'WES150043', '1232599167', 'user', 'chempakaseri96@gmail.com', '0183100257', 'chempakaseri', '123'),
(12, 'SITI SHOLIHA BINTI', 'WES150033', '3543562783', 'user', 'sholiha.zakaria@gmail.com', '0182679302', 'sholiha.zakaria@gmail.com', '123'),
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
(24, 'ABDLRAHMAN MOHAMMED FATHY', 'WIF160711', '2017119007', 'user', 'abdlrahmanfathy2020@siswa.um.edu.my', '01116400794', 'AbdlRahman', '123'),
(25, 'ALI HASAN SUMAIT', 'WIF160712', '2017254367', 'user', 'alisumait@siswa.um.edu.my', '0175561614', 'alisumait', '123'),
(26, 'MUHAMMAD SAIFUL HUSAINI BIN SYAFIE', 'WIF160039', '2017081311', 'user', 'saifulhusainisyafie@gmail.com', '0149660726', 'Saiful Husaini', '123'),
(27, 'NURUL AFIQAH BINTI MOHAMAD', 'WES150023', '3543792575', 'user', 'nurulafiqahmohamad@gmail.com', '0127707525', 'Afiqah', '123'),
(28, 'MUHAMMAD ADIB FAIZ BIN ABIDIN', 'WES150013', '0876913343', 'user', 'adib1204@gmail.com', '0133903612', 'ADIB', '123'),
(29, 'MUHAMMAD DZAQWAN BIN AMIR KHAIRUL ANWAR', 'WES150017', '3543674943', 'user', 'dzaqwan1234@gmail.com', '01118658587', 'dzaqwan', '123'),
(30, 'MUHAMMAD AKMA ADHWA BIN ZAMBURI', 'wes150014', '3543666591', 'user', 'muhdakma63@gmail.com', '0133356363', 'akma adhwa', '123'),
(31, 'SALVIN A/L RAVINDRAN', 'WES150030', '3543553567', 'user', 'salvinravindran@gmail.com', '0172723296', 'salvin', '123'),
(32, 'RAVINDRAN A/L MANICKAM', 'WES150028', '3543539583', 'user', 'ravindranmanickam07@gmail.com', '0169071589', 'ravindranmanickam07', '123'),
(33, 'KHOO BAO XUAN', 'WES150010', '3543592543', 'user', 'baoxuan9616@gmail.com', '0169157190', 'bx', '123'),
(34, 'WANG ZHONG QI', 'WES150037', '3543837983', 'user', 'wangzq@gmail.com', '0172886064', 'zq', '123'),
(35, 'CHEONG CHAH WEI', 'WES150007', '3543599775', 'user', 'chahwei@gmail.com', '0123702243', 'cw', '123'),
(36, 'TAN HAN YANG', 'WES150034', '3543569119', 'user', 'thy1996@gmail.com', '0189614833', 'thy', '123'),
(37, 'OOI KEE AUN', 'WES150026', '3543537023', 'user', 'oka1996@gmail.com', '0175686716', 'oka', '123'),
(38, '', '', '', 'user', 'inde@hotmail.com', '', 'qqq', '123');

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
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `ProfileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
