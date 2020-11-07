
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 06 nov. 2020 à 01:06
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
`id` int(11) NOT NULL,
`id1` int(11) NOT NULL,
`id2` int(11) NOT NULL,
`attente` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id`, `id1`, `id2`, `attente`) VALUES
(6, 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
`id` int(11) NOT NULL,
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
`id` int(11) NOT NULL,
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
(4, 2, 2, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),
(5, 2, 2, 'pas ouf ouf', 4, 'J\'ai pas trop aimé me faire déglingué par des elfes clerics sur la fin. C\'est franchement rageant', '2020-11-03'),
(6, 3, 1, 'grave bien', 7, 'C\'est vraiment un super jeu. J\'adore me prendre des +25 pour avoir eu le malheur de me mettre à côté d\'un mauvais joueur :)))).\r\n\'fin bref c\'est cool pour golri avec les rheys', '2020-11-04'),
(8, 3, 1, 'un truc de ouf de gros dingue de malade de ouf ( vous allez adorer sans déconner)', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam massa velit, placerat commodo hendrerit ornare, mollis nec ante. Nullam venenatis nunc nec odio eleifend vulputate. Curabitur eget tellus in sapien auctor luctus non eu nunc. Morbi sit amet sapien id odio eleifend commodo. Donec nulla arcu, vestibulum non nisl at, vestibulum egestas nunc. Vestibulum egestas consequat leo, at scelerisque dolor fermentum id. Quisque in libero dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris ac varius diam. Nunc varius iaculis orci, a molestie tellus ullamcorper vitae. Proin in malesuada velit, sit amet tempor sem. Aliquam erat volutpat. Nullam ut dictum felis, at euismod diam. Vestibulum id lectus nunc. Pellentesque tincidunt augue eu mi pulvinar placerat.\r\n\r\nEtiam sapien dui, maximus a quam quis, blandit ullamcorper enim. Morbi posuere velit vitae felis euismod, eget sagittis augue fringilla. Sed maximus ante volutpat tristique eleifend. Fusce nam.', '2020-11-04');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
`id` int(11) NOT NULL,
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
(1, 2, -1),
(2, 1, 1),
(1, 1, 1),
(2, 2, -1),
(1, 2, -1),
(6, 5, -1),
(7, 5, -1),
(3, 5, -1),
(7, 6, 2),
(3, 6, 4),
(2, 8, 9),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
`id` int(11) NOT NULL,
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
(2, 'Comment ca ? Moi bouffi ?', 1, 1, 1),
(3, 'ouais franchement t\'abuses', 3, 2, 1),
(4, 'Le jeu est cool mais comme je l\'ai dit dans ma critique, y a quand même mieux. Faut arrêter', 3, NULL, 1),
(5, 'la critique est vraiment mais alors pas du tout constructive', 3, NULL, 3),
(6, 'my bad lorem ipsum, c\'était vraiment pas le truc le plus malin à dire', 3, NULL, 8),
(7, 'franchement je suis aps d\'accord avec toi, tu dis nimp\'', 8, 6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
`id` int(11) NOT NULL,
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
(2, 'Ducknorris', 'onsenfout', 'Caillier', 'Paul', 'Jaime les Cannards', '2002-03-10', '2020-11-04', 'paul.caillier2002@gmail.com'),
(3, 'algator67', 'onsenfout', 'Viala', 'Alexandre', 'Franchement je suis méga fier du style de ce site.', '2001-03-10', '2020-10-27', 'alexandre.viala@utbm.fr'),
(4, 'Duck', NULL, 'Fifi', 'Loulou', 'je m\'appelle mimi la souris.', '2017-11-02', '2020-10-27', 'lol@mdr.com'),
(6, 'ebieth', NULL, 'BIETH', 'Elise', ' Hey !', '2001-02-25', '2020-10-29', 'elise.bieth@utbm.fr'),
(7, 'ds', NULL, 'ru', 're', 'j\'aime les tables de tennis', '2005-08-07', '2020-10-29', 'rouffach@rouf.gmail'),
(8, 'Quindecinn', '$2y$08$bpouYS7Q91jQKgec5X995eIZGLLIHrML/KHbp.jVeolevyzMgyrW2', 'Mann', 'William', 'J\'adore les jeux de sociétés. C\'est ma passion. Je suis vice-président de l\'ut gamedev et j\'organise des soirées jeux de sociétés tous les jeudis soirs.', '2001-03-17', '2020-11-05', 'william.mann@utbm.fr'),
(9, 'zer67', '$2y$08$qXWOpnFYMckm68gPAnrU9Oa7MGmiM9ly00YeH3.1Yj4d3L.EC4Qu6', 'Viala', 'Alexandre', 'J\'adore linksthesun et le métal.', '2001-03-10', '2020-11-05', 'algator67@hotmail.fr'),
(10, 'brbr', '$2y$08$nqSsmcKHZOQzvKza3AIMmOqdrjUt3eXIgCaI0FWwYsS3WdyiY9Ewa', 'prpr', 'br', 'born in the corona year fuck yeah !', '2020-04-05', '2020-11-05', 'brbr@prpr.cmr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
ADD PRIMARY KEY (`id`),
ADD KEY `id1` (`id1`),
ADD KEY `id2` (`id2`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `utilisateur` (`id`),
ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE messages (
  'id' INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  'id_amis' INT(11) NOT NULL,
  'sender' BOOLEAN,
  'datetime' DATETIME DEFAULT current_timestamp(),
  'content' VARCHAR(255),

  ADD CONSTRAINT FOREIGN KEY id_amis REFERENCES amis.id
);
