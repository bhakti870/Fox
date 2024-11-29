-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:25 AM
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
-- Database: `fox`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `content` varchar(2255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`, `image_path`) VALUES
(1, '<h3><span style=\"color:hsl(0,0%,100%);\"><strong>Welcome to Fox where fitness meets community!</strong></span></h3><h4>&nbsp;</h4><p><span style=\"color:hsl(0,0%,100%);\">&nbsp;At Fox, we believe that fitness is not just a destination; it\'s a journey that requires passion, dedication, and the right environment. Our mission is to provide a supportive space where everyone—from beginners to seasoned athletes—can achieve their fitness goals and transform their lives.</span></p><p>&nbsp;</p><h3><span style=\"color:hsl(30,75%,60%);\"><strong>Our Facilities:-</strong></span></h3><p><span style=\"color:hsl(0,0%,100%);\">&nbsp;Our state-of-the-art gym features top-of-the-line equipment, a variety of strength and cardio machines, and dedicated spaces for group classes, personal training, and functional workouts. Whether you prefer lifting weights, cycling, yoga, or high-intensity interval training, we have something for everyone.</span></p><p>&nbsp;</p><h3><span style=\"color:hsl(60, 75%, 60%);\">Our Team:-</span></h3><p><span style=\"color:hsl(0,0%,100%);\">&nbsp;Our team of certified trainers and fitness experts are here to guide and motivate you. Each trainer brings their unique experience and knowledge, ensuring that you receive personalized attention and effective training plans tailored to your needs. We\'re not just trainers; we\'re your fitness partners, cheering you on every step of the way.</span></p><h3>&nbsp;</h3>', 'uploads/member8.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `admin_membership`
--

CREATE TABLE `admin_membership` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Date` date NOT NULL,
  `Time_duration` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_membership`
--

INSERT INTO `admin_membership` (`Id`, `Name`, `Amount`, `Image`, `Description`, `Date`, `Time_duration`, `status`, `created_at`) VALUES
(12, 'BASIC MEMBERSHIP', 10000.00, 'rode-gym.jpg', '1. Access to cardio and strength training equipment.\r\n\r\n2. Locker room and shower facilities.\r\n\r\n3. Open gym access during regular hours.\r\n\r\n4. Complimentary fitness assessment.', '2024-09-25', '1 Month', 'Active', '2024-10-22 19:43:11'),
(27, 'PREMIUM MEMBERSHIP', 25000.00, 'rode-gym.jpg', '1. Includes all Basic Membership benefits.\r\n\r\n2. Access to group fitness classes (e.g., yoga, spinning, Zumba).\r\n\r\n3. 24/7 gym access.\r\n\r\n4. Discount on personal training sessions.\r\n\r\n5. Access to sauna and steam room.', '2024-10-17', '6 Month', 'Active', '2024-10-22 19:43:11'),
(29, 'PLATINUM MEMBERSHIP', 25000.00, 'rode-gym.jpg', '1. Access to cardio and strength training equipment.\r\n\r\n2. Locker room and shower facilities.\r\n\r\n3. Open gym access during regular hours.\r\n\r\n4. Complimentary fitness assessment.', '2024-10-24', '3 Month', 'Active', '2024-10-22 22:19:16'),
(30, 'IRON MEMBERSHIP', 35000.00, 'member1.jpeg', '1. Includes all Basic Membership benefits.\r\n\r\n2. Access to group fitness classes (e.g., yoga, spinning, Zumba).\r\n\r\n3. 24/7 gym access.\r\n\r\n4. Discount on personal training sessions.\r\n\r\n5. Access to sauna and steam room.', '2024-10-12', '5 Month', 'Active', '2024-10-22 22:25:11'),
(31, 'PLATINUM MEMBERSHIP', 1500.00, 'rode-gym.jpg', 'All type of services Available', '2024-11-19', '3 Month', '', '2024-11-20 09:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_plan`
--

CREATE TABLE `admin_plan` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Weight` int(11) NOT NULL,
  `Goal` varchar(255) NOT NULL,
  `Skill` varchar(255) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Days` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Exercise` varchar(255) NOT NULL,
  `exercise_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_plan`
--

INSERT INTO `admin_plan` (`id`, `Name`, `Weight`, `Goal`, `Skill`, `Duration`, `Days`, `user_id`, `Exercise`, `exercise_id`) VALUES
(31, 'Jenil', 45, 'Fat Loss', 'beginner', 3, '5', 20, ', 1, 2, 4, 5', NULL),
(34, 'Nirali Akbari', 42, 'Hypertrophy', 'beginner', 3, 'thursday', 18, ', 1, 3, 5', NULL),
(40, 'Kashish', 52, 'Hypertrophy', 'intermediate', 6, '5', 25, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_plan_exercise`
--

CREATE TABLE `admin_plan_exercise` (
  `id` int(11) NOT NULL,
  `admin_plan_id` int(11) NOT NULL,
  `workout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_plan_exercise`
--

INSERT INTO `admin_plan_exercise` (`id`, `admin_plan_id`, `workout_id`) VALUES
(13, 31, 1),
(14, 31, 2),
(15, 31, 4),
(16, 31, 5),
(17, 34, 1),
(18, 34, 3),
(19, 34, 5);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_time` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `name`, `user_id`, `date`, `check_in_time`, `check_out_time`, `status`) VALUES
(5, 'Nirr', 19, '2024-10-08', '00:38:00', '01:39:00', 'Present'),
(6, 'Nirr', 19, '2024-10-08', '00:38:00', '01:39:00', 'Present'),
(7, 'Nirr', 19, '2024-10-08', '00:38:00', '01:39:00', 'Present'),
(8, 'Nirali Akbari', 10, '2024-10-23', '03:43:00', '04:43:00', 'Present'),
(9, 'pooja', 9, '2024-10-02', '02:04:00', '02:04:00', 'Present'),
(10, 'Nirali Akbari', 10, '2024-10-31', '03:08:00', '04:10:00', 'Present'),
(11, 'Kashish', 25, '2024-09-17', '02:53:00', '03:53:00', 'Present'),
(12, 'Jenil', 20, '2024-10-02', '08:42:00', '12:42:00', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `Name`, `description`, `img`, `status`, `created_at`) VALUES
(1, 'YOGA CLASSES', 'Discover the art of yoga with our comprehensive classes designed to enhance your flexibility, strength, and overall well-being. Whether you are a beginner or an advanced practitioner, our sessions are tailored to meet your needs. Join us to experienc', 'yoga.jpg', 'Active', '2024-07-07 00:00:00'),
(2, 'ZUMBA CLASSES', 'Get ready to dance your way to fitness with our energetic Zumba classes! Combining fun, easy-to-follow dance moves with vibrant Latin rhythms, Zumba is a full-body workout that feels more like a party than exercise.\r\n', 'zumba.avif', 'Active', '2024-10-22 19:36:06'),
(3, 'class2', 'cfgh kjhg fxbhm', '1729653847_yoga.jpg', '', '2024-11-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `Name`, `Email`, `Message`, `created_at`) VALUES
(1, 'Nirali', 'nirali@gmail.com', 'Give me a membership information about membership', '2024-10-22 19:36:49'),
(6, 'Nirali Akbari', 'akbarinirali27@gmail.com', 'Add my Todays Attendance', '2024-10-22 19:36:49'),
(10, 'pooja', 'nirali1@gmail.com', 'give more information about membership', '2024-10-22 19:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `address` varchar(2550) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `content`, `address`, `phone`, `email`) VALUES
(1, '<p>At Fox Pro, we\'re not just a gym; we\'re a community dedicated to helping you achieve your fitness goals and transform your life. &amp;copy; 2024 Foxpro. All rights reserved. Design by &nbsp;Fox Pro&nbsp;</p>', '701, Star Empire, Near WestZone Circle, 150 Feet Ring Road.', '9727172717', 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Number` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Rating` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `Name`, `Email`, `Number`, `Message`, `Rating`, `created_at`) VALUES
(2, 'bhakti bhut ', 'bhakti26@gmail.com', '278493748893', 'helloo i am bhakti here ', 5, '2024-10-22 19:35:04'),
(3, 'priya busa', 'priya@123gmial.com', '328043780', 'HEYYYY', 3, '2024-10-22 19:35:04'),
(4, 'nirali', 'nirali@gmail.com', '9845786254', 'Good Facility', 0, '2024-10-22 19:35:04'),
(5, 'nirali', 'nirali@gmail.com', '9845786254', 'Good Facility', 0, '2024-10-22 19:35:04'),
(6, 'nirali', 'nirali@gmail.com', '9845786254', 'Good Facility', 0, '2024-10-22 19:35:04'),
(8, 'nirali', 'nirali@gmail.com', '8849274162', 'Excellent Services', 5, '2024-10-22 19:47:34'),
(9, 'Kashish', 'kashish@gmail.com', '9988776655', 'Good Facility', 4, '2024-10-23 00:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `expires_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_token`
--

INSERT INTO `password_token` (`id`, `email`, `otp`, `created_at`, `expires_at`) VALUES
(56, 'nakbari365@rku.ac.in', 184653, '2024-10-15', '2024-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `image` varchar(1100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_Number` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `weight` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `image`, `Name`, `Email`, `Password`, `Phone_Number`, `Gender`, `weight`) VALUES
(5, '', 'priya busaaaaaaaa', 'admin@admin.com', 'admin123', '01997568729', 'female', ''),
(6, '', 'Bhakti Patel', 'admin12@admin.com', 'admin123', '07016370260', 'female', ''),
(7, '', 'dharmik', 'd@gmail.com', 'admin123', '53287973835273673638', 'make', ''),
(8, '', 'priya busa', 'priybusaaaaaaaa@gmail.com', 'admin123', '01997568729', 'f', '');

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `membership_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `expired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `name`, `membership_name`, `price`, `created_at`, `expired_at`) VALUES
(1, 'DEC1217', 'xyz', 100, '2024-11-27', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `number` varchar(255) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `classes` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`, `number`, `weight`, `gender`, `image`, `classes`, `created_at`) VALUES
(9, 'pooja', 'pooja@gmail.com', '8ce87b8ec346ff4c80635f667d1592ae', '0', '50', 'Female', 'icon4.png', '', '0000-00-00 00:00:00'),
(10, 'Nirali Akbari', 'akbarinirali27@gmail.com', 'niralinirali7', '2147483647', '41', 'female', 'icon5.png', 'YOGA CLASSES', '2024-10-22 19:40:00'),
(17, 'Bhakti', 'bhakti27@gmail.com', '147147147', '852145242', '42', 'Male', 'icon5.png', '', '0000-00-00 00:00:00'),
(18, 'Nirali Akbari', 'nirali1717@gmail.com', 'Nirali@27171727', '2147483647', '42', 'Female', 'icon2.png', 'YOGA CLASSES', '0000-00-00 00:00:00'),
(19, 'Nirr', 'nakbari@gmail.com', 'abc@123321', '2147483647', '41', 'Female', 'user.png', 'ZUMBA CLASSES', '0000-00-00 00:00:00'),
(20, 'Jenil', 'jenil@gmail.com', 'jenil@1111', '9747483647', '45', 'male', 'icon5.png', 'YOGA CLASSES', '2024-10-22 19:40:00'),
(24, 'Admin', 'admin7@gmail.com', 'admin@2717', '2147483647', '42', 'Female', 'icon5.png', '', '2024-10-22 21:51:54'),
(25, 'Kashish', 'kashish@gmail.com', 'kashish1717', '2147483647', '52', 'female', 'user.png', 'ZUMBA CLASSES', '2024-10-23 00:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Experience` int(11) DEFAULT NULL,
  `bio` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `Name`, `Image`, `Contact`, `City`, `Address`, `Experience`, `bio`, `status`, `created_at`) VALUES
(1, 'JENIFERR', 'trainers1.jpg', '1234567890', 'Rajkot', 'Kotecha chowk, kalavad road, Rajkot', 2, 'Trainers, athletes and serious clients alike are looking for the toughest, most brutally productive training techniques to spice up their workouts and provide a truly unique challenge', 'Active', '2024-10-22 19:39:16'),
(2, 'JHON', 'trainers2.jpg', '7016370260', 'RALEIGH', '93 SUN TOWN STREET', 3, 'Trainers, athletes and serious clients alike are looking for the toughest, most brutally productive training techniques to spice up their workouts and provide a truly unique challenge', 'Active', '2024-10-22 19:39:16'),
(3, 'COREY', 'trainers2.jpg', '8787878787', 'Rajkot', 'Balaji Hall, 150 Feet Ring Road', 5, 'Trainers, athletes and serious clients alike are looking for the toughest, most brutally productive training techniques to spice up their workouts and provide a truly unique challenge', 'Active', '2024-10-22 19:39:16'),
(4, 'nirali', 'trainers1.jpg', '8849274162', 'rajkot', 'Krishna Park Society', 2, 'hiiiiii', 'Inactive', '2024-10-23 08:51:17'),
(5, 'nirali', '1732075323_g2.jpg', '8849274162', 'Rajkot', '701, Star Empire, Near WestZone Circle, 150 Feet Ring Road.', 7, 'SADNKLAMDKX ksndkask', '', '2024-11-20 09:32:03'),
(6, 'nirali', 'g2.jpg', '9521478525', 'Rajkot', '701, Star Empire, Near WestZone Circle, 150 Feet Ring Road.', 7, 'AAAAAABBBBBBBBBBCCCCCCCCCCCCCDDDDDDDDDDD', '', '2024-11-20 09:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`) VALUES
(13, 'GANVAY', 'admin123@admin.com', '123456'),
(14, 'Bhakti', 'admin@gmail.com', 'admin'),
(16, 'nnnnnnnnnnnn', 'nirali@gmail.com', '1111222233'),
(17, 'ggggggggggg', 'admin123@admin.com', '222222222');

-- --------------------------------------------------------

--
-- Table structure for table `user_membership`
--

CREATE TABLE `user_membership` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `membership_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_membership`
--

INSERT INTO `user_membership` (`id`, `Name`, `Amount`, `user_id`, `membership_id`, `Date`, `created_at`) VALUES
(1, 'Premium Membership', 15000.00, 20, 12, '2024-10-16', '2024-10-22 19:56:10'),
(6, 'PREMIUM MEMBERSHIP', 25000.00, NULL, 27, '0000-00-00', '2024-10-22 19:56:10'),
(7, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-10-22 19:56:10'),
(8, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-10-22 19:56:10'),
(9, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-10-22 19:56:10'),
(10, 'BASIC MEMBERSHIP', 10000.00, 25, 12, '0000-00-00', '2024-10-23 00:08:24'),
(11, 'PLATINUM MEMBERSHIP', 15000.00, 25, 29, '0000-00-00', '2024-10-23 00:14:34'),
(12, 'IRON MEMBERSHIP', 35000.00, 25, 30, '0000-00-00', '2024-10-23 00:50:08'),
(13, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-10-23 08:48:05'),
(14, 'IRON MEMBERSHIP', 35000.00, 20, 30, '0000-00-00', '2024-11-21 12:56:52'),
(15, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-21 13:38:26'),
(16, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-11-21 13:38:42'),
(17, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 08:53:06'),
(18, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 09:05:25'),
(19, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 09:13:35'),
(20, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 09:14:47'),
(21, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 09:26:01'),
(22, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-11-27 09:35:51'),
(23, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 12:54:05'),
(24, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 12:58:51'),
(25, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-27 13:12:19'),
(26, 'PLATINUM MEMBERSHIP', 25000.00, 20, 29, '0000-00-00', '2024-11-27 16:50:44'),
(27, 'IRON MEMBERSHIP', 35000.00, 20, 30, '0000-00-00', '2024-11-28 08:21:10'),
(28, 'PLATINUM MEMBERSHIP', 25000.00, 20, 29, '0000-00-00', '2024-11-28 08:45:31'),
(29, 'PLATINUM MEMBERSHIP', 25000.00, 20, 29, '0000-00-00', '2024-11-28 08:57:21'),
(30, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-11-28 09:13:24'),
(31, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-28 09:13:56'),
(32, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-11-28 09:33:43'),
(33, 'PREMIUM MEMBERSHIP', 25000.00, 20, 27, '0000-00-00', '2024-11-28 09:35:36'),
(34, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-28 10:28:34'),
(35, 'BASIC MEMBERSHIP', 10000.00, 20, 12, '0000-00-00', '2024-11-28 15:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `id` int(11) NOT NULL,
  `Exercise` varchar(255) NOT NULL,
  `Equipment` varchar(255) NOT NULL,
  `Reps` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`id`, `Exercise`, `Equipment`, `Reps`) VALUES
(1, 'DUMBBLE BENCH PRESS', 'Bench, Dumbble', '8,10,12'),
(2, 'LAT PULLDOWN', 'Adjustable Cable Machine, Lat Pulldown Bar', '8,10,12'),
(3, 'Rope PressDown', 'Adjustable Cable Machine, Rope Attachment', '8,10,12'),
(4, 'Standing Calf Raise', 'Box', '8,10,12'),
(5, 'OverHead Dumbbell Press', 'Dumbbells', '8,10,12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_membership`
--
ALTER TABLE `admin_membership`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `admin_plan`
--
ALTER TABLE `admin_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `admin_plan_exercise`
--
ALTER TABLE `admin_plan_exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_plan_id` (`admin_plan_id`),
  ADD KEY `workout_id` (`workout_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_membership`
--
ALTER TABLE `admin_membership`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `admin_plan`
--
ALTER TABLE `admin_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `admin_plan_exercise`
--
ALTER TABLE `admin_plan_exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_membership`
--
ALTER TABLE `user_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_plan`
--
ALTER TABLE `admin_plan`
  ADD CONSTRAINT `admin_plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`),
  ADD CONSTRAINT `admin_plan_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `workout` (`id`);

--
-- Constraints for table `admin_plan_exercise`
--
ALTER TABLE `admin_plan_exercise`
  ADD CONSTRAINT `admin_plan_exercise_ibfk_1` FOREIGN KEY (`admin_plan_id`) REFERENCES `admin_plan` (`id`),
  ADD CONSTRAINT `admin_plan_exercise_ibfk_2` FOREIGN KEY (`workout_id`) REFERENCES `workout` (`id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD CONSTRAINT `user_membership_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`),
  ADD CONSTRAINT `user_membership_ibfk_2` FOREIGN KEY (`membership_id`) REFERENCES `admin_membership` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
