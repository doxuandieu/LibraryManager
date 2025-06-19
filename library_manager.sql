-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 07:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlythuvien_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `birthday`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'J.K. Rowling', '1965-07-31', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(2, 'George R.R. Martin', '1948-09-20', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(3, 'J.R.R. Tolkien', '1892-01-03', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(4, 'O Henry', '1766-03-01', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(5, 'Nguyễn Du', '1766-01-03', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(6, 'Bernard Marr', '1970-06-05', '2024-11-25 21:37:33', '2024-11-25 21:37:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authors_books`
--

CREATE TABLE `authors_books` (
  `book_id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors_books`
--

INSERT INTO `authors_books` (`book_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2024-11-22 07:33:50', '2024-11-22 07:33:50', NULL),
(2, 2, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(3, 3, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(4, 4, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(5, 5, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(6, 6, '2024-11-25 21:37:53', '2024-11-25 21:37:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_year` year NOT NULL,
  `total_pages` int NOT NULL,
  `price` double NOT NULL,
  `stock` int NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_type` tinyint NOT NULL,
  `book_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `publisher_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `publish_year`, `total_pages`, `price`, `stock`, `address`, `book_type`, `book_code`, `category_id`, `publisher_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 1997, 309, 200000, 16, 'KhuA/D1/T1', 1, 'HPSS', 8, 2, '2024-11-20 11:08:53', '2024-11-25 21:59:57', NULL),
(2, 'A Game of Thrones', 1996, 694, 260000, 20, 'KhuB/D1/T1', 0, 'AGOT', 8, 2, '2024-11-20 11:08:53', '2024-11-22 07:39:48', NULL),
(3, 'The Lord of the Rings', 1954, 1178, 300000, 8, 'KhuC/D1/T1', 1, 'TLOR', 8, 2, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(4, 'Chiếc lá cuối cùng', 2022, 336, 150000, 10, 'KhuD/D1/T1', 0, 'CLCC', 2, 4, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(5, 'Truyện Kiều', 2015, 160, 50000, 20, 'KhuE/D1/T1', 0, 'TK1', 2, 4, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(6, 'Big Data - Dữ Liệu Lớn', 2017, 308, 120000, 20, 'KhuA/D2/T5', 1, 'BDT', 6, 1, '2024-11-25 21:35:03', '2024-11-25 21:46:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `category_name`) VALUES
(1, 'Khoa học'),
(2, 'Văn học'),
(3, 'Sinh học'),
(4, 'Kinh tế'),
(5, 'Ngoại ngữ'),
(6, 'Công nghệ'),
(7, 'Đời sống'),
(8, 'Truyện');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_books`
--

CREATE TABLE `borrow_books` (
  `id` bigint UNSIGNED NOT NULL,
  `student_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `beginDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_books`
--

INSERT INTO `borrow_books` (`id`, `student_code`, `student_name`, `quantity`, `beginDate`, `endDate`, `created_at`, `updated_at`, `status`, `deleted_at`) VALUES
(1, '00001', 'Nguyễn Văn A', 1, '2024-11-16 00:00:00', '2024-11-19 00:00:00', '2024-11-20 11:08:53', '2024-11-20 11:08:53', 1, NULL),
(2, '00002', 'Nguyễn Văn B', 1, '2024-11-17 00:00:00', '2024-11-19 00:00:00', '2024-11-20 11:08:53', '2024-11-20 11:08:53', 1, NULL),
(3, '00004', 'Nguyễn Văn D', 2, '2024-11-18 00:00:00', '2024-11-20 00:00:00', '2024-11-20 11:08:53', '2024-11-25 21:57:28', 1, NULL),
(4, '00001', 'Nguyễn Văn A', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 03:18:10', '2024-11-22 03:19:58', 1, NULL),
(5, 'S0005', 'Nguyễn Thành Nam', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 03:48:53', '2024-11-25 21:59:57', 1, NULL),
(6, 'B2104847', 'Nguyễn Văn A', 2, '2024-11-23 00:00:00', '2024-11-24 00:00:00', '2024-11-22 03:55:20', '2024-11-22 03:55:20', 0, NULL),
(7, 'B2104847', 'Nguyễn Văn A', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 06:10:05', '2024-11-22 06:10:05', 0, NULL),
(8, 'B2104847', 'Nguyễn Văn A', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 06:10:05', '2024-11-22 06:10:05', 0, NULL),
(9, 'B2104847', 'Nguyễn Văn A', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 06:15:37', '2024-11-22 06:15:37', 0, NULL),
(10, 'B2104847', 'Nguyễn Văn A', 1, '2024-11-22 00:00:00', '2024-11-24 00:00:00', '2024-11-22 07:30:27', '2024-11-24 20:19:55', 1, NULL),
(11, '00001', 'Nguyễn Văn A', 1, '2024-11-25 00:00:00', '2024-11-27 00:00:00', '2024-11-24 20:19:37', '2024-11-24 20:19:37', 0, NULL),
(12, 'S0001', 'Nguyễn Văn A', 1, '2024-11-26 00:00:00', '2024-12-10 00:00:00', '2024-11-25 21:26:46', '2024-11-25 21:26:46', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book_details`
--

CREATE TABLE `borrow_book_details` (
  `id` bigint UNSIGNED NOT NULL,
  `borrow_book_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_book_details`
--

INSERT INTO `borrow_book_details` (`id`, `borrow_book_id`, `book_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2024-11-19 19:04:46', '2024-11-19 19:04:46', NULL),
(2, 2, 3, 1, '2024-11-19 19:05:52', '2024-11-19 19:05:52', NULL),
(3, 3, 3, 1, '2024-11-19 19:09:23', '2024-11-19 19:09:23', NULL),
(4, 3, 1, 1, '2024-11-19 19:09:23', '2024-11-19 19:09:23', NULL),
(5, 4, 1, 1, '2024-11-22 03:18:10', '2024-11-22 03:18:10', NULL),
(6, 5, 1, 1, '2024-11-22 03:48:54', '2024-11-22 03:48:54', NULL),
(7, 6, 1, 2, '2024-11-22 03:55:20', '2024-11-22 03:55:20', NULL),
(8, 7, 3, 1, '2024-11-22 06:10:05', '2024-11-22 06:10:05', NULL),
(9, 8, 3, 1, '2024-11-22 06:10:05', '2024-11-22 06:10:05', NULL),
(10, 9, 3, 1, '2024-11-22 06:15:37', '2024-11-22 06:15:37', NULL),
(11, 10, 1, 1, '2024-11-22 07:30:27', '2024-11-22 07:30:27', NULL),
(12, 11, 1, 1, '2024-11-24 20:19:37', '2024-11-24 20:19:37', NULL),
(13, 12, 1, 1, '2024-11-25 21:26:46', '2024-11-25 21:26:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dissertations`
--

CREATE TABLE `dissertations` (
  `id` bigint UNSIGNED NOT NULL,
  `year` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yearOfBirth` int NOT NULL,
  `major` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleInVietnamese` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleInEnglish` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lecturer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_11_20_080001_create_authors_table', 1),
(3, '2024_11_20_080002_create_publishers_table', 1),
(4, '2024_11_20_080003_create_book_categories_table', 1),
(5, '2024_11_20_080004_create_books_table', 1),
(6, '2024_11_20_080005_create_authors_books_table', 1),
(7, '2024_11_20_080006_create_borrow_books_table', 1),
(8, '2024_11_20_080007_create_borrow_book_details_table', 1),
(9, '2024_11_20_080008_create_dissertations_table', 1),
(10, '2024_11_20_080009_create_receipts_table', 1),
(11, '2024_11_20_080010_create_receipt_details_table', 1),
(12, '2024_11_20_080011_create_users_table', 1),
(13, '2024_11_20_154833_create_students_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Giáo dục Việt Nam', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(2, 'Trẻ', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(3, 'Kim Đồng', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(4, 'Văn Học', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `date`, `receiver`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024-11-20 09:03:38', 'Thủ thư', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(2, '2024-11-20 09:12:23', 'Thủ thư', '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(3, '2024-11-22 14:39:48', 'Thủ thư', '2024-11-22 07:39:48', '2024-11-22 07:39:48', NULL),
(4, '2024-11-26 04:46:25', 'Thủ thư', '2024-11-25 21:46:25', '2024-11-25 21:46:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_details`
--

CREATE TABLE `receipt_details` (
  `receipt_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `importPrice` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipt_details`
--

INSERT INTO `receipt_details` (`receipt_id`, `book_id`, `quantity`, `importPrice`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 10, 50000, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(2, 1, 10, 200000, '2024-11-20 11:08:53', '2024-11-20 11:08:53', NULL),
(3, 2, 10, 300000, '2024-11-22 07:39:48', '2024-11-22 07:39:48', NULL),
(4, 6, 10, 100000, '2024-11-25 21:46:25', '2024-11-25 21:46:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `student_id`, `major`, `phone`, `birthday`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn A', 'HG20V7A1', 'B2104847', 'Công nghệ thông tin', '0123456789', '2002-09-09', 'B2104847', '$2y$10$dx2hyoOph4WEB4WhefeTS.O.hW4ZMyDMVW6z4vtZeq2i/hQcZX.Sq', '2024-11-20 11:08:53', '2024-11-22 07:24:16'),
(2, 'Nguyễn Văn B', 'HG20V7A2', 'B2104848', 'Tin học ứng dụng', '0123456789', '2002-02-02', 'student2', '$2y$10$34/JtljsHxulORbPE4mWXuC5SDfjXdjmSkU7NaMT/qg.XkRXqyKfG', '2024-11-22 07:22:45', '2024-11-22 07:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn An', 'nva@ctu.edu.vn', '0123456789', '$2y$10$dx2hyoOph4WEB4WhefeTS.O.hW4ZMyDMVW6z4vtZeq2i/hQcZX.Sq', 1, '2024-11-20 11:08:52', '2024-11-20 11:08:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors_books`
--
ALTER TABLE `authors_books`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `authors_books_author_id_foreign` (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_books`
--
ALTER TABLE `borrow_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow_book_details`
--
ALTER TABLE `borrow_book_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrow_book_details_borrow_book_id_foreign` (`borrow_book_id`),
  ADD KEY `borrow_book_details_book_id_foreign` (`book_id`);

--
-- Indexes for table `dissertations`
--
ALTER TABLE `dissertations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD PRIMARY KEY (`receipt_id`,`book_id`),
  ADD KEY `receipt_details_book_id_foreign` (`book_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_id_unique` (`student_id`),
  ADD UNIQUE KEY `students_username_unique` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrow_books`
--
ALTER TABLE `borrow_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `borrow_book_details`
--
ALTER TABLE `borrow_book_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dissertations`
--
ALTER TABLE `dissertations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors_books`
--
ALTER TABLE `authors_books`
  ADD CONSTRAINT `authors_books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `authors_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `borrow_book_details`
--
ALTER TABLE `borrow_book_details`
  ADD CONSTRAINT `borrow_book_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `borrow_book_details_borrow_book_id_foreign` FOREIGN KEY (`borrow_book_id`) REFERENCES `borrow_books` (`id`);

--
-- Constraints for table `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD CONSTRAINT `receipt_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receipt_details_receipt_id_foreign` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
