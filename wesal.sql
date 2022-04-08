-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 06:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wesal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `access_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `access_level`, `created_at`, `updated_at`) VALUES
(1, 'test', '2022-03-27 21:31:05', '2022-03-27 21:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Food', 'I am hangry', '2022-03-27 21:36:18', '2022-03-27 21:36:18'),
(2, 'Clothes', 'I am naked', '2022-03-27 21:36:18', '2022-03-27 21:36:18'),
(3, 'Sick', 'I am m2nta7', '2022-03-27 21:36:18', '2022-03-27 21:36:18'),
(4, 'Sadaka', 'For the sake of Allah', '2022-03-27 21:36:18', '2022-03-27 21:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `donation_cases`
--

CREATE TABLE `donation_cases` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal_amount` int(11) NOT NULL,
  `raised_amount` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_cases`
--

INSERT INTO `donation_cases` (`id`, `title`, `goal_amount`, `raised_amount`, `image`, `deadline`, `description`, `organization_id`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Food for Resala', 500, 200, 'png.png', '2022-03-23 16:07:26', 'the food will go to the resala comp', 1, 1, 3, '2022-03-27 21:40:49', '2022-03-27 21:40:49'),
(2, 'Clothes for resala', 5000, 2000, 'png.png', '2022-03-23 16:07:26', 'the clothes will go to the resala comp', 1, 2, 3, '2022-03-27 21:40:49', '2022-03-27 21:40:49'),
(3, 'money for resala', 1000, 2000, 'png.png', '2022-03-23 16:07:26', 'the money will go to the resala comp', 1, 2, 3, '2022-03-27 21:40:49', '2022-03-27 21:40:49'),
(4, 'money for misrelkhier', 200, 100, '.png', '2022-03-01 02:33:28', 'please donate money', 2, 1, 1, '2022-03-01 00:33:28', '2022-03-01 00:33:28'),
(5, 'food for misrelkhier', 3000, 1000, 'hi.png', '2022-03-01 17:28:34', 'please food ', 2, 1, 1, '2022-03-09 15:28:34', '2022-03-09 15:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `donation_operations`
--

CREATE TABLE `donation_operations` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `case_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_operations`
--

INSERT INTO `donation_operations` (`id`, `amount`, `currency`, `stripe_key`, `user_id`, `case_id`, `created_at`, `updated_at`) VALUES
(1, 500, '$', 'hi', 3, 1, '2022-03-27 21:44:43', '2022-03-27 21:44:43'),
(2, 100, '$', 'pay', 3, 1, '2022-03-27 21:44:43', '2022-03-27 21:44:43'),
(4, 1000, '$', 'woow', 1, 2, '2022-03-27 21:44:44', '2022-03-27 21:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourite_cases`
--

CREATE TABLE `favourite_cases` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `case_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourite_cases`
--

INSERT INTO `favourite_cases` (`id`, `user_id`, `case_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-03-27 21:40:55', '2022-03-27 21:40:55'),
(2, 3, 1, '2022-03-27 21:40:56', '2022-03-27 21:40:56'),
(3, 1, 2, '2022-03-27 21:40:56', '2022-03-27 21:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(105, '2014_10_12_000000_create_users_table', 1),
(106, '2014_10_12_100000_create_password_resets_table', 1),
(107, '2019_08_19_000000_create_failed_jobs_table', 1),
(108, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(109, '2022_03_20_133100_create_donation_cases_table', 1),
(110, '2022_03_20_133116_create_admins_table', 1),
(111, '2022_03_20_133116_create_organizations_table', 1),
(112, '2022_03_20_133215_create_categories_table', 1),
(113, '2022_03_20_133320_create_donation_operations_table', 1),
(114, '2022_03_20_133335_create_payment_methods_table', 1),
(115, '2022_03_20_133355_create_favourite_cases_table', 1),
(116, '2022_03_20_133408_create_reminders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verificationdocuments` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `verifiedat` datetime NOT NULL,
  `verifiedby` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `title`, `verificationdocuments`, `phonenumber`, `image`, `description`, `verified`, `verifiedat`, `verifiedby`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'Resala', '/doc.pdf', '0122', '/pp.png', 'hello world', 1, '2022-03-23 16:07:26', 1, 3, '2022-03-27 21:35:24', '2022-03-27 21:35:24'),
(2, 'misrelkhier', '/doc.pdf', '01233', '/pp.png', 'please donate', 1, '2022-03-23 16:07:26', 1, 3, '2022-03-27 21:35:24', '2022-03-27 21:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `remind_at` datetime NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `remind_at`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2022-03-23 16:01:44', 'remind me please', 1, '2022-03-27 21:37:44', '2022-03-27 21:37:44'),
(2, '2022-03-23 16:01:44', 'do not remind me please', 2, '2022-03-27 21:37:44', '2022-03-27 21:37:44'),
(3, '2022-03-23 16:01:44', 'please remind', 1, '2022-03-27 21:37:44', '2022-03-27 21:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('admin','user','organization') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `password`, `address`, `phonenumber`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Sergi', '/pp.png', 'sergisamirboules@gmail.com', 'qwerty', 'qwert', '0122', 'admin', '2022-03-27 21:31:05', '2022-03-27 21:31:05'),
(2, 'Karim', '/pp.png', 'karim@gmail.com', 'qwerty', 'qwert', '0122', 'user', '2022-03-27 21:31:05', '2022-03-27 21:31:05'),
(3, 'Reda', '/pp.png', 'reda@gmail.com', 'qwerty', 'qwert', '0122', 'organization', '2022-03-27 21:31:05', '2022-03-27 21:31:05'),
(4, 'hesham', '/pp.png', 'mohamed@gmail.com', 'qwerty', 'qwert', '0122', 'organization', '2022-03-27 21:31:05', '2022-03-27 21:31:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `admins_id_foreign` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_cases`
--
ALTER TABLE `donation_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_operations`
--
ALTER TABLE `donation_operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_operations_user_id_foreign` (`user_id`),
  ADD KEY `donation_operations_case_id_foreign` (`case_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourite_cases`
--
ALTER TABLE `favourite_cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_cases_user_id_foreign` (`user_id`),
  ADD KEY `favourite_cases_case_id_foreign` (`case_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizations_verifiedby_foreign` (`verifiedby`),
  ADD KEY `organizations_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donation_cases`
--
ALTER TABLE `donation_cases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation_operations`
--
ALTER TABLE `donation_operations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourite_cases`
--
ALTER TABLE `favourite_cases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donation_operations`
--
ALTER TABLE `donation_operations`
  ADD CONSTRAINT `donation_operations_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `donation_cases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_operations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite_cases`
--
ALTER TABLE `favourite_cases`
  ADD CONSTRAINT `favourite_cases_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `donation_cases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_cases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `organizations_verifiedby_foreign` FOREIGN KEY (`verifiedby`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
