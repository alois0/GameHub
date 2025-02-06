-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 fév. 2025 à 15:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gamehub`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street_number` varchar(10) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `addresses`
--

INSERT INTO `addresses` (`id`, `street_number`, `street_name`, `city`, `postal_code`) VALUES
(1, '1', 'rue', 'voi', 78960),
(2, '1', 'rue', 'voi', 78960),
(3, '1', 'rue', 'voi', 78960),
(4, '1', 'rue', 'voi', 78960),
(5, '2', 'rue', 'voi', 78960),
(6, 'ga', '30', 'Voisins', 78960),
(7, '12', 'aaaaaa', '78960', 78960),
(8, '12', 'aaaaa', 'aaaaaaa', 78960),
(9, '12', 'aaaaa', 'aaaaaaa', 78960);

-- --------------------------------------------------------

--
-- Structure de la table `address_user`
--

CREATE TABLE `address_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `address_user`
--

INSERT INTO `address_user` (`id`, `user_id`, `address_id`, `is_default`) VALUES
(1, 9, 4, 1),
(2, 9, 5, 0),
(3, 10, 6, 1),
(4, 11, 7, 1),
(5, 12, 8, 1),
(6, 4, 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('nicobou60@gmail.com|::1', 'i:1;', 1733304421),
('nicobou60@gmail.com|::1:timer', 'i:1733304421;', 1733304421);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-12-04 09:30:17', '2024-12-04 09:30:17'),
(2, 2, '2024-12-28 08:09:58', '2024-12-28 08:09:58'),
(3, 3, '2025-01-11 09:40:44', '2025-01-11 09:40:44'),
(4, 4, '2025-01-15 10:40:44', '2025-01-15 10:40:44'),
(5, 9, '2025-01-28 10:00:45', '2025-01-28 10:00:45'),
(6, 10, '2025-01-31 07:43:46', '2025-01-31 07:43:46'),
(7, 12, '2025-02-03 16:54:30', '2025-02-03 16:54:30');

-- --------------------------------------------------------

--
-- Structure de la table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Jeux Vidéo', 'Tous les types de jeux vidéo'),
(2, 'fantasie', 'f');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(52, '2024_10_24_121820_create_sessions_table', 1),
(53, '2024_10_24_131727_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Shipped','Delivered','Canceled') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`, `status`, `created_at`, `updated_at`) VALUES
(8, 2, 119.98, '2024-12-31 13:27:24', 'Pending', '2024-12-31 12:27:24', '2025-02-06 13:46:23'),
(9, 2, 59.99, '2024-12-31 14:21:30', 'Processing', '2024-12-31 13:21:30', '2025-01-24 12:01:13'),
(10, 2, 59.99, '2024-12-31 14:23:01', 'Pending', '2024-12-31 13:23:01', '2024-12-31 13:23:01'),
(11, 2, 59.99, '2024-12-31 14:35:17', 'Pending', '2024-12-31 13:35:17', '2024-12-31 13:35:17'),
(12, 4, 59.99, '2025-01-16 14:07:58', 'Pending', '2025-01-16 13:07:58', '2025-01-16 13:07:58'),
(13, 4, 59.99, '2025-01-16 14:21:03', 'Pending', '2025-01-16 13:21:03', '2025-01-16 13:21:03'),
(14, 4, 59.99, '2025-01-23 09:02:41', 'Pending', '2025-01-23 08:02:41', '2025-01-23 08:02:41'),
(15, 4, 59.99, '2025-01-27 11:34:16', 'Pending', '2025-01-27 10:34:16', '2025-01-27 10:34:16'),
(16, 4, 59.99, '2025-01-27 12:08:18', 'Pending', '2025-01-27 11:08:18', '2025-01-27 11:08:18'),
(17, 9, 59.99, '2025-01-28 12:43:56', 'Pending', '2025-01-28 11:43:56', '2025-01-28 11:43:56'),
(18, 9, 59.99, '2025-01-28 13:05:42', 'Pending', '2025-01-28 12:05:42', '2025-01-28 12:05:42'),
(19, 9, 59.99, '2025-01-28 13:15:43', 'Pending', '2025-01-28 12:15:43', '2025-01-28 12:15:43'),
(20, 9, 59.99, '2025-01-28 13:32:51', 'Pending', '2025-01-28 12:32:51', '2025-01-28 12:32:51'),
(21, 9, 59.99, '2025-01-28 13:39:08', 'Pending', '2025-01-28 12:39:08', '2025-01-28 12:39:08'),
(22, 9, 59.99, '2025-01-28 14:09:50', 'Pending', '2025-01-28 13:09:50', '2025-01-28 13:09:50'),
(23, 9, 59.99, '2025-01-28 14:25:30', 'Pending', '2025-01-28 13:25:30', '2025-01-28 13:25:30'),
(24, 9, 59.99, '2025-01-28 14:39:26', 'Pending', '2025-01-28 13:39:26', '2025-01-28 13:39:26'),
(25, 10, 59.99, '2025-01-31 08:44:32', 'Pending', '2025-01-31 07:44:32', '2025-01-31 07:44:32'),
(26, 10, 119.98, '2025-01-31 09:03:02', 'Pending', '2025-01-31 08:03:02', '2025-01-31 08:03:02'),
(27, 12, 59.99, '2025-02-03 17:54:59', 'Pending', '2025-02-03 16:54:59', '2025-02-03 16:54:59'),
(28, 4, 59.99, '2025-02-04 10:22:26', 'Delivered', '2025-02-04 09:22:26', '2025-02-04 10:28:51'),
(29, 4, 119.98, '2025-02-04 10:34:51', 'Pending', '2025-02-04 09:34:51', '2025-02-04 09:34:51'),
(30, 4, 59.99, '2025-02-04 10:38:18', 'Pending', '2025-02-04 09:38:18', '2025-02-04 09:38:18'),
(31, 4, 59.99, '2025-02-04 11:58:37', 'Delivered', '2025-02-04 10:58:37', '2025-02-04 11:13:36'),
(32, 4, 59.99, '2025-02-04 19:26:39', 'Delivered', '2025-02-04 18:26:39', '2025-02-04 18:27:34'),
(33, 4, 59.99, '2025-02-06 09:34:32', 'Pending', '2025-02-06 08:34:32', '2025-02-06 08:34:32'),
(34, 4, 59.99, '2025-02-06 12:17:05', 'Pending', '2025-02-06 11:17:05', '2025-02-06 11:17:05'),
(35, 4, 239.96, '2025-02-06 12:42:12', 'Pending', '2025-02-06 11:42:12', '2025-02-06 11:42:12'),
(36, 4, 119.98, '2025-02-06 14:00:36', 'Pending', '2025-02-06 13:00:36', '2025-02-06 13:00:36'),
(37, 4, 239.96, '2025-02-06 14:03:59', 'Pending', '2025-02-06 13:03:59', '2025-02-06 13:03:59'),
(38, 4, 59.99, '2025-02-06 14:44:07', 'Pending', '2025-02-06 13:44:07', '2025-02-06 13:44:07'),
(39, 4, 119.98, '2025-02-06 15:16:20', 'Pending', '2025-02-06 14:16:20', '2025-02-06 14:16:20');

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_each` decimal(10,2) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `platform_id`, `quantity`, `price_each`, `address_id`, `created_at`, `updated_at`) VALUES
(26, 28, 3, 4, 1, 59.99, 9, '2025-02-04 09:22:26', '2025-02-04 09:22:26'),
(27, 29, 3, 4, 2, 59.99, 9, '2025-02-04 09:34:51', '2025-02-04 09:34:51'),
(28, 30, 3, 4, 1, 59.99, 9, '2025-02-04 09:38:18', '2025-02-04 09:38:18'),
(29, 31, 3, 4, 1, 59.99, 9, '2025-02-04 10:58:37', '2025-02-04 10:58:37'),
(30, 32, 3, 4, 1, 59.99, 9, '2025-02-04 18:26:39', '2025-02-04 18:26:39'),
(31, 33, 3, 4, 1, 59.99, 9, '2025-02-06 08:34:33', '2025-02-06 08:34:33'),
(32, 34, 3, 4, 1, 59.99, 9, '2025-02-06 11:17:05', '2025-02-06 11:17:05'),
(33, 35, 3, 4, 4, 59.99, 9, '2025-02-06 11:42:12', '2025-02-06 11:42:12'),
(34, 36, 3, 4, 2, 59.99, 9, '2025-02-06 13:00:36', '2025-02-06 13:00:36'),
(35, 37, 3, 4, 4, 59.99, 9, '2025-02-06 13:03:59', '2025-02-06 13:03:59'),
(36, 38, 3, 4, 1, 59.99, 9, '2025-02-06 13:44:07', '2025-02-06 13:44:07'),
(37, 39, 3, 4, 1, 59.99, 9, '2025-02-06 14:16:20', '2025-02-06 14:16:20'),
(38, 39, 4, 4, 1, 59.99, 9, '2025-02-06 14:16:20', '2025-02-06 14:16:20');

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `phone`
--

INSERT INTO `phone` (`id`, `tel`, `user_id`) VALUES
(1, '0777444744', 1),
(2, '0744444444', 2),
(3, '01547889', 3),
(4, '01547887', 4),
(5, '48592641', 9),
(6, '12345678', 10),
(7, '07495265', 11),
(8, '0744547865', 12);

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

CREATE TABLE `platform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `platform`
--

INSERT INTO `platform` (`id`, `name`) VALUES
(4, 'Nintendo Switch'),
(3, 'PC'),
(1, 'PlayStation 4'),
(2, 'Xbox One');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `release_date` datetime DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `price`, `stock_quantity`, `release_date`, `image_path`) VALUES
(3, 'The Legend of Zelda: Breath of the Wild', 'Un jeu d\'aventure épique en monde ouvert', 59.99, 20, '2025-03-01 00:00:00', 'maxresdefault.jpg'),
(4, 'The Elder Scrolls V: Skyrim ', 'Explorez un vaste monde rempli de quêtes, de donjons et de créatures fantastiques. ', 59.99, 10, '2025-02-06 15:11:58', 'skyrim.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `product_platform`
--

CREATE TABLE `product_platform` (
  `product_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product_platform`
--

INSERT INTO `product_platform` (`product_id`, `platform_id`) VALUES
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `review_text`, `created_at`) VALUES
(7, 3, 4, 1, 'oui', '2025-02-04 09:15:23'),
(8, 3, 4, 1, 'non', '2025-02-04 09:15:33');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KmPsXLsIr6BXiLavs45XU5CwFWShoqQ31ACnZxPA', 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoickdwR2k0SFFJc3d5eFFLNUFWVFpjZjFSWjBFM1BQOU9mMUdIeGR4TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1738853075);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `payment` varchar(100) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `first_name`, `last_name`, `payment`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'nikoko', '$2y$12$sbY6tkNnTQ.poAEeSOg9ge0eJmgiQ1mlk02S137wJTfG/PB9ExKKG', 'nicobou60@gmail.com', NULL, NULL, NULL, 'user', '2024-12-04 09:30:07', '2024-12-04 09:30:07'),
(2, 'supernico', '$2y$12$9pQkgHu4d.CPGImq647lb./oklmDGsq0HMiN7wka.8Hw5JYRL8Ay2', 'supernico@gmail.com', NULL, NULL, NULL, 'user', '2024-12-28 08:09:54', '2024-12-28 08:09:54'),
(3, 'nicolasbour', '$2y$12$sCQK2E9KTvH8YIjtDHyX2OSA0d9.crdJGfkplzRLoXKWWpvlh6FmW', 'nicolasbour@gmail.com', NULL, NULL, NULL, 'user', '2025-01-11 09:40:36', '2025-01-11 09:40:36'),
(4, 'nicolasboura', '$2y$12$S8mOUwuMKp6rtDtnab/Kiuo0mktg3NGGG3PFEnB1yqnv5j0iy0esi', 'nicolasboura@gmail.com', NULL, NULL, NULL, 'user', '2025-01-15 10:40:39', '2025-01-15 10:40:39'),
(5, 'nicolarbou', '$2y$12$ofQgCrSRs.6YAwsJokVIAel.dwED4wYLjvKvGWmKfzYJh0fow4s2a', 'nicolarbou@gmail.com', NULL, NULL, NULL, 'user', '2025-01-28 08:23:55', '2025-01-28 08:23:55'),
(6, 'ahahah', '$2y$12$D0p8C71Zi/bBOToSXP0JwumkpgX89vYOaJBPC.GsnRvmk9/l/scyu', 'ah@gmail.com', NULL, NULL, NULL, 'user', '2025-01-28 08:33:10', '2025-01-28 08:33:10'),
(7, 'ahahah1', '$2y$12$Fo9YRTMNtMr/NOd53CD2p.4z2mMuMg87FJtJ1wBAuwXiM7T6udo6a', 'ah1@gmail.com', NULL, NULL, NULL, 'user', '2025-01-28 08:45:24', '2025-01-28 08:45:24'),
(8, 'ahahah11', '$2y$12$ocKMoMEYYRztqNyQObQ6aeyJnyh96dM6LsERl2J8JfDX95w.LgCOe', 'ah11@gmail.com', NULL, NULL, NULL, 'user', '2025-01-28 08:57:47', '2025-01-28 08:57:47'),
(9, 'ahahah111', '$2y$12$flrp4PsSZmWdalDinQOID.xZSqKrmdCQ1z/fP0cWag1vxnpAIFCx.', 'ah111@gmail.com', NULL, NULL, NULL, 'user', '2025-01-28 08:58:45', '2025-01-28 08:58:45'),
(10, 'ouioui', '$2y$12$uZqm6dHifGdcpHqERTdHg.RoA99XUZ7NVCZLAyftjzkZRbgTk9fj6', 'ouioui@gmail.com', NULL, NULL, NULL, 'user', '2025-01-31 07:43:21', '2025-01-31 07:43:21'),
(11, 'aaag', '$2y$12$6ir8OzCrbpUNHkiTYjOj2e8xPqzPKBhIpXtDv5fLW0K0/zMJKUCMy', 'aaag@gmail.com', NULL, NULL, NULL, 'user', '2025-02-03 16:37:31', '2025-02-03 16:37:31'),
(12, 'rrrrrrrrr', '$2y$12$0g.fMCFfBztdaZYeNgpESeThN5LDfR22sVz7GyIXzsrFUR/CFv64y', 'rrrrrg@gmail.com', NULL, NULL, NULL, 'user', '2025-02-03 16:39:40', '2025-02-03 16:39:40');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `address_user`
--
ALTER TABLE `address_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_cart_products_platform` (`platform_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_order_details_platform_id` (`platform_id`),
  ADD KEY `fk_order_details_address` (`address_id`);

--
-- Index pour la table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `platform_code` (`name`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `product_platform`
--
ALTER TABLE `product_platform`
  ADD PRIMARY KEY (`product_id`,`platform_id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Index pour la table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `address_user`
--
ALTER TABLE `address_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `platform`
--
ALTER TABLE `platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address_user`
--
ALTER TABLE `address_user`
  ADD CONSTRAINT `address_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `address_user_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_products_platform` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_address` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_details_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_platform`
--
ALTER TABLE `product_platform`
  ADD CONSTRAINT `product_platform_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_platform_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
