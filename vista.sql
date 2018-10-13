-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2018 at 03:03 AM
-- Server version: 8.0.12
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vista`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_model`
--

CREATE TABLE `business_model` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `timer_mins` int(11) DEFAULT NULL,
  `timer_hours` int(11) DEFAULT NULL,
  `timer_days` int(11) DEFAULT NULL,
  `cost` decimal(7,2) NOT NULL DEFAULT '0.00',
  `cost_visit` decimal(7,2) NOT NULL DEFAULT '0.00',
  `profit` decimal(7,2) NOT NULL DEFAULT '0.00',
  `money_still` decimal(7,2) NOT NULL DEFAULT '0.00',
  `vista_wateing` int(11) NOT NULL,
  `vista_running` int(11) NOT NULL DEFAULT '0',
  `vista_fails` int(11) NOT NULL DEFAULT '0',
  `vista_done` int(11) NOT NULL DEFAULT '0',
  `degree` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 close 1 open',
  `lat` double NOT NULL DEFAULT '0',
  `long` double NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_model`
--

INSERT INTO `business_model` (`id`, `user_id`, `bio`, `timer_mins`, `timer_hours`, `timer_days`, `cost`, `cost_visit`, `profit`, `money_still`, `vista_wateing`, `vista_running`, `vista_fails`, `vista_done`, `degree`, `status`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdfsdfsdf', 0, 3, 0, '12.00', '100.00', '0.00', '0.00', 0, 1, 0, 0, 'execelent', 1, 0, 0, '2018-10-10', '2018-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `chronic_diseases`
--

CREATE TABLE `chronic_diseases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cd_id` int(10) UNSIGNED NOT NULL,
  `cd_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `chronic_disease_categories`
--

CREATE TABLE `chronic_disease_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cd_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chronic_disease_categories`
--

INSERT INTO `chronic_disease_categories` (`id`, `cd_title`, `parent_id`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'category 1', 0, 1, 2, '2018-10-06 23:21:13', '2018-10-07 03:39:36'),
(3, 'sub category 1', 1, 1, 0, '2018-10-06 23:27:19', '2018-10-07 00:21:22'),
(4, 'category 2', 0, 1, 1, '2018-10-07 00:21:01', '2018-10-07 03:39:36'),
(6, 'sub category 2', 4, 1, 0, '2018-10-07 00:23:09', '2018-10-07 00:23:09'),
(7, 'sub category 2', 4, 1, 0, '2018-10-07 00:24:26', '2018-10-07 00:24:26'),
(8, 'new cronic disease', 1, 0, 0, '2018-10-07 01:44:10', '2018-10-07 01:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `chronic_drugs`
--

CREATE TABLE `chronic_drugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `drug_id` int(10) UNSIGNED NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `till_now` tinyint(1) NOT NULL,
  `will_stop` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chronic_drugs`
--

INSERT INTO `chronic_drugs` (`id`, `drug_id`, `dose`, `till_now`, `will_stop`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2  in day', 1, 0, 1, '2018-10-07 08:30:04', '2018-10-07 08:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `chronic_drug_lists`
--

CREATE TABLE `chronic_drug_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chronic_drug_lists`
--

INSERT INTO `chronic_drug_lists` (`id`, `title`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'drug 1', 1, 2, '2018-10-07 08:15:24', '2018-10-07 08:33:47'),
(2, 'drug 2', 1, 3, '2018-10-07 08:15:32', '2018-10-07 08:33:47'),
(4, 'new drug 2', 1, 1, '2018-10-07 08:28:09', '2018-10-07 08:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_forms`
--

CREATE TABLE `compliant_forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `compliant_title_id` int(10) UNSIGNED NOT NULL,
  `started_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `compliant_forms`
--

INSERT INTO `compliant_forms` (`id`, `user_id`, `compliant_title_id`, `started_at`, `created_at`, `updated_at`) VALUES
(15, 1, 1, '2018-10-09', '2018-10-11 00:59:49', '2018-10-11 00:59:49'),
(16, 1, 1, '2018-10-09', '2018-10-11 01:07:08', '2018-10-11 01:07:08'),
(17, 1, 1, '2018-10-09', '2018-10-11 01:08:27', '2018-10-11 01:08:27'),
(18, 1, 1, '2018-10-09', '2018-10-11 01:08:38', '2018-10-11 01:08:38'),
(19, 1, 1, '2018-10-09', '2018-10-11 01:09:42', '2018-10-11 01:09:42'),
(20, 1, 1, '2018-10-09', '2018-10-11 01:10:12', '2018-10-11 01:10:12'),
(21, 1, 1, '2018-10-09', '2018-10-11 01:10:22', '2018-10-11 01:10:22'),
(22, 1, 1, '2018-10-09', '2018-10-11 01:11:10', '2018-10-11 01:11:10'),
(23, 1, 1, '2018-10-09', '2018-10-11 01:11:28', '2018-10-11 01:11:28'),
(24, 1, 1, '2018-10-09', '2018-10-11 01:11:50', '2018-10-11 01:11:50'),
(25, 1, 1, '2018-10-09', '2018-10-11 01:11:58', '2018-10-11 01:11:58'),
(26, 1, 1, '2018-10-09', '2018-10-11 01:12:23', '2018-10-11 01:12:23'),
(27, 1, 1, '2018-10-09', '2018-10-11 01:12:57', '2018-10-11 01:12:57'),
(28, 1, 1, '2018-10-09', '2018-10-11 01:31:12', '2018-10-11 01:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `compliant_labs`
--

CREATE TABLE `compliant_labs` (
  `id` int(10) UNSIGNED NOT NULL,
  `lab_id` int(10) UNSIGNED NOT NULL,
  `lab_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mode_lab` date NOT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_medical_report`
--

CREATE TABLE `compliant_medical_report` (
  `id` int(10) UNSIGNED NOT NULL,
  `medical_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliant_medical_report`
--

INSERT INTO `compliant_medical_report` (`id`, `medical_picture`, `compliant_id`, `created_at`, `updated_at`) VALUES
(8, '1539226790-Y8WGnv.jpg', 15, '2018-10-11 02:59:50', '2018-10-11 02:59:50'),
(9, '1539227228-uqwRdV.jpg', 16, '2018-10-11 03:07:08', '2018-10-11 03:07:08'),
(10, '1539227308-IcPgqS.jpg', 17, '2018-10-11 03:08:28', '2018-10-11 03:08:28'),
(11, '1539227319-wIdaeT.jpg', 18, '2018-10-11 03:08:39', '2018-10-11 03:08:39'),
(12, '1539227383-SXSeQN.jpg', 19, '2018-10-11 03:09:43', '2018-10-11 03:09:43'),
(13, '1539227413-BZvNsm.jpg', 20, '2018-10-11 03:10:13', '2018-10-11 03:10:13'),
(14, '1539227422-2a2XPd.jpg', 21, '2018-10-11 03:10:22', '2018-10-11 03:10:22'),
(15, '1539227471-TtNIbi.jpg', 22, '2018-10-11 03:11:11', '2018-10-11 03:11:11'),
(16, '1539227488-2OL6jy.jpg', 23, '2018-10-11 03:11:28', '2018-10-11 03:11:28'),
(17, '1539227510-1gOLwH.jpg', 24, '2018-10-11 03:11:50', '2018-10-11 03:11:50'),
(18, '1539227519-TCdHIE.jpg', 25, '2018-10-11 03:11:59', '2018-10-11 03:11:59'),
(19, '1539227544-Q8o0PW.jpg', 26, '2018-10-11 03:12:24', '2018-10-11 03:12:24'),
(20, '1539227577-waKVPy.jpg', 27, '2018-10-11 03:12:57', '2018-10-11 03:12:57'),
(21, '1539228673-AdWAoF.jpg', 28, '2018-10-11 03:31:13', '2018-10-11 03:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `compliant_others`
--

CREATE TABLE `compliant_others` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliant_others`
--

INSERT INTO `compliant_others` (`id`, `content`, `other_picture`, `compliant_id`, `created_at`, `updated_at`) VALUES
(8, 'sdfsdfsfdsdfsdsdfsdf', '1539226790-DpL15I.jpg', 15, '2018-10-11 02:59:50', '2018-10-11 02:59:50'),
(9, 'sdfsdfsfdsdfsdsdfsdf', '1539227228-tiVRKk.jpg', 16, '2018-10-11 03:07:08', '2018-10-11 03:07:08'),
(10, 'sdfsdfsfdsdfsdsdfsdf', '1539227308-xItAn3.jpg', 17, '2018-10-11 03:08:28', '2018-10-11 03:08:28'),
(11, 'sdfsdfsfdsdfsdsdfsdf', '1539227319-CqyNbH.jpg', 18, '2018-10-11 03:08:39', '2018-10-11 03:08:39'),
(12, 'sdfsdfsfdsdfsdsdfsdf', '1539227383-Ryw5rI.jpg', 19, '2018-10-11 03:09:43', '2018-10-11 03:09:43'),
(13, 'sdfsdfsfdsdfsdsdfsdf', '1539227413-8mEKkP.jpg', 20, '2018-10-11 03:10:12', '2018-10-11 03:10:12'),
(14, 'sdfsdfsfdsdfsdsdfsdf', '1539227422-YaMFz1.jpg', 21, '2018-10-11 03:10:22', '2018-10-11 03:10:22'),
(15, 'sdfsdfsfdsdfsdsdfsdf', '1539227471-W05xde.jpg', 22, '2018-10-11 03:11:11', '2018-10-11 03:11:11'),
(16, 'sdfsdfsfdsdfsdsdfsdf', '1539227488-3NquBb.jpg', 23, '2018-10-11 03:11:28', '2018-10-11 03:11:28'),
(17, 'sdfsdfsfdsdfsdsdfsdf', '1539227510-cmmapq.jpg', 24, '2018-10-11 03:11:50', '2018-10-11 03:11:50'),
(18, 'sdfsdfsfdsdfsdsdfsdf', '1539227519-KdLNWe.jpg', 25, '2018-10-11 03:11:59', '2018-10-11 03:11:59'),
(19, 'sdfsdfsfdsdfsdsdfsdf', '1539227544-4y2zCf.jpg', 26, '2018-10-11 03:12:24', '2018-10-11 03:12:24'),
(20, 'sdfsdfsfdsdfsdsdfsdf', '1539227577-HxfNKo.jpg', 27, '2018-10-11 03:12:57', '2018-10-11 03:12:57'),
(21, 'sdfsdfsfdsdfsdsdfsdf', '1539228673-sIqfiD.jpg', 28, '2018-10-11 03:31:12', '2018-10-11 03:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `compliant_recent_drugs`
--

CREATE TABLE `compliant_recent_drugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `drug_id` int(10) UNSIGNED NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliant_recent_drugs`
--

INSERT INTO `compliant_recent_drugs` (`id`, `drug_id`, `dose`, `compliant_id`, `created_at`, `updated_at`) VALUES
(8, 1, '2 in day', 15, '2018-10-11 02:59:50', '2018-10-11 02:59:50'),
(9, 1, '2 in day', 16, '2018-10-11 03:07:08', '2018-10-11 03:07:08'),
(10, 1, '2 in day', 17, '2018-10-11 03:08:28', '2018-10-11 03:08:28'),
(11, 1, '2 in day', 18, '2018-10-11 03:08:38', '2018-10-11 03:08:38'),
(12, 1, '2 in day', 19, '2018-10-11 03:09:43', '2018-10-11 03:09:43'),
(13, 1, '2 in day', 20, '2018-10-11 03:10:12', '2018-10-11 03:10:12'),
(14, 1, '2 in day', 21, '2018-10-11 03:10:22', '2018-10-11 03:10:22'),
(15, 1, '2 in day', 22, '2018-10-11 03:11:11', '2018-10-11 03:11:11'),
(16, 1, '2 in day', 23, '2018-10-11 03:11:28', '2018-10-11 03:11:28'),
(17, 1, '2 in day', 24, '2018-10-11 03:11:50', '2018-10-11 03:11:50'),
(18, 1, '2 in day', 25, '2018-10-11 03:11:59', '2018-10-11 03:11:59'),
(19, 1, '2 in day', 26, '2018-10-11 03:12:24', '2018-10-11 03:12:24'),
(20, 1, '2 in day', 27, '2018-10-11 03:12:57', '2018-10-11 03:12:57'),
(21, 1, '2 in day', 28, '2018-10-11 03:31:12', '2018-10-11 03:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `compliant_titles`
--

CREATE TABLE `compliant_titles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliant_titles`
--

INSERT INTO `compliant_titles` (`id`, `title`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'title 1', 0, 1, '2018-10-10 12:03:52', '2018-10-10 12:03:52'),
(2, 'title 2', 0, 1, '2018-10-10 12:04:02', '2018-10-10 12:04:02'),
(4, 'new title', 0, 0, '2018-10-10 12:07:51', '2018-10-10 12:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `compliant_xray`
--

CREATE TABLE `compliant_xray` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `xray_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mode_xray` date NOT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compliant_xray`
--

INSERT INTO `compliant_xray` (`id`, `report`, `xray_picture`, `date_mode_xray`, `compliant_id`, `created_at`, `updated_at`) VALUES
(13, 'sdfsdfsdfsdf', '1539226790-yFWEvs.jpg', '2018-10-09', 15, NULL, NULL),
(14, 'sdfsdfsdfsdf', '1539227228-BTaXSe.jpg', '2018-10-09', 16, NULL, NULL),
(15, 'sdfsdfsdfsdf', '1539227308-LeK5Ik.jpg', '2018-10-09', 17, NULL, NULL),
(16, 'sdfsdfsdfsdf', '1539227318-mY85KL.jpg', '2018-10-09', 18, NULL, NULL),
(17, 'sdfsdfsdfsdf', '1539227383-hTf85R.jpg', '2018-10-09', 19, NULL, NULL),
(18, 'sdfsdfsdfsdf', '1539227412-1vtPAG.jpg', '2018-10-09', 20, NULL, NULL),
(19, 'sdfsdfsdfsdf', '1539227422-wEZwGQ.jpg', '2018-10-09', 21, NULL, NULL),
(20, 'sdfsdfsdfsdf', '1539227471-OpivIP.jpg', '2018-10-09', 22, NULL, NULL),
(21, 'sdfsdfsdfsdf', '1539227488-n95emk.jpg', '2018-10-09', 23, NULL, NULL),
(22, 'sdfsdfsdfsdf', '1539227510-pIHRsP.jpg', '2018-10-09', 24, NULL, NULL),
(23, 'sdfsdfsdfsdf', '1539227519-44bVzH.jpg', '2018-10-09', 25, NULL, NULL),
(24, 'sdfsdfsdfsdf', '1539227544-m08k11.jpg', '2018-10-09', 26, NULL, NULL),
(25, 'sdfsdfsdfsdf', '1539227577-k8dCSq.jpg', '2018-10-09', 27, NULL, NULL),
(26, 'sdfsdfsdfsdf', '1539228672-cuz7yw.jpg', '2018-10-09', 28, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drug_allergies`
--

CREATE TABLE `drug_allergies` (
  `id` int(10) UNSIGNED NOT NULL,
  `drug_id` int(10) UNSIGNED NOT NULL,
  `food_allergies` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drug_allergy_lists`
--

CREATE TABLE `drug_allergy_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drug_allergy_lists`
--

INSERT INTO `drug_allergy_lists` (`id`, `title`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'drug 1', 1, 2, '2018-10-07 06:56:07', '2018-10-07 06:56:18'),
(2, 'drug 2', 1, 1, '2018-10-07 06:56:15', '2018-10-07 06:56:18'),
(4, 'new drug', 0, 0, '2018-10-07 07:31:10', '2018-10-07 07:31:10'),
(5, 'new drug 2', 0, 0, '2018-10-07 07:31:48', '2018-10-07 07:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `title`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(2, 'job title', 1, 3, '2018-10-07 03:36:21', '2018-10-10 06:46:52'),
(3, 'job title 2', 1, 2, '2018-10-07 03:36:28', '2018-10-10 06:46:52'),
(5, 'new job title 2', 1, 1, '2018-10-07 03:46:32', '2018-10-10 06:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `title`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'lab title', 1, 1, '2018-10-07 05:41:35', '2018-10-07 05:41:49'),
(2, 'lab title 2', 1, 2, '2018-10-07 05:41:44', '2018-10-07 05:41:49'),
(4, 'new lab title', 1, 0, '2018-10-07 05:46:24', '2018-10-07 05:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_06_021300_laratrust_setup_tables', 1),
(4, '2018_10_06_104506_create_public_users_table', 1),
(5, '2018_10_06_105713_create_user_verification_table', 1),
(6, '2018_10_06_121349_create_chronic_disease_categories_table', 1),
(7, '2018_10_06_131730_create_chronic_diseases_table', 1),
(8, '2018_10_07_035510_create_user_summaries_table', 2),
(9, '2018_10_07_051108_create_job_titles_table', 3),
(10, '2018_10_07_064207_create_xray_reports_table', 4),
(11, '2018_10_07_073115_create_labs_table', 5),
(12, '2018_10_07_075037_create_store_labs_table', 6),
(13, '2018_10_07_083948_create_drug_allergy_lists_table', 7),
(14, '2018_10_07_092120_create_drug_allergies_table', 8),
(15, '2018_10_07_100618_create_chronic_drug_lists_table', 9),
(16, '2018_10_07_101723_create_chronic_drugs_table', 10),
(17, '2018_10_07_105323_create_recent_drugs_table', 11),
(18, '2018_10_07_110936_create_old_reports_table', 12),
(19, '2018_10_09_112916_create_comments_table', 13),
(20, '2018_10_09_113204_create_request_options_table', 13),
(21, '2018_10_09_113309_create_user_jobs_table', 13),
(22, '2018_10_09_113702_create_job_idenitities_table', 13),
(23, '2018_10_09_113903_create_notify_admin_table', 13),
(24, '2018_10_10_135208_create_compliant_titles_table', 14),
(25, '2018_10_10_140835_create_compliant_forms_table', 15),
(26, '2018_10_10_141141_create_compliant_recent_drugs_table', 15),
(27, '2018_10_10_141450_create_compliant_xray_table', 15),
(28, '2018_10_10_141757_create_compliant_labs_table', 15),
(29, '2018_10_10_141908_create_compliant_medical_report_table', 15),
(30, '2018_10_10_142054_create_compliant_others_table', 15),
(31, '2018_10_11_021006_create_request_chats_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notify_admin`
--

CREATE TABLE `notify_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `count_files` int(11) NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_admin`
--

INSERT INTO `notify_admin` (`id`, `count_files`, `job_id`, `user_id`, `opened`, `created_at`, `updated_at`) VALUES
(7, 3, 2, 1, 0, '2018-10-10 00:01:21', '2018-10-10 00:01:21'),
(8, 3, 2, 1, 0, '2018-10-10 08:15:39', '2018-10-10 08:15:39'),
(9, 3, 3, 1, 0, '2018-10-10 08:17:32', '2018-10-10 08:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `old_reports`
--

CREATE TABLE `old_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `posted_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-users', 'Create Users', 'Create Users', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(2, 'read-users', 'Read Users', 'Read Users', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(3, 'update-users', 'Update Users', 'Update Users', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(4, 'delete-users', 'Delete Users', 'Delete Users', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(5, 'create-acl', 'Create Acl', 'Create Acl', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(6, 'read-acl', 'Read Acl', 'Read Acl', '2018-10-06 12:24:03', '2018-10-06 12:24:03'),
(7, 'update-acl', 'Update Acl', 'Update Acl', '2018-10-06 12:24:03', '2018-10-06 12:24:03'),
(8, 'delete-acl', 'Delete Acl', 'Delete Acl', '2018-10-06 12:24:03', '2018-10-06 12:24:03'),
(9, 'read-profile', 'Read Profile', 'Read Profile', '2018-10-06 12:24:03', '2018-10-06 12:24:03'),
(10, 'update-profile', 'Update Profile', 'Update Profile', '2018-10-06 12:24:03', '2018-10-06 12:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(9, 2),
(10, 2),
(9, 3),
(10, 3),
(9, 4),
(10, 4),
(9, 5),
(10, 5),
(9, 6),
(10, 6),
(9, 7),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_users`
--

CREATE TABLE `public_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_social` tinyint(1) NOT NULL,
  `sex` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(10) UNSIGNED DEFAULT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telnum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_account_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `public_users`
--

INSERT INTO `public_users` (`id`, `name`, `email`, `password`, `login_social`, `sex`, `age`, `country`, `state`, `address1`, `address2`, `telnum`, `picture`, `social_account_title`, `created_at`, `updated_at`, `is_verified`) VALUES
(1, 'eslam', 'eslam@123.com', '$2y$10$hSWnMOT6HRq0wiT4LskmK.YH0EP0u9iorjgRV.FaTGYvOCLSYAyya', 0, 'male', NULL, NULL, NULL, NULL, NULL, '01152945713', '1538894381.jpg', NULL, '2018-10-07 00:30:51', '2018-10-10 09:34:10', 1),
(2, 'ahmed', 'ahmed205@gmail.com', '$2y$10$Y1nuUFVijZYMHIFFUCkiy.ZwfQcFmISheJdKDGoQ/m2XZKUEbis3e', 0, 'male', NULL, NULL, NULL, NULL, NULL, '01152945713`', NULL, NULL, '2018-10-09 09:15:31', '2018-10-09 09:16:29', 1),
(3, 'ahmed3', 'ahmed2054@gmail.com', '$2y$10$ODMhc8VecXWmXTzYjo3yNe3Puvk9t2t7ez9AimBzRx3Qq1k1N407C', 0, 'male', NULL, NULL, NULL, NULL, NULL, '0115294571', NULL, NULL, '2018-10-09 09:18:07', '2018-10-09 09:18:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `recent_drugs`
--

CREATE TABLE `recent_drugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `drug_id` int(10) UNSIGNED NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `till_now` tinyint(1) NOT NULL,
  `will_stop` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_chats`
--

CREATE TABLE `request_chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `bm_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bm_id` int(10) UNSIGNED NOT NULL,
  `compliant_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(8,2) UNSIGNED NOT NULL,
  `ref_num` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr_approve` tinyint(1) NOT NULL DEFAULT '0',
  `pt_closed` tinyint(1) NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `cost_pay` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_chats`
--

INSERT INTO `request_chats` (`id`, `bm_name`, `user_name`, `bm_id`, `compliant_id`, `user_id`, `cost`, `ref_num`, `dr_approve`, `pt_closed`, `closed`, `cost_pay`, `created_at`, `updated_at`) VALUES
(17, 'eslam', 'eslam', 1, 28, 1, '100.00', 'k48tko', 1, 0, 0, 0, '2018-10-11 01:31:13', '2018-10-11 01:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `request_options`
--

CREATE TABLE `request_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_options`
--

INSERT INTO `request_options` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'title 1', '2018-10-09 11:46:15', '2018-10-09 11:48:19'),
(2, 'title 2', '2018-10-09 11:48:29', '2018-10-09 11:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadministrator', 'Superadministrator', 'Superadministrator', '2018-10-06 12:24:02', '2018-10-06 12:24:02'),
(2, 'administrator', 'Administrator', 'Administrator', '2018-10-06 12:24:04', '2018-10-06 12:24:04'),
(3, 'editor', 'Editor', 'Editor', '2018-10-06 12:24:05', '2018-10-06 12:24:05'),
(4, 'author', 'Author', 'Author', '2018-10-06 12:24:05', '2018-10-06 12:24:05'),
(5, 'contributor', 'Contributor', 'Contributor', '2018-10-06 12:24:06', '2018-10-06 12:24:06'),
(6, 'supporter', 'Supporter', 'Supporter', '2018-10-06 12:24:06', '2018-10-06 12:24:06'),
(7, 'subscriber', 'Subscriber', 'Subscriber', '2018-10-06 12:24:07', '2018-10-06 12:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 3, 'App\\User'),
(4, 4, 'App\\User'),
(5, 5, 'App\\User'),
(6, 6, 'App\\User'),
(7, 7, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `store_labs`
--

CREATE TABLE `store_labs` (
  `id` int(10) UNSIGNED NOT NULL,
  `lab_id` int(10) UNSIGNED NOT NULL,
  `value` decimal(7,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mode` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadministrator', 'superadministrator@app.com', NULL, '$2y$10$0s4ys4WbtpLHzYmSRuFC6u9ljeZB8rNSki3YQ.0x2YMhhKcoSmxqe', NULL, '2018-10-06 12:24:04', '2018-10-06 12:24:04'),
(2, 'Administrator', 'administrator@app.com', NULL, '$2y$10$33nwQmX2aC3GUco394tjpeJHDPnqj76Lqazrt94gtMQDJp2ZUSaP6', NULL, '2018-10-06 12:24:05', '2018-10-06 12:24:05'),
(3, 'Editor', 'editor@app.com', NULL, '$2y$10$8XGAs9r2aJ0vMKxAHYGxyeAXf.FxGsTl0Tz5dh12dy2wED5XFN00y', NULL, '2018-10-06 12:24:05', '2018-10-06 12:24:05'),
(4, 'Author', 'author@app.com', NULL, '$2y$10$2sa2w/3PYGxqpAt2m/DLku6dofdesQOu0KHoIcIn6mEBkOsYqKOsm', NULL, '2018-10-06 12:24:06', '2018-10-06 12:24:06'),
(5, 'Contributor', 'contributor@app.com', NULL, '$2y$10$JF.MmHq0FZK1yNbC/fviP.bjgNg.1Y.2kjWUN6gDI4hkV0BUH6mxS', NULL, '2018-10-06 12:24:06', '2018-10-06 12:24:06'),
(6, 'Supporter', 'supporter@app.com', NULL, '$2y$10$Kcw3yJRPomI/O2tojFJkpOV/7sVXoetQSdrCrtA1H3Oo.2tISZN1.', NULL, '2018-10-06 12:24:07', '2018-10-06 12:24:07'),
(7, 'Subscriber', 'subscriber@app.com', NULL, '$2y$10$9xV84EySZDi9QyLqBCuvkO5yM1rpkAAvqpi.WlKR7Sbq132t69Ty6', NULL, '2018-10-06 12:24:07', '2018-10-06 12:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_jobs`
--

CREATE TABLE `user_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `files` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `option_id` int(10) NOT NULL DEFAULT '0',
  `confirm` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 is no action 1 is approve 2 is refused',
  `opened` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_jobs`
--

INSERT INTO `user_jobs` (`id`, `user_id`, `job_id`, `files`, `option_id`, `confirm`, `opened`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '1539159452-MKUFpY.jpg,1539159452-8OjZ47.jpg,1539159452-Al385H.jpg', 0, 0, 1, NULL, '2018-10-10 09:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_summaries`
--

CREATE TABLE `user_summaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `chronic_diseases_approve` tinyint(1) NOT NULL DEFAULT '0',
  `xray_approve` tinyint(1) NOT NULL DEFAULT '0',
  `lab_invent_approve` tinyint(1) NOT NULL DEFAULT '0',
  `allergies_approve` tinyint(1) NOT NULL DEFAULT '0',
  `chronic_drugs_approve` tinyint(1) NOT NULL DEFAULT '0',
  `recent_drugs_approve` tinyint(1) NOT NULL DEFAULT '0',
  `old_reports_approve` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_summaries`
--

INSERT INTO `user_summaries` (`id`, `chronic_diseases_approve`, `xray_approve`, `lab_invent_approve`, `allergies_approve`, `chronic_drugs_approve`, `recent_drugs_approve`, `old_reports_approve`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 1, 0, 0, 1, NULL, '2018-10-07 09:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_verification`
--

CREATE TABLE `user_verification` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `verification_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verification`
--

INSERT INTO `user_verification` (`id`, `user_id`, `verification_code`, `created_at`, `updated_at`) VALUES
(3, 3, 'ddotmn', NULL, NULL),
(4, 4, '4pjvtz', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `xray_reports`
--

CREATE TABLE `xray_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mode` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xray_reports`
--

INSERT INTO `xray_reports` (`id`, `report`, `picture`, `date_mode`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdfsdfsdfsdfdfssdfsdfsdfsdfsdf', '1538896298.jpg', '2018-10-03', 1, '2018-10-07 05:10:08', '2018-10-07 05:11:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_model`
--
ALTER TABLE `business_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chronic_diseases_cd_id_foreign` (`cd_id`);

--
-- Indexes for table `chronic_disease_categories`
--
ALTER TABLE `chronic_disease_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chronic_drugs`
--
ALTER TABLE `chronic_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chronic_drugs_user_id_foreign` (`user_id`),
  ADD KEY `chronic_drugs_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `chronic_drug_lists`
--
ALTER TABLE `chronic_drug_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_forms`
--
ALTER TABLE `compliant_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_forms_user_id_foreign` (`user_id`),
  ADD KEY `compliant_forms_compliant_title_id_foreign` (`compliant_title_id`);

--
-- Indexes for table `compliant_labs`
--
ALTER TABLE `compliant_labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_labs_compliant_id_foreign` (`compliant_id`);

--
-- Indexes for table `compliant_medical_report`
--
ALTER TABLE `compliant_medical_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_medical_report_compliant_id_foreign` (`compliant_id`);

--
-- Indexes for table `compliant_others`
--
ALTER TABLE `compliant_others`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_others_compliant_id_foreign` (`compliant_id`);

--
-- Indexes for table `compliant_recent_drugs`
--
ALTER TABLE `compliant_recent_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_recent_drugs_drug_id_foreign` (`drug_id`),
  ADD KEY `compliant_recent_drugs_compliant_id_foreign` (`compliant_id`);

--
-- Indexes for table `compliant_titles`
--
ALTER TABLE `compliant_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_xray`
--
ALTER TABLE `compliant_xray`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliant_xray_compliant_id_foreign` (`compliant_id`);

--
-- Indexes for table `drug_allergies`
--
ALTER TABLE `drug_allergies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drug_allergies_user_id_foreign` (`user_id`),
  ADD KEY `drug_allergies_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `drug_allergy_lists`
--
ALTER TABLE `drug_allergy_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_admin`
--
ALTER TABLE `notify_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_reports`
--
ALTER TABLE `old_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `old_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `public_users`
--
ALTER TABLE `public_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `public_users_email_unique` (`email`);

--
-- Indexes for table `recent_drugs`
--
ALTER TABLE `recent_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recent_drugs_user_id_foreign` (`user_id`),
  ADD KEY `recent_drugs_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `request_chats`
--
ALTER TABLE `request_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_options`
--
ALTER TABLE `request_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `store_labs`
--
ALTER TABLE `store_labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_labs_user_id_foreign` (`user_id`),
  ADD KEY `store_labs_lab_id_foreign` (`lab_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_jobs`
--
ALTER TABLE `user_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_summaries`
--
ALTER TABLE `user_summaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_summaries_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_verification`
--
ALTER TABLE `user_verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_verification_user_id_foreign` (`user_id`);

--
-- Indexes for table `xray_reports`
--
ALTER TABLE `xray_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `xray_reports_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_model`
--
ALTER TABLE `business_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chronic_disease_categories`
--
ALTER TABLE `chronic_disease_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chronic_drugs`
--
ALTER TABLE `chronic_drugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chronic_drug_lists`
--
ALTER TABLE `chronic_drug_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_forms`
--
ALTER TABLE `compliant_forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `compliant_labs`
--
ALTER TABLE `compliant_labs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `compliant_medical_report`
--
ALTER TABLE `compliant_medical_report`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `compliant_others`
--
ALTER TABLE `compliant_others`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `compliant_recent_drugs`
--
ALTER TABLE `compliant_recent_drugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `compliant_titles`
--
ALTER TABLE `compliant_titles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `compliant_xray`
--
ALTER TABLE `compliant_xray`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `drug_allergies`
--
ALTER TABLE `drug_allergies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drug_allergy_lists`
--
ALTER TABLE `drug_allergy_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notify_admin`
--
ALTER TABLE `notify_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `old_reports`
--
ALTER TABLE `old_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `public_users`
--
ALTER TABLE `public_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recent_drugs`
--
ALTER TABLE `recent_drugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_chats`
--
ALTER TABLE `request_chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `request_options`
--
ALTER TABLE `request_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store_labs`
--
ALTER TABLE `store_labs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_jobs`
--
ALTER TABLE `user_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_summaries`
--
ALTER TABLE `user_summaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_verification`
--
ALTER TABLE `user_verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `xray_reports`
--
ALTER TABLE `xray_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  ADD CONSTRAINT `chronic_diseases_cd_id_foreign` FOREIGN KEY (`cd_id`) REFERENCES `chronic_disease_categories` (`id`);

--
-- Constraints for table `chronic_drugs`
--
ALTER TABLE `chronic_drugs`
  ADD CONSTRAINT `chronic_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `chronic_drug_lists` (`id`),
  ADD CONSTRAINT `chronic_drugs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_forms`
--
ALTER TABLE `compliant_forms`
  ADD CONSTRAINT `compliant_forms_compliant_title_id_foreign` FOREIGN KEY (`compliant_title_id`) REFERENCES `compliant_titles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliant_forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_labs`
--
ALTER TABLE `compliant_labs`
  ADD CONSTRAINT `compliant_labs_compliant_id_foreign` FOREIGN KEY (`compliant_id`) REFERENCES `compliant_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_medical_report`
--
ALTER TABLE `compliant_medical_report`
  ADD CONSTRAINT `compliant_medical_report_compliant_id_foreign` FOREIGN KEY (`compliant_id`) REFERENCES `compliant_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_others`
--
ALTER TABLE `compliant_others`
  ADD CONSTRAINT `compliant_others_compliant_id_foreign` FOREIGN KEY (`compliant_id`) REFERENCES `compliant_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_recent_drugs`
--
ALTER TABLE `compliant_recent_drugs`
  ADD CONSTRAINT `compliant_recent_drugs_compliant_id_foreign` FOREIGN KEY (`compliant_id`) REFERENCES `compliant_forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compliant_recent_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `chronic_drug_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compliant_xray`
--
ALTER TABLE `compliant_xray`
  ADD CONSTRAINT `compliant_xray_compliant_id_foreign` FOREIGN KEY (`compliant_id`) REFERENCES `compliant_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drug_allergies`
--
ALTER TABLE `drug_allergies`
  ADD CONSTRAINT `drug_allergies_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drug_allergy_lists` (`id`),
  ADD CONSTRAINT `drug_allergies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `old_reports`
--
ALTER TABLE `old_reports`
  ADD CONSTRAINT `old_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recent_drugs`
--
ALTER TABLE `recent_drugs`
  ADD CONSTRAINT `recent_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `chronic_drug_lists` (`id`),
  ADD CONSTRAINT `recent_drugs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_labs`
--
ALTER TABLE `store_labs`
  ADD CONSTRAINT `store_labs_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`),
  ADD CONSTRAINT `store_labs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_summaries`
--
ALTER TABLE `user_summaries`
  ADD CONSTRAINT `user_summaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_verification`
--
ALTER TABLE `user_verification`
  ADD CONSTRAINT `user_verification_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `xray_reports`
--
ALTER TABLE `xray_reports`
  ADD CONSTRAINT `xray_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `public_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
