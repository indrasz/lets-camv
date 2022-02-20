-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `camvs`;
CREATE TABLE `camvs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderDay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `camvs` (`id`, `name`, `photo`, `orderDay`, `price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Big Van',	'assets/service/thumbnail/K2aXkaZOx80EtY1LK3sPimNDRZYYMHO6rwMsiJju.png',	'7',	2500000,	NULL,	'2022-01-02 06:29:51',	'2022-01-02 06:31:41'),
(2,	'Big Van 2',	'assets/service/thumbnail/rUqnZVV1lksVHUvAoadquxNRM9UTHJeNS9ME8r0c.png',	'5',	3000000,	NULL,	'2022-01-02 06:33:41',	'2022-01-02 06:33:41');

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destinations_id` bigint(20) unsigned DEFAULT NULL,
  `camvs_id` bigint(20) unsigned DEFAULT NULL,
  `users_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_carts_to_destinations` (`destinations_id`),
  KEY `fk_carts_to_camvs` (`camvs_id`),
  KEY `fk_carts_to_users` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carts` (`id`, `destinations_id`, `camvs_id`, `users_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	1,	'2022-01-02 06:38:33',	'2022-01-02 06:38:33'),
(2,	1,	1,	2,	'2022-01-02 10:31:08',	'2022-01-02 10:31:08');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'Mountaint',	'mountaint',	'2022-01-02 06:20:36',	'2022-01-02 06:20:36'),
(2,	'Forest',	'forest',	'2022-01-02 06:21:32',	'2022-01-02 06:21:32'),
(3,	'Beach',	'beach',	'2022-01-02 06:21:53',	'2022-01-02 06:21:53');

DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderDay` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `destinations` (`id`, `categories_id`, `name`, `price`, `description`, `location`, `orderDay`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	2,	'Kapolaga',	10000,	'INI dekskripsi',	'Subang',	5,	'kapolaga',	NULL,	'2022-01-02 06:23:36',	'2022-01-02 06:23:36'),
(2,	1,	'Bromo',	30000,	'Ini Deksripsi',	'Jawa Tengah',	7,	'bromo',	NULL,	'2022-01-02 06:25:17',	'2022-01-02 06:25:17');

DROP TABLE IF EXISTS `destination_galleries`;
CREATE TABLE `destination_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destinations_id` bigint(20) unsigned DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_destination_galleries_to_destination` (`destinations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `destination_galleries` (`id`, `destinations_id`, `photos`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	'assets/service/thumbnail/lhwB2Vcw0slXdlKpFuSCFubZvADiqEFXx7fAEwTF.png',	NULL,	'2022-01-02 06:23:36',	'2022-01-02 06:23:36'),
(2,	1,	'assets/service/thumbnail/Ky5C6MFuRqa8pDcqjSAKMqRJKixoOo5iUJSSREgS.png',	NULL,	'2022-01-02 06:23:36',	'2022-01-02 06:23:36'),
(3,	1,	'assets/service/thumbnail/K1EerPaKGjq5r1ijfHHzNByVVE0pTn7y8fExTx0i.png',	NULL,	'2022-01-02 06:23:36',	'2022-01-02 06:23:36'),
(4,	2,	'assets/service/thumbnail/SAjmT6ZhwEnU45Tr2r4kllmz1laYC7R6OulwYHDt.png',	NULL,	'2022-01-02 06:25:17',	'2022-01-02 06:25:17'),
(5,	2,	'assets/service/thumbnail/tXVmtJVVF1tTKLmgExkZuqa5IOKc06CwNpA4dmQ9.png',	NULL,	'2022-01-02 06:25:17',	'2022-01-02 06:25:17'),
(6,	2,	'assets/service/thumbnail/eFYcslOvCA7SDTeIndQJOIYgeU6L3t2p1RaVspXP.png',	NULL,	'2022-01-02 06:25:17',	'2022-01-02 06:25:17');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `feature_camvs`;
CREATE TABLE `feature_camvs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `camvs_id` bigint(20) unsigned DEFAULT NULL,
  `feature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feature_camvs_to_camvs` (`camvs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `feature_camvs` (`id`, `camvs_id`, `feature`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	'Bed',	NULL,	'2022-01-02 06:29:51',	'2022-01-02 06:29:51'),
(2,	1,	'Wifi',	NULL,	'2022-01-02 06:29:51',	'2022-01-02 06:29:51'),
(3,	1,	'TV',	NULL,	'2022-01-02 06:29:51',	'2022-01-02 06:29:51'),
(4,	2,	'Bed',	NULL,	'2022-01-02 06:33:41',	'2022-01-02 06:33:41'),
(5,	2,	'Wifi',	NULL,	'2022-01-02 06:33:41',	'2022-01-02 06:33:41'),
(6,	2,	'TV',	NULL,	'2022-01-02 06:33:41',	'2022-01-02 06:33:41');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(103,	'2014_10_12_000000_create_users_table',	1),
(104,	'2014_10_12_100000_create_password_resets_table',	1),
(105,	'2019_08_19_000000_create_failed_jobs_table',	1),
(106,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(107,	'2021_12_07_092336_create_destinations_table',	1),
(108,	'2021_12_07_093055_create_camvs_table',	1),
(109,	'2021_12_07_093144_create_destination_galleries_table',	1),
(110,	'2021_12_07_094431_create_feature_camvs_table',	1),
(111,	'2021_12_17_075602_create_categories_table',	1),
(112,	'2021_12_30_095729_create_transactions_table',	1),
(113,	'2022_01_01_164412_create_carts_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destinations_id` bigint(20) unsigned DEFAULT NULL,
  `camvs_id` bigint(20) unsigned DEFAULT NULL,
  `users_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_total` int(11) DEFAULT '1',
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `booking_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transactions_to_destinations` (`destinations_id`),
  KEY `fk_transactions_to_camvs` (`camvs_id`),
  KEY `fk_transactions_to_users` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transactions` (`id`, `destinations_id`, `camvs_id`, `users_id`, `transaction_total`, `transaction_status`, `booking_date`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	1,	2510000,	'PENDING',	'2022-01-06',	'2022-01-02 06:38:49',	'2022-01-02 06:38:49'),
(2,	2,	2,	2,	2510000,	'PENDING',	'2022-01-07',	'2022-01-02 10:31:19',	'2022-01-02 10:31:19');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Wahyu Indra',	'wahyuindra712@gmail.com',	'2022-01-02 04:14:37',	NULL,	'https://lh3.googleusercontent.com/a/AATXAJxyHiQ4yDGbHHIRPOnX2A4k0PjdU9dp6mnekjwz=s96-c',	'ADMIN',	'ONlbpMsQZqSBg10xnD9X4qW6KO97WJnyZdvDhmBOLtMStBEe3kaeXzt34RR5',	'2022-01-02 04:14:37',	'2022-01-02 04:14:37'),
(2,	'M. WAHYU INDRA WARDANA',	'wahyuindra@student.telkomuniversity.ac.id',	'2022-01-02 06:19:42',	NULL,	'https://lh3.googleusercontent.com/a-/AOh14GiL9V8SrC7fw5Y8yKlxekXBX54xY417ksVxJxui=s96-c',	'USER',	'3XPrNk2jFc7cdd4kmjEDnWeNquxqZquqGRyrDphsoEbCALnk5aAB65VRlVLb',	'2022-01-02 06:19:42',	'2022-01-02 06:19:42');

-- 2022-01-11 06:06:40
