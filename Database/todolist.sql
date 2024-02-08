-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 07:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `task` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `username`, `task`, `time`) VALUES
(1, 'ankan', 'Searching', '2024-02-06 12:14:12'),
(2, 'amit', 'Grunching', '2024-02-06 18:52:26'),
(5, 'amit', 'Smoking', '2024-02-06 18:52:40'),
(6, 'amit', 'Gubleting', '2024-02-06 18:52:47'),
(7, 'ankan', 'Development', '2024-02-08 12:27:26'),
(8, 'ankan', 'Playing', '2024-02-08 12:27:36'),
(9, 'ankan', 'Ruling', '2024-02-08 12:28:35'),
(11, 'ankan', 'Droozing', '2024-02-08 17:00:12'),
(12, 'ankan', 'Grooming', '2024-02-08 17:07:24'),
(13, 'tunir', 'Go to market', '2024-02-08 17:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `name`, `username`, `email`, `password`, `image`) VALUES
(1, 'Ankan Chakraborty', 'ankan', 'ankan@gmail.com', '4d4e28fff483a76cd48b034b9978f0af', 'profilePics/20191227_184911.jpg'),
(2, 'Amit Mondol', 'amit', 'amit@gmail.com', '0cb1eb413b8f7cee17701a37a1d74dc3', 'profilePics/20200103_141612.jpg'),
(3, 'Tunir Saha', 'tunir', 'tunir@gmail.com', '1723dd61c2dc20537174b1473750dd4d', 'profilePics/WIN_20230412_15_21_01_Pro.jpg'),
(4, 'Partha Sen', 'partha', 'partha@gmail.com', 'a553288817b7309b83c0dc0e76656779', 'profilePics/FDSKTP.png'),
(5, 'Changu Chauhan', 'changu', 'changu@gmail.com', '1ab50987b754bb9cfa87fd515992736d', 'profilePics/supratik.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
