-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 10 jan. 2019 à 13:10
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bookest`
--

-- --------------------------------------------------------

--
-- Structure de la table `biblio_rue`
--

DROP TABLE IF EXISTS `biblio_rue`;
CREATE TABLE IF NOT EXISTS `biblio_rue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geolocalization` double NOT NULL,
  `score` double DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `biblio_user`
--

DROP TABLE IF EXISTS `biblio_user`;
CREATE TABLE IF NOT EXISTS `biblio_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `biblio_user`
--

INSERT INTO `biblio_user` (`id`, `id_user`, `status`, `genre`) VALUES
(1, 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `biblio_user_quantity`
--

DROP TABLE IF EXISTS `biblio_user_quantity`;
CREATE TABLE IF NOT EXISTS `biblio_user_quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_biblio` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `biblio_user_quantity`
--

INSERT INTO `biblio_user_quantity` (`id`, `id_biblio`, `id_user`, `id_livre`, `id_genre`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cercle`
--

DROP TABLE IF EXISTS `cercle`;
CREATE TABLE IF NOT EXISTS `cercle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `synopsis` longtext COLLATE utf8mb4_unicode_ci,
  `score` double DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci,
  `historique_emprunt` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `title`, `author`, `synopsis`, `score`, `comments`, `historique_emprunt`, `status`, `genre`, `isbn`) VALUES
(1, "Harry Potter à l'école des sorciers", 'JK Rowling', "Orphelin, le jeune Harry Potter peut enfin quitter ses tyranniques oncle et tante Dursley lorsqu'un curieux messager lui révèle qu'il est un sorcier. À 11 ans, Harry va enfin pouvoir intégrer la légendaire école de sorcellerie de Poudlard, y trouver une famille digne de ce nom et des amis, développer ses dons, et préparer son glorieux avenir.\r\n", NULL, 'COMMENTAIRES', NULL, '', '', 9789604533084),
(2, "Le Seigneur des Anneaux (Tome 1-La Communauté de l'Anneau)", 'JRR Tolkien', "Dans les vertes prairies de la Comté, les Hobbits, ou Semi-hommes, vivaient en paix… Jusqu'au jour fatal où l'un d'entre eux, au cours de ses voyages, entra en possession de l'Anneau Unique aux immenses pouvoirs. Pour le reconquérir, Sauron, le seigneur ténébreux, va déchaîner toutes les forces du Mal. Frodon, le Porteur de l'Anneau, Gandalf, le magicien, et leurs intrépides compagnons réussiront-ils à écarter la menace qui pèse sur la Terre du Milieu ?", NULL, 'COMMENTAIRES ', NULL, '', '', 9782070612888);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_emprunteur` int(11) NOT NULL,
  `id_preteur` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `status_emprunt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `relation_emprunteur_preteur`
--

DROP TABLE IF EXISTS `relation_emprunteur_preteur`;
CREATE TABLE IF NOT EXISTS `relation_emprunteur_preteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_emprunteur` int(11) NOT NULL,
  `id_preteur` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `status_emprunt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_id` int(11) DEFAULT NULL,
  `google_id` int(11) DEFAULT NULL,
  `id_cercle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `name`, `firstname`, `email`, `adresse`, `status`, `facebook_id`, `google_id`, `id_cercle`) VALUES
(1, 'val', 'adminpass', 'Moret', 'Valentin', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(1, 'val@test.fr', 'adminpass');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
