CREATE DATABASE projetifd;
USE projetifd;

CREATE TABLE utilisateur (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pseudo VARCHAR(30),
  mdp VARCHAR(100),
  nom VARCHAR(30),
  prenom VARCHAR(30),
  bio VARCHAR(5000),
  date_de_naissance DATE,
  date_de_creation DATE DEFAULT current_timestamp(),
  email VARCHAR(50)
);

CREATE TABLE jeux (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(30),
  editeur VARCHAR(30),
  picture LONGBLOB,
  prix FLOAT,
  description VARCHAR(5000)
);

CREATE TABLE categorie (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT ,
  nom_categorie VARCHAR(50)
);

CREATE TABLE critiques (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_utilisateur INT NOT NULL,
  id_jeu INT NOT NULL,
  nom VARCHAR(50),
  note INT,
  content VARCHAR(5000),
  date_crit DATE DEFAULT current_timestamp(),

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
  FOREIGN KEY (id_jeu) REFERENCES jeux(id)
);


CREATE TABLE amis (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id1 INT NOT NULL,
  id2 INT NOT NULL,
  attente TINYINT(1),

  FOREIGN KEY (id1) REFERENCES utilisateur(id),
  FOREIGN KEY (id2) REFERENCES utilisateur(id)
);

CREATE TABLE reponses (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  content VARCHAR(100),
  id_auteur INT NOT NULL,
  id_reponse INT,
  id_critiques INT NOT NULL,

  FOREIGN KEY (id_auteur) REFERENCES utilisateur(id),
  FOREIGN KEY (id_reponse) REFERENCES reponses(id),
  FOREIGN KEY (id_critiques) REFERENCES critiques(id)
);

CREATE TABLE messages (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_amis INT NOT NULL,
  sender TINYINT(1),
  datetime DATETIME DEFAULT current_timestamp(),
  content VARCHAR(255),

  FOREIGN KEY (id_amis) REFERENCES amis(id)
);

CREATE TABLE link_categorie_jeux (
  id_categorie INT NOT NULL,
  id_jeux INT NOT NULL,

  FOREIGN KEY (id_categorie) REFERENCES categorie(id),
  FOREIGN KEY (id_jeux) REFERENCES jeux(id)
);

CREATE TABLE link_utilisateur_score (
  id_utilisateur INT NOT NULL,
  id_critiques INT NOT NULL,
  value INT,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
  FOREIGN KEY (id_critiques) REFERENCES critiques(id)
);

INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `bio`, `DATE_de_naissance`, `DATE_de_creation`, `email`) VALUES
(1, 'Xxx_DarkSasuke_xxX', 'onsenfout', 'Sarkozy', 'Nicolas', '#TrueGamerForever', '1955-01-01', '2020-11-04', 'nicolas@sarkozy.com'),
(2, 'Ducknorris', 'onsenfout', 'Caillier', 'Paul', 'Jaime les Cannards', '2002-03-10', '2020-11-04', 'paul.caillier2002@gmail.com'),
(3, 'algator67', 'onsenfout', 'Viala', 'Alexandre', 'Franchement je suis méga fier du style de ce site.', '2001-03-10', '2020-10-27', 'alexandre.viala@utbm.fr'),
(4, 'Duck', NULL, 'Fifi', 'Loulou', 'je m\'appelle mimi la souris.', '2017-11-02', '2020-10-27', 'lol@mdr.com'),
(6, 'ebieth', NULL, 'BIETH', 'Elise', ' Hey !', '2001-02-25', '2020-10-29', 'elise.bieth@utbm.fr'),
(7, 'ds', NULL, 'ru', 're', 'j\'aime les tables de tennis', '2005-08-07', '2020-10-29', 'rouffach@rouf.gmail'),
(8, 'Quindecinn', '$2y$08$bpouYS7Q91jQKgec5X995eIZGLLIHrML/KHbp.jVeolevyzMgyrW2', 'Mann', 'William', 'J\'adore les jeux de sociétés. C\'est ma passion. Je suis vice-président de l\'ut gamedev et j\'organise des soirées jeux de sociétés tous les jeudis soirs.', '2001-03-17', '2020-11-05', 'william.mann@utbm.fr'),
(9, 'zer67', '$2y$08$qXWOpnFYMckm68gPAnrU9Oa7MGmiM9ly00YeH3.1Yj4d3L.EC4Qu6', 'Viala', 'Alexandre', 'J\'adore linksthesun et le métal.', '2001-03-10', '2020-11-05', 'algator67@hotmail.fr'),
(10, 'brbr', '$2y$08$nqSsmcKHZOQzvKza3AIMmOqdrjUt3eXIgCaI0FWwYsS3WdyiY9Ewa', 'prpr', 'br', 'born in the corona year fuck yeah !', '2020-04-05', '2020-11-05', 'brbr@prpr.cmr');

INSERT INTO `jeux` (`id`, `nom`, `editeur`,`prix`, `description`) VALUES
(1, 'Uno', 'Mattel', 7.5, 'description 1'),
(2, 'Munchkin', 'Edge Entertainement', 19.99, 'description 2');

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(1, 'Carte'),
(2, 'Chance'),
(3, 'Humoristique');

INSERT INTO `critiques` (`id`, `id_utilisateur`, `id_jeu`, `nom`, `note`, `content`, `DATE_crit`) VALUES
(1, 1, 1, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),
(2, 1, 2, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(3, 2, 1, 'nul', 3, 'Trop NUL NUL NUL', '2020-11-04'),
(4, 2, 2, 'super', 10, 'Un super jeu! J\'adore, vraiment', '2020-11-04'),
(5, 2, 2, 'pas ouf ouf', 4, 'J\'ai pas trop aimé me faire déglingué par des elfes clerics sur la fin. C\'est franchement rageant', '2020-11-03'),
(6, 3, 1, 'grave bien', 7, 'C\'est vraiment un super jeu. J\'adore me prendre des +25 pour avoir eu le malheur de me mettre à côté d\'un mauvais joueur :)))).\r\n\'fin bref c\'est cool pour golri avec les rheys', '2020-11-04'),
(8, 3, 1, 'un truc de ouf de gros dingue de malade de ouf ( vous allez adorer sans déconner)', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam massa velit, placerat commodo hendrerit ornare, mollis nec ante. Nullam venenatis nunc nec odio eleifend vulputate. Curabitur eget tellus in sapien auctor luctus non eu nunc. Morbi sit amet sapien id odio eleifend commodo. Donec nulla arcu, vestibulum non nisl at, vestibulum egestas nunc. Vestibulum egestas consequat leo, at scelerisque dolor fermentum id. Quisque in libero dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris ac varius diam. Nunc varius iaculis orci, a molestie tellus ullamcorper vitae. Proin in malesuada velit, sit amet tempor sem. Aliquam erat volutpat. Nullam ut dictum felis, at euismod diam. Vestibulum id lectus nunc. Pellentesque tincidunt augue eu mi pulvinar placerat.\r\n\r\nEtiam sapien dui, maximus a quam quis, blandit ullamcorper enim. Morbi posuere velit vitae felis euismod, eget sagittis augue fringilla. Sed maximus ante volutpat tristique eleifend. Fusce nam.', '2020-11-04');

INSERT INTO `reponses` (`id`, `content`, `id_auteur`, `id_reponse`, `id_critiques`) VALUES
(1, 'Bien dis bouffi !', 2, NULL, 1),
(2, 'Comment ca ? Moi bouffi ?', 1, 1, 1),
(3, 'ouais franchement t\'abuses', 3, 2, 1),
(4, 'Le jeu est cool mais comme je l\'ai dit dans ma critique, y a quand même mieux. Faut arrêter', 3, NULL, 1),
(5, 'la critique est vraiment mais alors pas du tout constructive', 3, NULL, 3),
(6, 'my bad lorem ipsum, c\'était vraiment pas le truc le plus malin à dire', 3, NULL, 8),
(7, 'franchement je suis aps d\'accord avec toi, tu dis nimp\'', 8, 6, 8);

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
(6, 5, -1),
(7, 5, -1),
(3, 5, -1),
(7, 6, 1),
(3, 6, -1),
(2, 8, 1),
(3, 1, -1);
