-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2023 at 05:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_shop`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `allproduk`
-- (See below for the actual view)
--
CREATE TABLE `allproduk` (
`product_name` varchar(255)
,`image` text
,`price` decimal(15,2)
,`id` int(11)
,`category_id` int(11)
,`product_code` varchar(20)
,`unit` varchar(100)
,`description` text
,`stock` int(11)
,`category_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `allproduksearch`
-- (See below for the actual view)
--
CREATE TABLE `allproduksearch` (
`product_name` varchar(255)
,`image` text
,`id` int(11)
,`price` decimal(15,2)
,`category_id` int(11)
,`product_code` varchar(20)
,`unit` varchar(100)
,`description` text
,`stock` int(11)
,`category_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `name`, `phone_number`, `email`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'CT001', 'Fatqan Rama', '085745726082', 'fatqanramadhiansyah@gmail.com', 'JL. KH Hasyim Ashari', '2023-10-25 00:28:53', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(100) NOT NULL DEFAULT 'PCS' COMMENT 'satuan',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0 COMMENT 'stock',
  `image` text DEFAULT NULL COMMENT 'gambar dari product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `product_code`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `description`, `price`, `unit`, `discount_amount`, `stock`, `image`) VALUES
(60, 'Lego Tester', 2, 'LEGO0012', '1', '2023-11-15 16:27:22', '2023-11-15 16:27:42', NULL, NULL, 'Lego Unik Asli', 30000.00, 'PCS', 0.00, 312, '[\"images\\/1700065642_legotest2.jpg\",\"images\\/1700065642_legotest1.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `products_circulations`
--

CREATE TABLE `products_circulations` (
  `id` int(11) NOT NULL,
  `trx_date` date NOT NULL,
  `reff` varchar(20) DEFAULT NULL,
  `in` int(11) NOT NULL DEFAULT 0,
  `out` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `remaining_stock` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'Sports', '2023-10-11 06:32:38', NULL, NULL, NULL, '1'),
(2, 'Daily', '2023-10-11 06:32:42', NULL, NULL, NULL, '1'),
(3, 'Accesoris', '2023-10-11 06:32:54', NULL, NULL, NULL, '1'),
(4, 'Electronic', '2023-10-23 02:14:58', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `trx_date` date NOT NULL,
  `sub_amount` decimal(15,2) DEFAULT NULL COMMENT 'total semua',
  `amount_total` decimal(15,2) DEFAULT NULL COMMENT 'total setelah diskon',
  `discount_amount` decimal(15,0) DEFAULT NULL COMMENT 'nominal diskon',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `total_products` int(11) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `amount_total` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `trx_date` date NOT NULL,
  `sub_amount` decimal(15,2) DEFAULT NULL COMMENT 'total semua',
  `amount_total` decimal(15,2) DEFAULT NULL COMMENT 'total setelah diskon',
  `discount_amount` decimal(15,0) DEFAULT NULL COMMENT 'nominal diskon',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `total_products` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `amount_total` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `testing_view`
-- (See below for the actual view)
--
CREATE TABLE `testing_view` (
`id` int(11)
,`product_name` varchar(255)
,`product_code` varchar(20)
,`description` text
,`price` decimal(15,2)
,`category_name` varchar(255)
,`category_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `username`, `password`, `last_login_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `group_id`, `is_active`) VALUES
(1, 'Super Admin', 'super@gmail.com', '001122334455', 'uadmin', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:23:15', '2023-10-11 06:23:59', NULL, NULL, 1, '1'),
(2, 'Seller Satu', 'seller@gmail.com', '001122334456', 'seller', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:24:40', NULL, NULL, NULL, 2, '1'),
(3, 'Admin Product', 'adminproduct@gmail.com', '001122334457', 'products', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:25:14', NULL, NULL, NULL, 3, '1'),
(5, 'Ramaa', 'ryushineo@gmail.com', '0857', '0857', 'e04f28cc33cb20274dd3ff44e600a923', NULL, '2023-11-01 14:41:20', NULL, NULL, NULL, 3, '1'),
(6, 'Fatqan Rama', 'fatqan@gmail.com', '085745726082', '085745726082', 'f4b02e625219c6754afb85b316d6164a', NULL, '2023-11-01 14:55:46', NULL, NULL, NULL, 3, '1'),
(11, 'Ramaaa', 'rammm@gmail.com', '085730340221', '085730340221', 'f4b02e625219c6754afb85b316d6164a', NULL, '2023-11-06 02:32:19', NULL, NULL, NULL, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`, `description`) VALUES
(1, 'Super Admin', '2023-10-11 06:19:54', '2023-10-11 06:20:33', NULL, NULL, '1', 'Group user super admin'),
(2, 'Seller', '2023-10-11 06:20:08', '2023-10-11 06:21:17', NULL, NULL, '1', 'Group user seller'),
(3, 'Admin Products', '2023-10-11 06:21:32', '2023-10-11 06:21:40', NULL, NULL, '1', 'Group user admin product');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `code`, `name`, `phone_number`, `email`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'VND001', 'Fatqan Rama', '085745726082', 'fatqanramadhiansyah@gmail.com', 'JL KH Hasyim Ashari', '2023-10-25 00:31:30', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Structure for view `allproduk`
--
DROP TABLE IF EXISTS `allproduk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allproduk`  AS SELECT `products`.`product_name` AS `product_name`, `products`.`image` AS `image`, `products`.`price` AS `price`, `products`.`id` AS `id`, `products`.`category_id` AS `category_id`, `products`.`product_code` AS `product_code`, `products`.`unit` AS `unit`, `products`.`description` AS `description`, `products`.`stock` AS `stock`, `product_categories`.`category_name` AS `category_name` FROM (`products` join `product_categories` on(`products`.`category_id` = `product_categories`.`id`)) ORDER BY `products`.`id` ASC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Structure for view `allproduksearch`
--
DROP TABLE IF EXISTS `allproduksearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allproduksearch`  AS SELECT `products`.`product_name` AS `product_name`, `products`.`image` AS `image`, `products`.`id` AS `id`, `products`.`price` AS `price`, `products`.`category_id` AS `category_id`, `products`.`product_code` AS `product_code`, `products`.`unit` AS `unit`, `products`.`description` AS `description`, `products`.`stock` AS `stock`, `product_categories`.`category_name` AS `category_name` FROM (`products` join `product_categories` on(`products`.`category_id` = `product_categories`.`id`)) WHERE `products`.`product_name` like '%lego%' OR `products`.`category_id` like '%lego%' OR `products`.`description` like '%lego%' ORDER BY `products`.`id` ASC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Structure for view `testing_view`
--
DROP TABLE IF EXISTS `testing_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `testing_view`  AS SELECT `products`.`id` AS `id`, `products`.`product_name` AS `product_name`, `products`.`product_code` AS `product_code`, `products`.`description` AS `description`, `products`.`price` AS `price`, `product_categories`.`category_name` AS `category_name`, `products`.`category_id` AS `category_id` FROM (`products` join `product_categories` on(`products`.`category_id` = `product_categories`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_UN` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_UN` (`product_code`),
  ADD KEY `products_FK` (`category_id`);

--
-- Indexes for table `products_circulations`
--
ALTER TABLE `products_circulations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_UN` (`code`),
  ADD KEY `purchase_FK` (`vendor_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_FK` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_UN` (`code`),
  ADD KEY `sales_FK` (`customer_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_details_FK` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_UN` (`username`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_UN` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products_circulations`
--
ALTER TABLE `products_circulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_FK` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_FK` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
