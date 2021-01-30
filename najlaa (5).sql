-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2021 at 05:42 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `najlaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `fullname`, `street_address`, `building_no`, `city_id`, `user_id`, `area`, `phone`, `lat`, `lng`, `active`, `created_at`, `updated_at`) VALUES
(7, 'new address', 'hfhfhffh', '858555', 1, 17, 'gfjjcjh', '01000709271', NULL, NULL, 0, '2020-12-17 02:16:38', '2020-12-17 02:20:49'),
(8, 'Gigi', 'fufuffhch', '55558585', 1, 17, 'finch', '01000709271', NULL, NULL, 1, '2020-12-17 02:20:49', '2020-12-17 02:20:49'),
(20, 'xhhcxhhcgchc', 'ffffff', '55555', 1, 20, 'ghhhhhh', '888555555', NULL, NULL, 1, '2020-12-21 03:43:34', '2020-12-21 03:43:34'),
(24, 'd', 'did', 'w', 2, 23, 'd', 'd', NULL, NULL, 0, '2021-01-07 01:36:41', '2021-01-07 01:37:11'),
(25, 'eee', 'eee', '3', 1, 23, 'ff', '55555', NULL, NULL, 0, '2021-01-07 01:37:11', '2021-01-07 03:39:31'),
(26, 'd', 's', '2', 2, 23, '2', '2', NULL, NULL, 0, '2021-01-07 03:39:31', '2021-01-07 04:06:59'),
(28, 'w', 'w', 'w', 1, 23, '3', '3', NULL, NULL, 0, '2021-01-07 06:11:31', '2021-01-07 07:23:22'),
(29, 'sss', 'we', '2', 3, 23, '2', '22222222', NULL, NULL, 0, '2021-01-07 07:23:22', '2021-01-07 07:42:05'),
(30, 'rrr', 'rr', 'r', 1, 23, 'rr', 'ff', NULL, NULL, 1, '2021-01-07 07:42:05', '2021-01-07 07:42:05'),
(31, 'Mohamed', 'alzaitoon', '50', 1, 25, 'hhhhh', '66497607', NULL, NULL, 0, '2021-01-09 16:45:36', '2021-01-09 16:50:07'),
(32, 'jjhhh', 'ujgh', '955', 1, 25, 'jhh', '53', NULL, NULL, 0, '2021-01-09 16:50:07', '2021-01-27 16:18:20'),
(33, 'Mohamed', 'aa', '58', 1, 25, 'jjjhh', '12345678', NULL, NULL, 1, '2021-01-27 16:18:20', '2021-01-27 16:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `count` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `token`, `user_id`, `count`, `price`, `color_id`, `size_id`, `product_id`, `created_at`, `updated_at`) VALUES
(52, 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', NULL, '1', '500', 3, 2, 1, '2020-12-17 01:12:24', '2020-12-17 01:12:24'),
(57, 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', NULL, '6', '3000', 2, 1, 1, '2020-12-18 20:02:13', '2020-12-21 15:28:45'),
(93, NULL, 23, '1', '100', 2, 4, 3, '2021-01-17 00:00:19', '2021-01-17 00:00:19'),
(97, NULL, 23, '1', '450', 2, 1, 2, '2021-01-30 02:53:14', '2021-01-30 02:53:14'),
(98, NULL, 23, '1', '500', 2, 1, 1, '2021-01-30 03:10:03', '2021-01-30 03:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_page` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `parent_id`, `slug`, `home_page`, `active`, `created_at`, `updated_at`) VALUES
(1, 'أحذية‏', 'shoes', NULL, 'shoes', 1, 1, '2020-12-14 20:35:49', '2020-12-14 20:35:49'),
(2, 'جينز‏', 'jeans', NULL, 'jeans', 1, 1, '2020-12-14 20:37:24', '2020-12-14 20:37:24'),
(3, 'تي شيرت', 'T-Shitrt', NULL, 't-shitrt', 1, 1, '2020-12-14 20:40:47', '2020-12-14 20:40:47'),
(4, 'عبايا', 'Abaya', NULL, 'abaya', 1, 1, '2020-12-14 20:42:05', '2020-12-14 20:42:05'),
(5, 'عبايات سوارية', 'Soiree abayas', 4, 'soiree-abayas', 0, 1, '2020-12-14 20:45:10', '2020-12-14 20:45:10'),
(6, 'عبايات سادة', 'Plain Abayas', 4, 'plain-abayas', 0, 1, '2020-12-14 20:46:49', '2020-12-14 20:46:49'),
(7, 'جينز رجالي', 'Men\'s Jeans', 2, 'men-s-jeans', 0, 1, '2020-12-14 20:47:23', '2020-12-14 20:47:23'),
(8, 'جينز حريمي', 'Women Jeans', 2, 'women-jeans', 0, 1, '2020-12-14 20:47:43', '2020-12-14 20:47:43'),
(9, 'احذية رياضية', 'Sports Shoes', 1, 'sports-shoes', 0, 1, '2020-12-14 20:48:20', '2020-12-14 20:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `category_sliders`
--

CREATE TABLE `category_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_sliders`
--

INSERT INTO `category_sliders` (`id`, `title_ar`, `title_en`, `subtitle_ar`, `subtitle_en`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'اجدد الصيحات تجديها لدينا', 'The newest shouts', 'اجدد الصيحات تجديها لدينا', 'The newest shouts', 4, 1, '2020-12-14 22:21:48', '2020-12-14 22:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `chose_countries`
--

CREATE TABLE `chose_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chose_countries`
--

INSERT INTO `chose_countries` (`id`, `country_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 13, '2021-01-30 18:11:10', '2021-01-30 18:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `country_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'الدوحة', 'Doha', 1, 1, '2020-12-16 00:37:34', '2020-12-16 00:37:34'),
(2, 'الريان', 'Rayyan', 1, 1, '2020-12-16 00:38:17', '2020-12-16 00:38:17'),
(3, 'القاهرة', 'Cairo', 2, 1, '2020-12-17 12:59:32', '2020-12-17 12:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `name_ar`, `name_en`, `active`, `created_at`, `updated_at`) VALUES
(1, '#1560bd', 'ازرق', 'blue', 1, '2020-12-14 22:05:36', '2020-12-14 22:05:36'),
(2, '#000000', 'اسود', 'Black', 1, '2020-12-14 22:05:51', '2020-12-14 22:05:51'),
(3, '#e6a979', 'بيج', 'Beige', 1, '2020-12-14 22:08:44', '2020-12-14 22:08:44'),
(4, '#ffffff', 'ابيض', 'white', 1, '2020-12-16 04:48:33', '2020-12-16 04:48:33'),
(5, '#c10b0b', 'أحمر', 'Red', 1, '2021-01-27 16:03:52', '2021-01-27 16:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Essam', 'vghg@nbj.com', '01000706271', 'chubby', '2020-12-18 07:01:23', '2020-12-18 07:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `contact_orders`
--

CREATE TABLE `contact_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_ar`, `name_en`, `code`, `call_code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'قطر', 'QATAR', 'QAR', '+974', 1, '2020-12-14 19:22:15', '2021-01-30 17:55:46'),
(2, 'مصر', 'Egypt', 'EGP', '+20', 1, '2020-12-16 05:01:39', '2021-01-30 17:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `equal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name_ar`, `name_en`, `equal`, `code`, `active`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'ريال قطري', 'Riyal QATAR', NULL, 'QAR', 1, 1, '2020-12-14 19:22:15', '2020-12-14 19:22:15'),
(2, 'جنية مصري', 'EGP', NULL, 'EGP', 1, 2, '2020-12-16 05:02:34', '2020-12-16 05:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title_ar`, `title_en`, `body_ar`, `body_en`, `kind`, `created_at`, `updated_at`) VALUES
(1, 'التوصيل', 'Delivery', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 1, '2020-12-16 04:33:36', '2020-12-16 04:33:36'),
(2, 'الارجاع والمبالغ المستردة', 'Return and Refunds', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 1, '2020-12-16 04:34:09', '2020-12-16 04:34:09'),
(3, 'المنتج والمخزن', 'Product & Stock', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 1, '2020-12-16 04:34:31', '2020-12-16 04:34:31'),
(4, 'الدفع والعروض', 'Payment & Promos', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 1, '2020-12-16 04:34:54', '2020-12-16 04:34:54'),
(5, 'هل بإستطاعتي الغاء الطلب بعد اختيار العنوان ؟', 'Can I cancel my order after i\'ve place it?', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 2, '2020-12-16 04:35:21', '2020-12-16 04:35:21'),
(6, 'هل يمكنني تتبع توصيل طلبي؟', 'Can I track the delivery of my order?', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 2, '2020-12-16 04:35:40', '2020-12-16 04:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `imageable_id`, `imageable_type`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Category', '1607967349-shoes-banner.jpg', 'main', '2020-12-14 20:35:49', '2020-12-14 20:35:49'),
(2, 2, 'App\\Models\\Category', '1607967444-57f41cc356251c920c601f9c82f8b842.jpg', 'main', '2020-12-14 20:37:24', '2020-12-14 20:37:24'),
(3, 3, 'App\\Models\\Category', '1607967647-61TK-JKh15L._UL1262_.jpg', 'main', '2020-12-14 20:40:47', '2020-12-14 20:40:47'),
(4, 4, 'App\\Models\\Category', '1607967725-leilafr-scaled.jpg', 'main', '2020-12-14 20:42:05', '2020-12-14 20:42:05'),
(5, 1, 'App\\Models\\Slider', '1607973519-shoes-banner.jpg', 'main', '2020-12-14 22:18:39', '2020-12-14 22:18:39'),
(6, 2, 'App\\Models\\Slider', '1607973605-banner-2.png', 'main', '2020-12-14 22:20:05', '2020-12-14 22:20:05'),
(7, 1, 'App\\Models\\CategorySlider', '1607973708-banner-2.png', 'main', '2020-12-14 22:21:48', '2020-12-14 22:21:48'),
(9, 1, 'App\\Models\\Product', '1607973973-leilafr-scaled.jpg', 'main', '2020-12-14 22:26:13', '2020-12-14 22:26:13'),
(10, 1, 'App\\Models\\Product', '1607973973-9f93163acc564b3bb4cf78f898c71398.jpg', 'size', '2020-12-14 22:26:13', '2020-12-14 22:26:13'),
(11, 1, 'App\\Models\\Product', '1607973973--73d4848e4aab1572ad1d2144efe33923b2541956.jpg', 'sub', '2020-12-14 22:26:13', '2020-12-14 22:26:13'),
(12, 1, 'App\\Models\\Product', '1607973973--leilafr-scaled.jpg', 'sub', '2020-12-14 22:26:13', '2020-12-14 22:26:13'),
(13, 2, 'App\\Models\\Product', '1607974262-1-200x300.jpg', 'main', '2020-12-14 22:31:02', '2020-12-14 22:31:02'),
(14, 2, 'App\\Models\\Product', '1607974262-9f93163acc564b3bb4cf78f898c71398.jpg', 'size', '2020-12-14 22:31:02', '2020-12-14 22:31:02'),
(15, 2, 'App\\Models\\Product', '1607974262--1-200x300.jpg', 'sub', '2020-12-14 22:31:02', '2020-12-14 22:31:02'),
(16, 2, 'App\\Models\\Product', '1607974262--033001-0282-200x300.jpg', 'sub', '2020-12-14 22:31:02', '2020-12-14 22:31:02'),
(17, 2, 'App\\Models\\Product', '1607974262--leilafr-scaled.jpg', 'sub', '2020-12-14 22:31:02', '2020-12-14 22:31:02'),
(22, 4, 'App\\Models\\Product', '1607974607-download (4).jpg', 'main', '2020-12-14 22:36:47', '2020-12-14 22:36:47'),
(23, 4, 'App\\Models\\Product', '1607974607-size_chart_for_clothing_uk.jpg', 'size', '2020-12-14 22:36:47', '2020-12-14 22:36:47'),
(24, 4, 'App\\Models\\Product', '1607974607--1.jpg', 'sub', '2020-12-14 22:36:47', '2020-12-14 22:36:47'),
(25, 4, 'App\\Models\\Product', '1607974607--82.jpg', 'sub', '2020-12-14 22:36:47', '2020-12-14 22:36:47'),
(26, 4, 'App\\Models\\Product', '1607974607--download (4).jpg', 'sub', '2020-12-14 22:36:47', '2020-12-14 22:36:47'),
(27, 5, 'App\\Models\\Product', '1607974786-item_L_54891250_f88e4f53a24b2.jpg', 'main', '2020-12-14 22:39:46', '2020-12-14 22:39:46'),
(28, 5, 'App\\Models\\Product', '1607974786-size_chart_for_clothing_uk.jpg', 'size', '2020-12-14 22:39:46', '2020-12-14 22:39:46'),
(29, 5, 'App\\Models\\Product', '1607974786--415GkT-w+fL._AC_SY780_.jpg', 'sub', '2020-12-14 22:39:46', '2020-12-14 22:39:46'),
(30, 5, 'App\\Models\\Product', '1607974786--115356-large_default.jpg', 'sub', '2020-12-14 22:39:46', '2020-12-14 22:39:46'),
(31, 5, 'App\\Models\\Product', '1607974786--item_L_54891250_f88e4f53a24b2.jpg', 'sub', '2020-12-14 22:39:46', '2020-12-14 22:39:46'),
(33, 6, 'App\\Models\\Product', '1608083077-81U64AnQvkL._AC_UL1500_.jpg', 'main', '2020-12-16 04:44:37', '2020-12-16 04:44:37'),
(34, 6, 'App\\Models\\Product', '1608083077-9f93163acc564b3bb4cf78f898c71398.jpg', 'size', '2020-12-16 04:44:37', '2020-12-16 04:44:37'),
(35, 6, 'App\\Models\\Product', '1608083077--81U64AnQvkL._AC_UL1500_.jpg', 'sub', '2020-12-16 04:44:37', '2020-12-16 04:44:37'),
(36, 6, 'App\\Models\\Product', '1608083077--910zU0vyBrL._AC_UL1500_.jpg', 'sub', '2020-12-16 04:44:37', '2020-12-16 04:44:37'),
(43, 8, 'App\\Models\\Product', '1608083817-61fTX5TjAEL._UL1001_.jpg', 'main', '2020-12-16 04:56:57', '2020-12-16 04:56:57'),
(44, 8, 'App\\Models\\Product', '1608083817-9f93163acc564b3bb4cf78f898c71398.jpg', 'size', '2020-12-16 04:56:57', '2020-12-16 04:56:57'),
(46, 8, 'App\\Models\\Product', '1608083817--516dmtn2YcL._UX679_.jpg', 'sub', '2020-12-16 04:56:57', '2020-12-16 04:56:57'),
(48, 1, 'App\\Models\\Country', '1608084047-997c8f7439660ea40219911f52639830.jpg', 'main', '2020-12-16 05:00:47', '2020-12-16 05:00:47'),
(49, 2, 'App\\Models\\Country', '1608084099-eg.png', 'main', '2020-12-16 05:01:39', '2020-12-16 05:01:39'),
(50, 3, 'App\\Models\\CategorySlider', '1608202406-role (1).png', 'main', '2020-12-17 13:53:26', '2020-12-17 13:53:26'),
(52, 3, 'App\\Models\\Product', '1609850807-item_XXL_37057558_144724103.jpg', 'main', '2021-01-05 15:46:47', '2021-01-05 15:46:47'),
(53, 3, 'App\\Models\\Product', '1609850807-item_XXL_37057558_144724103.jpg', 'size', '2021-01-05 15:46:47', '2021-01-05 15:46:47'),
(54, 9, 'App\\Models\\Product', '1611753157-download.jpg', 'main', '2021-01-27 16:12:37', '2021-01-27 16:12:37'),
(55, 9, 'App\\Models\\Product', '1611753157-download.png', 'size', '2021-01-27 16:12:37', '2021-01-27 16:12:37'),
(56, 9, 'App\\Models\\Product', '1611753157--images (1).jpg', 'sub', '2021-01-27 16:12:37', '2021-01-27 16:12:37'),
(57, 9, 'App\\Models\\Product', '1611753157--images.jpg', 'sub', '2021-01-27 16:12:37', '2021-01-27 16:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name_ar`, `name_en`, `active`, `created_at`, `updated_at`) VALUES
(2, 'حرير', 'silk', 1, '2020-12-14 21:02:36', '2020-12-14 21:02:36'),
(3, 'مطاط', 'Rubber', 1, '2020-12-14 21:08:59', '2020-12-14 21:08:59'),
(4, 'جلد طبيعي', 'Genuine leather', 1, '2020-12-14 21:09:32', '2020-12-14 21:09:32'),
(5, 'قماش', 'Cloth', 1, '2020-12-16 04:48:57', '2020-12-16 04:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(114, '2020_10_26_173807_create_wishlist_storage_table', 1),
(324, '2014_10_12_000000_create_users_table', 2),
(325, '2014_10_12_100000_create_password_resets_table', 2),
(326, '2019_08_19_000000_create_failed_jobs_table', 2),
(327, '2020_09_023_083547_create_categories_table', 2),
(328, '2020_09_023_090601_create_pages_table', 2),
(329, '2020_09_23_202124_create_countries_table', 2),
(330, '2020_09_23_202143_create_cities_table', 2),
(331, '2020_09_23_202202_create_currencies_table', 2),
(332, '2020_09_23_202455_create_contacts_table', 2),
(333, '2020_09_23_202715_create_materials_table', 2),
(334, '2020_09_23_202738_create_colors_table', 2),
(335, '2020_09_23_202807_create_brands_table', 2),
(336, '2020_09_23_202859_create_sizes_table', 2),
(337, '2020_09_23_204224_create_products_table', 2),
(338, '2020_09_23_205127_create_product_details_table', 2),
(339, '2020_09_24_181315_create_moderators_table', 2),
(340, '2020_09_26_172032_create_images_table', 2),
(341, '2020_10_01_000213_create_options_table', 2),
(342, '2020_10_02_014927_create_addresses_table', 2),
(343, '2020_10_14_172521_adds_api_token_to_users_table', 2),
(344, '2020_10_18_205804_create_sliders_table', 2),
(345, '2020_10_19_143727_create_wish_lists_table', 2),
(347, '2020_11_07_164743_create_category_sliders_table', 2),
(348, '2020_11_07_185959_create_faqs_table', 2),
(349, '2020_11_20_110422_create_orders_table', 2),
(350, '2020_11_20_110423_create_pays_table', 2),
(351, '2020_12_01_215815_create_notifications_table', 2),
(352, '2020_12_05_002543_create_carts_table', 2),
(353, '2020_12_10_163751_create_contact_orders_table', 2),
(354, '2020_12_12_053057_create_token_users_table', 2),
(355, '2020_12_14_040324_create_recentlies_table', 2),
(356, '2021_01_30_200048_create_chose_countries_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$GFxomneGJn9Zc7Svgf24MOi7Mrcudx2sjE6XTCrv0ihSpsKWCLQde', 1, NULL, '2020-12-14 19:22:15', '2020-12-14 19:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('09a28f9a-3e39-4275-b3a7-9fd5960a8eda', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"DeveloperEssam\",\"email\":\"developer.essam2@gmail.com\",\"phone\":\"01000709270\",\"birth\":\"12-12-2020\",\"id\":18}}', NULL, '2020-12-17 12:43:02', '2020-12-17 12:43:02'),
('2086ab13-cd99-4a59-a1fa-3775b828eb62', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":361909843,\"status\":0,\"fullname\":\"s\",\"street_address\":\"s\",\"building_no\":\"s\",\"area\":\"s\",\"phone\":\"s\",\"time\":\"05:05:42\",\"date\":\"2020-12-20\",\"total_price\":4000,\"id\":8,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":23,\"name\":\"Ahmed\",\"email\":\"Ahmedkamal121995@gmail.com\",\"phone\":\"01001929079\",\"email_verified_at\":\"2020-12-18T17:16:52.000000Z\",\"birth\":\"Feb 1, 1995\",\"api_token\":\"ptKgiChRiHzt9okh3pU6c3NxM74u2JbFXgFZtOlDjo31xy0RXHiHigVJnlkB\"}}', NULL, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
('27ea83b2-49c3-48f5-bb5c-a29f1d976a35', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"testtest\",\"email\":\"developer.essam3@gmail.com\",\"phone\":\"01000709211\",\"birth\":\"12-12-2020\",\"id\":20}}', NULL, '2020-12-18 08:02:29', '2020-12-18 08:02:29'),
('33cd6bcb-5799-4efb-a802-c66217c219ff', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"testtest\",\"email\":\"developer.essam2@gmail.con\",\"phone\":\"01000709278\",\"birth\":\"12-12-2020\",\"id\":19}}', NULL, '2020-12-17 12:43:59', '2020-12-17 12:43:59'),
('427398b6-d8c0-46d0-98dc-a6389f629976', 'App\\Notifications\\OrderSatusNot', 'App\\User', 25, '{\"orderstatus\":{\"id\":13,\"status\":\"1\",\"date\":\"2021-01-27\",\"time\":\"16:18:31\",\"fullname\":\"Mohamed\",\"street_address\":\"aa\",\"building_no\":\"58\",\"area\":\"jjjhh\",\"phone\":\"12345678\",\"total_price\":\"5200\",\"order_no\":\"531166933\",\"currency_code\":\"QAR\",\"currency_value\":1}}', NULL, '2021-01-27 16:18:59', '2021-01-27 16:18:59'),
('4d508876-6ac3-40c2-abcb-c16f7144185d', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":553443739,\"status\":0,\"fullname\":\"jjhhh\",\"street_address\":\"ujgh\",\"building_no\":\"955\",\"area\":\"jhh\",\"phone\":\"53\",\"time\":\"16:50:28\",\"date\":\"2021-01-09\",\"total_price\":4000,\"id\":12,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":25,\"name\":\"Mohamed\",\"email\":\"m.f.keshk@gmail.com\",\"phone\":\"66497607\",\"email_verified_at\":\"2021-01-09T13:27:12.000000Z\",\"birth\":\"30 Jul 1988\",\"api_token\":\"J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD\"}}', NULL, '2021-01-09 16:50:28', '2021-01-09 16:50:28'),
('548eb860-654f-4f67-8f57-e0f5e02cd33a', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":2017446278,\"status\":0,\"fullname\":\"sss\",\"street_address\":\"we\",\"building_no\":\"2\",\"area\":\"2\",\"phone\":\"22222222\",\"time\":\"07:23:33\",\"date\":\"2021-01-07\",\"total_price\":4500,\"id\":10,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":23,\"name\":\"Ahmed\",\"email\":\"Ahmedkamal121995@gmail.com\",\"phone\":\"01001929079\",\"email_verified_at\":\"2020-12-18T17:16:52.000000Z\",\"birth\":\"Jun 16, 1995\",\"api_token\":\"JAXhn6Pur79bQsuXOX4jEgYOilY3ZVfW1qljHeCG89QNtGKiAonQbtjbsTEQ\"}}', NULL, '2021-01-07 07:23:33', '2021-01-07 07:23:33'),
('5ef79038-0123-42d3-8663-7a2541cad6fd', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":1208898016,\"status\":0,\"fullname\":\"Ahmed\",\"street_address\":\"Hassan Radwan\",\"building_no\":\"44\",\"area\":\"tanta\",\"phone\":\"01001929079\",\"time\":\"02:48:47\",\"date\":\"2020-12-19\",\"total_price\":10300,\"id\":7,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":23,\"name\":\"Ahmed\",\"email\":\"Ahmedkamal121995@gmail.com\",\"phone\":\"01001929079\",\"email_verified_at\":\"2020-12-18T17:16:52.000000Z\",\"birth\":\"Feb 1, 1995\",\"api_token\":\"jbYz26tWFqpi6yY4Yc6FTQpyvyTZhj5TdblpZcH2BGeaQK5Zy1lgyOw8hLdD\"}}', NULL, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
('77d62b02-17b7-45f8-a336-7c0ae9cde284', 'App\\Notifications\\NewContact', 'App\\Models\\Moderator', 1, '{\"contact\":{\"name\":\"Essam\",\"email\":\"vghg@nbj.com\",\"phone\":\"01000706271\",\"message\":\"chubby\",\"id\":1}}', NULL, '2020-12-18 07:01:23', '2020-12-18 07:01:23'),
('7bb03e78-488a-4ad0-b932-c9c717cc9a5f', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":1916564281,\"status\":0,\"fullname\":\"rrr\",\"street_address\":\"rr\",\"building_no\":\"r\",\"area\":\"rr\",\"phone\":\"ff\",\"time\":\"07:42:13\",\"date\":\"2021-01-07\",\"total_price\":3600,\"id\":11,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":23,\"name\":\"Ahmed\",\"email\":\"Ahmedkamal121995@gmail.com\",\"phone\":\"01001929079\",\"email_verified_at\":\"2020-12-18T17:16:52.000000Z\",\"birth\":\"Jun 16, 1995\",\"api_token\":\"BhAE4L6QGO7cQey83pd2iyihTO4DRCYvDgltNsLe1pZJRPCrhP42umh20C3H\"}}', NULL, '2021-01-07 07:42:13', '2021-01-07 07:42:13'),
('7de6a400-724e-443b-a18b-f238d9ddceb8', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"Mohamed\",\"email\":\"m.f.keshk@gmail.com\",\"phone\":\"66497607\",\"birth\":\"30 Jul 1988\",\"id\":25}}', NULL, '2021-01-09 16:27:00', '2021-01-09 16:27:00'),
('8de0b46c-a396-4d9c-9028-ada52eda6757', 'App\\Notifications\\OrderSatusNot', 'App\\User', 11, '{\"orderstatus\":{\"id\":4,\"status\":\"1\",\"date\":\"2020-12-16\",\"time\":\"04:02:24\",\"fullname\":\"w\",\"street_address\":\"w\",\"building_no\":\"w\",\"area\":\"w\",\"phone\":\"w\",\"total_price\":\"360\",\"order_no\":\"569369922\",\"currency_code\":\"QAR\",\"currency_value\":1}}', '2020-12-16 22:17:57', '2020-12-16 04:31:06', '2020-12-16 22:17:57'),
('8e17b47b-a409-43ec-a39d-2597a861f5fb', 'App\\Notifications\\OrderSatusNot', 'App\\User', 11, '{\"orderstatus\":{\"id\":2,\"status\":\"3\",\"date\":\"2020-12-16\",\"time\":\"04:00:10\",\"fullname\":\"s\",\"street_address\":\"s\",\"building_no\":\"s\",\"area\":\"s\",\"phone\":\"s\",\"total_price\":\"450\",\"order_no\":\"1858908116\",\"currency_code\":\"QAR\",\"currency_value\":1}}', '2020-12-16 22:17:29', '2020-12-16 04:31:31', '2020-12-16 22:17:29'),
('9a57a9bf-79dd-4186-83b1-143a819b2186', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"Dobaa\",\"email\":\"dobanabil40@gmail.com\",\"phone\":\"123456789\",\"birth\":\"sadf\",\"id\":13}}', NULL, '2020-12-14 23:24:22', '2020-12-14 23:24:22'),
('9dfbdd45-9a28-436d-a5e6-419b6e0659d5', 'App\\Notifications\\OrderSatusNot', 'App\\User', 11, '{\"orderstatus\":{\"id\":1,\"status\":\"4\",\"date\":\"2020-12-16\",\"time\":\"03:57:57\",\"fullname\":\"d\",\"street_address\":\"d\",\"building_no\":\"d\",\"area\":\"d\",\"phone\":\"d\",\"total_price\":\"2500\",\"order_no\":\"106629368\",\"currency_code\":\"QAR\",\"currency_value\":1}}', '2020-12-16 22:03:03', '2020-12-16 04:31:41', '2020-12-16 22:03:03'),
('ba8a391b-770b-46b2-9036-94b488d845d5', 'App\\Notifications\\NewUser', 'App\\Models\\Moderator', 1, '{\"user\":{\"name\":\"Ahmed\",\"email\":\"Ahmedshalaby121995@gmail.com\",\"phone\":\"01117180818\",\"birth\":\"Dec 19, 2020\",\"id\":24}}', NULL, '2020-12-19 23:23:05', '2020-12-19 23:23:05'),
('c2775b47-8b71-4929-b537-3080c4992399', 'App\\Notifications\\OrderSatusNot', 'App\\User', 11, '{\"orderstatus\":{\"id\":3,\"status\":\"2\",\"date\":\"2020-12-16\",\"time\":\"04:01:08\",\"fullname\":\"s\",\"street_address\":\"s\",\"building_no\":\"s\",\"area\":\"s\",\"phone\":\"s\",\"total_price\":\"180\",\"order_no\":\"878034211\",\"currency_code\":\"QAR\",\"currency_value\":1}}', '2020-12-16 22:17:44', '2020-12-16 04:31:21', '2020-12-16 22:17:44'),
('e7ea29fa-0718-4581-9196-b60a5a238386', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":302443062,\"status\":0,\"fullname\":\"xhhcxhhcgchc\",\"street_address\":\"ffffff\",\"building_no\":\"55555\",\"area\":\"ghhhhhh\",\"phone\":\"888555555\",\"time\":\"03:43:46\",\"date\":\"2020-12-21\",\"total_price\":2500,\"id\":9,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":20,\"name\":\"testtest\",\"email\":\"developer.essam3@gmail.com\",\"phone\":\"01000709211\",\"email_verified_at\":null,\"birth\":\"12-12-2020\",\"api_token\":\"Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0\"}}', NULL, '2020-12-21 03:43:46', '2020-12-21 03:43:46'),
('f5ed8efa-86c6-48ca-bf37-e8b0d711dcba', 'App\\Notifications\\NewOrder', 'App\\Models\\Moderator', 1, '{\"order\":{\"order_no\":973471548,\"status\":0,\"fullname\":\"Gigi\",\"street_address\":\"fufuffhch\",\"building_no\":\"55558585\",\"area\":\"finch\",\"phone\":\"01000709271\",\"time\":\"02:21:01\",\"date\":\"2020-12-17\",\"total_price\":1690,\"id\":6,\"currency_code\":\"QAR\",\"currency_value\":1},\"user\":{\"id\":17,\"name\":\"Essam\",\"email\":\"developer.essam@gmail.com\",\"phone\":\"01000709271\",\"email_verified_at\":\"2020-12-16T23:16:30.000000Z\",\"birth\":\"12-12-2020\",\"api_token\":\"AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS\"}}', NULL, '2020-12-17 02:21:01', '2020-12-17 02:21:01'),
('f9fb30f6-3c8a-4d4d-8ebd-ddb76785c0d2', 'App\\Notifications\\OrderSatusNot', 'App\\User', 23, '{\"orderstatus\":{\"id\":7,\"status\":\"2\",\"date\":\"2020-12-19\",\"time\":\"02:48:47\",\"fullname\":\"Ahmed\",\"street_address\":\"Hassan Radwan\",\"building_no\":\"44\",\"area\":\"tanta\",\"phone\":\"01001929079\",\"total_price\":\"10300\",\"order_no\":\"1208898016\",\"currency_code\":\"QAR\",\"currency_value\":1}}', NULL, '2020-12-20 02:12:34', '2020-12-20 02:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `face` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `insta` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whats` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `andriod` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `face`, `insta`, `whats`, `phone`, `email`, `address_ar`, `address_en`, `ios`, `andriod`, `active`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com', 'https://www.instagram.com', '99999900000000', '99999900000000', 'najla@najlaa.com', '234324132fdsafa', 'sdvadsvadsvasdvasdvads', 'https://apps.apple.com/', 'https://play.google.com/', 1, '2020-12-14 19:22:15', '2020-12-16 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fullname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipped` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_to_delivery` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `new`, `status`, `paid`, `user_id`, `city_id`, `date`, `time`, `fullname`, `street_address`, `building_no`, `area`, `phone`, `total_price`, `order_no`, `processed`, `shipped`, `out_to_delivery`, `delivered`, `created_at`, `updated_at`) VALUES
(7, 0, 2, 0, 23, 3, '2020-12-19', '02:48:47', 'Ahmed', 'Hassan Radwan', '44', 'tanta', '01001929079', '10300', '1208898016', '2020-12-19 02:48:47', '2020-12-20 02:12:32', NULL, NULL, '2020-12-19 02:48:47', '2020-12-20 02:12:32'),
(8, 1, 0, 0, 23, 1, '2020-12-20', '05:05:42', 's', 's', 's', 's', 's', '4000', '361909843', '2020-12-20 05:05:42', NULL, NULL, NULL, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(9, 1, 0, 0, 20, 1, '2020-12-21', '03:43:46', 'xhhcxhhcgchc', 'ffffff', '55555', 'ghhhhhh', '888555555', '2500', '302443062', '2020-12-21 03:43:46', NULL, NULL, NULL, '2020-12-21 03:43:46', '2020-12-21 03:43:46'),
(10, 1, 0, 0, 23, 3, '2021-01-07', '07:23:33', 'sss', 'we', '2', '2', '22222222', '4500', '2017446278', '2021-01-07 07:23:33', NULL, NULL, NULL, '2021-01-07 07:23:33', '2021-01-07 07:23:33'),
(11, 1, 0, 0, 23, 1, '2021-01-07', '07:42:13', 'rrr', 'rr', 'r', 'rr', 'ff', '3600', '1916564281', '2021-01-07 07:42:13', NULL, NULL, NULL, '2021-01-07 07:42:13', '2021-01-07 07:42:13'),
(12, 1, 0, 0, 25, 1, '2021-01-09', '16:50:28', 'jjhhh', 'ujgh', '955', 'jhh', '53', '4000', '553443739', '2021-01-09 16:50:28', NULL, NULL, NULL, '2021-01-09 16:50:28', '2021-01-09 16:50:28'),
(13, 0, 1, 0, 25, 1, '2021-01-27', '16:18:31', 'Mohamed', 'aa', '58', 'jjjhh', '12345678', '5200', '531166933', '2021-01-27 16:18:57', NULL, NULL, NULL, '2021-01-27 16:18:31', '2021-01-27 16:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name_ar`, `name_en`, `body_ar`, `body_en`, `active`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Legal Information', 'Legal Information', 'Legal Information body', 'Legal Information body', 1, 'legal-information', '2020-12-14 19:22:15', '2020-12-14 19:22:15'),
(2, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy body', 'Privacy Policy body', 1, 'privacy-policy', '2020-12-14 19:22:15', '2020-12-14 19:22:15'),
(3, 'Delivery and return info', 'Delivery and return info', 'Delivery and return info body', 'Delivery and return info body', 1, 'delivery-return', '2020-12-14 19:22:15', '2020-12-14 19:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`id`, `color_id`, `size_id`, `count`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(15, '2', '1', '1', 7, 2, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
(16, '2', '1', '1', 7, 2, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
(17, '2', '1', '1', 7, 2, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
(18, '2', '1', '5', 7, 2, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
(19, '2', '1', '10', 7, 2, '2020-12-19 02:48:47', '2020-12-19 02:48:47'),
(20, '2', '1', '2', 8, 1, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(21, '2', '3', '1', 8, 3, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(22, '2', '3', '3', 8, 3, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(23, '2', '4', '3', 8, 3, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(24, '2', '5', '3', 8, 3, '2020-12-20 05:05:42', '2020-12-20 05:05:42'),
(25, '3', '2', '1', 9, 1, '2020-12-21 03:43:46', '2020-12-21 03:43:46'),
(26, '2', '1', '1', 10, 1, '2021-01-07 07:23:33', '2021-01-07 07:23:33'),
(27, '2', '3', '5', 10, 3, '2021-01-07 07:23:33', '2021-01-07 07:23:33'),
(28, '2', '3', '1', 11, 3, '2021-01-07 07:42:13', '2021-01-07 07:42:13'),
(29, '3', '2', '1', 12, 1, '2021-01-09 16:50:28', '2021-01-09 16:50:28'),
(30, '3', '2', '1', 13, 1, '2021-01-27 16:18:31', '2021-01-27 16:18:31'),
(31, '5', '2', '1', 13, 9, '2021-01-27 16:18:31', '2021-01-27 16:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage_discount` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_qty` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_qty` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `chosen` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `category_id`, `subcategory_id`, `price`, `code`, `discount_price`, `percentage_discount`, `min_qty`, `max_qty`, `body_ar`, `body_en`, `slug`, `brand_id`, `material_id`, `active`, `views`, `chosen`, `created_at`, `updated_at`) VALUES
(1, 'عبايا سوارية', 'Soary Abaya', 4, 5, '643', '2568165123', '500', '22 % ', '1', '100', 'هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'soary-abaya', NULL, 2, 1, 506, 1, '2020-12-14 22:26:13', '2021-01-30 16:35:13'),
(2, 'عبايا سادة', 'Plain Abaya', 4, 5, '500', '259875515959', '450', '10 % ', '1', '20', 'هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.', 'ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et', 'plain-abaya', NULL, 2, 1, 210, 1, '2020-12-14 22:31:02', '2021-01-30 02:52:42'),
(3, 'حذاء رياضي', 'Nelle Benjamin', 1, 9, '120', '825594984', '100', '17 % ', '1', '50', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ', 'Voluptates tempora uConsequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur At aut Consequatur', 'nelle-benjamin', NULL, 3, 1, 152, 1, '2020-12-14 22:33:08', '2021-01-30 03:04:09'),
(9, 'حذاء', 'bag shoes', 1, 9, '150', '000', NULL, '0', '1', '7', 'حذاء', 'bag shoes', 'alhamdulillah', NULL, 2, 1, 8, 1, '2021-01-27 16:12:37', '2021-01-30 01:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color_id`, `size_id`, `type`, `created_at`, `updated_at`) VALUES
(21, 1, NULL, 1, 'size', '2020-12-14 22:41:11', '2020-12-14 22:41:11'),
(22, 1, NULL, 2, 'size', '2020-12-14 22:41:11', '2020-12-14 22:41:11'),
(23, 1, 2, NULL, 'color', '2020-12-14 22:41:11', '2020-12-14 22:41:11'),
(24, 1, 3, NULL, 'color', '2020-12-14 22:41:11', '2020-12-14 22:41:11'),
(88, 2, NULL, 1, 'size', '2020-12-18 20:58:04', '2020-12-18 20:58:04'),
(89, 2, NULL, 2, 'size', '2020-12-18 20:58:04', '2020-12-18 20:58:04'),
(90, 2, 2, NULL, 'color', '2020-12-18 20:58:04', '2020-12-18 20:58:04'),
(91, 2, 3, NULL, 'color', '2020-12-18 20:58:04', '2020-12-18 20:58:04'),
(100, 3, NULL, 3, 'size', '2021-01-05 15:47:33', '2021-01-05 15:47:33'),
(101, 3, NULL, 4, 'size', '2021-01-05 15:47:33', '2021-01-05 15:47:33'),
(102, 3, NULL, 5, 'size', '2021-01-05 15:47:33', '2021-01-05 15:47:33'),
(103, 3, 2, NULL, 'color', '2021-01-05 15:47:33', '2021-01-05 15:47:33'),
(106, 9, NULL, 2, 'size', '2021-01-27 16:14:33', '2021-01-27 16:14:33'),
(107, 9, 5, NULL, 'color', '2021-01-27 16:14:33', '2021-01-27 16:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `recentlies`
--

CREATE TABLE `recentlies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `word` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kind` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recentlies`
--

INSERT INTO `recentlies` (`id`, `word`, `product_id`, `kind`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 'j', NULL, 'word', NULL, '2020-12-14 22:22:56', '2020-12-14 22:22:56'),
(2, 'f', NULL, 'word', NULL, '2020-12-14 22:23:00', '2020-12-14 22:23:00'),
(3, 'a', NULL, 'word', NULL, '2020-12-14 22:23:04', '2020-12-14 22:23:04'),
(4, 'f', NULL, 'word', NULL, '2020-12-14 22:23:08', '2020-12-14 22:23:08'),
(5, 'f', NULL, 'word', NULL, '2020-12-14 22:31:33', '2020-12-14 22:31:33'),
(6, 'd', NULL, 'word', NULL, '2020-12-14 22:31:39', '2020-12-14 22:31:39'),
(7, 'e', NULL, 'word', NULL, '2020-12-14 22:31:44', '2020-12-14 22:31:44'),
(8, 'g', NULL, 'word', 'MMegfS9pLZymneVItskQpLwuJQFL4XF14iL6iSZKyyp4WVK6JBLH43yYodSc', '2020-12-14 22:40:16', '2020-12-14 22:40:16'),
(9, 'S', NULL, 'word', 'MMegfS9pLZymneVItskQpLwuJQFL4XF14iL6iSZKyyp4WVK6JBLH43yYodSc', '2020-12-14 22:40:24', '2020-12-14 22:40:24'),
(10, 'S', NULL, 'word', 'MMegfS9pLZymneVItskQpLwuJQFL4XF14iL6iSZKyyp4WVK6JBLH43yYodSc', '2020-12-14 22:40:29', '2020-12-14 22:40:29'),
(11, NULL, 1, 'product', 'MMegfS9pLZymneVItskQpLwuJQFL4XF14iL6iSZKyyp4WVK6JBLH43yYodSc', '2020-12-14 22:40:30', '2020-12-14 22:40:30'),
(12, NULL, 1, 'product', 'MMegfS9pLZymneVItskQpLwuJQFL4XF14iL6iSZKyyp4WVK6JBLH43yYodSc', '2020-12-14 22:40:58', '2020-12-14 22:40:58'),
(13, 'e', NULL, 'word', NULL, '2020-12-14 22:42:17', '2020-12-14 22:42:17'),
(14, 'S', NULL, 'word', NULL, '2020-12-14 22:45:54', '2020-12-14 22:45:54'),
(15, 'ss', NULL, 'word', NULL, '2020-12-14 22:46:26', '2020-12-14 22:46:26'),
(16, 'b', NULL, 'word', NULL, '2020-12-14 22:46:31', '2020-12-14 22:46:31'),
(17, 'g', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:47:44', '2020-12-14 22:47:44'),
(18, 'k', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:47:49', '2020-12-14 22:47:49'),
(19, 'S', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:47:57', '2020-12-14 22:47:57'),
(20, NULL, 1, 'product', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:47:58', '2020-12-14 22:47:58'),
(21, 'S', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:48:05', '2020-12-14 22:48:05'),
(22, 'S', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:48:07', '2020-12-14 22:48:07'),
(23, 'S', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:48:08', '2020-12-14 22:48:08'),
(25, 'S', NULL, 'word', 'XDnCSV2PJQZYVBGtFEhHIpc5JVhHYMvQOlylymHP5IKVNXDhazktBALDI8wK', '2020-12-14 22:48:11', '2020-12-14 22:48:11'),
(43, NULL, 3, 'product', 'CSBWriTCVsi0aV9yU2rsHWURFwtUMD7sRFh7ORRIzI6OJOQANS3pMa8JPkIl', '2020-12-14 23:17:01', '2020-12-14 23:17:01'),
(47, 'b', NULL, 'word', NULL, '2020-12-14 23:18:24', '2020-12-14 23:18:24'),
(48, 'b', NULL, 'word', NULL, '2020-12-14 23:18:30', '2020-12-14 23:18:30'),
(49, 'ذ', NULL, 'word', 'CSBWriTCVsi0aV9yU2rsHWURFwtUMD7sRFh7ORRIzI6OJOQANS3pMa8JPkIl', '2020-12-14 23:20:48', '2020-12-14 23:20:48'),
(50, NULL, 1, 'product', NULL, '2020-12-14 23:25:34', '2020-12-14 23:25:34'),
(51, NULL, 1, 'product', NULL, '2020-12-14 23:25:41', '2020-12-14 23:25:41'),
(52, NULL, 2, 'product', NULL, '2020-12-14 23:25:48', '2020-12-14 23:25:48'),
(53, NULL, 2, 'product', NULL, '2020-12-14 23:26:50', '2020-12-14 23:26:50'),
(54, NULL, 2, 'product', NULL, '2020-12-14 23:26:59', '2020-12-14 23:26:59'),
(55, NULL, 2, 'product', '2222', '2020-12-14 23:28:17', '2020-12-14 23:28:17'),
(81, NULL, 1, 'product', 'nrURfUKHvvZniL5AmK6N59IRJ4FLEzr3i0SnceV5gk6ncwF8xxruaCinr0bq', '2020-12-15 00:05:29', '2020-12-15 00:05:29'),
(84, NULL, 3, 'product', 'nrURfUKHvvZniL5AmK6N59IRJ4FLEzr3i0SnceV5gk6ncwF8xxruaCinr0bq', '2020-12-15 00:05:38', '2020-12-15 00:05:38'),
(86, NULL, 3, 'product', 'nrURfUKHvvZniL5AmK6N59IRJ4FLEzr3i0SnceV5gk6ncwF8xxruaCinr0bq', '2020-12-15 00:18:57', '2020-12-15 00:18:57'),
(89, 'g', NULL, 'word', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:00:30', '2020-12-15 01:00:30'),
(90, NULL, 1, 'product', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:07:48', '2020-12-15 01:07:48'),
(91, 'ق', NULL, 'word', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:08:01', '2020-12-15 01:08:01'),
(92, 'a', NULL, 'word', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:08:14', '2020-12-15 01:08:14'),
(93, NULL, 3, 'product', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:08:20', '2020-12-15 01:08:20'),
(94, 'a', NULL, 'word', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 01:08:25', '2020-12-15 01:08:25'),
(95, NULL, 1, 'product', 'Optional(\"9449F818-435C-4707-9E86-2EDB7A73AC33\")', '2020-12-15 02:13:32', '2020-12-15 02:13:32'),
(96, 'b', NULL, 'word', NULL, '2020-12-15 03:16:02', '2020-12-15 03:16:02'),
(97, 'a', NULL, 'word', NULL, '2020-12-15 03:16:32', '2020-12-15 03:16:32'),
(98, 'a', NULL, 'word', NULL, '2020-12-15 03:16:55', '2020-12-15 03:16:55'),
(99, 'f', NULL, 'word', NULL, '2020-12-15 03:21:20', '2020-12-15 03:21:20'),
(100, 'a', NULL, 'word', NULL, '2020-12-15 03:21:27', '2020-12-15 03:21:27'),
(101, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 03:49:37', '2020-12-15 03:49:37'),
(102, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:02:50', '2020-12-15 04:02:50'),
(103, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:07:43', '2020-12-15 04:07:43'),
(104, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:13:41', '2020-12-15 04:13:41'),
(105, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:14:54', '2020-12-15 04:14:54'),
(106, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:25:42', '2020-12-15 04:25:42'),
(107, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:30:45', '2020-12-15 04:30:45'),
(108, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:35:35', '2020-12-15 04:35:35'),
(109, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:39:17', '2020-12-15 04:39:17'),
(110, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 04:51:28', '2020-12-15 04:51:28'),
(111, 'a', NULL, 'word', NULL, '2020-12-15 05:00:11', '2020-12-15 05:00:11'),
(112, 'حذ', NULL, 'word', NULL, '2020-12-15 05:00:34', '2020-12-15 05:00:34'),
(113, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 05:14:59', '2020-12-15 05:14:59'),
(114, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 05:16:24', '2020-12-15 05:16:24'),
(115, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 05:16:53', '2020-12-15 05:16:53'),
(116, 'h', NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 05:33:34', '2020-12-15 05:33:34'),
(117, 'ح', NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 05:34:30', '2020-12-15 05:34:30'),
(118, 's', NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:17', '2020-12-15 14:39:17'),
(119, 'a', NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:28', '2020-12-15 14:39:28'),
(120, NULL, 1, 'product', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:31', '2020-12-15 14:39:31'),
(121, 'a', NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:37', '2020-12-15 14:39:37'),
(122, 'f', NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:50', '2020-12-15 14:39:50'),
(123, 'a', NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:39:56', '2020-12-15 14:39:56'),
(124, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:42:20', '2020-12-15 14:42:20'),
(125, NULL, 1, 'product', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:42:49', '2020-12-15 14:42:49'),
(126, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:42:56', '2020-12-15 14:42:56'),
(127, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:44:51', '2020-12-15 14:44:51'),
(128, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:48:26', '2020-12-15 14:48:26'),
(129, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:50:40', '2020-12-15 14:50:40'),
(130, NULL, 2, 'product', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:51:20', '2020-12-15 14:51:20'),
(131, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:51:24', '2020-12-15 14:51:24'),
(132, NULL, 3, 'product', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:51:37', '2020-12-15 14:51:37'),
(133, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:51:43', '2020-12-15 14:51:43'),
(134, NULL, NULL, 'word', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 14:53:18', '2020-12-15 14:53:18'),
(135, NULL, 1, 'product', 'bpkPIazCRbNEdKdzYYMGjDkFD8OjtOympIfkFAEW50LZ5DpsT4OKdJVMDwiQ', '2020-12-15 15:04:15', '2020-12-15 15:04:15'),
(143, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 16:11:28', '2020-12-15 16:11:28'),
(144, 'ح', NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 16:11:28', '2020-12-15 16:11:28'),
(145, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 16:11:28', '2020-12-15 16:11:28'),
(146, 'h', NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-15 16:11:28', '2020-12-15 16:11:28'),
(151, NULL, NULL, 'word', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:21:52', '2020-12-15 17:21:52'),
(152, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:21:53', '2020-12-15 17:21:53'),
(153, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:22:20', '2020-12-15 17:22:20'),
(154, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:23:02', '2020-12-15 17:23:02'),
(155, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:23:13', '2020-12-15 17:23:13'),
(156, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:23:22', '2020-12-15 17:23:22'),
(157, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:25:58', '2020-12-15 17:25:58'),
(158, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:27:32', '2020-12-15 17:27:32'),
(159, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:27:45', '2020-12-15 17:27:45'),
(160, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:32:20', '2020-12-15 17:32:20'),
(161, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:34:02', '2020-12-15 17:34:02'),
(162, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:16', '2020-12-15 17:35:16'),
(163, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:20', '2020-12-15 17:35:20'),
(164, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:23', '2020-12-15 17:35:23'),
(165, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:25', '2020-12-15 17:35:25'),
(166, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:35', '2020-12-15 17:35:35'),
(167, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:35:38', '2020-12-15 17:35:38'),
(168, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:40:29', '2020-12-15 17:40:29'),
(169, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:46:10', '2020-12-15 17:46:10'),
(170, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:46:26', '2020-12-15 17:46:26'),
(171, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:46:54', '2020-12-15 17:46:54'),
(172, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:47:12', '2020-12-15 17:47:12'),
(173, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:48:23', '2020-12-15 17:48:23'),
(174, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 17:48:36', '2020-12-15 17:48:36'),
(175, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 18:03:38', '2020-12-15 18:03:38'),
(176, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 18:04:16', '2020-12-15 18:04:16'),
(177, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 18:04:18', '2020-12-15 18:04:18'),
(178, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 18:14:40', '2020-12-15 18:14:40'),
(179, NULL, 1, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 18:20:08', '2020-12-15 18:20:08'),
(180, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 19:06:56', '2020-12-15 19:06:56'),
(181, NULL, 3, 'product', 'm3I3W3Nlt1RD3VDCnXHhSvvA6z78tCiLpPkdCfxwDStC2Od8zsCoyT4J9x88', '2020-12-15 19:07:28', '2020-12-15 19:07:28'),
(265, NULL, NULL, 'word', 'h41RJaLROTEH9dlvO6gC66VSJHe9kCgiu2QyWkHNaiuHQcqaqIwhOotm9D0G', '2020-12-16 02:40:30', '2020-12-16 02:40:30'),
(266, NULL, 3, 'product', 'h41RJaLROTEH9dlvO6gC66VSJHe9kCgiu2QyWkHNaiuHQcqaqIwhOotm9D0G', '2020-12-16 02:48:25', '2020-12-16 02:48:25'),
(267, NULL, 2, 'product', 'h41RJaLROTEH9dlvO6gC66VSJHe9kCgiu2QyWkHNaiuHQcqaqIwhOotm9D0G', '2020-12-16 02:49:33', '2020-12-16 02:49:33'),
(268, NULL, 1, 'product', 'WAJlt7ToczrIg3axCi5EQ7gBu3RwHIYqcS7HvKy26uu3uRTjtszpYTYsovD5', '2020-12-16 03:57:31', '2020-12-16 03:57:31'),
(272, NULL, 3, 'product', 'WAJlt7ToczrIg3axCi5EQ7gBu3RwHIYqcS7HvKy26uu3uRTjtszpYTYsovD5', '2020-12-16 04:03:02', '2020-12-16 04:03:02'),
(273, NULL, 3, 'product', 'WAJlt7ToczrIg3axCi5EQ7gBu3RwHIYqcS7HvKy26uu3uRTjtszpYTYsovD5', '2020-12-16 04:03:17', '2020-12-16 04:03:17'),
(274, NULL, 3, 'product', 'WAJlt7ToczrIg3axCi5EQ7gBu3RwHIYqcS7HvKy26uu3uRTjtszpYTYsovD5', '2020-12-16 04:03:19', '2020-12-16 04:03:19'),
(275, NULL, 3, 'product', 'WAJlt7ToczrIg3axCi5EQ7gBu3RwHIYqcS7HvKy26uu3uRTjtszpYTYsovD5', '2020-12-16 04:04:21', '2020-12-16 04:04:21'),
(298, 's', NULL, 'word', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:12:34', '2020-12-16 21:12:34'),
(300, 's', NULL, 'word', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:12:58', '2020-12-16 21:12:58'),
(302, 's', NULL, 'word', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:13:04', '2020-12-16 21:13:04'),
(303, 's', NULL, 'word', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:13:07', '2020-12-16 21:13:07'),
(304, NULL, 1, 'product', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:13:31', '2020-12-16 21:13:31'),
(305, 's', NULL, 'word', 'wVa6WS5zNriZBv98G2YzrlPSTk2aSFBidllfkpI4jTFPPimAPwGQUTMJQRz0', '2020-12-16 21:13:34', '2020-12-16 21:13:34'),
(308, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-16 21:16:02', '2020-12-16 21:16:02'),
(310, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-16 22:21:26', '2020-12-16 22:21:26'),
(311, NULL, 2, 'product', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-16 22:21:27', '2020-12-16 22:21:27'),
(312, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-16 22:21:31', '2020-12-16 22:21:31'),
(313, NULL, NULL, 'word', 'b9eLDzt7CMJsyWlsdXbwDIwoSAU6xjrYpceTvcEveOgK7XhQbpg2ve9uG8jr', '2020-12-16 22:21:47', '2020-12-16 22:21:47'),
(315, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-16 22:24:49', '2020-12-16 22:24:49'),
(316, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-16 22:25:01', '2020-12-16 22:25:01'),
(317, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-16 22:26:41', '2020-12-16 22:26:41'),
(319, NULL, 1, 'product', '6WWA775mdCW7ZVE5ED7FYTSrFochmnaMmuYM5cJaNGZ4aywZzA6Ch78BHDh7', '2020-12-16 22:33:32', '2020-12-16 22:33:32'),
(321, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-17 01:12:18', '2020-12-17 01:12:18'),
(323, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-17 01:16:20', '2020-12-17 01:16:20'),
(325, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-17 01:16:27', '2020-12-17 01:16:27'),
(326, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-17 01:16:51', '2020-12-17 01:16:51'),
(327, 'j', NULL, 'word', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 01:26:22', '2020-12-17 01:26:22'),
(328, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 01:26:36', '2020-12-17 01:26:36'),
(329, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 01:32:12', '2020-12-17 01:32:12'),
(330, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 02:15:43', '2020-12-17 02:15:43'),
(331, 'j', NULL, 'word', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 02:16:32', '2020-12-17 02:16:32'),
(332, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 02:16:32', '2020-12-17 02:16:32'),
(333, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-17 02:16:41', '2020-12-17 02:16:41'),
(334, 'ب', NULL, 'word', '6WWA775mdCW7ZVE5ED7FYTSrFochmnaMmuYM5cJaNGZ4aywZzA6Ch78BHDh7', '2020-12-17 02:18:59', '2020-12-17 02:18:59'),
(336, NULL, 3, 'product', '6WWA775mdCW7ZVE5ED7FYTSrFochmnaMmuYM5cJaNGZ4aywZzA6Ch78BHDh7', '2020-12-17 02:20:49', '2020-12-17 02:20:49'),
(337, NULL, 1, 'product', 'cM2Bj9nB5LFa4e1qyJYM1QXExAkWChWO0DCP3alF6tdwKkjI6SsYCzgva0OS', '2020-12-17 02:24:35', '2020-12-17 02:24:35'),
(339, 'b', NULL, 'word', 'cM2Bj9nB5LFa4e1qyJYM1QXExAkWChWO0DCP3alF6tdwKkjI6SsYCzgva0OS', '2020-12-17 02:27:09', '2020-12-17 02:27:09'),
(356, NULL, 3, 'product', '1Rq4MhHzICjsW64GuGcA0YPx9Fvf4CUYaVh4Xkkyi0SMlZjLNSqGFA9xxqA0', '2020-12-17 18:43:16', '2020-12-17 18:43:16'),
(357, NULL, 1, 'product', '1Rq4MhHzICjsW64GuGcA0YPx9Fvf4CUYaVh4Xkkyi0SMlZjLNSqGFA9xxqA0', '2020-12-17 18:43:21', '2020-12-17 18:43:21'),
(358, NULL, 1, 'product', '1Rq4MhHzICjsW64GuGcA0YPx9Fvf4CUYaVh4Xkkyi0SMlZjLNSqGFA9xxqA0', '2020-12-17 18:43:32', '2020-12-17 18:43:32'),
(359, NULL, 1, 'product', '1Rq4MhHzICjsW64GuGcA0YPx9Fvf4CUYaVh4Xkkyi0SMlZjLNSqGFA9xxqA0', '2020-12-17 18:43:39', '2020-12-17 18:43:39'),
(360, NULL, 3, 'product', '1Rq4MhHzICjsW64GuGcA0YPx9Fvf4CUYaVh4Xkkyi0SMlZjLNSqGFA9xxqA0', '2020-12-17 18:44:20', '2020-12-17 18:44:20'),
(403, NULL, 1, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:07:49', '2020-12-18 07:07:49'),
(404, NULL, 1, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:08:08', '2020-12-18 07:08:08'),
(405, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:09:27', '2020-12-18 07:09:27'),
(406, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:09:38', '2020-12-18 07:09:38'),
(407, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:09:41', '2020-12-18 07:09:41'),
(408, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:09:43', '2020-12-18 07:09:43'),
(409, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:14:08', '2020-12-18 07:14:08'),
(410, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:14:21', '2020-12-18 07:14:21'),
(411, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:15:56', '2020-12-18 07:15:56'),
(412, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:16:59', '2020-12-18 07:16:59'),
(413, 'nelle', NULL, 'word', NULL, '2020-12-18 07:19:09', '2020-12-18 07:19:09'),
(414, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:19:16', '2020-12-18 07:19:16'),
(415, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:20:01', '2020-12-18 07:20:01'),
(416, NULL, 1, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:20:08', '2020-12-18 07:20:08'),
(417, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:20:25', '2020-12-18 07:20:25'),
(418, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:20:32', '2020-12-18 07:20:32'),
(419, NULL, 2, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:20:56', '2020-12-18 07:20:56'),
(420, 'nelle', NULL, 'word', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:25:37', '2020-12-18 07:25:37'),
(421, NULL, 3, 'product', 'AafxN0fOs1bVTK86NFSO2fOqqTJdJLcq2E0mMEOBd98iO6KnOXRxfG72PUdS', '2020-12-18 07:26:41', '2020-12-18 07:26:41'),
(422, NULL, 3, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-18 07:42:43', '2020-12-18 07:42:43'),
(423, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-18 07:46:13', '2020-12-18 07:46:13'),
(424, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-18 07:46:19', '2020-12-18 07:46:19'),
(425, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-18 14:43:24', '2020-12-18 14:43:24'),
(426, NULL, 3, 'product', NULL, '2020-12-18 16:22:29', '2020-12-18 16:22:29'),
(427, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 16:22:55', '2020-12-18 16:22:55'),
(428, 'sh', NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 16:23:01', '2020-12-18 16:23:01'),
(429, 's', NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 16:23:05', '2020-12-18 16:23:05'),
(430, 's', NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 16:23:30', '2020-12-18 16:23:30'),
(461, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-18 17:08:45', '2020-12-18 17:08:45'),
(470, NULL, 1, 'product', 'PcqCfKotOQZ1IPTuKHfOvNlJbQwXbWGHWl7mISMvQqMLG2rBJrRvrml9jf9O', '2020-12-18 19:43:54', '2020-12-18 19:43:54'),
(471, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:01:21', '2020-12-18 20:01:21'),
(472, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:02:03', '2020-12-18 20:02:03'),
(473, NULL, 1, 'product', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:02:04', '2020-12-18 20:02:04'),
(474, NULL, 3, 'product', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:02:44', '2020-12-18 20:02:44'),
(475, NULL, 3, 'product', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:02:47', '2020-12-18 20:02:47'),
(476, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:12:40', '2020-12-18 20:12:40'),
(477, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:13:30', '2020-12-18 20:13:30'),
(478, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:20:20', '2020-12-18 20:20:20'),
(479, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:20:25', '2020-12-18 20:20:25'),
(480, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:20:33', '2020-12-18 20:20:33'),
(481, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:21:38', '2020-12-18 20:21:38'),
(482, NULL, 3, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:21:52', '2020-12-18 20:21:52'),
(483, NULL, 3, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:22:23', '2020-12-18 20:22:23'),
(484, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 20:28:09', '2020-12-18 20:28:09'),
(485, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 20:33:13', '2020-12-18 20:33:13'),
(486, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:33:50', '2020-12-18 20:33:50'),
(487, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:34:39', '2020-12-18 20:34:39'),
(488, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:34:54', '2020-12-18 20:34:54'),
(489, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:35:25', '2020-12-18 20:35:25'),
(490, NULL, 1, 'product', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:35:29', '2020-12-18 20:35:29'),
(491, 'f', NULL, 'word', NULL, '2020-12-18 20:37:00', '2020-12-18 20:37:00'),
(492, 'b', NULL, 'word', NULL, '2020-12-18 20:37:10', '2020-12-18 20:37:10'),
(493, 'g', NULL, 'word', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:39:51', '2020-12-18 20:39:51'),
(494, 'S', NULL, 'word', 'I6V9Zs94ntOCRhVw00hqCHtnigRDhBNvKLjevEYCZkrLWQd5IC4zbDcIBF1G', '2020-12-18 20:39:56', '2020-12-18 20:39:56'),
(497, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-18 22:10:58', '2020-12-18 22:10:58'),
(498, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:08:05', '2020-12-18 23:08:05'),
(499, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:11:59', '2020-12-18 23:11:59'),
(500, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:15:02', '2020-12-18 23:15:02'),
(501, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:28:11', '2020-12-18 23:28:11'),
(502, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:36:53', '2020-12-18 23:36:53'),
(503, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:45:31', '2020-12-18 23:45:31'),
(504, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:47:36', '2020-12-18 23:47:36'),
(505, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:49:38', '2020-12-18 23:49:38'),
(506, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:51:38', '2020-12-18 23:51:38'),
(507, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:55:42', '2020-12-18 23:55:42'),
(508, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-18 23:57:27', '2020-12-18 23:57:27'),
(509, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:07:18', '2020-12-19 00:07:18'),
(510, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:10:00', '2020-12-19 00:10:00'),
(511, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:17:22', '2020-12-19 00:17:22'),
(512, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:20:37', '2020-12-19 00:20:37'),
(513, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:21:41', '2020-12-19 00:21:41'),
(514, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:24:44', '2020-12-19 00:24:44'),
(515, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:37:06', '2020-12-19 00:37:06'),
(516, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:37:56', '2020-12-19 00:37:56'),
(517, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 00:56:45', '2020-12-19 00:56:45'),
(518, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:02:50', '2020-12-19 01:02:50'),
(519, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:17:36', '2020-12-19 01:17:36'),
(520, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:22:46', '2020-12-19 01:22:46'),
(521, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:28:11', '2020-12-19 01:28:11'),
(522, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:32:18', '2020-12-19 01:32:18'),
(523, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:37:57', '2020-12-19 01:37:57'),
(524, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:38:11', '2020-12-19 01:38:11'),
(525, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:41:06', '2020-12-19 01:41:06'),
(526, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:41:46', '2020-12-19 01:41:46'),
(527, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:42:18', '2020-12-19 01:42:18'),
(528, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-19 01:45:55', '2020-12-19 01:45:55'),
(529, NULL, 1, 'product', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-19 01:46:15', '2020-12-19 01:46:15'),
(530, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-19 01:46:18', '2020-12-19 01:46:18'),
(531, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:51:47', '2020-12-19 01:51:47'),
(532, NULL, 1, 'product', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:52:30', '2020-12-19 01:52:30'),
(533, NULL, 1, 'product', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 01:52:46', '2020-12-19 01:52:46'),
(534, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 02:18:09', '2020-12-19 02:18:09'),
(535, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 02:19:50', '2020-12-19 02:19:50'),
(536, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 02:24:43', '2020-12-19 02:24:43'),
(537, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 02:26:24', '2020-12-19 02:26:24'),
(538, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 02:28:42', '2020-12-19 02:28:42'),
(539, 's', NULL, 'word', 'CumNf1YxH06E73G6cqDyssKqbizGydSOfu58SvXPyuSMlLBwW1P09Dr1wO3J', '2020-12-19 02:43:17', '2020-12-19 02:43:17'),
(540, NULL, 1, 'product', 'jbYz26tWFqpi6yY4Yc6FTQpyvyTZhj5TdblpZcH2BGeaQK5Zy1lgyOw8hLdD', '2020-12-19 02:47:27', '2020-12-19 02:47:27'),
(541, NULL, 2, 'product', 'jbYz26tWFqpi6yY4Yc6FTQpyvyTZhj5TdblpZcH2BGeaQK5Zy1lgyOw8hLdD', '2020-12-19 02:47:31', '2020-12-19 02:47:31'),
(542, 'S', NULL, 'word', 'jbYz26tWFqpi6yY4Yc6FTQpyvyTZhj5TdblpZcH2BGeaQK5Zy1lgyOw8hLdD', '2020-12-19 02:53:16', '2020-12-19 02:53:16'),
(543, NULL, 1, 'product', 'jbYz26tWFqpi6yY4Yc6FTQpyvyTZhj5TdblpZcH2BGeaQK5Zy1lgyOw8hLdD', '2020-12-19 02:53:23', '2020-12-19 02:53:23'),
(544, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:00:24', '2020-12-19 03:00:24'),
(545, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:00:57', '2020-12-19 03:00:57'),
(546, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:02:25', '2020-12-19 03:02:25'),
(547, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:04:37', '2020-12-19 03:04:37'),
(548, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:08:47', '2020-12-19 03:08:47'),
(549, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:10:09', '2020-12-19 03:10:09'),
(550, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:13:01', '2020-12-19 03:13:01'),
(551, NULL, 1, 'product', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:13:34', '2020-12-19 03:13:34'),
(552, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:13:35', '2020-12-19 03:13:35'),
(553, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:16:09', '2020-12-19 03:16:09'),
(554, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:18:50', '2020-12-19 03:18:50'),
(555, NULL, 3, 'product', 'aWMJHkCD0VVimnjr7qIIll0oyjsfe0Tsg19V5IPUfq9lejsANjzwjPkFcCHc', '2020-12-19 03:20:14', '2020-12-19 03:20:14'),
(556, NULL, 1, 'product', 'aWMJHkCD0VVimnjr7qIIll0oyjsfe0Tsg19V5IPUfq9lejsANjzwjPkFcCHc', '2020-12-19 03:20:19', '2020-12-19 03:20:19'),
(557, NULL, 1, 'product', 'aWMJHkCD0VVimnjr7qIIll0oyjsfe0Tsg19V5IPUfq9lejsANjzwjPkFcCHc', '2020-12-19 03:20:26', '2020-12-19 03:20:26'),
(558, NULL, 3, 'product', 'aWMJHkCD0VVimnjr7qIIll0oyjsfe0Tsg19V5IPUfq9lejsANjzwjPkFcCHc', '2020-12-19 03:20:32', '2020-12-19 03:20:32'),
(559, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:26:18', '2020-12-19 03:26:18'),
(560, NULL, 1, 'product', 'aWMJHkCD0VVimnjr7qIIll0oyjsfe0Tsg19V5IPUfq9lejsANjzwjPkFcCHc', '2020-12-19 03:38:23', '2020-12-19 03:38:23'),
(561, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:50:11', '2020-12-19 03:50:11'),
(562, NULL, 3, 'product', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:50:50', '2020-12-19 03:50:50'),
(563, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 03:55:04', '2020-12-19 03:55:04'),
(564, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:02:59', '2020-12-19 04:02:59'),
(565, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:04:18', '2020-12-19 04:04:18'),
(566, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:07:40', '2020-12-19 04:07:40'),
(567, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:26:19', '2020-12-19 04:26:19'),
(568, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:28:29', '2020-12-19 04:28:29'),
(569, NULL, NULL, 'word', 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")', '2020-12-19 04:29:59', '2020-12-19 04:29:59'),
(571, NULL, 3, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 06:37:39', '2020-12-19 06:37:39'),
(572, NULL, 1, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 07:30:08', '2020-12-19 07:30:08'),
(573, NULL, 1, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 07:30:16', '2020-12-19 07:30:16'),
(574, NULL, 3, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 07:30:20', '2020-12-19 07:30:20'),
(575, NULL, 3, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 07:30:24', '2020-12-19 07:30:24'),
(576, NULL, 1, 'product', 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")', '2020-12-19 14:10:45', '2020-12-19 14:10:45'),
(577, NULL, 1, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 19:27:44', '2020-12-19 19:27:44'),
(578, NULL, 1, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 19:28:31', '2020-12-19 19:28:31'),
(579, NULL, 1, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 19:28:55', '2020-12-19 19:28:55'),
(580, NULL, 3, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 19:29:59', '2020-12-19 19:29:59'),
(581, NULL, 3, 'product', 'T22UBECUSVDIM6wlOwiL8ml5FE7HAUv04KIbH7zaSPOYC0z4R1KKZme67xmm', '2020-12-19 19:30:42', '2020-12-19 19:30:42'),
(588, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 21:23:39', '2020-12-19 21:23:39'),
(589, NULL, 2, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 21:30:58', '2020-12-19 21:30:58'),
(590, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:15:40', '2020-12-19 22:15:40'),
(591, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:15:51', '2020-12-19 22:15:51'),
(592, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:20:41', '2020-12-19 22:20:41'),
(593, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:31:55', '2020-12-19 22:31:55'),
(594, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:31:58', '2020-12-19 22:31:58'),
(595, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:32:01', '2020-12-19 22:32:01'),
(596, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:32:12', '2020-12-19 22:32:12'),
(597, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:32:15', '2020-12-19 22:32:15'),
(598, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:32:22', '2020-12-19 22:32:22'),
(599, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:33:49', '2020-12-19 22:33:49'),
(600, NULL, 1, 'product', 'O7XDtDon1uqP9hLofUqo00qVvWCVWZTs2HU8wE9UrejQaqWM82AyzWmsEj9w', '2020-12-19 22:35:23', '2020-12-19 22:35:23'),
(601, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:39:03', '2020-12-19 23:39:03'),
(602, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:39:22', '2020-12-19 23:39:22'),
(603, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:39:37', '2020-12-19 23:39:37'),
(604, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:39:43', '2020-12-19 23:39:43'),
(605, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:39:45', '2020-12-19 23:39:45'),
(606, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:40:04', '2020-12-19 23:40:04'),
(607, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:40:06', '2020-12-19 23:40:06'),
(608, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:40:44', '2020-12-19 23:40:44'),
(609, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:40:52', '2020-12-19 23:40:52'),
(610, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:41:49', '2020-12-19 23:41:49'),
(611, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:44:44', '2020-12-19 23:44:44'),
(612, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:45:59', '2020-12-19 23:45:59'),
(613, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:48:36', '2020-12-19 23:48:36'),
(614, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:50:05', '2020-12-19 23:50:05'),
(615, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:52:47', '2020-12-19 23:52:47'),
(616, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:52:55', '2020-12-19 23:52:55'),
(617, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:52:58', '2020-12-19 23:52:58'),
(618, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:54:36', '2020-12-19 23:54:36'),
(619, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:55:50', '2020-12-19 23:55:50'),
(620, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:56:10', '2020-12-19 23:56:10'),
(621, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:56:17', '2020-12-19 23:56:17'),
(622, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:56:30', '2020-12-19 23:56:30'),
(623, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:56:52', '2020-12-19 23:56:52'),
(624, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:56:54', '2020-12-19 23:56:54'),
(625, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:59:25', '2020-12-19 23:59:25'),
(626, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:59:35', '2020-12-19 23:59:35'),
(627, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:59:41', '2020-12-19 23:59:41'),
(628, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-19 23:59:45', '2020-12-19 23:59:45'),
(629, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:00:14', '2020-12-20 00:00:14'),
(630, NULL, 2, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:00:33', '2020-12-20 00:00:33'),
(631, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:07:51', '2020-12-20 00:07:51'),
(632, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:12:04', '2020-12-20 00:12:04'),
(633, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:12:20', '2020-12-20 00:12:20'),
(634, NULL, 2, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:12:33', '2020-12-20 00:12:33'),
(635, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:12:35', '2020-12-20 00:12:35'),
(636, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:13:19', '2020-12-20 00:13:19'),
(637, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:13:34', '2020-12-20 00:13:34'),
(638, NULL, 2, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:14:27', '2020-12-20 00:14:27'),
(639, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:14:39', '2020-12-20 00:14:39'),
(640, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:14:45', '2020-12-20 00:14:45'),
(641, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 00:15:59', '2020-12-20 00:15:59'),
(642, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:00:29', '2020-12-20 01:00:29'),
(643, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:00:34', '2020-12-20 01:00:34'),
(644, NULL, 3, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 01:00:37', '2020-12-20 01:00:37'),
(645, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 01:00:50', '2020-12-20 01:00:50'),
(646, NULL, 1, 'product', 'b5ue5hMpPewRaD1aoVo2HwWaqeRXfNk10wfnbfEycf9Tb7E21Z4OEQvJm7r9', '2020-12-20 01:00:59', '2020-12-20 01:00:59'),
(647, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:01:48', '2020-12-20 01:01:48'),
(648, NULL, NULL, 'word', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:24:30', '2020-12-20 01:24:30'),
(649, NULL, NULL, 'word', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:31:26', '2020-12-20 01:31:26'),
(650, NULL, NULL, 'word', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:32:32', '2020-12-20 01:32:32'),
(651, NULL, NULL, 'word', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:33:39', '2020-12-20 01:33:39'),
(652, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:46:40', '2020-12-20 01:46:40'),
(653, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:47:32', '2020-12-20 01:47:32'),
(654, NULL, 1, 'product', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 01:47:38', '2020-12-20 01:47:38'),
(655, NULL, NULL, 'word', 'AOyMq6xaFqFLFhKbYwtysCy7Fcx5zHpwgONqKqw1k8cwVAyhu7P18CgZX2Uc', '2020-12-20 02:08:40', '2020-12-20 02:08:40'),
(662, NULL, 3, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 03:51:52', '2020-12-20 03:51:52'),
(663, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 03:58:03', '2020-12-20 03:58:03'),
(664, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 03:59:39', '2020-12-20 03:59:39'),
(665, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:00:30', '2020-12-20 04:00:30'),
(666, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:01:04', '2020-12-20 04:01:04'),
(667, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:01:44', '2020-12-20 04:01:44'),
(668, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:02:33', '2020-12-20 04:02:33'),
(669, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:03:13', '2020-12-20 04:03:13'),
(670, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:04:35', '2020-12-20 04:04:35'),
(671, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:05:38', '2020-12-20 04:05:38'),
(672, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:07:02', '2020-12-20 04:07:02'),
(673, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:07:40', '2020-12-20 04:07:40'),
(674, NULL, 1, 'product', 'NGwhCbZdS88ItILJcz3wDBjSJ68pWfrTR3YTsBTQoR7Y6JONrkKmX0u4oBf9', '2020-12-20 04:59:06', '2020-12-20 04:59:06'),
(675, NULL, 1, 'product', 'qFHH6s2HvWpZKnVayZpdObj5CqpiKQFKzgVicSmXOzO6fgfpzc95y6bsCcbf', '2020-12-20 05:03:58', '2020-12-20 05:03:58'),
(676, NULL, 1, 'product', 'ptKgiChRiHzt9okh3pU6c3NxM74u2JbFXgFZtOlDjo31xy0RXHiHigVJnlkB', '2020-12-20 05:04:54', '2020-12-20 05:04:54'),
(677, NULL, 3, 'product', 'ptKgiChRiHzt9okh3pU6c3NxM74u2JbFXgFZtOlDjo31xy0RXHiHigVJnlkB', '2020-12-20 05:05:06', '2020-12-20 05:05:06'),
(678, NULL, 1, 'product', 'ptKgiChRiHzt9okh3pU6c3NxM74u2JbFXgFZtOlDjo31xy0RXHiHigVJnlkB', '2020-12-20 05:06:14', '2020-12-20 05:06:14'),
(679, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:10:03', '2020-12-20 05:10:03'),
(680, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:10:13', '2020-12-20 05:10:13'),
(681, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:10:19', '2020-12-20 05:10:19'),
(682, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:12:37', '2020-12-20 05:12:37'),
(683, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:13:00', '2020-12-20 05:13:00'),
(684, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:13:10', '2020-12-20 05:13:10'),
(685, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:13:17', '2020-12-20 05:13:17');
INSERT INTO `recentlies` (`id`, `word`, `product_id`, `kind`, `device_token`, `created_at`, `updated_at`) VALUES
(686, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:13:37', '2020-12-20 05:13:37'),
(687, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:13:42', '2020-12-20 05:13:42'),
(688, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:21', '2020-12-20 05:14:21'),
(689, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:27', '2020-12-20 05:14:27'),
(690, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:34', '2020-12-20 05:14:34'),
(691, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:37', '2020-12-20 05:14:37'),
(692, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:50', '2020-12-20 05:14:50'),
(693, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:54', '2020-12-20 05:14:54'),
(694, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:14:57', '2020-12-20 05:14:57'),
(695, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:15:02', '2020-12-20 05:15:02'),
(696, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:16:10', '2020-12-20 05:16:10'),
(697, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:16:18', '2020-12-20 05:16:18'),
(699, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:16:23', '2020-12-20 05:16:23'),
(702, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:17:53', '2020-12-20 05:17:53'),
(704, NULL, 2, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:17:57', '2020-12-20 05:17:57'),
(706, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:18:00', '2020-12-20 05:18:00'),
(707, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:18:06', '2020-12-20 05:18:06'),
(708, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:25:24', '2020-12-20 05:25:24'),
(709, NULL, 3, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 05:25:40', '2020-12-20 05:25:40'),
(712, NULL, 1, 'product', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 12:21:32', '2020-12-20 12:21:32'),
(713, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 12:39:12', '2020-12-20 12:39:12'),
(714, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 12:42:02', '2020-12-20 12:42:02'),
(715, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-20 12:42:06', '2020-12-20 12:42:06'),
(716, NULL, 1, 'product', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-20 19:34:03', '2020-12-20 19:34:03'),
(717, NULL, 2, 'product', 'Optional(\"60C5DCC8-1138-451B-B022-60B6221FE712\")', '2020-12-21 02:58:45', '2020-12-21 02:58:45'),
(718, NULL, 1, 'product', 'Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0', '2020-12-21 03:34:32', '2020-12-21 03:34:32'),
(719, NULL, 1, 'product', 'Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0', '2020-12-21 03:36:24', '2020-12-21 03:36:24'),
(720, NULL, 1, 'product', 'Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0', '2020-12-21 03:40:52', '2020-12-21 03:40:52'),
(721, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:00:00', '2020-12-21 13:00:00'),
(722, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:01:34', '2020-12-21 13:01:34'),
(723, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:02:38', '2020-12-21 13:02:38'),
(724, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:04:33', '2020-12-21 13:04:33'),
(725, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:05:09', '2020-12-21 13:05:09'),
(726, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:05:55', '2020-12-21 13:05:55'),
(727, NULL, NULL, 'word', 'oR33pSmqdKRAFV2wA438qaUPzEb0ZteE2CNjCZEBaL7eJW3xCx0Rit0SDG8z', '2020-12-21 13:08:18', '2020-12-21 13:08:18'),
(746, NULL, NULL, 'word', 'Optional(\"26F457D2-C48E-4385-8CD6-AD9505B89FBC\")', '2020-12-21 14:44:22', '2020-12-21 14:44:22'),
(756, NULL, 1, 'product', 'jir4alJmVYKCJL7padC6cGCFuFqUpWyUKRW97PT6qTsQC2WC47SJXGWoQ48x', '2020-12-21 16:09:19', '2020-12-21 16:09:19'),
(757, NULL, 1, 'product', 'jir4alJmVYKCJL7padC6cGCFuFqUpWyUKRW97PT6qTsQC2WC47SJXGWoQ48x', '2020-12-21 16:09:33', '2020-12-21 16:09:33'),
(758, NULL, 1, 'product', 'jir4alJmVYKCJL7padC6cGCFuFqUpWyUKRW97PT6qTsQC2WC47SJXGWoQ48x', '2020-12-21 16:11:24', '2020-12-21 16:11:24'),
(759, NULL, 1, 'product', 'jir4alJmVYKCJL7padC6cGCFuFqUpWyUKRW97PT6qTsQC2WC47SJXGWoQ48x', '2020-12-21 16:11:45', '2020-12-21 16:11:45'),
(760, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:45:25', '2020-12-21 16:45:25'),
(761, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:49:03', '2020-12-21 16:49:03'),
(762, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:51:28', '2020-12-21 16:51:28'),
(763, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:52:21', '2020-12-21 16:52:21'),
(764, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:54:34', '2020-12-21 16:54:34'),
(765, NULL, 1, 'product', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila', '2020-12-21 16:58:17', '2020-12-21 16:58:17'),
(770, NULL, 3, 'product', 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")', '2020-12-21 17:17:37', '2020-12-21 17:17:37'),
(771, NULL, 3, 'product', 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")', '2020-12-21 17:17:55', '2020-12-21 17:17:55'),
(772, NULL, 1, 'product', 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")', '2020-12-21 17:17:58', '2020-12-21 17:17:58'),
(776, NULL, NULL, 'word', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 00:28:46', '2020-12-22 00:28:46'),
(777, NULL, 1, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 00:28:53', '2020-12-22 00:28:53'),
(778, NULL, NULL, 'word', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 00:29:01', '2020-12-22 00:29:01'),
(779, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 02:46:27', '2020-12-22 02:46:27'),
(780, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 02:46:31', '2020-12-22 02:46:31'),
(781, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 02:46:51', '2020-12-22 02:46:51'),
(784, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 10:47:48', '2020-12-22 10:47:48'),
(785, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2020-12-22 10:47:49', '2020-12-22 10:47:49'),
(786, NULL, 1, 'product', 'GiDKu9leUhwMpXt4PG20aq56ZVUK8MLKhRBi9d6hcpCdHQT5pdwwlFMCU1lE', '2020-12-22 15:06:18', '2020-12-22 15:06:18'),
(787, NULL, 3, 'product', 'GiDKu9leUhwMpXt4PG20aq56ZVUK8MLKhRBi9d6hcpCdHQT5pdwwlFMCU1lE', '2020-12-22 15:07:22', '2020-12-22 15:07:22'),
(788, NULL, 3, 'product', 'GiDKu9leUhwMpXt4PG20aq56ZVUK8MLKhRBi9d6hcpCdHQT5pdwwlFMCU1lE', '2020-12-22 15:08:10', '2020-12-22 15:08:10'),
(789, NULL, 3, 'product', 'yOtieEQfj83JQUKuvpeowV44FWmWn6OXFjVqy9UThUqX39RtSbHelmr6sgXO', '2020-12-30 01:59:28', '2020-12-30 01:59:28'),
(790, NULL, 1, 'product', 'Optional(\"3FB509D1-6C39-415B-9FC8-9CE32DDDB477\")', '2021-01-02 22:55:58', '2021-01-02 22:55:58'),
(791, NULL, 1, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2021-01-03 17:16:39', '2021-01-03 17:16:39'),
(792, NULL, 2, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2021-01-03 17:16:56', '2021-01-03 17:16:56'),
(793, NULL, 1, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2021-01-03 17:37:50', '2021-01-03 17:37:50'),
(794, NULL, 1, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2021-01-03 17:37:54', '2021-01-03 17:37:54'),
(795, NULL, 1, 'product', 'Optional(\"8807733D-BEF6-4323-8B9E-DD94121F0215\")', '2021-01-05 15:14:38', '2021-01-05 15:14:38'),
(796, NULL, 1, 'product', 'Optional(\"8807733D-BEF6-4323-8B9E-DD94121F0215\")', '2021-01-05 15:15:36', '2021-01-05 15:15:36'),
(797, NULL, 3, 'product', 'Optional(\"8807733D-BEF6-4323-8B9E-DD94121F0215\")', '2021-01-05 15:45:13', '2021-01-05 15:45:13'),
(798, NULL, 3, 'product', 'Optional(\"8807733D-BEF6-4323-8B9E-DD94121F0215\")', '2021-01-05 15:47:45', '2021-01-05 15:47:45'),
(799, NULL, 3, 'product', 'Optional(\"8807733D-BEF6-4323-8B9E-DD94121F0215\")', '2021-01-05 15:48:55', '2021-01-05 15:48:55'),
(801, NULL, 1, 'product', 'qU90uTloqYwOrL2NTQZATiC8dtIAl0Lw1f1skH4SCShRJP8n55bNt8XZvGQZ', '2021-01-07 00:39:25', '2021-01-07 00:39:25'),
(802, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:01:24', '2021-01-07 03:01:24'),
(803, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:01:31', '2021-01-07 03:01:31'),
(804, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:06:10', '2021-01-07 03:06:10'),
(805, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:06:42', '2021-01-07 03:06:42'),
(806, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:09:48', '2021-01-07 03:09:48'),
(807, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:10:56', '2021-01-07 03:10:56'),
(808, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:14:13', '2021-01-07 03:14:13'),
(809, NULL, 2, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:36:30', '2021-01-07 03:36:30'),
(810, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:36:33', '2021-01-07 03:36:33'),
(811, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:36:47', '2021-01-07 03:36:47'),
(812, NULL, 3, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:37:31', '2021-01-07 03:37:31'),
(813, NULL, 1, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 03:38:28', '2021-01-07 03:38:28'),
(814, NULL, 2, 'product', '0QAj2FGmjokwUVRnIt4HtqGC4BACNOJ0hdeSBsHaAgWxdlLPEzzJYtlkK83Y', '2021-01-07 04:07:30', '2021-01-07 04:07:30'),
(815, NULL, 2, 'product', '6Yur2tpjODhcLY2BTJRxUkvxtCFjr1P1lRCaMFLaDktIyHn0lezLJNOQ4bUG', '2021-01-07 04:10:56', '2021-01-07 04:10:56'),
(823, NULL, 2, 'product', 'JAXhn6Pur79bQsuXOX4jEgYOilY3ZVfW1qljHeCG89QNtGKiAonQbtjbsTEQ', '2021-01-07 06:40:37', '2021-01-07 06:40:37'),
(824, NULL, 3, 'product', 'JAXhn6Pur79bQsuXOX4jEgYOilY3ZVfW1qljHeCG89QNtGKiAonQbtjbsTEQ', '2021-01-07 07:20:12', '2021-01-07 07:20:12'),
(825, NULL, 3, 'product', 'BhAE4L6QGO7cQey83pd2iyihTO4DRCYvDgltNsLe1pZJRPCrhP42umh20C3H', '2021-01-07 07:40:50', '2021-01-07 07:40:50'),
(826, NULL, 3, 'product', 'BhAE4L6QGO7cQey83pd2iyihTO4DRCYvDgltNsLe1pZJRPCrhP42umh20C3H', '2021-01-07 07:56:24', '2021-01-07 07:56:24'),
(827, NULL, 1, 'product', 'BhAE4L6QGO7cQey83pd2iyihTO4DRCYvDgltNsLe1pZJRPCrhP42umh20C3H', '2021-01-07 07:56:40', '2021-01-07 07:56:40'),
(828, NULL, 1, 'product', 'BhAE4L6QGO7cQey83pd2iyihTO4DRCYvDgltNsLe1pZJRPCrhP42umh20C3H', '2021-01-07 07:58:52', '2021-01-07 07:58:52'),
(829, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 21:40:13', '2021-01-07 21:40:13'),
(830, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 21:55:28', '2021-01-07 21:55:28'),
(831, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 21:59:59', '2021-01-07 21:59:59'),
(832, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 22:51:59', '2021-01-07 22:51:59'),
(833, NULL, 3, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 23:08:55', '2021-01-07 23:08:55'),
(834, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 23:08:57', '2021-01-07 23:08:57'),
(835, NULL, 3, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 23:57:49', '2021-01-07 23:57:49'),
(836, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 23:57:53', '2021-01-07 23:57:53'),
(837, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-07 23:59:14', '2021-01-07 23:59:14'),
(838, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:02:59', '2021-01-08 00:02:59'),
(839, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:03:02', '2021-01-08 00:03:02'),
(840, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:07:57', '2021-01-08 00:07:57'),
(841, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:08:00', '2021-01-08 00:08:00'),
(842, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:10:40', '2021-01-08 00:10:40'),
(843, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:10:42', '2021-01-08 00:10:42'),
(844, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:11:46', '2021-01-08 00:11:46'),
(845, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:11:48', '2021-01-08 00:11:48'),
(846, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:12:24', '2021-01-08 00:12:24'),
(847, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:12:26', '2021-01-08 00:12:26'),
(848, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:17:14', '2021-01-08 00:17:14'),
(849, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:17:16', '2021-01-08 00:17:16'),
(850, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:19:13', '2021-01-08 00:19:13'),
(851, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:19:16', '2021-01-08 00:19:16'),
(852, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:24:52', '2021-01-08 00:24:52'),
(853, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:24:53', '2021-01-08 00:24:53'),
(854, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:24:58', '2021-01-08 00:24:58'),
(855, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:25:01', '2021-01-08 00:25:01'),
(856, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:25:05', '2021-01-08 00:25:05'),
(857, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:27:47', '2021-01-08 00:27:47'),
(858, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:32:59', '2021-01-08 00:32:59'),
(859, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:33:01', '2021-01-08 00:33:01'),
(860, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:37:08', '2021-01-08 00:37:08'),
(861, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:37:10', '2021-01-08 00:37:10'),
(862, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:38:13', '2021-01-08 00:38:13'),
(863, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:38:15', '2021-01-08 00:38:15'),
(864, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:38:56', '2021-01-08 00:38:56'),
(865, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:38:58', '2021-01-08 00:38:58'),
(866, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:39:01', '2021-01-08 00:39:01'),
(867, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:39:02', '2021-01-08 00:39:02'),
(868, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:40:14', '2021-01-08 00:40:14'),
(869, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:40:18', '2021-01-08 00:40:18'),
(870, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:41:04', '2021-01-08 00:41:04'),
(871, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:42:58', '2021-01-08 00:42:58'),
(872, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:45:16', '2021-01-08 00:45:16'),
(873, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:45:18', '2021-01-08 00:45:18'),
(874, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:31', '2021-01-08 00:47:31'),
(875, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:33', '2021-01-08 00:47:33'),
(876, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:36', '2021-01-08 00:47:36'),
(877, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:38', '2021-01-08 00:47:38'),
(878, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:40', '2021-01-08 00:47:40'),
(879, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:42', '2021-01-08 00:47:42'),
(880, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:47:51', '2021-01-08 00:47:51'),
(881, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:20', '2021-01-08 00:48:20'),
(882, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:39', '2021-01-08 00:48:39'),
(883, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:44', '2021-01-08 00:48:44'),
(884, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:46', '2021-01-08 00:48:46'),
(885, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:47', '2021-01-08 00:48:47'),
(886, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:48:56', '2021-01-08 00:48:56'),
(887, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:08', '2021-01-08 00:49:08'),
(888, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:10', '2021-01-08 00:49:10'),
(889, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:13', '2021-01-08 00:49:13'),
(890, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:14', '2021-01-08 00:49:14'),
(891, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:17', '2021-01-08 00:49:17'),
(892, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:28', '2021-01-08 00:49:28'),
(893, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:32', '2021-01-08 00:49:32'),
(894, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:49:49', '2021-01-08 00:49:49'),
(895, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:50:42', '2021-01-08 00:50:42'),
(896, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:50:48', '2021-01-08 00:50:48'),
(897, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:51:17', '2021-01-08 00:51:17'),
(898, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:51:22', '2021-01-08 00:51:22'),
(899, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:51:28', '2021-01-08 00:51:28'),
(900, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:57:10', '2021-01-08 00:57:10'),
(901, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 00:57:14', '2021-01-08 00:57:14'),
(902, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:00:22', '2021-01-08 01:00:22'),
(903, NULL, NULL, 'word', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:01:22', '2021-01-08 01:01:22'),
(904, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:03:11', '2021-01-08 01:03:11'),
(905, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:03:12', '2021-01-08 01:03:12'),
(906, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:07:05', '2021-01-08 01:07:05'),
(907, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:09:00', '2021-01-08 01:09:00'),
(908, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:09:01', '2021-01-08 01:09:01'),
(909, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:16:36', '2021-01-08 01:16:36'),
(910, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:18:14', '2021-01-08 01:18:14'),
(911, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:18:26', '2021-01-08 01:18:26'),
(912, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:18:30', '2021-01-08 01:18:30'),
(913, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:18:31', '2021-01-08 01:18:31'),
(914, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:20:02', '2021-01-08 01:20:02'),
(915, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:24:00', '2021-01-08 01:24:00'),
(916, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:25:01', '2021-01-08 01:25:01'),
(917, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:25:28', '2021-01-08 01:25:28'),
(918, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:25:33', '2021-01-08 01:25:33'),
(919, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:26:23', '2021-01-08 01:26:23'),
(920, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:29:20', '2021-01-08 01:29:20'),
(921, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:30:43', '2021-01-08 01:30:43'),
(922, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:31:25', '2021-01-08 01:31:25'),
(923, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:32:31', '2021-01-08 01:32:31'),
(924, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:33:32', '2021-01-08 01:33:32'),
(925, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:34:14', '2021-01-08 01:34:14'),
(926, NULL, 3, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:34:25', '2021-01-08 01:34:25'),
(927, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:34:26', '2021-01-08 01:34:26'),
(928, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:36:45', '2021-01-08 01:36:45'),
(929, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:36:53', '2021-01-08 01:36:53'),
(930, NULL, 3, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:37:02', '2021-01-08 01:37:02'),
(931, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:38:02', '2021-01-08 01:38:02'),
(932, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:39:05', '2021-01-08 01:39:05'),
(933, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:39:23', '2021-01-08 01:39:23'),
(934, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:41:41', '2021-01-08 01:41:41'),
(935, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:41:46', '2021-01-08 01:41:46'),
(936, NULL, 1, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:42:37', '2021-01-08 01:42:37'),
(937, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:43:52', '2021-01-08 01:43:52'),
(938, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:44:28', '2021-01-08 01:44:28'),
(939, NULL, 2, 'product', 'lrwMDOaYPQgymkiYdAYneo8rDsf4GBQykPNN1eKVf5tNfbu7Iin6eZ1zqGjw', '2021-01-08 01:46:00', '2021-01-08 01:46:00'),
(940, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 01:54:20', '2021-01-08 01:54:20'),
(941, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 01:54:21', '2021-01-08 01:54:21'),
(942, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 01:54:26', '2021-01-08 01:54:26'),
(943, NULL, NULL, 'word', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 02:02:52', '2021-01-08 02:02:52'),
(944, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 04:28:08', '2021-01-08 04:28:08'),
(945, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 04:28:10', '2021-01-08 04:28:10'),
(946, NULL, 1, 'product', 'jWbmJpoK0dO4rjTYhqTs9DHnC4NJRZhCRyEW0OqHFtLx66sTNJjKFQYJumso', '2021-01-08 04:28:18', '2021-01-08 04:28:18'),
(947, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:47:19', '2021-01-09 16:47:19'),
(948, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:47:33', '2021-01-09 16:47:33'),
(949, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:47:43', '2021-01-09 16:47:43'),
(950, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:52:00', '2021-01-09 16:52:00'),
(951, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:52:05', '2021-01-09 16:52:05'),
(952, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:56:36', '2021-01-09 16:56:36'),
(954, NULL, 1, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:58:11', '2021-01-09 16:58:11'),
(955, NULL, 2, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 16:59:45', '2021-01-09 16:59:45'),
(956, NULL, 2, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 17:00:00', '2021-01-09 17:00:00'),
(957, NULL, 3, 'product', 'J7rr2BggfZMyMEVqWMl6t4NWRGeNMH6bu3S2n01LzuryHSHNdx76HdOailbD', '2021-01-09 17:01:31', '2021-01-09 17:01:31'),
(958, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:14:38', '2021-01-09 17:14:38'),
(959, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:14:45', '2021-01-09 17:14:45'),
(960, NULL, 2, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:14:47', '2021-01-09 17:14:47'),
(961, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:14:48', '2021-01-09 17:14:48'),
(962, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:17', '2021-01-09 17:15:17'),
(963, NULL, 2, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:24', '2021-01-09 17:15:24'),
(964, NULL, 2, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:26', '2021-01-09 17:15:26'),
(965, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:37', '2021-01-09 17:15:37'),
(966, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:56', '2021-01-09 17:15:56'),
(967, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:15:59', '2021-01-09 17:15:59'),
(968, NULL, NULL, 'word', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:16:09', '2021-01-09 17:16:09'),
(969, NULL, 2, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-09 17:17:21', '2021-01-09 17:17:21'),
(970, NULL, 1, 'product', 'UlhZjeqXEysRFfa9ktW8gU3qHGcf640lCpUvWDrtd8Eon91ef40JhJZYCNlA', '2021-01-09 17:18:04', '2021-01-09 17:18:04'),
(971, NULL, 1, 'product', 'UlhZjeqXEysRFfa9ktW8gU3qHGcf640lCpUvWDrtd8Eon91ef40JhJZYCNlA', '2021-01-09 17:18:07', '2021-01-09 17:18:07'),
(972, NULL, 1, 'product', 'UlhZjeqXEysRFfa9ktW8gU3qHGcf640lCpUvWDrtd8Eon91ef40JhJZYCNlA', '2021-01-09 17:18:16', '2021-01-09 17:18:16'),
(973, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:02:43', '2021-01-09 22:02:43'),
(974, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:02:44', '2021-01-09 22:02:44'),
(975, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:02:50', '2021-01-09 22:02:50'),
(976, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:03:10', '2021-01-09 22:03:10'),
(977, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:03:27', '2021-01-09 22:03:27'),
(978, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:03:32', '2021-01-09 22:03:32'),
(979, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:03:33', '2021-01-09 22:03:33'),
(980, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:03:34', '2021-01-09 22:03:34'),
(981, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:09:43', '2021-01-09 22:09:43'),
(982, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:09:44', '2021-01-09 22:09:44'),
(983, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 22:09:54', '2021-01-09 22:09:54'),
(984, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 23:47:45', '2021-01-09 23:47:45'),
(985, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 23:47:47', '2021-01-09 23:47:47'),
(986, NULL, NULL, 'word', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 23:49:24', '2021-01-09 23:49:24'),
(987, NULL, 1, 'product', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-09 23:50:36', '2021-01-09 23:50:36'),
(988, NULL, 3, 'product', 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")', '2021-01-09 23:59:14', '2021-01-09 23:59:14'),
(989, NULL, NULL, 'word', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-10 00:02:13', '2021-01-10 00:02:13'),
(990, NULL, NULL, 'word', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-10 01:39:59', '2021-01-10 01:39:59'),
(991, NULL, NULL, 'word', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-10 01:40:31', '2021-01-10 01:40:31'),
(992, NULL, NULL, 'word', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-10 01:42:30', '2021-01-10 01:42:30'),
(993, NULL, NULL, 'word', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-10 01:43:22', '2021-01-10 01:43:22'),
(994, NULL, NULL, 'word', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-10 01:51:17', '2021-01-10 01:51:17'),
(995, NULL, NULL, 'word', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-10 01:52:18', '2021-01-10 01:52:18'),
(996, NULL, NULL, 'word', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-10 01:54:13', '2021-01-10 01:54:13'),
(997, NULL, NULL, 'word', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-10 01:56:44', '2021-01-10 01:56:44'),
(998, NULL, NULL, 'word', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-10 02:03:34', '2021-01-10 02:03:34'),
(999, NULL, NULL, 'word', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-10 02:25:18', '2021-01-10 02:25:18'),
(1000, NULL, NULL, 'word', 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")', '2021-01-10 03:41:47', '2021-01-10 03:41:47'),
(1001, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 03:58:20', '2021-01-10 03:58:20'),
(1002, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 03:58:22', '2021-01-10 03:58:22'),
(1003, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 03:58:24', '2021-01-10 03:58:24'),
(1004, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 03:58:26', '2021-01-10 03:58:26'),
(1005, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 03:58:45', '2021-01-10 03:58:45'),
(1006, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:01:17', '2021-01-10 04:01:17'),
(1007, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:02:51', '2021-01-10 04:02:51'),
(1008, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:08', '2021-01-10 04:06:08'),
(1009, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:09', '2021-01-10 04:06:09'),
(1010, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:11', '2021-01-10 04:06:11'),
(1011, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:12', '2021-01-10 04:06:12'),
(1012, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:13', '2021-01-10 04:06:13'),
(1013, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:14', '2021-01-10 04:06:14'),
(1014, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:15', '2021-01-10 04:06:15'),
(1015, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:16', '2021-01-10 04:06:16'),
(1016, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:18', '2021-01-10 04:06:18'),
(1017, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:19', '2021-01-10 04:06:19'),
(1018, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:22', '2021-01-10 04:06:22'),
(1019, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:06:23', '2021-01-10 04:06:23'),
(1020, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:14', '2021-01-10 04:07:14'),
(1021, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:15', '2021-01-10 04:07:15'),
(1022, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:16', '2021-01-10 04:07:16'),
(1023, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:17', '2021-01-10 04:07:17'),
(1024, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:18', '2021-01-10 04:07:18'),
(1025, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:19', '2021-01-10 04:07:19'),
(1026, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:20', '2021-01-10 04:07:20'),
(1027, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:21', '2021-01-10 04:07:21'),
(1028, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:22', '2021-01-10 04:07:22'),
(1029, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:23', '2021-01-10 04:07:23'),
(1030, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:24', '2021-01-10 04:07:24'),
(1031, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:25', '2021-01-10 04:07:25'),
(1032, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:55', '2021-01-10 04:07:55'),
(1033, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:07:57', '2021-01-10 04:07:57'),
(1034, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:00', '2021-01-10 04:08:00'),
(1035, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:02', '2021-01-10 04:08:02'),
(1036, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:06', '2021-01-10 04:08:06'),
(1037, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:08', '2021-01-10 04:08:08'),
(1038, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:10', '2021-01-10 04:08:10'),
(1039, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:13', '2021-01-10 04:08:13'),
(1040, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:24', '2021-01-10 04:08:24'),
(1041, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:08:25', '2021-01-10 04:08:25'),
(1042, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:07', '2021-01-10 04:09:07'),
(1043, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:08', '2021-01-10 04:09:08'),
(1044, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:17', '2021-01-10 04:09:17'),
(1045, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:18', '2021-01-10 04:09:18'),
(1046, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:50', '2021-01-10 04:09:50'),
(1047, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:51', '2021-01-10 04:09:51'),
(1048, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:53', '2021-01-10 04:09:53'),
(1049, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:55', '2021-01-10 04:09:55'),
(1050, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:09:56', '2021-01-10 04:09:56'),
(1051, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:10:42', '2021-01-10 04:10:42'),
(1052, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:10:43', '2021-01-10 04:10:43'),
(1053, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:10:44', '2021-01-10 04:10:44'),
(1054, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:10:45', '2021-01-10 04:10:45'),
(1055, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:12', '2021-01-10 04:11:12'),
(1056, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:13', '2021-01-10 04:11:13'),
(1057, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:16', '2021-01-10 04:11:16'),
(1058, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:17', '2021-01-10 04:11:17'),
(1059, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:47', '2021-01-10 04:11:47'),
(1060, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:11:49', '2021-01-10 04:11:49'),
(1061, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:18', '2021-01-10 04:12:18'),
(1062, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:20', '2021-01-10 04:12:20'),
(1063, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:23', '2021-01-10 04:12:23'),
(1064, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:25', '2021-01-10 04:12:25'),
(1065, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:27', '2021-01-10 04:12:27'),
(1066, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:12:32', '2021-01-10 04:12:32'),
(1067, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:13', '2021-01-10 04:13:13'),
(1068, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:14', '2021-01-10 04:13:14'),
(1069, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:16', '2021-01-10 04:13:16'),
(1070, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:16', '2021-01-10 04:13:16'),
(1071, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:18', '2021-01-10 04:13:18'),
(1072, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:19', '2021-01-10 04:13:19'),
(1073, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:20', '2021-01-10 04:13:20'),
(1074, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:21', '2021-01-10 04:13:21'),
(1075, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:22', '2021-01-10 04:13:22'),
(1076, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:23', '2021-01-10 04:13:23'),
(1077, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:29', '2021-01-10 04:13:29'),
(1078, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:13:30', '2021-01-10 04:13:30'),
(1079, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:14:02', '2021-01-10 04:14:02'),
(1080, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:14:02', '2021-01-10 04:14:02'),
(1081, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:40', '2021-01-10 04:22:40'),
(1082, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:40', '2021-01-10 04:22:40'),
(1083, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:42', '2021-01-10 04:22:42'),
(1084, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:43', '2021-01-10 04:22:43'),
(1085, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:44', '2021-01-10 04:22:44'),
(1086, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:46', '2021-01-10 04:22:46'),
(1087, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:22:47', '2021-01-10 04:22:47'),
(1088, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:23:12', '2021-01-10 04:23:12'),
(1089, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:23:13', '2021-01-10 04:23:13'),
(1090, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:11', '2021-01-10 04:24:11'),
(1091, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:12', '2021-01-10 04:24:12'),
(1092, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:45', '2021-01-10 04:24:45'),
(1093, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:46', '2021-01-10 04:24:46'),
(1094, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:48', '2021-01-10 04:24:48'),
(1095, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:50', '2021-01-10 04:24:50'),
(1096, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:51', '2021-01-10 04:24:51'),
(1097, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:52', '2021-01-10 04:24:52'),
(1098, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:53', '2021-01-10 04:24:53'),
(1099, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:54', '2021-01-10 04:24:54'),
(1100, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:57', '2021-01-10 04:24:57'),
(1101, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:24:58', '2021-01-10 04:24:58'),
(1102, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:25:01', '2021-01-10 04:25:01'),
(1103, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:25:05', '2021-01-10 04:25:05'),
(1104, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:25:12', '2021-01-10 04:25:12'),
(1105, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:25:45', '2021-01-10 04:25:45'),
(1106, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:13', '2021-01-10 04:31:13'),
(1107, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:15', '2021-01-10 04:31:15'),
(1108, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:19', '2021-01-10 04:31:19'),
(1109, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:22', '2021-01-10 04:31:22'),
(1110, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:26', '2021-01-10 04:31:26');
INSERT INTO `recentlies` (`id`, `word`, `product_id`, `kind`, `device_token`, `created_at`, `updated_at`) VALUES
(1111, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:31:52', '2021-01-10 04:31:52'),
(1112, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:33:08', '2021-01-10 04:33:08'),
(1113, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:33:11', '2021-01-10 04:33:11'),
(1114, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:34:35', '2021-01-10 04:34:35'),
(1115, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:34:36', '2021-01-10 04:34:36'),
(1116, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:34:47', '2021-01-10 04:34:47'),
(1117, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:35:13', '2021-01-10 04:35:13'),
(1118, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:35:14', '2021-01-10 04:35:14'),
(1119, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:35:15', '2021-01-10 04:35:15'),
(1120, NULL, 3, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:36:55', '2021-01-10 04:36:55'),
(1121, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:38:16', '2021-01-10 04:38:16'),
(1122, NULL, 3, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:42:12', '2021-01-10 04:42:12'),
(1123, NULL, 3, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:42:21', '2021-01-10 04:42:21'),
(1124, NULL, 3, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:42:30', '2021-01-10 04:42:30'),
(1125, NULL, 3, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:55:06', '2021-01-10 04:55:06'),
(1126, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:58:41', '2021-01-10 04:58:41'),
(1127, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:58:42', '2021-01-10 04:58:42'),
(1128, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:58:47', '2021-01-10 04:58:47'),
(1129, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:58:47', '2021-01-10 04:58:47'),
(1130, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 04:58:49', '2021-01-10 04:58:49'),
(1131, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 05:02:15', '2021-01-10 05:02:15'),
(1133, 'd', NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 05:04:21', '2021-01-10 05:04:21'),
(1134, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 05:04:36', '2021-01-10 05:04:36'),
(1135, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-10 05:04:44', '2021-01-10 05:04:44'),
(1136, NULL, 3, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:57:28', '2021-01-10 18:57:28'),
(1137, NULL, 3, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:58:16', '2021-01-10 18:58:16'),
(1138, NULL, 1, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:58:33', '2021-01-10 18:58:33'),
(1139, NULL, 3, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:58:51', '2021-01-10 18:58:51'),
(1140, NULL, 1, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:58:52', '2021-01-10 18:58:52'),
(1141, NULL, 3, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-10 18:58:53', '2021-01-10 18:58:53'),
(1142, NULL, 1, 'product', 'Optional(\"16F52E05-F5EF-4C55-AF26-ABD241CC9640\")', '2021-01-11 01:42:12', '2021-01-11 01:42:12'),
(1143, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:27', '2021-01-11 18:09:27'),
(1144, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:44', '2021-01-11 18:09:44'),
(1145, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:48', '2021-01-11 18:09:48'),
(1146, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:51', '2021-01-11 18:09:51'),
(1147, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:56', '2021-01-11 18:09:56'),
(1148, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:09:59', '2021-01-11 18:09:59'),
(1149, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:10:02', '2021-01-11 18:10:02'),
(1150, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 18:10:11', '2021-01-11 18:10:11'),
(1151, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:13', '2021-01-11 20:03:13'),
(1152, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:14', '2021-01-11 20:03:14'),
(1153, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:16', '2021-01-11 20:03:16'),
(1154, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:17', '2021-01-11 20:03:17'),
(1155, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:18', '2021-01-11 20:03:18'),
(1156, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:19', '2021-01-11 20:03:19'),
(1157, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:20', '2021-01-11 20:03:20'),
(1158, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:21', '2021-01-11 20:03:21'),
(1159, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:22', '2021-01-11 20:03:22'),
(1160, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:23', '2021-01-11 20:03:23'),
(1161, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:31', '2021-01-11 20:03:31'),
(1162, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:32', '2021-01-11 20:03:32'),
(1163, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:33', '2021-01-11 20:03:33'),
(1164, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:35', '2021-01-11 20:03:35'),
(1165, NULL, 1, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:03:38', '2021-01-11 20:03:38'),
(1166, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:20:01', '2021-01-11 20:20:01'),
(1167, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-11 20:21:04', '2021-01-11 20:21:04'),
(1168, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 00:38:33', '2021-01-12 00:38:33'),
(1169, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 00:41:10', '2021-01-12 00:41:10'),
(1170, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 00:42:56', '2021-01-12 00:42:56'),
(1171, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 01:24:46', '2021-01-12 01:24:46'),
(1172, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 06:20:09', '2021-01-12 06:20:09'),
(1173, NULL, NULL, 'word', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 06:22:45', '2021-01-12 06:22:45'),
(1174, NULL, 2, 'product', 'lfKBxmEaWMbasrZsV4moGmFv4p8YGP8cRJ71XksbPa4ycusrJHbKtvbNb2eX', '2021-01-12 06:41:39', '2021-01-12 06:41:39'),
(1175, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 06:54:37', '2021-01-12 06:54:37'),
(1176, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 06:55:02', '2021-01-12 06:55:02'),
(1177, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 06:55:06', '2021-01-12 06:55:06'),
(1178, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 06:55:08', '2021-01-12 06:55:08'),
(1179, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 19:48:19', '2021-01-12 19:48:19'),
(1180, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 19:48:27', '2021-01-12 19:48:27'),
(1181, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 19:48:34', '2021-01-12 19:48:34'),
(1182, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 20:43:23', '2021-01-12 20:43:23'),
(1183, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 20:43:26', '2021-01-12 20:43:26'),
(1184, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 20:43:30', '2021-01-12 20:43:30'),
(1185, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 20:43:32', '2021-01-12 20:43:32'),
(1186, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 20:43:35', '2021-01-12 20:43:35'),
(1187, NULL, NULL, 'word', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:09:55', '2021-01-12 21:09:55'),
(1188, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:22:34', '2021-01-12 21:22:34'),
(1189, NULL, NULL, 'word', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:29:13', '2021-01-12 21:29:13'),
(1190, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:34:46', '2021-01-12 21:34:46'),
(1191, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:34:49', '2021-01-12 21:34:49'),
(1192, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:34:51', '2021-01-12 21:34:51'),
(1193, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:34:54', '2021-01-12 21:34:54'),
(1194, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:34:57', '2021-01-12 21:34:57'),
(1195, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:35:00', '2021-01-12 21:35:00'),
(1196, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-12 21:35:03', '2021-01-12 21:35:03'),
(1197, NULL, NULL, 'word', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:53:55', '2021-01-16 23:53:55'),
(1198, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:54:49', '2021-01-16 23:54:49'),
(1199, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:54:51', '2021-01-16 23:54:51'),
(1200, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:54:55', '2021-01-16 23:54:55'),
(1201, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:57:34', '2021-01-16 23:57:34'),
(1202, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-16 23:59:54', '2021-01-16 23:59:54'),
(1203, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:13', '2021-01-17 00:00:13'),
(1204, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:25', '2021-01-17 00:00:25'),
(1205, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:33', '2021-01-17 00:00:33'),
(1206, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:44', '2021-01-17 00:00:44'),
(1207, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:48', '2021-01-17 00:00:48'),
(1208, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:51', '2021-01-17 00:00:51'),
(1209, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:54', '2021-01-17 00:00:54'),
(1210, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:00:57', '2021-01-17 00:00:57'),
(1211, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:01:05', '2021-01-17 00:01:05'),
(1212, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:03:52', '2021-01-17 00:03:52'),
(1213, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:03', '2021-01-17 00:04:03'),
(1214, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:07', '2021-01-17 00:04:07'),
(1215, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:14', '2021-01-17 00:04:14'),
(1216, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:36', '2021-01-17 00:04:36'),
(1217, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:42', '2021-01-17 00:04:42'),
(1218, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:53', '2021-01-17 00:04:53'),
(1219, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:56', '2021-01-17 00:04:56'),
(1220, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:04:59', '2021-01-17 00:04:59'),
(1221, NULL, 3, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:05:51', '2021-01-17 00:05:51'),
(1222, NULL, 2, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:05:55', '2021-01-17 00:05:55'),
(1223, NULL, 1, 'product', 'EnAYsCU4vGLeVHBD7iejrpty4MLHj09FgRkQCGBQlhurbSgMLObttsIyYcJh', '2021-01-17 00:11:57', '2021-01-17 00:11:57'),
(1224, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-17 00:17:23', '2021-01-17 00:17:23'),
(1225, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-17 00:17:36', '2021-01-17 00:17:36'),
(1226, NULL, 3, 'product', 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")', '2021-01-18 09:35:05', '2021-01-18 09:35:05'),
(1227, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-18 20:18:50', '2021-01-18 20:18:50'),
(1228, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-18 20:22:50', '2021-01-18 20:22:50'),
(1229, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-18 20:22:58', '2021-01-18 20:22:58'),
(1230, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-18 20:23:05', '2021-01-18 20:23:05'),
(1231, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 00:46:35', '2021-01-20 00:46:35'),
(1232, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 00:46:52', '2021-01-20 00:46:52'),
(1233, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 00:47:03', '2021-01-20 00:47:03'),
(1234, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 00:47:10', '2021-01-20 00:47:10'),
(1235, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 00:47:18', '2021-01-20 00:47:18'),
(1236, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 01:36:38', '2021-01-20 01:36:38'),
(1237, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 01:37:08', '2021-01-20 01:37:08'),
(1238, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 01:37:12', '2021-01-20 01:37:12'),
(1239, NULL, 1, 'product', 'iSCpZ1TS6JFSVQ3It0Q6xaKWmwOLiytrL904flaGrNPAjx68LmOauPc2u0QP', '2021-01-20 01:37:21', '2021-01-20 01:37:21'),
(1240, NULL, 1, 'product', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-23 18:15:32', '2021-01-23 18:15:32'),
(1241, NULL, 1, 'product', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-23 18:15:47', '2021-01-23 18:15:47'),
(1242, NULL, NULL, 'word', 'IUSDlXw6B2XEpFs93q9CGeMovv3HbFTW6lK7Sphg84kcpGv3yesZdt70dROq', '2021-01-24 18:59:14', '2021-01-24 18:59:14'),
(1243, NULL, 1, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 16:56:22', '2021-01-26 16:56:22'),
(1244, NULL, NULL, 'word', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:01:11', '2021-01-26 17:01:11'),
(1245, 'soa', NULL, 'word', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:05:43', '2021-01-26 17:05:43'),
(1246, NULL, NULL, 'word', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:05:52', '2021-01-26 17:05:52'),
(1247, NULL, NULL, 'word', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:06:28', '2021-01-26 17:06:28'),
(1248, NULL, 3, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:07:26', '2021-01-26 17:07:26'),
(1249, NULL, 3, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:07:34', '2021-01-26 17:07:34'),
(1250, NULL, 1, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:07:50', '2021-01-26 17:07:50'),
(1251, NULL, 3, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:07:53', '2021-01-26 17:07:53'),
(1252, NULL, 3, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:07:56', '2021-01-26 17:07:56'),
(1253, NULL, 2, 'product', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:08:02', '2021-01-26 17:08:02'),
(1254, NULL, NULL, 'word', '9oGIb42O5aA3NXjojM8Zq2IhP3SrmgNdV6wTAfwszUqb8QtTe22XrM0n71xL', '2021-01-26 17:08:19', '2021-01-26 17:08:19'),
(1255, NULL, 1, 'product', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:33:13', '2021-01-26 21:33:13'),
(1256, NULL, 1, 'product', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:33:20', '2021-01-26 21:33:20'),
(1257, NULL, 1, 'product', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:33:22', '2021-01-26 21:33:22'),
(1258, 'f', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:47:57', '2021-01-26 21:47:57'),
(1259, 'g', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:48:04', '2021-01-26 21:48:04'),
(1260, 'A', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:49:06', '2021-01-26 21:49:06'),
(1261, 'S', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:49:15', '2021-01-26 21:49:15'),
(1262, 'a', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:49:21', '2021-01-26 21:49:21'),
(1263, 's', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:49:25', '2021-01-26 21:49:25'),
(1264, 's', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:49:36', '2021-01-26 21:49:36'),
(1265, 'Abaya', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:50:00', '2021-01-26 21:50:00'),
(1266, 's', NULL, 'word', '3hOPsq4UiiPYqWV5s78nL2SeyZQs3haeSF5CAXMaRLianZAlHihJ3vTnUZON', '2021-01-26 21:57:16', '2021-01-26 21:57:16'),
(1267, 's', NULL, 'word', 'DcrwmBHQmmdWSxjWA45ARHloEItq3UliebY21JmxH0drW4VALYwQodvKQaNv', '2021-01-26 22:00:01', '2021-01-26 22:00:01'),
(1268, 's', NULL, 'word', 'DcrwmBHQmmdWSxjWA45ARHloEItq3UliebY21JmxH0drW4VALYwQodvKQaNv', '2021-01-26 22:00:11', '2021-01-26 22:00:11'),
(1269, 's', NULL, 'word', 'DcrwmBHQmmdWSxjWA45ARHloEItq3UliebY21JmxH0drW4VALYwQodvKQaNv', '2021-01-26 22:04:56', '2021-01-26 22:04:56'),
(1270, NULL, NULL, 'word', 'DcrwmBHQmmdWSxjWA45ARHloEItq3UliebY21JmxH0drW4VALYwQodvKQaNv', '2021-01-26 22:08:18', '2021-01-26 22:08:18'),
(1271, 's', NULL, 'word', 'Optional(\"E864E3A6-C81C-46EB-A97E-A0BE7E7FD560\")', '2021-01-26 22:34:13', '2021-01-26 22:34:13'),
(1272, 's', NULL, 'word', 'jjbQxoKXYiaIhKckAlDQEXUz3o8yAApA7SM95jYv1SAQKCBHBG8VQi5ux9mI', '2021-01-27 03:30:09', '2021-01-27 03:30:09'),
(1273, NULL, 3, 'product', 'rPiXQrmxzpa910JaQoGzuQxLuE1PV5voR7KVMbxB1YPrgVXM6hYPPxjtWE7h', '2021-01-27 09:10:59', '2021-01-27 09:10:59'),
(1274, NULL, 1, 'product', 'rPiXQrmxzpa910JaQoGzuQxLuE1PV5voR7KVMbxB1YPrgVXM6hYPPxjtWE7h', '2021-01-27 09:11:18', '2021-01-27 09:11:18'),
(1275, NULL, 1, 'product', 'rPiXQrmxzpa910JaQoGzuQxLuE1PV5voR7KVMbxB1YPrgVXM6hYPPxjtWE7h', '2021-01-27 09:11:26', '2021-01-27 09:11:26'),
(1276, NULL, 1, 'product', 'rPiXQrmxzpa910JaQoGzuQxLuE1PV5voR7KVMbxB1YPrgVXM6hYPPxjtWE7h', '2021-01-27 09:11:27', '2021-01-27 09:11:27'),
(1277, 's', NULL, 'word', 'rPiXQrmxzpa910JaQoGzuQxLuE1PV5voR7KVMbxB1YPrgVXM6hYPPxjtWE7h', '2021-01-27 09:13:23', '2021-01-27 09:13:23'),
(1278, NULL, 9, 'product', 'BdONb6ZVLhqCzzoBvGGunuBymzRtACSjgGMJ2ZbbWnA7oFg77gA61LIJV62J', '2021-01-27 16:16:27', '2021-01-27 16:16:27'),
(1279, NULL, 9, 'product', 'BdONb6ZVLhqCzzoBvGGunuBymzRtACSjgGMJ2ZbbWnA7oFg77gA61LIJV62J', '2021-01-27 16:16:36', '2021-01-27 16:16:36'),
(1280, NULL, 9, 'product', 'BdONb6ZVLhqCzzoBvGGunuBymzRtACSjgGMJ2ZbbWnA7oFg77gA61LIJV62J', '2021-01-27 16:23:38', '2021-01-27 16:23:38'),
(1281, NULL, 3, 'product', 'Optional(\"E7E93F50-FD82-426F-9B45-65FE4BAF60A6\")', '2021-01-27 21:20:17', '2021-01-27 21:20:17'),
(1282, NULL, 3, 'product', 'AuBgxQp9h6fkRBWh7SRxGaZXVnj4TLtpDEmCsCyOuJmpDJAXaXbI4wWmDnAR', '2021-01-28 01:55:46', '2021-01-28 01:55:46'),
(1283, NULL, 2, 'product', 'Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0', '2021-01-29 21:20:29', '2021-01-29 21:20:29'),
(1284, NULL, 9, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:29:53', '2021-01-30 01:29:53'),
(1285, NULL, 9, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:30:03', '2021-01-30 01:30:03'),
(1286, NULL, 9, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:30:07', '2021-01-30 01:30:07'),
(1287, NULL, 9, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:30:09', '2021-01-30 01:30:09'),
(1288, NULL, 9, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:30:15', '2021-01-30 01:30:15'),
(1289, NULL, 3, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:31:15', '2021-01-30 01:31:15'),
(1290, NULL, 1, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:31:46', '2021-01-30 01:31:46'),
(1291, NULL, 1, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:31:48', '2021-01-30 01:31:48'),
(1292, NULL, 1, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:32:15', '2021-01-30 01:32:15'),
(1293, NULL, 2, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:38:59', '2021-01-30 01:38:59'),
(1294, NULL, 2, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:39:01', '2021-01-30 01:39:01'),
(1295, NULL, 2, 'product', 'uVVQMAb7Rymq85xkN6pYyZLZaeCOBF3m39PV1tIayz301aQh82HOvYHI1chv', '2021-01-30 01:40:07', '2021-01-30 01:40:07'),
(1296, NULL, 1, 'product', 'veEw5G9phFaWoJaOxqsLnXD7SAJWugkgPFHUAhubT0GORxRVtttUvZ9Cc4XX', '2021-01-30 02:52:31', '2021-01-30 02:52:31'),
(1297, NULL, 2, 'product', 'veEw5G9phFaWoJaOxqsLnXD7SAJWugkgPFHUAhubT0GORxRVtttUvZ9Cc4XX', '2021-01-30 02:52:42', '2021-01-30 02:52:42'),
(1298, NULL, 3, 'product', 'veEw5G9phFaWoJaOxqsLnXD7SAJWugkgPFHUAhubT0GORxRVtttUvZ9Cc4XX', '2021-01-30 03:04:09', '2021-01-30 03:04:09'),
(1299, NULL, 1, 'product', 'veEw5G9phFaWoJaOxqsLnXD7SAJWugkgPFHUAhubT0GORxRVtttUvZ9Cc4XX', '2021-01-30 03:09:25', '2021-01-30 03:09:25'),
(1300, NULL, 1, 'product', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-30 16:35:07', '2021-01-30 16:35:07'),
(1301, NULL, 1, 'product', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL', '2021-01-30 16:35:13', '2021-01-30 16:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'xl', 1, '2020-12-14 22:08:59', '2020-12-14 22:08:59'),
(2, 'lg', 1, '2020-12-14 22:09:03', '2020-12-14 22:09:03'),
(3, '42', 1, '2020-12-14 22:09:11', '2020-12-14 22:09:11'),
(4, '39', 1, '2020-12-14 22:09:16', '2020-12-14 22:09:16'),
(5, '45', 1, '2020-12-14 22:09:20', '2020-12-14 22:09:20'),
(6, '8999', 1, '2020-12-16 04:47:57', '2020-12-17 13:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_ar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title_ar`, `title_en`, `subtitle_ar`, `subtitle_en`, `link`, `active`, `created_at`, `updated_at`) VALUES
(1, 'تشكيلة رياضية جديدة', 'New Sports Collection', NULL, NULL, NULL, 1, '2020-12-14 22:18:39', '2020-12-14 22:18:39'),
(2, 'تشكيلة  عبايات جديدة', 'New abayas Collection', NULL, NULL, NULL, 1, '2020-12-14 22:20:05', '2020-12-17 14:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `token_users`
--

CREATE TABLE `token_users` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `token_users`
--

INSERT INTO `token_users` (`user_id`, `device_token`) VALUES
(17, 'Optional(\"EC14E4F4-BB07-408A-B49E-BF8CC89F2987\")'),
(17, '22222222'),
(21, 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")'),
(22, 'Optional(\"19160B1D-4226-45C3-88D3-AF5A4802C5DE\")'),
(23, 'Optional(\"19160B1D-4226-45C3-88D3-AF5A4802C5DE\")'),
(23, 'Optional(\"0302CF76-CFC8-45D9-A08D-BD53E374715F\")'),
(24, 'Optional(\"19160B1D-4226-45C3-88D3-AF5A4802C5DE\")'),
(20, 'Optional(\"60C5DCC8-1138-451B-B022-60B6221FE712\")'),
(24, 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")'),
(23, 'Optional(\"8CA5CA45-B0AE-4A39-A24F-6972D459A000\")'),
(23, 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")'),
(23, 'Optional(\"4AA02753-D013-40A2-9C38-06F3199C07E7\")'),
(23, 'Optional(\"A8D782C2-949F-41ED-B6AC-74C410CDCA3E\")'),
(23, 'Optional(\"DEE87AEF-4621-4108-8CD9-11D6915218BE\")'),
(23, 'Optional(\"2ABD7A35-F5C7-4632-AC2E-E7E4452FF62C\")'),
(23, 'Optional(\"5585A982-6A3B-4079-8CA4-F38A6DD44A68\")'),
(25, 'Optional(\"14E20142-2E4F-4505-977A-4F75BEEAFD7B\")'),
(26, 'Optional(\"44D16998-AFCF-46F0-A1AF-2F9DC58BBF71\")'),
(23, 'Optional(\"E864E3A6-C81C-46EB-A97E-A0BE7E7FD560\")'),
(23, 'Optional(\"E7E93F50-FD82-426F-9B45-65FE4BAF60A6\")');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `birth` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `active`, `birth`, `code`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`, `api_token`) VALUES
(13, 'Dobaa', 'dobanabil40@gmail.com', '123456789', '2021-01-10 01:17:48', '$2y$10$rUIJj2HG64TIWXXLn8RhgO/p6oG.7NXlkheDTnm8v/UHEHsKMXs8u', 1, '2021-01-13', '47074', NULL, NULL, 'PTSrP7XZkqGNd2AxjS3xWwiKjFp398Qm6dVdMLAnXIPNjpeT9sLKuH2CG6vn', '2020-12-14 23:24:21', '2021-01-10 01:18:05', 'HCrCcNYhbDaMtd1OsVbGcp6qRwOtyIXIEGA6IlAdn1mzeEacARGPD59MWqda'),
(17, 'Essam', 'developer.essam@gmail.com', '01000709271', '2020-12-18 08:06:43', '$2y$10$QU4qSjeQiyCvuS19/xj4XeDgeGVao2HdHhA3IgtTSZw1Oqsmz1sMW', 1, '2020-12-25', '85704', NULL, NULL, NULL, '2020-12-17 01:25:10', '2020-12-18 08:06:50', 'oJ1xFuAdL6oIbBcEZYSb9w42uuPPtifBxgjCm3ZlNT3sVMVHvjs72oVwNqiZ'),
(18, 'DeveloperEssam', 'developer.essam2@gmail.com', '01000709270', NULL, '$2y$10$5CZZZfkmg4GsVLYeMTgN..tBdkplDcHQH8P01mDeWWyM1W3KZLUSS', 1, '12-12-2020', '75469', NULL, NULL, NULL, '2020-12-17 12:43:01', '2020-12-17 12:43:02', 'OTy4QYBXtLw4OQsHwDdqcYRK9dcC31rPwtwlUR9THTzEr4MXHyECPuO96CxS'),
(19, 'testtest', 'developer.essam2@gmail.con', '01000709278', NULL, '$2y$10$iQUNatz9ZLagVIZMFhMN4OEvjqA5UpA8zj1AZ64WFh7/C3kDBjtOS', 1, '12-12-2020', '27842', NULL, NULL, NULL, '2020-12-17 12:43:58', '2020-12-17 13:59:49', 'ChDIbqoz583Oock5lPstPp9EMK4NnCSyTnCvukpxduC8G0krDwlNrtEba3g5'),
(20, 'testtest', 'developer.essam3@gmail.com', '01000709211', NULL, '$2y$10$hsjHxfQJFZ159WPJC4stte8KHMuy3CJL..cF6YnyrUssTHja1VSU2', 1, '12-12-2020', '61317', NULL, NULL, NULL, '2020-12-18 08:02:27', '2020-12-21 03:34:24', 'Y6nqZYv9wSBvkNwR5CtPoPqeANOg2oDFedJjd4IZncNXtGKtCRiFS6X6xSY0'),
(21, 'fff', 'eee@dddd', '012341234123', NULL, '$2y$10$Qs8DL8Bn8LWcL3T8.DxId.KYfRq2xosQ0kiVIa6iZu/gAnRIJgB5a', 1, '2020-12-16 02:44:00 +0000', '48256', NULL, NULL, NULL, '2020-12-18 17:46:16', '2020-12-18 17:46:19', 'FrDQzDl8T9dCIvjoH4YA65i9vWTZu5Sms76CUu2eHDKQS9WoKoi7QTD413nC'),
(22, 'wwwww', 'dd@ddddd', '01010101019', NULL, '$2y$10$kMEyTLT.0jsDjTh6n50ngeydz/JT.oi5fR6cqsjjiFgGkjmsnYQEG', 1, 'Dec 18, 2020', '25565', NULL, NULL, NULL, '2020-12-18 19:29:10', '2020-12-18 19:34:19', 'PcqCfKotOQZ1IPTuKHfOvNlJbQwXbWGHWl7mISMvQqMLG2rBJrRvrml9jf9O'),
(23, 'Ahmed', 'Ahmedkamal121995@gmail.com', '01001929079', '2020-12-18 20:16:52', '$2y$10$AXbeQA9NQe6a62hROPYIruv.rEPntLjDjx2q2i5eeYjm9s1mpaBIW', 1, 'Jun 16, 1995', '47844', NULL, NULL, NULL, '2020-12-18 20:16:13', '2021-01-30 02:10:35', 'veEw5G9phFaWoJaOxqsLnXD7SAJWugkgPFHUAhubT0GORxRVtttUvZ9Cc4XX'),
(24, 'Ahmed', 'Ahmedshalaby121995@gmail.com', '01117180818', '2020-12-19 23:23:46', '$2y$10$xVLPk4.f1QvZRgCBr7Mxr.m4qKCsGidnC/GscsH19W3wiaDxfZ4Cy', 1, 'Dec 19, 2020', '95094', NULL, NULL, NULL, '2020-12-19 23:23:03', '2020-12-21 16:34:07', '9k2kxSozzuTLsIa5Hj5ylRjeFOdXgXk7ZwqO04cDC6NVxgtIVKFV1LgUDila'),
(25, 'Mohamed', 'm.f.keshk@gmail.com', '66497607', '2021-01-09 16:27:12', '$2y$10$X23rTE0ZOuQ0y6mGqtzTWO/fHDkYY5kNvlJGjtBAEpzSmPK8PxM8u', 1, NULL, '54268', NULL, NULL, NULL, '2021-01-09 16:26:58', '2021-01-26 17:32:51', 'BdONb6ZVLhqCzzoBvGGunuBymzRtACSjgGMJ2ZbbWnA7oFg77gA61LIJV62J'),
(26, 'Ahmed', 'sherbeny2096@gmail.com', '01091964091', '2021-01-10 01:07:24', '$2y$10$kpgT5egD8UXGGWqMKtnm1OvmSqEHKNdGwZhU9/f6y/gUDVema7Nei', 1, '10 Jan 1996', '95601', NULL, NULL, NULL, '2021-01-10 01:06:58', '2021-01-10 01:07:24', 'aPifqdLPwAQHqV1lDFH628ug8dlBVGP9MaF71flC0hwhUzlPZRGITShp52eL');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_storage`
--

CREATE TABLE `wishlist_storage` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wishlist_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wish_lists`
--

INSERT INTO `wish_lists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(141, 1, 17, '2020-12-17 02:16:53', '2020-12-17 02:16:53'),
(249, 1, 20, '2020-12-21 03:34:58', '2020-12-21 03:34:58'),
(275, 2, 24, '2020-12-21 16:58:53', '2020-12-21 16:58:53'),
(317, 1, 25, '2021-01-09 17:18:20', '2021-01-09 17:18:20'),
(374, 3, 25, '2021-01-26 17:07:43', '2021-01-26 17:07:43'),
(379, 3, 23, '2021-01-30 03:04:47', '2021-01-30 03:04:47'),
(383, 1, 23, '2021-01-30 03:09:50', '2021-01-30 03:09:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_city_id_index` (`city_id`),
  ADD KEY `addresses_user_id_index` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_index` (`user_id`),
  ADD KEY `carts_color_id_index` (`color_id`),
  ADD KEY `carts_size_id_index` (`size_id`),
  ADD KEY `carts_product_id_index` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `category_sliders`
--
ALTER TABLE `category_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_sliders_category_id_index` (`category_id`);

--
-- Indexes for table `chose_countries`
--
ALTER TABLE `chose_countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chose_countries_country_id_index` (`country_id`),
  ADD KEY `chose_countries_user_id_index` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_index` (`country_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_orders`
--
ALTER TABLE `contact_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_orders_order_id_index` (`order_id`),
  ADD KEY `contact_orders_user_id_index` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_country_id_index` (`country_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `moderators_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_city_id_index` (`city_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pays_order_id_index` (`order_id`),
  ADD KEY `pays_product_id_index` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_subcategory_id_index` (`subcategory_id`),
  ADD KEY `products_brand_id_index` (`brand_id`),
  ADD KEY `products_material_id_index` (`material_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_index` (`product_id`),
  ADD KEY `product_details_color_id_index` (`color_id`),
  ADD KEY `product_details_size_id_index` (`size_id`);

--
-- Indexes for table `recentlies`
--
ALTER TABLE `recentlies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recentlies_product_id_index` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_users`
--
ALTER TABLE `token_users`
  ADD KEY `token_users_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Indexes for table `wishlist_storage`
--
ALTER TABLE `wishlist_storage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_storage_id_index` (`id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_lists_product_id_index` (`product_id`),
  ADD KEY `wish_lists_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category_sliders`
--
ALTER TABLE `category_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chose_countries`
--
ALTER TABLE `chose_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_orders`
--
ALTER TABLE `contact_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `recentlies`
--
ALTER TABLE `recentlies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1302;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_sliders`
--
ALTER TABLE `category_sliders`
  ADD CONSTRAINT `category_sliders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chose_countries`
--
ALTER TABLE `chose_countries`
  ADD CONSTRAINT `chose_countries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chose_countries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_orders`
--
ALTER TABLE `contact_orders`
  ADD CONSTRAINT `contact_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pays_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_details_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recentlies`
--
ALTER TABLE `recentlies`
  ADD CONSTRAINT `recentlies_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token_users`
--
ALTER TABLE `token_users`
  ADD CONSTRAINT `token_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD CONSTRAINT `wish_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
