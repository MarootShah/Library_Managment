-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2026 at 04:55 AM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `total_qty` int(11) NOT NULL DEFAULT 1,
  `available_qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `total_qty`, `available_qty`, `created_at`) VALUES
(1, 'test', 'krushna bhaiya', 1, 1, '2026-03-06 05:12:12'),
(11, 'test33', 'Maroot Shah', 1, 1, '2026-03-10 06:43:37'),
(12, 'test 4', 'Maroot Shah', 1, 1, '2026-03-12 04:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('issued','returned') NOT NULL DEFAULT 'issued',
  `fine_amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `stu_id`, `phone`, `class`, `created_at`) VALUES
(33, 33, '9104393949', 'int.b.tech.cse', '2026-03-12 05:38:47'),
(34, 34, '9313256253', 'Int Btech CSE', '2026-03-12 05:39:57'),
(35, 35, '9313256253', 'Int Btech CSE', '2026-03-12 09:33:35'),
(36, 39, '9313256253', 'Int Btech CSE', '2026-03-13 06:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(26, 'Maroot Shah', 'shahmaroot5@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2026-03-10 06:48:04'),
(33, 'Parth Pandya', 'parth2008pandya@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2026-03-12 05:38:47'),
(34, 'Maroot Shah', 'shahmaroot6@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2026-03-12 05:39:57'),
(35, 'Het Shah', 'shahmaroot7@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2026-03-12 09:33:35'),
(36, 'Himesh Verma', 'Himeshverma@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2026-03-12 09:35:12'),
(37, 'karan sharma', 'karansharma@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2026-03-12 09:37:25'),
(38, 'Kavya Patel', 'Kavya@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2026-03-13 06:45:21'),
(39, 'Krutagna Nai', 'Krutagna@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2026-03-13 06:46:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_issue_student` (`student_id`),
  ADD KEY `fk_issue_book` (`book_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `fk_issue_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_issue_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
