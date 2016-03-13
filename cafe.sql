-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2016 at 02:35 PM
-- Server version: 5.5.44-0+deb8u1
-- PHP Version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `cus_id` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `LastName` varchar(10) NOT NULL,
  `tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`cus_id`, `FirstName`, `LastName`, `tel`) VALUES
(23, 'Richard', 'Smittenaar', ''),
(24, 'James', 'Gilbert', ''),
(25, 'Jons', 'Slemmer', '15682556370'),
(26, 'Woody', '', ''),
(27, 'CC', '', ''),
(28, 'Gloria', '', ''),
(29, 'Craig', '', ''),
(30, 'Al', '', ''),
(31, 'Lara', '', ''),
(32, 'Alan', '', ''),
(33, 'Maomao', '', ''),
(34, 'David', 'Zhang', ''),
(35, 'David', 'Rhodes', ''),
(36, 'Matt', 'Ryan', ''),
(37, 'Mark', '', ''),
(38, 'Alex', '', ''),
(39, 'Duncun', '', ''),
(40, 'Chris', '', ''),
(41, 'Maria', '', ''),
(42, 'Jeremy', '', ''),
(43, 'Antong', '', ''),
(44, 'Gordon', '', ''),
(45, 'Micheal', '', ''),
(46, 'Jennifer', '', ''),
(47, 'Fred', '', ''),
(48, 'Jiaojiao', '', ''),
(49, 'Drew', '', ''),
(50, 'Monty', '', ''),
(51, 'JoJo', '', ''),
(52, 'Cody', '', ''),
(53, 'Matt', 'Copsey', '');

-- --------------------------------------------------------

--
-- Table structure for table `food_catalogue`
--

CREATE TABLE `food_catalogue` (
  `food_id` int(10) UNSIGNED NOT NULL,
  `cata_name` varchar(50) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `catalog_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_catalogue`
--

INSERT INTO `food_catalogue` (`food_id`, `cata_name`, `Price`, `catalog_id`) VALUES
(1, 'Sandwiches', NULL, 1),
(2, 'Salads', NULL, 4),
(3, 'Eggs', NULL, 5),
(4, 'Breakfast', NULL, 6),
(5, 'Patisserie', NULL, 7),
(6, 'Coffee', NULL, 8),
(7, 'HotChocolate', NULL, 9),
(8, 'Tea', NULL, 10),
(9, 'Beverage', NULL, 11),
(10, 'Meals', NULL, 3),
(11, 'The Veggie Power', 18, 1),
(12, 'The Parisian', 25, 1),
(13, 'The Ultimate', 26, 1),
(14, 'Croque-Monsieur', 30, 1),
(15, 'Croque-Madame', 32, 1),
(16, 'Bikini Sandwich', 25, 1),
(17, 'Salade Nicoise', 16, 4),
(18, 'Salade Paysanne', 22, 4),
(19, 'Salmon salad', 30, 4),
(20, 'Carrot salad', 8, 4),
(21, 'Scrambled/Fried eggs', 8, 5),
(22, 'Red &Rouge Omelette', 14, 5),
(23, 'The Biggy Omelette', 22, 5),
(24, 'English breakfast', 30, 6),
(25, '2 Pancakes', 15, 6),
(26, 'Bacon & Egg cupcake', 8, 6),
(27, 'Mini croissant', 4, 7),
(28, 'Cookie', 1, 7),
(29, 'Homemade cake', 8, 7),
(30, 'Americano', 9, 8),
(31, 'Espresso', 10, 8),
(32, 'Macchiato', 11, 8),
(33, 'Cappuccino', 15, 8),
(34, 'Latte', 16, 8),
(35, 'Mocha latte', 17, 8),
(36, 'Ciobar hot chocolate', 16, 9),
(37, 'Dark chocolate', 10, 9),
(38, 'Milk chocolate', 10, 9),
(39, 'Orange/cinnamon', 6, 10),
(40, 'Wild berry', 6, 10),
(41, 'Peppermint', 6, 10),
(42, 'Earl grey', 6, 10),
(43, 'Lady grey', 6, 10),
(44, 'Lavender', 6, 10),
(45, 'English breakfast', 6, 10),
(46, 'Harbin', 10, 11),
(47, 'Soft drinks', 3, 11),
(48, 'Vanilla Milkshake', 14, 12),
(49, 'Banana Milkshake', 14, 12),
(50, 'Discount', -1, 51),
(51, 'Discounts', NULL, 51),
(53, 'DIY', NULL, 2),
(54, 'Cheese', 6, 2),
(55, 'Milkshakes', NULL, 12),
(56, 'Baguette', 5, 2),
(57, 'White toast', 3, 2),
(58, 'Ham', 8, 2),
(59, 'Bacon', 3, 2),
(60, 'Tuna', 5, 2),
(61, 'Egg', 2, 2),
(62, 'Lettuce', 1, 2),
(63, 'Cucumber', 1, 2),
(64, 'Carrot', 1, 2),
(65, 'Bell peper', 1, 2),
(66, 'Cooked Zuccini', 1, 2),
(67, 'Eggplant', 1, 2),
(68, 'Onion', 1, 2),
(69, 'Tomatoes', 1, 2),
(70, 'Black olives', 2, 2),
(71, 'Pickles', 2, 2),
(72, 'Butter', 2, 2),
(73, 'Mayo', 2, 2),
(74, 'Ketchup', 1, 2),
(75, 'Mustard', 2, 2),
(76, 'Bechamel', 3, 2),
(77, 'Red chicken curry', 20, 3),
(78, 'Yellow beef curry', 30, 3),
(79, 'Fajita', 20, 3),
(80, 'Soup', 12, 3),
(81, 'One pot pasta', 25, 3),
(82, 'Dumplings', 15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `cus_id` varchar(6) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cus_id`, `Date`, `Time`, `payed`) VALUES
(1, '150001', '2015-11-14', '05:00:00', 1),
(2, '150002', '2015-11-14', '06:00:00', 0),
(4, '150001', '2015-11-26', '20:20:46', 0),
(8, '150003', '2015-11-26', '20:24:54', 0),
(12, '150003', '2015-11-26', '20:46:19', 0),
(17, '150009', '2015-11-27', '12:14:51', 0),
(18, '150001', '2015-11-27', '12:15:51', 0),
(19, '150010', '2015-11-27', '18:30:53', 0),
(20, '150008', '2015-11-27', '18:34:08', 0),
(22, '150003', '2015-11-30', '12:14:38', 0),
(24, '150011', '2015-12-03', '13:23:23', 0),
(25, '150005', '2015-12-03', '13:47:21', 0),
(28, '150003', '2015-12-21', '22:24:35', 0),
(29, '150004', '2015-12-21', '22:25:07', 0),
(31, '150002', '2015-12-21', '22:50:14', 0),
(35, '150010', '2015-12-23', '18:48:54', 0),
(36, '150014', '2015-12-23', '18:50:24', 0),
(37, '150014', '2015-12-23', '19:01:52', 0),
(38, '150006', '2015-12-23', '21:27:50', 0),
(39, '150006', '2015-12-24', '18:37:03', 0),
(40, '0', '2015-12-24', '18:41:01', 0),
(41, '0', '2015-12-24', '18:43:01', 0),
(42, '150012', '2015-12-27', '00:27:11', 0),
(43, '150014', '2015-12-27', '00:29:21', 0),
(44, '150007', '2015-12-27', '00:30:41', 0),
(45, '150010', '2015-12-27', '00:31:19', 0),
(46, '150012', '2015-12-27', '01:42:50', 0),
(47, '150012', '2015-12-27', '17:02:17', 0),
(48, '150003', '2015-12-27', '17:16:38', 0),
(49, '0', '2015-12-27', '17:26:33', 0),
(50, '150003', '2015-12-27', '18:16:07', 0),
(51, '150014', '2015-12-27', '19:19:21', 0),
(52, '0', '2015-12-27', '21:13:06', 0),
(53, '150003', '2015-12-28', '15:54:20', 0),
(54, '0', '2015-12-28', '15:54:42', 0),
(55, '0', '2015-12-28', '15:54:53', 0),
(56, '0', '2015-12-28', '15:55:02', 0),
(57, '0', '2015-12-28', '15:57:25', 0),
(58, '0', '2015-12-28', '15:57:33', 0),
(59, '0', '2015-12-28', '15:58:37', 0),
(60, '150006', '2015-12-28', '15:58:55', 0),
(61, '150006', '2015-12-28', '15:59:10', 0),
(62, '150006', '2015-12-28', '17:28:13', 0),
(63, '150012', '2015-12-28', '17:29:15', 0),
(65, '150002', '2016-01-14', '22:00:03', 1),
(67, '150004', '2016-01-15', '15:27:47', 1),
(68, '150003', '2016-01-16', '12:36:37', 1),
(71, '150005', '2016-02-29', '05:06:10', 0),
(73, '23', '2016-03-07', '05:44:35', 1),
(74, '23', '2016-03-07', '06:10:27', 0),
(79, '24', '2016-03-10', '13:03:05', 0),
(80, '25', '2016-03-13', '10:12:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_food`
--

CREATE TABLE `order_food` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `food_id` int(10) UNSIGNED DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_food`
--

INSERT INTO `order_food` (`item_id`, `order_id`, `food_id`, `Quantity`) VALUES
(1, 1, 11, 1),
(2, 1, 13, 4),
(3, 1, 18, 4),
(4, 1, 30, 3),
(5, 2, 48, 1),
(7, 4, 11, 1),
(8, 4, 13, 1),
(9, 4, 48, 2),
(10, 4, 50, 1),
(19, 8, 12, 1),
(20, 8, 49, 2),
(25, 12, 12, 1),
(32, 17, 47, 1),
(33, 17, 49, 1),
(34, 18, 16, 1),
(35, 18, 26, 1),
(36, 19, 11, 1),
(37, 19, 27, 1),
(38, 20, 37, 1),
(39, 20, 38, 1),
(40, 20, 45, 1),
(41, 20, 50, 1),
(43, 22, 11, 1),
(45, 24, 12, 1),
(46, 25, 12, 4),
(47, 25, 27, 1),
(50, 28, 11, 1),
(51, 29, 11, 1),
(52, 29, 29, 1),
(54, 31, 11, 1),
(57, 35, 11, 1),
(58, 35, 12, 1),
(59, 36, 11, 1),
(60, 37, 11, 1),
(62, 38, 12, 1),
(63, 39, 11, 2),
(64, 39, 12, 1),
(65, 40, 12, 2),
(66, 40, 13, 2),
(67, 41, 11, 1),
(68, 42, 11, 1),
(69, 43, 12, 2),
(70, 43, 13, 2),
(71, 44, 11, 2),
(72, 44, 12, 3),
(73, 45, 11, 1),
(74, 46, 11, 2),
(75, 46, 12, 1),
(76, 46, 13, 1),
(77, 47, 11, 1),
(78, 48, 11, 1),
(79, 48, 12, 1),
(80, 49, 11, 3),
(81, 49, 12, 1),
(82, 50, 11, 2),
(83, 50, 13, 3),
(84, 51, 11, 1),
(85, 52, 11, 2),
(86, 53, 11, 1),
(87, 54, 11, 1),
(88, 55, 11, 2),
(89, 56, 11, 3),
(90, 57, 11, 1),
(91, 58, 11, 1),
(92, 59, 11, 2),
(93, 59, 13, 4),
(94, 60, 11, 2),
(95, 60, 12, 2),
(96, 61, 11, 2),
(97, 61, 12, 2),
(98, 62, 11, 3),
(99, 62, 13, 3),
(100, 63, 11, 2),
(101, 63, 13, 2),
(102, 63, 14, 2),
(105, 65, 11, 1),
(113, 67, 21, 1),
(114, 67, 22, 1),
(115, 67, 26, 1),
(116, 68, 11, 1),
(117, 68, 12, 1),
(118, 68, 13, 1),
(134, 71, 11, 1),
(135, 71, 12, 1),
(136, 71, 13, 1),
(137, 71, 14, 1),
(138, 71, 15, 1),
(139, 71, 16, 1),
(140, 71, 17, 1),
(142, 73, 11, 1),
(143, 74, 12, 1),
(144, 74, 13, 1),
(149, 79, 11, 4),
(150, 80, 13, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `food_catalogue`
--
ALTER TABLE `food_catalogue`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`cus_id`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `cus_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `food_catalogue`
--
ALTER TABLE `food_catalogue`
  MODIFY `food_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_food`
--
ALTER TABLE `order_food`
  ADD CONSTRAINT `order_food_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
