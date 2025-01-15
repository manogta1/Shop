-- Datenbank erstellen
CREATE DATABASE online_shop;

USE online_shop;

-- Tabelle für Produkte erstellen
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- Tabelle für Admin-Benutzer erstellen
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabelle für Bestellungen erstellen
CREATE TABLE shop_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    order_status VARCHAR(255) NOT NULL,
    order_at DATETIME NOT NULL,
    payment_type VARCHAR(255) NOT NULL
);

-- Beispielbenutzer hinzufügen (Passwort ist 'password' gehasht)
INSERT INTO admin_users (username, password) VALUES ('admin', '$2y$10$e0MYz1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1Z1');