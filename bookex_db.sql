-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql-bookex
-- Время создания: Сен 08 2023 г., 18:01
-- Версия сервера: 8.0.34
-- Версия PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookex_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(50, 2, 'Robert Kiyosaki - Rich Dad', 25, 2, 'kiyosaki-rich-dad-poor-dad.jpg'),
(51, 2, 'Goethe - Faust', 16, 1, 'goethe-faust-330x495.jpg'),
(52, 2, 'Shakespeare - Hamlet', 20, 2, 'shakespeare-hamlet-330x495.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 2, 'Benjamin', 'benj@bookex.com', '333-333-3333', 'Super shop! Thx for reading. Love u very much. Lord of the Rings is awesome.'),
(2, 2, 'Dima', 'benj@bookex.com', '912-912-0000', 'Hello! Can i buy something from your shop?'),
(3, 2, 'Dima', 'benj@bookex.com', '333-333-3333', 'You\'re the best! All around!'),
(5, 4, 'fred', 'fred@bookex.com', '123-456-7890', 'Good-good!');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `total_products` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 2, 'Buba Smith', '222-222-2222', 'buba@bookex.com', 'mir', 'Apartment number: 3, Vivec str. 6, Balmora, Morrowind - 025025', '|| J. R. R. Tolkien - The Fellowship of the Ring (1) || J. R. R. Tolkien - The Two Towers (1) || J. R. R. Tolkien - The Return of the King (1) || Shakespeare - Hamlet (1) ', 83, '29-Nov-2022', 'completed'),
(3, 2, 'Benjamin', '333-333-3333', 'benj@bookex.com', 'credit card', 'Apartment number: 18, Tribunal str. 18, Sadrith Mora, Morrowind - 033033', '|| George Orwell - 1984 (1) || Goethe - Faust (2) || Robert Kiyosaki - Rich Dad (1) ', 75, '30-Nov-2022', 'pending'),
(4, 2, 'Dima', '912-912-8888', 'buba@bookex.com', 'paypal', 'Apartment number: 135, Saint str. 8, Ekaterinburg, Russia - 038038', '|| J. R. R. Tolkien - The Fellowship of the Ring (1) || J. R. R. Tolkien - The Two Towers (1) || J. R. R. Tolkien - The Return of the King (1) || Robert Martin - Clean Code (1) || Shakespeare - Hamlet (1) ', 109, '02-Dec-2022', 'completed'),
(5, 4, 'Fred', '123-456-7890', 'fred@bookex.com', 'mir', 'Apartment number: 3, Biba, Buba, Rambo - 333333', '|| Robert Martin - Clean Code (1) ', 26, '01-Aug-2023', 'pending'),
(6, 4, 'fred', '123-456-7890', 'fred@bookex.com', 'mir', 'Apartment number: 5, Biba, Buba, Rambo - 444444', '|| George Orwell - 1984 (1) ', 18, '01-Aug-2023', 'pending');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Ayn Rand - Atlas Shrugged', 20, 'rand-atlas-shrugged-330x495.jpg'),
(2, 'Robert Martin - Clean Code', 26, 'martin-clean-code-330x495.jpg'),
(3, 'George Orwell - 1984', 18, 'orwell-nineteen-eighty-four-330x495.jpg'),
(4, 'J. R. R. Tolkien - The Fellowship of the Ring', 21, 'tolkien-fellowship-of-the-ring-330x495.jpg'),
(5, 'J. R. R. Tolkien - The Two Towers', 21, 'tolkien-two-towers-330x495.jpg'),
(6, 'J. R. R. Tolkien - The Return of the King', 21, 'tolkien-return-of-the-king-330x495.jpg'),
(7, 'Robert Kiyosaki - Rich Dad', 25, 'kiyosaki-rich-dad-poor-dad.jpg'),
(8, 'Goethe - Faust', 16, 'goethe-faust-330x495.jpg'),
(9, 'Shakespeare - Hamlet', 20, 'shakespeare-hamlet-330x495.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Zepp-admn', 'zeppadmn@bookex.com', 'f42431f35bd95035e2ee2a16ea6b618e', 'admin'),
(2, 'benjamin', 'benj@bookex.com', 'f42431f35bd95035e2ee2a16ea6b618e', 'user'),
(3, 'Jaba', 'jaba@bookex.com', 'f42431f35bd95035e2ee2a16ea6b618e', 'user'),
(4, 'fred', 'fred@bookex.com', 'f42431f35bd95035e2ee2a16ea6b618e', 'user'),
(5, 'frank', 'frank@bookex.com', 'f42431f35bd95035e2ee2a16ea6b618e', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
