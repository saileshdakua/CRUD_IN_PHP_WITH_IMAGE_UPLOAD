-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 07:49 AM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `pimage` varchar(200) NOT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `course` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(15) NOT NULL,
  `password_cnf` varchar(15) NOT NULL,
  `condition_1` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `email`, `phone`, `gender`, `pimage`, `dob`, `course`, `address`, `password`, `password_cnf`, `condition_1`) VALUES
(1, 'sailesh', 'dakua', 'saileshdakua@gmail.com', '7077059695', 'Male', '64faab244af0d.png', '2023-08-15', 'B.Tech', 'Bhubaneswar', '12345', '12345', ''),
(2, 'Sailesh', 'Dakua', 'sailesh@gmail.com', '9988776655', 'Male', '', '1999-05-25', 'Diploma', 'Odisha', '12345', '12345', 'yes'),
(3, 'Sanjeet', 'Dash', 'das@gmail.com', '9988776655', 'Male', '64faab58b4c02.png', '2023-09-09', 'BSC', '123', '123', '123', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `s_address`
--

CREATE TABLE `s_address` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `city` varchar(12) NOT NULL,
  `state` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_address`
--

INSERT INTO `s_address` (`id`, `s_id`, `city`, `state`) VALUES
(1, 1, 'BBSR', 'ODISHA'),
(2, 1, 'BBSR', 'ODISHA'),
(3, 4, 'BBSR-1', 'ODISHA-1'),
(4, 4, 'BBSR-2', 'ODISHA=2'),
(5, 4, 'BBSR-3', 'ODISHA=3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `s_address`
--
ALTER TABLE `s_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `s_address`
--
ALTER TABLE `s_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
