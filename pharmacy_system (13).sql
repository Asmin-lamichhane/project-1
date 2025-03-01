-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 06:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `TOTAL_AMT` (IN `sale_id` INT, OUT `total_amt` DECIMAL(10,2))   BEGIN
    SELECT SUM(tot_price) INTO total_amt
    FROM sales_items
    WHERE sale_id = sale_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_username` varchar(50) NOT NULL,
  `a_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_username`, `a_password`) VALUES
(1, 'admin', '$2y$10$QccFIPt1fDMOCg5oHKyF/uuKOlMRTXr203llOsNm2W9a5c35C9sWu');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `medid` int(11) DEFAULT NULL,
  `medname` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `sale_id`, `sale_date`, `employee_name`, `customer_name`, `medid`, `medname`, `qty`, `price`, `grand_total`, `created_at`) VALUES
(3, 59, '2025-02-28', 'asminn', 'Unknown', 23, 'df', 10, 23.00, 230.00, '2025-02-28 17:42:03'),
(4, 60, '2025-02-28', 'asminn', 'asm as', 23, 'df', 5, 23.00, 115.00, '2025-02-28 17:42:03'),
(26, 102, '2025-02-28', 'asmin', 'Sita Adhikari', 2, 'Ibuprofen', 5, 8.50, 42.00, '2025-02-28 18:58:39'),
(27, 104, '2025-02-28', 'asmin', 'Sita Adhikari', 3, 'Amoxicillin', 1, 15.00, 15.00, '2025-02-28 20:13:25'),
(28, 104, '2025-02-28', 'asmin', 'Sita Adhikari', 2, 'Ibuprofen', 1, 8.50, 23.00, '2025-02-28 20:13:25'),
(29, 105, '2025-02-28', 'asmin', 'Radha Joshi', 4, 'Cefixime', 5, 18.00, 90.00, '2025-02-28 20:13:51'),
(30, 105, '2025-02-28', 'asmin', 'Radha Joshi', 4, 'Cefixime', 5, 18.00, 90.00, '2025-02-28 20:16:10'),
(31, 105, '2025-02-28', 'asmin', 'Radha Joshi', 3, 'Amoxicillin', 1, 15.00, 105.00, '2025-02-28 20:16:10'),
(32, 105, '2025-02-28', 'asmin', 'Radha Joshi', 4, 'Cefixime', 4, 18.00, 177.00, '2025-02-28 20:16:10'),
(33, 106, '2025-02-28', 'asmin', 'Sita Adhikari', 6, 'Cetirizine', 4, 3.50, 14.00, '2025-02-28 20:20:50'),
(34, 107, '2025-02-28', 'asmin', 'Bijay Tamang', 9, 'Omeprazole', 4, 10.00, 40.00, '2025-02-28 20:21:12'),
(35, 107, '2025-02-28', 'asmin', 'Bijay Tamang', 9, 'Omeprazole', 4, 10.00, 40.00, '2025-02-28 20:21:31'),
(36, 107, '2025-02-28', 'asmin', 'Bijay Tamang', 5, 'Azithromycin', 1, 22.00, 62.00, '2025-02-28 20:21:31'),
(37, 107, '2025-02-28', 'asmin', 'Bijay Tamang', 3, 'Amoxicillin', 1, 15.00, 15.00, '2025-02-28 20:22:33'),
(38, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 6, 'Cetirizine', 8, 3.50, 28.00, '2025-02-28 20:22:55'),
(39, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 6, 'Cetirizine', 8, 3.50, 28.00, '2025-02-28 20:23:12'),
(40, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 9, 'Omeprazole', 7, 10.00, 98.00, '2025-02-28 20:23:12'),
(41, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 6, 'Cetirizine', 8, 3.50, 28.00, '2025-02-28 20:23:32'),
(42, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 9, 'Omeprazole', 7, 10.00, 98.00, '2025-02-28 20:23:32'),
(43, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 14, 'Losartan', 5, 14.00, 168.00, '2025-02-28 20:23:32'),
(44, 108, '2025-02-28', 'asmin', 'Shyam Khadka', 2, 'Ibuprofen', 1, 8.50, 8.00, '2025-02-28 20:28:13'),
(45, 109, '2025-02-28', 'asmin', 'Gita Bhandari', 6, 'Cetirizine', 4, 3.50, 14.00, '2025-02-28 20:42:56'),
(46, 109, '2025-02-28', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 1, 18.00, 18.00, '2025-02-28 20:44:09'),
(47, 109, '2025-02-28', 'asmin', 'Gita Bhandari', 2, 'Ibuprofen', 1, 8.50, 8.00, '2025-02-28 20:52:43'),
(48, 110, '2025-02-28', 'asmin', 'Radha Joshi', 10, 'Pantoprazole', 5, 11.50, 57.00, '2025-02-28 21:00:00'),
(49, 110, '2025-02-28', 'asmin', 'Radha Joshi', 10, 'Pantoprazole', 5, 11.50, 57.00, '2025-02-28 21:01:42'),
(50, 110, '2025-02-28', 'asmin', 'Radha Joshi', 6, 'Cetirizine', 4, 3.50, 71.00, '2025-02-28 21:01:42'),
(51, 110, '2025-02-28', 'asmin', 'Radha Joshi', 9, 'Omeprazole', 5, 10.00, 121.00, '2025-02-28 21:01:42'),
(52, 111, '2025-02-28', 'asmin', 'Shyam Khadka', 6, 'Cetirizine', 7, 3.50, 24.00, '2025-02-28 21:04:17'),
(53, 111, '2025-02-28', 'asmin', 'Shyam Khadka', 8, 'Ranitidine', 2, 6.00, 36.00, '2025-02-28 21:04:17'),
(54, 112, '2025-02-28', 'asmin', 'Prakash Shrestha', 6, 'Cetirizine', 2, 3.50, 7.00, '2025-02-28 21:04:37'),
(55, 112, '2025-02-28', 'asmin', 'Prakash Shrestha', 6, 'Cetirizine', 2, 3.50, 7.00, '2025-02-28 21:04:51'),
(56, 112, '2025-02-28', 'asmin', 'Prakash Shrestha', 7, 'Montelukast', 1, 12.00, 19.00, '2025-02-28 21:04:51'),
(57, 113, '2025-02-28', 'asmin', 'Unknown', 6, 'Cetirizine', 9, 3.50, 31.00, '2025-02-28 21:09:10'),
(58, 114, '2025-02-28', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 10, 18.00, 180.00, '2025-02-28 21:09:29'),
(59, 114, '2025-02-28', 'asmin', 'Gita Bhandari', 7, 'Montelukast', 4, 12.00, 48.00, '2025-02-28 21:19:13'),
(60, 114, '2025-02-28', 'asmin', 'Gita Bhandari', 6, 'Cetirizine', 4, 3.50, 62.00, '2025-02-28 21:19:13'),
(61, 114, '2025-02-28', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 2, 18.00, 98.00, '2025-02-28 21:19:13'),
(62, 116, '2025-02-28', 'asmin', 'Gita Bhandari', 9, 'Omeprazole', 4, 10.00, 40.00, '2025-02-28 21:19:35'),
(63, 116, '2025-02-28', 'asmin', 'Gita Bhandari', 5, 'Azithromycin', 1, 22.00, 22.00, '2025-02-28 21:24:27'),
(64, 116, '2025-02-28', 'asmin', 'Gita Bhandari', 3, 'Amoxicillin', 4, 15.00, 60.00, '2025-02-28 21:26:24'),
(65, 116, '2025-02-28', 'asmin', 'Gita Bhandari', 7, 'Montelukast', 6, 12.00, 132.00, '2025-02-28 21:26:24'),
(66, 116, '2025-02-28', 'asmin', 'Gita Bhandari', 5, 'Azithromycin', 5, 22.00, 110.00, '2025-02-28 21:30:31'),
(67, 118, '2025-02-28', 'asmin', 'Dipendra Karki', 9, 'Omeprazole', 9, 10.00, 90.00, '2025-02-28 21:30:59'),
(68, 119, '2025-02-28', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 1, 18.00, 18.00, '2025-02-28 21:34:17'),
(69, 120, '2025-02-28', 'asmin', 'Sita Adhikari', 1, 'Paracetamol', 2, 5.00, 10.00, '2025-02-28 21:34:34'),
(70, 121, '2025-02-28', 'asmin', 'Sita Adhikari', 5, 'Azithromycin', 5, 22.00, 110.00, '2025-02-28 21:39:42'),
(71, 121, '2025-02-28', 'asmin', 'Sita Adhikari', 5, 'Azithromycin', 5, 22.00, 110.00, '2025-02-28 21:40:44'),
(72, 121, '2025-02-28', 'asmin', 'Sita Adhikari', 7, 'Montelukast', 1, 12.00, 122.00, '2025-02-28 21:40:44'),
(73, 125, '2025-03-01', 'asmin', 'Hari Dahal', 3, 'Amoxicillin', 4, 15.00, 60.00, '2025-03-01 00:01:22'),
(74, 125, '2025-03-01', 'asmin', 'Hari Dahal', 3, 'Amoxicillin', 4, 15.00, 60.00, '2025-03-01 00:01:39'),
(75, 126, '2025-03-01', 'asmin', 'Gita Bhandari', 6, 'Cetirizine', 4, 3.50, 14.00, '2025-03-01 00:02:19'),
(76, 127, '2025-03-01', 'asmin', 'Gita Bhandari', 1, 'Paracetamol', 10, 5.00, 50.00, '2025-03-01 00:07:22'),
(77, 127, '2025-03-01', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 1, 18.00, 68.00, '2025-03-01 00:07:22'),
(78, 134, '2025-03-01', 'asmin', 'Hari Dahal', 3, 'Amoxicillin', 2, 15.00, 30.00, '2025-03-01 20:42:25'),
(79, 135, '2025-03-01', 'asmin', 'Gita Bhandari', 4, 'Cefixime', 12, 18.00, 216.00, '2025-03-01 21:16:32'),
(80, 136, '2025-03-01', 'ramm', 'Hari Dahal', 4, 'Cefixime', 1, 18.00, 18.00, '2025-03-01 21:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `cfname` varchar(50) DEFAULT NULL,
  `clname` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `phno` bigint(20) DEFAULT NULL,
  `emid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cfname`, `clname`, `age`, `sex`, `phno`, `emid`) VALUES
(1, 'Ramesh', 'Sharma', 28, 'M', 9841000001, 'ram.sharma@example.com'),
(2, 'Sita', 'Adhikari', 25, 'F', 9841000002, 'sita.adhikari@example.com'),
(3, 'Hari', 'Dahal', 32, 'M', 9841000003, 'hari.dahal@example.com'),
(4, 'Gita', 'Bhandari', 29, 'F', 9841000004, 'gita.bhandari@example.com'),
(5, 'Krishna', 'Tiwari', 35, 'M', 9841000005, 'krishna.tiwari@example.com'),
(6, 'Radha', 'Joshi', 27, 'F', 9841000006, 'radha.joshi@example.com'),
(7, 'Shyam', 'Khadka', 30, 'M', 9841000007, 'shyam.khadka@example.com'),
(8, 'Laxmi', 'Poudel', 24, 'F', 9841000008, 'laxmi.poudel@example.com'),
(9, 'Bikash', 'Rai', 31, 'M', 9841000009, 'bikash.rai@example.com'),
(10, 'Anita', 'Maharjan', 26, 'F', 9841000010, 'anita.maharjan@example.com'),
(11, 'Suresh', 'Thapa', 34, 'M', 9841000011, 'suresh.thapa@example.com'),
(12, 'Rita', 'Gurung', 29, 'F', 9841000012, 'rita.gurung@example.com'),
(13, 'Prakash', 'Shrestha', 33, 'M', 9841000013, 'prakash.shrestha@example.com'),
(14, 'Manisha', 'Bista', 28, 'F', 9841000014, 'manisha.bista@example.com'),
(15, 'Ramesh', 'Basnet', 36, 'M', 9841000015, 'ramesh.basnet@example.com'),
(16, 'Sarita', 'Magar', 27, 'F', 9841000016, 'sarita.magar@example.com'),
(17, 'Dipendra', 'Karki', 31, 'M', 9841000017, 'dipendra.karki@example.com'),
(18, 'Sunita', 'Lama', 26, 'F', 9841000018, 'sunita.lama@example.com'),
(19, 'Bijay', 'Tamang', 30, 'M', 9841000019, 'bijay.tamang@example.com'),
(20, 'Meera', 'Sherpa', 25, 'F', 9841000020, 'meera.sherpa@example.com'),
(21, 'Kishor', 'Ghising', 32, 'M', 9841000021, 'kishor.ghising@example.com'),
(22, 'Sabina', 'Moktan', 27, 'F', 9841000022, 'sabina.moktan@example.com'),
(23, 'Niraj', 'Dong', 34, 'M', 9841000023, 'niraj.dong@example.com'),
(24, 'Puja', 'Maharjan', 29, 'F', 9841000024, 'puja.maharjan@example.com'),
(25, 'Sandesh', 'Newar', 30, 'M', 9841000025, 'sandesh.newar@example.com'),
(27, 'Bimal', 'Thakuri', 33, 'M', 9841000027, 'bimal.thakuri@example.com'),
(28, 'Karishma', 'Ghale', 28, 'F', 9841000028, 'karishma.ghale@example.com'),
(29, 'Santosh', 'Gurung', 35, 'M', 9841000029, 'santosh.gurung@example.com'),
(30, 'Mina', 'Rai', 24, 'F', 9841000030, 'mina.rai@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `efname` varchar(100) NOT NULL,
  `elname` varchar(100) NOT NULL,
  `ebdate` date NOT NULL,
  `eage` int(11) NOT NULL,
  `esex` enum('M','F','Other') NOT NULL,
  `etype` varchar(50) NOT NULL,
  `ejdate` date NOT NULL,
  `esal` decimal(10,2) NOT NULL,
  `ephno` varchar(15) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `eadd` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `efname`, `elname`, `ebdate`, `eage`, `esex`, `etype`, `ejdate`, `esal`, `ephno`, `e_mail`, `eadd`, `username`, `password_hash`) VALUES
(1, 'asmin', 'lamichhane', '2002-10-03', 22, '', 'Pharmacist', '2025-02-28', 10000.00, '9812200832', 'asmin95534@gmail.com', 'ktm', 'asmin', '$2y$10$E1aHWLVmwd23n67E5sfRcOT9Yr0Hh93kswguVCiWnO5Ajd.IcZdDK'),
(2, 'bishwash', 'purkoti', '2003-02-02', 22, '', 'Manager', '2025-03-01', 120000.00, '9845612347', 'bishwash@gmail.com', 'lalitpur', 'bish', '$2y$10$/BvBoOuwHzLCYkvYhsh.l.qvh3XJOGcix9UiSrZGXKLfCSnRP88Iq'),
(12, 'asminnnn', 'lamicjjj', '2005-05-09', 19, '', 'Pharmacist', '2025-03-01', 20000.00, '9874561230', 'asjdnd@gmail.com', 'ltp', 'as1', '$2y$10$Aq4k5MbhleJKtTUPbXGxgepmOrEREf.Dr62cIrqkqC2BrYuxIJa8C'),
(75, 'ramm', 'thapa', '2007-03-03', 17, '', 'Manager', '2025-03-27', 100000.00, '9632014785', 'dhfgvdshb@gmail.com', 'ktm', 'hii', '$2y$10$g.ZJpxdL7bT.KSjL0nWBXe3HMd9oKQhIHzMKYkaeJsBDPFXI99QzS');

-- --------------------------------------------------------

--
-- Table structure for table `meds`
--

CREATE TABLE `meds` (
  `medid` int(11) NOT NULL,
  `medname` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL CHECK (`qty` > 0),
  `cat` enum('Tablet','Capsule','Syrup') NOT NULL,
  `sp` decimal(10,2) NOT NULL CHECK (`sp` > 0),
  `loc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meds`
--

INSERT INTO `meds` (`medid`, `medname`, `qty`, `cat`, `sp`, `loc`) VALUES
(1, 'Paracetamol', 1488, 'Tablet', 5.00, 'Shelf A1'),
(2, 'Ibuprofen', 1192, 'Tablet', 8.50, 'Shelf A2'),
(3, 'Amoxicillin', 1783, 'Capsule', 15.00, 'Shelf B1'),
(4, 'Cefixime', 1258, 'Capsule', 18.00, 'Shelf B2'),
(5, 'Azithromycin', 1582, 'Tablet', 22.00, 'Shelf A3'),
(6, 'Cetirizine', 1036, 'Tablet', 3.50, 'Shelf A4'),
(7, 'Montelukast', 1388, 'Tablet', 12.00, 'Shelf A5'),
(8, 'Ranitidine', 1248, 'Tablet', 6.00, 'Shelf A6'),
(9, 'Omeprazole', 1310, 'Capsule', 10.00, 'Shelf B3'),
(10, 'Pantoprazole', 1690, 'Capsule', 11.50, 'Shelf B4'),
(11, 'Metformin', 1550, 'Tablet', 7.00, 'Shelf C1'),
(12, 'Glibenclamide', 1450, 'Tablet', 9.00, 'Shelf C2'),
(13, 'Amlodipine', 1900, 'Tablet', 5.50, 'Shelf D1'),
(14, 'Losartan', 1245, 'Tablet', 14.00, 'Shelf D2'),
(15, 'Atorvastatin', 1400, 'Tablet', 20.00, 'Shelf D3'),
(16, 'Simvastatin', 1100, 'Tablet', 17.00, 'Shelf D4'),
(17, 'Diclofenac', 1750, 'Tablet', 6.50, 'Shelf A7'),
(18, 'Naproxen', 1600, 'Tablet', 9.50, 'Shelf A8'),
(19, 'Hydroxyzine', 1400, 'Tablet', 7.80, 'Shelf A9'),
(20, 'Fexofenadine', 1800, 'Tablet', 13.20, 'Shelf A10'),
(21, 'Dextromethorphan', 1550, 'Syrup', 25.00, 'Shelf E1'),
(22, 'Ambroxol', 1300, 'Syrup', 28.00, 'Shelf E2'),
(23, 'Salbutamol', 1400, 'Syrup', 30.00, 'Shelf E3'),
(24, 'Chlorpheniramine', 1250, 'Syrup', 18.00, 'Shelf E4'),
(25, 'Bromhexine', 1750, 'Syrup', 22.50, 'Shelf E5'),
(26, 'Acetaminophen', 1500, 'Syrup', 19.00, 'Shelf E6'),
(27, 'Erythromycin', 1350, 'Tablet', 26.00, 'Shelf B5'),
(28, 'Mefenamic Acid', 1900, 'Tablet', 10.00, 'Shelf A11'),
(29, 'Levofloxacin', 1250, 'Tablet', 32.00, 'Shelf B6'),
(30, 'Doxycycline', 1800, 'Capsule', 28.00, 'Shelf B7'),
(31, 'Clarithromycin', 1400, 'Tablet', 35.00, 'Shelf B8'),
(32, 'Loratadine', 1100, 'Tablet', 8.00, 'Shelf A12'),
(33, 'Prednisolone', 1750, 'Tablet', 9.50, 'Shelf C3'),
(34, 'Hydrocortisone', 1250, 'Tablet', 12.00, 'Shelf C4'),
(35, 'Betamethasone', 1600, 'Tablet', 15.50, 'Shelf C5'),
(36, 'Dexamethasone', 1300, 'Tablet', 16.00, 'Shelf C6'),
(37, 'Fluconazole', 1450, 'Capsule', 20.00, 'Shelf B9'),
(38, 'Itraconazole', 1100, 'Capsule', 27.50, 'Shelf B10'),
(39, 'Ketoconazole', 1700, 'Tablet', 23.00, 'Shelf B11'),
(40, 'Domperidone', 1250, 'Tablet', 6.00, 'Shelf D5'),
(41, 'Ondansetron', 1900, 'Tablet', 12.50, 'Shelf D6'),
(42, 'Rabeprazole', 1350, 'Capsule', 14.00, 'Shelf D7'),
(43, 'Esomeprazole', 1100, 'Capsule', 16.50, 'Shelf D8'),
(44, 'Folic Acid', 1450, 'Tablet', 5.00, 'Shelf C7'),
(45, 'Vitamin C', 1700, 'Tablet', 8.00, 'Shelf C8'),
(46, 'Zinc Sulfate', 1200, 'Tablet', 10.00, 'Shelf C9'),
(47, 'Calcium Carbonate', 1800, 'Tablet', 12.50, 'Shelf C10'),
(48, 'Iron Fumarate', 1750, 'Tablet', 9.00, 'Shelf C11'),
(49, 'Magnesium Oxide', 1550, 'Tablet', 13.00, 'Shelf C12'),
(50, 'Vitamin D3', 1300, 'Capsule', 18.00, 'Shelf C13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `pid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `pqty` int(11) NOT NULL,
  `pcost` decimal(10,2) NOT NULL,
  `pdate` date NOT NULL,
  `mdate` date NOT NULL,
  `edate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`pid`, `sid`, `mid`, `pqty`, `pcost`, `pdate`, `mdate`, `edate`) VALUES
(1, 1, 5, 1500, 20000.00, '2024-01-10', '2023-12-15', '2025-12-15'),
(2, 2, 10, 1800, 25000.00, '2024-01-12', '2023-12-20', '2026-12-20'),
(3, 3, 15, 2000, 30000.00, '2024-01-15', '2024-01-01', '2026-01-01'),
(4, 4, 20, 2200, 35000.00, '2024-01-18', '2024-01-05', '2026-01-05'),
(5, 5, 25, 1700, 27000.00, '2024-01-20', '2023-12-25', '2025-12-25'),
(6, 6, 30, 1900, 32000.00, '2024-01-22', '2024-01-10', '2026-01-10'),
(7, 7, 35, 2100, 34000.00, '2024-01-25', '2024-01-12', '2026-01-12'),
(8, 8, 40, 2500, 40000.00, '2024-01-28', '2024-01-15', '2026-01-15'),
(9, 9, 45, 2300, 37000.00, '2024-02-01', '2024-01-18', '2026-01-18'),
(10, 10, 50, 2600, 42000.00, '2024-02-05', '2024-01-20', '2026-01-20'),
(11, 11, 1, 1400, 19000.00, '2024-02-08', '2024-01-25', '2025-12-25'),
(12, 12, 6, 1800, 24000.00, '2024-02-10', '2024-01-28', '2026-01-28'),
(13, 13, 11, 2000, 28000.00, '2024-02-12', '2024-02-01', '2026-02-01'),
(14, 14, 16, 2200, 32000.00, '2024-02-15', '2024-02-05', '2026-02-05'),
(15, 15, 21, 2400, 35000.00, '2024-02-18', '2024-02-08', '2026-02-08'),
(16, 16, 26, 1700, 29000.00, '2024-02-20', '2024-02-10', '2026-02-10'),
(17, 17, 31, 1900, 31000.00, '2024-02-22', '2024-02-12', '2026-02-12'),
(18, 18, 36, 2100, 34000.00, '2024-02-25', '2024-02-15', '2026-02-15'),
(19, 19, 41, 2500, 38000.00, '2024-02-28', '2024-02-18', '2026-02-18'),
(20, 20, 46, 2300, 35000.00, '2024-03-01', '2024-02-20', '2026-02-20'),
(21, 1, 3, 1600, 22000.00, '2024-03-05', '2024-02-25', '2026-02-25'),
(22, 2, 8, 1800, 26000.00, '2024-03-08', '2024-02-28', '2026-02-28'),
(23, 3, 13, 2000, 29000.00, '2024-03-10', '2024-03-01', '2026-03-01'),
(24, 4, 18, 2200, 32000.00, '2024-03-12', '2024-03-05', '2026-03-05'),
(25, 5, 23, 2400, 36000.00, '2024-03-15', '2024-03-08', '2026-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `sale_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `cid`, `eid`, `sale_date`) VALUES
(113, NULL, NULL, '2025-02-28 21:08:39'),
(114, 4, NULL, '2025-02-28 21:09:19'),
(116, 4, NULL, '2025-02-28 21:19:26'),
(117, 6, NULL, '2025-02-28 21:30:39'),
(118, 17, NULL, '2025-02-28 21:30:45'),
(119, 4, NULL, '2025-02-28 21:34:05'),
(120, 2, NULL, '2025-02-28 21:34:25'),
(121, 2, NULL, '2025-02-28 21:38:40'),
(122, 4, NULL, '2025-02-28 21:59:12'),
(123, 4, NULL, '2025-02-28 23:41:19'),
(124, 8, NULL, '2025-02-28 23:58:12'),
(125, 3, NULL, '2025-03-01 00:01:00'),
(126, 4, NULL, '2025-03-01 00:01:48'),
(127, 4, NULL, '2025-03-01 00:06:17'),
(128, 4, NULL, '2025-03-01 15:08:01'),
(130, 8, NULL, '2025-03-01 19:37:12'),
(131, 8, NULL, '2025-03-01 19:37:51'),
(132, 4, NULL, '2025-03-01 19:38:54'),
(133, 5, NULL, '2025-03-01 19:40:28'),
(134, 3, NULL, '2025-03-01 20:42:14'),
(135, 4, NULL, '2025-03-01 21:16:01'),
(136, 3, NULL, '2025-03-01 21:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sales_items_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `medid` int(11) DEFAULT NULL,
  `sale_qty` int(11) NOT NULL,
  `tot_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`sales_items_id`, `sale_id`, `medid`, `sale_qty`, `tot_price`) VALUES
(112, 113, 6, 9, 31.50),
(114, 114, 7, 4, 48.00),
(117, 114, 6, 4, 14.00),
(118, 114, 4, 2, 36.00),
(125, 116, 5, 5, 110.00),
(126, 118, 9, 9, 90.00),
(127, 119, 4, 1, 18.00),
(128, 120, 1, 2, 10.00),
(129, 121, 5, 5, 110.00),
(130, 121, 7, 1, 12.00),
(131, 121, 7, 1, 12.00),
(132, 121, 4, 1, 18.00),
(133, 121, 4, 1, 18.00),
(139, 122, 6, 3, 10.50),
(140, 122, 6, 10, 35.00),
(141, 123, 12, 10, 90.00),
(142, 123, 12, 10, 90.00),
(143, 123, 12, 10, 90.00),
(144, 123, 12, 10, 90.00),
(145, 123, 12, 10, 90.00),
(146, 123, 12, 10, 90.00),
(147, 123, 12, 10, 90.00),
(148, 123, 12, 10, 90.00),
(149, 123, 12, 10, 90.00),
(150, 123, 12, 10, 90.00),
(151, 124, 5, 10, 220.00),
(152, 124, 5, 10, 220.00),
(153, 124, 9, 5, 50.00),
(154, 125, 3, 4, 60.00),
(155, 126, 6, 4, 14.00),
(156, 127, 1, 10, 50.00),
(157, 127, 4, 1, 18.00),
(158, 128, 4, 4, 72.00),
(159, 128, 5, 10, 220.00),
(160, 130, 9, 10, 100.00),
(161, 130, 9, 10, 100.00),
(162, 131, 6, 10, 35.00),
(163, 131, 6, 10, 35.00),
(164, 132, 4, 10, 180.00),
(165, 132, 6, 10, 35.00),
(166, 132, 6, 10, 35.00),
(167, 133, 6, 10, 35.00),
(168, 134, 3, 2, 30.00),
(170, 135, 4, 12, 216.00),
(171, 136, 4, 1, 18.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sid` int(11) NOT NULL,
  `sName` varchar(255) NOT NULL,
  `sadd` varchar(255) NOT NULL,
  `sPhno` bigint(20) NOT NULL,
  `smail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sid`, `sName`, `sadd`, `sPhno`, `smail`) VALUES
(1, 'Everest Pharma', 'Kathmandu, Nepal', 9801234567, 'info@everestpharma.com'),
(2, 'Himalayan Meds', 'Pokhara, Nepal', 9802234567, 'contact@himalayanmeds.com'),
(3, 'Nepal Medicos', 'Lalitpur, Nepal', 9803234567, 'support@nepalmedicos.com'),
(4, 'Sagarmatha Distributors', 'Bhaktapur, Nepal', 9804234567, 'sales@sagarmathadistributors.com'),
(5, 'Annapurna Pharmaceuticals', 'Dharan, Nepal', 9805234567, 'info@annapurnapharma.com'),
(6, 'Pashupati Healthcare', 'Butwal, Nepal', 9806234567, 'contact@pashupatihealthcare.com'),
(7, 'Janaki Med Suppliers', 'Janakpur, Nepal', 9807234567, 'support@janakimeds.com'),
(8, 'Boudha Pharmaceuticals', 'Biratnagar, Nepal', 9808234567, 'info@boudhapharma.com'),
(9, 'Lumbini Pharma', 'Lumbini, Nepal', 9809234567, 'sales@lumbinipharma.com'),
(10, 'Gorkha Medicos', 'Gorkha, Nepal', 9810234567, 'contact@gorkhamedicos.com'),
(11, 'Seti Healthcare', 'Dhangadhi, Nepal', 9811234567, 'support@setihealthcare.com'),
(12, 'Koshi Pharma', 'Birgunj, Nepal', 9812234567, 'info@kospharma.com'),
(13, 'Dhaulagiri Distributors', 'Baglung, Nepal', 9813234567, 'sales@dhaulagiri.com'),
(14, 'Manaslu Medicines', 'Chitwan, Nepal', 9814234567, 'contact@manaslumeds.com'),
(15, 'Rara Pharma', 'Jumla, Nepal', 9815234567, 'support@rarapharma.com'),
(16, 'Mechi Med Suppliers', 'Bhadrapur, Nepal', 9816234567, 'info@mechimed.com'),
(17, 'Karnali Healthcare', 'Surkhet, Nepal', 9817234567, 'sales@karnalihealthcare.com'),
(18, 'Mahakali Pharma', 'Mahendranagar, Nepal', 9818234567, 'contact@mahakalipharma.com'),
(19, 'Everest Distributors', 'Taplejung, Nepal', 9819234567, 'support@everestdistributors.com'),
(20, 'Trishuli Medicos', 'Nuwakot, Nepal', 9820234567, 'info@trishulimeds.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `a_username` (`a_username`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `medid` (`medid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `meds`
--
ALTER TABLE `meds`
  ADD PRIMARY KEY (`medid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sales_items_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `medid` (`medid`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `smail` (`smail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4445;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sales_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256569;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`medid`) REFERENCES `meds` (`medid`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `employee` (`eid`) ON DELETE CASCADE;

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`medid`) REFERENCES `meds` (`medid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
