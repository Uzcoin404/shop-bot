-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2022 at 09:08 AM
-- Server version: 10.5.11-MariaDB-log
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop-bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `product_id`, `name`) VALUES
(1, 1, 'HP'),
(2, 1, 'Acer');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `chat_id` int(11) NOT NULL,
  `lang` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`chat_id`, `lang`) VALUES
(829349149, 'uz');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `price` int(11) NOT NULL,
  `uz` text COLLATE utf8mb4_bin NOT NULL,
  `uk` text COLLATE utf8mb4_bin NOT NULL,
  `photo_url` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `product_id`, `brand_id`, `name`, `price`, `uz`, `uk`, `photo_url`) VALUES
(1, 1, 1, '💻 HP Ultrabook i5 8/512', 12000000, '✅ Windows 10 Pro\n💎 10-avlod Intel® Core™ i5 Protsessor\n💾 8GB RAM va 512GB SSD xotira\n🖥 14\" diagonal Full HD ekran\n⚙️ Iris® Xᵉ Graphics\nZaryad 8+ soat \n🎁 Sovga sifatida HP maxsus ruchkasi', '✅ Windows 10 Pro\n💎 10th Intel® Core™ i5 Processor\n💾 8GB RAM & 512GB SSD storage\n🖥 14\" diagonal Full HD display\n⚙️ Iris® Xᵉ Graphics\n🎁 HP special pen as a gift', 'photos/3.jpeg'),
(2, 1, 1, '💻 HP Ultrabook i5 8/512', 12000000, '✅ Windows 10 Pro\r\n💎 10-avlod Intel® Core™ i5 Protsessor\r\n💾 8GB RAM va 512GB SSD xotira\r\n🖥 14\" diagonal Full HD ekran\r\n⚙️ Iris® Xᵉ Graphics\r\nZaryad 8+ soat \r\n🎁 Sovga sifatida HP maxsus ruchkasi', '✅ Windows 10 Pro\n💎 10th Intel® Core™ i5 Processor\n💾 8GB RAM & 512GB SSD storage\n🖥 14\" diagonal Full HD display\n⚙️ Iris® Xᵉ Graphics\n🎁 HP special pen as a gift', 'photos/2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `uz` longtext COLLATE utf8mb4_bin NOT NULL,
  `uk` longtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uz`, `uk`) VALUES
(1, 'Noutbuk 💻', 'Laptop 💻'),
(2, 'Komplekt(terilgan) kompyuter 🖥', 'Complete computer 🖥'),
(3, 'Monitor 🖥', 'Monitor 🖥'),
(4, 'Klaviatura ⌨️', 'Keyboard ⌨️'),
(5, 'Plata', 'Motherboard'),
(6, 'Sichqoncha 🖱', 'Mouse 🖱'),
(7, 'Server ☁️', 'Server ☁️'),
(8, 'Monoblok 🖥', 'Monoblok 🖥'),
(9, 'Videokarta (GPU)', 'VideoCard (GPU)'),
(10, 'Protsessor (CPU)', 'Processor (CPU)'),
(11, 'Qattiq disk', 'Hard disk'),
(12, 'USB Fleshka', 'USB Flesh card'),
(13, 'Blok pitaniya', 'power supply'),
(14, 'SSD', 'SSD'),
(15, 'Tizimli blok', 'Block Structured'),
(16, 'Ehtiyot qismlar', 'Spare parts');

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `keyword` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `uz` text COLLATE utf8mb4_bin NOT NULL,
  `uk` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id`, `keyword`, `uz`, `uk`) VALUES
(1, 'welcome', 'Assalamu Alaykum', 'Hello'),
(2, 'products', 'Mahsulotlar 🛍', 'Products 🛍'),
(3, 'basket', 'Savatcha 🛒', 'Basket 🛒'),
(4, 'contact', 'Aloqa 📨', 'Contact 📨'),
(5, 'info_bot', 'Bot haqida 📚', 'About bot 📚'),
(6, 'welcome_message', 'Uzcoin Delivery botiga xush kelibsiz 🚀', 'Welcome to the Uzcoin delivery bot 🚀'),
(7, 'choose_lang', 'Tilni almashtirish 🔄', 'Change language 🔄'),
(8, 'no_command1', '_Iltimos tillardan birini tanglang_ ❗️', '_Please choose one of the languages_ ❗️'),
(9, 'no_command2', '_Botda bunday Buyruq mavjud emas Iltimos tugmalardan birini bosing yoki /start bosing_ ❗️', '_There is no such command in the bot Please choose one of the buttons or click /start_ ❗️'),
(10, 'no_command3', '_Bosh Menyuda bunday buyruq mavjud emas_ ❗️', '_There is no such command on the main menu_ ❗️'),
(11, 'back', 'Orqaga ⬅️', 'Back ⬅️'),
(12, 'main_menu', 'Bosh menyu 🏘', 'Main menu 🏘'),
(13, 'no_command4', '_Iltimos mahsulotlardan birini tanlang ❗️_', '_Please choose one of the products ❗️_'),
(14, 'choose_brands', 'Brendlardan birini tanlang', 'Choose on of the brands'),
(15, 'no_brands', '_Bu mahsulot bo\'yicha tovarlar mavjud emas ❗️_', '_There are no goods on this product ❗️_'),
(16, 'tobasket', '🛒 Savatga', '🛒 Basket');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tg_id` bigint(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `referrals` int(11) NOT NULL DEFAULT 0,
  `balance` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tg_id`, `full_name`, `referrals`, `balance`, `date`) VALUES
(7, 829349149, '🇺🇿 Uzcoin Coder 🇺🇿 ', 0, 0, 1648815495);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
