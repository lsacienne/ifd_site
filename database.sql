CREATE DATABASE projetifd;

USE projetifd;

CREATE TABLE utilisateur(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	pseudo VARCHAR(255),
	mdp VARCHAR(255),
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
	nom VARCHAR(255),
	note INT,
	content VARCHAR(5000),
	date_crit DATE DEFAULT NOW(),

	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_jeu) REFERENCES jeux(id)
);


CREATE TABLE amis(
	id_demandeur INT,
	id_demande INT,

	FOREIGN KEY (id_demandeur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_demande) REFERENCES utilisateur(id)
);


CREATE TABLE reponses(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	content VARCHAR(5000),
	id_auteur INT,
	id_reponse INT DEFAULT NULL,
	id_critiques INT,

	FOREIGN KEY (id_reponse) REFERENCES reponses(id),
	FOREIGN KEY (id_critiques) REFERENCES critiques(id)
);

CREATE TABLE link_utilisateur_score(
	id_utilisateur INT,
	id_critiques INT,
	value INT,

	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
	FOREIGN KEY (id_critiques) REFERENCES critiques(id)
);

INSERT INTO utilisateur (pseudo,mdp,nom,prenom,bio,date_de_naissance,email) VALUES
	('Xxx_DarkSasuke_xxX','onsenfout','Sarkozy','Nicolas','#TrueGamerForever','1955-01-01','nicolas@sarkozy.com'),
	('Ducknorris','onsenfout','Caillier','Paul','Jaime les Cannards','2002-03-10','paul.caillier2002@gmail.com');

INSERT INTO jeux(nom, editeur,prix,description) VALUES
	('Uno','Mattel',7.50,'description 1'),
	('Munchkin','Edge Entertainement',19.99,'description 2');

INSERT INTO categorie(nom_categorie) VALUES('Jeu de carte'),('Jeu de chance'),('Jeu humoristique');


INSERT INTO critiques(id_utilisateur,id_jeu,nom,note,content) VALUES
	(1,1,'super',10,'Un super jeu! J''adore, vraiment'),
	(1,2,'nul',3,'Trop NUL NUL NUL'),
	(2,1,'nul',3,'Trop NUL NUL NUL'),
	(2,2,'super',10,'Un super jeu! J''adore, vraiment');


INSERT INTO reponses(content,id_auteur,id_critiques) VALUES ('Bien dis bouffi !',2,1);
INSERT INTO reponses(content,id_auteur,id_reponse,id_critiques) VALUES ('Comment ca ? Moi bouffi ?',1,1,1);

INSERT INTO amis VALUES ('1','2'),('2','1');
INSERT INTO link_categorie_jeux(id_categorie, id_jeux) VALUES ('1', '1'), ('2', '1');
INSERT INTO link_categorie_jeux(id_categorie, id_jeux) VALUES ('1', '2'), ('3', '2');
INSERT INTO link_utilisateur_score(id_utilisateur, id_critiques,value) VALUES ('2', '1', '1'), ('1', '1', '1');
INSERT INTO link_utilisateur_score(id_utilisateur, id_critiques, value) VALUES ('2', '2', '-1'), ('1', '2', '-1');
