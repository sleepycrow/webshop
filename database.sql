-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2020 at 12:43 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurwiks`
--

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}categories`
--

CREATE TABLE `{prefix}categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}orders`
--

CREATE TABLE `{prefix}orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_address` text COLLATE utf8_polish_ci NOT NULL,
  `order_date_made` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_date_paid` timestamp NULL DEFAULT NULL,
  `order_seen_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `order_total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}orders_products`
--

CREATE TABLE `{prefix}orders_products` (
  `orders_products_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `orders_products_amount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}products`
--

CREATE TABLE `{prefix}products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `product_price` decimal(15,2) NOT NULL,
  `product_thumbnail_src` varchar(150) COLLATE utf8_polish_ci DEFAULT NULL,
  `product_description` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}products_images`
--

CREATE TABLE `{prefix}products_images` (
  `prodimg_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prodimg_src` varchar(150) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{prefix}users`
--

CREATE TABLE `{prefix}users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `{prefix}categories`
--
ALTER TABLE `{prefix}categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `{prefix}orders`
--
ALTER TABLE `{prefix}orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders__user_id` (`user_id`);

--
-- Indexes for table `{prefix}orders_products`
--
ALTER TABLE `{prefix}orders_products`
  ADD PRIMARY KEY (`orders_products_id`),
  ADD KEY `orders_products__order_id` (`order_id`),
  ADD KEY `orders_products__product_id` (`product_id`);

--
-- Indexes for table `{prefix}products`
--
ALTER TABLE `{prefix}products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products__cat_id` (`cat_id`);

--
-- Indexes for table `{prefix}products_images`
--
ALTER TABLE `{prefix}products_images`
  ADD PRIMARY KEY (`prodimg_id`),
  ADD KEY `product_images__product_id` (`product_id`);

--
-- Indexes for table `{prefix}users`
--
ALTER TABLE `{prefix}users`
  ADD PRIMARY KEY (`user_id`);


--
-- Constraints for dumped tables
--

--
-- Constraints for table `{prefix}orders`
--
ALTER TABLE `{prefix}orders`
  ADD CONSTRAINT `orders__user_id` FOREIGN KEY (`user_id`) REFERENCES `{prefix}users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `{prefix}orders_products`
--
ALTER TABLE `{prefix}orders_products`
  ADD CONSTRAINT `orders_products__order_id` FOREIGN KEY (`order_id`) REFERENCES `{prefix}orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_products__product_id` FOREIGN KEY (`product_id`) REFERENCES `{prefix}products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `{prefix}products`
--
ALTER TABLE `{prefix}products`
  ADD CONSTRAINT `products__cat_id` FOREIGN KEY (`cat_id`) REFERENCES `{prefix}categories` (`cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `{prefix}products_images`
--
ALTER TABLE `{prefix}products_images`
  ADD CONSTRAINT `product_images__product_id` FOREIGN KEY (`product_id`) REFERENCES `{prefix}products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
