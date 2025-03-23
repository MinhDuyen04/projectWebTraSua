-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trasuaweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `productID` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ngay` timestamp NOT NULL DEFAULT current_timestamp(),
  `productName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPRESSED;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id_infor` int(5) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `dienthoai` text NOT NULL,
  `diachi` text NOT NULL,
  `ghichu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id_infor`, `hoten`, `dienthoai`, `diachi`, `ghichu`) VALUES
(1, 'nguyen phu cuong', '0355205304', '4343434', '434343'),
(2, 'nguyen phu cuong', '0355205304', '4343434', '434343'),
(3, 'nguyen phu cuong', '0355205304', '4343434', '434343'),
(4, 'nguyen phu cuong', '0355205304', '4343434', '434343'),
(5, 'nguyen phu cuong', '0355205304', '434', '434354'),
(6, 'minh duyen', '0913982394', 'ádadsd', ''),
(7, 'minh duyen', '0913982394', 'ádadsd', ''),
(8, 'minh duyen', '0913982394', '70 tân chánh hiệp', ''),
(9, 'duyen', '0913987471', 'ádadaj', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` text NOT NULL,
  `productType` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `count` int(5) NOT NULL,
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productType`, `price`, `count`, `trangthai`) VALUES
(1, 'Trà Chanh Thái', 'fruittea', 20000, 15, 1),
(2, 'Happy Tea', 'fruittea', 30000, 10, 1),
(3, 'Trà Bưởi Hồng', 'fruittea', 40000, 5, 1),
(4, 'Trà Chanh Vàng', 'fruittea', 30000, 2, 1),
(5, 'Trà Chanh', 'fruittea', 40000, 1, 1),
(6, 'Trà Đác Thơm', 'fruittea', 40000, 2, 1),
(7, 'Trà Đào Cam Sả', 'fruittea', 30000, 5, 1),
(8, 'Trà Đào', 'fruittea', 40000, 10, 1),
(9, 'Trà Dâu Tằm', 'fruittea', 40000, 3, 1),
(10, 'Trà Dưa Lưới', 'fruittea', 40000, 5, 1),
(11, 'Trà Long Nhãn', 'fruittea', 40000, 6, 1),
(12, 'Trà Mãng Cầu', 'fruittea', 40000, 9, 1),
(13, 'Trà Ổi Hồng', 'fruittea', 40000, 6, 1),
(14, 'Trà Tắc', 'fruittea', 40000, 15, 0),
(15, 'Trà Thanh Long', 'fruittea', 40000, 5, 0),
(16, 'Trà Trái Cây Nhiệt Đới', 'fruittea', 40000, 7, 0),
(17, 'Trà Vải', 'fruittea', 40000, 4, 0),
(18, 'Trà Dâu', 'fruittea', 40000, 6, 1),
(19, 'Hồng Trà Sữa', 'milktea', 40000, 15, 1),
(20, 'Trà Sữa Dâu', 'milktea', 20000, 5, 1),
(21, 'Trà Olong Sữa Than Tre', 'milktea', 40000, 7, 1),
(22, 'Trà Olong Sữa', 'milktea', 20000, 8, 1),
(23, 'Trà Sữa Bạc Hà', 'milktea', 40000, 9, 1),
(24, 'Trà Sữa Hoa Nhài', 'milktea', 40000, 2, 1),
(25, 'Trà Sữa Kem Trứng Khè', 'milktea', 45000, 6, 1),
(26, 'Trà Sữa Khoai Môn', 'milktea', 40000, 0, 1),
(27, 'Trà Sữa Matcha', 'milktea', 40000, 0, 1),
(28, 'Trà Sữa Rang', 'milktea', 40000, 0, 1),
(29, 'Trà Sữa Socola Bạc Hà', 'milktea', 40000, 0, 1),
(30, 'Trà Sữa Socola', 'milktea', 40000, 0, 1),
(31, 'Trà Sữa Dưa Lưới', 'milktea', 40000, 0, 1),
(32, 'Trà Sữa Thái Xanh', 'milktea', 40000, 0, 1),
(33, 'Trà Sữa Than Tre', 'milktea', 40000, 0, 0),
(34, 'Trà Sữa Truyền Thống', 'milktea', 40000, 0, 0),
(35, 'Trà Sữa Việt Quất', 'milktea', 40000, 0, 0),
(36, 'Trà Sữa Xoài', 'milktea', 40000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) NOT NULL,
  `typeuser` varchar(20) NOT NULL,
  `phone` text NOT NULL,
  `id_user` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `typeuser`, `phone`, `id_user`) VALUES
('thong1', '0000', 'custom', '038131991445', 1),
('Duyen', '0001', 'custom', '0417418241', 2),
('A', '0002', 'custom', '4140140140', 3),
('B', '13131', 'custom', '84141409109', 4),
('admin', 'admin', 'admin', '123456', 5),
('2251120412', 'abc', '', '02251120412', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_infor`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id_infor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
