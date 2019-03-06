-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2019 at 01:08 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Inactive,1:Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_code`, `mobile_number`, `otp`, `otp_date`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Radical', 'Hash', 'info@radicalhash.com', '$2y$10$VnzpfsOro9NtDhRAm4YABOWiYiPJlU.hI6kSeJKAH0Trsj91MxWbe', '91', '8058221535', NULL, NULL, 1, 'BxxYakKuahfGX5fEbJ3evGuu1tlK0y4jWxrbEy41FHCErUxzO0I3bMXAve4o', '2018-02-04 06:16:17', '2018-06-18 11:24:32');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('k.rsaini20@gmail.com', '$2y$10$9GxtdDfwbhkAvphkMsAnoOWUaD4evxPI8/mlOM.s3CjsZMaiphX2C', '2019-02-16 04:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_address` varchar(255) NOT NULL,
  `from_addreess` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `transaction_hash` varchar(255) NOT NULL,
  `wallet_type` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `to_address`, `from_addreess`, `amount`, `transaction_hash`, `wallet_type`, `created_at`, `updated_at`) VALUES
(5, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 2000000000000000, '4b33b6df85194b43f7d5da318ceeb172072ef7e867eafdd7451fb9d2cc5b8810', 'ETH', '2019-02-21 05:55:51', '2019-02-21 05:55:51'),
(6, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 300000000000000, '8607eb7e18dd1b4bbdf23508e8527064755e6166f6a1d1a3ce812c0fca9d8c08', 'ETH', '2019-02-21 06:01:21', '2019-02-21 06:01:21'),
(7, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 40000000000000000, 'f74b44420712d29006bfb0069ea715b32a8374ea7225cb89e3ba8b5dad374c89', 'ETH', '2019-02-21 06:02:53', '2019-02-21 06:02:53'),
(8, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 40000000000000000, '181adf0589b0a4b64a4039d9b50383223fad4ee990818e65a3d1759a3766a715', 'ETH', '2019-02-21 06:03:46', '2019-02-21 06:03:46'),
(9, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 40000000000000000, '72437a13b7c8f9db1f8d0df9eb5f6e627707c50a024257fb2509927eec60cf69', 'ETH', '2019-02-21 06:06:16', '2019-02-21 06:06:16'),
(10, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 2000000000000000, 'f2922cd5b79d4d1929bfa0fbd9dfcda9abf794ecf4a6ddb23633615acd1f20c7', 'ETH', '2019-02-21 06:10:11', '2019-02-21 06:10:11'),
(11, 17, 'ef2dfb886d6669925b4e7e8d54fbf26155cb832e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 500000000000000, '695ccac31a144a2efc40a717147753280d36858dfcfd2a494c63a6bc4773c05d', 'ETH', '2019-02-21 06:10:46', '2019-02-21 06:10:46'),
(12, 17, 'e3ce4b773dcd7da6c7f4dfeba4d87894e1ca4a1e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 20000000000000, 'c7900482c7e2aecb9918e3093c3f2cfbfa458027548427657b212e3717b331d3', 'ETH', '2019-02-21 06:26:31', '2019-02-21 06:26:31'),
(13, 17, 'e3ce4b773dcd7da6c7f4dfeba4d87894e1ca4a1e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 20000000000000, 'fbd8bae1d82eb82b7415ca5349d4583f0f8e7e45a4469ad1f77dc7cd3b05f092', 'ETH', '2019-02-21 06:26:55', '2019-02-21 06:26:55'),
(14, 17, 'e3ce4b773dcd7da6c7f4dfeba4d87894e1ca4a1e', 'deadc58876446ad1c053233a04045b3ca2b797fd', 20000000000000, 'f75cf1cedb509c66792064100132519da2c0f880e5d181dfefb167cc4e9979be', 'ETH', '2019-02-21 06:27:20', '2019-02-21 06:27:20'),
(15, 17, 'mx43vV1HgnVDXcRhTWmFsY18AUHtgGNyJj', 'mr7oWbnzPXKZqWsj9cLTQsBo6sQHHT5Pgf', 200000, 'c9bc4e6aea04c72ca5b935022fcfc8cf8cdfa434561a722bfb252d5787ea6ef0', 'BTC', '2019-02-21 06:56:17', '2019-02-21 06:56:17'),
(16, 17, 'mtxPSCyrvBpsgAgD6Pztrr5eFyGk4axGEj', 'mr7oWbnzPXKZqWsj9cLTQsBo6sQHHT5Pgf', 600000, 'eb92a3a006b7ff70aac03bf959048af05f68bb5ce32966d29a1265fe0daf6f02', 'BTC', '2019-02-21 15:19:24', '2019-02-21 15:19:24'),
(17, 17, 'n4nSaZ84DbjEp5BpW19ABmXMqH7j4ito3n', 'mr7oWbnzPXKZqWsj9cLTQsBo6sQHHT5Pgf', 600000, 'f6dc8f5933e8561728a39f3b65567f09a9892a14ae65d0db1cb906b1c87475e5', 'BTC', '2019-02-21 15:23:51', '2019-02-21 15:23:51'),
(18, 10, '0x7C4029e848b7854F8aC1466158E55873aE8cc562', '842eca8342be0e3e3a4c663f6481752c5ead175c', 100000000000000000, 'b13e97ff6884bc2d6189e020f809222892836f7830f7fa1bdadaa773c161339f', 'ETH', '2019-02-22 06:40:10', '2019-02-22 06:40:10'),
(19, 10, 'n1ioN1Ls3JmL7C1Ge8XfiQTD6xp2NRJFsV', 'n4nSaZ84DbjEp5BpW19ABmXMqH7j4ito3n', 10000, 'facb4839c4446067ec51957a5b43d667ec66d00e57c3dc901515f8a902319764', 'BTC', '2019-02-22 06:43:19', '2019-02-22 06:43:19'),
(20, 17, '0a778403bfd3664723770639e15f6f10ea504e9e', '65b615ff7b02947f543e4048a6bef17edf921261', 2000000000000000, 'b91151e441d5671a0e63858bb40913f5e879d8c93cfa0f08e6297a3f221f1f7c', 'ETH', '2019-02-22 09:41:07', '2019-02-22 09:41:07'),
(21, 15, '65b615ff7b02947f543e4048a6bef17edf921261', '90604268843681d95b313b38b8e2ecbd13f3a7af', 500000000000000000, '746af0f5edcce85d704e5358b44f01db6184b272db3a6590bf3183bd1048be7d', 'ETH', '2019-02-22 12:52:26', '2019-02-22 12:52:26'),
(22, 17, '90604268843681d95b313b38b8e2ecbd13f3a7af', '65b615ff7b02947f543e4048a6bef17edf921261', 50000000000000000, '2939e43c65fb5f7a196558398c280a0e7393f7d90f444b5fb6353a10e1d45e55', 'ETH', '2019-02-22 13:23:03', '2019-02-22 13:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_public` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eth_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_private_key` text COLLATE utf8mb4_unicode_ci,
  `eth_private_key` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `api_token`, `mobile_number`, `btc_address`, `btc_public`, `eth_address`, `btc_private_key`, `eth_private_key`, `created_at`, `updated_at`) VALUES
(1, 'radicalhash', 'info@radicalhash.com', NULL, '$2y$10$VnzpfsOro9NtDhRAm4YABOWiYiPJlU.hI6kSeJKAH0Trsj91MxWbe', 'sihNDyuBWLMM3VbHsUlpcPHYij2v0lQ80wtdsPIc55HX5Sx1HY5hrVphl7g5', 1, NULL, NULL, '', '', '', NULL, NULL, '2019-02-06 05:30:01', '2019-02-06 05:30:01'),
(10, 'Alex Vaitkus', 'jupiter.kgh720@gmail.com', NULL, '$2y$10$S4QQUG5TNoQCuU/Zrip2TuCDpO8/5gveQC9H0ubDWl7.8E5EhY7YG', 'qHED1WCPis8LZdOvyBgnKk7RnXBrRNmTfG3YgyDSFY7R2Ygyc7KDMGCa5rJu', 1, '6RTgtmWAWnbgaU0VQyRNTbDoUxqLCP69dHqSMDsEt6ZtVkzeXM6ZZ9lq4Um9NPgUo', NULL, 'n4nSaZ84DbjEp5BpW19ABmXMqH7j4ito3n', '02c37b0ec5eec21f0cd2d2f94f9a988c1f13cc0a1529460c3dec0cff8f3c280b2c', '842eca8342be0e3e3a4c663f6481752c5ead175c', 'eyJpdiI6Inh1bHlyVlVcL1VvVmZGajBicGdBZCt3PT0iLCJ2YWx1ZSI6Im1GREFHM1dwOFJURENiSW9ROUMxKzc5ak5IMkpJVlJKS2lCRWdwNjBBYkFyaktOTnM5eE9mSmJ4cnVTVFVWUzFTYXlkUnVlK1NQSHNpNWhDTDF1UVpDWGxiaVpDaEQwTWhlck14elc2SVJRPSIsIm1hYyI6Ijg5YTg0MTlkNGExYTNmYjMwMWVmOTQ2MzRhYWUzYTBjNGQ2OGUxYWVjMTg3YjRlODI0YmQ1NTRhNTI3YWMzMjYifQ==', 'eyJpdiI6IkxJOUhwRk85VEUwclwvczRuNDl1a1BRPT0iLCJ2YWx1ZSI6IkxJNTNzT21RSDViS0J1RUJ1N05KY25PWDQ0dFNYVElxeTdVNWxEXC90SUs3Und0NXBNczlGc1BVMVA5VXVIYTZURWNjc3dPeVg0c1FhVmVGUXlIaG45YzJTaERHV2RvVHd1QkZJMXVGNE02RT0iLCJtYWMiOiJiMGM5NzMwYmI5ZTFiNGRlOTllYzkyNWZkZWY0NmRhNjk0Yjk3ZmEyOTU2MzUxNzM4ZTBlYmMyMmMxMGQwNDAxIn0=', '2019-02-12 16:55:17', '2019-02-22 14:00:00'),
(12, 'hello', 'hello@sohanyadav.com', NULL, '$2y$10$vuST650Tt.8EE5aVvoAHReOVsOYVUO4EjkshsFHABLH5IyzQuiEMG', NULL, 1, 'jpDKLxOWgV2rB9Bqu4ManVMNlAXOwDGXaYeoUtMVQSkRVchVWAb2Dhdm58jqLfAtc', NULL, '', '', '', NULL, NULL, '2019-02-13 05:14:49', '2019-02-15 13:40:22'),
(15, 'Sohan Yadav', 'Sonu5650@gmail.com', NULL, '$2y$10$sGoWMbnEVIWfCtktGj/txuX/BY8kxi330nTm.C3GsUmM55kUIsJAa', NULL, 1, 'XPHNZuR9ZY9PBFSnppA0tFJ2gRq91texPVS0tw6JJvHLLDVmgrhfqdo3uN8bZtmuo', NULL, 'mtxPSCyrvBpsgAgD6Pztrr5eFyGk4axGEj', '02498d758ba9d583e6e401f4b3ba204520125b8c04348dd482d64aca88fec39bed', '90604268843681d95b313b38b8e2ecbd13f3a7af', 'eyJpdiI6ImdKT2FBdHRZNmFveHNNMnhmVXpNeUE9PSIsInZhbHVlIjoiRmpRQm5hVm9SMWZtYVRKUXpXeVgrYW5TTEQyTEJLc0FmSktaSXd2c3NiT0FXRFFyb3pJXC85TWJcL2NLeGl3UEFRMDhsRThFSkNsYjBVVmZkNHBzUEcyZWtaMHBkYW42UnJ2NGtrSWRwbXEwbz0iLCJtYWMiOiI0MDY5YTExZmZjYTc2NzgxYzY4NjI0ODJiZWRhMWU5ZTY3OWNmMzVkZTQxNTllNGUyYTI3MDc1MGRiNjVkMWE3In0=', 'eyJpdiI6ImpheE1xd2g3MEVMUlRsQVlpalArc1E9PSIsInZhbHVlIjoiQU93dW5cLzV6UFcwMit4ZFwvMGxoa1FHWGlQSE93ZkhrZU16VFlOSDNmd2VFemQ3ZDJZZENTMWZoVHFvT1VjRG9yNGg3N3VcL2lPWnJUZTg3R2NrZ2JzUk1FK0JPSXY4NTVFR3plNjFqbGJVOVE9IiwibWFjIjoiMTQwM2E4YjIwYmZmZjEyZWEyNDE1ZTI5NzQ3N2Y2NDBkN2I4NzhlMWFkZWY5YTMyODcwNDEyZDI1ZGE1ZmJkMiJ9', '2019-02-13 05:59:30', '2019-02-23 12:50:36'),
(16, 'Kaluram', 'k.rsaini20@gmail.co', NULL, '$2y$10$MGWxPvpxAt.p30s/mIcEFO8W2daM/TZD6S/SlXf4Jm4mOjL1b/4RW', NULL, 1, 'i81IYgtlolqCm97NX8zzae0WjpLMp42z6iqWwWeYXvBasy23pAyrumGA4o1LdXVqs', NULL, '', '', '', NULL, NULL, '2019-02-13 06:02:22', '2019-02-23 12:52:07'),
(17, 'kaluramsaini', 'k.rsaini20@gmail.com', NULL, '$2y$10$XAu5d3edYPmDg6hxm91gJuDUZZM6N9XI8EQdh3gTq6dN28F31Bh0a', 's9FRvejAgMKBXg3eRpe41KbwOo9ZD26hlGMKaIvlzMSUOR8Gwgf8A1j3Bwp0', 1, 'zJvzYLiF5PDvDYaDJHlCTYzcCzdM5JZA7yuakyPmJkbuvZer0sA1iL3CKh8fspfkV', NULL, 'mr7oWbnzPXKZqWsj9cLTQsBo6sQHHT5Pgf', '02537ed9d9b6ea51cf5a6bb89c52c0e300ae67ce9014539a8227ba1e2817982c0e', '65b615ff7b02947f543e4048a6bef17edf921261', 'eyJpdiI6IldlVXh1SnpYVHdsY2Z3alwvcmtESUJRPT0iLCJ2YWx1ZSI6IktPTDVyWHVCZnY1enpcL3MyaEQ2TitOblE0N3NoRWlyZFhxclwvT1Foa01tSEdqdUNBeVFVcm9uZ0dUV1dXVDNhK2c5dEJtc0l2WkxrbGhKVXliOHdYd2EwdDdXb2JRQ0Vxdkg0MlUyd0dzc0E9IiwibWFjIjoiODRiYWVhMjM3OGJkYWFmMzdlZjFlNjI4N2MzMTZlNWM4NzcxYjFiZDYwMWNhOTMyZWRhYmMyZGI0ZmIwNWU3YSJ9', 'eyJpdiI6IlBhSjNXS2xwYWJtRGp5YURFN3FBUXc9PSIsInZhbHVlIjoiUTlxQzF0c2tkU2o0ZWtFQ3o1KzlBMDBMcVhmc0dRUGI2WnlzZUJwQzgxZ21sc2pTSVpYa1ZHa3NDQlNUa1dBQlBPR1NlOEdnZ3k5TlMrRVh5eThcL1hiTFBqNE5Yc2VSa1UrOTEyWkJmdHJRPSIsIm1hYyI6IjdhYmZlYzQ2ZTUwOTE4Y2QyNmYyYTE5MjM3Mjk0MmQyMzA3Mzk1ZDk5MDgzMmJiMzE3NmZlZDE2OTJhNGVjYzAifQ==', '2019-02-15 08:05:03', '2019-02-23 10:08:06');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
