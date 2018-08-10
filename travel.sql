-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 10 2018 г., 12:08
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `travel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `img_category_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `img_category_id`, `path`, `description`, `created_at`, `updated_at`) VALUES
(11, 11, 'images/site_11/H6HEYYV9ekJYXWIaSds3Hl2SxGa9iMTKZ8pqPd6F.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(12, 11, 'images/site_11/21kIHh478ObF6MzqhnbSDS5Cj8StljUEJfRAnfz6.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(13, 11, 'images/site_11/x3orFlH4fa5YzZcuJwlWTVkiZtTlejtToJs3cmKJ.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(14, 11, 'images/site_11/gAb3qU4MrDzlkAzXXWhvv59KIjRMVhLOwG9N3LG8.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(15, 11, 'images/site_11/slwJqHjR7cWsVOz2FQpnAbcEZ6gfPjgsG0wGF5R8.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(16, 11, 'images/site_11/sIyoM8D0PTKV3LUat0nUUazbMyVQzLE1JlJry0Qw.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(17, 11, 'images/site_11/r0FiGxJDtXFPktRDp7dlzD0PUfL7NRSCXWd1mAef.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(18, 11, 'images/site_11/Y4LhqxUnE5oRQnKDa3jNMB50UaRu32lp2tuiFiSN.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25'),
(19, 11, 'images/site_11/sNwyXd0yYwWEHMkiIdH5g2AqDYaoRyxzcUw1yKdA.png', NULL, '2018-08-04 18:59:25', '2018-08-04 18:59:25');

-- --------------------------------------------------------

--
-- Структура таблицы `img_categories`
--

CREATE TABLE `img_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `img_categories`
--

INSERT INTO `img_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(11, 'Header сайта', 'Карусель фотографий в верхней части главной страницы', '2018-08-03 19:01:49', '2018-08-03 19:01:49'),
(12, 'Northern territories', 'Фоновая карусель для раздела северных территорий', '2018-08-04 18:09:34', '2018-08-10 08:21:43');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_02_090400_create_img_categories_table', 1),
(4, '2018_08_02_091005_create_images_table', 2),
(5, '2018_08_02_092340_create_nav_admins_table', 3),
(6, '2018_08_02_092920_create_table_roles', 4),
(7, '2018_08_02_093141_add_fillables_to_users_table', 5),
(8, '2018_08_02_094355_add_index_unique_column_name_to_users', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `nav_admins`
--

CREATE TABLE `nav_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', '2018-08-01 21:00:00', '2018-08-01 21:00:00'),
(2, 'Пользователь', '2018-08-01 21:00:00', '2018-08-01 21:00:00'),
(3, 'Автор', '2018-08-01 21:00:00', '2018-08-01 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Блокирован','Активен') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Активен',
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription` enum('Подписан','Не подписан') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Не подписан',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `status`, `login`, `email`, `subscription`, `avatar_path`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Активен', 'kubik', 'ukubik@mail.ru', 'Не подписан', NULL, '$2y$10$5NN7BdI4DR60.9adWbaiIuJMjgRTHuwpKOGX71cEYeUW2kC4BpzHK', 'L1jCbjIEK5YpkiQiNjT9NNg7Z5BM2pghvBTEgptLKsoYZRSjp2t7WgVH3iFF', '2018-08-02 07:03:10', '2018-08-02 07:03:10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_img_categories_id_foreign` (`img_category_id`);

--
-- Индексы таблицы `img_categories`
--
ALTER TABLE `img_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nav_admins`
--
ALTER TABLE `nav_admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_name_unique` (`login`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `img_categories`
--
ALTER TABLE `img_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `nav_admins`
--
ALTER TABLE `nav_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_img_categories_id_foreign` FOREIGN KEY (`img_category_id`) REFERENCES `img_categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
