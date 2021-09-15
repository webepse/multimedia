-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 15 sep. 2019 à 16:55
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `multimedia`
--
CREATE DATABASE IF NOT EXISTS `multimedia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `multimedia`;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `mdp`, `mail`, `image`, `level`) VALUES
(1, 'Jordan', '$2y$10$BOJDtNK050TeUaYbXoMivO1GYfPIwVzieR/7axzKfwN2zBUWag5Hi', 'berti@epse.be', NULL, 'administrateur'),
(2, 'epse', '$2y$10$iB4APkxExvydUKyblBC7cOD/iXuR3ZnvaKnQVu3HXtxQktyrdncpG', 'berti@epse.be', NULL, 'membre'),
(3, 'Test', '$2y$10$uD/ZlxcGuMhaiGkxtzMgPubqwWqMk.DbqNLLp5ztFWp3rSbOhaqZG', 'berti@epse.be', NULL, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(60) NOT NULL,
  `marque` varchar(60) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `type`, `marque`, `image`) VALUES
(25, 'Galaxy S10', '699.00', 'Faites connaissance avec le nouveau venu dans la famille Galaxy : le Samsung Galaxy S10 ! Au rayon des atouts ? Un superbe écran qui offre des images exceptionnelles, une grande capacité de stockage ou encore une très longue autonomie de batterie. ', 'Smartphone', 'Samsung', '1821646589galaxyS10.jpg'),
(26, 'Iphone 4S', '80.00', 'Le dernier Iphone de la marque Apple dont Steve Jobs a participé comme concepteur.', 'Smartphone', 'Apple', '1051158939iphone4s.jpg'),
(27, 'Iphone 6s', '160.00', 'description', 'Smartphone', 'Apple', '1085771687iphone6s.jpg'),
(29, 'Iphone Xs', '920.00', 'L’iPhone XS détient un écran Super Retina de 5,8 pouces et l’iPhone XS Max un écran de 6,5 pouces avec des panneaux OLED créés spécialement, pour un affichage HDR offrant des couleurs d’une qualité supérieure. La technologie Face ID avancée vous permet de déverrouiller votre téléphone portable, de vous connecter à des apps et de régler vos achats instantanément.', 'Smartphone', 'Apple', '652142162iphonexs.jpeg'),
(30, 'Galaxy S7', '200.00', 'description', 'Smartphone', 'Samsung', '1220640304samsungs7.jpg'),
(31, 'Mate 20 pro', '650.00', 'description', 'Smartphone', 'Huawei', '836518146mate20pro.jpg'),
(32, '7 pro', '750.00', 'description', 'Smartphone', 'One plus', '1100495064oneplus.jpg'),
(33, 'Fifa 20', '60.00', 'description', 'Jeux vidéo', 'PS4', '1558637456fifa20.jpg'),
(37, 'E Football PES 2020', '55.00', 'test', 'Jeux vidéo', 'Xbox', '2068090477pes2020.jpg'),
(38, 'Anno 1800', '45.00', 'description', 'Jeux vidéo', 'PC', '1422647385anno1800.jpg'),
(39, 'Borderlands 3', '48.00', 'description', 'Jeux vidéo', 'PC', '1292647089borderlands3.jpg'),
(40, 'Cyberpunk 2077', '49.00', 'Description', 'Jeux vidéo', 'PC', '1429033006cyberpunk-2077-cover.jpg'),
(41, 'NBA 2K20 Legend Edition', '60.00', 'description', 'Jeux vidéo', 'PC', '1288675102nba-2k20-legend-edition-cover.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
