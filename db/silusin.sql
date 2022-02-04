-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 02 fév. 2020 à 12:11
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `silusins`
--
CREATE DATABASE IF NOT EXISTS `silusins` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `silusins`;

-- --------------------------------------------------------

CREATE TABLE produit(
   id_produit INT NOT NULL UNIQUE AUTO_INCREMENT,
   lib_produit VARCHAR(500),
   type_produit VARCHAR(500),
   spec_produit VARCHAR(500),
   prix_produit VARCHAR(50),
   diametre_produit VARCHAR(50),
   PRIMARY KEY(id_produit)
);

CREATE TABLE statut(
   id_statut INT NOT NULL UNIQUE AUTO_INCREMENT,
   lib_statut VARCHAR(500),
   PRIMARY KEY(id_statut)
);

CREATE TABLE role(
   id_role INT NOT NULL UNIQUE AUTO_INCREMENT,
   lib_role VARCHAR(500),
   PRIMARY KEY(id_role)
);

CREATE TABLE famille(
   id_famille INT NOT NULL UNIQUE AUTO_INCREMENT,
   lib_famille VARCHAR(500),
   promo_famille TINYINT,
   PRIMARY KEY(id_famille)
   
);

CREATE TABLE image(
   id_famille INT,
   id_image INT NOT NULL,
   PRIMARY KEY(id_famille, id_image),
   FOREIGN KEY(id_famille) REFERENCES famille(id_famille)
);

CREATE TABLE utilisateur(
   id_user INT NOT NULL UNIQUE AUTO_INCREMENT,
   nom_user VARCHAR(500),
   prenom_user VARCHAR(500),
   mdp_user VARCHAR(500) NOT NULL,
   classe_user VARCHAR(500),
   tel_user VARCHAR(50),
   mail_user VARCHAR(500),
   id_role INT NOT NULL,
   PRIMARY KEY(id_user),
   FOREIGN KEY(id_role) REFERENCES role(id_role)
);

CREATE TABLE commande(
   id_commande INT NOT NULL UNIQUE AUTO_INCREMENT,
   num_commande VARCHAR(500),
   date_commande DATE,
   total_commande FLOAT,
   mode_paiement VARCHAR(500),
   nom_commande VARCHAR(500),
   prenom_commande VARCHAR(500),
   classe_commande VARCHAR(50),
   tel_commande VARCHAR(50),
   mail_commande VARCHAR(500),
   id_user INT NOT NULL,
   id_statut INT NOT NULL,
   id_user_controleur INT NOT NULL,
   PRIMARY KEY(Id_commande),
   FOREIGN KEY(Id_user) REFERENCES utilisateur(Id_user),
   FOREIGN KEY(Id_statut) REFERENCES statut(Id_statut),
   FOREIGN KEY(Id_user_controleur) REFERENCES utilisateur(Id_user)

);

CREATE TABLE produit_image_commande(
   id_produit INT NOT NULL,
   id_famille INT NOT NULL,
   id_image INT NOT NULL,
   id_commande INT NOT NULL,
   quantite INT NOT NULL,
   message VARCHAR(500),
   PRIMARY KEY(id_produit, id_famille, id_image, id_commande),
   FOREIGN KEY(id_produit) REFERENCES produit(id_produit),
   FOREIGN KEY(id_famille, id_image) REFERENCES image(id_famille, id_image),
   FOREIGN KEY(id_commande) REFERENCES commande(id_commande)
);
