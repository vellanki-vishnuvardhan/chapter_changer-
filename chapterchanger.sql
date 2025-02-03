-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 05, 2024 at 06:36 PM
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
(1, 17, 'Your book \'wewwqqq\' has been posted.', '2024-05-04 06:39:05', 0, NULL),
(2, 17, 'Your book \'book1\' has been posted.', '2024-05-04 16:11:17', 0, 'sai');

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
(18, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '18.png', '18_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:31', 'sai'),
(19, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '19.png', '19_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:34', 'sai'),
(20, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '20.png', '20_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:36', 'sai'),
(21, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '21.png', '21_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:38', 'sai'),
(22, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '22.png', '22_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:39', 'sai'),
(23, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '23.png', '23_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:41', 'sai'),
(24, 'book1', '12321', 'eeww', 23.00, 223.00, 'noottutittbtt', '24.png', '24_backside.png', 'romance', 'nothing', '', 17, '2024-05-02 11:57:43', 'sai'),
(25, 'wewwqqq', '12321', 'gddgd', 23.00, 223.00, 'bdzdsd', '25.png', '25_backside.png', 'hardwork', 'hardwork', '', 17, '2024-05-04 06:38:19', 'sai'),
(26, 'wewwqqq', '12321', 'gddgd', 23.00, 223.00, 'bdzdsd', '26.png', '26_backside.png', 'hardwork', 'hardwork', '', 17, '2024-05-04 06:39:05', 'sai'),
(27, 'book1', '12321', 'eeww', 23.00, 0.00, 'ddddd', 'images/uploads/66365dcb5e0399.75745580.png', 'images/uploads/66365dcb5e7105.59036644.png', 'nothing', 'nothing', '', 17, '2024-05-04 16:09:47', 'sai'),
(28, 'book1', '12321', 'eeww', 23.00, 0.00, 'ddddd', '28.png', '28_backside.png', 'nothing', 'nothing', '', 17, '2024-05-04 16:11:16', 'sai');

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
(1, 'sai@22', '12333', 67.00, 17, 0, '2024-05-03 13:30:55', NULL, NULL),
(2, 'sai@22', '12333', 67.00, 17, 0, '2024-05-03 13:31:01', NULL, NULL),
(3, 'sai@22', '12333', 34.00, 17, 0, '2024-05-03 13:31:13', NULL, NULL),
(4, 'sai@22', '12333', 34.00, 17, 0, '2024-05-03 13:32:05', NULL, NULL),
(5, 'sai@22', '12333', 344.00, 17, 0, '2024-05-05 08:32:20', NULL, NULL),
(6, 'sai@22', '12333', 34.00, 17, 17, '2024-05-05 08:42:14', 'fdfd', NULL),
(7, 'sai@22', '12333', 45.00, 17, 17, '2024-05-05 16:15:16', 'hii i want ', 28);

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
  `boks` int(11) DEFAULT 5,
  `req` int(11) DEFAULT 5,
  `subscription` varchar(255) DEFAULT 'basic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `number`, `state`, `city`, `password`, `boks`, `req`, `subscription`) VALUES
(17, 'sai', 'sai@22', '12345678', 'Telengana', 'HYderbaad', '$2y$10$tH8YTrw.vchKqBoKHr.NkOPDykLxU3vAH0wGYYuau8ZyEqVoUqdGS', 10, 20, 'premium');

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
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postbook`
--
ALTER TABLE `postbook`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
