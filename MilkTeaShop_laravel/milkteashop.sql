-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2021 at 07:18 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milkteashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `avatar` varchar(1024) NOT NULL,
  `createdDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clientaddress`
--

CREATE TABLE `clientaddress` (
  `addressId` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clientorder`
--

CREATE TABLE `clientorder` (
  `orderId` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  `note` varchar(1024) NOT NULL,
  `orderedDate` timestamp NULL DEFAULT NULL,
  `deliveredDate` timestamp NULL DEFAULT NULL,
  `isPaid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `drinkId` int(11) NOT NULL,
  `drinkName` int(11) NOT NULL,
  `drinkImage` int(11) NOT NULL,
  `drinkType` int(11) NOT NULL,
  `drinkDes` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `drinkprice`
--

CREATE TABLE `drinkprice` (
  `drinkId` int(11) NOT NULL,
  `drinkSize` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE `extra` (
  `extraId` int(11) NOT NULL,
  `extraName` varchar(100) NOT NULL,
  `extraImage` varchar(1024) NOT NULL,
  `extraType` int(11) NOT NULL,
  `extraDes` varchar(1024) DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `extraprice`
--

CREATE TABLE `extraprice` (
  `extraId` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nofitication`
--

CREATE TABLE `nofitication` (
  `nofiId` int(11) NOT NULL,
  `nofiContent` varchar(1024) NOT NULL,
  `clientId` int(11) NOT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `nofiTypeId` int(11) NOT NULL,
  `isRead` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nofiticationtype`
--

CREATE TABLE `nofiticationtype` (
  `nofiTypeId` int(11) NOT NULL,
  `nofiName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdrink`
--

CREATE TABLE `orderdrink` (
  `orderId` int(11) NOT NULL,
  `drinkId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitDrinkPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderextra`
--

CREATE TABLE `orderextra` (
  `orderId` int(11) NOT NULL,
  `drinkId` int(11) NOT NULL,
  `extraId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitExtraPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `orderStatusId` int(11) NOT NULL,
  `orderStatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `clientaddress`
--
ALTER TABLE `clientaddress`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `clientorder`
--
ALTER TABLE `clientorder`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`drinkId`);

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`extraId`);

--
-- Indexes for table `nofitication`
--
ALTER TABLE `nofitication`
  ADD PRIMARY KEY (`nofiId`);

--
-- Indexes for table `nofiticationtype`
--
ALTER TABLE `nofiticationtype`
  ADD PRIMARY KEY (`nofiTypeId`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`orderStatusId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientaddress`
--
ALTER TABLE `clientaddress`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientorder`
--
ALTER TABLE `clientorder`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `drinkId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `extraId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nofitication`
--
ALTER TABLE `nofitication`
  MODIFY `nofiId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nofiticationtype`
--
ALTER TABLE `nofiticationtype`
  MODIFY `nofiTypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `orderStatusId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
