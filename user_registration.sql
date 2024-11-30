-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 02:10 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `item_name`, `item_price`, `item_quantity`) VALUES
(193, 'Test Admin', 'Paris-Brest', 129.00, 2),
(194, 'Test Admin', 'Medium Baguette', 89.00, 1),
(195, 'Test Admin', 'Classic Croissant', 40.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `item_name` varchar(55) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `delivery_status` varchar(50) DEFAULT 'Preparing the Order'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `item_name`, `item_price`, `item_quantity`, `delivery_status`) VALUES
(138, 'izel vergara', 'nve3idce8ibou4is59ere0nsi7', 'Medium Baguette', 89.00, 1, 'Preparing the Order'),
(139, 'izel vergara', 'nve3idce8ibou4is59ere0nsi7', 'Pan au Chocolat', 45.00, 1, 'Preparing the Order'),
(141, 'izel vergara', 'ssagvi73r7g1bce2qara0ir2nn', 'Medium Baguette', 89.00, 2, 'Preparing the Order'),
(142, 'izel vergara', 'jpohfsr1bptshgeua4j9331fga', 'Paris-Brest', 129.00, 1, 'Preparing the Order'),
(143, 'izel vergara', 'jpohfsr1bptshgeua4j9331fga', 'Strawberry Macaroons', 30.00, 2, 'Preparing the Order'),
(144, 'izel vergara', 'jpohfsr1bptshgeua4j9331fga', 'Medium Baguette', 89.00, 2, 'Preparing the Order'),
(145, 'izel vergara', 'jpohfsr1bptshgeua4j9331fga', 'Pan au Chocolat', 45.00, 1, 'Preparing the Order');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_price` int(11) NOT NULL,
  `housenumber` varchar(55) NOT NULL,
  `streetname` varchar(55) NOT NULL,
  `barangay` varchar(55) NOT NULL,
  `postalcode` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `user_id`, `session_id`, `order_date`, `total_price`, `housenumber`, `streetname`, `barangay`, `postalcode`, `city`) VALUES
(20, 'Test Admin', 'jet3sce5hquuqr87euh3t56214', '2024-11-03 04:31:44', 467, '16', 'Doroteo', 'Tanod', '1234', 'Manila'),
(21, 'izel vergara', 'upphkgiq48mu30jmvli7h2nmol', '2024-11-30 09:17:52', 129, '12', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(22, 'izel vergara', 't81m37tt7rqggka70i0quci4ea', '2024-11-30 10:27:48', 174, '19', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(23, 'izel vergara', 'r2n4qk4khjv5jsbffk9ns08fjc', '2024-11-30 10:35:24', 25, '15', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(24, 'izel vergara', 'j68ldj6f9gob89d7ad96kt8rlo', '2024-11-30 11:50:40', 30, '78', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(25, 'izel vergara', 'nve3idce8ibou4is59ere0nsi7', '2024-11-30 13:37:22', 134, '45', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(26, 'izel vergara', 'ssagvi73r7g1bce2qara0ir2nn', '2024-11-30 13:38:14', 178, '32', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(27, 'izel vergara', 'ssagvi73r7g1bce2qara0ir2nn', '2024-11-30 13:38:15', 178, '32', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon'),
(28, 'izel vergara', 'jpohfsr1bptshgeua4j9331fga', '2024-11-30 13:40:06', 412, '98', 'Sitio Terminal', 'Santa Catalina Norte', '4323', 'Candelaria, Quezon');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `contactnumber` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `firstname`, `lastname`, `contactnumber`, `email`, `password`, `signup_date`) VALUES
(9, 'Test', 'Admin', '09123456789', 'admin@gmail.com', '$2y$10$vk6NxxFAW1T5p3g6okWoM.avwYPl9HTHiazbvla5MWceUYEaD.keK', '2024-10-24 14:42:03'),
(12, 'izel', 'vergara', '09569573225', 'izelwalangpera@gmail.com', '$2y$10$RsSn3jFmDjK/I0oSFh/f/.VpYhdsaEDTXOsoyedEY/Jez2Wad/QSS', '2024-11-30 08:57:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
