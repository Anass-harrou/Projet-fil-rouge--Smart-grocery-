-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 juin 2022 à 21:09
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `payed`
--

CREATE TABLE `payed` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `facture` varchar(255) NOT NULL,
  `clnum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `payed`
--

INSERT INTO `payed` (`id`, `name`, `facture`, `clnum`) VALUES
(141, 'ilias', '20', 'customers96'),
(142, 'ilias', '32', 'customers97');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `Product`, `Price`, `Name`) VALUES
(1, '671111', '19', 'THE'),
(2, '67111176', '5', 'LAIT'),
(3, '67111145', '25', 'CAFE'),
(4, '67111122', '10', 'FROMAGE'),
(5, '67115122', '7', 'EAU'),
(6, '67111100', '8', 'SUCRE'),
(7, '67111114', '11', 'LIMONADE'),
(8, '639337738', '18', 'FARINE');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `solde` varchar(50) NOT NULL,
  `carte` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `solde`, `carte`, `statut`, `password`, `created_at`) VALUES
(15, 'ilias', '948', ' 5A BF 38 3B', 'Activé', '$2y$10$Gtk3ljjZtqyWOEOGUEvXJOMcyvudGIH5GYCyOTIJufmAO4uHaD4OO', '2022-06-21 12:55:06'),
(16, 'mohamed', '0', '', '', '$2y$10$HvWxwHfEuvz30wWaRka95eB/zJlgjxwjstU/WtKY2rDjT28nFISUe', '2022-06-21 13:08:19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `payed`
--
ALTER TABLE `payed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `payed`
--
ALTER TABLE `payed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
