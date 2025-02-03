-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 30, 2024 at 06:47 AM
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
-- Database: `chapterchanger`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` tinyint(1) DEFAULT 1,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `created_at`, `read`, `username`) VALUES
(4, 21, 'Your book \'hiiii\' has been posted.', '2024-05-08 13:56:55', 1, 'sai'),
(5, 21, 'Your book \'dsds\' has been posted.', '2024-05-08 15:40:50', 1, 'sai'),
(6, 23, 'Your book \'wew\' has been posted.', '2024-05-09 06:15:14', 1, 'neha'),
(7, 23, 'Your book \'wew\' has been posted.', '2024-05-09 06:17:32', 1, 'neha'),
(8, 24, 'Your book \' Ice Breakers\' has been posted.', '2024-05-09 06:29:48', 1, 'vishnu'),
(9, 24, 'Your book \'Wildfire\' has been posted.', '2024-05-09 06:32:24', 1, 'vishnu'),
(10, 21, 'Your book \'book2\' has been posted.', '2024-05-10 05:30:10', 1, 'sai');

-- --------------------------------------------------------

--
-- Table structure for table `postbook`
--

CREATE TABLE `postbook` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_isbn` varchar(20) NOT NULL,
  `b_auth` varchar(255) NOT NULL,
  `og_pr` decimal(10,2) NOT NULL,
  `ex_pr` decimal(10,2) NOT NULL,
  `descript` text NOT NULL,
  `pic1` varchar(255) NOT NULL,
  `pic2` varchar(255) DEFAULT NULL,
  `genr1` varchar(100) DEFAULT NULL,
  `genr2` varchar(100) DEFAULT NULL,
  `used` enum('N','Y') NOT NULL DEFAULT 'N',
  `user_id` int(11) NOT NULL,
  `dt_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postbook`
--

INSERT INTO `postbook` (`b_id`, `b_name`, `b_isbn`, `b_auth`, `og_pr`, `ex_pr`, `descript`, `pic1`, `pic2`, `genr1`, `genr2`, `used`, `user_id`, `dt_creation`, `user_name`) VALUES
(30, 'hiiii', '12321', 'gddgd', 89.00, 78.00, 'fghffhhdfhhdfhh', '30.png', '30_backside.png', 'romance', 'nothing', '', 21, '2024-05-08 13:56:55', '0'),
(31, 'dsds', '12321', 'sadss', 34.00, 33.00, 'esrer', '31.png', '31_backside.png', 'science', 'nothing', 'N', 21, '2024-05-08 15:40:50', '0'),
(32, 'wew', '12321', 'gddgd', 39.00, 30.00, 'cvvbnbnfghjnmmguhk', '32.png', '32_backside.png', 'education', 'hardwork', 'N', 23, '2024-05-09 06:15:13', '0'),
(33, 'wew', '12321', 'gddgd', 39.00, 30.00, 'cvvbnbnfghjnmmguhk', '33.png', '33_backside.png', 'education', 'hardwork', 'N', 23, '2024-05-09 06:17:32', '0'),
(34, ' Ice Breakers', '0000000000', ' Ice Breakers author', 233.00, 231.00, 'Romance leds to life death', '34.jpg', '34_backside.jpg', 'romance', 'romance', 'N', 24, '2024-05-09 06:29:47', '0'),
(35, 'Wildfire', '0000000000', 'vishnu', 435.00, 433.00, 'Wild in life as a lover', '35.jpg', '35_backside.jpg', 'romance', 'romance', 'N', 24, '2024-05-09 06:32:24', '0'),
(36, 'book2', '0000000000', 'saaa', 2357.00, 2000.00, 'rttr', '36.jpg', '36_backside.jpg', 'education', 'nothing', 'N', 21, '2024-05-10 05:30:09', '0');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact1` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` varchar(150) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `email`, `contact1`, `price`, `pos_id`, `owner_id`, `request_date`, `message`, `book_id`) VALUES
(11, 'sai@22', '12333', 34.00, 21, 21, '2024-05-08 13:57:42', '223433', 30),
(12, 'sai@22', '12333', -34.00, 21, 21, '2024-05-08 13:57:49', '223433', 30),
(13, 'neha@gmail.com', '9234567801', 6.00, 23, 23, '2024-05-09 06:19:31', 'sdbdjndmndcjdhcjddddddddddddddddddddddddd', 32),
(14, '22211a6794@bvrit.ac.in', '9234567801', 1200.00, 24, 21, '2024-05-10 05:32:13', 'i want ths book', 36);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(500) NOT NULL,
  `number` varchar(10) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `boks` int(11) DEFAULT 2,
  `req` int(11) DEFAULT 2,
  `subscription` varchar(255) DEFAULT 'No plan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `number`, `state`, `city`, `password`, `boks`, `req`, `subscription`) VALUES
(21, 'sai', 'sai@bvrit.com', '12345678', 'Telengana', 'Hyderabad', '$2y$10$SdEIo7ih8vOPxD2S1nFqde3XgMyM1HjeIF/U/IjuZ9H410TZUKdPq', 5, 5, 'basic'),
(22, 'vishnu', '23215a6713@bvrit.com', '9111232232', 'Telengana', 'Hyderabad', '$2y$10$gJNctW.IKCrqFPUquw1Md.p79i4xDuj5yr4EGH44n9bisJjm6A/vy', 2, 2, 'No plan'),
(23, 'neha', 'neha@gmail.com', '9234567890', 'Telengana', 'Hyderabad', '$2y$10$.Fa0JQh6k2S6fjsa8kH4cu5.QXQgM4pm7lUJLbJ2D8oMNoO6xlos6', 2, 2, 'No plan'),
(24, 'vishnu', 'vishnu@bvrit.com', '9234567890', 'Telengana', 'Hyderabad', '$2y$10$lnlA1MEhzBy..Vhvp51AjuH2z9s7./Pwz6l7K1C067FB8prm8yrpW', 2, 2, 'No plan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `postbook`
--
ALTER TABLE `postbook`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `postbook`
--
ALTER TABLE `postbook`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
