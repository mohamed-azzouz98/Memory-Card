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



