-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 07:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs`
--

CREATE TABLE `tbl_blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(40) NOT NULL,
  `blog_content` varchar(255) NOT NULL,
  `blog_picture` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_posted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blogs`
--

INSERT INTO `tbl_blogs` (`blog_id`, `blog_title`, `blog_content`, `blog_picture`, `user_id`, `blog_posted_at`) VALUES
(1, 'Hello', 'This is my post', 'Screenshot (310).png', 3, '2024-09-27 09:42:43'),
(5, 'Hello', 'This is my post1', 'Screenshot (310).png', 3, '2024-09-27 09:44:21'),
(6, 'Hello', 'Hello world 😎', 'Screenshot (308).png', 3, '2024-09-27 10:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE `tbl_contactus` (
  `contact_us_id` int(11) NOT NULL,
  `userName` varchar(30) DEFAULT NULL,
  `userEmail` varchar(90) DEFAULT NULL,
  `userMessage` varchar(255) DEFAULT NULL,
  `contact_us_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contactus`
--

INSERT INTO `tbl_contactus` (`contact_us_id`, `userName`, `userEmail`, `userMessage`, `contact_us_date`) VALUES
(1, 'Muhammad Umer', 'muhammadumer123@gmail.com', 'your website is good', '2024-09-27'),
(2, 'Muhammad Umer', 'muhammadumer123@gmail.com', 'your website is good', '2024-09-27'),
(3, 'Muhammad Umer', 'muhammadumer123@gmail.com', 'Your website is not working', '2024-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_date_of_birth` date NOT NULL,
  `user_gender` varchar(7) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_profile_picture` varchar(50) NOT NULL,
  `user_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_date_of_birth`, `user_gender`, `user_password`, `user_profile_picture`, `user_created_at`) VALUES
(1, 'Umer', 'umer12@gmail.com', '2024-09-16', 'Male', '4122cb13c7a474c1976c9706ae3652', 'Screenshot (309).png', '2024-09-27 09:37:01'),
(2, 'Ali', 'ali12@gmail.com', '2024-09-06', 'Male', '202cb962ac59075b964b07152d234b', 'Screenshot (309).png', '2024-09-27 09:37:47'),
(3, 'Ali', 'ali@gmail.com', '2024-09-10', 'Male', '202cb962ac59075b964b07152d234b70', 'Screenshot (310).png', '2024-09-27 09:40:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD UNIQUE KEY `blog_content` (`blog_content`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD CONSTRAINT `tbl_blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
