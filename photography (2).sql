-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 مايو 2025 الساعة 19:35
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photography`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `Email`) VALUES
(1, NULL, '733363327', 'tota7333@gmail.com'),
(2, NULL, NULL, ''),
(4, NULL, NULL, ''),
(6, 'توته', '$2y$10$o8pG9vCHjIAdYnmLpza3xeKUG3FL45mj0f15FSh3XgGG4HlwVkZUS', 'tota77@gmail.com');

-- --------------------------------------------------------

--
-- بنية الجدول `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `session_date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `User_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `session_date`, `message`, `created_at`, `User_id`) VALUES
(1, 'tota', 'tota456@gimal.com', NULL, '2025-05-13', '', '2025-05-20 13:13:38', NULL),
(3, 'tota', 'tota733@gmail.com', '73336327', '2025-05-30', '', '2025-05-27 04:30:57', 1),
(4, 'tota', 'tota7333@gmail.com', '73336327', '2025-05-29', '', '2025-05-28 10:54:54', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image_path`, `uploaded_at`) VALUES
(1, 'birth.png', 'brth.png', '2025-05-22 20:18:37'),
(2, 'grad.png', 'grad.png', '2025-05-22 20:19:17'),
(3, 'ch.jpg', 'ch.jpg', '2025-05-22 20:19:50'),
(9, 'chald.png', '1747946119_chald.png', '2025-05-22 20:35:19'),
(11, 'nur', '1748012604_nur.png', '2025-05-23 15:03:24'),
(12, 'g', '1748012628_g.png', '2025-05-23 15:03:48'),
(13, 'w', '1748012660_wd.png', '2025-05-23 15:04:20'),
(14, 'r', '1748012702_wda.png', '2025-05-23 15:05:02'),
(15, 'g', '1748024943_gra.png', '2025-05-23 18:29:03'),
(16, 'h', '1748025007_cha.png', '2025-05-23 18:30:07'),
(17, 'c', '1748278196_grada.png', '2025-05-26 16:49:56'),
(18, 'u', '1748429770_6.jpg', '2025-05-28 10:56:10');

-- --------------------------------------------------------

--
-- بنية الجدول `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `sent_at`) VALUES
(1, 'tota', 'tota7333@gmail.com', NULL, 'hi', '2025-05-21 08:23:28');

-- --------------------------------------------------------

--
-- بنية الجدول `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sessions`
--

INSERT INTO `sessions` (`id`, `title`, `price`, `image_path`, `created_at`) VALUES
(2, 'جلسة تصوير تخرج', '70.00', 'uploads/g.png', '2025-05-28 10:29:56'),
(3, 'جلسة عيد ميلاد', '200.00', 'uploads/brth.png', '2025-05-28 10:29:56'),
(4, 'جلسة تصوير زفاف', '800.00', 'uploads/wd.png', '2025-05-28 10:29:56'),
(6, 'جلسة تصوير عقد', '100.00', 'uploads/wda.png', '2025-05-28 10:40:45'),
(10, 'جلسة تصوير منتجات', '300.00', 'uploads/co.jpg', '2025-05-28 10:40:45');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`User_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'tota alshehabi', 'tota733@gmail.com', '$2y$10$4yKmAuu5SHG2/DIXPjYtAe0GNMT.CAmGNJWiG2JJQd0Php9c7z3gi', '2025-05-22 07:17:50'),
(8, 'admin', 'admin253@gmail.com', '$2y$10$3c.GIYfx8KhcR5dbUGYrbeHomLAhWk8w3SCw7b0l5f6CwclQV9PLu', '2025-05-23 19:33:40'),
(12, 'sara', 'sara56@gmail.com', '$2y$10$nW79zqlKZrGNBvhiY84ZIuSo/.sbmDE1w7lmXMgnXpTLETd/L.Hu.', '2025-05-26 17:01:18'),
(13, 'reem', 'reem78@gmail.com', '$2y$10$88pTk3hCEGHJxJd7lvN7OOqhLJmW5es71I9qFuDDZL3A/kYwpfEoW', '2025-05-26 18:58:30'),
(14, 'toty', 'toty78@gmail.com', '$2y$10$8D/qmue3rGql3N.vn2cAnOv8VbM7YUXe1ZVe1kIGJ/mjJW0TAlYai', '2025-05-27 03:22:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
