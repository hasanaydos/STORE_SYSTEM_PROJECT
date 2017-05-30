-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2017, 13:57:04
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `store_system`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `a_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `authorization` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `process_name` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `process_type` int(11) NOT NULL,
  `process_date` date NOT NULL,
  `by_who` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ordered_date` date NOT NULL,
  `cargo_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `quantity`) VALUES
(4, 'AF', 3),
(11, 'lg', 45),
(89, 'hh', 88),
(123, 'asd', 45),
(323, 'ac', 4),
(7788, 'yeni', 8),
(44332, 'ericson', 9),
(54545, 'hjghjgj', 54545),
(90987, 'uu', 88),
(454545, 'ff', 44),
(776545, 'ff', 99),
(22223333, 'aaaaa', 111112111),
(33334444, 'ffffdddd', 1111),
(45454545, 'kk', 77);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_property`
--

CREATE TABLE `product_property` (
  `p_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Tablo döküm verisi `product_property`
--

INSERT INTO `product_property` (`p_id`, `pr_id`) VALUES
(54545, 10),
(89, 11),
(89, 12),
(90987, 7),
(7788, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `properties`
--

CREATE TABLE `properties` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `pr_value` varchar(100) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Tablo döküm verisi `properties`
--

INSERT INTO `properties` (`pr_id`, `pr_name`, `pr_value`) VALUES
(1, 'ekran', '5 inç'),
(2, 'battery', '3300 mah'),
(3, '3g', 'var'),
(4, 'tuşlu', 'evet'),
(5, 'nn', 'v'),
(6, 'n', 'vv'),
(7, 'n1', 'v1'),
(8, 'n2', 'v2'),
(9, 'o1', 'o2'),
(10, 'ghfghf', '4245'),
(11, 'nn1', 'vv1'),
(12, 'nn2', 'vv2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`a_id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Tablo için indeksler `product_property`
--
ALTER TABLE `product_property`
  ADD KEY `p_id` (`p_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Tablo için indeksler `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`pr_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `properties`
--
ALTER TABLE `properties`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Tablo kısıtlamaları `product_property`
--
ALTER TABLE `product_property`
  ADD CONSTRAINT `product_property_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
