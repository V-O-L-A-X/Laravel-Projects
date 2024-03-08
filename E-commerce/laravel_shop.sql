-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 09:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'The Cool Chair', 'the-cool-chair', 1, '2023-10-24 01:50:56', '2023-10-24 02:03:16'),
(3, 'The Awesome Hat', 'the-awesome-hat', 1, '2023-10-24 01:55:20', '2023-10-24 01:55:20'),
(4, 'Cozy Corner', 'cozy-corner', 1, '2023-10-28 02:31:24', '2023-10-28 02:31:24'),
(5, 'The Endless Dawn', 'the-endless-dawn', 1, '2023-11-21 06:08:00', '2023-11-21 06:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'clothes', 'clothes', NULL, 0, 'No', '2023-10-19 06:12:58', '2023-10-19 06:12:58'),
(3, 'Woman\'s Llothes', 'womans-llothes', '3-1700479433.jpg', 1, 'Yes', '2023-10-19 06:38:45', '2023-11-20 04:23:53'),
(36, 'ewrdfs befd', 'ewrdfs-befd', '36.jpg', 1, 'No', '2023-10-21 05:10:04', '2023-10-21 05:10:04'),
(37, 'hihi hehe lollol', 'hihi-hehe-lollol', NULL, 1, 'No', '2023-10-21 05:34:50', '2023-10-21 05:34:50'),
(38, 'sedc aeDs', 'sedc-aeds', NULL, 1, 'No', '2023-10-21 05:35:16', '2023-10-21 05:35:16'),
(39, 'esfd qaedsf', 'esfd-qaedsf', NULL, 0, 'No', '2023-10-21 05:37:52', '2023-10-21 05:37:52'),
(40, 'wesdfd easdfx', 'wesdfd-easdfx', NULL, 1, 'No', '2023-10-21 05:38:21', '2023-10-21 05:38:21'),
(41, 'wesdf', 'wesdf', '41.png', 0, 'No', '2023-10-21 05:40:37', '2023-10-22 03:00:17'),
(44, 'wedsfcv cwieijkn234', 'wedsfcv-cwieijkn234', '44.png', 1, 'Yes', '2023-10-22 03:13:03', '2023-11-20 04:04:47'),
(45, 'đồ điện tử', 'do-dien-tu', '45.jpg', 1, 'Yes', '2023-10-23 06:47:29', '2023-11-20 04:04:25'),
(46, 'Giày dép', 'giay-dep', '46-1700479446.jpg', 1, 'Yes', '2023-11-20 02:16:22', '2023-11-20 04:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 15, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', '2023-11-26 06:01:52', '2023-11-28 02:52:54'),
(2, 5, 'iwesdjknm', 'sdxc', 'hohoho@gmail.com', '0394763795', 126, 'ewisdjknm, ijwkenm,sd xwesdc', '234', 'wsdf', 'gftd', 'we35656', '2023-11-28 03:02:23', '2023-11-28 03:02:23'),
(3, 4, 'Vesna oHHHHHHH', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', '2023-12-04 04:09:40', '2023-12-09 02:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `start_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `start_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'YYYYYY', 'On the Top', '<p>qwsdfg</p>', 10, 10, 'fixed', 200000.00, 100000.00, 1, '2023-11-30 11:25:06', '2023-12-29 11:17:13', '2023-11-29 04:25:14', '2023-12-01 06:38:22'),
(4, 'VNI 5678', 'hehe', '<p>qwadfggwgfwqawfgwqawdfg</p>', 5, 1, 'percent', 20.00, NULL, 1, '2023-12-13 07:33:36', '2024-01-04 07:33:40', '2023-11-30 00:33:47', '2023-11-30 00:33:47'),
(5, 'YUFG145', 'hoihoi', '<p>qswdafgadozijkn,maszixkn,m</p>', 12, 5, 'percent', 50.00, NULL, 1, '2023-12-13 08:34:49', '2023-12-29 08:34:54', '2023-12-01 01:35:00', '2023-12-01 01:35:00');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_17_114708_alter_users', 2),
(6, '2023_10_19_084222_create_categories_table', 3),
(7, '2023_10_21_085835_create_temp_images_table', 4),
(8, '2023_10_22_112522_create_sub_categories_table', 5),
(9, '2023_10_24_082717_create_brands_table', 6),
(10, '2023_10_24_090621_create_products_table', 7),
(11, '2023_10_24_090703_create_products_images_table', 7),
(12, '2023_11_20_085816_alter_categories_table', 8),
(13, '2023_11_20_091958_alter_products_table', 9),
(14, '2023_11_20_093032_alter_sub_categories_table', 10),
(15, '2023_11_22_084230_alter_products_table', 11),
(16, '2023_11_25_080301_alter_users_table', 12),
(17, '2023_11_26_072911_create_countries_table', 13),
(18, '2023_11_26_080001_create_orders_table', 14),
(19, '2023_11_26_080138_create_order_items_table', 14),
(20, '2023_11_26_080316_create_customer_addresses_table', 14),
(21, '2023_11_27_080414_create_shipping_charges_table', 15),
(22, '2023_11_29_080955_create_discount_coupons_table', 16),
(23, '2023_12_02_085655_alter_orders_table', 17),
(24, '2023_12_04_082611_alter_orders_table', 18),
(25, '2023_12_06_093415_create_wishlists_table', 19),
(26, '2023_12_10_075653_alter_users_table', 20),
(27, '2023_12_11_084655_create_pages_table', 21),
(28, '2023_12_19_081255_create_product_ratings_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` int(100) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(2, 3, 2466478.00, 0.00, NULL, NULL, NULL, 2466478.00, 'not paid', 'shipped', '2023-12-07 09:20:33', 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 7, 'wesfga', NULL, 'wsdf', 'gftd', 'we35656', NULL, '2023-11-26 07:02:20', '2023-12-04 02:20:37'),
(3, 3, 875846.00, 0.00, NULL, NULL, NULL, 875846.00, 'not paid', 'cancelled', '2023-04-05 09:39:15', 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 7, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', 'wsadfgfasdfv', '2023-11-26 07:02:58', '2023-12-04 02:39:19'),
(4, 3, 780000.00, 0.00, NULL, NULL, NULL, 780000.00, 'not paid', 'delivered', NULL, 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 7, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', NULL, '2023-11-26 07:08:40', '2023-11-26 07:08:40'),
(6, 3, 3439535.00, 0.00, NULL, NULL, NULL, 3439535.00, 'not paid', 'pending', NULL, 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 7, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', NULL, '2023-11-26 07:11:21', '2023-11-26 07:11:21'),
(7, 3, 714551.00, 100.00, NULL, NULL, NULL, 714651.00, 'not paid', 'pending', NULL, 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 15, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', NULL, '2023-11-28 02:52:54', '2023-11-28 02:52:54'),
(8, 5, 2787445.00, 100.00, NULL, NULL, NULL, 2787545.00, 'not paid', 'delivered', '2023-12-14 09:19:46', 'iwesdjknm', 'sdxc', 'hohoho@gmail.com', '0394763795', 126, 'ewisdjknm, ijwkenm,sd xwesdc', '234', 'wsdf', 'gftd', 'we35656', 'ewrdfg', '2023-11-28 03:02:23', '2023-12-04 02:48:38'),
(9, 3, 2143653.00, 100.00, 'YYYYYY', 3, 200000.00, 1943753.00, 'not paid', 'shipped', NULL, 'Dank Memes', 'Nhộn', 'hoahong@d.com', '0394763795', 15, 'wesfga', '12344444444444', 'wsdf', 'gftd', 'we35656', NULL, '2023-12-01 03:40:07', '2023-12-01 03:40:07'),
(10, 4, 5687442.00, 12.00, 'YYYYYY', 3, 200000.00, 5487454.00, 'not paid', 'shipped', '2023-12-04 11:13:05', 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', 'asdfgwasdfcasdxcv', '2023-12-04 04:09:40', '2023-12-04 04:13:12'),
(11, 4, 9268686.00, 12.00, 'YYYYYY', 3, 200000.00, 9068698.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', 'asfdgfbsdxcesdx', '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(12, 4, 1972657.00, 12.00, '', NULL, 0.00, 1972669.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', 'asdfgf', '2023-12-04 04:11:34', '2023-12-04 04:11:34'),
(13, 4, 835702.00, 12.00, '', NULL, 0.00, 835714.00, 'not paid', 'cancelled', '2023-12-05 11:13:38', 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-04 04:12:02', '2023-12-04 04:13:42'),
(14, 4, 3120000.00, 12.00, '', NULL, 0.00, 3120012.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-04 04:12:26', '2023-12-04 04:12:26'),
(15, 4, 687907.00, 12.00, '', NULL, 0.00, 687919.00, 'not paid', 'shipped', '2023-12-07 13:30:56', 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-04 04:12:34', '2023-12-05 06:31:03'),
(16, 4, 218571.00, 12.00, '', NULL, 0.00, 218583.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-04 05:11:09', '2023-12-04 05:11:09'),
(17, 4, 218571.00, 12.00, '', NULL, 0.00, 218583.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-04 05:15:06', '2023-12-04 05:15:06'),
(18, 4, 3027907.00, 12.00, '', NULL, 0.00, 3027919.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', 'asdf', '2023-12-05 02:22:40', '2023-12-05 02:22:40'),
(19, 4, 13261.00, 12.00, '', NULL, 0.00, 13273.00, 'not paid', 'pending', NULL, 'Vesna', 'HEhehe', 'xuan.tranvu52@gmail.com', '0736582945', 233, 'iuajhksdnmzjknemsdxiuajhksdnmzjknemsdxiuajhksdnmzjknemsdx', '356', 'wosk', 'qwerdf', '3457UYF', NULL, '2023-12-05 02:34:30', '2023-12-05 02:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 51, 'Elmira Schmitt III', 1, 218571.00, 218571.00, '2023-11-26 07:02:20', '2023-11-26 07:02:20'),
(2, 2, 19, 'Ồ yeeeeee', 1, 687907.00, 687907.00, '2023-11-26 07:02:20', '2023-11-26 07:02:20'),
(3, 2, 13, 'bed', 1, 780000.00, 780000.00, '2023-11-26 07:02:20', '2023-11-26 07:02:20'),
(4, 2, 12, 'Dank Meme', 1, 780000.00, 780000.00, '2023-11-26 07:02:20', '2023-11-26 07:02:20'),
(5, 3, 51, 'Elmira Schmitt III', 1, 218571.00, 218571.00, '2023-11-26 07:02:58', '2023-11-26 07:02:58'),
(6, 3, 45, 'Marcelina Kertzmann', 1, 657275.00, 657275.00, '2023-11-26 07:02:58', '2023-11-26 07:02:58'),
(7, 4, 12, 'Dank Meme', 1, 780000.00, 780000.00, '2023-11-26 07:08:40', '2023-11-26 07:08:40'),
(9, 6, 19, 'Ồ yeeeeee', 5, 687907.00, 3439535.00, '2023-11-26 07:11:21', '2023-11-26 07:11:21'),
(10, 7, 50, 'Amina Robel', 1, 714551.00, 714551.00, '2023-11-28 02:52:54', '2023-11-28 02:52:54'),
(11, 8, 19, 'Ồ yeeeeee', 4, 687907.00, 2751628.00, '2023-11-28 03:02:23', '2023-11-28 03:02:23'),
(12, 8, 49, 'Miss Estefania Orn', 1, 35817.00, 35817.00, '2023-11-28 03:02:23', '2023-11-28 03:02:23'),
(13, 9, 50, 'Amina Robel', 3, 714551.00, 2143653.00, '2023-12-01 03:40:07', '2023-12-01 03:40:07'),
(14, 10, 19, 'Ồ yeeeeee', 6, 687907.00, 4127442.00, '2023-12-04 04:09:40', '2023-12-04 04:09:40'),
(15, 10, 12, 'Dank Meme', 2, 780000.00, 1560000.00, '2023-12-04 04:09:40', '2023-12-04 04:09:40'),
(16, 11, 30, 'Abbey Lemke', 1, 246273.00, 246273.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(17, 11, 49, 'Miss Estefania Orn', 2, 35817.00, 71634.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(18, 11, 13, 'bed', 7, 780000.00, 5460000.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(19, 11, 19, 'Ồ yeeeeee', 4, 687907.00, 2751628.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(20, 11, 35, 'Muhammad Will', 1, 152151.00, 152151.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(21, 11, 22, 'Bejewed', 1, 587000.00, 587000.00, '2023-12-04 04:11:12', '2023-12-04 04:11:12'),
(22, 12, 37, 'Westley Renner', 1, 974086.00, 974086.00, '2023-12-04 04:11:34', '2023-12-04 04:11:34'),
(23, 12, 12, 'Dank Meme', 1, 780000.00, 780000.00, '2023-12-04 04:11:34', '2023-12-04 04:11:34'),
(24, 12, 51, 'Elmira Schmitt III', 1, 218571.00, 218571.00, '2023-12-04 04:11:34', '2023-12-04 04:11:34'),
(25, 13, 25, 'Dr. Josefa Schmitt II', 1, 835702.00, 835702.00, '2023-12-04 04:12:02', '2023-12-04 04:12:02'),
(26, 14, 12, 'Dank Meme', 4, 780000.00, 3120000.00, '2023-12-04 04:12:26', '2023-12-04 04:12:26'),
(27, 15, 19, 'Ồ yeeeeee', 1, 687907.00, 687907.00, '2023-12-04 04:12:34', '2023-12-04 04:12:34'),
(28, 16, 51, 'Elmira Schmitt III', 1, 218571.00, 218571.00, '2023-12-04 05:11:09', '2023-12-04 05:11:09'),
(29, 17, 51, 'Elmira Schmitt III', 1, 218571.00, 218571.00, '2023-12-04 05:15:06', '2023-12-04 05:15:06'),
(30, 18, 12, 'Dank Meme', 3, 780000.00, 2340000.00, '2023-12-05 02:22:40', '2023-12-05 02:22:40'),
(31, 18, 19, 'Ồ yeeeeee', 1, 687907.00, 687907.00, '2023-12-05 02:22:40', '2023-12-05 02:22:40'),
(32, 19, 33, 'George Schultz', 1, 13261.00, 13261.00, '2023-12-05 02:34:30', '2023-12-05 02:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Contact Us', 'contact-us', '<p>wdfuijknm, asydxuijhkn,m asxdycuijhkn,m</p>', '2023-12-11 02:34:59', '2023-12-13 01:44:30'),
(3, 'About The Shop', 'about-the-shop', '<p class=\"MsoNormal\"><span lang=\"FR\">- Sapien\r\neu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient\r\nmontes, nascetur ridiculus mus. </span></p><p class=\"MsoNormal\"><span lang=\"FR\"><br></span>Cras\r\nfaucibus condimentum odio. Sed ac ligula. Aliquam at eros. Etiam at ligula et\r\ntellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam\r\nurna accumsan lacus, sed interdum wisi nibh nec nisl. <span lang=\"FR\">Ut tincidunt volutpat urna.\r\nMauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere\r\nquam vel nibh. Cras dapibus dapibus nisl.<b> Vestibulum quis dolor </b>a felis congue\r\nvehicula. Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris.\r\nCurabitur non eros. Nullam hendrerit bibendum justo. Fusce iaculis, est quis\r\nlacinia pretium, pede metus molestie lacus, at gravida wisi ante at libero.\r\n</span></p><p class=\"MsoNormal\"><span lang=\"FR\">Quisque ornare placerat risus. Ut molestie magna at mi. Integer aliquet mauris\r\net nibh. Ut mattis ligula posuere velit. Nunc sagittis. Curabitur varius\r\nfringilla nisl. Duis pretium mi euismod erat. Maecenas id augue. Nam vulputate.\r\nDuis a quam non <font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">neque lobortis malesuada.</font> Praesent euismod. Donec nulla augue,\r\nvenenatis scelerisque, dapibus a, consequat at, leo. Pellentesque libero\r\nlectus, tristique ac, consectetuer sit amet, imperdiet ut, justo. </span>Sed aliquam odio vitae tortor. Proin hendrerit tempus\r\narcu. In hac <u>habitasse platea dictumst</u>. <span lang=\"FR\">Suspendisse potenti. Vivamus vitae massa adipiscing est\r\nlacinia sodales. </span></p><p class=\"MsoNormal\"><span lang=\"FR\">Donec metus massa, mollis vel, tempus placerat, vestibulum\r\ncondimentum, ligula. Nunc lacus metus, posuere eget, lacinia eu, varius quis,\r\nlibero. </span>Aliquam nonummy adipiscing augue.<o:p></o:p></p>', '2023-12-11 04:03:11', '2023-12-11 04:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `shipping_returns` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `related_products` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `track_qty` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `short_description`, `description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Dank Meme', 'dank-meme', '<p>wdefgiowjdk,m dcwoiejdnkxc meijosdknx m,</p>', 'litora torquent per conubia nostra, per inceptos hymenaeos. Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros. Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna. Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh. Cras dapibus dapibus&nbsp;', '<p>fsdggwiojrndfmxciujknmdcijkn,mesdxcijkn m,s commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros. Etiam at ligula et tellus ullamcorper ultrices. In fermentum</p>', '13,15,19,21,22,24,27', 780000.00, 500000.00, 45, 5, 2, 'Yes', '45678', '3456-UHF', 'Yes', 4, 1, '2023-10-27 06:42:39', '2023-11-23 03:04:10'),
(13, 'bed', 'bed', NULL, '<p>wefggweqawd</p>', NULL, NULL, 780000.00, 467843.00, 44, 6, 4, 'Yes', '467422', 'wsedcz-76543', 'Yes', 14, 1, '2023-10-28 02:32:29', '2023-10-28 02:32:29'),
(15, 'qwertyrdfc', 'qwertyrdfc', NULL, '<p>wersdgwswerdfvc</p>', NULL, NULL, 45678.00, 64344.00, 45, 3, 3, 'Yes', '23456', 'dsxf34ee43', 'Yes', 56, 1, '2023-10-28 02:49:14', '2023-11-21 01:43:40'),
(19, 'Ồ yeeeeee', 'o-yeeeeee', NULL, '<p><font face=\"Times New Roman, serif\"><span style=\"font-size: 16px;\">litora torquent per conubia nostra, per inceptos hymenaeos. Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros. Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna. Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh. Cras dapibus dapibus&nbsp;</span></font><br></p>', NULL, NULL, 687907.00, 64344.00, 46, 9, 2, 'Yes', '35794455', 'werdfc436', 'Yes', 20, 1, '2023-11-20 04:27:49', '2023-11-22 01:57:30'),
(20, 'godsczx', 'godsczx', NULL, '<p>wedcd vwewfsc s</p>', NULL, NULL, 700000.00, 1000000.00, 46, 9, 4, 'Yes', '345678', '3563fdfvdfv', 'Yes', 56, 1, '2023-11-21 04:21:54', '2023-11-21 04:21:54'),
(21, 'njisoiejkws', 'njisoiejkws', NULL, '<p>qwdscxqedsc</p>', NULL, NULL, 200000.00, NULL, 45, 8, 3, 'Yes', '5680975', 'jkiujkn7899', 'Yes', 12, 1, '2023-11-21 04:24:11', '2023-11-21 04:24:11'),
(22, 'Bejewed', 'bejewed', NULL, '<p>wedscwdscwesdc</p>', NULL, NULL, 587000.00, NULL, 44, 7, 4, 'No', '876543', 'jsnx787', 'Yes', 56, 1, '2023-11-21 04:27:22', '2023-11-21 04:27:22'),
(23, 'Ayana Kuhic', 'ayana-kuhic', NULL, NULL, NULL, NULL, 200786.00, NULL, 45, 5, 2, 'Yes', '214578', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(24, 'Hope Howe', 'hope-howe', NULL, NULL, NULL, NULL, 728391.00, NULL, 45, 8, 5, 'Yes', '819972', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(25, 'Dr. Josefa Schmitt II', 'dr-josefa-schmitt-ii', NULL, NULL, NULL, NULL, 835702.00, NULL, 45, 5, 4, 'Yes', '360339', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(26, 'Dr. Paul Lockman II', 'dr-paul-lockman-ii', NULL, NULL, NULL, NULL, 847015.00, NULL, 45, 3, 2, 'Yes', '930466', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(27, 'Mrs. Fabiola Heathcote III', 'mrs-fabiola-heathcote-iii', NULL, NULL, NULL, NULL, 346281.00, NULL, 45, 3, 5, 'Yes', '440864', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(28, 'Augustine Smith', 'augustine-smith', NULL, NULL, NULL, NULL, 676868.00, NULL, 45, 5, 4, 'Yes', '828847', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(29, 'Dr. Idella Emard', 'dr-idella-emard', NULL, NULL, NULL, NULL, 148206.00, NULL, 45, 8, 2, 'Yes', '762606', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(30, 'Abbey Lemke', 'abbey-lemke', NULL, NULL, NULL, NULL, 246273.00, NULL, 45, 5, 2, 'Yes', '928507', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(31, 'Isom Walker', 'isom-walker', NULL, NULL, NULL, NULL, 784336.00, NULL, 45, 8, 3, 'Yes', '252945', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(32, 'Tania Ziemann', 'tania-ziemann', NULL, NULL, NULL, NULL, 631669.00, NULL, 45, 8, 4, 'Yes', '661183', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(33, 'George Schultz', 'george-schultz', NULL, NULL, NULL, NULL, 13261.00, NULL, 45, 3, 3, 'Yes', '223393', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(34, 'Gladys Rodriguez II', 'gladys-rodriguez-ii', NULL, NULL, NULL, NULL, 508248.00, NULL, 45, 8, 3, 'Yes', '180494', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(35, 'Muhammad Will', 'muhammad-will', NULL, NULL, NULL, NULL, 152151.00, NULL, 45, 3, 5, 'Yes', '561014', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(36, 'Shemar Cronin II', 'shemar-cronin-ii', NULL, NULL, NULL, NULL, 997249.00, NULL, 45, 8, 3, 'Yes', '807866', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(37, 'Westley Renner', 'westley-renner', NULL, NULL, NULL, NULL, 974086.00, NULL, 45, 5, 2, 'Yes', '251369', NULL, 'Yes', 10, 1, '2023-11-21 06:16:21', '2023-11-21 06:16:21'),
(38, 'Brianne Rice', 'brianne-rice', NULL, NULL, NULL, '12,24', 930499.00, NULL, 44, 6, 2, 'No', '265326', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-12-08 02:26:47'),
(39, 'Emil Flatley', 'emil-flatley', NULL, NULL, NULL, NULL, 496840.00, NULL, 44, 7, 2, 'Yes', '277968', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(40, 'Aracely Stehr', 'aracely-stehr', NULL, NULL, NULL, NULL, 667661.00, NULL, 44, 7, 3, 'Yes', '841932', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(41, 'Mr. Omer Pollich', 'mr-omer-pollich', NULL, NULL, NULL, '', 715710.00, NULL, 44, 7, 5, 'No', '28812', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-12-08 02:26:58'),
(42, 'Mr. Michel Wolf Sr.', 'mr-michel-wolf-sr', NULL, NULL, NULL, NULL, 130688.00, NULL, 44, 7, 3, 'Yes', '751117', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(43, 'Prof. Adella Koepp II', 'prof-adella-koepp-ii', NULL, NULL, NULL, NULL, 365763.00, NULL, 44, 6, 3, 'Yes', '557376', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(44, 'Mr. Joey Pacocha', 'mr-joey-pacocha', NULL, NULL, NULL, NULL, 774370.00, NULL, 44, 6, 5, 'Yes', '394122', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(45, 'Marcelina Kertzmann', 'marcelina-kertzmann', NULL, NULL, NULL, NULL, 657275.00, NULL, 44, 6, 4, 'Yes', '359587', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(46, 'Prof. Rossie Hintz', 'prof-rossie-hintz', NULL, NULL, NULL, NULL, 96213.00, NULL, 44, 6, 2, 'Yes', '285909', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(47, 'Myah Schmeler', 'myah-schmeler', NULL, NULL, NULL, '', 244111.00, NULL, 44, 7, 5, 'No', '858579', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-12-08 02:27:17'),
(48, 'Bruce Dooley', 'bruce-dooley', NULL, NULL, NULL, '', 948232.00, NULL, 44, 6, 4, 'No', '183719', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-12-08 02:29:06'),
(49, 'Miss Estefania Orn', 'miss-estefania-orn', NULL, NULL, NULL, NULL, 35817.00, NULL, 44, 6, 5, 'Yes', '780946', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(50, 'Amina Robel', 'amina-robel', NULL, NULL, NULL, NULL, 714551.00, NULL, 44, 6, 2, 'Yes', '25257', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(51, 'Elmira Schmitt III', 'elmira-schmitt-iii', NULL, NULL, NULL, NULL, 218571.00, NULL, 44, 7, 5, 'Yes', '569872', NULL, 'Yes', 10, 1, '2023-11-21 06:18:41', '2023-11-21 06:18:41'),
(52, 'Leonie Hayes', 'leonie-hayes', '<p>wertfgh</p>', '<p>ewsrdfgfgd</p><p>wesrfdsfghg</p><p>wretfghgerdfuijknwemsdxcuhjknm sdx</p><p>weuizsfxc m</p>', '<p>ewrtf</p>', '12,15,25,36', 170881.00, NULL, 44, 7, 4, 'Yes', '844941', NULL, 'Yes', 0, 1, '2023-11-21 06:18:41', '2023-12-08 02:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(30, 12, '12-30-1700644596.jpg', NULL, '2023-11-22 02:16:36', '2023-11-22 02:16:36'),
(31, 12, '12-31-1700644601.jpg', NULL, '2023-11-22 02:16:41', '2023-11-22 02:16:41'),
(32, 12, '12-32-1700644605.jpg', NULL, '2023-11-22 02:16:45', '2023-11-22 02:16:45'),
(33, 12, '12-33-1700644610.jpg', NULL, '2023-11-22 02:16:50', '2023-11-22 02:16:50'),
(34, 19, '19-34-1700645501.jpg', NULL, '2023-11-22 02:31:41', '2023-11-22 02:31:41'),
(35, 19, '19-35-1700645513.jpg', NULL, '2023-11-22 02:31:53', '2023-11-22 02:31:53'),
(36, 19, '19-36-1700645517.png', NULL, '2023-11-22 02:31:57', '2023-11-22 02:31:57'),
(37, 52, '52-37-1702027866.jpg', NULL, '2023-12-08 02:31:06', '2023-12-08 02:31:06'),
(38, 52, '52-38-1702027871.jpg', NULL, '2023-12-08 02:31:11', '2023-12-08 02:31:11'),
(39, 52, '52-39-1702027875.jpg', NULL, '2023-12-08 02:31:15', '2023-12-08 02:31:15'),
(40, 52, '52-40-1702027880.jpg', NULL, '2023-12-08 02:31:20', '2023-12-08 02:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 52, 'HOHOHO', 'sam@example.com', 'Xài được', 4.00, 0, '2023-12-19 02:25:42', '2023-12-20 01:56:14'),
(2, 52, 'samehere', 'hoahong@d.com', 'Tốt', 5.00, 1, '2023-12-19 02:26:57', '2023-12-20 01:56:20'),
(3, 12, 'Live in The hood', 'vesna@hi.com', 'Love Bejewed and the space backgound. Wonderful! Hope it has more picture.', 5.00, 0, '2023-12-20 01:33:59', '2023-12-20 01:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '6', 30.00, '2023-11-27 01:59:50', '2023-11-27 03:43:09'),
(2, 'rest_of_world', 100.00, '2023-11-27 02:25:34', '2023-11-28 01:42:46'),
(3, '80', 20.00, '2023-11-27 03:07:11', '2023-11-27 03:07:11'),
(4, '233', 12.00, '2023-11-27 03:42:59', '2023-11-27 03:42:59'),
(6, '7', 5.00, '2023-11-28 00:52:24', '2023-11-28 00:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'máy tính Dell', 'may-tinh-dell', 1, 'No', 45, '2023-10-23 06:47:53', '2023-10-23 06:47:53'),
(5, 'ewfaergae 34ra34rw34r', 'ewfaergae-34ra34rw34r', 1, 'No', 45, '2023-10-25 04:02:37', '2023-10-25 04:02:37'),
(6, 'bedroom', 'bedroom', 1, 'No', 44, '2023-10-28 02:28:38', '2023-10-28 02:28:38'),
(7, 'yea ye', 'yea-ye', 1, 'No', 44, '2023-10-28 02:28:57', '2023-10-28 02:28:57'),
(8, 'Dầu', 'dau', 1, 'Yes', 45, '2023-11-20 02:38:02', '2023-11-20 02:39:16'),
(9, 'Dank meme vui nhộn', 'dank-meme-vui-nhon', 1, 'Yes', 46, '2023-11-20 04:13:16', '2023-11-20 04:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1697882830.png', '2023-10-21 03:07:10', '2023-10-21 03:07:10'),
(2, '1697890200.jpg', '2023-10-21 05:10:00', '2023-10-21 05:10:00'),
(3, '1697891689.png', '2023-10-21 05:34:49', '2023-10-21 05:34:49'),
(4, '1697891713.png', '2023-10-21 05:35:13', '2023-10-21 05:35:13'),
(5, '1697891870.png', '2023-10-21 05:37:50', '2023-10-21 05:37:50'),
(6, '1697891898.jpg', '2023-10-21 05:38:18', '2023-10-21 05:38:18'),
(7, '1697892036.png', '2023-10-21 05:40:36', '2023-10-21 05:40:36'),
(8, '1697892283.png', '2023-10-21 05:44:43', '2023-10-21 05:44:43'),
(9, '1697892537.png', '2023-10-21 05:48:57', '2023-10-21 05:48:57'),
(10, '1697964855.png', '2023-10-22 01:54:15', '2023-10-22 01:54:15'),
(11, '1697964871.png', '2023-10-22 01:54:31', '2023-10-22 01:54:31'),
(12, '1697965269.png', '2023-10-22 02:01:09', '2023-10-22 02:01:09'),
(13, '1697965290.png', '2023-10-22 02:01:30', '2023-10-22 02:01:30'),
(14, '1697965300.png', '2023-10-22 02:01:40', '2023-10-22 02:01:40'),
(15, '1697965355.png', '2023-10-22 02:02:35', '2023-10-22 02:02:35'),
(16, '1697965377.jpg', '2023-10-22 02:02:57', '2023-10-22 02:02:57'),
(17, '1697965391.png', '2023-10-22 02:03:11', '2023-10-22 02:03:11'),
(18, '1697965755.jpg', '2023-10-22 02:09:15', '2023-10-22 02:09:15'),
(19, '1697965916.jpg', '2023-10-22 02:11:56', '2023-10-22 02:11:56'),
(20, '1697969582.png', '2023-10-22 03:13:02', '2023-10-22 03:13:02'),
(21, '1698068848.jpg', '2023-10-23 06:47:28', '2023-10-23 06:47:28'),
(22, '1698328235.png', '2023-10-26 06:50:35', '2023-10-26 06:50:35'),
(23, '1698328741.png', '2023-10-26 06:59:01', '2023-10-26 06:59:01'),
(24, '1698329823.png', '2023-10-26 07:17:03', '2023-10-26 07:17:03'),
(25, '1698330034.png', '2023-10-26 07:20:34', '2023-10-26 07:20:34'),
(26, '1698330034.png', '2023-10-26 07:20:34', '2023-10-26 07:20:34'),
(27, '1698330035.jpg', '2023-10-26 07:20:35', '2023-10-26 07:20:35'),
(28, '1698330076.png', '2023-10-26 07:21:16', '2023-10-26 07:21:16'),
(29, '1698330076.jpg', '2023-10-26 07:21:16', '2023-10-26 07:21:16'),
(30, '1698330078.png', '2023-10-26 07:21:18', '2023-10-26 07:21:18'),
(31, '1698330116.png', '2023-10-26 07:21:56', '2023-10-26 07:21:56'),
(32, '1698330116.png', '2023-10-26 07:21:56', '2023-10-26 07:21:56'),
(33, '1698330117.png', '2023-10-26 07:21:57', '2023-10-26 07:21:57'),
(34, '1698336159.jpg', '2023-10-26 09:02:39', '2023-10-26 09:02:39'),
(35, '1698336159.jpg', '2023-10-26 09:02:39', '2023-10-26 09:02:39'),
(36, '1698336183.jpg', '2023-10-26 09:03:03', '2023-10-26 09:03:03'),
(37, '1698336237.jpg', '2023-10-26 09:03:57', '2023-10-26 09:03:57'),
(38, '1698336248.jpg', '2023-10-26 09:04:08', '2023-10-26 09:04:08'),
(39, '1698336248.jpg', '2023-10-26 09:04:08', '2023-10-26 09:04:08'),
(40, '1698336249.jpg', '2023-10-26 09:04:09', '2023-10-26 09:04:09'),
(41, '1698336250.png', '2023-10-26 09:04:10', '2023-10-26 09:04:10'),
(42, '1698336262.png', '2023-10-26 09:04:22', '2023-10-26 09:04:22'),
(43, '1698336262.jpg', '2023-10-26 09:04:22', '2023-10-26 09:04:22'),
(44, '1698336263.png', '2023-10-26 09:04:23', '2023-10-26 09:04:23'),
(45, '1698336263.png', '2023-10-26 09:04:23', '2023-10-26 09:04:23'),
(46, '1698336278.jpg', '2023-10-26 09:04:38', '2023-10-26 09:04:38'),
(47, '1698336278.png', '2023-10-26 09:04:38', '2023-10-26 09:04:38'),
(48, '1698336279.jpg', '2023-10-26 09:04:39', '2023-10-26 09:04:39'),
(49, '1698396510.png', '2023-10-27 01:48:30', '2023-10-27 01:48:30'),
(50, '1698396510.jpg', '2023-10-27 01:48:30', '2023-10-27 01:48:30'),
(51, '1698396686.jpg', '2023-10-27 01:51:26', '2023-10-27 01:51:26'),
(52, '1698396862.png', '2023-10-27 01:54:22', '2023-10-27 01:54:22'),
(53, '1698396963.png', '2023-10-27 01:56:03', '2023-10-27 01:56:03'),
(54, '1698396969.png', '2023-10-27 01:56:09', '2023-10-27 01:56:09'),
(55, '1698397035.jpg', '2023-10-27 01:57:15', '2023-10-27 01:57:15'),
(56, '1698397035.jpg', '2023-10-27 01:57:15', '2023-10-27 01:57:15'),
(57, '1698397036.jpg', '2023-10-27 01:57:16', '2023-10-27 01:57:16'),
(58, '1698397189.jpg', '2023-10-27 01:59:49', '2023-10-27 01:59:49'),
(59, '1698397189.jpg', '2023-10-27 01:59:49', '2023-10-27 01:59:49'),
(60, '1698397252.png', '2023-10-27 02:00:52', '2023-10-27 02:00:52'),
(61, '1698397252.png', '2023-10-27 02:00:52', '2023-10-27 02:00:52'),
(62, '1698397406.jpg', '2023-10-27 02:03:26', '2023-10-27 02:03:26'),
(63, '1698397406.jpg', '2023-10-27 02:03:26', '2023-10-27 02:03:26'),
(64, '1698397406.jpg', '2023-10-27 02:03:26', '2023-10-27 02:03:26'),
(65, '1698397406.jpg', '2023-10-27 02:03:26', '2023-10-27 02:03:26'),
(66, '1698397425.jpg', '2023-10-27 02:03:45', '2023-10-27 02:03:45'),
(67, '1698397425.jpg', '2023-10-27 02:03:45', '2023-10-27 02:03:45'),
(68, '1698397426.jpg', '2023-10-27 02:03:46', '2023-10-27 02:03:46'),
(69, '1698397434.jpg', '2023-10-27 02:03:54', '2023-10-27 02:03:54'),
(70, '1698397437.jpg', '2023-10-27 02:03:57', '2023-10-27 02:03:57'),
(71, '1698397441.jpg', '2023-10-27 02:04:01', '2023-10-27 02:04:01'),
(72, '1698397445.jpg', '2023-10-27 02:04:05', '2023-10-27 02:04:05'),
(73, '1698412595.jpg', '2023-10-27 06:16:35', '2023-10-27 06:16:35'),
(74, '1698412599.jpg', '2023-10-27 06:16:39', '2023-10-27 06:16:39'),
(75, '1698412603.jpg', '2023-10-27 06:16:43', '2023-10-27 06:16:43'),
(76, '1698413973.jpg', '2023-10-27 06:39:33', '2023-10-27 06:39:33'),
(77, '1698413977.jpg', '2023-10-27 06:39:37', '2023-10-27 06:39:37'),
(78, '1698413980.jpg', '2023-10-27 06:39:40', '2023-10-27 06:39:40'),
(79, '1698413984.jpg', '2023-10-27 06:39:44', '2023-10-27 06:39:44'),
(80, '1698414053.jpg', '2023-10-27 06:40:53', '2023-10-27 06:40:53'),
(81, '1698414056.jpg', '2023-10-27 06:40:56', '2023-10-27 06:40:56'),
(82, '1698414061.jpg', '2023-10-27 06:41:01', '2023-10-27 06:41:01'),
(83, '1698414065.jpg', '2023-10-27 06:41:05', '2023-10-27 06:41:05'),
(84, '1698414117.jpg', '2023-10-27 06:41:57', '2023-10-27 06:41:57'),
(85, '1698414117.jpg', '2023-10-27 06:41:57', '2023-10-27 06:41:57'),
(86, '1698414118.jpg', '2023-10-27 06:41:58', '2023-10-27 06:41:58'),
(87, '1698414118.jpg', '2023-10-27 06:41:58', '2023-10-27 06:41:58'),
(88, '1698414125.jpg', '2023-10-27 06:42:05', '2023-10-27 06:42:05'),
(89, '1698414129.jpg', '2023-10-27 06:42:09', '2023-10-27 06:42:09'),
(90, '1698414133.jpg', '2023-10-27 06:42:13', '2023-10-27 06:42:13'),
(91, '1698414137.jpg', '2023-10-27 06:42:17', '2023-10-27 06:42:17'),
(92, '1698414754.png', '2023-10-27 06:52:34', '2023-10-27 06:52:34'),
(93, '1698485251.png', '2023-10-28 02:27:31', '2023-10-28 02:27:31'),
(94, '1698485251.png', '2023-10-28 02:27:31', '2023-10-28 02:27:31'),
(95, '1698485252.png', '2023-10-28 02:27:32', '2023-10-28 02:27:32'),
(96, '1698485262.png', '2023-10-28 02:27:42', '2023-10-28 02:27:42'),
(97, '1698485266.png', '2023-10-28 02:27:46', '2023-10-28 02:27:46'),
(98, '1698485271.png', '2023-10-28 02:27:51', '2023-10-28 02:27:51'),
(99, '1698485274.png', '2023-10-28 02:27:54', '2023-10-28 02:27:54'),
(100, '1698485520.png', '2023-10-28 02:32:00', '2023-10-28 02:32:00'),
(101, '1698485523.png', '2023-10-28 02:32:03', '2023-10-28 02:32:03'),
(102, '1698485527.png', '2023-10-28 02:32:07', '2023-10-28 02:32:07'),
(103, '1700479431.jpg', '2023-11-20 04:23:51', '2023-11-20 04:23:51'),
(104, '1700479446.jpg', '2023-11-20 04:24:06', '2023-11-20 04:24:06'),
(105, '1700479622.jpg', '2023-11-20 04:27:02', '2023-11-20 04:27:02'),
(106, '1700479628.png', '2023-11-20 04:27:08', '2023-11-20 04:27:08'),
(107, '1700479632.jpg', '2023-11-20 04:27:12', '2023-11-20 04:27:12'),
(108, '1700565563.png', '2023-11-21 04:19:23', '2023-11-21 04:19:23'),
(109, '1700565564.png', '2023-11-21 04:19:24', '2023-11-21 04:19:24'),
(110, '1700565564.png', '2023-11-21 04:19:24', '2023-11-21 04:19:24'),
(111, '1700565570.png', '2023-11-21 04:19:30', '2023-11-21 04:19:30'),
(112, '1700565787.png', '2023-11-21 04:23:07', '2023-11-21 04:23:07'),
(113, '1700565797.jpg', '2023-11-21 04:23:17', '2023-11-21 04:23:17'),
(114, '1700565803.png', '2023-11-21 04:23:23', '2023-11-21 04:23:23'),
(115, '1700565908.jpg', '2023-11-21 04:25:08', '2023-11-21 04:25:08'),
(116, '1700565915.jpg', '2023-11-21 04:25:15', '2023-11-21 04:25:15'),
(117, '1700565920.jpg', '2023-11-21 04:25:20', '2023-11-21 04:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, 2, 1, NULL, '$2y$10$aK6NpJRoM4oIM9wSd7ZmS.DisnMkjrIKB5md2nQ9MImrt5dism5sq', NULL, '2023-10-17 05:13:51', '2023-10-17 05:13:51'),
(2, 'Vesna', 'vesna@hi.com', NULL, 1, 1, NULL, '$2y$10$9KsCWWS3VSo7Vgdv4c/vo.CPUm9O6KzK8tStiPdORnFtk062iuVAu', NULL, '2023-10-17 05:16:26', '2023-10-17 05:16:26'),
(3, 'Dank Memes Vui Nhộn', 'hoahong@d.com', '0394763795', 1, 1, NULL, '$2y$10$g2XzZRBTbSzKy40nlYPJIeTfmliV0U108tsWSo5BTjQAW2T.51fAG', NULL, '2023-11-25 01:21:38', '2023-12-12 02:01:13'),
(4, 'YOOOOOOOOOO', 'xuan.tranvu52@gmail.com', '0547844234', 1, 1, NULL, '$2y$10$TBpM2mpzS.3Dz2jMTiEhd.ZB.VOc1MbJzMgOw8OF10RXXQJVj9oSW', NULL, '2023-11-25 04:38:56', '2023-12-09 01:39:23'),
(5, 'sdjknm,x ijskndm,', 'hohoho@gmail.com', '096456899', 1, 1, NULL, '$2y$10$HIT.ROTnG0XMGT0plohZleTlZerl4wZLzuMDd80Ayz07F5HTbpr6e', NULL, '2023-11-28 03:01:34', '2023-12-16 02:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
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
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
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
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
