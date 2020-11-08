INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `bio`, `DATE_de_naissance`, `DATE_de_creation`, `email`) VALUES
(1, 'Xxx_DarkSasuke_xxX', 'Mot-de-passe-censé-etre-hashé', 'Sarkozy', 'Nicolas', '#TrueGamerForever', '1955-01-01', '2020-11-04', 'nicolas@sarkozy.com'),
(2, 'Ducknorris', 'Mot-de-passe-censé-etre-hashé', 'Caillier', 'Paul', 'Jaime les Cannards', '2002-03-10', '2020-11-04', 'paul.caillier2002@gmail.com'),


INSERT INTO `jeux` (`id`, `nom`, `editeur`,`prix`, `description`) VALUES
(1, 'Uno', 'Mattel', 7.5, 'description du Uno'),
(2, 'Munchkin', 'Edge Entertainement', 19.99, 'description du Munchkin');

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(1, 'Carte'),
(2, 'Chance'),
(3, 'Humoristique');

INSERT INTO `critiques` (`id`, `id_utilisateur`, `id_jeu`, `nom`, `note`, `content`, `DATE_crit`) VALUES
(1, 1, 1, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),
(2, 1, 2, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(3, 2, 1, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(4, 2, 2, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),


INSERT INTO `reponses` (`id`, `content`, `id_auteur`, `id_reponse`, `id_critiques`) VALUES
(1, 'Bien dis bouffi !', 2, NULL, 1),
(2, 'Comment ca ? Moi bouffi ?', 1, 1, 1),
(3, 'ouais franchement t\'abuses', 3, 2, 1),
(4, 'Le jeu est cool mais comme je l\'ai dit dans ma critique, y a quand même mieux. Faut arrêter', 3, NULL, 1),
(5, 'la critique est vraiment mais alors pas du tout constructive', 3, NULL, 3),


INSERT INTO `link_categorie_jeux` (`id_categorie`, `id_jeux`) VALUES
(1, 1),
(2, 1),
(1, 2),
(3, 2);

INSERT INTO `link_utilisateur_score` (`id_utilisateur`, `id_critiques`, `value`) VALUES
(2, 1, 1),
(1, 1, 1),
(2, 2, -1),
(1, 2, -1),
(2, 1, 1),
(1, 1, 1),
(2, 2, -1),
(1, 2, -1),
(3, 1, -1);
