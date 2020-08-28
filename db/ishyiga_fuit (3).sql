-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 02:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ishyiga_fuit`
--

-- --------------------------------------------------------

--
-- Table structure for table `fluid_arrival`
--

CREATE TABLE `fluid_arrival` (
  `id` int(200) NOT NULL,
  `id_place2` int(200) NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_sector` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fluid_booking`
--

CREATE TABLE `fluid_booking` (
  `id` int(11) NOT NULL,
  `start_time` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_place0` int(255) NOT NULL,
  `id_placef` int(255) NOT NULL,
  `status_id` int(255) NOT NULL,
  `departments_id` int(255) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `driver_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_booking`
--

INSERT INTO `fluid_booking` (`id`, `start_time`, `end_time`, `id_user`, `id_place0`, `id_placef`, `status_id`, `departments_id`, `description`, `rank`, `created_at`, `updated_at`, `driver_id`) VALUES
(1232, '2020-08-19 10:00', '2020-08-19 12:00', 24, 1, 4, 1, 1, '0', 'done', '2020-08-19 09:03:49', '2020-08-19 00:00:00', 152),
(1233, '2020-08-19 12:00', '2020-08-19 14:00', 24, 1, 3, 1, 1, '0', 'done', '2020-08-19 10:44:57', '2020-08-19 00:00:00', 152),
(1234, '2020-08-19 16:00', '2020-08-19 18:00', 24, 1, 5, 1, 1, '0', 'done', '2020-08-19 10:47:59', '2020-08-19 00:00:00', 152),
(1235, '2020-08-20 14:00', '2020-08-20 16:00', 24, 1, 2, 3, 1, '0', 'confirmed', '2020-08-19 10:57:44', '2020-08-19 00:00:00', 152),
(1236, '2020-08-19 14:00', '2020-08-19 16:00', 24, 1, 5, 1, 1, '0', 'done', '2020-08-19 10:59:55', '2020-08-19 00:00:00', 152);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_booking_row`
--

CREATE TABLE `fluid_booking_row` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_place0` int(11) DEFAULT NULL,
  `id_placef` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_booking_row`
--

INSERT INTO `fluid_booking_row` (`id`, `id_booking`, `description`, `id_user`, `id_place0`, `id_placef`) VALUES
(1, 2, 'akazi', 0, NULL, NULL),
(2, 3, 'lift', 0, NULL, NULL),
(3, 1, 'lift', 0, NULL, NULL),
(4, 1, 'lift', 0, NULL, NULL),
(5, 3, 'lift', 0, NULL, NULL),
(6, 1, '$description', 0, NULL, NULL),
(7, 1, 'lift', 0, NULL, NULL),
(8, NULL, '$description', 0, NULL, NULL),
(9, 105, '0', 58, 111, 113),
(10, 105, '0', 56, 111, 180),
(11, 105, '0', 56, 111, 178),
(12, 254, '0', 56, 111, 180),
(13, 254, '0', 56, 111, 180),
(14, 0, '0', 1, 111, 180),
(15, 0, '0', 1, 111, 180),
(16, 0, '0', 1, 124, 180),
(17, 0, '0', 1, 111, 180),
(18, 0, '0', 56, 180, 111),
(19, 0, '0', 1, 111, 126),
(20, 261, '0', 22, 127, 112),
(21, 273, '0', 70, 177, 151),
(22, 275, '0', 70, 177, 151),
(23, 276, '0', 70, 177, 136),
(24, 283, '0', 4, 187, 184),
(25, 335, '0', 32, 102, 111),
(26, 342, '0', 21, 111, 195),
(27, 345, '0', 24, 211, 109),
(28, 346, '0', 1, 111, 126),
(29, 347, '0', 57, 101, 111),
(30, 348, '0', 82, 111, 188),
(31, 359, '0', 24, 211, 201),
(32, 379, '0', 1, 111, 126),
(33, 389, '0', 2, 111, 188),
(34, 398, '0', 24, 205, 111),
(35, 412, '0', 22, 4, 111),
(36, 413, '0', 82, 103, 111),
(37, 425, '0', 27, 135, 111),
(38, 474, '6', 84, 111, 226),
(39, 474, '0', 38, 111, 226),
(40, 474, '0', 26, 111, 226),
(41, 476, '0', 27, 1, 210),
(42, 489, '0', 27, 111, 124),
(43, 513, '0', 20, 111, 100),
(44, 536, '0', 20, 106, 238),
(45, 548, '0', 32, 115, 111),
(46, 595, '0', 82, 111, 217),
(47, 639, '0', 71, 259, 225),
(48, 837, '0', 90, 187, 187),
(49, 842, '0', 91, 259, 266),
(50, 847, '0', 91, 259, 266),
(51, 849, '0', 91, 266, 94),
(52, 854, '0', 91, 266, 94),
(53, 860, '0', 91, 266, 94),
(54, 867, '0', 90, 266, 94),
(55, 883, '0', 91, 294, 94),
(56, 888, '0', 91, 266, 94),
(57, 911, '0', 90, 294, 94),
(58, 912, '0', 91, 291, 94),
(59, 913, '0', 90, 266, 94),
(60, 941, '0', 90, 266, 94),
(61, 949, '0', 91, 294, 94),
(62, 951, '0', 91, 266, 94),
(63, 957, '0', 90, 266, 94),
(64, 962, '0', 91, 266, 94),
(65, 973, '0', 90, 266, 94),
(66, 978, '0', 90, 291, 94),
(67, 994, '0', 82, 111, 254),
(68, 995, '0', 90, 111, 266),
(69, 1162, '0', 20, 187, 206),
(70, 1171, '0', 131, 252, 93);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_book_date_lead`
--

CREATE TABLE `fluid_book_date_lead` (
  `id` int(11) NOT NULL,
  `start` varchar(50) DEFAULT NULL,
  `end` varchar(50) DEFAULT NULL,
  `duretion` int(11) DEFAULT NULL,
  `id_subcamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_book_date_lead`
--

INSERT INTO `fluid_book_date_lead` (`id`, `start`, `end`, `duretion`, `id_subcamp`) VALUES
(1, '08:00', '18:00', 120, 3);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_car`
--

CREATE TABLE `fluid_car` (
  `id` int(100) NOT NULL,
  `id_subcompany` int(100) DEFAULT NULL,
  `plaque` varchar(100) NOT NULL,
  `marque` varchar(100) NOT NULL,
  `insurance_date` date DEFAULT NULL,
  `control_technique_date` date DEFAULT NULL,
  `standard` text NOT NULL,
  `fuel_consumption` int(11) DEFAULT NULL COMMENT 'km/l',
  `id_driver` int(11) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_car`
--

INSERT INTO `fluid_car` (`id`, `id_subcompany`, `plaque`, `marque`, `insurance_date`, `control_technique_date`, `standard`, `fuel_consumption`, `id_driver`, `seats`) VALUES
(1, 3, 'RAC650V(NISSAN)', 'NISSAN MARCH', '2018-10-10', '2018-08-16', 'mechanical issue', 8, 0, 8),
(2, 3, 'RAD478P(AVANZA)', 'AVANZA', '2018-11-21', '2017-10-01', 'available', 9, 0, 8),
(3, 3, 'RAD672S(BMW325)', 'BMW325', '0000-00-00', '0000-00-00', 'available', 6, 0, 6),
(27, 3, 'RAE612M(TOYOTA)', 'toyota', '0000-00-00', '0000-00-00', 'available', 7, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_car_location`
--

CREATE TABLE `fluid_car_location` (
  `id` int(255) NOT NULL,
  `car_id` int(100) NOT NULL,
  `id_place` int(255) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(255) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_car_location`
--

INSERT INTO `fluid_car_location` (`id`, `car_id`, `id_place`, `comments`, `status_id`, `address`) VALUES
(1, 1, 126, 'irategereje  ummukozi', 3, ''),
(2, 2, 113, 'Fidele', 2, 'KN 34 Street,KN 34 St,Nyarugenge,Kigali,Kigali City,Rwanda,RW'),
(3, 3, 202, 'waiting', 3, ''),
(4, 19, 192, '', 0, NULL),
(5, 19, 137, 'hh', 1, NULL),
(6, 20, 137, 'hh', 1, NULL),
(7, 21, 192, 'hh', 1, NULL),
(8, 22, 138, 'hh', 1, NULL),
(9, 18, 192, 'hh', 1, NULL),
(10, 23, 141, 'hh', 1, NULL),
(11, 24, 192, 'hh', 1, NULL),
(12, 15, 136, 'HH', 1, NULL),
(13, 16, 156, 'HH', 1, NULL),
(14, 24, 136, 'HH', 1, NULL),
(15, 25, 142, 'HH', 1, NULL),
(16, 26, 137, 'HH', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_cell`
--

CREATE TABLE `fluid_cell` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_cell`
--

INSERT INTO `fluid_cell` (`id`, `province_id`, `district_id`, `sector_id`, `name`) VALUES
(1, 1, 1, 1, 'Akabahizi'),
(2, 1, 1, 1, 'Akabeza'),
(3, 1, 1, 1, 'Gacyamo'),
(4, 1, 1, 1, 'Kigarama'),
(5, 1, 1, 1, 'Kinyange'),
(6, 1, 1, 1, 'Kora'),
(7, 1, 1, 2, 'Nyamweru'),
(8, 1, 1, 2, 'Nzove'),
(9, 1, 1, 2, 'Taba'),
(10, 1, 1, 3, 'Kigali'),
(11, 1, 1, 3, 'Mwendo'),
(12, 1, 1, 3, 'Nyabugogo'),
(13, 1, 1, 3, 'Ruriba'),
(14, 1, 1, 3, 'Rwesero'),
(15, 1, 1, 4, 'Kamuhoza'),
(16, 1, 1, 4, 'Katabaro'),
(17, 1, 1, 4, 'Kimisagara'),
(18, 1, 1, 5, 'Kankuba'),
(19, 1, 1, 5, 'Kavumu'),
(20, 1, 1, 5, 'Mataba'),
(21, 1, 1, 5, 'Ntungamo'),
(22, 1, 1, 5, 'Nyarufunzo'),
(23, 1, 1, 5, 'Nyarurenzi'),
(24, 1, 1, 5, 'Runzenze'),
(25, 1, 1, 6, 'Amahoro'),
(26, 1, 1, 6, 'Kabasengerezi'),
(27, 1, 1, 6, 'Kabeza'),
(28, 1, 1, 6, 'Nyabugogo'),
(29, 1, 1, 6, 'Rugenge'),
(30, 1, 1, 6, 'Tetero'),
(31, 1, 1, 6, 'Ubumwe'),
(32, 1, 1, 7, 'Munanira I'),
(33, 1, 1, 7, 'Munanira Ii'),
(34, 1, 1, 7, 'Nyakabanda I'),
(35, 1, 1, 7, 'Nyakabanda Ii'),
(36, 1, 1, 8, 'Cyivugiza'),
(37, 1, 1, 8, 'Gasharu'),
(38, 1, 1, 8, 'Mumena'),
(39, 1, 1, 8, 'Rugarama'),
(40, 1, 1, 9, 'Agatare'),
(41, 1, 1, 9, 'Biryogo'),
(42, 1, 1, 9, 'Kiyovu'),
(43, 1, 1, 9, 'Rwampara'),
(44, 1, 1, 10, 'Kabuguru I'),
(45, 1, 1, 10, 'Kabuguru Ii'),
(46, 1, 1, 10, 'Rwezamenyo I'),
(47, 1, 1, 10, 'Rwezamenyo Ii'),
(48, 1, 2, 11, 'Kinyaga'),
(49, 1, 2, 11, 'Musave'),
(50, 1, 2, 11, 'Mvuzo'),
(51, 1, 2, 11, 'Ngara'),
(52, 1, 2, 11, 'Nkuzuzu'),
(53, 1, 2, 11, 'Nyabikenke'),
(54, 1, 2, 11, 'Nyagasozi'),
(55, 1, 2, 12, 'Karuruma'),
(56, 1, 2, 12, 'Nyamabuye'),
(57, 1, 2, 12, 'Nyamugari'),
(58, 1, 2, 13, 'Gasagara'),
(59, 1, 2, 13, 'Gicaca'),
(60, 1, 2, 13, 'Kibara'),
(61, 1, 2, 13, 'Munini'),
(62, 1, 2, 13, 'Murambi'),
(63, 1, 2, 14, 'Musezero'),
(64, 1, 2, 14, 'Ruhango'),
(65, 1, 2, 15, 'Akamatamu'),
(66, 1, 2, 15, 'Bweramvura'),
(67, 1, 2, 15, 'Kabuye'),
(68, 1, 2, 15, 'Kidashya'),
(69, 1, 2, 15, 'Ngiryi'),
(70, 1, 2, 16, 'Agateko'),
(71, 1, 2, 16, 'Buhiza'),
(72, 1, 2, 16, 'Muko'),
(73, 1, 2, 16, 'Nkusi'),
(74, 1, 2, 16, 'Nyabuliba'),
(75, 1, 2, 16, 'Nyakabungo'),
(76, 1, 2, 16, 'Nyamitanga'),
(77, 1, 2, 17, 'Kamatamu'),
(78, 1, 2, 17, 'Kamutwa'),
(79, 1, 2, 17, 'Kibaza'),
(80, 1, 2, 18, 'Kamukina'),
(81, 1, 2, 18, 'Kimihurura'),
(82, 1, 2, 18, 'Rugando'),
(83, 1, 2, 19, 'Bibare'),
(84, 1, 2, 19, 'Kibagabaga'),
(85, 1, 2, 19, 'Nyagatovu'),
(86, 1, 2, 20, 'Gacuriro'),
(87, 1, 2, 20, 'Gasharu'),
(88, 1, 2, 20, 'Kagugu'),
(89, 1, 2, 20, 'Murama'),
(90, 1, 2, 21, 'Bwiza'),
(91, 1, 2, 21, 'Cyaruzinge'),
(92, 1, 2, 21, 'Kibenga'),
(93, 1, 2, 21, 'Masoro'),
(94, 1, 2, 21, 'Mukuyu'),
(95, 1, 2, 21, 'Rudashya'),
(96, 1, 2, 22, 'Butare'),
(97, 1, 2, 22, 'Gasanze'),
(98, 1, 2, 22, 'Gasura'),
(99, 1, 2, 22, 'Gatunga'),
(100, 1, 2, 22, 'Muremure'),
(101, 1, 2, 22, 'Sha'),
(102, 1, 2, 22, 'Shango'),
(103, 1, 2, 23, 'Nyabisindu'),
(104, 1, 2, 23, 'Nyarutarama'),
(105, 1, 2, 23, 'Rukiri I'),
(106, 1, 2, 23, 'Rukiri Ii'),
(107, 1, 2, 24, 'Bisenga'),
(108, 1, 2, 24, 'Gasagara'),
(109, 1, 2, 24, 'Kabuga I'),
(110, 1, 2, 24, 'Kabuga Ii'),
(111, 1, 2, 24, 'Kinyana'),
(112, 1, 2, 24, 'Mbandazi'),
(113, 1, 2, 24, 'Nyagahinga'),
(114, 1, 2, 24, 'Ruhanga'),
(115, 1, 2, 25, 'Gasabo'),
(116, 1, 2, 25, 'Indatemwa'),
(117, 1, 2, 25, 'Kabaliza'),
(118, 1, 2, 25, 'Kacyatwa'),
(119, 1, 2, 25, 'Kibenga'),
(120, 1, 2, 25, 'Kigabiro'),
(121, 1, 3, 26, 'Gahanga'),
(122, 1, 3, 26, 'Kagasa'),
(123, 1, 3, 26, 'Karembure'),
(124, 1, 3, 26, 'Murinja'),
(125, 1, 3, 26, 'Nunga'),
(126, 1, 3, 26, 'Rwabutenge'),
(127, 1, 3, 27, 'Gatenga'),
(128, 1, 3, 27, 'Karambo'),
(129, 1, 3, 27, 'Nyanza'),
(130, 1, 3, 27, 'Nyarurama'),
(131, 1, 3, 28, 'Kagunga'),
(132, 1, 3, 28, 'Kanserege'),
(133, 1, 3, 28, 'Kinunga'),
(134, 1, 3, 29, 'Kanserege'),
(135, 1, 3, 29, 'Muyange'),
(136, 1, 3, 29, 'Rukatsa'),
(137, 1, 3, 30, 'Busanza'),
(138, 1, 3, 30, 'Kabeza'),
(139, 1, 3, 30, 'Karama'),
(140, 1, 3, 30, 'Rubirizi'),
(141, 1, 3, 31, 'Gasharu'),
(142, 1, 3, 31, 'Kagina'),
(143, 1, 3, 31, 'Kicukiro'),
(144, 1, 3, 31, 'Ngoma'),
(145, 1, 3, 32, 'Bwerankori'),
(146, 1, 3, 32, 'Karugira'),
(147, 1, 3, 32, 'Kigarama'),
(148, 1, 3, 32, 'Nyarurama'),
(149, 1, 3, 32, 'Rwampara'),
(150, 1, 3, 33, 'Ayabaraya'),
(151, 1, 3, 33, 'Cyimo'),
(152, 1, 3, 33, 'Gako'),
(153, 1, 3, 33, 'Gitaraga'),
(154, 1, 3, 33, 'Mbabe'),
(155, 1, 3, 33, 'Rusheshe'),
(156, 1, 3, 34, 'Gatare'),
(157, 1, 3, 34, 'Niboye'),
(158, 1, 3, 34, 'Nyakabanda'),
(159, 1, 3, 35, 'Kamashashi'),
(160, 1, 3, 35, 'Nonko'),
(161, 1, 3, 35, 'Rwimbogo'),
(162, 2, 4, 36, 'Gahondo'),
(163, 2, 4, 36, 'Kavumu'),
(164, 2, 4, 36, 'Kibinja'),
(165, 2, 4, 36, 'Nyanza'),
(166, 2, 4, 36, 'Rwesero'),
(167, 2, 4, 37, 'Gitovu'),
(168, 2, 4, 37, 'Kimirama'),
(169, 2, 4, 37, 'Masangano'),
(170, 2, 4, 37, 'Munyinya'),
(171, 2, 4, 37, 'Rukingiro'),
(172, 2, 4, 37, 'Shyira'),
(173, 2, 4, 38, 'Kadaho'),
(174, 2, 4, 38, 'Karama'),
(175, 2, 4, 38, 'Nyabinyenga'),
(176, 2, 4, 38, 'Nyarurama'),
(177, 2, 4, 38, 'Rubona'),
(178, 2, 4, 39, 'Cyeru'),
(179, 2, 4, 39, 'Mbuye'),
(180, 2, 4, 39, 'Mututu'),
(181, 2, 4, 39, 'Rwotso'),
(182, 2, 4, 40, 'Butansinda'),
(183, 2, 4, 40, 'Butara'),
(184, 2, 4, 40, 'Gahombo'),
(185, 2, 4, 40, 'Gasoro'),
(186, 2, 4, 40, 'Mulinja'),
(187, 2, 4, 41, 'Cyerezo'),
(188, 2, 4, 41, 'Gatagara'),
(189, 2, 4, 41, 'Kiruli'),
(190, 2, 4, 41, 'Mpanga'),
(191, 2, 4, 41, 'Ngwa'),
(192, 2, 4, 41, 'Nkomero'),
(193, 2, 4, 42, 'Gati'),
(194, 2, 4, 42, 'Migina'),
(195, 2, 4, 42, 'Nyamiyaga'),
(196, 2, 4, 42, 'Nyamure'),
(197, 2, 4, 42, 'Nyundo'),
(198, 2, 4, 43, 'Bugali'),
(199, 2, 4, 43, 'Cyotamakara'),
(200, 2, 4, 43, 'Kagunga'),
(201, 2, 4, 43, 'Katarara'),
(202, 2, 4, 44, 'Gahunga'),
(203, 2, 4, 44, 'Kabirizi'),
(204, 2, 4, 44, 'Kabuga'),
(205, 2, 4, 44, 'Kirambi'),
(206, 2, 4, 44, 'Rurangazi'),
(207, 2, 4, 45, 'Gacu'),
(208, 2, 4, 45, 'Gishike'),
(209, 2, 4, 45, 'Mubuga'),
(210, 2, 4, 45, 'Mushirarungu'),
(211, 2, 4, 45, 'Nyarusange'),
(212, 2, 4, 45, 'Runga'),
(213, 2, 5, 46, 'Cyiri'),
(214, 2, 5, 46, 'Gasagara'),
(215, 2, 5, 46, 'Gikonko'),
(216, 2, 5, 46, 'Mbogo'),
(217, 2, 5, 47, 'Gabiro'),
(218, 2, 5, 47, 'Nyabitare'),
(219, 2, 5, 47, 'Nyakibungo'),
(220, 2, 5, 47, 'Nyeranzi'),
(221, 2, 5, 48, 'Akaboti'),
(222, 2, 5, 48, 'Bwiza'),
(223, 2, 5, 48, 'Sabusaro'),
(224, 2, 5, 48, 'Umunini'),
(225, 2, 5, 49, 'Duwani'),
(226, 2, 5, 49, 'Kibirizi'),
(227, 2, 5, 49, 'Muyira'),
(228, 2, 5, 49, 'Ruturo'),
(229, 2, 5, 50, 'Agahabwa'),
(230, 2, 5, 50, 'Gatovu'),
(231, 2, 5, 50, 'Impinga'),
(232, 2, 5, 50, 'Nyabikenke'),
(233, 2, 5, 50, 'Rubona'),
(234, 2, 5, 50, 'Rusagara'),
(235, 2, 5, 51, 'Gakoma'),
(236, 2, 5, 51, 'Kabumbwe'),
(237, 2, 5, 51, 'Mamba'),
(238, 2, 5, 51, 'Muyaga'),
(239, 2, 5, 51, 'Ramba'),
(240, 2, 5, 52, 'Cyumba'),
(241, 2, 5, 52, 'Muganza'),
(242, 2, 5, 52, 'Remera'),
(243, 2, 5, 52, 'Rwamiko'),
(244, 2, 5, 52, 'Saga'),
(245, 2, 5, 53, 'Baziro'),
(246, 2, 5, 53, 'Kibayi'),
(247, 2, 5, 53, 'Kibu'),
(248, 2, 5, 53, 'Mugombwa'),
(249, 2, 5, 53, 'Mukomacara'),
(250, 2, 5, 54, 'Gitega'),
(251, 2, 5, 54, 'Mukiza'),
(252, 2, 5, 54, 'Nyabisagara'),
(253, 2, 5, 54, 'Runyinya'),
(254, 2, 5, 55, 'Bukinanyana'),
(255, 2, 5, 55, 'Gatovu'),
(256, 2, 5, 55, 'Kigarama'),
(257, 2, 5, 55, 'Kimana'),
(258, 2, 5, 56, 'Bweya'),
(259, 2, 5, 56, 'Cyamukuza'),
(260, 2, 5, 56, 'Dahwe'),
(261, 2, 5, 56, 'Gisagara'),
(262, 2, 5, 56, 'Mukande'),
(263, 2, 5, 57, 'Higiro'),
(264, 2, 5, 57, 'Nyamugari'),
(265, 2, 5, 57, 'Nyaruteja'),
(266, 2, 5, 57, 'Umubanga'),
(267, 2, 5, 58, 'Gatoki'),
(268, 2, 5, 58, 'Munazi'),
(269, 2, 5, 58, 'Rwanza'),
(270, 2, 5, 58, 'Shyanda'),
(271, 2, 5, 58, 'Zivu'),
(272, 2, 6, 59, 'Kirarangombe'),
(273, 2, 6, 59, 'Nkanda'),
(274, 2, 6, 59, 'Nteko'),
(275, 2, 6, 59, 'Runyombyi'),
(276, 2, 6, 59, 'Shororo'),
(277, 2, 6, 60, 'Coko'),
(278, 2, 6, 60, 'Cyahinda'),
(279, 2, 6, 60, 'Gasasa'),
(280, 2, 6, 60, 'Muhambara'),
(281, 2, 6, 60, 'Rutobwe'),
(282, 2, 6, 61, 'Gakoma'),
(283, 2, 6, 61, 'Kibeho'),
(284, 2, 6, 61, 'Mbasa'),
(285, 2, 6, 61, 'Mpanda'),
(286, 2, 6, 61, 'Mubuga'),
(287, 2, 6, 61, 'Nyange'),
(288, 2, 6, 62, 'Cyanyirankora'),
(289, 2, 6, 62, 'Gahurizo'),
(290, 2, 6, 62, 'Kimina'),
(291, 2, 6, 62, 'Kivu'),
(292, 2, 6, 62, 'Rugerero'),
(293, 2, 6, 63, 'Gorwe'),
(294, 2, 6, 63, 'Murambi'),
(295, 2, 6, 63, 'Nyamabuye'),
(296, 2, 6, 63, 'Ramba'),
(297, 2, 6, 63, 'Rwamiko'),
(298, 2, 6, 64, 'Muganza'),
(299, 2, 6, 64, 'Rukore'),
(300, 2, 6, 64, 'Samiyonga'),
(301, 2, 6, 64, 'Uwacyiza'),
(302, 2, 6, 65, 'Giheta'),
(303, 2, 6, 65, 'Ngarurira'),
(304, 2, 6, 65, 'Ngeri'),
(305, 2, 6, 65, 'Ntwali'),
(306, 2, 6, 65, 'Nyarure'),
(307, 2, 6, 66, 'Bitare'),
(308, 2, 6, 66, 'Mukuge'),
(309, 2, 6, 66, 'Murama'),
(310, 2, 6, 66, 'Nyamirama'),
(311, 2, 6, 66, 'Nyanza'),
(312, 2, 6, 66, 'Yaramba'),
(313, 2, 6, 67, 'Fugi'),
(314, 2, 6, 67, 'Kibangu'),
(315, 2, 6, 67, 'Kiyonza'),
(316, 2, 6, 67, 'Mbuye'),
(317, 2, 6, 67, 'Nyamirama'),
(318, 2, 6, 67, 'Rubona'),
(319, 2, 6, 68, 'Gihemvu'),
(320, 2, 6, 68, 'Kabere'),
(321, 2, 6, 68, 'Mishungero'),
(322, 2, 6, 68, 'Nyabimata'),
(323, 2, 6, 68, 'Ruhinga'),
(324, 2, 6, 69, 'Maraba'),
(325, 2, 6, 69, 'Mwoya'),
(326, 2, 6, 69, 'Nkakwa'),
(327, 2, 6, 69, 'Nyagisozi'),
(328, 2, 6, 70, 'Gitita'),
(329, 2, 6, 70, 'Kabere'),
(330, 2, 6, 70, 'Remera'),
(331, 2, 6, 70, 'Ruyenzi'),
(332, 2, 6, 70, 'Uwumusebeya'),
(333, 2, 6, 71, 'Gabiro'),
(334, 2, 6, 71, 'Giseke'),
(335, 2, 6, 71, 'Nyarugano'),
(336, 2, 6, 71, 'Rugogwe'),
(337, 2, 6, 71, 'Ruramba'),
(338, 2, 6, 72, 'Bunge'),
(339, 2, 6, 72, 'Cyuna'),
(340, 2, 6, 72, 'Gikunzi'),
(341, 2, 6, 72, 'Mariba'),
(342, 2, 6, 72, 'Raranzige'),
(343, 2, 6, 72, 'Rusenge'),
(344, 2, 7, 73, 'Nyakibanda'),
(345, 2, 7, 73, 'Nyumba'),
(346, 2, 7, 73, 'Shori'),
(347, 2, 7, 74, 'Muyogoro'),
(348, 2, 7, 74, 'Nyakagezi'),
(349, 2, 7, 74, 'Rukira'),
(350, 2, 7, 74, 'Sovu'),
(351, 2, 7, 75, 'Buhoro'),
(352, 2, 7, 75, 'Bunazi'),
(353, 2, 7, 75, 'Gahororo'),
(354, 2, 7, 75, 'Kibingo'),
(355, 2, 7, 75, 'Muhembe'),
(356, 2, 7, 76, 'Gishihe'),
(357, 2, 7, 76, 'Kabatwa'),
(358, 2, 7, 76, 'Kabuga'),
(359, 2, 7, 76, 'Karambi'),
(360, 2, 7, 76, 'Musebeya'),
(361, 2, 7, 76, 'Nyabisindu'),
(362, 2, 7, 76, 'Rugarama'),
(363, 2, 7, 76, 'Shanga'),
(364, 2, 7, 77, 'Byinza'),
(365, 2, 7, 77, 'Gahana'),
(366, 2, 7, 77, 'Gitovu'),
(367, 2, 7, 77, 'Kabona'),
(368, 2, 7, 77, 'Sazange'),
(369, 2, 7, 78, 'Buremera'),
(370, 2, 7, 78, 'Gasumba'),
(371, 2, 7, 78, 'Kabuye'),
(372, 2, 7, 78, 'Kanyinya'),
(373, 2, 7, 78, 'Shanga'),
(374, 2, 7, 78, 'Shyembe'),
(375, 2, 7, 79, 'Gatobotobo'),
(376, 2, 7, 79, 'Kabuga'),
(377, 2, 7, 79, 'Mutunda'),
(378, 2, 7, 79, 'Mwulire'),
(379, 2, 7, 79, 'Rugango'),
(380, 2, 7, 79, 'Rusagara'),
(381, 2, 7, 79, 'Tare'),
(382, 2, 7, 80, 'Bukomeye'),
(383, 2, 7, 80, 'Buvumu'),
(384, 2, 7, 80, 'Icyeru'),
(385, 2, 7, 80, 'Rango A'),
(386, 2, 7, 81, 'Butare'),
(387, 2, 7, 81, 'Kaburemera'),
(388, 2, 7, 81, 'Matyazo'),
(389, 2, 7, 81, 'Ngoma'),
(390, 2, 7, 82, 'Busheshi'),
(391, 2, 7, 82, 'Gatovu'),
(392, 2, 7, 82, 'Karama'),
(393, 2, 7, 82, 'Mara'),
(394, 2, 7, 82, 'Muhororo'),
(395, 2, 7, 82, 'Rugogwe'),
(396, 2, 7, 82, 'Ruhashya'),
(397, 2, 7, 83, 'Buhimba'),
(398, 2, 7, 83, 'Gafumba'),
(399, 2, 7, 83, 'Kimirehe'),
(400, 2, 7, 83, 'Kimuna'),
(401, 2, 7, 83, 'Kiruhura'),
(402, 2, 7, 83, 'Mugogwe'),
(403, 2, 7, 84, 'Gatwaro'),
(404, 2, 7, 84, 'Kamwambi'),
(405, 2, 7, 84, 'Kibiraro'),
(406, 2, 7, 84, 'Mwendo'),
(407, 2, 7, 84, 'Nyamabuye'),
(408, 2, 7, 84, 'Nyaruhombo'),
(409, 2, 7, 84, 'Shyunga'),
(410, 2, 7, 85, 'Cyendajuru'),
(411, 2, 7, 85, 'Gisakura'),
(412, 2, 7, 85, 'Kabusanza'),
(413, 2, 7, 85, 'Mugobore'),
(414, 2, 7, 85, 'Nyangazi'),
(415, 2, 7, 86, 'Cyarwa'),
(416, 2, 7, 86, 'Cyimana'),
(417, 2, 7, 86, 'Gitwa'),
(418, 2, 7, 86, 'Mpare'),
(419, 2, 7, 86, 'Rango B'),
(420, 2, 8, 87, 'Bushigishigi'),
(421, 2, 8, 87, 'Byimana'),
(422, 2, 8, 87, 'Gifurwe'),
(423, 2, 8, 87, 'Kizimyamuriro'),
(424, 2, 8, 87, 'Munini'),
(425, 2, 8, 87, 'Rambya'),
(426, 2, 8, 88, 'Gitega'),
(427, 2, 8, 88, 'Karama'),
(428, 2, 8, 88, 'Kiyumba'),
(429, 2, 8, 88, 'Ngoma'),
(430, 2, 8, 88, 'Nyanza'),
(431, 2, 8, 88, 'Nyanzoga'),
(432, 2, 8, 89, 'Kigeme'),
(433, 2, 8, 89, 'Ngiryi'),
(434, 2, 8, 89, 'Nyabivumu'),
(435, 2, 8, 89, 'Nyamugari'),
(436, 2, 8, 89, 'Nzega'),
(437, 2, 8, 89, 'Remera'),
(438, 2, 8, 90, 'Bakopfu'),
(439, 2, 8, 90, 'Gatare'),
(440, 2, 8, 90, 'Mukongoro'),
(441, 2, 8, 90, 'Ruganda'),
(442, 2, 8, 90, 'Shyeru'),
(443, 2, 8, 91, 'Kavumu'),
(444, 2, 8, 91, 'Murambi'),
(445, 2, 8, 91, 'Musenyi'),
(446, 2, 8, 91, 'Nyabisindu'),
(447, 2, 8, 91, 'Nyamiyaga'),
(448, 2, 8, 92, 'Bwama'),
(449, 2, 8, 92, 'Kamegeri'),
(450, 2, 8, 92, 'Kirehe'),
(451, 2, 8, 92, 'Kizi'),
(452, 2, 8, 92, 'Nyarusiza'),
(453, 2, 8, 92, 'Rususa'),
(454, 2, 8, 93, 'Bugarama'),
(455, 2, 8, 93, 'Bugarura'),
(456, 2, 8, 93, 'Gashiha'),
(457, 2, 8, 93, 'Karambo'),
(458, 2, 8, 93, 'Ruhunga'),
(459, 2, 8, 93, 'Uwindekezi'),
(460, 2, 8, 94, 'Bwenda'),
(461, 2, 8, 94, 'Gakanka'),
(462, 2, 8, 94, 'Kibibi'),
(463, 2, 8, 94, 'Nyakiza'),
(464, 2, 8, 95, 'Kagano'),
(465, 2, 8, 95, 'Mujuga'),
(466, 2, 8, 95, 'Mukungu'),
(467, 2, 8, 95, 'Shaba'),
(468, 2, 8, 95, 'Uwingugu'),
(469, 2, 8, 96, 'Manwari'),
(470, 2, 8, 96, 'Mutiwingoma'),
(471, 2, 8, 96, 'Ngambi'),
(472, 2, 8, 96, 'Ngara'),
(473, 2, 8, 97, 'Gitondorero'),
(474, 2, 8, 97, 'Gitwa'),
(475, 2, 8, 97, 'Ruhinga'),
(476, 2, 8, 97, 'Sovu'),
(477, 2, 8, 97, 'Suti'),
(478, 2, 8, 97, 'Yonde'),
(479, 2, 8, 98, 'Gasave'),
(480, 2, 8, 98, 'Jenda'),
(481, 2, 8, 98, 'Masagara'),
(482, 2, 8, 98, 'Masangano'),
(483, 2, 8, 98, 'Masizi'),
(484, 2, 8, 98, 'Nyagisozi'),
(485, 2, 8, 99, 'Gatovu'),
(486, 2, 8, 99, 'Nyarurambi'),
(487, 2, 8, 99, 'Rugano'),
(488, 2, 8, 99, 'Runege'),
(489, 2, 8, 99, 'Rusekera'),
(490, 2, 8, 99, 'Sekera'),
(491, 2, 8, 100, 'Buteteri'),
(492, 2, 8, 100, 'Cyobe'),
(493, 2, 8, 100, 'Gashwati'),
(494, 2, 8, 101, 'Bitandara'),
(495, 2, 8, 101, 'Musaraba'),
(496, 2, 8, 101, 'Mutengeri'),
(497, 2, 8, 101, 'Nkomane'),
(498, 2, 8, 101, 'Nyarwungo'),
(499, 2, 8, 101, 'Twiya'),
(500, 2, 8, 102, 'Buhoro'),
(501, 2, 8, 102, 'Gasarenda'),
(502, 2, 8, 102, 'Gatovu'),
(503, 2, 8, 102, 'Kaganza'),
(504, 2, 8, 102, 'Nkumbure'),
(505, 2, 8, 102, 'Nyamigina'),
(506, 2, 8, 103, 'Bigumira'),
(507, 2, 8, 103, 'Gahira'),
(508, 2, 8, 103, 'Kibyagira'),
(509, 2, 8, 103, 'Mudasomwa'),
(510, 2, 8, 103, 'Munyege'),
(511, 2, 8, 103, 'Rugogwe'),
(512, 2, 9, 104, 'Buhanda'),
(513, 2, 9, 104, 'Gitisi'),
(514, 2, 9, 104, 'Murama'),
(515, 2, 9, 104, 'Rubona'),
(516, 2, 9, 104, 'Rwinyana'),
(517, 2, 9, 105, 'Kamusenyi'),
(518, 2, 9, 105, 'Kirengeri'),
(519, 2, 9, 105, 'Mahembe'),
(520, 2, 9, 105, 'Mpanda'),
(521, 2, 9, 105, 'Muhororo'),
(522, 2, 9, 105, 'Ntenyo'),
(523, 2, 9, 105, 'Nyakabuye'),
(524, 2, 9, 106, 'Bihembe'),
(525, 2, 9, 106, 'Karambi'),
(526, 2, 9, 106, 'Munanira'),
(527, 2, 9, 106, 'Remera'),
(528, 2, 9, 106, 'Rwesero'),
(529, 2, 9, 106, 'Rwoga'),
(530, 2, 9, 107, 'Burima'),
(531, 2, 9, 107, 'Gisali'),
(532, 2, 9, 107, 'Kinazi'),
(533, 2, 9, 107, 'Rubona'),
(534, 2, 9, 107, 'Rutabo'),
(535, 2, 9, 108, 'Bweramvura'),
(536, 2, 9, 108, 'Gitinda'),
(537, 2, 9, 108, 'Kirwa'),
(538, 2, 9, 108, 'Muyunzwe'),
(539, 2, 9, 108, 'Nyakogo'),
(540, 2, 9, 108, 'Rukina'),
(541, 2, 9, 109, 'Cyanza'),
(542, 2, 9, 109, 'Gisanga'),
(543, 2, 9, 109, 'Kabuga'),
(544, 2, 9, 109, 'Kizibere'),
(545, 2, 9, 109, 'Mbuye'),
(546, 2, 9, 109, 'Mwendo'),
(547, 2, 9, 109, 'Nyakarekare'),
(548, 2, 9, 110, 'Gafunzo'),
(549, 2, 9, 110, 'Gishweru'),
(550, 2, 9, 110, 'Kamujisho'),
(551, 2, 9, 110, 'Kigarama'),
(552, 2, 9, 110, 'Kubutare'),
(553, 2, 9, 110, 'Mutara'),
(554, 2, 9, 110, 'Nyabibugu'),
(555, 2, 9, 110, 'Saruheshyi'),
(556, 2, 9, 111, 'Gako'),
(557, 2, 9, 111, 'Kareba'),
(558, 2, 9, 111, 'Kayenzi'),
(559, 2, 9, 111, 'Kebero'),
(560, 2, 9, 111, 'Nyagisozi'),
(561, 2, 9, 111, 'Nyakabungo'),
(562, 2, 9, 111, 'Nyarurama'),
(563, 2, 9, 112, 'Buhoro'),
(564, 2, 9, 112, 'Bunyogombe'),
(565, 2, 9, 112, 'Gikoma'),
(566, 2, 9, 112, 'Munini'),
(567, 2, 9, 112, 'Musamo'),
(568, 2, 9, 112, 'Nyamagana'),
(569, 2, 9, 112, 'Rwoga'),
(570, 2, 9, 112, 'Tambwe'),
(571, 2, 10, 113, 'Biringaga'),
(572, 2, 10, 113, 'Kigarama'),
(573, 2, 10, 113, 'Kivumu'),
(574, 2, 10, 113, 'Makera'),
(575, 2, 10, 113, 'Nyarunyinya'),
(576, 2, 10, 113, 'Shori'),
(577, 2, 10, 114, 'Buramba'),
(578, 2, 10, 114, 'Butare'),
(579, 2, 10, 114, 'Kabuye'),
(580, 2, 10, 114, 'Kavumu'),
(581, 2, 10, 114, 'Kibyimba'),
(582, 2, 10, 114, 'Ngarama'),
(583, 2, 10, 114, 'Ngoma'),
(584, 2, 10, 114, 'Sholi'),
(585, 2, 10, 115, 'Gisharu'),
(586, 2, 10, 115, 'Gitega'),
(587, 2, 10, 115, 'Jurwe'),
(588, 2, 10, 115, 'Mubuga'),
(589, 2, 10, 115, 'Rubyiniro'),
(590, 2, 10, 115, 'Ryakanimba'),
(591, 2, 10, 116, 'Budende'),
(592, 2, 10, 116, 'Ndago'),
(593, 2, 10, 116, 'Remera'),
(594, 2, 10, 116, 'Ruhina'),
(595, 2, 10, 116, 'Rukeri'),
(596, 2, 10, 117, 'Kanyinya'),
(597, 2, 10, 117, 'Nganzo'),
(598, 2, 10, 117, 'Nyamirama'),
(599, 2, 10, 117, 'Remera'),
(600, 2, 10, 117, 'Tyazo'),
(601, 2, 10, 118, 'Matyazo'),
(602, 2, 10, 118, 'Munazi'),
(603, 2, 10, 118, 'Nyagasozi'),
(604, 2, 10, 118, 'Rukaragata'),
(605, 2, 10, 118, 'Rwasare'),
(606, 2, 10, 118, 'Rwigerero'),
(607, 2, 10, 119, 'Gashorera'),
(608, 2, 10, 119, 'Masangano'),
(609, 2, 10, 119, 'Mbuga'),
(610, 2, 10, 119, 'Muvumba'),
(611, 2, 10, 119, 'Nyarusozi'),
(612, 2, 10, 120, 'Gahogo'),
(613, 2, 10, 120, 'Gifumba'),
(614, 2, 10, 120, 'Gitarama'),
(615, 2, 10, 120, 'Remera'),
(616, 2, 10, 121, 'Mbiriri'),
(617, 2, 10, 121, 'Musongati'),
(618, 2, 10, 121, 'Ngaru'),
(619, 2, 10, 121, 'Rusovu'),
(620, 2, 10, 122, 'Gasagara'),
(621, 2, 10, 122, 'Gasharu'),
(622, 2, 10, 122, 'Karambo'),
(623, 2, 10, 122, 'Nyamirambo'),
(624, 2, 10, 122, 'Ruhango'),
(625, 2, 10, 123, 'Gasave'),
(626, 2, 10, 123, 'Kanyana'),
(627, 2, 10, 123, 'Kibaga'),
(628, 2, 10, 123, 'Mpinga'),
(629, 2, 10, 123, 'Nsanga'),
(630, 2, 10, 124, 'Kinini'),
(631, 2, 10, 124, 'Mbare'),
(632, 2, 10, 124, 'Mubuga'),
(633, 2, 10, 124, 'Ruli'),
(634, 2, 11, 125, 'Gihinga'),
(635, 2, 11, 125, 'Gihira'),
(636, 2, 11, 125, 'Kigembe'),
(637, 2, 11, 125, 'Nkingo'),
(638, 2, 11, 126, 'Bitare'),
(639, 2, 11, 126, 'Bunyonga'),
(640, 2, 11, 126, 'Muganza'),
(641, 2, 11, 126, 'Nyamirembe'),
(642, 2, 11, 127, 'Bugarama'),
(643, 2, 11, 127, 'Cubi'),
(644, 2, 11, 127, 'Kayonza'),
(645, 2, 11, 127, 'Kirwa'),
(646, 2, 11, 127, 'Mataba'),
(647, 2, 11, 127, 'Nyamirama'),
(648, 2, 11, 128, 'Busoro'),
(649, 2, 11, 128, 'Gaseke'),
(650, 2, 11, 128, 'Giko'),
(651, 2, 11, 128, 'Muyange'),
(652, 2, 11, 129, 'Jenda'),
(653, 2, 11, 129, 'Kabugondo'),
(654, 2, 11, 129, 'Mbati'),
(655, 2, 11, 129, 'Mugina'),
(656, 2, 11, 129, 'Nteko'),
(657, 2, 11, 130, 'Buhoro'),
(658, 2, 11, 130, 'Cyambwe'),
(659, 2, 11, 130, 'Karengera'),
(660, 2, 11, 130, 'Kivumu'),
(661, 2, 11, 130, 'Mpushi'),
(662, 2, 11, 130, 'Rukambura'),
(663, 2, 11, 131, 'Kabuga'),
(664, 2, 11, 131, 'Kazirabonde'),
(665, 2, 11, 131, 'Marembo'),
(666, 2, 11, 132, 'Bibungo'),
(667, 2, 11, 132, 'Kabashumba'),
(668, 2, 11, 132, 'Kidahwe'),
(669, 2, 11, 132, 'Mukinga'),
(670, 2, 11, 132, 'Ngoma'),
(671, 2, 11, 133, 'Gitare'),
(672, 2, 11, 133, 'Kambyeyi'),
(673, 2, 11, 133, 'Kigusa'),
(674, 2, 11, 133, 'Nyagishubi'),
(675, 2, 11, 133, 'Ruyanza'),
(676, 2, 11, 134, 'Bihembe'),
(677, 2, 11, 134, 'Kigese'),
(678, 2, 11, 134, 'Masaka'),
(679, 2, 11, 134, 'Nyarubuye'),
(680, 2, 11, 134, 'Sheli'),
(681, 2, 11, 135, 'Bugoba'),
(682, 2, 11, 135, 'Buguri'),
(683, 2, 11, 135, 'Gishyeshye'),
(684, 2, 11, 135, 'Murehe'),
(685, 2, 11, 135, 'Mwirute'),
(686, 2, 11, 135, 'Remera'),
(687, 2, 11, 135, 'Taba'),
(688, 2, 11, 136, 'Gihara'),
(689, 2, 11, 136, 'Kabagesera'),
(690, 2, 11, 136, 'Kagina'),
(691, 2, 11, 136, 'Muganza'),
(692, 2, 11, 136, 'Ruyenzi'),
(693, 3, 12, 137, 'Burunga'),
(694, 3, 12, 137, 'Gasura'),
(695, 3, 12, 137, 'Gitarama'),
(696, 3, 12, 137, 'Kayenzi'),
(697, 3, 12, 137, 'Kibuye'),
(698, 3, 12, 137, 'Kiniha'),
(699, 3, 12, 137, 'Nyarusazi'),
(700, 3, 12, 138, 'Birambo'),
(701, 3, 12, 138, 'Musasa'),
(702, 3, 12, 138, 'Mwendo'),
(703, 3, 12, 138, 'Rugobagoba'),
(704, 3, 12, 138, 'Tongati'),
(705, 3, 12, 139, 'Buhoro'),
(706, 3, 12, 139, 'Cyanya'),
(707, 3, 12, 139, 'Kigarama'),
(708, 3, 12, 139, 'Munanira'),
(709, 3, 12, 139, 'Musasa'),
(710, 3, 12, 139, 'Ngoma'),
(711, 3, 12, 140, 'Gasharu'),
(712, 3, 12, 140, 'Gitega'),
(713, 3, 12, 140, 'Kanunga'),
(714, 3, 12, 140, 'Kirambo'),
(715, 3, 12, 140, 'Munanira'),
(716, 3, 12, 140, 'Nyamiringa'),
(717, 3, 12, 140, 'Ruhinga'),
(718, 3, 12, 140, 'Rwariro'),
(719, 3, 12, 141, 'Kagabiro'),
(720, 3, 12, 141, 'Murangara'),
(721, 3, 12, 141, 'Nyagatovu'),
(722, 3, 12, 141, 'Ryaruhanga'),
(723, 3, 12, 142, 'Mubuga'),
(724, 3, 12, 142, 'Muhororo'),
(725, 3, 12, 142, 'Nkoto'),
(726, 3, 12, 142, 'Nyarunyinya'),
(727, 3, 12, 142, 'Shyembe'),
(728, 3, 12, 143, 'Bukiro'),
(729, 3, 12, 143, 'Kabaya'),
(730, 3, 12, 143, 'Kamina'),
(731, 3, 12, 143, 'Kareba'),
(732, 3, 12, 143, 'Nyamushishi'),
(733, 3, 12, 143, 'Nzaratsi'),
(734, 3, 12, 144, 'Byogo'),
(735, 3, 12, 144, 'Gasharu'),
(736, 3, 12, 144, 'Gisayura'),
(737, 3, 12, 144, 'Kanyege'),
(738, 3, 12, 144, 'Kinyonzwe'),
(739, 3, 12, 144, 'Murengezo'),
(740, 3, 12, 144, 'Rwufi'),
(741, 3, 12, 145, 'Bubazi'),
(742, 3, 12, 145, 'Gacaca'),
(743, 3, 12, 145, 'Gisanze'),
(744, 3, 12, 145, 'Gitwa'),
(745, 3, 12, 145, 'Kibirizi'),
(746, 3, 12, 145, 'Mataba'),
(747, 3, 12, 145, 'Nyarugenge'),
(748, 3, 12, 145, 'Ruragwe'),
(749, 3, 12, 146, 'Gisiza'),
(750, 3, 12, 146, 'Gitega'),
(751, 3, 12, 146, 'Gitovu'),
(752, 3, 12, 146, 'Kabuga'),
(753, 3, 12, 146, 'Mubuga'),
(754, 3, 12, 146, 'Mucyimba'),
(755, 3, 12, 146, 'Rufungo'),
(756, 3, 12, 146, 'Rwungo'),
(757, 3, 12, 146, 'Tyazo'),
(758, 3, 12, 147, 'Biguhu'),
(759, 3, 12, 147, 'Kabingo'),
(760, 3, 12, 147, 'Kinyovu'),
(761, 3, 12, 147, 'Kivumu'),
(762, 3, 12, 147, 'Nyabikeri'),
(763, 3, 12, 147, 'Nyamugwagwa'),
(764, 3, 12, 147, 'Rubona'),
(765, 3, 12, 147, 'Rugobagoba'),
(766, 3, 12, 148, 'Bigugu'),
(767, 3, 12, 148, 'Bisesero'),
(768, 3, 12, 148, 'Gasata'),
(769, 3, 12, 148, 'Munini'),
(770, 3, 12, 148, 'Nyakamira'),
(771, 3, 12, 148, 'Nyarusanga'),
(772, 3, 12, 148, 'Rubazo'),
(773, 3, 12, 148, 'Rubumba'),
(774, 3, 12, 149, 'Bihumbe'),
(775, 3, 12, 149, 'Gakuta'),
(776, 3, 12, 149, 'Gisovu'),
(777, 3, 12, 149, 'Gitabura'),
(778, 3, 12, 149, 'Kavumu'),
(779, 3, 12, 149, 'Murehe'),
(780, 3, 12, 149, 'Rutabi'),
(781, 3, 13, 150, 'Bushaka'),
(782, 3, 13, 150, 'Kabihogo'),
(783, 3, 13, 150, 'Nkira'),
(784, 3, 13, 150, 'Remera'),
(785, 3, 13, 151, 'Bugina'),
(786, 3, 13, 151, 'Congo-nil'),
(787, 3, 13, 151, 'Mataba'),
(788, 3, 13, 151, 'Murambi'),
(789, 3, 13, 151, 'Ruhingo'),
(790, 3, 13, 151, 'Shyembe'),
(791, 3, 13, 151, 'Teba'),
(792, 3, 13, 152, 'Buhindure'),
(793, 3, 13, 152, 'Nkora'),
(794, 3, 13, 152, 'Nyagahinika'),
(795, 3, 13, 152, 'Rukaragata'),
(796, 3, 13, 153, 'Bunyoni'),
(797, 3, 13, 153, 'Bunyunju'),
(798, 3, 13, 153, 'Kabere'),
(799, 3, 13, 153, 'Kabujenje'),
(800, 3, 13, 153, 'Karambi'),
(801, 3, 13, 153, 'Nganzo'),
(802, 3, 13, 154, 'Haniro'),
(803, 3, 13, 154, 'Muyira'),
(804, 3, 13, 154, 'Tangabo'),
(805, 3, 13, 155, 'Kabuga'),
(806, 3, 13, 155, 'Kagano'),
(807, 3, 13, 155, 'Kageyo'),
(808, 3, 13, 155, 'Kagusa'),
(809, 3, 13, 155, 'Karambo'),
(810, 3, 13, 155, 'Mwendo'),
(811, 3, 13, 156, 'Kirwa'),
(812, 3, 13, 156, 'Mburamazi'),
(813, 3, 13, 156, 'Rugeyo'),
(814, 3, 13, 156, 'Twabugezi'),
(815, 3, 13, 157, 'Gabiro'),
(816, 3, 13, 157, 'Gisiza'),
(817, 3, 13, 157, 'Murambi'),
(818, 3, 13, 157, 'Nyarubuye'),
(819, 3, 13, 158, 'Biruyi'),
(820, 3, 13, 158, 'Kaguriro'),
(821, 3, 13, 158, 'Magaba'),
(822, 3, 13, 158, 'Rurara'),
(823, 3, 13, 159, 'Bumba'),
(824, 3, 13, 159, 'Cyarusera'),
(825, 3, 13, 159, 'Gitwa'),
(826, 3, 13, 159, 'Mageragere'),
(827, 3, 13, 159, 'Sure'),
(828, 3, 13, 160, 'Busuku'),
(829, 3, 13, 160, 'Cyivugiza'),
(830, 3, 13, 160, 'Mubuga'),
(831, 3, 13, 160, 'Ngoma'),
(832, 3, 13, 160, 'Terimbere'),
(833, 3, 13, 161, 'Gatare'),
(834, 3, 13, 161, 'Gihira'),
(835, 3, 13, 161, 'Kavumu'),
(836, 3, 13, 161, 'Nyakarera'),
(837, 3, 13, 161, 'Rugasa'),
(838, 3, 13, 161, 'Rundoyi'),
(839, 3, 13, 162, 'Kabona'),
(840, 3, 13, 162, 'Mberi'),
(841, 3, 13, 162, 'Remera'),
(842, 3, 13, 162, 'Ruronde'),
(843, 3, 14, 163, 'Buringo'),
(844, 3, 14, 163, 'Butaka'),
(845, 3, 14, 163, 'Hehu'),
(846, 3, 14, 163, 'Kabumba'),
(847, 3, 14, 163, 'Mutovu'),
(848, 3, 14, 163, 'Nsherima'),
(849, 3, 14, 163, 'Rusiza'),
(850, 3, 14, 164, 'Gacurabwenge'),
(851, 3, 14, 164, 'Gasiza'),
(852, 3, 14, 164, 'Gihonga'),
(853, 3, 14, 164, 'Kageshi'),
(854, 3, 14, 164, 'Makoro'),
(855, 3, 14, 164, 'Nyacyonga'),
(856, 3, 14, 164, 'Rusura'),
(857, 3, 14, 165, 'Busigari'),
(858, 3, 14, 165, 'Cyanzarwe'),
(859, 3, 14, 165, 'Gora'),
(860, 3, 14, 165, 'Kinyanzovu'),
(861, 3, 14, 165, 'Makurizo'),
(862, 3, 14, 165, 'Rwangara'),
(863, 3, 14, 165, 'Rwanzekuma'),
(864, 3, 14, 165, 'Ryabizige'),
(865, 3, 14, 166, 'Amahoro'),
(866, 3, 14, 166, 'Bugoyi'),
(867, 3, 14, 166, 'Kivumu'),
(868, 3, 14, 166, 'Mbugangari'),
(869, 3, 14, 166, 'Nengo'),
(870, 3, 14, 166, 'Rubavu'),
(871, 3, 14, 166, 'Umuganda'),
(872, 3, 14, 167, 'Kamuhoza'),
(873, 3, 14, 167, 'Karambo'),
(874, 3, 14, 167, 'Mahoko'),
(875, 3, 14, 167, 'Musabike'),
(876, 3, 14, 167, 'Nkomane'),
(877, 3, 14, 167, 'Rusongati'),
(878, 3, 14, 167, 'Yungwe'),
(879, 3, 14, 168, 'Kanyirabigogo'),
(880, 3, 14, 168, 'Kirerema'),
(881, 3, 14, 168, 'Muramba'),
(882, 3, 14, 168, 'Nyamikongi'),
(883, 3, 14, 168, 'Nyamirango'),
(884, 3, 14, 168, 'Nyaruteme'),
(885, 3, 14, 169, 'Bihungwe'),
(886, 3, 14, 169, 'Kanyundo'),
(887, 3, 14, 169, 'Micinyiro'),
(888, 3, 14, 169, 'Mirindi'),
(889, 3, 14, 169, 'Ndoranyi'),
(890, 3, 14, 169, 'Rungu'),
(891, 3, 14, 169, 'Rwanyakayaga'),
(892, 3, 14, 170, 'Bisizi'),
(893, 3, 14, 170, 'Gikombe'),
(894, 3, 14, 170, 'Kanyefurwe'),
(895, 3, 14, 170, 'Nyarushyamba'),
(896, 3, 14, 171, 'Burushya'),
(897, 3, 14, 171, 'Busoro'),
(898, 3, 14, 171, 'Kinigi'),
(899, 3, 14, 171, 'Kiraga'),
(900, 3, 14, 171, 'Munanira'),
(901, 3, 14, 171, 'Rubona'),
(902, 3, 14, 172, 'Bahimba'),
(903, 3, 14, 172, 'Gatovu'),
(904, 3, 14, 172, 'Kavomo'),
(905, 3, 14, 172, 'Kigarama'),
(906, 3, 14, 172, 'Mukondo'),
(907, 3, 14, 172, 'Nyundo'),
(908, 3, 14, 172, 'Terimbere'),
(909, 3, 14, 173, 'Buhaza'),
(910, 3, 14, 173, 'Burinda'),
(911, 3, 14, 173, 'Byahi'),
(912, 3, 14, 173, 'Gikombe'),
(913, 3, 14, 173, 'Murambi'),
(914, 3, 14, 173, 'Murara'),
(915, 3, 14, 173, 'Rukoko'),
(916, 3, 14, 174, 'Basa'),
(917, 3, 14, 174, 'Gisa'),
(918, 3, 14, 174, 'Kabilizi'),
(919, 3, 14, 174, 'Muhira'),
(920, 3, 14, 174, 'Rugerero'),
(921, 3, 14, 174, 'Rushubi'),
(922, 3, 14, 174, 'Rwaza'),
(923, 3, 15, 175, 'Arusha'),
(924, 3, 15, 175, 'Basumba'),
(925, 3, 15, 175, 'Kijote'),
(926, 3, 15, 175, 'Kora'),
(927, 3, 15, 175, 'Muhe'),
(928, 3, 15, 175, 'Rega'),
(929, 3, 15, 176, 'Bukinanyana'),
(930, 3, 15, 176, 'Gasizi'),
(931, 3, 15, 176, 'Kabatezi'),
(932, 3, 15, 176, 'Kareba'),
(933, 3, 15, 176, 'Nyirakigugu'),
(934, 3, 15, 176, 'Rega'),
(935, 3, 15, 177, 'Gasiza'),
(936, 3, 15, 177, 'Gasura'),
(937, 3, 15, 177, 'Gisizi'),
(938, 3, 15, 177, 'Guriro'),
(939, 3, 15, 177, 'Kavumu'),
(940, 3, 15, 177, 'Nyamitanzi'),
(941, 3, 15, 178, 'Batikoti'),
(942, 3, 15, 178, 'Cyamvumba'),
(943, 3, 15, 178, 'Gihorwe'),
(944, 3, 15, 178, 'Myuga'),
(945, 3, 15, 178, 'Ngando'),
(946, 3, 15, 178, 'Rugarama'),
(947, 3, 15, 179, 'Busoro'),
(948, 3, 15, 179, 'Cyamabuye'),
(949, 3, 15, 179, 'Gatagara'),
(950, 3, 15, 179, 'Gihirwa'),
(951, 3, 15, 179, 'Kadahenda'),
(952, 3, 15, 179, 'Karengera'),
(953, 3, 15, 180, 'Gatovu'),
(954, 3, 15, 180, 'Kintobo'),
(955, 3, 15, 180, 'Nyagisozi'),
(956, 3, 15, 180, 'Nyamugari'),
(957, 3, 15, 180, 'Rukondo'),
(958, 3, 15, 180, 'Ryinyo'),
(959, 3, 15, 181, 'Gasizi'),
(960, 3, 15, 181, 'Jaba'),
(961, 3, 15, 181, 'Kanyove'),
(962, 3, 15, 181, 'Rubaya'),
(963, 3, 15, 181, 'Rugeshi'),
(964, 3, 15, 181, 'Rukoma'),
(965, 3, 15, 181, 'Rurengeri'),
(966, 3, 15, 182, 'Gisizi'),
(967, 3, 15, 182, 'Mulinga'),
(968, 3, 15, 182, 'Mwiyanike'),
(969, 3, 15, 182, 'Nkomane'),
(970, 3, 15, 182, 'Nyamasheke'),
(971, 3, 15, 182, 'Rwantobo'),
(972, 3, 15, 183, 'Birembo'),
(973, 3, 15, 183, 'Guriro'),
(974, 3, 15, 183, 'Kibisabo'),
(975, 3, 15, 183, 'Mutaho'),
(976, 3, 15, 183, 'Nyundo'),
(977, 3, 15, 183, 'Rugamba'),
(978, 3, 15, 184, 'Gakoro'),
(979, 3, 15, 184, 'Marangara'),
(980, 3, 15, 184, 'Nyagahondo'),
(981, 3, 15, 184, 'Nyarutembe'),
(982, 3, 15, 184, 'Rurembo'),
(983, 3, 15, 184, 'Tyazo'),
(984, 3, 15, 185, 'Gahondo'),
(985, 3, 15, 185, 'Gitega'),
(986, 3, 15, 185, 'Kirimbogo'),
(987, 3, 15, 185, 'Murambi'),
(988, 3, 15, 185, 'Mwana'),
(989, 3, 15, 185, 'Rwaza'),
(990, 3, 15, 186, 'Cyimanzovu'),
(991, 3, 15, 186, 'Kanyamitana'),
(992, 3, 15, 186, 'Kintarure'),
(993, 3, 15, 186, 'Mpinga'),
(994, 3, 15, 186, 'Mutanda'),
(995, 3, 15, 186, 'Shaki'),
(996, 3, 16, 187, 'Bungwe'),
(997, 3, 16, 187, 'Cyahafi'),
(998, 3, 16, 187, 'Gashubi'),
(999, 3, 16, 187, 'Kabarondo'),
(1000, 3, 16, 187, 'Ruhindage'),
(1001, 3, 16, 188, 'Cyome'),
(1002, 3, 16, 188, 'Gatsibo'),
(1003, 3, 16, 188, 'Kamasiga'),
(1004, 3, 16, 188, 'Karambo'),
(1005, 3, 16, 188, 'Ruhanga'),
(1006, 3, 16, 188, 'Rusumo'),
(1007, 3, 16, 189, 'Gatare'),
(1008, 3, 16, 189, 'Gatega'),
(1009, 3, 16, 189, 'Kajinge'),
(1010, 3, 16, 189, 'Marantima'),
(1011, 3, 16, 189, 'Rugendabari'),
(1012, 3, 16, 189, 'Runyinya'),
(1013, 3, 16, 190, 'Busunzu'),
(1014, 3, 16, 190, 'Gaseke'),
(1015, 3, 16, 190, 'Kabaya'),
(1016, 3, 16, 190, 'Mwendo'),
(1017, 3, 16, 190, 'Ngoma'),
(1018, 3, 16, 190, 'Nyenyeri'),
(1019, 3, 16, 191, 'Kageshi'),
(1020, 3, 16, 191, 'Kirwa'),
(1021, 3, 16, 191, 'Mukore'),
(1022, 3, 16, 191, 'Muramba'),
(1023, 3, 16, 191, 'Nyamata'),
(1024, 3, 16, 191, 'Rwamamara'),
(1025, 3, 16, 192, 'Birembo'),
(1026, 3, 16, 192, 'Gitwa'),
(1027, 3, 16, 192, 'Murinzi'),
(1028, 3, 16, 192, 'Nyamugeyo'),
(1029, 3, 16, 192, 'Rugeshi'),
(1030, 3, 16, 192, 'Tetero'),
(1031, 3, 16, 193, 'Binana'),
(1032, 3, 16, 193, 'Gitega'),
(1033, 3, 16, 193, 'Matare'),
(1034, 3, 16, 193, 'Rutare'),
(1035, 3, 16, 193, 'Rwamiko'),
(1036, 3, 16, 194, 'Bugarura'),
(1037, 3, 16, 194, 'Gasiza'),
(1038, 3, 16, 194, 'Mashya'),
(1039, 3, 16, 194, 'Nganzo'),
(1040, 3, 16, 194, 'Ngoma'),
(1041, 3, 16, 194, 'Rutagara'),
(1042, 3, 16, 195, 'Bweramana'),
(1043, 3, 16, 195, 'Mubuga'),
(1044, 3, 16, 195, 'Myiha'),
(1045, 3, 16, 195, 'Rugogwe'),
(1046, 3, 16, 195, 'Rusororo'),
(1047, 3, 16, 195, 'Sanza'),
(1048, 3, 16, 196, 'Bijyojyo'),
(1049, 3, 16, 196, 'Bitabage'),
(1050, 3, 16, 196, 'Kabageshi'),
(1051, 3, 16, 196, 'Kibanda'),
(1052, 3, 16, 196, 'Kinyovi'),
(1053, 3, 16, 197, 'Kaseke'),
(1054, 3, 16, 197, 'Kazabe'),
(1055, 3, 16, 197, 'Mugano'),
(1056, 3, 16, 197, 'Nyange'),
(1057, 3, 16, 197, 'Rususa'),
(1058, 3, 16, 197, 'Torero'),
(1059, 3, 16, 198, 'Bambiro'),
(1060, 3, 16, 198, 'Gaseke'),
(1061, 3, 16, 198, 'Nsibo'),
(1062, 3, 16, 198, 'Vuganyana'),
(1063, 3, 16, 199, 'Birembo'),
(1064, 3, 16, 199, 'Kagano'),
(1065, 3, 16, 199, 'Kanyana'),
(1066, 3, 16, 199, 'Musenyi'),
(1067, 3, 16, 199, 'Nyabipfura'),
(1068, 3, 16, 199, 'Rutovu'),
(1069, 3, 17, 200, 'Nyange'),
(1070, 3, 17, 200, 'Pera'),
(1071, 3, 17, 200, 'Ryankana'),
(1072, 3, 17, 201, 'Butanda'),
(1073, 3, 17, 201, 'Gatereri'),
(1074, 3, 17, 201, 'Nyamihanda'),
(1075, 3, 17, 201, 'Rwambogo'),
(1076, 3, 17, 202, 'Gikungu'),
(1077, 3, 17, 202, 'Kiyabo'),
(1078, 3, 17, 202, 'Murwa'),
(1079, 3, 17, 202, 'Nyamuzi'),
(1080, 3, 17, 202, 'Rasano'),
(1081, 3, 17, 203, 'Birembo'),
(1082, 3, 17, 203, 'Buhokoro'),
(1083, 3, 17, 203, 'Kabakobwa'),
(1084, 3, 17, 203, 'Kacyuma'),
(1085, 3, 17, 203, 'Kamurehe'),
(1086, 3, 17, 203, 'Karemereye'),
(1087, 3, 17, 203, 'Muti'),
(1088, 3, 17, 203, 'Rusayo'),
(1089, 3, 17, 204, 'Cyendajuru'),
(1090, 3, 17, 204, 'Gakomeye'),
(1091, 3, 17, 204, 'Giheke'),
(1092, 3, 17, 204, 'Kamashangi'),
(1093, 3, 17, 204, 'Kigenge'),
(1094, 3, 17, 204, 'Ntura'),
(1095, 3, 17, 204, 'Rwega'),
(1096, 3, 17, 204, 'Turambi'),
(1097, 3, 17, 205, 'Burunga'),
(1098, 3, 17, 205, 'Gatsiro'),
(1099, 3, 17, 205, 'Gihaya'),
(1100, 3, 17, 205, 'Kagara'),
(1101, 3, 17, 205, 'Kamatita'),
(1102, 3, 17, 205, 'Shagasha'),
(1103, 3, 17, 206, 'Kizura'),
(1104, 3, 17, 206, 'Mpinga'),
(1105, 3, 17, 206, 'Nyamigina'),
(1106, 3, 17, 207, 'Cyingwa'),
(1107, 3, 17, 207, 'Gahungeri'),
(1108, 3, 17, 207, 'Hangabashi'),
(1109, 3, 17, 207, 'Mashesha'),
(1110, 3, 17, 208, 'Cyangugu'),
(1111, 3, 17, 208, 'Gihundwe'),
(1112, 3, 17, 208, 'Kamashangi'),
(1113, 3, 17, 208, 'Kamurera'),
(1114, 3, 17, 208, 'Ruganda'),
(1115, 3, 17, 209, 'Cyarukara'),
(1116, 3, 17, 209, 'Gakoni'),
(1117, 3, 17, 209, 'Shara'),
(1118, 3, 17, 210, 'Gahinga'),
(1119, 3, 17, 210, 'Kabahinda'),
(1120, 3, 17, 210, 'Kabasigirira'),
(1121, 3, 17, 210, 'Kagarama'),
(1122, 3, 17, 210, 'Karambi'),
(1123, 3, 17, 210, 'Miko'),
(1124, 3, 17, 210, 'Tara'),
(1125, 3, 17, 211, 'Gitwa'),
(1126, 3, 17, 211, 'Kamanyenga'),
(1127, 3, 17, 211, 'Kangazi'),
(1128, 3, 17, 211, 'Kinyaga'),
(1129, 3, 17, 211, 'Rugabano'),
(1130, 3, 17, 212, 'Bigoga'),
(1131, 3, 17, 212, 'Bugarura'),
(1132, 3, 17, 212, 'Ishywa'),
(1133, 3, 17, 212, 'Kamagimbo'),
(1134, 3, 17, 212, 'Rwenje'),
(1135, 3, 17, 213, 'Gatare'),
(1136, 3, 17, 213, 'Kiziguro'),
(1137, 3, 17, 213, 'Mataba'),
(1138, 3, 17, 213, 'Ryamuhirwa'),
(1139, 3, 17, 214, 'Gasebeya'),
(1140, 3, 17, 214, 'Gaseke'),
(1141, 3, 17, 214, 'Kamanu'),
(1142, 3, 17, 214, 'Kiziho'),
(1143, 3, 17, 214, 'Mashyuza'),
(1144, 3, 17, 214, 'Nyabintare'),
(1145, 3, 17, 215, 'Gatare'),
(1146, 3, 17, 215, 'Kabagina'),
(1147, 3, 17, 215, 'Kabuye'),
(1148, 3, 17, 215, 'Kanoga'),
(1149, 3, 17, 215, 'Karangiro'),
(1150, 3, 17, 215, 'Murambi'),
(1151, 3, 17, 215, 'Rusambu'),
(1152, 3, 17, 216, 'Butambamo'),
(1153, 3, 17, 216, 'Kigenge'),
(1154, 3, 17, 216, 'Murya'),
(1155, 3, 17, 216, 'Nyenji'),
(1156, 3, 17, 216, 'Rebero'),
(1157, 3, 17, 216, 'Rwinzuki'),
(1158, 3, 17, 217, 'Karenge'),
(1159, 3, 17, 217, 'Muhehwe'),
(1160, 3, 17, 217, 'Mushaka'),
(1161, 3, 17, 217, 'Rubugu'),
(1162, 3, 17, 217, 'Ruganda'),
(1163, 3, 18, 218, 'Buvungira'),
(1164, 3, 18, 218, 'Mpumbu'),
(1165, 3, 18, 218, 'Ngoma'),
(1166, 3, 18, 218, 'Nyarusange'),
(1167, 3, 18, 219, 'Gasheke'),
(1168, 3, 18, 219, 'Impala'),
(1169, 3, 18, 219, 'Kagatamu'),
(1170, 3, 18, 219, 'Karusimbi'),
(1171, 3, 18, 220, 'Bisumo'),
(1172, 3, 18, 220, 'Murambi'),
(1173, 3, 18, 220, 'Mutongo'),
(1174, 3, 18, 220, 'Rugari'),
(1175, 3, 18, 221, 'Butare'),
(1176, 3, 18, 221, 'Gitwa'),
(1177, 3, 18, 221, 'Jarama'),
(1178, 3, 18, 221, 'Kibingo'),
(1179, 3, 18, 221, 'Mubuga'),
(1180, 3, 18, 222, 'Gako'),
(1181, 3, 18, 222, 'Mubumbano'),
(1182, 3, 18, 222, 'Ninzi'),
(1183, 3, 18, 222, 'Rwesero'),
(1184, 3, 18, 222, 'Shara'),
(1185, 3, 18, 223, 'Kibogora'),
(1186, 3, 18, 223, 'Kigarama'),
(1187, 3, 18, 223, 'Kigoya'),
(1188, 3, 18, 223, 'Raro'),
(1189, 3, 18, 223, 'Susa'),
(1190, 3, 18, 224, 'Gasovu'),
(1191, 3, 18, 224, 'Gitwe'),
(1192, 3, 18, 224, 'Kabuga'),
(1193, 3, 18, 224, 'Kagarama'),
(1194, 3, 18, 224, 'Rushyarara'),
(1195, 3, 18, 225, 'Gasayo'),
(1196, 3, 18, 225, 'Gashashi'),
(1197, 3, 18, 225, 'Higiro'),
(1198, 3, 18, 225, 'Miko'),
(1199, 3, 18, 225, 'Mwezi'),
(1200, 3, 18, 226, 'Cyimpindu'),
(1201, 3, 18, 226, 'Karengera'),
(1202, 3, 18, 226, 'Muhororo'),
(1203, 3, 18, 226, 'Nyarusange'),
(1204, 3, 18, 227, 'Gatare'),
(1205, 3, 18, 227, 'Mutongo'),
(1206, 3, 18, 227, 'Nyakabingo'),
(1207, 3, 18, 227, 'Rugari'),
(1208, 3, 18, 227, 'Vugangoma'),
(1209, 3, 18, 228, 'Gisoke'),
(1210, 3, 18, 228, 'Kagarama'),
(1211, 3, 18, 228, 'Nyagatare'),
(1212, 3, 18, 228, 'Nyakavumu'),
(1213, 3, 18, 229, 'Kigabiro'),
(1214, 3, 18, 229, 'Kinunga'),
(1215, 3, 18, 229, 'Mariba'),
(1216, 3, 18, 229, 'Muyange'),
(1217, 3, 18, 229, 'Ntango'),
(1218, 3, 18, 230, 'Banda'),
(1219, 3, 18, 230, 'Gakenke'),
(1220, 3, 18, 230, 'Jurwe'),
(1221, 3, 18, 230, 'Murambi'),
(1222, 3, 18, 231, 'Kanazi'),
(1223, 3, 18, 231, 'Ntendezi'),
(1224, 3, 18, 231, 'Save'),
(1225, 3, 18, 231, 'Wimana'),
(1226, 3, 18, 232, 'Burimba'),
(1227, 3, 18, 232, 'Mataba'),
(1228, 3, 18, 232, 'Mugera'),
(1229, 3, 18, 232, 'Nyamugari'),
(1230, 3, 18, 232, 'Shangi'),
(1231, 4, 19, 233, 'Cyohoha'),
(1232, 4, 19, 233, 'Gitare'),
(1233, 4, 19, 233, 'Rwamahwa'),
(1234, 4, 19, 234, 'Butangampundu'),
(1235, 4, 19, 234, 'Karengeri'),
(1236, 4, 19, 234, 'Taba'),
(1237, 4, 19, 235, 'Gasiza'),
(1238, 4, 19, 235, 'Giko'),
(1239, 4, 19, 235, 'Kayenzi'),
(1240, 4, 19, 235, 'Mukoto'),
(1241, 4, 19, 235, 'Nyirangarama'),
(1242, 4, 19, 236, 'Busoro'),
(1243, 4, 19, 236, 'Butare'),
(1244, 4, 19, 236, 'Gahororo'),
(1245, 4, 19, 236, 'Gitumba'),
(1246, 4, 19, 236, 'Karama'),
(1247, 4, 19, 236, 'Mwumba'),
(1248, 4, 19, 236, 'Ndarage'),
(1249, 4, 19, 237, 'Budakiranya'),
(1250, 4, 19, 237, 'Migendezo'),
(1251, 4, 19, 237, 'Rudogo'),
(1252, 4, 19, 238, 'Burehe'),
(1253, 4, 19, 238, 'Marembo'),
(1254, 4, 19, 238, 'Rwili'),
(1255, 4, 19, 239, 'Butunzi'),
(1256, 4, 19, 239, 'Karegamazi'),
(1257, 4, 19, 239, 'Marembo'),
(1258, 4, 19, 239, 'Rebero'),
(1259, 4, 19, 240, 'Gitatsa'),
(1260, 4, 19, 240, 'Kamushenyi'),
(1261, 4, 19, 240, 'Kigarama'),
(1262, 4, 19, 240, 'Mubuga'),
(1263, 4, 19, 240, 'Murama'),
(1264, 4, 19, 240, 'Sayo'),
(1265, 4, 19, 241, 'Kabuga'),
(1266, 4, 19, 241, 'Kigarama'),
(1267, 4, 19, 241, 'Kivugiza'),
(1268, 4, 19, 241, 'Nyamyumba'),
(1269, 4, 19, 241, 'Shengampuli'),
(1270, 4, 19, 242, 'Bukoro'),
(1271, 4, 19, 242, 'Mushari'),
(1272, 4, 19, 242, 'Ngiramazi'),
(1273, 4, 19, 242, 'Rurenge'),
(1274, 4, 19, 243, 'Bubangu'),
(1275, 4, 19, 243, 'Gatwa'),
(1276, 4, 19, 243, 'Mugambazi'),
(1277, 4, 19, 243, 'Mvuzo'),
(1278, 4, 19, 244, 'Kabuga'),
(1279, 4, 19, 244, 'Karambo'),
(1280, 4, 19, 244, 'Mugote'),
(1281, 4, 19, 244, 'Munyarwanda'),
(1282, 4, 19, 245, 'Kajevuba'),
(1283, 4, 19, 245, 'Kiyanza'),
(1284, 4, 19, 245, 'Mahaza'),
(1285, 4, 19, 246, 'Buraro'),
(1286, 4, 19, 246, 'Bwimo'),
(1287, 4, 19, 246, 'Mberuka'),
(1288, 4, 19, 246, 'Mbuye'),
(1289, 4, 19, 247, 'Gako'),
(1290, 4, 19, 247, 'Kirenge'),
(1291, 4, 19, 247, 'Taba'),
(1292, 4, 19, 248, 'Bugaragara'),
(1293, 4, 19, 248, 'Kijabagwe'),
(1294, 4, 19, 248, 'Muvumu'),
(1295, 4, 19, 248, 'Rubona'),
(1296, 4, 19, 248, 'Rutonde'),
(1297, 4, 19, 249, 'Barari'),
(1298, 4, 19, 249, 'Gahabwa'),
(1299, 4, 19, 249, 'Misezero'),
(1300, 4, 19, 249, 'Nyirabirori'),
(1301, 4, 19, 249, 'Taba'),
(1302, 4, 20, 250, 'Birambo'),
(1303, 4, 20, 250, 'Butereri'),
(1304, 4, 20, 250, 'Byibuhiro'),
(1305, 4, 20, 250, 'Kamina'),
(1306, 4, 20, 250, 'Kirabo'),
(1307, 4, 20, 250, 'Mwumba'),
(1308, 4, 20, 250, 'Ruhanga'),
(1309, 4, 20, 251, 'Kiruku'),
(1310, 4, 20, 251, 'Mbirima'),
(1311, 4, 20, 251, 'Nyange'),
(1312, 4, 20, 251, 'Nyanza'),
(1313, 4, 20, 252, 'Muhaza'),
(1314, 4, 20, 252, 'Muhororo'),
(1315, 4, 20, 252, 'Muramba'),
(1316, 4, 20, 252, 'Mutanda'),
(1317, 4, 20, 252, 'Rukore'),
(1318, 4, 20, 253, 'Buheta'),
(1319, 4, 20, 253, 'Kagoma'),
(1320, 4, 20, 253, 'Nganzo'),
(1321, 4, 20, 253, 'Rusagara'),
(1322, 4, 20, 254, 'Nyacyina'),
(1323, 4, 20, 254, 'Rukura'),
(1324, 4, 20, 254, 'Rutabo'),
(1325, 4, 20, 254, 'Rutenderi'),
(1326, 4, 20, 254, 'Taba'),
(1327, 4, 20, 255, 'Gakindo'),
(1328, 4, 20, 255, 'Gashyamba'),
(1329, 4, 20, 255, 'Gatwa'),
(1330, 4, 20, 255, 'Karukungu'),
(1331, 4, 20, 256, 'Kamubuga'),
(1332, 4, 20, 256, 'Kidomo'),
(1333, 4, 20, 256, 'Mbatabata'),
(1334, 4, 20, 256, 'Rukore'),
(1335, 4, 20, 257, 'Kanyanza'),
(1336, 4, 20, 257, 'Karambo'),
(1337, 4, 20, 257, 'Kirebe'),
(1338, 4, 20, 258, 'Cyintare'),
(1339, 4, 20, 258, 'Gasiza'),
(1340, 4, 20, 258, 'Rugimbu'),
(1341, 4, 20, 258, 'Ruhinga'),
(1342, 4, 20, 258, 'Sereri'),
(1343, 4, 20, 259, 'Buyange'),
(1344, 4, 20, 259, 'Gikombe'),
(1345, 4, 20, 259, 'Nyundo'),
(1346, 4, 20, 260, 'Gasiho'),
(1347, 4, 20, 260, 'Munyana'),
(1348, 4, 20, 260, 'Murambi'),
(1349, 4, 20, 260, 'Raba'),
(1350, 4, 20, 261, 'Gahinga'),
(1351, 4, 20, 261, 'Munyana'),
(1352, 4, 20, 261, 'Mutego'),
(1353, 4, 20, 261, 'Nkomane'),
(1354, 4, 20, 261, 'Rutabo'),
(1355, 4, 20, 261, 'Rutenderi'),
(1356, 4, 20, 261, 'Rwamambe'),
(1357, 4, 20, 262, 'Busake'),
(1358, 4, 20, 262, 'Bwenda'),
(1359, 4, 20, 262, 'Gasiza'),
(1360, 4, 20, 262, 'Gihinga'),
(1361, 4, 20, 262, 'Huro'),
(1362, 4, 20, 262, 'Musagara'),
(1363, 4, 20, 262, 'Musenyi'),
(1364, 4, 20, 262, 'Ruganda'),
(1365, 4, 20, 262, 'Rwinkuba'),
(1366, 4, 20, 263, 'Bumba'),
(1367, 4, 20, 263, 'Gisiza'),
(1368, 4, 20, 263, 'Karyango'),
(1369, 4, 20, 263, 'Nganzo'),
(1370, 4, 20, 263, 'Va'),
(1371, 4, 20, 264, 'Kabatezi'),
(1372, 4, 20, 264, 'Kiryamo'),
(1373, 4, 20, 264, 'Mubuga'),
(1374, 4, 20, 264, 'Mwiyando'),
(1375, 4, 20, 264, 'Rwa'),
(1376, 4, 20, 265, 'Buranga'),
(1377, 4, 20, 265, 'Gahinga'),
(1378, 4, 20, 265, 'Gisozi'),
(1379, 4, 20, 265, 'Mucaca'),
(1380, 4, 20, 266, 'Busoro'),
(1381, 4, 20, 266, 'Gikingo'),
(1382, 4, 20, 266, 'Jango'),
(1383, 4, 20, 266, 'Ruli'),
(1384, 4, 20, 266, 'Rwesero'),
(1385, 4, 20, 267, 'Gataba'),
(1386, 4, 20, 267, 'Kamonyi'),
(1387, 4, 20, 267, 'Murambi'),
(1388, 4, 20, 267, 'Nyundo'),
(1389, 4, 20, 267, 'Rumbi'),
(1390, 4, 20, 267, 'Rurembo'),
(1391, 4, 20, 268, 'Burimba'),
(1392, 4, 20, 268, 'Busanane'),
(1393, 4, 20, 268, 'Joma'),
(1394, 4, 20, 268, 'Kageyo'),
(1395, 4, 20, 268, 'Mbogo'),
(1396, 4, 20, 268, 'Razi'),
(1397, 4, 20, 268, 'Rwankuba'),
(1398, 4, 20, 268, 'Shyombwe'),
(1399, 4, 21, 269, 'Gisesero'),
(1400, 4, 21, 269, 'Kavumu'),
(1401, 4, 21, 269, 'Nyagisozi'),
(1402, 4, 21, 269, 'Sahara'),
(1403, 4, 21, 270, 'Bukinanyana'),
(1404, 4, 21, 270, 'Buruba'),
(1405, 4, 21, 270, 'Cyanya'),
(1406, 4, 21, 270, 'Kabeza'),
(1407, 4, 21, 270, 'Migeshi'),
(1408, 4, 21, 270, 'Rwebeya'),
(1409, 4, 21, 271, 'Gakoro'),
(1410, 4, 21, 271, 'Gasakuza'),
(1411, 4, 21, 271, 'Kabirizi'),
(1412, 4, 21, 271, 'Karwasa'),
(1413, 4, 21, 272, 'Kigabiro'),
(1414, 4, 21, 272, 'Kivumu'),
(1415, 4, 21, 272, 'Mbwe'),
(1416, 4, 21, 272, 'Muharuro'),
(1417, 4, 21, 273, 'Mudakama'),
(1418, 4, 21, 273, 'Murago'),
(1419, 4, 21, 273, 'Rubindi'),
(1420, 4, 21, 273, 'Rungu'),
(1421, 4, 21, 274, 'Birira'),
(1422, 4, 21, 274, 'Buramira'),
(1423, 4, 21, 274, 'Kivumu'),
(1424, 4, 21, 274, 'Mbizi'),
(1425, 4, 21, 275, 'Bisoke'),
(1426, 4, 21, 275, 'Kaguhu'),
(1427, 4, 21, 275, 'Kampanga'),
(1428, 4, 21, 275, 'Nyabigoma'),
(1429, 4, 21, 275, 'Nyonirima'),
(1430, 4, 21, 276, 'Cyabararika'),
(1431, 4, 21, 276, 'Kigombe'),
(1432, 4, 21, 276, 'Mpenge'),
(1433, 4, 21, 276, 'Ruhengeri'),
(1434, 4, 21, 277, 'Cyivugiza'),
(1435, 4, 21, 277, 'Cyogo'),
(1436, 4, 21, 277, 'Mburabuturo'),
(1437, 4, 21, 277, 'Songa'),
(1438, 4, 21, 278, 'Cyabagarura'),
(1439, 4, 21, 278, 'Garuka'),
(1440, 4, 21, 278, 'Kabazungu'),
(1441, 4, 21, 278, 'Nyarubuye'),
(1442, 4, 21, 278, 'Rwambogo'),
(1443, 4, 21, 279, 'Bikara'),
(1444, 4, 21, 279, 'Gashinga'),
(1445, 4, 21, 279, 'Mubago'),
(1446, 4, 21, 279, 'Rugeshi'),
(1447, 4, 21, 279, 'Ruyumba'),
(1448, 4, 21, 280, 'Cyivugiza'),
(1449, 4, 21, 280, 'Kabeza'),
(1450, 4, 21, 280, 'Kamwumba'),
(1451, 4, 21, 280, 'Muhabura'),
(1452, 4, 21, 280, 'Ninda'),
(1453, 4, 21, 281, 'Gasongero'),
(1454, 4, 21, 281, 'Kamisave'),
(1455, 4, 21, 281, 'Murandi'),
(1456, 4, 21, 281, 'Murwa'),
(1457, 4, 21, 281, 'Rurambo'),
(1458, 4, 21, 282, 'Bumara'),
(1459, 4, 21, 282, 'Kabushinge'),
(1460, 4, 21, 282, 'Musezero'),
(1461, 4, 21, 282, 'Nturo'),
(1462, 4, 21, 282, 'Nyarubuye'),
(1463, 4, 21, 283, 'Gakingo'),
(1464, 4, 21, 283, 'Kibuguzo'),
(1465, 4, 21, 283, 'Mudende'),
(1466, 4, 21, 283, 'Mugari'),
(1467, 4, 22, 284, 'Bungwe'),
(1468, 4, 22, 284, 'Bushenya'),
(1469, 4, 22, 284, 'Mudugari'),
(1470, 4, 22, 284, 'Tumba'),
(1471, 4, 22, 285, 'Gatsibo'),
(1472, 4, 22, 285, 'Mubuga'),
(1473, 4, 22, 285, 'Muhotora'),
(1474, 4, 22, 285, 'Nyamicucu'),
(1475, 4, 22, 285, 'Rusumo'),
(1476, 4, 22, 286, 'Gasiza'),
(1477, 4, 22, 286, 'Gisovu'),
(1478, 4, 22, 286, 'Kabyiniro'),
(1479, 4, 22, 286, 'Kagitega'),
(1480, 4, 22, 286, 'Kamanyana'),
(1481, 4, 22, 286, 'Nyagahinga'),
(1482, 4, 22, 287, 'Butare'),
(1483, 4, 22, 287, 'Ndongozi'),
(1484, 4, 22, 287, 'Ruyange'),
(1485, 4, 22, 288, 'Buramba'),
(1486, 4, 22, 288, 'Gisizi'),
(1487, 4, 22, 288, 'Kidakama'),
(1488, 4, 22, 288, 'Nyangwe'),
(1489, 4, 22, 288, 'Rwasa'),
(1490, 4, 22, 289, 'Gabiro'),
(1491, 4, 22, 289, 'Musenda'),
(1492, 4, 22, 289, 'Rwambogo'),
(1493, 4, 22, 289, 'Rwasa'),
(1494, 4, 22, 290, 'Mariba'),
(1495, 4, 22, 290, 'Musasa'),
(1496, 4, 22, 290, 'Runoga'),
(1497, 4, 22, 291, 'Kabaya'),
(1498, 4, 22, 291, 'Kayenzi'),
(1499, 4, 22, 291, 'Kiringa'),
(1500, 4, 22, 291, 'Nyamabuye'),
(1501, 4, 22, 292, 'Gafuka'),
(1502, 4, 22, 292, 'Nkenke'),
(1503, 4, 22, 292, 'Nkumba'),
(1504, 4, 22, 292, 'Ntaruka'),
(1505, 4, 22, 293, 'Bugamba'),
(1506, 4, 22, 293, 'Kaganda'),
(1507, 4, 22, 293, 'Musasa'),
(1508, 4, 22, 293, 'Rutovu'),
(1509, 4, 22, 294, 'Bukwashuri'),
(1510, 4, 22, 294, 'Gashanje'),
(1511, 4, 22, 294, 'Murwa'),
(1512, 4, 22, 294, 'Nyirataba'),
(1513, 4, 22, 295, 'Kivumu'),
(1514, 4, 22, 295, 'Nyamugari'),
(1515, 4, 22, 295, 'Rubona'),
(1516, 4, 22, 295, 'Rushara'),
(1517, 4, 22, 296, 'Cyahi'),
(1518, 4, 22, 296, 'Gafumba'),
(1519, 4, 22, 296, 'Karangara'),
(1520, 4, 22, 296, 'Rurembo'),
(1521, 4, 22, 297, 'Kilibata'),
(1522, 4, 22, 297, 'Mucaca'),
(1523, 4, 22, 297, 'Nyanamo'),
(1524, 4, 22, 297, 'Rukandabyuma'),
(1525, 4, 22, 298, 'Gaseke'),
(1526, 4, 22, 298, 'Gatare'),
(1527, 4, 22, 298, 'Gitovu'),
(1528, 4, 22, 298, 'Rusekera'),
(1529, 4, 22, 299, 'Kabona'),
(1530, 4, 22, 299, 'Ndago'),
(1531, 4, 22, 299, 'Ruhanga'),
(1532, 4, 22, 300, 'Gacundura'),
(1533, 4, 22, 300, 'Gashoro'),
(1534, 4, 22, 300, 'Ruconsho'),
(1535, 4, 22, 300, 'Rugari'),
(1536, 4, 23, 301, 'Karenge'),
(1537, 4, 23, 301, 'Kigabiro'),
(1538, 4, 23, 301, 'Kivumu'),
(1539, 4, 23, 301, 'Rwesero'),
(1540, 4, 23, 302, 'Bwisige'),
(1541, 4, 23, 302, 'Gihuke'),
(1542, 4, 23, 302, 'Mukono'),
(1543, 4, 23, 302, 'Nyabushingitwa'),
(1544, 4, 23, 303, 'Gacurabwenge'),
(1545, 4, 23, 303, 'Gisuna'),
(1546, 4, 23, 303, 'Kibali'),
(1547, 4, 23, 303, 'Kivugiza'),
(1548, 4, 23, 303, 'Murama'),
(1549, 4, 23, 303, 'Ngondore'),
(1550, 4, 23, 303, 'Nyakabungo'),
(1551, 4, 23, 303, 'Nyamabuye'),
(1552, 4, 23, 303, 'Nyarutarama'),
(1553, 4, 23, 304, 'Gasunzu'),
(1554, 4, 23, 304, 'Muhambo'),
(1555, 4, 23, 304, 'Nyakabungo'),
(1556, 4, 23, 304, 'Nyambare'),
(1557, 4, 23, 304, 'Nyaruka'),
(1558, 4, 23, 304, 'Rwankonjo'),
(1559, 4, 23, 305, 'Gatobotobo'),
(1560, 4, 23, 305, 'Murehe'),
(1561, 4, 23, 305, 'Tanda'),
(1562, 4, 23, 306, 'Gihembe'),
(1563, 4, 23, 306, 'Horezo'),
(1564, 4, 23, 306, 'Kabuga'),
(1565, 4, 23, 306, 'Muhondo'),
(1566, 4, 23, 306, 'Nyamiyaga'),
(1567, 4, 23, 307, 'Bugomba'),
(1568, 4, 23, 307, 'Gatoma'),
(1569, 4, 23, 307, 'Mulindi'),
(1570, 4, 23, 307, 'Nyarwambu'),
(1571, 4, 23, 307, 'Rukurura'),
(1572, 4, 23, 308, 'Kabuga'),
(1573, 4, 23, 308, 'Nyiragifumba'),
(1574, 4, 23, 308, 'Nyiravugiza'),
(1575, 4, 23, 308, 'Remera'),
(1576, 4, 23, 308, 'Rusekera'),
(1577, 4, 23, 308, 'Ryaruyumba'),
(1578, 4, 23, 309, 'Gakenke'),
(1579, 4, 23, 309, 'Miyove'),
(1580, 4, 23, 309, 'Mubuga'),
(1581, 4, 23, 310, 'Cyamuganga'),
(1582, 4, 23, 310, 'Gatenga'),
(1583, 4, 23, 310, 'Kiruhura'),
(1584, 4, 23, 310, 'Mutarama'),
(1585, 4, 23, 310, 'Rugerero'),
(1586, 4, 23, 310, 'Rusambya'),
(1587, 4, 23, 311, 'Cyamuhinda'),
(1588, 4, 23, 311, 'Kigoma'),
(1589, 4, 23, 311, 'Mwendo'),
(1590, 4, 23, 311, 'Ngange'),
(1591, 4, 23, 311, 'Rebero'),
(1592, 4, 23, 312, 'Gaseke'),
(1593, 4, 23, 312, 'Kabeza'),
(1594, 4, 23, 312, 'Musenyi'),
(1595, 4, 23, 312, 'Mutandi'),
(1596, 4, 23, 312, 'Nyarubuye'),
(1597, 4, 23, 313, 'Gahumuliza'),
(1598, 4, 23, 313, 'Jamba'),
(1599, 4, 23, 313, 'Kabeza'),
(1600, 4, 23, 313, 'Kabuga'),
(1601, 4, 23, 313, 'Karambo'),
(1602, 4, 23, 313, 'Kiziba'),
(1603, 4, 23, 313, 'Mataba'),
(1604, 4, 23, 314, 'Butare'),
(1605, 4, 23, 314, 'Kigogo'),
(1606, 4, 23, 314, 'Kinishya'),
(1607, 4, 23, 314, 'Rusasa'),
(1608, 4, 23, 314, 'Rutete'),
(1609, 4, 23, 314, 'Rwagihura'),
(1610, 4, 23, 314, 'Yaramba'),
(1611, 4, 23, 315, 'Gihanga'),
(1612, 4, 23, 315, 'Gishambashayo'),
(1613, 4, 23, 315, 'Gishari'),
(1614, 4, 23, 315, 'Muguramo'),
(1615, 4, 23, 315, 'Nyamiyaga'),
(1616, 4, 23, 316, 'Cyeya'),
(1617, 4, 23, 316, 'Cyuru'),
(1618, 4, 23, 316, 'Gisiza'),
(1619, 4, 23, 316, 'Kinyami'),
(1620, 4, 23, 316, 'Mabare'),
(1621, 4, 23, 316, 'Munyinya'),
(1622, 4, 23, 317, 'Gitega'),
(1623, 4, 23, 317, 'Kamutora'),
(1624, 4, 23, 317, 'Karurama'),
(1625, 4, 23, 318, 'Bikumba'),
(1626, 4, 23, 318, 'Gasharu'),
(1627, 4, 23, 318, 'Gatwaro'),
(1628, 4, 23, 318, 'Kigabiro'),
(1629, 4, 23, 318, 'Munanira'),
(1630, 4, 23, 318, 'Nkoto'),
(1631, 4, 23, 319, 'Cyandaro'),
(1632, 4, 23, 319, 'Gasambya'),
(1633, 4, 23, 319, 'Gashirira'),
(1634, 4, 23, 319, 'Kabare'),
(1635, 4, 23, 319, 'Rebero'),
(1636, 4, 23, 319, 'Ruhondo'),
(1637, 4, 23, 320, 'Cyeru'),
(1638, 4, 23, 320, 'Kigabiro'),
(1639, 4, 23, 320, 'Nyagahinga'),
(1640, 4, 23, 321, 'Bushara'),
(1641, 4, 23, 321, 'Kitazigurwa'),
(1642, 4, 23, 321, 'Nyabishambi'),
(1643, 4, 23, 321, 'Nyabubare'),
(1644, 4, 23, 321, 'Shangasha'),
(1645, 5, 24, 322, 'Mununu'),
(1646, 5, 24, 322, 'Nyagasambu'),
(1647, 5, 24, 322, 'Nyakagunga'),
(1648, 5, 24, 322, 'Nyamirama'),
(1649, 5, 24, 322, 'Nyarubuye'),
(1650, 5, 24, 322, 'Sasabirago'),
(1651, 5, 24, 323, 'Gihumuza'),
(1652, 5, 24, 323, 'Kagezi'),
(1653, 5, 24, 323, 'Kanyangese'),
(1654, 5, 24, 323, 'Kibare'),
(1655, 5, 24, 323, 'Mutamwa'),
(1656, 5, 24, 323, 'Rugarama'),
(1657, 5, 24, 323, 'Runyinya'),
(1658, 5, 24, 323, 'Rweri'),
(1659, 5, 24, 324, 'Binunga'),
(1660, 5, 24, 324, 'Bwinsanga'),
(1661, 5, 24, 324, 'Cyinyana'),
(1662, 5, 24, 324, 'Gati'),
(1663, 5, 24, 324, 'Kavumu'),
(1664, 5, 24, 324, 'Ruhimbi'),
(1665, 5, 24, 324, 'Ruhunda'),
(1666, 5, 24, 325, 'Bicaca'),
(1667, 5, 24, 325, 'Byimana'),
(1668, 5, 24, 325, 'Kabasore'),
(1669, 5, 24, 325, 'Kangamba'),
(1670, 5, 24, 325, 'Karenge'),
(1671, 5, 24, 325, 'Nyabubare'),
(1672, 5, 24, 325, 'Nyamatete'),
(1673, 5, 24, 326, 'Bwiza'),
(1674, 5, 24, 326, 'Cyanya'),
(1675, 5, 24, 326, 'Nyagasenyi'),
(1676, 5, 24, 326, 'Sibagire'),
(1677, 5, 24, 326, 'Sovu'),
(1678, 5, 24, 327, 'Byeza'),
(1679, 5, 24, 327, 'Kabare'),
(1680, 5, 24, 327, 'Karambi'),
(1681, 5, 24, 327, 'Karitutu'),
(1682, 5, 24, 327, 'Kitazigurwa'),
(1683, 5, 24, 327, 'Murambi'),
(1684, 5, 24, 327, 'Nsinda'),
(1685, 5, 24, 327, 'Ntebe'),
(1686, 5, 24, 327, 'Nyarusange'),
(1687, 5, 24, 328, 'Kaduha'),
(1688, 5, 24, 328, 'Nkungu'),
(1689, 5, 24, 328, 'Rweru'),
(1690, 5, 24, 328, 'Zinga'),
(1691, 5, 24, 329, 'Binunga'),
(1692, 5, 24, 329, 'Bwana'),
(1693, 5, 24, 329, 'Cyarukamba'),
(1694, 5, 24, 329, 'Cyimbazi'),
(1695, 5, 24, 329, 'Nkomangwa'),
(1696, 5, 24, 329, 'Nyarubuye'),
(1697, 5, 24, 330, 'Akabare'),
(1698, 5, 24, 330, 'Budahanda'),
(1699, 5, 24, 330, 'Kagarama'),
(1700, 5, 24, 330, 'Musha'),
(1701, 5, 24, 330, 'Nyabisindu'),
(1702, 5, 24, 330, 'Nyakabanda'),
(1703, 5, 24, 331, 'Akinyambo'),
(1704, 5, 24, 331, 'Bujyujyu'),
(1705, 5, 24, 331, 'Murehe'),
(1706, 5, 24, 331, 'Ntebe'),
(1707, 5, 24, 331, 'Nyarukombe'),
(1708, 5, 24, 332, 'Bicumbi'),
(1709, 5, 24, 332, 'Bushenyi'),
(1710, 5, 24, 332, 'Mwulire'),
(1711, 5, 24, 332, 'Ntunga'),
(1712, 5, 24, 333, 'Bihembe'),
(1713, 5, 24, 333, 'Gatare'),
(1714, 5, 24, 333, 'Gishore'),
(1715, 5, 24, 333, 'Munini'),
(1716, 5, 24, 333, 'Rwimbogo'),
(1717, 5, 24, 334, 'Akanzu'),
(1718, 5, 24, 334, 'Kigarama'),
(1719, 5, 24, 334, 'Murama'),
(1720, 5, 24, 334, 'Rugarama'),
(1721, 5, 24, 335, 'Byinza'),
(1722, 5, 24, 335, 'Kabatasi'),
(1723, 5, 24, 335, 'Kabuye'),
(1724, 5, 24, 335, 'Karambi'),
(1725, 5, 24, 335, 'Mabare'),
(1726, 5, 24, 335, 'Nawe'),
(1727, 5, 25, 336, 'Cyagaju'),
(1728, 5, 25, 336, 'Kabeza'),
(1729, 5, 25, 336, 'Nyamikamba'),
(1730, 5, 25, 336, 'Nyamirembe'),
(1731, 5, 25, 336, 'Nyangara'),
(1732, 5, 25, 336, 'Nyarurema'),
(1733, 5, 25, 336, 'Rwensheke'),
(1734, 5, 25, 337, 'Bushara'),
(1735, 5, 25, 337, 'Cyenkwanzi'),
(1736, 5, 25, 337, 'Gikagati'),
(1737, 5, 25, 337, 'Gikundamvura'),
(1738, 5, 25, 337, 'Kabuga'),
(1739, 5, 25, 337, 'Ndego'),
(1740, 5, 25, 337, 'Nyakiga'),
(1741, 5, 25, 338, 'Kamate'),
(1742, 5, 25, 338, 'Karama'),
(1743, 5, 25, 338, 'Kizirakome'),
(1744, 5, 25, 338, 'Mbare'),
(1745, 5, 25, 338, 'Musenyi'),
(1746, 5, 25, 338, 'Ndama'),
(1747, 5, 25, 338, 'Nyagashanga'),
(1748, 5, 25, 338, 'Nyamirama'),
(1749, 5, 25, 338, 'Rubagabaga'),
(1750, 5, 25, 338, 'Rwenyemera'),
(1751, 5, 25, 338, 'Rwisirabo'),
(1752, 5, 25, 339, 'Bayigaburire'),
(1753, 5, 25, 339, 'Kaduha'),
(1754, 5, 25, 339, 'Kanyeganyege'),
(1755, 5, 25, 339, 'Katabagemu'),
(1756, 5, 25, 339, 'Kigarama'),
(1757, 5, 25, 339, 'Nyakigando'),
(1758, 5, 25, 339, 'Rubira'),
(1759, 5, 25, 339, 'Rugazi'),
(1760, 5, 25, 339, 'Rutoma'),
(1761, 5, 25, 340, 'Gataba'),
(1762, 5, 25, 340, 'Gitenga'),
(1763, 5, 25, 340, 'Kabungo'),
(1764, 5, 25, 340, 'Karambo'),
(1765, 5, 25, 340, 'Karujumba'),
(1766, 5, 25, 340, 'Tovu'),
(1767, 5, 25, 341, 'Bwera'),
(1768, 5, 25, 341, 'Byimana'),
(1769, 5, 25, 341, 'Cyembogo'),
(1770, 5, 25, 341, 'Kagitumba'),
(1771, 5, 25, 341, 'Kanyonza'),
(1772, 5, 25, 341, 'Matimba'),
(1773, 5, 25, 341, 'Nyabwishongwezi'),
(1774, 5, 25, 341, 'Rwentanga'),
(1775, 5, 25, 342, 'Bibare'),
(1776, 5, 25, 342, 'Gakoma'),
(1777, 5, 25, 342, 'Mahoro'),
(1778, 5, 25, 342, 'Mimuri'),
(1779, 5, 25, 342, 'Rugari'),
(1780, 5, 25, 343, 'Bufunda'),
(1781, 5, 25, 343, 'Gatete'),
(1782, 5, 25, 343, 'Gihengeri'),
(1783, 5, 25, 343, 'Gishororo'),
(1784, 5, 25, 343, 'Kagina'),
(1785, 5, 25, 343, 'Rugarama'),
(1786, 5, 25, 344, 'Kibirizi'),
(1787, 5, 25, 344, 'Kijojo'),
(1788, 5, 25, 344, 'Musheri'),
(1789, 5, 25, 344, 'Ntoma');
INSERT INTO `fluid_cell` (`id`, `province_id`, `district_id`, `sector_id`, `name`) VALUES
(1790, 5, 25, 344, 'Nyagatabire'),
(1791, 5, 25, 344, 'Nyamiyonga'),
(1792, 5, 25, 344, 'Rugarama I'),
(1793, 5, 25, 344, 'Rugarama Ii'),
(1794, 5, 25, 345, 'Barija'),
(1795, 5, 25, 345, 'Bushoga'),
(1796, 5, 25, 345, 'Cyabayaga'),
(1797, 5, 25, 345, 'Gakirage'),
(1798, 5, 25, 345, 'Kamagiri'),
(1799, 5, 25, 345, 'Nsheke'),
(1800, 5, 25, 345, 'Nyagatare'),
(1801, 5, 25, 345, 'Rutaraka'),
(1802, 5, 25, 345, 'Ryabega'),
(1803, 5, 25, 346, 'Gahurura'),
(1804, 5, 25, 346, 'Gashenyi'),
(1805, 5, 25, 346, 'Nyakagarama'),
(1806, 5, 25, 346, 'Rukomo Ii'),
(1807, 5, 25, 346, 'Rurenge'),
(1808, 5, 25, 347, 'Cyenjonjo'),
(1809, 5, 25, 347, 'Gasinga'),
(1810, 5, 25, 347, 'Kabare'),
(1811, 5, 25, 347, 'Kazaza'),
(1812, 5, 25, 347, 'Mishenyi'),
(1813, 5, 25, 347, 'Rugarama'),
(1814, 5, 25, 347, 'Rukorota'),
(1815, 5, 25, 347, 'Rutare'),
(1816, 5, 25, 347, 'Rwempasha'),
(1817, 5, 25, 347, 'Ryeru'),
(1818, 5, 25, 348, 'Gacundezi'),
(1819, 5, 25, 348, 'Kabeza'),
(1820, 5, 25, 348, 'Kirebe'),
(1821, 5, 25, 348, 'Ntoma'),
(1822, 5, 25, 348, 'Nyarupfubire'),
(1823, 5, 25, 348, 'Nyendo'),
(1824, 5, 25, 348, 'Rutungu'),
(1825, 5, 25, 348, 'Rwimiyaga'),
(1826, 5, 25, 349, 'Gishuro'),
(1827, 5, 25, 349, 'Gitengure'),
(1828, 5, 25, 349, 'Nkoma'),
(1829, 5, 25, 349, 'Nyabitekeri'),
(1830, 5, 25, 349, 'Nyagatoma'),
(1831, 5, 25, 349, 'Shonga'),
(1832, 5, 25, 349, 'Tabagwe'),
(1833, 5, 26, 350, 'Kigabiro'),
(1834, 5, 26, 350, 'Kimana'),
(1835, 5, 26, 350, 'Teme'),
(1836, 5, 26, 350, 'Viro'),
(1837, 5, 26, 351, 'Gatsibo'),
(1838, 5, 26, 351, 'Manishya'),
(1839, 5, 26, 351, 'Mugera'),
(1840, 5, 26, 351, 'Nyabicwamba'),
(1841, 5, 26, 351, 'Nyagahanga'),
(1842, 5, 26, 352, 'Bukomane'),
(1843, 5, 26, 352, 'Cyabusheshe'),
(1844, 5, 26, 352, 'Karubungo'),
(1845, 5, 26, 352, 'Mpondwa'),
(1846, 5, 26, 352, 'Nyamirama'),
(1847, 5, 26, 352, 'Rubira'),
(1848, 5, 26, 353, 'Kabarore'),
(1849, 5, 26, 353, 'Kabeza'),
(1850, 5, 26, 353, 'Karenge'),
(1851, 5, 26, 353, 'Marimba'),
(1852, 5, 26, 353, 'Nyabikiri'),
(1853, 5, 26, 353, 'Simbwa'),
(1854, 5, 26, 354, 'Busetsa'),
(1855, 5, 26, 354, 'Gituza'),
(1856, 5, 26, 354, 'Kintu'),
(1857, 5, 26, 354, 'Nyagisozi'),
(1858, 5, 26, 355, 'Akabuga'),
(1859, 5, 26, 355, 'Gakenke'),
(1860, 5, 26, 355, 'Gakoni'),
(1861, 5, 26, 355, 'Nyabisindu'),
(1862, 5, 26, 356, 'Agakomeye'),
(1863, 5, 26, 356, 'Mbogo'),
(1864, 5, 26, 356, 'Ndatemwa'),
(1865, 5, 26, 356, 'Rubona'),
(1866, 5, 26, 357, 'Bibare'),
(1867, 5, 26, 357, 'Gakorokombe'),
(1868, 5, 26, 357, 'Mamfu'),
(1869, 5, 26, 357, 'Rumuli'),
(1870, 5, 26, 357, 'Taba'),
(1871, 5, 26, 358, 'Murambi'),
(1872, 5, 26, 358, 'Nyamiyaga'),
(1873, 5, 26, 358, 'Rwankuba'),
(1874, 5, 26, 358, 'Rwimitereri'),
(1875, 5, 26, 359, 'Bugamba'),
(1876, 5, 26, 359, 'Karambi'),
(1877, 5, 26, 359, 'Kigasha'),
(1878, 5, 26, 359, 'Ngarama'),
(1879, 5, 26, 359, 'Nyarubungo'),
(1880, 5, 26, 360, 'Gitinda'),
(1881, 5, 26, 360, 'Kibare'),
(1882, 5, 26, 360, 'Mayange'),
(1883, 5, 26, 360, 'Murambi'),
(1884, 5, 26, 360, 'Nyagitabire'),
(1885, 5, 26, 360, 'Nyamirama'),
(1886, 5, 26, 361, 'Bushobora'),
(1887, 5, 26, 361, 'Butiruka'),
(1888, 5, 26, 361, 'Kigabiro'),
(1889, 5, 26, 361, 'Nyagakombe'),
(1890, 5, 26, 361, 'Rurenge'),
(1891, 5, 26, 361, 'Rwarenga'),
(1892, 5, 26, 362, 'Bugarama'),
(1893, 5, 26, 362, 'Gihuta'),
(1894, 5, 26, 362, 'Kanyangese'),
(1895, 5, 26, 362, 'Matare'),
(1896, 5, 26, 362, 'Matunguru'),
(1897, 5, 26, 362, 'Remera'),
(1898, 5, 26, 363, 'Kiburara'),
(1899, 5, 26, 363, 'Munini'),
(1900, 5, 26, 363, 'Nyamatete'),
(1901, 5, 26, 363, 'Rwikiniro'),
(1902, 5, 27, 364, 'Juru'),
(1903, 5, 27, 364, 'Kahi'),
(1904, 5, 27, 364, 'Kiyenzi'),
(1905, 5, 27, 364, 'Urugarama'),
(1906, 5, 27, 365, 'Cyarubare'),
(1907, 5, 27, 365, 'Gitara'),
(1908, 5, 27, 365, 'Kirehe'),
(1909, 5, 27, 365, 'Rubimba'),
(1910, 5, 27, 365, 'Rubumba'),
(1911, 5, 27, 366, 'Cyabajwa'),
(1912, 5, 27, 366, 'Cyinzovu'),
(1913, 5, 27, 366, 'Kabura'),
(1914, 5, 27, 366, 'Rusera'),
(1915, 5, 27, 367, 'Bwiza'),
(1916, 5, 27, 367, 'Kayonza'),
(1917, 5, 27, 367, 'Mburabuturo'),
(1918, 5, 27, 367, 'Nyagatovu'),
(1919, 5, 27, 367, 'Rugendabari'),
(1920, 5, 27, 368, 'Bunyentongo'),
(1921, 5, 27, 368, 'Muko'),
(1922, 5, 27, 368, 'Murama'),
(1923, 5, 27, 368, 'Nyakanazi'),
(1924, 5, 27, 368, 'Rusave'),
(1925, 5, 27, 369, 'Buhabwa'),
(1926, 5, 27, 369, 'Karambi'),
(1927, 5, 27, 369, 'Murundi'),
(1928, 5, 27, 369, 'Ryamanyoni'),
(1929, 5, 27, 370, 'Kageyo'),
(1930, 5, 27, 370, 'Migera'),
(1931, 5, 27, 370, 'Nyamugari'),
(1932, 5, 27, 370, 'Nyawera'),
(1933, 5, 27, 371, 'Byimana'),
(1934, 5, 27, 371, 'Isangano'),
(1935, 5, 27, 371, 'Karambi'),
(1936, 5, 27, 371, 'Kiyovu'),
(1937, 5, 27, 372, 'Gikaya'),
(1938, 5, 27, 372, 'Musumba'),
(1939, 5, 27, 372, 'Rurambi'),
(1940, 5, 27, 372, 'Shyogo'),
(1941, 5, 27, 373, 'Kawangire'),
(1942, 5, 27, 373, 'Rukara'),
(1943, 5, 27, 373, 'Rwimishinya'),
(1944, 5, 27, 374, 'Bugambira'),
(1945, 5, 27, 374, 'Nkamba'),
(1946, 5, 27, 374, 'Ruyonza'),
(1947, 5, 27, 374, 'Umubuga'),
(1948, 5, 27, 375, 'Gihinga'),
(1949, 5, 27, 375, 'Mbarara'),
(1950, 5, 27, 375, 'Mukoyoyo'),
(1951, 5, 27, 375, 'Nkondo'),
(1952, 5, 28, 376, 'Butezi'),
(1953, 5, 28, 376, 'Muhamba'),
(1954, 5, 28, 376, 'Murehe'),
(1955, 5, 28, 376, 'Nyagasenyi'),
(1956, 5, 28, 376, 'Nyakagezi'),
(1957, 5, 28, 376, 'Rubimba'),
(1958, 5, 28, 377, 'Curazo'),
(1959, 5, 28, 377, 'Cyunuzi'),
(1960, 5, 28, 377, 'Muganza'),
(1961, 5, 28, 377, 'Nyamiryango'),
(1962, 5, 28, 377, 'Rwabutazi'),
(1963, 5, 28, 377, 'Rwantonde'),
(1964, 5, 28, 378, 'Cyanya'),
(1965, 5, 28, 378, 'Kigarama'),
(1966, 5, 28, 378, 'Kiremera'),
(1967, 5, 28, 378, 'Nyakerera'),
(1968, 5, 28, 378, 'Nyankurazo'),
(1969, 5, 28, 379, 'Gatarama'),
(1970, 5, 28, 379, 'Rugarama'),
(1971, 5, 28, 379, 'Ruhanga'),
(1972, 5, 28, 379, 'Rwanteru'),
(1973, 5, 28, 380, 'Gahama'),
(1974, 5, 28, 380, 'Kirehe'),
(1975, 5, 28, 380, 'Nyabigega'),
(1976, 5, 28, 380, 'Nyabikokora'),
(1977, 5, 28, 380, 'Rwesero'),
(1978, 5, 28, 381, 'Kamombo'),
(1979, 5, 28, 381, 'Mwoga'),
(1980, 5, 28, 381, 'Saruhembe'),
(1981, 5, 28, 381, 'Umunini'),
(1982, 5, 28, 382, 'Bwiyorere'),
(1983, 5, 28, 382, 'Kankobwa'),
(1984, 5, 28, 382, 'Mpanga'),
(1985, 5, 28, 382, 'Mushongi'),
(1986, 5, 28, 382, 'Nasho'),
(1987, 5, 28, 382, 'Nyakabungo'),
(1988, 5, 28, 382, 'Rubaya'),
(1989, 5, 28, 383, 'Gasarabwayi'),
(1990, 5, 28, 383, 'Kabuga'),
(1991, 5, 28, 383, 'Mubuga'),
(1992, 5, 28, 383, 'Musaza'),
(1993, 5, 28, 383, 'Nganda'),
(1994, 5, 28, 384, 'Bisagara'),
(1995, 5, 28, 384, 'Cyamigurwa'),
(1996, 5, 28, 384, 'Rugarama'),
(1997, 5, 28, 384, 'Rwanyamuhanga'),
(1998, 5, 28, 384, 'Rwayikona'),
(1999, 5, 28, 385, 'Cyambwe'),
(2000, 5, 28, 385, 'Kagese'),
(2001, 5, 28, 385, 'Ntaruka'),
(2002, 5, 28, 385, 'Rubirizi'),
(2003, 5, 28, 385, 'Rugoma'),
(2004, 5, 28, 386, 'Bukora'),
(2005, 5, 28, 386, 'Kagasa'),
(2006, 5, 28, 386, 'Kazizi'),
(2007, 5, 28, 386, 'Kiyanzi'),
(2008, 5, 28, 386, 'Nyamugari'),
(2009, 5, 28, 387, 'Mareba'),
(2010, 5, 28, 387, 'Nyabitare'),
(2011, 5, 28, 387, 'Nyarutunga'),
(2012, 5, 29, 388, 'Cyerwa'),
(2013, 5, 29, 388, 'Giseri'),
(2014, 5, 29, 388, 'Munege'),
(2015, 5, 29, 388, 'Mutsindo'),
(2016, 5, 29, 389, 'Ihanika'),
(2017, 5, 29, 389, 'Jarama'),
(2018, 5, 29, 389, 'Karenge'),
(2019, 5, 29, 389, 'Kibimba'),
(2020, 5, 29, 389, 'Kigoma'),
(2021, 5, 29, 390, 'Akaziba'),
(2022, 5, 29, 390, 'Karaba'),
(2023, 5, 29, 390, 'Nyamirambo'),
(2024, 5, 29, 391, 'Birenga'),
(2025, 5, 29, 391, 'Gahurire'),
(2026, 5, 29, 391, 'Karama'),
(2027, 5, 29, 391, 'Kinyonzo'),
(2028, 5, 29, 391, 'Umukamba'),
(2029, 5, 29, 392, 'Cyasemakamba'),
(2030, 5, 29, 392, 'Gahima'),
(2031, 5, 29, 392, 'Gatonde'),
(2032, 5, 29, 392, 'Karenge'),
(2033, 5, 29, 392, 'Mahango'),
(2034, 5, 29, 393, 'Akabungo'),
(2035, 5, 29, 393, 'Mugatare'),
(2036, 5, 29, 393, 'Ntanga'),
(2037, 5, 29, 393, 'Nyamugari'),
(2038, 5, 29, 393, 'Nyange'),
(2039, 5, 29, 394, 'Gitaraga'),
(2040, 5, 29, 394, 'Kigabiro'),
(2041, 5, 29, 394, 'Mvumba'),
(2042, 5, 29, 394, 'Rurenge'),
(2043, 5, 29, 394, 'Sakara'),
(2044, 5, 29, 395, 'Karwema'),
(2045, 5, 29, 395, 'Kibare'),
(2046, 5, 29, 395, 'Mutenderi'),
(2047, 5, 29, 395, 'Muzingira'),
(2048, 5, 29, 395, 'Nyagasozi'),
(2049, 5, 29, 396, 'Bugera'),
(2050, 5, 29, 396, 'Kinunga'),
(2051, 5, 29, 396, 'Ndekwe'),
(2052, 5, 29, 396, 'Nyamagana'),
(2053, 5, 29, 397, 'Buliba'),
(2054, 5, 29, 397, 'Kibatsi'),
(2055, 5, 29, 397, 'Nyaruvumu'),
(2056, 5, 29, 397, 'Nyinya'),
(2057, 5, 29, 398, 'Gituza'),
(2058, 5, 29, 398, 'Ntovi'),
(2059, 5, 29, 398, 'Rubago'),
(2060, 5, 29, 398, 'Rubona'),
(2061, 5, 29, 398, 'Rwintashya'),
(2062, 5, 29, 399, 'Akagarama'),
(2063, 5, 29, 399, 'Muhurire'),
(2064, 5, 29, 399, 'Musya'),
(2065, 5, 29, 399, 'Rugese'),
(2066, 5, 29, 399, 'Rujambara'),
(2067, 5, 29, 399, 'Rwikubo'),
(2068, 5, 29, 400, 'Gafunzo'),
(2069, 5, 29, 400, 'Kibonde'),
(2070, 5, 29, 400, 'Nkanga'),
(2071, 5, 29, 400, 'Rukoma'),
(2072, 5, 29, 401, 'Nyagasozi'),
(2073, 5, 29, 401, 'Nyagatugunda'),
(2074, 5, 29, 401, 'Ruhembe'),
(2075, 5, 29, 401, 'Ruhinga'),
(2076, 5, 30, 402, 'Biryogo'),
(2077, 5, 30, 402, 'Kabuye'),
(2078, 5, 30, 402, 'Kagomasi'),
(2079, 5, 30, 402, 'Mwendo'),
(2080, 5, 30, 402, 'Ramiro'),
(2081, 5, 30, 403, 'Juru'),
(2082, 5, 30, 403, 'Kabukuba'),
(2083, 5, 30, 403, 'Mugorore'),
(2084, 5, 30, 403, 'Musovu'),
(2085, 5, 30, 403, 'Rwinume'),
(2086, 5, 30, 404, 'Biharagu'),
(2087, 5, 30, 404, 'Burenge'),
(2088, 5, 30, 404, 'Kampeka'),
(2089, 5, 30, 404, 'Nyakayaga'),
(2090, 5, 30, 404, 'Tunda'),
(2091, 5, 30, 405, 'Bushenyi'),
(2092, 5, 30, 405, 'Gakomeye'),
(2093, 5, 30, 405, 'Nyamigina'),
(2094, 5, 30, 405, 'Rango'),
(2095, 5, 30, 405, 'Rugarama'),
(2096, 5, 30, 406, 'Gakamba'),
(2097, 5, 30, 406, 'Kagenge'),
(2098, 5, 30, 406, 'Kibenga'),
(2099, 5, 30, 406, 'Kibirizi'),
(2100, 5, 30, 406, 'Mbyo'),
(2101, 5, 30, 407, 'Gicaca'),
(2102, 5, 30, 407, 'Musenyi'),
(2103, 5, 30, 407, 'Nyagihunika'),
(2104, 5, 30, 407, 'Rulindo'),
(2105, 5, 30, 408, 'Bitaba'),
(2106, 5, 30, 408, 'Kagasa'),
(2107, 5, 30, 408, 'Rugunga'),
(2108, 5, 30, 408, 'Rurenge'),
(2109, 5, 30, 409, 'Gihembe'),
(2110, 5, 30, 409, 'Murama'),
(2111, 5, 30, 409, 'Ngeruka'),
(2112, 5, 30, 409, 'Nyakayenzi'),
(2113, 5, 30, 409, 'Rutonde'),
(2114, 5, 30, 410, 'Cyugaro'),
(2115, 5, 30, 410, 'Kanzenze'),
(2116, 5, 30, 410, 'Kibungo'),
(2117, 5, 30, 411, 'Kanazi'),
(2118, 5, 30, 411, 'Kayumba'),
(2119, 5, 30, 411, 'Maranyundo'),
(2120, 5, 30, 411, 'Murama'),
(2121, 5, 30, 411, 'Nyamata y Umujyi'),
(2122, 5, 30, 412, 'Gihinga'),
(2123, 5, 30, 412, 'Kabuye'),
(2124, 5, 30, 412, 'Murambi'),
(2125, 5, 30, 412, 'Ngenda'),
(2126, 5, 30, 412, 'Rugando'),
(2127, 5, 30, 413, 'Kabeza'),
(2128, 5, 30, 413, 'Karera'),
(2129, 5, 30, 413, 'Kimaranzara'),
(2130, 5, 30, 413, 'Ntarama'),
(2131, 5, 30, 413, 'Nyabagendwa'),
(2132, 5, 30, 414, 'Bihari'),
(2133, 5, 30, 414, 'Gatanga'),
(2134, 5, 30, 414, 'Gikundamvura'),
(2135, 5, 30, 414, 'Kindama'),
(2136, 5, 30, 414, 'Ruhuha'),
(2137, 5, 30, 415, 'Batima'),
(2138, 5, 30, 415, 'Kintambwe'),
(2139, 5, 30, 415, 'Mazane'),
(2140, 5, 30, 415, 'Nemba'),
(2141, 5, 30, 415, 'Nkanga'),
(2142, 5, 30, 415, 'Sharita'),
(2143, 5, 30, 416, 'Kabagugu'),
(2144, 5, 30, 416, 'Kamabuye'),
(2145, 5, 30, 416, 'Nziranziza'),
(2146, 5, 30, 416, 'Rebero'),
(2147, 5, 30, 416, 'Rutare');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_company`
--

CREATE TABLE `fluid_company` (
  `id` int(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `tin_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `live` int(250) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_company`
--

INSERT INTO `fluid_company` (`id`, `company_name`, `tin_number`, `email`, `location`, `live`) VALUES
(5, 'ALGORITHM', '101909872', 'kimainyi@gmail.com', 'KIMIHURURA', 1),
(6, 'KAURWA LTD', '10317279', 'kaurwaltd@gmail.com', 'KIMIRONKO', 1),
(7, 'linkmeon', '12345679', 'sezeranochrisostom123@gmail.com', 'kigali', 0),
(8, 'new nation', '1019098722', 'eamo@gmail.com', 'kimironko', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_depart`
--

CREATE TABLE `fluid_depart` (
  `id` int(200) NOT NULL,
  `id_place1` int(200) NOT NULL,
  `departure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_sector1` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fluid_departments`
--

CREATE TABLE `fluid_departments` (
  `id` int(11) NOT NULL,
  `id_subcompany` int(11) DEFAULT NULL,
  `name_dep` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_departments`
--

INSERT INTO `fluid_departments` (`id`, `id_subcompany`, `name_dep`) VALUES
(1, 3, 'dev'),
(2, 3, 'support'),
(3, 3, 'sales'),
(4, 3, 'Customer issues'),
(5, 4, 'Distribution'),
(6, 4, 'Importation');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_distance`
--

CREATE TABLE `fluid_distance` (
  `id` int(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_sector0` int(255) NOT NULL,
  `id_sectorf` int(255) NOT NULL,
  `kilometers` decimal(55,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_distance`
--

INSERT INTO `fluid_distance` (`id`, `id_user`, `id_sector0`, `id_sectorf`, `kilometers`) VALUES
(1, NULL, 9, 8, '5'),
(2, NULL, 9, 14, '7'),
(3, NULL, 12, 8, '7'),
(4, NULL, 12, 4, '10'),
(5, NULL, 17, 9, '10'),
(6, NULL, 9, 1, '5'),
(7, NULL, 17, 19, '7'),
(8, NULL, 19, 1, '6'),
(9, NULL, 19, 15, '5'),
(10, NULL, 8, 9, '5'),
(11, NULL, 14, 9, '7'),
(12, NULL, 8, 12, '7'),
(13, NULL, 4, 12, '10'),
(14, NULL, 9, 17, '10'),
(15, NULL, 1, 9, '5'),
(16, NULL, 19, 17, '7'),
(17, NULL, 1, 19, '6'),
(18, NULL, 15, 19, '5'),
(19, NULL, 9, 15, '12'),
(20, NULL, 18, 19, '3'),
(21, NULL, 19, 18, '3'),
(22, NULL, 19, 9, '14'),
(23, NULL, 9, 19, '14'),
(24, NULL, 9, 18, '7'),
(25, NULL, 18, 9, '7'),
(26, NULL, 18, 19, '1'),
(27, NULL, 19, 18, '1'),
(28, NULL, 23, 8, '11'),
(29, NULL, 8, 23, '11'),
(30, NULL, 18, 418, '16'),
(31, NULL, 418, 18, '16'),
(32, NULL, 18, 14, '7'),
(33, NULL, 14, 18, '7'),
(34, NULL, 14, 9, '11'),
(35, NULL, 9, 14, '11'),
(101, NULL, 8, 17, '10'),
(102, NULL, 17, 8, '10'),
(103, NULL, 18, 31, '4'),
(104, NULL, 31, 18, '7'),
(105, 28, 7, 16, '200'),
(106, 61, 31, 135, '900'),
(107, 61, 1, 12, '900'),
(108, 61, 135, 31, '800'),
(109, 22, 9, 396, '8'),
(110, 1, 9, 9, '10'),
(111, 73, 166, 31, '162'),
(112, 73, 31, 166, '162'),
(113, 73, 166, 74, '272'),
(114, 73, 31, 74, '132'),
(115, 73, 31, 81, '98'),
(116, 73, 31, 275, '98'),
(117, 73, 31, 52, '260'),
(118, 73, 31, 198, '133'),
(119, 73, 31, 338, '158'),
(120, 73, 166, 81, '262'),
(121, 73, 166, 275, '65'),
(122, 73, 166, 52, '98'),
(123, 73, 166, 198, '50'),
(124, 73, 166, 338, '320'),
(125, 73, 166, 303, '214'),
(126, 73, 166, 181, '41'),
(127, 73, 166, 190, '67'),
(128, 73, 31, 303, '70'),
(129, 73, 166, 188, '110'),
(130, 73, 166, 197, '95'),
(131, 73, 166, 278, '50'),
(132, 73, 166, 253, '95'),
(133, 73, 166, 125, '175'),
(134, 73, 166, 117, '198'),
(135, 73, 166, 105, '208'),
(136, 73, 166, 112, '223'),
(137, 73, 166, 57, '242'),
(138, 73, 166, 53, '301'),
(139, 73, 166, 324, '215'),
(140, 73, 166, 310, '231'),
(141, 73, 166, 12, '163'),
(142, 73, 166, 248, '174'),
(143, 73, 166, 355, '252'),
(144, 73, 166, 411, '188'),
(145, 73, 166, 418, '179'),
(146, 73, 166, 88, '247'),
(147, 1, 9, 412, '10'),
(148, 28, 17, 14, '13'),
(149, 22, 18, 168, '26'),
(150, 22, 9, 168, '21'),
(151, 22, 31, 4, '18'),
(152, 22, 31, 396, '5'),
(153, 22, 18, 396, '7'),
(154, 22, 18, 233, '7'),
(155, 22, 23, 18, '7'),
(156, 22, 396, 18, '7'),
(157, 22, 17, 18, '4'),
(158, 22, 168, 9, '21'),
(159, 22, 18, 23, '5'),
(160, 22, 23, 19, '3'),
(161, 22, 233, 233, '8'),
(162, 22, 412, 18, '7'),
(163, 22, 168, 412, '23'),
(164, 22, 31, 361, '5'),
(165, 22, 18, 412, '7'),
(166, 22, 23, 9, '2'),
(167, 83, 31, 19, '7'),
(168, 83, 18, 17, '3'),
(169, 83, 18, 8, '9'),
(170, 83, 412, 31, '3'),
(171, 22, 19, 412, '8'),
(172, 22, 412, 9, '3'),
(173, 22, 233, 18, '4'),
(174, 83, 19, 14, '10'),
(175, 83, 14, 8, '11'),
(176, 83, 8, 28, '7'),
(177, 83, 28, 35, '7'),
(178, 83, 233, 35, '17'),
(179, 83, 18, 35, '12'),
(180, 22, 35, 233, '18'),
(181, 22, 278, 18, '54'),
(182, 22, 18, 278, '54'),
(183, 22, 233, 11, '8'),
(184, 22, 8, 18, '10'),
(185, 83, 18, 28, '6'),
(186, 83, 28, 412, '5'),
(187, 83, 412, 8, '6'),
(188, 83, 8, 4, '3'),
(189, 83, 4, 18, '9'),
(190, 22, 396, 19, '3'),
(191, 22, 18, 30, '7'),
(192, 22, 35, 18, '8'),
(193, 22, 19, 396, '7'),
(194, 22, 396, 9, '8'),
(195, 22, 412, 396, '8'),
(196, 22, 9, 23, '8'),
(197, 22, 23, 35, '7'),
(198, 28, 11, 396, '4'),
(199, 28, 396, 20, '10'),
(200, 83, 396, 28, '8'),
(201, 83, 28, 396, '8'),
(202, 83, 9, 418, '23'),
(203, 22, 8, 396, '7'),
(204, 22, 412, 412, '5'),
(205, 22, 412, 19, '8'),
(206, 22, 278, 412, '54'),
(207, 22, 412, 14, '13'),
(208, 22, 31, 412, '10'),
(209, 22, 18, 361, '5'),
(210, 22, 361, 18, '5'),
(211, 22, 396, 3, '4'),
(212, 22, 412, 168, '23'),
(213, 22, 396, 396, '4'),
(214, 22, 23, 412, '8'),
(215, 22, 19, 31, '7'),
(216, 22, 17, 28, '8'),
(217, 22, 28, 31, '11'),
(218, 22, 18, 34, '4'),
(219, 22, 412, 17, '10'),
(220, 22, 412, 411, '22'),
(221, 22, 18, 27, '6'),
(222, 22, 1, 18, '8'),
(223, 22, 412, 27, '8'),
(224, 22, 233, 412, '8'),
(225, 1, 18, 411, '26'),
(226, 1, 23, 127, '7'),
(227, 22, 233, 19, '5'),
(228, 22, 233, 281, '5'),
(229, 22, 18, 18, '5'),
(230, 22, 9, 30, '8'),
(231, 22, 233, 17, '8'),
(232, 22, 18, 281, '5'),
(233, 22, 396, 30, '11'),
(234, 22, 9, 411, '24'),
(235, 22, 281, 18, '4'),
(236, 22, 27, 9, '10'),
(237, 22, 411, 18, '26'),
(238, 22, 396, 411, '26'),
(239, 22, 411, 396, '26'),
(240, 83, 412, 278, '49'),
(241, 83, 412, 1, '7'),
(242, 22, 31, 233, '8'),
(243, 22, 27, 18, '10'),
(244, 22, 396, 27, '10'),
(245, 1, 18, 11, '12'),
(246, 22, 14, 233, '10'),
(247, 22, 23, 31, '7'),
(248, 22, 23, 17, '7'),
(249, 22, 412, 361, '8'),
(250, 22, 19, 28, '10'),
(251, 22, 28, 17, '10'),
(252, 22, 9, 35, '10'),
(253, 22, 6, 19, '10'),
(254, 22, 9, 281, '8'),
(255, 22, 31, 14, '12'),
(256, 22, 396, 412, '10'),
(257, 28, 28, 233, '10'),
(258, 83, 18, 7, '10'),
(259, 83, 7, 30, '13'),
(260, 83, 7, 18, '9'),
(261, 83, 9, 233, '7'),
(262, 83, 412, 11, '10'),
(263, 83, 23, 233, '5'),
(264, 83, 233, 23, '5'),
(265, 21, 8, 3, '10'),
(266, 22, 412, 271, '10'),
(267, 22, 14, 396, '9'),
(268, 22, 8, 31, '10'),
(269, 22, 23, 14, '10'),
(270, 22, 31, 11, '10'),
(271, 22, 28, 18, '10'),
(272, 22, 30, 18, '6'),
(273, 22, 30, 233, '6'),
(274, 22, 9, 31, '7'),
(275, 22, 18, 1, '8');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_district`
--

CREATE TABLE `fluid_district` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_district`
--

INSERT INTO `fluid_district` (`id`, `province_id`, `name`) VALUES
(1, 1, 'Nyarugenge'),
(2, 1, 'Gasabo'),
(3, 1, 'Kicukiro'),
(4, 2, 'Nyanza'),
(5, 2, 'Gisagara'),
(6, 2, 'Nyaruguru'),
(7, 2, 'Huye'),
(8, 2, 'Nyamagabe'),
(9, 2, 'Ruhango'),
(10, 2, 'Muhanga'),
(11, 2, 'Kamonyi'),
(12, 3, 'Karongi'),
(13, 3, 'Rutsiro'),
(14, 3, 'Rubavu'),
(15, 3, 'Nyabihu'),
(16, 3, 'Ngororero'),
(17, 3, 'Rusizi'),
(18, 3, 'Nyamasheke'),
(19, 4, 'Rulindo'),
(20, 4, 'Gakenke'),
(21, 4, 'Musanze'),
(22, 4, 'Burera'),
(23, 4, 'Gicumbi'),
(24, 5, 'Rwamagana'),
(25, 5, 'Nyagatare'),
(26, 5, 'Gatsibo'),
(27, 5, 'Kayonza'),
(28, 5, 'Kirehe'),
(29, 5, 'Ngoma'),
(30, 5, 'Bugesera');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_driver`
--

CREATE TABLE `fluid_driver` (
  `id` int(11) NOT NULL,
  `full_name` varchar(11) NOT NULL,
  `driving_licence` varchar(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fluid_driver_avail`
--

CREATE TABLE `fluid_driver_avail` (
  `id` int(11) NOT NULL,
  `from_time` varchar(250) DEFAULT NULL,
  `to_time` varchar(250) DEFAULT NULL,
  `live` int(11) DEFAULT '1',
  `discription` varchar(250) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_driver_avail`
--

INSERT INTO `fluid_driver_avail` (`id`, `from_time`, `to_time`, `live`, `discription`, `creator`) VALUES
(1, '2020-07-27 02:52', '2020-07-28 03:52', 1, 'wzexrctvybun', 75),
(2, '2020-07-28 01:52', '2020-07-13 10:56', 1, 'ZWxecrtvbynum', 75),
(3, '2020-07-28 02:53', '2020-07-28 01:53', 1, 'qWZexrctvybunim', 75),
(5, '2020-07-29 12:35', '2020-07-29 17:35', 1, 'car is taken by boos', 75),
(6, '2020-07-30 17:00', '2020-07-30 19:03', 1, 'car is taken', 75),
(7, '2020-07-31 12:00', '2020-07-31 14:00', 1, 'taken', 75),
(8, '2020-08-01 08:00', '2020-08-01 18:00', 1, 'car is taken all day', 75),
(9, '2020-08-02 14:30', '2020-08-07 20:37', 0, 'qwertyuiopasdfjklZxcvbnm', 1),
(10, '2020-08-03 08:44', '2020-08-03 18:00', 0, 'zwexrctvybunimo', 75),
(11, '2020-08-04 11:00', '2020-08-04 16:00', 0, 'car is ta', 1),
(12, '2020-08-05 00:10', '2020-08-05 18:14', 0, 'gasjdbfbksdbf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_driver_logs`
--

CREATE TABLE `fluid_driver_logs` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `date_log` varchar(50) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `live` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_driver_logs`
--

INSERT INTO `fluid_driver_logs` (`id`, `driver_id`, `date_log`, `car_id`, `live`) VALUES
(13, 75, '2020-08-05 15:08', 3, 1),
(14, 75, '2020-08-06 09:08', 2, 1),
(15, 152, '2020-08-07 12:08', 2, 1),
(16, 152, '2020-08-08 10:08', 2, 1),
(17, 152, '2020-08-10 15:08', 2, 1),
(18, 152, '2020-08-11 11:08', 2, 1),
(19, 93, '2020-08-11 15:08', 3, 1),
(22, 152, '2020-08-12 14:08', 3, 1),
(23, 93, '2020-08-12 14:08', 2, 1),
(24, 152, '2020-08-18 17:08', 2, 1),
(25, 152, '2020-08-19 07:08', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_kms`
--

CREATE TABLE `fluid_kms` (
  `id` int(11) NOT NULL,
  `id_subcompany` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `theday` datetime NOT NULL,
  `initial` decimal(10,0) NOT NULL,
  `lefton` decimal(10,0) DEFAULT NULL,
  `picture` varchar(200) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_kms`
--

INSERT INTO `fluid_kms` (`id`, `id_subcompany`, `id_car`, `theday`, `initial`, `lefton`, `picture`, `amount`, `qty`) VALUES
(29, 3, 1, '2018-07-30 00:00:00', '0', '14', 'WhatsApp Image 2018-07-27 at 11.48.50.jpeg', NULL, NULL),
(30, 3, 2, '2018-07-27 00:00:00', '0', '10786', 'DOLCE&BELLA.jpg', NULL, NULL),
(31, 3, 1, '2018-08-13 00:00:00', '0', '26520', '', 4000, 3),
(32, 3, 1, '2018-08-10 00:00:00', '0', '20705', 'RECU ESSENCE.jpg', 5000, 2),
(33, 4, 15, '2018-08-05 00:00:00', '0', '10786', 'FAITH PHARMACY.jpeg', 35000, 16),
(34, 4, 19, '2018-09-05 00:00:00', '0', '9400', '', 5000, 3),
(35, 4, 20, '2018-09-06 00:00:00', '0', '10786', 'FAITH PHARMACY.jpeg', 45000, 59),
(36, 4, 16, '2018-09-06 00:00:00', '0', '10786', 'LA DIVINE-MULINDI.jpeg', 100000, 200),
(37, 4, 16, '2018-09-06 00:00:00', '0', '10786', 'LA DIVINE-MULINDI.jpeg', 100000, 200),
(38, 3, 1, '2018-07-06 00:00:00', '0', '16935', '', 5000, 5),
(39, 3, 2, '2018-10-10 00:00:00', '0', '27610', '10.10.jpg', 20000, 20),
(40, 3, 2, '2018-09-05 00:00:00', '0', '23368', '05.09.jpg', 10000, 10),
(41, 3, 2, '2018-09-15 00:00:00', '0', '24762', '15.09.jpg', 15000, 15),
(42, 3, 2, '2018-10-11 00:00:00', '0', '27710', '11.10.jpg', 36700, 36);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_km_count`
--

CREATE TABLE `fluid_km_count` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `id_place0` int(255) DEFAULT NULL,
  `id_placef` int(255) DEFAULT NULL,
  `live` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_km_count`
--

INSERT INTO `fluid_km_count` (`id`, `id_booking`, `id_place0`, `id_placef`, `live`) VALUES
(38, 1232, 1, 4, 1),
(39, 1233, 1, 3, 1),
(40, 1234, 1, 5, 1),
(41, 1235, 1, 2, 1),
(42, 1236, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_location`
--

CREATE TABLE `fluid_location` (
  `id` int(11) NOT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `longt` varchar(250) DEFAULT NULL,
  `artut` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fluid_notification_lead`
--

CREATE TABLE `fluid_notification_lead` (
  `id` int(11) NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  `live` int(11) DEFAULT '1',
  `userId` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_notification_lead`
--

INSERT INTO `fluid_notification_lead` (`id`, `note`, `live`, `userId`, `created_at`) VALUES
(1, 'UWERA, your booking have been confirmed', 0, 24, '2020-08-18'),
(2, 'UWERA, your booking have been completed  by Gilles and on 2020-08-18  05:08:19', 0, 24, '2020-08-18  05:08:19'),
(3, ', your booking have been rejected  by Gilles and on 2020-08-18  06:08:51', 1, NULL, '2020-08-18  06:08:51'),
(4, 'UWERA, your booking have been rejected  by Gilles and on 2020-08-18  06:08:37', 0, 24, '2020-08-18  06:08:37'),
(5, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  07:08:23'),
(6, 'UWERA, your booking have been started  by Gilles ', 0, 24, '2020-08-19 07:08:51'),
(7, 'UWERA, your booking have been completed  by Gilles ', 0, 24, '2020-08-19  07:08:18'),
(8, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  07:08:23'),
(9, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  07:08:53'),
(10, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  08:08:51'),
(11, 'UWERA, your booking have been started  by Gilles ', 0, 24, '2020-08-19 08:08:39'),
(12, 'UWERA, your booking have been completed  by Gilles ', 0, 24, '2020-08-19  08:08:49'),
(13, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  09:08:00'),
(14, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  09:08:53'),
(15, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  09:08:03'),
(16, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  10:08:33'),
(17, 'UWERA, your booking have been started  by Gilles ', 0, 24, '2020-08-19 10:08:20'),
(18, 'UWERA, your booking have been completed  by Gilles ', 0, 24, '2020-08-19  10:08:50'),
(19, 'UWERA, your booking have been started  by Gilles ', 0, 24, '2020-08-19 10:08:34'),
(20, 'UWERA, your booking have been completed  by Gilles ', 0, 24, '2020-08-19  10:08:42'),
(21, 'UWERA, your booking have been confirmed  by Gilles :) ', 0, 24, '2020-08-19  10:08:36'),
(22, 'UWERA, your booking have been started  by Gilles ', 0, 24, '2020-08-19 10:08:41'),
(23, 'UWERA, your booking have been completed  by Gilles ', 0, 24, '2020-08-19  10:08:54'),
(24, 'UWERA, your booking have been confirmed  by Gilles :) ', 1, 24, '2020-08-19  10:08:01'),
(25, 'UWERA, your booking have been confirmed  by Gilles :) ', 1, 24, '2020-08-19  11:08:13'),
(26, 'UWERA, your booking have been started  by Gilles ', 1, 24, '2020-08-19 11:08:27'),
(27, 'UWERA, your booking have been completed  by Gilles ', 1, 24, '2020-08-19  11:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_place`
--

CREATE TABLE `fluid_place` (
  `id` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_sector0` int(200) NOT NULL,
  `street` int(11) DEFAULT NULL,
  `house_number` int(11) DEFAULT NULL,
  `aboutcontract` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_place`
--

INSERT INTO `fluid_place` (`id`, `id_user`, `name`, `id_sector0`, `street`, `house_number`, `aboutcontract`) VALUES
(1, 131, 'bunker', 18, NULL, NULL, ''),
(2, 131, 'ABIRWA PHARMACY Siege', 23, NULL, NULL, ''),
(3, 131, 'AKEDAH Siege', 411, NULL, NULL, ''),
(4, 131, 'ALLIANCE PHARMACY Siege', 6, NULL, NULL, ''),
(5, 131, 'ALLIMED Siege', 31, NULL, NULL, ''),
(6, 131, 'ALVARUS Siege', 9, NULL, NULL, ''),
(7, 131, 'APOTHECARY PHARMACY Siege', 418, NULL, NULL, ''),
(8, 131, 'AXIS Siege', 419, NULL, NULL, ''),
(9, 131, 'AYIBAMBE PHARMACIE Siege', 418, NULL, NULL, ''),
(10, 131, 'BENI Siege', 17, NULL, NULL, ''),
(11, 131, 'BETHZATHA Siege', 34, NULL, NULL, ''),
(12, 131, 'BONITAS Siege', 14, NULL, NULL, ''),
(13, 131, 'BON SAMARITAIN Siege', 74, NULL, NULL, ''),
(14, 131, 'BORA Siege', 12, NULL, NULL, ''),
(15, 131, 'BORANYAKABANDA', 9, NULL, NULL, ''),
(16, 131, 'CIVITAS HOTEL LTD Siege', 23, NULL, NULL, ''),
(17, 131, 'CONFIDENCE Siege', 14, NULL, NULL, ''),
(18, 131, 'CONSEIL KACYIRU', 17, NULL, NULL, ''),
(19, 131, 'CONSEIL Siege', 9, NULL, NULL, ''),
(20, 131, 'CROIX DU SUD Siege', 23, NULL, NULL, ''),
(21, 131, 'DELIGHT Siege', 23, NULL, NULL, ''),
(22, 131, 'DELIZA Siege', 4, NULL, NULL, ''),
(23, 131, 'DEPHAR Siege', 31, NULL, NULL, ''),
(24, 131, 'DEUPHAR Siege', 31, NULL, NULL, ''),
(25, 131, 'AFRICA MEDICAL SUPPLIER Siege', 9, NULL, NULL, ''),
(26, 131, 'AGA PHARMACEUTICAL Siege', 9, NULL, NULL, ''),
(27, 131, 'AGROTECH Siege', 9, NULL, NULL, ''),
(28, 131, ' KIMIRONKO-NEW-VISION Siege', 19, NULL, NULL, ''),
(29, 131, 'AHA Siege', 1, NULL, NULL, ''),
(30, 131, 'ZOOM PHARMACY Siege', 14, NULL, NULL, ''),
(31, 131, 'DIGNE Siege', 23, NULL, NULL, ''),
(32, 131, 'DIRRITO Siege', 278, NULL, NULL, ''),
(33, 131, 'DOLCE&BELLA Siege', 23, NULL, NULL, ''),
(34, 131, 'DOMUS MARKET Siege', 20, NULL, NULL, ''),
(35, 131, 'DOVE Siege', 14, NULL, NULL, ''),
(36, 131, 'DUCALME Siege', 19, NULL, NULL, ''),
(37, 131, 'EASTGATE SUPERMARKET VILLE Siege', 9, NULL, NULL, ''),
(38, 131, 'EASTGATE SUPERMARKET-REMERA', 23, NULL, NULL, ''),
(41, 131, 'MEDIASOL  Siege', 35, NULL, NULL, ''),
(42, 131, 'UNIQUE Siege', 23, NULL, NULL, ''),
(43, 131, 'UMURAVA Siege', 9, NULL, NULL, ''),
(44, 131, 'PHARMACIE FIDELE Siege', 9, NULL, NULL, ''),
(45, 131, 'KAURWA LTD Siege', 19, NULL, NULL, ''),
(46, 131, 'DEPHAM Siege', 9, NULL, NULL, ''),
(47, 131, 'KAVES Siege', 19, NULL, NULL, ''),
(48, 131, 'SINA AIRPORT', 30, NULL, NULL, ''),
(49, 131, 'SINA DEPOT DOWNTOWN', 9, NULL, NULL, ''),
(50, 131, 'SINA DEPOT NYAMIRAMBO', 9, NULL, NULL, ''),
(51, 131, 'SINA DOWNTOWN ONE', 9, NULL, NULL, ''),
(52, 131, 'SINA DOWNTOWN TWO', 9, NULL, NULL, ''),
(53, 131, 'SINA GARE NYABUGOGO', 9, NULL, NULL, ''),
(54, 131, 'SINA HUYE', 74, NULL, NULL, ''),
(55, 131, 'SINA KIMIRONKO', 19, NULL, NULL, ''),
(56, 131, 'SINA KUMASHYIRAHAMWE', 9, NULL, NULL, ''),
(57, 131, 'SINA MAGERAGERE', 9, NULL, NULL, ''),
(58, 131, 'SINA MUHANGA', 117, NULL, NULL, ''),
(59, 131, 'SINA MUSANZE', 98, NULL, NULL, ''),
(60, 131, 'SINA NYAGATARE', 345, NULL, NULL, ''),
(61, 131, 'SINA NYAMIRAMBO', 9, NULL, NULL, ''),
(62, 131, 'SINA RESTO DOWNTOWN', 9, NULL, NULL, ''),
(63, 131, 'SINA RUBAVU ONE', 173, NULL, NULL, ''),
(64, 131, 'SINA RUBAVU TWO', 173, NULL, NULL, ''),
(65, 131, 'SINA SIEGE CENTRAL', 239, NULL, NULL, ''),
(66, 131, 'SINA UTC', 9, NULL, NULL, ''),
(67, 131, 'SINAPI Siege', 57, NULL, NULL, ''),
(68, 131, 'SINA PRISON', 9, NULL, NULL, ''),
(69, 131, 'SORAS Siege', 9, NULL, NULL, ''),
(70, 131, 'SINA SIEGE FAST FOOD', 233, NULL, NULL, ''),
(71, 131, 'SINA SIEGE KIMARANZARA', 233, NULL, NULL, ''),
(72, 131, 'SINA SIEGE ONE', 233, NULL, NULL, ''),
(73, 131, 'SINA SIEGE TWO', 233, NULL, NULL, ''),
(74, 131, 'SINA SIEGE RESTO VIP', 233, NULL, NULL, ''),
(75, 131, 'SINA KAYONZA', 266, NULL, NULL, ''),
(136, 131, 'Gisenyi (brasserie)', 166, NULL, NULL, 'YES'),
(137, 131, 'Butare(depot BRALIRWA)', 74, NULL, NULL, 'YES'),
(138, 131, 'Kibungo (depot BRALIRWA)', 81, NULL, NULL, 'YES'),
(139, 131, 'Ruhengeri (depot BRALIRWA)', 275, NULL, NULL, 'YES'),
(140, 131, 'Cyangungu (depot BRALIRWA)', 52, NULL, NULL, 'YES'),
(141, 131, 'Kibuye (depot BRALIRWA)', 198, NULL, NULL, 'YES'),
(142, 131, 'Nyagatare (depot BRALIRWA)', 338, NULL, NULL, 'YES'),
(143, 131, 'Byumba (depot BRALIRWA)', 303, NULL, NULL, 'YES'),
(144, 131, 'Mukamira(SOFATHEBE)', 181, NULL, NULL, 'YES'),
(145, 131, 'Kabaya(SOFATHEBE)', 190, NULL, NULL, 'YES'),
(146, 131, 'Gatumba(SOFATHEBE)', 188, NULL, NULL, 'YES'),
(147, 131, 'Ngororero(SOFATHEBE)', 197, NULL, NULL, 'YES'),
(148, 131, 'Byangabo(BYIMANA)', 278, NULL, NULL, 'YES'),
(149, 131, 'Gakenke(KURA)', 253, NULL, NULL, 'YES'),
(150, 131, 'Nyirangarama', 278, NULL, NULL, 'YES'),
(151, 131, 'Kamonyi', 125, NULL, NULL, 'YES'),
(152, 131, 'Gitarama', 117, NULL, NULL, 'YES'),
(153, 131, 'Byimana(SMACORP)', 105, NULL, NULL, 'YES'),
(154, 131, 'Ruhango(KAFACO)', 112, NULL, NULL, 'YES'),
(155, 131, 'Nyanza(SODITRACO)', 57, NULL, NULL, 'YES'),
(156, 131, 'Gikongoro(SODITRACO)', 53, NULL, NULL, 'YES'),
(157, 131, 'Rwamagana(depot BUDEYI)', 324, NULL, NULL, 'YES'),
(158, 131, 'Kayonza(depot BUDEYI)', 310, NULL, NULL, 'YES'),
(159, 131, 'Nyacyonga(FAPROCO)', 12, NULL, NULL, 'YES'),
(160, 131, 'Rutongo(FAPROCO)', 248, NULL, NULL, 'YES'),
(161, 131, 'Kiramuruzi(BUDEYI)', 355, NULL, NULL, 'YES'),
(162, 131, 'Nyamata(DITRAC)', 411, NULL, NULL, 'YES'),
(163, 131, 'kabuga(SAM&CHAM)', 418, NULL, NULL, 'YES'),
(164, 131, 'Muhanga GPTC(Via ngororero)', 117, NULL, NULL, 'YES'),
(165, 131, 'Huye(SADICO)', 74, NULL, NULL, 'YES'),
(166, 131, 'Nyamagabe(SODITRACO)', 88, NULL, NULL, 'YES'),
(167, 131, 'Shyorongi(SOTKAM)', 248, NULL, NULL, 'YES'),
(332, 131, 'VINE PHARMACY', 23, NULL, NULL, ''),
(333, 131, 'VINE KH Siege', 17, NULL, NULL, ''),
(334, 131, 'FURAHA GAHANGA', 26, NULL, NULL, ''),
(335, 131, 'PHARMACY TRAMED VILLE Siege', 14, NULL, NULL, ''),
(336, 131, 'CONSEIL NYARUTARAMA', 23, NULL, NULL, ''),
(337, 131, 'BORA Siege', 12, NULL, NULL, ''),
(338, 131, 'NSANGA PHARMACY LTD Siege', 12, NULL, NULL, ''),
(339, 131, 'FURAHA GATENGA', 27, NULL, NULL, ''),
(340, 131, 'FURAHA PAROISSE', 31, NULL, NULL, ''),
(341, 131, 'FURAHA SONATUBE', 31, NULL, NULL, ''),
(342, 131, 'FURAHA-KICUKIRO CENTRE', 31, NULL, NULL, ''),
(343, 131, 'GALAXY Siege', 23, NULL, NULL, ''),
(344, 131, 'GALEAD PHARMACY Siege', 33, NULL, NULL, ''),
(345, 131, 'Glory siege', 23, NULL, NULL, ''),
(346, 131, 'HAMPHAR Siege', 17, NULL, NULL, ''),
(347, 131, 'HEALTHCARE Siege', 9, NULL, NULL, ''),
(348, 131, 'HOTEL CHEZ LANDO Siege', 23, NULL, NULL, ''),
(349, 131, 'HOUMED Siege', 14, NULL, NULL, ''),
(350, 131, 'INGENZI KIBUNGO', 392, NULL, NULL, ''),
(351, 131, 'INGENZI Siege', 173, NULL, NULL, ''),
(352, 131, 'INITIATIVE', 57, NULL, NULL, ''),
(353, 131, 'IRAGUHA  Siege', 278, NULL, NULL, ''),
(354, 131, 'INGPHARMA ', 23, NULL, NULL, ''),
(355, 131, 'Ireme ', 19, NULL, NULL, ''),
(356, 131, 'IRIS PHARMACY Siege ', 9, NULL, NULL, ''),
(357, 131, 'ISANO PHARMACY Siege', 31, NULL, NULL, ''),
(358, 131, 'IVY PHARMACY Siege', 197, NULL, NULL, ''),
(359, 131, 'JMPHARMACY Siege', 17, NULL, NULL, ''),
(360, 131, 'JOSHU Siege', 3, NULL, NULL, ''),
(361, 131, 'KABARE Siege', 24, NULL, NULL, ''),
(362, 131, 'KACYIRU DISTRICT HOSPITAL Siege', 17, NULL, NULL, ''),
(363, 131, 'KACYIRU POLICE HOSPITAL Siege', 17, NULL, NULL, ''),
(364, 131, 'KARO Siege', 23, NULL, NULL, ''),
(365, 131, 'KAVES Siege', 19, NULL, NULL, ''),
(366, 131, 'KIVU-BEACH Siege', 173, NULL, NULL, ''),
(367, 131, 'KWETU PHARMACY Siege', 9, NULL, NULL, ''),
(368, 131, 'LADIVINE REMERA Siege', 23, NULL, NULL, ''),
(369, 131, 'LAN2000 Siege', 9, NULL, NULL, ''),
(370, 131, 'LICORNE SIEGE', 9, NULL, NULL, ''),
(371, 131, 'LIFELINE PHARMACY Siege', 14, NULL, NULL, ''),
(372, 131, 'LINDO Siege', 9, NULL, NULL, ''),
(373, 131, 'LYDDA PHARMACY Siege', 30, NULL, NULL, ''),
(374, 131, 'MALISA Siege', 31, NULL, NULL, ''),
(375, 131, 'MALISA_KICUKIRO', 31, NULL, NULL, ''),
(376, 131, 'MARANATHA Siege', 9, NULL, NULL, ''),
(377, 131, 'MEDIASOL  Siege', 9, NULL, NULL, ''),
(378, 131, 'MEDIASOL DCM', 23, NULL, NULL, ''),
(379, 131, 'MEDIASOL KANOMBE', 30, NULL, NULL, ''),
(380, 131, 'MEDIASOL RUBAVU', 173, NULL, NULL, ''),
(381, 131, 'MEDIASOL_DEPOT Siege', 9, NULL, NULL, ''),
(382, 131, 'MEDIASOL-MUSANZE', 278, NULL, NULL, ''),
(383, 131, 'MEDIASOL REMERA', 23, NULL, NULL, ''),
(384, 131, 'MEMIAS PHARMACY Siege', 31, NULL, NULL, ''),
(385, 131, 'MENIPHAR Siege', 23, NULL, NULL, ''),
(386, 131, 'MNR Siege', 18, NULL, NULL, ''),
(387, 131, 'MUHIRE KANOMBE', 30, NULL, NULL, ''),
(388, 131, 'MUHIRE rubavu', 173, NULL, NULL, ''),
(389, 131, 'MUHIRE siege', 9, NULL, NULL, ''),
(390, 131, 'NEWHOPE Siege', 23, NULL, NULL, ''),
(391, 131, 'NOBILIS Siege', 14, NULL, NULL, ''),
(392, 131, 'NOVA PHARMACY Siege', 31, NULL, NULL, ''),
(393, 131, 'NYABIHU DISTRICT Siege', 175, NULL, NULL, ''),
(394, 131, 'PACH Siege', 117, NULL, NULL, ''),
(395, 131, 'PENIEL Siege', 6, NULL, NULL, ''),
(396, 131, 'PHARMACHOICE Siege', 117, NULL, NULL, ''),
(397, 131, 'PHARMACIE CONTINENTALE Siege', 23, NULL, NULL, ''),
(398, 131, 'PHARMACIE DE LA GARE Siege', 14, NULL, NULL, ''),
(399, 131, 'PHARMACIE FIDELE Siege', 9, NULL, NULL, ''),
(400, 131, 'PHARMACIE LAGO Siege', 173, NULL, NULL, ''),
(401, 131, 'PHARMACIE PHARMA PLUS Siege', 9, NULL, NULL, ''),
(402, 131, 'PHARMACIE VINCA Siege', 173, NULL, NULL, ''),
(403, 131, 'PHARMACURE Siege', 9, NULL, NULL, ''),
(404, 131, 'PHARMAID Siege', 28, NULL, NULL, ''),
(405, 131, 'PHARMALAB Siege', 9, NULL, NULL, ''),
(406, 131, 'PHARMAMED Siege', 19, NULL, NULL, ''),
(407, 131, 'PHARMAMED Siege', 17, NULL, NULL, ''),
(408, 131, 'PHARMAVIE CHUK', 9, NULL, NULL, ''),
(409, 131, 'PHARMAVIE RSSB', 9, NULL, NULL, ''),
(410, 131, 'PHARMAVIE ST PAUL', 9, NULL, NULL, ''),
(411, 131, 'PLIVA Siege', 9, NULL, NULL, ''),
(412, 131, 'PRICELINE  Siege', 9, NULL, NULL, ''),
(413, 131, 'RAFI Siege', 173, NULL, NULL, ''),
(414, 131, 'REFERENCE Siege', 9, NULL, NULL, ''),
(415, 131, 'REFERENCE Siege', 23, NULL, NULL, ''),
(416, 131, 'REMED Siege', 8, NULL, NULL, ''),
(417, 131, 'REMUCHAT Siege', 345, NULL, NULL, ''),
(418, 131, 'RITE Siege', 23, NULL, NULL, ''),
(419, 131, 'ROYAL', 24, NULL, NULL, ''),
(420, 131, 'SABANS Siege', 23, NULL, NULL, ''),
(421, 131, 'RUGWIRO Siege', 208, NULL, NULL, ''),
(422, 131, 'SALVIA PHARMACY Siege', 411, NULL, NULL, ''),
(423, 131, 'SANOPHAR Siege', 9, NULL, NULL, ''),
(424, 131, 'SCORETOWN Siege', 9, NULL, NULL, ''),
(425, 131, 'SEMU Siege', 31, NULL, NULL, ''),
(426, 131, 'SHENGE Siege', 31, NULL, NULL, ''),
(427, 131, 'SPECIALIST Siege', 19, NULL, NULL, ''),
(428, 131, 'STRONG', 6, NULL, NULL, ''),
(429, 131, 'STRONG MEDICA PHARMACY Siege', 6, NULL, NULL, ''),
(430, 131, 'STRONG Siege', 6, NULL, NULL, ''),
(431, 131, 'SUNBEAM PHARMACY Siege', 9, NULL, NULL, ''),
(432, 131, 'SUNRISE PHARMACY Siege', 74, NULL, NULL, ''),
(433, 131, 'TECHNIPHARMA II', 19, NULL, NULL, ''),
(434, 131, 'TECHNIPHARMA Siege', 19, NULL, NULL, ''),
(435, 131, 'TECHNIPHARMA Siege', 19, NULL, NULL, ''),
(436, 131, 'TETA KIMIRONKO', 19, NULL, NULL, ''),
(437, 131, 'TETA KIMIRONKO', 19, NULL, NULL, ''),
(438, 131, 'TETA SIEGE', 23, NULL, NULL, ''),
(439, 131, 'THE HOUSE OF VITAMINS Siege', 9, NULL, NULL, ''),
(440, 131, 'THE CELLAR Siege', 24, NULL, NULL, ''),
(441, 131, 'THE COURT BOUTIQUE HOTEL Siege', 24, NULL, NULL, ''),
(442, 131, 'THE COURT BOUTIQUE HOTEL Siege', 19, NULL, NULL, ''),
(443, 131, 'THE NEW RANCH Siege', 19, NULL, NULL, ''),
(444, 131, 'TRAMED NYARUGENGE', 8, NULL, NULL, ''),
(445, 131, 'TIGO Siege', 24, NULL, NULL, ''),
(446, 131, 'TRESOR Siege', 6, NULL, NULL, ''),
(447, 131, 'TRINITAS Siege', 74, NULL, NULL, ''),
(448, 131, 'TROJANUS Siege', 411, NULL, NULL, ''),
(449, 131, 'TUGANE Siege', 345, NULL, NULL, ''),
(450, 131, 'UMURAVA Siege', 9, NULL, NULL, ''),
(451, 131, 'UMUTOZO Siege', 31, NULL, NULL, ''),
(452, 131, 'UNIPHARMA B1', 23, NULL, NULL, ''),
(453, 131, 'UNIPHARMA B2', 28, NULL, NULL, ''),
(454, 131, 'Unipharma B3', 23, NULL, NULL, ''),
(455, 131, 'UNIQUE Siege', 23, NULL, NULL, ''),
(456, 131, 'VINE KH Siege', 17, NULL, NULL, ''),
(457, 131, 'VINE LADIVINE MURINDI', 9, NULL, NULL, ''),
(458, 131, 'VINE PHARMACY Siege', 23, NULL, NULL, ''),
(459, 131, 'VINEDISTRIBUTION Siege', 23, NULL, NULL, ''),
(460, 131, 'Vision Motel', 23, NULL, NULL, ''),
(461, 131, 'VITA GRATIA Siege', 31, NULL, NULL, ''),
(462, 131, 'VIVA Siege', 74, NULL, NULL, ''),
(463, 131, 'VIVA-CALUS', 74, NULL, NULL, ''),
(464, 131, 'ZOOM PHARMACY Siege', 19, NULL, NULL, ''),
(466, 131, 'GREEN_ROCK Siege', 31, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_private_usage`
--

CREATE TABLE `fluid_private_usage` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_car` int(11) DEFAULT NULL,
  `from` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `live` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_private_usage`
--

INSERT INTO `fluid_private_usage` (`id`, `id_car`, `from`, `to`, `status`, `live`) VALUES
(4, 2, '07/18/2020', '07/31/2020', 10, 1),
(3, 3, '07/22/2020', '06/24/2020', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_province`
--

CREATE TABLE `fluid_province` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_province`
--

INSERT INTO `fluid_province` (`id`, `name`) VALUES
(1, 'Kigali City'),
(2, 'Southern Province'),
(3, 'Western Province'),
(4, 'Northern Province'),
(5, 'Eastern Province');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_sector`
--

CREATE TABLE `fluid_sector` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_sector`
--

INSERT INTO `fluid_sector` (`id`, `province_id`, `district_id`, `name`) VALUES
(1, 1, 1, 'Gitega'),
(2, 1, 1, 'Kanyinya'),
(3, 1, 1, 'Kigali'),
(4, 1, 1, 'Kimisagara'),
(5, 1, 1, 'Mageregere'),
(6, 1, 1, 'Muhima'),
(7, 1, 1, 'Nyakabanda'),
(8, 1, 1, 'Nyamirambo'),
(9, 1, 1, 'Nyarugenge'),
(10, 1, 1, 'Rwezamenyo'),
(11, 1, 2, 'Bumbogo'),
(12, 1, 2, 'Gatsata'),
(13, 1, 2, 'Gikomero'),
(14, 1, 2, 'Gisozi'),
(15, 1, 2, 'Jabana'),
(16, 1, 2, 'Jali'),
(17, 1, 2, 'Kacyiru'),
(18, 1, 2, 'Kimihurura'),
(19, 1, 2, 'Kimironko'),
(20, 1, 2, 'Kinyinya'),
(21, 1, 2, 'Ndera'),
(22, 1, 2, 'Nduba'),
(23, 1, 2, 'Remera'),
(24, 1, 2, 'Rusororo'),
(25, 1, 2, 'Rutunga'),
(26, 1, 3, 'Gahanga'),
(27, 1, 3, 'Gatenga'),
(28, 1, 3, 'Gikondo'),
(29, 1, 3, 'Kagarama'),
(30, 1, 3, 'Kanombe'),
(31, 1, 3, 'Kicukiro'),
(32, 1, 3, 'Kigarama'),
(33, 1, 3, 'Masaka'),
(34, 1, 3, 'Niboye'),
(35, 1, 3, 'Nyarugunga'),
(36, 2, 4, 'Busasamana'),
(37, 2, 4, 'Busoro'),
(38, 2, 4, 'Cyabakamyi'),
(39, 2, 4, 'Kibilizi'),
(40, 2, 4, 'Kigoma'),
(41, 2, 4, 'Mukingo'),
(42, 2, 4, 'Muyira'),
(43, 2, 4, 'Ntyazo'),
(44, 2, 4, 'Nyagisozi'),
(45, 2, 4, 'Rwabicuma'),
(46, 2, 5, 'Gikonko'),
(47, 2, 5, 'Gishubi'),
(48, 2, 5, 'Kansi'),
(49, 2, 5, 'Kibirizi'),
(50, 2, 5, 'Kigembe'),
(51, 2, 5, 'Mamba'),
(52, 2, 5, 'Muganza'),
(53, 2, 5, 'Mugombwa'),
(54, 2, 5, 'Mukindo'),
(55, 2, 5, 'Musha'),
(56, 2, 5, 'Ndora'),
(57, 2, 5, 'Nyanza'),
(58, 2, 5, 'Save'),
(59, 2, 6, 'Busanze'),
(60, 2, 6, 'Cyahinda'),
(61, 2, 6, 'Kibeho'),
(62, 2, 6, 'Kivu'),
(63, 2, 6, 'Mata'),
(64, 2, 6, 'Muganza'),
(65, 2, 6, 'Munini'),
(66, 2, 6, 'Ngera'),
(67, 2, 6, 'Ngoma'),
(68, 2, 6, 'Nyabimata'),
(69, 2, 6, 'Nyagisozi'),
(70, 2, 6, 'Ruheru'),
(71, 2, 6, 'Ruramba'),
(72, 2, 6, 'Rusenge'),
(73, 2, 7, 'Gishamvu'),
(74, 2, 7, 'Huye'),
(75, 2, 7, 'Karama'),
(76, 2, 7, 'Kigoma'),
(77, 2, 7, 'Kinazi'),
(78, 2, 7, 'Maraba'),
(79, 2, 7, 'Mbazi'),
(80, 2, 7, 'Mukura'),
(81, 2, 7, 'Ngoma'),
(82, 2, 7, 'Ruhashya'),
(83, 2, 7, 'Rusatira'),
(84, 2, 7, 'Rwaniro'),
(85, 2, 7, 'Simbi'),
(86, 2, 7, 'Tumba'),
(87, 2, 8, 'Buruhukiro'),
(88, 2, 8, 'Cyanika'),
(89, 2, 8, 'Gasaka'),
(90, 2, 8, 'Gatare'),
(91, 2, 8, 'Kaduha'),
(92, 2, 8, 'Kamegeri'),
(93, 2, 8, 'Kibirizi'),
(94, 2, 8, 'Kibumbwe'),
(95, 2, 8, 'Kitabi'),
(96, 2, 8, 'Mbazi'),
(97, 2, 8, 'Mugano'),
(98, 2, 8, 'Musange'),
(99, 2, 8, 'Musebeya'),
(100, 2, 8, 'Mushubi'),
(101, 2, 8, 'Nkomane'),
(102, 2, 8, 'Tare'),
(103, 2, 8, 'Uwinkingi'),
(104, 2, 9, 'Bweramana'),
(105, 2, 9, 'Byimana'),
(106, 2, 9, 'Kabagali'),
(107, 2, 9, 'Kinazi'),
(108, 2, 9, 'Kinihira'),
(109, 2, 9, 'Mbuye'),
(110, 2, 9, 'Mwendo'),
(111, 2, 9, 'Ntongwe'),
(112, 2, 9, 'Ruhango'),
(113, 2, 10, 'Cyeza'),
(114, 2, 10, 'Kabacuzi'),
(115, 2, 10, 'Kibangu'),
(116, 2, 10, 'Kiyumba'),
(117, 2, 10, 'Muhanga'),
(118, 2, 10, 'Mushishiro'),
(119, 2, 10, 'Nyabinoni'),
(120, 2, 10, 'Nyamabuye'),
(121, 2, 10, 'Nyarusange'),
(122, 2, 10, 'Rongi'),
(123, 2, 10, 'Rugendabari'),
(124, 2, 10, 'Shyogwe'),
(125, 2, 11, 'Gacurabwenge'),
(126, 2, 11, 'Karama'),
(127, 2, 11, 'Kayenzi'),
(128, 2, 11, 'Kayumbu'),
(129, 2, 11, 'Mugina'),
(130, 2, 11, 'Musambira'),
(131, 2, 11, 'Ngamba'),
(132, 2, 11, 'Nyamiyaga'),
(133, 2, 11, 'Nyarubaka'),
(134, 2, 11, 'Rugarika'),
(135, 2, 11, 'Rukoma'),
(136, 2, 11, 'Runda'),
(137, 3, 12, 'Bwishyura'),
(138, 3, 12, 'Gashari'),
(139, 3, 12, 'Gishyita'),
(140, 3, 12, 'Gitesi'),
(141, 3, 12, 'Mubuga'),
(142, 3, 12, 'Murambi'),
(143, 3, 12, 'Murundi'),
(144, 3, 12, 'Mutuntu'),
(145, 3, 12, 'Rubengera'),
(146, 3, 12, 'Rugabano'),
(147, 3, 12, 'Ruganda'),
(148, 3, 12, 'Rwankuba'),
(149, 3, 12, 'Twumba'),
(150, 3, 13, 'Boneza'),
(151, 3, 13, 'Gihango'),
(152, 3, 13, 'Kigeyo'),
(153, 3, 13, 'Kivumu'),
(154, 3, 13, 'Manihira'),
(155, 3, 13, 'Mukura'),
(156, 3, 13, 'Murunda'),
(157, 3, 13, 'Musasa'),
(158, 3, 13, 'Mushonyi'),
(159, 3, 13, 'Mushubati'),
(160, 3, 13, 'Nyabirasi'),
(161, 3, 13, 'Ruhango'),
(162, 3, 13, 'Rusebeya'),
(163, 3, 14, 'Bugeshi'),
(164, 3, 14, 'Busasamana'),
(165, 3, 14, 'Cyanzarwe'),
(166, 3, 14, 'Gisenyi'),
(167, 3, 14, 'Kanama'),
(168, 3, 14, 'Kanzenze'),
(169, 3, 14, 'Mudende'),
(170, 3, 14, 'Nyakiriba'),
(171, 3, 14, 'Nyamyumba'),
(172, 3, 14, 'Nyundo'),
(173, 3, 14, 'Rubavu'),
(174, 3, 14, 'Rugerero'),
(175, 3, 15, 'Bigogwe'),
(176, 3, 15, 'Jenda'),
(177, 3, 15, 'Jomba'),
(178, 3, 15, 'Kabatwa'),
(179, 3, 15, 'Karago'),
(180, 3, 15, 'Kintobo'),
(181, 3, 15, 'Mukamira'),
(182, 3, 15, 'Muringa'),
(183, 3, 15, 'Rambura'),
(184, 3, 15, 'Rugera'),
(185, 3, 15, 'Rurembo'),
(186, 3, 15, 'Shyira'),
(187, 3, 16, 'Bwira'),
(188, 3, 16, 'Gatumba'),
(189, 3, 16, 'Hindiro'),
(190, 3, 16, 'Kabaya'),
(191, 3, 16, 'Kageyo'),
(192, 3, 16, 'Kavumu'),
(193, 3, 16, 'Matyazo'),
(194, 3, 16, 'Muhanda'),
(195, 3, 16, 'Muhororo'),
(196, 3, 16, 'Ndaro'),
(197, 3, 16, 'Ngororero'),
(198, 3, 16, 'Nyange'),
(199, 3, 16, 'Sovu'),
(200, 3, 17, 'Bugarama'),
(201, 3, 17, 'Butare'),
(202, 3, 17, 'Bweyeye'),
(203, 3, 17, 'Gashonga'),
(204, 3, 17, 'Giheke'),
(205, 3, 17, 'Gihundwe'),
(206, 3, 17, 'Gikundamvura'),
(207, 3, 17, 'Gitambi'),
(208, 3, 17, 'Kamembe'),
(209, 3, 17, 'Muganza'),
(210, 3, 17, 'Mururu'),
(211, 3, 17, 'Nkanka'),
(212, 3, 17, 'Nkombo'),
(213, 3, 17, 'Nkungu'),
(214, 3, 17, 'Nyakabuye'),
(215, 3, 17, 'Nyakarenzo'),
(216, 3, 17, 'Nzahaha'),
(217, 3, 17, 'Rwimbogo'),
(218, 3, 18, 'Bushekeri'),
(219, 3, 18, 'Bushenge'),
(220, 3, 18, 'Cyato'),
(221, 3, 18, 'Gihombo'),
(222, 3, 18, 'Kagano'),
(223, 3, 18, 'Kanjongo'),
(224, 3, 18, 'Karambi'),
(225, 3, 18, 'Karengera'),
(226, 3, 18, 'Kirimbi'),
(227, 3, 18, 'Macuba'),
(228, 3, 18, 'Mahembe'),
(229, 3, 18, 'Nyabitekeri'),
(230, 3, 18, 'Rangiro'),
(231, 3, 18, 'Ruharambuga'),
(232, 3, 18, 'Shangi'),
(233, 4, 19, 'Base'),
(234, 4, 19, 'Burega'),
(235, 4, 19, 'Bushoki'),
(236, 4, 19, 'Buyoga'),
(237, 4, 19, 'Cyinzuri'),
(238, 4, 19, 'Cyungo'),
(239, 4, 19, 'Kinihira'),
(240, 4, 19, 'Kisaro'),
(241, 4, 19, 'Masoro'),
(242, 4, 19, 'Mbogo'),
(243, 4, 19, 'Murambi'),
(244, 4, 19, 'Ngoma'),
(245, 4, 19, 'Ntarabana'),
(246, 4, 19, 'Rukozo'),
(247, 4, 19, 'Rusiga'),
(248, 4, 19, 'Shyorongi'),
(249, 4, 19, 'Tumba'),
(250, 4, 20, 'Busengo'),
(251, 4, 20, 'Coko'),
(252, 4, 20, 'Cyabingo'),
(253, 4, 20, 'Gakenke'),
(254, 4, 20, 'Gashenyi'),
(255, 4, 20, 'Janja'),
(256, 4, 20, 'Kamubuga'),
(257, 4, 20, 'Karambo'),
(258, 4, 20, 'Kivuruga'),
(259, 4, 20, 'Mataba'),
(260, 4, 20, 'Minazi'),
(261, 4, 20, 'Mugunga'),
(262, 4, 20, 'Muhondo'),
(263, 4, 20, 'Muyongwe'),
(264, 4, 20, 'Muzo'),
(265, 4, 20, 'Nemba'),
(266, 4, 20, 'Ruli'),
(267, 4, 20, 'Rusasa'),
(268, 4, 20, 'Rushashi'),
(269, 4, 21, 'Busogo'),
(270, 4, 21, 'Cyuve'),
(271, 4, 21, 'Gacaca'),
(272, 4, 21, 'Gashaki'),
(273, 4, 21, 'Gataraga'),
(274, 4, 21, 'Kimonyi'),
(275, 4, 21, 'Kinigi'),
(276, 4, 21, 'Muhoza'),
(277, 4, 21, 'Muko'),
(278, 4, 21, 'Musanze'),
(279, 4, 21, 'Nkotsi'),
(280, 4, 21, 'Nyange'),
(281, 4, 21, 'Remera'),
(282, 4, 21, 'Rwaza'),
(283, 4, 21, 'Shingiro'),
(284, 4, 22, 'Bungwe'),
(285, 4, 22, 'Butaro'),
(286, 4, 22, 'Cyanika'),
(287, 4, 22, 'Cyeru'),
(288, 4, 22, 'Gahunga'),
(289, 4, 22, 'Gatebe'),
(290, 4, 22, 'Gitovu'),
(291, 4, 22, 'Kagogo'),
(292, 4, 22, 'Kinoni'),
(293, 4, 22, 'Kinyababa'),
(294, 4, 22, 'Kivuye'),
(295, 4, 22, 'Nemba'),
(296, 4, 22, 'Rugarama'),
(297, 4, 22, 'Rugengabari'),
(298, 4, 22, 'Ruhunde'),
(299, 4, 22, 'Rusarabuye'),
(300, 4, 22, 'Rwerere'),
(301, 4, 23, 'Bukure'),
(302, 4, 23, 'Bwisige'),
(303, 4, 23, 'Byumba'),
(304, 4, 23, 'Cyumba'),
(305, 4, 23, 'Giti'),
(306, 4, 23, 'Kageyo'),
(307, 4, 23, 'Kaniga'),
(308, 4, 23, 'Manyagiro'),
(309, 4, 23, 'Miyove'),
(310, 4, 23, 'Mukarange'),
(311, 4, 23, 'Muko'),
(312, 4, 23, 'Mutete'),
(313, 4, 23, 'Nyamiyaga'),
(314, 4, 23, 'Nyankenke'),
(315, 4, 23, 'Rubaya'),
(316, 4, 23, 'Rukomo'),
(317, 4, 23, 'Rushaki'),
(318, 4, 23, 'Rutare'),
(319, 4, 23, 'Ruvune'),
(320, 4, 23, 'Rwamiko'),
(321, 4, 23, 'Shangasha'),
(322, 5, 24, 'Fumbwe'),
(323, 5, 24, 'Gahengeri'),
(324, 5, 24, 'Gishali'),
(325, 5, 24, 'Karenge'),
(326, 5, 24, 'Kigabiro'),
(327, 5, 24, 'Muhazi'),
(328, 5, 24, 'Munyaga'),
(329, 5, 24, 'Munyiginya'),
(330, 5, 24, 'Musha'),
(331, 5, 24, 'Muyumbu'),
(332, 5, 24, 'Mwulire'),
(333, 5, 24, 'Nyakaliro'),
(334, 5, 24, 'Nzige'),
(335, 5, 24, 'Rubona'),
(336, 5, 25, 'Gatunda'),
(337, 5, 25, 'Karama'),
(338, 5, 25, 'Karangazi'),
(339, 5, 25, 'Katabagemu'),
(340, 5, 25, 'Kiyombe'),
(341, 5, 25, 'Matimba'),
(342, 5, 25, 'Mimuri'),
(343, 5, 25, 'Mukama'),
(344, 5, 25, 'Musheri'),
(345, 5, 25, 'Nyagatare'),
(346, 5, 25, 'Rukomo'),
(347, 5, 25, 'Rwempasha'),
(348, 5, 25, 'Rwimiyaga'),
(349, 5, 25, 'Tambwe'),
(350, 5, 26, 'Gasange'),
(351, 5, 26, 'Gatsibo'),
(352, 5, 26, 'Gitoki'),
(353, 5, 26, 'Kabarore'),
(354, 5, 26, 'Kageyo'),
(355, 5, 26, 'Kiramuruzi'),
(356, 5, 26, 'Kiziguro'),
(357, 5, 26, 'Muhura'),
(358, 5, 26, 'Murambi'),
(359, 5, 26, 'Ngarama'),
(360, 5, 26, 'Nyagihanga'),
(361, 5, 26, 'Remera'),
(362, 5, 26, 'Rugarama'),
(363, 5, 26, 'Rwimbogo'),
(364, 5, 27, 'Gahini'),
(365, 5, 27, 'Kabare'),
(366, 5, 27, 'Kabarondo'),
(367, 5, 27, 'Mukarange'),
(368, 5, 27, 'Murama'),
(369, 5, 27, 'Murundi'),
(370, 5, 27, 'Mwiri'),
(371, 5, 27, 'Ndego'),
(372, 5, 27, 'Nyamirama'),
(373, 5, 27, 'Rukara'),
(374, 5, 27, 'Ruramira'),
(375, 5, 27, 'Rwinkwavu'),
(376, 5, 28, 'Gahara'),
(377, 5, 28, 'Gatore'),
(378, 5, 28, 'Kigarama'),
(379, 5, 28, 'Kigina'),
(380, 5, 28, 'Kirehe'),
(381, 5, 28, 'Mahama'),
(382, 5, 28, 'Mpanga'),
(383, 5, 28, 'Musaza'),
(384, 5, 28, 'Mushikiri'),
(385, 5, 28, 'Nasho'),
(386, 5, 28, 'Nyamugari'),
(387, 5, 28, 'Nyarubuye'),
(388, 5, 29, 'Gashanda'),
(389, 5, 29, 'Jarama'),
(390, 5, 29, 'Karembo'),
(391, 5, 29, 'Kazo'),
(392, 5, 29, 'Kibungo'),
(393, 5, 29, 'Mugesera'),
(394, 5, 29, 'Murama'),
(395, 5, 29, 'Mutenderi'),
(396, 5, 29, 'Remera'),
(397, 5, 29, 'Rukira'),
(398, 5, 29, 'Rukumberi'),
(399, 5, 29, 'Rurenge'),
(400, 5, 29, 'Sake'),
(401, 5, 29, 'Zaza'),
(402, 5, 30, 'Gashora'),
(403, 5, 30, 'Juru'),
(404, 5, 30, 'Kamabuye'),
(405, 5, 30, 'Mareba'),
(406, 5, 30, 'Mayange'),
(407, 5, 30, 'Musenyi'),
(408, 5, 30, 'Mwogo'),
(409, 5, 30, 'Ngeruka'),
(410, 5, 30, 'Ntarama'),
(411, 5, 30, 'Nyamata'),
(412, 5, 30, 'Nyarugenge'),
(413, 5, 30, 'Rilima'),
(414, 5, 30, 'Ruhuha'),
(415, 5, 30, 'Rweru'),
(416, 5, 30, 'Shyara'),
(418, 1, 2, 'kabuga'),
(419, 1, 3, 'KABEZA');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_status`
--

CREATE TABLE `fluid_status` (
  `id` int(11) NOT NULL,
  `statusname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_subcampany` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_status`
--

INSERT INTO `fluid_status` (`id`, `statusname`, `id_subcampany`) VALUES
(1, 'emergency', 3),
(2, 'priority', 3),
(3, 'normal', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_sub_company`
--

CREATE TABLE `fluid_sub_company` (
  `id` int(100) NOT NULL,
  `id_company` int(100) NOT NULL,
  `subcompany_name` varchar(100) NOT NULL,
  `tin_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_sub_company`
--

INSERT INTO `fluid_sub_company` (`id`, `id_company`, `subcompany_name`, `tin_number`, `email`, `location`) VALUES
(3, 5, 'ALGORITHM', '101909872', 'kimainyi@gmail.com', 'KIMIHURURA'),
(4, 6, 'KAURWA LTD', '10317279', 'kaurwaltd@gmail.com', 'KIMIRONKO'),
(5, 7, 'local', '12345679', 'sezeranochrisostom123@gmail.com', 'kigali'),
(6, 5, 'new', '12456', 'eamo@gmail.com', 'kigali');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_unavailable_car`
--

CREATE TABLE `fluid_unavailable_car` (
  `id` int(11) NOT NULL,
  `id_car` int(11) DEFAULT NULL,
  `departure_time` datetime DEFAULT NULL,
  `assumed_arrival_time` datetime DEFAULT NULL,
  `reason` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fluid_unavailable_car`
--

INSERT INTO `fluid_unavailable_car` (`id`, `id_car`, `departure_time`, `assumed_arrival_time`, `reason`, `status`, `is_active`) VALUES
(1, 22, '2018-04-01 00:00:00', '2018-04-23 00:00:00', 'barayigonze', 'still_repaired', 0),
(2, 24, '2018-04-01 00:00:00', '2018-04-23 00:00:00', 'pane', 'still_repaired', 0),
(3, 2, '0000-00-00 00:00:00', '2018-02-26 00:00:00', '2018-05-30', 'still_repaired', NULL),
(4, 2, '2018-04-01 00:00:00', '2018-04-30 00:00:00', 'barayigonze', 'still_repaired', NULL),
(5, 23, '2018-04-01 00:00:00', '2018-04-25 00:00:00', 'accident', 'still_repaired', NULL),
(6, 15, '2018-04-01 00:00:00', '2018-04-23 00:00:00', 'accident', 'still_repaired', NULL),
(7, 2, '2018-04-27 00:00:00', '2018-04-30 00:00:00', 'private issue', 'already-active', NULL),
(8, 2, '2018-08-14 00:00:00', '2018-08-14 00:00:00', 'antretien', 'still_repaired', NULL),
(9, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nta control', 'still_repaired', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fluid_urugendo`
--

CREATE TABLE `fluid_urugendo` (
  `id` int(11) NOT NULL,
  `departure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_sector1` int(100) NOT NULL,
  `id_sector2` int(100) NOT NULL,
  `aboutcontract` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_urugendo`
--

INSERT INTO `fluid_urugendo` (`id`, `departure`, `destination`, `id_sector1`, `id_sector2`, `aboutcontract`) VALUES
(1, 'kipharma', 'pharmamed', 12, 13, 'new'),
(2, 'kipharma', 'unipharma', 12, 19, 'outofdate'),
(3, 'speranza', 'pharmamed', 12, 13, 'updatecontract');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_user`
--

CREATE TABLE `fluid_user` (
  `id` int(11) NOT NULL,
  `id_subcompany` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT '10',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passreset` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '10',
  `last_login` datetime DEFAULT NULL,
  `live` int(250) DEFAULT '0',
  `status` varchar(250) COLLATE utf8_unicode_ci DEFAULT 'lebour',
  `vercod` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `verfied` int(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fluid_user`
--

INSERT INTO `fluid_user` (`id`, `id_subcompany`, `username`, `full_name`, `phone_number`, `auth_key`, `password`, `passreset`, `email`, `role`, `last_login`, `live`, `status`, `vercod`, `verfied`) VALUES
(5, 3, 'linda', 'Dushimire Linda Sylvie', '0788869326', '10', '25f9e794323b453885f5181f1b624d0b', '', 'lindadusy2@gmail.com', 10, '2017-11-27 11:17:59', 1, 'lebour', '', 1),
(24, 3, 'UWERA', 'UWERA ODETTE', '0782138025', '1', '25f9e794323b453885f5181f1b624d0b', '', 'odette.uwera@ishyiga.info', 10, '2020-08-19 10:27:21', 1, 'lebour', '', 1),
(26, 3, 'corneille', 'Corneille Mvuyekure', '+250000000000', '1', '25f9e794323b453885f5181f1b624d0b', '', 'corneille.mvuyekure@ishyiga.info', 10, '2019-01-31 12:16:03', 1, 'lebour', '', 1),
(27, 3, 'THEONESTE', 'BIZIMUNGU THEONESTE', '0787533098', '1', '25f9e794323b453885f5181f1b624d0b', '', 'theoneste.bizimungu@ishyiga.info', 10, '2018-11-05 13:39:34', 1, 'lebour', '', 1),
(28, 3, 'aimable', 'Aimable Kimenyi', '0788000000', '1', '25f9e794323b453885f5181f1b624d0b', '', 'aimable.kimenyi@ishyiga.info', 20, '2020-08-19 11:04:02', 1, 'MASTER', '', 1),
(30, 3, 'emelyne', 'ntigurirwa emelyne', '0782286200', '1', '25f9e794323b453885f5181f1b624d0b', '', 'emelyne.ntigurirwa@ishyiga.info', 20, '2018-07-30 12:27:32', 1, 'lebour', '', 1),
(38, 3, 'telesphore', 'nsabimana telesphore', '0782402205', '1', '25f9e794323b453885f5181f1b624d0b', '', 'telesphore.nsabimana@ishyiga.info', 10, '2019-03-31 13:43:20', 1, 'lebour', '', 1),
(57, 3, 'bizimana', 'Bizimana JMV', '+250784460563', '10', '25f9e794323b453885f5181f1b624d0b', '', 'jmv.bizimana@ishyiga.info', 10, '2018-10-02 11:36:59', 1, 'lebour', '', 1),
(58, 3, 'delphine', 'DELPHINE MUKAHIRWA', '0785989244', '10', '25f9e794323b453885f5181f1b624d0b', '', 'delphine.mukahirwa@ishyiga.info', 10, '2019-02-12 19:28:46', 1, 'lebour', '', 1),
(61, 3, 'rose', 'uwamariya marie rose', '0788975432', '10', '25f9e794323b453885f5181f1b624d0b', '1bbf28165a1dcbcfd145c68ff7fbe0ff685cc83646a3e253f786f4af1a7961bd', 'marie.rose.uwamariya@ishyiga.info', 10, '2020-07-08 14:01:43', 1, 'lebour', '', 1),
(80, 3, 'ella', 'Irangabiye ella', '0789623684', '10', '25f9e794323b453885f5181f1b624d0b', '', 'ella.hestia@ishyiga.info', 10, '2019-01-17 13:11:28', 1, 'lebour', '', 1),
(84, 3, 'sued', 'IRADUKUNDA Amri Sued', '0788970708', '10', '25f9e794323b453885f5181f1b624d0b', '', 'amri.sued.iradukunda@ishyiga.info', 10, '2019-01-31 12:15:07', 1, 'lebour', '', 1),
(87, 3, 'barthelemy', 'NIYIGIRIMBABAZI Barthelemy', '783288362', '10', '25f9e794323b453885f5181f1b624d0b', '', 'barthelemy.niyigirimbabazi@ishyiga.info', 10, '2018-08-08 17:23:41', 1, 'lebour', '', 1),
(88, 3, 'irakuzwa', 'Irakuzwa Jean Aime', '0782229123', '10', '25f9e794323b453885f5181f1b624d0b', 'efa080a8e06f479915f2be8f17236a84df3fb7a0b64ca47a8b3498fd03f28d52', 'jean.aime.irakuzwa@ishyiga.info', 10, '2020-07-07 15:49:43', 1, 'lebour', '', 1),
(91, 3, 'pacifique2', 'Pacifique Uwimana', '+250783248715', '10', '25f9e794323b453885f5181f1b624d0b', '8bbbb45e75a0748c92b2a7ed7fb0858928d42c62792eb6c770bc11627791aa11', 'pacifique.Uwimana@ishyiga.info', 10, '2019-01-28 17:52:49', 1, 'lebour', '', 1),
(92, 3, 'jeannine', 'nuyonkuru jeannine manariyo', '078843008', '10', '25f9e794323b453885f5181f1b624d0b', '81f061eabf0699fbbb7016324faf4ed04486df4684900cdbc553582fdd3fbe9d', 'jeannine.manariyo@ishyiga.info', 10, '2018-11-27 12:58:47', 1, 'lebour', '', 1),
(93, 3, 'Hagenimana', 'Hagenimana emmanuel', '0780273467', '10', '25f9e794323b453885f5181f1b624d0b', '', 'hagenimanemmanuel@gmail.com', 10, '2020-08-12 14:15:52', 1, 'lebour', '', 1),
(131, 3, 'seze', 'sez fent ', '25000000000000', '10', '25f9e794323b453885f5181f1b624d0b', '$2y$10$B.R8YqAPLYzJ0n.pU./tj.kqU/h7EV5Ix.a6ru59DMLCTa9NgVlJ.', 'sezeranochrisostom123@gmail.com', 20, '2020-08-19 11:04:16', 1, 'lebour', '6aeb853060bef4912be572ffdd6445b2', 1),
(137, 3, 'STEVE', 'hakizimana steve', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'steve.hakizimana@ishyiga.info', 10, NULL, 1, 'lebour', '', 1),
(139, 3, 'sheila', 'Annie Sheila Munezero', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'annieroy0412@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(140, 3, 'NIYIKORA', 'NIYIKORA Jean', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'jean.niyikora@ishyiga.info', 10, NULL, 1, 'lebour', '', 1),
(141, 3, 'MANIRAKIZA', 'MANIRAKIZA Patience', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'patience.manirakiza@ishyiga.info', 10, NULL, 1, 'lebour', '', 1),
(142, 3, 'aristide', 'Nijimbere aristide', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'aristide.nijimbere@ishyiga.info', 10, NULL, 1, 'lebour', '', 1),
(143, 3, 'mwungura', 'Mwungura muhire', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'mwunguramuhire@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(144, 3, 'elyse12', 'Elyse Ihirwe', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'elyse.ihirwe@ishyiga.info', 10, NULL, 1, 'lebour', '', 1),
(145, 3, 'MUKUNDENTE', 'MUKUNDENTE Mathilde', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'mukundentem@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(146, 3, 'HORANIMPUNDU', 'Fidelente HORANIMPUNDU', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'horafidelente@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(147, 3, 'MUGABO', 'MUGABO Francois', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'mugabofrancois1997@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(148, 3, 'NTAKIRUTIMANA', 'Ntakirutimana Elyssa', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'ntakirelyssa@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(149, 3, 'POUL', 'JEAN PAUL NIYIGENA', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'niyigenathewinner@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(150, 3, 'UGIRIMBABAZI', 'Etienne UGIRIMBABAZI', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'ugira77@gmail.com', 10, '2020-08-11 15:49:39', 1, 'lebour', '', 1),
(151, 3, 'NIYONSABA', 'NIYONSABA Claudine', '', '10', '25f9e794323b453885f5181f1b624d0b', '', 'niclaudine41@gmail.com', 10, NULL, 1, 'lebour', '', 1),
(152, 3, 'Gilles', 'Gilles', '+2500000000', '123456', '25f9e794323b453885f5181f1b624d0b', '', '', 30, '2020-08-19 10:52:19', 1, 'lebour', '', 1),
(153, 5, 'danny', 'Danny', '1234567890', '10', '25f9e794323b453885f5181f1b624d0b', '4899a839454d9b687fac884350146cb2', '', 30, NULL, 1, 'lebour', '9143bed468f4b552aaab032434d0a97d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_cost`
--

CREATE TABLE `fuel_cost` (
  `id` int(11) NOT NULL,
  `id_subcompany` int(11) DEFAULT NULL,
  `cost` decimal(55,0) DEFAULT NULL,
  `created` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_cost`
--

INSERT INTO `fuel_cost` (`id`, `id_subcompany`, `cost`, `created`) VALUES
(1, 3, '960', '2020-07-28 11:16:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fluid_arrival`
--
ALTER TABLE `fluid_arrival`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_placef` (`id_place2`),
  ADD KEY `id_sector` (`id_sector`);

--
-- Indexes for table `fluid_booking`
--
ALTER TABLE `fluid_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_sector0` (`id_place0`,`id_placef`,`status_id`,`departments_id`),
  ADD KEY `fk_booking_departments` (`departments_id`),
  ADD KEY `fk_booking_status` (`status_id`),
  ADD KEY `fk_booking_place` (`id_placef`);

--
-- Indexes for table `fluid_booking_row`
--
ALTER TABLE `fluid_booking_row`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `fluid_book_date_lead`
--
ALTER TABLE `fluid_book_date_lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_car`
--
ALTER TABLE `fluid_car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcompany` (`id_subcompany`);

--
-- Indexes for table `fluid_car_location`
--
ALTER TABLE `fluid_car_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_place` (`id_place`),
  ADD KEY `id_place_2` (`id_place`,`status_id`),
  ADD KEY `fk_car_location_status` (`status_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `fluid_cell`
--
ALTER TABLE `fluid_cell`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_province_id_3582_00` (`province_id`),
  ADD KEY `idx_district_id_3582_01` (`district_id`),
  ADD KEY `idx_sector_id_3582_02` (`sector_id`);

--
-- Indexes for table `fluid_company`
--
ALTER TABLE `fluid_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_depart`
--
ALTER TABLE `fluid_depart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_place0` (`id_place1`),
  ADD KEY `id_sector1` (`id_sector1`);

--
-- Indexes for table `fluid_departments`
--
ALTER TABLE `fluid_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcompany` (`id_subcompany`);

--
-- Indexes for table `fluid_distance`
--
ALTER TABLE `fluid_distance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sector0` (`id_sector0`,`id_sectorf`),
  ADD KEY `fk_distance_sectorf` (`id_sectorf`);

--
-- Indexes for table `fluid_district`
--
ALTER TABLE `fluid_district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-district-province_id` (`province_id`);

--
-- Indexes for table `fluid_driver_avail`
--
ALTER TABLE `fluid_driver_avail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_driver_logs`
--
ALTER TABLE `fluid_driver_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_kms`
--
ALTER TABLE `fluid_kms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcompany` (`id_subcompany`),
  ADD KEY `id_car` (`id_car`);

--
-- Indexes for table `fluid_km_count`
--
ALTER TABLE `fluid_km_count`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_place0` (`id_place0`),
  ADD KEY `id_placef` (`id_placef`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `fluid_location`
--
ALTER TABLE `fluid_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sector_id` (`sector_id`);

--
-- Indexes for table `fluid_notification_lead`
--
ALTER TABLE `fluid_notification_lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_place`
--
ALTER TABLE `fluid_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sector0` (`id_sector0`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `fluid_private_usage`
--
ALTER TABLE `fluid_private_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_car` (`id_car`);

--
-- Indexes for table `fluid_province`
--
ALTER TABLE `fluid_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_sector`
--
ALTER TABLE `fluid_sector`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idx_province_id_581_00` (`province_id`),
  ADD KEY `idx_district_id_581_01` (`district_id`);

--
-- Indexes for table `fluid_status`
--
ALTER TABLE `fluid_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_sub_company`
--
ALTER TABLE `fluid_sub_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `subcompany_name` (`subcompany_name`);

--
-- Indexes for table `fluid_unavailable_car`
--
ALTER TABLE `fluid_unavailable_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_urugendo`
--
ALTER TABLE `fluid_urugendo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departure` (`departure`,`destination`),
  ADD KEY `departure_2` (`departure`),
  ADD KEY `destination` (`destination`),
  ADD KEY `id_sector1` (`id_sector1`,`id_sector2`),
  ADD KEY `fk_urugendo_sector2` (`id_sector2`);

--
-- Indexes for table `fluid_user`
--
ALTER TABLE `fluid_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `full_name` (`full_name`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_subcompany` (`id_subcompany`);

--
-- Indexes for table `fuel_cost`
--
ALTER TABLE `fuel_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcompany` (`id_subcompany`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fluid_booking`
--
ALTER TABLE `fluid_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237;

--
-- AUTO_INCREMENT for table `fluid_booking_row`
--
ALTER TABLE `fluid_booking_row`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `fluid_book_date_lead`
--
ALTER TABLE `fluid_book_date_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fluid_car`
--
ALTER TABLE `fluid_car`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `fluid_car_location`
--
ALTER TABLE `fluid_car_location`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fluid_cell`
--
ALTER TABLE `fluid_cell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2148;

--
-- AUTO_INCREMENT for table `fluid_company`
--
ALTER TABLE `fluid_company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fluid_departments`
--
ALTER TABLE `fluid_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fluid_distance`
--
ALTER TABLE `fluid_distance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `fluid_district`
--
ALTER TABLE `fluid_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `fluid_driver_avail`
--
ALTER TABLE `fluid_driver_avail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fluid_driver_logs`
--
ALTER TABLE `fluid_driver_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `fluid_kms`
--
ALTER TABLE `fluid_kms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `fluid_km_count`
--
ALTER TABLE `fluid_km_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `fluid_notification_lead`
--
ALTER TABLE `fluid_notification_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `fluid_place`
--
ALTER TABLE `fluid_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=467;

--
-- AUTO_INCREMENT for table `fluid_private_usage`
--
ALTER TABLE `fluid_private_usage`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fluid_province`
--
ALTER TABLE `fluid_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fluid_sector`
--
ALTER TABLE `fluid_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `fluid_sub_company`
--
ALTER TABLE `fluid_sub_company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fluid_unavailable_car`
--
ALTER TABLE `fluid_unavailable_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fluid_user`
--
ALTER TABLE `fluid_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `fuel_cost`
--
ALTER TABLE `fuel_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fluid_arrival`
--
ALTER TABLE `fluid_arrival`
  ADD CONSTRAINT `fk_arrival_place` FOREIGN KEY (`id_place2`) REFERENCES `fluid_place` (`id`),
  ADD CONSTRAINT `fk_arrival_sector` FOREIGN KEY (`id_sector`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_cell`
--
ALTER TABLE `fluid_cell`
  ADD CONSTRAINT `fk_cell_sector` FOREIGN KEY (`sector_id`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_depart`
--
ALTER TABLE `fluid_depart`
  ADD CONSTRAINT `fk_depart_place` FOREIGN KEY (`id_place1`) REFERENCES `fluid_place` (`id`),
  ADD CONSTRAINT `fk_depart_sector` FOREIGN KEY (`id_sector1`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_distance`
--
ALTER TABLE `fluid_distance`
  ADD CONSTRAINT `fk_distance_sector0` FOREIGN KEY (`id_sector0`) REFERENCES `fluid_sector` (`id`),
  ADD CONSTRAINT `fk_distance_sectorf` FOREIGN KEY (`id_sectorf`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_km_count`
--
ALTER TABLE `fluid_km_count`
  ADD CONSTRAINT `fluid_km_count_ibfk_1` FOREIGN KEY (`id_place0`) REFERENCES `fluid_place` (`id`),
  ADD CONSTRAINT `fluid_km_count_ibfk_2` FOREIGN KEY (`id_placef`) REFERENCES `fluid_place` (`id`),
  ADD CONSTRAINT `fluid_km_count_ibfk_3` FOREIGN KEY (`id_booking`) REFERENCES `fluid_booking` (`id`);

--
-- Constraints for table `fluid_location`
--
ALTER TABLE `fluid_location`
  ADD CONSTRAINT `fluid_location_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_place`
--
ALTER TABLE `fluid_place`
  ADD CONSTRAINT `fk_place_sector` FOREIGN KEY (`id_sector0`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fluid_sector`
--
ALTER TABLE `fluid_sector`
  ADD CONSTRAINT `fk_district_5808_01` FOREIGN KEY (`district_id`) REFERENCES `fluid_district` (`id`),
  ADD CONSTRAINT `fk_province_5808_00` FOREIGN KEY (`province_id`) REFERENCES `fluid_province` (`id`);

--
-- Constraints for table `fluid_urugendo`
--
ALTER TABLE `fluid_urugendo`
  ADD CONSTRAINT `fk_urugendo_sector1` FOREIGN KEY (`id_sector1`) REFERENCES `fluid_sector` (`id`),
  ADD CONSTRAINT `fk_urugendo_sector2` FOREIGN KEY (`id_sector2`) REFERENCES `fluid_sector` (`id`);

--
-- Constraints for table `fuel_cost`
--
ALTER TABLE `fuel_cost`
  ADD CONSTRAINT `fuel_cost_ibfk_1` FOREIGN KEY (`id_subcompany`) REFERENCES `fluid_sub_company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;