-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 25 jan. 2021 à 07:57
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webshop_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/images/categories_img_01.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`),
  UNIQUE KEY `category_slug` (`category_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'bulbs', 'bulbs', '/assets/images/categories_img_02.jpg', '2020-12-23 08:53:14', '2020-12-23 08:53:14'),
(2, 'fruits', 'fruits', '/assets/images/img-pro-03.jpg', '2020-12-23 08:53:14', '2020-12-23 08:53:14'),
(3, 'podded vegetables', 'podded-vegetables', '/assets/images/categories_img_03.jpg', '2020-12-23 08:54:06', '2020-12-23 08:54:06'),
(4, 'root and tuberous', 'root-and-tuberous', '/assets/images/categories_img_01.jpg', '2020-12-23 08:54:06', '2020-12-23 08:54:06'),
(5, 'grocery', 'grocery', '/assets/images/instagram-img-06.jpg', '2020-12-23 08:54:06', '2020-12-23 08:54:06'),
(6, 'breakfast', 'breakfast', '/assets/images/instagram-img-02.jpg', '2020-12-23 08:54:06', '2020-12-23 08:54:06');

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'yuuu@gmail.com', '2021-01-07 12:53:17', '2021-01-07 12:53:17'),
(2, 'zaaaas@gmail.com', '2021-01-07 13:25:07', '2021-01-07 13:25:07'),
(4, 'heyyy@gmail.com', '2021-01-07 13:34:46', '2021-01-07 13:34:46'),
(5, 'joooo@gmail.com', '2021-01-07 13:44:14', '2021-01-07 13:44:14'),
(7, 'hg@gmail.com', '2021-01-07 13:46:13', '2021-01-07 13:46:13'),
(10, 'laq@gmail.com', '2021-01-07 13:53:00', '2021-01-07 13:53:00'),
(11, 'juuu@gmail.com', '2021-01-07 14:03:21', '2021-01-07 14:03:21'),
(12, 'jupi@gmail.com', '2021-01-09 15:23:58', '2021-01-09 15:23:58');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `user_session` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double UNSIGNED NOT NULL DEFAULT '0',
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_delivered` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_postal_code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `user_session`, `total_price`, `payment_status`, `is_delivered`, `shipping_address`, `shipping_country`, `shipping_city`, `shipping_postal_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'n6miedcjvlsd698bsdu6nego99', 216, 0, 0, 'avenue Militaire 123', 'Belgium', 'Bruxelles', '1310', '2020-01-27 18:37:04', '2020-06-18 17:48:52', NULL),
(2, 6, 'n6miedcjvlsd698bsdu6nego99', 259, 0, 0, 'Rue des Brisolers 895', 'Belgium5', 'Brussels5', '1040', '2020-01-27 19:09:20', '2020-04-20 10:41:47', NULL),
(3, 7, 'n6miedcjvlsd698bs', 133, 0, 0, 'avenue Militaire 123', 'Belgium', 'Bruxelles', '1310', '2020-01-27 18:37:04', '2020-06-18 17:48:52', NULL),
(17, 8, NULL, 312, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(33, 1, 2, 20, 1, '/assets/images/gallery-img-11.jpg', '2020-02-28 07:54:32', '2020-02-28 08:25:53'),
(51, 2, 8, 13, 1, '/assets/images/instagram-img-04.jpg', '2020-03-11 13:32:12', '2020-03-30 13:36:14'),
(54, 2, 3, 62, 3, '/assets/images/instagram-img-05.jpg', '2020-03-11 15:46:28', '2020-04-09 09:01:40'),
(58, 3, 4, 10, 2, '/assets/images/instagram-img-06.jpg', '2020-02-19 14:21:09', '2020-04-09 09:02:45'),
(59, 3, 1, 33, 1, '/assets/images/gallery-img-10.jpg', '2020-02-26 08:25:53', '2020-04-09 09:02:32'),
(60, 3, 2, 20, 4, '/assets/images/gallery-img-11.jpg', '2020-02-28 07:54:32', '2020-02-28 08:25:53'),
(63, 1, 4, 10, 1, '/assets/images/instagram-img-06.jpg', NULL, NULL),
(78, 1, 3, 62, 3, '/assets/images/instagram-img-05.jpg', NULL, NULL),
(79, 17, 8, 13, 1, '/assets/images/instagram-img-04.jpg', NULL, NULL),
(80, 17, 20, 299, 1, '/assets/images/gallery-img-04.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `type_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,4) UNSIGNED NOT NULL,
  `stripe_customer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_source` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_comm` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `type`, `type_name`, `order_id`, `user_id`, `amount`, `stripe_customer`, `stripe_source`, `stripe_charge`, `transfer_comm`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 1, 'credit', 12, 1, '938.0000', NULL, 'pi_1GSnBGIw4n6pDxhogwKu7K7H', NULL, NULL, 1, '2020-03-31 14:43:13', '2020-03-31 14:43:13', NULL),
(27, 1, 'credit', 13, 4, '616.0000', NULL, 'pi_1GaGwJIw4n6pDxhokLNb2iQp', NULL, NULL, 4, '2020-04-21 05:54:43', '2020-04-21 05:54:45', NULL),
(50, 2, 'bancontact', 26, 4, '561.5000', 'src_client_secret_bnQBvM6le01LjwIjVpfsJbyM', 'src_1Gj4xaIw4n6pDxhofVcwvJPL', 'py_1Gj4xnIw4n6pDxhoi6qVXJLA', NULL, 4, '2020-05-15 12:56:25', '2020-05-15 12:56:39', NULL),
(58, 3, 'transfer', 27, 4, '476.0000', NULL, NULL, NULL, 'Costinelinho3 19-05-20 27', 2, '2020-05-19 10:33:02', '2020-05-19 10:33:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `units` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `stock` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `label` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '../images/product.png',
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `units`, `stock`, `label`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'onion', 'onion', 'description onion', 33, 66, 33, 'new', '/assets/images/gallery-img-10.jpg', 1, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(2, 'celeri', 'celeri', 'description ', 20, 66, 33, 'sale', '/assets/images/gallery-img-11.jpg', 1, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(3, 'cherries', 'cherries', 'description ', 62, 66, 33, 'new', '/assets/images/instagram-img-05.jpg', 2, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(4, 'oranges', 'oranges', 'description ', 10, 66, 5, 'sale', '/assets/images/instagram-img-06.jpg', 2, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(5, 'berries', 'berries', 'description ', 399, 66, 33, NULL, '/assets/images/instagram-img-09.jpg', 2, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(6, 'pumpkin', 'pumpkin', 'description ', 259, 66, 33, 'sale', '/assets/images/instagram-img-07.jpg', 2, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(7, 'clementines', 'clementines', 'description ', 199, 66, 33, 'new', '/assets/images/instagram-img-03.jpg', 2, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(8, 'lemons', 'lemons', 'description ', 13, 66, 33, 'new', '/assets/images/instagram-img-04.jpg', 2, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(9, 'spinach', 'spinach', 'description ', 100, 66, 33, 'sale', '/assets/images/instagram-img-01.jpg', 5, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(10, 'parsnip', 'parsnip', 'description ', 60, 66, 33, 'new', '/assets/images/smp-img-01.jpg', 4, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(19, 'peppers', 'peppers', 'description peppers', 336, 66, 33, 'sale', '/assets/images/gallery-img-03.jpg', 5, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(20, 'lens', 'lens', 'description ', 299, 66, 33, 'sale', '/assets/images/gallery-img-04.jpg', 3, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(21, 'cucumbers', 'cucumbers', 'description ', 600, 66, 0, 'new', '/assets/images/gallery-img-01.jpg', 3, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(22, 'tomatoes', 'tomatoes', 'description ', 29, 66, 33, 'sale', '/assets/images/img-pro-02.jpg', 5, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(23, 'olives', 'olives', 'description ', 399, 66, 33, NULL, '/assets/images/gallery-img-08.jpg', 5, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(24, 'green beans', 'green-beans', 'description', 30, 66, 33, NULL, '/assets/images/gallery-img-12.jpg', 3, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(25, 'green lens', 'green-lens', 'description ', 299, 66, 0, NULL, '/assets/images/gallery-img-05.jpg', 3, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(26, 'small olives', 'small-olives', 'description ', 600, 66, 33, NULL, '/assets/images/gallery-img-07.jpg', 5, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(27, 'carots', 'carots', 'description ', 29, 66, 33, NULL, '/assets/images/img-pro-01.jpg', 4, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(31, 'papaya', 'papaya', 'description', 336, 66, 0, NULL, '/assets/images/img-pro-04.jpg', 2, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(32, 'grapes', 'grapes', 'description ', 600, 66, 33, 'sale', '/assets/images/img-pro-03.jpg', 2, '2020-12-23 09:13:57', '2020-12-23 09:13:57'),
(33, 'yogurt', 'yogurt', 'description ', 29, 66, 33, NULL, '/assets/images/instagram-img-02.jpg', 6, '2020-12-23 09:18:02', '2020-12-23 09:18:02'),
(34, 'cabbage', 'cabbage', 'description ', 29, 66, 33, 'new', '/assets/images/blog-img.jpg', 5, '2020-12-23 09:18:02', '2020-12-23 09:18:02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `is_connected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `pseudo`, `email`, `password`, `photo`, `description`, `role`, `is_connected`, `created_at`, `updated_at`) VALUES
(1, 'Cristina', 'Dinca', 'kiki', 'kiki@gmail.com', '$2y$10$C8UcyTqoSLV1w5ZzJQ6Xt.G6BkvXiENlOujPMTWohBJIx4FGqMONW', NULL, NULL, 'member', 0, '2020-12-17 10:47:32', '2020-12-17 10:47:32'),
(6, 'koooo', 'gyyyyy', NULL, 'gyyy@gmail.com', '$2y$10$cvWwD5TCTPYjETzHJX8NO.BJ12wp.y9TyY2GH7jL9.GKcpjZx5lI2', NULL, NULL, 'member', 0, '2021-01-06 16:49:12', '2021-01-06 16:49:12'),
(7, 'sqdqd', 'fdfdf', NULL, 'jhkkj@gmail.com', '$2y$10$WpPOlqbiQucGI9qECeKNEOG6Dve/hzr5meHCkAhlgM/dxkIbNRGti', NULL, NULL, 'member', 0, '2021-01-06 17:03:23', '2021-01-06 17:03:23'),
(8, 'fifina', 'verzuli', NULL, 'fifi@gmail.com', '$2y$10$qXoVPZUlUt.rHWMtkWvWlOxp/RasIUyRJrpnDtjQwBuYi2pNpom2i', NULL, NULL, 'member', 0, '2021-01-20 20:46:53', '2021-01-20 20:46:53'),
(9, 'sara', 'lynn', NULL, 'sara@gmail.com', '$2y$10$eJq9PevpS7hIY8o3adCX5e.S/YCPqNA/6kBwaDFQWMxXrBfi6NNk2', NULL, NULL, 'member', 1, '2021-01-20 21:59:00', '2021-01-20 21:59:00');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlist_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wishlist_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2021-01-12 13:17:53', '2021-01-12 13:17:53'),
(23, 1, 19, '2021-01-13 08:45:00', '2021-01-13 08:45:00'),
(25, 1, 27, '2021-01-13 08:57:31', '2021-01-13 08:57:31'),
(26, 6, 3, '2021-01-13 13:02:25', '2021-01-13 13:02:25'),
(27, 6, 6, '2021-01-13 13:02:30', '2021-01-13 13:02:30'),
(28, 6, 8, '2021-01-13 13:02:35', '2021-01-13 13:02:35'),
(29, 9, 4, '2021-01-20 21:59:30', '2021-01-20 21:59:30'),
(30, 9, 3, '2021-01-20 21:59:35', '2021-01-20 21:59:35');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `orderItem_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderItem_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
