-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2018 at 01:53 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilgamos_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `is_finished` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `disable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `customer_name`, `staff_name`, `table_number`, `total_price`, `is_finished`, `disable`, `created_at`, `updated_at`) VALUES
(57, 'Tony', 'Duy Tran', 'bns', 68000, 1, 0, '2018-03-31 13:15:37', '2018-03-31 13:41:25'),
(58, 'Tây đội nón', 'Duy Tran', 'bns', 51000, 1, 0, '2018-03-31 13:18:19', '2018-03-31 13:30:19'),
(59, 'Tây mắt kính', 'Duy Tran', 'bbtc', 50000, 1, 0, '2018-03-31 13:18:50', '2018-03-31 13:21:47'),
(60, 'Kính râm', 'Duy Tran', 'bns', 17000, 1, 0, '2018-03-31 13:34:47', '2018-03-31 13:35:03'),
(61, 'Berry', 'Duy Tran', 'bns', 25000, 1, 0, '2018-03-31 13:35:21', '2018-03-31 13:35:32'),
(62, 'Bạn Berry', 'Duy Tran', 'bns', 17000, 1, 0, '2018-03-31 13:35:57', '2018-03-31 13:36:10'),
(63, 'Khách Tây', 'Duy Tran', 'bns', 34000, 1, 0, '2018-03-31 13:36:54', '2018-03-31 13:38:55'),
(64, 'I AN 1', 'Duy Tran', 'bns', 34000, 1, 0, '2018-04-01 04:14:12', '2018-04-01 05:13:46'),
(65, 'S VEN', 'Duy Tran', 'bns', 20000, 1, 0, '2018-04-01 04:45:24', '2018-04-01 05:14:01'),
(66, 'Cặp vợ chồng Tây', 'Duy Tran', 'bbtg', 329000, 1, 0, '2018-04-01 05:53:18', '2018-04-01 06:48:54'),
(70, 'Gia đình tây áo xanh nước biển', 'Duy Tran', 'bbtg', 607000, 1, 0, '2018-04-01 09:40:58', '2018-04-01 11:02:18'),
(71, '2 cặp tây trẻ', 'Duy Tran', 'bns', 77000, 0, 0, '2018-04-01 11:17:26', '2018-04-01 11:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_type` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `disable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2018_03_10_061016_create_product_table', 1),
(18, '2018_03_10_061017_create_product_detail_table', 1),
(19, '2018_03_10_061018_create_menu_table', 1),
(20, '2018_03_10_061019_create_contract_table', 1),
(21, '2018_03_10_061020_create_order_detail_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `contract_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name_vi` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_name_en` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `unit_price` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `total_price` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `disable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `contract_id`, `product_id`, `product_name_vi`, `product_name_en`, `amount`, `unit_price`, `total_price`, `disable`, `created_at`, `updated_at`) VALUES
(84, 57, 260, 'Saigon Đỏ', 'Saigon Export', 4, 17000, 68000, 0, '2018-03-31 13:17:57', '2018-03-31 13:41:17'),
(85, 58, 259, 'Saigon Trắng', 'Saigon Lager', 3, 17000, 51000, 0, '2018-03-31 13:18:28', '2018-03-31 13:28:28'),
(86, 59, 262, 'Tiger', 'Tiger', 2, 25000, 50000, 0, '2018-03-31 13:19:01', '2018-03-31 13:19:10'),
(87, 60, 259, 'Saigon Trắng', 'Saigon Lager', 1, 17000, 17000, 0, '2018-03-31 13:34:54', '2018-03-31 13:34:54'),
(88, 61, 262, 'Tiger', 'Tiger', 1, 25000, 25000, 0, '2018-03-31 13:35:30', '2018-03-31 13:35:30'),
(89, 62, 259, 'Saigon Trắng', 'Saigon Lager', 1, 17000, 17000, 0, '2018-03-31 13:36:08', '2018-03-31 13:36:08'),
(90, 63, 259, 'Saigon Trắng', 'Saigon Lager', 2, 17000, 34000, 0, '2018-03-31 13:38:10', '2018-03-31 13:38:37'),
(91, 64, 259, 'Saigon Trắng', 'Saigon Lager', 2, 17000, 34000, 0, '2018-04-01 04:15:04', '2018-04-01 04:44:51'),
(92, 65, 267, 'Coca Cola', 'Coca Cola', 1, 20000, 20000, 0, '2018-04-01 04:45:48', '2018-04-01 04:45:48'),
(93, 66, 261, 'Saigon Special', 'Saigon Special', 2, 22000, 44000, 0, '2018-04-01 05:53:32', '2018-04-01 06:19:26'),
(94, 66, 221, 'Hàu phủ phô mai đút lò', 'Baked oysters with cheese', 1, 125000, 125000, 0, '2018-04-01 06:04:38', '2018-04-01 06:04:38'),
(95, 66, 231, 'Mì xào hải sản', 'Stir-fried seafood noodles', 1, 105000, 105000, 0, '2018-04-01 06:04:38', '2018-04-01 06:04:38'),
(96, 66, 354, 'Phở gà', 'Chicken noodle\'s soup', 1, 55000, 55000, 0, '2018-04-01 06:27:04', '2018-04-01 06:27:04'),
(97, 70, 282, 'Ca Phe Den Vietnam array(hot/ice)', 'Ca Phe Den Vietnam array(hot/ice)', 0, 25000, 0, 0, '2018-04-01 09:42:54', '2018-04-01 09:56:17'),
(98, 70, 297, 'Sinh tố đu đủ', 'Papaya Smoothie', 1, 40000, 40000, 0, '2018-04-01 09:42:54', '2018-04-01 09:42:54'),
(99, 70, 274, 'Trà đá chanh', 'Classic lemon iced tea', 1, 30000, 30000, 0, '2018-04-01 09:42:54', '2018-04-01 09:42:54'),
(100, 70, 185, 'Bơ gơ bò hoặc gà phô mai', 'Cheesy beef or chicken burger', 0, 85000, 0, 0, '2018-04-01 09:42:54', '2018-04-01 09:42:59'),
(101, 70, 186, 'Bơ gơ bò phô mai với thịt xông khói', 'Cheesy beef burger with bacon', 0, 105000, 0, 0, '2018-04-01 09:43:12', '2018-04-01 09:43:14'),
(102, 70, 359, 'Bơ gơ bò hoặc gà', 'Beef burger or chicken burger', 1, 69000, 69000, 0, '2018-04-01 09:46:37', '2018-04-01 09:46:37'),
(103, 70, 283, 'Ca Phe Sua Da Vietnam array(milk hot/ice)', 'Ca Phe Sua Da Vietnam array(milk hot/ice)', 1, 30000, 30000, 0, '2018-04-01 09:56:26', '2018-04-01 09:56:26'),
(104, 70, 222, 'Mực/tôm lăn bột chiên giòn', 'Calamari/shrimp tempura array(250gr)', 1, 169000, 169000, 0, '2018-04-01 10:08:13', '2018-04-01 10:08:13'),
(105, 70, 201, 'Gà tẩm bột chiên xù, sốt tiêu/nấm', 'Chicken schnitzel, pepper/mushroom sauce array(250gr)', 1, 149000, 149000, 0, '2018-04-01 10:08:13', '2018-04-01 10:08:13'),
(106, 70, 260, 'Saigon Đỏ', 'Saigon Export', 0, 17000, 0, 0, '2018-04-01 10:08:44', '2018-04-01 10:10:08'),
(107, 70, 360, 'Rượu vang Đà Lạt đỏ', 'Da Lat clasic white', 3, 40000, 120000, 0, '2018-04-01 10:16:46', '2018-04-01 10:46:18'),
(108, 71, 326, 'Gordon\'s ', 'Gordon\'s ', 1, 35000, 35000, 0, '2018-04-01 11:17:41', '2018-04-01 11:41:41'),
(109, 71, 261, 'Saigon Xanh', 'Saigon Special', 1, 22000, 22000, 0, '2018-04-01 11:17:41', '2018-04-01 11:17:41'),
(110, 71, 271, 'Tonic Water', 'Tonic Water', 1, 20000, 20000, 0, '2018-04-01 11:20:02', '2018-04-01 11:20:02');

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_type` int(11) NOT NULL DEFAULT '1',
  `product_name_en` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_name_vi` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `disable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `column_name`, `product_type`, `product_name_en`, `product_name_vi`, `disable`, `created_at`, `updated_at`) VALUES
(183, '', 1, 'Vietnamese beef stew with carros, potatoes, beans, bread.', 'Súp bò kho, bánh mì.', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(184, '', 1, 'Borsch soup', 'Súp kiểu Nga', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(185, '', 1, 'Cheesy beef or chicken burger', 'Bơ gơ bò hoặc gà phô mai', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(186, '', 1, 'Cheesy beef burger with bacon', 'Bơ gơ bò phô mai với thịt xông khói', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(187, '', 1, 'Double cheesy beef burger', 'Bơ gơ bò phô mai lớn', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(188, '', 1, 'Mozzarella cheese sticks', 'Phô mai lăn bột chiên giòn', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(189, '', 1, 'Crispy pork spring rolls', 'Chả giò thịt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(190, '', 1, 'Mixed green salad, tomatoes, onion, cucumber, olive oil and vinegar sauce', 'Xà lách trộn dầu giấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(191, '', 1, 'Beef salad', 'Xà lách bò, sốt tiêu chanh', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(192, '', 1, 'Tuna salad', 'Xà lách cá ngừ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(193, '', 1, 'Salmon salad', 'Xà lách cá hồi', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(194, '', 1, 'Grilled AUS/USA Rib eye with sauce array(250gr)', 'Thăn bò Úc/Mỹ nướng, sốt tiêu/nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(195, '', 1, 'Grilled AUS/USA T-Bone with sauce array(250gr)', 'Thăn bò T-Bone Úc/Mỹ nướng, sốt tiêu/nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(196, '', 1, 'Grilled AUS lamb chops, Red wine sauce array(250gr)', 'Sườn cừu Úc nướng, sốt rượu vang đỏ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(197, '', 1, 'Stewed AUS lamb fillet with red wine array(250gr)', 'Thịt cừu Úc hầm rượu vang đỏ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(198, '', 1, 'Grilled pork chop, creamy sauce array(250gr)', 'Thịt cốc lết nướng, sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(199, '', 1, 'Two pcs of steamed or grilled pork/ chicken, mustard sausages', 'Xúc xích heo/ gà luộc hoặc nướng, mù tạt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(200, '', 1, 'French style pork in oven array(250gr)', 'Thịt heo đút lò', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(201, '', 1, 'Chicken schnitzel, pepper/mushroom sauce array(250gr)', 'Gà tẩm bột chiên xù, sốt tiêu/nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(202, '', 1, 'Pork schnitzel, pepper/mushroom sauce array(250gr)', 'Thịt heo tẩm bột chiên xù, sốt tiêu/nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(203, '', 1, 'Veal AUS schnitzel, pepper sauce/mushroom sauce array(250gr)', 'Thịt bê tẩm bột chiên xù, sốt tiêu/nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(204, '', 1, 'German style fried mincedbeef balls, mustard vinegar sauce array(300gr)', 'Thịt bò băm viên chiên kiểu Đức', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(205, '', 1, 'German style stewed pork thigh, creamy sauce array(350gr)', 'Chân giò heo hầm kiểu Đức, sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(206, '', 1, 'Stewed beef with Red wine array(250gr)', 'Thịt bò hầm sốt rượu vang đỏ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(207, '', 1, 'Stewed beef with green pepper array(beef muscle 250gr)', 'Bắp bò hầm tiêu xanh', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(208, '', 1, 'BBQ pork ribs array(400gr)', 'Sườn heo nướng BBQ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(209, '', 1, 'BBQ chicken thighs array(400gr)', 'Đùi gà nướng sốt BBQ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(210, '', 1, 'BBQ chicken wings array(400gr)', 'Cánh gà nướng sốt BBQ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(211, '', 1, 'Pan seared chicken breast array(250gr)', 'Ức gà áp chảo', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(212, '', 1, 'Chicken kiev array(250gr)', 'Ức gà cuộn phô mai phủ bột chiên xù', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(213, '', 1, 'French style chicken breast in oven array(250gr)', 'Ức gà phủ nấm đút lò', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(214, '', 1, 'Pan seared fillet sea bass, passion fruit sauce array(250gr)', 'Cá chẽm áp chảo sốt chanh dây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(215, '', 1, 'Pan seared salmon, passion fruit sauce array(250gr)', 'Cá hồi áp chảo sốt chanh đây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(216, '', 1, 'Pan seared tuna steak, vinegar sauce array(250gr)', 'Cá ngừ đại dương áp chảo sốt nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(217, '', 1, 'Grilled squid/shrimp with butter, garlic array(250gr)', 'Mực/tôm nướng bơ tỏi', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(218, '', 1, 'Grilled chili, salt squid/ shrimp array(250gr)', 'Mực/tôm nướng muối ớt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(219, '', 1, 'Grilled satay octopus, pineapple, bell pepper array(330gr)', 'Bạch tuộc nướng sa tế, dứa, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(220, '', 1, 'Sauteed sweet and sour octopus array(330gr)', 'Bạch tuộc xào chua ngọt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(221, '', 1, 'Baked oysters with cheese', 'Hàu phủ phô mai đút lò', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(222, '', 1, 'Calamari/shrimp tempura array(250gr)', 'Mực/tôm lăn bột chiên giòn', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(223, '', 1, 'Stir-fried chicken with ginger, lemon grass, chili array(250gr)', 'Gà ta xào gừng, xả ớt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(224, '', 1, 'Stir-fried chicken with pineapple, bell pepper array(250gr)', 'Gà ta xào dứa, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(225, '', 1, 'Sauteed sweet and sour chicken array(250gr) ', 'Gà ta sốt chua ngọt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(226, '', 1, 'Grilled half chicken with honey array(700gr)', 'Gà ta nướng mật ong', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(227, '', 1, 'Grilled whole chicken with honeyarray(1400gr)', 'Gà ta nguyên con nướng mật ong', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(228, '', 1, 'Seafood fried rice', 'Cơm chiên hải sản', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(229, '', 1, 'Stir-fried chicken noodles', 'Mì xào gà', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(230, '', 1, 'Stir-fried beef noodles', 'Mì xào bò', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(231, '', 1, 'Stir-fried seafood noodles', 'Mì xào hải sản', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(232, '', 1, 'French fries \'Big\'', 'Khoai tây chiên', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(233, '', 1, 'Mashes potatoes', 'Khoai tây nghiền', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(234, '', 1, 'Bolled potatoes cakes', 'Khoai tây luộc', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(235, '', 1, 'Steamed vegetables', 'Rau củ luộc', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(236, '', 1, 'Spaghetti carbonara, Jambon', 'Mì Ý sốt kem và thịt giăm bông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(237, '', 1, 'Spaghetti Bolognese', 'Mì Ý sốt bò bằm truyền thống', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(238, '', 1, 'Creamy sauce chicken spaghetti, mushroom', 'Mì Ý gà, nấm sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(239, '', 1, 'BBQ beef spaghetti, onion, mushroom', 'Mì Ý bò sốt BBQ, hành tây và nấm', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(240, '', 1, 'BBQ beef/pork sausage spaghetti', 'Mì Ý xúc xích bò/heo sốt BBQ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(241, '', 1, 'Creamy garlic seafood spaghetti', 'Mì Ý hải sản sốt kem tỏi', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(242, '', 1, 'Seafood spaghetti, spicy tomato sauce', 'Mì Ý hải sản sốt cà chua cay', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(243, '', 1, 'Bacon spaghetti, creamy sauce', 'Mì Ý thịt hun khói, hành tây sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(244, '', 1, 'Salmon spaghetti, creamy sauce', 'Mì Ý cá hồi sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(245, '', 1, 'Salmon spaghetti, tomato sauce', 'Mì Ý cá hồi sốt cà chua', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(246, '', 1, 'Tuna spaghetti, creamy sauce', 'Mì Ý cá ngừ sốt kem', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(247, '', 1, 'Tuna spaghetti with tomato sauce', 'Mì Ý cá ngừ sốt cà chua', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(248, '', 1, 'Hawaii pizza, tomato sauce, mozzarella, pineapple, jambon', 'Pizza sốt cà chua, phô mai, giăm bông, dứa', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(249, '', 1, 'Olives pizza, tomato, mozzarella, bell pepper, mishroom, onion', 'Pizza sốt cà chua, phô mai, ooliu ớt chuông, nấm, hành tây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(250, '', 1, 'Spicy salami pizza, tomato sauce, mozzarela', 'Pizza sốt cà chua, phô mai, xúc xích tiêu cay', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(251, '', 1, 'Bolognese pizza, tomato, mozzarella, bell pepper', 'Pizza sốt cà chua, phô mai, bò bằm, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(252, '', 1, 'BBQ chicken pizza, mozzarella, onion, bell pepper', 'Pizza sốt gà nướng BBQ, phô mai, hành tây, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(253, '', 1, 'Meatlovers\' supreme pizza, tomato sauce, mozzarella, onion, bacon, sausage, salami', 'Pizza xốt cà chua, phô mai, thịt xông khói, xúc xích tiêu cay, hành tây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(254, '', 1, 'Beefy pizza, tomato sauce, mozzarella, minced beef, jambon, sakami', 'Pizza xốt cà chua, phô mai, bò băm, jambon, salami', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(255, '', 1, 'Seafood pizza, tomato sauce, mozzarella, onion, bell pepper', 'Pizza xốt cà chua, phô mai, hải sản, hành tây, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(256, '', 1, 'Tuna pizza, tomato sauce, mozzarella, pineapple', 'Pizza cá ngừ, sốt cà chua, phô mai, dứa', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(257, '', 1, 'Salmon Pizza tomato sauce, mozzarella, onion, bell pepper', 'Pizza cá hồi, sốt cà chua, phô mai, hành tây, ớt chuông', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(258, '', 1, 'Special Pizza four seasons Ilgamos', 'Pizza đặc biệt bốn mùa Ilgamos', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(259, '', 2, 'Saigon Lager', 'Saigon Trắng', 0, '2018-03-31 12:37:13', '2018-04-01 06:17:02'),
(260, '', 2, 'Saigon Export', 'Saigon Đỏ', 0, '2018-03-31 12:37:13', '2018-04-01 06:17:11'),
(261, '', 2, 'Saigon Special', 'Saigon Xanh', 0, '2018-03-31 12:37:13', '2018-04-01 06:17:22'),
(262, '', 2, 'Tiger', 'Tiger', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(263, '', 2, 'Tiger Crystal', 'Tiger Crystal', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(264, '', 2, 'Heineken', 'Heineken', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(265, '', 2, 'Strongbow Cider', 'Strongbow Cider', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(266, '', 3, 'Vikoda 500ml', 'Vikoda 500ml', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(267, '', 4, 'Coca Cola', 'Coca Cola', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(268, '', 4, 'Diet Coke', 'Diet Coke', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(269, '', 4, 'Sprite', 'Sprite', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(270, '', 4, 'Soda water', 'Soda water', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(271, '', 4, 'Tonic Water', 'Tonic Water', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(272, '', 4, 'Sea Bird\'s', 'Sea Bird\'s', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(273, '', 4, 'Red Bull', 'Red Bull', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(274, '', 5, 'Classic lemon iced tea', 'Trà đá chanh', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(275, '', 5, 'Lipton tea array(hot/ice)', 'Trà lipton', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(276, '', 5, 'Lipton tea with milk array(hot/ice)', 'Trà lipton sữa', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(277, '', 5, 'Cocoa array(hot/ice)', 'Cacao array(nóng/đá)', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(278, '', 6, 'Espresso', 'Espresso', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(279, '', 6, 'Double Espresso', 'Double Espresso', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(280, '', 6, 'Cappuccino', 'Cappuccino', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(281, '', 6, 'Café Latte', 'Café Latte', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(282, '', 6, 'Ca Phe Den Vietnam array(hot/ice)', 'Ca Phe Den Vietnam array(hot/ice)', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(283, '', 6, 'Ca Phe Sua Da Vietnam array(milk hot/ice)', 'Ca Phe Sua Da Vietnam array(milk hot/ice)', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(284, '', 7, 'Martini Dry', 'Martini Dry', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(285, '', 7, 'Martini Bianco', 'Martini Bianco', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(286, '', 8, 'Orange Juice', 'Cam Ép', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(287, '', 8, 'Pineapple Juice', 'Dứa Ép', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(288, '', 8, 'Passion Juice', 'Nước Chanh Dây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(289, '', 8, 'Lemon Juice', 'Nước Chanh Dây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(290, '', 8, 'Apple Juice', 'Nước Ép Táo', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(291, '', 8, 'Water melon Juice', 'Nước Dưa Hấu', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(292, '', 8, 'Young Coconut ', 'Dừa Tươi', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(293, '', 8, 'Carrot Juice', 'Nước Ép Cà Rốt', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(294, '', 8, 'Tomato Juice', 'Nước Ép Cà Chua', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(295, '', 9, 'Mango Smoothie', 'Sinh tố xoài', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(296, '', 9, 'Banana Smoothie', 'Sinh tố chuối', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(297, '', 9, 'Papaya Smoothie', 'Sinh tố đu đủ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(298, '', 9, 'Strawberry Smoothie', 'Sinh tố dâu tây', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(299, '', 9, 'Sapoche Smoothie', 'Sinh tố Sa pô chê', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(300, '', 10, 'JW Red Label', 'JW Red Label', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(301, '', 10, 'JW Black Label', 'JW Black Label', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(302, '', 10, 'Ballantine\'s Finest', 'Ballantine\'s Finest', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(303, '', 10, 'Ballantine\'s 12', 'Ballantine\'s 12', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(304, '', 10, 'Chivas Regal 12y', 'Chivas Regal 12y', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(305, '', 10, 'Wall Street VN', 'Wall Street VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(306, '', 10, 'Whisky ISC VN', 'Whisky ISC VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(307, '', 11, 'Dalat Classic Red', 'Dalat Classic Red', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(308, '', 11, 'Dalat Classic White', 'Dalat Classic White', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(309, '', 12, 'Tequila Jose Cuervo Gold 7 Coins', 'Tequila Jose Cuervo Gold 7 Coins', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(310, '', 12, 'Sauza Gold', 'Sauza Gold', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(311, '', 13, 'Barcadi Light', 'Barcadi Light', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(312, '', 13, 'Havana Club Blanco', 'Havana Club Blanco', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(313, '', 13, 'Captain Morgan Original Black Label', 'Captain Morgan Original Black Label', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(314, '', 13, 'Captain Morgan Original Spice Gold', 'Captain Morgan Original Spice Gold', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(315, '', 13, 'Rhum Asia VN', 'Rhum Asia VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(316, '', 13, 'Rhum ISC VN', 'Rhum ISC VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(317, '', 13, 'Rhum Cacao VN', 'Rhum Cacao VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(318, '', 13, 'Rhum Coffee VN', 'Rhum Coffee VN', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(319, '', 13, 'Rhum Chauvet Dark ', 'Rhum Chauvet Dark ', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(320, '', 13, 'Rhum Chauvet Balanco', 'Rhum Chauvet Balanco', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(321, '', 14, 'Malibu', 'Malibu', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(322, '', 14, 'Kahlua', 'Kahlua', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(323, '', 14, 'Baley\'s Irish Cream', 'Baley\'s Irish Cream', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(324, '', 14, 'Cointreau', 'Cointreau', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(325, '', 15, 'Bombay Shapphir', 'Bombay Shapphir', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(326, '', 15, 'Gordon\'s', 'Gordon\'s', 0, '2018-03-31 12:37:13', '2018-04-01 11:30:22'),
(327, '', 15, 'Beefeater London Dry', 'Beefeater London Dry', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(328, '', 15, 'Beefeater Vietnam Dry', 'Beefeater Vietnam Dry', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(329, '', 16, 'Smirnoff Red', 'Smirnoff Red', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(330, '', 16, 'Smirnoff Black', 'Smirnoff Black', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(331, '', 16, 'Absolute', 'Absolute', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(332, '', 16, 'Danzka Red', 'Danzka Red', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(333, '', 16, 'Putinka Gold', 'Putinka Gold', 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(334, '', 16, 'Standard Vodka', 'Standard Vodka', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(335, '', 16, 'Vodka Aligator Russian', 'Vodka Aligator Russian', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(336, '', 16, 'Vodka Aligator Vietnam', 'Vodka Aligator Vietnam', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(337, '', 16, 'Men\'s Vodka', 'Men\'s Vodka', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(338, '', 16, 'Vodka Hanoi', 'Vodka Hanoi', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(339, '', 17, 'Jim Beam White', 'Jim Beam White', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(340, '', 17, 'Jameson Irish', 'Jameson Irish', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(341, '', 17, 'Canadian Club', 'Canadian Club', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(342, '', 18, 'Ilgamos Passion', 'Ilgamos Passion', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(343, '', 18, 'Espresso Martini', 'Espresso Martini', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(344, '', 18, 'Nha Trang Martini', 'Nha Trang Martini', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(345, '', 18, 'Lychee Martini', 'Lychee Martini', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(346, '', 18, 'Classic Mojito', 'Classic Mojito', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(347, '', 18, 'Caipiroska', 'Caipiroska', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(348, '', 18, 'Pina Colada', 'Pina Colada', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(349, '', 18, 'Whisky Sour', 'Whisky Sour', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(350, '', 18, 'Blue Hawaiian', 'Blue Hawaiian', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(351, '', 18, 'B52', 'B52', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(352, '', 18, 'JUG FOR 2 / Green Paradise', 'JUG FOR 2 / Green Paradise', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(353, '', 18, 'Signature Sangrira', 'Signature Sangrira', 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(354, '', 1, 'Chicken noodle\'s soup', 'Phở gà', 0, '2018-04-01 06:08:39', '2018-04-01 06:08:39'),
(355, '', 1, 'Beef noodles soup', 'Phở bò', 0, '2018-04-01 06:09:21', '2018-04-01 06:09:21'),
(356, '', 1, 'Four Pancakes', 'Bánh xèo Âu', 0, '2018-04-01 06:10:31', '2018-04-01 06:20:40'),
(357, '', 1, 'Three fried eggs with tomatoes, onions, bread', '3 trứng ốp la, cà chua, hành tây, bánh mì', 0, '2018-04-01 06:11:41', '2018-04-01 06:20:50'),
(358, '', 1, 'Three omelettes with cheese, milk, tomatoes, onion, bread', '3 trứng chiên với sữa, phô mai, cà chua, hành tây, bánh mì', 0, '2018-04-01 06:12:56', '2018-04-01 06:21:02'),
(359, '', 1, 'Beef burger or chicken burger', 'Bơ gơ bò hoặc gà', 0, '2018-04-01 09:46:16', '2018-04-01 09:46:16'),
(360, '', 11, 'Da Lat clasic white', 'Rượu vang Đà Lạt đỏ', 0, '2018-04-01 10:16:06', '2018-04-01 10:16:06'),
(361, '', 11, 'Da Lat clasic white', 'Rượu vang Đà Lạt Trắng', 0, '2018-04-01 10:16:30', '2018-04-01 10:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `version_no` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `disable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `version_no`, `price`, `disable`, `created_at`, `updated_at`) VALUES
(25, 183, 1, 79000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(26, 184, 1, 79000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(27, 185, 1, 85000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(28, 186, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(29, 187, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(30, 188, 1, 79000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(31, 189, 1, 79000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(32, 190, 1, 75000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(33, 191, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(34, 192, 1, 115000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(35, 193, 1, 135000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(36, 194, 1, 229000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(37, 195, 1, 199000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(38, 196, 1, 199000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(39, 197, 1, 199000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(40, 198, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(41, 199, 1, 139000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(42, 200, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(43, 201, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(44, 202, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(45, 203, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(46, 204, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(47, 205, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(48, 206, 1, 189000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(49, 207, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(50, 208, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(51, 209, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(52, 210, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(53, 211, 1, 135000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(54, 212, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(55, 213, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(56, 214, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(57, 215, 1, 239000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(58, 216, 1, 199000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(59, 217, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(60, 218, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(61, 219, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(62, 220, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(63, 221, 1, 125000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(64, 222, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(65, 223, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(66, 224, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(67, 225, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(68, 226, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(69, 227, 1, 249000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(70, 228, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(71, 229, 1, 85000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(72, 230, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(73, 231, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(74, 232, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(75, 233, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(76, 234, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(77, 235, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(78, 236, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(79, 237, 1, 115000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(80, 238, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(81, 239, 1, 115000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(82, 240, 1, 115000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(83, 241, 1, 125000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(84, 242, 1, 125000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(85, 243, 1, 105000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(86, 244, 1, 145000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(87, 245, 1, 145000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(88, 246, 1, 125000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(89, 247, 1, 125000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(90, 248, 1, 149000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(91, 249, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(92, 250, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(93, 251, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(94, 252, 1, 159000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(95, 253, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(96, 254, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(97, 255, 1, 169000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(98, 256, 1, 179000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(99, 257, 1, 189000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(100, 258, 1, 199000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(101, 259, 1, 17000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(102, 260, 1, 17000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(103, 261, 1, 22000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(104, 262, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(105, 263, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(106, 264, 1, 29000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(107, 265, 1, 29000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(108, 266, 1, 15000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(109, 267, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(110, 268, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(111, 269, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(112, 270, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(113, 271, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(114, 272, 1, 18000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(115, 273, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(116, 274, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(117, 275, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(118, 276, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(119, 277, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(120, 278, 1, 35000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(121, 279, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(122, 280, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(123, 281, 1, 50000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(124, 282, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(125, 283, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(126, 284, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(127, 285, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(128, 286, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(129, 287, 1, 35000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(130, 288, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(131, 289, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(132, 290, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(133, 291, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(134, 292, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(135, 293, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(136, 294, 1, 30000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(137, 295, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(138, 296, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(139, 297, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(140, 298, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(141, 299, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(142, 300, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(143, 301, 1, 75000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(144, 302, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(145, 303, 1, 75000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(146, 304, 1, 75000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(147, 305, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(148, 306, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(149, 307, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(150, 308, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(151, 309, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(152, 310, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(153, 311, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(154, 312, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(155, 313, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(156, 314, 1, 50000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(157, 315, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(158, 316, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(159, 317, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(160, 318, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(161, 319, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(162, 320, 1, 25000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(163, 321, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(164, 322, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(165, 323, 1, 50000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(166, 324, 1, 50000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(167, 325, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(168, 326, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(169, 327, 1, 50000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(170, 328, 1, 20000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(171, 329, 1, 40000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(172, 330, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(173, 331, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(174, 332, 1, 45000, 0, '2018-03-31 12:37:13', '2018-03-31 12:37:13'),
(175, 333, 1, 40000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(176, 334, 1, 40000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(177, 335, 1, 40000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(178, 336, 1, 20000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(179, 337, 1, 20000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(180, 338, 1, 20000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(181, 339, 1, 40000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(182, 340, 1, 50000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(183, 341, 1, 45000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(184, 342, 1, 70000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(185, 343, 1, 85000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(186, 344, 1, 85000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(187, 345, 1, 70000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(188, 346, 1, 75000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(189, 347, 1, 70000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(190, 348, 1, 75000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(191, 349, 1, 70000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(192, 350, 1, 75000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(193, 351, 1, 85000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(194, 352, 1, 145000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(195, 353, 1, 145000, 0, '2018-03-31 12:37:14', '2018-03-31 12:37:14'),
(196, 354, 1, 55000, 0, '2018-04-01 06:08:39', '2018-04-01 06:08:39'),
(197, 355, 1, 55000, 0, '2018-04-01 06:09:21', '2018-04-01 06:09:21'),
(198, 356, 1, 55000, 0, '2018-04-01 06:10:31', '2018-04-01 06:10:31'),
(199, 357, 1, 49000, 0, '2018-04-01 06:11:41', '2018-04-01 06:11:41'),
(200, 358, 1, 65000, 0, '2018-04-01 06:12:56', '2018-04-01 06:12:56'),
(201, 359, 1, 69000, 0, '2018-04-01 09:46:16', '2018-04-01 09:46:16'),
(202, 360, 1, 40000, 0, '2018-04-01 10:16:06', '2018-04-01 10:16:06'),
(203, 361, 1, 40000, 0, '2018-04-01 10:16:30', '2018-04-01 10:16:30'),
(204, 326, 2, 35000, 0, '2018-04-01 11:30:22', '2018-04-01 11:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_contract_id_foreign` (`contract_id`),
  ADD KEY `order_detail_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_detail_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;
--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`),
  ADD CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
