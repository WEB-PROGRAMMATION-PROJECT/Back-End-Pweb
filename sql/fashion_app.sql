-- Création de la base de données
DROP
DATABASE IF EXISTS fashion_app;
CREATE
DATABASE fashion_app;
USE
fashion_app;

-- Table des utilisateurs
CREATE TABLE users
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    first_name     VARCHAR(255) NOT NULL,
    last_name      VARCHAR(255) NOT NULL,
    email          VARCHAR(255) NOT NULL UNIQUE,
    password       VARCHAR(255) NOT NULL,
    country        VARCHAR(255),
    city           VARCHAR(255),
    address        TEXT,
    user_type      ENUM('client', 'stylist') NOT NULL,
    terms_accepted BOOLEAN   DEFAULT FALSE,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at     TIMESTAMP NULL
);

-- Table des stylistes
CREATE TABLE stylistes
(
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    user_id             INT NOT NULL,
    phone_number        VARCHAR(20),
    specializations     TEXT,
    description         TEXT,
    profile_picture_url VARCHAR(255),
    points              INT           DEFAULT 0,
    collections         INT           DEFAULT 0,
    awards              INT           DEFAULT 0,
    rating              DECIMAL(3, 2) DEFAULT 0,
    response_time       VARCHAR(50),
    completed_orders    INT           DEFAULT 0,
    specialites         VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Table des clients
CREATE TABLE clients
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT NOT NULL,
    tour_poitrine  DECIMAL(6, 2),
    tour_taille    DECIMAL(6, 2),
    tour_hanches   DECIMAL(6, 2),
    hauteur_totale DECIMAL(6, 2),
    longueur_bras  DECIMAL(6, 2),
    tour_cou       DECIMAL(6, 2),
    mesures_photo  VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Table des catégories
CREATE TABLE categories
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    image      VARCHAR(255),
    count      INT       DEFAULT 0,
    href       VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des modèles
CREATE TABLE modeles
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    styliste_id  INT            NOT NULL,
    categorie_id BIGINT UNSIGNED NOT NULL,
    name         VARCHAR(255)   NOT NULL,
    description  TEXT,
    story        TEXT,
    points       INT         DEFAULT 0,
    status       ENUM('available', 'unavailable', 'archived') DEFAULT 'available',
    prix_min     DECIMAL(10, 2) NOT NULL,
    prix_max     DECIMAL(10, 2) NOT NULL,
    devise       VARCHAR(10) DEFAULT 'XAF',
    temps_min    INT            NOT NULL,
    temps_max    INT            NOT NULL,
    unite_temps  VARCHAR(20) DEFAULT 'jours',
    styles       VARCHAR(255),
    image1       VARCHAR(255)   NOT NULL,
    image2       VARCHAR(255)   NOT NULL,
    image3       VARCHAR(255)   NOT NULL,
    image4       VARCHAR(255),
    image5       VARCHAR(255),
    created_at   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at   TIMESTAMP NULL,
    FOREIGN KEY (styliste_id) REFERENCES stylistes (id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES categories (id) ON DELETE CASCADE
);

-- Table des matériaux
CREATE TABLE materiaux
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    modele_id   INT          NOT NULL,
    name        VARCHAR(100) NOT NULL,
    description TEXT,
    FOREIGN KEY (modele_id) REFERENCES modeles (id) ON DELETE CASCADE
);

-- Table des commentaires
CREATE TABLE commentaires
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id    INT  NOT NULL,
    content    TEXT NOT NULL,
    likes      INT       DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    type       ENUM('styliste', 'modele') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

-- Table des commentaires stylistes
CREATE TABLE commentaire_stylistes
(
    id          BIGINT UNSIGNED PRIMARY KEY,
    styliste_id INT NOT NULL,
    FOREIGN KEY (id) REFERENCES commentaires (id) ON DELETE CASCADE,
    FOREIGN KEY (styliste_id) REFERENCES stylistes (id) ON DELETE CASCADE
);

-- Table des commentaires modèles
CREATE TABLE commentaire_modeles
(
    id        BIGINT UNSIGNED PRIMARY KEY,
    modele_id INT NOT NULL,
    FOREIGN KEY (id) REFERENCES commentaires (id) ON DELETE CASCADE,
    FOREIGN KEY (modele_id) REFERENCES modeles (id) ON DELETE CASCADE
);

-- Table des disponibilités
CREATE TABLE disponibilites
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    styliste_id INT  NOT NULL,
    jour        DATE NOT NULL,
    heure       TIME NOT NULL,
    status      ENUM('available', 'booked', 'unavailable') DEFAULT 'available',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (styliste_id) REFERENCES stylistes (id) ON DELETE CASCADE
);

-- Table des adresses de livraison
CREATE TABLE adresse_livraisons
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id   INT          NOT NULL,
    pays        VARCHAR(100) NOT NULL,
    ville       VARCHAR(100) NOT NULL,
    rue         VARCHAR(255),
    quartier    VARCHAR(100),
    type        ENUM('domicile', 'bureau', 'autre') DEFAULT 'domicile',
    est_default BOOLEAN   DEFAULT FALSE,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE
);

-- Table des commandes
CREATE TABLE commandes
(
    id                     BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reference              VARCHAR(50) UNIQUE NOT NULL,
    client_id              INT                NOT NULL,
    modele_id              INT                NOT NULL,
    adresse_livraison_id   BIGINT UNSIGNED NOT NULL,
    state                  INT                NOT NULL DEFAULT 0,
    prix_total             DECIMAL(10, 2)     NOT NULL,
    date_commande          TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP,
    date_livraison_estimee DATE,
    status                 ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    notes                  TEXT,
    created_at             TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP,
    updated_at             TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at             TIMESTAMP NULL,
    FOREIGN KEY (client_id) REFERENCES clients (id),
    FOREIGN KEY (modele_id) REFERENCES modeles (id),
    FOREIGN KEY (adresse_livraison_id) REFERENCES adresse_livraisons (id)
);

-- Table des paiements
CREATE TABLE paiements
(
    id                    BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    commande_id           BIGINT UNSIGNED NOT NULL,
    montant               DECIMAL(10, 2) NOT NULL,
    methode               VARCHAR(50)    NOT NULL,
    status                ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    reference_transaction VARCHAR(100),
    created_at            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at            TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (commande_id) REFERENCES commandes (id)
);

-- Table des favoris
CREATE TABLE favoris
(
    client_id  INT NOT NULL,
    modele_id  INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (client_id, modele_id),
    FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE,
    FOREIGN KEY (modele_id) REFERENCES modeles (id) ON DELETE CASCADE
);

-- Table des promotions
CREATE TABLE promotions
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    description TEXT,
    image       VARCHAR(255),
    link        VARCHAR(255),
    active      BOOLEAN   DEFAULT TRUE,
    debut_at    TIMESTAMP NULL,
    fin_at      TIMESTAMP NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
