-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 02:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_cat`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProId` int(11) NOT NULL,
  `ProName` varchar(100) NOT NULL,
  `ProQty` int(11) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `ProUnit` varchar(30) NOT NULL,
  `Supplier` varchar(100) NOT NULL,
  `SupplierPhone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProId`, `ProName`, `ProQty`, `UnitPrice`, `ProUnit`, `Supplier`, `SupplierPhone`) VALUES
(100, 'Rice', 150, 1200, 'Kg', 'RICE PRODUCTION LTD', '0788102030'),
(200, 'Sugar', 190, 2000, 'Kg', 'KABUYE SUGAR', '0788102030'),
(300, 'Oil', 80, 4000, 'Liter', 'MUKWANO', '078810203050'),
(500, 'SOAP', 500, 1000, 'Box', 'ERIC SUPPLIER', '0788908070'),
(600, 'INYANGE MILK', 300, 800, 'Boxes', 'INYANGE INDUSTRIES', '0788102030'),
(700, 'KAWUNGA', 420, 850, 'Kg', 'BEST SELLER LTD', '0788506090');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
