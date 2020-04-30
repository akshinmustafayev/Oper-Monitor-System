-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 14 2018 г., 15:51
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `opermonitorsystemnew`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(16) NOT NULL,
  `computer_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `computers`
--

CREATE TABLE `computers` (
  `id` int(11) NOT NULL,
  `serialnumber` varchar(255) CHARACTER SET latin1 NOT NULL,
  `systemname` varchar(255) NOT NULL,
  `computername` varchar(255) CHARACTER SET latin1 NOT NULL,
  `computervendor` text CHARACTER SET latin1 NOT NULL,
  `domain` text CHARACTER SET latin1 NOT NULL,
  `os` text CHARACTER SET latin1 NOT NULL,
  `ram` text CHARACTER SET latin1 NOT NULL,
  `processor` text CHARACTER SET latin1 NOT NULL,
  `ipaddress` text CHARACTER SET latin1 NOT NULL,
  `harddisk` text CHARACTER SET latin1 NOT NULL,
  `harddiskserial` text CHARACTER SET latin1 NOT NULL,
  `graphicscard` text CHARACTER SET latin1 NOT NULL,
  `lastactiondate` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pathvariable` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `loginhistory`
--

CREATE TABLE `loginhistory` (
  `id` int(200) NOT NULL,
  `systemname` varchar(255) NOT NULL,
  `serialnumber` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` varchar(128) NOT NULL,
  `actiontype` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `messagetext` text NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `access` text NOT NULL,
  `lang` varchar(16) NOT NULL DEFAULT 'en',
  `sidebar` tinyint(1) NOT NULL DEFAULT '1',
  `logindate` varchar(255) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(128) NOT NULL,
  `maxcomputers` int(16) NOT NULL DEFAULT '10',
  `domain` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`, `access`, `lang`, `sidebar`, `logindate`, `block`, `token`, `maxcomputers`, `domain`, `timestamp`) VALUES
(1, 'Akshin', 'Mustafayev', 'admin', '', '{\"access_computers\":\"1\" ,\"access_computers_add\":\"1\" ,\"access_bookmarks\":\"1\" ,\"access_login_events\":\"1\" ,\"access_monitoring\":\"1\" ,\"access_messages\":\"1\" ,\"access_users\":\"1\" ,\"access_users_add\":\"1\"}', 'en', 0, '2018-05-14 16:34:07', 0, '', 10, 'domain', '2000-05-14 13:51:28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `loginhistory`
--
ALTER TABLE `loginhistory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `computers`
--
ALTER TABLE `computers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1321;

--
-- AUTO_INCREMENT для таблицы `loginhistory`
--
ALTER TABLE `loginhistory`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247622;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
