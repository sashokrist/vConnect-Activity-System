-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2020 at 11:56 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1-log
-- PHP Version: 7.3.18-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test-sasho_activity-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Events', '2020-05-26 05:32:51', '2020-05-26 05:32:51'),
(2, 'Food', '2020-05-26 05:32:51', '2020-05-26 05:32:51'),
(3, 'Others', '2020-05-26 05:32:51', '2020-05-26 05:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `parent_id`, `body`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Everybody is welcome', 3, 'App\\Post', '2020-05-26 05:36:37', '2020-05-26 05:36:37'),
(2, 2, 1, 'Nice Job!', 3, 'App\\Post', '2020-05-26 05:41:38', '2020-05-26 05:41:38'),
(3, 2, NULL, 'When will be ready?', 3, 'App\\Post', '2020-05-26 05:42:22', '2020-05-26 05:42:22'),
(4, 3, 1, 'Good Job!!!', 3, 'App\\Post', '2020-05-26 05:46:12', '2020-05-26 05:46:12'),
(5, 5, NULL, 'Looking forward...', 3, 'App\\Post', '2020-05-26 05:53:32', '2020-05-26 05:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Common', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(2, 'vConnect', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(3, 'vConnect-frontend', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(4, 'Shippii', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(5, 'Shippii-frontend', '2020-05-26 05:32:53', '2020-05-26 05:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`id`, `user_id`, `group_id`) VALUES
(3, 1, '1'),
(4, 1, '2'),
(5, 1, '3'),
(6, 1, '4'),
(7, 1, '5'),
(8, 2, '1'),
(9, 3, '1'),
(10, 4, '1'),
(11, 5, '1'),
(12, 6, '1');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `massages`
--

CREATE TABLE `massages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `duration` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `massage_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `massages`
--

INSERT INTO `massages` (`id`, `start`, `end`, `duration`, `price`, `massage_date`, `created_at`, `updated_at`) VALUES
(1, '10:00:00', '15:00:00', 15, '5', '2020-05-31 21:00:00', '2020-05-26 05:43:52', '2020-05-26 05:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `massage_users`
--

CREATE TABLE `massage_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `massage_id` int(10) UNSIGNED NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `massage_users`
--

INSERT INTO `massage_users` (`id`, `user_id`, `massage_id`, `time`, `paid`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '10:15:00', 0, '2020-05-26 05:44:19', '2020-05-26 05:44:19'),
(2, 3, 1, '11:00:00', 1, '2020-05-26 05:47:40', '2020-05-26 05:55:41'),
(3, 4, 1, '13:00:00', 0, '2020-05-26 05:52:32', '2020-05-26 05:52:32'),
(4, 5, 1, '12:00:00', 1, '2020-05-26 05:53:52', '2020-05-26 05:55:43'),
(5, 6, 1, '10:45:00', 1, '2020-05-26 05:55:17', '2020-05-26 05:55:45');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_05_131304_create_roles_table', 1),
(4, '2019_12_09_074253_create_posts_comments_table', 1),
(5, '2019_12_10_081706_create_categories_table', 1),
(6, '2019_12_13_124618_create_signups_table', 1),
(7, '2019_12_30_071404_create_role_user_table', 1),
(8, '2019_12_30_090235_create_polls_table', 1),
(9, '2019_12_30_090255_create_poll_answers_table', 1),
(10, '2019_12_30_090311_create_poll_results_table', 1),
(11, '2020_01_09_072922_create_signup_titles_table', 1),
(12, '2020_02_12_094320_create_poll_comments_table', 1),
(13, '2020_02_18_111248_create_massage_user_table', 1),
(14, '2020_02_18_114112_create_massages_table', 1),
(15, '2020_02_20_073055_create_poll_signup_title_table', 1),
(16, '2020_02_25_093922_create_jobs_table', 1),
(17, '2020_02_26_095526_create_users_table', 1),
(18, '2020_03_16_082851_create_subscribes_table', 1),
(19, '2020_04_03_123112_create_groups_table', 1),
(20, '2020_04_07_123938_create_group_users_table', 1),
(21, '2020_04_09_145705_create_subscribe_user_table', 1),
(22, '2020_04_30_115631_create_tags_table', 1),
(23, '2020_04_30_115911_create_post_tag_table', 1),
(24, '2020_05_26_074348_create_contact_us_table', 1);

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
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `name`, `signup_id`, `created_at`, `updated_at`) VALUES
(1, 'where you prefer to work?', 1, '2020-05-26 05:38:57', '2020-05-26 05:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `name`, `poll_id`, `created_at`, `updated_at`) VALUES
(1, 'home', 1, '2020-05-26 05:38:58', '2020-05-26 05:38:58'),
(2, 'office', 1, '2020-05-26 05:38:58', '2020-05-26 05:38:58'),
(3, 'mixed', 1, '2020-05-26 05:38:58', '2020-05-26 05:38:58'),
(4, 'other', 1, '2020-05-26 05:38:58', '2020-05-26 05:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `poll_comments`
--

CREATE TABLE `poll_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll_comments`
--

INSERT INTO `poll_comments` (`id`, `user_id`, `parent_id`, `body`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'hhhhhhhhh', 1, 'App\\Poll', '2020-05-26 05:46:38', '2020-05-26 05:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `poll_results`
--

CREATE TABLE `poll_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poll_results`
--

INSERT INTO `poll_results` (`id`, `poll_id`, `answer_id`, `question`, `answer`, `username`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'where you prefer to work?', 'office', 'User', '2020-05-26 05:42:32', '2020-05-26 05:42:32'),
(2, 1, 1, 'where you prefer to work?', 'home', 'John Doe', '2020-05-26 05:47:31', '2020-05-26 05:47:31'),
(3, 1, 3, 'where you prefer to work?', 'mixed', 'bob', '2020-05-26 05:52:25', '2020-05-26 05:52:25'),
(4, 1, 1, 'where you prefer to work?', 'home', 'linda', '2020-05-26 05:53:44', '2020-05-26 05:53:44'),
(5, 1, 1, 'where you prefer to work?', 'home', 'luisa', '2020-05-26 05:55:04', '2020-05-26 05:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `poll_signup_title`
--

CREATE TABLE `poll_signup_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `signup_title_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `filename`, `category_id`, `group_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Assumenda nemo voluptates incidunt magni.', 'minus', 'Nesciunt aut modi quia voluptas odit eum iste voluptates. Aut consectetur reiciendis accusamus sed tenetur dolorem. Optio assumenda a assumenda blanditiis adipisci.', 'no files attached', 3, 1, '[\"image.jpg\"]', '2020-05-05 06:07:22', '2020-05-26 05:32:52', NULL),
(3, 'the renovation of the office continues', 'the-renovation-of-the-office-continues', 'I expect that the refurbishment of the office will be completed by the end of this month, so we will be opening it up from Monday the 1st of June... initially, it will be voluntary to come to work from the office or to continue working from home... I really don\'t want to put 40 people together in the office from day 1, so I need to know if you intend to come to work from the office from 1st June or if you plan to stay at home a bit longer...\r\nPlease spend 1 minute on giving me this info in this online \"Home office or Office office\" excel :)\r\n\r\n(the point is that if everybody wants to come back to the office on 1st of June we might put in place some kind of rotation principle)', NULL, 3, 1, '[\"9646EAD4-AE0C-4635-B224-74B6A7B182F3.jpg\",\"2696FC10-39DE-4F0F-908E-6938EE80B3B8.jpg\",\"E841A710-393B-4882-AAE9-ABDC8568C7E0.jpg\",\"Skype_Picture_2020_05_26T06_56_58_005Z.jpeg\"]', '2020-05-26 05:36:05', '2020-05-26 05:36:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(3, 7),
(3, 8),
(3, 9),
(3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-26 05:32:49', '2020-05-26 05:32:49'),
(2, 'user', '2020-05-26 05:32:49', '2020-05-26 05:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `signups`
--

CREATE TABLE `signups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `signup_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signups`
--

INSERT INTO `signups` (`id`, `user_id`, `signup_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'User', '2020-05-26 05:42:52', '2020-05-26 05:42:52'),
(2, 3, 1, 'John Doe', '2020-05-26 05:47:46', '2020-05-26 05:47:46'),
(3, 4, 1, 'bob', '2020-05-26 05:52:36', '2020-05-26 05:52:36'),
(4, 5, 1, 'linda', '2020-05-26 05:53:56', '2020-05-26 05:53:56'),
(5, 6, 1, 'luisa', '2020-05-26 05:55:22', '2020-05-26 05:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `signup_titles`
--

CREATE TABLE `signup_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signup_titles`
--

INSERT INTO `signup_titles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Who is comming to open-office party on 1.06.2020?', '2020-05-26 05:38:57', '2020-05-26 05:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Poll', '2020-05-26 05:32:52', '2020-05-26 05:32:52'),
(2, 'News', '2020-05-26 05:32:52', '2020-05-26 05:32:52'),
(3, 'Signup', '2020-05-26 05:32:52', '2020-05-26 05:32:52'),
(4, 'Massage', '2020-05-26 05:32:52', '2020-05-26 05:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_user`
--

CREATE TABLE `subscribe_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subscribe_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribe_user`
--

INSERT INTO `subscribe_user` (`id`, `user_id`, `subscribe_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 2),
(6, 2, 4),
(7, 3, 2),
(8, 4, 2),
(9, 4, 4),
(10, 5, 2),
(11, 5, 3),
(12, 5, 4),
(13, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'vconnect', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(8, 'shippii', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(9, 'news', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(10, 'massage', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(11, 'poll', '2020-05-26 05:32:53', '2020-05-26 05:32:53'),
(12, 'events', '2020-05-26 05:32:53', '2020-05-26 05:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@admin.com', '2019-07-01 21:00:00', '$2y$10$atPWyjU/XKByaC9h1loedeZMbFPUqs9OnspiKhdZi2ZLdSJ.Q6nce', '1590482409.png', 'xzVRuiyoaeuPTNCk2AoqsVz2OqQ7vdtQeYxTcx3QyE8dQk3h4eF3NAvcqS5J', '2020-05-26 05:32:50', '2020-05-26 05:40:09'),
(2, 'User', 'user@user.com', '2019-07-01 21:00:00', '$2y$10$Lih99bQuvTqemDAWBw2AEOilseKwRi2bvtB2b9cpjLEUPbV3TbPq2', '1590482677.jpg', '6ycZTEcoSupHvI67zaeUhFV2UnWgIQ07ttFQITmWwLiGOzXxWE9PFEi5TchO', '2020-05-26 05:32:50', '2020-05-26 05:44:37'),
(3, 'John Doe', 'john@john.com', NULL, '$2y$10$f6EhfkLVoPV2LTJjFL0p4uPhSjn71ZG1pfOPVGvgxwOELXSV7jN.G', '1590482885.JPG', NULL, '2020-05-26 05:45:35', '2020-05-26 05:48:05'),
(4, 'bob', 'bob@bob.com', NULL, '$2y$10$0rsKQO4A.Uo5kZsyvYd21etPVrHzfT4yVdSUTt055PWmjxIMbavi2', 'default.jpg', NULL, '2020-05-26 05:52:08', '2020-05-26 05:52:08'),
(5, 'linda', 'linda@linda.com', NULL, '$2y$10$3iE.uXim16n46jabl5tS0ew90eWF8jX6bmFHFolAWHNDXC9LXvf16', 'default.jpg', NULL, '2020-05-26 05:53:00', '2020-05-26 05:53:00'),
(6, 'luisa', 'luisa@luisa.com', NULL, '$2y$10$OYCDjf17lg6nLEVDzFMmB.w7xgBEm9dLxXFZCmqt5TvFr7PxWiibG', 'default.jpg', NULL, '2020-05-26 05:54:36', '2020-05-26 05:54:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `massages`
--
ALTER TABLE `massages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `massage_users`
--
ALTER TABLE `massage_users`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_comments`
--
ALTER TABLE `poll_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_results`
--
ALTER TABLE `poll_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_signup_title`
--
ALTER TABLE `poll_signup_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD KEY `post_tag_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signups`
--
ALTER TABLE `signups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup_titles`
--
ALTER TABLE `signup_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe_user`
--
ALTER TABLE `subscribe_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `massages`
--
ALTER TABLE `massages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `massage_users`
--
ALTER TABLE `massage_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poll_comments`
--
ALTER TABLE `poll_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poll_results`
--
ALTER TABLE `poll_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poll_signup_title`
--
ALTER TABLE `poll_signup_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signups`
--
ALTER TABLE `signups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signup_titles`
--
ALTER TABLE `signup_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribe_user`
--
ALTER TABLE `subscribe_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
