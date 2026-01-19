-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 12:54 PM
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
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `phone`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', '01234567891', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `property_id`, `buyer_id`, `message`, `response`) VALUES
(1, 1, 2, 'Is the price negotiable for this apartment?', NULL),
(2, 1, 2, 'Is the price negotiable for this apartment?', NULL),
(4, 3, 3, 'What is the square footage of the office?', 'It is approximately 1500 sq ft.'),
(10, 5, 2, 'Is this property still available?', NULL),
(11, 6, 14, 'Can I schedule a visit this week?', NULL),
(12, 7, 7, 'Is parking available?', 'Yes, parking is included.'),
(13, 8, 3, 'Any discount for full payment?', NULL),
(14, 9, 12, 'What is the handover date?', 'Handover is within 6 months.');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Sold') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `seller_id`, `title`, `location`, `price`, `type`, `status`) VALUES
(1, 1, 'Modern 3-Bedroom Apartment', 'Dhaka, Bangladesh', 7500000, 'Apartment', 'Pending'),
(3, 1, 'Green View Villa', 'Purbachal, Dhaka', 18000000, 'House', 'Pending'),
(4, 1, 'Commercial Office Space', 'Motijheel, Dhaka', 12000000, 'Commercial', 'Approved'),
(5, 10, 'Luxury Lake View Apartment', 'Gulshan, Dhaka', 9500000, 'Apartment', 'Pending'),
(6, 13, 'Family Duplex House', 'Uttara, Dhaka', 14500000, 'House', 'Approved'),
(7, 10, 'Commercial Shop Space', 'Mirpur, Dhaka', 8000000, 'Commercial', 'Sold'),
(8, 10, 'Affordable Flat', 'Jatrabari, Dhaka', 5200000, 'Apartment', 'Pending'),
(9, 13, 'Office Floor Space', 'Banani, Dhaka', 22000000, 'Commercial', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Seller','Buyer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `user_type`) VALUES
(1, 'Karim', 'karim@gmail.com', '01236547890', '56789', 'Seller'),
(2, 'Rahim', 'rahim@email.com', '01711223344', 'pass123', 'Buyer'),
(3, 'Sultan', 'sultan@email.com', '01833445566', 'pass456', 'Buyer'),
(7, 'Jamal', 'jamal@gmail.com', '01236547890', '', 'Buyer'),
(10, 'Hasan', 'hasan@gmail.com', '01700000001', 'hasan123', 'Seller'),
(11, 'Rafi', 'rafi@gmail.com', '01700000002', 'rafi123', 'Buyer'),
(12, 'Nabil', 'nabil@gmail.com', '01700000003', 'nabil123', 'Buyer'),
(13, 'Tanvir', 'tanvir@gmail.com', '01700000004', 'tanvir123', 'Seller'),
(14, 'Arif', 'arif@gmail.com', '01700000005', 'arif123', 'Buyer');

-- --------------------------------------------------------

--
-- Table structure for table `visitrequests`
--

CREATE TABLE `visitrequests` (
  `request_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitrequests`
--

INSERT INTO `visitrequests` (`request_id`, `property_id`, `buyer_id`, `status`) VALUES
(2, 1, 2, 'Pending'),
(4, 1, 3, 'Approved'),
(5, 4, 11, 'Pending'),
(6, 6, 14, 'Approved'),
(7, 9, 12, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visitrequests`
--
ALTER TABLE `visitrequests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visitrequests`
--
ALTER TABLE `visitrequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`),
  ADD CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `visitrequests`
--
ALTER TABLE `visitrequests`
  ADD CONSTRAINT `visitrequests_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`),
  ADD CONSTRAINT `visitrequests_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
