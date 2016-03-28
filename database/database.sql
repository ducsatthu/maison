-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2016 at 12:32 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `maison`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `name`, `descriptions`) VALUES
(1, 'T-Shits 2', 'Mô tả danh mục '),
(4, 'T-Shits', 'Mô tả danh mục ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colors`
--

CREATE TABLE `tbl_colors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_colors`
--

INSERT INTO `tbl_colors` (`id`, `name`, `color`) VALUES
(1, 'Tên màu 2', '#cccccc'),
(2, 'mau 2', '#ccccccc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturers`
--

CREATE TABLE `tbl_manufacturers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_manufacturers`
--

INSERT INTO `tbl_manufacturers` (`id`, `name`, `address`) VALUES
(1, 'Tên nhà sản xuất', 'Địa chỉ'),
(2, 'Tên nhà sản xuất đã sửa', 'Địa chỉ'),
(3, 'Tên nhà sản xuất đã sửa 3', 'Địa chỉ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `price_old` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `price`, `price_old`, `category_id`, `manufacturer_id`, `color_id`, `size_id`, `descriptions`, `image`) VALUES
(1, 'Tên sản phẩm', '1600000', '4000000', 1, 1, 1, 1, 'Thông Tin Đang Được Cập Nhật', '/public/img/products/1/product.png'),
(2, 'Ten nha san xuat gi do', '1500000', '3000000', 4, 1, 2, 2, 'Thông Tin Đang Được Cập Nhật', '/public/img/products/2/product.png'),
(3, 'TEEN GI DO', '1500000', '3000000', 4, 3, 1, 2, 'Thông Tin Đang Được Cập Nhật', '/public/img/products/3/product.png'),
(4, 'Teensanpham', '5000000', '6000000', 1, 3, 2, 1, 'Thông Tin Đang Được Cập Nhật', '/public/img/products/4/product.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`id`, `name`) VALUES
(1, 'nomal'),
(2, 'small');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_colors`
--
ALTER TABLE `tbl_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacturers`
--
ALTER TABLE `tbl_manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_colors`
--
ALTER TABLE `tbl_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_manufacturers`
--
ALTER TABLE `tbl_manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;