-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2026 at 08:31 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Smartphones', NULL, 'smartphones', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(2, 'Laptops', NULL, 'laptops', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(3, 'Tablets', NULL, 'tablets', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(4, 'Smart Watches', NULL, 'smart-watches', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(5, 'Headphones', NULL, 'headphones', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(6, 'Bluetooth Speakers', NULL, 'bluetooth-speakers', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(7, 'Gaming Consoles', NULL, 'gaming-consoles', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(8, 'Televisions', NULL, 'televisions', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(9, 'Cameras', NULL, 'cameras', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(10, 'Monitors', NULL, 'monitors', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(11, 'Routers', NULL, 'routers', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(12, 'Power Banks', NULL, 'power-banks', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(13, 'External Hard Drives', NULL, 'external-hard-drives', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(14, 'Graphic Cards', NULL, 'graphic-cards', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25'),
(15, 'Smart Home Devices', NULL, 'smart-home-devices', 1, '2026-03-02 13:36:25', '2026-03-02 13:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '0001_01_01_000000_create_users_table', 1),
(14, '0001_01_01_000001_create_cache_table', 1),
(15, '0001_01_01_000002_create_jobs_table', 1),
(16, '2025_12_31_162844_create_personal_access_tokens_table', 1),
(17, '2025_12_31_190914_add_role_to_users_table', 1),
(18, '2026_01_01_185506_create_categories_table', 1),
(19, '2026_01_01_192647_create_products_table', 1),
(20, '2026_01_01_192724_create_orders_table', 1),
(21, '2026_01_01_192743_create_order_items_table', 1),
(22, '2026_01_01_192808_create_payments_table', 1),
(23, '2026_01_01_192841_create_shipments_table', 1),
(24, '2026_02_02_154647_create_product_images_table', 1),
(25, '2026_03_05_123635_add_profile_photo_to_users_table', 2),
(26, '2026_03_05_124333_create_support_tickets_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_address`, `billing_address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 13898.00, '123 Main Street, New York, NY 10001', '123 Main Street, New York, NY 10001', 'delivered', '2026-03-02 07:25:20', '2026-03-02 07:38:34'),
(2, 3, 533.14, 'Rohit Mishra\n1050 West Romeo Road\nRomeoville, 60446', '1050 West Romeo Road', 'pending', '2026-03-02 10:42:19', '2026-03-02 10:42:19'),
(3, 2, 29.00, 'Admin\n1050 West Romeo Road\nRomeoville, 60446', '1050 West Romeo Road', 'pending', '2026-03-02 14:17:57', '2026-03-02 14:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 5216.99, '2026-03-02 07:25:20', '2026-03-02 07:25:20'),
(2, 1, 3, 1, 3464.02, '2026-03-02 07:25:20', '2026-03-02 07:25:20'),
(3, 2, 5, 2, 266.57, '2026-03-02 10:42:19', '2026-03-02 10:42:19'),
(4, 3, 30, 1, 29.00, '2026-03-02 14:17:57', '2026-03-02 14:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_index` (`order_id`),
  KEY `payments_status_index` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `method`, `amount`, `status`, `transaction_id`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'upi', 13898.00, 'paid', 'txn_69a53bdfc7f62', '2026-03-02 07:27:27', '2026-03-02 07:27:27', '2026-03-02 07:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_product_name_index` (`product_name`),
  KEY `products_sku_index` (`sku`),
  KEY `products_category_id_index` (`category_id`),
  KEY `products_is_active_index` (`is_active`),
  KEY `products_created_at_index` (`created_at`),
  KEY `products_price_index` (`price`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `price`, `stock`, `category_id`, `sku`, `weight`, `dimension`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 15 Pro', 'Latest Apple flagship smartphone', 1299.00, 50, 1, 'SKU-001', 0.45, '146x70x8 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(2, 'Samsung Galaxy S24', 'Premium Android smartphone', 1199.00, 60, 1, 'SKU-002', 0.48, '147x71x8 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(3, 'MacBook Air M3', 'Lightweight Apple laptop', 1499.00, 40, 2, 'SKU-003', 1.24, '304x212x15 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(4, 'Dell XPS 15', 'High performance Windows laptop', 1699.00, 35, 2, 'SKU-004', 1.80, '344x230x18 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(5, 'iPad Pro', 'Professional tablet device', 1099.00, 45, 3, 'SKU-005', 0.60, '280x214x6 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(6, 'Galaxy Tab S9', 'Android premium tablet', 899.00, 30, 3, 'SKU-006', 0.62, '285x216x6 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(7, 'Apple Watch 9', 'Advanced smartwatch', 499.00, 70, 4, 'SKU-007', 0.05, '45x38x10 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(8, 'Galaxy Watch 6', 'Stylish smartwatch', 399.00, 65, 4, 'SKU-008', 0.06, '44x40x9 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(9, 'Sony WH-1000XM5', 'Noise cancelling headphones', 349.00, 80, 5, 'SKU-009', 0.25, '200x180x80 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(10, 'AirPods Pro 2', 'Wireless earbuds', 249.00, 90, 5, 'SKU-010', 0.05, '60x45x21 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(11, 'JBL Charge 5', 'Portable speaker', 199.00, 75, 6, 'SKU-011', 0.96, '223x94x97 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(12, 'PlayStation 5', 'Next-gen gaming console', 599.00, 25, 7, 'SKU-012', 4.50, '390x104x260 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(13, 'Xbox Series X', '4K gaming console', 599.00, 20, 7, 'SKU-013', 4.45, '301x151x151 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(14, 'Samsung 55 QLED', '4K Smart TV', 999.00, 15, 8, 'SKU-014', 15.00, '1230x710x60 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(15, 'LG 65 OLED', 'Premium OLED TV', 1799.00, 10, 8, 'SKU-015', 20.00, '1440x830x50 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(16, 'Canon EOS R6', 'Mirrorless camera', 2499.00, 12, 9, 'SKU-016', 0.68, '138x98x88 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(17, 'Sony A7 IV', 'Full-frame camera', 2699.00, 10, 9, 'SKU-017', 0.65, '131x96x80 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(18, 'LG UltraGear 27', 'Gaming monitor', 399.00, 40, 10, 'SKU-018', 5.50, '614x364x56 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(19, 'Dell 32 4K', 'Professional monitor', 699.00, 25, 10, 'SKU-019', 7.80, '713x419x52 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(20, 'TP-Link AX73', 'WiFi 6 router', 199.00, 60, 11, 'SKU-020', 0.90, '260x135x42 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(21, 'Netgear AX12', 'Gaming router', 499.00, 30, 11, 'SKU-021', 1.20, '295x206x56 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(22, 'Anker 20000mAh', 'Power bank', 79.00, 100, 12, 'SKU-022', 0.35, '158x74x19 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(23, 'Mi 10000mAh', 'Compact power bank', 39.00, 120, 12, 'SKU-023', 0.25, '150x70x14 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(24, 'Seagate 2TB', 'External HDD', 129.00, 85, 13, 'SKU-024', 0.41, '115x80x20 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(25, 'WD 4TB Passport', 'Portable HDD', 179.00, 70, 13, 'SKU-025', 0.45, '110x82x21 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(26, 'RTX 4070', 'Gaming GPU', 799.00, 18, 14, 'SKU-026', 1.10, '242x112x40 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(27, 'RX 7800 XT', 'High performance GPU', 749.00, 20, 14, 'SKU-027', 1.15, '267x120x50 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(28, 'Google Nest Hub', 'Smart display', 149.00, 50, 15, 'SKU-028', 0.48, '178x118x67 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(29, 'Amazon Echo Dot 5', 'Smart speaker', 59.00, 95, 15, 'SKU-029', 0.30, '100x100x89 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 13:36:54'),
(30, 'Smart LED Bulb', 'WiFi LED bulb', 29.00, 149, 15, 'SKU-030', 0.15, '60x60x120 mm', 1, NULL, '2026-03-02 13:36:54', '2026-03-02 14:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `is_primary`, `created_at`, `updated_at`) VALUES
(83, 1, 'products/2pz39l34DQzd83gVUnaYvSVFfqrEeR0p9b0Whe9s.jpg', 0, '2026-03-05 07:45:56', '2026-03-05 07:45:56'),
(84, 1, 'products/MJjZoMlIYckd7FLgbNZabx03p1TGvmFZuL106oN7.jpg', 0, '2026-03-05 07:45:56', '2026-03-05 07:45:56'),
(89, 2, 'products/ueeEhMlc0j86rk5145dgV4sXXsHl7iuL8HRhEnBi.jpg', 0, '2026-03-08 04:26:35', '2026-03-08 04:26:35'),
(88, 2, 'products/D42rdq4fRxr3pamoVUGjlZ3FQrnTqWdqNZKW7WdY.jpg', 0, '2026-03-08 04:26:35', '2026-03-08 04:26:35'),
(90, 3, 'products/Z3JSX5YYLXXnUSv1O4R03WX83FR6Zra1yzL1XLnq.jpg', 0, '2026-03-08 04:27:44', '2026-03-08 04:27:44'),
(91, 3, 'products/9ptYXLk2v6fAzFBQAlu7W8HYkdNzhE4XtE8fe82c.jpg', 0, '2026-03-08 04:27:44', '2026-03-08 04:27:44'),
(93, 4, 'products/SyILeYG8TMuFzg68BIW81IoFK9yD5wlGOFdEFxZ1.jpg', 0, '2026-03-08 04:29:05', '2026-03-08 04:29:05'),
(92, 4, 'products/MWX10cN6R0Dt2EzfKBVdWgeod9Pt6xJ67x2T9sEq.jpg', 0, '2026-03-08 04:29:05', '2026-03-08 04:29:05'),
(94, 5, 'products/vysX2LyfV6VUVKUClK5rGR2Cy82fuwdpEyAmsogJ.jpg', 0, '2026-03-08 04:33:02', '2026-03-08 04:33:02'),
(96, 6, 'products/51ZIoQMnBDqUJEypalI5e9bhyMJElqziGSFXemcw.jpg', 0, '2026-03-08 04:36:09', '2026-03-08 04:36:09'),
(95, 6, 'products/b5maCz7XdqUW0ERGmlKkXKJGuP5PIjr9S5lottOW.jpg', 0, '2026-03-08 04:36:09', '2026-03-08 04:36:09'),
(97, 7, 'products/YX7BlfOdZJxKux1oxPwT2QI9AMcPpyazr1ccTyky.jpg', 0, '2026-03-08 04:38:02', '2026-03-08 04:38:02'),
(19, 8, 'https://images.unsplash.com/photo-1523275335684-37898b6baf30', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(20, 8, 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(21, 9, 'https://images.unsplash.com/photo-1518444065439-e933c06ce9cd', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(22, 9, 'https://images.unsplash.com/photo-1484704849700-f032a568e944', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(23, 9, 'https://images.unsplash.com/photo-1546435770-a3e426bf472b', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(76, 10, 'products/CX71IbTPyGO6wNB124qZ9tZp8I4a9Z4QTCugTHWE.jpg', 0, '2026-03-02 14:04:45', '2026-03-02 14:04:45'),
(75, 10, 'products/r5uWtdOOQwSOw7mEzqwjIueGE48cGdQhGXcNt27Q.jpg', 0, '2026-03-02 14:04:45', '2026-03-02 14:04:45'),
(26, 11, 'https://images.unsplash.com/photo-1585386959984-a41552231658', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(27, 11, 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(28, 12, 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(29, 12, 'https://images.unsplash.com/photo-1592840062661-1cbbd0d7c7b0', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(30, 12, 'https://images.unsplash.com/photo-1621259182978-fbf93132d53d', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(31, 13, 'https://images.unsplash.com/photo-1605902711622-cfb43c4437d1', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(32, 13, 'https://images.unsplash.com/photo-1621259182978-fbf93132d53d', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(33, 14, 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(34, 14, 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(35, 14, 'https://images.unsplash.com/photo-1571415060716-baff5f717c37', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(36, 15, 'https://images.unsplash.com/photo-1571415060716-baff5f717c37', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(37, 15, 'https://images.unsplash.com/photo-1593784991095-a205069470b6', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(38, 16, 'https://images.unsplash.com/photo-1519183071298-a2962be96f83', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(39, 16, 'https://images.unsplash.com/photo-1502920917128-1aa500764b36', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(40, 16, 'https://images.unsplash.com/photo-1492724441997-5dc865305da7', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(41, 17, 'https://images.unsplash.com/photo-1502920917128-1aa500764b36', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(42, 17, 'https://images.unsplash.com/photo-1510127034890-ba27508e9f1c', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(43, 18, 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(44, 18, 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(45, 18, 'https://images.unsplash.com/photo-1618761714954-0b8cd0026356', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(46, 19, 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(47, 19, 'https://images.unsplash.com/photo-1618761714954-0b8cd0026356', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(48, 20, 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(49, 20, 'https://images.unsplash.com/photo-1555617117-08fda3d1c9d5', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(50, 21, 'https://images.unsplash.com/photo-1629904853716-f0bc54eea481', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(51, 21, 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(52, 22, 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(53, 22, 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(54, 22, 'https://images.unsplash.com/photo-1580910051074-3eb694886505', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(55, 23, 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(56, 23, 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(57, 24, 'https://images.unsplash.com/photo-1580894894513-541e068a3e2b', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(58, 24, 'https://images.unsplash.com/photo-1576179635662-9d1983e97e1b', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(59, 24, 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(60, 25, 'https://images.unsplash.com/photo-1576179635662-9d1983e97e1b', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(61, 25, 'https://images.unsplash.com/photo-1580894894513-541e068a3e2b', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(62, 26, 'https://images.unsplash.com/photo-1591488320449-011701bb6704', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(63, 26, 'https://images.unsplash.com/photo-1612197527590-9f0e22e59f67', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(64, 26, 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(65, 27, 'https://images.unsplash.com/photo-1612197527590-9f0e22e59f67', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(66, 27, 'https://images.unsplash.com/photo-1591488320449-011701bb6704', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(67, 28, 'https://images.unsplash.com/photo-1558002038-1055907df827', 1, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(68, 28, 'https://images.unsplash.com/photo-1580910051074-3eb694886505', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(69, 28, 'https://images.unsplash.com/photo-1558002038-7f0b4f9c94c4', 0, '2026-03-02 13:37:19', '2026-03-02 13:37:19'),
(81, 29, 'products/KOY6Q4tgH121BkwGAf0vIkkTAYyOV35BxhZncMlc.jpg', 0, '2026-03-05 07:32:21', '2026-03-05 07:32:21'),
(80, 29, 'products/nr0MiCbZX33dh10afmqf6qLxBECt79ZUyLfuudDp.png', 0, '2026-03-05 07:32:21', '2026-03-05 07:32:21'),
(104, 30, 'products/BI0a7Vo5gPShkwbNSbOjgsNEnpzgbVkFyi07bJI7.jpg', 0, '2026-03-08 07:18:40', '2026-03-08 07:18:40'),
(82, 29, 'products/cYWhIwl3kMWnS7nGwbZASu8mrcpZa1SCPHLb6POY.jpg', 0, '2026-03-05 07:32:21', '2026-03-05 07:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qaEaeoEReb5dLM4VWmDfqIE1gZDxUygv0fWNGF5S', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiZ3NhSXhYTEFTZ01nQWkyZ3JVd1MwazNZaDF3WXBiTEhia1Z1a3hqbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7czo1OiJyb3V0ZSI7czoxNDoiY2hlY2tvdXQuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiY2FydCI7YToxOntpOjI7YTo0OntzOjQ6Im5hbWUiO3M6MTg6IlNhbXN1bmcgR2FsYXh5IFMyNCI7czo4OiJxdWFudGl0eSI7czoxOiIxIjtzOjU6InByaWNlIjtzOjc6IjExOTkuMDAiO3M6NToiaW1hZ2UiO3M6NTM6InByb2R1Y3RzL3VlZUVoTWxjMGo4NnJrNTE0NWRnVjRzWFhzSGw3aXVMOEhSaEVuQmkuanBnIjt9fX0=', 1779178804);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  KEY `shipments_order_id_index` (`order_id`),
  KEY `shipments_status_index` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `order_id`, `address`, `status`, `carrier`, `tracking_number`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`) VALUES
(1, 1, '123 Main Street, New York, NY 10001', 'delivered', 'FedEx', 'trk_69a53dffa5f85', '2026-03-02 07:36:31', '2026-03-02 07:38:34', '2026-03-02 07:36:31', '2026-03-02 07:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', 'customer', '2026-03-02 13:34:31', '$2y$12$8UIAQhSMZouOMXivHL9.uONPxZoZ6nXRrA1k2zHLOXCSMCb9Zk1nK', NULL, 'DOuspvV6YG', '2026-03-02 13:34:32', '2026-03-02 13:34:32'),
(2, 'Admin', 'admin@oms.com', 'admin', NULL, '$2y$12$7oKGb73g5CxmoHLLV5cFfe3CdBYKkPN0lW6WfFwl87PMikzDlj6AC', NULL, 'EORprq46pY5S5ZNrIefTxdH0nBu4hD4sFj9jLoVLNjXyWj9CpK976JBlTQhj', '2026-03-02 13:34:32', '2026-03-05 07:35:36'),
(3, 'Rohit Mishra', 'rohit.mishra@codeclouds.com', 'customer', NULL, '$2y$12$LtOyG2fkOORpkz9Q9K07T.5PlHaFnZbjxjxvAm3/MbOfQoGl0/agG', NULL, 'TJEzxJs09AbV5NH08R8HzcB4btQn95YiQCIUjycWZi9bJWiAD2xn8KkRKewz', '2026-03-06 09:38:00', '2026-03-06 09:38:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
