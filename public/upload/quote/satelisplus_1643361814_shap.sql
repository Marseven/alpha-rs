-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2021 at 03:10 AM
-- Server version: 10.3.30-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satelisplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `box_canals`
--

CREATE TABLE `box_canals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_box` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_abonne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `box_canals`
--

INSERT INTO `box_canals` (`id`, `numero_box`, `numero_abonne`, `client_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '123654789545', '7452AZS', 5, 1, '2021-08-19 17:33:29', '2021-08-19 17:33:29'),
(2, '451222009874', '074VBT4', 8, 1, '2021-08-19 19:21:10', '2021-09-07 15:36:00'),
(3, '2245789632145', '741852963321', 8, 1, '2021-09-07 15:28:54', '2021-09-07 15:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `libelle`, `active`, `created_at`, `updated_at`) VALUES
(1, 'IFO', 'INFO', 1, '2021-08-18 23:39:46', '2021-08-19 00:11:50'),
(2, 'CNM', 'CINEMA', 1, '2021-08-18 23:55:25', '2021-08-18 23:55:25'),
(3, 'GNR', 'GENERALISTE', 1, '2021-08-18 23:55:56', '2021-08-18 23:55:56'),
(4, 'SED', 'SERIES & DIVERTISSEMENTS', 1, '2021-08-18 23:57:00', '2021-08-18 23:57:00'),
(5, 'JNS', 'JEUNESSE', 1, '2021-08-18 23:57:15', '2021-08-18 23:57:15'),
(6, 'DCVT', 'DECOUVERTE', 1, '2021-08-18 23:57:34', '2021-08-18 23:57:34'),
(7, 'RLG', 'RELIGION', 1, '2021-08-18 23:57:47', '2021-08-18 23:57:47'),
(8, 'MZK', 'MUSIQUE', 1, '2021-08-18 23:58:02', '2021-08-18 23:58:02'),
(9, 'SPR', 'SPORT', 1, '2021-08-18 23:58:28', '2021-08-18 23:58:28'),
(10, 'CHRA', 'CHAINES & RADIOS AFRICAINES', 1, '2021-08-18 23:59:59', '2021-08-18 23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `chaines`
--

CREATE TABLE `chaines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chaines`
--

INSERT INTO `chaines` (`id`, `categorie_id`, `code`, `libelle`, `logo_url`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'FR24', 'France24', 'http://localhost:8000/logos/27286.png', 'France 24 est une chaîne de télévision française d\'information internationale en continu, créée le 30 novembre 2005 et diffusant depuis le 6 décembre 2006 . Elle est, depuis 2012, une chaîne de la société nationale de programme France Médias Monde, qui supervise l\'audiovisuel extérieur de la France.', 1, '2021-08-19 10:06:59', '2021-08-19 11:08:47'),
(2, 1, 'G24', 'GABON24', 'http://localhost:8000/logos/15669.jpg', 'Gabon 24 est la première chaîne de télévision gabonaise d\'information en continu bilingue lancée le 24 mai 2016 ,.', 1, '2021-08-19 10:27:37', '2021-08-19 11:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `chaine_offres`
--

CREATE TABLE `chaine_offres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chaine_id` int(11) DEFAULT NULL,
  `offre_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compte_marchands`
--

CREATE TABLE `compte_marchands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Satelis',
  `tel_marchand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operateur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_operateur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compte_marchands`
--

INSERT INTO `compte_marchands` (`id`, `societe`, `tel_marchand`, `operateur`, `code_operateur`, `token`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Satelis', '077921645', 'Airtel', 'AM', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.QUVSZ0FHaUZ6YUU5MFRteTRYMHFNNTdtL3paYzBxQXhLMmdJZGkzb2V1NVB2RHVqOUFSdzRNam11b0pWY3V1SGl3RHA3ZUkwaGUyaWw0UDZENHluQzZEcnhQRzFaRmJlT2VjeEFjZERJMklGMTlsa1lFMmlIZ1NkeTEzZ2FLNGx4SWxuanU5eC9LWGRGWVJkNWg2QTd5VmluSVdrYjBubUZzcGhvR1NoWVh2WVZpNzhjdE5RMEFrRmtra0FMbVZOOjpyWnNFYWZaR2NwNkdtMXF4YUNwYXZBPT0=.CCUTEQZDOCdWARVYVfBWceG1sssoPwgBuGwIlh5h6A8=', 0, '2021-08-19 16:43:36', '2021-08-19 16:51:23'),
(2, 'Satelis', '066682353', 'MOOV Africa', 'MC', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.QUVSZ0FHaUZ6YUU5MFRteTRYMHFNNTdtL3paYzBxQXhLMmdJZGkzb2V1NVB2RHVqOUFSdzRNam11b0pWY3V1SGl3RHA3ZUkwaGUyaWw0UDZENHluQzZEcnhQRzFaRmJlT2VjeEFjZERJMklGMTlsa1lFMmlIZ1NkeTEzZ2FLNGx4SWxuanU5eC9LWGRGWVJkNWg2QTd5VmluSVdrYjBubUZzcGhvR1NoWVh2WVZpNzhjdE5RMEFrRmtra0FMbVZOOjpyWnNFYWZaR2NwNkdtMXF4YUNwYXZBPT0=.CCUTEQZDOCdWARVYVfBWceG1sssoPwgBuGwIlh5h6A8=', 1, '2021-08-19 16:50:51', '2021-08-19 16:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `decodeurs`
--

CREATE TABLE `decodeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_decodeur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_abonne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decodeurs`
--

INSERT INTO `decodeurs` (`id`, `numero_decodeur`, `numero_abonne`, `client_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '178559600129', '4125MLK', 5, 0, '2021-08-19 17:35:00', '2021-08-19 22:58:39'),
(2, '17855960012000', '14785MP46', 8, 1, '2021-08-19 18:42:52', '2021-10-20 16:01:27'),
(3, '22451638505400', '600489278001', 8, 1, '2021-09-07 14:18:06', '2021-10-20 13:38:54'),
(4, '23800006001941', '1072309', 8, 1, '2021-11-11 10:58:20', '2021-11-11 10:58:20'),
(5, '224516385054', '0000-0000-0000-0000', 8, 1, '2021-11-19 23:30:14', '2021-11-19 23:30:14'),
(6, '12345678912301', '0000-0000-0000-0000', 8, 1, '2021-11-19 23:31:47', '2021-11-19 23:31:47'),
(7, '23800006001941', '0000-0000-0000-0000', 9, 1, '2021-11-20 00:07:33', '2021-11-20 00:07:33'),
(8, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-11-20 00:11:03', '2021-11-20 00:11:03'),
(9, '23800006001941', '0000-0000-0000-0000', 5, 1, '2021-11-20 00:21:53', '2021-11-20 00:21:53'),
(10, '23800006001941', '0000-0000-0000-0000', 6, 1, '2021-11-20 00:26:12', '2021-11-20 00:26:12'),
(11, '23800006001941', '12345678901234', 11, 1, '2021-11-21 17:44:16', '2021-11-21 17:44:16'),
(12, '23800006001941', '0000-0000-0000-0000', 14, 1, '2021-12-13 15:27:39', '2021-12-13 15:27:39'),
(13, '23800160529412', '0000-0000-0000-0000', 15, 1, '2021-12-13 15:43:20', '2021-12-13 15:43:20'),
(14, '23800014858191', '0000-0000-0000-0000', 15, 1, '2021-12-13 15:46:43', '2021-12-13 15:46:43'),
(15, '12345678901234', '0000-0000-0000-0000', 15, 1, '2021-12-13 16:09:48', '2021-12-13 16:09:48'),
(16, '12345678902345', '0000-0000-0000-0000', 15, 1, '2021-12-13 16:12:24', '2021-12-13 16:12:24'),
(17, '23800160529412', '0000-0000-0000-0000', 15, 1, '2021-12-16 15:12:01', '2021-12-16 15:12:01'),
(18, NULL, '0000-0000-0000-0000', 15, 1, '2021-12-16 15:39:18', '2021-12-16 15:39:18'),
(19, NULL, '0000-0000-0000-0000', 15, 1, '2021-12-16 15:42:20', '2021-12-16 15:42:20'),
(20, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 10:46:39', '2021-12-22 10:46:39'),
(21, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 10:58:16', '2021-12-22 10:58:16'),
(22, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 11:32:51', '2021-12-22 11:32:51'),
(23, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 11:34:03', '2021-12-22 11:34:03'),
(24, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 11:37:11', '2021-12-22 11:37:11'),
(25, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 11:37:40', '2021-12-22 11:37:40'),
(26, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 11:48:58', '2021-12-22 11:48:58'),
(27, '23800006001941', '0000-0000-0000-0000', 10, 1, '2021-12-22 12:11:12', '2021-12-22 12:11:12'),
(28, '23800311981825', '0000-0000-0000-0000', 17, 1, '2021-12-27 15:52:20', '2021-12-27 15:52:20'),
(29, '23800311981825', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:01:40', '2021-12-27 16:01:40'),
(30, '23800311981825', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:02:43', '2021-12-27 16:02:43'),
(31, '23800311900000', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:06:01', '2021-12-27 16:06:01'),
(32, '23800158800815', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:20:30', '2021-12-27 16:20:30'),
(33, '23800158800815', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:21:16', '2021-12-27 16:21:16'),
(34, '23800158800815', '0000-0000-0000-0000', 17, 1, '2021-12-27 16:26:23', '2021-12-27 16:26:23'),
(35, '23800316560409', '0000-0000-0000-0000', 19, 1, '2021-12-28 14:46:19', '2021-12-28 14:46:19'),
(36, '23800336898802', '0000-0000-0000-0000', 20, 1, '2021-12-29 11:00:15', '2021-12-29 11:00:15'),
(37, '23800305628297', '0000-0000-0000-0000', 20, 1, '2021-12-29 12:40:06', '2021-12-29 12:40:06'),
(38, '23900002875880', '0000-0000-0000-0000', 20, 1, '2021-12-29 13:26:28', '2021-12-29 13:26:28'),
(39, '23800186283452', '0000-0000-0000-0000', 20, 1, '2021-12-29 13:45:43', '2021-12-29 13:45:43'),
(40, '23900002875880', '0000-0000-0000-0000', 21, 1, '2021-12-29 15:23:16', '2021-12-29 15:23:16'),
(41, '23800158941031', '0000-0000-0000-0000', 21, 1, '2021-12-31 01:29:57', '2021-12-31 01:29:57'),
(42, '23800156207575', '0000-0000-0000-0000', 21, 1, '2021-12-31 03:57:16', '2021-12-31 03:57:16'),
(43, '23800158946081', '0000-0000-0000-0000', 21, 1, '2021-12-31 03:58:00', '2021-12-31 03:58:00');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forfaits`
--

CREATE TABLE `forfaits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forfaits`
--

INSERT INTO `forfaits` (`id`, `code`, `libelle`, `photo_url`, `description`, `prix`, `active`, `created_at`, `updated_at`) VALUES
(1, 'STR', 'START', 'http://localhost:8000/forfaits/48001.jpeg', 'Entrez dans l’univers de la fibre optique\r\n\r\n10 Mb/s\r\n\r\nINTERNET TRÈS HAUT DÉBIT ILLIMITÉ\r\n\r\n• Surf, email\r\n• Réseaux sociaux, chat\r\n• Streaming vidéo\r\n• Appel vidéo', 25000, 1, '2021-08-19 13:19:16', '2021-08-19 13:39:38'),
(2, 'PRM', 'PREMIUM', 'http://localhost:8000/forfaits/13543.jpeg', 'Le meilleur et le plus puissant de l\'internet en fibre optique\r\n\r\n50 Mb/s\r\n\r\nINTERNET TRÈS HAUT DÉBIT ILLIMITÉ\r\n\r\n• Jusqu\'à 15 écrans connectés en simultané sans ralentissement\r\n• Streaming vidéo Ultra Haute Définition (4K)\r\n• Envoi de fichiers volumineux et téléchargements ultra-rapides\r\n• Diffusion de vidéos en temps réel en HD\r\n• Expérience optimale pour les jeux en ligne et la visio-conférence\r\n• Compatible avec la vidéo-surveillance et l\'internet des objets', 45000, 1, '2021-08-19 13:34:05', '2021-08-19 13:40:58'),
(3, 'FUN', 'SIMPLE', 'http://localhost:8000/forfaits/39453.jpeg', 'Entrez dans l’univers de la fibre optique\r\n\r\n10 Mb/s\r\n\r\nINTERNET TRÈS HAUT DÉBIT ILLIMITÉ\r\n\r\n• Surf, email\r\n• Réseaux sociaux, chat\r\n• Streaming vidéo\r\n• Appel vidéo\r\n• Installation offerte (réalisé par un installateur agrée)', 30000, 0, '2021-08-19 13:36:21', '2021-08-19 13:41:10');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_17_133642_create_categories_table', 1),
(5, '2021_08_17_133710_create_chaines_table', 1),
(6, '2021_08_17_133729_create_offres_table', 1),
(7, '2021_08_17_133752_create_options_table', 1),
(8, '2021_08_17_133812_create_publicites_table', 1),
(9, '2021_08_17_133904_create_forfaits_table', 1),
(10, '2021_08_17_133924_create_reabonnements_table', 1),
(11, '2021_08_17_133945_create_reclamations_table', 1),
(12, '2021_08_17_134201_create_tickets_table', 1),
(13, '2021_08_17_134218_create_mouchards_table', 1),
(14, '2021_08_17_134316_create_notifications_table', 1),
(15, '2021_08_17_134336_create_decodeurs_table', 1),
(16, '2021_08_17_134410_create_box_canals_table', 1),
(17, '2021_08_17_134427_create_paiements_table', 1),
(18, '2021_08_17_141705_create_chaine_offres_table', 1),
(19, '2021_08_17_141725_create_option_offres_table', 1),
(20, '2021_08_17_152833_create_compte_marchands_table', 1),
(21, '2021_09_07_225647_add_api_token_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mouchards`
--

CREATE TABLE `mouchards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mouchards`
--

INSERT INTO `mouchards` (`id`, `couleur`, `titre`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter le tableau de bord ROOT à la date du jeudi 19 août 2021 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-18 23:17:09', '2021-08-18 23:17:09'),
(2, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter le tableau de bord ROOT à la date du jeudi 19 août 2021 à 00:27:53 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-18 23:27:53', '2021-08-18 23:27:53'),
(3, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 19 août 2021 à 00:34:23 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-18 23:34:23', '2021-08-18 23:34:23'),
(4, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord ROOT à la date du jeudi 19 août 2021 à 18:31:31 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-19 17:31:31', '2021-08-19 17:31:31'),
(5, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 19 août 2021 à 18:32:26 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-19 17:32:26', '2021-08-19 17:32:26'),
(6, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 19 août 2021 à 19:15:57 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-19 18:15:57', '2021-08-19 18:15:57'),
(7, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 19 août 2021 à 19:35:48 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-19 18:35:48', '2021-08-19 18:35:48'),
(8, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 20 août 2021 à 13:08:15 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-20 12:08:15', '2021-08-20 12:08:15'),
(9, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 20 août 2021 à 13:32:01 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-20 12:32:01', '2021-08-20 12:32:01'),
(10, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 20 août 2021 à 22:35:09 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-20 21:35:09', '2021-08-20 21:35:09'),
(11, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 20 août 2021 à 22:36:29 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-20 21:36:29', '2021-08-20 21:36:29'),
(12, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du dimanche 22 août 2021 à 20:29:47 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-22 19:29:47', '2021-08-22 19:29:47'),
(13, 'info', 'Consultation Profil ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son profil ROOT à la date du lundi 23 août 2021 à 23:43:31 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-23 22:43:31', '2021-08-23 22:43:31'),
(14, 'info', 'Consultation Profil ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son profil ROOT à la date du mardi 24 août 2021 à 00:03:55 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-23 23:03:55', '2021-08-23 23:03:55'),
(15, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 10:03:02 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 09:03:02', '2021-08-24 09:03:02'),
(16, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 10:45:10 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 09:45:10', '2021-08-24 09:45:10'),
(17, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 13:36:02 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 12:36:02', '2021-08-24 12:36:02'),
(18, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 16:15:28 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 15:15:29', '2021-08-24 15:15:29'),
(19, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 22:24:12 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 21:24:12', '2021-08-24 21:24:12'),
(20, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Aristide MEBODO a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 23:14:54 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 22:14:54', '2021-08-24 22:14:54'),
(21, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 24 août 2021 à 23:15:38 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 22:15:38', '2021-08-24 22:15:38'),
(22, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 25 août 2021 à 00:46:36 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 23:46:36', '2021-08-24 23:46:36'),
(23, 'info', 'Erreur Modification Profil ADMIN', 'L\'utilisateur nommé Ivan OKOUNA a tenté de modifier son profil ADMIN à la date du mercredi 25 août 2021 à 00:58:50 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-24 23:58:50', '2021-08-24 23:58:50'),
(24, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé Arsène HAND a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 01:26:46 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 00:26:46', '2021-08-25 00:26:46'),
(25, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé Arsène HAND a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 01:26:55 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 00:26:55', '2021-08-25 00:26:55'),
(26, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé Arsène HAND a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 01:26:59 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 00:26:59', '2021-08-25 00:26:59'),
(27, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé Arsène HAND a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 01:29:57 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 00:29:57', '2021-08-25 00:29:57'),
(28, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé SAVOURI Hydes a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 15:19:20 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:19:20', '2021-08-25 14:19:20'),
(29, 'info', 'Erreur Modification Profil OPERATEUR', 'L\'utilisateur nommé SAVOURI Hydes a tenté de modifier son profil OPERATEUR à la date du mercredi 25 août 2021 à 15:21:03 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:21:03', '2021-08-25 14:21:03'),
(30, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 25 août 2021 à 15:21:43 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:21:43', '2021-08-25 14:21:43'),
(31, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:28:18 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:28:18', '2021-08-25 14:28:18'),
(32, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:30:39 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:30:39', '2021-08-25 14:30:39'),
(33, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:32:18 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:32:18', '2021-08-25 14:32:18'),
(34, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:34:03 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:34:03', '2021-08-25 14:34:03'),
(35, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:35:17 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:35:17', '2021-08-25 14:35:17'),
(36, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:35:29 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:35:29', '2021-08-25 14:35:29'),
(37, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:41:11 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:41:11', '2021-08-25 14:41:11'),
(38, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé SAVOURI Hydes a consulter son tableau de bord CLIENT à la date du mercredi 25 août 2021 à 15:56:57 avec l\'adresse IP suivante (client) : 127.0.0.1.', 1, '2021-08-25 14:56:57', '2021-08-25 14:56:57'),
(39, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 6 octobre 2021 à 11:50:07 avec l\'adresse IP suivante (client) : 160.119.178.197.', 1, '2021-10-06 11:50:07', '2021-10-06 11:50:07'),
(40, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 7 octobre 2021 à 13:21:20 avec l\'adresse IP suivante (client) : 160.119.178.197.', 1, '2021-10-07 13:21:20', '2021-10-07 13:21:20'),
(41, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 11:08:38 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 11:08:38', '2021-10-08 11:08:38'),
(42, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 11:11:24 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 11:11:24', '2021-10-08 11:11:24'),
(43, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 12:27:14 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 12:27:14', '2021-10-08 12:27:14'),
(44, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 12:28:03 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 12:28:03', '2021-10-08 12:28:03'),
(45, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 12:28:15 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 12:28:15', '2021-10-08 12:28:15'),
(46, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 12:29:21 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 12:29:21', '2021-10-08 12:29:21'),
(47, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 12:29:34 avec l\'adresse IP suivante (client) : 160.119.188.19.', 1, '2021-10-08 12:29:34', '2021-10-08 12:29:34'),
(48, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 8 octobre 2021 à 14:22:08 avec l\'adresse IP suivante (client) : 154.0.186.177.', 1, '2021-10-08 14:22:08', '2021-10-08 14:22:08'),
(49, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du samedi 9 octobre 2021 à 12:22:01 avec l\'adresse IP suivante (client) : 160.119.178.197.', 1, '2021-10-09 12:22:01', '2021-10-09 12:22:01'),
(50, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 13 octobre 2021 à 07:22:38 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-13 07:22:38', '2021-10-13 07:22:38'),
(51, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 13 octobre 2021 à 07:45:38 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-13 07:45:38', '2021-10-13 07:45:38'),
(52, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 13 octobre 2021 à 07:47:25 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-13 07:47:25', '2021-10-13 07:47:25'),
(53, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 00:16:51 avec l\'adresse IP suivante (client) : 160.119.178.197.', 1, '2021-10-14 00:16:51', '2021-10-14 00:16:51'),
(54, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 16:42:39 avec l\'adresse IP suivante (client) : 41.158.220.2.', 1, '2021-10-14 16:42:39', '2021-10-14 16:42:39'),
(55, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 18:59:42 avec l\'adresse IP suivante (client) : 41.158.220.2.', 1, '2021-10-14 18:59:42', '2021-10-14 18:59:42'),
(56, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 18:59:56 avec l\'adresse IP suivante (client) : 41.158.220.2.', 1, '2021-10-14 18:59:56', '2021-10-14 18:59:56'),
(57, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 20:48:43 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-14 20:48:43', '2021-10-14 20:48:43'),
(58, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 20:54:17 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-14 20:54:17', '2021-10-14 20:54:17'),
(59, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 14 octobre 2021 à 21:04:25 avec l\'adresse IP suivante (client) : 102.142.60.74.', 1, '2021-10-14 21:04:25', '2021-10-14 21:04:25'),
(60, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 15 octobre 2021 à 09:41:42 avec l\'adresse IP suivante (client) : 160.119.188.153.', 1, '2021-10-15 09:41:42', '2021-10-15 09:41:42'),
(61, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 20 octobre 2021 à 13:33:10 avec l\'adresse IP suivante (client) : 160.119.190.31.', 1, '2021-10-20 13:33:10', '2021-10-20 13:33:10'),
(62, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 28 octobre 2021 à 12:28:49 avec l\'adresse IP suivante (client) : 160.119.176.96.', 1, '2021-10-28 12:28:49', '2021-10-28 12:28:49'),
(63, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du lundi 1er novembre 2021 à 21:46:33 avec l\'adresse IP suivante (client) : 160.119.182.166.', 1, '2021-11-01 21:46:33', '2021-11-01 21:46:33'),
(64, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Nino MPONDO a consulter son tableau de bord ROOT à la date du lundi 1er novembre 2021 à 22:40:36 avec l\'adresse IP suivante (client) : 102.142.171.22.', 1, '2021-11-01 22:40:36', '2021-11-01 22:40:36'),
(65, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Nino MPONDO a consulter son tableau de bord ROOT à la date du lundi 1er novembre 2021 à 22:41:15 avec l\'adresse IP suivante (client) : 102.142.171.22.', 1, '2021-11-01 22:41:15', '2021-11-01 22:41:15'),
(66, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Nino MPONDO a consulter son tableau de bord ROOT à la date du lundi 1er novembre 2021 à 22:41:18 avec l\'adresse IP suivante (client) : 102.142.171.22.', 1, '2021-11-01 22:41:18', '2021-11-01 22:41:18'),
(67, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 10 novembre 2021 à 20:10:59 avec l\'adresse IP suivante (client) : 160.119.177.165.', 1, '2021-11-10 20:10:59', '2021-11-10 20:10:59'),
(68, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 11 novembre 2021 à 11:03:59 avec l\'adresse IP suivante (client) : 160.119.177.165.', 1, '2021-11-11 11:03:59', '2021-11-11 11:03:59'),
(69, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 12 novembre 2021 à 02:18:43 avec l\'adresse IP suivante (client) : 160.119.177.165.', 1, '2021-11-12 02:18:43', '2021-11-12 02:18:43'),
(70, 'info', 'Consultation Dashboard CLIENT', 'L\'utilisateur nommé Léo Martin DUBOIS a consulter son tableau de bord CLIENT à la date du vendredi 12 novembre 2021 à 02:22:14 avec l\'adresse IP suivante (client) : 160.119.177.165.', 1, '2021-11-12 02:22:14', '2021-11-12 02:22:14'),
(71, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 12 novembre 2021 à 06:53:34 avec l\'adresse IP suivante (client) : 160.119.177.165.', 1, '2021-11-12 06:53:34', '2021-11-12 06:53:34'),
(72, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 12 novembre 2021 à 09:47:48 avec l\'adresse IP suivante (client) : 160.119.186.253.', 1, '2021-11-12 09:47:48', '2021-11-12 09:47:48'),
(73, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 12 novembre 2021 à 11:12:40 avec l\'adresse IP suivante (client) : 154.0.186.183.', 1, '2021-11-12 11:12:40', '2021-11-12 11:12:40'),
(74, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 19 novembre 2021 à 14:00:21 avec l\'adresse IP suivante (client) : 102.142.87.58.', 1, '2021-11-19 14:00:21', '2021-11-19 14:00:21'),
(75, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du vendredi 19 novembre 2021 à 23:33:16 avec l\'adresse IP suivante (client) : 102.142.87.58.', 1, '2021-11-19 23:33:16', '2021-11-19 23:33:16'),
(76, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 25 novembre 2021 à 14:28:37 avec l\'adresse IP suivante (client) : 160.119.179.16.', 1, '2021-11-25 14:28:37', '2021-11-25 14:28:37'),
(77, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 8 décembre 2021 à 13:30:36 avec l\'adresse IP suivante (client) : 102.142.158.165.', 1, '2021-12-08 13:30:36', '2021-12-08 13:30:36'),
(78, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 8 décembre 2021 à 14:53:08 avec l\'adresse IP suivante (client) : 102.142.158.165.', 1, '2021-12-08 14:53:08', '2021-12-08 14:53:08'),
(79, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 8 décembre 2021 à 15:25:03 avec l\'adresse IP suivante (client) : 102.142.158.165.', 1, '2021-12-08 15:25:03', '2021-12-08 15:25:03'),
(80, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 9 décembre 2021 à 01:53:28 avec l\'adresse IP suivante (client) : 102.142.158.165.', 1, '2021-12-09 01:53:28', '2021-12-09 01:53:28'),
(81, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 9 décembre 2021 à 11:41:40 avec l\'adresse IP suivante (client) : 102.142.158.165.', 1, '2021-12-09 11:41:40', '2021-12-09 11:41:40'),
(82, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mardi 14 décembre 2021 à 17:47:54 avec l\'adresse IP suivante (client) : 160.119.189.173.', 1, '2021-12-14 17:47:54', '2021-12-14 17:47:54'),
(83, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 22 décembre 2021 à 11:00:27 avec l\'adresse IP suivante (client) : 160.119.191.178.', 1, '2021-12-22 11:00:27', '2021-12-22 11:00:27'),
(84, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du mercredi 29 décembre 2021 à 02:02:21 avec l\'adresse IP suivante (client) : 160.119.178.13.', 1, '2021-12-29 02:02:21', '2021-12-29 02:02:21'),
(85, 'info', 'Consultation Dashboard ROOT', 'L\'utilisateur nommé Yannick ABOH a consulter son tableau de bord ROOT à la date du jeudi 30 décembre 2021 à 21:40:57 avec l\'adresse IP suivante (client) : 160.119.178.13.', 1, '2021-12-30 21:40:57', '2021-12-30 21:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lecture` int(11) NOT NULL DEFAULT 0,
  `expediteur` int(11) DEFAULT NULL,
  `destinataire` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `couleur`, `objet`, `message`, `lecture`, `expediteur`, `destinataire`, `active`, `created_at`, `updated_at`) VALUES
(1, 'primary', 'Alerte abonnement', 'Cher client, votre abonnement prendra fin d\'ici une semaine alors veuillez vous réabonner dès que possible !', 0, 1, 1, 1, '2021-08-19 17:12:00', '2021-08-19 17:12:00'),
(2, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                            \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                            \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-21 01:27:51', '2021-11-21 01:27:51'),
(3, 'green', 'Satelis+ | Nouvelle réclamation', 'Cher client, \n Votre réclamation a été prise en compte et un opérateur vous rappellera pour vous notifier une fois votre requête traitée !', 0, 1, 10, 1, '2021-11-21 13:16:59', '2021-11-21 13:16:59'),
(4, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-21 15:20:37', '2021-11-21 15:20:37'),
(5, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-21 15:20:58', '2021-11-21 15:20:58'),
(6, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 11, 1, '2021-11-21 17:40:30', '2021-11-21 17:40:30'),
(7, 'green', 'SATELIS+ | Nouveau décodeur', 'Bienvenue sur SATELIS+, \nVotre décodeur a été certifié et sauvegardé avec succès !', 0, 1, 11, 1, '2021-11-21 17:44:16', '2021-11-21 17:44:16'),
(8, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 11, 1, '2021-11-21 17:48:06', '2021-11-21 17:48:06'),
(9, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                            \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                            \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 11, 1, '2021-11-21 17:48:56', '2021-11-21 17:48:56'),
(10, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-23 13:29:58', '2021-11-23 13:29:58'),
(11, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                            \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                            \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-23 13:30:51', '2021-11-23 13:30:51'),
(12, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 02:48:50', '2021-11-24 02:48:50'),
(13, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 02:49:56', '2021-11-24 02:49:56'),
(14, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 03:35:13', '2021-11-24 03:35:13'),
(15, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 03:35:48', '2021-11-24 03:35:48'),
(16, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 03:51:14', '2021-11-24 03:51:14'),
(17, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 12:38:06', '2021-11-24 12:38:06'),
(18, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 16:19:45', '2021-11-24 16:19:45'),
(19, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 16:48:53', '2021-11-24 16:48:53'),
(20, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 16:51:52', '2021-11-24 16:51:52'),
(21, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 17:05:42', '2021-11-24 17:05:42'),
(22, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 17:31:02', '2021-11-24 17:31:02'),
(23, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 17:34:40', '2021-11-24 17:34:40'),
(24, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 17:38:33', '2021-11-24 17:38:33'),
(25, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 17:42:03', '2021-11-24 17:42:03'),
(26, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-24 18:10:36', '2021-11-24 18:10:36'),
(27, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 00:33:40', '2021-11-25 00:33:40'),
(28, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 00:35:32', '2021-11-25 00:35:32'),
(29, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 00:51:22', '2021-11-25 00:51:22'),
(30, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 01:01:03', '2021-11-25 01:01:03'),
(31, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 01:22:45', '2021-11-25 01:22:45'),
(32, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 01:26:19', '2021-11-25 01:26:19'),
(33, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 01:50:58', '2021-11-25 01:50:58'),
(34, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 01:55:59', '2021-11-25 01:55:59'),
(35, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 02:03:17', '2021-11-25 02:03:17'),
(36, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 02:06:37', '2021-11-25 02:06:37'),
(37, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 02:12:18', '2021-11-25 02:12:18'),
(38, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 02:21:44', '2021-11-25 02:21:44'),
(39, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 02:41:44', '2021-11-25 02:41:44'),
(40, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 03:02:07', '2021-11-25 03:02:07'),
(41, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 03:13:34', '2021-11-25 03:13:34'),
(42, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 03:20:34', '2021-11-25 03:20:34'),
(43, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:00:59', '2021-11-25 04:00:59'),
(44, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:02:03', '2021-11-25 04:02:03'),
(45, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:09:05', '2021-11-25 04:09:05'),
(46, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:11:36', '2021-11-25 04:11:36'),
(47, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:14:32', '2021-11-25 04:14:32'),
(48, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:16:23', '2021-11-25 04:16:23'),
(49, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 04:29:44', '2021-11-25 04:29:44'),
(50, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 04:29:49', '2021-11-25 04:29:49'),
(51, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:31:41', '2021-11-25 04:31:41'),
(52, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:35:42', '2021-11-25 04:35:42'),
(53, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:40:08', '2021-11-25 04:40:08'),
(54, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:45:18', '2021-11-25 04:45:18'),
(55, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:49:01', '2021-11-25 04:49:01'),
(56, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:51:42', '2021-11-25 04:51:42'),
(57, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 04:52:15', '2021-11-25 04:52:15'),
(58, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:12:25', '2021-11-25 22:12:25'),
(59, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:13:51', '2021-11-25 22:13:51'),
(60, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:16:41', '2021-11-25 22:16:41'),
(61, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:17:52', '2021-11-25 22:17:52'),
(62, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:18:24', '2021-11-25 22:18:24'),
(63, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:19:51', '2021-11-25 22:19:51'),
(64, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:25:02', '2021-11-25 22:25:02'),
(65, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:25:45', '2021-11-25 22:25:45'),
(66, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:26:07', '2021-11-25 22:26:07'),
(67, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:26:47', '2021-11-25 22:26:47'),
(68, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:27:52', '2021-11-25 22:27:52'),
(69, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:28:20', '2021-11-25 22:28:20'),
(70, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:29:54', '2021-11-25 22:29:54'),
(71, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:30:22', '2021-11-25 22:30:22'),
(72, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:30:51', '2021-11-25 22:30:51'),
(73, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:33:31', '2021-11-25 22:33:31'),
(74, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:35:43', '2021-11-25 22:35:43'),
(75, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 22:51:22', '2021-11-25 22:51:22'),
(76, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 22:55:57', '2021-11-25 22:55:57'),
(77, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 23:02:52', '2021-11-25 23:02:52'),
(78, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:04:13', '2021-11-25 23:04:13'),
(79, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:04:59', '2021-11-25 23:04:59'),
(80, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:04:59', '2021-11-25 23:04:59'),
(81, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:05:04', '2021-11-25 23:05:04'),
(82, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:05:39', '2021-11-25 23:05:39'),
(83, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:05:45', '2021-11-25 23:05:45'),
(84, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:05:55', '2021-11-25 23:05:55'),
(85, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:06:06', '2021-11-25 23:06:06'),
(86, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 23:16:07', '2021-11-25 23:16:07'),
(87, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:17:59', '2021-11-25 23:17:59'),
(88, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:20:05', '2021-11-25 23:20:05'),
(89, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 23:21:48', '2021-11-25 23:21:48'),
(90, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 23:38:44', '2021-11-25 23:38:44'),
(91, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-25 23:50:43', '2021-11-25 23:50:43'),
(92, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:55:37', '2021-11-25 23:55:37'),
(93, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:55:57', '2021-11-25 23:55:57'),
(94, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:56:44', '2021-11-25 23:56:44'),
(95, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:56:49', '2021-11-25 23:56:49'),
(96, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:57:23', '2021-11-25 23:57:23'),
(97, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:57:29', '2021-11-25 23:57:29'),
(98, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:57:39', '2021-11-25 23:57:39'),
(99, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-25 23:57:49', '2021-11-25 23:57:49'),
(100, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 00:02:29', '2021-11-26 00:02:29'),
(101, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-26 00:20:05', '2021-11-26 00:20:05'),
(102, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 00:37:29', '2021-11-26 00:37:29'),
(103, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-26 00:42:28', '2021-11-26 00:42:28'),
(104, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 00:47:02', '2021-11-26 00:47:02'),
(105, 'red', 'Satelis+ | Echec paiement', 'Votre paiement n\'a pu aboutir. Veuillez vous assurer de disposer de la provision suffisante et procéder à nouveau à votre réabonnement.', 0, 1, 10, 1, '2021-11-26 00:49:05', '2021-11-26 00:49:05'),
(106, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 00:53:59', '2021-11-26 00:53:59'),
(107, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:03:55', '2021-11-26 01:03:55'),
(108, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:14:10', '2021-11-26 01:14:10'),
(109, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:31:10', '2021-11-26 01:31:10'),
(110, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:34:00', '2021-11-26 01:34:00'),
(111, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:38:58', '2021-11-26 01:38:58'),
(112, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:45:33', '2021-11-26 01:45:33'),
(113, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 01:51:49', '2021-11-26 01:51:49'),
(114, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:01:12', '2021-11-26 02:01:12'),
(115, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:05:16', '2021-11-26 02:05:16'),
(116, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:06:15', '2021-11-26 02:06:15'),
(117, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:07:05', '2021-11-26 02:07:05'),
(118, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:08:15', '2021-11-26 02:08:15'),
(119, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:10:12', '2021-11-26 02:10:12'),
(120, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:14:20', '2021-11-26 02:14:20'),
(121, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:16:15', '2021-11-26 02:16:15');
INSERT INTO `notifications` (`id`, `couleur`, `objet`, `message`, `lecture`, `expediteur`, `destinataire`, `active`, `created_at`, `updated_at`) VALUES
(122, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:22:20', '2021-11-26 02:22:20'),
(123, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:35:22', '2021-11-26 02:35:22'),
(124, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:38:45', '2021-11-26 02:38:45'),
(125, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:41:21', '2021-11-26 02:41:21'),
(126, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:42:09', '2021-11-26 02:42:09'),
(127, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 02:43:08', '2021-11-26 02:43:08'),
(128, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 03:20:33', '2021-11-26 03:20:33'),
(129, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 03:23:22', '2021-11-26 03:23:22'),
(130, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 03:26:39', '2021-11-26 03:26:39'),
(131, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 03:29:03', '2021-11-26 03:29:03'),
(132, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 03:41:54', '2021-11-26 03:41:54'),
(133, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 04:02:10', '2021-11-26 04:02:10'),
(134, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-11-26 04:07:26', '2021-11-26 04:07:26'),
(135, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 11:47:48', '2021-12-01 11:47:48'),
(136, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 12:22:11', '2021-12-01 12:22:11'),
(137, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 12:23:44', '2021-12-01 12:23:44'),
(138, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 12:45:03', '2021-12-01 12:45:03'),
(139, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 12:47:15', '2021-12-01 12:47:15'),
(140, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-01 12:49:22', '2021-12-01 12:49:22'),
(141, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-02 12:50:11', '2021-12-02 12:50:11'),
(142, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-03 04:30:16', '2021-12-03 04:30:16'),
(143, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 13:59:21', '2021-12-09 13:59:21'),
(144, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:00:40', '2021-12-09 14:00:40'),
(145, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:09:03', '2021-12-09 14:09:03'),
(146, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:27:42', '2021-12-09 14:27:42'),
(147, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:43:02', '2021-12-09 14:43:02'),
(148, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:45:43', '2021-12-09 14:45:43'),
(149, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:50:16', '2021-12-09 14:50:16'),
(150, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:52:07', '2021-12-09 14:52:07'),
(151, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-09 14:54:01', '2021-12-09 14:54:01'),
(152, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 12, 1, '2021-12-09 15:58:33', '2021-12-09 15:58:33'),
(153, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:06:28', '2021-12-13 01:06:28'),
(154, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:12:00', '2021-12-13 01:12:00'),
(155, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:12:48', '2021-12-13 01:12:48'),
(156, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:14:22', '2021-12-13 01:14:22'),
(157, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:15:04', '2021-12-13 01:15:04'),
(158, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:17:00', '2021-12-13 01:17:00'),
(159, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:18:05', '2021-12-13 01:18:05'),
(160, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:25:47', '2021-12-13 01:25:47'),
(161, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:30:16', '2021-12-13 01:30:16'),
(162, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:46:25', '2021-12-13 01:46:25'),
(163, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 01:48:15', '2021-12-13 01:48:15'),
(164, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 04:42:52', '2021-12-13 04:42:52'),
(165, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 04:46:18', '2021-12-13 04:46:18'),
(166, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 04:46:47', '2021-12-13 04:46:47'),
(167, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-13 04:47:21', '2021-12-13 04:47:21'),
(168, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 13, 1, '2021-12-13 04:53:27', '2021-12-13 04:53:27'),
(169, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 14, 1, '2021-12-13 15:18:01', '2021-12-13 15:18:01'),
(170, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 15, 1, '2021-12-13 15:41:08', '2021-12-13 15:41:08'),
(171, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-13 15:43:51', '2021-12-13 15:43:51'),
(172, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-13 16:00:43', '2021-12-13 16:00:43'),
(173, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-13 16:09:49', '2021-12-13 16:09:49'),
(174, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-13 16:12:25', '2021-12-13 16:12:25'),
(175, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 16, 1, '2021-12-14 16:14:33', '2021-12-14 16:14:33'),
(176, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-16 15:12:02', '2021-12-16 15:12:02'),
(177, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-16 15:39:19', '2021-12-16 15:39:19'),
(178, 'green', 'Satelis+ | Succès paiement', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur Mobile Payement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 15, 1, '2021-12-16 15:42:21', '2021-12-16 15:42:21'),
(179, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 10:46:40', '2021-12-22 10:46:40'),
(180, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 10:58:17', '2021-12-22 10:58:17'),
(181, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 11:32:52', '2021-12-22 11:32:52'),
(182, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 11:37:12', '2021-12-22 11:37:12'),
(183, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 11:37:41', '2021-12-22 11:37:41'),
(184, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 11:48:59', '2021-12-22 11:48:59'),
(185, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-22 12:11:13', '2021-12-22 12:11:13'),
(186, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 17, 1, '2021-12-27 15:44:28', '2021-12-27 15:44:28'),
(187, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 15:52:21', '2021-12-27 15:52:21'),
(188, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:01:41', '2021-12-27 16:01:41'),
(189, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:02:44', '2021-12-27 16:02:44'),
(190, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:06:02', '2021-12-27 16:06:02'),
(191, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:20:31', '2021-12-27 16:20:31'),
(192, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:21:17', '2021-12-27 16:21:17'),
(193, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:26:24', '2021-12-27 16:26:24'),
(194, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:33:26', '2021-12-27 16:33:26'),
(195, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:36:06', '2021-12-27 16:36:06'),
(196, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:37:26', '2021-12-27 16:37:26'),
(197, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:38:48', '2021-12-27 16:38:48'),
(198, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:40:26', '2021-12-27 16:40:26'),
(199, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 17, 1, '2021-12-27 16:46:03', '2021-12-27 16:46:03'),
(200, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 10, 1, '2021-12-28 01:58:27', '2021-12-28 01:58:27'),
(201, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 18, 1, '2021-12-28 13:41:03', '2021-12-28 13:41:03'),
(202, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 19, 1, '2021-12-28 14:44:27', '2021-12-28 14:44:27'),
(203, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 14:46:20', '2021-12-28 14:46:20'),
(204, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 14:47:59', '2021-12-28 14:47:59'),
(205, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 14:53:41', '2021-12-28 14:53:41'),
(206, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 15:10:24', '2021-12-28 15:10:24'),
(207, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 15:17:59', '2021-12-28 15:17:59'),
(208, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 15:35:54', '2021-12-28 15:35:54'),
(209, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-28 15:36:29', '2021-12-28 15:36:29'),
(210, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 19, 1, '2021-12-29 04:09:07', '2021-12-29 04:09:07'),
(211, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 20, 1, '2021-12-29 10:58:08', '2021-12-29 10:58:08'),
(212, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 11:00:16', '2021-12-29 11:00:16'),
(213, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 11:25:15', '2021-12-29 11:25:15'),
(214, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 11:28:36', '2021-12-29 11:28:36'),
(215, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 11:28:53', '2021-12-29 11:28:53'),
(216, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 11:54:56', '2021-12-29 11:54:56'),
(217, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 12:04:08', '2021-12-29 12:04:08'),
(218, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 12:40:07', '2021-12-29 12:40:07'),
(219, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 12:57:56', '2021-12-29 12:57:56'),
(220, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 13:26:29', '2021-12-29 13:26:29'),
(221, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 13:45:44', '2021-12-29 13:45:44'),
(222, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 13:53:45', '2021-12-29 13:53:45'),
(223, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 14:00:16', '2021-12-29 14:00:16'),
(224, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 14:01:12', '2021-12-29 14:01:12'),
(225, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 14:13:39', '2021-12-29 14:13:39'),
(226, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 20, 1, '2021-12-29 14:18:10', '2021-12-29 14:18:10'),
(227, 'green', 'Bienvenue sur SATELIS+', 'Bienvenue sur SATELIS+, \nPar la création de votre compte accéder sans plus tarder à l\'ensemble de nos services de réabonnements et d\'achats en ligne !', 0, 1, 21, 1, '2021-12-29 15:22:01', '2021-12-29 15:22:01'),
(228, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                    \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                    \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-29 15:23:17', '2021-12-29 15:23:17'),
(229, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                          \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                          \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-31 03:48:55', '2021-12-31 03:48:55');
INSERT INTO `notifications` (`id`, `couleur`, `objet`, `message`, `lecture`, `expediteur`, `destinataire`, `active`, `created_at`, `updated_at`) VALUES
(230, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                          \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                          \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-31 03:50:49', '2021-12-31 03:50:49'),
(231, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                          \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                          \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-31 03:56:09', '2021-12-31 03:56:09'),
(232, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                          \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                          \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-31 03:58:55', '2021-12-31 03:58:55'),
(233, 'green', 'Satelis+ | Succès', 'Votre demande est prise en compte et en cours de traitement. Nous vois prions de suivre les instructions suivantes pour en assurer la bonne fin :\n                          \n1. Veuillez valider votre règlement en répondant à la requête de votre opérateur de paiement \n                          \n2. Vérifiez que votre décodeur est allumé et positionné sur une chaîne du bouquet souscrit.', 0, 1, 21, 1, '2021-12-31 04:04:09', '2021-12-31 04:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id`, `code`, `libelle`, `description`, `prix`, `photo_url`, `active`, `created_at`, `updated_at`) VALUES
(1, '37M1AC|ACDD', 'ACCESS', 'Une formule accessible à tous !', 5500, 'http://localhost:8000/photos/40107.png', 1, '2021-08-19 11:35:49', '2021-12-29 02:03:13'),
(2, '37M2EV|EVDD', 'EVASION', 'La formule pour toute la famille !', 10500, 'http://localhost:8000/photos/25020.png', 1, '2021-08-19 11:36:50', '2021-12-29 02:03:32'),
(3, '37M3CP|CPDD', 'ESSENTIEL+', 'Le concentré sport et divertissement', 12500, 'http://localhost:8000/photos/34950.png', 1, '2021-08-19 11:38:05', '2021-12-29 02:03:55'),
(4, '37M5EVP|EVPDD', 'EVASION+', 'La formule la + complète pour toute la famille', 20500, 'http://localhost:8000/photos/29512.png', 1, '2021-08-19 11:38:59', '2021-12-29 02:04:42'),
(5, '37M1AC | ACDD', 'EVATEST+', 'Toujours plus près de vous !', 100, NULL, 1, '2021-08-24 22:42:39', '2021-11-10 20:25:10'),
(6, '37M6TCA|TCADD', 'TOUT CANAL+', 'Toutes les chaînes dans une seule formule !', 40500, NULL, 1, '2021-10-07 13:22:25', '2021-12-29 02:05:06'),
(7, '37M4ACP|ACPDD', 'ACCESS+', 'La formule bon plan', 15500, NULL, 1, '2021-11-10 20:19:14', '2021-12-29 02:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `code`, `libelle`, `prix`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CHR1', 'CHARME+1', 6000, NULL, 1, '2021-08-19 12:38:09', '2021-12-29 02:43:50'),
(2, 'OPT4', 'CHARME 2', 6000, NULL, 0, '2021-08-19 12:40:16', '2021-08-22 23:29:20'),
(3, 'OPT2', 'CHARME 1 ET 2', 6000, NULL, 1, '2021-08-19 12:40:53', '2021-08-22 23:29:08'),
(4, 'CHR0', 'AUCUNE OPTION', 0, NULL, 1, '2021-08-19 12:41:17', '2021-12-30 21:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `option_offres`
--

CREATE TABLE `option_offres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `offre_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reabonnement_id` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operateur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paiements`
--

INSERT INTO `paiements` (`id`, `reabonnement_id`, `montant`, `reference`, `tel_client`, `operateur`, `service`, `code`, `client_id`, `message`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(41, 26, 18000, 'CANALSAT.PAIE.1631038597', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:16:37', '2021-09-07 18:16:37'),
(42, 27, 26000, 'CANALSAT.PAIE.1631038773', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:19:33', '2021-09-07 18:19:33'),
(43, 28, 26000, 'CANALSAT.PAIE.1631039097', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:24:57', '2021-09-07 18:24:57'),
(44, 29, 26000, 'CANALSAT.PAIE.1631039277', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:27:57', '2021-09-07 18:27:57'),
(45, 30, 26000, 'CANALSAT.PAIE.1631039572', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:32:52', '2021-09-07 18:32:52'),
(46, 29, 26000, 'CANALSAT.PAIE.1631039655', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-09-07 18:34:15', '2021-09-07 18:34:15'),
(47, 31, 25000, 'CANALBOX.PAIE.1631042667', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 19:24:27', '2021-09-07 19:24:27'),
(48, 32, 25000, 'CANALBOX.PAIE.1631042799', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 19:26:39', '2021-09-07 19:26:39'),
(49, 32, 45000, 'CANALBOX.PAIE.1631043198', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 19:33:18', '2021-09-07 19:33:18'),
(50, 31, 11000, 'CANALBOX.PAIE.1631050406', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 21:33:26', '2021-09-07 21:33:26'),
(51, 31, 11000, 'CANALBOX.PAIE.1631050431', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 21:33:51', '2021-09-07 21:33:51'),
(52, 32, 11000, 'CANALBOX.PAIE.1631050454', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 21:34:14', '2021-09-07 21:34:14'),
(53, 32, 11000, 'CANALBOX.PAIE.1631050790', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 21:39:50', '2021-09-07 21:39:50'),
(54, 32, 45000, 'CANALBOX.PAIE.1631051219', '074835631', 'AM', 'CanalBox', NULL, 8, NULL, NULL, 0, '2021-09-07 21:46:59', '2021-09-07 21:46:59'),
(55, 33, 5500, 'CANALSAT.PAIE.1633660862', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 03:41:02', '2021-10-08 03:41:02'),
(56, 34, 100, 'CANALSAT.PAIE.1633663487', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 04:24:47', '2021-10-08 04:24:47'),
(57, 34, 100, 'CANALSAT.PAIE.1633663545', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 04:25:45', '2021-10-08 04:25:45'),
(58, 35, 100, 'CANALSAT.PAIE.1633665639', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 05:00:39', '2021-10-08 05:00:39'),
(59, 36, 100, 'CANALSAT.PAIE.1633700251', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 14:37:31', '2021-10-08 14:37:31'),
(60, 37, 100, 'CANALSAT.PAIE.1633700279', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 14:37:59', '2021-10-08 14:37:59'),
(61, 37, 100, 'CANALSAT.PAIE.1633700305', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-08 14:38:25', '2021-10-08 14:38:25'),
(62, 38, 5500, 'CANALSAT.PAIE.1634733572', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-20 13:39:32', '2021-10-20 13:39:32'),
(63, 38, 5500, 'CANALSAT.PAIE.1634733730', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-20 13:42:10', '2021-10-20 13:42:10'),
(64, 38, 5500, 'CANALSAT.PAIE.1634733760', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-10-20 13:42:40', '2021-10-20 13:42:40'),
(65, 55, 5500, 'CANALSAT.PAIE.1636078211', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 03:10:11', '2021-11-05 03:10:11'),
(66, 56, 100, 'CANALSAT.PAIE.1636078381', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 03:13:01', '2021-11-05 03:13:01'),
(67, 57, 100, 'CANALSAT.PAIE.1636078519', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 03:15:19', '2021-11-05 03:15:19'),
(68, 58, 100, 'CANALSAT.PAIE.1636078542', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 03:15:42', '2021-11-05 03:15:42'),
(69, 58, 100, 'CANALSAT.PAIE.1636078557', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 03:15:57', '2021-11-05 03:15:57'),
(70, 59, 5500, 'CANALSAT.PAIE.1636099830', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 09:10:30', '2021-11-05 09:10:30'),
(71, 60, 5500, 'CANALSAT.PAIE.1636101212', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 09:33:32', '2021-11-05 09:33:32'),
(72, 61, 5500, 'CANALSAT.PAIE.1636101244', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 09:34:04', '2021-11-05 09:34:04'),
(73, 62, 5500, 'CANALSAT.PAIE.1636101606', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 09:40:06', '2021-11-05 09:40:06'),
(74, 63, 12500, 'CANALSAT.PAIE.1636103390', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:09:50', '2021-11-05 10:09:50'),
(75, 64, 12500, 'CANALSAT.PAIE.1636104932', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:35:32', '2021-11-05 10:35:32'),
(76, 65, 12500, 'CANALSAT.PAIE.1636104969', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:36:09', '2021-11-05 10:36:09'),
(77, 66, 12500, 'CANALSAT.PAIE.1636105004', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:36:44', '2021-11-05 10:36:44'),
(78, 66, 12500, 'CANALSAT.PAIE.1636105096', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:38:16', '2021-11-05 10:38:16'),
(79, 66, 12500, 'CANALSAT.PAIE.1636105152', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:39:12', '2021-11-05 10:39:12'),
(80, 66, 12500, 'CANALSAT.PAIE.1636105154', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:39:14', '2021-11-05 10:39:14'),
(81, 67, 100, 'CANALSAT.PAIE.1636105229', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-05 10:40:29', '2021-11-05 10:40:29'),
(82, 68, 100, 'CANALSAT.PAIE.1636584905', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-10 23:55:05', '2021-11-10 23:55:05'),
(83, 69, 100, 'CANALSAT.PAIE.1636679238', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 02:07:18', '2021-11-12 02:07:18'),
(84, 70, 100, 'CANALSAT.PAIE.1636679512', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 02:11:52', '2021-11-12 02:11:52'),
(85, 71, 100, 'CANALSAT.PAIE.1636680067', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 02:21:07', '2021-11-12 02:21:07'),
(86, 72, 100, 'CANALSAT.PAIE.1636696734', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 06:58:54', '2021-11-12 06:58:54'),
(87, 73, 40500, 'CANALSAT.PAIE.1636696782', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 06:59:42', '2021-11-12 06:59:42'),
(88, 74, 20500, 'CANALSAT.PAIE.1636696827', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:00:27', '2021-11-12 07:00:27'),
(89, 75, 15500, 'CANALSAT.PAIE.1636696868', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:01:08', '2021-11-12 07:01:08'),
(90, 76, 12500, 'CANALSAT.PAIE.1636696912', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:01:52', '2021-11-12 07:01:52'),
(91, 77, 10500, 'CANALSAT.PAIE.1636696953', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:02:33', '2021-11-12 07:02:33'),
(92, 78, 5500, 'CANALSAT.PAIE.1636697013', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:03:33', '2021-11-12 07:03:33'),
(93, 79, 5500, 'CANALSAT.PAIE.1636697346', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:09:06', '2021-11-12 07:09:06'),
(94, 80, 5500, 'CANALSAT.PAIE.1636698532', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:28:52', '2021-11-12 07:28:52'),
(95, 81, 10500, 'CANALSAT.PAIE.1636698574', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:29:34', '2021-11-12 07:29:34'),
(96, 82, 100, 'CANALSAT.PAIE.1636698868', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:34:28', '2021-11-12 07:34:28'),
(97, 83, 100, 'CANALSAT.PAIE.1636699127', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 07:38:47', '2021-11-12 07:38:47'),
(98, 84, 100, 'CANALSAT.PAIE.1636701343', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 08:15:43', '2021-11-12 08:15:43'),
(99, 85, 100, 'CANALSAT.PAIE.1636706543', '074835631', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-12 09:42:23', '2021-11-12 09:42:23'),
(100, 85, 100, 'CANALSAT.PAIE.1636706613', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-12 09:43:33', '2021-11-12 10:57:42'),
(101, 86, 100, 'CANALSAT.PAIE.1636706784', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-12 09:46:24', '2021-11-12 10:57:51'),
(102, 86, 100, 'CANALSAT.PAIE.1636706801', '074835631', 'AM', 'CanalSat', '200', 8, 'Success', 'PAIEMENT OK !', 1, '2021-11-12 09:46:41', '2021-11-12 09:47:06'),
(103, 88, 100, 'CANALSAT.PAIE.1636710481', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-12 10:48:01', '2021-11-12 11:58:55'),
(104, 90, 100, 'CANALSAT.PAIE.1636711180', '077002872', 'AM', 'CanalSat', '200', 8, 'Success', 'PAIEMENT OK !', 1, '2021-11-12 10:59:40', '2021-11-12 11:00:06'),
(105, 90, 100, 'CANALSAT.PAIE.1636711249', '077002872', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-12 11:00:49', '2021-11-12 12:55:48'),
(106, 92, 100, 'CANALSAT.PAIE.1636711785', '077002872', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-12 11:09:45', '2021-11-12 12:55:57'),
(107, 93, 100, 'CANALSAT.PAIE.1636711857', '077002872', 'AM', 'CanalSat', '200', 8, 'Success', 'PAIEMENT OK !', 1, '2021-11-12 11:10:57', '2021-11-12 11:11:21'),
(108, 94, 100, 'CANALSAT.PAIE.1636806696', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-13 13:31:36', '2021-11-13 14:57:20'),
(109, 95, 5500, 'CANALSAT.PAIE.1636981822', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-15 14:10:22', '2021-11-15 15:56:24'),
(110, 96, 5500, 'CANALSAT.PAIE.1636982592', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-15 14:23:12', '2021-11-15 15:57:23'),
(111, 97, 100, 'CANALSAT.PAIE.1637106577', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 00:49:37', '2021-11-17 01:57:10'),
(112, 98, 100, 'CANALSAT.PAIE.1637106740', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 00:52:20', '2021-11-17 01:57:15'),
(113, 99, 100, 'CANALSAT.PAIE.1637107048', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 00:57:28', '2021-11-17 02:55:06'),
(114, 100, 100, 'CANALSAT.PAIE.1637107578', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-17 01:06:18', '2021-11-17 01:06:18'),
(115, 101, 100, 'CANALSAT.PAIE.1637107740', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-17 01:09:00', '2021-11-17 01:09:00'),
(116, 102, 100, 'CANALSAT.PAIE.1637149936', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 12:52:16', '2021-11-17 13:57:49'),
(117, 103, 100, 'CANALSAT.PAIE.1637152098', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 13:28:18', '2021-11-17 14:56:27'),
(118, 104, 100, 'CANALSAT.PAIE.1637152276', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-17 13:31:16', '2021-11-17 14:56:42'),
(119, 105, 100, 'CANALSAT.PAIE.1637239718', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-18 13:48:38', '2021-11-18 14:57:32'),
(120, 106, 100, 'CANALSAT.PAIE.1637247092', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-18 15:51:32', '2021-11-18 16:57:49'),
(121, 106, 100, 'CANALSAT.PAIE.1637247172', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-18 15:52:52', '2021-11-18 16:58:04'),
(122, 107, 100, 'CANALSAT.PAIE.1637247216', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-18 15:53:36', '2021-11-18 16:58:09'),
(123, 108, 100, 'CANALSAT.PAIE.1637248187', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-18 16:09:47', '2021-11-18 16:09:47'),
(124, 109, 100, 'CANALSAT.PAIE.1637249105', '24174835639', 'AM', 'CanalSat', NULL, 8, NULL, NULL, 0, '2021-11-18 16:25:05', '2021-11-18 16:25:05'),
(125, 110, 100, 'CANALSAT.PAIE.1637326604', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 13:56:44', '2021-11-19 13:58:08'),
(126, 111, 100, 'CANALSAT.PAIE.1637326915', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-19 14:01:55', '2021-11-19 14:02:21'),
(127, 113, 100, 'CANALSAT.PAIE.1637327424', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-19 14:10:24', '2021-11-19 14:10:51'),
(128, 114, 100, 'CANALSAT.PAIE.1637327912', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 14:18:32', '2021-11-19 14:19:51'),
(129, 115, 100, 'CANALSAT.PAIE.1637328221', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 14:23:41', '2021-11-19 14:24:51'),
(130, 116, 100, 'CANALSAT.PAIE.1637328497', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 14:28:17', '2021-11-19 14:29:54'),
(131, 117, 100, 'CANALSAT.PAIE.1637328796', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 14:33:16', '2021-11-19 14:34:51'),
(132, 118, 100, 'CANALSAT.PAIE.1637361014', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 23:30:14', '2021-11-20 00:57:31'),
(133, 119, 100, 'CANALSAT.PAIE.1637361107', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 23:31:47', '2021-11-20 00:57:36'),
(134, 120, 100, 'CANALSAT.PAIE.1637361247', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-19 23:34:07', '2021-11-20 00:57:55'),
(135, 121, 100, 'BCP.PAIE.1637363150', '074835631', 'AM', 'CanalSat', '0', 8, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:05:50', '2021-11-20 01:55:31'),
(136, 123, 100, 'BCP.PAIE.1637363463', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:11:03', '2021-11-20 01:55:50'),
(137, 124, 100, 'BCP.PAIE.1637363974', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:19:34', '2021-11-20 01:56:16'),
(138, 125, 100, 'BCP.PAIE.1637364201', '074835631', 'AM', 'CanalSat', '0', 5, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:23:21', '2021-11-20 01:56:30'),
(139, 126, 100, 'BCP.PAIE.1637364301', '074835631', 'AM', 'CanalSat', '0', 5, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:25:01', '2021-11-20 01:56:35'),
(140, 127, 100, 'BCP.PAIE.1637364380', '074835631', 'AM', 'CanalSat', '0', 6, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 00:26:20', '2021-11-20 01:56:45'),
(141, 128, 100, 'BCP.PAIE.1637403576', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 11:19:36', '2021-11-20 13:00:38'),
(142, 128, 100, 'CANALSAT.PAIE.1637403765', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 11:22:45', '2021-11-20 11:23:21'),
(143, 129, 100, 'BCP.PAIE.1637417478', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 15:11:18', '2021-11-20 15:11:52'),
(144, 130, 100, 'BCP.PAIE.1637418282', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 15:24:42', '2021-11-20 15:25:06'),
(145, 131, 100, 'BCP.PAIE.1637418560', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 15:29:20', '2021-11-20 15:29:52'),
(146, 132, 100, 'BCP.PAIE.1637421822', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 16:23:42', '2021-11-20 16:24:06'),
(147, 133, 100, 'BCP.PAIE.1637423254', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 16:47:34', '2021-11-20 16:48:06'),
(148, 134, 100, 'BCP.PAIE.1637424802', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-20 17:13:22', '2021-11-20 18:59:14'),
(149, 134, 100, 'BCP.PAIE.1637424824', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-20 17:13:44', '2021-11-20 17:14:07'),
(150, 135, 100, 'BCP.PAIE.1637450875', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-21 00:27:55', '2021-11-21 00:28:21'),
(151, 136, 100, 'BCP.PAIE.1637451088', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-21 00:31:28', '2021-11-21 00:31:52'),
(152, 137, 100, 'BCP.PAIE.1637454436', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-21 01:27:16', '2021-11-21 01:27:51'),
(153, 138, 100, 'BCP.PAIE.1637504430', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-21 15:20:30', '2021-11-21 17:02:03'),
(154, 139, 100, 'BCP.PAIE.1637504452', '07421212', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-21 15:20:52', '2021-11-21 17:02:21'),
(155, 140, 100, 'BCP.PAIE.1637513281', '074835631', 'AM', 'CanalSat', '200', 11, 'Success', 'PAIEMENT OK !', 1, '2021-11-21 17:48:01', '2021-11-21 17:48:56'),
(156, 141, 100, 'BCP.PAIE.1637670592', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-23 13:29:52', '2021-11-23 15:00:14'),
(157, 141, 100, 'BCP.PAIE.1637670615', '074835631', 'AM', 'CanalSat', '200', 10, 'Success', 'PAIEMENT OK !', 1, '2021-11-23 13:30:15', '2021-11-23 13:30:51'),
(158, 142, 100, 'BCP.PAIE.1637718529', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 02:48:49', '2021-11-24 02:48:49'),
(159, 143, 100, 'BCP.PAIE.1637718595', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 02:49:55', '2021-11-24 02:49:55'),
(160, 144, 100, 'BCP.PAIE.1637721307', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-24 03:35:07', '2021-11-24 04:55:25'),
(161, 145, 100, 'BCP.PAIE.1637721347', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 03:35:47', '2021-11-24 03:35:47'),
(162, 146, 100, 'BCP.PAIE.1637722272', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 03:51:12', '2021-11-24 03:51:12'),
(163, 147, 100, 'BCP.PAIE.1637753884', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 12:38:04', '2021-11-24 12:38:04'),
(164, 148, 100, 'BCP.PAIE.1637767184', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 16:19:44', '2021-11-24 16:19:44'),
(165, 149, 100, 'BCP.PAIE.1637768932', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 16:48:52', '2021-11-24 16:48:52'),
(166, 150, 100, 'BCP.PAIE.1637769111', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 16:51:51', '2021-11-24 16:51:51'),
(167, 151, 100, 'BCP.PAIE.1637769941', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 17:05:41', '2021-11-24 17:05:41'),
(168, 152, 100, 'BCP.PAIE.1637771461', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 17:31:01', '2021-11-24 17:31:01'),
(169, 153, 100, 'BCP.PAIE.1637771678', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 17:34:38', '2021-11-24 17:34:38'),
(170, 154, 100, 'BCP.PAIE.1637771911', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 17:38:31', '2021-11-24 17:38:31'),
(171, 155, 100, 'BCP.PAIE.1637772122', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 17:42:02', '2021-11-24 17:42:02'),
(172, 156, 100, 'BCP.PAIE.1637773835', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-24 18:10:35', '2021-11-24 18:10:35'),
(173, 157, 100, 'BCP.PAIE.1637796819', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 00:33:39', '2021-11-25 00:33:39'),
(174, 158, 100, 'BCP.PAIE.1637796931', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 00:35:31', '2021-11-25 00:35:31'),
(175, 159, 100, 'BCP.PAIE.1637797881', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 00:51:21', '2021-11-25 00:51:21'),
(176, 160, 100, 'BCP.PAIE.1637798462', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 01:01:02', '2021-11-25 01:01:02'),
(177, 161, 100, 'BCP.PAIE.1637799764', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 01:22:44', '2021-11-25 01:22:44'),
(178, 162, 100, 'BCP.PAIE.1637799978', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 01:26:18', '2021-11-25 01:26:18'),
(179, 163, 100, 'BCP.PAIE.1637801457', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 01:50:57', '2021-11-25 01:50:57'),
(180, 164, 100, 'BCP.PAIE.1637801757', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 01:55:57', '2021-11-25 01:55:57'),
(181, 165, 100, 'BCP.PAIE.1637802196', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 02:03:16', '2021-11-25 02:03:16'),
(182, 166, 100, 'BCP.PAIE.1637802395', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 02:06:35', '2021-11-25 02:06:35'),
(183, 167, 100, 'BCP.PAIE.1637802736', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 02:12:16', '2021-11-25 02:12:16'),
(184, 168, 100, 'BCP.PAIE.1637803302', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 02:21:42', '2021-11-25 02:21:42'),
(185, 169, 100, 'BCP.PAIE.1637804503', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 02:41:43', '2021-11-25 02:41:43'),
(186, 170, 100, 'BCP.PAIE.1637805726', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 03:02:06', '2021-11-25 03:02:06'),
(187, 171, 100, 'BCP.PAIE.1637806412', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 03:13:32', '2021-11-25 03:13:32'),
(188, 172, 100, 'BCP.PAIE.1637806833', '074212121', 'VM', 'CanalSat', '0', 10, 'Aucune reponse VM', 'PAIEMENT NON OK !', 1, '2021-11-25 03:20:33', '2021-11-25 03:50:05'),
(189, 173, 100, 'BCP.PAIE.1637809257', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:00:57', '2021-11-25 04:00:57'),
(190, 174, 100, 'BCP.PAIE.1637809322', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:02:02', '2021-11-25 04:02:02'),
(191, 175, 100, 'BCP.PAIE.1637809743', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:09:03', '2021-11-25 04:09:03'),
(192, 176, 100, 'BCP.PAIE.1637809895', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:11:35', '2021-11-25 04:11:35'),
(193, 177, 100, 'BCP.PAIE.1637810071', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:14:31', '2021-11-25 04:14:31'),
(194, 178, 100, 'BCP.PAIE.1637810182', '074212121', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-25 04:16:22', '2021-11-25 04:29:49'),
(195, 179, 100, 'BCP.PAIE.1637811100', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:31:40', '2021-11-25 04:31:40'),
(196, 180, 100, 'BCP.PAIE.1637811341', '066682353', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:35:41', '2021-11-25 04:35:41'),
(197, 181, 100, 'BCP.PAIE.1637811607', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:40:07', '2021-11-25 04:40:07'),
(198, 182, 100, 'BCP.PAIE.1637811916', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:45:16', '2021-11-25 04:45:16'),
(199, 183, 100, 'BCP.PAIE.1637812139', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:48:59', '2021-11-25 04:48:59'),
(200, 184, 100, 'BCP.PAIE.1637812300', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:51:40', '2021-11-25 04:51:40'),
(201, 185, 100, 'BCP.PAIE.1637812334', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 04:52:14', '2021-11-25 04:52:14'),
(202, 186, 100, 'BCP.PAIE.1637874739', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:12:19', '2021-11-25 23:55:57'),
(203, 187, 100, 'BCP.PAIE.1637874995', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:16:35', '2021-11-25 23:56:44'),
(204, 188, 100, 'BCP.PAIE.1637875098', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:18:18', '2021-11-25 23:56:49'),
(205, 189, 100, 'BCP.PAIE.1637875496', '074212121', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:24:56', '2021-11-25 23:57:23'),
(206, 190, 100, 'BCP.PAIE.1637875545', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 22:25:45', '2021-11-25 22:25:45'),
(207, 190, 100, 'BCP.PAIE.1637875585', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:26:25', '2021-11-25 23:57:29'),
(208, 191, 100, 'BCP.PAIE.1637875606', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 22:26:46', '2021-11-25 22:26:46'),
(209, 192, 100, 'BCP.PAIE.1637875699', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 22:28:19', '2021-11-25 22:28:19'),
(210, 192, 100, 'BCP.PAIE.1637875738', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:28:58', '2021-11-25 23:57:39'),
(211, 192, 100, 'BCP.PAIE.1637875762', '074835631', 'AM', 'CanalSat', '0', 10, 'Transaction id is invalid', 'PAIEMENT NON OK !', 1, '2021-11-25 22:29:22', '2021-11-25 23:57:49'),
(212, 193, 100, 'BCP.PAIE.1637875793', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-25 22:29:53', '2021-11-25 22:35:43'),
(213, 194, 100, 'BCP.PAIE.1637877081', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-25 22:51:21', '2021-11-25 23:04:59'),
(214, 195, 100, 'BCP.PAIE.1637877771', '074835631', 'VM', 'CanalSat', '0', 10, 'Aucune reponse VM', 'PAIEMENT NON OK !', 1, '2021-11-25 23:02:51', '2021-11-25 23:20:05'),
(215, 196, 100, 'BCP.PAIE.1637878566', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-25 23:16:06', '2021-11-25 23:17:59'),
(216, 197, 100, 'BCP.PAIE.1637878907', '074835631', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 23:21:47', '2021-11-25 23:21:47'),
(217, 198, 100, 'BCP.PAIE.1637879923', '074835631', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-25 23:38:43', '2021-11-25 23:38:43'),
(218, 199, 100, 'BCP.PAIE.1637880642', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-25 23:50:42', '2021-11-25 23:55:37'),
(219, 200, 100, 'BCP.PAIE.1637881348', '074835631', 'VM', 'CanalSat', '0', 10, 'Aucune reponse VM', 'PAIEMENT NON OK !', 1, '2021-11-26 00:02:28', '2021-11-26 00:20:05'),
(220, 201, 100, 'BCP.PAIE.1637883448', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-26 00:37:28', '2021-11-26 00:42:28'),
(221, 202, 100, 'BCP.PAIE.1637884021', '074835631', 'VM', 'CanalSat', '0', 10, 'CANCELED', 'PAIEMENT NON OK !', 1, '2021-11-26 00:47:01', '2021-11-26 00:49:05'),
(222, 203, 100, 'BCP.PAIE.1637884438', '074835631', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 00:53:58', '2021-11-26 00:53:58'),
(223, 204, 100, 'BCP.PAIE.1637885034', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:03:54', '2021-11-26 01:03:54'),
(224, 205, 100, 'BCP.PAIE.1637885649', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, '200', 1, '2021-11-26 01:14:09', '2021-11-26 01:19:18'),
(225, 206, 100, 'BCP.PAIE.1637886669', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:31:09', '2021-11-26 01:31:09'),
(226, 207, 100, 'BCP.PAIE.1637886839', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:33:59', '2021-11-26 01:33:59'),
(227, 208, 100, 'BCP.PAIE.1637887137', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:38:57', '2021-11-26 01:38:57'),
(228, 209, 100, 'BCP.PAIE.1637887532', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:45:32', '2021-11-26 01:45:32'),
(229, 210, 100, 'BCP.PAIE.1637887908', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 01:51:48', '2021-11-26 01:51:48'),
(230, 211, 100, 'BCP.PAIE.1637888471', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:01:11', '2021-11-26 02:01:11'),
(231, 212, 100, 'BCP.PAIE.1637888715', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:05:15', '2021-11-26 02:05:15'),
(232, 213, 100, 'BCP.PAIE.1637888774', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:06:14', '2021-11-26 02:06:14'),
(233, 214, 100, 'BCP.PAIE.1637888824', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:07:04', '2021-11-26 02:07:04'),
(234, 215, 100, 'BCP.PAIE.1637888894', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:08:14', '2021-11-26 02:08:14'),
(235, 216, 100, 'BCP.PAIE.1637889011', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:10:11', '2021-11-26 02:10:11'),
(236, 217, 100, 'BCP.PAIE.1637889259', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:14:19', '2021-11-26 02:14:19'),
(237, 218, 100, 'BCP.PAIE.1637889374', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:16:14', '2021-11-26 02:16:14'),
(238, 219, 100, 'BCP.PAIE.1637889739', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:22:19', '2021-11-26 02:22:19'),
(239, 220, 100, 'BCP.PAIE.1637890521', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:35:21', '2021-11-26 02:35:21'),
(240, 221, 100, 'BCP.PAIE.1637890724', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:38:44', '2021-11-26 02:38:44'),
(241, 222, 100, 'BCP.PAIE.1637890880', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:41:20', '2021-11-26 02:41:20'),
(242, 223, 100, 'BCP.PAIE.1637890928', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:42:08', '2021-11-26 02:42:08'),
(243, 224, 100, 'BCP.PAIE.1637890987', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 02:43:07', '2021-11-26 02:43:07'),
(244, 225, 100, 'BCP.PAIE.1637893232', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 03:20:32', '2021-11-26 03:20:32'),
(245, 226, 100, 'BCP.PAIE.1637893401', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 03:23:21', '2021-11-26 03:23:21'),
(246, 227, 100, 'BCP.PAIE.1637893598', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 03:26:38', '2021-11-26 03:26:38'),
(247, 228, 100, 'BCP.PAIE.1637893743', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 03:29:03', '2021-11-26 03:29:03'),
(248, 229, 100, 'BCP.PAIE.1637894513', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 03:41:53', '2021-11-26 03:41:53'),
(249, 230, 100, 'BCP.PAIE.1637895729', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 04:02:09', '2021-11-26 04:02:09'),
(250, 231, 100, 'BCP.PAIE.1637896045', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-11-26 04:07:25', '2021-11-26 04:07:25'),
(251, 232, 100, 'BCP.PAIE.1638355667', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 11:47:47', '2021-12-01 11:47:47'),
(252, 233, 100, 'BCP.PAIE.1638357730', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 12:22:10', '2021-12-01 12:22:10'),
(253, 234, 100, 'BCP.PAIE.1638357823', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 12:23:43', '2021-12-01 12:23:43'),
(254, 235, 100, 'BCP.PAIE.1638359102', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 12:45:02', '2021-12-01 12:45:02'),
(255, 236, 100, 'BCP.PAIE.1638359234', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 12:47:14', '2021-12-01 12:47:14'),
(256, 237, 100, 'BCP.PAIE.1638359361', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-01 12:49:21', '2021-12-01 12:49:21'),
(257, 238, 100, 'BCP.PAIE.1638445810', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-02 12:50:10', '2021-12-02 12:50:10'),
(258, 239, 100, 'BCP.PAIE.1638502215', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-03 04:30:15', '2021-12-03 04:30:15'),
(259, 240, 5500, 'BCP.PAIE.1639054760', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 13:59:20', '2021-12-09 13:59:20'),
(260, 241, 100, 'BCP.PAIE.1639054839', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:00:39', '2021-12-09 14:00:39'),
(261, 242, 100, 'BCP.PAIE.1639055342', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:09:02', '2021-12-09 14:09:02'),
(262, 243, 100, 'BCP.PAIE.1639056461', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:27:41', '2021-12-09 14:27:41'),
(263, 244, 100, 'BCP.PAIE.1639057381', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:43:01', '2021-12-09 14:43:01'),
(264, 245, 100, 'BCP.PAIE.1639057542', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:45:42', '2021-12-09 14:45:42'),
(265, 246, 100, 'BCP.PAIE.1639057816', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:50:16', '2021-12-09 14:50:16'),
(266, 247, 100, 'BCP.PAIE.1639057926', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:52:06', '2021-12-09 14:52:06'),
(267, 248, 100, 'BCP.PAIE.1639058040', '074212121', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-09 14:54:00', '2021-12-09 14:54:00'),
(268, 249, 100, 'BCP.PAIE.1639353987', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:06:27', '2021-12-13 01:06:27'),
(269, 250, 100, 'BCP.PAIE.1639354320', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:12:00', '2021-12-13 01:12:00'),
(270, 251, 100, 'BCP.PAIE.1639354367', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:12:47', '2021-12-13 01:12:47'),
(271, 252, 100, 'BCP.PAIE.1639354461', '066682353', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:14:21', '2021-12-13 01:14:21'),
(272, 253, 100, 'BCP.PAIE.1639354503', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:15:03', '2021-12-13 01:15:03'),
(273, 254, 100, 'BCP.PAIE.1639354619', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:16:59', '2021-12-13 01:16:59'),
(274, 255, 100, 'BCP.PAIE.1639354684', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:18:04', '2021-12-13 01:18:04'),
(275, 256, 100, 'BCP.PAIE.1639355146', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:25:46', '2021-12-13 01:25:46'),
(276, 257, 100, 'BCP.PAIE.1639355415', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:30:15', '2021-12-13 01:30:15'),
(277, 258, 100, 'BCP.PAIE.1639356384', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:46:24', '2021-12-13 01:46:24'),
(278, 259, 100, 'BCP.PAIE.1639356494', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:48:14', '2021-12-13 01:48:14'),
(279, 259, 259, 'BCP.PAIE.1639356782', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:53:02', '2021-12-13 01:53:02'),
(280, 259, 259, 'BCP.PAIE.1639356942', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:55:42', '2021-12-13 01:55:42'),
(281, 259, 259, 'BCP.PAIE.1639357141', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:59:01', '2021-12-13 01:59:01'),
(282, 259, 259, 'BCP.PAIE.1639357151', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:59:11', '2021-12-13 01:59:11'),
(283, 259, 259, 'BCP.PAIE.1639357160', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:59:20', '2021-12-13 01:59:20'),
(284, 259, 259, 'BCP.PAIE.1639357166', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 01:59:26', '2021-12-13 01:59:26'),
(285, 259, 259, 'BCP.PAIE.1639357661', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 02:07:41', '2021-12-13 02:07:41'),
(286, 259, 259, 'BCP.PAIE.1639357665', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 02:07:45', '2021-12-13 02:07:45'),
(287, 259, 259, 'BCP.PAIE.1639357669', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 02:07:49', '2021-12-13 02:07:49'),
(288, 259, 259, 'BCP.PAIE.1639357867', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 02:11:07', '2021-12-13 02:11:07'),
(289, 259, 259, 'BCP.PAIE.1639358001', '066682353', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 02:13:21', '2021-12-13 02:13:21'),
(290, 260, 100, 'BCP.PAIE.1639366971', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 04:42:51', '2021-12-13 04:42:51'),
(291, 260, 260, 'BCP.PAIE.1639367154', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 04:45:54', '2021-12-13 04:45:54'),
(292, 261, 100, 'BCP.PAIE.1639367177', '074835631', 'MC', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 04:46:17', '2021-12-13 04:46:17'),
(293, 262, 100, 'BCP.PAIE.1639367206', '074835631', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 04:46:46', '2021-12-13 04:46:46'),
(294, 263, 100, 'BCP.PAIE.1639367240', '074835631', 'VM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-13 04:47:20', '2021-12-13 04:47:20'),
(295, 264, 100, 'BCP.PAIE.1639406630', '074565656', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-13 15:43:50', '2021-12-13 15:43:50'),
(296, 265, 100, 'BCP.PAIE.1639407642', '074565656', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-13 16:00:42', '2021-12-13 16:00:42'),
(297, 266, 100, 'BCP.PAIE.1639408188', '074565656', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-13 16:09:48', '2021-12-13 16:09:48'),
(298, 267, 100, 'BCP.PAIE.1639408344', '074565656', 'VM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-13 16:12:24', '2021-12-13 16:12:24'),
(299, 267, 267, 'BCP.PAIE.1639408424', '074565656', 'VM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-13 16:13:44', '2021-12-13 16:13:44'),
(300, 268, 100, 'BCP.PAIE.1639663921', '074835631', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-16 15:12:01', '2021-12-16 15:12:01'),
(301, 269, 100, 'BCP.PAIE.1639665558', '074565656', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-16 15:39:18', '2021-12-16 15:39:18'),
(302, 270, 100, 'BCP.PAIE.1639665740', '074565656', 'AM', 'CanalSat', NULL, 15, NULL, NULL, 0, '2021-12-16 15:42:20', '2021-12-16 15:42:20'),
(303, 271, 100, 'BCP.PAIE.1640166399', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 10:46:39', '2021-12-22 10:46:39'),
(304, 272, 100, 'BCP.PAIE.1640167096', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 10:58:16', '2021-12-22 10:58:16'),
(305, 273, 5500, 'BCP.PAIE.1640169171', '074835631', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:32:51', '2021-12-22 11:32:51'),
(306, 275, 11500, 'BCP.PAIE.1640169431', '074212121', NULL, 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:37:11', '2021-12-22 11:37:11'),
(307, 276, 5500, 'BCP.PAIE.1640169460', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:37:40', '2021-12-22 11:37:40'),
(308, 276, 276, 'BCP.PAIE.1640169786', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:43:06', '2021-12-22 11:43:06'),
(309, 276, 276, 'BCP.PAIE.1640170114', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:48:34', '2021-12-22 11:48:34'),
(310, 277, 5500, 'BCP.PAIE.1640170138', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 11:48:58', '2021-12-22 11:48:58'),
(311, 278, 40500, 'BCP.PAIE.1640171472', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 12:11:12', '2021-12-22 12:11:12'),
(312, 278, 40500, 'BCP.PAIE.1640171501', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 12:11:41', '2021-12-22 12:11:41'),
(313, 278, 40500, 'BCP.PAIE.1640171506', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 12:11:46', '2021-12-22 12:11:46'),
(314, 278, 40500, 'BCP.PAIE.1640171510', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-22 12:11:50', '2021-12-22 12:11:50'),
(315, 279, 5500, 'BCP.PAIE.1640616740', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 15:52:20', '2021-12-27 15:52:20'),
(316, 279, 5500, 'BCP.PAIE.1640616861', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 15:54:21', '2021-12-27 15:54:21'),
(317, 280, 5500, 'BCP.PAIE.1640617300', '074333333', 'MC', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:01:40', '2021-12-27 16:01:40'),
(318, 281, 5500, 'BCP.PAIE.1640617363', '074333333', 'VM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:02:43', '2021-12-27 16:02:43'),
(319, 282, 5500, 'BCP.PAIE.1640617561', '074333333', 'VM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:06:01', '2021-12-27 16:06:01'),
(320, 283, 5500, 'BCP.PAIE.1640618430', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:20:30', '2021-12-27 16:20:30'),
(321, 284, 20500, 'BCP.PAIE.1640618476', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:21:16', '2021-12-27 16:21:16'),
(322, 285, 10500, 'BCP.PAIE.1640618783', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:26:23', '2021-12-27 16:26:23'),
(323, 286, 15500, 'BCP.PAIE.1640619206', '074333333', NULL, 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:33:26', '2021-12-27 16:33:26'),
(324, 287, 100, 'BCP.PAIE.1640619365', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:36:05', '2021-12-27 16:36:05'),
(325, 288, 100, 'BCP.PAIE.1640619445', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:37:25', '2021-12-27 16:37:25'),
(326, 289, 100, 'BCP.PAIE.1640619528', '074333333', NULL, 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:38:48', '2021-12-27 16:38:48'),
(327, 290, 100, 'BCP.PAIE.1640619625', '074333333', NULL, 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:40:25', '2021-12-27 16:40:25'),
(328, 291, 100, 'BCP.PAIE.1640619962', '074333333', 'AM', 'CanalSat', NULL, 17, NULL, NULL, 0, '2021-12-27 16:46:02', '2021-12-27 16:46:02'),
(329, 292, 100, 'BCP.PAIE.1640653106', '074212121', 'AM', 'CanalSat', NULL, 10, NULL, NULL, 0, '2021-12-28 01:58:26', '2021-12-28 01:58:26'),
(330, 293, 5500, 'BCP.PAIE.1640699179', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 14:46:19', '2021-12-28 14:46:19'),
(331, 294, 5500, 'BCP.PAIE.1640699278', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 14:47:58', '2021-12-28 14:47:58'),
(332, 295, 5500, 'BCP.PAIE.1640699620', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 14:53:40', '2021-12-28 14:53:40'),
(333, 296, 5500, 'BCP.PAIE.1640700624', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 15:10:24', '2021-12-28 15:10:24'),
(334, 296, 5500, 'BCP.PAIE.1640700915', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 15:15:15', '2021-12-28 15:15:15'),
(335, 296, 5500, 'BCP.PAIE.1640700920', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 15:15:20', '2021-12-28 15:15:20'),
(336, 297, 100, 'BCP.PAIE.1640701078', '074696969', 'AM', 'CanalSat', '200', 19, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-28 15:17:58', '2021-12-28 15:18:49'),
(337, 297, 100, 'BCP.PAIE.1640701249', '074696969', 'AM', 'CanalSat', '200', 19, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-28 15:20:49', '2021-12-28 15:21:40'),
(338, 297, 100, 'BCP.PAIE.1640701494', '074696969', 'AM', 'CanalSat', '200', 19, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-28 15:24:54', '2021-12-28 15:25:38'),
(339, 298, 100, 'BCP.PAIE.1640702153', '074696969', 'MC', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 15:35:53', '2021-12-28 15:35:53'),
(340, 299, 100, 'BCP.PAIE.1640702188', '074696969', 'VM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-28 15:36:28', '2021-12-28 15:36:28'),
(341, 300, 5500, 'BCP.PAIE.1640747346', '074696969', 'AM', 'CanalSat', NULL, 19, NULL, NULL, 0, '2021-12-29 04:09:06', '2021-12-29 04:09:06'),
(342, 301, 10500, 'BCP.PAIE.1640772015', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:00:15', '2021-12-29 11:00:15'),
(343, 301, 10500, 'BCP.PAIE.1640772054', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 11:00:54', '2021-12-29 11:02:31'),
(344, 302, 100, 'BCP.PAIE.1640773514', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:25:14', '2021-12-29 11:25:14'),
(345, 303, 100, 'BCP.PAIE.1640773715', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:28:35', '2021-12-29 11:28:35'),
(346, 304, 100, 'BCP.PAIE.1640773732', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 11:28:52', '2021-12-29 11:29:49'),
(347, 304, 100, 'BCP.PAIE.1640773999', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:33:19', '2021-12-29 11:33:19'),
(348, 304, 100, 'BCP.PAIE.1640774019', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 11:33:39', '2021-12-29 11:34:25'),
(349, 304, 100, 'BCP.PAIE.1640774739', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 11:45:39', '2021-12-29 11:46:28'),
(350, 304, 100, 'BCP.PAIE.1640775198', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:53:18', '2021-12-29 11:53:18'),
(351, 305, 100, 'BCP.PAIE.1640775295', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 11:54:55', '2021-12-29 11:55:48'),
(352, 305, 100, 'BCP.PAIE.1640775556', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 11:59:16', '2021-12-29 11:59:16'),
(353, 305, 100, 'BCP.PAIE.1640775715', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:01:55', '2021-12-29 12:01:55'),
(354, 305, 100, 'BCP.PAIE.1640775724', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:02:04', '2021-12-29 12:02:04'),
(355, 306, 100, 'BCP.PAIE.1640775847', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:04:07', '2021-12-29 12:05:02'),
(356, 306, 100, 'BCP.PAIE.1640776230', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:10:30', '2021-12-29 12:10:30'),
(357, 306, 100, 'BCP.PAIE.1640776235', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:10:35', '2021-12-29 12:11:25'),
(358, 306, 100, 'BCP.PAIE.1640776349', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:12:29', '2021-12-29 12:13:12'),
(359, 306, 100, 'BCP.PAIE.1640776558', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:15:58', '2021-12-29 12:16:39'),
(360, 306, 100, 'BCP.PAIE.1640776722', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:18:42', '2021-12-29 12:18:42'),
(361, 306, 100, 'BCP.PAIE.1640776725', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:18:45', '2021-12-29 12:18:45'),
(362, 306, 100, 'BCP.PAIE.1640776764', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:19:24', '2021-12-29 12:20:09'),
(363, 306, 100, 'BCP.PAIE.1640777238', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:27:18', '2021-12-29 12:28:10'),
(364, 306, 100, 'BCP.PAIE.1640777605', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:33:25', '2021-12-29 12:34:14'),
(365, 306, 100, 'BCP.PAIE.1640777702', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:35:02', '2021-12-29 12:35:02'),
(366, 306, 100, 'BCP.PAIE.1640777739', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:35:39', '2021-12-29 12:36:40'),
(367, 307, 100, 'BCP.PAIE.1640778006', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 12:40:06', '2021-12-29 12:41:02'),
(368, 308, 40500, 'BCP.PAIE.1640779075', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:57:55', '2021-12-29 12:57:55'),
(369, 308, 40500, 'BCP.PAIE.1640779123', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 12:58:43', '2021-12-29 12:58:43'),
(370, 309, 100, 'BCP.PAIE.1640780788', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 13:26:28', '2021-12-29 13:26:28'),
(371, 309, 100, 'BCP.PAIE.1640780849', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 13:27:29', '2021-12-29 13:27:29');
INSERT INTO `paiements` (`id`, `reabonnement_id`, `montant`, `reference`, `tel_client`, `operateur`, `service`, `code`, `client_id`, `message`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(372, 309, 100, 'BCP.PAIE.1640780851', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 13:27:31', '2021-12-29 13:28:15'),
(373, 310, 100, 'BCP.PAIE.1640781943', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 13:45:43', '2021-12-29 13:46:43'),
(374, 311, 100, 'BCP.PAIE.1640782424', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 13:53:44', '2021-12-29 13:54:39'),
(375, 312, 6100, 'BCP.PAIE.1640782815', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 14:00:15', '2021-12-29 14:00:15'),
(376, 313, 100, 'BCP.PAIE.1640782871', '074181818', 'AM', 'CanalSat', NULL, 20, NULL, NULL, 0, '2021-12-29 14:01:11', '2021-12-29 14:01:11'),
(377, 314, 100, 'BCP.PAIE.1640783618', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 14:13:38', '2021-12-29 14:16:55'),
(378, 315, 100, 'BCP.PAIE.1640783889', '074181818', 'AM', 'CanalSat', '200', 20, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 14:18:09', '2021-12-29 14:19:17'),
(379, 316, 10500, 'BCP.PAIE.1640787796', '074303030', 'AM', 'CanalSat', '200', 21, 'Paiement effectuéavec succès !!!!', 'PAIEMENT OK !', 1, '2021-12-29 15:23:16', '2021-12-29 15:25:24'),
(380, 325, 5500, 'BCP.PAIE.1640918757', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 03:45:57', '2021-12-31 03:45:57'),
(381, 326, 15500, 'BCP.PAIE.1640918935', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 03:48:55', '2021-12-31 03:48:55'),
(382, 327, 12500, 'BCP.PAIE.1640919049', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 03:50:49', '2021-12-31 03:50:49'),
(383, 328, 12500, 'BCP.PAIE.1640919369', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 03:56:09', '2021-12-31 03:56:09'),
(384, 329, 40500, 'BCP.PAIE.1640919535', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 03:58:55', '2021-12-31 03:58:55'),
(385, 330, 15500, 'BCP.PAIE.1640919849', '074303030', 'AM', 'CanalSat', NULL, 21, NULL, NULL, 0, '2021-12-31 04:04:09', '2021-12-31 04:04:09');

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
-- Table structure for table `publicites`
--

CREATE TABLE `publicites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publicites`
--

INSERT INTO `publicites` (`id`, `code`, `libelle`, `photo_url`, `active`, `created_at`, `updated_at`) VALUES
(1, 'P1', 'PUB1', 'http://localhost:8000/publicites/35315.png', 0, '2021-08-20 12:47:40', '2021-08-20 12:53:38'),
(2, 'P2', 'PUB2', 'http://localhost:8000/publicites/49154.png', 1, '2021-08-20 13:00:19', '2021-08-20 13:02:53'),
(3, 'P3', 'PUB3', 'http://localhost:8000/publicites/26374.jpg', 1, '2021-08-20 13:00:30', '2021-08-20 13:03:09'),
(4, 'P4', 'PUB4', 'http://localhost:8000/publicites/27788.jpg', 1, '2021-08-20 13:00:41', '2021-08-20 13:03:25'),
(5, 'P5', 'PUB5', 'http://localhost:8000/publicites/44940.jpg', 1, '2021-08-20 13:00:54', '2021-08-20 13:03:43'),
(6, 'P6', 'PUB6', 'http://localhost:8000/publicites/17998.jpg', 1, '2021-08-20 13:01:07', '2021-08-20 13:03:58'),
(7, 'P7', 'PUB7', 'http://localhost:8000/publicites/19972.jpg', 1, '2021-08-20 13:01:21', '2021-08-20 13:04:13'),
(8, 'P8', 'PUB8', 'http://localhost:8000/publicites/14712.jpg', 1, '2021-08-20 13:01:40', '2021-08-20 13:04:31'),
(9, 'P9', 'PUB9', 'http://localhost:8000/publicites/33228.jpg', 1, '2021-08-20 13:02:06', '2021-08-20 13:04:52'),
(10, 'P10', 'PUB10', 'http://localhost:8000/publicites/43097.jpg', 1, '2021-08-20 13:02:17', '2021-08-20 13:05:10'),
(11, 'P11', 'PUB11', 'http://localhost:8000/publicites/43520.jpg', 1, '2021-08-20 13:05:40', '2021-08-20 13:06:18'),
(12, 'P12', 'PUB12', 'http://localhost:8000/publicites/25925.jpg', 1, '2021-08-20 13:05:55', '2021-08-20 13:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `reabonnements`
--

CREATE TABLE `reabonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decodeur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_canal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offre_choisie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_choisie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forfait_choisie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_alerte` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tel_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `statut` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reabonnements`
--

INSERT INTO `reabonnements` (`id`, `reference`, `service`, `decodeur`, `box_canal`, `offre_choisie`, `option_choisie`, `forfait_choisie`, `duree`, `date_debut`, `date_alerte`, `date_fin`, `client_id`, `tel_client`, `mode_paiement`, `active`, `statut`, `created_at`, `updated_at`) VALUES
(26, 'REABO.CANALSAT.1631038596', 'CanalSat', '224516385054', NULL, 'ESSENTIEL+', 'CHARME 1', NULL, NULL, '2021-09-07', '2021-09-30', '2021-10-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 18:16:36', '2021-09-07 18:16:36'),
(27, 'REABO.CANALSAT.1631038773', 'CanalSat', '224516385054', NULL, 'EVASION+', 'CHARME 1', NULL, NULL, '2021-09-07', '2021-09-30', '2021-10-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 18:19:33', '2021-09-07 18:19:33'),
(28, 'REABO.CANALSAT.1631039097', 'CanalSat', '224516385054', NULL, 'EVASION+', 'CHARME 1 ET 2', NULL, NULL, '2021-09-07', '2021-09-30', '2021-10-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 18:24:57', '2021-09-07 18:24:57'),
(29, 'REABO.CANALSAT.1631039655', 'CanalSat', '224516385054', NULL, 'EVASION+', 'CHARME 1', NULL, NULL, '2021-09-07', '2021-09-30', '2021-10-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 18:27:57', '2021-09-07 18:34:15'),
(30, 'REABO.CANALSAT.1631039572', 'CanalSat', '224516385054', NULL, 'EVASION+', 'CHARME 2', NULL, NULL, '2021-09-07', '2021-09-30', '2021-10-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 18:32:52', '2021-09-07 18:32:52'),
(31, 'REABO.CANALBOX.1631042667', 'CanalBox', NULL, '2245789632145', NULL, NULL, 'START', 2, '2021-09-07', '2021-10-31', '2021-11-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 19:24:27', '2021-09-07 19:24:27'),
(32, 'REABO.CANALBOX.1631043198', 'CanalBox', NULL, '2245789632145', NULL, NULL, 'PREMIUM', 2, '2021-09-07', '2021-10-31', '2021-11-07', 8, '074835631', 'AM', 0, 0, '2021-09-07 19:26:39', '2021-09-07 19:33:18'),
(33, 'REABO.CANALSAT.1633660862', 'CanalSat', '224516385054', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-10-08', '2021-11-01', '2021-11-08', 8, '074835631', 'AM', 0, 0, '2021-10-08 03:41:02', '2021-10-08 03:41:02'),
(34, 'REABO.CANALSAT.1633663487', 'CanalSat', '224516385054', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-08', '2021-11-01', '2021-11-08', 8, '074835631', 'AM', 0, 0, '2021-10-08 04:24:47', '2021-10-08 04:24:47'),
(35, 'REABO.CANALSAT.1633665639', 'CanalSat', '224516385054', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-08', '2021-11-01', '2021-11-08', 8, '074835631', 'AM', 0, 0, '2021-10-08 05:00:39', '2021-10-08 05:00:39'),
(36, 'REABO.CANALSAT.1633700251', 'CanalSat', '224516385054', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-08', '2021-11-01', '2021-11-08', 8, '074835631', 'AM', 0, 0, '2021-10-08 14:37:31', '2021-10-08 14:37:31'),
(37, 'REABO.CANALSAT.1633700279', 'CanalSat', '224516385054', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-08', '2021-11-01', '2021-11-08', 8, '074835631', 'AM', 0, 0, '2021-10-08 14:37:59', '2021-10-08 14:37:59'),
(38, 'REABO.CANALSAT.1634733572', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 13:39:32', '2021-10-20 13:39:32'),
(39, 'REABO.CANALSAT.1634742719', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:11:59', '2021-10-20 16:11:59'),
(40, 'REABO.CANALSAT.1634743067', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:17:47', '2021-10-20 16:17:47'),
(41, 'REABO.CANALSAT.1634743313', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:21:53', '2021-10-20 16:21:53'),
(42, 'REABO.CANALSAT.1634743411', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:23:31', '2021-10-20 16:23:31'),
(43, 'REABO.CANALSAT.1634743420', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:23:40', '2021-10-20 16:23:40'),
(44, 'REABO.CANALSAT.1634743455', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:24:15', '2021-10-20 16:24:15'),
(45, 'REABO.CANALSAT.1634743467', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:24:27', '2021-10-20 16:24:27'),
(46, 'REABO.CANALSAT.1634743733', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:28:53', '2021-10-20 16:28:53'),
(47, 'REABO.CANALSAT.1634743893', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:31:33', '2021-10-20 16:31:33'),
(48, 'REABO.CANALSAT.1634744042', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:34:02', '2021-10-20 16:34:02'),
(49, 'REABO.CANALSAT.1634744054', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-10-20', '2021-11-13', '2021-11-20', 8, '074835631', 'AM', 0, 0, '2021-10-20 16:34:14', '2021-10-20 16:34:14'),
(50, 'REABO.CANALSAT.1636076905', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 02:48:25', '2021-11-05 02:48:25'),
(51, 'REABO.CANALSAT.1636077041', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 02:50:41', '2021-11-05 02:50:41'),
(52, 'REABO.CANALSAT.1636077199', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 02:53:19', '2021-11-05 02:53:19'),
(53, 'REABO.CANALSAT.1636077416', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 02:56:56', '2021-11-05 02:56:56'),
(54, 'REABO.CANALSAT.1636077466', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 02:57:46', '2021-11-05 02:57:46'),
(55, 'REABO.CANALSAT.1636078211', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 03:10:11', '2021-11-05 03:10:11'),
(56, 'REABO.CANALSAT.1636078381', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 03:13:01', '2021-11-05 03:13:01'),
(57, 'REABO.CANALSAT.1636078519', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 03:15:19', '2021-11-05 03:15:19'),
(58, 'REABO.CANALSAT.1636078542', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 03:15:42', '2021-11-05 03:15:42'),
(59, 'REABO.CANALSAT.1636099830', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 09:10:30', '2021-11-05 09:10:30'),
(60, 'REABO.CANALSAT.1636101212', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 09:33:32', '2021-11-05 09:33:32'),
(61, 'REABO.CANALSAT.1636101244', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 09:34:04', '2021-11-05 09:34:04'),
(62, 'REABO.CANALSAT.1636101606', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 09:40:06', '2021-11-05 09:40:06'),
(63, 'REABO.CANALSAT.1636103390', 'CanalSat', '22451638505400', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 10:09:50', '2021-11-05 10:09:50'),
(64, 'REABO.CANALSAT.1636104932', 'CanalSat', '22451638505400', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 10:35:32', '2021-11-05 10:35:32'),
(65, 'REABO.CANALSAT.1636104969', 'CanalSat', '22451638505400', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 10:36:09', '2021-11-05 10:36:09'),
(66, 'REABO.CANALSAT.1636105004', 'CanalSat', '22451638505400', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 10:36:44', '2021-11-05 10:36:44'),
(67, 'REABO.CANALSAT.1636105229', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-05', '2021-11-28', '2021-12-05', 8, '074835631', 'AM', 0, 0, '2021-11-05 10:40:29', '2021-11-05 10:40:29'),
(68, 'REABO.CANALSAT.1636584905', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-10', '2021-12-03', '2021-12-10', 8, '074835631', 'AM', 0, 0, '2021-11-10 23:55:05', '2021-11-10 23:55:05'),
(69, 'REABO.CANALSAT.1636679238', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '24174835639', 'AM', 0, 0, '2021-11-12 02:07:18', '2021-11-12 02:07:18'),
(70, 'REABO.CANALSAT.1636679512', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 02:11:52', '2021-11-12 02:11:52'),
(71, 'REABO.CANALSAT.1636680067', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 02:21:07', '2021-11-12 02:21:07'),
(72, 'REABO.CANALSAT.1636696734', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 06:58:54', '2021-11-12 06:58:54'),
(73, 'REABO.CANALSAT.1636696782', 'CanalSat', '22451638505400', NULL, 'TOUT CANAL+', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 06:59:42', '2021-11-12 06:59:42'),
(74, 'REABO.CANALSAT.1636696827', 'CanalSat', '17855960012000', NULL, 'EVASION+', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:00:27', '2021-11-12 07:00:27'),
(75, 'REABO.CANALSAT.1636696868', 'CanalSat', '23800006001941', NULL, 'ACCESS+', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:01:08', '2021-11-12 07:01:08'),
(76, 'REABO.CANALSAT.1636696912', 'CanalSat', '22451638505400', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:01:52', '2021-11-12 07:01:52'),
(77, 'REABO.CANALSAT.1636696953', 'CanalSat', '17855960012000', NULL, 'EVASION', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:02:33', '2021-11-12 07:02:33'),
(78, 'REABO.CANALSAT.1636697013', 'CanalSat', '17855960012000', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:03:33', '2021-11-12 07:03:33'),
(79, 'REABO.CANALSAT.1636697346', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '24174835639', 'AM', 0, 0, '2021-11-12 07:09:06', '2021-11-12 07:09:06'),
(80, 'REABO.CANALSAT.1636698532', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:28:52', '2021-11-12 07:28:52'),
(81, 'REABO.CANALSAT.1636698574', 'CanalSat', '17855960012000', NULL, 'EVASION', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:29:34', '2021-11-12 07:29:34'),
(82, 'REABO.CANALSAT.1636698868', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:34:28', '2021-11-12 07:34:28'),
(83, 'REABO.CANALSAT.1636699127', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 07:38:47', '2021-11-12 07:38:47'),
(84, 'REABO.CANALSAT.1636701343', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 08:15:43', '2021-11-12 08:15:43'),
(85, 'REABO.CANALSAT.1636706543', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 09:42:23', '2021-11-12 09:42:23'),
(86, 'REABO.CANALSAT.1636706784', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 1, 0, '2021-11-12 09:46:24', '2021-11-12 09:47:06'),
(87, 'REABO.CANALSAT.1636709611', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'CHARME+1', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '24174835639', 'AM', 0, 0, '2021-11-12 10:33:31', '2021-11-12 10:33:31'),
(88, 'REABO.CANALSAT.1636710481', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '074835631', 'AM', 0, 0, '2021-11-12 10:48:01', '2021-11-12 10:48:01'),
(89, 'REABO.CANALSAT.1636711171', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'CHARME+1', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '24174698185', 'AM', 0, 0, '2021-11-12 10:59:31', '2021-11-12 10:59:31'),
(90, 'REABO.CANALSAT.1636711180', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '077002872', 'AM', 1, 0, '2021-11-12 10:59:40', '2021-11-12 11:00:06'),
(91, 'REABO.CANALSAT.1636711296', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'CHARME+1', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '24174698185', 'AM', 0, 0, '2021-11-12 11:01:36', '2021-11-12 11:01:36'),
(92, 'REABO.CANALSAT.1636711785', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '077002872', 'AM', 0, 0, '2021-11-12 11:09:45', '2021-11-12 11:09:45'),
(93, 'REABO.CANALSAT.1636711857', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-12', '2021-12-05', '2021-12-12', 8, '077002872', 'AM', 1, 0, '2021-11-12 11:10:57', '2021-11-12 11:11:21'),
(94, 'REABO.CANALSAT.1636806696', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-13', '2021-12-06', '2021-12-13', 8, '074835631', 'AM', 0, 0, '2021-11-13 13:31:36', '2021-11-13 13:31:36'),
(95, 'REABO.CANALSAT.1636981822', 'CanalSat', '17855960012000', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-15', '2021-12-08', '2021-12-15', 8, '074835631', 'AM', 0, 0, '2021-11-15 14:10:22', '2021-11-15 14:10:22'),
(96, 'REABO.CANALSAT.1636982592', 'CanalSat', '22451638505400', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-11-15', '2021-12-08', '2021-12-15', 8, '074835631', 'AM', 0, 0, '2021-11-15 14:23:12', '2021-11-15 14:23:12'),
(97, 'REABO.CANALSAT.1637106577', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 00:49:37', '2021-11-17 00:49:37'),
(98, 'REABO.CANALSAT.1637106740', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 00:52:20', '2021-11-17 00:52:20'),
(99, 'REABO.CANALSAT.1637107048', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 00:57:28', '2021-11-17 00:57:28'),
(100, 'REABO.CANALSAT.1637107578', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '24174835639', 'AM', 0, 0, '2021-11-17 01:06:18', '2021-11-17 01:06:18'),
(101, 'REABO.CANALSAT.1637107740', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '24174835639', 'AM', 0, 0, '2021-11-17 01:09:00', '2021-11-17 01:09:00'),
(102, 'REABO.CANALSAT.1637149936', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 12:52:16', '2021-11-17 12:52:16'),
(103, 'REABO.CANALSAT.1637152098', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 13:28:18', '2021-11-17 13:28:18'),
(104, 'REABO.CANALSAT.1637152276', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-17', '2021-12-10', '2021-12-17', 8, '074835631', 'AM', 0, 0, '2021-11-17 13:31:16', '2021-11-17 13:31:16'),
(105, 'REABO.CANALSAT.1637239718', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-18', '2021-12-11', '2021-12-18', 8, '074835631', 'AM', 0, 0, '2021-11-18 13:48:38', '2021-11-18 13:48:38'),
(106, 'REABO.CANALSAT.1637247092', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-18', '2021-12-11', '2021-12-18', 8, '074835631', 'AM', 0, 0, '2021-11-18 15:51:32', '2021-11-18 15:51:32'),
(107, 'REABO.CANALSAT.1637247216', 'CanalSat', '17855960012000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-18', '2021-12-11', '2021-12-18', 8, '074835631', 'AM', 0, 0, '2021-11-18 15:53:36', '2021-11-18 15:53:36'),
(108, 'REABO.CANALSAT.1637248187', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-18', '2021-12-11', '2021-12-18', 8, '24174835639', 'AM', 0, 0, '2021-11-18 16:09:47', '2021-11-18 16:09:47'),
(109, 'REABO.CANALSAT.1637249105', 'CanalSat', '22451638505400', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-18', '2021-12-11', '2021-12-18', 8, '24174835639', 'AM', 0, 0, '2021-11-18 16:25:05', '2021-11-18 16:25:05'),
(110, 'REABO.CANALSAT.1637326604', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 13:56:44', '2021-11-19 13:56:44'),
(111, 'REABO.CANALSAT.1637326915', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 1, 0, '2021-11-19 14:01:55', '2021-11-19 14:02:21'),
(112, 'REABO.CANALSAT.1637327253', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 14:07:33', '2021-11-19 14:07:33'),
(113, 'REABO.CANALSAT.1637327424', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 1, 0, '2021-11-19 14:10:24', '2021-11-19 14:10:51'),
(114, 'REABO.CANALSAT.1637327912', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 14:18:32', '2021-11-19 14:18:32'),
(115, 'REABO.CANALSAT.1637328221', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 14:23:41', '2021-11-19 14:23:41'),
(116, 'REABO.CANALSAT.1637328497', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 14:28:17', '2021-11-19 14:28:17'),
(117, 'REABO.CANALSAT.1637328796', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 10, '074835631', 'AM', 0, 0, '2021-11-19 14:33:16', '2021-11-19 14:33:16'),
(118, 'REABO.BCP.1637361014', 'CanalSat', '224516385054', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 8, '074835631', 'AM', 0, 0, '2021-11-19 23:30:14', '2021-11-19 23:30:14'),
(119, 'REABO.BCP.1637361107', 'CanalSat', '12345678912301', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 8, '074835631', 'AM', 0, 0, '2021-11-19 23:31:47', '2021-11-19 23:31:47'),
(120, 'REABO.BCP.1637361247', 'CanalSat', '224516385054', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-19', '2021-12-12', '2021-12-19', 8, '074835631', 'AM', 0, 0, '2021-11-19 23:34:07', '2021-11-19 23:34:07'),
(121, 'REABO.BCP.1637363150', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 8, '074835631', 'AM', 0, 0, '2021-11-20 00:05:50', '2021-11-20 00:05:50'),
(122, 'REABO.BCP.1637363253', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 9, '074835631', 'AM', 0, 0, '2021-11-20 00:07:33', '2021-11-20 00:07:33'),
(123, 'REABO.BCP.1637363463', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 0, 0, '2021-11-20 00:11:03', '2021-11-20 00:11:03'),
(124, 'REABO.BCP.1637363974', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 0, 0, '2021-11-20 00:19:34', '2021-11-20 00:19:34'),
(125, 'REABO.BCP.1637364201', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 5, '074835631', 'AM', 0, 0, '2021-11-20 00:23:21', '2021-11-20 00:23:21'),
(126, 'REABO.BCP.1637364301', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 5, '074835631', 'AM', 0, 0, '2021-11-20 00:25:01', '2021-11-20 00:25:01'),
(127, 'REABO.BCP.1637364380', 'CanalSat', '23800006001941', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 6, '074835631', 'AM', 0, 0, '2021-11-20 00:26:20', '2021-11-20 00:26:20'),
(128, 'REABO.BCP.1637403576', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 11:19:36', '2021-11-20 11:23:21'),
(129, 'REABO.BCP.1637417478', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 15:11:18', '2021-11-20 15:11:52'),
(130, 'REABO.BCP.1637418282', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 15:24:42', '2021-11-20 15:25:06'),
(131, 'REABO.BCP.1637418560', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 15:29:20', '2021-11-20 15:29:52'),
(132, 'REABO.BCP.1637421822', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 16:23:42', '2021-11-20 16:24:06'),
(133, 'REABO.BCP.1637423254', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 16:47:34', '2021-11-20 16:48:06'),
(134, 'REABO.BCP.1637424802', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-20', '2021-12-13', '2021-12-20', 10, '074835631', 'AM', 1, 0, '2021-11-20 17:13:22', '2021-11-20 17:14:07'),
(135, 'REABO.BCP.1637450875', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 10, '074835631', 'AM', 1, 0, '2021-11-21 00:27:55', '2021-11-21 00:28:21'),
(136, 'REABO.BCP.1637451088', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 10, '074835631', 'AM', 1, 0, '2021-11-21 00:31:28', '2021-11-21 00:31:52'),
(137, 'REABO.BCP.1637454436', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 10, '074835631', 'AM', 1, 0, '2021-11-21 01:27:16', '2021-11-21 01:27:51'),
(138, 'REABO.BCP.1637504430', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 10, '074212121', 'AM', 0, 0, '2021-11-21 15:20:30', '2021-11-21 15:20:30'),
(139, 'REABO.BCP.1637504452', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 10, '07421212', 'AM', 0, 0, '2021-11-21 15:20:52', '2021-11-21 15:20:52'),
(140, 'REABO.BCP.1637513281', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-21', '2021-12-14', '2021-12-21', 11, '074835631', 'AM', 1, 0, '2021-11-21 17:48:01', '2021-11-21 17:48:56'),
(141, 'REABO.BCP.1637670592', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-23', '2021-12-16', '2021-12-23', 10, '074835631', 'AM', 1, 0, '2021-11-23 13:29:52', '2021-11-23 13:30:51'),
(142, 'REABO.BCP.1637718529', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 02:48:49', '2021-11-24 02:48:49'),
(143, 'REABO.BCP.1637718595', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 02:49:55', '2021-11-24 02:49:55'),
(144, 'REABO.BCP.1637721307', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'AM', 0, 0, '2021-11-24 03:35:07', '2021-11-24 03:35:07'),
(145, 'REABO.BCP.1637721347', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 03:35:47', '2021-11-24 03:35:47'),
(146, 'REABO.BCP.1637722272', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 03:51:12', '2021-11-24 03:51:12'),
(147, 'REABO.BCP.1637753884', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 12:38:04', '2021-11-24 12:38:04'),
(148, 'REABO.BCP.1637767184', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 16:19:44', '2021-11-24 16:19:44'),
(149, 'REABO.BCP.1637768932', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 16:48:52', '2021-11-24 16:48:52'),
(150, 'REABO.BCP.1637769111', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 16:51:51', '2021-11-24 16:51:51'),
(151, 'REABO.BCP.1637769941', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 17:05:41', '2021-11-24 17:05:41'),
(152, 'REABO.BCP.1637771461', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 17:31:01', '2021-11-24 17:31:01'),
(153, 'REABO.BCP.1637771678', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 17:34:38', '2021-11-24 17:34:38'),
(154, 'REABO.BCP.1637771911', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 17:38:31', '2021-11-24 17:38:31'),
(155, 'REABO.BCP.1637772122', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 17:42:02', '2021-11-24 17:42:02'),
(156, 'REABO.BCP.1637773835', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-24', '2021-12-17', '2021-12-24', 10, '074212121', 'VM', 0, 0, '2021-11-24 18:10:35', '2021-11-24 18:10:35'),
(157, 'REABO.BCP.1637796819', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 00:33:39', '2021-11-25 00:33:39'),
(158, 'REABO.BCP.1637796931', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 00:35:31', '2021-11-25 00:35:31'),
(159, 'REABO.BCP.1637797881', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 00:51:21', '2021-11-25 00:51:21'),
(160, 'REABO.BCP.1637798462', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 01:01:02', '2021-11-25 01:01:02'),
(161, 'REABO.BCP.1637799764', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 01:22:44', '2021-11-25 01:22:44'),
(162, 'REABO.BCP.1637799978', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 01:26:18', '2021-11-25 01:26:18'),
(163, 'REABO.BCP.1637801457', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 01:50:57', '2021-11-25 01:50:57'),
(164, 'REABO.BCP.1637801757', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 01:55:57', '2021-11-25 01:55:57'),
(165, 'REABO.BCP.1637802196', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 02:03:16', '2021-11-25 02:03:16'),
(166, 'REABO.BCP.1637802395', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 02:06:35', '2021-11-25 02:06:35'),
(167, 'REABO.BCP.1637802736', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 02:12:16', '2021-11-25 02:12:16'),
(168, 'REABO.BCP.1637803302', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 02:21:42', '2021-11-25 02:21:42'),
(169, 'REABO.BCP.1637804503', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 02:41:43', '2021-11-25 02:41:43'),
(170, 'REABO.BCP.1637805726', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 03:02:06', '2021-11-25 03:02:06'),
(171, 'REABO.BCP.1637806412', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 03:13:32', '2021-11-25 03:13:32'),
(172, 'REABO.BCP.1637806833', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 03:20:33', '2021-11-25 03:20:33'),
(173, 'REABO.BCP.1637809257', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:00:57', '2021-11-25 04:00:57'),
(174, 'REABO.BCP.1637809322', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:02:02', '2021-11-25 04:02:02'),
(175, 'REABO.BCP.1637809743', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:09:03', '2021-11-25 04:09:03'),
(176, 'REABO.BCP.1637809895', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:11:35', '2021-11-25 04:11:35'),
(177, 'REABO.BCP.1637810071', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:14:31', '2021-11-25 04:14:31'),
(178, 'REABO.BCP.1637810182', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:16:22', '2021-11-25 04:16:22'),
(179, 'REABO.BCP.1637811100', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:31:40', '2021-11-25 04:31:40'),
(180, 'REABO.BCP.1637811341', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '066682353', 'VM', 0, 0, '2021-11-25 04:35:41', '2021-11-25 04:35:41'),
(181, 'REABO.BCP.1637811607', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:40:07', '2021-11-25 04:40:07'),
(182, 'REABO.BCP.1637811916', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:45:16', '2021-11-25 04:45:16'),
(183, 'REABO.BCP.1637812139', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:48:59', '2021-11-25 04:48:59'),
(184, 'REABO.BCP.1637812300', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:51:40', '2021-11-25 04:51:40'),
(185, 'REABO.BCP.1637812334', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'VM', 0, 0, '2021-11-25 04:52:14', '2021-11-25 04:52:14'),
(186, 'REABO.BCP.1637874739', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'AM', 0, 0, '2021-11-25 22:12:19', '2021-11-25 22:12:19'),
(187, 'REABO.BCP.1637874995', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'AM', 0, 0, '2021-11-25 22:16:35', '2021-11-25 22:16:35'),
(188, 'REABO.BCP.1637875098', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'AM', 0, 0, '2021-11-25 22:18:18', '2021-11-25 22:18:18'),
(189, 'REABO.BCP.1637875496', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074212121', 'AM', 0, 0, '2021-11-25 22:24:56', '2021-11-25 22:24:56'),
(190, 'REABO.BCP.1637875545', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'AM', 0, 0, '2021-11-25 22:25:45', '2021-11-25 22:25:45'),
(191, 'REABO.BCP.1637875606', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'AM', 0, 0, '2021-11-25 22:26:46', '2021-11-25 22:26:46'),
(192, 'REABO.BCP.1637875699', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'AM', 0, 0, '2021-11-25 22:28:19', '2021-11-25 22:28:19'),
(193, 'REABO.BCP.1637875793', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 22:29:53', '2021-11-25 22:29:53'),
(194, 'REABO.BCP.1637877081', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 22:51:21', '2021-11-25 22:51:21'),
(195, 'REABO.BCP.1637877771', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 23:02:51', '2021-11-25 23:02:51'),
(196, 'REABO.BCP.1637878566', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 23:16:06', '2021-11-25 23:16:06'),
(197, 'REABO.BCP.1637878907', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 23:21:47', '2021-11-25 23:21:47'),
(198, 'REABO.BCP.1637879923', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 23:38:43', '2021-11-25 23:38:43'),
(199, 'REABO.BCP.1637880642', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-25', '2021-12-18', '2021-12-25', 10, '074835631', 'VM', 0, 0, '2021-11-25 23:50:42', '2021-11-25 23:50:42'),
(200, 'REABO.BCP.1637881348', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074835631', 'VM', 0, 0, '2021-11-26 00:02:28', '2021-11-26 00:02:28'),
(201, 'REABO.BCP.1637883448', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074835631', 'VM', 0, 0, '2021-11-26 00:37:28', '2021-11-26 00:37:28'),
(202, 'REABO.BCP.1637884021', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074835631', 'VM', 0, 0, '2021-11-26 00:47:01', '2021-11-26 00:47:01'),
(203, 'REABO.BCP.1637884438', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074835631', 'VM', 0, 0, '2021-11-26 00:53:58', '2021-11-26 00:53:58'),
(204, 'REABO.BCP.1637885034', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 01:03:54', '2021-11-26 01:03:54'),
(205, 'REABO.BCP.1637885649', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 1, 1, '2021-11-26 01:14:09', '2021-11-26 01:19:18'),
(206, 'REABO.BCP.1637886669', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'AM', 0, 0, '2021-11-26 01:31:09', '2021-11-26 01:31:09'),
(207, 'REABO.BCP.1637886839', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 01:33:59', '2021-11-26 01:33:59'),
(208, 'REABO.BCP.1637887137', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 01:38:57', '2021-11-26 01:38:57'),
(209, 'REABO.BCP.1637887532', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 01:45:32', '2021-11-26 01:45:32'),
(210, 'REABO.BCP.1637887908', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 01:51:48', '2021-11-26 01:51:48'),
(211, 'REABO.BCP.1637888471', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:01:11', '2021-11-26 02:01:11'),
(212, 'REABO.BCP.1637888715', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:05:15', '2021-11-26 02:05:15'),
(213, 'REABO.BCP.1637888774', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:06:14', '2021-11-26 02:06:14'),
(214, 'REABO.BCP.1637888824', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:07:04', '2021-11-26 02:07:04'),
(215, 'REABO.BCP.1637888894', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:08:14', '2021-11-26 02:08:14'),
(216, 'REABO.BCP.1637889011', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:10:11', '2021-11-26 02:10:11'),
(217, 'REABO.BCP.1637889259', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:14:19', '2021-11-26 02:14:19'),
(218, 'REABO.BCP.1637889374', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:16:14', '2021-11-26 02:16:14'),
(219, 'REABO.BCP.1637889739', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:22:19', '2021-11-26 02:22:19'),
(220, 'REABO.BCP.1637890521', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:35:21', '2021-11-26 02:35:21'),
(221, 'REABO.BCP.1637890724', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:38:44', '2021-11-26 02:38:44'),
(222, 'REABO.BCP.1637890880', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:41:20', '2021-11-26 02:41:20'),
(223, 'REABO.BCP.1637890928', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:42:08', '2021-11-26 02:42:08'),
(224, 'REABO.BCP.1637890987', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 02:43:07', '2021-11-26 02:43:07'),
(225, 'REABO.BCP.1637893232', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 03:20:32', '2021-11-26 03:20:32'),
(226, 'REABO.BCP.1637893401', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 03:23:21', '2021-11-26 03:23:21'),
(227, 'REABO.BCP.1637893598', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 03:26:38', '2021-11-26 03:26:38'),
(228, 'REABO.BCP.1637893743', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 03:29:03', '2021-11-26 03:29:03'),
(229, 'REABO.BCP.1637894513', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 03:41:53', '2021-11-26 03:41:53'),
(230, 'REABO.BCP.1637895729', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 04:02:09', '2021-11-26 04:02:09'),
(231, 'REABO.BCP.1637896045', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-11-26', '2021-12-19', '2021-12-26', 10, '074212121', 'VM', 0, 0, '2021-11-26 04:07:25', '2021-11-26 04:07:25'),
(232, 'REABO.BCP.1638355667', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 11:47:47', '2021-12-01 11:47:47'),
(233, 'REABO.BCP.1638357730', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 12:22:10', '2021-12-01 12:22:10'),
(234, 'REABO.BCP.1638357823', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 12:23:43', '2021-12-01 12:23:43'),
(235, 'REABO.BCP.1638359102', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 12:45:02', '2021-12-01 12:45:02'),
(236, 'REABO.BCP.1638359234', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 12:47:14', '2021-12-01 12:47:14'),
(237, 'REABO.BCP.1638359361', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-01', '2021-12-25', '2022-01-01', 10, '074212121', 'VM', 0, 0, '2021-12-01 12:49:21', '2021-12-01 12:49:21'),
(238, 'REABO.BCP.1638445810', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-02', '2021-12-26', '2022-01-02', 10, '074212121', 'VM', 0, 0, '2021-12-02 12:50:10', '2021-12-02 12:50:10'),
(239, 'REABO.BCP.1638502215', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-03', '2021-12-27', '2022-01-03', 10, '074212121', 'VM', 0, 0, '2021-12-03 04:30:15', '2021-12-03 04:30:15'),
(240, 'REABO.BCP.1639054760', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074835631', 'AM', 0, 0, '2021-12-09 13:59:20', '2021-12-09 13:59:20'),
(241, 'REABO.BCP.1639054839', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074835631', 'AM', 0, 0, '2021-12-09 14:00:39', '2021-12-09 14:00:39'),
(242, 'REABO.BCP.1639055342', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:09:02', '2021-12-09 14:09:02'),
(243, 'REABO.BCP.1639056461', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:27:41', '2021-12-09 14:27:41'),
(244, 'REABO.BCP.1639057381', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:43:01', '2021-12-09 14:43:01'),
(245, 'REABO.BCP.1639057542', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:45:42', '2021-12-09 14:45:42'),
(246, 'REABO.BCP.1639057816', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:50:16', '2021-12-09 14:50:16'),
(247, 'REABO.BCP.1639057926', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:52:06', '2021-12-09 14:52:06'),
(248, 'REABO.BCP.1639058040', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-09', '2022-01-02', '2022-01-09', 10, '074212121', 'VM', 0, 0, '2021-12-09 14:54:00', '2021-12-09 14:54:00'),
(249, 'REABO.BCP.1639353987', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:06:27', '2021-12-13 01:06:27'),
(250, 'REABO.BCP.1639354319', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:11:59', '2021-12-13 01:11:59');
INSERT INTO `reabonnements` (`id`, `reference`, `service`, `decodeur`, `box_canal`, `offre_choisie`, `option_choisie`, `forfait_choisie`, `duree`, `date_debut`, `date_alerte`, `date_fin`, `client_id`, `tel_client`, `mode_paiement`, `active`, `statut`, `created_at`, `updated_at`) VALUES
(251, 'REABO.BCP.1639354367', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '066682353', 'MC', 0, 0, '2021-12-13 01:12:47', '2021-12-13 01:12:47'),
(252, 'REABO.BCP.1639354461', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '066682353', 'VM', 0, 0, '2021-12-13 01:14:21', '2021-12-13 01:14:21'),
(253, 'REABO.BCP.1639354503', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:15:03', '2021-12-13 01:15:03'),
(254, 'REABO.BCP.1639354619', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:16:59', '2021-12-13 01:16:59'),
(255, 'REABO.BCP.1639354684', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:18:04', '2021-12-13 01:18:04'),
(256, 'REABO.BCP.1639355146', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:25:46', '2021-12-13 01:25:46'),
(257, 'REABO.BCP.1639355415', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '066682353', 'MC', 0, 0, '2021-12-13 01:30:15', '2021-12-13 01:30:15'),
(258, 'REABO.BCP.1639356384', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 01:46:24', '2021-12-13 01:46:24'),
(259, 'REABO.BCP.1639356494', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '066682353', 'MC', 0, 0, '2021-12-13 01:48:14', '2021-12-13 01:48:14'),
(260, 'REABO.BCP.1639366971', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'AM', 0, 0, '2021-12-13 04:42:51', '2021-12-13 04:42:51'),
(261, 'REABO.BCP.1639367177', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'MC', 0, 0, '2021-12-13 04:46:17', '2021-12-13 04:46:17'),
(262, 'REABO.BCP.1639367206', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'VM', 0, 0, '2021-12-13 04:46:46', '2021-12-13 04:46:46'),
(263, 'REABO.BCP.1639367240', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 10, '074835631', 'VM', 0, 0, '2021-12-13 04:47:20', '2021-12-13 04:47:20'),
(264, 'REABO.BCP.1639406630', 'CanalSat', '23800160529412', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 15, '074565656', 'AM', 0, 0, '2021-12-13 15:43:50', '2021-12-13 15:43:50'),
(265, 'REABO.BCP.1639407642', 'CanalSat', '23800160529412', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 15, '074565656', 'AM', 0, 0, '2021-12-13 16:00:42', '2021-12-13 16:00:42'),
(266, 'REABO.BCP.1639408188', 'CanalSat', '12345678901234', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 15, '074565656', 'AM', 0, 0, '2021-12-13 16:09:48', '2021-12-13 16:09:48'),
(267, 'REABO.BCP.1639408344', 'CanalSat', '12345678902345', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-13', '2022-01-06', '2022-01-13', 15, '074565656', 'VM', 0, 0, '2021-12-13 16:12:24', '2021-12-13 16:12:24'),
(268, 'REABO.BCP.1639663921', 'CanalSat', '23800160529412', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-16', '2022-01-09', '2022-01-16', 15, '074835631', 'AM', 0, 0, '2021-12-16 15:12:01', '2021-12-16 15:12:01'),
(269, 'REABO.BCP.1639665558', 'CanalSat', NULL, NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 3, '2021-12-16', '2022-03-09', '2022-03-16', 15, '074565656', 'AM', 0, 0, '2021-12-16 15:39:18', '2021-12-16 15:39:18'),
(270, 'REABO.BCP.1639665740', 'CanalSat', NULL, NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 3, '2021-12-16', '2022-03-09', '2022-03-16', 15, '074565656', 'AM', 0, 0, '2021-12-16 15:42:20', '2021-12-16 15:42:20'),
(271, 'REABO.BCP.1640166399', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074835631', 'AM', 0, 0, '2021-12-22 10:46:39', '2021-12-22 10:46:39'),
(272, 'REABO.BCP.1640167096', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074835631', 'AM', 0, 0, '2021-12-22 10:58:16', '2021-12-22 10:58:16'),
(273, 'REABO.BCP.1640169171', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074835631', 'AM', 0, 0, '2021-12-22 11:32:51', '2021-12-22 11:32:51'),
(274, 'REABO.BCP.1640169243', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'CHARME+1', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074835631', 'AM', 0, 0, '2021-12-22 11:34:03', '2021-12-22 11:34:03'),
(275, 'REABO.BCP.1640169431', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'CHARME+1', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074212121', NULL, 0, 0, '2021-12-22 11:37:11', '2021-12-22 11:37:11'),
(276, 'REABO.BCP.1640169460', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074212121', 'AM', 0, 0, '2021-12-22 11:37:40', '2021-12-22 11:37:40'),
(277, 'REABO.BCP.1640170138', 'CanalSat', '23800006001941', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074212121', 'AM', 0, 0, '2021-12-22 11:48:58', '2021-12-22 11:48:58'),
(278, 'REABO.BCP.1640171472', 'CanalSat', '23800006001941', NULL, 'TOUT CANAL+', 'AUCUNE OPTION', NULL, 1, '2021-12-22', '2022-01-15', '2022-01-22', 10, '074212121', 'AM', 0, 0, '2021-12-22 12:11:12', '2021-12-22 12:11:12'),
(279, 'REABO.BCP.1640616740', 'CanalSat', '23800311981825', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 15:52:20', '2021-12-27 15:52:20'),
(280, 'REABO.BCP.1640617300', 'CanalSat', '23800311981825', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'MC', 0, 0, '2021-12-27 16:01:40', '2021-12-27 16:01:40'),
(281, 'REABO.BCP.1640617363', 'CanalSat', '23800311981825', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'VM', 0, 0, '2021-12-27 16:02:43', '2021-12-27 16:02:43'),
(282, 'REABO.BCP.1640617561', 'CanalSat', '23800311900000', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'VM', 0, 0, '2021-12-27 16:06:01', '2021-12-27 16:06:01'),
(283, 'REABO.BCP.1640618430', 'CanalSat', '23800158800815', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:20:30', '2021-12-27 16:20:30'),
(284, 'REABO.BCP.1640618476', 'CanalSat', '23800158800815', NULL, 'EVASION+', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:21:16', '2021-12-27 16:21:16'),
(285, 'REABO.BCP.1640618783', 'CanalSat', '23800158800815', NULL, 'EVASION', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:26:23', '2021-12-27 16:26:23'),
(286, 'REABO.BCP.1640619205', 'CanalSat', '23800311900000', NULL, 'ACCESS+', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', NULL, 0, 0, '2021-12-27 16:33:25', '2021-12-27 16:33:25'),
(287, 'REABO.BCP.1640619365', 'CanalSat', '23800311900000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:36:05', '2021-12-27 16:36:05'),
(288, 'REABO.BCP.1640619445', 'CanalSat', '23800311900000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:37:25', '2021-12-27 16:37:25'),
(289, 'REABO.BCP.1640619527', 'CanalSat', '23800311900000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', NULL, 0, 0, '2021-12-27 16:38:47', '2021-12-27 16:38:47'),
(290, 'REABO.BCP.1640619625', 'CanalSat', '23800311900000', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', NULL, 0, 0, '2021-12-27 16:40:25', '2021-12-27 16:40:25'),
(291, 'REABO.BCP.1640619962', 'CanalSat', '23800311981825', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-27', '2022-01-20', '2022-01-27', 17, '074333333', 'AM', 0, 0, '2021-12-27 16:46:02', '2021-12-27 16:46:02'),
(292, 'REABO.BCP.1640653106', 'CanalSat', '23800006001941', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 10, '074212121', 'AM', 0, 0, '2021-12-28 01:58:26', '2021-12-28 01:58:26'),
(293, 'REABO.BCP.1640699179', 'CanalSat', '23800316560409', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'AM', 0, 0, '2021-12-28 14:46:19', '2021-12-28 14:46:19'),
(294, 'REABO.BCP.1640699278', 'CanalSat', '23800316560409', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'AM', 0, 0, '2021-12-28 14:47:58', '2021-12-28 14:47:58'),
(295, 'REABO.BCP.1640699620', 'CanalSat', '23800316560409', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'AM', 0, 0, '2021-12-28 14:53:40', '2021-12-28 14:53:40'),
(296, 'REABO.BCP.1640700624', 'CanalSat', '23800316560409', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'AM', 0, 0, '2021-12-28 15:10:24', '2021-12-28 15:10:24'),
(297, 'REABO.BCP.1640701078', 'CanalSat', '23800316560409', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'AM', 1, 0, '2021-12-28 15:17:58', '2021-12-28 15:18:49'),
(298, 'REABO.BCP.1640702153', 'CanalSat', '23800316560409', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'MC', 0, 0, '2021-12-28 15:35:53', '2021-12-28 15:35:53'),
(299, 'REABO.BCP.1640702188', 'CanalSat', '23800316560409', NULL, 'EVATEST', 'AUCUNE OPTION', NULL, 1, '2021-12-28', '2022-01-21', '2022-01-28', 19, '074696969', 'VM', 0, 0, '2021-12-28 15:36:28', '2021-12-28 15:36:28'),
(300, 'REABO.BCP.1640747346', 'CanalSat', '23800316560409', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 19, '074696969', 'AM', 0, 0, '2021-12-29 04:09:06', '2021-12-29 04:09:06'),
(301, 'REABO.BCP.1640772015', 'CanalSat', '23800336898802', NULL, 'EVASION', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 11:00:15', '2021-12-29 11:02:31'),
(302, 'REABO.BCP.1640773514', 'CanalSat', '23800336898802', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 0, 0, '2021-12-29 11:25:14', '2021-12-29 11:25:14'),
(303, 'REABO.BCP.1640773715', 'CanalSat', '23800336898802', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 0, 0, '2021-12-29 11:28:35', '2021-12-29 11:28:35'),
(304, 'REABO.BCP.1640773732', 'CanalSat', '23800336898802', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 11:28:52', '2021-12-29 11:29:49'),
(305, 'REABO.BCP.1640775295', 'CanalSat', '23800336898802', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 11:54:55', '2021-12-29 11:55:48'),
(306, 'REABO.BCP.1640775847', 'CanalSat', '23800336898802', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 12:04:07', '2021-12-29 12:05:02'),
(307, 'REABO.BCP.1640778006', 'CanalSat', '23800305628297', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 12:40:06', '2021-12-29 12:41:02'),
(308, 'REABO.BCP.1640779075', 'CanalSat', '23800305628297', NULL, 'TOUT CANAL+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 0, 0, '2021-12-29 12:57:55', '2021-12-29 12:57:55'),
(309, 'REABO.BCP.1640780788', 'CanalSat', '23900002875880', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 13:26:28', '2021-12-29 13:28:15'),
(310, 'REABO.BCP.1640781943', 'CanalSat', '23800186283452', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 13:45:43', '2021-12-29 13:46:43'),
(311, 'REABO.BCP.1640782424', 'CanalSat', '23800186283452', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 13:53:44', '2021-12-29 13:54:39'),
(312, 'REABO.BCP.1640782815', 'CanalSat', '23900002875880', NULL, 'EVATEST+', 'CHARME+1', NULL, 3, '2021-12-29', '2022-03-22', '2022-03-29', 20, '074181818', 'AM', 0, 0, '2021-12-29 14:00:15', '2021-12-29 14:00:15'),
(313, 'REABO.BCP.1640782871', 'CanalSat', '23900002875880', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 3, '2021-12-29', '2022-03-22', '2022-03-29', 20, '074181818', 'AM', 0, 0, '2021-12-29 14:01:11', '2021-12-29 14:01:11'),
(314, 'REABO.BCP.1640783618', 'CanalSat', '23900002875880', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 3, '2021-12-29', '2022-03-22', '2022-03-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 14:13:38', '2021-12-29 14:16:55'),
(315, 'REABO.BCP.1640783889', 'CanalSat', '23900002875880', NULL, 'EVATEST+', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 20, '074181818', 'AM', 1, 0, '2021-12-29 14:18:09', '2021-12-29 14:19:17'),
(316, 'REABO.BCP.1640787796', 'CanalSat', '23900002875880', NULL, 'EVASION', 'AUCUNE OPTION', NULL, 1, '2021-12-29', '2022-01-22', '2022-01-29', 21, '074303030', 'AM', 1, 0, '2021-12-29 15:23:16', '2021-12-29 15:25:24'),
(317, 'REABO.BCP.1640910598', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 01:29:58', '2021-12-31 01:29:58'),
(318, 'REABO.BCP.1640911467', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 01:44:27', '2021-12-31 01:44:27'),
(319, 'REABO.BCP.1640912599', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 02:03:19', '2021-12-31 02:03:19'),
(320, 'REABO.BCP.1640912889', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'CHARME+1', NULL, 2, '2021-12-31', '2022-02-24', '2022-03-03', 21, '074303030', 'AM', 0, 0, '2021-12-31 02:08:09', '2021-12-31 02:08:09'),
(321, 'REABO.BCP.1640913419', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'CHARME+1', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 02:16:59', '2021-12-31 02:16:59'),
(322, 'REABO.BCP.1640915786', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 02:56:26', '2021-12-31 02:56:26'),
(323, 'REABO.BCP.1640916597', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:09:57', '2021-12-31 03:09:57'),
(324, 'REABO.BCP.1640917391', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:23:11', '2021-12-31 03:23:11'),
(325, 'REABO.BCP.1640918757', 'CanalSat', '23800158941031', NULL, 'ACCESS', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:45:57', '2021-12-31 03:45:57'),
(326, 'REABO.BCP.1640918935', 'CanalSat', '23800158941031', NULL, 'ACCESS+', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:48:55', '2021-12-31 03:48:55'),
(327, 'REABO.BCP.1640919049', 'CanalSat', '23800158941031', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:50:49', '2021-12-31 03:50:49'),
(328, 'REABO.BCP.1640919369', 'CanalSat', '23800158941031', NULL, 'ESSENTIEL+', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:56:09', '2021-12-31 03:56:09'),
(329, 'REABO.BCP.1640919535', 'CanalSat', '23800158946081', NULL, 'TOUT CANAL+', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 03:58:55', '2021-12-31 03:58:55'),
(330, 'REABO.BCP.1640919849', 'CanalSat', '23800156207575', NULL, 'ACCESS+', 'AUCUNE OPTION', NULL, 1, '2021-12-31', '2022-01-24', '2022-01-31', 21, '074303030', 'AM', 0, 0, '2021-12-31 04:04:09', '2021-12-31 04:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `reclamations`
--

CREATE TABLE `reclamations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reclamations`
--

INSERT INTO `reclamations` (`id`, `objet`, `description`, `client_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Paiement échoué', 'Bonjour, je voudrais renouveler mon abonnement canal box mais le paiement en ligne ne passe pas. Que suis je sensé faire svp ?', 1, 3, '2021-08-24 00:22:39', '2021-08-24 09:37:44'),
(2, 'Réabonnement inactif', 'Bonjour, j\'ai réactivé mon abonnement il y\'a 2h mais jusque là je n\'ai toujours pas d\'image. puis-je savoir quel est le problème svp ?', 8, 3, '2021-08-24 09:13:20', '2021-08-24 10:18:59'),
(3, 'Problème d\'images', 'bonjour, j\'ai un souci d\'images depuis vendredi dernier j\'aimerais savoir comment faire pour que le probleme soit résolu svp ?', 8, 1, '2021-08-24 10:20:13', '2021-08-24 10:46:10'),
(4, 'Réabonnement inactif', 'Bonjour, j\'ai réactivé mon abonnement il y\'a 2h mais jusque là je n\'ai toujours pas d\'image. puis-je savoir quel est le problème svp ?', 8, 0, '2021-09-07 12:57:10', '2021-09-07 12:57:10'),
(5, 'Réabonnement inactif', 'Bonjour, j\'ai réactivé mon abonnement il y\'a 2h mais jusque là je n\'ai toujours pas d\'image. puis-je savoir quel est le problème svp ?', 8, 0, '2021-09-07 12:58:35', '2021-09-07 12:58:35'),
(6, 'Absence d\'image', 'Bonjour, je viens de me réabonner à travers l\'application il y\'a plus d\'une heure mais je n\'ai toujours pas d\'images. Que suis je sensé faire svp ?', 10, 0, '2021-11-21 13:16:59', '2021-11-21 13:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('04ZmOdNO9F3474UusGcJrp5O1QLMjLEbywPMpidV', NULL, '172.26.43.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazg1bzhiU3d0VEJIcmxJS1NuSURmMXZIWTFBT2NvdmtsbEpDb2YxNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vNTIuNTguMTMzLjE0NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915549),
('07hX8lNV9rpWVozcoD38RHgbMyDG7hiUULCvVql1', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVENmZmk5U1JPWWlETURCeHR5aEpLTE40akc0d2NuZUlocGZabmNkMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914776),
('0CPejnqatKZiRIEkki0LVG6Tg5FwI0kM8Xsd72lg', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDJoaWxoY3UySzdWZ0tqNUo1alp6OThLckZUUWUwUVhDN2Q2dE1ENSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916578),
('0FDnFSabud6RlY3FAFzqim7RupR7xyXgmkpRVFyH', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2FUTlpxSDNjT1NseE01bVh2Zm9mZEZUMEFzdkNNSzJwMm5ja3p4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918799),
('0lGeZZdNIUTi8VKgBVFPZKUgFaow1ASUNiM0YoPl', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUJxRGxTOGF2andYWnU1Z1I4dGxHdWZTRzlkU0NIbUdDQnpJcnpTRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909192),
('0LmKoZIOZZu93hp5krH6xKwo7ppVGLJQbduC0l0N', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1QzYnN1c0ZlWkZ6d0RiaEZ2czUwek5LSWE4bVIwQmx3dzZCUHdFaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915137),
('0O1RQHlbltgbw4ggzwWfEiHCS7dInzmcMZEHsGRr', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmVrVjhvUUxpTmRQMml2TUhLYWptdHBqbGh6UUNHRkF6Uzc1NElISiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913996),
('0UpWJ2mrWJHLMFlw9ZjgziGzOCGddnL4CAHyyEY0', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRG9WcGVTNVBXZFRVZzFtU0J4UkI4OU9uV05lTHJLcmZoSFdTYTFjcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914116),
('0UWyXYKvLpSEjqFSJQ7qj5YEGU9Fl63kHMsmfjn6', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0R0N3o1WG5wUDRwdjJhajFzTlV5dGJZQUNpTUxWZWQ0TWhUVUxPeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916818),
('0vfOr4HPd4oSqdEk2fQDZKmyfThMto9ZlWyjFQeQ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2JGczVkUVF3cHo0MHJYSzJhUGNyMkpJWTBzWWgwNTdnTU5aTG1oUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916517),
('1A216ne82k6fg7RyZliJC87lpZMVD4cgAfDBABHb', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnV3cG9jcjlmODd3eEo4Y1FBdXZtSDJ3Q1J1cW1ERXk5UlRCNkZYQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911594),
('1bIKnGRS04udLA92jYGPjxIQuICOBypCwIIVEdm2', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnhHNlNDSG9pSnZId1RMckh6cU9uYzZkMWlSamttTGRxQ215M3B6aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913215),
('1bUxAOfsrdT5IwuPVfqyo7FjLhDk4Y0faRxOItmp', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0J0T3RzTmtWSFVBWGZlU1RxdFQxZEo2dFhJZHZBYWFZZndCclNmbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910453),
('1dZwHUKGIQJndQVqYSP07NeMGv634pAAIvTaYUIr', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGl6RkZWYWM1aktlcENyYmlWQVBPMHZhNzlmRXNhZHJqYmx5cmtUUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919640),
('1EbtvJX9fli3dKHaFLNnKABWbux7vhsM5pgMrIDh', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjZ1dHAxQ3pBSzRIblphNkUzcTk4N2hDbkNlczFzVGdoTklXR0trbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918799),
('1f9G5iwzMrLeGTpngHxLsaiewGCBJNg24DfKm8DQ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlhoSm83ZGlpY3MzU0kxeDJYR2p6S3JHd0JlSHk2aVpFYVZZWTJNYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913875),
('1IBGuKgPkQjAQd2JFPMdWR9j9PsSeUmIas2jmhyI', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclNKT1A1S2x3MFB6QkpOSzhxTTVqcXdrc2RPVk94aHl5Skw0cW5BbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917598),
('21XRGZax4nzKVjaNisO6nqDgXrp8hLbfygTWqrQL', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWU80Zk9nZU1LUzZwVWhiMnZGbXRnYlBhMVNDU0UwMDNhWkxHdTBSSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909012),
('2cHiJYcU0bYlMcwSgHO9AVku12WKqVSXMsFju6h6', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1ZjbFE3WG41bjhMMHZDbkZId0dETjFmNUxMb0NYbUdhWTdKZkhLUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909973),
('2eiTYDHTcjBhUb4GFVQ9TrftFdlfxMKb9rQyYkBv', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUowNm9lQVYyWUpTcjVBbnA3NVJmeW9mUFlRdUJkUGlxWGl0d1EyUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916637),
('2eRImjBsEgt9VtXWNG3tzWmHIOF0yxxzhxZWaU9p', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2o0WnRDTDRENWJYWklaWTBJVE5WaUNvcGptYWl6bVJTZVlNc2pyeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917298),
('2g3v2aIpstYSatHwWAXmZThn9lf8QZyn661rnG6c', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjdKcmtJUE9sYzZ5aXhmQ3JHbFRUZkdmRXNVQ3NIV1RrTE9wUG1zQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908772),
('2H5W0gaiD8VqrmtUaOI6U3ARW0sWGC4SRk4f5FWO', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmFGc3hPRzBsaFFvZGhldEZ3QU05eDR6b1hNOU85Wk1lTGRtc3VicCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917538),
('2hKpoAvT0El8XdjeCZ1Vn4UYvt05kBSL7kqscfN6', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTAyYUhSalNrOGc4T0Viek9uenl0WWprOWhQV1NGeHBMUWxHd2RadiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912014),
('2nURufpt4sA55kO5ADTjAGT7Fe6xGKiFDEwdiwHG', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDNteDA5SlpUUjFBdEJQMWVwWWEzWThEUVNzeFhMc3FmTmNLWHZmTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911294),
('2Rnz7jfMYJxFWGbPbXpLGrpLipMABhDL44jMfl7E', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUU2bkxWb2ZJRnRzZEpNdHJOU3VEODdHeGJnZ2h1c1gySktkRUNoYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915557),
('2zSUNPjzDU8Z1E67UCgugIOhWmXSlnGUEVzh6FAa', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUw4aWhqVWZTVHh0SUJVdXp3emtTMkVkdFZvYWpXaTNGcjFSVThJWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917298),
('3c94cCp9EfKpBN5JvOTDsDKPGgPqHk6rPAlPsYFX', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUNmeDR5Y1dhZXRtN1IyNEtXYmxXSHBRUTBGVVVSVWlCVFdiT1Q5WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909913),
('3iYJz3GBF3itHTb0SFhFXC9I41skPG8oPPQ9hqtG', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2phbkt1OUthdVJxajVGbHEwNGFieGRXM3pEUkx4aVFyaHBaUXgwSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915737),
('3xQPqB02RXqzAFgpHZT2GpQARalgd1jVhgGcL3gB', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEtBYnNuYThZMHZOUjVaZTV1WlFaNWcyUVMwN0JEdE84eXRNNlQ1MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915797),
('3yFb21XWDLrA4OyZd7Ls6fMA3deidWvLAfFO92it', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkVjQWZ4R2ZmbFptaFpiTkdYQ2N6T1hlWHpuN3NjM2dKSmZsaUdpRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909252),
('3zLUgraQevNheQFYBu4gQg6UielnIRdttRdGGqg1', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0Vta2VqdWdqTmVkR09TVm1HdWFla2g3ZnhVVHJHaG5yR3NldkhGWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917898),
('4AzJLH3R8UxyH4SKi4vkLcvyzs2634slf6XRFv3b', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkxHSjAzcnFOMlJ4ZjdwVUc5NDIzV01yc3JMbXkwaUtSWDVUakVTOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909553),
('4IAnpvprqmD58rnGPsfskXTx4fuR9umeVXZzPj2b', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3BUVFVJWXptdnh0QjlrWHZQcVlrYmg5eDcydW1YN2FXSHFDUVJnaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910993),
('4IucZMhVBRiUF7VoBTIDQhxkdZglddZ9j4QzN7yA', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidU9VWTJuY3Nrb0xYMG52TjV2dGxoRjh3N1FCV1dDcXZIZ1NuU2FJMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918739),
('4mTzDGHTRoOjARgNEwvqOzIoiAJ8UnCht71bY9ae', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmFSR0hOTWpjaVlaNXpvaTc1SnZ4aVpTUEFrQTdISFkzcFhIdHZGVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913395),
('4N37Beilt4Cq1KN1ImWABS30rU2EU6lLbopPVHrC', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjdkTTY3OEZOTUJQSjFIUnh2Y1Q3V0hXekdac21wRE9ORDhFcmdDTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913155),
('4qtVZ8sSvkgy5dUG89RWUYd6YrLJnxWRFZcYQbhL', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2hzdnV1MkEweGNVTm5vZ2REWVV0aFR1dVVrZFNLTHNUVDFOU1hiUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909432),
('4sS5uHzIcDuV5nR7UKU7S945qh3W7PvbDDZizIZt', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE1LS0VVYUcwS3U2QUVKUjJRTXV5WlpJRnUxQWJzbUdRWnRvenkwUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918439),
('4uRsr47Qja7kE3TaW3tbIYxF8rwrULRJnlADmNfz', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2kwTHlsbURCaHRReVBnNnZ4bEU2TFZydFF5UGk0RnRaRU5xdThscyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907931),
('4zn0tYOdppmlmnuE05UFV9jy94Ztzg96BTrOV9Pt', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDdrbEIxR3hVMlgzY1FSNXV0TFVBaHFGVnc2eWxlQ1NCV2lUUG1ZQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908472),
('56CYMBTM97sNNndr3URaf5QFHXVR859Cl2hltU0l', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkNIVkZ4aThwY0pwNExMYWxtSkpNVVZ1ZGt2UFZVQ2k1TWEwZVRSeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912675),
('5G2bLn8Lqh2FlnmGle06XzLDaGN2Juuk59bbOCsD', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlpCNHlVOXY2WFB2Y2ZDVW9Xc3htVEtnSzV6RU80d0VpS3k3ZWczcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916157),
('5J9fkaKM4UBMdwVHlsLYPMrIEhZniBNVqqWbVbQi', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWJCT0tQSGFyTzZROXRUSTlMRVk2WUd6eGlLSnMwN1dnVHdMSkdKViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912915),
('5NGso1H0wRRpXzg7hPjOcVuoox0DTXNiEOvbhdyW', NULL, '23.251.102.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSThTQ0pTcFl2OVRBbDJrUHZBWDVvcTlTTnhFNDVpRFBSR2JVU2lxMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHBzOi8vMy42OS4zLjE4OCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915158),
('6A0B8FVebrk0LzyCaPoFfGG5s6QjesKiqhrZuC40', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDFSWlNKWE1tdmlFM0c3Nk1JTml6MDhxUEV2TTZOb2VyVzdJYWVOWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909072),
('6C1kFoB9WyRUq10WUZLXWgKcIzQOy5eYI1rlpCZy', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlVVOVBWZkVFY25qQ0sxRjNEWm1TS0c3UnlHcnFpZVhwV2dVWG40eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916097),
('6gC0WlHSQyqjozkMa7AJwVS1FGBbWHvYFY4og7xQ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTU0yb3J2a2dlYm1JNXRQTkZFQWhCeDhaWk84UHNuV0ppb1ZCUklLVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918379),
('6MxO5IuaUK4uvb6ohJDOCQBIzNA2arHPDx2plMJB', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQktBNjVVQVQwVnRyeEt3SEN5bG53S015bVNkQnIxZlp0OUo0SVNKZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913755),
('6VXK4RwiylHjIEVRieOBJibSkeFdoaoK9doU8byI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0xzT2wzdVh5cnZtR2pYZkE4emZqaFJHRVJacnBBNEU4V2taNVlkTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909853),
('74cWMlrXJfrneqAMK65O6H49mHkfH5xvNfUyulu4', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0RJdWJScWFDNDZ2NkNzUHZBaWExbk1yelp0RkhZZmxXaGxHR1d5RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916277),
('7HG1QJBXDn05U1f4eHyuDgBbeU0k4SkrHI7QfM5U', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidU1kTWNYbnlGWGxlbVFhQ1o4TmVwa3k1eWpneExyWkc1am9va0psaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916638),
('7KxVXF3Oy8KkSBw8kAxTtlMpf8Lx8iffq3r0Xz2K', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFZKUXdEcXd0d2FMYmVuek9vZWlKcmZQY3A0a2lVbjVSTEFhQmhkNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910093),
('7m1lUVqDvyft9MrzfSn4ix1qCCnoRLd8MntjU9c3', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1RZdGtyWnQxWWZBYkxrd3A3bXBmc1FJT1pkM3BTTmRYY2RyekFZNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917658),
('7pmtoPnO7jV9ZD0qihk4UfkOoYHDKLUEzSdLsMwJ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHR3RlVnd1ZwcVllR1NPZVFTN1FSOVNaWU5SampvUHo3YmtMVzdtRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910393),
('7qzmUJsl7sosd5uyxHKAx8UdVNPqa7H0AbNyHTBD', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFpHdGhaWGlhWkY1U1lEcVJyOVFGN2Zwc2pLUHJoQ1BibUhCcDhGNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919520),
('7rd2JJ8vhWjXFCROnZqSZP000LFEEi9ashk2K54r', NULL, '172.26.43.207', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidE1kb2pKdlFFUXQ1RjZBUUt2Q3dXdmZpZ0ZXSXpwNlBidzNIdDloWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9hemVudi5uZXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640913472),
('7tezDzfhC4BLEr8Okzbk8C05CFbyPe0m0Q73rd4s', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTI2c2VDUlJOR0d1MEpXbWpsYklWRVRiOUVmTExUVUFLc2poelVBVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916217),
('7Vi3qWMNph3bfBpc7MYUiVr2r9VkpaQhdP80Ol8d', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTIxUWlmZ1RjaEtWc3F6WG9rMENLeUpQcm9ZWlE5eGVTbGpsdk00ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916758),
('85Yt3OC4MUXnpQh0cEpDrJ5xKWYZhXY8333RHjuW', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlhHampGcklEQUh5S0lRaWNnclVpZU9BeXhjMVpaR2xGTThmSmNoZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911774),
('8a5Bnr2dY2N67RPBwvL1cLyV6gP8LRAflML2aY11', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXhuU3pRRGk4Nk94R2VSTHh1WFIyWER2dHl6cHBoM0xaYldCMWdCTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913455),
('8HPUL57mShNasJmyy4WfLK0llLbDNeQdnIzyFCQA', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzhpZU5OYmM4c0hHcURvT3JCYUNWTE52U0FxRTRabTBkM3paZUZPRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919580),
('8iox9pzG6p5CmiwhEANUdJ6nkL5YF6orCKd2yocR', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTRuMHYxc09HVTgyMDdDaGY1RDJuWjZ0MFdzUzBHMllYUU1LOUR0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916037),
('8J1VNQhOxQo2o7Mmvn2lQO6OOUvzYmHY1NjEs53j', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlg0czdaR3Q4Zjlla3RpWjYxYlJQYkhFRjJIM0prbFl4YlRhQVFtZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919460),
('8Q6dDTYFW0MGsa2N8w94DTcH8udl6voHTA0WWe9K', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEtDeDZqdU1nUlZyMUtoQlhTb3U5aFltc0kxSUhoYkNTZVNoeWhIeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916758),
('8sfzgp2B0LoRUc0bntp9vQwl3LSl67TMLvFGlPXJ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2d4b3dQR0RpYjN3Tm9ycmhOZXczb3dMM3JjTmppcXhZUE9PUEpUcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916938),
('904wEqj1ZDLnpjGank9w92toJmN2UoJ6TRwS4GAs', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkxoV0lWOGVDR1Jhbmw5aUlPdnMyNE9Pdm5iT2JNZlQ2N0I2d2lzbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917779),
('91yCK9M0YRWfEk18EU09Coxxd8WkGa4JQykp0zR8', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnpneElBckluSzdLWE1XZGRnZjlBNmVPVDhpcmV5NExXUVRDa1JXeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914716),
('97CveQKewBjrtQMVmwGja9I9zYjn2ctTwnxetBsy', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkRkZ2pRR29jRDdNRnk0QTJRMlZGTXZXbDM0TDc3SlVqcUF5WjZQeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919580),
('98Ymi8IRidoXCocPwxM24tY5oGIswiLEngJFxwu8', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVV4T0lUNG1idUZLZkIwSEQzc05IWEVhUTBaVGpuZWpHQ2YwaGJ6byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918679),
('9BCe5rX5F57wr3ahdm1wqAXRosDLT7WyOAKgFwbY', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFExV0hlWHlEbmlqVmJNdERtbFYwYzZRVExRSkdZclFCMzdUakF1RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917358),
('9eiEb43U5zsKGJtLwwHEk46Ze7czFVXBFdTMoVfr', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjhPTzA4MG0zMWdDRGFrTkl5Z3BzVHR6c3NkRlpGemdUcnhsa0VadCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914476),
('9gLpHTAGt79YZA6UKPy05kn8y8SMgxYhnVJNvizA', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDQ1a0tlRHUwQVpIQmZJRko1cjQ5RFVxQjFZTmJyZ2tFMVJERjNyWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914476),
('9jvKBxsEQdTD2t4dZic01swOPaZJhha4M7h2kx1x', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3l0YnVWN2E5S3ptbnFJN2FsYnNFQTJjVW5lUWtFOW9odEx0VWJpcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908052),
('9PW58gvX3ldQqgBVuRcW8EllP1ihtT7pTrTgTHEZ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlpocjhSWWFOc1EzaENHTEtXaDJyWFZVQjBEdkduQ1NNNzEyN3NJbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910934),
('9tkPGP4pcdfDD9LLKhJZjvUAWmqhikY19fMqDIJJ', NULL, '172.26.43.207', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUlhYTRnSm5xOHBzSUxRUXd1aDZjZElaVkpPYlVRcGpSMjJ3bjl4NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640918465),
('9vW6HfOnqwStu8c5nv5ER86vDyhovdJ3zgKeMYee', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnJyS1A1djhmSzlQeXRFWG5hYjljUmo4ZXVOM1ZzaUFZTjAyNGlXUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914176),
('aAJt8PQo7lT5Rr7fGZkfMVRvb8HlK3ljSBa25nDe', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW8waXVzeHRFRFZrMHFnWVZDUU1NSnRHTkF0NlJxZVdFeTJaMjhtQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914596),
('acTQHEVsBiwGQGMrEnQLILZYsqXPpCVUHsm1JyNu', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0M1T2hXWW13clplU2QzdGRmeEd3d2VWVWxuUkRKWXJ6Q2VnaEFIZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917598),
('aeUL9uf8HfWKXtNEmxMbOa4zLotC2Or5p7ehfMzL', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0lRWWVpOXRsZVpJQ1J3Wk1GV1ZsZTJLQzRqVVl2eWJtVjVUNnhMeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915077),
('afcpEDcfEHNRhkQkbJLkEG65HrMLowpM5feAdQDp', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTBqcjc1aWRBMm8zcWNocXpwU2JjRkgwZGRuMWtZdVRFdk9HZ1VZSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907871),
('agShe99krcItuti7xUmqntNdOBXRo2gpkqnvHxOV', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2w5UE9xRXRHSmFQbDMwa3R6TXkycW1vNnBabWJpQXpyWFV3OU1abyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911294),
('Agv2ajtQ1A1y4zCcAHhrwVIO2XQbDz70sob1wgh3', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ29MYmV2ZjZIQXVwNm5Ba3FjUklkWE1UVWY3amdXRW1kbWJSNFNCbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919099),
('aMdcG5TY08zLeS9Vf83LNWSpLTyAAgFi75c6qgt3', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGo4RkNSS2d6QUFSUnVQb2M0SmRKZk1YQmNvZGJQNGZZcWt4YURJMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919160),
('aMUBrv1y7p4NK8vHvLBlzmUlOabL2ywfcko5PqmV', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1Bac3BJZkp3SXdja29WQlQzN0JJem1CMHpIME85RURXeWZZdGtqTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914416),
('AqEKz2lFkrSCaBaYunJ8Yy78Ur2tGdoKHoGV1mIB', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnJ5UkpVME51TldDVWJNOVN1b3A0ZmZpNmVvYVNuZk01QXNockg3YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917778),
('aSVj6cd42GJv6gfsrRCI4h2Qd05NCns5344KKdk1', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkRqWmtRcmdsb2taczRHTWVYUUhZN0VzdEtrendIYTFacFdPeXhSeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910033),
('ATYts2ALBHvKhyx15GHiTVGhQl3fYeQXPzQRkvLn', NULL, '172.26.7.104', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUIxTUZRNmU4UGtvN3E4RWJobkxKTEtKNHRENDJzVWQ4TDlMNW5GZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640909724),
('AUDYgrECgJuNTOoIplH5tp9k8Pi98irgOA6w1Wqq', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW9vSXVWYWFSM3VtRGx2S0lkTXloNFkwaXd6OHpLclpydnBDdHYxUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918319),
('avzre9qzF2aNNQQlktB6DzKw9q3QrE10ioTnnsal', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEFmOU5WQ1pXSUtPVUpGYVBwcG1iWjhqNmtuMWZWbVllWDBhNjl0SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911834),
('AYLAZSZ38VhKwQcyc8TUMBuqjcBXsAnQ9hiNh3aJ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1oyUkVURlJWTUphVE5GcmpTU2ZzSEIyY2M2YUJUWlk4U25NU0tqRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914956),
('az1RgACysXeYCaKeGGprIXc5Em7Dko8SXLl5SwDm', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUtHaEVaVkFDMXNUSnFsOWxtNUlCN2lCWjFXMlp2MUV1Y0FjQmNSeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913335),
('BDol75cPF038DX3tOxe1hHThFYJqwKDOhUySTi77', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVVsZFU4a1R6Um5ORm9CdGRia2dhOVROWEhORGhBcjlGMGM1aEJqeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910573),
('BDWJk61DFbSCq15rUrKxNIg1utBpfiu5zTzreTRz', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlFuQk9Ed0JFclA5ZFhna2tUVUN5VHpqVEVyVzRzQmhnbkVKY0VjcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910093),
('Be3v4Jj9Zaaw96fHof7KrGbBSKaGmyGw7Afl67My', NULL, '172.26.7.104', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmpMNGRHSFg1R1RFNmtxZWpsWGN3bmhVWFZ3Y1FnaFBPUldtSUNpViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9zYXRlbGlzcGx1cy5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640910541),
('BG32EFLDs02Ai54ei2pH0OaIegNnvRqNicVJ3WMD', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2RSandtcFZOYnU4OEd1NXAzNXVTSGVFVEU5T2hoMnFQZDhHc2ZNSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918979),
('BnZjWCBD4NWFmGMobpTZ4so2nQdnzzy3tE2j2Hpg', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUk1ET24xajY4QlBNTDZzYm16aDdNeXQ0OUR1cVVTMVE2eEloU1pmZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907871),
('bQzZYtqUr8Tw8suJgQnKZCcVKgog7TAln6IzzL2w', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHNyVmZQRUdWdVY3OWRHbXV3cVFDeFhzSzY5aThvbTQwNTJSRXhWeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915437),
('bSWk1B1TBwO0DvFTDxQW4F8mv9T1TsZ9xMN9FaCw', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2RLMHREQllhdlRyMjZZekRnZWpHdXZYeVBwNXBMZFkxcFhIYjZLaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918319),
('bUAxxEWAdJvGraEoQvVNN9s6jE62vFeFVPGAf1xX', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmVrN2FYa1dsd2FOb0kxTkhnbHJCRWQ2ZlhtVkg2REowQXBtd3FraiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909733),
('BWQDdw6DC570kD5zHlUc4rP2dqFTvBoUygB3qHGn', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieWVTVE1xMjd2VVJRRERLcGQzYTJpeFc1NThnMFRzNDZXRVpTNlZjRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911173),
('bXkDmUQ8HMYcvPfla2l4KShp7gnlRkPycgh5Yt2R', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielFHMTBXd0hXZXhMSWpONVJaMTc1bzBRdGpQZE92SVZHU0MyQVB3MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909673),
('BxKWC2TYdcgYYJYUY27KJsoSVkOr8G6uDXPDsQlr', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkUyN3N1all4SmowUnh0bmhKTnpSbkI1d08xU0JIT2V1OEVyemhMUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912254),
('BYMVpleFW6qNZhdps59ADFUmJqcn9qm1J0gJL2q4', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmNvRXBvY0dLVklJVDkxdXZDaWlpS0hMTjZKM0FVZTJlUmpxRndZRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912374),
('bZLji5lgbGTGddD7JjQQkA4Y4zO7Xkd1DF95fKVL', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXh1N1BNbDZPTXhUUUpOWktNcGMwY3pPVlNxSTBiVkxPZ2pWZU05cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916698),
('c2cdgYGs08fj0Y9BoykpV7IAwrI5RjvaIePgQyc0', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFRDeUJZVld5dHA1TVFkZ0hLOUc4WHNwNDRVcTlsWWR4ckduT1NoYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917118),
('c56FDNOR7vGUPbmCJc46lzS8zgkpttCXgxRbGgsr', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmRHNTdQRzBUMGRKWklkekJoVHZHZGRRbERIUE02azNPY2VVNTlLMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917478),
('C5rHNdzM35e0ygEiel492cQtgKUXiWxpvKTTEiFt', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVZjb0hpMHhqUnRnQU1LVWZicm1XVkJjUklQV2xZSzRQV3BhOUhUSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916398),
('CBWoGM07HP9sRZbrwzejnGSMHCeH6rH02GUNv7MD', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkJ6bm45T0hYanRYRlJaWmRUcVg3NGEzZUVnSzJlbmVIaTd2ME1teSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914656),
('cdzQUgapwx3vrBw1dB5jw3ypnpMoMeGJsK2FLxqb', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTdzd1YzWjU4Tm1oekhhRFFuVDNnbkxsYjhRWUR4UDVqRDJQT2RBSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915857),
('CeFZ05K83upljgigaMfIdIGkw2QlESbJj55XjWVW', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFZ4OUJMODJvQXNnMnp2Y3ZETFh1Wk1ENVdBQzBHbW41UFZZbXBTSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920000),
('cfbJMtVvoJ5u0iOswn34QLvxuAqoF6kjXhxteXOZ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUVlZDhVTGpQRHNRN2VCZVpFaWFGeW0wdG15WGx0TkdqYkxORmNlTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911955),
('CGpLSEZ2znl5DGcpgl9HTXv8HE3EsfXKJQ1cOv35', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV29tUFppejNTbGcyVW9PMVNkd250dnNTRnNBSXFBa2VnZkFVYjg2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911895),
('cHz9Uo4Gi1be4NbtO9BFAyL7qr9Eh7FNJpjbeczD', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3RycGNkSW9JSXhjS0dITENJSmZzcHFvaDluejlGZnJYa0IzT0c1SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911714),
('cKw2HZTuOyoIsthnx7ZooFI3lZSTW9tynWmzJlpI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGhmU0NMcUNHQVVPVWpJVTN5SUJsU1VWM0Vxc2s0WWhMUkJ3c1ZmYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916338),
('cLRbnRxcNzyyqPsfqhyho5UfEHcPp5xf3xZbcLBf', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekU3M0RCSHQyYUZtZnJlQzNib0x2MHBwQXZYTDRwZzlMazBxbzBheCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919220),
('cMnou3kHcAMxN0KRx5N3Ulk5nLy6Dwcxnf1ot1Ke', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoianVXZVJ1QTFEYlZ0TGhna3JGamJjdVVIRXBDcFZnTTdoQldHS01ibiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919760),
('cvJIo0SQm9bmLkVd710dj1k4YaM8tbUEUU7se2tr', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQk44bWlwdlJTM2d5M2xOa0JRWDZ5U1RpdnlFekFXb0J0ZFBGdEVOcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911414),
('Cx56ox6t1bH5j5f5wCsJcllRguY8n5gOkxpxdHDf', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXZUcFpmc3pqaVNqQU9RVXNKQ0pHcnRPUm10NjVXbkZHUTlyV3cwZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914056),
('CxBh61aYjubIQYY7aQXOyLUn7indutgxBqOPupN3', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDZlWmVXOXVBcThJTzUyajVHRDhLQ2trbUUyWlZ2ZmVtQlpJUWxBYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913575),
('cxS7AwHd4fZeIf2fgnbvZ9dVBc2qNFJ6nXvLx5aS', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTG5jWno2ODlmVWo2TXhWVHAzeTRXOXFOZHF4OUw1SlcwTVJ3OEx4aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908412),
('d40uUxiVgegE0PYCfiboVl7H9ca3vbs6TfgmqRRR', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjg4bnJWVW5ndWxadE5DMUFyT0hxSmtsMXpCTUVxZk53cWFKc2M3biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918679),
('D9zAVeAoRJxdmAXsHQWtnTRB8SjxmLXQtq6zpFCq', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0RDRGJQd3hER2FlclJKaGhGRlpwTmNQYWc4VXVrZWtUUTFyb256UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912135),
('DaWul12yfevPdcP5ACCZN7uMvYiZxoiDid7S72IJ', NULL, '172.26.7.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWk3OTZIaWdNQWg5ZkYzVm9YWXlOOFdYaEluRUxFQTQxN1k4WFFzcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vc2F0ZWxpc3BsdXMuY29tL2NsZWFyLWNhY2hlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640917385),
('dgwd2m3IUsuL0XVF9hK1kEyMFqJqryJoNTsCOF8e', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEx2Q2V1SU9kdmZQYzdSMWEzdWdjZnlyUGRzU01WbEJxSmFQQjVWTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914957),
('DKYmrVSPN3NHqNQD10WiMUCgXRKjd0u6E8AoY7Ju', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUdnYXRvS0xreVBlQms4U2NCVWdOQmMwR2RuRDdDdFZRQmU3Wm9aUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908952),
('dM50zy0BgJzkMr4fXTOajAufW2qSMINg1aimVlzY', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlRIQXhzZlNDQVAwZFlYdlpkMktUdUdSeHBXNHc4d2ZBMzNLTk9RbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914056),
('dMWuzPHUJ3amvTR5G3a4R6Vj0XIl2EmaOfuJDAvY', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDI0cXhkN3Bxb1RpSUhTUUt4TVh5NGxjVlpTU2dqUHZxc0FVYnVsNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919220),
('drxqxDRPjhm1u5roc0nIpVylYaCCrzwNHWI0vyid', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkpIemZicjFxUjdFbUxMSk1UZjFEQm5kV0dzVzI5QUZ3eHdKR2NhViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919460),
('dUSQP9tib1m0XLyg2FpUaQesnU5mMy3Ic1ZlIQMt', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDkzRkZoT281NjNTM2ZMVXRua0hJSVlDZlBDRlM2bkFodzExbG1YUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914536),
('dwxxAZA3zc6BuPoMvivec0ZMWwRft5EahUnWHzbs', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDdoMHNFMHpCM0dxR3phY2RKdURobURSTnNJbDljckdkVUVJVmZvYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911654),
('Dxn21DpUNRTQG5sTFslsqhSsViDzThw2tE2l9us1', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVU0OGo0ZXZtSnRzbVBOWHlMTDJyalQxUVFobjJ0OWx0dGp2MG1pZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917659),
('DxuIo1u3PPfIFQOxeem5ruhW2ow4sQ9FPlNZv8aE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTZGd1hwdjcxYjRMMDNpY3lhNUVxcWRRS2x1d0oxREhxT3JGMGdmOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911053),
('DxwsTEkafB8474BSzPbfk1C5yVQKppwDLFa92n54', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXhFWWtVZFFQc1JtT0hHOGNFMmZFTDdZM0NmUUtTNmM2bXlkV2NlWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916397),
('dy4QRBbWJfVlp5FIq1Mg2LL1njPXhb5Gx3sc2T3Q', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODJhVFk2ZW1SQmp3Zld4UFdsNTlic0xGWFQyQmQwcDJjSDBJOUFHbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915797),
('dyKUT7YRLsSKB45hAMphLl0V5C07ZZud1YAPHdMD', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWswQ2hadHBVdk1BbFNkcnFaeUtEb2ZGblJKdnZXRXJSNzdmN2k2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910333),
('e0Zm05uakhRPlkT04LCzlITX6pt0D47XA5Ax6xlO', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3BKeTZ0MXVxaVJlZHFta0F1QnVUSWN3aFpNMFc5VWlkUThucWFUbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913275),
('e24ZZQKYApArqnIdNrmwCAhaZgR1fhAOFLdr4v8N', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic043UmNkUmFvMEl6dkdaZFBVSU03dG1IdFE5dzVaeERDWkpUek43QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915917),
('e6xshwmqEHquo59AIk8l7tJnCFtgCqPiwdyXnnMu', NULL, '172.26.7.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUNmajVYNEg5UUNuZHFWZFlEWUtkY2JsQnlUOXB0NUFyYkJQcXdzNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vNTQuOTMuNTMuMTQyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640908298),
('E8QlEZAZEboKd7K3NOzA15bAh1iPwjM9Bom8d2dw', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieU5wMUdnQ0NkcTBBWUt6d3VCZnJTVTl3ZGhaRUdxVEV2aDIzUW5iViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915977),
('EfnlU5bO5znGFWht2pI4qRGW1x3iv3LJJElWqDHj', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWlwMFRTMEUxNEZINU9uaVVNTXIxRTJnMkdxQkRNVEhYYlJlRG5POSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918919),
('EkEcWz2bbsTZEHnbfinoBKV0nakSVG3oHjX56xQW', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVVWanRZaGF6WnBMeGgzZVREdWs4WWFsd0ZxcUpZRlRmdGFiVDRMdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910213),
('eL0SCmWzh60DDrdn8x5xvRShMw1OykcEB4Yt0e6p', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm1NTVdEYUxwNXdidTdJSmRJb3hwbmUwa29kVWIyNE42TzRGWTFSNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916278);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eLE3SRbKm1p4ua6sK0kkm9C8Q39aIWpV3yab8XAt', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkcySmtQblI0aHFBWGtYUE5XWWlwaVBUb0R0S3BZU25yYlp4RWxmeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914896),
('envpW2a6QIJcF7zgFNVUaMufmhKBnZeaTiUDILHU', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXVqbHdoeDBwVEppQjlMNXJuNU04a3V1ZTlkTW5rSGdGcTZiZGZRQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908292),
('eo9lDKVTGdTS6ugYcXoVF7XdoDfIddqayxxMSE0H', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUW5qeEdZc1dJT2tyTFl6dWVIMnZhUmdLanRrV3RtT05aOUh4UDV0SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912674),
('EOBGMpAvuuTvH05YwwqS7c3kobVJjnfevBuiOFrt', NULL, '172.26.7.104', 'Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZvR0t5Qnh5RHg5S21RNHhkSmhtc0Nybzh3NnJFM3hGaXdzUUhZbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640911878),
('eoLRRlQAudJ5fjdnTNc9DFb6o7VAlGkQoX0nsTqd', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTlPcFJLazQzbzY1U2QzSWtucFhsNlBTQmtHNFJxOW91YjhiUnltRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917958),
('EqlIIyeB3EbsIT5BziQn36rlUInqjmvLF4ZHBuTs', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUThkTEpzb0FHSTBqcll0UFR4eVllUDBtT2FQaHZ1ZDRyS000RWFHMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916577),
('Es93Kds0nu5mxig3bv0HhhnaIV728twUQ9ah3NuI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFp4OHZrTWhvU0xDUEhWa2hCR0FYUll0TFNWMzFNS0I5UDhLUm56NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914836),
('eT2034TuYIvNcu5CGJQIUx6wcOrlhpNgdQGMd3JJ', NULL, '172.26.43.207', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUNXYUxySmt4VFhmSGdYc2I1RmdtOHVaN3lRU1A1cnF3VGlLU1VrNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640919917),
('eVslpyYQqhLCwEIEQsZuXkhavpQDlWbzzFDGrvdR', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUw4ckFCUW50dHVUYklPZk9aVG4xODVBcjkwVFc1eWNVejlud3JleCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911954),
('eWTYFvAS7Kw6UnNCn7BWNpWBInidsThsEzEYmPTI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3gwbVZDWlZwazF3dGczb0FJa0VoN1RGWDRtcEJacndESWJmQVpUdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919760),
('eWzdS8xd8hQnzQ3da7Dr5ZjOblyls4aEvXGOrTY6', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0hiaGNIVHU5akc1dDZyeWh3RWdVWE5GSVlLTjhJS0thMGR1U0h4TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908652),
('EzmiFzUhxpGCJiMxMwj3r47pu2nxhILInuc27TDs', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVcwVTUxanNDZHIyS0hndGNrdUdkeWpwVm9uQnhMWWxXSTlmTks5cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911354),
('f4GCkrqNGZJEoldQ6FgiJLRTM9KrytMgsUCvlu5x', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibW4ycm1Sbm9Zck1zc0ZSaExyMG9FSXQ2VHF6VmszaXNYWmt4NzQ0cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918019),
('f8rFocM2IuCkHr05WU8pTtohNAlrzkU0sp2fkA3q', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia01yZHZGb2k0aTY5cnBOVmtqMHE2RWZNT3BQT1VmU3QybGsyS0N6SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919280),
('F9AYb1V0XPysUUH3IXFKGbWlw1milvgM7uh44vpS', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDlSemRyS3hUSWRYQlVYZllSR3E1a0F6MFVid1pWaDBoUWdYcnFXNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910273),
('F9fzc5X4rIhvAeBuHy8KzFEIRdK6Nt0eNBcxeDF2', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjh1OWVWa1VFNWJuMUtKc1ZlajlSUGhHMDlGdHpkVlhjRFl4U1I3WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910453),
('fFGoQvkpuU56rcgmLgC9Y8GtzYsIJ9HL99M6qIbW', NULL, '178.73.215.171', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE5keTFMTnVHVWM1cjdTRThqR040MkpNeWZjSVhkR2pLWFA2RHZKRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vd3d3LmV4YW1wbGUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640914924),
('fFv0NAOH9sJPVeUsdNgN6VvrpefxPfdB1psK00bq', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkhxVXhTSHdBUDJaZ3Q3ZkdaeXVYTXVha3ZZd3RVVDY3VlhuVTNzZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909493),
('fkuwZow4MAPIzb6xxuzxNRGaL4jernCnTevRTqad', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOU1mVWs3bGlzSHpzc0lmblJFY2FXTkNRY3lwNkNtZXphbnh6bHVkRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909733),
('fm6jszyqj74trAreEZjnRMdhYHNxEQBzQ5Hxi1wc', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDA5aHQxNXRpU2Z0WW1pT1FFN0VzVGtLeE10WndsRGw3YjRXcXZ2WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912315),
('fSb61oNY0Qg7fXDoggaiOeQZ2vyu2wXQMsuZklyO', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHp2aW05bkppTWtqemNWOWZRQVZaQnR2Q2c5VTJNRmRMakxOVzVobiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919700),
('FZjkkh5UvQDjwLfsaSqcMZNMXDluko2z8PDS7hhH', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlNXNTg2Y3d5MXBiRlAxTHA5S1pJeDJ3enVjajVjdDVDNm1GTjdtNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918559),
('g1hhqHaCfNxYnvkOkZhGCa41uUquFKdTEMpbkzI8', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEtEMWFmVmt6ZURqTDdSUzlSWXlmNElIMzZUblpPaGNTWnNMRTgyYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908532),
('g98EFdIkij4Rb1BAwKHK8Sp3D4Py3jBSUp7VpiVw', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjdtUDdQVXp3U0Ewbng3TmtVN3F0NERpa0l4NFVXVEp4Tm82eXM4OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913815),
('g9qtKib0MC8DBbcwPC0xb1iLBCENhegiteeEVt43', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFgzYjZsVG1KRWdCbkhMY25od25USmRzVWlyeTBFM1QyWDNUbXlsbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916818),
('gA55VfVqErfQrmQaJ33eIrb05RWncGqodksT1Psi', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidk84VHNUMkkyRkx1MklmNUdoYnBBWU1WT3QxcUg5ZzNXdWdMUTd6YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915376),
('Ga5HGvZrqbex2A1sTt9J2io7PE6nKUQfs3mvSSOG', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlRSR3pmajY5cENmSnBJZ1Z5MHBtSHJkWkpmQmZ6WEtLYzdGaTVPbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916458),
('gb7j7VIAF7DoD71fRvailpgDjoZpsLAO2buMjbfq', NULL, '92.118.234.202', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHJaWWlCclh0VVpLU0VSZnVBaXoydWt6cllSaUdEY0F3RVBFTnVDdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9hemVudi5uZXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640914181),
('gBgfbcIVn0b2ovOrzQMHLJI6tyCwNLp2Bl1rNr1r', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkt1dDdWdHcwdklxN0pUTWtNNWpsWkZOWVJYeDFwaHFuSGJhVGRpdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911594),
('gHG4hguNrxkEUuJhfx6jGp1l1VoHAK2Pr4qtBPoA', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWW5YVjBZQ2RINHVoQVA2QWZPcElwaVVsSXFyTW1WMUhOcUxLenJ2USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918079),
('gHHCvZEp2JKM5qitSysS7w6gtDKZo5dQd3icRa80', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3FpT2VMY3drNG5lWEZMcFVaMzhzUEZpQmhRRU1YQ25LMm5wMlhKNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918259),
('GJK46UNNtJM8w0AjRvr89qhQOZLMok6Ds7fQzkHI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM21zUDBYYjJxMXVYVWRuZTk1RGN4TjZzVFk0dXBGNGNPMFRZUjNtbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912555),
('gJuOFprGI5yvHx3CP1xj08h0UibGPqZYP7rVUFA3', NULL, '172.26.7.104', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUl1d1V2SFNhaXp2bDRsbVZNSDBFWkNzY0Z0aU5HR0JlZGp6VnB2RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9hemVudi5uZXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640913467),
('GkEyxL8MX5VZ45XgguKYvYFDObEfvaCGu1bnVBim', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWxBZFM2RDByUGZQaWtqTTRZUzlTSHlDT2M5VFB5bklQM3oyREpxbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917058),
('gL3KWavBU9HUcmFYyDWBqLeuTpQhkgiKQ6ANGRpa', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkdFRWtCNDNNOTFvcHhIc2VjYm0welFEWlF0UHp1SlhubmJuaGw5QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913936),
('GlQAcHli1bLzCNasR2caO63VVo0f358UDwslPUgz', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYW56RldIclRvRUxSOHlHNzJDUGZpWUtPb0RCb3hKZ3FUcFdYZGgwTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920180),
('GmJF00mgrgIbKrG5q3CalR3J0DximJKEGWeGZqow', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3dpMFRuVlI3MGcxOE5EbmN0dXdRckFkdldIRHYxQ0puaG0zVGZzQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910933),
('gqDkdy9pjXLukOuGklKKUByk5dL8H4RzGBlNh0w1', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkZLYndRTEVCSG5ZQjl0c0w0MzdZTFpHd1c5c1Q5Rm1hZzdJU1VKUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910694),
('grI9nDrVBqVQATvpENnntPqsDMgNmLRbNN1vppzT', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzZPTHRDdG1aY09DaHZySFFUcUx5czJGTzZ5MDZ3Nm1Ic0haY1JZMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917238),
('GsTUXU8WL4bgeU9nwNDwz54WpbYWhQR8tHEqnrxz', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmpaS0pkZEZlM3lSMVhJYjVTNjBDdk5OZzlUVTNRU3RQT2RoYlUxbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919099),
('GZ8lLfF9Yrjn9ztZbgQaaVai6HNYuhC5UbylUaXX', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDc0QUpNUVhWaDhmWDRhUEs5bkRyMkhpcU5kdnhobmRqUGpPZlVhcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917538),
('gZSZfW1RqxerJseEpH43vbmWrHxU4bvXwikrX5ZN', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1dNaWlPY0ExclEyWDJwcUxJb3gyTXZwVkdQWlJBcVZmOXA3a0laUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920060),
('h8QhGD0quRwcjaiD71N6BtyLxl76DuH6BVtY7pXE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWJFUGxwaFdDcXZOSnl3b1pQNjJwQlp0N2xxeHhSQkV4aFd2S0FiaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908592),
('HAFWxl8CFnKSlOPhsOvobYs70bE2nwsl9GaCtlGI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjhQQkZkRktKYlBYWkxqc01kYUdWS3BEWW1FZ1pURzIyOGFtUk42USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915317),
('hBp8qbsSHSFLKEG8DkJHzicgSj3YBlDunchMOMVS', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2thMFVZb3BlS2pZNGVPblRmSmUyb0xlcDVNcjFOelE2cHR0d1dmdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913635),
('hEkx2QjD3shF28X3RQbnhsfvJ1jPMgZmAR6ILptV', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFFYa2s5Sm1wMTFtRTVmamxEZEREbWRBbll5Yzh6bFlCcTFkdG1DYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915016),
('HfrmVHtACEt6XOfiqkYEEvfgt7HIYng1DQBMPg43', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFA0dkFwZW10cFhFZG5NRmhPUHFBSzV0S0R1WUpDSFFXM05oc0k0MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913395),
('hI6JQCcrY9zHoselKuPglhhOHa6bM2ElZ5WTzDwD', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzZNeWhGWDdmVDRsa3piRVBBRjExcTMzMVdWZDEwSU5vSXZHZ2tZbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918439),
('HILrYJzOn1TxRkIiq639CInPdAjnMI1bcqPJ2r8W', NULL, '172.26.43.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVhCVmlINm5mcGZWVTgzdFJ6RnRkckRHQlBES1dxbWJ1MDdrSU5ESSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vNTIuNTguMTMzLjE0NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908818),
('hk9Ak2jOML5utg40TMe3a4NO7ZGBlvkO1DyB2zqL', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXpxZVp2aGlvZU9EUXVUWWNlRHdBOUZBNVJSSTJFMTBGQlc0ZTJwWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910753),
('HMYny0Yng7yI8u8JkDcwiPZl0bYE6Mbx8IzwRoBU', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUZFRHhsNkROSG42RUt6R3BSMHBPYVF6UkMydUNjaGhyZ3pJUzduNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908892),
('Hup4aKDL3jyXTasQALAgPKts0CERdIScyCmTyW00', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkdFQ1ZUcjFoUGJ4c0lRZDhTMVdVeU5LQWZzRUhOZlJJWHZxcGVmQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918619),
('hvfjklbPeQohzIcBjra83KJKOz45IAovvesL1Wqb', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnpMVUdHYmRRMk9xNGlQQUFKZnZ3U1VUb0dDTkwyOVdoN0dKcWV5USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913155),
('hWRgKO4NcazDbwzR0r5kP7WKQBBdr1XqWg26JyHe', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT05tMnA3Z2NKa3NXUTRMOG5BT2pDOFU3RkFYRjNzWjhWTHh4Y3JkMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915617),
('hy7bAtUpXVbYrrft8kaXKd7l0dgAiFBlOnHwMZVl', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2FMYzlnM0phSE83UkFWSlRURlFYQXowQXQ3aVVYMGp3bmM0U0M3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916518),
('hyGtmEqcMJE7e7GGUk9F21VH7Rv8zQ9mIH4AcHrO', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGFGZVUycjZ2SG9Td2l4eTVjcVpteGc5eElWbWNPaVdWY0c1RkdPQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914296),
('HzlSuhvtHooWfdGjn7BOajgxmqSXkOcTowqjpRcZ', NULL, '172.26.43.207', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWxlazRkWm5RZDBTSFlFUzdKQUZSSTc5WUJoTFJnTnhHRzJDcDdTdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640918465),
('hzVm8GRcCXW8W0wihYhjfs59BkE6SNDWy0cW5BCm', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2FHMjg5bXFsa3BxdEFHNG80SDVHaUJGNU9WNU12b3dCTlNHa2JyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912195),
('i39n6AndZoSUKEs611I2kTCdSEjKgIZ66Y5iX9Dh', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0hLZzVHczZpS2ZSTDdxWFZuc1RvS3JWaGVSTExIbHk1QmlHR2dtRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917899),
('iaFS9KeeoI30HTxvblFhrekzdhJvwr8etWeNpSwf', NULL, '209.17.96.146', 'Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmpFamxaQm9VcTYzc2p3NE9RT0pkYVZ6dkJabnlUa0FnS1d2clpIcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly93d3cuZXhhbXBsZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640917308),
('iegU55bhyHKtOWnL5qfeg0Eb283gbhFoQ99kVQWr', NULL, '172.26.7.104', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0tVNVE0aThQRXh6b0ozeVQ0T0UxMzdQQ1dHTVZ6ZVFYRk9IVENiZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vNTQuOTMuNTMuMTQyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640908242),
('IibnghPH60ukbmJWMQSbxJPM5ECtDbYGD8rf9EHW', NULL, '34.140.248.32', 'python-requests/2.26.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDdrUDl3SkIybno0aXg0QTBNWVdLVThGMnh0ekFDTmtpMjBQeUdheCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHBzOi8vMy42OS4zLjE4OCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917458),
('Ij9h3EAciZDcjFrZfpvXud4wZVeedaJyJWbCWAcE', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDF1ZDZNTmRrekl2aGNHendBUkllQjhlNE9hR2IxSzRqcE1aS3dPZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910513),
('iLlJaEgTldJVSvv9MikR7JMwRD4rhmVCYHt0LeYc', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibm54SEp4dE1VMlJPWTJOWnIxY1hFazZBQW5sRDlEWXhDaWlVZ3dLZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912494),
('ilWg3DaZFCPN7vm7Imlhrm75OiWQ5R2LuoMJGaja', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVm1lcUZxZ1NzUUdFMk1Ndld4enprRlpYdlllQktyWTNPeFdWWGZNMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909132),
('iPrzUeo2iFH9vupNguxCDfgG2N9ZHcYi3cnBL5nd', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmVOSTZhSUpXeUdJNmRiUWhOTnBYQzloZ1ZyR3VRdkJzelVvM3I4ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918859),
('IQnV2O5IxLYWmAGbUm2BH4HTPEf2TEYASTZdoHzx', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGYybTJNMHFGc2pQeXpFZTF3OXFKZGh3UWZMWDhiNlhHUTJpNHBGWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910994),
('Iu5WbfiF2zmZDCUgcB51LKJENm6ATTdg6hVXIV75', NULL, '172.26.7.104', 'Expanse indexes the network perimeters of our customers. If you have any questions or concerns, please reach out to: scaninfo@expanseinc.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0FDVVVvMFlRdG5vRzNFRURjUE82WHdacDVrWVFKbHlsS0tMR0hXUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9zYXRlbGlzcGx1cy5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640918838),
('IwxGIR397XLgAydfTqX4sxkscefGgq24LUPtvYAS', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTV6aG84bDNramd6S2FTVTJxQ1pQTGcwbUc4ZXV1NjJRWTI2VWZSSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908411),
('Iy3djqW2LE9SLdoNKlLO5azNC4qmcCXtNzib7BcE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNk9NN25adjNaMEZBNTJSY2RtQ3J4eHNEeENyUENqeHBza2c1RmRKQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918199),
('j0c1uAO1Aiw2l74zHYIQXP4tbJnr7q41dNUAaUV3', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHE1RTJWU1pZQ1RIUzVNNGQ2YXE0Qkdoc2JoMVlOcmxBZ2ZxUU11QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915197),
('j1Z5TbHnz75jt8jE3y2ROSFI6EbWv1iS23QKwqdt', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlpkNFpVcUhjQ3dmMHpkUUZXTmtMQnVNeU9TN2RDWmFSanRGZGFtWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910874),
('J36PcrhkbksSha3GY9NI5VsgVLOsosvyaKdLWIeT', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDI5bXNnODJSWkxqa1BVZmNTS0RjN3VJeGdmNmdINHJ4S3V4V2pJaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910693),
('J48V2nEkUM8qwZBZngJIOPZLmWZca8fVSThrqZse', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2VGSWp1cE0zU0ZIdHg1YkE4N3Y1Y0tpcTZRbUI4NEF3Sjl4MkN0MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918259),
('J6k0Csk5wCT8xb9Tf5TEeg9Tb0xfGXOVbLCsMfgA', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzJZQzRNQUZua1o3VWNhcEVDaU5HMGRmNDBaaFJaZDdYODBUWDNJdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916698),
('J7LW9CKrtSnZljFz27gGuoMAAHdsVfsdzs0Y1O1A', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZk8xdUpGVEJlMVNETDJHTUJwcmpNMm11c1k2ZzVMVkcwZGlZRGIxRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919640),
('J8kqS8rUJVFST3LTRMRaRN4UEYuFhkH4fYMbZ5kQ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEFrZzQzRUczTEZvUVRYc0VtRTJQaWxiT2JscTh2NWZyTlcwWGx2OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907931),
('jGWOUeYaQZwVLNQCFehwTWkUS3XSwEMUiuxaz7uf', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREZySVc1M21STXo2b3FwSTNWODN1V2hoVXhkYmo0dkl6U01FcDJBUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915076),
('jJhOoAF6sDuvVrYvPFarAaj2PiuDT4Is8zeXzEdk', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTRpeUxZamhCdk1rVnFoWWt3NjFGQ0NseHVtaGxmOTc0VHJaRThyWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909132),
('JkSa7AxrSYsHhL9mmbJeaOjYUJLeS2lb9OIzGJNn', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjZkUXZXb3FQMHRkcVFiV0J0c2llRnNKaVhQR1hnaXBROFFWelV4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912614),
('JLVjKGkK6hKgfDVsxZZRerWG3kWtPBocBrY1OyUO', NULL, '172.26.7.104', 'Mozilla/4.0 (compatible; Netcraft Web Server Survey)', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoib3JpNm1VbzhmOEpIOHpORG9jSXNmbFpFZlNpTUhZRzJLRm1IQ3RLbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640918489),
('JNB3fJRePdfpeux02GqjMU2GcDOwZyTTvFGeQkia', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXh5bW9zcXZPNDh2WXF3ajl1enU5TFFTZFBzS3NqYnlRVFpKdmNRYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910213),
('jpwCEXQgT6g3O2luLZ8BZEAqWmIIUTQ8hvhkpgJM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFJCTWUwZXpBNGJMejdQYldPTUhCejJPM1hkbElzMlNjd3FXRFRuciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910873),
('JqA09TjCtoPzPDDGWFMDPCEfvU32rZhFZslvd2AK', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2ZUUDdTemdwajdoRkdqNmUydkNNaEI3UnR5dlhFem9QSXkyRmd0aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917719),
('jqX916ZnurhoXBFfPlfFTE2VUvtLM6tQM0SWApyk', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1dYTG1lQ2c2RHluQkNYUEh0UGRqREl0MkptZUFLUk80NTBaWXlMYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911714),
('jtZraggTFjV9MaF9kesie9Bc7o9urbO6DhMx95Gf', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkdUVlVrSzVKUEdUcDd2bXBDRTI0eU04S1VnMlRINUNBNFR3OEx2eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918019),
('juIJ4DPb81m9J0SY4AXYXMErq5bEteLSBNGGboIo', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDNKMm5ld3hiMGFuN0RlVGtEcXMyOHRXVjZCb1F3czdMejRLSUdtdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915256),
('JWo79i1PK4l4GgCT9Ztr5By2KLWTYUB6KXOrRuJr', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE5HakRjUUZuM2hIRk5lRmJDSDRQNlFRZVhTWU1tQVk0a1ZLcDhRYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908772),
('Jx3x0eNav2Onm37bzUDRGwaiOFSpLYsXRHauHATT', NULL, '172.26.43.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkE0TUswa096TjBlaDhRcXhBSUFSZEFuNGd1clR5NjR1amdiZEhEeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640909442),
('jYggpdJ7U9zOUnz1KCgAqtrlBy8ktxiEromiAyiW', NULL, '170.130.187.26', 'https://gdnplus.com:Gather Analyze Provide.', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2Z0QkJzSHVEN3NIazVHV2xaQWdzanh1ajJtUXR5NlpCR3BUcmFNYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHBzOi8vMy42OS4zLjE4OCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918378),
('k1GYLW8XQNyVDwmszOzHbI7Ap9DEIknZx0fhJGVZ', NULL, '172.26.43.207', 'python-requests/2.26.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmQ3QUd1WXdPMm42OFM4TmFNbWdrNHRkUjNoVlVwNEpiZDgyMWdlbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vNTIuNTguMTMzLjE0NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915771),
('kAtUZjZuWNYVj2LEE8nXKpcCkMrIbIPTcKSUP0Ol', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUZaR2Y2cWZOclJhNmFFVXpqQ3RPcVR5WjBEUFJJOUNJUlFUaFJ5VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908112),
('KBTG8oY4XDdEvyW4HH4JnNXiRgnvwLFuyxbJctER', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDBWaHl4MVZHRGJpZEkwekJoV3RHU0xtcG03bVpUTTc1WjVnbFY1biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908532),
('Kbtv8yEoSWiAugLdqfsThHD99dWku01rKWyi3PAn', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHgxQlk2ampXRldtbFhmeW1KdHFjVmFGN3EwTUU0YUJJUldLbXYzRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910333),
('KdMFM7rtt2fXJn6XjwDhHoxQFc4sWMdlt0Qg9Dof', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVdlS1hVZlZXdDNxOTZOQlQxREI1MEhPT0FtSmFkVmJmNnJIbFJ5UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917478),
('KkXD1TthiZeKCsUV1sQYQ7bCDoKBeSCQYxocs4Va', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkNsMU5jVnhDQjMyN1ByU0J4RWdWQUk4N2h6eE9ham1hMjRGVktqQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912075),
('KPhQOKGbPVzCuyoxInPGCvWM4JxSIKjVgFp45nH9', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2VjTW54YkhiZkdTdnA4VlZqUUxVdW9FMU5HTmk1am1XamVLb2R4QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917959),
('KPtZBFpnjOouPvRG0STMZvz3Kh6Ck3IKxz7y6SBr', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHhIQ0xYWmZEM0VMTXdJbFZqS3ZPTVJmbGlGTG5pMlNBR3Q4bHRJWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919039),
('kRyIeNwb9EsM2cZklfSGVtAMZIdsawLMO3Pm58ah', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzdqZFJXZ1pjSFlxd2c0Zmc4cmdscUw1eFdvSzZHQ1Q1SFlWYnpDQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913095),
('kSP6mVJwBU5UaOZegiDnUSSzMGfoHDM5Y6sueMeB', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0ZWMTdKZGxlUGVONk5QalhNU3lEVXlIVklobjNvRG9Qdm9Jek5kaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919880),
('kTccCqbirbssCq6eTybKzFyF6ng12Y2mW1Xo6hj2', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3ozNkZUNXN5aXFoVXRGdlNudTBwMGZzV2lxS2E4NzVQMjhRSTRVTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911054),
('kuIrrgK4596LwOFKY8rOnKRxDxz6XmcFrJJft7d7', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnloUTJBVzlJVWhRaWc3bHAyaHdXQ09zdGhDR2lrMHJXMkVpQ3NZUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917718),
('KVPEgfqEyoLrI7JzgYcfEvnBbeDMOOLsFTE5zPNR', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQThCbU13ZTA1Y3M5clNSNFRobVJaOTdRRHprNEFLQTg0N1p5Nnh3NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917418),
('KYlSyc2OCnH507R7paMfE33jVRNOZJx96Q6BJEFY', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDVuWllocUh0dFY3VTBpRWtUTWpkV3I0Y3E4NkdRT0szcTlXYjlKVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920060),
('KZV1ymnE1C41OTYj8Lrw8t2Py88KrmHTnpEpFbUB', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmd2TnU3MkJVMnNHMm1ueVhHM1RRTnZ4RXdKT1hyZjFCQzFkOUFiRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914897),
('L4dH8ULsf7ALy3ODyHtKyRuzIQM7Z8QTGtoeAv6V', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjk1cUwyVGZiV0I5WHdyZWlLd2FRT3B5WTd3bGNWZE5abVJqcGMzbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912795),
('l6DGTIPQQtcZI9v4mSxgrXn2Lj8Q36XWvPqHrbgV', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUJHY1laSWVtUTRTeHM3bUQ1M3FIYkNZM0VNNmlXVGNFb0tSMDV1ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912435),
('lboTAbGDGUl2AKZ8mB3RGdJOqju3j91rdkD6sNwU', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTM5eVpMRnVRY2RndTl4ekxtTU12alRVbmI4cXBIc01OOXhIc0JxYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913576),
('lfSWqGfNhDFvf9q69gwbsEIs54Qrr56X5Zn7J0Fj', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEFwMDQ3Vzd0dGxCbElFSWd6dTlqRDE3ckV3Vm80Mm5JU1h5M2h0MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912375),
('lgJsgaImXXYEp9fG6LDjrmv4ebxOSDsYNkD0ZLGe', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTERIQ2owT01iYU5hN0c5Qm1YY3RBcVV5SWtlZWRCQ25wY1d2QWF1OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917838),
('LGKnKUBrUJbmUHgENS845KFSAld5Fu4mIU6RTc6n', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmJVY1UxU2NVOHJmTXpOVFZJa0FQRnJvNzdmbVFIZDE2ajF5SlIzcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918079),
('LHqsyVgOH09SkzRuxiwCFuw8jLeyBsEJIHjLFutC', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHdEam9JRHBROGFnTDVNZEZXSUVrNVo4TXUzSFcwajJBNllrV2FYOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910513),
('LINCH0LCefb0RkEv61RVcP9VyDXQpHuJhAfKFUY1', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibm90ZE5BM09hTEtyU09Md2JRMmE2V0h2TEs4NUtENmk5NFhzOHBOSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918739),
('LjctZZ7RQlD5CKyqa9QRvwqq7PfSU7MB5Abd7zzl', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYndqdnNLSEZCQkVyVFprQzRrdnZqaFpOc3BmMFVYMW15SkJIdTBjVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913095),
('LjzNWN5H1c4Ndbzl39Kjwpug2pjrB4dIojFeqt5c', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHVONW83OTFpNFVST1pnYmRBazU3UmJZR2tKeTBQYjZWOTdhMlBVRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918919),
('lkl3jdpdGrzdoViXqIhZU6lt6q5kHm8InfprIklM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFV6VHZBYmxiQU05NVY2U3NDdlRBTFZ4cmZvQjMxUEFaNmpSa20wOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909192),
('lL24ltgPpBClJg9NeeGz4H2BscFcAgMUOX5VmuGw', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUNlWm0zeDg0cTN3bTlCS0JGUGl1TlZ5NFZtekVGTU1POXdkRXBZMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908472),
('llSlCU90YoVF2SjDTEyOQYj0uO2V8nFbDbV7jqSx', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielp5MHhNa0JhU3Jwemc4TW1ZNmJoTmlTdHZCbm1CSVR1ZEtJMDduUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916097),
('LnMdp8y7Vxl37xYAgyxuXlMaTIIfuSxDx3P7hlRU', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzdiV291S2ttREdyemlQNGhwb1BRN2JOSFU3MUhLemJRMDBmc25UUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908352),
('LNro37FMUaE8o4O82av0YieRx6QUg8KTDuoy7vHN', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkxEVGl1UlZFa2F2VTFNQWJwNklmZ3ZTVTJqTTBQbDNFOGt5QnpvYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913035),
('lU9fKlg6zOmClhTltp9A6rtJJML9iUukGuR2231L', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTRvMkdhc3FrUTNaN3J6ZjRSdWFCeGFDMFlXaTlPUGxseEEzUUdqZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909672),
('LZVUEcexSOaZtdTThDu4MPqcA5gvsJwC5suKEBtJ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmlrazhvMHBNVnljYXVkYmZnTzZIUjUwVDFxcHQ1NmNqOWZPRzZzYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915677),
('m3zrX88U2nj23HTOFvMKtl5de4jMJAJh3mdlKgT1', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWYyUXVzOU1hVzBtREg3WjJqSVZHZFd1dnVhN2FQRFZIalJDT3FvQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915737),
('M6IHFRs0iyO4wUZzOzFvON3gUDl7KhaRmVwPSq1d', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlpaZm1qeWlOY2drelhrMHhhS05Mbjl0cGZvYzB0TW1GUURRN1pZcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912855),
('M714Nbogan0WajIeAR5Kq9HMIv6zepVdX8v5Ttgu', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmtIdjVCWHR6QnVrRnUwbndDWjRDMmp5WlI0UnkzMjBjNHAwWFRuNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911894),
('m7trPD05ltZHKHxlpKwC9fvBIlbhpn4kTzZKpPfF', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic09RTWhpUjY4eWVPYm1mejBjRlM2cVFMSFNXR1B0TTNFWjRaSEdwbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912795),
('MeY5ho3qfq3buceiE9KCBSpDvt2z5T1S38BxfRES', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakJVNUM0c2RvMnVOWHQzQzFxdU5HSU0yOVpRYnJWWmo4MEJoeUN4SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918559),
('mL7ZKLkhEItodF29zhtFzM1NFseNgU1Z7yAspIq0', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblo5T1RlYkNpOTEyN3NsaXZDUXUySVRXUjFBRHRZUkhZM3U3Um95UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913455),
('mlxNvov4KXhm8quhcUm6rB5AoyeyMxXcGv2FD7gB', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXBGSm80bG5QSm1CMkRFV1E2Z0Y4V29ta2RjekhKRU1md2sxdWNYNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919160),
('MM72qxRZLBRrE6snZWVBDpvIu20V7uI8S187XSIW', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFI4WmpJQjdnMXZ3dG5IWTNDc0xQVGg0OXY1WExtOHNxMXNhRlJPaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918499),
('MmCDv5sosdUqCvBHYcChr824X6sp8lamM6v9RVc5', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEE1Wk9zOGIxRm5FeVJrdFFlQkx4Tm1EQTNXb1ZQNWpHWUdrWExIMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915377),
('MMWxJ3FKj39VaQLNoXTQVnDHtMI2IPAGCNMsTfz6', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWdJMU9RQ1NDejA2YVlEem5mS0FUNDkzQmdkaTFDWWxHakI0UG5HTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908171),
('moT96lmdwzk9gps541zmRfb9MbR3QiiQaqSNceTC', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGR2UGNoeVB6cW1mSlFEOHpqSk94YlV3TG9ZRHpzTXVUejR4Sk91YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912975),
('MrGfaJJw2CjKOs5Q781PwRcxJN1sESPFVS3gXFfI', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUW5PTThuRG9LdFFQeTRlZnJBcTBzWFp1cGhMaVdUNXh5NGdUeE1URCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920120),
('mRILyYvwNQSFD5tsV1nelcb3PMRZlB8Xt64knJu9', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkQyb2trSFp4dEQyTkZHc2w3S2x4UW5jREk3eElEVXZmTTFEalZCOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917839),
('MSeAmMZMiyBVgcNeBeTWjuyUDAFZuye3JSz4ioku', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVBTdGR0aXRuTWx2OGZwR3lpRXl0cXpBbUIyemRlVG5jZ1Q3N3h4USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920180),
('mZtmwSLUkiJueJlirOs8v72JWbKAAR12YfwYyZSE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0VqN0ljMU4wRGFURWxFTGpQb2V6RVVZdnNMQnlpeEZlcWRud2VNeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911354),
('n2TIqipSCJGVxQ9Umo3eMG3HDw12QsHuqgE5Sl3a', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2taMnVOZDVrM1JDQnpSbDZVeWtEb2VvVENrVEtTUXBMT3VqY3R6RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910153),
('n3bPuDtEAcE1FjsSCR60umCbG47H6rrPkos8DiRF', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEtPVllkdzNkdE5HWFAxWnRFSlFNSDl2Q1l3WllzNzlOZnFxaWtsNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914236),
('n58G3hIf066OrBbTg10pAiYLfOD5h3qcJfGqnyvB', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazVQeHJqeXJvTnBZTDVsejl0MEVKNDVFdnA1UTFCSXZwNDJrTXJqUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918619),
('N5zxKv3x6sCCT3gu3z3weAiHg7flZeWe3iaI2Err', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmtqaWJWdVRoR3Y2TTJteEp2RHROdWhmSVNHRWx6RW01RXlnbTN3ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909552),
('N7UT8OZsXzUX4pbrSv1G6MofPWNf76aHOSrazCyW', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1d6Z2NCZmRmOHZBMWFwd1NvN1pVWHI0bzdEazNlelBUY1V6Wk5JQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919700),
('NAbSh55tYLYLYFD8DpjkvpLmEuo5OjsxwFAELR3D', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYURvWldDR2oyYnBDZjBoVnU4U1NjSnRtaHlNQmV5WE9ZZ1RUS3hhRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913275),
('nCajWuPUCEbejfk1dYpvAJcRCnMeOTcRVW65KrzP', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMk1mSW9rNnE1QUZBV1Y3RkhIaXdtaUJFRXZNQ004UmtnUUhOakZSaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912074);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nhAqzP9S8BZjleYOEw094tUBlEBGIOqxehw5zyKf', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmlkRW4zRG83OXFhYno3UzdBT2ZOTXRQalhOWDB1eGZFdDJxOUxJRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914716),
('NhjvFevvVMwCz53E09CXCEtW96gbKDjMrZAEzT0m', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYU1BQkpnVXJlNG51ekpuSG5QT0JWTFJPdzhzMlhMamFqUTd4STkxdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908111),
('nJbLFLZJYd05WUPPp8DBoT6lLZXlyUYua4du5Ghx', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDIwYnpiRDVSUFlFU1NCQVhobmNLYmFoVkhpbHZQaVJKanFWVUFvRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912495),
('nKxMIxJ7rXK9e7mxbVJZFUhmT8EfvMN19bIspNQz', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHM1QmI1OFd0UkRST2FUeFcxMTlMZldSMzN2cEtjUTdqc1d6WHdlaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915136),
('nM0x9w52HKgGtlygG6Dc9sc3MRdlZdxgH7ikE2Ue', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGI5TElzdkdObnJEVVl3Qnp3bDFvbEdkOEFIOGFXeFBacmhvSzBYcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912554),
('nPLDzOKHzEkxtRc0pabxZL2M8kVrUM3iJGYje3Y0', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDBXRnNFQzMzWVlZTDhqdW14elF3T0hHa1JuN0hmQk1sMndzekFSdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913335),
('nQ7LYKHxnj0hR8c60xZ8QxFK3hfouF4QTZ50Ei3D', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2xMSkhXVHMxYU9YTWVuMk5qT0tlTWRJaEpkbU5yRWJ2Qmg5WjR3eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915257),
('NqyAvOnurFxy947g6Wl2W5rQBaN5wiOAFfj9G4oa', NULL, '172.26.7.104', 'Linux Gnu (cow)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHczc21OT0I1dkxUMVIwSm9GaHo4Tk1IdGNvR3RBUXRaTkI0ODMydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640919604),
('nVJzNkqHllzNeq7TUlekxrDjfcf0PMpw5XGXthm1', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmt0VkRaeUlpQkkwcWpiYUxFSFRqUTNQaTNZb3RsYUxWMTMzbGFpaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909973),
('NxMi8tKdGdlnJhVe7TcCmFD8QB7yuRZiv3erJ50w', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUJvWXhMcVFySGNQcEFDdDY0bHNBMFVZSTQyR1U4V1VNTTJ2ejAzRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919940),
('ny9EU7B9lwW82vHQrmI2sMsGzEAZwcAqLCRbPNIb', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkRVMzN2bVJ0UnVLdjByOFoxRTM4QWVLM2NldVJtcnUwZ0MwblBUaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914116),
('O2tO09VujQN9onsndjwA8vgOG1tGQrJ3UzQXydn3', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3dqQlFZUVNSaUNlbGxMME1xTmtpRlc1T0ZySE1udHJaN0hadUNIViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919340),
('OeRtPUQxjIM4YVYLwfmA4esw7sgWuSruSW3PnQNT', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUMyekJIOUtia3ZDblVlTHlWZW9TZ25rSmVWM3JmR2hFZGhpRzFXTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914296),
('ofSTYkLYu3pspBE55TnMhnJNrmExP0MtFBp851ym', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGpRZWNtVWpBcFpEdWcwdk1jTzIwd25pNXJIUHh0THhaZUVrUkNUUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919340),
('OFZWiP5ctdrRw2dNiIx8XqZkJCLKTkxKYZaV7qm1', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGRRMFI5MVcxNGg2VHhPUDNHMFlhZ2JwalpybU1JSW8yVU1IcUdmZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920000),
('ogQduZ55xTCfMYJ2ofkIwqRFTSgfIe2Kv2qFEKHu', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXU3VllUVzc2U2tXdWRDMThHekZLTHR1dHo1TEl2dmZDaWF0NGtEZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915017),
('oIsafkWNrJN2mKaIOT42DCqqhPt8tFQGrHwMlNrF', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWllTMUtiNlJMY2JmZWF0QlBZRVJuUkhhaHE5UHozVThoWHVXdHJ5TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918499),
('OJzOcmwJWsJ38uxzG0sILGWc3JnxeQdUm63jgerf', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzJsOE90SDE1bVQ4NFQyRzVyaml3Y042aE5Fdkl3emlvZUdIcGFDdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915437),
('oKOCo9fAwNFu8fNvivrBkHiX0ql92UnYbuTpssdO', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaG1BRDFKem5ZVGJLYUUzMzljdnhkZTM0QUh5M2lNTmRVTUlUcGdqaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912015),
('olO6uBiwvdg01Byqx7w8U4RrvmXq92ycpEsCMz56', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM016T2p3eFpIR2VRenM4NjF0SHlYTzNua05TT1kwUTgwSVlMWXpqayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907991),
('omHspRvseC14GKnfOUu9JyI343cd1WOu07dEt5st', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWNKRm45TWNyc1NGVVpoU3luRzFNQTNySXRkaklUOHY5UkpPdjdFZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914836),
('oOCrb8LN6rNY9egpJcdOxYp9mnXG7j58h8r0sUwG', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejdUempmYWhwc1ZXRjh4MnBUejdGWmdCbDh6N2VDc0Z6azh2RjdFSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916998),
('oPYIOUlNS4mOBU0h9K1ivIvRlcCrDoFGy26jC034', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieE9ISkRoZ3phaTNKN3BycnoxS001R29MR0llaVQ4dFozZG1HNk5uayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912855),
('oRklEoCTkdRowYRm00fwwsdMcgfwnADDMR3jxVNo', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXdFalRiNENJYkhxcHp0NzNrSEpBeFRwZ1lDYmxUMmkzUENtQkdVNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910273),
('OSwsYIh8UG6ot0DAkiAF6suAIls4OXe84dyF3zRJ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEtHQ2JyaG84Y29sa21DWld1S01RYTFEd0c2M1lmWjZMYzJ6Y3ZraiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913515),
('oyeDjJqpDUU9knLeDVJBOz2rfILCsZj5RdptYnVl', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemYzR0I5R3BqTXFHbkhHNzV4VFU4MWdMODY1RmVoUnFYVnE1UnBwSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917418),
('p1oK1Z88BHb8kTmgQue10NbUz5rUJ8V5FNt8cSck', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHNPWDJaRU4zNEt0eThBaWFzTkFSZVlwS21PaXhFZFV3RDBrMm5iRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913636),
('p8QHsradsTUY913beHW0aT1CwEIJdkFYv4yW9tjY', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUh6Y0d3NHBQSjVEdnpBM04xc0RRVldYMWxLdkNibjEwMXBlTFNuWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915977),
('PdF0WQN0wwa2X6L5T8rYzVrihyVlcHGWlgXF13Vm', NULL, '172.26.43.207', 'Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWdhM2VKSmlSTzdpU2l1T29UcjY2dEdXYm5FRFl2YTROZVY0RVRxYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly85MmIzY2I5MzljYWRkODNhOWVmZWVmMmI3ZTAyOWIyMS0yNTAzMjkyMDEuZXUtY2VudHJhbC0xLmVsYi5hbWF6b25hd3MuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640911948),
('pEGpeIKqDL52MFJqSSiDncOet0lGc9HGA5APYE70', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUV5bUQ0cmRNNUpPV2RNcWFpYk1hUVBLdkdja1R6TXFvVElNT2gwayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916457),
('PfGATzuLt4Ck3Ce6vfidH7Db6eTnIqs6kCizaBxZ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1lnV2NRTk5NdTFtVGFzdGc0QmVvdE1WcXQ0U3R1MUhWQVg3ajB3RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909312),
('plTgkTnu0HCuVp76enaKZNExrlep8V5kwUM51Ca9', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2tqdnlickdoUjlURGRyN2M1SFAyZG1kNHB3cTlFaEtyRUVvZDV2UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908051),
('PmqgzG9AVjqgUjlcWLvBSmV4qaM6xWxB2ptuN0iV', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFN3UFhlTGZDeFNnSmpGeFBjVkgyaEQ1WFBzb21LOVpUanNraVhnWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916337),
('POhUrSbrrF3xCDrXZROCZFLHlVXMQnQr0u0nM2MA', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmhVSkVJWXdIdzRuODZ6N2tzUnpKNUJSSnRHSlZnV01VRjJXMTZGTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911414),
('PPPNRvOX8cND5q0jCRSLEvy2PhFhSsCJVbbIXNyy', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmlVRENtTllDbkVZeG84Y1Bnc0NsNk5Id2NVdTY0ejBMeHcwOGh4OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919400),
('pR29OFbswvVYXhdmu8CvGGuMQrgVaMnNq1wULksh', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT21Ga3psMzNwRGRwT01KSFhZQnVBeWtURFI0SElJVnQwWXk1RVJrTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911834),
('pStIZdWVcXoxcMv7lMKxdpRLhQ38KhVerXVdKEik', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjNKRjlSc3Jkbnc3c1ppckRsVGpMNnN6MXZ3TEE1d1BqaFFDTjIxNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912735),
('PVrdoCEhqGZG76ckVUfeMcO5qwpgBSuNBnH4HQMX', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVZSNVBQVE5qazV1bTZuR3hDWjhxSmNVdlRQMlZ3bjZoejVTQWxLcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909312),
('PZTzYpHE4j4z2tMTSOYyEMMRjwJkLiydBPlSiQtk', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGFmS0IwTFc2TDRqTk9pQ0dCd3pVU1dvZU5pMGlkeTBPRzI2cGZ2WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918859),
('Q0vNhvncQbIOjgKWeN4HcrZipoBtygxmmB5QM5Nq', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTVkY2s3YzJMT2s0ZVhuRzNqaFFhRDdsalNSM29Pa1RiWWhHUW02cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910573),
('q4eMMP8jCSOpwKm4miIzno3YzudsUeuWRhdyfFyJ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGlERUF5TlhIR2tHTHIxZ0NlUlpIOTE4Y3Q2am1GTlVTSjlha2doNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915917),
('Q68WiJuZx6vRlEfh69DuneXmVgpZiT65E0YacFGm', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVJQZFFxQU5FbmxHZjhoc1NFY2Vvd2p5MVBaY0U2QUN3MFZwb3B6bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918979),
('Q7e7fzBnJwZtIUQmjEowM3i4TyaYOKJ2RyCXEZiN', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia21LbUFCTzdUV000VXBsN25HTzFPNzRRaXpZY25TVmVvVTBTYzZSMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917238),
('Q7h7SSmKJj3Ska4XUUkUFOIJweYImjoX8b7ss36H', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWE2U1hRNWs2S1RCMVFlaUlFVklsall5M1lUdVRyT1FLNjA2N3NuRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909373),
('q9AZGjz3UrL210Nf9QSDkhygPMDAjRxTvpVdKwVi', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTI2S2t4a2pVVTFCRllOTU94VjdNZlNSdUdTMGlDaGpneUVZZnhtNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913876),
('QHcSkBuL77M2CBMxV51dBFGq4ZTQ51h5BHwKoRPU', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3BUWmZzbVhoV1VTdGRiaGlFVHcxYUo4YTlCeFZlUXVkUk5YSW0xOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910813),
('QJHJUJjI2MhXy44zbLfd282txyIux9zsfuSRr1Dw', NULL, '172.26.43.207', 'Mozilla/4.0 (compatible; Netcraft Web Server Survey)', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiekZQNEtMNGZYOU1ReDg1eFBUWG5hb1FNNXZlZ2VIRG96Q3dWdU02bCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640916083),
('qlK5rYBFKhgKFSTXhUCxJrfFbYZrNa4zhfnMynKM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTVRaUFXWkRUOGFCVzYxYVdlS1kwSlpOTG1Ua0ZjQnppcG9JRmpWYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909853),
('qoH9iqNKxbVAjO6fvvcG7mHFwO2DQUjgXUJ0s3nm', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2Faa2xTOUVUNExvTlY1djcxckZJeEJZaVVod3oyRzZPYjZDNzBxdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913695),
('qv23wpshkho1Bf7fjRwrZoV5G9IRLdEb21rO7NVk', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOElVclFLVDM0QjlxTUpDUE1RT2tEamdHVFg3eFNTdUtGNThrMmFueSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916037),
('qWm3S8Fc0oPP3RThDSIAUnU4aJwpuqTzeuYjZf0M', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW5qbjVoY2Rka3gwQTVpVFZ6NG5vOTlaRUs3ZWFvSGRrSWRzOFFIViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915617),
('QWxM236Z80o1c1sRxJhgp9ioyoepwh13ajyOeytS', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEJoU3c4QzZQWWhjdXFWQlAxaTFjQzRJSjk3RXE3bUlUNlV5b1JMOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911233),
('QXydM4Eezqyb3CRjpeP3qJ2uNifJTb3S8dK8OQjK', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2VZZllGVlBYUnU0bFdpZ0hFYTNLWUkxd01xQUZoUjN4QTk5UkRZbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908892),
('r2YcwEh2mMsi7ddI4s8UItlL6qFPGyCxKR4TL5Ut', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0VtaVNnU3pZdFdUbHZDVmFWYXJERGhmZG5iTHRtSDd1VVJxaGFMSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912314),
('R6h0xbeLyW4dQ3wYQrU4IFOpAOeEz397N5xijcNw', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3I3NFlGWUx0TjRUSGJabUJtcXhPS2FQOHVSZzkyaDk1OFBPTzlVdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908232),
('R8CHA4Xo2pBfAThqEW8KsM3Zj5nmJY8vqmgslChM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidThhTW5xVUdnTjJ1cnNUVWxvRFVuc3VTTXRZWXhvR0w0Mjg0S1hoNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912134),
('r8v41APyHCX9CCyqQ6MZDi26vcGVG420UKzPofLU', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1dPd0ozVHJ4Y0pzbGpBVW9pWFAwaGZhd3d5MDVQenpBY2pHbVZPaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909072),
('RCHvJWDfGHIjR4bCOITVt6UmoHBRr4s8SuCung8z', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWxEVDhudmw2TUFvZnl4RXkwbTljUWIwUmY3aDNwaU11ZXJodXQ0NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913756),
('rd1pv7lUD2dBDYzMSl7UJH1jBzD2iMw3l8bOh5VU', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiek9WT1p3aTdZWm5Ca3k3QXoyTk1wWW90Ym1pejhTdHVTU0pLaGxIbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909793),
('rDntIzXkDe41PtsQfGXDC0kKF7iaCyUZp4DCNBk7', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW9DWVc4ZWptMWVWeFAwUHdLeDVpZDAwY3R2UFRkcjhEYkRhV3FzRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908832),
('rEIGqYbAgUCvCKjF2KOEfARsOCLVzAcCwznJy6y4', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNExQRDZ4MXRDdFJGTUFpYkM4cUdJbGN0QnVSVXBvMmtSYUQ0bVhsWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911234),
('RfTxybghEEgwOX4feb6K2Ce01J7zWGqemq2zMmIL', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWl3SkdmQWswSEVoenYzc24zWTI2TGRPUU1ZNXRtR04wNnZTZHJsZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911534),
('RH0Y0TKE6wHx1P0BiREXD0DsWdDcWucTlbB7HSi4', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWFTQzYzRW4xS09OTmN3cUdTTDlldmlGdWpFUHo2Vndzb3hHNTNuMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914776),
('rhT2o9Dm6JMMoZxM1KZpSWDsZbu1CaklnJ5HlTAa', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmxwSUhxOFVaNHprclpHeVZDNXRLdjJzS0hyNXJJeE40SHFKVkxaeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911474),
('RKieejWlJA78vD0J6THykYWTPGLikjhoa4YRJhZj', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDQ5dlh6Rm9ueDhjbGxBb1FkM0Y2SlJocU9jbU1US1FVYVhuTE00ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910153),
('rlw8yGP7kXXwEJApHVafwBqS63OadvwaP02B4TKZ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHBaWkpkaFNIakJPTEpXc1NxamN1bEZ4cGJjeUticjhTNFdlNFBzYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914416),
('rqeTRIXls3dySLpvw7n4Dj27bNTx7amv9YgrFHih', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU01hUEtGSG1mZk55aDNnNmY3OERScWUwV2FFYjZOUnlVb2R5R0p4SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909612),
('rv2KthEcXNeuU2r22IjAK1Wd1iXVMwwPDI8bEor5', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUVwZ1dId2Fsc0xzdE01N2JGb2xOb1h6Q1pWbHlRUncwZTl6Ujg1MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918139),
('S0DTZb3nCSjNuVq4YdcKSjW0PJlM3E1uXcObjuKj', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGRZSjVxVWJHT3k5Zms4c3JXYlJxTkVLMlVxelhwNmlyaXdMbnFzcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916938),
('s34wgEvWDzOnGB3VnLLA2ohikIy9voqbzfxjBeJk', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnpKeWo5WDMzRlVvUW9nOGJTd1dER0xONmhtQVlNUWNjSmtuZGFydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915857),
('Sb1jhyApLLXc5VuMXNEzrWBvaV07K7DhV3fHncUx', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVVzNThSbDJHUUpwaGU1Q2FRaEVLTVN5aTgwd0VZUnN6cTUyMFJNSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vMTI3LjAuMC4xOjg4ODgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640919950),
('SC2U9LYlj9HPMZvWb0lPgyJqNYgXihoRjNQkuT7d', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnlRWHdvdnVNMFlYcWpUbjdqN0JVbmYxQVl6UVRtWWV3VG5uQWNrZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914236),
('sDs6TdOtkU2MGQvLiswrVoE9ivoFZktYi0TMU1oL', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVZKU2NhNWdLYUtOa3ZNSkpzOHpkSVdhbGNWVlZ6TjVBRFlDVzhYSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913696),
('sfccnqz1ajLQKWlDqVsbqOCvlgQI6KwPNjVe4KJC', NULL, '172.26.43.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1B0NDdTWlFPSmt0YVkyS0kwOXA1VTVkeW1lSm1vOFVvODZDTTBGWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640912812),
('Shp6jmcMXzA4OQ6HQCIglO2BjIcPqjg2TzOPTWpW', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDQ5dHpBMnJ3ZjluaWJ2Z00zRGxBaW5LelIwWTRWMnNrcVVBdXJrOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915316),
('sSyX3TRUxDugtwGtmXXFgM9emV4Xygc472F3IuRP', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVlLMTE0a1FXVnZnUHBYTTBRWlRrVGFXTTB4OUFaNEc0ZHRqQlpLdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908231),
('sWimU9Z4J2iFbaO0KkmxjjAn682eT19LbfCvtvCc', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNG1aTkhDUGVvTEFwNlVPNkFDcnFIRjRIclJxeUdDaHhDdmIxUHdDYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919400),
('SyzDz3n8sMFwFgYG2t6OToWE2VWjQiuTlP0Ha9KR', NULL, '45.129.56.200', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHg4WVgzZ0UxT1I2bTV3WkZCaVR3a0ptVTV4MXlXaTk0NVI4WVM4ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTc6Imh0dHA6Ly8zLjY5LjMuMTg4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640917745),
('sZwKBHW3q6D8HPcctJshCGczq2lZFL2zw2NerRPp', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjFZeFpwTGZORWJ5eDlmTzVzbHVWR3QzZGtpU094cEZDZE5JMkVBMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909793),
('T9JiOl6uBPdNDT8obGz8G8I1mBybtMHchaOa8HUL', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTlJSHlqZUFiUkxDWTBzVjZwbnltaXhlN2xBcWVHZGNFY2VvM0FRNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911534),
('tA0DIjDIgOCLNIw3cRvgKHzNnfqFZKglZjb2ETb9', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY05lSlRYd1JKU1I5cWQ1RHRnSmJ1TzJiVXNXYWpzdUZxVFhGckNPWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919880),
('TjfZWRtrozZrh0dOWzC4PwYHIhxWJy4cEQcjDRvu', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlRxVlFtUk1nUndic2pROUdLWDB1Qkl5U3RNMFBpY3FqMkVvNFo4cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909252),
('TqNB1EAz8CtU1mWvLDYxMAkcZcB5Rdiwh0LcLdeY', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicENLa2dwRmNVcXI1NlVLaTlKWDA0aFN6UG5NT2F0TDVpa01VY3ozVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912735),
('trmSDn2a8zKyFJzTxnyijbYFNbZpX8mSXpHXVnGQ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUM3Y21GUGNsZkJaSlRQTndwODdIYm01bGlGZDJ3ajl0N25URUpmeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914356),
('tu72MwacwVAMObt6F35nYfJkqq1ovCxDDHCWTlBE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia00wRGJ2V29WVGpVYlpJMEUxSUNPMmFPVGVyODd1UTVMazhOM2M1ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909372),
('tuOBfFtbO7K4wSjL5ayhdJL3FH6tIAQ9skzkTehh', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXRLSUE2aENIaThHd2RTWGY1aDJhdkVFdU1SNG00ZkI2SkVxcnh6ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913816),
('TxZyCq4D2QqQnM3TNhnRwuvy00DLYbJiRL4kIOdl', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlZKVG1NUWZFY3p0NEdVeUEwMkREZWU5UDZQOVg3WXNXMWxqZ2ljbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915677),
('TyXSEhfYfuJVSen8L0I9CNcmw3Xpu1e8S6K0EiJM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGV2QU5YQVF2clRCQkNjVFl0bkZsQlFVcFJKRjA5cmk1UVJKbEhKOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919039),
('tzJP9y5SjJXTd2lQMF8xMeu2LkUIU6YaoRakg6e2', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHdvNGlEVURaTVg4TXVXZ2x1Q3YxVFFSVVdPNFk2bHZpcHZiWVhZViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912434),
('u9UWNuI2cPP8CWFR1KLiolHlwIrOLuoDZEbZ0OxX', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE45OW1FcERwcHVlMW9IRjNQQ1VlMG5sQ1FyODNGTFpNVkw0c2NVTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912615),
('Ub8W5Q1oPuMTGTPVvpTq92vYZ1VJ7uchtFUS9TwT', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWZ0bG9ocnc2azRJbDdzR25IRHlTdzB1NDV2VUJCV1hTeHRCQ0pFMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915196),
('UBLeVOvRUN5jo1pKu0NGoH0dDxUnbk0hicEutmrS', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE9mUDh6dE9USGtsQ2Q2NW91V2tvOFNmR2xtVHlKYklRcVJiRTNkYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908832),
('uc4BGqPrmLzG5oH3U7KQR2fw4j3k8HJSoIBUrHKf', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjNLbk5GamhVRXZxVDhmbFZUaEI5VGVQdm9xUzV5cDdwSWJWbjgxTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911174),
('UdbqPleWMpbCVxen6a8LBAXzTkmCYYwLqCsuyqPq', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzRzdk9OUHljVzBrSW5aV1N5c0ZSYXhLVzRJbFZIVDFUZkFVNGg0UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919940),
('ujt4kF3VbhBvEhfGQZov6QTBpfN1qhwf1cR90E9p', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV09vZjQwRkthbnpaYkpWMGVieGE0S1NXZUVPckdMUW9SVnQ0WkVNMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910634),
('ULDNZHYnZB2i7hAJ99vgUytVbbPLaxD3HaOgYiqn', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNThPOWVzalJRdlpha1lLelB0eExSNlNzNlJ0TzFNUG5PTVlFU0gzUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908952),
('UVfQ6vPytAvEvGvbSBGpxNJuhnwyWDDwQONiDG5B', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMk52elNkakRSTG5VOVVQNk8zeUFEOExDRGJTeE5YTzF1dlpHQ2t0byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909012),
('uYIcwHzPVx4xjWqFG2xUsyo7MtjNP1QsBs0ZTFy5', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEtaUmdYaWFqVmJYUUg4cFI2dGNLUXRYZnd0V2VicW9zOTN6bTlaNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911113),
('uYTdl9andIhwwFTQPsCOstZz5S3sc0RrmgdiROLH', NULL, '209.17.96.50', 'Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1QwRUFGbXZqRDBsa01rV1hOMklPRFlqVEg2RVNKSjk1ZzlMY3lrMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTc6Imh0dHA6Ly8zLjY5LjMuMTg4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640907842),
('v9jtnZa5jgg8K18n2aHnmymoZI3qdwDvkjuZztOw', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFZaakE4TEJheldmVzQxYkFTV1FpNk1zQWhjVEh6UWRETnhRTUs3YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913516),
('vDMAFApzOu9GZTqwg7Lakwb1skB14F10OcnfUi5x', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE5wMHYzaExva3ZCQUV0TzFvcG9KZDllS1BaeWNyWmRpdUU1Y2RkeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911654),
('VE7INYqwixLlPiNJxAB5bKdTesUfUyaWEM7g5rWG', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmxJWnZkTUxqVllkaGpwTHBLY1U2dUhqODJ4RGgxTndBMUtWWHdOWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910633),
('veDcGZX4VVg6DO12tQBijLS8cGvJ1MZ5oIuYTDLh', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlljR29kREZzS2NkemVnM1ZlUWNiWGxtMk5ZekRBRHZQZ3RWbTMzYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912975),
('VGKhUXswjeouQSWfJYyLElYfLss0GUrzkGUVb9n8', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSktzckgzTFB6SVV6NTB5NVI2RDN6SGI5V3FsUU1DTkxGMUgwSERqWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913035),
('VlR0fzbxIQ7naEfTdbJR96lPZFUWliDCs2ol0sHc', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlBHQ3pPYmtxVFg0MndpOGw4Wm9VWWFRWVZuUUFWeWRXVzhsb2sweCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913995),
('VMcwSklaxbZWQOznNi96YDzoNfgz3kRKl2RQR3pK', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEVRZVd0b1NnblFYTEVJUE5EQkFqeUxGRGtOTnZPcEExa2w4VjV5ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913935),
('vMjVdeGIsbLLeTylH8ZRCXvtXPFM42cINrBKfdbJ', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieVJxMnBJV0dKNXc0Mmd3dzVqcURLeGxWWm52ekdhQTliVVhWR0RQVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909913),
('VNDgeHjUoLkfywz5UhVmdFlpSM4glSbb3bwoHrfR', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVk80aVlwWGtDMGFHbzZBaTNxYThrcHFDNWw0YktJMzQ1SXBXaEFxRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917178),
('VnfrTqZtC9fXJtZH1C4TYJFIcU6nnQ3b7y267cBW', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGRsenlrcklPdFZWZUs1Nk5lMFNEb0JoWE84cHpsVkp3bUF0NE04SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916217),
('VQDdivxgr0FRbDy5iIEj6AXqgcp9wkHsxuBWxaVd', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3psbXRxYXNDbU1jT0l0aWRTMDlHM05wRnpSNzBhak1wb1RQbHhXQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916157),
('vVCotK3ij1HXjdnUCxOxOr95rQOlo2WsFWhIpWMQ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEhzbE9tcXhRS1ZxdDU1VDYzQ044bE5BZ1lyeFh1QVp6Z042ZDlFaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640913215),
('VyGxsOFvQ0RDUhRMZMjZaGVjnOMHeICPNSCGTlO3', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjFDQjFGam52djR5ODZyUUFVeVlucmV6ZmtXSUtqcUpHazBkTWV5ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910033),
('Vz1btVN6MyD5FxXWAx5XdzBa4hQHLftZ7TuTIHcG', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmxvSTNrQ2RXbTVEWjVmWFRoaERlbjRDSmdTY3ZFYm9udDZMSkxDNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912915),
('W6lEc5Fvs1XYxiDb8dvQGaMRNDiPfhGfQ8SjN2m2', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmNoVUVuZWFPc21KOWdoTzlDbzBJdmZHeW9qMldJZ0ZUQjVhTUd4bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915557),
('weCfmc4t8cEkaQAzDsqbcgoYgELcLFe5i9l9IXNk', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNG95dTcyRk5PZVRyc3VweFo3NDNvR1Y3VUp1anJQQlFOQzlvZjdnVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910814),
('Wh9OWR7SY7ftlU1gJyRYxoDvjz1CPTcWdk2pyO3b', NULL, '172.26.43.207', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1lKb1JBRDh2Q0M2WG5jVGdPcklDczl5SHlGMUZyUTI4QmRQTnJEcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640911304),
('wiJpvk0DUi0uTaTHRjTbLVNWx7MnYPl4NI3mBYEj', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnBZM0JUZUxEcTRhdURuaEk5TGRZSkFLOVNHSTNYZGFuVlphalJrciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918139),
('wLaRDLEi0xpvISZde9gWumoKn73nVTfLrzGIezpp', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzhGRnB6cUtBU0hjYVF2T0xyckxyeDZFMU11S1ZYNk92RFQ5Wnd3ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916878),
('wpGNA5eV9jWoA5y6GFsF7qnpAMWRXAEv3spNxpol', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzdFYllrSlBmYlRSWEFINmg5dnpybTkxOEJGTElzWmZUQUJBZm1COSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908712),
('wzHiWacupqgjnWrBDJzmk52Em71jHeg8LNGbj03b', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3hVNlg5cUtKZjRlWnRiY0JYYlRWNzJRb09BdG03YUozYVRrc0ExZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640920120),
('x0ETfQSGNHzBG9HlUIwcB9kTH0zqulBOYjjwp4nZ', NULL, '172.26.7.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGYyVGh1TUxKSzZHeTZGbmcxWkZyUEl1aTVBZUZaczExRTBOSE91RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640919031),
('X5RL5mcwHBJrZwbyAVNQy4SVtzsJrtTrcfi41Xwr', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOU5vQ0FkRHRVR2dqSmJSV0JFNTRDWDMyemF3cHd0MGNsOGZnU3p0WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914536),
('XDflo9oAH4rtijrrfw4YFaCqXu6V8qcdABYn4q8n', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWVKdGl3VWFVRTBaYUcwdmRxaDhMcTQ1ZnF5NHM5V1RqSW54RFRycCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918199),
('XDnwO6djjlnL7gFaTKe45vJZQLDQICzfQ2v1me40', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXNhY0RMNzI4Ykg5SWdrbnF0UHJ2cVl5N2xZN3R3dzNxbzNYcXVhbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908291),
('xHyDAe0hDg7fqxtum9NjR2PRYNExE6XelPofNeHM', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDdIT1NCa0J6cU5maWZsU0ZnelM1anNOQWFCcXZ2UXlaSkpMamtQbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908712),
('xjlFNlJwcxeLunRZMqNkLmD8NcvNgB798QIk88LE', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGVYaTNCR1lxa3pLR0R6RDVwMHBVc0ZzT3dYR3pWcXJudEh3MlFDNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914656),
('XLkHL5rhiQnmMFutKandOuZdX4F9Y6pmEt16zkqD', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3dqWGhMY1N3UUdwUmRVdm90TzgzMzE4Mmx5bWlEMWZSblBjNVUxOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908172),
('xoUuy9eHPUe2lGKdjD1gcWwDIzBGxkqdE4CJv59Q', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU25OZlJySEVFaEpkZG9GS01WRkNvRXFCN1VOOHVtbUZOUGhwR1htQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917118),
('xS1LEY5Gv2e5MiSjT27M3uuRB3R9qIjmokWloB66', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXZtNE1IRzNvanBBbVpiMGRUcVROcHhISWUwYTNYd1RydHoyWk5TVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916998),
('XsLs8sNDu0wCN6cVYmws8H7MGQmg1yHYgZbx4W7O', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGdyM0lNbnlKdFpRV1N6ODl3dEhUalNFeVY4MGxBNUw4azVWZGQ1ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640907992),
('xsy8c9ZqkSqsJa1q3hc54lwq7eyR2gLNeo4vWgD0', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFY2M3g0MnhTa0ZId1pqUW5KeDc0UmpXZDR0Z0lkZkFPTWNaMTZ0VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915497),
('xuqdFBC4bKxUA9v1NatynJiHDFo5R1nTuDNEA8hF', NULL, '172.26.7.104', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRG5GdGFWaXo5Q000VVdhNll0UGZEUU1maDRkckNTT1c3S1hNT3Z1ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640918336),
('XW2CEQOFUTHMULPCGe4WZtZHKZxqCOkwYDhkbTak', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVFkZjV5dlZwTVlqUHNmRTN6TzBjRDhUNHRzTDV1dGdqTzNtZFBGWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914176),
('XwzDZD1zhDzGQqNQCckznClynH5d4ICMoc482G0h', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGVTcHZyemdjWFNBY2FnYzZsTDNnQlZGNEJycmJMOWtCcUM4eVNmMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917358),
('xXh6w9yDc5Rsdl5oyQwi1m0gIYONrfnqoRl92vte', NULL, '172.26.7.104', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1F5RnhxY1N6SUp4Y3lFa2ZETDNKQVZvQmpVa3ZVQXVoV1BTektyTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly81NC45My41My4xNDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1640909724),
('XXrCtOcVgtQ0jKle3OY8GqT68gSew68pqbgln2oP', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVRuVjd1VnpDcnF4c3BxdDRDQVhDeFFQRFlDcnA5Y0NtaHpkTmladyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908351),
('y1dH96kQDAmvreWmyI83rfwF6ZKTCBHgyWCVXkcZ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTFFYmZlQTl6QWczNTluMVhoTlQ2UVNpVFBZdDJjWkwxMjBlUkdPaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917178),
('y3xGMtqsidShK74pf3tkI2F6f4hGYDlIXpCojYNN', NULL, '172.26.43.207', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEhhWVh0ZXBrYUM5R09TSlJrbXJBWTNVS3lQZnIzNTFJbjBSOE5VQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640915240),
('ycsSNHuCk4yySMhpST9uG7Hn608qkinwbtkqrUiL', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkl0aFl2T3Q3cmpvU1FvTXhoMzg0WXpkd21iSWxLYzg2SnYwNnI2eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908592),
('yIxOakkU6mZT5HAXGWAqlouH5ZkPiJbUMN9or5vf', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2NVSE5GeUUybHJlUm8yajdtNGhURTNXd3RZcE5Ia2JXUU55MFlJMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919520),
('Yl1R9ONwsWEbnjHRj9wNx3cyUNjWJXQ8h6hL0sgh', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiam1ZM2lpM1JZZTJQSjFFQWZtdFhSdzFOMHliaHpOV3VPUFNVbWJJTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919280),
('YnuNpyhYSzZnp5mxaRCjxwfNwh2FSI2cvbhUnyrR', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUF0cGRyRFZCV2NDUG5YWFlWa0luMnBxR1JRNnUxcFA5U0t6Z2FDSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919820),
('yoU0YTLB7xbyslqA01mWoTc6BHbpkMVcBTZ3fAoi', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGRxNWZYUGtiYlBkU1U0aklybGxHVGZyQjZxYnNSNkRnOW9wRm9rZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911114);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yW2k1EfOR6r3wJuxL2rEoFeAvtVl9U05rwmSRiOn', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkU0bkpBTXRFR3FFZ0hIV1ZmQ3EzV2R4Q1JLbVlpZGUxbWV1R2ZuSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909433),
('yxdTyPS4jWjrs4d3NRd21b3ZLxlZYvlD2ZN6xyxg', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVpNcFRpcUpUWTByb1lDOHBLR1d2TTVMTlVURGl1WGZEeWR0NmhldiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640915497),
('z1IYeGErF6Rwqv0eUOa6mIBOt2bYgYztB6OCkCB7', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTJIdjZXWU0yekkySklkdUU2endwd001RG9xYURuRGg2R0FKVklqNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640918379),
('Z9dvLhkm0ToWYCYOIPMdHLfJBOIaPtovgmr4i3ol', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3o1RU9qb25XSnE0VEhLeG53dktIejlLU0phbjR2VFBBV1JNd2RHViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640917058),
('zb1WShIKNsoIBouzjxsnOUi3IHbAq2jIngsTRFHe', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3lmRUs4QTFueWRIRHdwTllnVUJhNUl0ZTFmaDZJakVmU2xrcmw1cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914356),
('ZDRP7vTOIsnR0ZlIc5hDGpwbqwDC6CsQyt61B8zm', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1JsbzZPdklua0NhZkxEMWU4OWJ4VFdnOGc4NlB4aUNxNExwYWVGNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640914596),
('ZHVsQYtHvBd2bNRbubloIjcWJpcWIlPyVDOQOG59', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTNEaHU3Vk9OMnZUZ1NTSUhnejlsOU9yVmtWeHRqd0poU1BWNGNjeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912194),
('ZIBJVV5ChGFi3ZaVU3c44eM8UoIUIHLkAmRKV1mJ', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkdtN3ppcVRJOTcwSXBvVzllclRNR0E0TEJ0amtPSGF3M0lhcVczZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909613),
('zkMkjttQXq3vu9YEwEezWSTklAjcsMxSqiiAe6ub', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFRzczh3WDYwaDVQQzNFb1VVRXRsSkkwem5uRnVpcE1iN0t0NGxNViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640908652),
('zmL1hTXYXcAwDd0VojpCKhcMw6JWziDq3j5bHYQ6', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW5NZHgwTXlLUmUxN3czMWpHRjY1aDF5cnRNNlB4eHN6Vk1BZEZlbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640909492),
('zNDrW7KeLwQOUgKPUDWlEKobBBYJ4qKYTiNuGS7c', NULL, '172.26.43.207', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWI3SFJEV1lXc3p2RzVEa2RlMDZiaXFIZWhjM01MQW5vUTA0VU5FbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly81Mi41OC4xMzMuMTQ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1640919917),
('zNK8x1bazCFwUJE52JxFE00Ldxcdmfmd5m6tOlUf', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3BmYTRPRVJRUWZrTDdETk9kTTh5ODB0V1F5S3lFdENZOGdxYmxscyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640912255),
('ZnOt9CRZTIYW3UbocNLJBdhmj2Gp5N34ucHMMtqt', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWg5QlQwZ1JNU3A1NlhrQTh6UHdtWjd5TXB1cFBFSk15aWY5QnVrMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910754),
('ZNWgeUANadUkCe8UgsF8rwxAXRAwrmfe65hXrpyq', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2xmWTFxTDBlV04yMFVQR1laOXVNb3JCeUxJOFpKYTNBcGVjS2FpdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640916878),
('ZocXk2RW5D7R1nJMrJAZzlLS36jK0XduagDCjIVD', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUQ2WlBveUltZENTQm5zQUpOTVJIdE5PalRiVm9qYU10Z0tYdkdmRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640919820),
('ZRkGoi0iDCcaEx9phPU7iy9Fc8U2AnjqQwmFJuxR', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUxGTXc3QXcwYlJINGx6cHdPNzFkQU9zZ1hWYTR3aU9rRjBvTXl3RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911474),
('ZryScCDqMZ6ykj5kKZu8SrNJMgNI6MqP8eVpYFAt', NULL, '172.26.7.104', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3U5UkpDM3VERVhrdkp0MHRDWFREVndvOTN0eDlEdTFVSlZ2RUZOUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640911774),
('ZZSd3HHdjDKHylc6ZPNntg9Yp2DtwYVhdN0OFqgI', NULL, '172.26.43.207', 'ELB-HealthChecker/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNm5oOFNMUXRIME1zWFRnN0laWnhJNTd1MlZjMGNQYURYSkp5Zm11USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly8xNzIuMjYuOC40NCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1640910393);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reclamation_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Nouveau',
  `priorite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Elevée',
  `date_attribution` date DEFAULT NULL,
  `date_cloture` date DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `reclamation_id`, `agent_id`, `reference`, `titre`, `solution`, `status`, `priorite`, `date_attribution`, `date_cloture`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'TICKET.1629764559', 'Paiement échoué', 'Le paiement du client a été reactivé avec succès depuis le site d\'administration', 'Clotûré', 'Elevée', '2021-08-24', '2021-08-24', 3, '2021-08-24 00:22:39', '2021-08-24 09:37:44'),
(2, 2, 1, 'TICKET.1629796400', 'Réabonnement inactif', 'Le réabonnement CANASAT du client a été activé manuellement depuis le site d\'administration !', 'Clotûré', 'Elevée', '2021-08-24', '2021-08-24', 3, '2021-08-24 09:13:20', '2021-08-24 10:18:59'),
(3, 3, 1, 'TICKET.1629800413', 'Problème d\'images', NULL, 'Accepté', 'Elevée', '2021-08-24', NULL, 1, '2021-08-24 10:20:13', '2021-08-24 10:46:10'),
(4, 4, NULL, 'TICKET.1631019430', 'Réabonnement inactif', NULL, 'Nouveau', 'Elevée', NULL, NULL, 0, '2021-09-07 12:57:10', '2021-09-07 12:57:10'),
(5, 5, NULL, 'TICKET.1631019515', 'Réabonnement inactif', NULL, 'Nouveau', 'Elevée', NULL, NULL, 0, '2021-09-07 12:58:35', '2021-09-07 12:58:35'),
(6, 6, NULL, 'TICKET.1637497019', 'Absence d\'image', NULL, 'Nouveau', 'Elevée', NULL, NULL, 0, '2021-11-21 13:16:59', '2021-11-21 13:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CLIENT',
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `termes` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `telephone`, `password`, `role`, `profession`, `adresse`, `code_secret`, `active`, `termes`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Yannick ABOH', 'yannickabohthierry@gmail.com', NULL, '24174835631', '$2y$10$lFwZZcyhg8EfAQw/Y3OVSO1cGhDyAFhQHPwNPlQYwoxdaJBp3lqTe', 'ROOT', 'Ingénieur de conception des SI', 'Quartier IAI, Libreville, GABON', '1630952533', 0, 0, '0OJKuDBWoYuZ9pG0A5BGK3kaq5giHxCGzfs2o7kR7beXmegQqaURK8PaAfT5', NULL, '2021-08-17 16:25:56', '2021-09-06 19:36:04'),
(2, 'Arsène HAND', 'arsenehand07@gmail.com', NULL, '24174835632', '$2y$10$UF82ineWCYTBs9CPW9mJ1uJLAvmzgLI0IIffjnZlPflxwLs5s1hge', 'OPERATEUR', 'Informaticien', 'Campus IAI, Libreville, Gabon', NULL, 0, 0, NULL, NULL, '2021-08-17 15:25:56', '2021-09-07 09:18:10'),
(3, 'Ivan OKOUNA', 'ivanoscarokouna@gmail.com', NULL, '24174835633', '$2y$10$KhssseCp2r77FV6bh1ykbem0Fbmp/GgLlR3Wjk9xveAFx44l/mXfG', 'ADMIN', NULL, 'Carrefour cité ndzeng, Libreville, Gabon', NULL, 1, 0, NULL, NULL, '2021-08-17 15:25:56', '2021-08-24 23:51:11'),
(4, 'Aristide MEBODO', 'mebodoaristide@gmail.com', NULL, '24174835634', '$2y$10$xoY4O26ixNfX.zB9r0vSyu86qdFSl.bIQF.cXhT2OnFwTZHMmbnGK', 'SUPERADMIN', NULL, 'Montagne sainte, Libreville, Gabon', NULL, 0, 0, NULL, NULL, '2021-08-17 15:25:56', '2021-08-24 22:16:08'),
(5, 'SAVOURI Hydes', 'savourihydes@gmail.com', NULL, NULL, '$2y$10$bLJ44iCXAV7xHe6iDFZBquhuq8KHD/LiFWeY.JBfaa3Lh/7d5PY06', 'CLIENT', NULL, NULL, NULL, 1, 0, NULL, NULL, '2021-08-19 17:26:21', '2021-08-19 21:56:03'),
(6, 'BEKALE Curly', 'bekale.curly@gmail.com', NULL, '241066682353', '$2y$10$mhx1dNt4SaskFyoR8vjy8.xwSAr1/4mx5xJgzQ3qlR5pk23X8TGXS', 'SUPERADMIN', 'Etudiant', 'Quartier damas, Libreville, Gabon', NULL, 0, 0, NULL, NULL, '2021-08-19 22:37:04', '2021-08-19 22:37:04'),
(7, 'Sloan NDEMBET', 'sloan.ndembet@gmail.com', NULL, '24174529993', '$2y$10$lBTv1gjTr2wM9I7Y3YtLMuDveB4.Co8148vkYdTKyKrz/shUpH/au', 'ROOT', 'Entrepreneur', 'Nouvelle route cité, Ndzeng-ayong, Libreville, Gabon', NULL, 0, 0, NULL, NULL, '2021-08-24 20:46:09', '2021-08-24 20:46:09'),
(8, 'Léo Martin DUBOIS', 'leomartindubois@gmail.com', NULL, '24174835639', '$2y$10$Dr/orb5w9Kxi/btWb.AWsuP.O8Qfg92PjFZbTM5eB/k7MCjE4Rxiy', 'CLIENT', 'Footballeur', 'Avenue matignon, Paris, France', '1637314735', 0, 1, NULL, '0SXF5YNWA46IISU1HAKV0SXF5YNWA46IISU1HAKV0SXF5YNWA46IISU1HAKV0SXF5YNWA46IISU1HAKV0SXF5YNWA46IISU1HAKV', '2021-09-06 17:25:34', '2021-11-19 10:39:50'),
(9, 'Nino MPONDO', 'nino.mpondo@gmail.com', NULL, '+237677640190', '$2y$10$yx8TVp61N/tMgzZ1P8SaMugdMmCfq432uS3UoOnZ9F4PMWrDziEau', 'ROOT', 'Software Engineer', 'Campus IAI, Libreville', NULL, 0, 0, NULL, NULL, '2021-11-01 21:50:33', '2021-11-01 21:50:33'),
(10, 'Samantha KOUEMOU', 'samantha.kouemou@gmail.com', NULL, '074212121', '$2y$10$DhJCeE/vW.DQiVqfXfrs3Oelc8678uBxsNDC3Vh1y4Mwjup5ireYq', 'CLIENT', NULL, NULL, '1637421732', 0, 1, NULL, 'KLwsEmu1JYQU4qV47PWB5n3HDAGn28JJTyJFDuPek2d8aXvAp0WEfpaSAP3lyebKpReBGmnmOxH6iC7REcMISsJy5wgtnL6jDg1P', '2021-11-19 12:07:54', '2021-11-20 16:23:02'),
(11, 'NDONG OBIANG Terence', 'ndong.terence@gmail.com', NULL, '074222222', '$2y$10$sS1zt.SkftOfYg690INE3OrEGXV5//8mV3uefxmWlXlYbCVi5VdQm', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'D6BWYXSSbKiquOkG7cL87O0lnZ9MtNIBjigDZo2m7Hl5X0oGZor2lahazfETBhjKxIsS1lLB4xzts1ek2hAkfg2m1OQYLqLsRn5a', '2021-11-21 17:40:30', '2021-11-21 17:40:30'),
(12, 'sloann Ndembet', 'sloann68@gmail.com', NULL, '074529993', '$2y$10$aTi4G6lu5dHsxWApDnEfiO8ziGUAG/EBC7l29KH9td43vbaY3ZRSK', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'omozeCCtQoNhvu0LUUR34Ey23iLSqkE5GIDqGY3lB22tFA5pWYUvrzSuIEc5QiKMXz9CPuybm8sFCbBtCraobAdfYcOTUfKXgEvk', '2021-12-09 15:58:32', '2021-12-09 15:58:32'),
(13, 'Jason SANCHO', 'jason.sancho@gmail.com', NULL, '074555555', '$2y$10$QzXT0ZJzgVh5G3mIc5783.qtCpAILhKll5S.8VbCTk9XEHAWP307.', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'w8YeUMc0v9lFExuxfQxKQkaEmvdvcLQJcVVPjk5qicGGQU0GcrffNknhVRrKmC10VJtVR7DH5oqcZfnAk03H1Qo2LhH0QhC1mWYO', '2021-12-13 04:53:27', '2021-12-13 04:53:27'),
(14, 'Sloann Ndembet', 'nzaou00006@yahoo.com', NULL, '062529993', '$2y$10$xM9OuCTjdgshK6mA6YKMQe/piz/2MEXMB5i0u8PuePQZ//sq7KOgq', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, '1TizIeyBsww0SmT60U894qwqK8JQ9RkvbBzcMOuGxuiIib6UlCAqkKCIeuYZ2IsBfnMPorrG2chDsN8cqRClveRjec1fk24Tnraj', '2021-12-13 15:18:00', '2021-12-13 15:18:00'),
(15, 'NDONG Albert', 'albert.ndong@gmail.com', NULL, '074565656', '$2y$10$Un76IU3PBe5teREMBm6tEe7iDL1YnA/FQhH/tEN/Jul1Zp7JhU0Ii', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'y36bvtahdP3DLuxPsHjOkMDU3qDV4F2un69Chv9HB25Po4OB6wEF54fjIvuSqD6euqBkiw4mWN7uiFfKVE5wfZwTzM8AxFZumJf7', '2021-12-13 15:41:08', '2021-12-13 15:41:08'),
(16, 'steve noel MBALLA', 'stevenoel.mballa@canal-plus.com', NULL, '062512174', '$2y$10$EZ7DgfCTNKzXcfgRzpT4S.M5UjgEXVAOoHx5HD5.KRUcz3SfLgR96', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'PsrKf7AWbS4EYSQ2saaCx2qBJoBRRTV8irryucVkPGV7jvyI077lTgZ7na3J4TryNUiwg9JyuxYkhaiXKvg6Hk2HfkiGcjj4nMJE', '2021-12-14 16:14:33', '2021-12-14 16:14:33'),
(17, 'MABIKA Stefane', 'stefane.mabika@gmail.com', NULL, '074333333', '$2y$10$YLwUqhH3BqJ25grWfbpWGu2q4oyJt3PrBts.LxFX5JnwRuKX7UtGy', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, '3ZndcykrtFhSXFezhoDmG90g6NuL73fsLBjVyW3oW6B5cwKvra2xZe5vXNoWTEhUawIF7O6svPHYDOZ59OppVXnYmTzFQ0Tif6Ev', '2021-12-27 15:44:28', '2021-12-27 15:44:28'),
(18, 'Jack DANIELS', 'jack.daniels@gmail.com', NULL, '074353535', '$2y$10$9WlTNcq4qGYRnvFEs2YjaOkvtSTKH7eyR8KoJHdTG3ZrR9JO5plZm', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'kyLD4eRqf4REfClzmloEPhMH9qmBcE1mV0whYwkXfE9R4Hi4GQaRxLvV6IhotliKVPp8l7My1HNJHDIDPaRZZypmqy1Reeiz3C7p', '2021-12-28 13:41:03', '2021-12-28 13:41:03'),
(19, 'Jules NDONG', 'ndong.jules@gmail.com', NULL, '074696969', '$2y$10$R93Dd1aniaIph1tZPK.H1.l6nZnaO5CGo3F8jtzc/IcBAbIye73p2', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'orMnVSa7yqHfxT2Z9ky59nq2TeNPQTTfWTJnNWX9qJUbNXHAvuJuSwTMMP7o2PZ6MlFcDDDX1a7em00ZE2Ta0aRuYabH31Bvu0LE', '2021-12-28 14:44:27', '2021-12-28 14:44:27'),
(20, 'Benoit MEZUI', 'benoit.mezui@gmail.com', NULL, '074181818', '$2y$10$/nvQrwFI2hapqGX3tQoktOj0Q46TdfIpjwNy7jjUKP1bM.RwVJ4vi', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, 'o9QlnJqfWq3lHcpwhLVg0YNk8nLfxfogkDHChsAV64sDPq3UswvgJBQu0v7xuiC6mn1rhWHPjhwI1cAfXiJ4Hm8Ias5YOCjBRjgS', '2021-12-29 10:58:07', '2021-12-29 10:58:07'),
(21, 'Matthieu Vincent', 'vincent.matthieu@gmail.com', NULL, '074303030', '$2y$10$LoOvZiOrZyVzrDZdS7KDDeOJ4llDpU5imsQfIsWoDyiz5/Ydv7Mne', 'CLIENT', NULL, NULL, NULL, 0, 1, NULL, '55TjaUGxJgxTkdXVKzwneiZFjA725i5q2wZ8icOqLIdjSvNLdrMUHP8pQdf6YDYrz5klzyjSDbmlK2fvmQPoyYKOcwKaZXdRwq6i', '2021-12-29 15:22:01', '2021-12-29 15:22:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `box_canals`
--
ALTER TABLE `box_canals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chaines`
--
ALTER TABLE `chaines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chaine_offres`
--
ALTER TABLE `chaine_offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compte_marchands`
--
ALTER TABLE `compte_marchands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decodeurs`
--
ALTER TABLE `decodeurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forfaits`
--
ALTER TABLE `forfaits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouchards`
--
ALTER TABLE `mouchards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_offres`
--
ALTER TABLE `option_offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `publicites`
--
ALTER TABLE `publicites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reabonnements`
--
ALTER TABLE `reabonnements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telephone_unique` (`telephone`),
  ADD UNIQUE KEY `api_token` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `box_canals`
--
ALTER TABLE `box_canals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chaines`
--
ALTER TABLE `chaines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chaine_offres`
--
ALTER TABLE `chaine_offres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compte_marchands`
--
ALTER TABLE `compte_marchands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `decodeurs`
--
ALTER TABLE `decodeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forfaits`
--
ALTER TABLE `forfaits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mouchards`
--
ALTER TABLE `mouchards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `option_offres`
--
ALTER TABLE `option_offres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `publicites`
--
ALTER TABLE `publicites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reabonnements`
--
ALTER TABLE `reabonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
