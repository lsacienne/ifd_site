-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 nov. 2020 à 17:25
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetifd`
--

-- --------------------------------------------------------

--
-- Structure de la table `link_utilisateur_score`
--

CREATE TABLE `link_utilisateur_score` (
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_critiques` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `link_utilisateur_score`
--

INSERT INTO `link_utilisateur_score` (`id_utilisateur`, `id_critiques`, `value`) VALUES
(2, 1, 1),
(1, 1, 1),
(2, 2, -1),
(1, 2, -1),
(6, 5, -1),
(7, 5, -1),
(3, 5, -1),
(7, 6, 2),
(3, 6, 4),
(2, 8, 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `link_utilisateur_score`
--
ALTER TABLE `link_utilisateur_score`
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_critiques` (`id_critiques`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `link_utilisateur_score`
--
ALTER TABLE `link_utilisateur_score`
  ADD CONSTRAINT `link_utilisateur_score_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `link_utilisateur_score_ibfk_2` FOREIGN KEY (`id_critiques`) REFERENCES `critiques` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
