-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 nov. 2020 à 23:33
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

CREATE DATABASE projetifd;
USE projetifd;
-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_1` varchar(255) DEFAULT NULL,
  `pseudo_2` varchar(255) DEFAULT NULL,
  `attente` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id`, `pseudo_1`, `pseudo_2`, `attente`) VALUES
(1, 'Xxx_DarkSasuke_xxX', 'Ducknorris', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(1, 'Carte'),
(2, 'Chance'),
(3, 'Humoristique');

-- --------------------------------------------------------

--
-- Structure de la table `critiques`
--

CREATE TABLE `critiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_jeu` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `date_crit` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `critiques`
--

INSERT INTO `critiques` (`id`, `id_utilisateur`, `id_jeu`, `nom`, `note`, `content`, `date_crit`) VALUES
(1, 1, 1, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),
(2, 1, 2, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(3, 2, 1, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(4, 2, 2, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `editeur` varchar(255) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `editeur`, `prix`, `description`) VALUES
(1, 'Uno', 'Mattel', 7.5, 'description 1'),
(2, 'Munchkin', 'Edge Entertainement', 19.99, 'description 2');

-- --------------------------------------------------------

--
-- Structure de la table `link_categorie_jeux`
--

CREATE TABLE `link_categorie_jeux` (
  `id_categorie` int(11) DEFAULT NULL,
  `id_jeux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `link_categorie_jeux`
--

INSERT INTO `link_categorie_jeux` (`id_categorie`, `id_jeux`) VALUES
(1, 1),
(2, 1),
(1, 2),
(3, 2);

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
(1, 2, -1);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(5000) DEFAULT NULL,
  `id_auteur` int(11) DEFAULT NULL,
  `id_reponse` int(11) DEFAULT NULL,
  `id_critiques` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `content`, `id_auteur`, `id_reponse`, `id_critiques`) VALUES
(1, 'Bien dis bouffi !', 2, NULL, 1),
(2, 'Comment ca ? Moi bouffi ?', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `bio` varchar(5000) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `date_de_creation` date DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `bio`, `date_de_naissance`, `date_de_creation`, `email`) VALUES
(1, 'Xxx_DarkSasuke_xxX', 'onsenfout', 'Sarkozy', 'Nicolas', '#TrueGamerForever', '1955-01-01', '2020-11-04', 'nicolas@sarkozy.com'),
(2, 'Ducknorris', 'onsenfout', 'Caillier', 'Paul', 'Jaime les Cannards', '2002-03-10', '2020-11-04', 'paul.caillier2002@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `critiques`
--
ALTER TABLE `critiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `link_categorie_jeux`
--
ALTER TABLE `link_categorie_jeux`
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `id_jeux` (`id_jeux`);

--
-- Index pour la table `link_utilisateur_score`
--
ALTER TABLE `link_utilisateur_score`
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_critiques` (`id_critiques`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reponse` (`id_reponse`),
  ADD KEY `id_critiques` (`id_critiques`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
