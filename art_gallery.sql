-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 03:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `art_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `art_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `art_title` varchar(50) NOT NULL,
  `art_desc` mediumtext NOT NULL,
  `art_price` int(11) NOT NULL,
  `art_date` date NOT NULL,
  `art_category` varchar(20) NOT NULL,
  `art_status` varchar(20) NOT NULL,
  `art_imagepath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`art_id`, `id`, `art_title`, `art_desc`, `art_price`, `art_date`, `art_category`, `art_status`, `art_imagepath`) VALUES
(1, 28, 'minimalist', 'Starry Night', 10000, '2022-02-23', 'minimalism', 'available', 'Aesthetic-PC-Wallpaper-HD.jpg'),
(2, 28, 'Try lang', 'mwehehe', 20000, '2022-02-02', 'Expressionism', 'available', 'signup.jpg'),
(3, 28, 'Try lang', 'mwehehe', 20000, '2022-02-02', 'Expressionism', 'available', 'signup.jpg'),
(4, 28, 'Try lang', 'mwehehe', 20000, '2022-02-02', 'Expressionism', 'available', 'signup.jpg'),
(5, 28, 'Try lang', 'mwehehe', 20000, '2022-02-02', 'Expressionism', 'available', 'signup.jpg'),
(6, 28, 'Try lang', 'mwehehe', 20000, '2022-02-02', 'Expressionism', 'available', 'signup.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `last` varchar(30) NOT NULL,
  `first` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `last`, `first`, `email`, `username`, `password`, `user_type`) VALUES
(22, 'Cua', 'Arvie', 'arviecua29@gmail.com', 'admin', '$2y$10$lYJG6T4BkWE5HbUv2GpQ3ek8RE0HLWVJ/qcgE6e/kduMX/j1GgLjO', 'admin'),
(24, 'Yanguas', 'Peter', 'peter@gmail.com', 'admin2', '$2y$10$r52K5.UaLVTuaDTFEbjgAuwoVI6YDpZBpaOUnPnzhsqB6NihotoJe', 'admin'),
(28, 'nieto', 'jm', 'jm@gmail.com', 'jm', '$2y$10$tfzOYYiwlylOImUa0qmWm./EHX7CiSME3S.rBUxRxEi0w6LkBqFaq', 'user'),
(29, 'Adversalo', 'Patrick', 'patty@gmail.com', 'patty', '$2y$10$uOwTXlV2Oro32rM0JhJM2e1KHTuTJkK5ximOq8b5offtoWOhqgLj.', 'user'),
(30, 'Batista', 'Ervin', 'ervin@gmail.com', 'ervin1', '$2y$10$CxNQaGaoTsCzpL4zJAxmWuPr4X2cLkwn6P63QNtFR5MR8h.VsvK1y', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`art_id`) USING BTREE,
  ADD KEY `fk_id` (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `signup` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
