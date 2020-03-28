-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 29 2020 г., 09:49
-- Версия сервера: 10.3.18-MariaDB-0+deb10u1
-- Версия PHP: 7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yeticave`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bets`
--

CREATE TABLE `bets` (
  `id` int(11) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bets`
--

INSERT INTO `bets` (`id`, `date_create`, `price`, `user_id`, `lot_id`) VALUES
(1, '2020-03-12 09:29:26', '11500', 2, 1),
(2, '2020-03-12 09:29:26', '8000', 3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Ботинки'),
(1, 'Доски и лыжи'),
(5, 'Инструменты'),
(2, 'Крепления'),
(4, 'Одежда'),
(6, 'Разное');

-- --------------------------------------------------------

--
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `id` int(11) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `date_expire` date NOT NULL,
  `step` decimal(10,0) NOT NULL DEFAULT 0,
  `favorites` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `winner` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `date_create`, `title`, `description`, `img`, `price`, `date_expire`, `step`, `favorites`, `user_id`, `winner`, `category_id`) VALUES
(1, '2020-03-09 16:39:05', '2014 Rossignol District Snowboard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-1.jpg', '10999', '2020-04-11', '0', NULL, 1, NULL, 1),
(2, '2020-03-10 16:39:05', 'DC Ply Mens 2016/2017 Snowboard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-2.jpg', '15999', '2020-04-20', '0', NULL, 3, NULL, 1),
(3, '2020-03-11 16:39:05', 'Крепление Union Contacts Pro 2015 года размер L/XL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-3.jpg', '8000', '2020-04-18', '0', NULL, 1, NULL, 2),
(4, '2020-03-11 16:39:05', 'Ботинки для сноуборда DC Mutiny Charocal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-4.jpg', '10999', '2020-04-10', '0', NULL, 2, NULL, 3),
(5, '2020-03-11 16:39:05', 'Куртка для сноуборда DC Mutiny Charocal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-5.jpg', '7500', '2020-04-18', '0', NULL, 2, NULL, 4),
(6, '2020-03-12 09:00:00', 'Маска Oakley Canopy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n     Sed nisi lacus sed viverra tellus in hac habitasse platea.\r\n     Urna cursus eget nunc scelerisque viverra.\r\n     Sed sed risus pretium quam vulputate dignissim suspendisse.\r\n     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.', 'img/lot-6.jpg', '5400', '2020-03-29', '0', NULL, 1, NULL, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `contacts` text NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `date_create`, `email`, `name`, `password`, `avatar`, `contacts`, `token`) VALUES
(1, '2020-03-11 16:39:04', 'alexey@mail.com', 'Алексей', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', NULL, '+7(999)898-98-89', '5817684'),
(2, '2020-03-11 16:39:04', 'olga@mail.com', 'Ольга', '$2y$10$DfPGYJV9KfhP6jkA1W8L/u4pVYyogiPPrfpf30vw7wL73aalLy2a.', NULL, '+7(888)999-88-99', NULL),
(3, '2020-03-11 16:39:04', 'svetlana@mail.com', 'Светлана', '$2y$10$hqgBi/5OKHcaB2pafc.bsOoU9nleWb7/qjOWl4twuexxfCDFc1QQ.', NULL, '+7(898)888-99-88', NULL),
(4, '2020-03-18 11:14:42', 'fromsotis@gmail.com', 'Alexey', '$2y$10$qYt9aFy4lT0A3XpaYPFtqO.V.fCQwUWdbFv.Eogb38QxF2DGDnOYG', 'uploads/user.jpg', '8 950 296 57 30', '9860621'),
(5, '2020-03-19 09:28:25', 'alsvol@mail.ru', 'Olga', '$2y$10$wILxPGhaQwju70ObTwJIqO.aaEeSJY.yctfpnVM3sbqUQE5cURG5u', NULL, '8 950 296 57 77', NULL),
(6, '2020-03-19 09:43:08', 'womxez09hez2@mail.ru', 'Svetlana', '$2y$10$kukcHNWjtzVnPvQ8N5gBfO.Dk9pxkWwsCFDzQJkz.ONN0edowdw4C', NULL, '8 999 856 63 65', NULL),
(7, '2020-03-19 10:40:26', 'john@mail.com', 'Джон', '$2y$10$EbdRTcWcCT7uj7/FbS4xDePTtBt3zKI/c/JYM6zJchOfijJN3bap.', NULL, '8 968 963 58 25', NULL),
(8, '2020-03-19 12:08:04', 'feofan@monah.god', 'Феофан', '$2y$10$IVXfHSct9yGdLyqrwbvQteeTvOJMbmLXjNYapqsU8KntLtPrFhs1.', NULL, '8 960 599 56 96', NULL),
(9, '2020-03-20 10:30:58', 'abc@mail.com', 'Марина', '$2y$10$AaCrJy23KgYl39d5k9CTheU6L7IoGyd.116yMr.22MmryV2KH5evW', 'uploads/dym_rozovyj_pelena_115937_1920x1080.jpg', '8 965 58 58 585', NULL),
(10, '2020-03-26 11:13:07', 'stmt_test@mail.com', 'Stmt', '$2y$10$.5/y9jU7dwlKqTLb4ki1.OzdjmDnqo2xw44mf0lMuOyndbdzwyLE.', 'uploads/Debian Linux Os Black.png', 'Я тестовый stmt (подготовленный запрос)', '8416285');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_bets_date_create` (`date_create`),
  ADD KEY `index_bets_price` (`price`),
  ADD KEY `fk_bets_users` (`user_id`),
  ADD KEY `fk_bets_lots` (`lot_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_categories_name` (`name`);

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_lots_title` (`title`),
  ADD KEY `index_lots_description` (`description`(100)),
  ADD KEY `index_lots_price` (`price`),
  ADD KEY `index_lots_date_expire` (`date_expire`),
  ADD KEY `fk_lots_winner_users` (`user_id`),
  ADD KEY `fk_lots_categories` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index_users_email` (`email`),
  ADD KEY `index_users_name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bets`
--
ALTER TABLE `bets`
  ADD CONSTRAINT `fk_bets_lots` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bets_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `fk_lots_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lots_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lots_winner_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
