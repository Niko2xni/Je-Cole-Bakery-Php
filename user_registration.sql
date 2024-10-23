-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 02:41 AM
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
-- Database: `user_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `contactnumber` varchar(55) NOT NULL,
  `housenumber` varchar(55) NOT NULL,
  `streetname` varchar(55) NOT NULL,
  `barangay` varchar(55) NOT NULL,
  `postalcode` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `firstname`, `lastname`, `contactnumber`, `housenumber`, `streetname`, `barangay`, `postalcode`, `city`, `email`, `password`) VALUES
(1, 'Nikolai', 'Ng', '09774600869', '16', 'Doroteo', 'Bato', '1011', 'Manila', 'nikolai@gmail.com', '$2y$10$UTP7HGD4skmK42erhRaQTee9Pje6/LQO85sFXnPxwZr3//f3yPnrO'),
(2, 'Albert', 'Tucker', '09123456789', '16', 'Banana', 'Fruit', '1234', 'Manila', 'albert@gmail.com', '$2y$10$igZMsSnW/6Auq9fkyyjm3e4C8eRXbf9Hw7/ASSIKRcwH/KN2kGUZq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
