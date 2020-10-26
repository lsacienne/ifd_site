CREATE DATABASE projetIFD;

USE projetIFD;

CREATE TABLE utilisateur(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	pseudo VARCHAR(255),
	nom VARCHAR(255),
	prenom VARCHAR(255),
	bio VARCHAR(5000),
	date_de_naissance DATE,
	date_de_creation DATE DEFAULT NOW(),
	email VARCHAR(255)
);


CREATE TABLE jeux(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255),
	editeur VARCHAR(255),
	prix FLOAT,
	id_categorie INT,
	note_moyenne FLOAT,
	description VARCHAR(5000)
);


CREATE TABLE categorie(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nom_categorie VARCHAR(255)
);


CREATE TABLE link_categorie_jeux(
	id_categorie INT,
	id_jeux INT,

	FOREIGN KEY (id_categorie) REFERENCES categorie(id),
	FOREIGN KEY (id_jeux) REFERENCES jeux(id)
);


CREATE TABLE critiques(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_utilisateur INT,
	id_jeu INT,
	note INT,
	content VARCHAR(5000),
	date_crit DATE DEFAULT NOW(),
	up INT,
	down INT,

	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_jeu) REFERENCES jeux(id)
);


CREATE TABLE amis(
	id_utilisateur INT,
	id_amis INT,

	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_amis) REFERENCES utilisateur(id)
);


CREATE TABLE reponses(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	content VARCHAR(5000),
	id_auteur INT,
	id_reponse INT,
	id_critiques INT,
	up INT,
	down INT,

	FOREIGN KEY (id_reponse) REFERENCES reponses(id),
	FOREIGN KEY (id_critiques) REFERENCES critiques(id),
	FOREIGN KEY (id_reponse) REFERENCES reponses(id)
)
