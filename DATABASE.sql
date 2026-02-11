-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 02:49 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(3) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'krisha', 'rajpura'),
(2, 'manya', 'trivedi');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `type` varchar(20) NOT NULL,
  `id` int(4) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `cost` float NOT NULL,
  `photo` varchar(100) NOT NULL,
  `product_id` int(15) NOT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(3) NOT NULL,
  `c_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Furniture'),
(2, 'Clothing'),
(3, 'Accessories'),
(4, 'Automobiles'),
(5, 'Gadgets'),
(6, 'others'),
(16, 'makeup');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `pname` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`pname`, `price`, `fname`, `lname`, `email`, `contact`, `address`) VALUES
('sofa', 40000, 'krisha', 'rajpura', 'krisharajpura@gmail.com', '9988776655', 'makan'),
('gown', 5000, 'user', 'rajpura', 'krisharajpura@gmail.com', '6577889034', 'kahan'),
('purse ', 500, 'krisha', 'rajpura', 'krisharajpura@gmail.com', '6577889034', 'home'),
('sofa', 40000, 'janvi', 'patel', 'janvi10@gmail.com', '6577889034', 'delhi'),
('blazzer', 1200, 'krisha', 'rajpura', 'krisharajpura@gmail.com', '9988776655', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `type` varchar(20) NOT NULL,
  `id` int(4) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `height` float NOT NULL,
  `length` float NOT NULL,
  `width` float NOT NULL,
  `pdate` date NOT NULL,
  `edate` date NOT NULL,
  `cost` float NOT NULL,
  `info` varchar(200) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(10) NOT NULL,
  `contact` text NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`type`, `id`, `pname`, `height`, `length`, `width`, `pdate`, `edate`, `cost`, `info`, `photo`, `name`, `address`, `pincode`, `contact`, `product_id`) VALUES
('Furniture', 1, 'sofa', 90, 0, 200, '2021-07-07', '0000-00-00', 18000, 'great quality and sturdy', 'upload/f6.jpg', 'tanisha', '1026/s , mnc society junagadh ', 364007, '9988776655', 47),
('Furniture', 1, 'rocking chair', 110, 0, 70, '2022-09-20', '0000-00-00', 2000, 'wooden chair with intrigued craftsmanship', 'upload/f3.jpg', 'Avinash ', '2256/d , ec01 street surat', 364001, '8128351162', 48),
('Furniture', 1, 'wooden cabinet', 70, 0, 110, '2023-09-29', '0000-00-00', 8000, 'lots of storage space', 'upload/f5.jpg', 'shruti', '1004 hazel street , delhi', 364005, '6577889034', 49),
('Furniture', 1, 'cushion chair', 90, 0, 70, '2022-07-12', '0000-00-00', 5000, 'color : forest green\r\nsoft cushion \r\ngood condition', 'upload/f1.jpg,upload/f2.jpg', 'mahek', 'takteshwar bhavnagar', 364002, '8460486755', 50),
('Furniture', 1, 'sofa chair', 90, 0, 80, '2024-09-18', '0000-00-00', 7000, 'sturdy and comfortable', 'upload/f4.jpg', 'vivek', '1103/d1 , soindhubhavan ahemdabad', 364008, '8460486755', 51),
('Clothing', 2, 'Satin Dress', 70, 0, 28, '2023-06-06', '0000-00-00', 750, 'brand : zara\r\nsize : m ', 'upload/c4.jpg,upload/c5.jpg', 'Manya', 'kadamgirir bhavnagar', 364002, '9988776655', 52),
('Clothing', 2, 'shirt', 0, 0, 0, '2024-10-16', '0000-00-00', 450, 'brand : myntra\r\nsize : S', 'upload/c1.jpg', 'vishwa', '111/a bhavnagar', 36004, '8128351162', 54),
('Clothing', 2, 'co-ord set', 0, 0, 0, '2024-06-04', '0000-00-00', 700, 'brand : trends\r\nsize : m\r\ncolor : sky blue', 'upload/c2.jpg', 'krisha', 'bhavnagar', 364001, '8128351162', 55),
('Clothing', 2, 'vintage gown', 0, 0, 0, '2024-05-13', '0000-00-00', 900, 'vintage gown \r\nprom dress\r\nsize : M \r\nstrapless , baby pink', 'upload/c6.jpg', 'tanisha', 'delhi', 364002, '6577889034', 56),
('Accessories', 3, 'earrings', 0, 0, 0, '2024-09-11', '0000-00-00', 150, 'gold coating \r\nwater and tarnish proof', 'upload/as1.jpg', 'krisha', 'home', 36004, '8460486755', 57),
('Accessories', 3, 'jute purse', 0, 0, 0, '2024-11-06', '0000-00-00', 400, 'spacious and washable', 'upload/as3.jpg', 'manya', 'kahan flats', 364008, '8460486755', 58),
('Accessories', 3, 'earring set', 0, 0, 0, '2024-10-09', '0000-00-00', 400, 'gold coating\r\nwaterproof\r\ntarnish free', 'upload/as2.jpg', 'bhavna', 'surat', 364001, '9988776655', 59),
('Accessories', 3, 'brown purse', 0, 0, 0, '2024-07-23', '0000-00-00', 450, 'good as new \r\nbrand : linoperos', 'upload/as4.jpg', 'vishwa', 'gandhinagar', 364008, '8460486755', 60);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uname` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uname`, `password`) VALUES
('krisha', '1234'),
('manya12', 'trivedi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `product_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
