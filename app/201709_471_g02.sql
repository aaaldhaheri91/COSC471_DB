-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 06:16 PM
-- Server version: 10.2.9-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `201709_471_g02`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorNo` int(11) NOT NULL,
  `Fname` varchar(25) DEFAULT NULL,
  `Lname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorNo`, `Fname`, `Lname`) VALUES
(1, 'Harvey', 'Deital'),
(2, 'Greg', 'Ayer'),
(3, 'Dan', 'Quirk');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` int(15) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `publishDate` varchar(25) DEFAULT NULL,
  `publisherName` varchar(100) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `authorNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `category`, `publishDate`, `publisherName`, `price`, `stock`, `authorNo`) VALUES
(132222205, 'Java How to Program', 'Object Oriented Programming', '2008', 'Mcgraw-Hill', '$50.00', 10, 1),
(132404168, 'C How to Program', 'Procedural Programming', '2007', 'Pearson', '$25.50', 15, 2),
(136053225, 'Visual C# 2008 How to Program', 'Object Oriented Programming', '2012', 'Pearson', '$60.00', 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `card_number` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `expiration` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_cards`
--

INSERT INTO `credit_cards` (`card_number`, `username`, `type`, `expiration`) VALUES
('123456789', 'aaldhahe', 'Visa', '10/20'),
('12354658943', 'aaaaldhaheri', 'DISCOVER', '10/45'),
('321567895', 'ahmad_nobani', 'MASTER', '10/26'),
('5648945156', 'ahmed_abdofara', 'VISA', '03/22'),
('567894564245', 'hello', 'VISA', '10/22'),
('778974564564', 'moemoe', 'VISA', '06/10'),
('789456315', 'jonmeany', 'Master Card', '04/23'),
('7897456489', 'jon_meany', 'VISA', '10/11'),
('7958723', 'aaaldhaheri', 'VISA', '10/22'),
('87895644', 'aaldhaheri', 'VISA', '10/22'),
('8789745646456', 'aliJahmi', 'DISCOVER', '10/32'),
('987456123', 'salnubani', 'American Express', '07/22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `username`, `order_date`, `total`) VALUES
(1, 'aaldhahe', '2017-11-10', '$58.50'),
(2, 'salnubani', '2017-11-03', '$60.00'),
(3, 'jonmeany', '2017-11-16', '$69.25'),
(6, 'aliJahmi', '2012-12-17', '$307.5'),
(7, 'aliJahmi', '2012-12-17', '$196.5'),
(8, 'aliJahmi', '2012-12-17', '$250'),
(9, 'aaldhahe', '2012-12-17', '$307.5'),
(10, 'aaldhahe', '2012-12-17', '$135.5'),
(11, 'moemoe', '2012-12-17', '$110'),
(12, 'aaldhahe', '2017-01-15', '$100'),
(13, 'aaldhahe', '2017-01-19', '$300.50'),
(14, 'aaldhahe', '2017-02-15', '$1000'),
(15, 'aaldhahe', '2017-02-15', '$400'),
(17, 'aaldhahe', '2017-03-19', '$700'),
(18, 'aaldhahe', '2017-03-19', '$900'),
(19, 'aaldhahe', '2017-04-19', '$800'),
(20, 'aaldhahe', '2017-04-19', '$6000'),
(21, 'aaldhahe', '2017-05-19', '$600'),
(22, 'aaldhahe', '2017-06-19', '$10000'),
(23, 'aaldhahe', '2017-06-19', '$6000'),
(24, 'aaldhahe', '2017-07-19', '$5000'),
(25, 'aaldhahe', '2017-08-19', '$15000'),
(26, 'aaldhahe', '2017-09-18', '$19000'),
(27, 'aaldhahe', '2017-10-18', '$25000'),
(28, 'aaldhahe', '2012-12-17', '$85.5'),
(29, 'aaldhahe', '2012-12-17', '$120'),
(30, 'aaldhahe', '2012-12-17', '$25.5');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_num` int(10) NOT NULL,
  `isbn` int(13) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_num`, `isbn`, `quantity`) VALUES
(4, 132222205, 2),
(4, 136053225, 1),
(6, 132404168, 5),
(6, 136053225, 3),
(7, 132404168, 3),
(7, 136053225, 2),
(8, 132222205, 5),
(9, 132404168, 5),
(9, 136053225, 3),
(10, 132404168, 1),
(10, 136053225, 1),
(10, 132222205, 1),
(11, 132222205, 1),
(11, 136053225, 1),
(28, 132404168, 1),
(28, 136053225, 1),
(29, 136053225, 2),
(30, 132404168, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `month_id` int(11) NOT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`month_id`, `total`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(11, 187.75),
(12, 1230.5);

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

CREATE TABLE `residence` (
  `addressId` int(11) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residence`
--

INSERT INTO `residence` (`addressId`, `address`, `city`, `state`, `zip`) VALUES
(1, '1485 Jonathan St.', 'Dearborn', 'MI', 48126),
(2, '8556 Telegraph Rd.', 'Southfield', 'MI', 48512),
(3, '6548 Reuter St.', 'Dearborn Heights', 'MI', 48127),
(4, '555 Maple St.', 'Dearborn', 'Michigan', 48126),
(5, '7895 HillSide', 'Dearborn Heights', 'Michigan', 48127),
(6, '78334 Kingsley', 'Dearborn', 'Michigan', 48126),
(7, '8945 Raliegh ', 'Kendallville', 'California', 48764),
(8, '6555 Kingsley', 'Wayne', 'California', 49586),
(9, '8956 Kingsley', 'Dearborn', 'Michigan', 48126),
(10, '5511 kendall', 'Dearborn', 'Michigan', 48126),
(11, '4587 Woodward', 'Detroit', 'Michigan', 78952),
(12, '78334 Kingsley', 'Dearborn', 'Michigan', 48126),
(13, '5456 Hill Dr', 'Southfield', 'Michigan', 4856),
(14, '8549 Morrow', 'Dearborn', 'Michigan', 48126),
(15, '7232', 'dearborn', 'Michigan', 78952),
(16, '6555 Kingsley', 'Wayne', 'California', 49586),
(17, '45687 Jonathan', 'San Francisco', 'California', 48565);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(11) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `isbn` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `description`, `rating`, `username`, `isbn`) VALUES
(1, 'The book was amazing and awesome in getting me fimiliar with C. I would recommend to anyone wanting to learn C programmin', 4, 'aaldhahe', 132404168),
(2, 'This book really helped me in learning Java and also did a very well job at explaining OOP concepts.', 5, 'jonmeany', 132222205),
(3, 'It helped me in self studying Java. I am very happy I chose this book.', 4, 'salnubani', 132222205);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `pin` varchar(25) DEFAULT NULL,
  `Fname` varchar(25) DEFAULT NULL,
  `Lname` varchar(25) DEFAULT NULL,
  `addressId` int(11) DEFAULT NULL,
  `isAdmin` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pin`, `Fname`, `Lname`, `addressId`, `isAdmin`) VALUES
('aaaaaldhaheri', 'ahmed1991', 'ahmad', 'nobani', 10, NULL),
('aaaaldhaheri', '', 'Ali', 'Eljahmi', 16, NULL),
('aaaldhaheri', '72934', 'Ahmed', 'Alkuhali', 4, NULL),
('aaldhahe', '1031', 'Ahmed', 'Aldhaheri', 1, NULL),
('aaldhaheri', '1013', 'Ahmed', 'Ali', 5, NULL),
('ahmad_nobani', 'ahmad1996', 'ahmad', 'nobani', 8, NULL),
('ahmed_abdofara', 'ahmedabdo', 'ahmed', 'abdofara', 14, NULL),
('aliJahmi', 'ahmed1991', 'Ali', 'Eljahmi', 17, NULL),
('hamzah_aldhaheri', 'hamz1994', 'hamzah', 'aldhaheri', 7, NULL),
('hannan', 'hannan2014', 'hannan', 'aldhaheri', 9, NULL),
('hello', 'ahmed', 'hello', 'world', 15, NULL),
('hello_world', 'hello', 'hello', 'world', 11, NULL),
('jmeaney', '43526928', 'Jon', 'Meaney', NULL, 1),
('jonmeany', '1013', 'Jon', 'Meany', 2, NULL),
('jon_meany', 'jonmeany', 'jon', 'meany', 13, NULL),
('moemoe', 'moe1995', 'moe', 'aldhaheri', 12, NULL),
('moe_aldhaheri', 'moe1993', 'Moe', 'Aldhaheri', 6, NULL),
('salnubani', '1992', 'Safa', 'Alnubani', 3, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorNo`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `authorNo` (`authorNo`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`card_number`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_num` (`order_num`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `residence`
--
ALTER TABLE `residence`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `username` (`username`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `addressId` (`addressId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `residence`
--
ALTER TABLE `residence`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`authorNo`) REFERENCES `authors` (`authorNo`);

--
-- Constraints for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD CONSTRAINT `credit_cards_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `residence` (`addressId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
