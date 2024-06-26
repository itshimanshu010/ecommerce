-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2024 at 08:22 AM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Himanshu Jaiswal', 'himanshu.tech010@gmail.com', NULL, '$2y$10$GMyiWZByklbbc9CLzysJP.EH3ZUJWQSWymTJT4BaqgVKDu26ouepy', '1712562639.jpg', 'SImskXwegPiyV9CqheCy5LXVWZqAHmf7fwz9Ix5kMNTEOEwWgF9M14JXuoiv', 'active', '2024-03-01 07:58:52', '2024-04-08 02:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE `baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baskets`
--

INSERT INTO `baskets` (`id`, `user_id`, `product_id`, `quantity`, `unit_price`, `total`, `status`, `created_at`, `updated_at`, `checked`) VALUES
(112, 39, 19, 1, 2000.00, 2000.00, 'active', '2024-04-24 05:33:04', '2024-04-24 05:33:04', 1),
(113, 39, 20, 1, 2000.00, 2000.00, 'active', '2024-04-24 05:33:05', '2024-04-24 05:33:05', 1),
(117, 39, 15, 1, 220000.00, 220000.00, 'active', '2024-04-24 05:33:09', '2024-04-24 05:33:09', 1),
(197, 43, 15, 2, 50.00, 100.00, 'active', '2024-05-10 04:21:04', '2024-05-20 02:06:55', 1),
(199, 43, 18, 1, 200.00, 200.00, 'active', '2024-05-10 04:21:06', '2024-05-10 04:21:06', 1),
(200, 43, 21, 1, 10.00, 10.00, 'active', '2024-05-10 04:21:08', '2024-05-10 04:21:08', 1),
(201, 43, 20, 1, 10.00, 10.00, 'active', '2024-05-10 04:21:09', '2024-05-10 04:21:09', 1),
(202, 43, 19, 1, 100.00, 100.00, 'active', '2024-05-10 04:21:10', '2024-05-20 02:07:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Shirt', '1712034693.jpg', 'active', '2024-04-01 23:32:48', '2024-04-01 23:41:33'),
(13, 'Jeans', '1712034737.jpg', 'active', '2024-04-01 23:42:17', '2024-04-01 23:42:17'),
(14, 'Electronic', '1712034789.jpg', 'active', '2024-04-01 23:43:01', '2024-04-01 23:43:09'),
(15, 'Grocery', '1712034891.jpg', 'active', '2024-04-01 23:44:51', '2024-04-01 23:44:51'),
(16, 'Home Appliances', '1712034945.jpg', 'active', '2024-04-01 23:45:45', '2024-04-01 23:45:45'),
(18, 'Ticket', '1712041737.jpg', 'active', '2024-04-02 01:38:28', '2024-04-08 00:29:17'),
(19, 'T-Shirt', '1713964498.jpg', 'active', '2024-04-24 07:42:14', '2024-04-24 07:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_27_101540_create_table_name', 1),
(7, '2014_10_12_000000_create_users_table', 2),
(8, '2024_02_29_071243_user', 2),
(11, '2024_03_01_092638_create_admins_table', 3),
(13, '2024_03_05_064941_add_phone_field_to_users', 4),
(15, '2024_04_01_060920_create_categories_table', 5),
(16, '2024_04_01_110912_create_sub_categories_table', 6),
(17, '2024_04_05_110904_create_products_table', 7),
(18, '2024_04_09_070101_create_product_variants_table', 8),
(24, '2024_04_16_084302_create_baskets_table', 9),
(27, '2024_04_29_052224_add_checked_field_to_baskets', 11),
(29, '2024_04_25_111726_create_orders_table', 12),
(30, '2024_04_29_085024_create_order_details_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `shipping_charge` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `payment_id`, `user_id`, `subtotal`, `tax`, `shipping_charge`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 43, NULL, NULL, NULL, NULL, 'pending', '2024-05-10 04:08:59', '2024-05-10 04:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('himanshu.tech010@gmail.com', '$2y$10$Y1T6NpbnPDvAojNlj2BfM.opQ2cccr/nHEkYb.hkbhjepoz/JCrcC', '2024-04-02 23:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `images` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `category_id`, `sub_category_id`, `quantity`, `price`, `status`, `images`, `created_at`, `updated_at`) VALUES
(15, 'Redmi Note 7 Pro', 'redmi-note-7-pro', 14, 14, 20, 50.00, 'active', '1713964044.jpg', '2024-04-08 01:35:21', '2024-04-24 07:37:24'),
(17, 'Samsung S21 Ultra', 'samsung-s21-ultra', 14, 15, 1, 100.00, 'active', '1713963711.jpg', '2024-04-08 04:12:32', '2024-04-24 07:31:51'),
(18, 'Apple Iphone 15', 'apple-iphone-15', 14, 16, NULL, 200.00, 'active', '1713963970.jpg', '2024-04-08 04:12:44', '2024-04-24 07:36:10'),
(19, 'OnePlus 9 5G', 'oneplus-9-5g', 14, 17, 2, 100.00, 'active', '1713964232.jpg', '2024-04-08 04:28:13', '2024-04-24 07:43:06'),
(20, 'Roadster Summer Tshirt', 'roadster-summer-tshirt', 19, 18, 2, 10.00, 'active', '1713964562.jpg', '2024-04-08 06:49:16', '2024-04-24 07:46:02'),
(21, 'Roadster Polo T-Shirt', 'roadster-polo-t-shirt', 19, 18, NULL, 10.00, 'active', '1712917243.jpeg', '2024-04-12 04:50:43', '2024-04-24 07:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color`, `size`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 'red', '33', 33, 'active', '2024-04-09 12:22:57', '2024-04-09 12:22:57'),
(3, 15, 'nnvnghg', '4', 14, 'active', '2024-04-10 05:06:35', '2024-04-10 05:06:35'),
(6, 15, 'blue', '4', 66, 'active', '2024-04-10 05:29:48', '2024-04-10 05:29:48'),
(10, 21, 'red', 's', 20, 'active', '2024-04-12 04:51:32', '2024-04-12 04:51:32'),
(11, 21, 'blue', 's', 20, 'active', '2024-04-12 04:51:32', '2024-04-12 04:51:32'),
(12, 21, 'green', 'm', 20, 'active', '2024-04-12 04:51:32', '2024-04-12 04:51:32'),
(14, 21, 'violet', 'm', 22, 'active', '2024-04-12 05:14:48', '2024-04-12 05:14:48'),
(15, 21, '#e70d0d', '6', 14, 'active', '2024-04-12 05:16:32', '2024-04-12 05:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(14, 'Redmi Note', 14, NULL, 'active', '2024-04-02 23:19:34', '2024-04-08 01:20:10'),
(15, 'Samsung', 14, NULL, 'active', '2024-04-24 07:31:12', '2024-04-24 07:31:12'),
(16, 'Apple', 14, NULL, 'active', '2024-04-24 07:32:22', '2024-04-24 07:32:22'),
(17, 'OnePlus', 14, NULL, 'active', '2024-04-24 07:42:34', '2024-04-24 07:42:34'),
(18, 'Roadster', 19, NULL, 'active', '2024-04-24 07:45:27', '2024-04-24 07:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `table_name`
--

CREATE TABLE `table_name` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(22, 'Lakshay Sir', '7894561233', 'lakshay@braintechnosys.com', 'inactive', NULL, '$2y$10$GbqmXZ9MEPs8Caa329wJoewDLyW5eN7pCVCPwQ7f4T6ndV9V3pc8.', NULL, '2024-03-05 03:30:41', '2024-03-05 03:30:41'),
(23, 'Ankit Raghav Sir', '8527419631', 'ankit@braintechnosys.com', 'active', NULL, '$2y$10$6kqr5UZQ2Klu/pHjc52qPuot.a3VZThutbLhumWJ1uWkLvB8gtW4q', NULL, '2024-03-05 03:31:27', '2024-03-05 03:31:27'),
(24, 'Gaurav Sir 2', '4567891236', 'gaurav@braintechnosys.in', 'inactive', NULL, '$2y$10$DtmHnBIhk2tcVWwluLOPQuaW42nySNGQmI52aS5U9lkUEmxgyRNPq', NULL, '2024-03-05 03:32:24', '2024-03-05 04:50:51'),
(26, 'Anurag Sir', '7412589632', 'anurag@braintechnosys.com', 'active', NULL, '$2y$10$Sx.F9faffeBQhmGXLkAbGO1wfmF63Roozjpjcwr4BbszOBqvgAwqG', NULL, '2024-03-05 03:34:41', '2024-03-05 03:34:41'),
(27, 'Raghav', '7412893247', 'rag@gmail.com', 'active', NULL, '$2y$10$CQ0TE3sRhpjOhlxcQNgAUuXYmwQEm9/8zsbWSKHbkRKNDYlj6gCTq', NULL, '2024-03-05 04:37:58', '2024-03-05 04:37:58'),
(28, 'Brijesh Sharma Sir', '7418529637', 'brijesh@gmail.com', 'inactive', NULL, '$2y$10$i8HBuNbjXr/.TMhyLrtKHuGE09dXHinN5sndjg9qyX0FXA4Wyytei', NULL, '2024-03-05 04:40:46', '2024-03-05 05:02:42'),
(29, 'Saurabh', '9874563214', 'saurabh@braintechnosys.com', 'active', NULL, '$2y$10$.A99TyYhbTsbwm1CApFZfOsM1amp9ZY9HGMfsHxATImWsBzeTaJce', NULL, '2024-03-05 05:12:46', '2024-03-06 01:07:04'),
(34, 'Shrijan', '9450600586', 'shrijanaa123@gmail.com', 'inactive', NULL, '$2y$10$i9M4RbaeNix1UsqpohLoGu.ia5fwN9cAr9jdm2fFmEu5WGMH6K7KS', NULL, '2024-03-29 07:27:44', '2024-03-29 07:31:25'),
(35, 'raj', '9632587412', 'raj@gmail.com', 'inactive', NULL, '$2y$10$0TUl6pWQkpp2mpR8wh0GJel.ViBC1eml6ozED3T2Jx0Wc5wTPlHzK', NULL, '2024-03-29 08:01:57', '2024-04-01 01:26:23'),
(36, 'Himesh', '123456789', 'him@gmail.com', 'active', NULL, '$2y$10$aalWG1E.BV8rB2ZOzaUz0eiglha96LRBwnjZDrfLBqwwIbhjUYwcy', NULL, '2024-04-01 04:37:49', '2024-04-01 04:37:49'),
(38, 'Lakshay Sir', '7418529632', 'ankitsir@gmail.com', 'active', NULL, '$2y$10$A.cudNKsZBzdB6nM6Hy27erf//VNyHMqy.RiTnr5oaQ0HmZ0PmOey', NULL, '2024-04-05 01:52:59', '2024-04-05 05:11:30'),
(39, 'Gaurav', NULL, 'g@gmail.com', 'active', NULL, '$2y$10$EjeFxVpR1Ty9h6DJyxHQgu03b.08z/mPUeGfrGg07X0sMqmuL.6YS', NULL, '2024-04-11 01:34:57', '2024-04-11 01:34:57'),
(40, 'Laks', NULL, 'l@gmail.com', 'active', NULL, '$2y$10$5FL8ts4z0kcB6xKmLyuuheW/10t.BZzi6/3HSZkd3aL5YeEFLy3OS', NULL, '2024-04-11 02:18:50', '2024-04-11 02:18:50'),
(41, 'Ankit Sir', NULL, 'a@gmail.com', 'active', NULL, '$2y$10$NrVrMehoYqYPe/NUggdKC.OVeCgeJGJnuVOvRS5LITlz9gKXYk0iW', NULL, '2024-04-11 02:45:22', '2024-04-11 02:45:22'),
(42, 'Ankit Raghav', NULL, 'ankit+1@braintechnosys.com', 'active', NULL, '$2y$10$5vBeG7KG6wErxuQabPFQbefRbdaiips0nGYBr0uRorH/boYjgAefi', NULL, '2024-04-11 03:29:06', '2024-04-11 03:29:06'),
(43, 'Himanshu', NULL, 'h@gmail.com', 'active', NULL, '$2y$10$Kj/SDdLjT6iHTtuQQKior.oxq7Dcvn7OiA3VOKxgzmOW52VLJedmu', NULL, '2024-04-12 00:07:00', '2024-04-12 00:07:00'),
(44, 'Tushar', NULL, 'tushar@gmail.com', 'active', NULL, '$2y$10$ztPa2M/NwlRVt3eIAikRbu.UVsSw9R0he0lNZHmzl8OeH59XoWWyi', NULL, '2024-04-23 04:56:27', '2024-04-23 04:56:27'),
(45, 'Gaurav', NULL, 'gau@gmail.com', 'active', NULL, '$2y$10$w1VS.914Pr5SvKuufvW5M.wcVjCUee9qu/8hdPdsRdQOiVdt1NOb6', NULL, '2024-05-23 05:34:34', '2024-05-23 05:34:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baskets_user_id_foreign` (`user_id`),
  ADD KEY `baskets_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `table_name`
--
ALTER TABLE `table_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `table_name`
--
ALTER TABLE `table_name`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baskets`
--
ALTER TABLE `baskets`
  ADD CONSTRAINT `baskets_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `baskets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
