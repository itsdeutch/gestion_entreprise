-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 06 mai 2025 à 14:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `telephone`, `adresse`, `created_at`) VALUES
(1, 'HECTOR', 'hector@gmail.com', '698458616', NULL, '2025-05-02 08:49:00'),
(2, 'Christian 237', 'christian237@gmail.com', '697936052', NULL, '2025-05-02 08:49:47'),
(3, 'YOAN KAMENI', 'yoan@gmail.com', '682379295', NULL, '2025-05-02 08:50:34'),
(4, 'BABY ALONE', 'nganguemleslie@gmail.com', '693789036', NULL, '2025-05-02 08:51:37'),
(5, 'Mbiteu yann', 'yann@gmail.com', '690127531', NULL, '2025-05-02 08:52:19');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `email`, `telephone`, `adresse`, `created_at`) VALUES
(1, 'Bizario ', 'Bizario@gmail.com', '698458616', NULL, '2025-05-02 10:15:10'),
(2, 'Christian 237', 'christian237@gmail.com', '640866052', NULL, '2025-05-02 10:15:46'),
(3, 'Badja', 'naomi@gmail.com', '656103174', NULL, '2025-05-02 10:16:50'),
(4, 'HECTOR', 'hector@gmail.com', '674592930', NULL, '2025-05-05 07:31:39');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `date_ajout`, `image`, `created_at`) VALUES
(1, 'ABSOLUTELY DARK ZARA', 'GOOD', 150.00, '2025-05-02 09:16:43', 'uploads/Absolutely.jpg', '2025-05-02 09:16:43'),
(2, 'ANTIQUE BROWN ZARA', 'SMELL GOOD', 200.00, '2025-05-02 09:28:16', 'uploads/ANTIQUE.jpg', '2025-05-02 09:28:16'),
(3, 'BOGOSS-VIBRAN-LEATHER', 'GOOD', 150.00, '2025-05-02 09:28:59', 'uploads/BOGOSS-VIBRAN-LEATHER.jpg', '2025-05-02 09:28:59'),
(4, 'SCANDAL POUR HOMME', 'HIGH', 200.00, '2025-05-02 09:29:50', 'uploads/scandal-pour-homme-le-parfum___250411.jpg', '2025-05-02 09:29:50'),
(5, 'AZZARO', 'GOOD', 150.00, '2025-05-02 09:30:26', 'uploads/AZZARO_CHROME_EDP_100ml_MONTAGE.jpg', '2025-05-02 09:30:26'),
(6, 'LA NUIT DE L\'HOMME ', 'TRES BON', 150.00, '2025-05-05 07:31:09', 'uploads/LA NUIT DE L\'HOMME.jpeg', '2025-05-05 07:31:09');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','utilisateur','membre') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Test', 'test@example.com', '$2y$10$hYwUpR.p3eFTFjPEYmZ69uPV/N23i6hKMW8lCQ1sF5mHQHGMUfsaa', 'utilisateur', '2025-05-02 08:20:08'),
(3, 'admin', 'admin@example.com', '$2y$10$oO8kHPiv3egsX51DXqfAOek0dfrVH.xweE.aNqX/0okLRVgLenyYi', 'admin', '2025-05-02 08:46:38'),
(6, 'hector', 'hector@gmail.com', '$2y$10$UEsh3RgXEs6VpfdsSNnDEucGGiL.D2N.Eh/ffwg1gk92wt2jd7C2m', 'admin', '2025-05-02 10:34:13');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `nombre_vendu` int(11) NOT NULL DEFAULT 1,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `produit`, `montant`, `produit_id`, `nom`, `email`, `telephone`, `quantite`, `nombre_vendu`, `prix`) VALUES
(7, '', 200.00, 1, 'ABSOLUTELY DARK ZARA', 'hector@gmail.com', '698458616', 1, 1, 150.00),
(8, '', 150.00, 1, 'AZZARO', 'Bizario@gmail.com', '674592930', 1, 1, 150.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ventes_produit` (`produit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `fk_ventes_produit` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
