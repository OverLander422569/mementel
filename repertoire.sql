-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 mai 2019 à 13:02
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `repertoire`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID`, `intitule`) VALUES
(2, 'Restaurant'),
(4, 'Star'),
(8, 'Famille(s)'),
(9, 'bouiboui');

-- --------------------------------------------------------

--
-- Structure de la table `categoriser`
--

DROP TABLE IF EXISTS `categoriser`;
CREATE TABLE IF NOT EXISTS `categoriser` (
  `ID` int(11) NOT NULL,
  `ID_Categorie` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Categorie`),
  KEY `Categoriser_Categorie0_FK` (`ID_Categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categoriser`
--

INSERT INTO `categoriser` (`ID`, `ID_Categorie`) VALUES
(9, 2),
(1, 4),
(4, 4),
(23, 8);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `chemin_photo` varchar(150) NOT NULL,
  `estProfessionnel` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`ID`, `nom`, `prenom`, `pseudo`, `dateNaissance`, `chemin_photo`, `estProfessionnel`) VALUES
(1, 'FORD', 'Harrison', 'Han', '1942-07-13', 'C:\\Users\\adrien\\Desktop\\Harrison-Ford-Sexy-Pictures.jpg', 0),
(4, 'SPIELBERG', 'Steven', 'Stevie', '1946-12-18', '', 1),
(9, 'LES DENTS DE LA MER', '.', 'tala tala tala talatalata', '2018-06-26', '', 0),
(23, 'SOUBEYRAND', 'AadDrien', 'Adri', '2018-07-18', 'C:\\Users\\adrien\\Desktop\\20170519_122040.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `habiter`
--

DROP TABLE IF EXISTS `habiter`;
CREATE TABLE IF NOT EXISTS `habiter` (
  `ID_type_adresse` int(11) NOT NULL,
  `ID_contact` int(11) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_type_adresse`,`ID_contact`),
  KEY `Habiter_contact0_FK` (`ID_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `habiter`
--

INSERT INTO `habiter` (`ID_type_adresse`, `ID_contact`, `adresse`) VALUES
(1, 1, ''),
(1, 4, ''),
(1, 9, ''),
(1, 23, '10 IMPASSE DU PROGRES\n42000\nSAINT ETIENNE'),
(2, 1, ''),
(2, 4, ''),
(2, 9, ''),
(2, 23, '28 RUE DU GASPACHO\n29130\nFOUGERES');

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `ID_contact` int(11) NOT NULL,
  `ID_type_numero` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_contact`,`ID_type_numero`),
  KEY `posseder_Type_numero0_FK` (`ID_type_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`ID_contact`, `ID_type_numero`, `numero`) VALUES
(1, 1, ''),
(1, 2, '0183565949'),
(1, 3, ''),
(1, 4, ''),
(1, 5, ''),
(4, 1, ''),
(4, 2, '0302010605'),
(4, 3, '0607080509'),
(4, 4, '0102030405'),
(4, 5, ''),
(9, 1, ''),
(9, 2, ''),
(9, 3, ''),
(9, 4, ''),
(9, 5, ''),
(23, 1, '0708090102'),
(23, 2, '0102030405'),
(23, 3, ''),
(23, 4, '0203040506'),
(23, 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `type_adresse`
--

DROP TABLE IF EXISTS `type_adresse`;
CREATE TABLE IF NOT EXISTS `type_adresse` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_adresse`
--

INSERT INTO `type_adresse` (`ID`, `libelle`) VALUES
(1, 'Perso'),
(2, 'Pro');

-- --------------------------------------------------------

--
-- Structure de la table `type_numero`
--

DROP TABLE IF EXISTS `type_numero`;
CREATE TABLE IF NOT EXISTS `type_numero` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_numero`
--

INSERT INTO `type_numero` (`ID`, `libelle`) VALUES
(1, 'PorPerso'),
(2, 'FixPerso'),
(3, 'PorPro'),
(4, 'FixPro'),
(5, 'Fax');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categoriser`
--
ALTER TABLE `categoriser`
  ADD CONSTRAINT `Categoriser_Categorie0_FK` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorie` (`ID`),
  ADD CONSTRAINT `Categoriser_contact_FK` FOREIGN KEY (`ID`) REFERENCES `contact` (`ID`);

--
-- Contraintes pour la table `habiter`
--
ALTER TABLE `habiter`
  ADD CONSTRAINT `Habiter_Type_adresse_FK` FOREIGN KEY (`ID_type_adresse`) REFERENCES `type_adresse` (`ID`),
  ADD CONSTRAINT `Habiter_contact0_FK` FOREIGN KEY (`ID_contact`) REFERENCES `contact` (`ID`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_Type_numero0_FK` FOREIGN KEY (`ID_type_numero`) REFERENCES `type_numero` (`ID`),
  ADD CONSTRAINT `posseder_contact_FK` FOREIGN KEY (`ID_contact`) REFERENCES `contact` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
