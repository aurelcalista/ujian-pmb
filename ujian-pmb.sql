-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2026 at 05:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujian-pmb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'PMB Administrator', 'admin@cic.ac.id', '$2y$12$Agt9rJYkMl82rUGpP9h5T.p.M.iTxCFqqFcQ04tbdAPu9OiieTGlq', '2026-08-07 05:11:51', '2026-08-10 05:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '90',
  `shuffle_questions` tinyint(1) NOT NULL DEFAULT '1',
  `shuffle_options` tinyint(1) NOT NULL DEFAULT '1',
  `fullscreen_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `autosave_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `anti_cheat_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `max_violation` int NOT NULL DEFAULT '3',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `study_program_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `description`, `start_time`, `end_time`, `duration`, `shuffle_questions`, `shuffle_options`, `fullscreen_enabled`, `autosave_enabled`, `anti_cheat_enabled`, `max_violation`, `status`, `created_at`, `updated_at`, `study_program_id`) VALUES
(1, 'Ujian CBT Seleksi PMB UCIC 2026/2027', 'Tes Potensi Akademik, Logika Penalaran, dan Bahasa Inggris untuk Calon Mahasiswa Baru Universitas Catur Insan Cendekia.', '2026-08-09 12:06:53', '2026-09-09 12:06:53', 150, 1, 1, 1, 1, 1, 3, 'active', '2026-08-07 05:11:51', '2026-08-10 05:06:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_activity_logs`
--

CREATE TABLE `exam_activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `violation_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_activity_logs`
--

INSERT INTO `exam_activity_logs` (`id`, `session_id`, `activity_type`, `description`, `violation_number`, `created_at`, `updated_at`) VALUES
(20, 18, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 1, '2026-08-10 04:12:32', '2026-08-10 04:12:32'),
(21, 18, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 2, '2026-08-10 04:13:05', '2026-08-10 04:13:05'),
(22, 18, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 3, '2026-08-10 04:13:07', '2026-08-10 04:13:07'),
(23, 19, 'window_blur', 'Peserta terdeteksi mengklik luar jendela browser', 1, '2026-08-10 04:23:44', '2026-08-10 04:23:44'),
(24, 20, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 1, '2026-08-10 05:08:40', '2026-08-10 05:08:40'),
(25, 20, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 2, '2026-08-10 05:09:13', '2026-08-10 05:09:13'),
(26, 21, 'keluar_fullscreen', 'Peserta terdeteksi keluar dari mode layar penuh (Fullscreen)', 1, '2026-08-10 05:11:22', '2026-08-10 05:11:22'),
(27, 22, 'window_blur', 'Peserta terdeteksi mengklik luar jendela browser', 1, '2026-08-10 05:14:25', '2026-08-10 05:14:25'),
(28, 22, 'window_blur', 'Peserta terdeteksi mengklik luar jendela browser', 2, '2026-08-10 05:14:29', '2026-08-10 05:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `exam_sessions`
--

CREATE TABLE `exam_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `participant_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `started_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  `question_order` text COLLATE utf8mb4_unicode_ci,
  `option_order` text COLLATE utf8mb4_unicode_ci,
  `violation_count` int NOT NULL DEFAULT '0',
  `security_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aman',
  `score` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_sessions`
--

INSERT INTO `exam_sessions` (`id`, `participant_id`, `exam_id`, `started_at`, `finished_at`, `status`, `question_order`, `option_order`, `violation_count`, `security_status`, `score`, `created_at`, `updated_at`) VALUES
(18, 38, 1, '2026-08-10 11:11:49', '2026-08-10 11:13:07', 'finished', '[135,139,130,137,138,140,134,133,136,132,131]', '{\"135\":[511,513,514,512],\"139\":[529,528,530,527],\"130\":[492,491,493,494],\"137\":[519,522,521,520],\"138\":[523,524,526,525],\"140\":[532,531],\"134\":[510,508,507,509],\"133\":[504,503,506,505],\"136\":[515,518,517,516],\"132\":[501,499,502,500],\"131\":[496,497,495,498]}', 3, 'Terindikasi Pelanggaran / Diblokir', 0.00, '2026-08-10 04:11:49', '2026-08-10 04:13:07'),
(19, 39, 1, '2026-08-10 11:23:31', '2026-08-10 11:24:07', 'finished', '[130,140,131,136,133,137,138,132,134,139,135]', '{\"130\":[494,493,492,491],\"140\":[532,531],\"131\":[497,498,496,495],\"136\":[515,518,517,516],\"133\":[505,503,504,506],\"137\":[520,519,522,521],\"138\":[526,524,525,523],\"132\":[499,502,500,501],\"134\":[507,508,509,510],\"139\":[529,527,528,530],\"135\":[512,513,514,511]}', 1, 'Mendapat Peringatan', 23.81, '2026-08-10 04:23:31', '2026-08-10 04:24:07'),
(20, 41, 1, '2026-08-10 12:08:27', NULL, 'ongoing', '[18,54,29,17,50,8,3,31,59,42,14,12,7,13,57,4,46,43,58,36,27,30,20,33,47,28,21,48,9,23,16,55,11,45,40,44,24,41,52,32,34,37,25,56,35,53,39,15,26,19,22,10,6,38,5,51,1,49,2,60]', '{\"18\":[71,70,69,72],\"54\":[213,214,216,215],\"29\":[115,113,114,116],\"17\":[67,66,68,65],\"50\":[197,200,198,199],\"8\":[29,32,31,30],\"3\":[11,9,12,10],\"31\":[124,123,122,121],\"59\":[235,234,236,233],\"42\":[166,168,165,167],\"14\":[53,56,55,54],\"12\":[48,45,46,47],\"7\":[28,26,25,27],\"13\":[51,49,50,52],\"57\":[226,225,227,228],\"4\":[14,15,13,16],\"46\":[183,184,182,181],\"43\":[171,169,170,172],\"58\":[229,232,230,231],\"36\":[142,141,144,143],\"27\":[105,107,108,106],\"30\":[120,118,117,119],\"20\":[79,77,80,78],\"33\":[129,132,131,130],\"47\":[188,185,187,186],\"28\":[109,112,110,111],\"21\":[83,84,81,82],\"48\":[192,190,189,191],\"9\":[34,35,33,36],\"23\":[91,90,89,92],\"16\":[62,64,61,63],\"55\":[218,219,217,220],\"11\":[42,41,43,44],\"45\":[177,179,178,180],\"40\":[158,160,157,159],\"44\":[173,175,174,176],\"24\":[94,95,93,96],\"41\":[162,161,163,164],\"52\":[208,206,207,205],\"32\":[128,127,125,126],\"34\":[134,136,133,135],\"37\":[148,146,145,147],\"25\":[98,97,99,100],\"56\":[224,221,222,223],\"35\":[137,138,140,139],\"53\":[212,209,211,210],\"39\":[155,156,153,154],\"15\":[58,57,59,60],\"26\":[103,101,102,104],\"19\":[73,74,76,75],\"22\":[88,86,87,85],\"10\":[37,38,40,39],\"6\":[21,22,23,24],\"38\":[152,149,150,151],\"5\":[19,20,18,17],\"51\":[204,201,202,203],\"1\":[3,4,1,2],\"49\":[196,193,195,194],\"2\":[7,8,5,6],\"60\":[238,237,239,240]}', 2, 'Mendapat Peringatan', NULL, '2026-08-10 05:08:27', '2026-08-10 05:09:13'),
(21, 42, 1, '2026-08-10 12:10:29', NULL, 'ongoing', '[4,43,41,45,39,34,56,31,3,15,40,38,8,12,14,51,18,33,11,20,23,16,25,19,21,2,58,53,28,24,54,26,9,44,47,55,32,7,49,46,22,48,29,52,37,60,6,30,17,35,57,59,13,1,36,50,5,27,42,10]', '{\"4\":[13,14,15,16],\"43\":[171,170,169,172],\"41\":[161,164,163,162],\"45\":[177,178,180,179],\"39\":[154,153,155,156],\"34\":[135,134,136,133],\"56\":[222,223,224,221],\"31\":[122,121,123,124],\"3\":[10,12,9,11],\"15\":[57,58,59,60],\"40\":[157,158,159,160],\"38\":[149,151,152,150],\"8\":[32,31,29,30],\"12\":[46,48,45,47],\"14\":[53,54,56,55],\"51\":[204,201,203,202],\"18\":[72,69,71,70],\"33\":[132,131,130,129],\"11\":[42,43,44,41],\"20\":[79,78,77,80],\"23\":[89,91,90,92],\"16\":[64,61,62,63],\"25\":[98,100,97,99],\"19\":[74,73,75,76],\"21\":[84,83,81,82],\"2\":[7,6,5,8],\"58\":[229,230,232,231],\"53\":[209,211,210,212],\"28\":[111,109,110,112],\"24\":[94,95,93,96],\"54\":[213,216,215,214],\"26\":[101,103,102,104],\"9\":[33,36,35,34],\"44\":[173,176,174,175],\"47\":[187,188,186,185],\"55\":[219,217,220,218],\"32\":[127,128,126,125],\"7\":[28,25,26,27],\"49\":[195,193,196,194],\"46\":[181,183,182,184],\"22\":[85,87,88,86],\"48\":[189,191,192,190],\"29\":[116,113,114,115],\"52\":[206,205,207,208],\"37\":[146,147,145,148],\"60\":[239,237,240,238],\"6\":[21,22,23,24],\"30\":[119,118,120,117],\"17\":[65,67,66,68],\"35\":[138,137,139,140],\"57\":[227,226,225,228],\"59\":[235,236,233,234],\"13\":[51,49,52,50],\"1\":[2,3,1,4],\"36\":[141,142,144,143],\"50\":[197,200,198,199],\"5\":[17,18,19,20],\"27\":[108,107,106,105],\"42\":[167,166,168,165],\"10\":[38,39,37,40]}', 1, 'Mendapat Peringatan', NULL, '2026-08-10 05:10:29', '2026-08-10 05:11:22'),
(22, 43, 1, '2026-08-10 12:13:46', NULL, 'ongoing', '[16,53,58,39,48,22,51,26,5,60,12,21,1,13,11,20,15,3,30,42,52,49,45,59,32,29,44,6,2,35,55,37,7,43,25,24,18,14,41,8,50,46,34,10,54,47,38,31,9,23,33,27,19,57,40,28,17,4,56,36]', '{\"16\":[62,63,64,61],\"53\":[211,212,210,209],\"58\":[232,229,231,230],\"39\":[155,153,154,156],\"48\":[191,192,190,189],\"22\":[85,88,86,87],\"51\":[202,201,204,203],\"26\":[101,103,104,102],\"5\":[19,17,18,20],\"60\":[237,238,239,240],\"12\":[45,47,48,46],\"21\":[82,81,83,84],\"1\":[2,3,1,4],\"13\":[52,50,51,49],\"11\":[41,43,44,42],\"20\":[80,79,77,78],\"15\":[58,60,57,59],\"3\":[9,12,10,11],\"30\":[117,120,119,118],\"42\":[167,166,168,165],\"52\":[207,208,206,205],\"49\":[193,194,196,195],\"45\":[180,177,179,178],\"59\":[236,235,234,233],\"32\":[127,126,125,128],\"29\":[115,114,116,113],\"44\":[173,175,174,176],\"6\":[24,21,22,23],\"2\":[7,5,8,6],\"35\":[140,139,137,138],\"55\":[218,219,217,220],\"37\":[147,146,148,145],\"7\":[25,28,26,27],\"43\":[172,170,169,171],\"25\":[98,100,99,97],\"24\":[95,94,96,93],\"18\":[72,71,70,69],\"14\":[55,53,56,54],\"41\":[164,162,161,163],\"8\":[29,31,30,32],\"50\":[199,197,198,200],\"46\":[182,181,184,183],\"34\":[133,136,135,134],\"10\":[40,37,38,39],\"54\":[214,215,216,213],\"47\":[185,187,188,186],\"38\":[151,152,149,150],\"31\":[123,122,124,121],\"9\":[33,35,36,34],\"23\":[89,91,90,92],\"33\":[132,129,130,131],\"27\":[106,107,105,108],\"19\":[76,75,73,74],\"57\":[227,225,228,226],\"40\":[159,157,158,160],\"28\":[110,111,112,109],\"17\":[67,66,65,68],\"4\":[15,14,13,16],\"56\":[221,224,223,222],\"36\":[142,144,143,141]}', 2, 'Mendapat Peringatan', NULL, '2026-08-10 05:13:46', '2026-08-10 05:14:29'),
(23, 44, 1, '2026-08-10 12:14:20', NULL, 'ongoing', '[50,3,25,41,52,45,1,46,12,13,36,34,38,35,18,37,43,31,7,32,40,54,53,8,55,21,5,57,27,2,24,20,51,23,15,29,19,17,4,26,30,47,16,39,28,10,60,48,11,14,42,22,58,56,59,49,9,33,6,44]', '{\"50\":[198,200,197,199],\"3\":[11,9,10,12],\"25\":[100,98,99,97],\"41\":[161,164,163,162],\"52\":[207,205,208,206],\"45\":[177,180,179,178],\"1\":[2,1,3,4],\"46\":[184,181,182,183],\"12\":[45,46,48,47],\"13\":[50,49,51,52],\"36\":[144,141,143,142],\"34\":[135,136,134,133],\"38\":[149,152,150,151],\"35\":[138,137,140,139],\"18\":[69,70,71,72],\"37\":[147,148,145,146],\"43\":[172,170,169,171],\"31\":[123,121,122,124],\"7\":[27,25,26,28],\"32\":[127,125,128,126],\"40\":[157,158,160,159],\"54\":[215,213,214,216],\"53\":[212,211,210,209],\"8\":[31,30,32,29],\"55\":[220,217,219,218],\"21\":[81,82,83,84],\"5\":[20,19,17,18],\"57\":[226,227,228,225],\"27\":[107,108,105,106],\"2\":[6,7,5,8],\"24\":[95,94,96,93],\"20\":[79,80,78,77],\"51\":[203,201,202,204],\"23\":[90,89,92,91],\"15\":[57,60,58,59],\"29\":[115,114,116,113],\"19\":[75,74,76,73],\"17\":[67,66,68,65],\"4\":[14,15,16,13],\"26\":[101,103,102,104],\"30\":[118,120,119,117],\"47\":[186,187,188,185],\"16\":[62,61,63,64],\"39\":[155,153,154,156],\"28\":[109,110,111,112],\"10\":[39,40,38,37],\"60\":[237,240,238,239],\"48\":[190,191,189,192],\"11\":[42,44,41,43],\"14\":[54,55,56,53],\"42\":[165,167,166,168],\"22\":[85,87,88,86],\"58\":[229,230,231,232],\"56\":[223,224,221,222],\"59\":[233,235,234,236],\"49\":[194,196,193,195],\"9\":[34,36,33,35],\"33\":[132,129,131,130],\"6\":[22,23,24,21],\"44\":[173,174,176,175]}', 0, 'Aman', NULL, '2026-08-10 05:14:20', '2026-08-10 05:14:20'),
(24, 45, 1, '2026-08-10 12:14:24', NULL, 'ongoing', '[56,25,47,54,44,15,10,19,29,57,9,30,46,18,33,38,20,53,8,55,43,41,58,16,49,6,45,26,7,34,35,14,21,13,40,36,12,51,42,27,28,59,60,1,48,52,37,39,50,22,31,23,24,2,17,11,4,32,5,3]', '{\"56\":[223,222,224,221],\"25\":[97,99,100,98],\"47\":[187,188,186,185],\"54\":[213,215,214,216],\"44\":[176,175,174,173],\"15\":[57,60,59,58],\"10\":[37,38,40,39],\"19\":[76,75,74,73],\"29\":[116,115,114,113],\"57\":[228,225,227,226],\"9\":[35,34,36,33],\"30\":[119,120,117,118],\"46\":[182,183,181,184],\"18\":[72,71,69,70],\"33\":[129,131,132,130],\"38\":[152,151,149,150],\"20\":[80,77,79,78],\"53\":[210,209,212,211],\"8\":[32,29,31,30],\"55\":[220,217,218,219],\"43\":[169,170,171,172],\"41\":[161,162,164,163],\"58\":[230,232,229,231],\"16\":[64,62,61,63],\"49\":[194,196,195,193],\"6\":[22,23,21,24],\"45\":[177,178,180,179],\"26\":[103,104,102,101],\"7\":[25,27,26,28],\"34\":[134,135,136,133],\"35\":[139,140,138,137],\"14\":[53,54,55,56],\"21\":[84,83,81,82],\"13\":[51,49,50,52],\"40\":[159,160,158,157],\"36\":[144,141,143,142],\"12\":[45,47,46,48],\"51\":[202,203,201,204],\"42\":[165,168,167,166],\"27\":[107,106,108,105],\"28\":[112,109,111,110],\"59\":[233,235,236,234],\"60\":[239,237,240,238],\"1\":[1,4,2,3],\"48\":[191,189,192,190],\"52\":[208,205,206,207],\"37\":[148,147,146,145],\"39\":[153,154,155,156],\"50\":[200,197,198,199],\"22\":[88,85,86,87],\"31\":[121,122,123,124],\"23\":[92,89,91,90],\"24\":[95,93,96,94],\"2\":[8,7,5,6],\"17\":[68,66,65,67],\"11\":[42,41,44,43],\"4\":[15,16,14,13],\"32\":[127,126,128,125],\"5\":[17,20,19,18],\"3\":[10,12,9,11]}', 0, 'Aman', NULL, '2026-08-10 05:14:24', '2026-08-10 05:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '0001_01_01_000000_create_users_table', 1),
(26, '0001_01_01_000001_create_cache_table', 1),
(27, '0001_01_01_000002_create_jobs_table', 1),
(28, '2026_08_07_000001_create_cbt_pmb_tables', 1),
(29, '2026_08_07_104728_create_study_programs_table', 1),
(30, '2026_08_07_112242_add_study_program_id_to_exams_table', 1),
(31, '2026_08_07_112304_remove_major_choice_2_from_participants_table', 1),
(32, '2026_08_07_112933_add_image_to_questions_table', 1),
(33, '2026_08_10_113231_add_major_choice_2_to_participants_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_choice_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_choice_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `exam_id`, `name`, `school_origin`, `major_choice_1`, `major_choice_2`, `created_at`, `updated_at`) VALUES
(38, 1, 'p', 'smkn1cirebon', 'S1 Pendidikan Kepelatihan Olahraga', NULL, '2026-08-10 04:11:34', '2026-08-10 04:12:20'),
(39, 1, 'kefas', 'sma', 'S1 Pendidikan Kepelatihan Olahraga', NULL, '2026-08-10 04:23:25', '2026-08-10 04:23:25'),
(40, 1, 'arel', 'smkn1cirebon', 'S1 Sistem Informasi', 'D3 Manajemen Bisnis', '2026-08-10 04:43:17', '2026-08-10 04:43:17'),
(41, 1, 'nunu', 'smkn1cirebon', 'S1 Bisnis Digital', 'S1 Pendidikan Kepelatihan Olahraga', '2026-08-10 05:08:23', '2026-08-10 05:08:23'),
(42, 1, 'pais', 'smkn1cirebon', 'S1 Pendidikan Matematika', 'S1 Akuntansi', '2026-08-10 05:10:26', '2026-08-10 05:10:26'),
(43, 1, 'sofi', 'smkn 1 cirebon', 'D3 Manajemen Informatika', 'S1 Akuntansi', '2026-08-10 05:13:43', '2026-08-10 05:13:43'),
(44, 1, 'arel calista', 'smkn 1 cirebon', 'S1 Sistem Informasi', 'S1 Teknik Informatika', '2026-08-10 05:13:46', '2026-08-10 05:13:46'),
(45, 1, 'Jihan Riesty Aprilia', 'SMKN 1 CIREBON', 'S1 Sistem Informasi', 'S1 Desain Komunikasi', '2026-08-10 05:14:07', '2026-08-10 05:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `participant_answers`
--

CREATE TABLE `participant_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `option_id` bigint UNSIGNED DEFAULT NULL,
  `is_doubt` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant_answers`
--

INSERT INTO `participant_answers` (`id`, `session_id`, `question_id`, `option_id`, `is_doubt`, `created_at`, `updated_at`) VALUES
(24, 19, 130, 492, 0, '2026-08-10 04:23:52', '2026-08-10 04:23:52'),
(25, 19, 140, 531, 0, '2026-08-10 04:23:54', '2026-08-10 04:23:54'),
(26, 19, 131, 495, 0, '2026-08-10 04:23:56', '2026-08-10 04:23:56'),
(27, 19, 136, 517, 0, '2026-08-10 04:23:57', '2026-08-10 04:23:57'),
(28, 19, 133, 504, 0, '2026-08-10 04:23:58', '2026-08-10 04:23:58'),
(29, 19, 137, 522, 0, '2026-08-10 04:24:00', '2026-08-10 04:24:00'),
(30, 19, 138, 523, 0, '2026-08-10 04:24:01', '2026-08-10 04:24:01'),
(31, 19, 132, 500, 0, '2026-08-10 04:24:02', '2026-08-10 04:24:02'),
(32, 19, 134, 510, 0, '2026-08-10 04:24:04', '2026-08-10 04:24:04'),
(33, 19, 139, 530, 0, '2026-08-10 04:24:05', '2026-08-10 04:24:05'),
(34, 19, 135, 514, 0, '2026-08-10 04:24:06', '2026-08-10 04:24:06'),
(35, 22, 16, 63, 0, '2026-08-10 05:13:52', '2026-08-10 05:13:52'),
(36, 22, 5, 18, 0, '2026-08-10 05:14:22', '2026-08-10 05:14:22'),
(37, 23, 50, 198, 0, '2026-08-10 05:14:25', '2026-08-10 05:14:25'),
(38, 23, 3, 10, 0, '2026-08-10 05:14:27', '2026-08-10 05:14:28'),
(39, 23, 25, 98, 0, '2026-08-10 05:14:30', '2026-08-10 05:14:30'),
(40, 23, 41, 162, 0, '2026-08-10 05:14:32', '2026-08-10 05:14:32'),
(41, 23, 52, 206, 0, '2026-08-10 05:14:37', '2026-08-10 05:14:37'),
(42, 23, 45, 177, 0, '2026-08-10 05:14:40', '2026-08-10 05:14:40'),
(43, 23, 1, 2, 0, '2026-08-10 05:14:57', '2026-08-10 05:15:00'),
(44, 23, 46, 184, 0, '2026-08-10 05:15:04', '2026-08-10 05:15:04'),
(45, 23, 12, 47, 0, '2026-08-10 05:15:06', '2026-08-10 05:15:06'),
(46, 23, 13, 52, 0, '2026-08-10 05:15:07', '2026-08-10 05:15:08'),
(47, 23, 36, 142, 0, '2026-08-10 05:15:10', '2026-08-10 05:15:10'),
(48, 23, 34, 134, 0, '2026-08-10 05:15:11', '2026-08-10 05:15:11'),
(49, 23, 38, 150, 0, '2026-08-10 05:15:12', '2026-08-10 05:15:12'),
(50, 23, 35, 138, 0, '2026-08-10 05:15:14', '2026-08-10 05:15:14'),
(51, 23, 18, 71, 0, '2026-08-10 05:15:16', '2026-08-10 05:15:16'),
(52, 23, 37, 146, 0, '2026-08-10 05:15:17', '2026-08-10 05:15:17'),
(53, 23, 43, 171, 0, '2026-08-10 05:15:19', '2026-08-10 05:15:19'),
(54, 23, 31, 122, 0, '2026-08-10 05:15:21', '2026-08-10 05:15:21'),
(55, 23, 7, 28, 0, '2026-08-10 05:15:21', '2026-08-10 05:15:22'),
(56, 23, 32, 126, 0, '2026-08-10 05:15:23', '2026-08-10 05:15:24'),
(57, 23, 40, 158, 0, '2026-08-10 05:15:24', '2026-08-10 05:15:26'),
(58, 24, 25, 98, 0, '2026-08-10 05:15:26', '2026-08-10 05:15:26'),
(59, 23, 54, 214, 0, '2026-08-10 05:15:27', '2026-08-10 05:15:27'),
(60, 23, 53, 210, 0, '2026-08-10 05:15:28', '2026-08-10 05:15:28'),
(61, 23, 8, 29, 0, '2026-08-10 05:15:29', '2026-08-10 05:15:29'),
(62, 23, 55, 218, 0, '2026-08-10 05:15:30', '2026-08-10 05:15:30'),
(63, 24, 47, 187, 0, '2026-08-10 05:15:31', '2026-08-10 05:15:31'),
(64, 23, 21, 82, 0, '2026-08-10 05:15:31', '2026-08-10 05:15:31'),
(65, 24, 54, 214, 0, '2026-08-10 05:15:32', '2026-08-10 05:15:50'),
(66, 24, 44, 174, 0, '2026-08-10 05:15:52', '2026-08-10 05:15:52'),
(67, 23, 5, 18, 0, '2026-08-10 05:15:52', '2026-08-10 05:15:52'),
(68, 23, 57, 226, 0, '2026-08-10 05:15:54', '2026-08-10 05:15:54'),
(69, 23, 27, 106, 0, '2026-08-10 05:15:55', '2026-08-10 05:15:55'),
(70, 23, 2, 6, 0, '2026-08-10 05:15:56', '2026-08-10 05:16:01'),
(71, 24, 15, 59, 0, '2026-08-10 05:15:58', '2026-08-10 05:16:10'),
(72, 23, 24, 94, 0, '2026-08-10 05:16:03', '2026-08-10 05:16:03'),
(73, 23, 20, 78, 0, '2026-08-10 05:16:05', '2026-08-10 05:16:05'),
(74, 23, 51, 202, 0, '2026-08-10 05:16:07', '2026-08-10 05:16:08'),
(75, 23, 23, 90, 0, '2026-08-10 05:16:10', '2026-08-10 05:16:10'),
(76, 23, 15, 59, 0, '2026-08-10 05:16:11', '2026-08-10 05:16:11'),
(77, 23, 29, 114, 0, '2026-08-10 05:16:12', '2026-08-10 05:16:12'),
(78, 23, 19, 75, 0, '2026-08-10 05:16:14', '2026-08-10 05:16:14'),
(79, 23, 17, 66, 0, '2026-08-10 05:16:15', '2026-08-10 05:16:15'),
(80, 24, 10, 37, 0, '2026-08-10 05:16:15', '2026-08-10 05:16:15'),
(81, 23, 4, 14, 0, '2026-08-10 05:16:15', '2026-08-10 05:16:41'),
(82, 23, 26, 102, 0, '2026-08-10 05:16:45', '2026-08-10 05:16:45'),
(83, 23, 30, 118, 0, '2026-08-10 05:16:46', '2026-08-10 05:16:46'),
(84, 23, 47, 186, 0, '2026-08-10 05:16:47', '2026-08-10 05:16:47'),
(85, 23, 16, 63, 0, '2026-08-10 05:16:49', '2026-08-10 05:16:49'),
(86, 23, 39, 154, 0, '2026-08-10 05:16:51', '2026-08-10 05:16:51'),
(87, 23, 28, 110, 0, '2026-08-10 05:16:53', '2026-08-10 05:16:53'),
(88, 24, 19, 74, 0, '2026-08-10 05:16:54', '2026-08-10 05:16:54'),
(89, 24, 29, 114, 0, '2026-08-10 05:16:54', '2026-08-10 05:16:56'),
(90, 23, 10, 40, 0, '2026-08-10 05:16:55', '2026-08-10 05:16:55'),
(91, 23, 60, 240, 0, '2026-08-10 05:16:56', '2026-08-10 05:16:56'),
(92, 23, 48, 190, 0, '2026-08-10 05:16:57', '2026-08-10 05:16:58'),
(93, 24, 57, 226, 0, '2026-08-10 05:16:57', '2026-08-10 05:16:57'),
(94, 23, 11, 44, 0, '2026-08-10 05:16:58', '2026-08-10 05:16:58'),
(95, 24, 9, 34, 0, '2026-08-10 05:16:59', '2026-08-10 05:16:59'),
(96, 23, 14, 55, 0, '2026-08-10 05:16:59', '2026-08-10 05:16:59'),
(97, 24, 30, 118, 0, '2026-08-10 05:17:00', '2026-08-10 05:17:00'),
(98, 23, 42, 165, 0, '2026-08-10 05:17:00', '2026-08-10 05:17:00'),
(99, 23, 22, 86, 0, '2026-08-10 05:17:01', '2026-08-10 05:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(8,2) NOT NULL DEFAULT '2.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question_text`, `image`, `weight`, `created_at`, `updated_at`) VALUES
(1, 1, 'PADI : BERAS = ... : ...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(2, 1, 'DOKTER : PASIEN = GURU : ...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(3, 1, 'Kata \"BIJAKSANA\" memiliki makna yang sama dengan...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(4, 1, 'Kata \"EFEKTIF\" memiliki makna yang sama dengan...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(5, 1, 'Lawan kata dari \"OPTIMIS\" adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(6, 1, 'Lawan kata dari \"KONSISTEN\" adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(7, 1, 'Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang.\r<br>Ide pokok paragraf di atas adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(8, 1, 'Berdasarkan paragraf berikut:\r<br>\"Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang.\"\r<br>Alasan belajar konsisten lebih efektif adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(9, 1, 'Semua mahasiswa penerima KIP Kuliah wajib menjaga IPK minimal 3,00. Andi adalah penerima KIP Kuliah. Kesimpulan yang tepat adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(10, 1, 'Jika hujan turun, maka jalan menjadi basah. Kenyataannya jalan tidak basah. Kesimpulan yang tepat adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(11, 1, 'Seorang mahasiswa mendapat beasiswa yang menanggung 80% biaya kuliah sebesar Rp5.000.000 per semester. Berapa yang harus ia bayar sendiri?', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(12, 1, 'Nilai ujian seorang siswa naik dari 70 menjadi 84. Berapa persen kenaikan nilainya?', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(13, 1, 'Perbandingan jumlah mahasiswa laki-laki dan perempuan penerima KIP Kuliah di sebuah kampus adalah 3:5. Jika total penerima 160 orang, jumlah mahasiswa perempuan adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(14, 1, 'Sebuah larutan dibuat dengan perbandingan air dan gula 4:1. Jika digunakan 500 ml air, gula yang dibutuhkan adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(15, 1, 'Perhatikan pola bilangan berikut: 2, 6, 12, 20, 30, ... Angka selanjutnya adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(16, 1, 'Perhatikan pola bilangan berikut: 3, 5, 9, 15, 23, ... Angka selanjutnya adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(17, 1, 'Untuk menyelesaikan sebuah proyek, 4 orang membutuhkan waktu 12 hari. Jika dikerjakan oleh 6 orang dengan kecepatan kerja yang sama, waktu yang dibutuhkan adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(18, 1, 'Harga 3 buku adalah Rp45.000. Berapa harga 7 buku dengan harga satuan yang sama?', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(19, 1, 'Jumlah penerima KIP Kuliah di sebuah kampus: 2021 = 120 orang, 2022 = 150 orang, 2023 = 180 orang, 2024 = 200 orang. Rata-rata pertambahan penerima per tahun adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(20, 1, 'Berdasarkan data pada soal nomor 19, persentase kenaikan jumlah penerima dari tahun 2023 ke 2024 adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(21, 1, 'Seorang mahasiswa penerima KIP Kuliah mengalami penurunan IPK karena bekerja paruh waktu untuk membantu orang tua. Tindakan paling tepat yang sebaiknya ia lakukan adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(22, 1, 'Dua mahasiswa mengerjakan tugas kelompok. Salah satu jarang berkontribusi namun mendapat nilai yang sama. Sikap paling tepat dari mahasiswa yang aktif adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(23, 1, 'Ani jarang mengikuti kelas karena harus menjaga adiknya di rumah. Akibat yang paling mungkin terjadi adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(24, 1, 'Kenaikan harga kebutuhan pokok menyebabkan sebagian keluarga kurang mampu kesulitan membiayai pendidikan anak. Program KIP Kuliah dibuat sebagai...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(25, 1, 'Sebuah kampus mencatat bahwa 70% mahasiswa yang aktif berorganisasi memiliki IPK di atas 3,25, sedangkan mahasiswa yang pasif berorganisasi mayoritas memiliki IPK di bawah 3,00. Kesimpulan paling tepat berdasarkan data ini adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(26, 1, 'Dalam sebuah survei, 60% responden menyatakan lebih suka belajar pada malam hari. Apakah kesimpulan \"semua orang belajar lebih baik pada malam hari\" tepat?', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(27, 1, '\"Karena rajin belajar, Budi pasti akan lulus dengan nilai terbaik.\" Asumsi yang mendasari pernyataan tersebut adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(28, 1, '\"Karena berasal dari keluarga kurang mampu, mahasiswa tersebut pasti kurang mampu secara akademik.\" Pernyataan ini mengandung asumsi yang keliru karena...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(29, 1, 'Seorang mahasiswa memiliki dua pilihan: mengikuti kegiatan organisasi yang berguna untuk pengalaman, atau fokus penuh pada nilai akademik yang sedang menurun. Keputusan paling bijak adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(30, 1, 'Mahasiswa penerima KIP Kuliah ditawari pekerjaan sampingan dengan gaji besar namun jam kerja bentrok dengan jadwal kuliah wajib. Keputusan yang paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(31, 1, '\"Semua mahasiswa penerima beasiswa pasti berasal dari keluarga miskin, karena beasiswa hanya untuk yang tidak mampu.\" Kelemahan argumen ini adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(32, 1, '\"Nilai akademik adalah satu-satunya penentu kesuksesan seseorang.\" Argumen ini paling tepat dinilai sebagai...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(33, 1, 'Seorang teman berkata, \"Tidak perlu membaca petunjuk soal, langsung saja kerjakan.\" Bagaimana sikap kritis yang tepat terhadap saran ini?', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(34, 1, 'Seorang mahasiswa kesulitan memahami mata kuliah tertentu meski sudah belajar sendiri. Solusi paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(35, 1, 'Sinyal internet di rumah mahasiswa penerima KIP Kuliah sering terputus saat kuliah daring. Solusi paling realistis adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(36, 1, 'Mahasiswa memiliki jadwal kuliah yang padat dan tugas menumpuk. Strategi paling efektif adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(37, 1, 'Dalam sebuah pengumuman beasiswa tertulis: \"Berkas dikumpulkan paling lambat 10 Agustus pukul 16.00 WIB melalui portal resmi, tidak menerima berkas susulan.\" Informasi paling penting yang harus diperhatikan mahasiswa adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(38, 1, 'Sebuah soal ujian menyajikan banyak data, namun hanya sebagian yang relevan untuk menjawab pertanyaan. Sikap kritis yang tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(39, 1, 'Seorang mahasiswa memiliki keterbatasan biaya untuk membeli buku kuliah. Solusi paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(40, 1, 'Mahasiswa mendapati bahwa metode belajarnya selama ini tidak efektif meningkatkan pemahaman. Langkah paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(41, 1, 'Saat mengerjakan tugas kuliah, seorang mahasiswa menemukan sebuah artikel daring tanpa nama penulis dan tanpa sumber rujukan yang jelas. Sikap paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(42, 1, 'Ketika mencari referensi ilmiah untuk tugas akhir, sumber yang paling dapat dipercaya untuk dikutip adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(43, 1, 'Seorang mahasiswa menerima pesan berantai di grup WhatsApp berisi informasi kesehatan tanpa sumber jelas dan menggunakan bahasa provokatif. Tindakan paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(44, 1, 'Ciri informasi yang patut dicurigai sebagai hoaks adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(45, 1, 'Saat berdiskusi daring di forum kelas, seorang mahasiswa tidak setuju dengan pendapat temannya. Sikap yang mencerminkan etika digital yang baik adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(46, 1, 'Mengunggah foto atau video orang lain tanpa izin ke media sosial merupakan pelanggaran terhadap...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(47, 1, 'Untuk menjaga keamanan akun email dan portal akademik, tindakan yang paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(48, 1, 'Mahasiswa menerima email yang mengatasnamakan pihak kampus dan meminta mengklik tautan untuk \"verifikasi akun beasiswa\" secara mendesak. Tindakan paling tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(49, 1, 'Sebelum mengisi formulir daring yang meminta data pribadi seperti NIK dan nomor rekening, mahasiswa sebaiknya...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(50, 1, 'Membagikan data pribadi seperti NISN, alamat rumah, dan foto KTP secara terbuka di media sosial berisiko menyebabkan...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(51, 1, 'Ketika menggunakan chatbot AI untuk mencari referensi tugas, sikap kritis yang tepat adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(52, 1, 'Salah satu keterbatasan alat kecerdasan buatan (AI) dalam menjawab pertanyaan adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(53, 1, 'Seorang mahasiswa menggunakan AI untuk membantu menyusun kerangka tugas esai, kemudian ia mengembangkan dan menuliskan ulang gagasan tersebut dengan pemahamannya sendiri. Tindakan ini termasuk...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(54, 1, 'Menyalin seluruh jawaban dari AI dan mengumpulkannya sebagai tugas esai pribadi tanpa proses berpikir sendiri merupakan tindakan yang...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(55, 1, 'Mahasiswa hendak mengakses portal akademik menggunakan jaringan WiFi publik di tempat umum. Tindakan paling aman adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(56, 1, 'Tanda bahwa sebuah situs web cukup aman untuk memasukkan data pribadi antara lain...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(57, 1, 'Untuk mengelola tugas kuliah dengan banyak tenggat waktu, mahasiswa dapat memanfaatkan...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(58, 1, 'Saat mengerjakan tugas kelompok secara daring dengan anggota di lokasi berbeda, alat yang paling tepat digunakan adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(59, 1, 'Saat ujian daring tanpa pengawasan langsung, sikap yang mencerminkan integritas akademik adalah...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(60, 1, 'Menyalin sebagian besar tulisan orang lain dalam tugas tanpa mencantumkan sumber (plagiarisme) merupakan pelanggaran karena...', NULL, 1.66, '2026-08-10 05:06:54', '2026-08-10 05:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `option_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `option_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kapas : Benang', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(2, 1, 'Kayu : Meja', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(3, 1, 'Susu : Sapi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(4, 1, 'Kertas : Pohon', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(5, 2, 'Sekolah', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(6, 2, 'Murid', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(7, 2, 'Buku', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(8, 2, 'Kelas', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(9, 3, 'Ceroboh', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(10, 3, 'Arif', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(11, 3, 'Sombong', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(12, 3, 'Pemarah', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(13, 4, 'Boros', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(14, 4, 'Tepat guna', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(15, 4, 'Rumit', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(16, 4, 'Lambat', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(17, 5, 'Percaya diri', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(18, 5, 'Pesimis', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(19, 5, 'Realistis', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(20, 5, 'Antusias', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(21, 6, 'Stabil', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(22, 6, 'Berubah-ubah', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(23, 6, 'Tetap', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(24, 6, 'Teratur', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(25, 7, 'Belajar lama lebih baik daripada belajar sebentar', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(26, 7, 'Konsistensi belajar lebih efektif daripada belajar tidak teratur', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(27, 7, 'Otak manusia sulit menyimpan informasi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(28, 7, 'Belajar setiap hari membuang waktu', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(29, 8, 'Otak membutuhkan waktu memproses dan menyimpan informasi ke memori jangka panjang', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(30, 8, 'Belajar lama membuat otak lelah', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(31, 8, 'Guru menyarankan cara tersebut', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(32, 8, 'Belajar sebentar tidak membutuhkan usaha', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(33, 9, 'Andi tidak wajib menjaga IPK', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(34, 9, 'Andi wajib menjaga IPK minimal 3,00', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(35, 9, 'Andi memiliki IPK di bawah 3,00', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(36, 9, 'Andi bukan mahasiswa', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(37, 10, 'Hujan turun', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(38, 10, 'Hujan tidak turun', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(39, 10, 'Jalan akan basah', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(40, 10, 'Tidak dapat disimpulkan', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(41, 11, 'Rp1.000.000', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(42, 11, 'Rp800.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(43, 11, 'Rp1.200.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(44, 11, 'Rp1.500.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(45, 12, '14%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(46, 12, '16%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(47, 12, '20%', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(48, 12, '24%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(49, 13, '60 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(50, 13, '80 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(51, 13, '100 orang', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(52, 13, '120 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(53, 14, '100 ml', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(54, 14, '125 ml', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(55, 14, '150 ml', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(56, 14, '200 ml', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(57, 15, '40', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(58, 15, '42', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(59, 15, '44', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(60, 15, '36', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(61, 16, '30', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(62, 16, '31', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(63, 16, '33', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(64, 16, '35', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(65, 17, '6 hari', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(66, 17, '8 hari', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(67, 17, '9 hari', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(68, 17, '10 hari', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(69, 18, 'Rp95.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(70, 18, 'Rp100.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(71, 18, 'Rp105.000', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(72, 18, 'Rp110.000', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(73, 19, '20 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(74, 19, '26,7 orang', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(75, 19, '30 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(76, 19, '40 orang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(77, 20, '10,5%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(78, 20, '11,1%', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(79, 20, '12,5%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(80, 20, '15%', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(81, 21, 'Berhenti kuliah dan fokus bekerja', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(82, 21, 'Mengatur ulang jadwal dan berkonsultasi dengan dosen pembimbing akademik', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(83, 21, 'Membiarkan IPK turun karena keadaan ekonomi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(84, 21, 'Meminta teman mengerjakan tugasnya', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(85, 22, 'Diam saja agar tidak berkonflik', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(86, 22, 'Membicarakan masalah tersebut secara terbuka dengan anggota kelompok, dan ke dosen bila perlu', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(87, 22, 'Ikut tidak mengerjakan tugas sebagai balasan', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(88, 22, 'Melaporkan tanpa berdiskusi terlebih dahulu', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(89, 23, 'Nilai Ani meningkat', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(90, 23, 'Pemahaman materi Ani menjadi tertinggal', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(91, 23, 'Ani menjadi lebih disiplin', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(92, 23, 'Tidak ada dampak apa pun', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(93, 24, 'Penyebab masalah tersebut', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(94, 24, 'Solusi untuk mengurangi dampak masalah tersebut', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(95, 24, 'Akibat dari masalah tersebut', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(96, 24, 'Hal yang tidak berkaitan', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(97, 25, 'Berorganisasi pasti menyebabkan IPK tinggi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(98, 25, 'Ada kecenderungan hubungan antara keaktifan organisasi dan IPK, namun bukan berarti hubungan sebab-akibat mutlak', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(99, 25, 'Mahasiswa harus berhenti kuliah agar bisa berorganisasi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(100, 25, 'Organisasi tidak ada hubungannya dengan akademik', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(101, 26, 'Tepat, karena mayoritas menyatakan demikian', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(102, 26, 'Tidak tepat, karena data hanya menunjukkan preferensi, bukan bukti efektivitas belajar', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(103, 26, 'Tepat, karena survei adalah bukti ilmiah mutlak', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(104, 26, 'Tidak relevan untuk dibahas', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(105, 27, 'Kerajinan belajar selalu menjamin hasil terbaik', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(106, 27, 'Budi memiliki fasilitas belajar yang lengkap', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(107, 27, 'Nilai terbaik ditentukan oleh dosen', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(108, 27, 'Budi tidak pernah gagal sebelumnya', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(109, 28, 'Keluarga kurang mampu selalu memiliki anak yang pintar', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(110, 28, 'Kemampuan ekonomi tidak menentukan kemampuan akademik seseorang', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(111, 28, 'Semua mahasiswa KIP Kuliah pasti berprestasi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(112, 28, 'Pernyataan tersebut sudah benar dan tidak keliru', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(113, 29, 'Memilih salah satu secara ekstrem tanpa evaluasi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(114, 29, 'Mengevaluasi prioritas, memperbaiki nilai akademik lebih dulu, lalu mengatur waktu untuk organisasi secara terbatas', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(115, 29, 'Mengikuti organisasi penuh dan mengabaikan akademik', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(116, 29, 'Berhenti dari kedua kegiatan', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(117, 30, 'Menerima pekerjaan dan meninggalkan kelas', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(118, 30, 'Menolak, atau mencari kesepakatan jam kerja yang tidak mengganggu kewajiban akademik', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(119, 30, 'Meminta teman mengisi absensi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(120, 30, 'Mengabaikan kewajiban kuliah demi uang', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(121, 31, 'Argumen ini benar sepenuhnya', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(122, 31, 'Generalisasi berlebihan karena ada berbagai jenis beasiswa dengan syarat berbeda-beda', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(123, 31, 'Semua beasiswa memang khusus untuk keluarga miskin', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(124, 31, 'Argumen ini tidak dapat dievaluasi', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(125, 32, 'Benar karena nilai menentukan segalanya', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(126, 32, 'Kurang tepat, karena kesuksesan dipengaruhi banyak faktor selain nilai akademik', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(127, 32, 'Tidak relevan untuk dibahas', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(128, 32, 'Selalu terbukti secara ilmiah', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(129, 33, 'Langsung menerima saran tersebut', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(130, 33, 'Mengevaluasi risikonya dan tetap membaca petunjuk agar tidak salah memahami soal', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(131, 33, 'Mengikuti saran karena teman lebih berpengalaman', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(132, 33, 'Mengabaikan soal sepenuhnya', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(133, 34, 'Berhenti mengikuti mata kuliah tersebut', 0, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(134, 34, 'Mencari bantuan tambahan seperti bertanya ke dosen, kelompok belajar, atau tutor sebaya', 1, '2026-08-10 05:06:53', '2026-08-10 05:06:53'),
(135, 34, 'Menyalin jawaban teman saat ujian', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(136, 34, 'Mengabaikan mata kuliah tersebut hingga akhir semester', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(137, 35, 'Berhenti kuliah karena keterbatasan fasilitas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(138, 35, 'Mencari alternatif seperti fasilitas kampus, tempat dengan sinyal lebih baik, atau melapor ke pihak kampus', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(139, 35, 'Tidak mengikuti kelas tanpa memberi kabar', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(140, 35, 'Menyalahkan dosen atas gangguan sinyal', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(141, 36, 'Mengerjakan semua tugas secara acak tanpa prioritas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(142, 36, 'Membuat skala prioritas berdasarkan tenggat waktu dan tingkat kesulitan', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(143, 36, 'Menunda semua tugas hingga H-1', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(144, 36, 'Meminta perpanjangan waktu untuk semua tugas tanpa alasan jelas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(145, 37, 'Nama panitia seleksi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(146, 37, 'Batas waktu dan cara pengumpulan berkas', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(147, 37, 'Jumlah total pendaftar', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(148, 37, 'Sejarah program beasiswa', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(149, 38, 'Menggunakan semua data tanpa menyeleksi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(150, 38, 'Mengidentifikasi data yang relevan dengan pertanyaan sebelum menjawab', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(151, 38, 'Mengabaikan seluruh data yang diberikan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(152, 38, 'Menjawab tanpa membaca data', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(153, 39, 'Tidak mengikuti mata kuliah tersebut', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(154, 39, 'Memanfaatkan perpustakaan kampus, e-book resmi, atau meminjam dari senior', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(155, 39, 'Berutang tanpa mempertimbangkan kemampuan membayar', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(156, 39, 'Berhenti kuliah karena tidak mampu membeli buku', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(157, 40, 'Tetap menggunakan metode yang sama tanpa evaluasi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(158, 40, 'Mengevaluasi metode belajar dan mencoba pendekatan lain yang lebih sesuai', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(159, 40, 'Menyalahkan mata kuliah sebagai penyebabnya', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(160, 40, 'Berhenti belajar sama sekali', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(161, 41, 'Langsung mengutip karena informasinya menarik', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(162, 41, 'Memverifikasi informasi tersebut melalui sumber lain yang kredibel sebelum digunakan', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(163, 41, 'Menggunakan artikel tersebut sebagai satu-satunya sumber', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(164, 41, 'Mengabaikan tugas karena sulit mencari sumber', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(165, 42, 'Blog pribadi tanpa identitas jelas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(166, 42, 'Jurnal ilmiah terakreditasi atau situs resmi lembaga terpercaya', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(167, 42, 'Status media sosial teman', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(168, 42, 'Forum diskusi anonim', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(169, 43, 'Langsung menyebarkan ke grup lain agar semua tahu', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(170, 43, 'Memeriksa kebenaran informasi tersebut sebelum membagikannya', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(171, 43, 'Mempercayai begitu saja karena dikirim oleh teman', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(172, 43, 'Menghapus pesan tanpa memeriksa kebenarannya', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(173, 44, 'Berasal dari lembaga resmi dan memiliki data pendukung', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(174, 44, 'Menggunakan judul provokatif berlebihan, tanpa sumber jelas, dan meminta segera disebarkan', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(175, 44, 'Ditulis dengan bahasa yang netral dan berimbang', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(176, 44, 'Mencantumkan tanggal dan penulis yang jelas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(177, 45, 'Menyampaikan ketidaksetujuan dengan bahasa yang sopan dan disertai alasan', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(178, 45, 'Menyerang secara pribadi teman tersebut di kolom komentar', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(179, 45, 'Mengabaikan diskusi sepenuhnya', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(180, 45, 'Menyebarkan tangkapan layar percakapan untuk mempermalukan teman', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(181, 46, 'Etika digital dan hak privasi orang lain', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(182, 46, 'Kebebasan berekspresi yang sah', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(183, 46, 'Hal yang wajar dilakukan di era digital', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(184, 46, 'Ketentuan yang tidak perlu diperhatikan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(185, 47, 'Menggunakan kata sandi yang sama untuk semua akun agar mudah diingat', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(186, 47, 'Menggunakan kata sandi yang kuat dan berbeda untuk setiap akun serta mengaktifkan verifikasi dua langkah', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(187, 47, 'Membagikan kata sandi kepada teman dekat', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(188, 47, 'Menuliskan kata sandi di tempat umum agar tidak lupa', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(189, 48, 'Langsung mengklik tautan karena terlihat resmi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(190, 48, 'Memeriksa keaslian email dan menghubungi pihak kampus secara langsung sebelum mengklik apa pun', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(191, 48, 'Membalas email dengan data pribadi lengkap', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(192, 48, 'Meneruskan email ke seluruh teman kelas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(193, 49, 'Mengisi tanpa mempertimbangkan apa pun karena diminta oleh sistem', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(194, 49, 'Memastikan situs tersebut resmi dan terpercaya serta memahami tujuan penggunaan data', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(195, 49, 'Mengabaikan keamanan karena data pribadi tidak penting', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(196, 49, 'Membagikan data tersebut ke media sosial agar transparan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(197, 50, 'Meningkatkan popularitas akun', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(198, 50, 'Penyalahgunaan data oleh pihak yang tidak bertanggung jawab', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(199, 50, 'Tidak berdampak apa pun', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(200, 50, 'Mempercepat proses seleksi beasiswa', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(201, 51, 'Menerima seluruh jawaban AI sebagai kebenaran mutlak', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(202, 51, 'Memverifikasi kembali informasi yang diberikan AI dengan sumber terpercaya lain', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(203, 51, 'Menyalin seluruh jawaban tanpa membaca ulang', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(204, 51, 'Tidak perlu memeriksa karena AI selalu benar', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(205, 52, 'AI selalu memberikan informasi yang benar tanpa kesalahan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(206, 52, 'AI dapat menghasilkan informasi yang tidak akurat atau sudah ketinggalan zaman sehingga perlu diverifikasi', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(207, 52, 'AI tidak pernah membutuhkan data untuk bekerja', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(208, 52, 'AI dapat menggantikan seluruh proses berpikir manusia', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(209, 53, 'Pelanggaran akademik', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(210, 53, 'Pemanfaatan AI yang bertanggung jawab sebagai alat bantu belajar', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(211, 53, 'Kecurangan dalam ujian', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(212, 53, 'Tindakan yang dilarang tanpa terkecuali', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(213, 54, 'Dianjurkan karena lebih efisien', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(214, 54, 'Tidak etis karena tidak mencerminkan pemahaman dan usaha pribadi mahasiswa', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(215, 54, 'Diperbolehkan selama hasilnya bagus', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(216, 54, 'Tidak memiliki risiko akademik', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(217, 55, 'Langsung memasukkan kata sandi tanpa memeriksa keamanan jaringan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(218, 55, 'Menghindari mengakses data sensitif, atau menggunakan koneksi yang lebih aman seperti VPN saat memakai WiFi publik', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(219, 55, 'Membagikan hasil login ke teman yang menggunakan jaringan sama', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(220, 55, 'Mengabaikan risiko karena WiFi publik selalu aman', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(221, 56, 'Alamat situs menggunakan protokol https dan memiliki reputasi yang jelas', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(222, 56, 'Situs meminta data sebanyak mungkin tanpa alasan jelas', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(223, 56, 'Situs sering menampilkan iklan mencurigakan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(224, 56, 'Situs tidak memiliki kebijakan privasi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(225, 57, 'Membiarkan semua tugas diingat tanpa pencatatan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(226, 57, 'Aplikasi kalender atau manajemen tugas untuk mencatat dan mengingatkan tenggat waktu', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(227, 57, 'Menunda pencatatan hingga tugas terlupakan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(228, 57, 'Menghindari penggunaan teknologi sama sekali', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(229, 58, 'Aplikasi kolaborasi dokumen daring dan platform komunikasi yang disepakati bersama', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(230, 58, 'Mengerjakan sendiri tanpa berkoordinasi dengan anggota lain', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(231, 58, 'Mengandalkan komunikasi tatap muka meskipun berjauhan', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(232, 58, 'Tidak menggunakan alat bantu apa pun', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(233, 59, 'Mencari jawaban dari internet atau teman karena tidak diawasi', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(234, 59, 'Mengerjakan soal secara mandiri sesuai kemampuan sendiri meskipun tidak diawasi', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(235, 59, 'Bekerja sama dengan teman tanpa izin dosen', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(236, 59, 'Membuka banyak tab untuk mencari jawaban', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(237, 60, 'Tidak menghargai karya orang lain dan melanggar kejujuran akademik', 1, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(238, 60, 'Merupakan cara belajar yang efisien', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(239, 60, 'Tidak berdampak pada penilaian', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54'),
(240, 60, 'Dianggap wajar dalam dunia akademik', 0, '2026-08-10 05:06:54', '2026-08-10 05:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('45wAclBOOcWgMImzIsvsQ9ua2DsiHUM07fNlObxV', NULL, '10.112.143.133', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiI1ZTk2aGcyQ0Q2UE5yVVBVOEZlUmNPUXNwWHI1T2hKYW53QUo5UWJBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjExMi4xNDMuMTQ0OjgwMDBcL3N0dWRlbnRcL2V4YW0iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwicGFydGljaXBhbnRfaWQiOjQ0LCJleGFtX2lkIjoxLCJleGFtX3Nlc3Npb25faWQiOjIzfQ==', 1786339022),
('H41Y7Q80R2cK9lmp8nv3Lg0w02BSPKmbwAVDZV7D', NULL, '10.112.143.97', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJqdTN5bnAyYUtQUlBteHV3UmRpU1NOUjVxWEJvbmNyQXY0QXhlVzd2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjExMi4xNDMuMTQ0OjgwMDBcL3N0dWRlbnRcL2V4YW0iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwicGFydGljaXBhbnRfaWQiOjQ1LCJleGFtX2lkIjoxLCJleGFtX3Nlc3Npb25faWQiOjI0fQ==', 1786339021),
('qxfLAxMF7Qi5Vb3ocs4cUy9bHS2OPpmFByaE2DTQ', NULL, '10.112.143.6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJ3Sld5ak1WQmNrWTlldVE4Tk5hb0xveFZmOVExVU45aWtmVXZ3OHc1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjExMi4xNDMuMTQ0OjgwMDBcL3N0dWRlbnRcL2V4YW0iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwicGFydGljaXBhbnRfaWQiOjQzLCJleGFtX2lkIjoxLCJleGFtX3Nlc3Npb25faWQiOjIyfQ==', 1786338869),
('WDBErLTKVkcgJckZquKqEfIl4Vbi5NjUwWE63zkb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'eyJfdG9rZW4iOiJBd2c1bEtkQ3B4M1dUck83RHFRZFRaelBidERqdklBWkhLMVl4WHdMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImFkbWluX2lkIjoxLCJhZG1pbl9uYW1lIjoiUGFuaXRpYSBQTUIgQWRtaW5pc3RyYXRvciIsInBhcnRpY2lwYW50X2lkIjo0MiwiZXhhbV9pZCI6MSwiZXhhbV9zZXNzaW9uX2lkIjoyMX0=', 1786338712);

-- --------------------------------------------------------

--
-- Table structure for table `study_programs`
--

CREATE TABLE `study_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `study_programs`
--

INSERT INTO `study_programs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S1 Teknik Informatika', '2026-08-07 05:11:50', '2026-08-07 05:11:50'),
(2, 'S1 Sistem Informasi', '2026-08-07 05:11:50', '2026-08-07 05:11:50'),
(3, 'S1 Desain Komunikasi', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(4, 'S1 Akuntansi', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(5, 'S1 Manajemen', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(6, 'S1 Bisnis Digital', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(7, 'S1 Pendidikan Kepelatihan Olahraga', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(8, 'S1 Pendidikan Matematika', '2026-08-07 05:11:51', '2026-08-07 05:11:51'),
(9, 'D3 Manajemen Informatika', '2026-08-07 07:30:07', '2026-08-07 07:30:07'),
(10, 'D3 Manajemen Bisnis', '2026-08-07 07:30:07', '2026-08-07 07:30:07'),
(11, 'D3 Manajemen', '2026-08-07 07:30:07', '2026-08-07 07:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_study_program_id_foreign` (`study_program_id`);

--
-- Indexes for table `exam_activity_logs`
--
ALTER TABLE `exam_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_activity_logs_session_id_foreign` (`session_id`);

--
-- Indexes for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_sessions_participant_id_foreign` (`participant_id`),
  ADD KEY `exam_sessions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `participant_answers`
--
ALTER TABLE `participant_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_answers_session_id_foreign` (`session_id`),
  ADD KEY `participant_answers_question_id_foreign` (`question_id`),
  ADD KEY `participant_answers_option_id_foreign` (`option_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `study_programs`
--
ALTER TABLE `study_programs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_activity_logs`
--
ALTER TABLE `exam_activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `participant_answers`
--
ALTER TABLE `participant_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `study_programs`
--
ALTER TABLE `study_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `study_programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_activity_logs`
--
ALTER TABLE `exam_activity_logs`
  ADD CONSTRAINT `exam_activity_logs_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  ADD CONSTRAINT `exam_sessions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_sessions_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participant_answers`
--
ALTER TABLE `participant_answers`
  ADD CONSTRAINT `participant_answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participant_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participant_answers_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
