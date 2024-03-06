-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 03:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

CREATE TABLE `booking_info` (
  `reservation_id` varchar(255) NOT NULL,
  `car_id` int(255) DEFAULT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `Occasion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars_info`
--

CREATE TABLE `cars_info` (
  `car_id` int(255) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_colour` varchar(255) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `price_perday` int(255) DEFAULT NULL,
  `car_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars_info`
--

INSERT INTO `cars_info` (`car_id`, `car_name`, `car_colour`, `car_type`, `price_perday`, `car_image`) VALUES
(2, 'Rolls Royce Phantom', 'Blue', 'Luxury', 9800, 'picture/roll1.png'),
(3, 'Bentley Continental Flying Spur', 'White', 'Luxury', 4800, 'picture/bent.png'),
(4, 'Mercedes Benz CLS 350', 'Silver', 'Luxury', 1350, 'picture/benz1.png'),
(5, 'Jaguar S Type', 'Champagne', 'Luxury', 1350, 'picture/jaguar3.png'),
(6, 'Ferrari F430 Scuderia', 'Red', 'Sports', 6000, 'picture/ferrari3.png'),
(7, 'Lamborghini Murcielago LP640', 'Matte Black', 'Sports', 7000, 'picture/Lamboo.png'),
(8, 'Porsche Boxster', 'White', 'Sports', 2800, 'picture/Porsche1.webp'),
(9, 'Lexus SC430', 'Black', 'Sports', 1600, 'picture/lexus3.png'),
(10, 'Jaguar MK 2', 'White', 'Classics', 2200, 'picture/mk2.png'),
(11, 'Rolls Royce Silver Spirit Limousine', 'Georgian Silver', 'Classics', 3200, 'picture/rollcla.png'),
(12, 'MG TD', 'Red', 'Classics', 2500, 'picture/mg.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `cus_name` varchar(255) DEFAULT NULL,
  `cus_email` varchar(255) DEFAULT NULL,
  `cus_tel` int(255) DEFAULT NULL,
  `cus_add` varchar(255) DEFAULT NULL,
  `reservation_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup_form`
--

CREATE TABLE `signup_form` (
  `staff_id` varchar(255) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pass_word` varchar(20) NOT NULL,
  `last_login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_info`
--
ALTER TABLE `booking_info`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `cars_info`
--
ALTER TABLE `cars_info`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD KEY `customer_info_ibfk_1` (`reservation_id`);

--
-- Indexes for table `signup_form`
--
ALTER TABLE `signup_form`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars_info`
--
ALTER TABLE `cars_info`
  MODIFY `car_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_info`
--
ALTER TABLE `booking_info`
  ADD CONSTRAINT `booking_info_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars_info` (`car_id`),
  ADD CONSTRAINT `booking_info_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `signup_form` (`staff_id`);

--
-- Constraints for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD CONSTRAINT `customer_info_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `booking_info` (`reservation_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
