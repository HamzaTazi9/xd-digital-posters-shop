-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Gegenereerd op: 08 jan 2026 om 19:18
-- Serverversie: 8.0.40
-- PHP-versie: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selfique_store`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Essentials'),
(2, 'Outerwear'),
(3, 'Bottoms'),
(4, 'Accesories');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(19, 7, 390.00, '2026-01-08 16:00:02');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price_each` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_each`) VALUES
(8, 19, 31, 3, 130.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`, `created_at`) VALUES
(32, 'Brown desginers scarf', 50.00, 'uploads/1767895303_3.webp', 4, '2026-01-08 18:19:05'),
(33, 'zwarte trui', 80.00, 'uploads/1767892787_hoodie.jpg', 1, '2026-01-08 18:19:47'),
(34, 'zwarte jas', 130.00, 'uploads/1767892812_fo.jpg', 2, '2026-01-08 18:20:12'),
(35, 'Blauwe designers sjaal', 45.00, 'uploads/1767895259_1.jpg', 4, '2026-01-08 19:00:59'),
(36, 'Grey hoodie', 65.00, 'uploads/1767895431_11.webp', 1, '2026-01-08 19:03:51'),
(37, 'grey hoodie', 80.00, 'uploads/1767895473_12.webp', 1, '2026-01-08 19:04:33'),
(38, 'Warm grey hoodie', 75.00, 'uploads/1767895527_13.jpg', 1, '2026-01-08 19:05:27'),
(39, 'Blue jeans', 60.00, 'uploads/1767895595_1.avif', 3, '2026-01-08 19:06:35'),
(40, 'Grey jeans', 60.00, 'uploads/1767895631_grey jeans.webp', 3, '2026-01-08 19:07:11'),
(41, 'Designer jeans', 80.00, 'uploads/1767895735_2.webp', 3, '2026-01-08 19:08:55'),
(42, 'vintage jeans', 70.00, 'uploads/1767895776_4.jpeg', 3, '2026-01-08 19:09:36'),
(43, 'Green Scarf', 40.00, 'uploads/1767895824_green scarf.jpg', 4, '2026-01-08 19:10:24'),
(44, 'Duck earring', 30.00, 'uploads/1767895896_ee.jpg', 4, '2026-01-08 19:11:36'),
(45, 'Silver jacket', 230.00, 'uploads/1767895950_sil.webp', 2, '2026-01-08 19:12:30'),
(46, 'Beige puffer jacket', 160.00, 'uploads/1767896001_bei.webp', 2, '2026-01-08 19:13:21'),
(47, 'Blue jacket', 300.00, 'uploads/1767896080_1.jpg', 2, '2026-01-08 19:14:40');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 6, 31, 1, 'Heel mooie jas', '2026-01-08 13:09:08'),
(2, 6, 31, 2, 'heel mooie jas.', '2026-01-08 14:55:59');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wallet` int NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `wallet`) VALUES
(4, 'admin', 'admin@admin.com', '$2y$10$8bBcw5xsYqPH9XOmI9Ubu.aZtMIYcnv3Gw41UBLDJU5mjNU.N5hEu', 'admin', '2025-12-29 19:06:50', 1000),
(6, 'hamza', 'hamza.tazi.1225@gmail.com', '$2y$10$2xFhJOzsZb3M7SjxM9s1dO9X0KECswfb4o3JF/BwpD6ldBOqe0VzW', 'user', '2026-01-07 18:16:07', 350),
(7, 'Usertest', 'h.tazi.professional@gmail.com', '$2y$10$aPkuJjoXOfEBL3bi7FxLLeCT87vBgdUgLrYiIJDyvXLr8OR1JPdku', 'user', '2026-01-08 15:59:35', 610);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `order_items`
--
ALTER TABLE `order_items`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
