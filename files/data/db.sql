-- phpMyAdmin SQL Dump
-- version 4.9.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `page_gen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `ucode` varchar(48) NOT NULL COMMENT 'латинские буквы,_,цифры',
  `dictum` varchar(6144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `blocks`
--

INSERT INTO `blocks` (`id`, `ucode`, `dictum`) VALUES
(1, 'title', 'Каркас для лендинг-пейдж'),
(2, 'description', 'Скрипт для создания посадочной страницы'),
(3, 'keywords', 'каркас,frame,лендинг,landing'),
(5, 'h1', 'Каркас для посадочной страницы'),
(6, 'readme', '<h3>Вступление</h3>\r\nШаблон (`/view/front/tamplates/page.php`) представляет собой обычный html+css+js.<br>\r\n\r\nПриложение умышленно написано просто. Все константы определены в /index.php.<br>\r\nЕсли будет нужно расширить функциональность приложения, а это почти наверняка будет<br>\r\nвам нужно, создайте свои контроллеры.<br>\r\n\r\n<h3>Как развернуть приложение</h3>\r\n\r\nИмпортируйте `/files/data/db.sql` в вашу базу данных.<br>\r\nСодержимое данного репозитория положите в корень вашего сайта.<br> \r\nВпишите в `/library/config/config.php` значения для вашей базы данных.<br>\r\nПерейдите по адресу `yoursite.com/staff/viewForm`, используйте demo@demo.ru / qwerty<br>\r\nдля входа в админ.часть.'),
(7, 'company', '&laquo;Побочный эффект&raquo;'),
(26, 'image_dog', 'src=\"files/images/image_dog.jpg\"\r\nalt=\"image_dog\"\r\nwidth=\"480\"\r\n'),
(27, 'hello', 'href=\"files/others/hello.pdf\"\r\ntext=\"Скачать файл hello.pdf\"\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `role`) VALUES
(1, 'demo@demo.ru', '$2y$10$j7BfwKINhwQheQyNKxNq5eFmwMAjoQUwCKSc/oJvY.4ATAcowfUny', 'Administrator');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_code` (`ucode`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
