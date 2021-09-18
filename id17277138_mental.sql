-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2021 at 03:16 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17277138_mental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `college` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `position` varchar(10) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name_ar`, `name_en`, `email`, `password`, `college`, `division`, `mobile`, `position`) VALUES
(1, 'ايمن', 'Ayman', 'aymansafwat88@yahoo.com', '63c02f11b01c7303587a8a90a5c012f81a40f946', 'Science', 'Physics', '01062153292', 'master'),
(7, 'حنان محمد', 'Hanan Mohammed', 'h.esmaeil@mu.edu.sa', 'd826ec5d0a5ed39f63ce39eec1756f846bfa7c50', 'التربية', 'الصحة النفسيه', '0535074839', 'master');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('aymansafwat88@yahoo.com', '$2y$10$sXytDhuDjPqTUEoOKgUO1u68nio9O9/aVdXZFPqeJ4r.ybcVeKL32', '2021-09-08 16:33:34'),
('aymansafwat2468@gmail.com', '$2y$10$WVcQXPaecmLeyiuIEkogQOq/oHWMufQSJdKZGQsMw8ARhkv8zZ6o6', '2021-09-08 16:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `answer` varchar(5000) NOT NULL DEFAULT 'waiting for answer',
  `user` varchar(50) NOT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `college` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name_ar`, `name_en`, `email`, `password`, `age`, `college`, `division`, `mobile`, `email_verified_at`, `remember_token`) VALUES
(1, 'ايمن', 'Ayman', 'aymansafwat88@yahoo.com', '$2y$10$MPOxIRbaxFdMCIjWrSlEHeJh3T6YBF/BZ2uKOSyZfL4nc3gemwpku', 28, 'Science', 'Physics', '01062153292', '2021-09-03 23:19:36', 'Fzhci9rm1Cw25yE3srTNTmgJYFLBAu5LJnkaPsK1T3BpuP3BV9Zu9hTIgBby'),
(7, 'حنان محمد', 'Hanan Mohammed', 'h.esmaeil@mu.edu.sa', '$2y$10$USOVHCdhtzwGdzQLpGbiceFv3jmtzQ.ZFuRmeFSQZFY9R3fVltlVC', 54, 'التربية', 'الصحة النفسية', '0535074839', '2021-09-12 16:00:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
