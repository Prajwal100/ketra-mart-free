-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ketra-ecommerce
CREATE DATABASE IF NOT EXISTS `ketra-ecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ketra-ecommerce`;

-- Dumping structure for table ketra-ecommerce.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.admins: ~0 rows (approximately)
INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Mr. Admin', 'admin@gmail.com', NULL, '$2y$10$qzyBq54bJZ1K.k/eaUhPhOJl7yVxduYZkgENV2TQYY770VoN9C/K2', 'active', 1, NULL, NULL, NULL);

-- Dumping structure for table ketra-ecommerce.attributes
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_color` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.attributes: ~2 rows (approximately)
INSERT INTO `attributes` (`id`, `name`, `has_color`, `created_at`, `updated_at`) VALUES
	(1, 'Color', 1, NULL, NULL),
	(2, 'Size', 0, NULL, NULL);

-- Dumping structure for table ketra-ecommerce.attribute_values
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.attribute_values: ~6 rows (approximately)
INSERT INTO `attribute_values` (`id`, `name`, `color_code`, `attribute_id`, `created_at`, `updated_at`) VALUES
	(1, 'L', '', 2, NULL, NULL),
	(2, 'S', '', 2, NULL, NULL),
	(3, 'M', '', 2, NULL, NULL),
	(4, 'XL', '', 2, NULL, NULL),
	(5, 'White', '#FFFFFF', 1, NULL, NULL),
	(6, 'Black', '#000000', 1, NULL, NULL);

-- Dumping structure for table ketra-ecommerce.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_type` enum('home','popup','promo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.banners: ~3 rows (approximately)
INSERT INTO `banners` (`id`, `content`, `url`, `banner_type`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, NULL, NULL, 'home', 'frontend/assets/images/banners/01.png', 'active', '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(2, NULL, NULL, 'home', 'frontend/assets/images/banners/02.jpg', 'active', '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(3, NULL, NULL, 'promo', 'frontend/assets/images/banners/promo-banner1.jpg', 'active', '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(4, NULL, NULL, 'promo', 'frontend/assets/images/banners/promo-banner2.jpg', 'active', '2023-01-24 11:51:08', '2023-01-24 11:51:08');

-- Dumping structure for table ketra-ecommerce.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int DEFAULT '0',
  `position` int DEFAULT '0',
  `parent_id` int DEFAULT '0',
  `is_menu` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.categories: ~11 rows (approximately)
INSERT INTO `categories` (`id`, `title`, `slug`, `banner`, `icon`, `level`, `position`, `parent_id`, `is_menu`, `featured`, `status`, `meta_title`, `meta_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Wedding Dress', 'wedding-dress', NULL, 'frontend/assets/images/icons/wedding-dress.svg', 0, 1, 0, 1, 1, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(2, 'Bridesmaid Dresses', 'bridesmaid-dresses', NULL, 'frontend/assets/images/icons/bridesmaid.svg', 0, 2, 0, 1, 1, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(3, 'Wedding Party', 'wedding-party', NULL, 'frontend/assets/images/icons/wedding.svg', 0, 3, 0, 1, 1, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(4, 'Prom Dresses', 'prom-dresses', NULL, 'frontend/assets/images/icons/prom-night.svg', 0, 4, 0, 1, 1, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(5, 'Special Occasions', 'special-occasions', NULL, 'frontend/assets/images/icons/special.svg', 0, 5, 0, 1, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(6, 'Accessories', 'accessories', NULL, 'frontend/assets/images/icons/accessories.svg', 0, 6, 0, 1, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(7, 'Wedding Guest Dresses', 'wedding-guest-dresses', NULL, NULL, 1, NULL, 3, 0, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(8, 'Flower Girls Dresses', 'flower-girls-dresses', NULL, NULL, 1, 0, 3, 0, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(9, 'Men Accessories', 'men-accessories', NULL, NULL, 1, 0, 6, 0, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(10, 'Headpieces', 'headpieces', NULL, NULL, 1, 0, 2, 0, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(11, 'Luxury Collection', 'luxury-collection', NULL, NULL, 1, 0, 2, 0, 0, 'active', NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08');

-- Dumping structure for table ketra-ecommerce.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.contact_messages: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.coupons: ~1 rows (approximately)
INSERT INTO `coupons` (`id`, `title`, `code`, `start_date`, `expire_date`, `type`, `status`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'New Year Offer', 'ABC1234', '2023-01-27', '2023-01-31', 'fixed', 'active', 100.00, '2023-01-27 21:14:23', '2023-01-27 21:15:09');

-- Dumping structure for table ketra-ecommerce.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double(8,2) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.currencies: ~4 rows (approximately)
INSERT INTO `currencies` (`id`, `name`, `symbol`, `exchange_rate`, `code`, `flag`, `flag_path`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'US dollar', '$', 1.00, 'USD', 'frontend/assets/img/us-flag.jpg', 'frontend/assets/img/us-flag.jpg', 'active', NULL, NULL),
	(2, 'Spain Euro', '€', 0.82, 'SPA', 'frontend/assets/img/spain-flag.jpg', 'frontend/assets/img/spain-flag.jpg', 'active', NULL, NULL),
	(3, 'Russian Ruble', '₽', 72.86, 'RUS', 'frontend/assets/img/russia-flag.jpg', 'frontend/assets/img/russia-flag.jpg', 'active', NULL, NULL),
	(4, 'France Euro', '€', 0.82, 'FRA', 'frontend/assets/img/france-flag.jpg', 'frontend/assets/img/france-flag.jpg', 'active', NULL, NULL);

-- Dumping structure for table ketra-ecommerce.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.f_a_q_s
CREATE TABLE IF NOT EXISTS `f_a_q_s` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.f_a_q_s: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.media: ~2 rows (approximately)
INSERT INTO `media` (`id`, `title`, `file_name`, `admin_id`, `created_at`, `updated_at`) VALUES
	(4, 'Screenshot_204.png', '1-1674756662.png', 1, '2023-01-26 12:26:03', '2023-01-26 12:26:03'),
	(5, '230605979_392284018898238_8601129681866098523_n.jpg', '1-1674756766.jpg', 1, '2023-01-26 12:27:47', '2023-01-26 12:27:47'),
	(6, 'IMG_20221015_085954.jpg', '1-1674756789.jpg', 1, '2023-01-26 12:28:11', '2023-01-26 12:28:11');

-- Dumping structure for table ketra-ecommerce.media_files
CREATE TABLE IF NOT EXISTS `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_user` int DEFAULT NULL,
  `update_user` int DEFAULT NULL,
  `app_id` int DEFAULT NULL,
  `app_user_id` int DEFAULT NULL,
  `file_width` int DEFAULT NULL,
  `file_height` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.media_files: ~19 rows (approximately)
INSERT INTO `media_files` (`id`, `file_name`, `file_path`, `file_size`, `file_type`, `file_extension`, `create_user`, `update_user`, `app_id`, `app_user_id`, `file_width`, `file_height`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'avatar', 'demo/general/avatar.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'avatar-2', 'demo/general/avatar-2.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'avatar-3', 'demo/general/avatar-3.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'ico_adventurous', 'demo/general/ico_adventurous.png', NULL, 'image/png', 'png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'ico_localguide', 'demo/general/ico_localguide.png', NULL, 'image/png', 'png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'ico_maps', 'demo/general/ico_maps.png', NULL, 'image/png', 'png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'ico_paymethod', 'demo/general/ico_paymethod.png', NULL, 'image/png', 'png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'logo', 'demo/general/logo.svg', NULL, 'image/svg+xml', 'svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'bg_contact', 'demo/general/bg-contact.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'favicon', 'demo/general/favicon.png', NULL, 'image/png', 'png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'thumb-vendor-register', 'demo/general/thumb-vendor-register.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'bg-video-vendor-register1', 'demo/general/bg-video-vendor-register1.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'ico_chat_1', 'demo/general/ico_chat_1.svg', NULL, 'image/svg', 'svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'ico_friendship_1', 'demo/general/ico_friendship_1.svg', NULL, 'image/svg', 'svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'ico_piggy-bank_1', 'demo/general/ico_piggy-bank_1.svg', NULL, 'image/svg', 'svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 'home-mix', 'demo/general/home-mix.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 'image_home_mix_1', 'demo/general/image_home_mix_1.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 'image_home_mix_2', 'demo/general/image_home_mix_2.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 'image_home_mix_3', 'demo/general/image_home_mix_3.jpg', NULL, 'image/jpeg', 'jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table ketra-ecommerce.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2021_01_01_000001_create_admins_table', 1),
	(5, '2021_01_12_074306_create_banners_table', 1),
	(6, '2021_01_15_162252_create_categories_table', 1),
	(7, '2021_01_17_050422_create_products_table', 1),
	(8, '2021_01_30_045614_create_coupons_table', 1),
	(9, '2021_01_31_104325_create_orders_table', 1),
	(10, '2021_02_04_035507_create_shippings_table', 1),
	(11, '2021_02_10_161501_create_product_attributes_table', 1),
	(12, '2021_02_11_115831_create_product_reviews_table', 1),
	(13, '2021_02_23_084922_create_product_orders_table', 1),
	(14, '2021_02_25_091025_create_settings_table', 1),
	(15, '2021_04_12_155631_create_currencies_table', 1),
	(16, '2021_04_25_121025_create_subscribes_table', 1),
	(17, '2021_05_13_135936_create_media_table', 1),
	(18, '2021_05_18_175912_create_wishlists_table', 1),
	(19, '2021_05_24_095153_create_attributes_table', 1),
	(20, '2021_06_05_181249_create_f_a_q_s_table', 1),
	(21, '2021_06_06_025550_create_why_chooses_table', 1),
	(22, '2021_06_06_132026_create_contact_messages_table', 1),
	(23, '2021_06_13_034706_create_shipping_addresses_table', 1),
	(24, '2021_06_13_035342_create_order_details_table', 1),
	(25, '2021_10_25_151521_create_roles_table', 1),
	(26, '2021_10_25_151715_create_staff_table', 1),
	(27, '2021_12_03_040115_create_attribute_values_table', 1),
	(28, '2021_12_04_113908_create_product_variations_table', 1),
	(29, '2021_12_04_114002_create_product_variation_combinations_table', 1),
	(30, '2021_12_04_114428_create_product_attribute_values_table', 1),
	(31, '2022_02_01_142250_create_product_stocks_table', 1),
	(32, '2022_02_02_175447_create_media_files_table', 1);

-- Dumping structure for table ketra-ecommerce.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `subtotal` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `payment_status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `order_status` enum('pending','process','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_details` longtext COLLATE utf8mb4_unicode_ci,
  `delivery_charge` double(8,2) DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '0',
  `coupon` double(8,2) DEFAULT '0.00',
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scountry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spostcode` int DEFAULT NULL,
  `sstate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saddress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `subtotal`, `payment_method`, `payment_status`, `order_status`, `payment_details`, `delivery_charge`, `quantity`, `coupon`, `first_name`, `last_name`, `email`, `phone`, `country`, `postcode`, `state`, `address`, `address2`, `scountry`, `spostcode`, `sstate`, `saddress`, `saddress2`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'KETRA-1000', 3000.00, 3000.00, 'cod', 'unpaid', 'pending', NULL, 100.00, 2, 100.00, 'Prajwal', 'Rai', 'prajwal.iar@gmail.com', '+9773568684364', 'Nepal', 31091, 'Koshi', 'Kadaghari', 'Kadaghari', 'Nepal', 31091, 'Koshi', 'Kadaghari', NULL, 'Can u delivery within this week.', NULL, '2023-01-27 21:39:39', '2023-01-27 21:39:39');

-- Dumping structure for table ketra-ecommerce.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_details` longtext COLLATE utf8mb4_unicode_ci,
  `quantity` int DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `variation` longtext COLLATE utf8mb4_unicode_ci,
  `variant` longtext COLLATE utf8mb4_unicode_ci,
  `shipping_method_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.order_details: ~2 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_details`, `quantity`, `price`, `discount`, `variation`, `variant`, `shipping_method_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, '{"id":4,"title":"Prajwal product","slug":"prajwal-product","summary":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><br><\\/p>","description":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br><\\/p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span>","features":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br><\\/p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span>","current_stock":0,"product_label":"hot","cat_ids":1,"unit":"pc","min_qty":10,"refundable":1,"thumbnail_image":"storage\\/images\\/products\\/1-1674756662.png","images":"[\\"storage\\\\\\/images\\\\\\/products\\\\\\/1-1674756766.jpg\\",\\"storage\\\\\\/images\\\\\\/products\\\\\\/1-1674756789.jpg\\",null,null,null,null]","is_featured":1,"unit_price":"1200.00","purchase_price":"1000.00","discount":"200.00","discount_type":"amount","colors":"[\\"#FFFFFF\\",\\"#000000\\"]","variant_products":0,"attributes":"[\\"2\\"]","choice_options":"[{\\"attribute_id\\":\\"2\\",\\"values\\":[\\"L\\",\\"S\\"]}]","variation":"[]","processing_time":null,"shipping_time":null,"user_id":1,"added_by":"admin","status":"active","meta_title":"Prajwal product","meta_keywords":null,"meta_description":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><br><\\/p>","deleted_at":null,"created_at":"2023-01-26T18:13:41.000000Z","updated_at":"2023-01-26T18:13:41.000000Z"}', 4, 2400.00, 800.00, 'White-S', NULL, 1, NULL, '2023-01-27 21:39:39', '2023-01-27 21:39:39'),
	(2, 1, 5, '{"id":5,"title":"Prajwal product","slug":"prajwal-product-uprrV","summary":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><br><\\/p>","description":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br><\\/p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span>","features":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br><\\/p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span>","current_stock":0,"product_label":"hot","cat_ids":1,"unit":"pc","min_qty":10,"refundable":1,"thumbnail_image":"storage\\/images\\/products\\/1-1674756662.png","images":"[\\"storage\\\\\\/images\\\\\\/products\\\\\\/1-1674756766.jpg\\",\\"storage\\\\\\/images\\\\\\/products\\\\\\/1-1674756789.jpg\\",null,null,null,null]","is_featured":1,"unit_price":"1200.00","purchase_price":"1000.00","discount":"200.00","discount_type":"amount","colors":"[\\"#FFFFFF\\",\\"#000000\\"]","variant_products":1,"attributes":"[\\"2\\"]","choice_options":"[{\\"attribute_id\\":\\"2\\",\\"values\\":[\\"L\\",\\"S\\"]}]","variation":"[]","processing_time":null,"shipping_time":null,"user_id":1,"added_by":"admin","status":"active","meta_title":"Prajwal product","meta_keywords":null,"meta_description":"<p><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">Hi,<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">:<\\/span><br style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\"><span style=\\"color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;\\">there is around approx. 10-12 Ready functionals Forms where you need to add\\/remove some text fields and need some functionally changes\\/add-on etc.<\\/span><br><\\/p>","deleted_at":null,"created_at":"2023-01-26T18:24:07.000000Z","updated_at":"2023-01-26T18:24:07.000000Z"}', 2, 600.00, 400.00, 'Black-S', NULL, 1, NULL, '2023-01-27 21:39:39', '2023-01-27 21:39:39');

-- Dumping structure for table ketra-ecommerce.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.password_resets: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `features` longtext COLLATE utf8mb4_unicode_ci,
  `current_stock` int NOT NULL DEFAULT '0',
  `product_label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_ids` bigint unsigned NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_qty` int NOT NULL DEFAULT '1',
  `refundable` tinyint NOT NULL DEFAULT '1',
  `thumbnail_image` text COLLATE utf8mb4_unicode_ci,
  `images` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) DEFAULT '0',
  `unit_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `purchase_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(8,2) DEFAULT '0.00',
  `discount_type` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` text COLLATE utf8mb4_unicode_ci,
  `variant_products` tinyint(1) NOT NULL DEFAULT '0',
  `attributes` text COLLATE utf8mb4_unicode_ci,
  `choice_options` text COLLATE utf8mb4_unicode_ci,
  `variation` text COLLATE utf8mb4_unicode_ci,
  `processing_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '1',
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `features`, `current_stock`, `product_label`, `cat_ids`, `unit`, `min_qty`, `refundable`, `thumbnail_image`, `images`, `is_featured`, `unit_price`, `purchase_price`, `discount`, `discount_type`, `colors`, `variant_products`, `attributes`, `choice_options`, `variation`, `processing_time`, `shipping_time`, `user_id`, `added_by`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Canon EOS185', 'canon-eos185', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>', NULL, 100, 'new', 2, 'pc', 5, 0, 'frontend/assets/images/products/1.jpg', NULL, 1, 324.36, 324.36, 0.00, 'amount', '[]', 0, 'null', '[]', NULL, NULL, NULL, 1, 'admin', 'active', NULL, NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(2, 'Test Product', 'test-product', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>', NULL, 100, 'new', 1, 'pc', 5, 0, 'frontend/assets/images/products/2.jpg', NULL, 1, 100.00, 90.00, 10.00, 'amount', '[]', 0, 'null', '[]', NULL, NULL, NULL, 1, 'admin', 'active', NULL, NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(3, 'Test Product 2', 'test-product-2', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>', '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>', NULL, 100, 'new', 2, 'pc', 5, 0, 'frontend/assets/images/products/3.jpg', NULL, 1, 1000.00, 500.00, 50.00, 'percent', '[]', 0, 'null', '[]', NULL, NULL, NULL, 1, 'admin', 'active', NULL, NULL, NULL, NULL, '2023-01-24 11:51:08', '2023-01-24 11:51:08'),
	(4, 'Prajwal product', 'prajwal-product', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><br></p>', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br></p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span>', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br></p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span>', 0, 'hot', 1, 'pc', 10, 1, 'storage/images/products/1-1674756662.png', '["storage\\/images\\/products\\/1-1674756766.jpg","storage\\/images\\/products\\/1-1674756789.jpg",null,null,null,null]', 1, 1200.00, 1000.00, 200.00, 'amount', '["#FFFFFF","#000000"]', 0, '["2"]', '[{"attribute_id":"2","values":["L","S"]}]', '[]', NULL, NULL, 1, 'admin', 'active', 'Prajwal product', NULL, '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><br></p>', NULL, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(5, 'Prajwal product', 'prajwal-product-uprrV', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><br></p>', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br></p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span>', '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br></p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span>', 0, 'hot', 1, 'pc', 10, 1, 'storage/images/products/1-1674756662.png', '["storage\\/images\\/products\\/1-1674756766.jpg","storage\\/images\\/products\\/1-1674756789.jpg",null,null,null,null]', 1, 1200.00, 1000.00, 200.00, 'amount', '["#FFFFFF","#000000"]', 1, '["2"]', '[{"attribute_id":"2","values":["L","S"]}]', '[]', NULL, NULL, 1, 'admin', 'active', 'Prajwal product', NULL, '<p><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">Hi,</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">I am looking for experienced laravel php web developer for some simple customisation on readymade POS system</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">:</span><br style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;"><span style="color: rgb(0, 30, 0); font-family: &quot;Neue Montreal&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; letter-spacing: 0.6px;">there is around approx. 10-12 Ready functionals Forms where you need to add/remove some text fields and need some functionally changes/add-on etc.</span><br></p>', NULL, '2023-01-26 12:39:07', '2023-01-26 12:39:07');

-- Dumping structure for table ketra-ecommerce.product_attributes
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `attribute_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_attributes: ~4 rows (approximately)
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(2, 4, 2, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(3, 5, 1, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(4, 5, 2, '2023-01-26 12:39:07', '2023-01-26 12:39:07');

-- Dumping structure for table ketra-ecommerce.product_attribute_values
CREATE TABLE IF NOT EXISTS `product_attribute_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `attribute_value_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_attribute_values: ~8 rows (approximately)
INSERT INTO `product_attribute_values` (`id`, `product_id`, `attribute_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 5, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(2, 4, 1, 6, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(3, 4, 2, 1, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(4, 4, 2, 2, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(5, 5, 1, 5, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(6, 5, 1, 6, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(7, 5, 2, 1, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(8, 5, 2, 2, '2023-01-26 12:39:07', '2023-01-26 12:39:07');

-- Dumping structure for table ketra-ecommerce.product_orders
CREATE TABLE IF NOT EXISTS `product_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_orders_product_id_foreign` (`product_id`),
  KEY `product_orders_order_id_foreign` (`order_id`),
  CONSTRAINT `product_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_orders: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.product_reviews
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `rate` double(8,2) NOT NULL DEFAULT '0.00',
  `review` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_reviews: ~0 rows (approximately)
INSERT INTO `product_reviews` (`id`, `name`, `product_id`, `rate`, `review`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Prajwal R.', 1, 2.50, 'Hello Just testing', 'active', '2023-01-25 08:47:42', '2023-01-25 08:47:42');

-- Dumping structure for table ketra-ecommerce.product_stocks
CREATE TABLE IF NOT EXISTS `product_stocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `variant` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(20,2) NOT NULL DEFAULT '0.00',
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_stocks: ~8 rows (approximately)
INSERT INTO `product_stocks` (`id`, `product_id`, `variant`, `price`, `qty`, `created_at`, `updated_at`) VALUES
	(1, 4, 'White-L', 800.00, 111, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(2, 4, 'White-S', 600.00, 111, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(3, 4, 'Black-L', 400.00, 111, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(4, 4, 'Black-S', 300.00, 111, '2023-01-26 12:28:41', '2023-01-26 12:28:41'),
	(5, 5, 'White-L', 800.00, 111, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(6, 5, 'White-S', 600.00, 111, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(7, 5, 'Black-L', 400.00, 111, '2023-01-26 12:39:07', '2023-01-26 12:39:07'),
	(8, 5, 'Black-S', 300.00, 111, '2023-01-26 12:39:07', '2023-01-26 12:39:07');

-- Dumping structure for table ketra-ecommerce.product_variations
CREATE TABLE IF NOT EXISTS `product_variations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_variations: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.product_variation_combinations
CREATE TABLE IF NOT EXISTS `product_variation_combinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `product_variation_id` bigint unsigned NOT NULL,
  `attribute_id` bigint unsigned NOT NULL,
  `attribute_value_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.product_variation_combinations: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.roles: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `system_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1.0',
  `website_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha` tinyint(1) NOT NULL DEFAULT '0',
  `recaptcha_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitors` int NOT NULL DEFAULT '0',
  `copyright_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '© Copyrights 2023. All rights reserved.',
  `about_us` longtext COLLATE utf8mb4_unicode_ci,
  `return_policy` longtext COLLATE utf8mb4_unicode_ci,
  `shipping_payment` longtext COLLATE utf8mb4_unicode_ci,
  `privacy_policy` longtext COLLATE utf8mb4_unicode_ci,
  `terms_conditions` longtext COLLATE utf8mb4_unicode_ci,
  `cancellation_policy` longtext COLLATE utf8mb4_unicode_ci,
  `paypal_sandbox` tinyint(1) NOT NULL DEFAULT '1',
  `delivery_time` int NOT NULL DEFAULT '20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `site_title`, `meta_description`, `meta_keywords`, `logo`, `favicon`, `phone`, `office_time`, `email`, `address`, `currency`, `system_version`, `website_url`, `facebook_url`, `instagram_url`, `twitter_url`, `youtube_url`, `recaptcha`, `recaptcha_key`, `recaptcha_secret`, `visitors`, `copyright_text`, `about_us`, `return_policy`, `shipping_payment`, `privacy_policy`, `terms_conditions`, `cancellation_policy`, `paypal_sandbox`, `delivery_time`, `created_at`, `updated_at`) VALUES
	(1, 'KETRA MART Shopping Site', 'KETRA MART online Shopping ', 'Shopping, Fashion dress, ecommerce', 'backend/assets/images/logo.png', '', '9818441226', ' 9 AM - 6 PM (PDT) . MON-FRI', 'info@ketramart.com', 'Kadaghari, Nepal', '$', '1.0', NULL, 'https://facebook.com/', 'https://instagram.com/', 'https://twitter.com/', 'https://youtube.com/', 0, NULL, NULL, 5, '© Copyrights 2023. All rights reserved.', '{"description1":"Testing","description2":"Hello","image1":"1674697447-Category01.png","image1_path":"storage\\/frontend\\/images\\/settings\\/1674697447-Category01.png","image2":"1674697447-Category02.png","image2_path":"storage\\/frontend\\/images\\/settings\\/1674697447-Category02.png"}', NULL, NULL, NULL, 'Terms and condition', 'Cancellation page.', 0, 20, NULL, '2023-01-27 21:12:15');

-- Dumping structure for table ketra-ecommerce.shippings
CREATE TABLE IF NOT EXISTS `shippings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` double(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.shippings: ~2 rows (approximately)
INSERT INTO `shippings` (`id`, `shipping_address`, `delivery_time`, `delivery_charge`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'China', '4-5 days', 100.00, 'active', NULL, NULL),
	(2, 'Nepal', '8-9 days', 300.00, 'active', NULL, NULL);

-- Dumping structure for table ketra-ecommerce.shipping_addresses
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scountry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spostcode` int DEFAULT NULL,
  `sstate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saddress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `shipping_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.shipping_addresses: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.staff: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.subscribes
CREATE TABLE IF NOT EXISTS `subscribes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribes_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.subscribes: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `image_path`, `phone`, `status`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Mr. Customer', 'Customer', 'customer@gmail.com', NULL, '$2y$10$44yt.jK.hlMiruipMfqyBunuimcpokCqD1PHJ6wKk4ZDIoUm2rqE6', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table ketra-ecommerce.why_chooses
CREATE TABLE IF NOT EXISTS `why_chooses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.why_chooses: ~0 rows (approximately)

-- Dumping structure for table ketra-ecommerce.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_user_id_foreign` (`user_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ketra-ecommerce.wishlists: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
