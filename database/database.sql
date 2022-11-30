-- Creation de la bdd
CREATE DATABASE IF NOT EXISTS memory;

-- Creation de l'utilisateur
CREATE USER IF NOT EXISTS 'memory'@'localhost' IDENTIFIED BY 'memory13';

GRANT ALL PRIVILEGES ON memory.* TO 'memory'@'localhost';

FLUSH PRIVILEGES;



USE  memory;


-- Creation des tables



CREATE TABLE IF NOT EXISTS user(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,   
    pseudo varchar (50) NOT NULL,
    password varchar (255) NOT NULL,
    email varchar (100) NOT NULL
);

CREATE TABLE IF NOT EXISTS categorie(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    nom varchar (50) NOT NULL,

    FOREIGN KEY (id_user) REFERENCES user(id)
);

create table IF NOT EXISTS theme(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_categorie INT NOT NULL,
    nom VARCHAR(20) NOT NULL,
    description TEXT,
    public BOOLEAN NOT NULL,
    date_creation DATE NOT NULL,


    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_categorie) REFERENCES categorie(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS carte(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_theme INT NOT NULL,
    recto VARCHAR(255),
    verso VARCHAR(255),
    imgRecto VARCHAR(255),
    imgVerso VARCHAR(255),
    date_creation DATE NOT NULL ,
    date_modification DATE NOT NULL,


    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_theme) REFERENCES theme(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS revision(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_theme INT NOT NULL,
    nb_niveau DECIMAL NOT NULL,
    nb_carte DECIMAL NOT NULL,
    started_at DATE NOT NULL,

    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_theme) REFERENCES theme(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS revoit(
    id_carte INT NOT NULL,
    id_revision INT NOT NULL,
    derniere_vue DATE NOT NULL,
    niveau DECIMAL NOT NULL,

    PRIMARY KEY(id_carte, id_revision),
    FOREIGN KEY (id_carte) REFERENCES carte(id) ON DELETE CASCADE,
    FOREIGN KEY (id_revision) REFERENCES revision(id) ON DELETE CASCADE

);



-- Données de test


-- Mot de pass : gloria123 --
INSERT INTO user(pseudo, password, email) VALUE('gloria','$2y$10$FE6KSzEhS6u4LGaHwsohvOkbw/p8eVUDWc05gAghq0SBqzTNOGgta','gloria@gmail.com');

-- Mot de pass : melman123 --
INSERT INTO user(pseudo, password, email) VALUE('melman','$2y$10$UWIuiRMjgO06ByNFNhp1Jur/Ket.IKYLwxD3bUmLPoKUywi5VZ3hi','melman@gmail.com');

INSERT INTO categorie(id_user, nom) VALUE(1, 'sport');
INSERT INTO categorie(id_user, nom) VALUE(2, 'language web');

INSERT INTO theme(id_user, id_categorie, nom, description, public, date_creation) VALUE(1, 1, 'basket', 'question sur les joueurs de basket', 0, '2022-11-30');
INSERT INTO theme(id_user, id_categorie, nom, description, public, date_creation) VALUE(1, 2, 'html/css', 'question sur les balise hmtl et css', 1, '2022-11-30');

INSERT INTO theme(id_user, id_categorie, nom, description, public, date_creation) VALUE(2, 1, 'foot', 'question sur les joueurs de foot', 0, '2022-11-30');
INSERT INTO theme(id_user, id_categorie, nom, description, public, date_creation) VALUE(2, 2, 'javascript', 'question sur le fonctionnement des script js', 1, '2022-11-30');

INSERT INTO carte(id_user, id_theme, recto, verso, imgRecto, imgVerso, date_creation, date_modification) VALUE(1, 1, 'Quel joueur est connu pour ses 3pts ?', 'Stephen Curry', NULL, NULL, '2022-11-30', '2022-11-30');
INSERT INTO carte(id_user, id_theme, recto, verso, imgRecto, imgVerso, date_creation, date_modification) VALUE(2, 3, 'Quel joueur a remporté le ballon dor en 2022 ?', 'Karim Benzema', NULL, NULL, '2022-11-30', '2022-11-30');

