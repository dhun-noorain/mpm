-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 11:02 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `pkg_type` varchar(7) NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` smallint(6) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `pkg_type`, `price`, `quantity`, `date`, `status`) VALUES
(1, 'Newboston', 'No 30, mainstreet, sabon gari', '08194568723', 'regu', 'N400', 2, '2021-08-04 10:32:48', 1),
(2, 'Karka test', 'no 90, maje road, t/wada, zaria', '08194568729', 'vvip', 'N300', 1, '2021-08-04 10:31:25', 1),
(3, 'Jameel', 'no 90, maje road, t/wada, zaria', '09034244659', 'vip', 'N1000', 4, '2021-08-04 10:30:22', 1),
(4, 'Newboston', 'no 90, dan raka road, gyellesu, zaria', '08023509609', 'vvip', 'N2100', 7, '2021-08-04 10:50:52', 1),
(5, 'Karka test', 'no 90, dan raka road, gyellesu, zaria', '09034244650', 'vvip', 'N2700', 9, '2021-08-04 10:55:03', 1),
(6, 'Ibrahim Musa', 'No 30, mainstreet, sabon gari', '07029877465', 'regu', 'N600', 3, '2021-08-05 07:58:26', 1),
(7, 'Karka test', 'no 90, maje road, t/wada, zaria', '08194568723', 'regular', 'N600', 3, '2021-08-05 07:57:18', 1),
(8, 'Karka test', 'no 90, maje road, t/wada, zaria', '09034244650', 'vip', 'N250', 1, '2021-08-05 07:59:06', 1),
(15, 'Karka test', 'no 90, maje road, t/wada, zaria', '09034244650', 'vip', 'N1000', 4, '2021-08-05 09:01:52', 1),
(14, 'Karka test', 'no 90, maje road, t/wada, zaria', '09034244650', 'regular', 'N200', 1, '2021-08-05 08:58:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'testadmin', '5daf720b63d9ffdea387e93b37db4405');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
