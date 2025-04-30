CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(50)
);
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL
);
CREATE TABLE ventes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit VARCHAR(255) NOT NULL,
    quantite INT NOT NULL,
    prix_total DECIMAL(10, 2) NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE fournisseurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(50) NOT NULL
);
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'utilisateur') NOT NULL
);
ALTER TABLE produits ADD COLUMN image VARCHAR(255) AFTER prix;

-- Exemple d'ajout de produits (avec images)
INSERT INTO produits (nom, description, prix, image)
VALUES 
('Parfum Dior Homme', 'Parfum élégant et séduisant pour homme.', 150.00, 'assets/images/dior_homme.jpg'),
('Parfum Chanel N°5', 'Un classique intemporel pour femme.', 200.00, 'assets/images/chanel_5.jpg'),
('Parfum Paco Rabanne 1 Million', 'Parfum moderne et sophistiqué pour homme.', 130.00, 'assets/images/paco_rabanne_1_million.jpg');
-- Table des commandes
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    produit_nom VARCHAR(255) NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('admin', 'utilisateur', 'membre') DEFAULT 'utilisateur'
);
