-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 26 Avril 2019 à 15:09
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ram`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouterCalendrier` (IN `sante` VARCHAR(255), IN `temperature` INT(11), IN `pleurs` VARCHAR(255), IN `besoins` VARCHAR(255), IN `repas` VARCHAR(255), IN `alimentation` VARCHAR(255), IN `dodo` VARCHAR(255), IN `humeur` VARCHAR(255), IN `activite` VARCHAR(255), IN `promenade` VARCHAR(255), IN `remarques` VARCHAR(255), IN `date` INT(11), IN `idEnfant` INT(11))  NO SQL
INSERT INTO calendrier(sante, temperature, pleurs, besoins, repas, aliments, dodo, humeur, activite, promenade, remarques, date, idEnfant) VALUES (sante, temperature, pleurs, besoins, repas, aliments, dodo, humeur, activite, promenade, remarques, date, idEnfant)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouterEnfant` (IN `enfNom` VARCHAR(255), IN `enfPrenom` VARCHAR(255), IN `enfAge` INT(11), IN `idParent` INT(11), IN `idNounou` INT(11))  NO SQL
INSERT INTO enfants(enfNom, enfPrenom, enfAge, idParent, idNounou) 
VALUES (enfNom, enfPrenom, enfAge, idParent, idNounou)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendrierRempliOuNon` (IN `enfant` INT(11))  NO SQL
SELECT COUNT(*) 
FROM calendrier
WHERE idEnfant = enfant
AND date = CURDATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creer_Atelier` (IN `pnom` VARCHAR(255), IN `pdescription` VARCHAR(255), IN `phoraire` VARCHAR(255), IN `pjour` VARCHAR(255), IN `pnbrPlace` INT(255), IN `ppersoConcernees` VARCHAR(225))  MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
	INSERT INTO atelier (atelier.ateID, atelier.ateNom, atelier.ateDescription, atelier.ateHoraire, atelier.ateJour, atelier.ateNbrPlace,atelier.atePublicConcerne) VALUES (DEFAULT, pnom, pdescription, phoraire, pjour, pnbrPlace, ppersoConcernees);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creer_Enfant` (IN `enfPrenom` VARCHAR(255), IN `enfNom` VARCHAR(255), IN `enNumTelParent` VARCHAR(10), IN `enfStatut` VARCHAR(255), IN `enfInformations` VARCHAR(255), IN `enfDateInscription` DATE, IN `enfDateFinInscription` DATE)  BEGIN
	INSERT INTO enfant (enfant.enfPrenom, enfant.enfNom, enfant.enfNumTelParent, enfant.enfStatut, enfant.enfInformations, enfant.enfDateInscription, enfant.enfDateFinInscription) VALUES (enfPrenom, enfNom, enNumTelParent, enfStatut, enfInformations, enfDateInscription, enfDateFinInscription);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creer_Enfant_Erreur` (IN `pprenom` VARCHAR(255), IN `pnom` VARCHAR(255), IN `ptel` VARCHAR(255), IN `pstatut` VARCHAR(255), IN `pinformations` VARCHAR(255), IN `pdateinscription` DATE, IN `pfininscription` DATE)  BEGIN
INSERT INTO `enfant` (`enfPrenom`, `enfNom`, `enfNumTelParent`, `enfStatut`, `enfInformations`, `enfDateInscription`, `enfDateFinInscription`, `ateId`) VALUES (pprenom, pnom, ptel, pstatut, pinformations, pdateinscription, pfininscription, NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creer_Lien` (IN `pEnfID` INT, IN `pAteId` INT)  BEGIN 
INSERT INTO presence_atelier_enfant (enfId, ateId) 
VALUES (pEnfID, pAteId); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inscriptionUtilisateur` (IN `pseudo` VARCHAR(255), IN `mdp` VARCHAR(255), IN `nom` VARCHAR(255), IN `prenom` VARCHAR(255), IN `cp` INT(11), IN `ville` VARCHAR(255), IN `pays` VARCHAR(255), IN `email` VARCHAR(255), IN `nbrEnfant` INT(11), IN `type` VARCHAR(255), IN `choix_nounou` INT(11))  NO SQL
INSERT INTO membres(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type, choix_nounou) VALUES(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type, choix_nounou)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererEnfant` (IN `idSession` INT)  SELECT *
FROM calendrier AS c
INNER JOIN enfant AS e on c.idEnfant = e.enfId
WHERE idParent = idSession AND date = CURDATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererInformationsUtilisateur` (IN `idSession` INT(11))  NO SQL
SELECT * 
FROM membres 
WHERE id = idSession$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererNombreEnfantDeLUtilisateur` (IN `idSession` INT(11))  NO SQL
SELECT COUNT(*) 
FROM enfant
WHERE idParent = idSession$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererUtilisateur` (IN `pseudoVoulu` VARCHAR(255))  NO SQL
SELECT id, pseudo, mdp, choix_nounou
FROM membres
WHERE pseudo = pseudoVoulu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Atelier` ()  SQL SECURITY INVOKER
BEGIN
SELECT * FROM atelier;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Enfant` ()  BEGIN
SELECT * FROM enfant;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Enfant_Atelier` (IN `pIdAte` INT)  MODIFIES SQL DATA
BEGIN
SELECT * FROM enfant WHERE (enfant.ateId = pIdAte);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Enfant_Atelier2` (IN `pIdAte` INT)  MODIFIES SQL DATA
BEGIN SELECT * FROM enfant
INNER JOIN presence_atelier_enfant ON enfant.enfId = presence_atelier_enfant.enfId

WHERE (presence_atelier_enfant.ateId = pIdAte); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Enfant_Date` (IN `pdate` DATETIME)  MODIFIES SQL DATA
BEGIN
SELECT * FROM enfant WHERE (enfDateInscription <= pdate AND enfDateFinInscription >= pdate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recup_Enfant_Id` (IN `pIdEnf` INT)  MODIFIES SQL DATA
BEGIN
SELECT * FROM enfant WHERE (enfant.enfId = pIdEnf);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `supprimer_Enfant` (IN `pid` INT)  MODIFIES SQL DATA
BEGIN
DELETE FROM `Enfant`
WHERE `enfId` = pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Enfant` (IN `pPrenom` VARCHAR(255), IN `pNom` VARCHAR(255), IN `pNum` VARCHAR(255), IN `pStatut` VARCHAR(255), IN `pInfos` VARCHAR(255), IN `pDateIns` DATETIME, IN `pDateFinIns` DATETIME, IN `pId` INT(255))  MODIFIES SQL DATA
BEGIN
UPDATE enfant SET enfPrenom = pPrenom, enfNom = pNom, enfNumTelParent = pNum, enfStatut = pStatut, enfInformations = pInfos, enfDateInscription = pDateIns, enfDateFinInscription = pDateFinIns WHERE enfId = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Enfant_ateId` (IN `pEnfId` INT, IN `pAteId` INT)  MODIFIES SQL DATA
BEGIN
UPDATE enfant SET enfant.ateId = pAteId  WHERE enfId = pEnfId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `ateID` int(11) NOT NULL,
  `ateNom` varchar(50) DEFAULT NULL,
  `ateDescription` varchar(50) DEFAULT NULL,
  `ateHoraire` varchar(50) NOT NULL,
  `ateJour` varchar(50) NOT NULL,
  `ateNbrPlace` int(11) DEFAULT NULL,
  `atePublicConcerne` varchar(50) DEFAULT NULL,
  `enfId` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `atelier`
--

INSERT INTO `atelier` (`ateID`, `ateNom`, `ateDescription`, `ateHoraire`, `ateJour`, `ateNbrPlace`, `atePublicConcerne`, `enfId`) VALUES
(1, 'Sieste', 'Fais dodo', '14:00', '2019-04-25 14:33:11', 50, 'Parents', NULL),
(2, 'Peinture', 'Peinture', '16:00', '2019-04-25 14:33:11', 6, 'Assistantes Maternelles', NULL),
(3, 'Maxime', 'On fait des Maximes', '20:00', '2019-04-25 14:33:11', 69, 'Parents', NULL),
(4, 'Chanson', 'On chante et on apprend des chansons !', '15:00', '2019-04-25 14:33:11', 999, 'Parents', NULL),
(5, 'Promenade', 'Balade dans le parc', '10:00', '2019-04-25 14:33:11', 10, 'Assistantes Maternelles', NULL),
(6, 'Jouer (salle bleue)', 'Jouer dans la salle bleue', '8:00', '2019-04-25 14:33:11', 56, 'Assistantes Maternelles', NULL),
(7, 'Guirlande de Noël', 'On fait des guirlandes de Noël', '', '2019-04-25 14:33:11', 20, '', NULL),
(8, 'Gilets Jaunes', 'On fait greve', '23:00', '2019-04-25 14:33:11', 62, 'Parents', NULL),
(9, 'Je', 'Suis', 'Un', '2019-04-25 14:33:11', 234, 'Prout', NULL),
(10, 'STP', 'fonctionne', 'jean', '2019-04-25 14:33:11', 27, 'mer2', NULL),
(11, 'Maxime est un dieu', 'On fait ENCORE des Maximes', '9:00', '2019-04-25 14:33:11', 1666, 'Parents', NULL),
(12, 'Tabassage d\'enfant', 'On se défoule', '11:00', '2019-04-25 14:33:11', 69, 'Parents', NULL),
(13, 'At', 'nj', '8:00', '2019-04-25 14:33:11', 5, 'Parents', NULL),
(14, '', '', '', '2019-04-25 00:00:00', 600, 'Parents', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `id` int(11) NOT NULL,
  `sante` varchar(255) NOT NULL,
  `temperature` double NOT NULL,
  `pleurs` varchar(255) NOT NULL,
  `besoins` varchar(255) NOT NULL,
  `repas` varchar(255) NOT NULL,
  `aliments` varchar(255) NOT NULL,
  `dodo` varchar(255) NOT NULL,
  `humeur` varchar(255) NOT NULL,
  `activite` varchar(255) NOT NULL,
  `promenade` varchar(255) NOT NULL,
  `remarques` longtext,
  `date` datetime NOT NULL,
  `idEnfant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `calendrier`
--

INSERT INTO `calendrier` (`id`, `sante`, `temperature`, `pleurs`, `besoins`, `repas`, `aliments`, `dodo`, `humeur`, `activite`, `promenade`, `remarques`, `date`, `idEnfant`) VALUES
(17, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Rugby', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 42),
(18, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Badminton', '10h 12h', 'Il a travaille', '2019-03-27 00:00:00', 43),
(19, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Basket', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 44),
(23, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', '', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 41),
(24, '10', 1, '0101', '01', '01', '', '0101', '10', '01', '01', '01', '2019-04-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `enfant`
--

CREATE TABLE `enfant` (
  `enfId` int(255) NOT NULL,
  `enfPrenom` varchar(255) NOT NULL,
  `enfNom` varchar(255) NOT NULL,
  `enfNumTelParent` varchar(255) NOT NULL,
  `enfStatut` varchar(255) NOT NULL,
  `enfInformations` varchar(255) NOT NULL,
  `enfDateInscription` datetime NOT NULL,
  `enfDateFinInscription` datetime NOT NULL,
  `ateId` int(255) DEFAULT NULL,
  `enfAge` int(255) DEFAULT NULL,
  `idParent` int(255) DEFAULT NULL,
  `idNounou` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enfant`
--

INSERT INTO `enfant` (`enfId`, `enfPrenom`, `enfNom`, `enfNumTelParent`, `enfStatut`, `enfInformations`, `enfDateInscription`, `enfDateFinInscription`, `ateId`, `enfAge`, `idParent`, `idNounou`) VALUES
(1, 'Jean', 'Valjean', '', 'Régulier', '', '2019-04-22 17:13:31', '2019-04-23 22:06:34', 9, NULL, 1, 3),
(2, 'Léo', 'Paul', '0605080705', 'Régulier', 'Asthme', '2019-02-12 00:00:00', '2019-03-14 00:00:00', 9, NULL, NULL, NULL),
(4, 'Jean', 'Valjean', '', 'Régulier', '', '2019-04-22 17:13:31', '2019-04-23 22:06:34', 6, NULL, NULL, NULL),
(5, 'Pernault', 'Jean Pierre', '008', '', 'Nouveau', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 3, NULL, NULL, NULL),
(6, '', '', '', '', '', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 7, NULL, NULL, NULL),
(7, 'Victor', 'Louvet', '0638527587', 'Régulier', 'Aucune', '1999-09-08 00:00:00', '2099-12-31 00:00:00', 8, NULL, NULL, NULL),
(8, '', 'Rubert', '', '', '', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 3, NULL, NULL, NULL),
(9, 'Jean', 'Pierre', '000002', 'Régulier', 'Aucune', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 5, NULL, NULL, NULL),
(10, 'Jean', 'Pierre', '000002', 'Régulier', 'Aucune', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 11, NULL, NULL, NULL),
(12, 'Jean', 'Pierre', '000002', 'Régulier', 'Aucune', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 12, NULL, NULL, NULL),
(14, '', '', '', '', '', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 5, NULL, NULL, NULL),
(15, 'Victor', 'Louvet', '0638527587', '', 'Aucune', '1999-09-08 00:00:00', '2099-12-31 00:00:00', 6, NULL, NULL, NULL),
(16, 'Kevin', 'Delsart', '1215', 'Occasionnel', 'Débile', '2019-03-27 00:00:00', '2019-12-15 00:00:00', 4, NULL, NULL, NULL),
(17, 'Louise', 'Rubert', '06543210', 'Occasionnel', '', '2019-04-22 00:00:00', '2019-04-22 00:00:00', 12, NULL, NULL, NULL),
(18, 'Jules', 'Bébé', '0638520000', 'Régulier', 'Aucune', '2014-07-31 00:00:00', '2019-08-31 00:00:00', 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `horID` int(11) NOT NULL,
  `horLib` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `horaire`
--

INSERT INTO `horaire` (`horID`, `horLib`) VALUES
(1, '8:00'),
(2, '9:00'),
(3, '10:00'),
(4, '11:00'),
(5, '12:00'),
(6, '13:00'),
(7, '14:00'),
(8, '15:00'),
(9, '16:00'),
(10, '17:00'),
(11, '18:00'),
(12, '19:00'),
(13, '20:00'),
(14, '21:00'),
(15, '22:00'),
(16, '23:00'),
(17, '00:00');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

CREATE TABLE `jour` (
  `jourID` int(11) NOT NULL,
  `jourLib` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jour`
--

INSERT INTO `jour` (`jourID`, `jourLib`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi'),
(7, 'Dimanche');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `cp` int(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nbrEnfant` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `choix_nounou` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `cp`, `ville`, `pays`, `email`, `nbrEnfant`, `type`, `choix_nounou`) VALUES
(1, 'Parent', '$2y$10$S1miluTi.e8aTGnXNvGZNeYQfIaC5oAUwOGBafV/HRmxq1tpMTzQa', 'Cazin', 'Guillaume', 62200, 'Boulogne-sur-Mer', 'France', 'czn.guillaume@gmail.com', '1', 'parent', 3),
(2, 'Parent-2', '$2y$10$mNamhXoPrOTsA909DliuoOpTIgE6GfGrwMuO3Jg2akjv9IcDeDHvS\n', 'Parent', 'Parent', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '3', 'parent', 4),
(3, 'Assistante', '$2y$10$DPIms/xONoMZH4oVcSACLurw19GvAulQ6DSjHJ44T42bSjHEIwRDS', 'Assistante', 'Assistante', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '', 'assistante', 0),
(4, 'Assistante-2', '$2y$10$jZWkfiSzQogzEgTd0yILMujnCjrKBFej7YE0tkMjCtNYVa4Aerqm.', 'Assistante-2', 'Assistante-2', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '', 'assistante', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `presence_atelier_enfant`
--

CREATE TABLE `presence_atelier_enfant` (
  `enfId` int(11) NOT NULL,
  `ateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `presence_atelier_enfant`
--

INSERT INTO `presence_atelier_enfant` (`enfId`, `ateId`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(15, 7),
(15, 8);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`ateID`),
  ADD KEY `ateID` (`ateID`);

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEnfant` (`idEnfant`);

--
-- Index pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD PRIMARY KEY (`enfId`),
  ADD KEY `enfId` (`enfId`),
  ADD KEY `idParent` (`idParent`,`idNounou`),
  ADD KEY `idNounou` (`idNounou`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`horID`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`jourID`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `presence_atelier_enfant`
--
ALTER TABLE `presence_atelier_enfant`
  ADD PRIMARY KEY (`enfId`,`ateId`),
  ADD KEY `FK_presenceEnfant_atelierId` (`ateId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
  MODIFY `ateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `enfant`
--
ALTER TABLE `enfant`
  MODIFY `enfId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `horID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `jourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD CONSTRAINT `enfant_ibfk_1` FOREIGN KEY (`idParent`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `enfant_ibfk_2` FOREIGN KEY (`idNounou`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `presence_atelier_enfant`
--
ALTER TABLE `presence_atelier_enfant`
  ADD CONSTRAINT `FK_presenceEnfant_atelierId` FOREIGN KEY (`ateId`) REFERENCES `atelier` (`ateID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_presenceEnfant_enfantID` FOREIGN KEY (`enfId`) REFERENCES `enfant` (`enfId`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
