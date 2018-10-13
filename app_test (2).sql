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
-- Database: `app_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `id` int(11) NOT NULL,
  `allergie_title_id` int(11) NOT NULL,
  `food_allergies` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_slides`
--

CREATE TABLE `business_slides` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_links`
--

CREATE TABLE `bussiness_links` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `target_url` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL COMMENT 'if id equal 0 so, is admin',
  `sender_id` int(11) NOT NULL COMMENT 'if id equal 0 so, is admin',
  `message` longtext NOT NULL,
  `request_id` int(11) NOT NULL COMMENT 'chat request',
  `seen` int(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chronic_disease`
--

CREATE TABLE `chronic_disease` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chronic_disease_categories`
--

CREATE TABLE `chronic_disease_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chronic_drugs`
--

CREATE TABLE `chronic_drugs` (
  `id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `still_used` int(1) NOT NULL,
  `will_stop` int(11) NOT NULL COMMENT 'when it will stop (don''t know or date)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` varchar(2) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_form`
--

CREATE TABLE `compliant_form` (
  `id` int(11) NOT NULL,
  `compliant_id` int(11) NOT NULL,
  `started_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_lab`
--

CREATE TABLE `compliant_lab` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `lab_report_picture` varchar(255) NOT NULL,
  `date_mode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_medical_report`
--

CREATE TABLE `compliant_medical_report` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `compliant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_others`
--

CREATE TABLE `compliant_others` (
  `id` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `picture` int(11) NOT NULL,
  `compliant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_recent_drugs`
--

CREATE TABLE `compliant_recent_drugs` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `dose` int(11) NOT NULL,
  `compliant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compliant_xray`
--

CREATE TABLE `compliant_xray` (
  `id` int(11) NOT NULL,
  `xray_picture` varchar(255) NOT NULL,
  `xray_report` text NOT NULL,
  `xray_date` date NOT NULL,
  `compliant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dashboard`
--

CREATE TABLE `doctor_dashboard` (
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
  `vista_running` int(11) NOT NULL DEFAULT '0',
  `vista_fails` int(11) NOT NULL DEFAULT '0',
  `vista_done` int(11) NOT NULL DEFAULT '0',
  `degree` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `lat` double NOT NULL DEFAULT '0',
  `long` double NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dr_rate`
--

CREATE TABLE `dr_rate` (
  `id` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab_investigation`
--

CREATE TABLE `lab_investigation` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `lab_value` int(11) DEFAULT NULL,
  `picture` int(11) NOT NULL,
  `date_mode` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `make_assistants`
--

CREATE TABLE `make_assistants` (
  `id` int(11) NOT NULL,
  `assistant_id` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `level` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `headline` varchar(120) DEFAULT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) NOT NULL COMMENT 'count of view post',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recent_drugs`
--

CREATE TABLE `recent_drugs` (
  `id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `still_used` int(1) NOT NULL,
  `will_stop` int(11) NOT NULL COMMENT 'when it will stop (don''t know or date)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `opened` int(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request_chat`
--

CREATE TABLE `request_chat` (
  `id` int(11) NOT NULL,
  `dr_name` varchar(255) NOT NULL,
  `pt_name` varchar(255) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost` decimal(7,2) NOT NULL,
  `ref_num` varchar(10) NOT NULL,
  `dr_approve` int(1) NOT NULL DEFAULT '0',
  `pt_closed` int(1) NOT NULL DEFAULT '0' COMMENT 'to know is open OR close	',
  `dr_closed` int(1) NOT NULL COMMENT 'to know is open OR close',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_allergies`
--

CREATE TABLE `store_allergies` (
  `id` int(11) NOT NULL,
  `drug_title` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_chronic_drugs`
--

CREATE TABLE `store_chronic_drugs` (
  `id` int(11) NOT NULL,
  `drug_title` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_complaints`
--

CREATE TABLE `store_complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_follows`
--

CREATE TABLE `store_follows` (
  `id` int(11) NOT NULL,
  `me_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_job_titles`
--

CREATE TABLE `store_job_titles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_labs`
--

CREATE TABLE `store_labs` (
  `id` int(11) NOT NULL,
  `lab_title` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_old_reports`
--

CREATE TABLE `store_old_reports` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_xray`
--

CREATE TABLE `store_xray` (
  `id` int(11) NOT NULL,
  `report` text NOT NULL,
  `pic` varchar(255) NOT NULL,
  `date_mode` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `upload_identity`
--

CREATE TABLE `upload_identity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_social` int(1) NOT NULL,
  `verified_at` int(1) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `state` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address1` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address2` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telnum` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `group_id` int(1) NOT NULL COMMENT '0 mean pt OR 1 mean Dr',
  `approved` int(1) NOT NULL DEFAULT '0' COMMENT 'when approve identity job title',
  `social_account_title` varchar(60) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_posts`
--

CREATE TABLE `users_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `like` int(1) NOT NULL COMMENT '0 is mean dislike OR 1 is mean like',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_dashboard`
--

CREATE TABLE `user_dashboard` (
  `id` int(11) NOT NULL,
  `job_title_approve` int(1) NOT NULL COMMENT 'approve of job_title',
  `chronic_diseases_approve` int(1) NOT NULL,
  `xray_approve` int(1) NOT NULL,
  `lab_invent_approve` int(1) NOT NULL,
  `allergies_approve` int(1) NOT NULL,
  `chronic_drugs_approve` int(1) NOT NULL,
  `recent_drugs_approve` int(1) NOT NULL,
  `old_reports_approve` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vista_approve` int(11) NOT NULL,
  `vista_running` int(11) NOT NULL,
  `vista_fails` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bussiness_links`
--
ALTER TABLE `bussiness_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chronic_disease`
--
ALTER TABLE `chronic_disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chronic_disease_categories`
--
ALTER TABLE `chronic_disease_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chronic_drugs`
--
ALTER TABLE `chronic_drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_lab`
--
ALTER TABLE `compliant_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_medical_report`
--
ALTER TABLE `compliant_medical_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_others`
--
ALTER TABLE `compliant_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_recent_drugs`
--
ALTER TABLE `compliant_recent_drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliant_xray`
--
ALTER TABLE `compliant_xray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_dashboard`
--
ALTER TABLE `doctor_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_rate`
--
ALTER TABLE `dr_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_investigation`
--
ALTER TABLE `lab_investigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_drugs`
--
ALTER TABLE `recent_drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_chat`
--
ALTER TABLE `request_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_allergies`
--
ALTER TABLE `store_allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_chronic_drugs`
--
ALTER TABLE `store_chronic_drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_follows`
--
ALTER TABLE `store_follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_job_titles`
--
ALTER TABLE `store_job_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_labs`
--
ALTER TABLE `store_labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_xray`
--
ALTER TABLE `store_xray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_dashboard`
--
ALTER TABLE `user_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bussiness_links`
--
ALTER TABLE `bussiness_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chronic_disease`
--
ALTER TABLE `chronic_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chronic_disease_categories`
--
ALTER TABLE `chronic_disease_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chronic_drugs`
--
ALTER TABLE `chronic_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_lab`
--
ALTER TABLE `compliant_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_medical_report`
--
ALTER TABLE `compliant_medical_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_others`
--
ALTER TABLE `compliant_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_recent_drugs`
--
ALTER TABLE `compliant_recent_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compliant_xray`
--
ALTER TABLE `compliant_xray`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_dashboard`
--
ALTER TABLE `doctor_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dr_rate`
--
ALTER TABLE `dr_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_investigation`
--
ALTER TABLE `lab_investigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recent_drugs`
--
ALTER TABLE `recent_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_chat`
--
ALTER TABLE `request_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_allergies`
--
ALTER TABLE `store_allergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_chronic_drugs`
--
ALTER TABLE `store_chronic_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_follows`
--
ALTER TABLE `store_follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_job_titles`
--
ALTER TABLE `store_job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_labs`
--
ALTER TABLE `store_labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_xray`
--
ALTER TABLE `store_xray`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_dashboard`
--
ALTER TABLE `user_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
