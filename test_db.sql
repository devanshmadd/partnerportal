-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2021 at 08:16 AM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint NOT NULL,
  `deal_id` bigint NOT NULL,
  `partner_organization` varchar(200) NOT NULL,
  `partner_name` varchar(100) NOT NULL,
  `partner_email` varchar(100) NOT NULL,
  `partner_phone` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(100) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `deal_id`, `partner_organization`, `partner_name`, `partner_email`, `partner_phone`, `client_name`, `client_email`, `client_phone`, `status`) VALUES
(9, 456956, 'Spectrami', 'Ahmed', 'ahmed@spectrami.com', '911', 'KPMG', 'admin@kpmg.com', '112', 'ACTIVE'),
(10, 614625, 'Spectrami', 'Khalil', 'khalil@spectrami.com', '922', 'Almarai', 'almarai@almarai.com', '11221', 'ACTIVE'),
(11, 929721, 'Spectrami', 'Devansh', 'devansh@spectrami.com', '23719487', 'Majid Al Futaim', 'majid@alfutaim.com', '577430566', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int NOT NULL,
  `que` text NOT NULL,
  `option 1` varchar(255) NOT NULL,
  `option 2` varchar(255) NOT NULL,
  `option 3` varchar(255) NOT NULL,
  `option 4` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL,
  `userans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `que`, `option 1`, `option 2`, `option 3`, `option 4`, `ans`, `userans`) VALUES
(1, 'What does PHP stand for?', 'Preprocessed Hypertext Page', 'Hypertext Markup Language', 'Hypertext Pre-processor', 'Hypertext Transfer Protocol', 'Hypertext Pre-processor', 'Hypertext Pre-processor'),
(2, 'What is the capital of India', 'Maharashtra', 'Delhi', 'New Delhi', 'Gujarat', 'New Delhi', 'New Delhi'),
(3, 'Which is the longest river in the world?', 'River Nile', 'River Ganges', 'River Amazon', 'River Thames', 'River Nile', 'River Nile'),
(4, 'What is the full form of HTML', 'Hypertext Markup Language', 'Hypertext Model Language', 'Hypertextual Model Language', 'Hypertext Madeup Language', 'Hypertext Markup Language', 'Hypertext Markup Language'),
(5, 'Which is the smallest country in the world?', 'Kuwait', 'Bahrain', 'Vatican City', 'Venice', 'Vatican City', 'Vatican City');

-- --------------------------------------------------------

--
-- Table structure for table `user_creds`
--

CREATE TABLE `user_creds` (
  `id` bigint NOT NULL,
  `partner_organization` varchar(200) NOT NULL,
  `partner_email` varchar(200) NOT NULL,
  `partner_password` varchar(200) NOT NULL,
  `partner_priv` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_creds`
--

INSERT INTO `user_creds` (`id`, `partner_organization`, `partner_email`, `partner_password`, `partner_priv`) VALUES
(1, 'Spectrami', 'hasan@spectrami.com', '$2y$10$8QAxFEfgBeG.B2YKYN4BbuD9bodJaFl/E8XFkJDQxhovzjm7qW9Iy', '1'),
(2, 'Spectrami', 'ahmed@spectrami.com', '$2y$10$ok68ZVxP9D64c3Dxx1zeF.c2hO.ox/blQqec7yO8VAOQowpr.hGEG', '2'),
(3, 'Spectrami', 'khalil@spectrami.com', '$2y$10$fKJCWcVIYjRnC4LBLYAs8Ooo0ONc1hZZsn38fa2ddbIepnEoOg.Km', '2'),
(5, 'Spectrami', 'devansh@spectrami.com', '$2y$10$5bNN.IEjDp.02rn07GDz8evNs8CcpdX5AWe8M1PHOtinxf2ZQi2A6', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_id` (`deal_id`),
  ADD KEY `partner_email` (`partner_email`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_creds`
--
ALTER TABLE `user_creds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner_organization` (`partner_organization`),
  ADD KEY `partner_email` (`partner_email`),
  ADD KEY `partner_priv` (`partner_priv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_creds`
--
ALTER TABLE `user_creds`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
