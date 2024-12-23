-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 22 2024 г., 18:09
-- Версия сервера: 11.1.2-MariaDB
-- Версия PHP: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `petshop_web`
--
CREATE DATABASE IF NOT EXISTS `petshop_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `petshop_web`;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Staff') NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `avatar`, `email`, `password`, `role`, `is_active`, `created_at`) VALUES
(3, 'Site Administrator', '1608357080619.png', 'admin@mail.com', '$2y$10$DsJvLX1WH3TzONzf9xYYz.JXJnY/WXwhqEbHgIuZdbD0uPphzLgqe', 'Admin', 1, '2020-12-19 05:51:51'),
(5, 'Natalya', 'default.jpg', 'ifelseiforelif@gmail.com', '$2y$10$6powosY7Tul0P9kiO7k1LeAPGXspazXD.kN0OYHlA0wvWXq1Zha6.', 'Admin', 1, '2024-12-22 12:37:00');

-- --------------------------------------------------------

--
-- Структура таблицы `admin_tokens`
--

CREATE TABLE `admin_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `bank_id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `number` varchar(20) NOT NULL,
  `holder` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `bank_accounts`
--

INSERT INTO `bank_accounts` (`bank_id`, `logo`, `name`, `number`, `holder`) VALUES
(3, '1622336131728.jpg', 'MonoBank', '823627863', 'Petrenko Taras');

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `image`) VALUES
(1, 'Food', 'foods', '1605481281645.jpg'),
(2, 'Pets', 'pets', '1605481292032.jpg'),
(3, 'Cats', 'cats', '1605483254673.jpg'),
(4, 'Accessories', 'accessories', '1606404043004.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `phone` char(15) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `avatar`, `phone`, `address`, `email`, `password`, `is_active`, `created_at`) VALUES
(6, 'Site Customer', '1608357453866.png', '081939448487', 'street Test 2', 'customer@mail.com', '$2y$10$heyAPdEKex5I3SPZ5RA92OCP8cNqpapPFRWkuF/LPFqLZeuPOVC0m', 1, '2024-12-22 14:30:28'),
(8, 'Natalya', '1734886084768.jpg', '380665445448', 'street Test 3', 'ifelseiforelif@gmail.com', '$2y$10$vCEmMjZ.SWTLMXLDFj7unuWze0Zo.4badgjYmpacr7pKycLT6tTqW', 1, '2024-12-22 16:48:04'),
(9, 'test', 'default.jpg', '3805252525', 'str Test55', 'ifelseiforelif22@gmail.com', '$2y$10$iULOLfIAyJuWAj1fUH1AHOfVHbq2jdxTGTky32/4Epl6URMqp/S.K', 1, '2024-12-22 15:49:29');

-- --------------------------------------------------------

--
-- Структура таблицы `customer_tokens`
--

CREATE TABLE `customer_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `groomings`
--

CREATE TABLE `groomings` (
  `grooming_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `customer_phone` char(15) NOT NULL,
  `customer_address` text NOT NULL,
  `pet_type` enum('Cat','Dog') NOT NULL,
  `grooming_status` enum('Registered','Accepted','Performed','Completed') NOT NULL,
  `package_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_finished` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `images` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`item_id`, `name`, `slug`, `images`, `stock`, `price`, `description`, `category_id`, `created_at`) VALUES
(3, 'Minimalist Cat Cage Model', 'minimalist-cat-cage-model', '1701811888259.png', 10, 150000, 'Directly from the craftsmen 🛠️, Made from solid wood, no wood chips, so it is durable and long-lasting 🏡, ✅ All photos here are REAL and belong to us.', 2, '2024-12-22 17:21:21'),
(5, 'Persian Kitten for Sale, 2 Months Old', 'persian-kitten-for-sale-2-months-old', '1702269988619.jpg', 0, 750000, 'Persian kitten, 2 months old. Buy a pair for 800,000 UAH', 3, '2020-12-21 06:04:59'),
(6, 'Bolt 1Kg Tuna Fish - Cheap Cat Food', 'bolt-1kg-tuna-fish---cheap-cat-food', '1702270123439.jpg', 0, 19700, 'Sell Bolt 1Kg Tuna Fish - Cheap Cat Food - Repack - Cat Food at 19,700 IDR from the online store.', 1, '2024-12-22 17:22:02'),
(7, 'Tokopedia Sale Me-o Meo Tuna Cat Food 1.2 Kg', 'tokopedia-sale-me-o-meo-tuna-cat-food-1-2-kg', '344355423.jpeg', 78, 54000, 'Sell Me-o Meo Tuna Cat Food 1.2 Kg at 54,000 UAH The cheapest price.', 1, '2024-12-22 17:53:21'),
(12, 'Felibite Fish-Shaped Cat Food, 1kg Package', 'felibite-fish-shaped-cat-food-1kg-package', '847477483.jpg', 88, 67000, 'Buy Felibite Fish-Shaped Cat Food 1kg Package in Indonesia for a low price - Shop for Dry Cat Food on Lazada. FREE SHIPPING & COD available.', 1, '2024-12-22 17:33:59'),
(13, 'Sell Aggressive Cat', 'sell-aggressive-cat', '1702269638134.jpg', 9, 290000, 'Sell an aggressive cat, very active. The reason for selling is its annoying face, always wants to fight when it sees someone.', 3, '2024-12-22 17:20:29'),
(16, 'Cheap Cat Collar', 'cheap-cat-collar', '1608357696589.jpg', 51, 35000, '<p>Cat collar at an affordable and reasonable price</p>', 4, '2021-05-29 22:35:54');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `receipent_name` varchar(128) NOT NULL,
  `receipent_phone` char(15) NOT NULL,
  `receipent_address` text NOT NULL,
  `payment_method` enum('cod','transfer') NOT NULL,
  `payment_slip` varchar(128) DEFAULT NULL,
  `total_payment` float NOT NULL,
  `order_status` enum('New','Processed','Delivered','Received') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `info` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Структура таблицы `order_details`
--

CREATE TABLE `order_details` (
  `oder_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `total_price` float NOT NULL,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Триггеры `order_details`
--
DELIMITER $$
CREATE TRIGGER `trigger_qty` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
    UPDATE items SET stock = stock-NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `cost_for_cat` float NOT NULL,
  `cost_for_dog` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `packages`
--

INSERT INTO `packages` (`package_id`, `name`, `slug`, `description`, `cost_for_cat`, `cost_for_dog`, `created_at`) VALUES
(12, 'Complete Bath', 'complete-bath', '', 50000, 80000, '2020-12-19 05:33:05'),
(13, 'Moldy Animal Bath', 'moldy-animal-bath', '', 60000, 85000, '2020-12-19 05:33:27'),
(14, 'Regular Bath', 'regular-bath', '', 40000, 60000, '2020-12-19 05:33:45'),
(15, 'Flea-infested Animal Bath', 'flea-infested-animal-bath', '', 65000, 70000, '2020-12-19 05:35:40');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Индексы таблицы `admin_tokens`
--
ALTER TABLE `admin_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`bank_id`);

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `customer_tokens`
--
ALTER TABLE `customer_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groomings`
--
ALTER TABLE `groomings`
  ADD PRIMARY KEY (`grooming_id`),
  ADD KEY `type_id` (`package_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`customer_id`);

--
-- Индексы таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`oder_details_id`),
  ADD KEY `oder_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `admin_tokens`
--
ALTER TABLE `admin_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `customer_tokens`
--
ALTER TABLE `customer_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `groomings`
--
ALTER TABLE `groomings`
  MODIFY `grooming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `order_details`
--
ALTER TABLE `order_details`
  MODIFY `oder_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `groomings`
--
ALTER TABLE `groomings`
  ADD CONSTRAINT `groomings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groomings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
