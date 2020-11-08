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
