-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2023 at 03:17 AM
-- Server version: 5.7.21
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todos`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anne Seaton', 1, 0, 2, NULL, NULL, '2023-08-02 01:55:27', NULL, NULL),
(2, 'Howard Sargeant', 1, 0, 2, NULL, NULL, '2023-08-02 01:55:37', NULL, NULL),
(3, 'Richard Walton', 1, 0, 45, NULL, NULL, '2023-08-02 02:04:44', NULL, NULL),
(4, 'Evan Frendo Sean Mahoney', 1, 0, 58, NULL, NULL, '2023-08-02 02:40:50', NULL, NULL),
(5, 'Rosemary Richey', 1, 0, 58, NULL, NULL, '2023-08-02 03:02:52', NULL, NULL),
(6, 'Rebecca Chapman', 1, 0, 58, NULL, NULL, '2023-08-02 03:05:03', NULL, NULL),
(7, 'Pat Pledger', 1, 0, 58, NULL, NULL, '2023-08-02 03:05:16', NULL, NULL),
(8, 'Kenneth Thomson', 1, 0, 58, NULL, NULL, '2023-08-02 03:05:40', NULL, NULL),
(9, 'Charles Lafond, Sheila Vine and Birgit Welch', 1, 0, 58, NULL, NULL, '2023-08-02 03:05:51', NULL, NULL),
(10, 'Marion Grussendorf', 1, 0, 58, NULL, NULL, '2023-08-02 03:06:07', NULL, NULL),
(11, 'Sylee Gore and David Gordon Smith', 1, 0, 58, NULL, NULL, '2023-08-02 03:06:15', NULL, NULL),
(12, 'David Gordon Smith', 1, 0, 58, NULL, NULL, '2023-08-02 03:06:25', NULL, NULL),
(13, 'Lothar Gutjahr and Sean Mahoney', 1, 0, 58, NULL, NULL, '2023-08-02 03:06:41', NULL, NULL),
(14, 'Anthony Hughes', 1, 0, 58, NULL, NULL, '2023-08-02 03:07:29', NULL, NULL),
(15, 'Anthony Hughes', 0, 0, 58, 58, NULL, '2023-08-02 04:50:03', '2023-08-02 04:50:39', NULL),
(16, 'Mark Nettle and Diana Hopkins', 1, 0, 45, NULL, NULL, '2023-08-02 07:25:55', NULL, NULL),
(17, 'Martin Hewings', 1, 0, 45, NULL, NULL, '2023-08-02 07:29:26', NULL, NULL),
(18, 'Michael McCarthy Flicity O\'Dell', 1, 0, 45, NULL, NULL, '2023-08-02 07:30:09', NULL, NULL),
(19, 'Mark C. Baker', 1, 0, 45, NULL, NULL, '2023-08-02 07:31:42', NULL, NULL),
(20, 'Laurie E. Rozakis, PH.D.', 1, 0, 45, NULL, NULL, '2023-08-02 07:32:06', NULL, NULL),
(21, 'E. Walker, S. Elsworth', 1, 0, 45, NULL, NULL, '2023-08-02 07:32:29', NULL, NULL),
(22, 'Jack Umstatter', 1, 0, 45, NULL, NULL, '2023-08-02 07:33:05', NULL, NULL),
(23, 'Geraldine Woods', 1, 0, 45, NULL, NULL, '2023-08-02 07:34:29', NULL, NULL),
(24, 'Helen Naylor with Raymond Murphy', 1, 0, 45, NULL, NULL, '2023-08-02 07:34:52', NULL, NULL),
(25, 'Auditi Chakravarty', 1, 0, 45, NULL, NULL, '2023-08-02 07:35:12', NULL, NULL),
(26, 'Michael Berman', 1, 0, 45, NULL, NULL, '2023-08-02 09:06:00', NULL, NULL),
(27, 'Adrian Doff Christopher Jones', 1, 0, 45, NULL, NULL, '2023-08-02 09:07:06', NULL, NULL),
(28, 'Mark Fletcher', 1, 0, 45, NULL, NULL, '2023-08-02 09:07:33', NULL, NULL),
(29, 'Stuart Redman', 1, 0, 45, NULL, NULL, '2023-08-02 09:13:36', NULL, NULL),
(30, 'Rawdon Wyatt', 1, 0, 45, NULL, NULL, '2023-08-02 09:14:06', NULL, NULL),
(31, 'Richard Side, Guy Wellman', 1, 0, 45, NULL, NULL, '2023-08-02 09:15:48', NULL, NULL),
(32, 'Elaine Walker and Steve Elsworth', 1, 0, 45, NULL, NULL, '2023-08-02 09:16:10', NULL, NULL),
(33, 'L.G Alexander', 1, 0, 45, NULL, NULL, '2023-08-02 09:16:59', NULL, NULL),
(34, 'Michael Vince with Paul Emmerson', 1, 0, 45, NULL, NULL, '2023-08-02 09:21:25', NULL, NULL),
(35, 'Michael Swan', 1, 0, 45, NULL, NULL, '2023-08-04 06:51:08', NULL, NULL),
(36, 'Angela Burt', 1, 0, 45, NULL, NULL, '2023-08-04 06:51:28', NULL, NULL),
(37, 'Paul W.Lovinger', 1, 0, 45, NULL, NULL, '2023-08-04 06:51:53', NULL, NULL),
(38, 'Dilys Parkinson', 1, 0, 45, NULL, NULL, '2023-08-04 06:52:10', NULL, NULL),
(39, 'University of Cambridge Local Examination Syndicate', 1, 0, 45, NULL, NULL, '2023-08-04 06:54:03', NULL, NULL),
(40, 'Adrian Wallwork', 1, 0, 45, NULL, NULL, '2023-08-04 06:54:20', NULL, NULL),
(41, 'Richard A. Spears, Ph.D.', 1, 0, 45, NULL, NULL, '2023-08-04 06:55:38', NULL, NULL),
(42, 'Ann Batko', 1, 0, 45, NULL, NULL, '2023-08-04 08:15:47', NULL, NULL),
(43, 'Stevan Krajnjan', 1, 0, 45, NULL, NULL, '2023-08-04 08:16:53', NULL, NULL),
(44, 'Steve Welistein', 1, 0, 45, NULL, NULL, '2023-08-04 08:17:24', NULL, NULL),
(45, 'Keith S.Flose , April Muchmore-Vorkoun, Elena Vestri solomon', 1, 0, 45, NULL, NULL, '2023-08-04 08:17:38', NULL, NULL),
(46, 'Francine.Galko', 1, 0, 45, NULL, NULL, '2023-08-04 08:18:11', NULL, NULL),
(47, 'BART A. BAGGETT', 1, 0, 45, NULL, NULL, '2023-08-04 08:19:30', NULL, NULL),
(48, 'Lauren Starkey', 1, 0, 45, NULL, NULL, '2023-08-04 08:19:46', NULL, NULL),
(49, 'Ann Cook', 1, 0, 45, NULL, NULL, '2023-08-04 08:20:12', NULL, NULL),
(50, 'Timesavers for Teachers', 0, 0, 45, 45, NULL, '2023-08-04 08:21:06', '2023-08-04 08:33:49', NULL),
(51, 'Richard R. Day, Junko Yamanaka', 1, 0, 45, NULL, NULL, '2023-08-04 09:43:23', NULL, NULL),
(52, 'Amy Gillett', 1, 0, 45, NULL, NULL, '2023-08-04 09:43:57', NULL, NULL),
(53, 'Ben Bova', 1, 0, 45, NULL, NULL, '2023-08-04 09:44:13', NULL, NULL),
(54, 'Stephen King', 1, 0, 45, NULL, NULL, '2023-08-04 09:44:26', NULL, NULL),
(55, 'John Hughes', 1, 0, 45, NULL, NULL, '2023-08-04 09:44:48', NULL, NULL),
(56, 'Seglin, Jeffrey L', 1, 0, 45, NULL, NULL, '2023-08-04 09:45:07', NULL, NULL),
(57, 'David Grant', 1, 0, 45, NULL, NULL, '2023-08-04 09:45:20', NULL, NULL),
(58, 'Louise Pile', 1, 0, 45, NULL, NULL, '2023-08-04 09:46:03', NULL, NULL),
(59, 'David King', 1, 0, 45, NULL, NULL, '2023-08-04 09:46:21', NULL, NULL),
(60, 'Susan Lowe and Louise Pile', 1, 0, 45, NULL, NULL, '2023-08-04 09:46:35', NULL, NULL),
(61, 'John Allison', 1, 0, 45, NULL, NULL, '2023-08-04 09:47:01', NULL, NULL),
(62, 'Iwonna Dubicka Margaret O\'keeffe', 1, 0, 45, NULL, NULL, '2023-08-04 09:47:15', NULL, NULL),
(63, 'Dawn Montague', 1, 0, 45, NULL, NULL, '2023-08-04 09:47:26', NULL, NULL),
(64, 'Bill Mascull', 1, 0, 45, NULL, NULL, '2023-08-04 09:47:37', NULL, NULL),
(65, 'Simon Sweeney', 1, 0, 45, NULL, NULL, '2023-08-04 09:47:48', NULL, NULL),
(66, 'Jackie Jarvis', 1, 0, 45, NULL, NULL, '2023-08-04 09:48:14', NULL, NULL),
(67, 'ALLEN & UNWIN', 1, 0, 45, NULL, NULL, '2023-08-04 09:48:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `author_histories`
--

CREATE TABLE `author_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author_histories`
--

INSERT INTO `author_histories` (`id`, `name`, `author_id`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anne Seaton', 1, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:55:27', NULL, NULL),
(2, 'Howard Sargeant', 2, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:55:37', NULL, NULL),
(3, 'Richard Walton', 3, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 09:04:44', NULL, NULL),
(4, 'Evan Frendo Sean Mahoney', 4, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 09:40:50', NULL, NULL),
(5, 'Rosemary Richey', 5, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:02:52', NULL, NULL),
(6, 'Rebecca Chapman', 6, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:05:03', NULL, NULL),
(7, 'Pat Pledger', 7, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:05:16', NULL, NULL),
(8, 'Kenneth Thomson', 8, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:05:40', NULL, NULL),
(9, 'Charles Lafond, Sheila Vine and Birgit Welch', 9, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:05:51', NULL, NULL),
(10, 'Marion Grussendorf', 10, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:06:07', NULL, NULL),
(11, 'Sylee Gore and David Gordon Smith', 11, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:06:15', NULL, NULL),
(12, 'David Gordon Smith', 12, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:06:25', NULL, NULL),
(13, 'Lothar Gutjahr and Sean Mahoney', 13, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:06:41', NULL, NULL),
(14, 'Anthony Hughes', 14, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:07:29', NULL, NULL),
(15, 'Anthony Hughes', 15, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:50:03', NULL, NULL),
(16, 'Anthony Hughes', 15, 0, 0, NULL, 'Yan Namrong', NULL, NULL, '2023-08-02 11:50:39', NULL),
(17, 'Mark Nettle and Diana Hopkins', 16, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:25:55', NULL, NULL),
(18, 'Martin Hewings', 17, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:29:26', NULL, NULL),
(19, 'Michael McCarthy Flicity O\'Dell', 18, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:30:09', NULL, NULL),
(20, 'Mark C. Baker', 19, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:31:42', NULL, NULL),
(21, 'Laurie E. Rozakis, PH.D.', 20, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:32:06', NULL, NULL),
(22, 'E. Walker, S. Elsworth', 21, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:32:29', NULL, NULL),
(23, 'Jack Umstatter', 22, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:33:05', NULL, NULL),
(24, 'Geraldine Woods', 23, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:34:29', NULL, NULL),
(25, 'Helen Naylor with Raymond Murphy', 24, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:34:52', NULL, NULL),
(26, 'Auditi Chakravarty', 25, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:35:12', NULL, NULL),
(27, 'Michael Berman', 26, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:06:00', NULL, NULL),
(28, 'Adrian Doff Christopher Jones', 27, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:07:06', NULL, NULL),
(29, 'Mark Fletcher', 28, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:07:33', NULL, NULL),
(30, 'Stuart Redman', 29, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:13:36', NULL, NULL),
(31, 'Rawdon Wyatt', 30, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:14:06', NULL, NULL),
(32, 'Richard Side, Guy Wellman', 31, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:15:48', NULL, NULL),
(33, 'Elaine Walker and Steve Elsworth', 32, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:16:10', NULL, NULL),
(34, 'L.G Alexander', 33, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:16:59', NULL, NULL),
(35, 'Michael Vince with Paul Emmerson', 34, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:21:25', NULL, NULL),
(36, 'Michael Swan', 35, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:51:08', NULL, NULL),
(37, 'Angela Burt', 36, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:51:28', NULL, NULL),
(38, 'Paul W.Lovinger', 37, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:51:53', NULL, NULL),
(39, 'Dilys Parkinson', 38, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:52:10', NULL, NULL),
(40, 'University of Cambridge Local Examination Syndicate', 39, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:54:03', NULL, NULL),
(41, 'Adrian Wallwork', 40, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:54:20', NULL, NULL),
(42, 'Richard A. Spears, Ph.D.', 41, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:55:38', NULL, NULL),
(43, 'Ann Batko', 42, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:15:47', NULL, NULL),
(44, 'Stevan Krajnjan', 43, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:16:53', NULL, NULL),
(45, 'Steve Welistein', 44, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:17:24', NULL, NULL),
(46, 'Keith S.Flose , April Muchmore-Vorkoun, Elena Vestri solomon', 45, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:17:38', NULL, NULL),
(47, 'Francine.Galko', 46, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:18:11', NULL, NULL),
(48, 'BART A. BAGGETT', 47, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:19:30', NULL, NULL),
(49, 'Lauren Starkey', 48, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:19:46', NULL, NULL),
(50, 'Ann Cook', 49, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:20:12', NULL, NULL),
(51, 'Timesavers for Teachers', 50, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:21:06', NULL, NULL),
(52, 'Timesavers for Teachers', 50, 0, 0, NULL, 'Sao Panha', NULL, NULL, '2023-08-04 15:33:49', NULL),
(53, 'Richard R. Day, Junko Yamanaka', 51, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:43:23', NULL, NULL),
(54, 'Amy Gillett', 52, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:43:57', NULL, NULL),
(55, 'Ben Bova', 53, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:44:13', NULL, NULL),
(56, 'Stephen King', 54, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:44:26', NULL, NULL),
(57, 'John Hughes', 55, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:44:48', NULL, NULL),
(58, 'Seglin, Jeffrey L', 56, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:45:07', NULL, NULL),
(59, 'David Grant', 57, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:45:20', NULL, NULL),
(60, 'Louise Pile', 58, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:46:03', NULL, NULL),
(61, 'David King', 59, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:46:21', NULL, NULL),
(62, 'Susan Lowe and Louise Pile', 60, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:46:35', NULL, NULL),
(63, 'John Allison', 61, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:47:01', NULL, NULL),
(64, 'Iwonna Dubicka Margaret O\'keeffe', 62, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:47:15', NULL, NULL),
(65, 'Dawn Montague', 63, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:47:26', NULL, NULL),
(66, 'Bill Mascull', 64, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:47:37', NULL, NULL),
(67, 'Simon Sweeney', 65, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:47:48', NULL, NULL),
(68, 'Jackie Jarvis', 66, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:48:14', NULL, NULL),
(69, 'ALLEN & UNWIN', 67, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:48:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_libraries`
--

CREATE TABLE `e_libraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `book_cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_libraries`
--

INSERT INTO `e_libraries` (`id`, `title`, `sub_title`, `year`, `page`, `author_id`, `publisher_id`, `genre_id`, `book_cover`, `book_file`, `view`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Basic English Grammar, Book 1', NULL, '2007', '159', 1, 1, 1, 'r3D1690941598.png', 'Ppn_book_file_1690941598.pdf', 26, 1, 0, 2, NULL, NULL, '2023-08-02 01:59:58', '2023-08-02 01:59:58', NULL),
(2, 'Basic English  Grammar, Book 2', NULL, '2007', '154', 2, 1, 1, 'kkq1690942141.png', '9ED_book_file_1690942141.pdf', 36, 1, 0, 45, NULL, NULL, '2023-08-02 02:09:01', '2023-08-02 02:09:01', NULL),
(3, 'Advanced English CAE Grammar Practice', NULL, '1994', '111', 3, 2, 2, 'kZ11690944668.jpg', 'Eif_book_file_1690944668.pdf', 1, 1, 0, 58, NULL, NULL, '2023-08-02 02:51:08', '2023-08-19 02:04:07', NULL),
(4, 'Oxford-Eng for Accounting', NULL, '2007', '64', 4, 3, 3, 'sW51690945110.jpg', 'Hko_book_file_1690945110.pdf', 55, 1, 0, 58, NULL, NULL, '2023-08-02 02:58:30', '2023-08-02 02:58:30', NULL),
(5, 'Oxford-Eng for Customer Care', NULL, '2007', '82', 5, 3, 3, '8y71690945792.jpg', 'JSs_book_file_1690945792.pdf', 44, 1, 0, 58, NULL, NULL, '2023-08-02 03:09:52', '2023-08-02 03:09:52', NULL),
(6, 'Oxford-Eng For Emails', NULL, '2007', '67', 6, 3, 3, '1Eu1690947544.jpg', 'jbg_book_file_1690947544.pdf', 88, 1, 0, 58, NULL, NULL, '2023-08-02 03:39:04', '2023-08-02 03:39:04', NULL),
(7, 'Oxford-Eng for HR', NULL, '2007', '82', 7, 3, 3, 'pQb1690947713.jpg', 'vSA_book_file_1690947713.pdf', 75, 1, 0, 58, NULL, NULL, '2023-08-02 03:41:53', '2023-08-02 03:41:53', NULL),
(8, 'Oxford-Eng For Meeting', NULL, '2007', '83', 8, 3, 3, '5qJ1690948001.jpg', 'qe7_book_file_1690948001.pdf', 35, 1, 0, 58, NULL, NULL, '2023-08-02 03:46:41', '2023-08-02 03:46:41', NULL),
(9, 'Oxford-Eng For Negotiating', NULL, '2010', '91', 9, 3, 3, 'M5C1690948345.jpg', '7h2_book_file_1690948345.pdf', 54, 1, 0, 58, NULL, NULL, '2023-08-02 03:52:25', '2023-08-02 03:52:25', NULL),
(10, 'Oxford-Eng For Presentation', NULL, '2007', '83', 10, 3, 3, 'oCH1690948904.jpg', 'Fsx_book_file_1690948904.pdf', 55, 1, 0, 58, NULL, NULL, '2023-08-02 04:01:44', '2023-08-02 04:01:44', NULL),
(11, 'Oxford-Eng For Teleohining', NULL, '2007', '83', 11, 3, 3, 'nwA1690950437.jpg', 'yE0_book_file_1690950437.pdf', 65, 1, 0, 58, 58, NULL, '2023-08-02 04:27:17', '2023-08-02 04:44:05', NULL),
(12, 'Oxford-Eng For Teleohining', NULL, '2007', '68', 12, 3, 3, 'Gud1690951236.jpg', '1ws_book_file_1690951236.pdf', 74, 1, 0, 58, NULL, NULL, '2023-08-02 04:40:36', '2023-08-02 04:40:36', NULL),
(13, 'Oxford-Sales and Purchasing', NULL, '2009', '82', 13, 3, 3, 'o1i1690951637.jpg', 'tQl_book_file_1690951637.pdf', 52, 1, 0, 58, NULL, NULL, '2023-08-02 04:47:17', '2023-08-02 04:47:17', NULL),
(14, 'Anthony Huge English4today The Online English Grammar', NULL, '2001', '261', 14, 4, 1, 'Kg11690951978.jpg', 'xbp_book_file_1690951978.pdf', 54, 1, 0, 58, NULL, NULL, '2023-08-02 04:52:58', '2023-08-02 04:52:58', NULL),
(15, 'Cambridge University Press Devoloping Grammar In Context', NULL, '2003', '334', 16, 5, 1, 'zLJ1690962610.png', '9oX_book_file_1690962611.pdf', 25, 1, 0, 45, NULL, NULL, '2023-08-02 07:50:11', '2023-08-02 07:50:11', NULL),
(16, 'Cambridge University Press English Advanced Grammar In Use', NULL, '1999', '350', 17, 5, 1, '1Bv1690962837.png', 'f81_book_file_1690962837.pdf', 15, 1, 0, 45, NULL, NULL, '2023-08-02 07:53:57', '2023-08-02 07:53:57', NULL),
(17, 'Cambridge University Press Lexical Categories Verbs, Nouns, And Adjectives', NULL, '2003', '253', 19, 5, 1, 'vWv1690963947.png', 'JwR_book_file_1690963947.pdf', 15, 1, 0, 45, NULL, NULL, '2023-08-02 08:12:27', '2023-08-02 08:12:27', NULL),
(18, 'Complete Idiot\'s Guide to Grammar & Style, 2nd Ed (2003)', NULL, '2003', '403', 20, 6, 1, 'RHx1690964140.png', 'jtM_book_file_1690964140.pdf', 63, 1, 0, 45, NULL, NULL, '2023-08-02 08:15:40', '2023-08-02 08:15:40', NULL),
(19, 'E. Walker, S. Elsworth -- Grammar Practice for Upper Intermediate Students', NULL, '2000', '204', 21, 7, 1, 'bWX1690964458.png', 'VeI_book_file_1690964458.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-02 08:20:58', '2023-08-02 08:20:58', NULL),
(20, 'English Brainstormers_Ready-to-Use Games and Activities', NULL, '2009', '270', 22, 8, 1, 'S5N1690964605.png', 'Fe5_book_file_1690964605.pdf', 94, 1, 0, 45, NULL, NULL, '2023-08-02 08:23:25', '2023-08-02 08:23:25', NULL),
(21, 'English Grammar for the Utterly Confused', NULL, '2003', '236', 20, 9, 1, 'zLk1690964777.png', '8BK_book_file_1690964778.pdf', 33, 1, 0, 45, NULL, NULL, '2023-08-02 08:26:18', '2023-08-02 08:26:18', NULL),
(22, 'English Grammar Workbook for Dummies', NULL, '2006', '298', 23, 10, 1, 'jHM1690965022.png', 'mFW_book_file_1690965022.pdf', 44, 1, 0, 45, NULL, NULL, '2023-08-02 08:30:22', '2023-08-02 08:30:22', NULL),
(23, 'Essential Grammar in Use_Supplementary Exercises', NULL, '1996', '184', 24, 5, 1, 'hF21690965413.png', 't8b_book_file_1690965413.pdf', 77, 1, 0, 45, NULL, NULL, '2023-08-02 08:36:53', '2023-08-02 08:36:53', NULL),
(24, 'Grammar and Usage for Better Writing (2004)', NULL, '2004', '270', 25, 11, 1, '1Os1690965527.png', 'wyP_book_file_1690965527.pdf', 88, 1, 0, 45, NULL, NULL, '2023-08-02 08:38:47', '2023-08-02 08:38:47', NULL),
(25, 'Brain Friendly Publiscations Who Are You Intermediate Questionnaires', NULL, '1995', '25', 26, 12, 4, 'x441691027100.png', 'q4D_book_file_1691027100.pdf', 22, 1, 0, 45, NULL, NULL, '2023-08-03 01:45:00', '2023-08-03 01:45:00', NULL),
(26, 'Cambridge University Press Essential Grammar In Use Supplementary Exercises', NULL, '1996', '113', 24, 5, 1, '4kJ1691028005.png', 'D7V_book_file_1691028005.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:00:05', '2023-08-03 02:00:05', NULL),
(27, 'Cambridge University Press Language In Use - Pre-Intermediate - Self-Study Workbook', NULL, '1991', '86', 27, 5, 5, 'DzC1691028557.png', 'DM1_book_file_1691028557.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:09:17', '2023-08-03 02:09:17', NULL),
(28, 'Brain Friendly Publications Activating Vocaulary Through Pictures', NULL, '2004', '25', 28, 12, 6, 'Qbx1691028778.png', 'LhM_book_file_1691028778.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:12:58', '2023-08-03 02:12:58', NULL),
(29, 'English Vocabulary in Use - Elementary', '60 Units of vocabulary reference and Practice self-study and classroom use', '1999', '171', 18, 5, 6, 'h3a1691029236.png', 'ays_book_file_1691029236.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:20:36', '2023-08-03 02:20:36', NULL),
(30, 'English Vocabulary in Use - Pre- & Intermediate 1997', '100 Units of vocabulary reference and Practice self-study and classroom use', '1997', '269', 29, 5, 6, 'UR71691029498.png', 'Cld_book_file_1691029499.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:24:59', '2023-08-03 02:24:59', NULL),
(31, 'English Vocabulary in Use - Upper-Intermediate & Advanced', '100 Units of vocabulary reference and Practice self-study and classroom use', '1994', '303', 18, 5, 6, '7fX1691030190.jpg', 'Y5E_book_file_1691030190.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:36:30', '2023-08-03 02:36:30', NULL),
(32, 'Check Your Vocabulary for English for the IELTS Exam', 'A workbook for student', '2001', '125', 30, 13, 6, 'Z6T1691030708.jpg', 'b5i_book_file_1691030708.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:45:08', '2023-08-03 02:45:08', NULL),
(33, 'Grammar and Vocabulary for Cambridge Advanced and Proficiency', NULL, '1999', '288', 31, 14, 1, 'Q6W1691031014.png', 'u7E_book_file_1691031015.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 02:50:15', '2023-08-03 02:50:15', NULL),
(34, 'Grammar Practice for Upper Intermediate Students', NULL, '1988', '209', 32, 15, 1, '37v1691048229.png', 'P02_book_file_1691048229.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 07:37:09', '2023-08-03 07:37:09', NULL),
(35, 'Longman English Grammar Practice Intermediate_Self- Study Ed', NULL, '1990', '296', 33, 16, 1, 'AQU1691048446.png', 'Yws_book_file_1691048446.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 07:40:46', '2023-08-03 07:40:46', NULL),
(36, 'MacMillan-FCE.Language.Practice.With.Key (M.Vince)', NULL, '2003', '351', 34, 17, 1, '4aU1691049464.png', '9kf_book_file_1691049464.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-03 07:57:44', '2023-08-03 07:57:44', NULL),
(37, 'New Grammar Practice (Pre-intermediate with key)', NULL, '2000', '174', 21, 16, 1, 'ttC1691113114.png', '2MN_book_file_1691113114.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 01:38:34', '2023-08-04 01:38:34', NULL),
(38, 'Oxford - Basic English Usage', NULL, '1984', '288', 35, 3, 1, 'wei1691132741.png', 'h3g_book_file_1691132741.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:05:41', '2023-08-04 07:05:41', NULL),
(39, 'The A-Z of Correct English_Common Errors in English', 'The A-Z of Correct English', '2002', '203', 36, 19, 4, 'U3B1691132873.png', 'XaC_book_file_1691132873.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:07:53', '2023-08-04 07:07:53', NULL),
(40, 'Penguin Dictionary of American English Usage and Style', NULL, '2002', '491', 37, 18, 1, 'BJx1691133120.png', 'oqq_book_file_1691133121.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:12:01', '2023-08-04 07:12:01', NULL),
(41, 'Really Learn 100 Phrasal Verbs', NULL, '2002', '128', 38, 3, 1, '2az1691135511.png', 'kBV_book_file_1691135511.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:51:51', '2023-08-04 07:51:51', NULL),
(42, 'Cambridge University Press Cambridge Certificate In Advanced English Teachers Book - 4', 'Certificate In Advanced English 4', '1999', '88', 39, 5, 4, 'WrT1691135688.png', 'YC7_book_file_1691135688.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:54:48', '2023-08-04 07:54:48', NULL),
(43, 'Cambridge University Press Cambridge Certificate Of Profeciency English - 1', 'Certificate In Advanced English 1', '2001', '184', 39, 5, 4, 'Zv21691135812.png', 'bAE_book_file_1691135812.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 07:56:52', '2023-08-04 07:56:52', NULL),
(44, 'Cambridge University Press Discussions A-Z Advanced', 'Discussions A-Z Advanced, A resource book of speaking activities', '1997', '113', 40, 5, 7, 'LJR1691136106.png', 't1M_book_file_1691136107.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:01:47', '2023-08-04 08:01:47', NULL),
(45, 'Dictionary Cambridge English Grammar - Check Your Vocabulary for IELTS', 'IELTS Workbook', '2001', '125', 30, 13, 8, 'qnD1691136297.png', 'rQj_book_file_1691136297.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:04:58', '2023-08-04 08:04:58', NULL),
(46, 'McGraw-Hill\'s.Dictionary.of.American.Idioms.and.Phrasal.Verbs.ShareVirus', 'Dictionary.of.American.Idioms.and.Phrasal.Verbs', '2005', '1098', 41, 9, 4, '3mV1691136512.png', 'Lvx_book_file_1691136512.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:08:32', '2023-08-04 08:08:32', NULL),
(47, 'NTC\'s American Idioms Dictionary', 'The Most Practical Reference for\r\nthe Everyday Expressions of\r\nContemporary American English', '1976', '641', 41, 9, 4, 'uQv1691136615.png', 'bTt_book_file_1691136615.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:10:15', '2023-08-04 08:10:15', NULL),
(48, 'When Bad Grammar Happens to Good People', 'How to avoid common errors in English', '2004', '256', 42, 20, 1, 'rNy1691137754.png', 'JWy_book_file_1691137754.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:29:14', '2023-08-04 08:29:14', NULL),
(49, '1000 Quick Writing Ideas', NULL, '2000', '46', 43, 23, 9, 'BF01691138511.png', 'kCD_book_file_1691138511.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:41:51', '2023-08-04 08:41:51', NULL),
(50, 'Associate Press Sports Writing Handbook', NULL, '2002', '209', 44, 9, 9, '6Mi1691138718.png', '9D7_book_file_1691138718.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 08:45:18', '2023-08-04 08:45:18', NULL),
(51, 'Better Writing Right Now', 'Using words to your advantage', '2001', '239', 46, 22, 9, 'Sfh1691139992.png', 'IFW_book_file_1691139992.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 09:06:32', '2023-08-04 09:06:32', NULL),
(52, 'Email English by Paul Emmerson', 'Includes phrase bank of useful expressions', '2003', '97', 34, 17, 9, '4UG1691140188.png', 'Vfp_book_file_1691140188.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 09:09:48', '2023-08-04 09:09:48', NULL),
(53, 'Handwriting Success Secrets', NULL, '2002', '159', 47, 24, 9, 'xbP1691141634.png', 'aGk_book_file_1691141635.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 09:33:55', '2023-08-04 09:33:55', NULL),
(54, 'SAT Writing Essentials', NULL, '2006', '170', 48, 22, 9, 'C1D1691141764.png', 'W0G_book_file_1691141764.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 09:36:04', '2023-08-04 09:36:04', NULL),
(55, 'American Accent Training', 'A Guide to Speaking and Pronouncing American English for Everyone Who Speaks English as a Second Language', '2000', '185', 49, 25, 7, 'GXB1691143985.jpg', 'z0L_book_file_1691143985.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 10:13:05', '2023-08-04 10:13:05', NULL),
(56, 'Impact Issues', '30 key issues to help you express yourself in English', '2002', '60', 51, 26, 7, '4Yq1691146903.jpg', 'vr9_book_file_1691146904.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:01:44', '2023-08-04 11:01:44', NULL),
(57, 'Impact Topics', '30 exciting topics to talk about in English', '1999', '79', 51, 27, 7, 'TzK1691147020.jpg', 'rfj_book_file_1691147020.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:03:40', '2023-08-04 11:03:40', NULL),
(58, 'Speak English like an American', 'Learn the idiom & expressions that will help you speak like a native!', '2004', '175', 52, 28, 7, 'kzK1691147148.jpg', 'Pgi_book_file_1691147148.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:05:48', '2023-08-04 11:05:48', NULL),
(59, 'The Craft of Writing Science Fiction', NULL, '1994', '141', 53, 29, 9, 'NGh1691147449.jpg', 'TdK_book_file_1691147449.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:10:49', '2023-08-04 11:10:49', NULL),
(60, 'On Writing', NULL, '2000', '278', 54, 30, 9, 'unk1691147547.jpg', '26i_book_file_1691147547.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:12:27', '2023-08-04 11:12:27', NULL),
(61, 'BR Begin-Stu', 'Business Result Starter Student\'s Book', '2014', '81', 55, 3, 3, 'cn41691147651.jpg', 'ojQ_book_file_1691147651.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:14:11', '2023-08-04 11:14:11', NULL),
(62, 'Amacom The AMA Handbook of Business Letters', NULL, '2002', '537', 56, 31, 3, 'XZ91691147838.png', 'RTl_book_file_1691147838.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:17:18', '2023-08-04 11:17:18', NULL),
(63, 'Delta-E-mailing', NULL, '2004', '66', 58, 32, 3, 'lAI1691148435.png', '71q_book_file_1691148435.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:27:15', '2023-08-04 11:27:15', NULL),
(64, 'Delta-Meeting', NULL, '2008', '66', 59, 32, 3, 'BMf1691148559.png', 'SNA_book_file_1691148559.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:29:19', '2023-08-04 11:29:19', NULL),
(65, 'Delta-Negotiating', NULL, '2007', '66', 60, 32, 3, '49i1691148685.png', '52v_book_file_1691148685.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:31:25', '2023-08-04 11:31:25', NULL),
(66, 'Delta-Telephoning', NULL, '2004', '66', 60, 32, 3, '6mO1691148826.png', 'RnD_book_file_1691148827.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:33:47', '2023-08-04 11:33:47', NULL),
(67, 'Delta-Socializing', NULL, '2005', '67', 59, 32, 3, 't0g1691148909.png', 'AFQ_book_file_1691148909.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:35:09', '2023-08-04 11:35:09', NULL),
(68, 'ML Advanced-Stu', NULL, '2011', '186', 62, 33, 3, 'r001691149184.png', 'K7T_book_file_1691149184.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:39:44', '2023-08-04 11:39:44', NULL),
(69, 'Aspatore Publishing The Business Translator', NULL, '2002', '600', 63, 34, 3, 'HkG1691149373.png', 'Ytw_book_file_1691149373.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:42:53', '2023-08-04 11:42:53', NULL),
(70, 'Business Vocabulary in Use (2002)', NULL, '2002', '173', 64, 35, 3, 'M6A1691149494.png', 'JSd_book_file_1691149494.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:44:54', '2023-08-04 11:44:54', NULL),
(71, 'Cambridge University Press - English For Business Communication', NULL, '2003', '91', 65, 5, 3, 'Fmg1691149598.png', 'nng_book_file_1691149598.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:46:38', '2023-08-04 11:46:38', NULL),
(72, 'Business Vocab in Use Advance', NULL, '2002', '128', 64, 5, 3, 'jks1691149914.png', 'Sjs_book_file_1691149914.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:51:54', '2023-08-04 11:51:54', NULL),
(73, 'Business Vocab in Use Elementary', NULL, '2006', '105', 64, 5, 3, 'U4c1691150124.png', 'Jc8_book_file_1691150124.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:55:24', '2023-08-04 11:55:24', NULL),
(74, '85 Inspiring Ways to Market Your Small Business', '85 Inspiring Ways to Market Your Small Business_ Inspiring, Self-help, Sales and Marketing Strategies That You Can Apply to Your Own Business Immediately', '2009', '257', 66, 19, 3, 'VTn1691150316.png', 'yD2_book_file_1691150316.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 11:58:36', '2023-08-04 11:58:36', NULL),
(75, '101 Ways to Market Your Business', NULL, '2006', '271', 67, 36, 3, 'adX1691150430.png', 'IvX_book_file_1691150430.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 12:00:30', '2023-08-04 12:00:30', NULL),
(76, 'In Company Logistics-Student\'s book', NULL, '2017', '66', 61, 17, 3, 'D121691150741.png', 'eEZ_book_file_1691150741.pdf', 0, 1, 0, 45, NULL, NULL, '2023-08-04 12:05:41', '2023-08-04 12:05:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_library_histories`
--

CREATE TABLE `e_library_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `elibrary_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_library_histories`
--

INSERT INTO `e_library_histories` (`id`, `elibrary_id`, `title`, `sub_title`, `year`, `page`, `author`, `publisher`, `genre`, `book_cover`, `book_file`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Basic English Grammar, Book 1', NULL, '2007', '159', 'Anne Seaton', 'Saddleback Educational Publishing', 'Grammar Book', 'r3D1690941598.png', 'Ppn_book_file_1690941598.pdf', 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:59:58', '2023-08-02 08:59:58', NULL),
(2, 2, 'Basic English  Grammar, Book 2', NULL, '2007', '154', 'Howard Sargeant', 'Saddleback Educational Publishing', 'Grammar Book', 'kkq1690942141.png', '9ED_book_file_1690942141.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 09:09:01', '2023-08-02 09:09:01', NULL),
(3, 3, 'Advanced English CAE Grammar Practice', NULL, '1994', '111', 'Richard Walton', 'Thomas Nelson and Sons', 'Grammar Exercise', 'kZ11690944668.jpg', 'Eif_book_file_1690944668.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 09:51:08', '2023-08-02 09:51:08', NULL),
(4, 4, 'Oxford-Eng for Accounting', NULL, '2007', '64', 'Evan Frendo Sean Mahoney', 'Oxford University Press (Maker)', 'Business Book', 'sW51690945110.jpg', 'Hko_book_file_1690945110.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 09:58:30', '2023-08-02 09:58:30', NULL),
(5, 5, 'Oxford-Eng for Customer Care', NULL, '2007', '82', 'Rosemary Richey', 'Oxford University Press (Maker)', 'Business Book', '8y71690945792.jpg', 'JSs_book_file_1690945792.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:09:52', '2023-08-02 10:09:52', NULL),
(6, 6, 'Oxford-Eng For Emails', NULL, '2007', '67', 'Rebecca Chapman', 'Oxford University Press (Maker)', 'Business Book', '1Eu1690947544.jpg', 'jbg_book_file_1690947544.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:39:04', '2023-08-02 10:39:04', NULL),
(7, 7, 'Oxford-Eng for HR', NULL, '2007', '82', 'Pat Pledger', 'Oxford University Press (Maker)', 'Business Book', 'pQb1690947713.jpg', 'vSA_book_file_1690947713.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:41:53', '2023-08-02 10:41:53', NULL),
(8, 8, 'Oxford-Eng For Meeting', NULL, '2007', '83', 'Kenneth Thomson', 'Oxford University Press (Maker)', 'Business Book', '5qJ1690948001.jpg', 'qe7_book_file_1690948001.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:46:41', '2023-08-02 10:46:41', NULL),
(9, 9, 'Oxford-Eng For Negotiating', NULL, '2010', '91', 'Charles Lafond, Sheila Vine and Birgit Welch', 'Oxford University Press (Maker)', 'Business Book', 'M5C1690948345.jpg', '7h2_book_file_1690948345.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 10:52:25', '2023-08-02 10:52:25', NULL),
(10, 10, 'Oxford-Eng For Presentation', NULL, '2007', '83', 'Marion Grussendorf', 'Oxford University Press (Maker)', 'Business Book', 'oCH1690948904.jpg', 'Fsx_book_file_1690948904.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:01:44', '2023-08-02 11:01:44', NULL),
(11, 11, 'Oxford-Eng For Teleohining', NULL, '2007', '68', 'David Gordon Smith', 'Oxford University Press (Maker)', 'Business Book', 'nwA1690950437.jpg', 'yE0_book_file_1690950437.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:27:17', '2023-08-02 11:27:17', NULL),
(12, 12, 'Oxford-Eng For Teleohining', NULL, '2007', '68', 'David Gordon Smith', 'Oxford University Press (Maker)', 'Business Book', 'Gud1690951236.jpg', '1ws_book_file_1690951236.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:40:36', '2023-08-02 11:40:36', NULL),
(13, 11, 'Oxford-Eng For Teleohining', NULL, '2007', '83', 'Sylee Gore and David Gordon Smith', 'Oxford University Press (Maker)', 'Business Book', 'nwA1690950437.jpg', 'yE0_book_file_1690950437.pdf', 1, 0, NULL, 'Yan Namrong', NULL, '2023-08-02 11:44:05', '2023-08-02 11:44:05', NULL),
(14, 13, 'Oxford-Sales and Purchasing', NULL, '2009', '82', 'Lothar Gutjahr and Sean Mahoney', 'Oxford University Press (Maker)', 'Business Book', 'o1i1690951637.jpg', 'tQl_book_file_1690951637.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:47:17', '2023-08-02 11:47:17', NULL),
(15, 14, 'Anthony Huge English4today The Online English Grammar', NULL, '2001', '261', 'Anthony Hughes', 'Anthony Hughes', 'Grammar Book', 'Kg11690951978.jpg', 'xbp_book_file_1690951978.pdf', 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 11:52:58', '2023-08-02 11:52:58', NULL),
(16, 15, 'Cambridge University Press Devoloping Grammar In Context', NULL, '2003', '334', 'Mark Nettle and Diana Hopkins', 'Cambridge University Press', 'Grammar Book', 'zLJ1690962610.png', '9oX_book_file_1690962611.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:50:11', '2023-08-02 14:50:11', NULL),
(17, 16, 'Cambridge University Press English Advanced Grammar In Use', NULL, '1999', '350', 'Martin Hewings', 'Cambridge University Press', 'Grammar Book', '1Bv1690962837.png', 'f81_book_file_1690962837.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:53:57', '2023-08-02 14:53:57', NULL),
(18, 17, 'Cambridge University Press Lexical Categories Verbs, Nouns, And Adjectives', NULL, '2003', '253', 'Mark C. Baker', 'Cambridge University Press', 'Grammar Book', 'vWv1690963947.png', 'JwR_book_file_1690963947.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:12:27', '2023-08-02 15:12:27', NULL),
(19, 18, 'Complete Idiot\'s Guide to Grammar & Style, 2nd Ed (2003)', NULL, '2003', '403', 'Laurie E. Rozakis, PH.D.', 'Marie Butler-Knight', 'Grammar Book', 'RHx1690964140.png', 'jtM_book_file_1690964140.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:15:40', '2023-08-02 15:15:40', NULL),
(20, 19, 'E. Walker, S. Elsworth -- Grammar Practice for Upper Intermediate Students', NULL, '2000', '204', 'E. Walker, S. Elsworth', 'E. Walker, S. Elsworth', 'Grammar Book', 'bWX1690964458.png', 'VeI_book_file_1690964458.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:20:58', '2023-08-02 15:20:58', NULL),
(21, 20, 'English Brainstormers_Ready-to-Use Games and Activities', NULL, '2009', '270', 'Jack Umstatter', 'Jossey-Bass', 'Grammar Book', 'S5N1690964605.png', 'Fe5_book_file_1690964605.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:23:25', '2023-08-02 15:23:25', NULL),
(22, 21, 'English Grammar for the Utterly Confused', NULL, '2003', '236', 'Laurie E. Rozakis, PH.D.', 'The McGraw-Hill Companies, Inc.', 'Grammar Book', 'zLk1690964777.png', '8BK_book_file_1690964778.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:26:18', '2023-08-02 15:26:18', NULL),
(23, 22, 'English Grammar Workbook for Dummies', NULL, '2006', '298', 'Geraldine Woods', 'Wiley Publishing, Inc.', 'Grammar Book', 'jHM1690965022.png', 'mFW_book_file_1690965022.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:30:22', '2023-08-02 15:30:22', NULL),
(24, 23, 'Essential Grammar in Use_Supplementary Exercises', NULL, '1996', '184', 'Helen Naylor with Raymond Murphy', 'Cambridge University Press', 'Grammar Book', 'hF21690965413.png', 't8b_book_file_1690965413.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:36:53', '2023-08-02 15:36:53', NULL),
(25, 24, 'Grammar and Usage for Better Writing (2004)', NULL, '2004', '270', 'Auditi Chakravarty', 'Amsco School Publications, Inc.', 'Grammar Book', '1Os1690965527.png', 'wyP_book_file_1690965527.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 15:38:47', '2023-08-02 15:38:47', NULL),
(26, 25, 'Brain Friendly Publiscations Who Are You Intermediate Questionnaires', NULL, '1995', '25', 'Michael Berman', 'Brain Friendly Publications', 'Reference', 'x441691027100.png', 'q4D_book_file_1691027100.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 08:45:00', '2023-08-03 08:45:00', NULL),
(27, 26, 'Cambridge University Press Essential Grammar In Use Supplementary Exercises', NULL, '1996', '113', 'Helen Naylor with Raymond Murphy', 'Cambridge University Press', 'Grammar Book', '4kJ1691028005.png', 'D7V_book_file_1691028005.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:00:05', '2023-08-03 09:00:05', NULL),
(28, 27, 'Cambridge University Press Language In Use - Pre-Intermediate - Self-Study Workbook', NULL, '1991', '86', 'Adrian Doff Christopher Jones', 'Cambridge University Press', 'Excersie Practice', 'DzC1691028557.png', 'DM1_book_file_1691028557.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:09:17', '2023-08-03 09:09:17', NULL),
(29, 28, 'Brain Friendly Publications Activating Vocaulary Through Pictures', NULL, '2004', '25', 'Mark Fletcher', 'Brain Friendly Publications', 'Vocabulary Book', 'Qbx1691028778.png', 'LhM_book_file_1691028778.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:12:58', '2023-08-03 09:12:58', NULL),
(30, 29, 'English Vocabulary in Use - Elementary', '60 Units of vocabulary reference and Practice self-study and classroom use', '1999', '171', 'Michael McCarthy Flicity O\'Dell', 'Cambridge University Press', 'Vocabulary Book', 'h3a1691029236.png', 'ays_book_file_1691029236.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:20:36', '2023-08-03 09:20:36', NULL),
(31, 30, 'English Vocabulary in Use - Pre- & Intermediate 1997', '100 Units of vocabulary reference and Practice self-study and classroom use', '1997', '269', 'Stuart Redman', 'Cambridge University Press', 'Vocabulary Book', 'UR71691029498.png', 'Cld_book_file_1691029499.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:24:59', '2023-08-03 09:24:59', NULL),
(32, 31, 'English Vocabulary in Use - Upper-Intermediate & Advanced', '100 Units of vocabulary reference and Practice self-study and classroom use', '1994', '303', 'Michael McCarthy Flicity O\'Dell', 'Cambridge University Press', 'Vocabulary Book', '7fX1691030190.jpg', 'Y5E_book_file_1691030190.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:36:30', '2023-08-03 09:36:30', NULL),
(33, 32, 'Check Your Vocabulary for English for the IELTS Exam', 'A workbook for student', '2001', '125', 'Rawdon Wyatt', 'Peter Collin Publishing Ltd', 'Vocabulary Book', 'Z6T1691030708.jpg', 'b5i_book_file_1691030708.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:45:08', '2023-08-03 09:45:08', NULL),
(34, 33, 'Grammar and Vocabulary for Cambridge Advanced and Proficiency', NULL, '1999', '288', 'Richard Side, Guy Wellman', 'Pearson Education Limited', 'Grammar Book', 'Q6W1691031014.png', 'u7E_book_file_1691031015.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:50:15', '2023-08-03 09:50:15', NULL),
(35, 34, 'Grammar Practice for Upper Intermediate Students', NULL, '1988', '209', 'Elaine Walker and Steve Elsworth', 'Longman', 'Grammar Book', '37v1691048229.png', 'P02_book_file_1691048229.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 14:37:09', '2023-08-03 14:37:09', NULL),
(36, 35, 'Longman English Grammar Practice Intermediate_Self- Study Ed', NULL, '1990', '296', 'L.G Alexander', 'Longman Group UK Limited', 'Grammar Book', 'AQU1691048446.png', 'Yws_book_file_1691048446.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 14:40:46', '2023-08-03 14:40:46', NULL),
(37, 36, 'MacMillan-FCE.Language.Practice.With.Key (M.Vince)', NULL, '2003', '351', 'Michael Vince with Paul Emmerson', 'Macmillan Education', 'Grammar Book', '4aU1691049464.png', '9kf_book_file_1691049464.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 14:57:44', '2023-08-03 14:57:44', NULL),
(38, 37, 'New Grammar Practice (Pre-intermediate with key)', NULL, '2000', '174', 'E. Walker, S. Elsworth', 'Longman Group UK Limited', 'Grammar Book', 'ttC1691113114.png', '2MN_book_file_1691113114.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 08:38:34', '2023-08-04 08:38:34', NULL),
(39, 38, 'Oxford - Basic English Usage', NULL, '1984', '288', 'Michael Swan', 'Oxford University Press (Maker)', 'Grammar Book', 'wei1691132741.png', 'h3g_book_file_1691132741.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:05:41', '2023-08-04 14:05:41', NULL),
(40, 39, 'The A-Z of Correct English_Common Errors in English', 'The A-Z of Correct English', '2002', '203', 'Angela Burt', 'British Library Cataloguing', 'Reference', 'U3B1691132873.png', 'XaC_book_file_1691132873.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:07:53', '2023-08-04 14:07:53', NULL),
(41, 40, 'Penguin Dictionary of American English Usage and Style', NULL, '2002', '491', 'Paul W.Lovinger', 'Penguin Reference', 'Grammar Book', 'BJx1691133120.png', 'oqq_book_file_1691133121.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:12:01', '2023-08-04 14:12:01', NULL),
(42, 41, 'Really Learn 100 Phrasal Verbs', NULL, '2002', '128', 'Dilys Parkinson', 'Oxford University Press (Maker)', 'Grammar Book', '2az1691135511.png', 'kBV_book_file_1691135511.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:51:51', '2023-08-04 14:51:51', NULL),
(43, 42, 'Cambridge University Press Cambridge Certificate In Advanced English Teachers Book - 4', 'Certificate In Advanced English 4', '1999', '88', 'University of Cambridge Local Examination Syndicate', 'Cambridge University Press', 'Reference', 'WrT1691135688.png', 'YC7_book_file_1691135688.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:54:48', '2023-08-04 14:54:48', NULL),
(44, 43, 'Cambridge University Press Cambridge Certificate Of Profeciency English - 1', 'Certificate In Advanced English 1', '2001', '184', 'University of Cambridge Local Examination Syndicate', 'Cambridge University Press', 'Reference', 'Zv21691135812.png', 'bAE_book_file_1691135812.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:56:52', '2023-08-04 14:56:52', NULL),
(45, 44, 'Cambridge University Press Discussions A-Z Advanced', 'Discussions A-Z Advanced, A resource book of speaking activities', '1997', '113', 'Adrian Wallwork', 'Cambridge University Press', 'Speaking Book', 'LJR1691136106.png', 't1M_book_file_1691136107.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:01:47', '2023-08-04 15:01:47', NULL),
(46, 45, 'Dictionary Cambridge English Grammar - Check Your Vocabulary for IELTS', 'IELTS Workbook', '2001', '125', 'Rawdon Wyatt', 'Peter Collin Publishing Ltd', 'Excersie Practice', 'qnD1691136297.png', 'rQj_book_file_1691136297.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:04:58', '2023-08-04 15:04:58', NULL),
(47, 46, 'McGraw-Hill\'s.Dictionary.of.American.Idioms.and.Phrasal.Verbs.ShareVirus', 'Dictionary.of.American.Idioms.and.Phrasal.Verbs', '2005', '1098', 'Richard A. Spears, Ph.D.', 'The McGraw-Hill Companies, Inc.', 'Reference', '3mV1691136512.png', 'Lvx_book_file_1691136512.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:08:32', '2023-08-04 15:08:32', NULL),
(48, 47, 'NTC\'s American Idioms Dictionary', 'The Most Practical Reference for\r\nthe Everyday Expressions of\r\nContemporary American English', '1976', '641', 'Richard A. Spears, Ph.D.', 'The McGraw-Hill Companies, Inc.', 'Reference', 'uQv1691136615.png', 'bTt_book_file_1691136615.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:10:15', '2023-08-04 15:10:15', NULL),
(49, 48, 'When Bad Grammar Happens to Good People', 'How to avoid common errors in English', '2004', '256', 'Ann Batko', 'Book-mart Press', 'Grammar Book', 'rNy1691137754.png', 'JWy_book_file_1691137754.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:29:14', '2023-08-04 15:29:14', NULL),
(50, 49, '1000 Quick Writing Ideas', NULL, '2000', '46', 'Stevan Krajnjan', 'Timesavers for Teachers', 'Writing Book', 'BF01691138511.png', 'kCD_book_file_1691138511.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:41:51', '2023-08-04 15:41:51', NULL),
(51, 50, 'Associate Press Sports Writing Handbook', NULL, '2002', '209', 'Steve Welistein', 'The McGraw-Hill Companies, Inc.', 'Writing Book', '6Mi1691138718.png', '9D7_book_file_1691138718.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:45:18', '2023-08-04 15:45:18', NULL),
(52, 51, 'Better Writing Right Now', 'Using words to your advantage', '2001', '239', 'Francine.Galko', 'LearningExpress, LLC.', 'Writing Book', 'Sfh1691139992.png', 'IFW_book_file_1691139992.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:06:32', '2023-08-04 16:06:32', NULL),
(53, 52, 'Email English by Paul Emmerson', 'Includes phrase bank of useful expressions', '2003', '97', 'Michael Vince with Paul Emmerson', 'Macmillan Education', 'Writing Book', '4UG1691140188.png', 'Vfp_book_file_1691140188.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:09:48', '2023-08-04 16:09:48', NULL),
(54, 53, 'Handwriting Success Secrets', NULL, '2002', '159', 'BART A. BAGGETT', 'BART A. BAGGETT', 'Writing Book', 'xbP1691141634.png', 'aGk_book_file_1691141635.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:33:55', '2023-08-04 16:33:55', NULL),
(55, 54, 'SAT Writing Essentials', NULL, '2006', '170', 'Lauren Starkey', 'LearningExpress, LLC.', 'Writing Book', 'C1D1691141764.png', 'W0G_book_file_1691141764.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:36:04', '2023-08-04 16:36:04', NULL),
(56, 55, 'American Accent Training', 'A Guide to Speaking and Pronouncing American English for Everyone Who Speaks English as a Second Language', '2000', '185', 'Ann Cook', 'Barrons', 'Speaking Book', 'GXB1691143985.jpg', 'z0L_book_file_1691143985.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 17:13:05', '2023-08-04 17:13:05', NULL),
(57, 56, 'Impact Issues', '30 key issues to help you express yourself in English', '2002', '60', 'Richard R. Day, Junko Yamanaka', 'Pearson Ed Asia', 'Speaking Book', '4Yq1691146903.jpg', 'vr9_book_file_1691146904.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:01:44', '2023-08-04 18:01:44', NULL),
(58, 57, 'Impact Topics', '30 exciting topics to talk about in English', '1999', '79', 'Richard R. Day, Junko Yamanaka', 'Pearson Education ESL', 'Speaking Book', 'TzK1691147020.jpg', 'rfj_book_file_1691147020.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:03:40', '2023-08-04 18:03:41', NULL),
(59, 58, 'Speak English like an American', 'Learn the idiom & expressions that will help you speak like a native!', '2004', '175', 'Amy Gillett', 'Language Success Press', 'Speaking Book', 'kzK1691147148.jpg', 'Pgi_book_file_1691147148.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:05:48', '2023-08-04 18:05:48', NULL),
(60, 59, 'The Craft of Writing Science Fiction', NULL, '1994', '141', 'Ben Bova', 'Ben Bova', 'Writing Book', 'NGh1691147449.jpg', 'TdK_book_file_1691147449.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:10:49', '2023-08-04 18:10:49', NULL),
(61, 60, 'On Writing', NULL, '2000', '278', 'Stephen King', 'Stephen King', 'Writing Book', 'unk1691147547.jpg', '26i_book_file_1691147547.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:12:27', '2023-08-04 18:12:27', NULL),
(62, 61, 'BR Begin-Stu', 'Business Result Starter Student\'s Book', '2014', '81', 'John Hughes', 'Oxford University Press (Maker)', 'Business Book', 'cn41691147651.jpg', 'ojQ_book_file_1691147651.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:14:11', '2023-08-04 18:14:11', NULL),
(63, 62, 'Amacom The AMA Handbook of Business Letters', NULL, '2002', '537', 'Seglin, Jeffrey L', 'Seglin, Jeffrey L', 'Business Book', 'XZ91691147838.png', 'RTl_book_file_1691147838.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:17:18', '2023-08-04 18:17:18', NULL),
(64, 63, 'Delta-E-mailing', NULL, '2004', '66', 'Louise Pile', 'Cengage Learning', 'Business Book', 'lAI1691148435.png', '71q_book_file_1691148435.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:27:15', '2023-08-04 18:27:15', NULL),
(65, 64, 'Delta-Meeting', NULL, '2008', '66', 'David King', 'Cengage Learning', 'Business Book', 'BMf1691148559.png', 'SNA_book_file_1691148559.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:29:19', '2023-08-04 18:29:19', NULL),
(66, 65, 'Delta-Negotiating', NULL, '2007', '66', 'Susan Lowe and Louise Pile', 'Cengage Learning', 'Business Book', '49i1691148685.png', '52v_book_file_1691148685.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:31:25', '2023-08-04 18:31:25', NULL),
(67, 66, 'Delta-Telephoning', NULL, '2004', '66', 'Susan Lowe and Louise Pile', 'Cengage Learning', 'Business Book', '6mO1691148826.png', 'RnD_book_file_1691148827.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:33:47', '2023-08-04 18:33:47', NULL),
(68, 67, 'Delta-Socializing', NULL, '2005', '67', 'David King', 'Cengage Learning', 'Business Book', 't0g1691148909.png', 'AFQ_book_file_1691148909.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:35:09', '2023-08-04 18:35:09', NULL),
(69, 68, 'ML Advanced-Stu', NULL, '2011', '186', 'Iwonna Dubicka Margaret O\'keeffe', 'Financial Times', 'Business Book', 'r001691149184.png', 'K7T_book_file_1691149184.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:39:44', '2023-08-04 18:39:44', NULL),
(70, 69, 'Aspatore Publishing The Business Translator', NULL, '2002', '600', 'Dawn Montague', 'Aspatore', 'Business Book', 'HkG1691149373.png', 'Ytw_book_file_1691149373.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:42:53', '2023-08-04 18:42:53', NULL),
(71, 70, 'Business Vocabulary in Use (2002)', NULL, '2002', '173', 'Bill Mascull', 'G.Canale & C.', 'Business Book', 'M6A1691149494.png', 'JSd_book_file_1691149494.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:44:54', '2023-08-04 18:44:54', NULL),
(72, 71, 'Cambridge University Press - English For Business Communication', NULL, '2003', '91', 'Simon Sweeney', '‎Cambridge University Press', 'Business Book', 'Fmg1691149598.png', 'nng_book_file_1691149598.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:46:38', '2023-08-04 18:46:38', NULL),
(73, 72, 'Business Vocab in Use Advance', NULL, '2002', '128', 'Bill Mascull', '‎Cambridge University Press', 'Business Book', 'jks1691149914.png', 'Sjs_book_file_1691149914.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:51:54', '2023-08-04 18:51:54', NULL),
(74, 73, 'Business Vocab in Use Elementary', NULL, '2006', '105', 'Bill Mascull', '‎Cambridge University Press', 'Business Book', 'U4c1691150124.png', 'Jc8_book_file_1691150124.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:55:24', '2023-08-04 18:55:24', NULL),
(75, 74, '85 Inspiring Ways to Market Your Small Business', '85 Inspiring Ways to Market Your Small Business_ Inspiring, Self-help, Sales and Marketing Strategies That You Can Apply to Your Own Business Immediately', '2009', '257', 'Jackie Jarvis', 'British Library Cataloguing', 'Business Book', 'VTn1691150316.png', 'yD2_book_file_1691150316.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 18:58:36', '2023-08-04 18:58:36', NULL),
(76, 75, '101 Ways to Market Your Business', NULL, '2006', '271', 'ALLEN & UNWIN', 'Andrew Griffiths', 'Business Book', 'adX1691150430.png', 'IvX_book_file_1691150430.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 19:00:30', '2023-08-04 19:00:30', NULL),
(77, 76, 'In Company Logistics-Student\'s book', NULL, '2017', '66', 'John Allison', 'Macmillan Education', 'Business Book', 'D121691150741.png', 'eEZ_book_file_1691150741.pdf', 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 19:05:41', '2023-08-04 19:05:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grammar Book', 1, 0, 2, NULL, NULL, '2023-08-02 01:56:21', NULL, NULL),
(2, 'Grammar Exercise', 1, 0, 2, NULL, NULL, '2023-08-02 01:56:33', NULL, NULL),
(3, 'Business Book', 1, 0, 45, NULL, NULL, '2023-08-02 02:05:47', NULL, NULL),
(4, 'Reference', 1, 0, 45, NULL, NULL, '2023-08-03 01:41:18', NULL, NULL),
(5, 'Excersie Practice', 1, 0, 45, NULL, NULL, '2023-08-03 01:47:43', NULL, NULL),
(6, 'Vocabulary Book', 1, 0, 45, NULL, NULL, '2023-08-03 02:10:54', NULL, NULL),
(7, 'Speaking Book', 1, 0, 45, NULL, NULL, '2023-08-04 07:04:26', NULL, NULL),
(8, 'Excersie Practice', 0, 0, 45, 45, NULL, '2023-08-04 07:04:39', '2023-08-04 08:03:49', NULL),
(9, 'Writing Book', 1, 0, 45, NULL, NULL, '2023-08-04 08:26:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre_hostories`
--

CREATE TABLE `genre_hostories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_hostories`
--

INSERT INTO `genre_hostories` (`id`, `name`, `genre_id`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grammar Book', 1, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:56:21', NULL, NULL),
(2, 'Grammar Exercise', 2, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:56:33', NULL, NULL),
(3, 'Business Book', 3, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 09:05:47', NULL, NULL),
(4, 'Reference', 4, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 08:41:18', NULL, NULL),
(5, 'Excersie Practice', 5, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 08:47:43', NULL, NULL),
(6, 'Vocabulary Book', 6, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-03 09:10:54', NULL, NULL),
(7, 'Speaking Book', 7, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:04:26', NULL, NULL),
(8, 'Excersie Practice', 8, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 14:04:39', NULL, NULL),
(9, 'Excersie Practice', 8, 1, 0, NULL, 'Sao Panha', NULL, NULL, '2023-08-04 15:03:43', NULL),
(10, 'Excersie Practice', 8, 0, 0, NULL, 'Sao Panha', NULL, NULL, '2023-08-04 15:03:49', NULL),
(11, 'Writing Book', 9, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:26:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optView` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optCreate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optShow` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optEdit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optDelete` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `header`, `name`, `optView`, `optCreate`, `optShow`, `optEdit`, `optDelete`) VALUES
(1, 'Permission', 'Role', 'View', 'Create', 'Show', 'Edit', 'Delete'),
(2, 'Permission', 'User', 'View', 'Create', 'Show', 'Edit', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_02_132737_create_labels_table', 1),
(6, '2022_05_02_132920_create_roles_table', 1),
(7, '2022_05_02_133125_create_permissions_table', 1),
(8, '2022_05_03_141819_create_theme_settings_table', 1),
(9, '2022_05_26_015457_create_user_histories_table', 1),
(10, '2023_06_14_040344_create_todos_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `optView` tinyint(1) NOT NULL DEFAULT '0',
  `optCreate` tinyint(1) NOT NULL DEFAULT '0',
  `optShow` tinyint(1) NOT NULL DEFAULT '0',
  `optEdit` tinyint(1) NOT NULL DEFAULT '0',
  `optDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `header`, `name`, `role_id`, `optView`, `optCreate`, `optShow`, `optEdit`, `optDelete`) VALUES
(1, 'Permission', 'Role', 1, 1, 1, 1, 1, 1),
(2, 'Permission', 'User', 1, 1, 1, 1, 1, 1),
(3, 'Permission', '0_Role', 2, 0, 0, 0, 0, 0),
(4, 'Permission', 'User', 2, 1, 1, 1, 1, 1),
(5, 'Permission', 'Role', 3, 1, 1, 1, 1, 1),
(6, 'Permission', '0_User', 3, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'token', 'e098bf43aaabee44e516d07a44b63ba81a532d8abab0720cd5d1b259b728aaac', '[\"*\"]', NULL, '2023-07-06 00:38:14', '2023-07-06 00:38:14'),
(2, 'App\\Models\\User', 1, 'token', 'c627727fdb455f5c5171a71aac6ff7d070ae2deea1dd775a56608e56b44a3a9f', '[\"*\"]', NULL, '2023-07-06 00:41:00', '2023-07-06 00:41:00'),
(3, 'App\\Models\\User', 1, 'token', '753c9fffda8afbe775252fc54d7eea01e010025cb52f921e173994213e945777', '[\"*\"]', NULL, '2023-07-06 00:51:52', '2023-07-06 00:51:52'),
(4, 'App\\Models\\User', 1, 'token', '29085930a6664b2888126d2efa4e6fc34858e1e6978d0956a2dcd3fc17dbe7c7', '[\"*\"]', NULL, '2023-07-06 01:06:50', '2023-07-06 01:06:50'),
(5, 'App\\Models\\User', 1, 'token', '7b8566d232bb3226988ccd7ea898f1255c749fa98cfb6a9c9a4e51dfe76edd3f', '[\"*\"]', NULL, '2023-07-06 01:16:55', '2023-07-06 01:16:55'),
(6, 'App\\Models\\User', 1, 'token', '7a5b50c7ce1dafbe7b5ec182d67ac99e2bddc153c978f709b2aeb79d58ba72bf', '[\"*\"]', NULL, '2023-07-06 03:16:10', '2023-07-06 03:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Saddleback Educational Publishing', 1, 0, 2, NULL, NULL, '2023-08-02 01:55:55', NULL, NULL),
(2, 'Thomas Nelson and Sons', 1, 0, 2, NULL, NULL, '2023-08-02 01:56:05', NULL, NULL),
(3, 'Oxford University Press (Maker)', 1, 0, 45, NULL, NULL, '2023-08-02 02:05:25', NULL, NULL),
(4, 'Anthony Hughes', 1, 0, 58, NULL, NULL, '2023-08-02 02:44:31', NULL, NULL),
(5, '‎Cambridge University Press', 1, 0, 45, 45, NULL, '2023-08-02 07:39:04', '2023-08-04 09:58:39', NULL),
(6, 'Marie Butler-Knight', 1, 0, 45, NULL, NULL, '2023-08-02 07:41:38', NULL, NULL),
(7, 'E. Walker, S. Elsworth', 1, 0, 45, NULL, NULL, '2023-08-02 07:41:51', NULL, NULL),
(8, 'Jossey-Bass', 1, 0, 45, NULL, NULL, '2023-08-02 07:42:05', NULL, NULL),
(9, 'The McGraw-Hill Companies, Inc.', 1, 0, 45, NULL, NULL, '2023-08-02 07:42:25', NULL, NULL),
(10, 'Wiley Publishing, Inc.', 1, 0, 45, NULL, NULL, '2023-08-02 07:42:43', NULL, NULL),
(11, 'Amsco School Publications, Inc.', 1, 0, 45, NULL, NULL, '2023-08-02 07:43:01', NULL, NULL),
(12, 'Brain Friendly Publications', 1, 0, 45, NULL, NULL, '2023-08-02 09:18:52', NULL, NULL),
(13, 'Peter Collin Publishing Ltd', 1, 0, 45, NULL, NULL, '2023-08-02 09:19:29', NULL, NULL),
(14, 'Pearson Education Limited', 1, 0, 45, NULL, NULL, '2023-08-02 09:19:52', NULL, NULL),
(15, 'Longman', 1, 0, 45, NULL, NULL, '2023-08-02 09:20:01', NULL, NULL),
(16, 'Longman Group UK Limited', 1, 0, 45, NULL, NULL, '2023-08-02 09:20:28', NULL, NULL),
(17, 'Macmillan Education', 1, 0, 45, NULL, NULL, '2023-08-02 09:20:42', NULL, NULL),
(18, 'Penguin Reference', 1, 0, 45, NULL, NULL, '2023-08-04 06:59:01', NULL, NULL),
(19, 'British Library Cataloguing', 1, 0, 45, NULL, NULL, '2023-08-04 06:59:34', NULL, NULL),
(20, 'Book-mart Press', 1, 0, 45, NULL, NULL, '2023-08-04 08:20:41', NULL, NULL),
(21, 'Sherrise Roehr', 1, 0, 45, NULL, NULL, '2023-08-04 08:24:17', NULL, NULL),
(22, 'LearningExpress, LLC.', 1, 0, 45, NULL, NULL, '2023-08-04 08:24:37', NULL, NULL),
(23, 'Timesavers for Teachers', 1, 0, 45, NULL, NULL, '2023-08-04 08:33:05', NULL, NULL),
(24, 'BART A. BAGGETT', 1, 0, 45, NULL, NULL, '2023-08-04 09:29:28', NULL, NULL),
(25, 'Barrons', 1, 0, 45, NULL, NULL, '2023-08-04 09:50:12', NULL, NULL),
(26, 'Pearson Ed Asia', 1, 0, 45, NULL, NULL, '2023-08-04 09:50:46', NULL, NULL),
(27, 'Pearson Education ESL', 1, 0, 45, NULL, NULL, '2023-08-04 09:51:18', NULL, NULL),
(28, 'Language Success Press', 1, 0, 45, NULL, NULL, '2023-08-04 09:51:32', NULL, NULL),
(29, 'Ben Bova', 1, 0, 45, NULL, NULL, '2023-08-04 09:52:30', NULL, NULL),
(30, 'Stephen King', 1, 0, 45, NULL, NULL, '2023-08-04 09:52:43', NULL, NULL),
(31, 'Seglin, Jeffrey L', 1, 0, 45, NULL, NULL, '2023-08-04 09:53:59', NULL, NULL),
(32, 'Cengage Learning', 1, 0, 45, NULL, NULL, '2023-08-04 09:54:09', NULL, NULL),
(33, 'Financial Times', 1, 0, 45, NULL, NULL, '2023-08-04 09:54:43', NULL, NULL),
(34, 'Aspatore', 1, 0, 45, NULL, NULL, '2023-08-04 09:55:00', NULL, NULL),
(35, 'G.Canale & C.', 1, 0, 45, NULL, NULL, '2023-08-04 09:56:28', NULL, NULL),
(36, 'Andrew Griffiths', 1, 0, 45, NULL, NULL, '2023-08-04 09:59:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publisher_hostories`
--

CREATE TABLE `publisher_hostories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publisher_hostories`
--

INSERT INTO `publisher_hostories` (`id`, `name`, `publisher_id`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Saddleback Educational Publishing', 1, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:55:55', NULL, NULL),
(2, 'Thomas Nelson and Sons', 2, 1, 0, 'Mean Vatanak', NULL, NULL, '2023-08-02 08:56:05', NULL, NULL),
(3, 'Oxford University Press (Maker)', 3, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 09:05:25', NULL, NULL),
(4, 'Anthony Hughes', 4, 1, 0, 'Yan Namrong', NULL, NULL, '2023-08-02 09:44:31', NULL, NULL),
(5, 'Cambridge University Press', 5, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:39:04', NULL, NULL),
(6, 'Marie Butler-Knight', 6, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:41:38', NULL, NULL),
(7, 'E. Walker, S. Elsworth', 7, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:41:51', NULL, NULL),
(8, 'Jossey-Bass', 8, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:42:05', NULL, NULL),
(9, 'The McGraw-Hill Companies, Inc.', 9, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:42:25', NULL, NULL),
(10, 'Wiley Publishing, Inc.', 10, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:42:43', NULL, NULL),
(11, 'Amsco School Publications, Inc.', 11, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 14:43:01', NULL, NULL),
(12, 'Brain Friendly Publications', 12, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:18:52', NULL, NULL),
(13, 'Peter Collin Publishing Ltd', 13, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:19:29', NULL, NULL),
(14, 'Pearson Education Limited', 14, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:19:52', NULL, NULL),
(15, 'Longman', 15, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:20:01', NULL, NULL),
(16, 'Longman Group UK Limited', 16, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:20:28', NULL, NULL),
(17, 'Macmillan Education', 17, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-02 16:20:42', NULL, NULL),
(18, 'Penguin Reference', 18, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:59:01', NULL, NULL),
(19, 'British Library Cataloguing', 19, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 13:59:34', NULL, NULL),
(20, 'Book-mart Press', 20, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:20:41', NULL, NULL),
(21, 'Sherrise Roehr', 21, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:24:17', NULL, NULL),
(22, 'LearningExpress, LLC.', 22, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:24:37', NULL, NULL),
(23, 'Timesavers for Teachers', 23, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 15:33:05', NULL, NULL),
(24, 'BART A. BAGGETT', 24, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:29:28', NULL, NULL),
(25, 'Barrons', 25, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:50:12', NULL, NULL),
(26, 'Pearson Ed Asia', 26, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:50:46', NULL, NULL),
(27, 'Pearson Education ESL', 27, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:51:18', NULL, NULL),
(28, 'Language Success Press', 28, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:51:32', NULL, NULL),
(29, 'Ben Bova', 29, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:52:30', NULL, NULL),
(30, 'Stephen King', 30, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:52:43', NULL, NULL),
(31, 'Seglin, Jeffrey L', 31, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:53:59', NULL, NULL),
(32, 'Cengage Learning', 32, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:54:09', NULL, NULL),
(33, 'Financial Times', 33, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:54:43', NULL, NULL),
(34, 'Aspatore', 34, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:55:00', NULL, NULL),
(35, 'G.Canale & C.', 35, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:56:28', NULL, NULL),
(36, '‎Cambridge University Press', 5, 1, 0, NULL, 'Sao Panha', NULL, NULL, '2023-08-04 16:58:39', NULL),
(37, 'Andrew Griffiths', 36, 1, 0, 'Sao Panha', NULL, NULL, '2023-08-04 16:59:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `remark`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super_Admin', NULL, 1, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Admin', NULL, 1, 0, 1, 1, NULL, '2023-06-16 21:48:42', '2023-06-16 22:21:04', NULL),
(3, 'Admin 1', NULL, 1, 0, 1, NULL, NULL, '2023-06-16 22:21:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `user_id`, `theme`, `compact`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'default', 'fixed', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:pending, 1:completed',
  `delete_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:active, 1:deleted',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `name`, `due_date`, `description`, `user_id`, `status`, `delete_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Quam debitis voluptatem vel ab.', '2023-06-21', 'Ea nihil recusandae et est reprehenderit aut laborum pariatur nisi ad aperiam.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Fuga adipisci ex.', '2023-07-03', 'Neque saepe nisi voluptatem facere vero ullam quibusdam consectetur labore dicta maiores velit.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(3, 'Voluptatem mollitia laborum numquam.', '2023-07-12', 'Et doloribus ut vero neque possimus quia numquam.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(4, 'Debitis similique omnis officiis.', '2023-06-26', 'Vero fugit ea et error facere id ratione quia et.', 1, 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(5, 'Quis quo error perspiciatis.', '2023-06-15', 'Et expedita ea et quae aperiam et officia non quis quia vero.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(6, 'Doloribus magni voluptas officia.', '2023-06-27', 'Aut veritatis nihil dolore maxime ipsa eveniet rerum voluptatem.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(7, 'Numquam commodi vitae eum assumenda.', '2023-06-27', 'Quidem quia expedita rerum magnam sequi et.', 1, 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(8, 'Aperiam sed eum.', '2023-07-03', 'Blanditiis alias dolorem incidunt vel et in aut nesciunt aut odit.', 1, 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(9, 'Hic totam soluta at.', '2023-07-14', 'Omnis omnis est quis ad exercitationem deserunt impedit corrupti et et.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(10, 'Rerum aut.', '2023-07-01', 'Doloribus quae dolor eligendi saepe quo magnam rerum consequatur.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(11, 'Illo consequuntur nam voluptas.', '2023-07-05', 'Alias ut enim reiciendis omnis dolor odit.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(12, 'Facilis sit eum.', '2023-06-19', 'Error officiis in quod ad voluptas sunt ducimus in ut.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(13, 'Esse consequatur aut accusamus.', '2023-06-18', 'Et placeat omnis dicta ab dolor facere et numquam in ea non voluptatem in.', 1, 1, 0, 1, 1, NULL, NULL, NULL, NULL),
(14, 'Quia maiores est.', '2023-06-23', 'Neque qui iste corporis sed aut accusamus accusamus occaecati possimus in.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(15, 'Sit quia qui est.', '2023-07-09', 'Eveniet odit ipsa odit eaque debitis voluptatum dolores laborum qui exercitationem quis non ipsum.', 1, 0, 0, 1, 1, NULL, NULL, NULL, NULL),
(16, 'Mean Vatanak', '2023-06-17', 'test', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Projector Screen', '2023-06-30', 'test', 1, 0, 0, NULL, NULL, NULL, '2023-06-16 05:31:10', '2023-06-16 05:31:10', NULL),
(18, 'Project Project', '2023-06-29', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-06-16 21:32:26', '2023-06-16 21:32:26', NULL),
(19, 'Mean Vatanak', '2023-06-30', 'test', 1, 0, 0, NULL, NULL, NULL, '2023-06-16 21:43:10', '2023-06-16 21:43:10', NULL),
(21, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:08:56', '2023-07-06 01:08:56', NULL),
(22, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:12:43', '2023-07-06 01:12:43', NULL),
(23, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:12:50', '2023-07-06 01:12:50', NULL),
(24, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:12:55', '2023-07-06 01:12:55', NULL),
(25, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:13:04', '2023-07-06 01:13:04', NULL),
(26, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:13:11', '2023-07-06 01:13:11', NULL),
(27, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:13:42', '2023-07-06 01:13:42', NULL),
(28, 'Project', '2023-10-07', NULL, 1, 0, 0, NULL, NULL, NULL, '2023-07-06 01:14:11', '2023-07-06 01:14:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role_id` int(11) NOT NULL,
  `theme_id` tinyint(1) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `delete_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `gender`, `image`, `email`, `verified_at`, `token`, `name`, `address`, `role_id`, `theme_id`, `status`, `delete_status`, `created_at`, `created_id`, `updated_at`, `updated_id`, `deleted_at`, `deleted_id`) VALUES
(1, 'admin', '$2y$10$Ir9pPSNROOaKTIvU0rNBQ.MwHFAqwHZdjQlWbMM.BRBZDAL7rEZxi', '010300667', '', '', 'ict@camasean.edu.kh', NULL, '6|YFeqRmflU4YFVtoZ7WyTbTUhFjtWTtNuMROeihty', 'Mean Vatanak', '1', 1, 1, 1, 0, NULL, NULL, '2023-07-06 03:16:10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_histories`
--
ALTER TABLE `author_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_libraries`
--
ALTER TABLE `e_libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_library_histories`
--
ALTER TABLE `e_library_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_hostories`
--
ALTER TABLE `genre_hostories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_role_id_unique` (`name`,`role_id`);

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
-- Indexes for table `publisher_hostories`
--
ALTER TABLE `publisher_hostories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `author_histories`
--
ALTER TABLE `author_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `e_libraries`
--
ALTER TABLE `e_libraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `e_library_histories`
--
ALTER TABLE `e_library_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genre_hostories`
--
ALTER TABLE `genre_hostories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `publisher_hostories`
--
ALTER TABLE `publisher_hostories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
