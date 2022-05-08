-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2022 at 01:20 PM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `Checkout`
--

CREATE TABLE `Checkout` (
  `id` int(10) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `original_price` int(10) NOT NULL,
  `final_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `id` int(10) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `special_price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `sku`, `price`, `special_price`) VALUES
(1, 'A', 50, '[{"qty": "3","price": "130", "fromDate":"2022-05-05","toDate":"2022-05-10"}]'),
(2, 'B', 30, '[{"qty": "2","price": "45", "fromDate":"2022-05-05","toDate":"2022-05-10"}]'),
(3, 'C', 20, '[{"qty": "2","price": "38", "fromDate":"2022-05-05","toDate":"2022-05-10"},{"qty": "3","price": "50", "fromDate":"2022-05-05","toDate":"2022-05-10"}]'),
(4, 'D', 15, '[{"product":"A","price":"5"}]'),
(5, 'E', 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Checkout`
--
ALTER TABLE `Checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Checkout`
--
ALTER TABLE `Checkout`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
